@extends('layouts.app')
@section('title')
   @if(App::getlocale() == 'es')
      {{$post->title_es}}
   @else
      {{$post->title_en}}
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
                           <h3>{{$post->title_es}}</h3>
                           @else
                           <h3>{{$post->title_en}}</h3>
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
                                 <li data-target="#carouselGallery" v-for="(picture, index) in post.attachments" :class="[index == 0 ? 'active' : '']" :data-slide-to="index"></li>
                              </ol>
                              <div class="carousel-inner">
                                 <div class="carousel-item" v-for="(picture, index) in post.attachments" :class="[index == 0 ? 'active' : '']">
                                    <img class="d-block w-100" :src="homepath + '/blogImages/' + post.picture_path + '/' + picture">
                                 </div>
                                 
                              </div>
                              <a v-if="post.attachments.length > 1" class="carousel-control-prev" href="#carouselGallery" role="button" data-slide="prev">
                                 <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                 <span class="sr-only">Previous</span>
                              </a>
                              <a v-if="post.attachments.length > 1" class="carousel-control-next" href="#carouselGallery" role="button" data-slide="next">
                                 <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                 <span class="sr-only">Next</span>
                              </a>
                           </div>
                       </div>
                       <div class="blog_details">
                           @if(App::getlocale() == 'es')
                           <h2>@{{post.title_es}}</h2>
                           @else
                           <h2>@{{post.title_en}}</h2>
                           @endif
                          <ul class="blog-info-link mt-3 mb-4">
                             <li><i class="fa fa-users"></i>
                                 <a v-for="category in post.categories" href="#"> 
                                    <span class="text-lowercase">
                                       @if(App::getlocale() == 'es')
                                          #@{{category.category_name_es}}
                                       @else
                                          #@{{category.category_name_en}}
                                       @endif
                                    </span>
                                 </a>
                              </li>
                             <li><a href="#"><i class="fa fa-comments"></i> @{{post.comments.length}} {{__('Comment(s)')}}</a></li>
                          </ul>
                          <textarea id="summernote" data-toolbar="slim"></textarea>
                          
                       </div>
                    </div>
                    <div class="navigation-top">
                       <div class="d-sm-flex justify-content-between text-center">
                          <p class="like-info"><span class="align-middle"><i class="fa fa-heart"></i></span> Lily and 4
                             people like this</p>
                          <div class="col-sm-4 text-center my-2 my-sm-0">
                             <!-- <p class="comment-count"><span class="align-middle"><i class="fa fa-comment"></i></span> 06 Comments</p> -->
                          </div>
                          <ul class="social-icons">
                             <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                             <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                             <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                             <li><a href="#"><i class="fa fa-behance"></i></a></li>
                          </ul>
                       </div>
                       <div class="navigation-area d-none d-md-block">
                          <div class="row">
                             <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                <div class="d-flex" v-if="previous_post != null">
                                   <div class="detials">
                                      <p>{{__('Prev Post')}}</p>
                                      <a :href="homepath + '/blog/' + previous_post.id">
                                       @if (App::getLocale() == 'es')
                                           <h4>@{{previous_post.title_es}}</h4>
                                       @else
                                        <h4>@{{previous_post.title_en}}</h4>
                                       @endif
                                    </a>
                                   </div>
                                </div>
                             </div>
                             <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                <div class="d-flex" v-if="next_post != null">
                                   <div class="detials">
                                      <p>{{__('Next Post')}}</p>
                                      <a :href="homepath + '/blog/' + next_post.id">
                                         @if (App::getLocale() == 'es')
                                             <h4>@{{next_post.title_es}}</h4>
                                         @else
                                          <h4>@{{next_post.title_en}}</h4>
                                         @endif
                                      </a>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="blog-author">
                     <div class="media align-items-center">
                           <img v-if="post.user.img_thumbnail != null" :src="homepath + '/UsersPictures/' + post.user.attach_reference + '/' + post.user.img_thumbnail" alt="">
                           <img v-else :src="homepath + '/img/feedback_picture.jpg'" alt="">
                           <div class="media-body">
                              <a href="javascript:void(0)">
                                 <h4>@{{post.user.name}}</h4>
                              </a>
                              <p>
                                 @if (App::getLocale() == 'es')
                                    @{{post.user.slogan_es}}
                                 @else
                                    @{{post.user.slogan_en}}
                                 @endif
                              </p>
                           </div>
                        </div>
                     </div>
                     <div class="comments-area">
                        <h4>@{{post.comments.length}} {{__('Comment(s)')}}</h4>
                        <div class="comment-list" v-for="comment in post.comments">
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
                        <aside class="single_sidebar_widget search_widget">
                           <div>
                              <div class="form-group search-keyword">
                                 <div class="input-group mb-3">
                                       <input v-model="search_keyword" type="text" class="form-control" placeholder="{{__('Search Keyword')}}">
                                       <div class="input-group-append">
                                          <button class="btn" type="button"><i class="ti-search"></i></button>
                                       </div>
                                 </div>
                              </div>
                              <button @click="SearchForm()" class="button rounded-0 primary-bg text-white w-100 btn_1 boxed-btn"
                                 type="submit">{{__('Search')}}
                              </button>
                           </div>
                        </aside>
                       <aside class="single_sidebar_widget post_category_widget">
                          <h4 class="widget_title">{{__('Categories')}}</h4>
                          <ul class="list cat-list">
                             <li v-for="category in categories">
                                <a href="#" class="d-flex">
                                 @if(App::getlocale() == 'es')
                                    <p>@{{category.category_name_es}}</p>
                                 @else
                                    <p>@{{category.category_name_en}}</p>
                                 @endif
                                   <p>(@{{category.posts.length}})</p>
                                </a>
                             </li>
                          </ul>
                       </aside>
                       <aside class="single_sidebar_widget popular_post_widget">
                          <h3 class="widget_title">{{__('Recent Post')}}</h3>
                          <div class="media post_item" v-for="post in recent_posts">
                             <div class="row">
                                <div class="col-4 px-1">
                                   <img style="width: 100%;" :src="homepath + '/blogImages/' + post.picture_path + '/' + post.img_thumbnail" :alt="post.img_thumbnail">
                                </div>
                                <div class="col-8 px-1">
                                   <div class="media-body">
                                      <a :href="homepath + '/blog/' + post.id">
                                          @if(App::getLocale() == 'es')
                                             <h3>@{{post.title_es}}</h3>
                                          @else
                                             <h3>@{{post.title_en}}</h3>
                                          @endif
                                      </a>
                                      <p>@{{moment(post.created_at, "YYYYMMDD").fromNow()}}</p>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </aside>
                       <aside class="single_sidebar_widget tag_cloud_widget">
                           <h4 class="widget_title">{{__('Tags')}}</h4>
                           <ul class="list">
                              <li v-for="tag in tags">
                                 <a href="#" class="text-lowercase">
                                       @if (App::getLocale() == 'es')
                                          @{{tag.category_name_es}}
                                       @else
                                          @{{tag.category_name_en}}
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
                     <!-- Modal -->
                     <div class="modal fade" id="whereModal" tabindex="-1" role="dialog" aria-labelledby="whereModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                           <div class="modal-content" style="border-radius:0px">
                              <div class="modal-header row mx-0">
                                 <div class="col-md-4">
                                       <span><strong style="color:#FF4A52">{{__('SEARCH')}}:</strong> @{{search_keyword}}</span>
                                 </div>
                              </div>
                              <div class="modal-body">
                                 <div class="recent_trip_area py-0">
                                       <div class="container">
                                          <div class="row mb-3">
                                             <div class="col-12">
                                                   <span>{{__('Results')}}: (@{{keyword_results.length}})</span>
                                             </div>
                                          </div>
                                          <div class="row" v-if="keyword_results.length <= 0">
                                             <div class="col-12">
                                                   <span><strong>{{__('NO RESULTS FOUND')}}</strong></span>
                                             </div>
                                          </div>
                                          <div class="row">
                                             <div v-if="keyword_results.length > 0" v-for="trip in keyword_results" class="col-md-12">
                                                   <div class="single_trip row">
                                                      <div class="col-4 col-lg-2">
                                                         <div class="thumb">
                                                               <img style="width:100%;" :src="homepath + '/blogImages/' + trip.picture_path + '/' + trip.img_thumbnail" alt="">
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
                 </div>
              </div>
           </div>
        </section>
        <!--================ Blog Area end =================-->
    </div>
@endsection

@section('scripts')
<script>
   var post = {!! json_encode($post)!!}
   var tags = {!! json_encode($tags)!!}
   var recent_posts = {!! json_encode($recent_posts)!!}
   var categories = {!! json_encode($categories)!!}
   var next_post = {!! json_encode($next_post)!!}
   var previous_post = {!! json_encode($previous_post)!!}
   

   let current_background = homepath + "/blogImages/" + post.picture_path + "/" + post.img_thumbnail;
   $(".bradcam_area").css('background-image', 'url("' + current_background + '")');

   var left_side = new Vue({
      el : '.left-side',
      data : {
         next_post : next_post,
         previous_post : previous_post,
         post : post,
         comments: post.comments,
         summernote : null,
         replying : false,
         comment_details : {
            comment : '',
            name : '',
            email : '',
            post_id : post.id,
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
            axios.post(homepath + "/comments/posts/store", {comment_details : this.comment_details, lang : lang}).then(function(response){
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
               $('#summernote').summernote('code', this.post.content_es );
            }else{
               $('#summernote').summernote('code', this.post.content_en );
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
         recent_posts : recent_posts,
         email_account : null,
         categories : categories,
         search_keyword : '',
         keyword_results : [],
         tags : tags,
      },
      methods: {
         SearchForm: function(){
               var _this = this;
               $(".search-keyword").LoadingOverlay("show");
               axios.post(homepath + '/search_keyword', {word : this.search_keyword}).then(function(response){
                  if(response.data){
                     _this.keyword_results = response.data
                  }
                  $(".search-keyword").LoadingOverlay("hide");
                  $('#whereModal').modal('show');
               }).catch(function(error){
                  $.toast({
                     heading: 'Error',
                     text: '{{__("Unsuccessful Search")}}',
                     showHideTransition: 'fade',
                     icon: 'error',
                     position : 'top-right'
                  });
                  $(".search-keyword").LoadingOverlay("hide");
                  console.log(error);
               })
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