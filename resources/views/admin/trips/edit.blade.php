@extends('layouts.admin')
@section('title') 
    @if(App::getlocale() == 'es')
        {{$trip->title_es}}
    @else
        {{$trip->title_en}}
    @endif
@endsection

@section('styles')
   <style>
      
   </style>
@endsection

@section('content')
  
     <!--================Blog Area =================-->
     <section class="blog_area single-post-area">
        <div class="container">
           <div class="row">
              <div class="col-lg-8 posts-list mb-5">
                 <div class="row">
                    <div class="col-12">
                       <div class="single-post">
                          <div class="blog_details">
                              <div class="form-contact comment_form">
                                  <div class="form-group">
                                      <input v-validate="'required'" v-model="trip.title" class="form-control" name="title" id="tile" type="text" name="title" placeholder="{{__('Type the title')}}">
                                      <span class="text-danger" style="font-size: 12px;" v-show="errors.has('title')">* @{{ errors.first('title') }}</span>
                                    </div>
                                  <textarea id="summernote" data-toolbar="slim"></textarea>
                                  <div class="form-group my-3">
                                    <textarea v-validate="'required|max:157'" class="form-control w-100" v-model="trip.short_description" name="short description" cols="30" rows="9" placeholder="{{__('Type short description')}}"></textarea>
                                    <span class="text-danger" style="font-size: 12px;" v-show="errors.has('short description')">* @{{ errors.first('short description') }}</span>
                                 </div>
                              </div>
                           </div>
                       </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="blog_right_sidebar">
                            <aside class="single_sidebar_widget tag_cloud_widget p-0 mb-3">
                                <ul class="list">
                                   <li >
                                        <a @click="add_galery = !add_galery" class="mb-0 summernote_link" href="#">{{__('Change default picture')}}</a>
                                   </li>
                                </ul>
                             </aside>
                        </div>
                        <div v-show="add_galery" class="dropzone-container border rounded text-center mb-3">
                           <form class="dropzone dz-clickable " id="defaultDropzone">
                           @csrf
                           <input type="hidden" name="attach_reference" v-model="trip.attach_reference">
                           </form>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                 <div class="blog_right_sidebar">
                                    <aside class="single_sidebar_widget tag_cloud_widget p-0 mb-3">
                                        <ul class="d-flex flex-row flex-wrap list">
                                            <li class="d-flex">
                                                <a :href="homepath + '/tripsImages/' + trip.attach_reference + '/' + current_trip.img_thumbnail" class="mb-0 p-1" target="_blank">
                                                    <img style="width:100px" :src="homepath + '/tripsImages/' + trip.attach_reference + '/' + current_trip.img_thumbnail" alt="">
                                                </a>
                                            </li>
                                        </ul>
                                    </aside>
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="col-md-8 mt-4">
                        <div class="blog_right_sidebar">
                            <aside class="single_sidebar_widget tag_cloud_widget p-0 mb-3">
                                <ul class="list">
                                   <li >
                                        <a @click="change_thumbnail = !change_thumbnail" class="mb-0 summernote_link" href="#">{{__('Add pictures to galery')}}</a>
                                   </li>
                                </ul>
                             </aside>
                        </div>
                       <div v-show="change_thumbnail" class="dropzone-container border rounded text-center mb-3">
                          <form  class="dropzone dz-clickable " id="galeryDropzone">
                           @csrf
                           <input type="hidden" name="attach_reference" v-model="trip.attach_reference">
                          </form>
                       </div>
                       <div class="row">
                           <div class="col-12">
                                <div class="blog_right_sidebar">
                                    <aside class="single_sidebar_widget tag_cloud_widget p-0 mb-3">
                                        <ul class="d-flex flex-row flex-wrap justify-content-around list">
                                            <li v-if="picture != current_trip.img_thumbnail" v-for="picture in current_trip.attachments" class="d-flex">
                                                <a :href="homepath + '/tripsImages/' + trip.attach_reference + '/' + picture" class="mb-0 p-1" target="_blank">
                                                    <img style="width:100px" :src="homepath + '/tripsImages/' + trip.attach_reference + '/' + picture" alt="">
                                                </a>
                                                <span @click="DeletePicture(picture)" class="close" style="font-size:13px">&times;</span>
                                            </li>
                                        </ul>
                                    </aside>
                                </div>
                           </div>
                        </div>
                    </div>
                 </div>
              </div>

              <!-----------------------------HALF HERE------------------------------------->

              <div class="col-lg-4">
                 <div class="blog_right_sidebar">
                     <aside class="single_sidebar_widget post_category_widget pb-0 mb-0" style="background:none;">
                        <div class="switch-wrap d-flex justify-content-start align-items-center">
                           <p class="mx-2">ES</p>
                           <div class="confirm-switch">
                              <input  type="checkbox" id="confirm-switch" :checked="lang == 'en'">
                              <label for="confirm-switch"></label>
                           </div>
                           <p class="mx-2">EN</p>
                        </div>
                     </aside>
                     <aside class="single_sidebar_widget post_category_widget pb-0 mb-0">
                        <h4 class="widget_title mb-2">{{__("Trip Prices")}}</h4>
                        <div class="form-contact comment_form">
                           <input v-validate="'required|numeric'" type="type" name="adult price" v-model="trip.adult_price" class="form-control"  placeholder="{{__('Adults price')}}">
                        </div>
                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('adult price')">* @{{ errors.first('adult price') }}</span>
                        <div class="form-contact comment_form">
                           <input v-validate="'required|numeric'" type="type" name="kids price" v-model="trip.kid_price" class="form-control"  placeholder="{{__('Kids price')}}">
                        </div>
                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('kids price')">* @{{ errors.first('kids price') }}</span>
                     </aside>
                     <aside class="single_sidebar_widget post_category_widget pb-0 mb-0">
                        <h4 class="widget_title mb-2">{{__("Available Date")}}</h4>
                        <div class="form-contact comment_form">
                           <input v-validate="'required'" type="type" data-date-format="yyyy-mm-dd" class="datepicker form-control" data-provide="datepicker" name="available date" v-model="trip.available_date" class="form-control"  placeholder="{{__('Select Date')}}">
                        </div>
                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('available date')">* @{{ errors.first('available date') }}</span>
                     </aside>
                     <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title mb-2">{{__('Categories')}}</h4>
                        <select v-validate="'required'" v-model="trip.categories" name="category" class="selectpicker form-control" multiple>
                           <option v-for="category in categories" :value="category.id">
                              @if(App::getlocale() == 'es')
                                 @{{category.category_name_es}}
                              @else
                                 @{{category.category_name_en}}
                              @endif
                           </option>
                        </select>
                        <span class="text-danger" style="font-size: 12px;" v-show="errors.has('category')">* @{{ errors.first('category') }}</span>
                     </aside>
                    <aside class="single_sidebar_widget search_widget pt-0">
                     <button @click="validate(updateTrip)" class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn">{{__('Update Trip')}}</button>
                    </aside>
                 </div>
              </div>
           </div>
        </div>
        <div id="spin-area"></div>
     </section>
     <!--================ Blog Area end =================-->
@endsection

@section('scripts')
    <script>
         Vue.use(VeeValidate);
         var categories = {!! json_encode($categories) !!}
         var trip = {!! json_encode($trip) !!}

         Dropzone.autoDiscover = false;

         var main = new Vue({
            el: '.blog_area',
            data : {
               categories : categories,
               current_trip: trip,
               summernote : null,
               dropzone_galery : null,
               dropzone_default : null,
               summernoteValue : null,
               trip : {
                    id : null,
                    title : null,
                    content : null,
                    img_thumbnail : null,
                    categories: [],
                    attach_reference: '',
                    adult_price : null,
                     kid_price : null,  
                    short_description : '',   
                     available_date : null,              

               },
               spinner : null,
               change_thumbnail : false,
               add_galery : false,
               
            },
            mounted: function(){

               this.initSummernote();
               this.initDropzoneGalery();
               this.initDefaultDropzone();

               $( "#confirm-switch" ).change(function() {
                  if(lang == 'es'){
                     window.location.href = homepath + "/changeLanguage/en";
                  }else{
                     window.location.href = homepath + "/changeLanguage/es";
                  }
               });

               $(".summernote_link").click(function (e){
                        e.preventDefault(); 
                        return false;  
                });
               
               this.trip.id = this.current_trip.id;
               if(lang == 'es'){
                    this.trip.title = this.current_trip.title_es;
                    this.trip.content = this.current_trip.content_es;
                    this.trip.short_description = this.current_trip.short_description_es;
               }else{
                    this.trip.title = this.current_trip.title_en;
                    this.trip.content = this.current_trip.content_en;
                    this.trip.short_description = this.current_trip.short_description_en;
               }

               this.trip.categories = this.current_trip.categories.map(function(category){
                   return category.id;
               })

               this.summernote.summernote('code', this.trip.content)
               this.trip.attach_reference = this.current_trip.picture_path;
               this.trip.price = this.current_trip.price;
               this.trip.adult_price = this.current_trip.adult_price;
               this.trip.kid_price = this.current_trip.kid_price;
               this.trip.kid_price = this.current_trip.kid_price;
               this.trip.img_thumbnail = this.current_trip.img_thumbnail;
               this.trip.available_date = this.current_trip.available_date;

               $('.datepicker').datepicker({
                  format: 'yyyy-mm-dd',
                  immediateUpdates : true
               });

               $('.datepicker').on('change', function(val){
                  main.trip.available_date = val.target.value;
               })



            },
            watch : {
               lang_check: function(val){
                  console.log(val);
               }
            },
            methods: {
                randomString: function(){
                    var result = '';
                    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    var charactersLength = characters.length;
                    for ( var i = 0; i < 30; i++ ) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    }
                    return result;
                },
               updateTrip(){
                   var _this = this;
                  var go_to_go = true;
                  if(this.summernote.summernote('code').length < 500){
                     $.toast({
                        heading: 'Error',
                        text: '{{__("Trip description is too small")}}',
                        showHideTransition: 'fade',
                        icon: 'error',
                        position : 'top-right'
                     });
                     go_to_go = false;
                  }

                  if(go_to_go){
                    let hide_loading = false;
                     $(".single-post-area").LoadingOverlay("show");
                     this.trip.content = this.summernote.summernote('code');
                     if(this.dropzone_default[0].dropzone.files.length > 0){
                         this.trip.img_thumbnail = this.dropzone_default[0].dropzone.files[0].name;
                     }

                    if(_this.dropzone_galery[0].dropzone.files.length > 0){
                        _this.dropzone_galery[0].dropzone.processQueue();
                    }else{
                        if(_this.dropzone_default[0].dropzone.files.length > 0){
                            _this.dropzone_default[0].dropzone.processQueue();   
                        }else{
                            hide_loading = true;
                        }
                    }

                    axios.post(homepath + '/admin/trips/update', {trip_info : this.trip, lang : lang}).then(function(response){
                        console.log(response.data);
                        if(hide_loading){
                            $(".single-post-area").LoadingOverlay("hide");
                            window.location.reload()
                        }
                    }).catch(function(error){
                        console.log(error);
                    });
                  }

               },
               DeletePicture: function(picture){
                   var _this = this;
                    axios.post(homepath + '/admin/trips/file/DeletePicture', {picture : picture, path : this.trip.attach_reference}).then(function(response){
                        _this.current_trip.attachments = response.data;
                    }).catch(function(error){
                        console.log(error);
                    });
               },
               initSummernote: function(){
                  var HightlightButton = function(context) {
                  var ui = $.summernote.ui;
                  var button = ui.button({
                        contents: '<i class="fa fa-pencil"/> Highlight',
                        tooltip: 'Highlight text with red color',
                        click: function() {
                        context.invoke('editor.foreColor', 'red');
                        }
                  });
                        return button.render();
                  }
                  var codigo = `<h5><span style="font-family: Arial; color: rgb(206, 198, 206);">{{__('Type trip information')}}</span></h5>`;
                  this.summernote = $('#summernote').summernote({
                     blockquoteBreakingLevel: 2,
                     placeholder: codigo,
                     tabsize: 2,
                     height: 500,
                     minHeight: 500,
                     maxHeight: 500,  
                     toolbar: [
                        // [groupName, [list of button]]
                        ['style', ['bold', 'italic', 'underline', 'clear']],
                        ['font', ['strikethrough', 'superscript', 'subscript']],
                        ['fontsize', ['fontsize']],
                        ['fontname', ['fontname']],
                        ['color', ['color']],
                        ['para', [ 'paragraph']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['view', ['fullscreen', 'codeview']],

                     ],
                     buttons: {
                        highlight: HightlightButton
                     }
                  });
               },
               initDropzoneGalery:  function(){
                  this.dropzone_galery = $("#galeryDropzone").dropzone({ 
                     url: "/admin/trips/file/galery",
                     uploadMultiple: true,
                     paramName: "file",
                     parallelUploads: 10,
                     acceptedFiles: "image/*",
                     autoProcessQueue: false,
                     addRemoveLinks: true,
                     dictDefaultMessage: `<i class="fa fa-hand-o-up mb-2" aria-hidden="true" style="font-size: 1.5em"></i><br/>
                                          <span style="font-size: 1em">{{__('Drop or click here to upload your galery')}}</span>`,
                     init : function(){
                        var _this = this;
                        this.on('error', function(file, error){
                           _this.removeFile(file)
                        //   toastr["error"](error, "Error");
                        });
                        this.on("successmultiple", function(file, response) {
                           if(file){
                                main.dropzone_galery[0].dropzone.removeAllFiles()
                                if(main.dropzone_default[0].dropzone.files.length > 0){
                                    main.dropzone_default[0].dropzone.processQueue();   
                                }else{
                                    $(".single-post-area").LoadingOverlay("hide");
                                    window.location.reload()
                                }   

                           }
                        });
                     }, 
                  });
               },
               initDefaultDropzone: function(){
                  var _this = this;
                  this.dropzone_default = $("#defaultDropzone").dropzone({ 
                     url: "/admin/trips/file/default",
                     uploadMultiple: true,
                     maxFiles:1,
                     paramName: "file",
                     // parallelUploads: 10,
                     acceptedFiles: "image/*",
                     autoProcessQueue: false,
                     addRemoveLinks: true,
                     dictDefaultMessage: `<i class="fa fa-hand-o-up mb-2" aria-hidden="true" style="font-size: 1.5em"></i><br/>
                                          <span style="font-size: 1em">{{__('Drop or click here to upload your custom image')}}</span>`,
                     init : function(){
                        var _this_ = _this;
                        this.on('error', function(file, error){
                           _this.removeFile(file)
                        //   toastr["error"](error, "Error");
                        });
                        this.on("success", function(file, response) {
                           if(file){
                                main.dropzone_default[0].dropzone.removeAllFiles();
                                $(".single-post-area").LoadingOverlay("hide");
                                window.location.reload()
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
            },
        });
    </script>
@endsection