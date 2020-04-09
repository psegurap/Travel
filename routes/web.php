<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//------------------ COJEFAV ------------------------//
Route::get('/cojefavsomostodos', 'ConfraController@index');
Route::get('/cojefavsomostodos/create', 'ConfraController@index');

Route::group(['prefix' => 'cojefavsomostodos'], function(){
    Route::get('/', 'ConfraController@index');
    Route::get('admin', 'ConfraController@maintenanceView');
    Route::post('create', 'ConfraController@store');
});

// Route::middleware(['house'])->group(function () {

    //------------------ Some Auth Routes -------------------------//

    Route::get('/registered', function(){
        return view('auth.registered');
    });


    
    //------------------ Routes for principal pages ----------------//
    Route::get('/', 'HomeController@index')->name('index');
    Route::post('/where_search', 'HomeController@where_search');
    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/destinations', 'HomeController@destinations')->name('destinations');
    Route::get('/destinations/{id}', 'HomeController@single_destinations');
    Route::post('/destinations/more_destinations', 'HomeController@load_more_destinations');
    Route::get('/blog', 'HomeController@blog')->name('blog');
    Route::get('/blog/{id}', 'HomeController@single_blog');
    Route::get('/contact', 'HomeController@contact')->name('contact');
    
    Route::get('/destinations/booking/{id}', 'HomeController@booking');
    Route::post('/destinations/booking/save_booking', 'HomeController@save_booking');
    Route::get('/bookingmail', function(){
        return view('mail.reservation_created');
    });

    Route::post('/store_quick_feedback', 'LayoutsController@store_quick_feedback');
    Route::group(['prefix' => 'file'], function(){
        Route::post('/quick_feedback_attachment', 'LayoutsController@quick_feedback_store_attachment');
    });

    Route::group(['prefix' => 'file'], function(){
        Route::post('/quick_feedback_attachment', 'LayoutsController@quick_feedback_store_attachment');
    });

    //---------------- All comments route ---------------------//
    Route::group(['prefix' => 'comments'], function(){
        Route::group(['prefix' => 'trips'], function(){
            Route::post('/store', 'CommentsController@store_comment');
        });
        Route::post('/quick_feedback_attachment', 'LayoutsController@quick_feedback_store_attachment');
    });


    //----------------- Translations -------------------------//
    Route::get('/changeLanguage/{locale}', function($locale){
        App::setlocale($locale);
        session()->put('locale',$locale);
        return redirect()->back();
    });


    //---------------- Authenticate Routes --------------------//
    Auth::routes();


    //--------------------- Mail Routes ----------------------//
    Route::post('/sendContactEmail', 'MailController@SendContactMail');


    //---------------- Admin Routes -------------------------//
    Route::group(['prefix' => 'admin'], function(){
        Route::get('home', function(){
            return view('admin.home_admin');
        })->middleware('auth')->name('admin');

        Route::group(['prefix' => 'reservations'], function(){
            Route::get('/', 'ReservationController@all_reservations')->name('reservations');
        });

        Route::group(['prefix' => 'user'], function(){
            Route::get('/', 'UserController@index')->name('user_panel');
            Route::post('/update_profile', 'UserController@update_profile');

            Route::group(['prefix' => 'file'], function(){
                Route::post('/store_picture', 'UserController@store_picture');
            });
        });


        Route::group(['prefix' => 'trips'], function(){
            Route::get('all', 'TripsController@all_trips');
            Route::get('create', 'TripsController@create');
            Route::post('store', 'TripsController@store');
            Route::get('edit/{id}', 'TripsController@edit');
            Route::post('update', 'TripsController@update');
            Route::post('file/default', 'TripsController@StoreDefault');
            Route::post('file/galery', 'TripsController@StoreGalery');
            Route::post('file/DeletePicture', 'TripsController@DeletePicture');
        });

        Route::group(['prefix' => 'blog'], function(){
            Route::get('all', 'BlogController@all_posts');
            Route::get('create', 'BlogController@create');
            Route::post('store', 'BlogController@store');
            Route::get('edit/{id}', 'BlogController@edit');
            Route::post('update', 'BlogController@update');
            Route::post('file/default', 'BlogController@StoreDefault');
            Route::post('file/galery', 'BlogController@StoreGalery');
            // Route::post('file/DeletePicture', 'BlogController@DeletePicture');
        });

        Route::group(['prefix' => 'maintenance'], function(){
            Route::group(['prefix' => 'categories'], function(){
                Route::get('/', 'CategoriesController@index');
                Route::post('/store', 'CategoriesController@store');
                Route::post('/update/{id}', 'CategoriesController@update');
                Route::post('/delete/{id}', 'CategoriesController@delete');
            });

            Route::group(['prefix' => 'subscribers'], function(){
                Route::get('/', 'SubscriberController@index')->middleware('auth');
                Route::post('/new', 'SubscriberController@store');
                Route::post('/update/{id}', 'SubscriberController@update')->middleware('auth');
                Route::get('/broadcast_message', 'SubscriberController@broadcast_message')->middleware('auth');
                Route::post('/send_broadcast', 'MailController@send_broadcast')->middleware('auth');

                Route::group(['prefix' => 'file'], function(){
                    Route::post('/broadcast_attachments', 'SubscriberController@broadcast_attachments')->middleware('auth');
                });
            });

            Route::group(['prefix' => 'layouts'], function(){
                Route::get('/quick_feedbacks', 'LayoutsController@all_quick_feedbacks');
                Route::post('/update/{id}', 'LayoutsController@update_feedback')->middleware('auth');
            });
        });
    });



// });