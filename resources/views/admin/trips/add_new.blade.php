@extends('layouts.admin')
@section('title') {{__('New Trip')}}@endsection
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
                        <div class="dropzone-container border rounded text-center">
                           <form class="dropzone dz-clickable " id="defaultDropzone">
                           @csrf
                           <input type="hidden" name="attach_reference" v-model="trip.attach_reference">
                           </form>
                        </div>
                    </div>
                    <div class="col-md-8 mt-4">
                       <div class="dropzone-container border rounded text-center">
                          <form  class="dropzone dz-clickable " id="galeryDropzone">
                           @csrf
                           <input type="hidden" name="attach_reference" v-model="trip.attach_reference">
                          </form>
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
                           <div class="confirm-switch language-switch">
                              <input  type="checkbox" id="language-switch" :checked="lang == 'en'">
                              <label for="language-switch"></label>
                           </div>
                           <p class="mx-2">EN</p>
                        </div>
                        <div class="switch-wrap d-flex justify-content-start align-items-center">
                           <p class="mx-2">{{__('HIDE')}}</p>
                           <div class="confirm-switch active-switch">
                              <input  type="checkbox" id="active-switch">
                              <label for="active-switch"></label>
                           </div>
                           <p class="mx-2">{{__('SHOW')}}</p>
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
                     <button @click="validate(saveTrip)" class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn">{{__('Save Trip')}}</button>
                    </aside>
                    {{-- <aside class="single_sidebar_widget popular_post_widget">
                       <h3 class="widget_title">Recent Post</h3>
                       <div class="media post_item">
                          <img src="{{asset('/img/post/post_1.png')}}" alt="post">
                          <div class="media-body">
                             <a href="single-blog.html">
                                <h3>From life was you fish...</h3>
                             </a>
                             <p>January 12, 2019</p>
                          </div>
                       </div>
                       <div class="media post_item">
                          <img src="{{asset('/img/post/post_2.png')}}" alt="post">
                          <div class="media-body">
                             <a href="single-blog.html">
                                <h3>The Amazing Hubble</h3>
                             </a>
                             <p>02 Hours ago</p>
                          </div>
                       </div>
                       <div class="media post_item">
                          <img src="{{asset('/img/post/post_3.png')}}" alt="post">
                          <div class="media-body">
                             <a href="single-blog.html">
                                <h3>Astronomy Or Astrology</h3>
                             </a>
                             <p>03 Hours ago</p>
                          </div>
                       </div>
                       <div class="media post_item">
                          <img src="{{asset('/img/post/post_4.png')}}" alt="post">
                          <div class="media-body">
                             <a href="single-blog.html">
                                <h3>Asteroids telescope</h3>
                             </a>
                             <p>01 Hours ago</p>
                          </div>
                       </div>
                    </aside>
                    <aside class="single_sidebar_widget tag_cloud_widget">
                       <h4 class="widget_title">Tag Clouds</h4>
                       <ul class="list">
                          <li>
                             <a href="#">project</a>
                          </li>
                          <li>
                             <a href="#">love</a>
                          </li>
                          <li>
                             <a href="#">technology</a>
                          </li>
                          <li>
                             <a href="#">travel</a>
                          </li>
                          <li>
                             <a href="#">restaurant</a>
                          </li>
                          <li>
                             <a href="#">life style</a>
                          </li>
                          <li>
                             <a href="#">design</a>
                          </li>
                          <li>
                             <a href="#">illustration</a>
                          </li>
                       </ul>
                    </aside>
                    <aside class="single_sidebar_widget instagram_feeds">
                       <h4 class="widget_title">Instagram Feeds</h4>
                       <ul class="instagram_row flex-wrap">
                          <li>
                             <a href="#">
                                <img class="img-fluid" src="{{asset('/img/post/post_5.png')}}" alt="">
                             </a>
                          </li>
                          <li>
                             <a href="#">
                                <img class="img-fluid" src="{{asset('/img/post/post_6.png')}}" alt="">
                             </a>
                          </li>
                          <li>
                             <a href="#">
                                <img class="img-fluid" src="{{asset('/img/post/post_7.png')}}" alt="">
                             </a>
                          </li>
                          <li>
                             <a href="#">
                                <img class="img-fluid" src="{{asset('/img/post/post_8.png')}}" alt="">
                             </a>
                          </li>
                          <li>
                             <a href="#">
                                <img class="img-fluid" src="{{asset('/img/post/post_9.png')}}" alt="">
                             </a>
                          </li>
                          <li>
                             <a href="#">
                                <img class="img-fluid" src="{{asset('/img/post/post_10.png')}}" alt="">
                             </a>
                          </li>
                       </ul>
                    </aside>
                    <aside class="single_sidebar_widget newsletter_widget">
                       <h4 class="widget_title">Newsletter</h4>
                       <form action="#">
                          <div class="form-group">
                             <input type="email" class="form-control" onfocus="this.placeholder = ''"
                                onblur="this.placeholder = 'Enter email'" placeholder='Enter email' required>
                          </div>
                          <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                             type="submit">Subscribe</button>
                       </form>
                    </aside> --}}
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

         Dropzone.autoDiscover = false;

         var main = new Vue({
            el: '.blog_area',
            data : {
               categories : categories,
               summernote : null,
               dropzone_galery : null,
               dropzone_default : null,
               summernoteValue : null,
               trip : {
                  title : null,
                  content : null,
                  img_thumbnail : null,
                  categories: [],
                  attach_reference: '',
                  adult_price : null,
                  kid_price : null,    
                  short_description : '',
                  available_date : null,
                  status : 0,              
               },
               spinner : null,
               // lang_check : '',
               
            },
            mounted: function(){

               this.initSummernote();
               this.initDropzoneGalery();
               this.initDefaultDropzone();

               $( "#language-switch" ).change(function() {
                  if(lang == 'es'){
                     window.location.href = homepath + "/changeLanguage/en";
                  }else{
                     window.location.href = homepath + "/changeLanguage/es";
                  }
               });

               $( "#active-switch" ).change(function(val) {
                  if(val.target.checked){
                     main.trip.status = 1 
                  }else{
                     main.trip.status = 0 
                  }
               });

               $('.datepicker').datepicker({
                  format: 'yyyy-mm-dd',
                  immediateUpdates : true
               });

               $('.datepicker').on('change', function(val){
                  main.trip.available_date = val.target.value;
               })
               

               this.trip.attach_reference = this.randomString() + new Date().getTime();

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
               saveTrip(){
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

                  if(this.dropzone_galery[0].dropzone.files.length == 0 || this.dropzone_default[0].dropzone.files.length == 0){
                     $.toast({
                        heading: 'Error',
                        text: '{{__("Your galery or default picture is empty")}}',
                        showHideTransition: 'fade',
                        icon: 'error',
                        position : 'top-right'
                     })
                     go_to_go = false;
                  }

                  if(go_to_go){
                     $(".single-post-area").LoadingOverlay("show");
                     this.trip.content = this.summernote.summernote('code');
                     this.trip.img_thumbnail = this.dropzone_default[0].dropzone.files[0].name;
                     axios.post(homepath + '/admin/trips/store', {trip_info : this.trip, lang : lang}).then(function(response){
                        console.log(response.data);
                     }).catch(function(error){
                        console.log(error);
                     });
                     this.dropzone_galery[0].dropzone.processQueue();
                  }
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
                              console.log(file);
                              main.dropzone_galery[0].dropzone.removeAllFiles()
                              main.dropzone_default[0].dropzone.processQueue();
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
                              //response bring the ID of just created trip
                              window.location.href = homepath + "/destinations/" + response;
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