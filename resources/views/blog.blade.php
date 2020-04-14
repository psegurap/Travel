@extends('layouts.app')
@section('title') {{__('Blog')}}@endsection

@section('styles')
    <style>
        .swal2-popup {
            font-size: 0.8rem !important;
        }

        .modal-body {
            overflow-y: auto;
            max-height: calc(100vh - 200px);
        }
    </style>
@endsection

@section('content')
    <!-- bradcam_area  -->
    <div class="bradcam_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="bradcam_text text-center">
                        <h3>blog</h3>
                        <p>Pixel perfect design with awesome contents</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ bradcam_area  -->


    <!--================Blog Area =================-->
    <section class="blog_area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-5 mb-lg-0">
                    <div class="blog_left_sidebar">
                        <article v-for="post in posts['data']" class="blog_item">
                            <div class="blog_item_img">
                                <img class="card-img rounded-0" :src="homepath + '/blogImages/' + post.picture_path + '/' + post.img_thumbnail" :alt="post.img_thumbnail">
                                <a href="#" class="blog_item_date">
                                    <h3>@{{moment(post.created_at).format("D")}}</h3>
                                    <p>@{{moment(post.created_at).format('ddd')}}</p>
                                </a>
                            </div>

                            <div class="blog_details">
                                <a class="d-inline-block" :href="homepath + '/blog/' + post.id">
                                    @if(App::getlocale() == 'es')
                                        <h2>@{{post.title_es}}</h2>
                                    @else
                                        <h2>@{{post.title_en}}</h2>
                                    @endif
                                </a>
                                <p>
                                    {{-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque illo dolor quis incidunt autem ut minus facere, aut enim eveniet? --}}
                                    @if(App::getlocale() == 'es')
                                        @{{ post.short_description_es }}
                                    @else
                                        @{{ post.short_description_en }}
                                    @endif
                                </p>
                                <ul class="blog-info-link">
                                    <li><i class="fa fa-users"></i>
                                        <a v-for="category in post.categories" href="#"> 
                                            <span class="text-capitalize">
                                                @if(App::getlocale() == 'es')
                                                    @{{category.category_name_es}}
                                                @else
                                                    @{{category.category_name_en}}
                                                @endif
                                            </span>
                                        </a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-comments"></i> @{{post.comments.length}} {{__('Comment(s)')}}</a></li>
                                </ul>
                            </div>
                        </article>
                        <nav class="blog-pagination justify-content-center d-flex">
                            <ul class="pagination">
                                <li class="page-item" :class="[posts['prev_page_url'] == null ? 'd-none' : '']">
                                    <a :class="[posts['prev_page_url'] == null ? 'disabled' : 'bg-info']" :href="posts['prev_page_url']" class="page-link" aria-label="Previous">
                                        <i :class="[posts['prev_page_url'] == null ? 'disabled' : 'text-light']" class="ti-angle-left"></i>
                                    </a>
                                </li>
                                <li v-for="page in posts['last_page']" class="page-item">
                                    <a :class="[page == posts['current_page'] ? 'border-0' : '']" :href="homepath + '/blog?page=' + page" class="page-link">@{{page}}</a>
                                </li>
                                
                                <li class="page-item" :class="[posts['next_page_url'] == null ? 'd-none' : '']">
                                    <a :class="[posts['next_page_url'] == null ? 'disabled' : 'bg-info']" :href="posts['next_page_url']" class="page-link" aria-label="Next">
                                        <i :class="[posts['next_page_url'] == null ? 'disabled' : 'text-light']" class="ti-angle-right"></i>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-4">
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
                                    type="submit">{{__('Search')}}</button>
                            </div>
                        </aside>

                        <aside class="single_sidebar_widget post_category_widget">
                            <h4 class="widget_title">Category</h4>
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
                                        <img class="img-fluid" src="img/post/post_5.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="img/post/post_6.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="img/post/post_7.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="img/post/post_8.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="img/post/post_9.png" alt="">
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img class="img-fluid" src="img/post/post_10.png" alt="">
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
    </section>
    <!--================Blog Area =================-->
    @endsection
    
    @section('scripts')
<script>
    var posts = {!! json_encode($posts)!!}
    var pagination = {!! json_encode($posts->links()) !!}
    var categories = {!! json_encode($categories)!!}
    var recent_posts = {!! json_encode($recent_posts)!!}
    var tags = {!! json_encode($tags)!!}

    if(posts['current_page'] > posts['last_page']){
        window.location.href = homepath + '/blog?page=' + posts['last_page'];
    }

   let current_background = homepath + "/blogImages/" + posts.data[0].picture_path + "/" + posts.data[0].img_thumbnail;
   $(".bradcam_area").css('background-image', 'url("' + current_background + '")');


   var main = new Vue({
      el : '.blog_area',
      data : {
        posts : posts,
        recent_posts : recent_posts,
        categories : categories,
        tags : tags,
        search_keyword : '',
        keyword_results : [],
        email_account : '',
      },
      mounted: function(){
        
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
   });

</script>
    
@endsection