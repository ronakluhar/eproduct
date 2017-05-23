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
                        <div class="col-md-3 col-sm-3">
                            <a href="{{url('/')}}" class="logo_box"><img src="{{asset('images/front/logo-big.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
            </nav>
            <!--Swiper-->
        </header>
        <!-- Page Contents-->
        <main class="page-content section-34">
            <section class="breadcrumb-classic">
                <div class="container section-10">
                    <div class="collage-title">
                        <div class="right_section">
                            <img src="{{asset('images/front/clg-logo.jpg')}}" alt="">
                        </div>
                        <div class="left_section">Collage-name</div>
                    </div>
                </div>
            </section>
            <section class="button-group-collage-detail section-10 text-right">
                <div class="container">
                    <button class="btn btn-sm btn-deluge btn-icon btn-icon-left" onclick="location.href = '{{url('/')}}';"><span class="icon mdi mdi-arrow-left"></span>Back to result</button>
<!--                    <button class="btn btn-sm btn-primary btn-icon btn-icon-left"><span class="icon mdi mdi-printer"></span>Print</button>
                    <button class="btn btn-sm btn-success btn-icon btn-icon-left"><span class="icon mdi mdi-content-save"></span>Save</button>-->
                    <button class="btn btn-sm btn-danger btn-icon btn-icon-left" data-toggle="modal" data-target="#myModal"><span class="icon mdi mdi-heart"></span>My Favorites<span class="badge">42</span></button>
                </div>
            </section>
            <section class="section-34">
                <div class="container custom_accordion">
                    <div class="row">
                        <div class="col-md-8 col-sm-8">
                            <div class="table-responsive">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th class="text-info text-uppercase">Collage-Info</th>
                                            <th class="text-info">
                                                <div class="add-to-fav-checkbox">
                                                    <input type="checkbox" id="fav-id">
                                                    <label for="fav-id"><i class="fa fa-heart"></i> Add to Favorite</label>
                                                </div>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>General information:</td>
                                            <td>(256) 372-5000</td>
                                        </tr>
                                        <tr>
                                            <td>Website:</td>
                                            <td>www.aamu.edu/</td>
                                        </tr>
                                        <tr>
                                            <td>Type:</td>
                                            <td>4-year, Public</td>
                                        </tr>
                                        <tr>
                                            <td>Awards offered:</td>
                                            <td>Bachelor's degree</td>
                                        </tr>
                                        <tr>
                                            <td>Campus setting:</td>
                                            <td>Master's degree
                                                <br/>Post-master's certificate
                                                <br/>Doctor's degree - research/scholarship</td>
                                        </tr>
                                        <tr>
                                            <td>City:</td>
                                            <td>Midsize</td>
                                        </tr>
                                        <tr>
                                            <td>Campus housing:</td>
                                            <td>Yes</td>
                                        </tr>
                                        <tr>
                                            <td>Student population:</td>
                                            <td>5,628 (4,505 undergraduate)</td>
                                        </tr>
                                        <tr>
                                            <td>Student-to-faculty ratio:</td>
                                            <td>19 to 1</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4">
                            <div class="map_section">
                                <iframe src="https://www.maps.ie/create-google-map/map.php?width=100%&amp;height=600&amp;hl=en&amp;q=1%20Grafton%20Street%2C%20Dublin%2C%20Ireland+(My%20Business%20Name)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=A&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section-34">
                <div class="container custom_accordion">
                    <h1>Classic  Accordion</h1>
                    <hr class="divider bg-mantis">
                    <div class="panel-button text-right">
                        <button class="btn btn-xs btn-default expandall">Expand All</button>
                        <button class="btn btn-xs btn-default collapseall">Collapse All</button>
                    </div>
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" href="#collapse1" class="clearfix collapsed">Collapsible Group 1 <i class="mdi mdi-plus pull-right"></i><i class="mdi mdi-minus pull-right"></i></a></h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <table class="table table-condensed no-title">
                                        <tbody>
                                            <tr>
                                                <td>Admissions</td>
                                                <td><a href="#">www.aamu.edu/Admissions/Pages/default.aspx</a></td>
                                            </tr>
                                            <tr>
                                                <td>Apply Online</td>
                                                <td><a href="#">www.aamu.edu/admissions/undergraduateadmissions/pages/undergraduate-application-checklist.aspx</a></td>
                                            </tr>
                                            <tr>
                                                <td>Financial Aid</td>
                                                <td><a href="#">www.aamu.edu/Admissions/fincialaid/Pages/default.aspx</a></td>
                                            </tr>
                                            <tr>
                                                <td>Net Price Calculator</td>
                                                <td><a href="#">www2.aamu.edu/scripts/netpricecalc/npcalc.htm</a></td>
                                            </tr>
                                            <tr>
                                                <td>Disability Services</td>
                                                <td><a href="#">www.aamu.edu/administrativeoffices/VADS/Pages/Disability-Services.aspx</a></td>
                                            </tr>
                                            <tr>
                                                <td>Athletic Graduation Rates</td>
                                                <td><a href="#">www.aamu.edu/administrativeoffices/irpsp/institutionalresearchandplanning/pages/default.aspx</a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" href="#collapse2" class="clearfix collapsed">Collapsible Group 2<i class="mdi mdi-plus pull-right"></i><i class="mdi mdi-minus pull-right"></i></a></h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body text-left">
                                    <ul class="list list-unstyled">
                                        <li>Fully Responsive Design</li>
                                        <li>Social Integration</li>
                                        <li>250+ Predesigned Pages</li>
                                        <li>Regular Content Updates</li>
                                        <li>Lots of Child Themes</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" href="#collapse3" class="clearfix collapsed">Collapsible Group 3<i class="mdi mdi-plus pull-right"></i><i class="mdi mdi-minus pull-right"></i></a></h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body text-left">
                                    <ul class="list list-unstyled">
                                        <li>Fully Responsive Design</li>
                                        <li>Social Integration</li>
                                        <li>250+ Predesigned Pages</li>
                                        <li>Regular Content Updates</li>
                                        <li>Lots of Child Themes</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
                                    <a href="blog-classic-single-post.html">
                                        <div class="unit unit-horizontal unit-spacing-xs unit-middle">
                                            <div class="unit-body">
                                                <div class="post-meta"><span class="icon-xxs mdi mdi-arrow-right"></span>
                                                    <time class="text-dark" datetime="2016-01-01">05/14/2015</time>
                                                </div>
                                                <div class="post-title">
                                                    <h6 class="text-regular">Let’s Change the world</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </article>
                                <!-- Post Widget-->
                                <article class="post widget-post text-left text-picton-blue">
                                    <a href="blog-classic-single-post.html">
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
                                    <a href="blog-classic-single-post.html">
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
                                            <li><a href="about-us.html">About Us</a></li>
                                            <li><a href="contact-us.html">Contact Us</a></li>
                                            <li><a href="services.html">Services</a></li>
                                            <li><a href="pricing.html">Pricing</a></li>
                                            <li><a href="clients.html">Clients</a></li>
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
                                                    <button class="btn btn-sm btn-primary" type="submit">Subscribe</button></span>
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
                    Intense &copy; <span id="copyright-year"></span> . <a href="privacy.html">Privacy Policy</a>
                    <!-- {%FOOTER_LINK}-->
                </p>
            </div>
        </footer>
    </div>
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
                <p class="text-muted">Please select any two collage for compare!!</p>
                    <table class="table table-condensed no-title no-padd">
                        <tbody>
                            <tr>
                                <td style="width:20px;"><div class="form-group "><label class="checkbox-inline"><input class="checkbox-custom" name="input-group-radio" value="checkbox-1" type="checkbox"><span class="checkbox-custom-dummy"></span></label></div></td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td style="width:30px;"><button class="btn btn-xs btn-danger btn-icon only btn-icon-left" data-toggle="modal" data-target="#myModal"><span class="icon mdi mdi-delete"></span></button></td>
                            </tr>
                            <tr>
                                <td style="width:20px;"><div class="form-group "><label class="checkbox-inline"><input class="checkbox-custom" name="input-group-radio" value="checkbox-1" type="checkbox"><span class="checkbox-custom-dummy"></span></label></div></td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td style="width:30px;"><button class="btn btn-xs btn-danger btn-icon only btn-icon-left" data-toggle="modal" data-target="#myModal"><span class="icon mdi mdi-delete"></span></button></td>
                            </tr>
                            <tr>
                                <td style="width:20px;"><div class="form-group "><label class="checkbox-inline"><input class="checkbox-custom" name="input-group-radio" value="checkbox-1" type="checkbox"><span class="checkbox-custom-dummy"></span></label></div></td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td style="width:30px;"><button class="btn btn-xs btn-danger btn-icon only btn-icon-left" data-toggle="modal" data-target="#myModal"><span class="icon mdi mdi-delete"></span></button></td>
                            </tr>
                            <tr>
                                <td style="width:20px;"><div class="form-group "><label class="checkbox-inline"><input class="checkbox-custom" name="input-group-radio" value="checkbox-1" type="checkbox"><span class="checkbox-custom-dummy"></span></label></div></td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td style="width:30px;"><button class="btn btn-xs btn-danger btn-icon only btn-icon-left" data-toggle="modal" data-target="#myModal"><span class="icon mdi mdi-delete"></span></button></td>
                            </tr>
                            <tr>
                                <td style="width:20px;"><div class="form-group "><label class="checkbox-inline"><input class="checkbox-custom" name="input-group-radio" value="checkbox-1" type="checkbox"><span class="checkbox-custom-dummy"></span></label></div></td>
                                <td>Lorem ipsum dolor sit amet.</td>
                                <td style="width:30px;"><button class="btn btn-xs btn-danger btn-icon only btn-icon-left" data-toggle="modal" data-target="#myModal"><span class="icon mdi mdi-delete"></span></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-deluge btn-sm" data-dismiss="modal">Compare</button>
                    <button type="submit" class="btn btn-primary btn-sm" data-dismiss="modal">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('js/front/core.min.js')}}"></script>
    <script src="{{asset('js/front/script.js')}}"></script>
    <script>
    $('#ex1').slider({
        formatter: function(value) {
            return 'Current value: ' + value;
        }
    });
    $('.expandall').click(function(event) {
        $('.panel-collapse').collapse('show');
    });
    $('.collapseall').click(function(event) {
        $('.panel-collapse').collapse('hide');
    });
    </script>
</body>

</html>
