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
    Route::get('/about', 'HomeController@about')->name('about');
    Route::get('/destinations', 'HomeController@destinations')->name('destinations');
    Route::get('/destinations/{id}', 'HomeController@single_destinations');
    Route::get('/blog', 'HomeController@blog')->name('blog');
    Route::get('/blog/{id}', 'HomeController@single_blog');
    Route::get('/contact', 'HomeController@contact')->name('contact');
    Route::get('/', 'HomeController@index')->name('index');


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
                Route::get('/', 'SubscriberController@index');
                Route::post('/new', 'SubscriberController@store');
                Route::post('/update/{id}', 'SubscriberController@update');
                Route::get('/broadcast_message', 'SubscriberController@broadcast_message');
                Route::post('/send_broadcast', 'MailController@send_broadcast');

                Route::group(['prefix' => 'file'], function(){
                    Route::post('/broadcast_attachments', 'SubscriberController@broadcast_attachments');
                });
            });
        });
    });



// });