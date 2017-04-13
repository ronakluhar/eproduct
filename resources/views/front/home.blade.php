@extends('layouts.master-basic')

@section('content')

<main class="page-content">
        <!-- Build Your Future-->
        <section>
          <!-- RD Parallax-->
          <div data-on="false" data-md-on="true" class="rd-parallax">
            <div data-speed="0.35" data-type="media" data-url="{{asset('images/front/background-01-1920x870.jpg')}}" style="background-size: 130%;" class="rd-parallax-layer"></div>
            <div data-speed="0" data-type="html" class="rd-parallax-layer">
              <div class="bg-overla y-gray-darkest">
                <div class="shell section-98 section-sm-254">
                  <div class="range range-xs-center">
                    <div class="cell-xs-12">
                      <div class="text-extra-big text-white text-bold">Education <br><font>is the key</font></div>
                      <h4 class="text-muted offset-top-20 offset-sm-top-41">Detailed data on <span class="text-primary text-bold">3957</span> colleges</h4>
                      <form class="offset-top-10 offset-sm-top-30">
                        <div class="group-sm group-top">
                          <div style="max-width: 352px;" class="group-item element-fullwidth">
                            <div class="form-group">
                              <label for="home-search-form-input" class="form-label rd-input-label">Enter College or University Name...</label>
                              <input id="home-search-form-input" type="text" name="s" autocomplete="off" class="form-control">
                            </div>
                          </div>
                          <div style="max-width: 230px;" class="group-item element-fullwidth">
                            <div class="form-group">
                              <select id="form-filter-location" name="location" data-minimum-results-for-search="Infinity" class="form-control">
                                <option value="1">Location</option>
                                <option value="2">New York</option>
                                <option value="3">Missouri</option>
                                <option value="4">Los Angeles</option>
                              </select>
                            </div>
                          </div>
                          <div class="reveal-block reveal-lg-inline-block">
                            <button type="button" style="max-width: 170px; min-width: 170px; min-height: 50px;" class="btn btn-primary element-fullwidth">Find College</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Offers-->
        <section class="section-top-50 section-bottom-34 section-lg-top-0 section-lg-bottom-0 context-dark bg-primary">
          <div class="range range-condensed range-xs-center">
            <div class="cell-xs-10 cell-sm-9 cell-md-10 cell-lg-12">
              <div data-items="1" data-xs-items="2" data-md-items="3" data-lg-items="6" data-dots="true" class="owl-carousel owl-carousel-default veil-lg-owl-dots veil-owl-nav">
                <div>
                  <!-- Box Offer Type 1--><a href="find-name.html">
                    <ul class="list list-unstyled list-vertical-right-line bg-primary">
                      <li>
                        <div class="section-lg-34"><span class="icon icon-lg mdi mdi-message-text-outline"></span>
                          <div class="h5 offset-top-14">Name</div>
                        </div>
                      </li>
                    </ul></a>
                </div>
                <div>
                  <!-- Box Offer Type 1--><a href="find-location.html">
                    <ul class="list list-unstyled list-vertical-right-line bg-primary">
                      <li>
                        <div class="section-lg-34"><span class="icon icon-lg mdi mdi-car"></span>
                          <div class="h5 offset-top-14">Location</div>
                        </div>
                      </li>
                    </ul></a>
                </div>
                <div>
                  <!-- Box Offer Type 1--><a href="find-type.html">
                    <ul class="list list-unstyled list-vertical-right-line bg-primary">
                      <li>
                        <div class="section-lg-34"><span class="icon icon-lg fa fa-building-o"></span>
                          <div class="h5 offset-top-14">Type</div>
                        </div>
                      </li>
                    </ul></a>
                </div>
                <div>
                  <!-- Box Offer Type 1--><a href="find-no-test.html">
                    <ul class="list list-unstyled list-vertical-right-line bg-primary">
                      <li>
                        <div class="section-lg-34"><span class="icon icon-lg mdi mdi-food"></span>
                          <div class="h5 offset-top-14">No Test</div>
                        </div>
                      </li>
                    </ul></a>
                </div>
                <div>
                  <!-- Box Offer Type 1--><a href="find-graduation.html">
                    <ul class="list list-unstyled list-vertical-right-line bg-primary">
                      <li>
                        <div class="section-lg-34"><span class="icon icon-lg mdi mdi-earth"></span>
                          <div class="h5 offset-top-14">Graduation</div>
                        </div>
                      </li>
                    </ul></a>
                </div>
                <div>
                  <!-- Box Offer Type 1--><a href="find-aid.html">
                    <ul class="list list-unstyled list-vertical-right-line bg-primary">
                      <li>
                        <div class="section-lg-34"><span class="icon icon-lg mdi mdi-chart-areaspline"></span>
                          <div class="h5 offset-top-14">AID</div>
                        </div>
                      </li>
                    </ul></a>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Latest Jobs-->
        <section class="section-98 section-sm-110">
          <div class="shell">
            <h1>Explore Colleges</h1>
            <hr class="divider divider-sm bg-darkers">
            <!-- Bootstrap Table-->
            <div class="table-responsive clearfix">
              <table class="table table-striped">
                <tr>
                  <th></th>
                  <th class="text-regular text-dark big">Date</th>
                  <th class="text-regular text-dark big">Company</th>
                  <th class="text-regular text-dark big">Job Vacancy</th>
                  <th class="text-regular text-dark big">City</th>
                  <th class="text-regular text-dark big">Salary</th>
                  <th class="text-regular text-dark big">Employment</th>
                </tr>
                <tr>
                  <th><span class="icon icon-xxs mdi mdi-fire text-danger"></span></th>
                  <td>11.05.2016, 4:16pm</td>
                  <td><a href="your-career-starts-here.html"><img src="{{asset('images/front/partner-01-45x40.png')}}" width="45" height="40" alt="" class="img-semi-transparent-inverse"></a></td>
                  <td class="text-bold text-primary p"><a href="project-managers.html">Developer</a></td>
                  <td>New York</td>
                  <td>$6000</td>
                  <td>Full time</td>
                </tr>
                <tr>
                  <th><span class="icon icon-xxs mdi mdi-fire text-danger"></span></th>
                  <td>06.02.2016, 2:54pm</td>
                  <td><a href="your-career-starts-here.html"><img src="{{asset('images/front/partner-02-50x40.png')}}" width="50" height="40" alt="" class="img-semi-transparent-inverse"></a></td>
                  <td class="text-bold text-primary p"><a href="project-managers.html">Project Manager</a></td>
                  <td>San Diego</td>
                  <td>$4000</td>
                  <td>Full time</td>
                </tr>
                <tr>
                  <th><span class="icon icon-xxs mdi mdi-airplane text-neon-carrot"></span></th>
                  <td>18.01.2016, 2:42pm</td>
                  <td><a href="your-career-starts-here.html"><img src="{{asset('images/front/partner-03-40x40.png')}}" width="40" height="40" alt="" class="img-semi-transparent-inverse"></a></td>
                  <td class="text-bold text-primary p"><a href="project-managers.html">Truck Driver</a></td>
                  <td>Dallas</td>
                  <td>$2000</td>
                  <td>Part time</td>
                </tr>
                <tr>
                  <th></th>
                  <td>13.04.2016, 2:54pm</td>
                  <td><a href="your-career-starts-here.html"><img src="{{asset('images/front/partner-04-76x40.png')}}" width="76" height="40" alt="" class="img-semi-transparent-inverse"></a></td>
                  <td class="text-bold text-primary p"><a href="project-managers.html">JS Programmer</a></td>
                  <td>Seattle</td>
                  <td>$7000</td>
                  <td>Full time</td>
                </tr>
                <tr>
                  <th></th>
                  <td>18.05.2016, 4:32pm</td>
                  <td><a href="your-career-starts-here.html"><img src="{{asset('images/front/partner-01-45x40.png')}}" width="45" height="40" alt="" class="img-semi-transparent-inverse"></a></td>
                  <td class="text-bold text-primary p"><a href="project-managers.html">Developer</a></td>
                  <td>San Francisco</td>
                  <td>$5000</td>
                  <td>Part time</td>
                </tr>
              </table>
            </div>
            <div class="range range-xs-center offset-top-66">
              <div class="cell-xs-5 cell-sm-3 cell-md-3 cell-lg-2"><a href="#" class="btn btn-primary reveal-xs-block">view all</a></div>
            </div>
          </div>
        </section>
        <!-- Why People Choose Us-->
        <section class="section-98 section-sm-110 bg-gray-light">
          <div class="shell">
            <h1>Why People Choose Us</h1>
            <hr class="divider divider-sm bg-darkers">
            <div class="range range-xs-center text-md-left offset-top-50 offset-lg-top-66">
              <div class="cell-sm-9 cell-md-4 cell-md-preffix-0">
                <!-- Icon Box Type 3-->
                <div class="unit unit-middle unit-spacing-xs unit-xs unit-xs-horizontal text-center text-xs-left">
                  <div class="unit-left"><span class="icon text-middle icon-sm text-primary mdi mdi-account-check"></span></div>
                  <div class="unit-body">
                    <h5 class="text-uppercase text-bold">Verified employers</h5>
                  </div>
                </div>
                <p class="offset-top-10 text-dark text-center text-xs-left">We pay a lot of attention to the employers we cooperate with and vacancies they submit to our job board.</p>
              </div>
              <div class="cell-sm-9 cell-md-4 cell-md-preffix-0 offset-top-50 offset-md-top-0">
                <!-- Icon Box Type 3-->
                <div class="unit unit-middle unit-spacing-xs unit-xs unit-xs-horizontal text-center text-xs-left">
                  <div class="unit-left"><span class="icon text-middle icon-sm text-primary mdi mdi-chart-bar"></span></div>
                  <div class="unit-body">
                    <h5 class="text-uppercase text-bold">Demanded vacancies</h5>
                  </div>
                </div>
                <p class="offset-top-10 text-dark text-center text-xs-left">Our catalog contains only the most demanded vacancies from American and international companies with offices in the US.</p>
              </div>
              <div class="cell-sm-9 cell-md-4 cell-md-preffix-0 offset-top-50 offset-md-top-0">
                <!-- Icon Box Type 3-->
                <div class="unit unit-middle unit-spacing-xs unit-xs unit-xs-horizontal text-center text-xs-left">
                  <div class="unit-left"><span class="icon text-middle icon-sm text-primary mdi mdi-newspaper"></span></div>
                  <div class="unit-body">
                    <h5 class="text-uppercase text-bold">Employment blog</h5>
                  </div>
                </div>
                <p class="offset-top-10 text-dark text-center text-xs-left">We have recently launched our employment blog where we review top rated vacancies and give useful advice to our readers.</p>
              </div>
            </div>
          </div>
        </section>
        <!-- Start Building Your Own Job Board Now-->
        <section class="context-dark">
          <!-- RD Parallax-->
          <div data-on="false" data-md-on="true" class="rd-parallax">
            <div data-speed="0.35" data-type="media" data-url="{{asset('images/front/background-02-1920x870.jpg')}}" class="rd-parallax-layer"></div>
            <div data-speed="0" data-type="html" class="rd-parallax-layer">
              <div class="bg-overlay-gr ay-darkest" style="padding: 10% 0;">
                <div class="shell section-98">
                  <div class="range range-xs-middle range-condensed">
                    <div class="cell-md-8 cell-lg-10 text-center text-md-left">
                      <h1 style="color: #fff;">Find a college that's right for you!</h1>
                    </div>
                    <div class="cell-md-4 cell-lg-2 offset-top-41 offset-md-top-0"><a href="#" style="max-width:195px;" class="btn btn-primary btn-block center-block">get started</a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <!-- Testimonials-->
        <section class="section-98 section-sm-110">
          <div class="shell">
            <h1>Testimonials</h1>
            <hr class="divider divider-sm bg-darkers">
            <div data-items="1" data-nav="true" data-dots="true" data-nav-class="[&quot;owl-prev mdi mdi-chevron-left&quot;, &quot;owl-next mdi mdi-chevron-right&quot;]" class="owl-carousel owl-carousel-default owl-carousel-arrows veil-md-owl-dots veil-owl-nav reveal-md-owl-nav inset-left-7p inset-right-7p">
              <div>
                <div class="range range-xs-center">
                  <div class="cell-lg-8">
                    <div class="reveal-inline-block">
                      <div class="unit unit-xs unit-xs-horizontal unit-spacing-sm text-xs-left">
                        <div class="unit-left"><img width="60" height="60" src="{{asset('images/front/user-brittany-freeman-60x60.jpg')}}" alt="Brittany Freeman" class="img-circle"/></div>
                        <div class="unit-body">
                          <div>
                            <div class="h5 text-primary">Elon Musk</div>
                          </div>
                          <div>
                            <div class="p text-dark">Stanford University</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="offset-top-41">
                      <!-- Quote Simple-->
                      <hr class="hr hr-gradient"/>
                      <div class="h4 text-center text-regular text-italic">
                        <q>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</q>
                      </div>
                      <hr class="hr hr-gradient"/>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="range range-xs-center">
                  <div class="cell-lg-8">
                    <div class="reveal-inline-block">
                      <div class="unit unit-xs unit-xs-horizontal unit-spacing-sm text-xs-left">
                        <div class="unit-left"><img width="60" height="60" src="{{asset('images/front/user-james-newman-60x60.jpg')}}" alt="James Newman" class="img-circle"/></div>
                        <div class="unit-body">
                          <div>
                            <div class="h5 text-primary">James Newman</div>
                          </div>
                          <div>
                            <div class="p text-dark">Ohio State University</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="offset-top-41">
                      <!-- Quote Simple-->
                      <hr class="hr hr-gradient"/>
                      <div class="h4 text-center text-regular text-italic">
                        <q>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</q>
                      </div>
                      <hr class="hr hr-gradient"/>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="range range-xs-center">
                  <div class="cell-lg-8">
                    <div class="reveal-inline-block">
                      <div class="unit unit-xs unit-xs-horizontal unit-spacing-sm text-xs-left">
                        <div class="unit-left"><img width="60" height="60" src="{{asset('images/front/user-jim-johnson-60x60.jpg')}}" alt="Jim Johnson" class="img-circle"/></div>
                        <div class="unit-body">
                          <div>
                            <div class="h5 text-primary">Jim Johnson</div>
                          </div>
                          <div>
                            <div class="p text-dark">Harvard University</div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="offset-top-41">
                      <!-- Quote Simple-->
                      <hr class="hr hr-gradient"/>
                      <div class="h4 text-center text-regular text-italic">
                        <q>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.</q>
                      </div>
                      <hr class="hr hr-gradient"/>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </main>

@endsection
