<style>
.btn-primary{
    background-color: rgb(128, 174, 79) !important;
    border-color: rgb(128, 174, 79);
}
</style>

<?php
use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
<div class="mt-5 offset-lg-1 col-lg-4 white-space" style="padding: 40px; border-radius: 10px; background-color: #f9f6f6; margin-top: 120px !important;">
<?php /*
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out the following fields to login:</p>
    */ 
    echo Html::img('/img/logo2.png', ['alt' => Yii::$app->name, 'width'=>'100%']);
    ?>
    <br />
    <br />
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true, 'placeholder'=>'Email'])->label(false) ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Password'])->label(false) ?>
            <?php // echo $form->field($model, 'rememberMe')->checkbox() ?>
            
            <?php /*
            <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
                <br />
                Need new verification email? <?= Html::a('Resend', ['site/resend-verification-email']) ?>
            </div>
            */ ?>
            <div class="form-group">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary w-100', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
</div>