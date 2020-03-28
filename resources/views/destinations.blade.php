@extends('layouts.app')
@section('title') {{__('Destinations')}}@endsection
@section('content')

    <main>
        <!-- bradcam_area  -->
        <div class="bradcam_area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bradcam_text text-center">
                            <h3>{{__('Destinations')}}</h3>
                            <p>Pixel perfect design with awesome contents</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ bradcam_area  -->
        
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
                            <div class="search_form" action="#">
                                <div class="input_field">
                                    <input v-model="where_form.free_input" type="text" placeholder="{{__('Where to go?')}}">
                                </div>
                                <div class="input_field">
                                    <input v-model="where_form.date" data-date-format="yyyy-mm" class="datepicker" data-provide="datepicker" type="text" placeholder="{{__('Date')}}">
                                </div>
                                <div class="input_field">
                                    <select class="travel_type" v-model="where_form.trip_type">
                                        <option value="All" data-display="{{__('Travel type')}}">{{__('Travel type')}}</option>
                                        <option v-for="category in categories" :value="category.id">
                                            @if (App::getLocale() == 'es')
                                                    @{{category.category_name_es}}
                                                @else
                                                    @{{category.category_name_en}}
                                            @endif
                                        </option>
                                    </select>
                                </div>
                                <div class="search_btn">
                                    <button class="boxed-btn4 where_form_btn" @click="WhereForm()" >{{__('Search')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- where_togo_area_end  -->
        
        
        <div class="popular_places_area">
            <div class="container">
                <div class="row">
                    {{-- <div class="col-lg-4">
                        <div class="filter_result_wrap">
                            <h3>{{__('Filter Result')}}</h3>
                            <div class="filter_bordered">
                                <div class="filter_inner">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="single_select">
                                                <select>
                                                    <option data-display="Country">Country</option>
                                                    <option value="1">Africa</option>
                                                    <option value="2">canada</option>
                                                    <option value="4">USA</option>
                                                  </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="single_select">
                                                <select>
                                                    <option data-display="{{__('Travel type')}}">{{__('Travel type')}}</option>
                                                    <option v-for="category in categories" :value="category.id">
                                                        @if (App::getLocale() == 'es')
                                                                @{{category.category_name_es}}
                                                            @else
                                                                @{{category.category_name_en}}
                                                        @endif
                                                    </option>
                                                  </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="range_slider_wrap">
                                                <span class="range">{{__('Prise range')}}</span>
                                                <div id="slider-range"></div>
                                                <p>
                                                    <input v-model="filter_form.range" type="text" id="amount"  style="border:0; color:#7A838B; font-weight:400;">
                                                </p>
                                            </div>
                                        </div>
                                    </div>
        
        
                                </div>
        
                                <div class="reset_btn">
                                    <button class="boxed-btn4" type="submit">{{__('Reset')}}</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-12">
                        <div class="row">
                            <div v-for="trip in trips" class="col-lg-4 col-md-4">
                                <div class="single_place">
                                    <div class="thumb">
                                        <img :src="homepath + '/tripsImages/' + trip.picture_path + '/' + trip.img_thumbnail" :alt="trip.img_thumbnail">
                                        <a href="#" class="prise">$@{{trip.adult_price}}</a>
                                    </div>
                                    <div class="place_info">
                                        <a :href="homepath + '/destinations/' + trip.id">
                                            <h3>
                                                @if(App::getlocale() == 'es')
                                                    @{{ trip.title_es }}
                                                @else
                                                    @{{ trip.title_en }}
                                                @endif
                                            </h3>
                                        </a>
                                        <p>
                                            <span class="text-lowercase" v-for="category in trip.categories">
                                                @if(App::getlocale() == 'es')
                                                    #@{{ category.category_name_es }}
                                                @else
                                                    #@{{ category.category_name_en }}
                                                @endif
                                            </span>
                                        </p>
                                        <div class="rating_days d-flex justify-content-end">
                                            {{-- <span class="d-flex justify-content-center align-items-center">
                                                 <i class="fa fa-star"></i> 
                                                 <i class="fa fa-star"></i> 
                                                 <i class="fa fa-star"></i> 
                                                 <i class="fa fa-star"></i> 
                                                 <i class="fa fa-star"></i>
                                                 <a href="#">(20 Review)</a>
                                            </span> --}}
                                            <div class="days">
                                                <i class="fa fa-clock-o"></i>
                                                <a href="#">@{{moment(trip.available_date, "YYYYMMDD").fromNow()}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row" v-show="trips.length != amount_trips">
                            <div class="col-lg-12">
                                <div class="more_place_btn text-center">
                                    <a @click="MoreDestinations()" class="boxed-btn4 more_places_btn" href="javascript:void(0)">{{__('More Places')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
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

        <!-- Modal -->
        <div class="modal fade" id="whereModal" tabindex="-1" role="dialog" aria-labelledby="whereModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content" style="border-radius:0px">
                <div class="modal-header row mx-0">
                        <div class="col-md-4">
                            <span><strong style="color:#FF4A52">{{__('Where')}}:</strong> @{{where_form.free_input}}</span>
                        </div>
                        <div class="col-md-3">
                            <span><strong style="color:#FF4A52">{{__('Date')}}:</strong> @{{where_form.date}}</span> 
                        </div>
                        <div class="col-md-4">
                            <span><strong style="color:#FF4A52">{{__('Type')}}:</strong> 
                                <span v-if="selected_category.length > 0">
                                    @if (App::getLocale() == 'es')
                                        @{{selected_category[0].category_name_es}}
                                    @else
                                        @{{selected_category[0].category_name_en}}
                                    @endif
                                </span>
                            </span>
                        </div>
                </div>
                <div class="modal-body">
                    <div class="recent_trip_area py-0">
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <span>{{__('Results')}}: (@{{where_results.length}})</span>
                                </div>
                            </div>
                            <div class="row" v-if="where_results.length <= 0">
                                <div class="col-12">
                                    <span><strong>{{__('NO RESULTS FOUND')}}</strong></span>
                                </div>
                            </div>
                            <div class="row">
                                <div v-if="where_results.length > 0" v-for="trip in where_results" class="col-md-12">
                                    <div class="single_trip row">
                                        <div class="col-4 col-lg-2">
                                            <div class="thumb">
                                                <img style="width:100%;" :src="homepath + '/tripsImages/' + trip.picture_path + '/' + trip.img_thumbnail" alt="">
                                            </div>
                                        </div>
                                        <div class="col-8 col-lg-10">
                                            <div class="info pt-0">
                                                <div class="date">
                                                    <span>@{{moment(trip.created_at).format('LL')}}</span>
                                                </div>
                                                <a :href="homepath + '/destinations/' + trip.id">
                                                    <span>
                                                        @if (App::getLocale() == 'es')
                                                            @{{trip.title_es}}
                                                        @else
                                                            @{{trip.title_en}}
                                                        @endif
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default px-4" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
            </div>
        </div>

    </main>

@endsection

@section('scripts')
<script>
    Vue.use(VeeValidate);
    
    var trips = {!! json_encode($trips) !!}
    var categories = {!! json_encode($categories) !!}
    var amount_trips = {!! json_encode($amount_trips) !!}
    var recent_trips = {!! json_encode($recent_trips) !!}
    

    let current_background = homepath + "/tripsImages/" + trips[0].picture_path + "/" + trips[0].img_thumbnail;
    $(".bradcam_area").css('background-image', 'url("' + current_background + '")');

    // $( function() {
    //     $( "#slider-range" ).slider({
    //         range: true,
    //         min: 0,
    //         max: 600,
    //         values: [ 75, 300 ],
    //         slide: function( event, ui ) {
    //             $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    //         }
    // });
    // $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
    //     " - $" + $( "#slider-range" ).slider( "values", 1 ) );
    // } );

    var main = new Vue({
        el : 'main',
        data : {
            trips : trips,
            categories : categories,
            recent_trips : recent_trips,
            email_account : null,
            where_form: {
                trip_type : 'All',
                date : null,
                free_input : null,
            },
            where_results : [],
            filter_form : {
                range : null,
            }
        },
        mounted: function(){
            $('.datepicker').datepicker({
                format: 'yyyy-mm',
                viewMode: "months", 
                minViewMode: "months",
                immediateUpdates : true
            });

            $('.travel_type').on('change', function(val){
                main.where_form.trip_type = val.target.value;
            });

            $('.datepicker').on('change', function(val){
                main.where_form.date = val.target.value;
            });
            $('#slider-range').on('change', function(){
                console.log($("#amount").val())
                main.filter_form.range = val.target.value;
            });
        },
        computed: {
            selected_category (){
                var _this = this;
                return this.categories.filter(function(category){
                    return category.id == _this.where_form.trip_type; 
                })
            }
        },
        methods: {
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
            WhereForm: function(){
                var _this = this;
                $(".where_form_btn").LoadingOverlay("show");
                axios.post(homepath + '/where_search', {form : this.where_form}).then(function(response){
                    if(response.data){
                        _this.where_results = response.data
                    }
                    $(".where_form_btn").LoadingOverlay("hide");
                    $('#whereModal').modal('show');
                }).catch(function(error){
                    $.toast({
                        heading: 'Error',
                        text: '{{__("Unsuccessful Search")}}',
                        showHideTransition: 'fade',
                        icon: 'error',
                        position : 'top-right'
                    });
                    $(".where_form_btn").LoadingOverlay("hide");
                    console.log(error);
                })
            },
            MoreDestinations: function(){
                var _this = this;
                $(".more_places_btn").LoadingOverlay("show");
                axios.post(homepath + '/destinations/more_destinations', {current_amount : this.trips.length}).then(function(response){
                    _this.trips = response.data;
                    $(".more_places_btn").LoadingOverlay("hide");
                }).catch(function(error){
                    $.toast({
                        heading: 'Error',
                        text: '{{__("Error loading more places")}}',
                        showHideTransition: 'fade',
                        icon: 'error',
                        position : 'top-right'
                    });
                    $(".where_form_btn").LoadingOverlay("hide");
                    console.log(error);
                })
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