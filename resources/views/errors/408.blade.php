@extends('layouts.master-basic')

@section('content')
<section class="banner">
    <img src="{{asset('images/front/error-banner.jpg')}}" class="img-full-width">
    <div class="mobile_ban_cont">
        <h1>{{trans('label.408')}}</h1>
        <h3>{{trans('label.408-detail')}}</h3>
    </div>
    <div class="banner-container">
        <div class="banner-content-table">
            <div class="banner-content-area">
                <h1>{{trans('label.408')}}</h1>
                <h3>{{trans('label.408-detail')}}</h3>
            </div>
        </div>
    </div>
</section>
<section class="newsletter_area">
    <div class="container">
        <div class="newsletter_content">
            <form class="form-inline">           
                <div class="form-group">
                    <label for="pwd">subscribe For special deals & updates</label>
                    <input type="email" class="form-control" placeholder='Email Address'>
                </div>           
                <button type="submit" class="btn">Subscribe</button>
            </form>
        </div>
    </div>
</section>
@endsection

