<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
	//return Redirect::route('dashboard');
	return View::make('welcome');
});



// Route::group(['middleware' => 'guest'], function(){
// 	Route::controller('password', 'RemindersController');
// 	Route::get('login', ['as'=>'login','uses' => 'Auth\AuthController@login']);
// 	Route::get('user/create', ['as'=>'user.create','uses' => 'UsersController@create']);
// 	Route::post('user/store', ['as'=>'user.store','uses' => 'UsersController@store']);
// 	Route::post('login', array('uses' => 'Auth\AuthController@doLogin'));


// 	// social login route
// 	Route::get('login/fb', ['as'=>'login/fb','uses' => 'SocialController@loginWithFacebook']);
// 	Route::get('login/gp', ['as'=>'login/gp','uses' => 'SocialController@loginWithGoogle']);

// });



// Route::group(array('middleware' => 'auth'), function()
// {

// 	Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
// 	Route::get('profile', ['as' => 'profile', 'uses' => 'UsersController@profile']);
// 	Route::get('dashboard', array('as' => 'dashboard', 'uses' => 'Auth\AuthController@dashboard'));
// 	Route::get('change-password', array('as' => 'password.change', 'uses' => 'Auth\AuthController@changePassword'));
// 	Route::post('change-password', array('as' => 'password.doChange', 'uses' => 'Auth\AuthController@doChangePassword'));


// });


//all women news 
Route::get('all',function(){
	
	return \App\Crawler::where('overall',1)->count();
});


//bad news 
Route::get('bad',function(){
	return \App\Crawler::where('overall',1)
		->where('is_goodOrBad',1)
		//->count();
		->get();
});


//good news 
Route::get('good',function(){
	return \App\Crawler::where('overall',1)
		->where('is_goodOrBad',0)
		//->count();
		->get();
});



Route::get('group',function(){
	$types = \App\Crawler::where('overall',1)
		//->where('is_goodOrBad',0)
		   ->select('type', \DB::raw('count(id) as news'))
            ->groupBy('type')
            ->get();

      //return  $types->lists('news');
      return  $types->lists('type');
            
});





//carwler divider
Route::get('prothomAloLinks', ['uses' => 'CrawlerController@prothomAloLinks']);
Route::get('prothomAloDetails', ['uses' => 'CrawlerController@prothomAloDetails']);

//all process for news crawling
Route::get('search-women-news', ['uses' => 'CrawlerController@all']);
Route::get('prothomAlo', ['uses' => 'CrawlerController@prothomAlo']);


//Divide women news form all news 
Route::get('womenNews', ['uses' => 'AnalyzeController@areWomenNews']);

//Divide the good news and bad news from all women news 
Route::get('newsBadOrGood', ['uses' => 'AnalyzeController@areGoodOrBad']);


//Divide the good news into different category 
Route::get('goodNewsCategorized', ['uses' => 'AnalyzeController@goodNewsCategorized']);


//Divide the bad news into different category 
Route::get('badNewsCategorized', ['uses' => 'AnalyzeController@badNewsCategorized']);


//Define Final type for each women news 
Route::get('setType', ['uses' => 'AnalyzeController@setType']);


//all data and 
Route::get('index', ['as' => 'dashboard','uses' => 'GraphController@indexPage']);


//test 
Route::get('testing', ['as' => 'testing','uses' => 'GraphController@testing']);
