<?php

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING); 
}

Auth::routes();

// super admin route
Route::get('/home', 'HomeController@index')->name('home'); 

// cashier route
Route::get('/cashier', 'CashierController@cashier')->name('cashier');

// national admin route
Route::get('/nationaladmin', 'NationalAdminController@nationalAdmin')->name('nationaladmin');

// overload entry clerk route
Route::get('/overloadentryclerk', 'OverloadEntryClerkController@overLoadEntryClerk')->name('overloadentryclerk');

// reginal admin route
Route::get('/regionaladmin', 'RegionalAdminController@regionalAdmin')->name('regionaladmin');

// station admin route
Route::get('/stationadmin', 'StationAdminController@stationAdmin')->name('stationadmin');

// weighing officer route
Route::get('/weighingofficer', 'WeighingOfficerController@weighingOfficer')->name('weighingofficer');


// User Routes
Route::group(['namespace'=>'User'],function(){

	// station routes
    Route::resource('user/station','StationController');

    // commodity routes
    Route::resource('user/commodity','CommodityController');

    // height routes
    Route::resource('user/height','HeightController');

    // vehicletype routes
    Route::resource('user/vehicletype','VehicleTypeController');
    
    // transaction routes
    Route::resource('user/transaction','TransactionController');

    Route::get('user/vehicle', 'TransactionController@vehicleDetails')->name('vehicleDetails');

    Route::get('/blacklisted', 'TransactionController@blacklisted')->name('vehicleBlacklisted');

    Route::get('transaction/invoice', 'TransactionController@invoice')->name('invoice');

    // region routes
    Route::resource('user/region','RegionController');

    // user routes
    Route::resource('user/user','UserController');

    // role routes
    Route::resource('user/role','RoleController');

    // permission routes
    Route::resource('user/permission','PermissionController');
    
    // fine routes
    Route::resource('user/fine','FineController');

    // finetype routes
    Route::resource('user/finetype','FineTypeController');

    // system routes
    Route::resource('user/system','SystemController');

    // overload routes
    Route::resource('user/overloadcases','OverloadCaseController');

    Route::get('/overload', 'OverloadCaseController@overload')->name('overload');

    Route::get('transactionfines/reciept', 'OverloadCaseController@invoice')->name('reciept');

    // settings routes
    Route::get('user/settings','SettingsController@index')->name('settings');

    Route::patch('user/settings','SettingsController@update')->name('settings.update');

    // transaction enquiry routes
    Route::get('user/weighing/enquiry','EnquiryController@weighingEnquiry')->name('weighing.enquiry');

    Route::get('user/weighingenquiry/{weighingdetaials}','EnquiryController@weighingDetails')->name('weighing.show');

    Route::get('user/fines/enquiry','EnquiryController@finesEnquiry')->name('fines.enquiry');

    Route::get('user/finesenquiry/{finedetaials}','EnquiryController@finesDetails')->name('fines.show');
    
    // blacklist routes
    Route::resource('user/blacklist','BlacklistedController');

    Route::post('user/{update}/blacklist','BlacklistedController@arrest')->name('arrest.update');

    // reports routes
    Route::get('user/report/technical','TechnicalReportController@technical')->name('technical');
    
    // station report grouped by vehicle type detailed
    Route::get('report/technical/detailedvehicletype','TechnicalReportController@detailedVehicleType')->name('detailedvehicletype');

    Route::post('technical/searchdetailedvehicletype','TechnicalReportController@searchDetailedVehicleType')->name('searchdetailedvehicletype');
    
    // station report grouped by attendant detailed
    Route::get('report/technical/detailedattendant','TechnicalReportController@detailedAttendant')->name('detailedattendant');

    Route::post('technical/searchdetailedattendant','TechnicalReportController@searchDetailedAttendant')->name('searchdetailedattendant');
    
    // station report grouped by vehicle type summary
    Route::get('report/technical/summaryvehicletype','TechnicalReportController@summaryVehicleType')->name('summaryvehicletype');

    Route::post('technical/searchsummaryvehicletype','TechnicalReportController@searchSummaryVehicleType')->name('searchsummaryvehicletype');

    // regional report grouped by vehicle type summary
    Route::get('report/technical/regionalsummaryvehicletype','TechnicalReportController@regionalSummaryVehicleType')->name('regionalsummaryvehicletype');

    Route::post('technical/searchregionalsummaryvehicletype','TechnicalReportController@searchRegionalSummaryVehicleType')
    ->name('searchregionalsummaryvehicletype');

    // national report grouped by vehicle type summary
    Route::get('report/technical/nationalsummaryvehicletype','TechnicalReportController@nationalSummaryVehicleType')->name('nationalsummaryvehicletype');

    Route::post('technical/searchnationalsummaryvehicletype','TechnicalReportController@searchNationalSummaryVehicleType')
    ->name('searchnationalsummaryvehicletype');
    
    // station report grouped by attendant summary
    Route::get('report/technical/summaryattendant','TechnicalReportController@summaryAttendant')->name('summaryattendant');

    Route::post('technical/searchsummaryattendant','TechnicalReportController@searchSummaryAttendant')->name('searchsummaryattendant');
    
    // regional report grouped by attendant summary
    Route::get('report/technical/regionalsummaryattendant','TechnicalReportController@regionalSummaryAttendant')->name('regionalsummaryattendant');

    Route::post('technical/searchregionalsummaryattendant','TechnicalReportController@searchRegionalSummaryAttendant')->name('searchregionalsummaryattendant');
    
    // national report grouped by attendant summary
    Route::get('report/technical/nationalsummaryattendant','TechnicalReportController@nationalSummaryAttendant')->name('nationalsummaryattendant');

    Route::post('technical/searchnationalsummaryattendant','TechnicalReportController@searchNationalSummaryAttendant')->name('searchnationalsummaryattendant');
});