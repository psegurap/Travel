@extends('layouts.app')
@section('title') {{__('About')}}@endsection
@section('content')
    <main>
        <!-- bradcam_area  -->
        <div class="bradcam_area bradcam_bg_3">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bradcam_text text-center">
                            <h3>{{__('About Us')}}</h3>
                            <p>Pixel perfect design with awesome contents</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ bradcam_area  -->
        
        <div class="about_story">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="story_heading">
                            <h3>{{__('Our Story')}}</h3>
                        </div>
                        <div class="row">
                            <div class="col-lg-11 offset-lg-1">
                                <div class="story_info">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <p>Consulting represents success at realizing the company is going in the wrong direction. The only time the company fails is when it is not possible to do a turnaround anymore. We help companies pivot into more profitable directions where they can expand and grow. It is inevitable that companies will end up making a few mistakes; we help them correct these mistakes.</p>
                                    <p>Consulting represents success at realizing the company is going in the wrong direction. The only time the company fails is when it is not possible to do a turnaround anymore. We help companies pivot into more profitable directions where they can expand and grow. It is inevitable that companies will end up making a few mistakes; we help them correct these mistakes.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="story_thumb">
                                    <div class="row">
                                        <div v-for="trip in some_trips" class="col-md-6">
                                            <div class="thumb">
                                                <img style="width:100%;" class="rounded" :src="homepath + '/tripsImages/' + trip.picture_path + '/' + trip.img_thumbnail" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="counter_wrap">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4">
                                            <div class="single_counter text-center">
                                                <h3 class="counter">@{{reservations_metrics.reservation_count}}</h3>
                                                <p>{{__('Reservations Arranged')}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="single_counter text-center">
                                                <h3 class="counter">@{{reservations_metrics.completed_trips}}</h3>
                                                <p>{{__('Completed Trips')}}</p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-4">
                                            <div class="single_counter text-center">
                                                <h3 class="counter">@{{reservations_metrics.clients_count}}</h3>
                                                <p>{{__('Happy Clients')}}</p>
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
        
        <div class="video_area video_bg overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="video_wrap text-center">
                            <h3>{{__('Enjoy Video')}}</h3>
                            <div class="video_icon">
                                <a class="popup-video video_play_button" href="https://www.youtube.com/watch?v=F-uPHbfznlM">
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
                            <div v-for="feedback in feedbacks" class="single_carousel">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <div class="single_testmonial text-center">
                                            <div class="author_thumb">
                                                <img v-if="feedback.img_thumbnail != '---'" style="width:100%; border-radius: 20px;" :src="homepath + '/QuickFeedbackUsers/' + feedback.img_thumbnail" alt="">
                                                <img v-else style="width:100%; border-radius: 100%;" :src="homepath + '/img/feedback_picture.jpg'" alt="">
                                            </div>
                                            <p>"@{{feedback.visitor_feedback}}"</p>
                                            <div class="testmonial_author">
                                                <h3>- @{{feedback.visitor_name}}</h3>
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
                    <div v-for="trip in recent_trips" class="col-lg-4 col-md-6">
                        <div class="single_trip">
                            <div class="thumb">
                                <img style="width:100%" :src="homepath + '/tripsImages/' + trip.picture_path + '/' + trip.img_thumbnail" alt="">
                            </div>
                            <div class="info">
                                <div class="date">
                                    <span>@{{moment(trip.available_date).format('LL')}}</span>
                                </div>
                                <a :href="homepath + '/destinations/' + trip.id">
                                    <h3>
                                        @if(App::getLocale() == 'es')
                                            @{{trip.title_es}}
                                        @else
                                            @{{trip.title_en}}
                                        @endif
                                    </h3>
                                </a>
                                <p class="font-italic mt-1">
                                    <span class="mr-1 text-capitalize" v-for="category in trip.categories">
                                        @if(App::getLocale() == 'es')
                                            <span><i class="fa fa-angle-right" aria-hidden="true"></i>@{{category.category_name_es}}</span>
                                        @else
                                            <span><i class="fa fa-angle-right" aria-hidden="true"></i>@{{category.category_name_en}}</span>
                                        @endif
                                    </span>
                                </p>
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
        var recent_trips = {!! json_encode($recent_trips) !!}
        var feedbacks = {!! json_encode($feedbacks) !!}
        var reservations_metrics = {!! json_encode($reservations_metrics) !!}
        
        
        var main = new Vue({
            el : 'main',
            data : {
                some_trips : some_trips,
                reservations_metrics: reservations_metrics,
            }
        });
    </script>
@endsection