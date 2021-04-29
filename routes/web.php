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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('invitation/{token}','InvitationController@acceptInvitation')->name('invite');


Route::group(['middleware' => 'web'], function () {
    //Route::auth();
    Route::get(
        '/',
        [
        'as' => 'login',
        'middleware' => ['web'],
        'uses' => 'Auth\LoginController@showLoginForm']
    );
    //Route::get('accept-email-invitation/{remember_token}','EmailVerificationController@setVerificationStatus')->name('accept-email-invitation');
    Route::get(
        'login',
        [
            'as' => 'login',
            'middleware' => ['web'],
            'uses' => 'Auth\LoginController@showLoginForm']
    );

    Route::get(
        'locked',
        [
            'as' => 'locked',
            'middleware' => ['web'],
            'uses' => 'Auth\LoginController@locked']
    );

    Route::post(
        'login',
        [
            'as' => 'login',
            'middleware' => ['web'],
            'uses' => 'Auth\LoginController@login']
    );

    Route::get(
        'logout',
        [
            'as' => 'logout',
            'uses' => 'Auth\LoginController@logout']
    );

});

Auth::routes([
    'register' => false,
    'reset' => false, // Password Reset Routes...
    'verify' => true, // Email Verification Routes...'register' => false, // Registration Routes...
]);

Route::group( ['middleware' => ['auth','verified']], function() {
    //Route::group(['prefix' => 'admin'], function() {
        Route::group(['prefix' => 'dashboard'], function() {
            Route::get('/','DashboardController@index')->name('dashboard');

            Route::get('/{participant_id}/vote', 'DashboardController@addVoting')->name('dashboard.vote');
            Route::get('/{participant_id}/vote-pengawas','DashboardController@addVotingPengawas')->name('dashboard.vote-pengawas');

            Route::get('/jam-sekarang','DashboardController@getJamSaatIni');
            Route::get('/jam-voting','DashboardController@getJamVoting');

            Route::get('/{id}/data-pemilih', 'DashboardController@viewDataPemilih')->name('dashboard.view');

            Route::get('/refresh','DashboardController@refreshPemilih');
        });

        Route::group(['prefix' => 'positions'], function() {
            Route::get('/','PositionController@index')->name('positions');

            Route::match(['get', 'post'],'/{sistem_id}/create', 'PositionController@addPosition')->name('positions.create');
            Route::match(['get', 'put'],'/{sistem_id}/create/{id}/update', 'PositionController@editPosition')->name('positions.update');
        });

        Route::group(['prefix' => 'participants'], function() {
            Route::get('/','ParticipantController@index')->name('participants');

            Route::match(['get', 'post'],'/{sistem_id}/create', 'ParticipantController@addPosition')->name('participants.create');
            Route::match(['get', 'put'],'/{sistem_id}/create/{id}/update', 'ParticipantController@editPosition')->name('participants.update');
        });

        Route::group(['prefix' => 'members'], function() {
            Route::get('/','MemberController@index')->name('members');

            Route::match(['get', 'post'],'/{sistem_id}/create', 'MemberController@addMember')->name('members.create');
            Route::match(['get', 'put'],'/{sistem_id}/create/{id}/update', 'MemberController@editMember')->name('members.update');

            Route::match(['get', 'post'],'/1/import','MemberController@dapenUpload')->name('members.upload');

            Route::match(['get', 'post'],'/{id}/kirim-undangan','MemberController@sendInvitation')->name('members.send-invitation');
        });

        Route::group(['prefix' => 'schedule'], function() {
            Route::get('/','ScheduleVotingController@index')->name('schedule');

            Route::match(['get', 'post'],'/{sistem_id}/create', 'ScheduleVotingController@addSchedule')->name('schedule.create');
            Route::match(['get', 'put'],'/{sistem_id}/create/{id}/update', 'ScheduleVotingController@editSchedule')->name('schedule.update');

            Route::match(['get', 'post'],'/{id}/mulai', 'ScheduleVotingController@mulaiVoting')->name('schedule.mulai');
            Route::match(['get', 'post'],'/{id}/berhenti', 'ScheduleVotingController@berhentiVoting')->name('schedule.berhenti');
        });

        Route::group(['prefix' => 'undang-member'], function() {
            Route::get('/','ScheduleVotingController@index')->name('undang-member');
        });

        Route::group(['prefix' => 'laporan'], function() {
            
        });
    //});
    
});
