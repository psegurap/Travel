@extends('layouts.app')
@section('title') {{__('Contact')}}@endsection
@section('content')

    <main>
        <!-- bradcam_area  -->
        <div class="bradcam_area bradcam_bg_4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="bradcam_text text-center">
                            <h3>contact</h3>
                            <p>Pixel perfect design with awesome contents</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ bradcam_area  -->
        
        <!-- ================ contact section start ================= -->
        <section class="contact-section">
            <div class="container">
                <div class="d-none d-sm-block mb-5 pb-4">
                    <div id="map" style="height: 480px; position: relative; overflow: hidden;"> </div>
                    <script>
                        function initMap() {
                            var uluru = {
                                lat: -25.363,
                                lng: 131.044
                            };
                            var grayStyles = [{
                                    featureType: "all",
                                    stylers: [{
                                            saturation: -90
                                        },
                                        {
                                            lightness: 50
                                        }
                                    ]
                                },
                                {
                                    elementType: 'labels.text.fill',
                                    stylers: [{
                                        color: '#ccdee9'
                                    }]
                                }
                            ];
                            var map = new google.maps.Map(document.getElementById('map'), {
                                center: {
                                    lat: -31.197,
                                    lng: 150.744
                                },
                                zoom: 9,
                                styles: grayStyles,
                                scrollwheel: false
                            });
                        }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpfS1oRGreGSBU5HHjMmQ3o5NLw7VdJ6I&amp;callback=initMap">
                    </script>
        
                </div>
        
        
                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">{{__('Get in Touch')}}</h2>
                    </div>
                    <div class="col-lg-8">
                        <section class="form-contact contact_form">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <textarea v-validate="'required'" v-model="email_details.message" class="form-control w-100" name="message" cols="30" rows="9" placeholder="{{__('Enter Message')}}"></textarea>
                                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('message')">* @{{ errors.first('message') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input v-validate="'required'" v-model="email_details.name" class="form-control valid" name="name" type="text" placeholder="{{__('Enter your name')}}">
                                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('name')">* @{{ errors.first('name') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input v-validate="'required|email'" v-model="email_details.email" class="form-control valid" name="email" type="email" placeholder="{{__('Email')}}">
                                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('email')">* @{{ errors.first('email') }}</span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <input v-validate="'required'" v-model="email_details.subject" class="form-control" name="subject" type="text" placeholder="{{__('Enter Subject')}}">
                                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('subject')">* @{{ errors.first('subject') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button @click="validate(sendMessage)" class="button button-contactForm boxed-btn">{{__('Send')}}</button>
                            </div>
                        </section>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-home"></i></span>
                            <div class="media-body">
                                <h3>Buttonwood, California.</h3>
                                <p>Rosemead, CA 91770</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
                            <div class="media-body">
                                <h3>+1 253 565 2365</h3>
                                <p>Mon to Fri 9am to 6pm</p>
                            </div>
                        </div>
                        <div class="media contact-info">
                            <span class="contact-info__icon"><i class="ti-email"></i></span>
                            <div class="media-body">
                                <h3>support@colorlib.com</h3>
                                <p>Send us your query anytime!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ================ contact section end ================= -->
    </main>

@endsection

@section('scripts')
    <script>
        Vue.use(VeeValidate);

        var main = new Vue({
            el : 'main',
            data : { 
                email_details: {
                    message : null,
                    name : null,
                    email : null,
                    subject : null
                }
            },
            methods : {
                sendMessage: function(){
                    $(".contact-section").LoadingOverlay("show");
                    axios.post( homepath +  '/sendContactEmail', {email_details : this.email_details, lang: lang}).then(function(response){
                        $(".contact-section").LoadingOverlay("hide");
                        Swal.fire({
                             icon: 'success',
                                title: "{{__('Your message was sent')}}!",
                                showConfirmButton: false,
                                timer: 2500
                        }).then(function(){
                            window.location.reload();
                        })
                    }).catch(function(error){
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