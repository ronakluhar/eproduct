<div class="logmod__heading">
    <span class="logmod__heading-subtitle">{{trans('label.lblyour_personal_detail')}} <strong>{{trans('label.lblto_create_account')}}</strong></span>
</div>
<div class="logmod__form">
    <form accept-charset="utf-8" class="simform" id="signup_form" enctype="multipart/form-data" method="POST" action="{{ url('/doSignup') }}">
    {{csrf_field()}}
    <div class="sminputs clearfix signup_filde">
        <div class="input full">
            <label class="string optional" for="first_name" >{{trans('label.lblfirstname')}} *</label>
            <input class="string optional alphaonly" name="first_name" id="first_name" placeholder="{{trans('label.lblfirstname')}}" type="text" value="{{old('first_name')}}" size="20" maxlength="20" />
        </div>
    </div>
    <div class="sminputs clearfix signup_filde">
        <div class="input full">
            <label class="string optional" for="last_name">{{trans('label.lbllastname')}} *</label>
            <input class="string optional alphaonly" name="last_name" id="last_name" placeholder="{{trans('label.lbllastname')}}" type="text" value="{{old('last_name')}}" size="20" maxlength="20"/>
        </div>
    </div>
    <div class="sminputs clearfix">
        <div class="input full">
            <label class="string optional" for="email">{{trans('label.lblemail')}} *</label>
            <input class="string optional" maxlength="100" name="email" id="email" placeholder="{{trans('label.lblemail')}}" type="email" size="100" value="{{old('email')}}" maxlength="100" />
        </div>
    </div>
    <div class="sminputs clearfix {{ $errors->has('username') ? ' has-error' : '' }}">
        <div class="input full">
            <label class="string optional" for="username">{{trans('label.lblusername')}} *</label>
            <input class="string optional alphaonly_username" name="username" id="username" placeholder="{{trans('label.lblusername')}}" type="text" size="20" value="{{old('username')}}" maxlength="20">
        </div>
    </div>
    <div class="sminputs clearfix">
        <span id="passwordDescription"></span>
        <span id="passwordStrength" ></span>
        <div class="input string optional">
            <label class="string optional" for="password">{{trans('label.lblpassword')}} *</label>
            <input class="string optional" maxlength="20" name="password" id="password" placeholder="{{trans('label.lblpassword')}}" type="password" size="50" onkeyup="passwordStrength(this.value);">
        </div>
    </div>
    <div class="sminputs clearfix">
        <div class="input string optional">
            <label class="string optional" for="phone">{{trans('label.usertblheadphone')}} *</label>
            <input class="string optional numeric" maxlength="20" name="phone" id="phone" placeholder="{{trans('label.usertblheadphone')}}" type="text" size="50"  maxlength="12">
        </div>
    </div>
    <!--<div class="sminputs clearfix">
        <div class="gender_view clearfix">
            <span class="gender-title">{{trans('label.gender')}} *</span>
            <div class="gender_type">
                <input type="radio" id="f-option" name="gender" value="1" checked='checked'>
                <label for="f-option">{{trans('label.lblmale')}}</label>
                <span id="gender_error_msg"></span>
                <div class="check"></div>
            </div>
            <div class="gender_type">
                <input type="radio" id="s-option" name="gender" value="2">
                <label for="s-option">{{trans('label.lblfemale')}}</label>
                <div class="check"><div class="inside"></div></div>
            </div>
        </div>
    </div>-->
    <div class="simform__actions clearfix">
        <button class="sumbit" name="commit" type="submit" id="signup_submit" value="Create Account">{{trans('label.lblcreateaccount')}}</button>
        <span class="simform__actions-sidetext">{{trans('label.lblcreateaccounttext')}} <a class="special" href="#" >{{trans('label.lbltearms')}} &amp; {{trans('label.lblprivacy')}}</a></span>
    </div>
    </form>
</div>
<!--<div class="logmod__alter">
    <div class="logmod__alter-container">
        <a href="{{url('/facebook')}}" title="Signin with Facebook" alt="Signin with Facebook" class="connect facebooklo clearfix">
            <div class="connect__icon">
                <i class="fa fa-facebook"></i>
            </div>
            <div class="connect__context">
                <span>{{trans('label.lblcreateaccountwith')}} <strong>{{trans('label.lblfacebook')}}</strong></span>
            </div>
        </a>
        <a href="{{url('/google')}}" title="Signin with Google+" alt="Signin with Google+" class="connect googleplus clearfix">
            <div class="connect__icon">
                <i class="fa fa-google-plus"></i>
            </div>
            <div class="connect__context">
                <span>{{trans('label.lblcreateaccountwith')}} <strong>{{trans('label.lblgoogle')}}</strong></span>
            </div>
        </a>
    </div>
</div>-->