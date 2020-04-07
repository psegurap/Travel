@extends('layouts.app')
@section('title') {{__('Book Now')}}@endsection

@section('styles')
    <style>
        .nice-select .list{
            border-radius: 0px;
            max-height: 300px;
            overflow-y: auto;
        }

        .modal-body {
            overflow-y: auto;
            max-height: calc(100vh - 200px);
        }

    </style>
@endsection

@section('content')
    <div class="detail_container">
        <!--================Blog Area =================-->
        <section class="blog_area single-post-area section-padding py-4">
           <div class="container">
                <div class="row mb-4">
                    <div class="col-12">
                        <h2 class="h2">{{__('Booking Details')}}:</h2>
                    </div>
                </div>
              <div class="row">
                 <div class="left-side col-lg-8 posts-list">
                    <div class="comment-form mt-0 pt-0 border-0">
                        <section class="form-contact contact_form">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="">{{__('Full Name')}}:</label>
                                        <input v-validate="'required'" v-model="book_details.user_name"  class="form-control valid rounded-0" name="name" type="text" placeholder="{{__('Enter your full name')}} *">
                                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('name')">* @{{ errors.first('name') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="">{{__('Email Address')}}:</label>
                                        <input v-validate="'required|email'" v-model="book_details.user_email" class="form-control valid rounded-0" name="email" type="email" placeholder="{{__('Email')}} *">
                                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('email')">* @{{ errors.first('email') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="">{{__('Address')}}:</label>
                                        <input v-validate="'required'" v-model="book_details.user_street" class="form-control valid rounded-0" name="address" type="text" placeholder="{{__('Enter your address')}} *">
                                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('address')">* @{{ errors.first('address') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="">{{__('City')}}:</label>
                                        <input v-validate="'required'" v-model="book_details.user_city" class="form-control valid rounded-0" name="city" type="text" placeholder="{{__('Enter your city')}} *">
                                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('city')">* @{{ errors.first('city') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="">{{__('Zip Code')}}:</label>
                                        <input v-validate="'required|numeric'" v-model="book_details.user_zipCode" class="form-control numeric_value valid rounded-0" name="zip code" type="text" placeholder="{{__('Zip Code')}} *">
                                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('zip code')">* @{{ errors.first('zip code') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-12 form-group">
                                    <div class="">
                                        <label class="font-weight-bold" for="">{{__('Country')}}:</label>
                                        <select v-validate="'required'" v-model="book_details.user_country" name="country" class="rounded-0 form-control country_select wide">
                                            <option value="" data-display="{{__('Select your country')}} *">{{__('Select your country')}}</option>
                                            <option v-for="country in countries" :value="country.id">
                                                @if (App::getLocale() == 'es')
                                                        @{{country.country_es}}
                                                    @else
                                                        @{{country.country_en}}
                                                @endif
                                            </option>
                                        </select>
                                    </div>
                                    <span class="text-danger" style="font-size: 12px;" v-show="errors.has('country')">* @{{ errors.first('country') }}</span>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="">{{__('Cell Phone')}}:</label>
                                        <input v-validate="'required'" v-model="book_details.user_mainPhone" class="form-control numeric_value valid rounded-0" name="cell phone" type="text" placeholder="{{__('Enter your cell phone')}} *">
                                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('cell phone')">* @{{ errors.first('cell phone') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="">{{__('Home Phone')}}:</label>
                                        <input class="form-control valid rounded-0 numeric_value" v-model="book_details.user_secondPhone" name="phone" type="text" placeholder="{{__('Enter your home phone')}}">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold" for="">{{__('Additional Notes')}}:</label>
                                        <textarea class="form-control w-100 rounded-0" v-model="book_details.user_notes" name="notes" cols="30" rows="5" placeholder="{{__('Enter your notes')}}"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group d-none d-md-block mt-3">
                                <button @click="validate(ConfirmBooking)" class="button button-contactForm btn-save-booking boxed-btn px-5">{{__('Save Booking')}}</button>
                            </div>
                        </section>
                    </div>
                 </div>
                 <div class="right-side col-lg-4">
                    <div class="blog_right_sidebar">
                        <aside class="border single_sidebar_widget post_category_widget">
                            <img style="width:100%" :src="homepath + '/tripsImages/' + trip.picture_path + '/' + trip.img_thumbnail" alt="">
                            <div class="info">
                                <p class="text-right my-1">
                                    <a style="color:#ff4a52!important" :href="homepath + '/destinations/' + trip.id" target="_blank">
                                        @if(App::getlocale() == 'es')
                                            @{{trip.title_es}}
                                        @else
                                            @{{trip.title_en}}
                                        @endif
                                    </a>
                                </p>
                                <p class="small text-justify" style="line-height: 20px;">
                                    @if(App::getlocale() == 'es')
                                        @{{trip.short_description_es}}
                                    @else
                                        @{{trip.short_description_en}}
                                    @endif
                                </p>
                            </div>
                        </aside>
                        <aside class="border single_sidebar_widget post_category_widget pt-3">
                            <section class="form-contact contact_form">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <p class="mt-3">
                                                <span>
                                                    <i class="fa fa-check-circle-o text-success" aria-hidden="true"></i> <span class="d-none d-sm-inline-block">{{__('Available Date')}}:</span> 
                                                </span> <span style="color:#FF4A52;" class="font-weight-bold">@{{moment(trip.available_date).format('YYYY/MM/DD')}}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="">{{__('Adults')}}:</label>
                                            <input v-validate="'min_value:0'" v-model="book_details.adults_amount" class="form-control numeric_value valid rounded-0" name="adults" type="number" placeholder="{{__('0')}}">
                                            <span class="text-danger" style="font-size: 12px;" v-show="errors.has('adults')">* @{{ errors.first('adults') }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <span class="font-weight-bold">US$ @{{totals.adults_total}}</span>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label class="font-weight-bold" for="">{{__('Kids')}}(2-8):</label>
                                            <input v-validate="'min_value:0'"  v-model="book_details.kids_amount" class="form-control numeric_value valid rounded-0" name="kids" type="number" placeholder="{{__('0')}}">
                                            <span class="text-danger" style="font-size: 12px;" v-show="errors.has('kids')">* @{{ errors.first('kids') }}</span>
                                        </div>
                                        <div class="mb-3">
                                            <span class="font-weight-bold">US$ @{{totals.kids_total}}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="border-top pt-3">
                                            <span class="font-weight-bold">Total: US$ @{{totals.adults_kids_total}}</span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group d-block d-md-none mt-3">
                                            <button @click="validate(ConfirmBooking)" class="button btn-save-booking btn-block button-contactForm boxed-btn">{{__('Save Booking')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </aside>
                    </div>
                 </div>
              </div>
           </div>
        </section>
        <!--================ Blog Area end =================-->

        <!-- Modal -->
        <div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog" aria-labelledby="whereModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content" style="border-radius:0px">
                <div class="modal-header row mx-0">
                    <div class="col-md-12">
                        <span style="color:#FF4A52">{{__('Read and confirm your booking information')}}:</span>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">
                            <span class="font-weight-light h5" style="color:#FF4A52">{{__('Customer Information')}}:</span>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6 my-1">
                                    <span class="border d-block px-2 py-1 rounded"><strong>{{__('Full Name')}}:</strong> <br/>@{{book_details.user_name}}</span>
                                </div>
                                <div class="col-md-6 my-1">
                                    <span class="border d-block px-2 py-1 rounded"><strong>{{__('Email')}}:</strong> <br/>@{{book_details.user_email}}</span>
                                </div>
                                <div class="col-md-12 my-1">
                                    <span  class="border d-block px-2 py-1 rounded"><strong>{{__('Address')}}:</strong> <br/>@{{book_details.user_street}}</span>
                                </div>
                                <div class="col-md-4 my-1">
                                    <span class="border d-block px-2 py-1 rounded"><strong>{{__('City')}}:</strong> <br/>@{{book_details.user_city}}</span>
                                </div>
                                <div class="col-md-4 my-1">
                                    <span class="border d-block px-2 py-1 rounded"><strong>{{__('Zip Code')}}:</strong> <br/>@{{book_details.user_zipCode}}</span>
                                </div>
                                <div class="col-md-4 my-1">
                                    <span v-if="selected_country.length > 0" class="border d-block px-2 py-1 rounded"><strong>{{__('Country')}}:</strong> <br/>
                                        @if(App::getlocale() == 'es')
                                            @{{selected_country[0].country_es}}
                                        @else
                                            @{{selected_country[0].country_en}}
                                        @endif
                                    </span>
                                </div>
                                <div class="col-md-6 my-1">
                                    <span class="border d-block px-2 py-1 rounded"><strong>{{__('Cell Phone')}}:</strong> <br/>@{{book_details.user_mainPhone}}</span>
                                </div>
                                <div class="col-md-6 my-1">
                                    <span class="border d-block px-2 py-1 rounded"><strong>{{__('Home Phone')}}:</strong> <br/>
                                        <span v-if="book_details.user_secondPhone != '' && book_details.user_secondPhone != null">@{{book_details.user_secondPhone}}</span>
                                        <span v-else>---</span>
                                    </span>
                                </div>
                                <div class="col-md-12 my-1">
                                    <span class="border d-block px-2 py-1 rounded text-justify"><strong>{{__('Additional Notes')}}:</strong> <br/>
                                        <span v-if="book_details.user_notes != '' && book_details.user_notes != null">@{{book_details.user_notes}}</span>
                                        <span v-else>---</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="bg-danger">
                    <div class="row">
                        <div class="col-12">
                            <span class="font-weight-light h5" style="color:#FF4A52">{{__('Trip Information')}}:</span>
                        </div>
                        <div class="col-md-12 my-1">
                            <div class="row">
                                <div class="col-md-12">
                                    <aside class="border p-1 post_category_widget rounded single_sidebar_widget">
                                        <div class="row align-items-center">
                                            <div class="col-12 col-md-4 col-lg-3">
                                                <img style="width:100%" :src="homepath + '/tripsImages/' + trip.picture_path + '/' + trip.img_thumbnail" alt="">
                                            </div>
                                            <div class="col-12 col-md-8 col-lg-9">
                                                <div class="info">
                                                    <p style="color:#ff4a52!important" class="text-left mt-1">
                                                        @if(App::getlocale() == 'es')
                                                            @{{trip.title_es}}
                                                        @else
                                                            @{{trip.title_en}}
                                                        @endif
                                                    </p>
                                                    <p class="small text-justify" style="line-height: 20px;">
                                                        @if(App::getlocale() == 'es')
                                                            @{{trip.short_description_es}}
                                                        @else
                                                            @{{trip.short_description_en}}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </aside>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 my-1">
                            <table class="table table-bordered table-hover table-sm text-center table-md-responsive" style="width:100%">
                                <thead class="table-header bg-danger text-white">
                                    <tr>
                                        <th></th>
                                        <th>Quantity</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Adults</td>
                                        <td>@{{book_details.adults_amount}}</td>
                                        <td>US$ @{{totals.adults_total}}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Kids</td>
                                        <td>@{{book_details.kids_amount}}</td>
                                        <td>US$ @{{totals.kids_total}}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Total</td>
                                        <td></td>
                                        <td class="font-weight-bold">US$ @{{totals.adults_kids_total}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" @click="SaveBooking()" class="btn d-none d-sm-block btn-confirm-booking btn-danger px-4">{{__('Confirm Reservation')}}</button>
                    <button type="button" @click="SaveBooking()" class="btn d-block d-sm-none btn-confirm-booking btn-danger px-4">{{__('Confirm')}}</button>
                    <button type="button" class="btn btn-default px-4" data-dismiss="modal">{{__('Close')}}</button>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
   var trip = {!! json_encode($trip)!!}
   var countries = {!! json_encode($countries)!!}

   function isNumberKey(evt)
    {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

   var main = new Vue({
      el : '.detail_container',
      data : {
         trip : trip,
         comments: trip.comments,
         countries: countries,
         book_details: {
             user_name : null,
             user_email : null,
             user_street : null,
             user_city: null,
             user_zipCode : null,
             user_country : '',
             user_mainPhone : null,
             user_secondPhone: null,
             user_notes: null,
             adults_amount : 0,
             kids_amount : 0,
             lang: lang,
         },
         totals: {
            adults_total : 0,
            kids_total : 0,
            adults_kids_total : 0
         }
      },
      mounted: function(){
          this.book_details.adults_amount = 1;
          this.book_details.kids_amount = 1;
         $('.country_select').on('change', function(val){
            main.book_details.user_country = parseInt(val.target.value);
        })

        $('.numeric_value').on('keypress', function(val){
            return isNumberKey(val)
        })
      },
      watch: {
        'book_details.adults_amount': function(val){
            if(val >= 0 && val != ''){
                this.totals.adults_total = parseFloat(parseFloat(this.trip.adult_price) * parseInt(val)).toFixed(2);
                this.totals.adults_kids_total = parseFloat(parseFloat(this.totals.adults_total) + parseFloat(this.totals.kids_total)).toFixed(2);
            }
        },
        'book_details.kids_amount': function(val){
            if(val >= 0 && val != ''){
                this.totals.kids_total = parseFloat(parseFloat(this.trip.kid_price) * parseInt(val)).toFixed(2);
                this.totals.adults_kids_total = parseFloat(parseFloat(this.totals.adults_total) + parseFloat(this.totals.kids_total)).toFixed(2);
            }
        }
      },
      computed: {
        selected_country (){
            var _this = this;
            return this.countries.filter(function(country){
                return country.id == _this.book_details.user_country; 
            })
        }
      },
      methods: {
        ConfirmBooking: function(){
            $(".btn-save-booking").LoadingOverlay("show");
            $('#ConfirmModal').modal('show');
            $(".btn-save-booking").LoadingOverlay("hide");
        },
        SaveBooking: function(){
            $(".btn-confirm-booking").LoadingOverlay("show");
            axios.post(homepath + '/destinations/booking/save_booking', {customer_info : this.book_details, totals : this.totals, trip: this.trip.id}).then(function(response){
                console.log(response.data);
                $(".btn-confirm-booking").LoadingOverlay("hide");
                Swal.fire({
                    icon: 'success',
                    title: "{{__('Thank You')}}!",
                    text: "{{__('We have sent you an email with the reservation details')}}.",
                    showConfirmButton: true,
                    // timer: 2000
                }).then(function(){
                    $('#ConfirmModal').modal('hide');
                })
            }).catch(function(error){
                $(".btn-confirm-booking").LoadingOverlay("hide");
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