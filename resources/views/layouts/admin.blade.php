<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title') - Admin </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/img/favicon.png')}}">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="{{asset('/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/themify-icons.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('/css/nice-select.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('/css/gijgo.css')}}">
    <link rel="stylesheet" href="{{asset('/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('/css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset('/css/tippy.css')}}">
    <link rel="stylesheet" href="{{asset('/css/summernote.min.css')}}">
    <link rel="stylesheet" href="{{asset('/plugins/dist/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/jquery.toast.css')}}">
    <link rel="stylesheet" href="{{asset('/css/summernote.min.css')}}">
    <link rel="stylesheet" href="{{asset('/css/sweetalert2.css')}}">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
    
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap-select.css')}}">
    <link rel="stylesheet" href="{{asset('/css/bootstrap-datepicker.min.css')}}">

    <!-- <link rel="stylesheet" href="css/responsive.css"> -->
    @yield('styles')
</head>

<body>
    <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    <!-- header-start -->
    <header>
        <div class="header-area ">
            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid">
                    <div class="header_bottom_border">
                        <div class="row align-items-center">
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="{{route('index')}}">
                                        <img src="{{asset('/img/travel-guide-black-small.png')}}" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="main-menu  d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a class="active" href="{{route('admin')}}">{{__('Home')}}</a></li>
                                            <li><a href="javascript:void(0)">{{__('Trips')}} <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="/admin/trips/create">{{__('Add New')}}</a></li>
                                                    <li><a href="/admin/trips/all">{{__('All Trips')}}</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="javascript:void(0)">{{__('Blog')}} <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="/admin/blog/create">{{__('New Post')}}</a></li>
                                                    <li><a href="/admin/blog/all">{{__('All Posts')}}</a></li>
                                                    <li><a href="#">{{__('Dropdown')}} <i class="ti-angle-down"></i></a>
                                                        <ul class="submenu">
                                                            <li><a href="#">{{__('Option #1')}}</a></li>
                                                            <li><a href="#">{{__('Option #2')}}</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="javascript:void(0)">{{__('Dropdown')}} <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="#">{{__('Option #1')}}</a></li>
                                                    <li><a href="#">{{__('Option #2')}}</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="javascript:void(0)">{{__('Dropdown')}} <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="#">{{__('Option #1')}}</a></li>
                                                    <li><a href="#">{{__('Option #2')}}</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="javascript:void(0)">{{__('Others')}} <i class="ti-angle-down"></i></a>
                                                <ul class="submenu">
                                                    <li><a href="/admin/maintenance/categories">{{__('Categories')}}</a></li>
                                                    <li><a href="/admin/maintenance/subscribers">{{__('Subscribers')}}</a></li>
                                                    <li><a href="#">{{__('Option #2')}}</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-3 d-none d-md-block">
                                <div class="social_wrap d-flex align-items-center justify-content-end">
                                    <div class="social_links d-none d-xl-block">
                                        <ul>
                                        <li><a href="{{route('index')}}"> <i class="fa fa-home"></i> </a></li>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                                document.getElementById('logout-form-2').submit();">
                                                {{ __('Logout') }}
                                                </a>
                
                                                <form id="logout-form-2" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="seach_icon">
                                <a data-toggle="modal" data-target="#exampleModalCenter" href="#">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div> --}}
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <!-- header-end -->

    @yield('content')

    <footer class="footer">
        <div class="footer_top">
            <div class="container">
                <div class="row">
                    <div class="col-xl-4 col-md-6 col-lg-4 ">
                        <div class="footer_widget">
                            <div class="footer_logo">
                                <a href="{{route('index')}}">
                                    <img src="{{asset('/img/travel-guide-white-small.png')}}" alt="">
                                </a>
                            </div>
                            <p>5th flora, 700/D kings road, green <br> lane New York-1782 <br>
                                <a href="#">+10 367 826 2567</a> <br>
                                <a href="#">contact@carpenter.com</a><br>
                                @if(App::getlocale() == 'es')
                                    <a href="/changeLanguage/en" class="btn-link">{{__('English')}}</a> <i class="fa fa-globe"></i>
                                @else
                                    <a href="/changeLanguage/es" class="btn-link">{{__('Español')}}</a> <i class="fa fa-globe"></i>
                                @endif

                                {{-- <li><a href="#" id="linkLanguage"> <i id="languageOption" class="fa fa-globe"></i> </a></li> --}}

                                @if(Auth::check())
                                <br/>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                                @endif

                            </p>
                            <div class="socail_links">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <i class="ti-facebook"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-twitter-alt"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-pinterest"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-youtube-play"></i>
                                        </a>
                                    </li>
                                    
                                </ul>
                            </div>

                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-2">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                {{__('Company')}}
                            </h3>
                            <ul class="links">
                                <li><a href="#">{{__('Pricing')}}</a></li>
                                <li><a href="#">{{__('About')}}</a></li>
                                <li><a href="#"> {{__('Gallery')}}</a></li>
                                <li><a href="#"> {{__('Contact')}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                {{__('Popular Destination')}}
                            </h3>
                            <ul class="links double_links">
                                <li><a href="#">Indonesia</a></li>
                                <li><a href="#">America</a></li>
                                <li><a href="#">India</a></li>
                                <li><a href="#">Switzerland</a></li>
                                <li><a href="#">Italy</a></li>
                                <li><a href="#">Canada</a></li>
                                <li><a href="#">Franch</a></li>
                                <li><a href="#">England</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="footer_widget">
                            <h3 class="footer_title">
                                Instagram
                            </h3>
                            <div class="instagram_feed">
                                <div class="single_insta">
                                    <a href="#">
                                        <img src="{{asset('/img/instagram/1.png')}}" alt="">
                                    </a>
                                </div>
                                <div class="single_insta">
                                    <a href="#">
                                        <img src="{{asset('/img/instagram/2.png')}} " alt="">
                                    </a>
                                </div>
                                <div class="single_insta">
                                    <a href="#">
                                        <img src="{{asset('/img/instagram/3.png')}} " alt="">
                                    </a>
                                </div>
                                <div class="single_insta">
                                    <a href="#">
                                        <img src="{{asset('/img/instagram/4.png')}}" alt="">
                                    </a> 
                                </div>
                                <div class="single_insta">
                                    <a href="#">
                                        <img src="{{asset('/img/instagram/5.png')}} " alt="">
                                    </a>
                                </div>
                                <div class="single_insta">
                                    <a href="#">
                                        <img src="{{asset('/img/instagram/6.png')}} " alt="">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right_text">
            <div class="container">
                <div class="footer_border"></div>
                <div class="row">
                    <div class="col-xl-12">
                        <p class="copy_right text-center">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


  <!-- Modal -->
  <div class="modal fade custom_search_pop" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="serch_form">
            <input type="text" placeholder="Search" >
            <button type="submit">search</button>
        </div>
      </div>
    </div>
  </div>
    <!-- link that opens popup -->
<!--     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://static.codepen.io/assets/common/stopExecutionOnTimeout-de7e2ef6bfefd24b79a3f68b414b87b8db5b08439cac3f1012092b2290c719cd.js"></script>

    <script src=" https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"> </script> -->
    <!-- JS here -->
    <script src="{{asset('/js/vendor/modernizr-3.5.0.min.js')}}"></script>
    <script src="{{asset('/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('/js/popper.min.js')}}"></script>
    <script src="{{asset('/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('/js/isotope.pkgd.min.js')}}"></script>
    <script src="{{asset('/js/ajax-form.js')}}"></script>
    <script src="{{asset('/js/waypoints.min.js')}}"></script>
    <script src="{{asset('/js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('/js/imagesloaded.pkgd.min.js')}}"></script>
    <script src="{{asset('/js/scrollIt.js')}}"></script>
    <script src="{{asset('/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('/js/wow.min.js')}}"></script>
    {{-- <script src="{{asset('/js/nice-select.min.js')}}"></script> --}}
    <script src="{{asset('/js/jquery.slicknav.min.js')}}"></script>
    <script src="{{asset('/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('/js/plugins.js')}} "></script>
    <script src="{{asset('/js/gijgo.min.js')}}"></script>
    <script src="{{asset('/js/slick.min.js')}}"></script>
    <script src="{{asset('/js/tippy.js')}}"></script>
    <script src="{{asset('/js/summernote.min.js')}}"></script>
    <script src="{{asset('/plugins/dist/dropzone.js')}}"></script>
    
    <script src="{{asset('/js/vue.js')}}"></script>
    <script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('/js/moment.js')}}"></script>
    <script src="{{asset('/js/vee-validate.js')}}"></script>
    <script src="{{asset('/js/bootstrap-select.js')}}"></script>
    <script src="{{asset('/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('/js/axios.js')}}"></script>
    <script src="{{asset('/js/jquery.toast.js')}}"></script>
    <script src="{{asset('/js/sweetalert2@9.js')}}"></script>
    <script src="{{asset('/js/loadingoverlay.js')}}"></script>

    <!--contact js-->
    {{-- <script src="{{asset('/js/contact.js')}}"></script> --}}
    <script src="{{asset('/js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('/js/jquery.form.js')}}"></script>
    <script src="{{asset('/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('/js/mail-script.js')}}"></script>
    {{-- <script src="{{asset('/js/main.js')}}"></script> --}}
    <script>
        $('#datepicker').datepicker({
            iconsLibrary: 'fontawesome',
            icons: {
             rightIcon: '<span class="fa fa-caret-down"></span>'
         }
        });

        $.fn.selectpicker.Constructor.BootstrapVersion = '4';

        var homepath = "{{url('/')}}";
        var lang = "{{App::getlocale()}}";

        
    </script>
    @yield('scripts')
</body>

</html>