<?php


use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;


/*
|----------------------------------------------------------------------`----
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('admin.index');
// });

Route::any('clear-guest', 'HomeController@clearGuest');


Route::any('test-route', 'HomeController@routeTest');



//stripe




Route::get('stripe','StripeController@stripe');

Route::any('payment', 'StripeController@payment');


Route::any("cancel_membership","StripeController@cancel_subscription")->name('cancel_membership');

Route::post('stripe','StripeController@stripePost')->name('stripe.post');
Route::get('payment/stripe/status/{id}', 'StripeController@status')->name('stripe.status');
Route::any("payment/stripe/failed","StripeController@failed")->name('failed');











Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index')->name('home');

Route::any('/guidelines', 'HomeController@guideLines');

Route::any('login-register', 'TestController@registerUserLoign')->name('login-register');


Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');


    Route::view('live', 'live')->name('live');



Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware('playSessionCheck')->group(function(){

    Route::any('/', 'HomeController@index')->name('index');
    Route::get('/home-background', 'HomeController@homeBackground');
    Route::any('/article/{id}','HomeController@article')->name("view.article");
    Route::get('/category/{name}','HomeController@category');
    Route::get('/sections/{name}','HomeController@sectionListing');
    Route::get('/search','HomeController@search');
    Route::get('/contest','HomeController@contest');
    Route::get('/contest-detail/{id}','PublisherController@contestDetail')->name("playContestQuiz");
    Route::get('/section/{name}','HomeController@sectionBasedPosts');
    Route::get('/sport/{name}','HomeController@sportsBasedPosts');
    Route::post('/subscribe-mailchimp','HomeController@subscribeMailChimp');
    Route::any('/profile/{id}','HomeController@profile')->name("my.profile");
    Route::post('/accept-terms','HomeController@acceptTerms');
    Route::post('/update-profile','HomeController@updateProfile')->middleware('verified');
    Route::any('/profile-pic','HomeController@profilePicUpload');
    Route::get('/load-menu','HomeController@loadMenu');
    Route::post('/save-contest-answer','PublisherController@saveContestAnswer')->name("saveContestAnswer");
    Route::get('/enter-contest/{id}','PublisherController@enterContest')->name("enterContest");
    Route::post('/username','HomeController@username');

});

Route::get('/home',function (){
    return redirect('/');
});

Route::get('wp-imp', "HomeController@wpUserCreate");
Route::get('invite/{id}', "HomeController@inviteFriend");
Route::get('refer-terms', "HomeController@referTerms");
Route::get('/athlete_registration_form', "HomeController@athleteRegistration");


Route::get('/live-score','WidgetController@liveScore')->name('live-score');
Route::post('/match-info/','WidgetController@matchInfo');
Route::post('/compititionmatch','WidgetController@footBallMatchesList');
Route::get('/play','HomeController@games')->name('play-game');
Route::prefix('play')->group(function(){
    Route::prefix('game')->group(function(){
        Route::get('/detail/{id}','HomeController@gameDetail')->name('game-detail');
        Route::get('/enter/{id}','PublisherController@enterGame')->name("enterGame");
        Route::get('/leaderboard/{id?}','PublisherController@gameLeaderboard');
        Route::any('/winner_leaderboard/{id}','PublisherController@winnerLeaderboard')->name("winnerlist");
        Route::get('/start/{id}','PublisherController@startGame')->name("playGameQuiz");
        Route::post('/save-answer','PublisherController@saveGameAnswer')->name("saveGameAnswer");
    });
});

Route::get('/get-tags', 'OtherController@getTags')->middleware('verified');
Route::get('/post','PublisherController@post')->middleware('auth');
Route::post('/post','PublisherController@postSubmit')->middleware('verified');
Route::any('/edit-post/{id}','PublisherController@editPost')->middleware('verified');
Route::post('/article-image-upload','PublisherController@articleImageUpload')->middleware('verified');

/*Sportsgram image upload */
Route::get('/sportsgram','HomeController@sportsgram')->name("sportsgram");
Route::post('/upload-sportsgram-image','PublisherController@uploadSportsgramImage')->name("uploadSportsgramImage")->middleware('auth');
Route::post('/delete-sportsgram-image','PublisherController@deleteSportsgramImage')->name("deleteSportsgramImage")->middleware('auth');
Route::any('/image-post','PublisherController@imagePostSubmit')->middleware('verified');
Route::any('/sportsgram/{slug}','HomeController@imagePostDetail')->name("sportsgramDetail");

/*Sportsgram image upload */
/*Route::any('/sections/{name}','HomeController@communityDetail');*/



Route::middleware('auth:web', 'throttle:1,5')->group(function () {
        Route::any('/otprequest', 'HomeController@otpRequest')->middleware('verified');

});


/*Rss feed*/
Route::feeds();




Route::post('/usernamevalidate','HomeController@usernamevalidate');
Route::any('/withdrawltoken','HomeController@withdrawalToken')->middleware('auth');


Route::prefix('store')->group(function () {
    Route::any('/', 'HomeController@fetchProduct')->name('store');
    Route::get('/{id}', 'HomeController@ProductDetail');
    //Route::get('/products/{id}', 'HomeController@placeOrder');
    /*Route::any('/product/checkout', 'HomeController@Checkout')->name('productCheckout');*/
    Route::any('/product/checkout', 'HomeController@PlaceOrderByToken')->middleware('auth')->name('PlaceOrderByToken');
    Route::any('/cart/detail', 'HomeController@cartDetail')->name('cartDetail')->middleware('auth');
    Route::any('/additemscart', 'HomeController@addtoCart')->name('addtoCart')->middleware('auth');
    Route::any('/order/success', 'HomeController@orderSuccess')->name('orderSuccess')->middleware('auth');
    Route::delete('/delete/{product}', 'HomeController@destory')->name('destory');
});




Route::prefix('dashboard')->group(function () {
    Route::get('/', 'AdminController@index');


    /*countries and plans*/

        Route::get('countries', 'CountryPlanController@index')->name('cp.index');
        Route::get('countries/create',  'CountryPlanController@create') ->name('cp.create');
        Route::get('countries/edit/{id}','CountryPlanController@edit')  ->name('cp.edit');
        Route::POST('countries/save',   'CountryPlanController@save')   ->name('cp.save');


    /*---end----*/




    Route::any('post-pending', 'AdminController@postPending');
    Route::any('post-ajax', 'AdminController@PendingAjax')->name('post-ajax');
    Route::any('contest', 'AdminController@contest');
    Route::any('contest-ajax', 'AdminController@contestAjax')->name('contest-ajax');
    Route::any('game', 'AdminController@game');
    Route::any('game-get', 'AdminController@gameGet')->name('game-get');
    Route::any('view-questions/{id}', 'AdminController@viewQuestions');
    Route::any('view-game-questions/{id}', 'AdminController@viewGameQuestions');
    Route::any('import-game-questions/{id}', 'AdminController@importGameQuestions');
    Route::any('add-questions/{id}', 'AdminController@addSpecificQuestions');
    Route::any('add-game-questions/{id}', 'AdminController@addGameQuestions');
    Route::any('edit-question/{id}', 'AdminController@editSpecificQuestion');
    Route::any('edit-game-question/{id}', 'AdminController@editGameQuestion');
    Route::any('add-contest', 'AdminController@addContest');
    Route::any('add-game', 'AdminController@addGames');
    Route::any('edit-contest/{id}', 'AdminController@addGames');
    Route::any('edit-game/{id}', 'AdminController@editGame');
    Route::get('preview-post/{id}', 'AdminController@previewPost');
    Route::any('edit-post/{id}', 'AdminController@editPost');
    Route::post('/notification', 'AdminController@newPost');
    Route::any('/users', 'AdminController@users');
    Route::any('/postlisting', 'AdminController@postListing');
    Route::get('/token-request', 'AdminController@tokenRequest');
    Route::any('/site-setting', 'AdminController@siteSetting');
    Route::any('/tokenapprove', 'AdminController@tokenApprove');
    Route::any('/community-users', 'AdminController@communityUsers')->name('communityUsers');
    Route::any('/community-users-ajax', 'AdminController@communityUsersAjax')->name('communityUsersAjax');
    Route::prefix('products')->group(function (){
        Route::any('/', 'AdminController@products');
        Route::any('/add', 'AdminController@addProduct');
        Route::any('/edit/{id}', 'AdminController@editProduct');
    });

    Route::prefix('store')->group(function (){
        Route::prefix('category')->group(function (){
            Route::any('/', 'AdminController@storeCategory')->name('store.category');
            Route::get('search', 'AdminController@searchStoreCategory')->name('store.category.search');
        });
    });

});

Route::view("/mastercard","mastercard");

/************ woo  Commerce /*********************/
Route::get("wpcheck", function(){
    $path = "https://www.sportco.io/wordpress/?download_file=88&order=wc_order_pTZJSTKLR8b1q&email=neerajbhatt833%40gmail.com&key=d1cd59ef-b0e8-4ba9-b28d-fff77898972b";
    $filename = "file.pdf";
    header('Content-Transfer-Encoding: binary');  // For Gecko browsers mainly
    //header('Last-Modified: ' . gmdate('D, d M Y H:i:s', filemtime($path)) . ' GMT');
    header('Accept-Ranges: bytes');  // For download resume
    //header('Content-Length: ' . filesize($path));  // File size
    header('Content-Encoding: none');
    header('Content-Type: application/pdf');  // Change this mime type if the file is not PDF
    header('Content-Disposition: attachment; filename=' . $filename);  // Make the browser display the Save As dialog
    readfile($path);
});

