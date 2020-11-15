$(function () {
    var dataTable1 = $('#datatable1').DataTable({
        responsive: {
            details: false
        }
    }
    );

    var dataTable = $('#datatable2').DataTable({
        responsive: {
            details: false
        }
    }
    );   



    $(document).on('sidebarChanged', function () {
        dataTable.columns.adjust();
        dataTable.responsive.recalc();
        dataTable.responsive.rebuild();

        dataTable1.columns.adjust();
        dataTable1.responsive.recalc();
        dataTable1.responsive.rebuild();
    });

});



 "<!-- Breadcrumbs -->\n<div class=\"breadcrumbs\">\n"+
 " <div class=\"container\">\n    <div class=\"row\">\n"+      
 "<div class=\"col-xs-12\">\n"+      
  "<ul>\n"+          
  "<li class=\"home\">\n<a title=\"Go to Home Page\" href=\"#\" routerLink=\"\">{{ 'Homepage.Home' | translate}}</a>\n <span>&raquo;</span>\n </li>\n"+
  "<li>\n<strong>{{ 'Homepage.SignUp' | translate}}</strong>\n </li>\n </ul>\n</div>\n </div>\n </div>\n</div>\n<!-- Breadcrumbs End -->\n\n"+
  "<!-- Main Container -->\n<section class=\"main-container col1-layout\">\n"+
  "<div class=\"main container\">\n"+
  "<div class=\"page-content\">\n"+
  "<div class=\"account-login\">\n"+
  "<div class=\"box-authentication\">\n"+
  "<form [formGroup]=\"signUpForm\">\n"+
  "<h4>{{ 'Homepage.SignUp' | translate}}</h4>\n"+
  "<p class=\"before-login-text\">{{ 'Homepage.Welcome' | translate}}</p>\n"+
  "<label for=\"phone_number\"> {{ 'Homepage.phoneNumber' | translate}}\n<span class=\"required\">*</span>\n</label>\n"+
  "<!-- <international-phone-number \n formControlName=\"phone_number\ placeholder=\"Enter phone number\" \n [maxlength]=\"20\" \n [defaultCountry]=\"'in'\"\n ></international-phone-number> -->\n"+
  "<div class=\"row arbic-row\">\n  <div class=\"col-md-4\" >\n"+
  "<select name=\"country_code\" class=\"form-control\" id=\"country_code\" formControlName=\"country_code\">\n"+
  "<option value=\"0\">  {{ 'Homepage.Country' | translate}}   </option>\n"+
  "<option *ngFor=\" let country of getInternationalCountryCode() \" [value]=\"country.mcode\"> {{ country.name\n }} : {{ country.mcode }} </option>\n"+
  "</select>\n</div>\n<div class=\"col-md-8\" >\n"+
  "<div [ngClass]=\"{'has-error': (signUpForm.controls.phone_number.errors && signUpForm.controls.phone_number.dirty), 'has-success': !signUpForm.controls.phone_number.errors}\"\n class=\"form-input-group\" class=\"form-group\">\n"+
  "<input type=\"text\" onkeypress=\"return event.charCode >= 48\" min=\"0\" formControlName=\"phone_number\"\nclass=\"form-control\" placeholder=\"{{'placeHolder.EnterMobileNumber' | translate }}\" value=\"\" required>\n <ul class=\"help-block\">\n\n"+
  "<li *ngIf=\"signUpForm.controls.phone_number.errors?.required && signUpForm.controls.phone_number.dirty\">\n"+
  "<p style=\"color: #a94442\">{{ 'Homepage.Required' | translate  }}</p>\n</li>\n"+
  "<li *ngIf=\"signUpForm.controls.phone_number.errors?.validatephone && signUpForm.controls.phone_number.dirty\">\n"+
  "<p style=\"color: #a94442\"> {{ 'Homepage.ValidMobile' | translate  }}</p>\n</li>\n</ul>\n</div>\n </div>\n</div>\n\n"+
  "<!-- <input \nclass=\"form-control\" \n type=\"text\" \nid=\"country_code\" \nformControlName=\"country_code\" placeholder=\"Country Code\"\nwidth=\"30%\"\n> -->\n"+
  "<!-- <input id=\"phone_number\" type=\"text\" class=\"form-control\" formControlName=\"phone_number\" placeholder=\"Phone Number\"\nwidth=\"70%\"> -->\n \n"+

  "<!-- <label for=\"refer_by_code\">Referal Code\n </label>\n<input id=\"refer_by_code\" type=\"text\" class=\"form-control\" formControlName=\"refer_by_code\"> -->\n\n"+
  "<!-- <label class=\"inline\" for=\"rememberme\">\n<input type=\"checkbox\" value=\"forever\" id=\"rememberme\" formControlName=\"rememberme\" > Remember me\n</label> -->\n<br> \n"+
  "<button class=\"button btn-signup\" *ngIf=\"!socialLoginType\" type=\"submit\" (click)=\"onSubmit()\"\n[disabled]=\"!isValidForm()\">\n <a>\n<i class=\"fa fa-lock\"></i>&nbsp;\n<span>{{'Homepage.SignUp' | translate}} </span>\n</a>\n</button>\n<br>\n"+
  "<label class=\"inline\" for=\"termcondition\">\n"+
  "<input type=\"checkbox\" value=\"forever\" id=\"termcondition\" formControlName=\"termcondition\" checked><a href=\"javascript:void(0)\" routerLink = \"/about-us\">  {{'Homepage.Terms' | translate}}</a>\n</label>\n\n"+
  "<button class=\"button btn-signup\" *ngIf=\"socialLoginType\" type=\"submit\" (click)=\"onSubmit()\" [disabled]=\"isValidForm()\">\n<a>\n<i class=\"fa fa-lock\"></i>&nbsp;\n<span> {{'Homepage.CompleteProfile' | translate}}</span>\n</a>\n</button>\n<br>\n"+
  "<h5 class=\"text-center m-0\" *ngIf=\"!socialLoginType\">\n <b>OR</b>\n</h5>\n"+
  "<button class=\"button btn-facebook\" (click)=\"onFBSignIn()\" *ngIf=\"!socialLoginType\">\n"+
  "<a href=\"\">\n<i class=\"fa fa-facebook\"></i>&nbsp;\n <span>facebook</span>\n</a>\n</button>\n<a href=\"\" routerLink=\"/login\">\n"+
  "<button class=\"button btn-login\" style=\"width: 175px;margin-top: 5px;margin-left: 4px;padding: 10px;\">\n<i class=\"fa fa-lock\"></i>&nbsp;\n<span>{{'Homepage.LogIn' | translate}}</span>\n</button>\n</a>\n"+
  "<button class=\"button btn-twitter\" (click)=\"onTwitterSignup()\" *ngIf=\"!socialLoginType\">\n <a href=\"\">\n<i class=\"fa fa-twitter\"></i>&nbsp;\n<span>Twitter</span>\n</a>\n</button>\n <!-- <div class=\"col-md-12 text-right\" style=\"margin: 15px 0;\">\n"+
  "<p>Already Register Click On.. <a href=\"#\" routerLink=\"/login\" class=\"text-theme\"><b>Login</b></a></p>\n</div> -->\n</form>\n</div>\n"+
  "</div>\n    </div>\n  </div>\n</section>\n<!-- Main Container End -->"



"<div class=\"breadcrumbs\">\n"+
"<div class=\"container\">\n"+
"<div class=\"row\">\n"+
"<div class=\"col-xs-12\">\n"+
"<ul>\n<li class=\"home\">\n<a title=\"Go to Home Page\" href=\"#\" routerLink=\"\"> {{'Homepage.Home' | translate}}</a>\n<span>&raquo;</span> \n</li>\n"+
"<li>\n<strong> {{'Homepage.LogIn' | translate}}</strong>\n</li>\n</ul>\n</div>\n</div>\n</div>\n</div>\n<!-- Breadcrumbs End -->\n"+
"<!-- Main Container -->\n<section class=\"main-container col1-layout\">\n  <div class=\"main container\">\n"+
"<div class=\"page-content\">\n      <div class=\"account-login\">\n<div class=\"box-authentication\">\n"+
"<form [formGroup]=\"signInForm\">\n<h4> {{'Homepage.LogIn' | translate}} </h4>\n"+

"<p class=\"before-login-text\"> {{'Homepage.WelcomeSignIn' | translate}} </p>\n"+

"<label for=\"email\">{{'Homepage.EmailOrPass' | translate}} \n<span class=\"required\">*</span>\n</label>\n"+
"<input id=\"email\" type=\"text\" class=\"form-control\" formControlName=\"email\">\n"+
"<label for=\"password\"> {{'Homepage.yourPaswword' | translate}} \n<span class=\"required\">*</span>\n </label>\n"+
"<input id=\"password\" type=\"password\" class=\"form-control\" formControlName=\"password\">\n<p class=\"forgot-pass\">\n"+


"<label class=\"pull-right\"><a routerLink=\"/forget-password\"> {{'Homepage.ForgetPass' | translate}}</a></label>\n</p>\n"+
"<!-- <label class=\"inline\" for=\"rememberme\">\n<input type=\"checkbox\" value=\"forever\" id=\"rememberme\" name=\"rememberme\" formControlName=\"rememberme\"> Remember me\n</label> -->\n<br>\n"+
"<button class=\"button btn-login\" (click)=\"onSignIn()\">\n<a href=\"\">\n<i class=\"fa fa-lock\"></i>&nbsp;\n<span> {{'Homepage.LogIn' | translate}}</span>\n</a>\n</button>\n"+
"<br>\n<p class=\"form-row\"></p>\n<h5 class=\"text-center\">\n<b>{{'Homepage.OR' | translate }}</b>\n</h5>\n"+
"<button class=\"button btn-facebook\" (click)=\"onFBSignIn()\">\n<a href=\"\">\n<i class=\"fa fa-facebook\"></i>&nbsp;\n<span>facebook</span>\n</a>\n</button>\n"+
"<a href=\"\" routerLink=\"/signup\">\n<button class=\"button btn-login\" style=\"width: 175px;margin-top: 5px;margin-left: 4px;padding: 10px;\">\n<i class=\"fa fa-lock\"></i>&nbsp;\n"+
"<span>{{'Homepage.SignUp' | translate}}</span>\n</button>\n</a>\n"+
"<button class=\"button btn-twitter\" (click)=\"onTwitterSignIn()\">\n <a href=\"\">\n<i class=\"fa fa-twitter\"></i>&nbsp;\n"+
"<span>Twitter</span>\n</a>\n </button>\n"+
"<!-- <div class=\"col-md-12 text-right\" style=\"margin: 15px 0;\">\n<p>For New Registration Click Here.. <a href=\"#\" routerLink=\"/signup\" class=\"text-theme\"><b>Register</b></a></p>\n</div> -->\n</form>\n"+
"</div>\n</div>\n</div>\n</div>\n</section>"
