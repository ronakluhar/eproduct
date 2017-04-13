<div class="logmod__heading">
    <span class="logmod__heading-subtitle">{{trans('label.lblemailpassword')}} <strong>{{trans('label.lbllogin')}}</strong></span>
</div>
<div class="logmod__form">
    <form accept-charset="utf-8" class="simform" action="{{url('/login')}}" method="POST" id="login_form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="sminputs clearfix">
        <div class="input full">
            <label class="string optional" for="email">{{trans('label.lblemailorusername')}} *</label>
            <input class="string optional" name="email" id ="email" placeholder="{{trans('label.lblemailorusername')}}" type="text" size="50" value="{{old('email')}}" maxlength="100">
        <em class="invalid" id="email_username_invalid" style="display: none;">{{trans('label.lblemailorusername')}}</em>
        </div>
    </div>
    <div class="sminputs clearfix">
        <div class="input full">
            <label class="string optional" for="password">{{trans('label.lblpassword')}} *</label>
            <input class="string optional password_hide_show" maxlength="20" name="password" id="password" placeholder="{{trans('label.lblpassword')}}" type="password" size="50">
            <span class="hide-password">{{trans('label.lblshow')}}</span>
        </div>
    </div>
    <div class="simform__actions clearfix">
        <button class="sumbit" name="commit" type="sumbit" value="Log In"  id="login_submit">{{trans('label.lbllogin')}}</button>
        <span class="simform__actions-sidetext"><a class="special" role="link" href={{url('forgot-password')}}>{{trans('label.lblforgotpassword')}}<br>{{trans('label.lblclickhere')}}</a></span>
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
          <span>{{trans('label.lblsignwith')}} <strong>{{trans('label.lblfacebook')}}</strong></span>
      </div>
      </a>
      <a href="{{url('/google')}}" title="Signin with Google+" alt="Signin with Google+" class="connect googleplus clearfix">
      <div class="connect__icon">
          <i class="fa fa-google-plus"></i>
      </div>
      <div class="connect__context">
          <span>{{trans('label.lblsignwith')}} <strong>{{trans('label.lblgoogle')}}</strong></span>
      </div>
      </a>
  </div>
</div>-->