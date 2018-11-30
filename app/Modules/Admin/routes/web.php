<?php
//
//Route::group(['module' => 'Admin', 'middleware' => ['web'], 'namespace' => 'App\Modules\Admin\Controllers'], function() {
//
//    Route::resource('Admin', 'AdminController');
//
//});


Route::group(['module' => 'Admin', 'namespace' => 'App\Modules\Admin\Controllers'], function () {

    Route::group(['middleware' => ['web']], function () {

            Route::get('/reg','AdminController@Register');
            Route::post('/reg','AdminController@Register');

            Route::get('/login','AdminController@login');
            Route::post('/login','AdminController@login');

            Route::get('/dashboard','AdminController@Dashboard');
            Route::post('/dashboard','AdminController@Dashboard');

            Route::get('/search','AdminController@Search');
            Route::post('/search','AdminController@Search');

            Route::get('/sugList','AdminController@SugList');
            Route::post('/sugList','AdminController@SugList');

            Route::get('/sendReq/{id}','AdminController@SendReq');

            Route::get('/home','AdminController@home');
            Route::post('/home','AdminController@home');

            Route::get('/logout','AdminController@logout');





            Route::get('/viewTable','AdminController@viewTable');
            Route::get('/friendList','AdminController@friendList');
            Route::get('/requestData','AdminController@requestData');
            Route::get('/profile/{id}','AdminController@profile');
            Route::get('/mutual/{id}','AdminController@mutual');
            Route::get('/pendingData','AdminController@pendingData');
            Route::get('/pending/{id}','AdminController@conformPending');





//        });
    });

});