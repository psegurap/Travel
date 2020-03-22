@extends('layouts.app')
@section('title') {{__('Home')}}@endsection
@section('styles')

<style>
    .swal2-popup {
        font-size: 0.8rem !important;
    }

</style>
    
@endsection
@section('content')
    <main>
        <!-- slider_area_start -->
        <div class="slider_area">
            <div class="slider_active owl-carousel">
                <div v-for="(trip, index) in some_trips" :class="'slider' + index" class="single_slider d-flex align-items-center overlay">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-12 col-md-12">
                                <div class="slider_text text-center">
                                    <h3>
                                        @if (App::getLocale() == 'es')
                                            Sed praesentium
                                        @else
                                            Eum quia sed
                                        @endif
                                    </h3>
                                    <p>
                                        @if (App::getLocale() == 'es')
                                            Non dignissimos tempore debitis sed maxime laborum dolores ut quas.
                                        @else
                                            Deleniti alias reprehenderit non eum dignissimos.
                                        @endif
                                    </p>
                                    @if (App::getLocale() == 'es')
                                        <a href="#" class="boxed-btn3">Ver Más</a>
                                    @else
                                        <a href="#" class="boxed-btn3">Explorar Ahora</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        
        </div>
        <!-- slider_area_end -->
        
        <!-- where_togo_area_start  -->
        <div class="where_togo_area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3">
                        <div class="form_area">
                            <h3>{{__('Where you want to go?')}}</h3>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="search_wrap">
                            <form class="search_form" action="#">
                                <div class="input_field">
                                    <input type="text" placeholder="{{__('Where to go?')}}">
                                </div>
                                <div class="input_field">
                                    <input id="datepicker" placeholder="{{__('Date')}}">
                                </div>
                                <div class="input_field">
                                    <select>
                                        <option data-display="Travel type">Travel type</option>
                                        <option value="1">Some option</option>
                                        <option value="2">Another option</option>
                                    </select>
                                </div>
                                <div class="search_btn">
                                    <button class="boxed-btn4 " type="submit" >{{__('Search')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- where_togo_area_end  -->
        
        <!-- popular_destination_area_start  -->
        <div class="popular_destination_area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section_title text-center mb_70">
                            <h3>{{__('Popular Destination')}}</h3>
                            <p>Suffered alteration in some form, by injected humour or good day randomised booth anim 8-bit hella wolf moon beard words.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single_destination">
                            <div class="thumb">
                                <img src="img/destination/1.png" alt="">
                            </div>
                            <div class="content">
                                <p class="d-flex align-items-center">Italy <a href="travel_destination.html">  07 Places</a> </p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_destination">
                            <div class="thumb">
                                <img src="img/destination/2.png" alt="">
                            </div>
                            <div class="content">
                                <p class="d-flex align-items-center">Brazil <a href="travel_destination.html">  03 Places</a> </p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_destination">
                            <div class="thumb">
                                <img src="img/destination/3.png" alt="">
                            </div>
                            <div class="content">
                                <p class="d-flex align-items-center">America <a href="travel_destination.html">  10 Places</a> </p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_destination">
                            <div class="thumb">
                                <img src="img/destination/4.png" alt="">
                            </div>
                            <div class="content">
                                <p class="d-flex align-items-center">Nepal <a href="travel_destination.html">  02 Places</a> </p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_destination">
                            <div class="thumb">
                                <img src="img/destination/5.png" alt="">
                            </div>
                            <div class="content">
                                <p class="d-flex align-items-center">Maldives <a href="travel_destination.html">  02 Places</a> </p>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_destination">
                            <div class="thumb">
                                <img src="img/destination/6.png" alt="">
                            </div>
                            <div class="content">
                                <p class="d-flex align-items-center">Indonesia <a href="travel_destination.html">  05 Places</a> </p>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- popular_destination_area_end  -->
        
        <!-- newletter_area_start  -->
        <div class="newletter_area overlay">
            <div class="container">
                <div class="row justify-content-center align-items-center">
                    <div class="col-lg-10">
                        <div class="row align-items-center">
                            <div class="col-lg-5">
                                <div class="newsletter_text">
                                    <h4>{{__('Subscribe Our Newsletter')}}</h4>
                                    <p>{{__('Subscribe newsletter to get offers and about new places to discover.')}}</p>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="mail_form">
                                    <div class="row no-gutters">
                                        <div class="col-lg-9 col-md-8">
                                            <div class="newsletter_field">
                                                <input v-validate="'required|email'" autocomplete="off" v-model="email_account" name="email" type="email" placeholder="{{__('Your mail')}}" >
                                                <span class="text-warning" style="font-size: 12px;" v-show="errors.has('email')">* @{{ errors.first('email') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4">
                                            <div class="newsletter_btn">
                                                <button class="boxed-btn4" @click="validate(StoreSubscriber)" >{{__('Subscribe')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- newletter_area_end  -->
        
        <div class="popular_places_area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section_title text-center mb_70">
                            <h3>{{__('Popular Places')}}</h3>
                            <p>Suffered alteration in some form, by injected humour or good day randomised booth anim 8-bit hella wolf moon beard words.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single_place">
                            <div class="thumb">
                                <img src="img/place/1.png" alt="">
                                <a href="#" class="prise">$500</a>
                            </div>
                            <div class="place_info">
                                <a href="destination_details.html"><h3>California</h3></a>
                                <p>United State of America</p>
                                <div class="rating_days d-flex justify-content-between">
                                    <span class="d-flex justify-content-center align-items-center">
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i>
                                         <a href="#">(20 Review)</a>
                                    </span>
                                    <div class="days">
                                        <i class="fa fa-clock-o"></i>
                                        <a href="#">5 Days</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_place">
                            <div class="thumb">
                                <img src="img/place/2.png" alt="">
                                <a href="#" class="prise">$500</a>
                            </div>
                            <div class="place_info">
                                <a href="destination_details.html"><h3>Korola Megna</h3></a>
                                <p>United State of America</p>
                                <div class="rating_days d-flex justify-content-between">
                                    <span class="d-flex justify-content-center align-items-center">
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i>
                                         <a href="#">(20 Review)</a>
                                    </span>
                                    <div class="days">
                                        <i class="fa fa-clock-o"></i>
                                        <a href="#">5 Days</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_place">
                            <div class="thumb">
                                <img src="img/place/3.png" alt="">
                                <a href="#" class="prise">$500</a>
                            </div>
                            <div class="place_info">
                                <a href="destination_details.html"><h3>London</h3></a>
                                <p>United State of America</p>
                                <div class="rating_days d-flex justify-content-between">
                                    <span class="d-flex justify-content-center align-items-center">
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i>
                                         <a href="#">(20 Review)</a>
                                    </span>
                                    <div class="days">
                                        <i class="fa fa-clock-o"></i>
                                        <a href="#">5 Days</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_place">
                            <div class="thumb">
                                <img src="img/place/4.png" alt="">
                                <a href="#" class="prise">$500</a>
                            </div>
                            <div class="place_info">
                                <a href="destination_details.html"><h3>Miami Beach</h3></a>
                                <p>United State of America</p>
                                <div class="rating_days d-flex justify-content-between">
                                    <span class="d-flex justify-content-center align-items-center">
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i>
                                         <a href="#">(20 Review)</a>
                                    </span>
                                    <div class="days">
                                        <i class="fa fa-clock-o"></i>
                                        <a href="#">5 Days</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_place">
                            <div class="thumb">
                                <img src="img/place/5.png" alt="">
                                <a href="#" class="prise">$500</a>
                            </div>
                            <div class="place_info">
                                <a href="destination_details.html"><h3>California</h3></a>
                                <p>United State of America</p>
                                <div class="rating_days d-flex justify-content-between">
                                    <span class="d-flex justify-content-center align-items-center">
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i>
                                         <a href="#">(20 Review)</a>
                                    </span>
                                    <div class="days">
                                        <i class="fa fa-clock-o"></i>
                                        <a href="#">5 Days</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_place">
                            <div class="thumb">
                                <img src="img/place/6.png" alt="">
                                <a href="#" class="prise">$500</a>
                            </div>
                            <div class="place_info">
                                <a href="destination_details.html"><h3>Saintmartine Iceland</h3></a>
                                <p>United State of America</p>
                                <div class="rating_days d-flex justify-content-between">
                                    <span class="d-flex justify-content-center align-items-center">
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i> 
                                         <i class="fa fa-star"></i>
                                         <a href="#">(20 Review)</a>
                                    </span>
                                    <div class="days">
                                        <i class="fa fa-clock-o"></i>
                                        <a href="#">5 Days</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="more_place_btn text-center">
                            <a class="boxed-btn4" href="#">{{__('More Places')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="video_area video_bg overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="video_wrap text-center">
                            <h3>{{__('Enjoy Video')}}</h3>
                            <div class="video_icon">
                                <a class="popup-video video_play_button" href="https://www.youtube.com/watch?v=f59dDEk57i0">
                                    <i class="fa fa-play"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="travel_variation_area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single_travel text-center">
                            <div class="icon">
                                <img src="img/svg_icon/1.svg" alt="">
                            </div>
                            <h3>Comfortable Journey</h3>
                            <p>A wonderful serenity has taken to the possession of my entire soul.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_travel text-center">
                            <div class="icon">
                                <img src="img/svg_icon/2.svg" alt="">
                            </div>
                            <h3>Luxuries Hotel</h3>
                            <p>A wonderful serenity has taken to the possession of my entire soul.</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_travel text-center">
                            <div class="icon">
                                <img src="img/svg_icon/3.svg" alt="">
                            </div>
                            <h3>Travel Guide</h3>
                            <p>A wonderful serenity has taken to the possession of my entire soul.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- testimonial_area  -->
        <div class="testimonial_area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="testmonial_active owl-carousel">
                            <div class="single_carousel">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="single_testmonial text-center">
                                            <div class="author_thumb">
                                                <img src="img/testmonial/author.png" alt="">
                                            </div>
                                            <p>"Working in conjunction with humanitarian aid agencies, we have supported programmes to help alleviate human suffering.</p>
                                            <div class="testmonial_author">
                                                <h3>- Micky Mouse</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_carousel">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="single_testmonial text-center">
                                            <div class="author_thumb">
                                                <img src="img/testmonial/author.png" alt="">
                                            </div>
                                            <p>"Working in conjunction with humanitarian aid agencies, we have supported programmes to help alleviate human suffering.</p>
                                            <div class="testmonial_author">
                                                <h3>- Tom Mouse</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="single_carousel">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="single_testmonial text-center">
                                            <div class="author_thumb">
                                                <img src="img/testmonial/author.png" alt="">
                                            </div>
                                            <p>"Working in conjunction with humanitarian aid agencies, we have supported programmes to help alleviate human suffering.</p>
                                            <div class="testmonial_author">
                                                <h3>- Jerry Mouse</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /testimonial_area  -->
        
        
        <div class="recent_trip_area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="section_title text-center mb_70">
                            <h3>{{__('Recent Trips')}}</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single_trip">
                            <div class="thumb">
                                <img src="img/trip/1.png" alt="">
                            </div>
                            <div class="info">
                                <div class="date">
                                    <span>Oct 12, 2019</span>
                                </div>
                                <a href="#">
                                    <h3>Journeys Are Best Measured In
                                        New Friends</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_trip">
                            <div class="thumb">
                                <img src="img/trip/2.png" alt="">
                            </div>
                            <div class="info">
                                <div class="date">
                                    <span>Oct 12, 2019</span>
                                </div>
                                <a href="#">
                                    <h3>Journeys Are Best Measured In
                                        New Friends</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single_trip">
                            <div class="thumb">
                                <img src="img/trip/3.png" alt="">
                            </div>
                            <div class="info">
                                <div class="date">
                                    <span>Oct 12, 2019</span>
                                </div>
                                <a href="#">
                                    <h3>Journeys Are Best Measured In
                                        New Friends</h3>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        Vue.use(VeeValidate);
        var some_trips = {!! json_encode($some_trips) !!}
        // //------ IMAGES ---------//
        let bg0 = homepath + "/tripsImages/" + some_trips[0].picture_path + "/" + some_trips[0].img_thumbnail;
        let bg1 = homepath + "/tripsImages/" + some_trips[1].picture_path + "/" + some_trips[1].img_thumbnail;
        let bg2 = homepath + "/tripsImages/" + some_trips[2].picture_path + "/" + some_trips[2].img_thumbnail;

        var main = new Vue({
            el : 'main',
            data : {
                some_trips : some_trips,
                email_account : null,
            },
            mounted: function(){
                //------ Setting BG ------//
                $('.slider0').css('background-image', 'url("' + bg0 + '")');
                $('.slider1').css('background-image', 'url("' + bg1 + '")');
                $('.slider2').css('background-image', 'url("' + bg2 + '")');
            },
            methods : {
                StoreSubscriber: function(){
                    $(".mail_form").LoadingOverlay("show");
                    var _this = this;
                    axios.post(homepath + "/admin/maintenance/subscribers/new", {email : this.email_account, lang : lang}).then(function(response){
                        _this.email_account = ""
                        $(".mail_form").LoadingOverlay("hide");
                        Swal.fire({
                            icon: 'success',
                            title: "{{__('Your subscription was added')}}!",
                            showConfirmButton: false,
                            timer: 2000
                        }).then(function(){
                            _this.errors.clear();
                        })
                    }).catch(function(error){
                        console.log(error);
                    });
                },
                validate: function(callback){
                    var _this = this;
                    this.$validator.validateAll().then(function(result){
                        if(result){
                            callback();
                        }else{
                            $.toast({
                                heading: 'Error',
                                text: '{{__("You need to fix the errors")}}',
                                showHideTransition: 'fade',
                                icon: 'error',
                                position : 'top-right'
                            })
                        }
                    })
                }
            }
        });

    </script>
@endsection