<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomToRentController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\CustomerProductController;
use Modules\Crm\Http\Controllers\CampaignController;
use App\Http\Controllers\ServiceWantedCustomerController;
use App\Http\Controllers\PropertyWantedCustomerController;

// Customer route


// Route::group(['middleware' => ['web', 'authh', 'SetSessionData', 'auth', 'language', 'timezone', 'ContactSidebarMenu', 'CheckContactLogin'], 'prefix' => 'contact',], function () {
Route::group(['middleware' => ['checkCustomer'], 'prefix' => 'contact',], function () {
    Route::get('/property-wanted-create', [PropertyWantedCustomerController::class, 'createPropertyPage'])->name('property.add.page');
    Route::post('/property-wanted-store', [PropertyWantedCustomerController::class, 'storeProperty']);
    Route::resource('/property-wanted', PropertyWantedCustomerController::class);
    Route::resource('/service_wanted', ServiceWantedCustomerController::class);
    Route::get('/show-occupants-details-inputs', [PropertyWantedCustomerController::class, 'showOccupantsDetailsInputs']);
    Route::get('/show-occupants-details-inputs-create', [PropertyWantedCustomerController::class, 'showOccupantsDetailsInputsCreate']);
    Route::get('/show-room-details-inputs', [PropertyWantedCustomerController::class, 'showRoomDetailsInputs']);
    Route::get('/show-property-delete-modal', [PropertyWantedCustomerController::class, 'showPropertyDeleteModal']);
    Route::get('/confirm-property-delete', [PropertyWantedCustomerController::class, 'confirmPropertyDelete']);
    Route::get('/show-property-edit-modal', [PropertyWantedCustomerController::class, 'showPropertyEditModal']);
    Route::post('/update-property-wanted', [PropertyWantedCustomerController::class, 'updatePropertyWanted']);
    Route::post('/property-wanted/upgrade', [PropertyWantedCustomerController::class, 'propertyWantedUpgradePage']);

    Route::get('/products', [CustomerProductController::class, 'getPurchaseList']);
    Route::get('/single-order-details-show', [CustomerProductController::class, 'single'])->name('customer.order.show.details');
    Route::get('/single-order-details-print', [CustomerProductController::class, 'printInvoice'])->name('customer.order.print.details');

    Route::get('/my-information/{id}', [RecruitmentController::class, 'showCustomer'])->name('customer.recruitment.showCustomer');
    Route::get('/my-applications', [RecruitmentController::class, 'appliedJobsCustomer'])->name('recruitment.appliedJobsCustomer');

    Route::get('/show-student-info-container-edit', [PropertyWantedCustomerController::class, 'showStudentInfoContainerEdit']);
    Route::get('/show-student-info-container-create', [PropertyWantedCustomerController::class, 'showStudentInfoContainerCreate']);
    Route::get('/show-second-step', [PropertyWantedCustomerController::class, 'showSecondStep']);
    Route::get('/show-edit-second-step', [PropertyWantedCustomerController::class, 'showEditSecondStep']);

    Route::get('/check-advert-title/{data}', [PropertyWantedCustomerController::class, 'checkAdvertTitle']);

    Route::get('/rough-test', function () {
        return view('rough.rough');
    });
});

Route::group(['middleware' => ['checkCustomer'], 'prefix' => 'contact', 'namespace' => 'Modules\Crm\Http\Controllers'], function () {
    // Route::group(['prefix' => 'contact', 'namespace' => 'Modules\Crm\Http\Controllers'], function () {
    Route::resource('contact-dashboard', 'DashboardController');
    Route::get('contact-profile', 'ManageProfileController@getProfile');
    Route::post('contact-password-update', 'ManageProfileController@updatePassword');
    Route::post('contact-profile-update', 'ManageProfileController@updateProfile');
    Route::get('contact-purchases', 'PurchaseController@getPurchaseList');
    Route::get('contact-sells', 'SellController@getSellList');
    Route::get('contact-ledger', 'LedgerController@index');
    Route::get('contact-get-ledger', 'LedgerController@getLedger');
    Route::resource('bookings', 'ContactBookingController');
    Route::resource('order-request', 'OrderRequestController');
    // Route::get('/property-wanted', 'PropertyWantedController@showPropertyForm');
    // Route::post('/save-property-wanted', 'PropertyWantedController@saveProperty')->name('user.save.property.wanted');
    Route::get('products/list', '\App\Http\Controllers\ProductController@getProducts');
    Route::get('order-request/get_product_row/{variation_id}/{location_id}', 'OrderRequestController@getProductRow');
});

Route::group(['middleware' => ['web', 'authh', 'auth', 'SetSessionData', 'language', 'timezone', 'AdminSidebarMenu', 'CheckUserLogin'], 'namespace' => 'Modules\Crm\Http\Controllers', 'prefix' => 'crm'], function () {
    Route::get('all-contacts-login', 'ContactLoginController@allContactsLoginList');
    Route::resource('contact-login', 'ContactLoginController')->except(['show']);
    Route::resource('follow-ups', 'ScheduleController');
    Route::get('todays-follow-ups', 'ScheduleController@getTodaysSchedule');
    Route::get('lead-follow-ups', 'ScheduleController@getLeadSchedule');
    Route::get('get-invoices', 'ScheduleController@getInvoicesForFollowUp');
    Route::get('get-followup-groups', 'ScheduleController@getFollowUpGroups');

    Route::resource('follow-up-log', 'ScheduleLogController');

    Route::get('install', 'InstallController@index');
    Route::post('install', 'InstallController@install');
    Route::get('install/uninstall', 'InstallController@uninstall');
    Route::get('install/update', 'InstallController@update');

    Route::resource('leads', 'LeadController');
    Route::get('lead/{id}/convert', 'LeadController@convertToCustomer');
    Route::get('lead/{id}/post-life-stage', 'LeadController@postLifeStage');

    Route::get('{id}/send-campaign-notification', 'CampaignController@sendNotification')->name('sendNotification');
    Route::resource('campaigns', 'CampaignController');
    Route::post('/validate-email', [CampaignController::class, 'validateEmail'])->name('validateEmail');
    Route::get('/campaign-leads-list/{id}', [CampaignController::class, 'campaignApplicantList'])->name('campaignApplicantList');
    Route::get('/campaign-leads-details/{id}', [CampaignController::class, 'campaignApplicantDetails'])->name('campaignApplicantDetails');

    Route::get('dashboard', 'CrmDashboardController@index');

    Route::get('reports', 'ReportController@index');
    Route::get('follow-ups-by-user', 'ReportController@followUpsByUser');
    Route::get('follow-ups-by-contact', 'ReportController@followUpsContact');
    Route::get('lead-to-customer-report', 'ReportController@leadToCustomerConversion');
    Route::get('lead-to-customer-details/{user_id}', 'ReportController@showLeadToCustomerConversionDetails');
    Route::get('call-log', 'CallLogController@index', ['only' => ['index']]);
    Route::post('mass-delete-call-log', 'CallLogController@massDestroy');

    Route::get('edit-proposal-template', 'ProposalTemplateController@getEdit');
    Route::post('update-proposal-template', 'ProposalTemplateController@postEdit');
    Route::get('view-proposal-template', 'ProposalTemplateController@getView');
    Route::get('send-proposal', 'ProposalTemplateController@send');
    Route::delete('delete-proposal-media/{id}', 'ProposalTemplateController@deleteProposalMedia');
    Route::resource('proposal-template', 'ProposalTemplateController')->except(['show', 'edit', 'update', 'destroy']);
    Route::resource('proposals', 'ProposalController')->except(['create', 'edit', 'update', 'destroy']);
    Route::get('settings', 'CrmSettingsController@index');
    Route::post('update-settings', 'CrmSettingsController@updateSettings');
    Route::get('order-request', 'OrderRequestController@listOrderRequests');
});
