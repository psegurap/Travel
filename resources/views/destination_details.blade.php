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
                       {{-- <div class="navigation-area d-none d-md-block">
                          <div class="row">
                             <div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
                                <div class="d-flex" v-if="previous_trip != null">
                                   <div class="detials">
                                      <p>Prev Post</p>
                                      <a :href="homepath + '/blog/' + previous_trip.id">
                                       @if (App::getLocale() == 'es')
                                           <h4>@{{previous_trip.title_es}}</h4>
                                       @else
                                        <h4>@{{previous_trip.title_en}}</h4>
                                       @endif
                                    </a>
                                   </div>
                                </div>
                             </div>
                             <div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
                                <div class="d-flex" v-if="next_trip != null">
                                   <div class="detials">
                                      <p>Next Post</p>
                                      <a :href="homepath + '/blog/' + next_trip.id">
                                         @if (App::getLocale() == 'es')
                                             <h4>@{{next_trip.title_es}}</h4>
                                         @else
                                          <h4>@{{next_trip.title_en}}</h4>
                                         @endif
                                      </a>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div> --}}
                    </div>
                    <div class="blog-author">
                       <div class="media align-items-center">
                          <img src="{{asset('/img/blog/author.png')}}" alt="">
                          <div class="media-body">
                             <a href="#">
                                <h4>Harvard milan</h4>
                             </a>
                             <p>Second divided from form fish beast made. Every of seas all gathered use saying you're, he
                                our dominion twon Second divided from</p>
                          </div>
                       </div>
                    </div>
                    <div class="comments-area">
                       <h4>05 Comments</h4>
                       <div class="comment-list">
                          <div class="single-comment justify-content-between d-flex">
                             <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                   <img src="{{asset('/img/comment/comment_1.png')}}" alt="">
                                </div>
                                <div class="desc">
                                   <p class="comment">
                                      Multiply sea night grass fourth day sea lesser rule open subdue female fill which them
                                      Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                                   </p>
                                   <div class="d-flex justify-content-between">
                                      <div class="d-flex align-items-center">
                                         <h5>
                                            <a href="#">Emilly Blunt</a>
                                         </h5>
                                         <p class="date">December 4, 2017 at 3:12 pm </p>
                                      </div>
                                      <div class="reply-btn">
                                         <a href="#" class="btn-reply text-uppercase">reply</a>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                       <div class="comment-list">
                          <div class="single-comment justify-content-between d-flex">
                             <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                   <img src="{{asset('/img/comment/comment_2.png')}}" alt="">
                                </div>
                                <div class="desc">
                                   <p class="comment">
                                      Multiply sea night grass fourth day sea lesser rule open subdue female fill which them
                                      Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                                   </p>
                                   <div class="d-flex justify-content-between">
                                      <div class="d-flex align-items-center">
                                         <h5>
                                            <a href="#">Emilly Blunt</a>
                                         </h5>
                                         <p class="date">December 4, 2017 at 3:12 pm </p>
                                      </div>
                                      <div class="reply-btn">
                                         <a href="#" class="btn-reply text-uppercase">reply</a>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                       <div class="comment-list">
                          <div class="single-comment justify-content-between d-flex">
                             <div class="user justify-content-between d-flex">
                                <div class="thumb">
                                   <img src="{{asset('/img/comment/comment_3.png')}}" alt="">
                                </div>
                                <div class="desc">
                                   <p class="comment">
                                      Multiply sea night grass fourth day sea lesser rule open subdue female fill which them
                                      Blessed, give fill lesser bearing multiply sea night grass fourth day sea lesser
                                   </p>
                                   <div class="d-flex justify-content-between">
                                      <div class="d-flex align-items-center">
                                         <h5>
                                            <a href="#">Emilly Blunt</a>
                                         </h5>
                                         <p class="date">December 4, 2017 at 3:12 pm </p>
                                      </div>
                                      <div class="reply-btn">
                                         <a href="#" class="btn-reply text-uppercase">reply</a>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                    <div class="comment-form">
                       <h4>Leave a Reply</h4>
                       <form class="form-contact comment_form" action="#" id="commentForm">
                          <div class="row">
                             <div class="col-12">
                                <div class="form-group">
                                   <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9"
                                      placeholder="Write Comment"></textarea>
                                </div>
                             </div>
                             <div class="col-sm-6">
                                <div class="form-group">
                                   <input class="form-control" name="name" id="name" type="text" placeholder="Name">
                                </div>
                             </div>
                             <div class="col-sm-6">
                                <div class="form-group">
                                   <input class="form-control" name="email" id="email" type="email" placeholder="Email">
                                </div>
                             </div>
                             <div class="col-12">
                                <div class="form-group">
                                   <input class="form-control" name="website" id="website" type="text" placeholder="Website">
                                </div>
                             </div>
                          </div>
                          <div class="form-group">
                             <button type="submit" class="button button-contactForm btn_1 boxed-btn">Send Message</button>
                          </div>
                       </form>
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
                          <h4 class="widget_title">Newsletter</h4>
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
         summernote : null,
      },
      mounted: function(){
         this.initSummernote();
      },
      methods: {
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