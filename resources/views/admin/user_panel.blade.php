@extends('layouts.admin')
@section('title') {{__('User Panel')}}@endsection
@section('content')

    <main>
        <!-- ================ contact section start ================= -->
        <section class="contact-section pt-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <section class="form-contact contact_form">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">{{__('Name')}}:</label>
                                        <input v-validate="'required'" v-model="user_details.name" class="form-control valid" name="name" type="text" placeholder="{{__('Enter your name')}}">
                                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('name')">* @{{ errors.first('name') }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">{{__('Email')}}:</label>
                                        <input v-validate="'required|email'" disabled readonly v-model="user_details.email" class="form-control valid" name="email" type="email" placeholder="{{__('Email')}}">
                                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('email')">* @{{ errors.first('email') }}</span>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">{{__('Slogan')}}[EN]:</label>
                                                <textarea v-validate="'required|max:128'" v-model="user_details.slogan_en" class="form-control w-100" name="slogan (en)" cols="30" rows="5" placeholder="{{__('Enter your slogan  (es)')}}"></textarea>
                                                <span class="text-danger" style="font-size: 12px;" v-show="errors.has('slogan (en)')">* @{{ errors.first('slogan (en)') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">{{__('Slogan')}}[ES]:</label>
                                                <textarea v-validate="'required|max:128'" v-model="user_details.slogan_es" class="form-control w-100" name="slogan (es)" cols="30" rows="5" placeholder="{{__('Enter your slogan (es)')}}"></textarea>
                                                <span class="text-danger" style="font-size: 12px;" v-show="errors.has('slogan (es)')">* @{{ errors.first('slogan (es)') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="blog_right_sidebar">
                                            <aside class="single_sidebar_widget tag_cloud_widget p-0 mb-2 bg-white">
                                                <ul class="list">
                                                   <li >
                                                        <a @click="change_profile_picture = !change_profile_picture" class="mb-0 " href="javascript:void(0)">{{__('Change profile picture')}} (2MB)</a>
                                                   </li>
                                                </ul>
                                             </aside>
                                        </div>
                                        <div v-show="change_profile_picture" class="dropzone-container border rounded text-center mb-3">
                                            <form class="dropzone dz-clickable " id="Dropzone">
                                                @csrf
                                                <input type="hidden" name="attach_reference" v-model="user_details.attach_reference">
                                            </form>
                                        </div>
                                        <div v-show="!change_profile_picture">
                                            <img class="rounded" :src="homepath + '/UsersPictures/' + user.attach_reference + '/' + user.img_thumbnail" style="width: 100%" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button @click="validate(PrepareUpdate)" class="button btn-block button-contactForm boxed-btn">{{__('Update Profile')}}</button>
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
        Dropzone.autoDiscover = false;

        var user = {!! json_encode($user) !!}

        var main = new Vue({
            el : 'main',
            data : { 
                user : user,
                dropzone : null,
                user_details: {
                    name : null,
                    email : null,
                    slogan_es : null,
                    slogan_en : null,
                    picture : null,
                    attach_reference : null,
                },
                change_profile_picture: false,
            },
            mounted: function(){
                this.user_details.name = this.user.name;
                this.user_details.email = this.user.email;
                this.user_details.picture = this.user.img_thumbnail;
                this.user_details.slogan_es = this.user.slogan_es;
                this.user_details.slogan_en = this.user.slogan_en;
                if(this.user.img_thumbnail == null){
                    this.change_profile_picture = true;
                }

                if(this.user.attach_reference == null){
                    this.user_details.attach_reference = this.randomString() + new Date().getTime();
                }else{
                    this.user_details.attach_reference = this.user.attach_reference;
                }

                this.initDropzone();
            },
            methods : {
                randomString: function(){
                    var result = '';
                    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    var charactersLength = characters.length;
                    for ( var i = 0; i < 30; i++ ) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    }
                    return result;
                },
                PrepareUpdate: function(){
                    var go_to_go = true;
                    if(this.dropzone[0].dropzone.files.length == 0 && this.user_details.picture == null){
                        go_to_go = false;
                        $.toast({
                           heading: 'Error',
                           text: '{{__("You need to add a profile picture")}}',
                           showHideTransition: 'fade',
                           icon: 'error',
                           position : 'top-right'
                        })
                    }

                    if(go_to_go){
                        $(".form-contact").LoadingOverlay("show");
                        if(this.dropzone[0].dropzone.files.length > 0){
                            this.user_details.picture = this.dropzone[0].dropzone.files[0].name;
                            this.dropzone[0].dropzone.processQueue();
                        }else{
                            this.UpdateProfile();
                        }
                    }
                },
                UpdateProfile:function(){
                    axios.post( homepath +  '/admin/user/update_profile', {user_details : this.user_details}).then(function(response){
                        $(".form-contact").LoadingOverlay("hide");
                        Swal.fire({
                                icon: 'success',
                                title: "{{__('Your profile was updated')}}!",
                                showConfirmButton: false,
                                timer: 2500
                        }).then(function(){
                            window.location.reload();
                        })
                    }).catch(function(error){
                        console.log(error);
                    }) 
                },
                initDropzone: function(){
                    var _this = this;
                    this.dropzone = $("#Dropzone").dropzone({ 
                        url: "/admin/user/file/store_picture",
                        uploadMultiple: true,
                        maxFiles:1,
                        maxFilesize: 2,
                        paramName: "file",
                        acceptedFiles: "image/*",
                        autoProcessQueue: false,
                        addRemoveLinks: true,
                        dictDefaultMessage: `<i class="fa fa-hand-o-up mb-2" aria-hidden="true" style="font-size: 1.5em"></i><br/>
                                            <span style="font-size: 1em">{{__('Click here to upload image')}}</span>`,
                        init : function(){
                            var _this_ = _this;
                            this.on('error', function(file, error){
                                _this.removeFile(file)
                                //   toastr["error"](error, "Error");
                            });
                            this.on("success", function(file, response) {
                                if(file){
                                    main.dropzone[0].dropzone.removeAllFiles();
                                    main.UpdateProfile();
                                }
                            });
                        },
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