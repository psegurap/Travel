@extends('layouts.admin')
@section('title') {{__('Broadcast Message')}}@endsection
@section('styles')
   <style>
      
   </style>
@endsection

@section('content')
  
     <!--================Broadcast Area =================-->
     <section class="broadcast_area single-post-area">
        <div class="container">
           <div class="row">
              <div class="col-lg-8 posts-list mb-5">
                 <div class="row">
                    <div class="col-12">
                       <div class="single-post">
                          <div class="blog_details">
                              <div class="form-contact comment_form">
                                 <div class="form-group">
                                    <input v-validate="'required'" v-model="broadcast.subject" class="form-control" name="subject" id="subject" type="text" name="subject" placeholder="{{__('Type the subject')}}">
                                    <span class="text-danger" style="font-size: 12px;" v-show="errors.has('subject')">* @{{ errors.first('subject') }}</span>
                                 </div>
                                 <textarea id="summernote" data-toolbar="slim"></textarea>
                              </div>
                           </div>
                       </div>
                    </div>
                 </div>
              </div>

              <!-----------------------------HALF HERE------------------------------------->

              <div class="col-lg-4">
                 <div class="blog_right_sidebar">
                    <aside class="single_sidebar_widget search_widget mb-0">
                        <button @click="validate(PrepareBroadcast)" class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn">{{__('Send Broadcast')}}</button>
                     </aside>
                     <aside class="single_sidebar_widget post_category_widget mb-0 pt-2" style="background:none;">
                        <span class="d-block my-2">{{__('Language')}}:</span>
                        <div class="switch-wrap d-flex justify-content-start align-items-center">
                           <p class="mx-2">ES</p>
                           <div class="confirm-switch">
                              <input  type="checkbox" id="confirm-switch" :checked="lang == 'en'">
                              <label for="confirm-switch"></label>
                           </div>
                           <p class="mx-2">EN</p>
                        </div>
                     </aside>
                     <aside class="single_sidebar_widget search_widget mb-0">
                        <div class="blog_right_sidebar">
                           <aside class="single_sidebar_widget tag_cloud_widget p-0 mb-0">
                               <ul class="list">
                                  <li >
                                       <a href="javascript:void(0)" @click="add_attachment = !add_attachment" class="mb-0" href="#">{{__('Include attachments')}}</a>
                                  </li>
                               </ul>
                            </aside>
                       </div>
                        <div v-show="add_attachment" class="dropzone-container border rounded text-center">
                           <form  class="dropzone dz-clickable " id="dropzone">
                            @csrf
                            <input type="hidden" name="attach_reference" v-model="attach_reference">
                           </form>
                        </div>
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
         Dropzone.autoDiscover = false;
         var main = new Vue({
            el: '.broadcast_area',
            data : {
               summernote : null,
            //    dropzone_galery : null,
            //    dropzone_default : null,
            //    summernoteValue : null,
               broadcast : {
                   subject : null,
                   message : null,
               },
               dropzone : null,
               attach_reference : null,
               add_attachment : false,
            },
            mounted: function(){

               this.initSummernote();
               this.initDropzone();

               $( "#confirm-switch" ).change(function() {
                  if(lang == 'es'){
                     window.location.href = homepath + "/changeLanguage/en";
                  }else{
                     window.location.href = homepath + "/changeLanguage/es";
                  }
               });

               this.attach_reference = this.randomString();
            },
            watch : {
               
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
                PrepareBroadcast: function(){
                    var _this = this;
                    var go_to_go = true;
                    if(this.summernote.summernote('code').length < 20){
                        $.toast({
                            heading: 'Error',
                            text: '{{__("Broadcast information is too small")}}',
                            showHideTransition: 'fade',
                            icon: 'error',
                            position : 'top-right'
                        });
                        go_to_go = false;
                    }

                    if(go_to_go){
                        Swal.fire({
                        title: "{{__('Are you sure?')}}",
                        text: "{{__('You are about to send this broadcast!')}}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "{{__('Yes, send it!')}}",
                        cancelButtonText: "{{__('Cancel')}}",
                        }).then(function(result) {
                            var _this_ = _this;
                            if (result.value) {
                              if(_this_.dropzone[0].dropzone.files.length > 0){
                                $(".broadcast_area").LoadingOverlay("show");
                                 main.dropzone[0].dropzone.processQueue();
                              }else{
                                 $(".broadcast_area").LoadingOverlay("show");
                                 _this_.SendBroadcast();
                              }
                            }
                        })
                    }
                },
                SendBroadcast: function(){
                     this.broadcast.message = this.summernote.summernote('code');
                     axios.post(homepath + '/admin/maintenance/subscribers/send_broadcast', {broadcast_info : this.broadcast, attach_reference : this.attach_reference, lang : lang}).then(function(response){
                        $(".broadcast_area").LoadingOverlay("hide");
                        Swal.fire({
                              icon: 'success',
                                 title: "{{__('Your broadcast was sent')}}!",
                                 showConfirmButton: false,
                                 timer: 2500
                        }).then(function(){
                              window.location.reload();
                        })
                     }).catch(function(error){
                        $(".broadcast_area").LoadingOverlay("hide");
                        $.toast({
                              heading: 'Error',
                              text: '{{__("There was an error sending the broadcast")}}',
                              showHideTransition: 'fade',
                              icon: 'error',
                              position : 'top-right'
                        })
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
                    var codigo = `<h5><span style="font-family: Arial; color: rgb(206, 198, 206);">{{__('Type broadcast information')}}</span></h5>`;
                    this.summernote = $('#summernote').summernote({
                        blockquoteBreakingLevel: 2,
                        placeholder: codigo,
                        tabsize: 2,
                        height: 700,
                        minHeight: 500,
                        maxHeight: 1000,  
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
                            ['insert', ['link']],
                        ],
                        buttons: {
                            highlight: HightlightButton
                        }
                    });
                },
                initDropzone:  function(){
                    this.dropzone = $("#dropzone").dropzone({ 
                        url: "/admin/maintenance/subscribers/file/broadcast_attachments",
                        uploadMultiple: true,
                        paramName: "file",
                        parallelUploads: 10,
                        acceptedFiles: "image/*",
                        autoProcessQueue: false,
                        addRemoveLinks: true,
                        dictDefaultMessage: `<i class="fa fa-hand-o-up mb-2" aria-hidden="true" style="font-size: 1.5em"></i><br/>
                                            <span style="font-size: 1em">{{__('Drop or click here to upload your attachments')}}</span>`,
                        init : function(){
                            var _this = this;
                            this.on('error', function(file, error){
                            _this.removeFile(file)
                            //   toastr["error"](error, "Error");
                            });
                            this.on("successmultiple", function(file, response) {
                              if(file){
                                 main.dropzone[0].dropzone.removeAllFiles()
                                 main.SendBroadcast();
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