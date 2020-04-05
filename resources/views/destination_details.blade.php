@extends('layouts.app')
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
    <div class="detail_container">
         <!-- bradcam_area  -->
         <div class="bradcam_area">
            <div class="container">
               <div class="row">
                  <div class="col-xl-12">
                        <div class="bradcam_text text-center">
                           @if(App::getlocale() == 'es')
                           <h3>{{$trip->title_es}}</h3>
                           @else
                           <h3>{{$trip->title_en}}</h3>
                           @endif
                        </div>
                  </div>
               </div>
            </div>
         </div>
         
       
        <!--================Blog Area =================-->
        <section class="blog_area single-post-area section-padding">
           <div class="container">
              <div class="row">
                 <div class="left-side col-lg-8 posts-list">
                    <div class="single-post">
                       <div class="feature-img">
                           <div id="carouselGallery" class="carousel slide" data-ride="carousel">
                              <ol class="carousel-indicators">
                                 <li data-target="#carouselGallery" v-for="(picture, index) in trip.attachments" :class="[index == 0 ? 'active' : '']" :data-slide-to="index"></li>
                              </ol>
                              <div class="carousel-inner">
                                 <div class="carousel-item" v-for="(picture, index) in trip.attachments" :class="[index == 0 ? 'active' : '']">
                                    <img class="d-block w-100" :src="homepath + '/tripsImages/' + trip.picture_path + '/' + picture">
                                 </div>
                                 
                              </div>
                              <a v-if="trip.attachments.length > 1" class="carousel-control-prev" href="#carouselGallery" role="button" data-slide="prev">
                                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                 <span class="sr-only">Previous</span>
                              </a>
                              <a v-if="trip.attachments.length > 1" class="carousel-control-next" href="#carouselGallery" role="button" data-slide="next">
                                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                 <span class="sr-only">Next</span>
                              </a>
                           </div>
                       </div>
                       <div class="blog_details">
                           @if(App::getlocale() == 'es')
                           <h2>@{{trip.title_es}}</h2>
                           @else
                           <h2>@{{trip.title_en}}</h2>
                           @endif
                          <ul class="blog-info-link mt-3 mb-4">
                             <li><i class="fa fa-users"></i>
                                 <a v-for="category in trip.categories" href="#"> 
                                    <span class="text-lowercase">
                                       @if(App::getlocale() == 'es')
                                          #@{{category.category_name_es}}
                                       @else
                                          #@{{category.category_name_en}}
                                       @endif
                                    </span>
                                 </a>
                              </li>
                             <li><a href="#"><i class="fa fa-comments"></i> 03 Comments</a></li>
                          </ul>
                          <textarea id="summernote" data-toolbar="slim"></textarea>
                          
                       </div>
                    </div>
                    <div class="navigation-top">
                    </div>
                    <div class="blog-author">
                       <div class="media align-items-center">
                          <img v-if="trip.user.img_thumbnail != null" :src="homepath + '/UsersPictures/' + trip.user.attach_reference + '/' + trip.user.img_thumbnail" alt="">
                          <img v-else :src="homepath + '/img/feedback_picture.jpg'" alt="">
                          <div class="media-body">
                             <a href="javascript:void(0)">
                                <h4>@{{trip.user.name}}</h4>
                             </a>
                             <p>
                                @if (App::getLocale() == 'es')
                                    @{{trip.user.slogan_es}}
                                @else
                                    @{{trip.user.slogan_en}}
                                @endif
                             </p>
                          </div>
                       </div>
                    </div>
                    <div class="comments-area">
                       <h4>@{{trip.comments.length}} {{__('Comment(s)')}}</h4>
                       <div class="comment-list" v-for="comment in trip.comments">
                          <div class="single-comment justify-content-between d-flex">
                             <div class="user justify-content-between d-flex">
                                <div class="thumb d-none d-sm-block">
                                   <img :src="homepath + '/img/feedback_picture.jpg'" alt="">
                                </div>
                                <div class="row justify-content-end">
                                   <div class="col-12">
                                      <div class="desc border-bottom">
                                         <p class="comment">
                                            @{{comment.comment}}
                                         </p>
                                         <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                               <h5>
                                                  <a href="javascript:void(0)">@{{comment.user_name}}</a>
                                               </h5>
                                                <p class="date">@{{moment(comment.created_at).format('LLL')}}</p>
                                            </div>
                                            <div class="reply-btn">
                                               <a href="javascript:void(0)" @click="add_reply(comment.id)" class="btn-reply text-uppercase">reply</a>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                   <div class="col-11">
                                      <div v-for="reply in comment.replies" class="desc border-left mt-3 pl-3">
                                         <p class="comment">
                                            @{{reply.comment}}
                                         </p>
                                         <div class="d-flex justify-content-between">
                                            <div class="d-flex align-items-center">
                                               <h5>
                                                  <a href="javascript:void(0)">@{{reply.user_name}}</a>
                                               </h5>
                                                <p class="date">@{{moment(reply.created_at).format('LLL')}}</p>
                                            </div>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="comment-form">
                       <h4 v-if="!replying">{{__('Leave a Reply')}}</h4>
                       <div v-if="replying" class="border-0 comments-area mt-0 pt-0">
                           <h4 class="d-flex justify-content-between">{{('Replying to')}}: <a @click="replying = false" href="javascript:void(0)" class="btn-link small"><u>Cancel</u></a></h4>
                           <div class="comment-list">
                              <div class="single-comment justify-content-between d-flex">
                                 <div class="user justify-content-between d-flex">
                                    <div class="desc">
                                       <p class="comment">
                                          @{{CurrentComment[0].comment}}
                                       </p>
                                       <div class="d-flex justify-content-between">
                                          <div class="d-flex align-items-center">
                                             <h5>
                                                <a href="javascript:void(0)">@{{CurrentComment[0].user_name}}</a>
                                             </h5>
                                             <p class="date">@{{moment(CurrentComment[0].created_at).format('LLL')}}</p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                       <div class="form-contact comment_form" id="commentForm">
                          <div class="row">
                             <div class="col-12">
                                <div class="form-group">
                                   <textarea v-validate="'required|max:600'" v-model="comment_details.comment" class="form-control w-100" name="comment" id="comment" cols="30" rows="9"placeholder="Write Comment *"></textarea>
                                   <span class="text-danger" style="font-size: 12px;" v-show="errors.has('comment')">* @{{ errors.first('comment') }}</span>
                                 </div>
                             </div>
                             <div class="col-sm-6">
                                <div class="form-group">
                                   <input v-validate="'required|max:30'" v-model="comment_details.name" class="form-control" name="name" id="name" type="text" placeholder="Name *">
                                   <span class="text-danger" style="font-size: 12px;" v-show="errors.has('name')">* @{{ errors.first('name') }}</span>
                                </div>
                             </div>
                             <div class="col-sm-6">
                                <div class="form-group">
                                   <input v-validate="'required|email'" class="form-control" v-model="comment_details.email" name="email" id="email" type="email" placeholder="Email *">
                                   <span class="text-danger" style="font-size: 12px;" v-show="errors.has('email')">* @{{ errors.first('email') }}</span>
                                 </div>
                             </div>
                          </div>
                          <div class="form-group">
                             <button type="submit" @click="validate(SendComment)" class="button button-contactForm btn_1 boxed-btn">Send Message</button>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="right-side col-lg-4">
                    <div class="blog_right_sidebar">
                     <aside v-if="trip.available_to_book" class="single_sidebar_widget newsletter_widget">
                           <button @click="BookNow(trip.id)" class="button rounded primary-bg text-white w-100 btn_1 boxed-btn" type="submit">
                              {{__('Book Now')}}
                           </button>
                           <p class="mt-3"><i class="fa fa-check-circle-o text-success" aria-hidden="true"></i> {{__('Available Date')}}: <span style="color:#FF4A52;" class="font-weight-bold">@{{moment(trip.available_date).format('YYYY/MM/DD')}}</span></p>
                     </aside>
                     <aside v-else class="single_sidebar_widget newsletter_widget">
                        <button disabled style="cursor: not-allowed;" class="button rounded btn btn-default text-white w-100 btn_1 boxed-btn" type="submit">
                           {{__('Currently unavailable')}}
                        </button>
                        <p class="mt-3"><i class="fa fa fa-times-circle-o text-danger" aria-hidden="true"></i> {{__('Available Date')}}: <span style="color:#FF4A52;" class="font-weight-bold">{{__('Undefined')}}</span></p>
                     </aside>
                       <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">{{__('Prices')}}</h4>
                            <ul class="list cat-list">
                                <li>{{__('Adults')}}: 
                                    <strong>
                                        $@{{trip.adult_price}}
                                    </strong>
                                </li>
                                
                                <li>{{__('Kids')}}(2-8): 
                                    <strong>
                                        $@{{trip.kid_price}}
                                    </strong>
                                </li>
                            </ul>
                        </aside>
                       <aside class="single_sidebar_widget popular_post_widget">
                          <h3 class="widget_title">{{__('Other Trips')}}</h3>
                          <div class="media post_item" v-for="post in some_trips">
                             <div class="row">
                                <div class="col-4 px-1">
                                   <img style="width: 100%;" :src="homepath + '/tripsImages/' + post.picture_path + '/' + post.img_thumbnail" :alt="post.img_thumbnail">
                                </div>
                                <div class="col-8 px-1">
                                   <div class="media-body">
                                      <a :href="homepath + '/destinations/' + post.id">
                                          @if(App::getLocale() == 'es')
                                             <h3>@{{post.title_es}}</h3>
                                          @else
                                             <h3>@{{post.title_en}}</h3>
                                          @endif
                                      </a>
                                      <p>@{{moment(post.available_date, "YYYYMMDD").fromNow()}}</p>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </aside>
                       <aside class="single_sidebar_widget tag_cloud_widget">
                          <h4 class="widget_title">{{__('Tags')}}</h4>
                          <ul class="list">
                             <li v-for="category in trip.categories">
                                <a class="text-lowercase" href="#">
                                    @if(App::getlocale() == 'es')
                                        @{{category.category_name_es}}
                                    @else
                                        @{{category.category_name_en}}
                                    @endif
                                </a>
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
                          <h4 class="widget_title">{{__('Newsletter')}}</h4>
                          <div>
                             <div class="form-group">
                                <input v-validate="'required|email'" type="email" autocomplete="off" v-model="email_account" name="email" class="form-control" placeholder="{{__('Your mail')}}">
                                <span class="text-danger" style="font-size: 12px;" v-show="errors.has('email')">* @{{ errors.first('email') }}</span>
                              </div>
                             <button class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn newsletter-btn" @click="validate(StoreSubscriber)" type="submit">{{__('Subscribe')}}</button>
                          </div>
                       </aside>
                    </div>
                 </div>
              </div>
           </div>
        </section>
        <!--================ Blog Area end =================-->
    </div>
@endsection

@section('scripts')
<script>
   var trip = {!! json_encode($trip)!!}
   var some_trips = {!! json_encode($some_trips)!!}

   let current_background = homepath + "/tripsImages/" + trip.picture_path + "/" + trip.img_thumbnail;
   $(".bradcam_area").css('background-image', 'url("' + current_background + '")');

   var left_side = new Vue({
      el : '.left-side',
      data : {
         trip : trip,
         comments: trip.comments,
         summernote : null,
         replying : false,
         comment_details : {
            comment : '',
            name : '',
            email : '',
            trip_id : trip.id,
            comment_id : null,
         },
         current_comment_id : null, 
      },
      mounted: function(){
         this.initSummernote();
      },
      computed: {
         CurrentComment: function(){
            var _this = this;
            return this.comments.filter(function(comment){
               return comment.id == _this.current_comment_id;
            })
         }
      },
      methods: {
         add_reply: function(id){
            this.current_comment_id = id;
            this.comment_details.comment_id = id;
            this.replying = true;
         },
         SendComment: function(){
            var _this = this;
            $(".commentForm").LoadingOverlay("show");
            this.comment_details['replying'] = this.replying;
            axios.post(homepath + "/comments/trips/store", {comment_details : this.comment_details, lang : lang}).then(function(response){
               $(".commentForm").LoadingOverlay("hide");
               _this.comment_details.comment = '';
               _this.comment_details.name = '';
               _this.comment_details.email = '';
               Swal.fire({
                     icon: 'success',
                     title: "{{__('Your comment was added')}}!",
                     showConfirmButton: false,
                     timer: 2000
               }).then(function(){
                     _this.errors.clear();
               })
            }).catch(function(error){
               console.log(error);
               $(".commentForm").LoadingOverlay("hide");
            });
         },
         initSummernote: function(){
            var _this = this;
            this.summernote = $('#summernote').summernote({
               airMode: true,
            });
            if(lang == 'es'){
               $('#summernote').summernote('code', this.trip.content_es );
            }else{
               $('#summernote').summernote('code', this.trip.content_en );
            }
            $('#summernote').summernote('disable')
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

   var right_side = new Vue({
      el : '.right-side',
      data : { 
         some_trips : some_trips,
         email_account : null,
      },
      methods: {
         BookNow: function(id){
            window.location.href = homepath + '/destinations/booking/' + id;
            console.log(id);
         },
         StoreSubscriber: function(){
            $(".newsletter-btn").LoadingOverlay("show");
            var _this = this;
            axios.post(homepath + "/admin/maintenance/subscribers/new", {email : this.email_account, lang : lang}).then(function(response){
               _this.email_account = ""
               $(".newsletter-btn").LoadingOverlay("hide");
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
               $(".newsletter-btn").LoadingOverlay("hide");
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
   })

</script>
    
@endsection