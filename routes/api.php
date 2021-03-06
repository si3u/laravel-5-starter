<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/*
|------------------------------------------
| PUBLIC API
|------------------------------------------
*/
Route::group(['namespace' => 'Api'], function () {
	
    // notifications
    Route::group(['prefix' => 'notifications',], function () {
        Route::post('/{user}', 'NotificationsController@index');
        Route::post('/{user}/unread', 'NotificationsController@unread');
        Route::post('/{user}/read/{notification}', 'NotificationsController@read');

        Route::post('/actions/latest', 'NotificationsController@getLatestActions');
    });

    // analytics
    Route::group(['prefix' => 'analytics'], function () {
        Route::post('/keywords', 'AnalyticsController@getKeywords');
        Route::post('/referrers', 'AnalyticsController@getReferrers');
        Route::post('/visitors', 'AnalyticsController@getVisitors');
        Route::post('/browsers', 'AnalyticsController@getBrowsers');
        Route::post('/visited-pages', 'AnalyticsController@getVisitedPages');
        Route::post('/unique-visitors', 'AnalyticsController@getUniqueVisitors');
        Route::post('/bounce-rate', 'AnalyticsController@getBounceRate');
        Route::post('/page-load', 'AnalyticsController@getAvgPageLoad');
        Route::post('/active-visitors', 'AnalyticsController@getActiveVisitors');
        Route::post('/visitors-views', 'AnalyticsController@getVisitorsAndPageViews');

        Route::post('/devices', 'AnalyticsController@getDevices');
        Route::post('/device-category', 'AnalyticsController@getDeviceCategory');
        Route::post('/gender', 'AnalyticsController@getUsersGender');
        Route::post('/age', 'AnalyticsController@getUsersAge');
        Route::post('/positions', 'AnalyticsController@getUsersPositions');

        Route::post('/interests-affinity', 'AnalyticsController@getInterestsAffinity');
        Route::post('/interests-market', 'AnalyticsController@getInterestsMarket');
        Route::post('/interests-other', 'AnalyticsController@getInterestsOther');
       
    });
	
    // Create Directory for Actus & Articles
    Route::get('/createDirectory/{type}/{dir}', 'CreateDirectoryController@create');
	
    // Force Delete User Invited for ReSend Invitation
    Route::post('/invited/resend/{email}/delete', 'UsersController@destroyForReSend');
	
    // Toggle Tags
    Route::get('/toggle-tag/{model}/{item_id}/{tag_slug}', 'TagsController@toggleStatus');
	
    // Sitemap Builder
    Route::get('/sitemap-builder', 'SitemapController@builder');
});
