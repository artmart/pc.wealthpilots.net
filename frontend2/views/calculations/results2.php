<?php 
function calculateMarketHistory1($calculation, $years){
    $table2JsonData = [];
    //reset worth to original income so we can subtract freely
    $total['worth'] = $calculation['value'];
    $total['remaining'] = $calculation['value'];
    
    //reset statistics values to ensure it's always recalculated
    $statistics['averageReturn'] = 0;
    //default value is 1 because 0? anything is 0 ;)
    $statistics['geometricAverage'] = 1;
    $statistics['actualAnnualizedYield'] = 0;
    $statistics['finalNetValue'] = 0;
    $statistics['totalAnnualizedYield'] = 0;
    $statistics['earnedIncome'] = 0;
    $statistics['lowestPrincipal'] = $calculation['value'];
    
    //iterate over years, workout monthly math and reduce total worth
        
   // var_dump($years);
   // exit;
    
    foreach($years as $index=>$year){
      $year['geometricAverage'] = (1 + ($year['return'] / 100));
      $statistics['earnedIncome'] += ($years[($index == 0 ? 0 : $index -1)]['eoy'] < $years[($index == 0 ? 0 : $index -1)]['income'] ? $years[($index == 0 ? 0 : $index -1)]['eoy'] : $year['income']);
      $year['charges'] = 0;
      $year['fees'] = 0;
      $year['boy'] = 0;
      $year['eoy'] = 0;
      $year['toggled'] = false;
    
      // calculate statistics
      $statistics['averageReturn'] += $year['return'];
      $statistics['geometricAverage'] *= $year['geometricAverage'];
      
      //////////////////////////////////////////////////////
      //dynamic monthly values
      /*
      $fees = 0;
          for($j = 1; $j<13; $j++){
            $month = [];
            $calculatedValue = ((1 + $year['return'] / 12 / 100) * $total['worth']) - $year['income'] / 12;
            $charge = $calculation['fee'] / 12 / 100 * $calculatedValue;
            $globalFee = $calculation['fee'] / 12 / 100;
            $remaining = ($calculatedValue - ($globalFee * $calculatedValue) < 0 ? 0 : $calculatedValue - ($globalFee * $calculatedValue));
            $monthlyCharge = $globalFee * $calculatedValue;

            $month['month'] = $j;
            $month['income'] = $year['income'] / 12;
            $month['fee'] = $globalFee;
            $month['interest'] = $year['return'] / 12 / 100;
            $month['rate'] = $year['return'] / 12 / 100;
            $month['value'] = $calculatedValue;
            $month['charge'] = ($monthlyCharge < 0 ? 0 : $monthlyCharge);
            $month['remaining'] = $remaining;

            $fees += $month['charge'];

            //$month['previousRemaining'] = $previousRemaining;
            $month['fees'] = $fees;
            $statistics['lowestPrincipal'] = ($remaining < $statistics['lowestPrincipal'] ? $remaining : $statistics['lowestPrincipal']);
            if($statistics['lowestPrincipal']< 0){
              $statistics['lowestPrincipal'] = 0;
            }
            $total['worth'] = $remaining;
            $total['remaining'] -= $remaining;
            //$previousRemaining = $month['remaining'];

            $year['months'][] = $month; // .push(month)  
          }
          $years[$index] = $year;
          */
           
    ////////////////////////////////////////////////////////////////////////////////
      //var_dump($year['return']);
      //foreach($year['months'] as $month){
        for($j = 1; $j<13; $j++){
            $month = [];
        
        $month['rate'] = $year['rate'] / 12;
        
        $calculatedValue = ((1 + $month['rate'] / 100) * $total['worth']) - $year['income'] / 12;
        $charge = $month['rate'] / 100 * $calculatedValue;
        $globalFee = $calculation['fee'] / 12 / 100;
        $remaining = $calculatedValue - ($globalFee * $calculatedValue);
        $monthlyCharge = $globalFee * $calculatedValue;
        $month['month'] = $j;
        $month['income'] = $year['income'] / 12;
        $month['fee'] = $globalFee;
        $month['value'] = $calculatedValue;
        $month['charge'] = ($monthlyCharge < 0 ? 0 : $monthlyCharge);
        $month['remaining'] = $remaining;
        $statistics['lowestPrincipal'] = ($remaining < $statistics['lowestPrincipal'] ? $remaining : $statistics['lowestPrincipal']);
        if($statistics['lowestPrincipal'] < 0){
          $statistics['lowestPrincipal'] = 0;
        }
        $total['worth'] = $remaining;
        $total['remaining'] -= $remaining;
        
        $year['charges'] += floatval($month['charge']);
        $year['months'][] = $month;
      }
      $years[$index] = $year;
    
      $year['boy'] = ($index>0 && $years[$index - 1]) ? $years[$index - 1]['months'][11]['remaining'] : $calculation['value']; //????
      //$year['fees'] += $year['charges'] + (($index>0 && $years[$index - 1]) ? $years[$index - 1]['fees'] : null);
      $year['fees'] = $year['fees'] + $year['charges'] + ($index>0 && $years[$index - 1] ? $years[$index - 1]['fees'] : 0);
      // last iteration will assign final net value
      $year['eoy'] = $statistics['actualAnnualizedYield'] = $years[$index]['months'][11]['remaining']; //???????
    
      $statistics['totalAnnualizedYield'] = $year['eoy'];
      $statistics['finalNetValue'] = $year['eoy'];
    
      if($year['eoy']<0){$year['eoy'] = $statistics['actualAnnualizedYield'] = 0;}
      if($year['boy']<0){$year['boy'] = 0;}
      
      $table2JsonData[] = [$year['year'], $year['return'].'%', '$'.number_format($year['income']), '$'.number_format($year['charges'], 2), '$'.number_format($year['boy'], 2), '$'.number_format($year['eoy'], 2), '$'.number_format($year['fees'], 2)]; 
                        
    }

    calculateStatistics($statistics, $calculation, $table2JsonData);
}

///////////////////////////////////////////////////////////////////

















///  let app = new Vue({
//    el: '#app',
    data: () => ({
      loading: false,
      showMarketHistory: false,
      showBreakeven: false,
      marketHistory: {
        from: 2000,
        to: null,
      },
      total: {
        worth: null,
        remaining: null,
      },
      calculation: {
        reference: null,
        value: null,
        years: null,
        return: null,
        income: null,
        fee: null,
      },
      statistics: {
        averageReturn: 0,
        geometricAverage: 1,
        actualAnnualizedYield: 0,
        earnedIncome: 0,
        lowestPrincipal: 0,
        optimalBreakeven: 0,
      },
      years: [],
      demo: {
        reference: 'demo',
        value: 100000,
        years: 10,
        return: 5,
        income: 4000,
        fee: 1,
      },
      breakevenCurrent: 0,
      breakevenYrs: 0,
      breakevenIndex: 0,
      breakevenIncome: [],
      breakevenErrors: [],
    }),
    
    
    
    
    
//////////////////////////////////////////////////////////    
    watch: {
      calculation: {
        handler(val) {
          this.doTheMath()
        },
        deep: true,
      },
      marketHistory: {
        handler(val) {
          if (this.marketHistory.from > 1999) {
            this.doTheMath()
          }
        },
        deep: true,
      },
      showMarketHistory() {
        this.doTheMath()
      },
    },
    
//////////////////////////////////////////////////    
    
    computed: {
      yearRange() {
        let years = []

        currentYear = new Date().getFullYear();

        for (i = 2000; i <= currentYear; i++) {
          years.push(i)
        }

        console.log(years)

        return years
      },
    },
    
    
////////////////////////////////////////////////////////////////////

   // methods: {
      toggleBreakeven(index) {
        negatives = 0
        this.breakevenYrs = 0
        this.breakevenIndex = 0
        this.breakevenIncome = []
        this.breakevenErrors = []
        this.years.forEach((year, index) => {
          if (this.years[index].return < 0 && index < this.calculation.years - 1){
            negatives ++
            this.breakevenIndex = (index > this.breakevenIndex || this.breakevenIndex == 0 ? index : this.breakevenIndex)
          }
        })
        if (negatives > 0){
          this.showBreakeven = true
          this.breakevenYrs = this.calculation.years - this.breakevenIndex - 1
            for (i = 0; i < this.breakevenYrs; i++){
            this.breakevenIncome[i] = this.years[this.breakevenIndex + i+ 1].income
          }

          this.calculateMonths()
          this.calculateBreakeven()
        }
        else{
          this.showBreakeven = false
          this.calculateMonths()
        }
      },
      
      toggleIncome(index) {
        this.breakevenErrors = []
        if (index > this.breakevenIndex){
          this.breakevenIncome[index - this.breakevenIndex - 1] = this.years[index].income
          this.calculateMonths()
          this.calculateBreakeven()
        }
        else{
          this.calculateMonths()
          this.calculateBreakeven()
        }
      },
      
      calculateBreakeven() {
        let CAGRs = []
        let prevBalance = this.years[this.breakevenIndex].eoy
        let yrsLeft = this.breakevenYrs
        if (prevBalance < this.years[this.breakevenIndex].income){
          this.optimalBreakeven = null
          return
        }
        console.log(this.breakevenIndex,this.calculation.years)
        for (i = this.breakevenIndex + 1; i < this.calculation.years; i++){
          CAGRs[i - this.breakevenIndex - 1] = (Math.pow(this.calculation.value / prevBalance, (1 / yrsLeft)) - 1) + this.breakevenIncome[i - this.breakevenIndex - 1]/prevBalance + this.calculation.fee/100
          let tempBalance = prevBalance
          for (j = 0; j < 12; j++){
            tempBalance = tempBalance * (1 + (CAGRs[i - this.breakevenIndex - 1]/12))
            tempBalance = tempBalance - (this.breakevenIncome[i - this.breakevenIndex - 1]/12)
            tempBalance = tempBalance * (1 - (this.calculation.fee/100)/12)
          }
          prevBalance = tempBalance
          yrsLeft--
        }
        console.log(CAGRs)

        minRate = 1
        maxRate = 0
        switchIndex = 0
        switcher = 0

        for (i = 0; i < this.breakevenYrs; i++){
          minRate = (minRate > CAGRs[i] ? CAGRs[i] : minRate)
          maxRate = (maxRate < CAGRs[i] ? CAGRs[i] : maxRate)
        }

        let rateCount = 0
        for (rate = minRate; rate <= maxRate; rate += 0.0001){
          let yrsLeft = this.breakevenYrs
          let prevBal = this.years[this.breakevenIndex].eoy
          yr = 0

          while (yr < yrsLeft){
            let tempBal = prevBal
            for (j = 0; j < 12; j++){
              tempBal = tempBal * (1 + (rate/12))
              tempBal = tempBal - (this.breakevenIncome[yr]/12)
              tempBal = tempBal * (1 - (this.calculation.fee/100)/12)
            }
            prevBal = tempBal
            yr++
            }
          this.breakevenErrors[rateCount] = this.calculation.value - prevBal
          if (switcher == 0 && this.breakevenErrors[rateCount] < 0){
            switcher = 1
            switchIndex = rateCount - 1
            console.log(switchIndex)
          }
          console.log(minRate,rate,maxRate,rateCount,this.breakevenErrors[rateCount])
          rateCount++
        }

        this.statistics.optimalBreakeven = 100 * (minRate + (switchIndex + 1)*0.0001)
      },
      
      toggleYear(year) {
        year.toggled = !year.toggled
      },
      
      returnUp(index) {
        currentReturn = this.years[index].return

        while (index >= 0) {
          this.years[index].return = currentReturn
          index--
          this.calculateMonths()
        }
        this.toggleBreakeven()
      },
      
      returnDown(index) {
        currentReturn = this.years[index].return
        yearsCount = this.years.length

        while (index <= yearsCount - 1) {
          this.years[index].return = currentReturn
          index++
          this.calculateMonths()
        }
        this.toggleBreakeven()
      },
      
      incomeUp(index) {
        currentIncome = this.years[index].income

        while (index >= 0) {
          this.years[index].income = currentIncome
          index--
          this.calculateMonths()
        }
        this.toggleIncome()
        this.toggleBreakeven()
      },
      
      incomeDown(index) {
        currentIncome = this.years[index].income
        yearsCount = this.years.length

        while (index <= yearsCount - 1) {
          this.years[index].income = currentIncome
          index++
          this.calculateMonths()
        }
        this.toggleIncome()
        this.toggleBreakeven()
      },
      
      
/*      
      saveCalculation() {
        if (!this.calculation.reference) {
          alert('Cannot save calculation without Reference ID')
          return
        }

        this.loading = true
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content

        fetch('/archive', {
          method: 'post',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-Token': csrfToken,
          },
          credentials: 'same-origin',
          body: JSON.stringify({
            meta: {
              calculation: this.calculation,
              years: this.years,
              statistics: this.statistics,
            }
          })
        })
        .then(response => response.json())
        .then(result => {
          this.loading = false
          if (result.message == 'Success') {
            window.location = '/archive';
          }
        })
      },
*/      
      
      
      assignDemo() {
        this.showMarketHistory = false
        this.showBreakeven = false
        this.doTheMath()
        Object.assign(this.calculation, this.demo)
      },
      
      toggleMarketHistory() {
        this.showMarketHistory = !this.showMarketHistory
      },
      
      clearValues() {
        this.years = []
        this.calculation = {
          reference: null,
          value: null,
          years: null,
          return: null,
          income: null,
          fee: null,
          monthlyFee: null,
          monthlyPercentage: null,
        }
      },
      
      calculateMarketHistory() {
        // reset worth to original income so we can subtract freely
        this.total.worth = this.calculation.value
        this.total.remaining = this.calculation.value

        // reset statistics values to ensure it's always recalculated
        this.statistics.averageReturn = 0
        // default value is 1 because 0? anything is 0 ;)
        this.statistics.geometricAverage = 1
        this.statistics.actualAnnualizedYield = 0
        this.statistics.finalNetValue = 0
        this.statistics.totalAnnualizedYield = 0
        this.statistics.earnedIncome = 0
        this.statistics.lowestPrincipal = this.calculation.value

        // iterate over years, workout monthly math and reduce total worth
        this.years.forEach((year, index) => {
          year.geometricAverage = (1 + (year.return / 100))
          this.statistics.earnedIncome += (this.years[(index == 0 ? 0 : index -1)].eoy < this.years[(index == 0 ? 0 : index -1)].income ? this.years[(index == 0 ? 0 : index -1)].eoy : year.income)
          year.charges = null
          year.fees = null
          year.boy = null
          year.eoy = null
          year.toggled = false

          // calculate statistics
          this.statistics.averageReturn += year.return
          this.statistics.geometricAverage *= year.geometricAverage

          year.months.forEach((month) => {
            let calculatedValue = ((1 + month.rate / 100) * this.total.worth) - year.income / 12
            let charge = month.rate / 100 * calculatedValue
            let globalFee = this.calculation.fee / 12 / 100
            let remaining = calculatedValue - (globalFee * calculatedValue)
            let monthlyCharge = globalFee * calculatedValue
            month.income = year.income / 12
            month.fee = globalFee
            month.value = calculatedValue
            month.charge = (monthlyCharge < 0 ? 0 : monthlyCharge)
            month.remaining = remaining
            this.statistics.lowestPrincipal = (remaining < this.statistics.lowestPrincipal ? remaining : this.statistics.lowestPrincipal)
            if (this.statistics.lowestPrincipal < 0) {
              this.statistics.lowestPrincipal = 0
            }
            this.total.worth = remaining
            this.total.remaining -= remaining
            year.charges += parseFloat(month.charge.toFixed(4))
          })

          year.boy = (this.years[index - 1] ? this.years[index - 1].months[11].remaining : this.calculation.value)
          year.fees += year.charges + (this.years[index - 1] ? this.years[index - 1].fees : null)
          // last iteration will assign final net value
          year.eoy = this.statistics.actualAnnualizedYield = this.years[index].months[11].remaining

          this.statistics.totalAnnualizedYield = year.eoy
          this.statistics.finalNetValue = year.eoy

          if (year.eoy < 0) {
            year.eoy = this.statistics.actualAnnualizedYield = 0
          }

          if (year.boy < 0) {
            year.boy = 0
          }
        })

        this.calculateStatistics()
      },
      
      calculateMonths() {
        // reset worth to original income so we can subtract freely
        this.total.worth = this.calculation.value
        this.total.remaining = this.calculation.value

        // reset statistics values to ensure it's always recalculated
        this.statistics.averageReturn = 0
        // default value is 1 because 0? anything is 0 ;)
        this.statistics.geometricAverage = 1
        this.statistics.actualAnnualizedYield = 0
        this.statistics.finalNetValue = 0
        this.statistics.totalAnnualizedYield = 0
        this.statistics.earnedIncome = 0
        this.statistics.lowestPrincipal = this.calculation.value

        // iterate over years, workout monthly math and reduce total worth
        this.years.forEach((year, index) => {
          year.geometricAverage = (1 + (year.return / 100))
          this.statistics.earnedIncome += (this.years[(index == 0 ? 0 : index -1)].eoy < this.years[(index == 0 ? 0 : index -1)].income ? this.years[(index == 0 ? 0 : index -1)].eoy : year.income)
          year.charges = null
          year.fees = null
          year.boy = null
          year.eoy = null
          year.toggled = false
          year.months = []
          let previousRemaining = (!this.years[index - 1] ? this.calculation.value : this.years[index - 1].months[11].remaining)
          let fees = 0

          // calculate statistics
          this.statistics.averageReturn += year.return
          this.statistics.geometricAverage *= year.geometricAverage

          // dynamic monthly values
          for (j = 1; j < 13; j++) {
            let month = {}
            let calculatedValue = ((1 + year.return / 12 / 100) * this.total.worth) - year.income / 12
            let charge = this.calculation.fee / 12 / 100 * calculatedValue
            let globalFee = this.calculation.fee / 12 / 100
            let remaining = (calculatedValue - (globalFee * calculatedValue) < 0 ? 0 : calculatedValue - (globalFee * calculatedValue))
            let monthlyCharge = globalFee * calculatedValue

            month.month = j
            month.income = year.income / 12
            month.fee = globalFee
            month.interest = year.return / 12 / 100
            month.value = calculatedValue
            month.charge = (monthlyCharge < 0 ? 0 : monthlyCharge)
            month.remaining = remaining

            fees += month.charge

            month.previousRemaining = previousRemaining
            month.fees = fees
            this.statistics.lowestPrincipal = (remaining < this.statistics.lowestPrincipal ? remaining : this.statistics.lowestPrincipal)
            if (this.statistics.lowestPrincipal < 0) {
              this.statistics.lowestPrincipal = 0
            }
            this.total.worth = remaining
            this.total.remaining -= remaining
            previousRemaining = month.remaining

            year.months.push(month)
          }

          year.months.forEach((month) => {
            year.charges += parseFloat(month.charge.toFixed(4))
          })

          year.boy = (this.years[index - 1] ? this.years[index - 1].months[11].remaining : this.calculation.value)
          year.fees += year.charges + (this.years[index - 1] ? this.years[index - 1].fees : null)
          // last iteration will assign final net value
          year.eoy = this.statistics.actualAnnualizedYield = this.years[index].months[11].remaining

          if (year.eoy < 0) {
            year.eoy = this.statistics.actualAnnualizedYield = 0
          }

          if (year.boy < 0) {
            year.boy = 0
          }

          this.statistics.totalAnnualizedYield = year.eoy
          this.statistics.finalNetValue = year.eoy
        })

        this.calculateStatistics()
      },
      
      calculateStatistics() {
        this.statistics.averageReturn = this.statistics.averageReturn / this.calculation.years
        // javascript does not support "y square root of x", but supports a second argument in "x to the power of y"
        this.statistics.geometricAverage = (Math.pow(this.statistics.geometricAverage, (1 / this.calculation.years)) - 1) * 100
        this.statistics.actualAnnualizedYield = (Math.pow(this.statistics.actualAnnualizedYield / this.calculation.value, (1 / this.calculation.years)) - 1) * 100
        this.statistics.totalAnnualizedYield = (Math.pow((this.statistics.totalAnnualizedYield + this.statistics.earnedIncome) / this.calculation.value, (1 / this.calculation.years)) - 1) * 100
        this.statistics.finalNetValue = this.statistics.finalNetValue + this.statistics.earnedIncome
      },
      
      doTheMath() {
        this.years = []
        // worth is a duplicate of income, so that the value can be manipulated
        this.total.worth = this.calculation.value

        let currentYear = new Date().getFullYear()
        let yearsRange = this.calculation.years

        if (this.showMarketHistory) {
          currentYear = this.marketHistory.from

          if (!this.marketHistory.to) {
            this.marketHistory.to = this.marketHistory.from
          }

          if (this.marketHistory.from > this.marketHistory.to) {
            this.marketHistory.to = this.marketHistory.from
          }

          yearsRange = this.marketHistory.to - this.marketHistory.from
          this.calculation.years = yearsRange
        }

        // TODO - detect existing value and don't overwrite

        if (!this.showMarketHistory) {
          // years
          for (i = 0; i < yearsRange; i++) {
            let year = {}
            year.year = currentYear + i
            year.return = this.calculation.return
            year.income = this.calculation.income
            year.toggled = false
            year.months = []
            this.years.push(year)
          }

          this.calculateMonths()
        }

        if (this.showMarketHistory) {
          fetch('/rates')
          .then(response => response.json())
          .then(data => {
            this.years = []
            data.forEach(year => {
              if (year['year'] < this.marketHistory.from) {
                return
              }

              if (year['year'] >= this.marketHistory.to) {
                return
              }

              year.return *= 100
              year.income = this.calculation.income
              this.years.push(year)
            })
            this.calculateMarketHistory()
          })
        }
      }
   // },
    
/*    
    filters: {
      formatCurrency: function (value) {
        return value.toLocaleString('en-US', { maximumFractionDigits: 2, minimumFractionDigits: 2 })
      },
      twoDecimals: function (value) {
        return parseFloat(value).toFixed(2)
      },
      formatMonth: (month) => {
        const date = new Date('2020', month - 1, '1')
        return date.toLocaleString('default', { month: 'long'})
      }
    }
    
    
  })

*/

?>