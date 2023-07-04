<?php
$this->title = 'Home';


 




?>


<!DOCTYPE html>
<html lang="en">
<head>
  	<title>Annuity Indexing Strategy Comparison Calculator</title>
    <meta name="description" content="Annuity Indexing Strategy Comparison Calculator">
    <meta name="keywords" content="annuity, indexing, strategy, comparison, calculator">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="Etag" content="<?php echo time(); ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/css/smoothness/jquery-ui-1.10.0.custom.min.css" />-->
       
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
    
    
<style>
.pagetitle { font-family: 'Montserrat', "Open Sans", Helvetica, Arial, sans-serif; font-weight: 900; font-size: 32px; text-align: center; letter-spacing: -1px; padding: 0; }
.calculatorbox { padding: 20px; border: 2px solid #28a745; border-radius: 4px; }
.horizontal-scrollable {
            overflow-x: auto;
           /* white-space: nowrap;
            display: inline-block;
            float: none;*/
        }
.table {
    color: #fff;
    text-align: center;
}
</style>


<!-- Content -->
<div class="container">
    <div class="row">
            <!--<a class="brand" href="/"><img src="logo.png" style= 'height: 35px; margin-bottom: -60px;'/></a>-->
    		<div class="pagetitle">Annuity Indexing Strategy Comparison Calculator</div>
            <p style="text-align: center;" class="small">For Illustrative Purposes Only & Does Not Represent Any Specific Products</p>
    </div>
    <hr />
    <div class="row">
        
        <div class="col-sm-12">
            <div class="calculatorbox">
            
<form class="row g-3 needs-validation" id="form_id" novalidate>

<div class="col-md-3">
<div class="card border-secondary mb-1">
  <div class="card-header">Input Values</div>
  <div class="card-body text-secondary">
  <div class="col-md-12">
    <label for="investment_amount" class="form-label">Investment Amount</label>
    <div class="input-group has-validation">
    <span class="input-group-text" id="investment_amount_prepend">$</span>
    <input type="text" class="form-control decimal" id="investment_amount" value="2,000,000" required>
    <div class="invalid-feedback">Please input a Valid Investment Amount</div>
    </div>
  </div>
 <!-- 
  <div class="col-md-2">
    <label for="income_need" class="form-label">Income Need</label>
    <div class="input-group has-validation">
    <span class="input-group-text" id="income_need_prepend">$</span>
    <input type="text" class="form-control" id="income_need" value="0" required>
    <span class="input-group-text">yr</span>
    <div class="invalid-feedback">Please input a Valid Income Need</div>
    </div>
  </div>
  -->
  <div class="col-md-12">
    <label for="client_age" class="form-label">Client Age</label>
    <div class="input-group has-validation">
    <input type="text" class="form-control" id="client_age" value="67" max="120" required>
    <span class="input-group-text">yr</span>
    <div class="invalid-feedback">Please input a Valid Client Age</div>
    </div>
  </div>
  <div class="col-md-12">
    <label for="management_fee" class="form-label">Management Fee</label>
    <div class="input-group has-validation">
    <input type="text" class="form-control" max="100" id="management_fee" value="0.25" required>
    <span class="input-group-text">%</span>
    <div class="invalid-feedback">Please input a Valid Management Fee</div>
    </div>
  </div>  
  </div>
</div>
</div>

<div class="col-md-3">
<div class="card border-danger mb-1">
  <div class="card-header">S&P 500 (1999-2019)</div>
  <div class="card-body text-danger">
  <div class="col-md-12">
    <label for="growth_bucket" class="form-label">Growth Bucket</label>
    <div class="input-group has-validation">
    <input type="text" class="form-control" id="growth_bucket" value="50" required>
    <span class="input-group-text">%</span>
    <div class="invalid-feedback">Please input a Valid Growth Bucket</div>
    </div>
  </div>
  <div class="col-md-12">
    <label for="" class="form-label">No Safety Net</label>
    <div class="input-group has-validation">
    <input type="text" class="form-control decimal" id="No Safety Net" value="" placeholder="Volatility">
    <div class="invalid-feedback">Please input a Valid No Safety Net</div>
    </div>
  </div>
  <div class="col-md-12">
    <label for="wd_1" class="form-label">Withdrawal</label>
    <div class="input-group has-validation">
    <span class="input-group-text" id="wd_1_prepend">$</span>
    <input type="text" class="form-control decimal" id="wd_1" value="50,000" required>
    <div class="invalid-feedback">Please input a Valid Withdrawal</div>
    </div>
  </div>
  </div>
</div>
</div>
<div class="col-md-3">
<div class="card border-success mb-1">
  <div class="card-header">Annuity With CAP</div>
  <div class="card-body text-success">
  <div class="col-md-12">
    <label for="safe_bucket_cap" class="form-label">Safe Bucket - Cap</label>
    <div class="input-group has-validation">
    <input type="text" class="form-control" id="safe_bucket_cap" value="50" required>
    <span class="input-group-text">%</span>
    <div class="invalid-feedback">Please input a Valid Safe Bucket - Cap</div>
    </div>
  </div> 
  <div class="col-md-12">
    <label for="cap_rate" class="form-label">Cap Rate</label>
    <div class="input-group has-validation">
    <input type="text" class="form-control" id="cap_rate" value="3" required>
    <span class="input-group-text">%</span>
    <div class="invalid-feedback">Please input a Valid Cap Rate</div>
    </div>
  </div>
  <div class="col-md-12">
    <label for="wd_2" class="form-label">Withdrawal</label>
    <div class="input-group has-validation">
    <span class="input-group-text" id="wd_2_prepend">$</span>
    <input type="text" class="form-control decimal" id="wd_2" value="50,000" required>
    <div class="invalid-feedback">Please input a Valid Withdrawal</div>
    </div>
  </div>
  </div>
</div>
</div>
<div class="col-md-3">
<div class="card border-primary mb-1">
  <div class="card-header">Annuity With PAR Rate</div>
  <div class="card-body text-primary">
  <div class="col-md-12">
    <label for="safe_bucket_par" class="form-label">Safe Bucket % - Par</label>
    <div class="input-group has-validation">
    <input type="text" class="form-control" id="safe_bucket_par" value="33" required>
    <span class="input-group-text">%</span>
    <div class="invalid-feedback">Please input a Valid Safe Bucket % - Par</div>
    </div>
  </div>   
  <div class="col-md-12">
    <label for="par_rate" class="form-label">Par Rate</label>
    <div class="input-group has-validation">
    <input type="text" class="form-control" id="par_rate" value="47" required>
    <span class="input-group-text">%</span>
    <div class="invalid-feedback">Please input a Valid Par Rate</div>
    </div>
  </div>
  <div class="col-md-12">
    <label for="wd_3" class="form-label">Withdrawal</label>
    <div class="input-group has-validation">
    <span class="input-group-text" id="wd_3_prepend">$</span>
    <input type="text" class="form-control decimal" id="wd_3" value="40,000" required>
    <div class="invalid-feedback">Please input a Valid Withdrawal</div>
    </div>
  </div>
  </div>
</div>
</div>

</form>
<script>


// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated');
       
      }, false)
    })
})()

</script>            
</div>
</div>
</div>           
<hr />            
    <div class="row">
    
    
    <div class="col-md-9">
        <div id="chart"></div> 
    </div>
    <div class="col-md-3">    
        <div id="chart2"></div>
    </div>
    </div>
    <div class="row">
    <div class="horizontal-scrollable"> 
    <div class="table-responsive">
    <hr />        
        <div id="tbl"></div>
    </div>
    </div>
    </div>

<hr />

<p class="small">
This calculator is for illustration purposes only and does not represent any specific contract or investment recommendation. 
It is general in scope and is not intended to explain in detail how any of these products work internally. 
The purpose of this illustration is to help give context and explain how fixed index annuities compare to the S&P 500 index 
and how a peak performing annuity can provide a growth and retirement income. Fixed index annuities are designed to meet 
long-term needs for retirement income that guarantee principal and credited interest. They are subject to surrender charges and include a 
death benefit for beneficiaries. Like most financial products, fixed indexed annuities have limitations and availability varies by state. 
For full details, see product-specific illustrations, disclosures, riders and contract forms. 
Investing involves risk, including the potential loss of principal and past performance does not indicate future results. 
No investment strategy can guarantee a profit or protect against loss in periods of declining values. 
Any information or comments regarding guaranteed income streams or safety refer only to fixed insurance products. 
Annuities are not FDIC insured and they do not refer, in any way to securities or investment advisory products. 
Insurance and annuity product guarantees are backed by the financial strength and claims-paying ability of the issuing insurer.
</p>

<p class="small">
The S&P values for the years noted represents historical performance. The S&P 500 index does not allow direct investment. It is provided solely as a benchmark of overall market performance.
</p>

<p class="small">
Past performance of the S&P 500® is not an indication of future performance and cannot be guaranteed. Standard & Poor’s: “Standard & Poor’s®”, “S&P®”, and “S&P 500®” are registered trademarks of Standard & Poor’s Financial Services LLC (“S&P”). S&P 500® returns based on information obtained from https://www.macrotrends.net/2526/sp-500-historical-annual-returns. This information is believed to be reliable but the accuracy of the information cannot be guaranteed.
</p>
<hr />
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>-->
<script type="text/javascript">

    function addCommas(nStr) {
        nStr += '';
        var x = nStr.split('.');
        var x1 = x[0];
        var x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        formattedamount = x1 + x2
        return formattedamount;
        
    }
   
$(document).on('keyup, change, input','.decimal',function() {    
    var numcheck = $(this).val();
        numcheck = numcheck.replace(/[^0-9\.]/g, '');
        numcheck = addCommas(numcheck);
        $(this).val(numcheck);
});



$("#form_id").submit(function(){return false;});

/*

    $(document).on("keyup", "[name=propertyPrice], [name=depositAMT], [name=propertyInsurance], [name=bodyCorporateFees]", function () {
        var numcheck = $(this).val();
        numcheck = numcheck.replace(/[^0-9\.]/g, '');
        numcheck = addCommas(numcheck);
        $(this).val(numcheck);
    });
*/

var sp500 = [{'year':1970, 'rate':0.10},
            {'year':1971, 'rate':10.79},
            {'year':1972, 'rate':15.63},
            {'year':1973, 'rate':-17.37},
            {'year':1974, 'rate':-29.72},
            {'year':1975, 'rate':31.55},
            {'year':1976, 'rate':19.15},
            {'year':1977, 'rate':-11.50},
            {'year':1978, 'rate':1.06},
            {'year':1979, 'rate':12.31},
            {'year':1980, 'rate':25.77},
            {'year':1981, 'rate':-9.73},
            {'year':1982, 'rate':14.76},
            {'year':1983, 'rate':17.27},
            {'year':1984, 'rate':1.40},
            {'year':1985, 'rate':26.33},
            {'year':1986, 'rate':14.62},
            {'year':1987, 'rate':2.03},
            {'year':1988, 'rate':12.40},
            {'year':1989, 'rate':27.25},
            {'year':1990, 'rate':-6.56},
            {'year':1991, 'rate':26.31},
            {'year':1992, 'rate':4.46},
            {'year':1993, 'rate':7.06},
            {'year':1994, 'rate':-1.54},
            {'year':1995, 'rate':34.11},
            {'year':1996, 'rate':20.26},
            {'year':1997, 'rate':31.01},
            {'year':1998, 'rate':26.67},
            {'year':1999, 'rate':19.53},
            {'year':2000, 'rate':-10.14},
            {'year':2001, 'rate':-13.04},
            {'year':2002, 'rate':-23.37},
            {'year':2003, 'rate':26.38},
            {'year':2004, 'rate':8.99},
            {'year':2005, 'rate':3.00},
            {'year':2006, 'rate':13.62},
            {'year':2007, 'rate':3.53},
            {'year':2008, 'rate':-38.49},
            {'year':2009, 'rate':23.45},
            {'year':2010, 'rate':12.78},
            {'year':2011, 'rate':0.00},
            {'year':2012, 'rate':13.41},
            {'year':2013, 'rate':29.60},
            {'year':2014, 'rate':11.39},
            {'year':2015, 'rate':-0.73},
            {'year':2016, 'rate':9.54},
            {'year':2017, 'rate':19.42},
            {'year':2018, 'rate':-6.24},
            {'year':2019, 'rate':28.88},
            {'year':2020, 'rate':16.26},
            {'year':2021, 'rate':26.89}];


$('.form-control').on('keyup','',function(){calc();}) 
var sp500_1 = sp500.reverse();
    function calc(){
        var investment_amount = $('#investment_amount').val(); 
        //var income_need = parseFloat($('#income_need').val()); 
        var client_age = parseFloat($('#client_age').val());
        var growth_bucket = parseFloat($('#growth_bucket').val());
        var safe_bucket_cap = parseFloat($('#safe_bucket_cap').val());
        var cap_rate = parseFloat($('#cap_rate').val());
        var safe_bucket_par = parseFloat($('#safe_bucket_par').val());
        var par_rate = parseFloat($('#par_rate').val());
        var safe_bucket_cap_bonus = parseFloat($('#safe_bucket_cap_bonus').val());
        var cap_rate2 = parseFloat($('#cap_rate2').val());
        var bonus = parseFloat($('#bonus').val());
        var management_fee = parseFloat($('#management_fee').val());
        var wd_1 = $('#wd_1').val();
        var wd_2 = $('#wd_2').val();
        var wd_3 = $('#wd_3').val();
        
        
        investment_amount = parseFloat(investment_amount.replace(/[^0-9\.]/g, '')*1);
        
        wd_1 = parseFloat(wd_1.replace(/[^0-9\.]/g, '')*1);
        wd_2 = parseFloat(wd_2.replace(/[^0-9\.]/g, '')*1);
        wd_3 = parseFloat(wd_3.replace(/[^0-9\.]/g, '')*1);
        
        
        //var wd_4 = parseFloat($('#wd_4').val());

        
        
        var tb_row = '';
        
    tb_row += '<table class="table"><thead><tr>'+
            '<th scope="col" class="bg-secondary"></th>'+
            '<th scope="col" colspan="4" class="bg-danger">Historical S&P 500 Index</th>'+
            '<th scope="col" colspan="3" class="bg-success">FIA With Cap</th>'+
            '<th scope="col" colspan="3" class="bg-primary">FIA With Par</th>'+
            '</tr>'; //<th scope="col" colspan="3">Safe Bucket (Index Annuity Cap+Bonus)</th>
        
    tb_row += '<tr><th scope="col" class="bg-secondary">Age</th>'+
            '<th scope="col" class="bg-danger">Account Balance</th>'+
            '<th scope="col" class="bg-danger">Growth</th>'+
            '<th scope="col" class="bg-danger">Net Growth</th>'+
            '<th scope="col" class="bg-danger">W/D</th>'+
            '<th scope="col" class="bg-success">Account Balance</th>'+
            '<th scope="col" class="bg-success">Growth</th>'+
            '<th scope="col" class="bg-success">W/D</th>'+
            '<th scope="col" class="bg-primary">Account Balance</th>'+
            '<th scope="col" class="bg-primary">Growth</th>'+
            '<th scope="col" class="bg-primary">W/D</th>'+
    '</tr></thead><tbody>';
    
    /*
    '<th scope="col">Account Balance</th>'+
            '<th scope="col">Growth</th>'+
            '<th scope="col">W/D</th>'+
    */
 
    var account_balance1 = 0;
    var	growth1 = 0;
    var	net_growth1 = 0;
    var	wd1 = 0;
    var	account_balance2 = 0;
    var	growth2 = 0;
    var	wd2 = 0;
    var account_balance3 = 0;
    var	growth3 = 0;
    var	wd3 = 0;
    //var	account_balance4 = 0;
    //var	growth4 = 0;
    //var wd4 = 0;
    
    var total_growth1 = 0;
    var total_growth2 = 0;
    var total_growth3 = 0;
    //var total_growth4 = 0;
    
    var avg_ror1 = 0;
    var avg_ror2 = 0;
    var avg_ror3 = 0;
    //var avg_ror4 = 0;
    
    var total_acc_balance1 = 0;
    var total_acc_balance2 = 0;
    var total_acc_balance3 = 0;
    //var total_acc_balance4 = 0;
    
    var categories = [];
    var s_and_p_500  = [];
    var participation_rate_annuity = [];
    var cap_rate_annuity = [];
    
    //var point_start;  
     
 for(var i = 0; i<=20; i++){ 
    var age = client_age+i;
    categories[i] = sp500_1[22-i].year;
if(i==0){
    
    account_balance1 = investment_amount*growth_bucket/100;
    growth1 = parseFloat(sp500_1[22-i].rate);
    net_growth1 = growth1 - management_fee;
    wd1 = -wd_1;
    account_balance2 = investment_amount*safe_bucket_cap/100;
    growth2 = growth1> 0 ? Math.min(growth1, cap_rate) : 0;
    wd2 = -wd_2;
    account_balance3 = investment_amount*safe_bucket_par/100;
    growth3 = Math.max(0, growth1*par_rate/100);
    wd3 = -wd_3;
    
    s_and_p_500[i]=investment_amount;
    cap_rate_annuity[i]=investment_amount;
    participation_rate_annuity[i]=investment_amount;
    //account_balance4 = investment_amount*safe_bucket_cap_bonus*(1+bonus/100)/100;
    //growth4 = growth1> 0 ? Math.min(growth1, cap_rate2) : 0;
    //wd4 = -wd_4;
}else{
    account_balance1 = account_balance1*(1+net_growth1/100)+wd1; // investment_amount*growth_bucket/100;
    growth1 = parseFloat(sp500_1[22-i].rate);
    net_growth1 = growth1 - management_fee;
    wd1 = -wd_1;
    account_balance2 = account_balance2*(1+growth2/100)+wd2;// investment_amount*safe_bucket_cap/100;
    growth2 = growth1> 0 ? Math.min(growth1, cap_rate) : 0;
    wd2 = -wd_2;
    account_balance3 = account_balance3*(1+growth3/100)+wd3;// investment_amount*safe_bucket_par/100;
    growth3 = Math.max(0, growth1*par_rate/100);
    wd3 = -wd_3;
    
    s_and_p_500[i] = s_and_p_500[i-1]*(1+growth1/100);
    cap_rate_annuity[i] = cap_rate_annuity[i-1]*(1+growth2/100);
    participation_rate_annuity[i] = participation_rate_annuity[i-1]*(1+growth3/100);
    //account_balance4 = account_balance4*(1+growth4/100)+wd4*safe_bucket_cap_bonus; // investment_amount*safe_bucket_cap_bonus*(1+bonus/100)/100;
    //growth4 = growth1> 0 ? Math.min(growth1, cap_rate2) : 0;
    //wd4 = -wd_4;
}
//point_start = sp500_1[i].year;
   

    total_acc_balance1 = account_balance1*(1+net_growth1/100)+wd1; //total_acc_balance1 + account_balance1;
    //total_acc_balance2 = account_balance2*(1+growth2/100)+wd2; //total_acc_balance2 + account_balance2;
    //total_acc_balance3 = total_acc_balance3 + account_balance3;
    //total_acc_balance4 = total_acc_balance4 + account_balance4;

    total_growth1 = total_growth1 + net_growth1;
    total_growth2 = total_growth2 + growth2;
    total_growth3 = total_growth3 + growth3;
    //total_growth4 = total_growth4 + growth4;
    
    tb_row += '<tr>'+
                '<th scope="row" class="bg-secondary">'+age+'</th>'+
                '<td class="bg-danger">'+addCommas(account_balance1.toFixed())+'</td>'+
                '<td class="bg-danger">'+growth1.toFixed(2)+'</td>'+
                '<td class="bg-danger">'+net_growth1.toFixed(2)+'</td>'+
                '<td class="bg-danger">'+addCommas(wd1)+'</td>'+
                '<td class="bg-success">'+addCommas(account_balance2.toFixed())+'</td>'+
                '<td class="bg-success">'+growth2.toFixed(2)+'</td>'+
                '<td class="bg-success">'+addCommas(wd2)+'</td>'+
                '<td class="bg-primary">'+addCommas(account_balance3.toFixed())+'</td>'+
                '<td class="bg-primary">'+growth3.toFixed(2)+'</td>'+
                '<td class="bg-primary">'+addCommas(wd3)+'</td>'+
              '</tr>'; 
              
              /*
                              '<td>'+addCommas(account_balance4.toFixed())+'</td>'+
                '<td>'+growth4.toFixed(2)+'</td>'+
                '<td>'+addCommas(wd4)+'</td>'+
              */
}
    total_acc_balance2 = account_balance2*(1+growth2/100);
    total_acc_balance3 = account_balance3*(1+growth3/100);
    //total_acc_balance4 = account_balance4*(1+growth4/100);
    
    tb_row += '<tr>'+
                '<th scope="row" class="bg-secondary">Total</th>'+
                '<td class="bg-danger"><strong>'+addCommas(total_acc_balance1.toFixed())+'</strong></td>'+
                '<td class="bg-danger"></td>'+
                '<td class="bg-danger"></td>'+
                '<td class="bg-danger"></td>'+
                '<td class="bg-success"><strong>'+addCommas(total_acc_balance2.toFixed())+'</strong></td>'+
                '<td class="bg-success"></td>'+
                '<td class="bg-success"></td>'+
                '<td class="bg-primary"><strong>'+addCommas(total_acc_balance3.toFixed())+'</strong></td>'+
                '<td class="bg-primary"></td>'+
                '<td class="bg-primary"></td>'+
              '</tr>'; 

/*
                '<td>'+addCommas(total_acc_balance4.toFixed())+'</td>'+
                '<td></td>'+
                '<td></td>'+

*/              

    avg_ror1 = total_growth1/21;
    avg_ror2 = total_growth2/21;
    avg_ror3 = total_growth3/21;
    //avg_ror4 = total_growth4/21;
/*
    tb_row += '<tr>'+
                '<th class="bg-secondary"></th>'+
                '<td class="bg-danger">Avg ROR</td>'+
                '<td class="bg-danger">'+avg_ror1.toFixed(2)+'</td>'+
                '<td class="bg-danger"></td>'+
                '<td class="bg-danger"></td>'+
                '<td class="bg-success">Avg ROR</td>'+
                '<td class="bg-success">'+avg_ror2.toFixed(2)+'</td>'+
                '<td class="bg-success"></td>'+
                '<td class="bg-primary">Avg ROR</td>'+
                '<td class="bg-primary">'+avg_ror3.toFixed(2)+'</td>'+
                '<td class="bg-primary"></td>'+
              '</tr>'; 
*/
/*
                '<td>Avg ROR</td>'+
                '<td>'+avg_ror4.toFixed(2)+'</td>'+
                '<td></td>'+
*/


  tb_row += '</tbody></table>';  
    
    
    
    $('#tbl').html(tb_row);
    
Highcharts.chart('chart', {
    //colors: ['red', 'blue', 'green'],
    colors: ['#dc3545', '#0d6efd', '#198754'],
    title: {text: '', /*align: 'left'*/},
    subtitle: {text: '', /*align: 'left'*/},
    yAxis: {
        title: {text: ''}
    },
    xAxis: {
        //accessibility: {
            //rangeDescription: 'Range: 2010 to 2020'
        //}
        categories: categories
    }, 
    tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.2f}</b><br/>',
            //valueSuffix: ' cm',
            shared: true
        },
    //legend: {layout: 'vertical', align: 'right', verticalAlign: 'middle'},
    //plotOptions: {series: {label: {connectorAllowed: false}, pointStart: point_start}},
    credits: {enabled: false},
    series: [{name: 'S&P 500', data: s_and_p_500, lineWidth: 3}, 
             {name: 'Participation Rate Annuity', data: participation_rate_annuity, lineWidth: 3}, 
             {name: 'Cap Rate Annuity', data: cap_rate_annuity, lineWidth: 3}],

    responsive: {
        rules: [{
            condition: {maxWidth: 500},
            chartOptions: {legend: {layout: 'horizontal', align: 'center', verticalAlign: 'bottom'}}
        }]
    }

});

////////////////////////////////////////////////

Highcharts.chart('chart2', {
    colors: ['#dc3545',  '#198754', '#0d6efd'],
    chart: {type: 'column'},
    title: {text: '', align: 'left'},
    //subtitle: {text: '', align: 'left'},
    xAxis: {
        categories: ['S&P 500', 'FIA With Cap', 'FIA With Par'],
        title: {text: null},
        gridLineWidth: 1,
        lineWidth: 0,
    },
    yAxis: {
        min: 0,
        title: {text: 'AVG ROR'},
        labels: {overflow: 'justify'},
        gridLineWidth: 0,
    },
    tooltip: {
            pointFormat: '{series.name}: <b>{point.y:.2f}%</b><br/>',
            //valueSuffix: ' cm',
            shared: true
        },
    //tooltip: {valueSuffix: ' millions'},
    plotOptions: {
        bar: {
            //borderRadius: '50%',
            dataLabels: {enabled: true},
            //groupPadding: 0.1,
            dataLabels: {
                enabled: true,
                formatter: function () {
                    return Highcharts.numberFormat(this.y,2)+"%";
                }
            },
        },
        dataLabels: {
                enabled: true,
                formatter: function () {
                    return Highcharts.numberFormat(this.y,2);
                }
            },
    },

    legend:{ enabled:false },
   /* legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },*/
    credits: {enabled: false},
    series: [{name: 'Avg ROR', 'data': [avg_ror1, avg_ror2, avg_ror3], colorByPoint: true}]
});

}
    
 $(document).ready(function () {calc(); })   
</script>
    
</div>