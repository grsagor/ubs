<?php
include 'customer.php';

use App\Http\Controllers\Backend\WithdrawController;
use App\Http\Controllers\Install;
use App\Http\Controllers\Restaurant;
use App\Http\Controllers\WithdrawRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BackUpController;
use App\Http\Controllers\LabelsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResellController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BarcodeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\PrinterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SellPosController;
// use App\Http\Controllers\Auth;
use App\Http\Controllers\TaxRateController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\GroupTaxController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\TaxonomyController;
use App\Http\Controllers\WarrantyController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\ShopShareController;
use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\RoomToRentController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\SellReturnController;
use App\Http\Controllers\AccountTypeController;
use App\Http\Controllers\ImportSalesController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\RecruitmentController;
use App\Http\Controllers\CashRegisterController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OpeningStockController;
use App\Http\Controllers\CustomerGroupController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\InvoiceLayoutController;
use App\Http\Controllers\InvoiceSchemeController;
use App\Http\Controllers\NewsMarketingController;
// use App\Http\Controllers\Auth;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\StockTransferController;
// use App\Http\Controllers\Auth;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\AccountReportsController;
use App\Http\Controllers\Backend\FooterController;
use App\Http\Controllers\ImportProductsController;
use App\Http\Controllers\LedgerDiscountController;
use App\Http\Controllers\PurchaseReturnController;
use App\Http\Controllers\TypesOfServiceController;
use App\Http\Controllers\DocumentAndNoteController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\StockAdjustmentController;
use App\Http\Controllers\BusinessLocationController;
use App\Http\Controllers\Frontend\CatalogController;
use App\Http\Controllers\Frontend\ServiceController;
use App\Http\Controllers\LocationSettingsController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\PropertyController;
use App\Http\Controllers\Frontend\RoomListController;

// use App\Http\Controllers\DashboardConfiguratorController;    

use App\Http\Controllers\SellingPriceGroupController;

// use App\Http\Controllers\CombinedPurchaseReturnController;

use App\Http\Controllers\VariationTemplateController;
use App\Http\Controllers\Frontend\EducationController;
use App\Http\Controllers\ImportOpeningStockController;

// use App\Http\Controllers\DashboardConfiguratorController;    
// use App\Http\Controllers\CombinedPurchaseReturnController;

use App\Http\Controllers\TransactionPaymentController;
use App\Http\Controllers\Frontend\RoomWantedController;
use App\Http\Controllers\PurchaseRequisitionController;
use App\Http\Controllers\NotificationTemplateController;
use App\Http\Controllers\SalesCommissionAgentController;
use App\Http\Controllers\DashboardConfiguratorController;
use App\Http\Controllers\Backend\PropertyWantedController;
use App\Http\Controllers\CombinedPurchaseReturnController;
use App\Http\Controllers\Frontend\OtherServicesController;
use App\Http\Controllers\Backend\ServiceEducationController;
use App\Http\Controllers\Backend\ServiceAdvertiseRoomController;
use App\Http\Controllers\FrontendController as PropertyFrontController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;

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

include_once 'install_r.php';

//Optimize Clear:
Route::get('/route-optimize-clear', function () {
    Artisan::call('optimize:clear');
    return '<h2>Events, views, cache, route, config, compiled clear</h2>';
});

Route::get('send-mail', function () {

    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];

    \Mail::to('test@gmail.com')->send(new \App\Mail\MyTestMail($details));

    dd("Email is Sent.");
});

// Stripe payment gateway
Route::controller(StripePaymentController::class)->group(function () {
    Route::get('stripe', 'stripe');
    Route::post('stripe', 'stripePost')->name('stripe.post');
});

// Digital Marketing, Partner Boarding, Business Solution, IT solution
// Route::get('/digital-marketing',                                    [OtherServicesController::class, 'digitalMarketing'])->name('digitalMarketing');
// Route::get('/partner-boarding',                                     [OtherServicesController::class, 'partnerBoarding'])->name('partnerBoarding');
// Route::get('/business-solutions',                                   [OtherServicesController::class, 'businessSolutions'])->name('businessSolutions');
// Route::get('/it-solutions',                                         [OtherServicesController::class, 'itSolutions'])->name('itSolutions');
// Route::get('/landlord-service',                                     [OtherServicesController::class, 'landlordeService'])->name('landlordeService');
Route::get('/property-finding-service', [OtherServicesController::class, 'propertyFindingService'])->name('propertyFindingService');
Route::get('/property-finding-service-charge/{id}', [OtherServicesController::class, 'propertyFindingServiceCharge'])->name('propertyFindingServiceCharge');
Route::get('/property-finding-service-add-click-handler', [OtherServicesController::class, 'addClilckHandler']);
Route::get('/property-finding-service-change-quantity-handler', [OtherServicesController::class, 'changeQuantityHandler']);
Route::get('/property-finding-payment', [OtherServicesController::class, 'propertyFindingPayment'])->name('propertyFindingPayment');

Route::get('/landlord-service', [FrontendController::class, 'landlord_service'])->name('landlordeService');
Route::get('/tenant-management-service', [FrontendController::class, 'tenant_management_service'])->name('tenant_management_service');
Route::get('/business-solutions', [FrontendController::class, 'business_solutions'])->name('businessSolutions');
Route::get('/digital-marketing', [FrontendController::class, 'digital_marketing_service'])->name('digitalMarketing');
Route::get('/it-solutions', [FrontendController::class, 'it_solutions'])->name('itSolutions');
Route::get('/partner-boarding', [FrontendController::class, 'partner_boarding'])->name('partnerBoarding');

Route::get('/recruitment/list', [RecruitmentController::class, 'list'])->name('recruitment.list');
Route::get('/recruitment/{id}/{slug}', [RecruitmentController::class, 'details'])->name('recruitment.details')->where('title', '.*');
Route::get('/recruitment-create/{id}', [RecruitmentController::class, 'create'])->name('recruitment.create');
Route::post('/recruitment', [RecruitmentController::class, 'store'])->name('recruitment.store');
Route::get('/recruitment-success', [RecruitmentController::class, 'success'])->name('recruitment.success');
Route::get('/recruitment-userCheck/{jobID}', [RecruitmentController::class, 'userCheck'])->name('recruitment.userCheck');
Route::post('/recruitment/applyJob/{jobID}', [RecruitmentController::class, 'applyJob'])->name('recruitment.applyJob');

// Services
Route::get('/room-list/', [RoomListController::class, 'roomList'])->name('room.list');
Route::get('/room-list/category', [RoomListController::class, 'roomListCategory'])->name('room.list.category');
Route::get('/room-show/{id}', [RoomListController::class, 'roomShow'])->name('room_show');
Route::post('/submit-form', [RoomListController::class, 'showModal']);
Route::post('/room-booking/', [RoomListController::class, 'propertyRentBooking'])->name('room.propertyRentBooking');
Route::get('/show-occupants-details-inputs', [RoomListController::class, 'showOccupantsDetailsInputs']);

Route::get('/property/{sub_category_id?}/{child_category_id?}', [PropertyFrontController::class, 'roomList'])->name('property.list');
Route::get('/property-show/{id}', [PropertyController::class, 'propertyShow'])->name('property_show');
Route::put('/property-reference-number-check/{id}', [PropertyController::class, 'referenceNumberCheck'])->name('property.referenceNumberCheck');
Route::get('/property-list-showing/{child_category_id?}', [PropertyController::class, 'propertyListShowing']);

Route::get('/education-list', [EducationController::class, 'educationList'])->name('education.list');
Route::get('/education-show/{id}', [EducationController::class, 'educationShow'])->name('education_show');

Route::get('/service/list', [ServiceController::class, 'serviceList'])->name('service.list');
Route::get('/service-create', [ServiceController::class, 'serviceCreate'])->name('service.create');
Route::get('/get-subcategories/{category_id}', [ServiceController::class, 'getSubcategories'])->name('service.subCategory');
Route::get('/get-child-subcategories/{category_id}', [ServiceController::class, 'getChildSubcategories'])->name('service.childSubCategory');
Route::get('/get-service-items/{category_id}', [ServiceController::class, 'getServiceItems']);

// FOOTER LINKS DETAIL SECTION
// Route::get('/about',                                    [FrontendController::class, 'footerDetails'])->name('footer.details.about');
Route::get('/about-us', [FrontendController::class, 'about_us'])->name('footer.details.about_us');
Route::get('/slavery-and-human-trafficking-statement', [FrontendController::class, 'slavery_and_human_trafficking_statement'])->name('footer.details.slavery_and_human_trafficking_statement');
Route::get('/statement', [FrontendController::class, 'statement'])->name('footer.details.statement');
Route::get('/sustainability', [FrontendController::class, 'sustainability'])->name('footer.details.sustainability');
Route::get('/unipuller-service', [FrontendController::class, 'unipuller_service'])->name('footer.details.unipuller_service');

// Route::get('/make-money',                               [FrontendController::class, 'footerDetails'])->name('footer.details.make.money');
Route::get('/sell-on-unipuller', [FrontendController::class, 'sell_on_unipuller'])->name('footer.details.sell_on_unipuller');
Route::get('/sell-on-unipuller-technology', [FrontendController::class, 'sell_on_technology'])->name('footer.details.sell_on_technology');
Route::get('/associate-program', [FrontendController::class, 'associate_program'])->name('footer.details.associate_program');
Route::get('/service-delivery-partnership', [FrontendController::class, 'delivery_partner'])->name('footer.details.delivery_partner');


// Route::get('/our-services',                             [FrontendController::class, 'footerDetails'])->name('footer.details.our.services');
Route::get('/advertising', [FrontendController::class, 'advertising'])->name('footer.details.our.advertising');
Route::get('/marketing', [FrontendController::class, 'marketing'])->name('footer.details.our.marketing');
Route::get('/website-devlopment', [FrontendController::class, 'website_devlopment'])->name('footer.details.our.website_devlopment');
Route::get('/software-devlopment', [FrontendController::class, 'software_devlopment'])->name('footer.details.our.software_devlopment');
Route::get('/seo', [FrontendController::class, 'seo'])->name('footer.details.our.seo');
Route::get('/video-production', [FrontendController::class, 'video_production'])->name('footer.details.our.video_production');

// Route::get('/quick-links',                              [FrontendController::class, 'footerDetails'])->name('footer.details.quick.links');

// Route::get('/policies',                                 [FrontendController::class, 'footerDetails'])->name('footer.details.policies');
Route::get('/privacy-cookies', [FrontendController::class, 'privacy_cookies'])->name('footer.details.policies.privacy_cookies');
Route::get('/condition-of-use-and-sale', [FrontendController::class, 'condition_of_use_sale'])->name('footer.details.policies.condition_of_use_sale');
Route::get('/return-and-return-policies', [FrontendController::class, 'return_refund_policies'])->name('footer.details.policies.return_refund_policies');
Route::get('/payment-terms', [FrontendController::class, 'payment_terms'])->name('footer.details.policies.payment_terms');

// Contact us
Route::get('/contact-us', [FrontendController::class, 'contact_us'])->name('footer.details.contact_us');

// CART SECTION
Route::get('/carts', [CartController::class, 'cart'])->name('front.cart');
Route::get('/get-client-secret', [CartController::class, 'getClientSecret'])->name('get.stripe.client.secret');
Route::post('/post-cart', [CartController::class, 'postCart'])->name('post.cart');
Route::post('/removecart', [CartController::class, 'removecart'])->name('product.cart.remove');
Route::post('/order-now', [CartController::class, 'orderNow'])->name('order.now');
Route::get('/checkout', [CartController::class, 'checkout'])->name('front.checkout');
Route::post('/checkout-post', [CartController::class, 'checkoutPost'])->name('checkout.post');
Route::get('/addcart/{id}', [CartController::class, 'addcart'])->name('product.cart.add');
Route::get('/addtocart/{id}', [CartController::class, 'addtocart'])->name('product.cart.quickadd');
Route::get('/addnumcart', 'Front\CartController@addnumcart')->name('details.cart');
Route::get('/addtonumcart', 'Front\CartController@addtonumcart');
Route::get('/addservicetonumcart', 'Front\CartController@addservicetonumcart');
Route::get('/addbyone', 'Front\CartController@addbyone');
Route::get('/reducebyone', 'Front\CartController@reducebyone');
Route::get('/upcolor', 'Front\CartController@upcolor');
// Route::get('/carts/coupon', 'Front\CouponController@coupon');
// CART SECTION ENDS

Route::middleware(['setData'])->group(function () {

    // Frontend Routes Start //

    Route::get('/', [HomePageController::class, 'index'])->name('homePage');
    Route::get('/category/{category?}/{subcategory?}/{childcategory?}/{kind?}', [FrontendCategoryController::class, 'category'])->name('front.category');

    Route::get('/shop/list/{category?}/{country?}', [ShopController::class, 'shopList'])->name('shop.list');
    Route::get('/shop/{id}', [ShopController::class, 'ShopService'])->name('shop.service');

    Route::get('/shop/business/service/{id}', [ShopController::class, 'BusinessShopService'])->name('business.shop.service');


    //Product
    Route::get('/product/list', [ProductController::class, 'productList'])->name('product.list');
    // Route::get('/service/service/list/{id}', [ProductController::class, 'productShow'])->name('product.show');
    Route::get('/service/service/list/{id}/{name}', [ProductController::class, 'productShow'])->name('product.show');
    Route::get('/product-policy/{id}', [ProductController::class, 'productPolicy'])->name('product.policy');
    Route::get('/product-refund-policy/{id}', [ProductController::class, 'productRefundPolicy'])->name('product.refund.policy');

    // CATEGORY SECTION

    Route::get('/categories', [CatalogController::class, 'categories'])->name('front.categories');
    Route::get('/category/{category?}/{subcategory?}/{childcategory?}/{kind?}', [CatalogController::class, 'category'])->name('front.category');

    // Frontend Routes End //

    Auth::routes();

    Route::get('/business/register', [BusinessController::class, 'getRegister'])->name('business.getRegister');
    Route::post('/business/register', [BusinessController::class, 'postRegister'])->name('business.postRegister');

    Route::get('/customer/register/{business_id?}', [CustomerGroupController::class, 'getRegister'])->name('customer.getRegister');
    Route::post('/customer/register', [CustomerGroupController::class, 'postRegister'])->name('customer.postRegister');

    Route::post('/business/register/check-username', [BusinessController::class, 'postCheckUsername'])->name('business.postCheckUsername');
    Route::post('/business/register/check-email', [BusinessController::class, 'postCheckEmail'])->name('business.postCheckEmail');

    Route::get('/invoice/{token}', [SellPosController::class, 'showInvoice'])
        ->name('show_invoice');
    Route::get('/quote/{token}', [SellPosController::class, 'showInvoice'])
        ->name('show_quote');

    Route::get('/pay/{token}', [SellPosController::class, 'invoicePayment'])
        ->name('invoice_payment');
    Route::post('/confirm-payment/{id}', [SellPosController::class, 'confirmPayment'])
        ->name('confirm_payment');
});

//Routes for authenticated users only
// Route::middleware(['setData', 'auth', 'SetSessionData', 'language', 'timezone', 'AdminSidebarMenu', 'CheckUserLogin'])->group(function () {
Route::middleware(['checkAdmin', 'SetSessionData'])->group(function () {

    Route::get('/footer', [FooterController::class, 'index'])->name('footer.index');
    Route::get('/footer/create', [FooterController::class, 'create'])->name('footer.create');
    Route::post('/footer', [FooterController::class, 'store'])->name('footer.store');
    Route::get('/footer/{id}/edit', [FooterController::class, 'edit'])->name('footer.edit');
    Route::put('/footer/{id}', [FooterController::class, 'update'])->name('footer.update');

    // Shop news category
    Route::get('shop-news-category', [NewsCategoryController::class, 'index'])->name('shop-news-category.index');
    Route::get('shop-news-category/create', [NewsCategoryController::class, 'create'])->name('shop-news-category.create');
    Route::post('shop-news-category', [NewsCategoryController::class, 'store'])->name('shop-news-category.store');
    Route::get('shop-news-category/{id}', [NewsCategoryController::class, 'show'])->name('shop-news-category.show');
    Route::get('shop-news-category/{id}/edit', [NewsCategoryController::class, 'edit'])->name('shop-news-category.edit');
    Route::put('shop-news-category/{id}', [NewsCategoryController::class, 'update'])->name('shop-news-category.update');
    Route::delete('shop-news-category/{id}', [NewsCategoryController::class, 'destroy'])->name('shop-news-category.destroy');
    Route::get('shop-news-cactegory/status-change/{id}', [NewsCategoryController::class, 'statusChange'])->name('shop-news-category.statusChange');

    // News
    Route::get('shop-news', [NewsController::class, 'index'])->name('shop-news.index');
    Route::get('shop-news/create', [NewsController::class, 'create'])->name('shop-news.create');
    Route::post('shop-news', [NewsController::class, 'store'])->name('shop-news.store');
    Route::get('shop-news/{id}', [NewsController::class, 'show'])->name('shop-news.show');
    Route::get('shop-news/{id}/edit', [NewsController::class, 'edit'])->name('shop-news.edit');
    Route::put('shop-news/{id}', [NewsController::class, 'update'])->name('shop-news.update');
    Route::delete('shop-news/{id}', [NewsController::class, 'destroy'])->name('shop-news.destroy');
    Route::get('shop-news/status-change/{id}', [NewsController::class, 'statusChange'])->name('shop-news.statusChange');

    Route::resource('shop-marketing', MarketingController::class);

    Route::get('/applicant/index', [RecruitmentController::class, 'index'])->name('recruitment.index');
    Route::get('/my-applications', [RecruitmentController::class, 'myApplications'])->name('recruitment.myApplications');
    Route::get('/recruitment-show/{id}', [RecruitmentController::class, 'show'])->name('recruitment.show');

    // Job
    Route::resource('jobs', JobController::class);
    Route::get('/jobs/status-change/{id}', [JobController::class, 'status_change'])->name('jobs.status_change');

    // Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
    // Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
    // Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
    // Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    // Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');
    // Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
    // Route::delete('jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');

    Route::get('jobs/{id}/applicant-list', [JobController::class, 'applicantList'])->name('jobs.applicantList');

    // Job category
    Route::get('job-category', [JobCategoryController::class, 'index'])->name('job-category.index');
    Route::get('job-category/create', [JobCategoryController::class, 'create'])->name('job-category.create');
    Route::post('job-category', [JobCategoryController::class, 'store'])->name('job-category.store');
    Route::get('job-category/{id}', [JobCategoryController::class, 'show'])->name('job-category.show');
    Route::get('job-category/{id}/edit', [JobCategoryController::class, 'edit'])->name('job-category.edit');
    Route::put('job-category/{id}', [JobCategoryController::class, 'update'])->name('job-category.update');
    // Route::delete('job-category/{id}',                      [JobCategoryController::class, 'destroy'])->name('job-category.destroy');
    Route::get('job-cactegory/status-change/{id}', [JobCategoryController::class, 'statusChange'])->name('job-category.statusChange');

    // Services
    Route::resource('service-advertise', ServiceAdvertiseRoomController::class);
    Route::get('/room-to-rent-open-add-modal', [ServiceAdvertiseRoomController::class, 'create']);
    Route::get('/show-property-rent-delete-modal', [ServiceAdvertiseRoomController::class, 'showPropertyRentDeleteModal']);
    Route::get('/confirm-property-rent-delete', [ServiceAdvertiseRoomController::class, 'confirmPropertyRentDelete']);
    Route::get('/show-property-rent-edit-modal', [ServiceAdvertiseRoomController::class, 'showPropertyRentEditModal']);
    Route::get('/show-property-booking-details-modal', [ServiceAdvertiseRoomController::class, 'showPropertyBookingDetailsModal']);
    Route::post('/update-property-rent', [ServiceAdvertiseRoomController::class, 'updatePropertyRent']);
    // Route::get('/show-subcategory-select', [ServiceAdvertiseRoomController::class, 'showSubCategorySelect']);
    // Route::get('/show-childcategory-select', [ServiceAdvertiseRoomController::class, 'showChildCategorySelect']);
    Route::get('/show-room-size-select', [ServiceAdvertiseRoomController::class, 'showRoomQuantitySelect']);

    // Route::resource('property-wanted', PropertyWantedController::class);

    Route::resource('/room-to-rent', RoomToRentController::class);

    Route::resource('service-education', ServiceEducationController::class);







    Route::get('pos/payment/{id}', [SellPosController::class, 'edit'])->name('edit-pos-payment');
    Route::get('service-staff-availability', [SellPosController::class, 'showServiceStaffAvailibility']);
    Route::get('pause-resume-service-staff-timer/{user_id}', [SellPosController::class, 'pauseResumeServiceStaffTimer']);
    Route::get('mark-as-available/{user_id}', [SellPosController::class, 'markAsAvailable']);

    Route::resource('purchase-requisition', PurchaseRequisitionController::class)->except(['edit', 'update']);
    Route::post('/get-requisition-products', [PurchaseRequisitionController::class, 'getRequisitionProducts'])->name('get-requisition-products');
    Route::get('get-purchase-requisitions/{location_id}', [PurchaseRequisitionController::class, 'getPurchaseRequisitions']);
    Route::get('get-purchase-requisition-lines/{purchase_requisition_id}', [PurchaseRequisitionController::class, 'getPurchaseRequisitionLines']);

    Route::get('/sign-in-as-user/{id}', [ManageUserController::class, 'signInAsUser'])->name('sign-in-as-user');

    /* Route created by GR SAGOR from here */
    Route::get('/shop-share', [ShopShareController::class, 'index'])->name('shop.share.page');
    Route::post('/shop-share', [ShopShareController::class, 'store'])->name('shop.share.store');
    Route::get('/shop-share-open-modal', [ShopShareController::class, 'openModal'])->name('shop.share.open.modal');

    Route::get('/resell-product', [ResellController::class, 'index'])->name('product.resell.page');
    Route::post('/resell-product', [ResellController::class, 'store'])->name('product.resell.store');
    Route::get('/resell_product_modal', [ResellController::class, 'modalResellProduct'])->name('product.resell.modal');
    /* Route created by GR SAGOR to here */

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/get-totals', [HomeController::class, 'getTotals']);
    Route::get('/home/product-stock-alert', [HomeController::class, 'getProductStockAlert']);
    Route::get('/home/purchase-payment-dues', [HomeController::class, 'getPurchasePaymentDues']);
    Route::get('/home/sales-payment-dues', [HomeController::class, 'getSalesPaymentDues']);
    Route::post('/attach-medias-to-model', [HomeController::class, 'attachMediasToGivenModel'])->name('attach.medias.to.model');
    Route::get('/calendar', [HomeController::class, 'getCalendar'])->name('calendar');

    Route::post('/test-email', [BusinessController::class, 'testEmailConfiguration']);
    Route::post('/test-sms', [BusinessController::class, 'testSmsConfiguration']);
    Route::get('/business/settings', [BusinessController::class, 'getBusinessSettings'])->name('business.getBusinessSettings');
    Route::post('/business/update', [BusinessController::class, 'postBusinessSettings'])->name('business.postBusinessSettings');
    Route::get('/user/profile', [UserController::class, 'getProfile'])->name('user.getProfile');
    Route::post('/user/update', [UserController::class, 'updateProfile'])->name('user.updateProfile');
    Route::post('/user/update-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');

    Route::resource('brands', BrandController::class);

    // Route::resource('payment-account', 'PaymentAccountController');

    Route::resource('tax-rates', TaxRateController::class);

    Route::resource('units', UnitController::class);

    Route::resource('ledger-discount', LedgerDiscountController::class)->only('edit', 'destroy', 'store', 'update');

    Route::post('check-mobile', [ContactController::class, 'checkMobile']);
    Route::get('/get-contact-due/{contact_id}', [ContactController::class, 'getContactDue']);
    Route::get('/contacts/payments/{contact_id}', [ContactController::class, 'getContactPayments']);
    Route::get('/contacts/map', [ContactController::class, 'contactMap']);
    Route::get('/contacts/update-status/{id}', [ContactController::class, 'updateStatus']);
    Route::get('/contacts/stock-report/{supplier_id}', [ContactController::class, 'getSupplierStockReport']);
    Route::get('/contacts/ledger', [ContactController::class, 'getLedger']);
    Route::post('/contacts/send-ledger', [ContactController::class, 'sendLedger']);
    Route::get('/contacts/import', [ContactController::class, 'getImportContacts'])->name('contacts.import');
    Route::post('/contacts/import', [ContactController::class, 'postImportContacts']);
    Route::post('/contacts/check-contacts-id', [ContactController::class, 'checkContactId']);
    Route::get('/contacts/customers', [ContactController::class, 'getCustomers']);
    Route::resource('contacts', ContactController::class);

    Route::get('taxonomies-ajax-index-page', [TaxonomyController::class, 'getTaxonomyIndexPage']);
    Route::resource('taxonomies', TaxonomyController::class);

    Route::get('/get_sub_category/{id}', [TaxonomyController::class, 'get_sub_category'])->name('get_sub_category');

    Route::get('/business-location/category',                   [TaxonomyController::class, 'business_location_category_index'])->name('business_location_category_index');
    Route::get('/business-location/category/create',            [TaxonomyController::class, 'business_location_category_create'])->name('business_location_category_create');
    Route::post('/business-location/category/store',            [TaxonomyController::class, 'business_location_category_store'])->name('business_location_category_store');
    Route::get('/business-location/category/edit/{id}',         [TaxonomyController::class, 'business_location_category_edit'])->name('business_location_category_edit');
    Route::put('/business-location/category/update/{id}',       [TaxonomyController::class, 'business_location_category_update'])->name('business_location_category_update');
    Route::delete('/business-location/category/destroy/{id}',   [TaxonomyController::class, 'business_location_category_destroy'])->name('business_location_category_destroy');

    Route::get('/business-location/sub-category/create',        [TaxonomyController::class, 'business_location_sub_category_create'])->name('business_location_sub_category_create');
    Route::get('/business-location/sub-category/edit/{id}',     [TaxonomyController::class, 'business_location_sub_category_edit'])->name('business_location_sub_category_edit');

    Route::get('/product-service/category/index',               [TaxonomyController::class, 'product_service_category_index'])->name('product_service_category_index');
    Route::get('/product-service/category/create',              [TaxonomyController::class, 'product_service_category_create'])->name('product_service_category_create');
    Route::post('/product-service/category/store',              [TaxonomyController::class, 'product_service_category_store'])->name('product_service_category_store');
    Route::get('/product-service/category/edit/{id}',           [TaxonomyController::class, 'product_service_category_edit'])->name('product_service_category_edit');
    Route::put('/product-service/category/update/{id}',         [TaxonomyController::class, 'product_service_category_update'])->name('product_service_category_update');

    Route::get('/product-service/sub-category/create',        [TaxonomyController::class, 'product_service_sub_category_create'])->name('product_service_sub_category_create');
    Route::get('/product-service/sub-category/edit/{id}',     [TaxonomyController::class, 'product_service_sub_category_edit'])->name('product_service_sub_category_edit');

    Route::resource('variation-templates', VariationTemplateController::class);

    Route::get('/products/download-excel', [ProductController::class, 'downloadExcel']);

    Route::get('/products/stock-history/{id}', [ProductController::class, 'productStockHistory']);
    Route::get('/delete-media/{media_id}', [ProductController::class, 'deleteMedia']);
    Route::post('/products/mass-deactivate', [ProductController::class, 'massDeactivate']);
    Route::get('/products/activate/{id}', [ProductController::class, 'activate']);
    Route::get('/products/view-product-group-price/{id}', [ProductController::class, 'viewGroupPrice']);
    Route::get('/products/add-selling-prices/{id}', [ProductController::class, 'addSellingPrices']);
    Route::post('/products/save-selling-prices', [ProductController::class, 'saveSellingPrices']);
    Route::post('/products/mass-delete', [ProductController::class, 'massDestroy']);
    Route::get('/products/view/{id}', [ProductController::class, 'view']);
    Route::get('/products/list', [ProductController::class, 'getProducts']);
    Route::get('/products/list-no-variation', [ProductController::class, 'getProductsWithoutVariations']);
    Route::post('/products/bulk-edit', [ProductController::class, 'bulkEdit']);
    Route::post('/products/bulk-update', [ProductController::class, 'bulkUpdate']);
    Route::post('/products/bulk-update-location', [ProductController::class, 'updateProductLocation']);
    Route::get('/products/get-product-to-edit/{product_id}', [ProductController::class, 'getProductToEdit']);

    Route::post('/products/get_sub_categories', [ProductController::class, 'getSubCategories']);
    Route::get('/products/get_sub_units', [ProductController::class, 'getSubUnits']);
    Route::post('/products/product_form_part', [ProductController::class, 'getProductVariationFormPart']);
    Route::post('/products/get_product_variation_row', [ProductController::class, 'getProductVariationRow']);
    Route::post('/products/get_variation_template', [ProductController::class, 'getVariationTemplate']);
    Route::get('/products/get_variation_value_row', [ProductController::class, 'getVariationValueRow']);
    Route::post('/products/check_product_sku', [ProductController::class, 'checkProductSku']);
    Route::post('/products/validate_variation_skus', [ProductController::class, 'validateVaritionSkus']); //validates multiple skus at once
    Route::get('/products/quick_add', [ProductController::class, 'quickAdd']);
    Route::post('/products/save_quick_product', [ProductController::class, 'saveQuickProduct']);
    Route::get('/products/get-combo-product-entry-row', [ProductController::class, 'getComboProductEntryRow']);
    Route::post('/products/toggle-woocommerce-sync', [ProductController::class, 'toggleWooCommerceSync']);

    Route::resource('products', ProductController::class);

    Route::get('product/type/change', [ProductController::class, 'productTypeChange'])->name('product.type.change');
    Route::get('product/category_id/change', [ProductController::class, 'productCategoryChange'])->name('product.category_id.change');
    Route::get('product/sub_category/change', [ProductController::class, 'productSubcategoryChange'])->name('product.sub_category.change');

    Route::get('/toggle-subscription/{id}', 'SellPosController@toggleRecurringInvoices');
    Route::post('/sells/pos/get-types-of-service-details', 'SellPosController@getTypesOfServiceDetails');
    Route::get('/sells/subscriptions', 'SellPosController@listSubscriptions');
    Route::get('/sells/duplicate/{id}', 'SellController@duplicateSell');
    Route::get('/sells/drafts', 'SellController@getDrafts');
    Route::get('/sells/convert-to-draft/{id}', 'SellPosController@convertToInvoice');
    Route::get('/sells/convert-to-proforma/{id}', 'SellPosController@convertToProforma');
    Route::get('/sells/quotations', 'SellController@getQuotations');
    Route::get('/sells/draft-dt', 'SellController@getDraftDatables');
    Route::resource('sells', 'SellController')->except(['show']);
    Route::get('/sells/copy-quotation/{id}', [SellPosController::class, 'copyQuotation']);

    Route::post('/import-purchase-products', [PurchaseController::class, 'importPurchaseProducts']);
    Route::post('/purchases/update-status', [PurchaseController::class, 'updateStatus']);
    Route::get('/purchases/get_products', [PurchaseController::class, 'getProducts']);
    Route::get('/purchases/get_suppliers', [PurchaseController::class, 'getSuppliers']);
    Route::post('/purchases/get_purchase_entry_row', [PurchaseController::class, 'getPurchaseEntryRow']);
    Route::post('/purchases/check_ref_number', [PurchaseController::class, 'checkRefNumber']);
    Route::resource('purchases', PurchaseController::class)->except(['show']);

    Route::get('/toggle-subscription/{id}', [SellPosController::class, 'toggleRecurringInvoices']);
    Route::post('/sells/pos/get-types-of-service-details', [SellPosController::class, 'getTypesOfServiceDetails']);
    Route::get('/sells/subscriptions', [SellPosController::class, 'listSubscriptions']);
    Route::get('/sells/duplicate/{id}', [SellController::class, 'duplicateSell']);
    Route::get('/sells/drafts', [SellController::class, 'getDrafts']);
    Route::get('/sells/convert-to-draft/{id}', [SellPosController::class, 'convertToInvoice']);
    Route::get('/sells/convert-to-proforma/{id}', [SellPosController::class, 'convertToProforma']);
    Route::get('/sells/quotations', [SellController::class, 'getQuotations']);
    Route::get('/sells/draft-dt', [SellController::class, 'getDraftDatables']);
    Route::resource('sells', SellController::class)->except(['show']);

    Route::get('/import-sales', [ImportSalesController::class, 'index']);
    Route::post('/import-sales/preview', [ImportSalesController::class, 'preview']);
    Route::post('/import-sales', [ImportSalesController::class, 'import']);
    Route::get('/revert-sale-import/{batch}', [ImportSalesController::class, 'revertSaleImport']);

    Route::get('/sells/pos/get_product_row/{variation_id}/{location_id}', [SellPosController::class, 'getProductRow']);
    Route::post('/sells/pos/get_payment_row', [SellPosController::class, 'getPaymentRow']);
    Route::post('/sells/pos/get-reward-details', [SellPosController::class, 'getRewardDetails']);
    Route::get('/sells/pos/get-recent-transactions', [SellPosController::class, 'getRecentTransactions']);
    Route::get('/sells/pos/get-product-suggestion', [SellPosController::class, 'getProductSuggestion']);
    Route::get('/sells/pos/get-featured-products/{location_id}', [SellPosController::class, 'getFeaturedProducts']);
    Route::get('/reset-mapping', [SellController::class, 'resetMapping']);

    Route::resource('pos', SellPosController::class);

    Route::resource('roles', RoleController::class);

    Route::resource('users', ManageUserController::class);

    Route::resource('group-taxes', GroupTaxController::class);

    Route::get('/barcodes/set_default/{id}', [BarcodeController::class, 'setDefault']);
    Route::resource('barcodes', BarcodeController::class);

    //Invoice schemes..
    Route::get('/invoice-schemes/set_default/{id}', [InvoiceSchemeController::class, 'setDefault']);
    Route::resource('invoice-schemes', InvoiceSchemeController::class);

    //Print Labels
    Route::get('/labels/show', [LabelsController::class, 'show']);
    Route::get('/labels/add-product-row', [LabelsController::class, 'addProductRow']);
    Route::get('/labels/preview', [LabelsController::class, 'preview']);

    //Reports...
    Route::get('/reports/gst-purchase-report', [ReportController::class, 'gstPurchaseReport']);
    Route::get('/reports/gst-sales-report', [ReportController::class, 'gstSalesReport']);
    Route::get('/reports/get-stock-by-sell-price', [ReportController::class, 'getStockBySellingPrice']);
    Route::get('/reports/purchase-report', [ReportController::class, 'purchaseReport']);
    Route::get('/reports/sale-report', [ReportController::class, 'saleReport']);
    Route::get('/reports/service-staff-report', [ReportController::class, 'getServiceStaffReport']);
    Route::get('/reports/service-staff-line-orders', [ReportController::class, 'serviceStaffLineOrders']);
    Route::get('/reports/table-report', [ReportController::class, 'getTableReport']);
    Route::get('/reports/profit-loss', [ReportController::class, 'getProfitLoss']);
    Route::get('/reports/get-opening-stock', [ReportController::class, 'getOpeningStock']);
    Route::get('/reports/purchase-sell', [ReportController::class, 'getPurchaseSell']);
    Route::get('/reports/customer-supplier', [ReportController::class, 'getCustomerSuppliers']);
    Route::get('/reports/stock-report', [ReportController::class, 'getStockReport']);
    Route::get('/reports/stock-details', [ReportController::class, 'getStockDetails']);
    Route::get('/reports/tax-report', [ReportController::class, 'getTaxReport']);
    Route::get('/reports/tax-details', [ReportController::class, 'getTaxDetails']);
    Route::get('/reports/trending-products', [ReportController::class, 'getTrendingProducts']);
    Route::get('/reports/expense-report', [ReportController::class, 'getExpenseReport']);
    Route::get('/reports/stock-adjustment-report', [ReportController::class, 'getStockAdjustmentReport']);
    Route::get('/reports/register-report', [ReportController::class, 'getRegisterReport']);
    Route::get('/reports/sales-representative-report', [ReportController::class, 'getSalesRepresentativeReport']);
    Route::get('/reports/sales-representative-total-expense', [ReportController::class, 'getSalesRepresentativeTotalExpense']);
    Route::get('/reports/sales-representative-total-sell', [ReportController::class, 'getSalesRepresentativeTotalSell']);
    Route::get('/reports/sales-representative-total-commission', [ReportController::class, 'getSalesRepresentativeTotalCommission']);
    Route::get('/reports/stock-expiry', [ReportController::class, 'getStockExpiryReport']);
    Route::get('/reports/stock-expiry-edit-modal/{purchase_line_id}', [ReportController::class, 'getStockExpiryReportEditModal']);
    Route::post('/reports/stock-expiry-update', [ReportController::class, 'updateStockExpiryReport'])->name('updateStockExpiryReport');
    Route::get('/reports/customer-group', [ReportController::class, 'getCustomerGroup']);
    Route::get('/reports/product-purchase-report', [ReportController::class, 'getproductPurchaseReport']);
    Route::get('/reports/product-sell-grouped-by', [ReportController::class, 'productSellReportBy']);
    Route::get('/reports/product-sell-report', [ReportController::class, 'getproductSellReport']);
    Route::get('/reports/product-sell-report-with-purchase', [ReportController::class, 'getproductSellReportWithPurchase']);
    Route::get('/reports/product-sell-grouped-report', [ReportController::class, 'getproductSellGroupedReport']);
    Route::get('/reports/lot-report', [ReportController::class, 'getLotReport']);
    Route::get('/reports/purchase-payment-report', [ReportController::class, 'purchasePaymentReport']);
    Route::get('/reports/sell-payment-report', [ReportController::class, 'sellPaymentReport']);
    Route::get('/reports/product-stock-details', [ReportController::class, 'productStockDetails']);
    Route::get('/reports/adjust-product-stock', [ReportController::class, 'adjustProductStock']);
    Route::get('/reports/get-profit/{by?}', [ReportController::class, 'getProfit']);
    Route::get('/reports/items-report', [ReportController::class, 'itemsReport']);
    Route::get('/reports/get-stock-value', [ReportController::class, 'getStockValue']);

    Route::get('business-location/activate-deactivate/{location_id}', [BusinessLocationController::class, 'activateDeactivateLocation'])->name('location.activate_deactivate');

    //Business Location Settings...
    Route::prefix('business-location/{location_id}')->name('location.')->group(function () {
        Route::get('settings', [LocationSettingsController::class, 'index'])->name('settings');
        Route::post('settings', [LocationSettingsController::class, 'updateSettings'])->name('settings_update');
    });

    //Business Locations...
    Route::post('business-location/check-location-id', [BusinessLocationController::class, 'checkLocationId']);
    Route::resource('business-location', BusinessLocationController::class);

    //Invoice layouts..
    Route::resource('invoice-layouts', InvoiceLayoutController::class);

    Route::post('get-expense-sub-categories', [ExpenseCategoryController::class, 'getSubCategories']);

    //Expense Categories...
    Route::resource('expense-categories', ExpenseCategoryController::class);

    //Expenses...
    Route::resource('expenses', ExpenseController::class);

    //Transaction payments...
    // Route::get('/payments/opening-balance/{contact_id}', 'TransactionPaymentController@getOpeningBalancePayments');
    Route::get('/payments/show-child-payments/{payment_id}', [TransactionPaymentController::class, 'showChildPayments']);
    Route::get('/payments/view-payment/{payment_id}', [TransactionPaymentController::class, 'viewPayment']);
    Route::get('/payments/add_payment/{transaction_id}', [TransactionPaymentController::class, 'addPayment']);
    Route::get('/payments/pay-contact-due/{contact_id}', [TransactionPaymentController::class, 'getPayContactDue']);
    Route::post('/payments/pay-contact-due', [TransactionPaymentController::class, 'postPayContactDue']);
    Route::resource('payments', TransactionPaymentController::class);

    //Printers...
    Route::resource('printers', PrinterController::class);

    Route::get('/stock-adjustments/remove-expired-stock/{purchase_line_id}', [StockAdjustmentController::class, 'removeExpiredStock']);
    Route::post('/stock-adjustments/get_product_row', [StockAdjustmentController::class, 'getProductRow']);
    Route::resource('stock-adjustments', StockAdjustmentController::class);

    Route::get('/cash-register/register-details', [CashRegisterController::class, 'getRegisterDetails']);
    Route::get('/cash-register/close-register/{id?}', [CashRegisterController::class, 'getCloseRegister']);
    Route::post('/cash-register/close-register', [CashRegisterController::class, 'postCloseRegister']);
    Route::resource('cash-register', CashRegisterController::class);

    //Import products
    Route::get('/import-products', [ImportProductsController::class, 'index']);
    Route::post('/import-products/store', [ImportProductsController::class, 'store']);

    //Sales Commission Agent
    Route::resource('sales-commission-agents', SalesCommissionAgentController::class);

    //Stock Transfer
    Route::get('stock-transfers/print/{id}', [StockTransferController::class, 'printInvoice']);
    Route::post('stock-transfers/update-status/{id}', [StockTransferController::class, 'updateStatus']);
    Route::resource('stock-transfers', StockTransferController::class);

    Route::get('/opening-stock/add/{product_id}', [OpeningStockController::class, 'add']);
    Route::post('/opening-stock/save', [OpeningStockController::class, 'save']);

    //Customer Groups
    Route::resource('customer-group', CustomerGroupController::class);

    //Import opening stock
    Route::get('/import-opening-stock', [ImportOpeningStockController::class, 'index']);
    Route::post('/import-opening-stock/store', [ImportOpeningStockController::class, 'store']);

    //Sell return
    Route::get('validate-invoice-to-return/{invoice_no}', [SellReturnController::class, 'validateInvoiceToReturn']);
    Route::resource('sell-return', SellReturnController::class);
    Route::get('sell-return/get-product-row', [SellReturnController::class, 'getProductRow']);
    Route::get('/sell-return/print/{id}', [SellReturnController::class, 'printInvoice']);
    Route::get('/sell-return/add/{id}', [SellReturnController::class, 'add']);

    //Backup
    Route::get('backup/download/{file_name}', [BackUpController::class, 'download']);
    Route::get('backup/delete/{file_name}', [BackUpController::class, 'delete']);
    Route::resource('backup', BackUpController::class)->only('index', 'create', 'store');

    Route::get('selling-price-group/activate-deactivate/{id}', [SellingPriceGroupController::class, 'activateDeactivate']);
    Route::get('export-selling-price-group', [SellingPriceGroupController::class, 'export']);
    Route::post('import-selling-price-group', [SellingPriceGroupController::class, 'import']);

    Route::resource('selling-price-group', SellingPriceGroupController::class);

    Route::resource('notification-templates', NotificationTemplateController::class)->only(['index', 'store']);
    Route::get('notification/get-template/{transaction_id}/{template_for}', [NotificationController::class, 'getTemplate']);
    Route::post('notification/send', [NotificationController::class, 'send']);

    Route::post('/purchase-return/update', [CombinedPurchaseReturnController::class, 'update']);
    Route::get('/purchase-return/edit/{id}', [CombinedPurchaseReturnController::class, 'edit']);
    Route::post('/purchase-return/save', [CombinedPurchaseReturnController::class, 'save']);
    Route::post('/purchase-return/get_product_row', [CombinedPurchaseReturnController::class, 'getProductRow']);
    Route::get('/purchase-return/create', [CombinedPurchaseReturnController::class, 'create']);
    Route::get('/purchase-return/add/{id}', [PurchaseReturnController::class, 'add']);
    Route::resource('/purchase-return', PurchaseReturnController::class)->except('create');

    Route::get('/discount/activate/{id}', [DiscountController::class, 'activate']);
    Route::post('/discount/mass-deactivate', [DiscountController::class, 'massDeactivate']);
    Route::resource('discount', DiscountController::class);

    Route::prefix('account')->group(function () {
        Route::resource('/account', AccountController::class);
        // Withdraw routes
        Route::get('/withdraw', [WithdrawRequestController::class, 'index']);
        Route::get('/withdraw-list', [WithdrawRequestController::class, 'getWithdrawList'])->name('account.withdraw.list');
        Route::get('/withdraw-superadmin-list', [WithdrawRequestController::class, 'getSuperadminList'])->name('account.withdraw.superadmin.list');
        Route::get('/withdraw-add-request', [WithdrawRequestController::class, 'addRequest'])->name('account.withdraw.add.request');
        Route::post('/withdraw-store-request', [WithdrawRequestController::class, 'storeWithdrawRequest'])->name('account.withdraw.store.request');
        Route::get('/withdraw-view-request', [WithdrawRequestController::class, 'viewWithdrawRequest'])->name('account.withdraw.view.request');
        Route::get('/withdraw-take-action', [WithdrawRequestController::class, 'takeAction'])->name('account.withdraw.take.action');
        Route::post('/withdraw-take-action-store', [WithdrawRequestController::class, 'takeActionStore'])->name('account.withdraw.store.take.action');

        Route::get('/fund-transfer/{id}', [AccountController::class, 'getFundTransfer']);
        Route::post('/fund-transfer', [AccountController::class, 'postFundTransfer']);
        Route::get('/deposit/{id}', [AccountController::class, 'getDeposit']);
        Route::post('/deposit', [AccountController::class, 'postDeposit']);
        Route::get('/close/{id}', [AccountController::class, 'close']);
        Route::get('/activate/{id}', [AccountController::class, 'activate']);
        Route::get('/delete-account-transaction/{id}', [AccountController::class, 'destroyAccountTransaction']);
        Route::get('/edit-account-transaction/{id}', [AccountController::class, 'editAccountTransaction']);
        Route::post('/update-account-transaction/{id}', [AccountController::class, 'updateAccountTransaction']);
        Route::get('/get-account-balance/{id}', [AccountController::class, 'getAccountBalance']);
        Route::get('/balance-sheet', [AccountReportsController::class, 'balanceSheet']);
        Route::get('/trial-balance', [AccountReportsController::class, 'trialBalance']);
        Route::get('/payment-account-report', [AccountReportsController::class, 'paymentAccountReport']);
        Route::get('/link-account/{id}', [AccountReportsController::class, 'getLinkAccount']);
        Route::post('/link-account', [AccountReportsController::class, 'postLinkAccount']);
        Route::get('/cash-flow', [AccountController::class, 'cashFlow']);
    });

    Route::resource('account-types', AccountTypeController::class);

    //Restaurant module
    Route::prefix('modules')->group(function () {
        Route::resource('tables', Restaurant\TableController::class);
        Route::resource('modifiers', Restaurant\ModifierSetsController::class);

        //Map modifier to products
        Route::get('/product-modifiers/{id}/edit', [Restaurant\ProductModifierSetController::class, 'edit']);
        Route::post('/product-modifiers/{id}/update', [Restaurant\ProductModifierSetController::class, 'update']);
        Route::get('/product-modifiers/product-row/{product_id}', [Restaurant\ProductModifierSetController::class, 'product_row']);

        Route::get('/add-selected-modifiers', [Restaurant\ProductModifierSetController::class, 'add_selected_modifiers']);

        Route::get('/kitchen', [Restaurant\KitchenController::class, 'index']);
        Route::get('/kitchen/mark-as-cooked/{id}', [Restaurant\KitchenController::class, 'markAsCooked']);
        Route::post('/refresh-orders-list', [Restaurant\KitchenController::class, 'refreshOrdersList']);
        Route::post('/refresh-line-orders-list', [Restaurant\KitchenController::class, 'refreshLineOrdersList']);

        Route::get('/orders', [Restaurant\OrderController::class, 'index']);
        Route::get('/orders/mark-as-served/{id}', [Restaurant\OrderController::class, 'markAsServed']);
        Route::get('/data/get-pos-details', [Restaurant\DataController::class, 'getPosDetails']);
        Route::get('/orders/mark-line-order-as-served/{id}', [Restaurant\OrderController::class, 'markLineOrderAsServed']);
        Route::get('/print-line-order', [Restaurant\OrderController::class, 'printLineOrder']);
    });

    Route::get('bookings/get-todays-bookings', [Restaurant\BookingController::class, 'getTodaysBookings']);
    Route::resource('bookings', Restaurant\BookingController::class);

    Route::resource('types-of-service', TypesOfServiceController::class);
    Route::get('sells/edit-shipping/{id}', [SellController::class, 'editShipping']);
    Route::put('sells/update-shipping/{id}', [SellController::class, 'updateShipping']);
    Route::get('shipments', [SellController::class, 'shipments']);

    Route::post('upload-module', [Install\ModulesController::class, 'uploadModule']);
    Route::resource('manage-modules', Install\ModulesController::class)
        ->only(['index', 'destroy', 'update']);
    Route::resource('warranties', WarrantyController::class);

    Route::resource('dashboard-configurator', DashboardConfiguratorController::class)
        ->only(['edit', 'update']);

    Route::get('view-media/{model_id}', [SellController::class, 'viewMedia']);

    //common controller for document & note
    Route::get('get-document-note-page', [DocumentAndNoteController::class, 'getDocAndNoteIndexPage']);
    Route::post('post-document-upload', [DocumentAndNoteController::class, 'postMedia']);
    Route::resource('note-documents', DocumentAndNoteController::class);
    Route::resource('purchase-order', PurchaseOrderController::class);
    Route::get('get-purchase-orders/{contact_id}', [PurchaseOrderController::class, 'getPurchaseOrders']);
    Route::get('get-purchase-order-lines/{purchase_order_id}', [PurchaseController::class, 'getPurchaseOrderLines']);
    Route::get('edit-purchase-orders/{id}/status', [PurchaseOrderController::class, 'getEditPurchaseOrderStatus']);
    Route::put('update-purchase-orders/{id}/status', [PurchaseOrderController::class, 'postEditPurchaseOrderStatus']);
    Route::resource('sales-order', SalesOrderController::class)->only(['index']);
    Route::get('get-sales-orders/{customer_id}', [SalesOrderController::class, 'getSalesOrders']);
    Route::get('get-sales-order-lines', [SellPosController::class, 'getSalesOrderLines']);
    Route::get('edit-sales-orders/{id}/status', [SalesOrderController::class, 'getEditSalesOrderStatus']);
    Route::put('update-sales-orders/{id}/status', [SalesOrderController::class, 'postEditSalesOrderStatus']);
    Route::get('reports/activity-log', [ReportController::class, 'activityLog']);
    Route::get('user-location/{latlng}', [HomeController::class, 'getUserLocation']);
});

Route::get('/withdraw', [WithdrawRequestController::class, 'index']);
Route::get('/withdraw-list', [WithdrawRequestController::class, 'getWithdrawList'])->name('account.withdraw.list');
Route::get('/withdraw-superadmin-list', [WithdrawRequestController::class, 'getSuperadminList'])->name('account.withdraw.superadmin.list');
Route::get('/withdraw-add-request', [WithdrawRequestController::class, 'addRequest'])->name('account.withdraw.add.request');
Route::post('/withdraw-store-request', [WithdrawRequestController::class, 'storeWithdrawRequest'])->name('account.withdraw.store.request');

// Route::middleware(['EcomApi'])->prefix('api/ecom')->group(function () {
//     Route::get('products/{id?}', [ProductController::class, 'getProductsApi']);
//     Route::get('categories', [CategoryController::class, 'getCategoriesApi']);
//     Route::get('brands', [BrandController::class, 'getBrandsApi']);
//     Route::post('customers', [ContactController::class, 'postCustomersApi']);
//     Route::get('settings', [BusinessController::class, 'getEcomSettings']);
//     Route::get('variations', [ProductController::class, 'getVariationsApi']);
//     Route::post('orders', [SellPosController::class, 'placeOrdersApi']);
// });

//common route
Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['setData', 'auth', 'SetSessionData', 'language', 'timezone'])->group(function () {
    Route::get('/load-more-notifications', [HomeController::class, 'loadMoreNotifications']);
    Route::get('/get-total-unread', [HomeController::class, 'getTotalUnreadNotifications']);
    Route::get('/purchases/print/{id}', [PurchaseController::class, 'printInvoice']);
    Route::get('/purchases/{id}', [PurchaseController::class, 'show']);
    Route::get('/download-purchase-order/{id}/pdf', [PurchaseOrderController::class, 'downloadPdf'])->name('purchaseOrder.downloadPdf');
    Route::get('/sells/{id}', [SellController::class, 'show']);
    Route::get('/sells/{transaction_id}/print', [SellPosController::class, 'printInvoice'])->name('sell.printInvoice');
    Route::get('/download-sells/{transaction_id}/pdf', [SellPosController::class, 'downloadPdf'])->name('sell.downloadPdf');
    Route::get('/download-quotation/{id}/pdf', [SellPosController::class, 'downloadQuotationPdf'])->name('quotation.downloadPdf');
    Route::get('/download-packing-list/{id}/pdf', [SellPosController::class, 'downloadPackingListPdf'])->name('packing.downloadPdf');
    Route::get('/sells/invoice-url/{id}', [SellPosController::class, 'showInvoiceUrl']);
    Route::get('/show-notification/{id}', [HomeController::class, 'showNotification']);
});
