<!DOCTYPE html>
<html lang="en" class="wide wow-animation smoothscroll scrollTo">
  <head>
    <!-- Site Title-->
    <title>Welcome to College Search Guide</title>
    <meta charset="utf-8">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="keywords" content="intense web design multipurpose template">
    <meta name="date" content="Dec 26">
    <link rel="icon" href="{{asset('images/front/favicon.png')}}" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,700,700italic">
    <link href="{{asset('css/front/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/front/custom.css')}}">
		<!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
		<![endif]-->
  </head>
  <style>
      @-webkit-keyframes pulse {  0% {    opacity: 1;  }  100% {    opacity: 0;  }}@keyframes pulse {  0% {    opacity: 1;  }  100% {    opacity: 0;  }}body {  margin: 0;}.ldr {  margin:20px auto;  width:42px;}.ldr-blk {  height: 15px;  width: 15px;  float:left;  margin:3px;  -webkit-animation: pulse 0.75s ease-in infinite alternate;          animation: pulse 0.75s ease-in infinite alternate;  background-color: #029eb7;}.an_delay {  -webkit-animation-delay: 0.75s;          animation-delay: 0.75s;}
  </style>
  <body>
    <!-- Page-->
    <div class="page text-center">
      <div class="page-loader page-loader-variant-1">
        <div><img class='img-responsive' style='margin-top: -20px;margin-left: -5px;' src="{{asset('images/front/logo-big.png')}}" alt=''/>
          <div class="offset-top-41 text-center">
            <div class="spinner"></div>
          </div>
        </div>
      </div>
      <!-- Page Head-->
      <header class="page-head slider-menu-position">
        <!-- - RD Navbar-->
        <!-- RD Navbar Transparent-->
        <div class="rd-navbar-wrap">
          <nav data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-static" class="rd-navbar container rd-navbar-floated rd-navbar-dark rd-navbar-dark-transparent" data-lg-auto-height="true" data-md-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-stick-up="true">
            <div class="rd-navbar-inner">
              <!-- RD Navbar Panel -->
              <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button data-rd-navbar-toggle=".rd-navbar, .rd-navbar-nav-wrap" class="rd-navbar-toggle"><span></span></button>
                <!-- RD Navbar Top Panel Toggle-->
                <button data-rd-navbar-toggle=".rd-navbar, .rd-navbar-right-buttons" class="rd-navbar-right-buttons-toggle"><span></span></button>
                <!--Navbar Brand-->
                <div class="rd-navbar-brand"><a href="index.html"><img height="60" src="{{asset('images/front/logo.png')}}" alt=''/></a></div>
              </div>
              <div class="rd-navbar-menu-wrap">
                <div class="rd-navbar-nav-wrap">
                  <div class="rd-navbar-mobile-scroll">
                    <!--Navbar Brand Mobile-->
                    <div class="rd-navbar-mobile-brand"><a href="index.html"><img height="60" src="{{asset('images/front/logo.png')}}" alt=''/></a></div>
                    <!-- RD Navbar Nav-->
                    <ul class="rd-navbar-nav">
                      <li class="active"><a href="index.html"><span>Home</span></a></li>
                      <li><a href="#"><span>Find Colleges</span></a></li>
                      <li><a href="#"><span>Contact</span></a></li>
                    </ul>
                  </div>
                </div>
              
              </div>
            </div>
          </nav>
        </div>
      </header>
        @yield('content')

        @yield('footer')

      <!-- Page Footer-->
      <!-- Default footer-->
      <footer class="section-relative section-top-66 section-bottom-34 page-footer bg-gray-darkest">
        <div class="shell">
          <div class="range range-sm-center text-md-left">
            <div class="cell-sm-8 cell-md-12">
              <div class="range range-xs-center">
                <div class="cell-xs-10 cell-md-5 cell-md-push-2">
                  <h6 class="text-uppercase text-spacing-60 font-default text-white">Newsletter</h6>
                  <div class="inset-lg-right-80">
                    <p class="text-muted">Keep up with our always upcoming  news and updates. Enter your e-mail and subscribe to our newsletter.</p>
                  </div>
                  <div class="offset-top-30">
                    <div class="inset-lg-right-93">
                            <form data-form-output="form-subscribe-footer" data-form-type="subscribe" method="post" action="bat/rd-mailform.php" class="rd-mailform">
                              <div class="form-group">
                                <div class="input-group input-group-sm"><span class="input-group-addon"><span class="input-group-icon mdi mdi-email"></span></span>
                                  <input placeholder="Type your E-Mail" type="email" name="email" data-constraints="@Required @Email" class="form-control"><span class="input-group-btn">
                                    <button type="submit" class="btn btn-sm btn-primary">Subscribe</button></span>
                                </div>
                              </div>
                              <div id="form-subscribe-footer" class="form-output"></div>
                            </form>
                    </div>
                  </div>
                </div>
                <div class="cell-xs-4 cell-md-2 offset-top-50 offset-md-top-0 cell-md-push-3 text-xs-left">
                  <h6 class="text-uppercase text-spacing-60 font-default text-white">College</h6>
                  <div class="reveal-block">
                    <div class="reveal-inline-block">
                      <ul class="list list-unstyled list-inline-primary">
                        <li class="text-primary"><a href="#">College 1</a></li>
                        <li class="text-primary"><a href="#">College 2</a></li>
                        <li class="text-primary"><a href="#">College 3</a></li>
                        <li class="text-primary"><a href="#">College 4</a></li>
                        <li class="text-primary"><a href="#">College 5</a></li>
                        <li class="text-primary"><a href="#">College 6</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="cell-xs-4 cell-md-2 offset-top-50 offset-md-top-0 cell-md-push-3 text-xs-left">
                  <h6 class="text-uppercase text-spacing-60 font-default text-white">Categories</h6>
                  <div class="reveal-block">
                    <div class="reveal-inline-block">
                      <ul class="list list-unstyled list-inline-primary">
                        <li class="text-primary"><a href="#">Science</a></li>
                        <li class="text-primary"><a href="#">Arts</a></li>
                        <li class="text-primary"><a href="#">Commerce</a></li>
                        <li class="text-primary"><a href="#">Sociology</a></li>
                        <li class="text-primary"><a href="#">Biology</a></li>
                        <li class="text-primary"><a href="#">Finance</a></li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="cell-md-3 offset-top-50 offset-md-top-0 cell-md-push-1">
                  <!-- Footer brand-->
                  <div class="footer-brand"><a href="index.html"><img src="{{asset('images/front/logo.png')}}" alt=''/></a></div>
                  <ul class="list-inline list-inline-sm reveal-inline-block offset-top-34 post-meta text-dark list-inline-primary">
                    <li><a href="#"><span class="icon icon-xxs fa-facebook"></span></a></li>
                    <li><a href="#"><span class="icon icon-xxs fa-twitter"></span></a></li>
                    <li><a href="#"><span class="icon icon-xxs fa-google-plus"></span></a></li>
                    <li><a href="#"><span class="icon icon-xxs fa-youtube-play"></span></a></li>
                    <li><a href="#"><span class="icon icon-xxs fa-instagram"></span></a></li>
                  </ul>
                  <p class="text-dark offset-top-50">College Search Guide &copy; <span id="copyright-year"></span></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </div>
    <!-- Global Mailform Output-->
    <div id="form-output-global" class="snackbars"></div>
    <!-- PhotoSwipe Gallery-->
    <div tabindex="-1" role="dialog" aria-hidden="true" class="pswp">
      <div class="pswp__bg"></div>
      <div class="pswp__scroll-wrap">
        <div class="pswp__container">
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
          <div class="pswp__item"></div>
        </div>
        <div class="pswp__ui pswp__ui--hidden">
          <div class="pswp__top-bar">
            <div class="pswp__counter"></div>
            <button title="Close (Esc)" class="pswp__button pswp__button--close"></button>
            <button title="Share" class="pswp__button pswp__button--share"></button>
            <button title="Toggle fullscreen" class="pswp__button pswp__button--fs"></button>
            <button title="Zoom in/out" class="pswp__button pswp__button--zoom"></button>
            <div class="pswp__preloader">
              <div class="pswp__preloader__icn">
                <div class="pswp__preloader__cut">
                  <div class="pswp__preloader__donut"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
            <div class="pswp__share-tooltip"></div>
          </div>
          <button title="Previous (arrow left)" class="pswp__button pswp__button--arrow--left"></button>
          <button title="Next (arrow right)" class="pswp__button pswp__button--arrow--right"></button>
          <div class="pswp__caption">
            <div class="pswp__caption__center"></div>
          </div>
        </div>
      </div>
    </div>
    <!-- Java script-->
    <script src="{{asset('js/front/core.min.js')}}"></script>
    <script src="{{asset('js/front/script.js')}}"></script>
  </body>
</html>        