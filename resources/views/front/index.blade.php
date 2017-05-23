<!DOCTYPE html>
<html class="wide wow-animation smoothscroll scrollTo" lang="en">
    <head>
        <!-- Site Title-->
        <title>Intense - multi-page template by TemplateMonster</title>
        <meta charset="utf-8">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="keywords" content="intense web design multipurpose template html">
        <meta name="date" content="Dec 26">
        <link rel="icon" href="{{asset('images/front/favicon.png')}}" type="image/x-icon">
        <!-- Stylesheets-->
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Montserrat:400,700%7CLato:300,300italic,400,700,900%7CYesteryear">
        <link rel="stylesheet" href="{{asset('css/front/style.css')}}">
        <link rel="stylesheet" href="{{asset('css/front/custom.css')}}">
        <!--[if lt IE 10]>
        <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
        <script src="js/html5shiv.min.js"></script>
        <![endif]-->
        <style>
            .loader{display:block;padding:50px 0;width:100%;}@-webkit-keyframes pulse{0%{opacity:1}100%{opacity:0}}@keyframes pulse{0%{opacity:1}100%{opacity:0}}body{margin:0}.ldr{margin:20px auto;width:56px}.ldr-blk{height:20px;width:20px;float:left;margin:4px !important;-webkit-animation:pulse .75s ease-in infinite alternate;animation:pulse .75s ease-in infinite alternate;background-color:#029eb7}.an_delay{-webkit-animation-delay:.75s;animation-delay:.75s}
        </style>
    <script>
        var at_page = parseInt("<?= $at_page; ?>");
        var no_of_result = parseInt("<?= $no_of_result; ?>");
        var no_of_pages = parseInt("<?= $no_of_pages; ?>");
        var displayStart = parseInt("<?= $start_from; ?>");
        var displayLength = parseInt("<?= $record_per_page; ?>");
    </script>
    </head>
    <body>
        <!-- Page-->
        <div class="page text-center">
            <!-- Page Head-->
            <header class="page-head">
                <!-- RD Navbar Transparent-->
                <nav class="rd-navbar-default rd-navbar-dark cst_navigation">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-sm-3"><a href="{{url('/')}}" class="logo_box"><img src="{{asset('images/front/logo-big.png')}}" alt=""></a></div>
                        </div>
                    </div>
                </nav>
                <!--Swiper-->
                <div class="rd-parallax rd-parallax-swiper">
                    <div class="rd-parallax-layer" data-speed="0.3" data-sm-speed="1" data-type="html">
                        <div class="swiper-container swiper-slider" data-loop="true" data-height="100vh" data-dragable="false" data-min-height="480px">
                            <div class="swiper-wrapper text-center">
                                <div class="swiper-slide" id="page-loader" data-slide-bg="{{asset('images/front/slide-1.jpeg')}}" data-preview-bg="{{asset('images/front/slide-1.jpeg')}}">
                                    <div class="swiper-caption swiper-parallax" data-speed="0.5" data-fade="true">
                                        <div class="swiper-slide-caption">
                                            <div class="shell">
                                                <div class="range range-lg-center">
                                                    <div class="cell-lg-12">
                                                        <h1><span class="big text-uppercase" data-caption-animate="fadeInUp" data-caption-delay="700">Welcome to Intense</span></h1>
                                                    </div>
                                                    <div class="cell-lg-10 offset-top-30">
                                                        <h4 class="hidden reveal-sm-block text-light" data-caption-animate="fadeInUp" data-caption-delay="900">
                                                            The smartest and most flexible bootstrap template by TemplateMonster you've ever seen.
                                                            Create exactly what you need with our powerful bootstrap toolkit.
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" data-slide-bg="{{asset('images/front/slide-2.jpeg')}}" data-preview-bg="{{asset('images/front/slide-2.jpeg')}}">
                                    <div class="swiper-caption swiper-parallax" data-speed="0.5" data-fade="true">
                                        <div class="swiper-slide-caption">
                                            <div class="shell">
                                                <div class="range range-lg-center">
                                                    <div class="cell-lg-12">
                                                        <h1><span class="big text-uppercase" data-caption-animate="fadeInUp" data-caption-delay="700">ULTRA sharp & RESPONSIVE</span></h1>
                                                    </div>
                                                    <div class="cell-lg-10 offset-top-30">
                                                        <h4 class="hidden reveal-sm-block text-light offset-bottom-0" data-caption-animate="fadeInUp" data-caption-delay="900">
                                                            Beautiful and clean designs are optimized for all screen sizes
                                                            and types. Taste a new meaning of Retina Ready.
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-slide" data-slide-bg="{{asset('images/front/slide-3.jpeg')}}" data-preview-bg="{{asset('images/front/slide-3.jpeg')}}">
                                    <div class="swiper-caption swiper-parallax" data-speed="0.5" data-fade="true">
                                        <div class="swiper-slide-caption">
                                            <div class="shell">
                                                <div class="range range-lg-center">
                                                    <div class="cell-lg-12">
                                                        <h1><span class="big text-uppercase" data-caption-animate="fadeInUp" data-caption-delay="700">ULTRA sharp & RESPONSIVE</span></h1>
                                                    </div>
                                                    <div class="cell-lg-10 offset-top-30">
                                                        <h4 class="hidden reveal-sm-block text-light offset-bottom-0" data-caption-animate="fadeInUp" data-caption-delay="900">
                                                            Beautiful and clean designs are optimized for all screen sizes
                                                            and types. Taste a new meaning of Retina Ready.
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-button swiper-button-prev swiper-parallax" data-speed="0.5">
                                <div class="preview">
                                    <div class="preview__img preview__img-3"></div>
                                    <div class="preview__img preview__img-2"></div>
                                    <div class="preview__img preview__img-1"></div>
                                </div>
                            </div>
                            <div class="swiper-button swiper-button-next swiper-parallax" data-speed="0.5">
                                <div class="preview">
                                    <div class="preview__img preview__img-1"></div>
                                    <div class="preview__img preview__img-2"></div>
                                    <div class="preview__img preview__img-3"></div>
                                </div>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Page Contents-->
            <main class="page-content section-98 section-sm-110">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3">
                            <!-- Category-->
                            <h6 class="text-uppercase text-spacing-60">SELECT FILTERS</h6>
                            <div class="text-subline"></div>
                            <ul class="list list-marked offset-top-30 filter-list">
                                <li data-toggle="modal" data-target="#myModal">School Name</li>
                                <li data-toggle="modal" data-target="#myModal">Location</li>
                                <li data-toggle="modal" data-target="#myModal">Net Cost</li>
                                <li data-toggle="modal" data-target="#myModal">Tuition</li>
                                <li data-toggle="modal" data-target="#myModal">Majors</li>
                                <li data-toggle="modal" data-target="#myModal">SAT Scores</li>
                                <li data-toggle="modal" data-target="#myModal">Campus Setting</li>
                                <li data-toggle="modal" data-target="#myModal">Athletics</li>
                                <li data-toggle="modal" data-target="#myModal">Acceptance Rate</li>
                                <li data-toggle="modal" data-target="#myModal">Diversity</li>
                                <li data-toggle="modal" data-target="#myModal">Library facts</li>
                                <li data-toggle="modal" data-target="#myModal">Ranking</li>
                            </ul>
                        </div>
                        <div class="col-md-9 collage_container">
                            <div class="row">
                                <div class="col-md-8 col-sm-6 result_count">
                                    <h5 class="text-primary total_result">{{$no_of_result}} Results</h5>
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <div class="grid_section_header">
                                        <div class="form-group">
                                            <select class="form-control select-filter" data-placeholder="Select an option" data-minimum-results-for-search="Infinity">
                                                <optgroup label="Category 1">
                                                    <option>Demo Item 1-1</option>
                                                    <option>Demo Item 1-2</option>
                                                    <option>Demo Item 1-2</option>
                                                </optgroup>
                                                <optgroup label="Category 2">
                                                    <option>Demo Item 2-1</option>
                                                    <option>Demo Item 2-2</option>
                                                    <option>Demo Item 2-3</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="hr bg-blue-gray">
                            <div class="box_body_container" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="loader">
                                <div class="ldr clearfix">
                                    <div class="ldr-blk"></div>
                                    <div class="ldr-blk an_delay"></div>
                                    <div class="ldr-blk an_delay"></div>
                                    <div class="ldr-blk"></div>
                                  </div>
                            </div>
                                    </div>
                                </div>
                                <div id="school_content"></div>
                                <!-- AJAX DATA -->
                            </div>
                            
                            <hr class="hr bg-gray">
                            <div class="row">
                                <div class="col-xs-2">
                                    <button type="button" class="leftPagination_previous btn btn-xs btn-primary">Previous</button>
                                </div>
                                <div class="col-xs-8">
                                    <label>Page</label>
                                    <div class="form-group" style="max-width: 40px;display: inline-block;vertical-align: middle;margin: 0 7px;">
                                        <input class="form-control input-sm" name="at_page" id="input-sizes-3" type="text" value="{{$at_page}}">
                                    </div>
                                    
                                    <label>of</label>
                                    <div class="pull-center" id="no_of_pages" style="display: inline">{{$no_of_pages}}</div>
                                </div>
                                <div class="col-xs-2">
                                    <button type="button" class="rightPagination_next btn btn-xs btn-primary">Next</button>
                                </div>
                            </div>
                            <hr class="hr bg-gray">
                            
                            <div class="google_ad_footer">
                                <div class="inner_ad"><img src="{{asset('images/front/nav-ad.png')}}" alt=""></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <!-- Page Footer-->
            <!-- Default footer-->
            <footer class="section-relative section-top-66 section-bottom-34 page-footer bg-gray-base context-dark">
                <div class="shell">
                    <div class="range range-sm-center text-lg-left">
                        <div class="cell-sm-8 cell-md-12">
                            <div class="range range-xs-center">
                                <div class="cell-xs-7 text-xs-left cell-md-4 cell-lg-3 cell-lg-push-4">
                                    <h6 class="text-uppercase text-spacing-60">Latest news</h6>
                                    <!-- Post Widget-->
                                    <article class="post widget-post text-left text-picton-blue">
                                        <a href="#"> <!-- blog-classic-single-post.html -->
                                            <div class="unit unit-horizontal unit-spacing-xs unit-middle">
                                                <div class="unit-body">
                                                    <div class="post-meta"><span class="icon-xxs mdi mdi-arrow-right"></span>
                                                        <time class="text-dark" datetime="2016-01-01">05/14/2015</time>
                                                    </div>
                                                    <div class="post-title">
                                                        <h6 class="text-regular">Let&#39;s Change the world</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                    <!-- Post Widget-->
                                    <article class="post widget-post text-left text-picton-blue">
                                        <a href="#"> <!-- blog-classic-single-post.html -->
                                            <div class="unit unit-horizontal unit-spacing-xs unit-middle">
                                                <div class="unit-body">
                                                    <div class="post-meta"><span class="icon-xxs mdi mdi-arrow-right"></span>
                                                        <time class="text-dark" datetime="2016-01-01">05/14/2015</time>
                                                    </div>
                                                    <div class="post-title">
                                                        <h6 class="text-regular">The meaning of Web Design</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                    <!-- Post Widget-->
                                    <article class="post widget-post text-left text-picton-blue">
                                        <a href="#"> <!-- blog-classic-single-post.html -->
                                            <div class="unit unit-horizontal unit-spacing-xs unit-middle">
                                                <div class="unit-body">
                                                    <div class="post-meta"><span class="icon-xxs mdi mdi-arrow-right"></span>
                                                        <time class="text-dark" datetime="2016-01-01">05/14/2015</time>
                                                    </div>
                                                    <div class="post-title">
                                                        <h6 class="text-regular">Get Started with TemplateMonster</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </article>
                                </div>
                                <div class="cell-xs-5 offset-top-41 offset-xs-top-0 text-xs-left cell-md-3 cell-lg-2 cell-lg-push-3">
                                    <h6 class="text-uppercase text-spacing-60">Useful Links</h6>
                                    <div class="reveal-block">
                                        <div class="reveal-inline-block">
                                            <ul class="list list-marked">
                                                <li><a href="#">About Us</a></li> <!-- about-us.html -->
                                                <li><a href="#">Contact Us</a></li> <!-- contact-us.html -->
                                                <li><a href="#">Services</a></li> <!-- services.html -->
                                                <li><a href="#">Pricing</a></li> <!-- pricing.html -->
                                                <li><a href="#">Clients</a></li> <!-- clients.html -->
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="cell-xs-12 offset-top-41 cell-md-5 offset-md-top-0 text-md-left cell-lg-4 cell-lg-push-2">
                                    <h6 class="text-uppercase text-spacing-60">Newsletter</h6>
                                    <p>Keep up with our always upcoming product features and technologies. Enter your e-mail and subscribe to our newsletter.</p>
                                    <div class="offset-top-30">
                                        <form class="rd-mailform" data-form-output="form-subscribe-footer" data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                                            <div class="form-group">
                                                <div class="input-group input-group-sm"><span class="input-group-addon"><span class="input-group-icon mdi mdi-email"></span></span>
                                                    <input class="form-control" placeholder="Type your E-Mail" type="email" name="email" data-constraints="@Required @Email"><span class="input-group-btn">
                                                        <button class="btn btn-sm btn-primary" type="button">Subscribe</button></span>
                                                </div>
                                            </div>
                                            <div class="form-output" id="form-subscribe-footer"></div>
                                        </form>
                                    </div>
                                </div>
                                <div class="cell-xs-12 offset-top-66 cell-lg-3 cell-lg-push-1 offset-lg-top-0">
                                    <!-- Footer brand-->
                                    <p class="text-darker offset-top-4">Feel the power of future</p>
                                    <ul class="list-inline">
                                        <li>
                                            <a class="icon fa fa-facebook icon-xxs icon-circle icon-darkest-filled" href="#"></a>
                                        </li>
                                        <li>
                                            <a class="icon fa fa-twitter icon-xxs icon-circle icon-darkest-filled" href="#"></a>
                                        </li>
                                        <li>
                                            <a class="icon fa fa-google-plus icon-xxs icon-circle icon-darkest-filled" href="#"></a>
                                        </li>
                                        <li>
                                            <a class="icon fa fa-linkedin icon-xxs icon-circle icon-darkest-filled" href="#"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shell offset-top-50">
                    <p class="small text-darker">
                        College Search Guide &copy; <span id="copyright-year"></span> . <a href="#">Privacy Policy</a> <!-- privacy.html -->
                        <!-- {%FOOTER_LINK}-->
                    </p>
                </div>
            </footer>
        </div>
        <!-- Global RD Mailform Output-->
        <div class="snackbars" id="form-output-global"></div>
        <!-- PhotoSwipe Gallery-->
        <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                        <button class="pswp__button pswp__button--share" title="Share"></button>
                        <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                        <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
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
                    <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
                    <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
                    <div class="pswp__caption">
                        <div class="pswp__caption__center"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- JavaScript-->
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title text-primary">Modal Header</h4>
                    </div>
                    <div class="modal-body">
                        <h6 class="text-uppercase text-spacing-60">Normal title</h6>
                        <div class="text-subline mb10"></div>
                        <div class="form-group">
                            <label class="form-label" for="input-labels-2">Placeholder</label>
                            <input class="form-control" id="input-labels-2" type="text">
                        </div>
                        <div class="form-group">
                            <label class="radio-inline">
                                <input name="input-group-radio" value="radio-1" type="radio" class="radio-custom"><span class="radio-custom-dummy"></span>Radio 1
                            </label>
                            <label class="radio-inline">
                                <input name="input-group-radio" value="radio-2" type="radio" class="radio-custom"><span class="radio-custom-dummy"></span>Radio 2
                            </label>
                        </div>
                        <div class="form-group ">
                            <label class="checkbox-inline">
                                <input class="checkbox-custom" name="input-group-radio" value="checkbox-1" type="checkbox"><span class="checkbox-custom-dummy"></span>Checkbox 1
                            </label>
                            <label class="checkbox-inline">
                                <input class="checkbox-custom" name="input-group-radio" value="checkbox-2" type="checkbox"><span class="checkbox-custom-dummy"></span>Checkbox 2
                            </label>
                        </div>
                        <div class="form-group">
                            <select class="form-control select-filter" data-placeholder="Select an option" data-minimum-results-for-search="Infinity">
                                <optgroup label="Category 1">
                                    <option>Demo Item 1-1</option>
                                    <option>Demo Item 1-2</option>
                                    <option>Demo Item 1-2</option>
                                </optgroup>
                                <optgroup label="Category 2">
                                    <option>Demo Item 2-1</option>
                                    <option>Demo Item 2-2</option>
                                    <option>Demo Item 2-3</option>
                                </optgroup>
                            </select>
                        </div>
                        <div class="form-group">
                            <input id="ex1" data-slider-id='ex1Slider' type="text" data-slider-min="0" data-slider-max="20" data-slider-step="1" data-slider-value="14"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm" data-dismiss="modal">Submit</button>
                    </div>
                </div>

            </div>
        </div>
        
        <!-- tempate of school list -->
        <script id="tplSchoolList" type="text/script" type="x-tmpl-mustache">
            @include ('front.partial._school_iist_content')
        </script>
        
        <script src="{{asset('js/front/core.min.js')}}"></script>
        <script src="{{asset('js/front/script.js')}}"></script>
        <script src="{{asset('js/front/mustache.js/mustache.min.js')}}" type="text/javascript"></script>
        <script>
            $('#ex1').slider({
                formatter: function (value) {
                    return 'Current value: ' + value;
                }
            });
            var getSchoolList = function(displayStart, displayLength) {
                $('#school_content').html('');
                $('.loader').show();
                $.ajax({
                    "url": "{{ url('school-front-list-ajax') }}",
                    "type": "post",
                    data: {
                        _token: "{{csrf_token()}}",
                        displayStart: displayStart,
                        displayLength: displayLength
                    },
                    success: function(response) {
                        
                        var result_text = (response.no_of_result > 1) ? 'Results' : 'Result';
                        $('.total_result').html(response.no_of_result + ' ' +result_text);
                        $('#no_of_pages').html(response.no_of_pages);
                        $('input[name="at_page"]').val(at_page);
                        var schoolListTpl = $('#tplSchoolList').html();
                            Mustache.parse(schoolListTpl);

                        var html = Mustache.render(schoolListTpl, { list: response.list });
                        $('#school_content').html(html);
                        $('.loader').hide();
                    }
                });
            };
            var delay = (function(){
              var timer = 0;
              return function(callback, ms){
                clearTimeout (timer);
                timer = setTimeout(callback, ms);
              };
            })();
            
            $(document).ready(function () {
                getSchoolList(displayStart, displayLength);
                // Previous button
                $('body').on('click', '.leftPagination_previous', function(e) {
                    at_page = ((at_page > 2) ? (at_page - 1) : 1);
                    displayStart = ((at_page - 1) * displayLength);
                    
                    getSchoolList(displayStart, displayLength);
                });
                // Next button
                $('body').on('click', '.rightPagination_next', function(e) {
                    at_page = ((at_page < no_of_pages) ? (at_page + 1) : no_of_pages);
                    displayStart = ((at_page - 1) * displayLength);

                    getSchoolList(displayStart, displayLength);
                });
                // Jump to no of page
                $(document).on('keyup', 'input[name="at_page"]', function() {
                    var page_no = parseInt($(this).val());
                    
                    delay(function() {
                        if(Number.isInteger(page_no) && page_no > 0) {
                            at_page = ((page_no > no_of_pages) ? no_of_pages : page_no);
                            displayStart = ((at_page - 1) * displayLength);
                        }
                        getSchoolList(displayStart, displayLength);
                    }, 700);
                });
                
            });            
        </script>
    </body>
</html>