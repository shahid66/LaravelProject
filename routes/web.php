<?php

use App\Http\Controllers\AccountsController;
use App\Http\Controllers\admin\ChangeImageController;
use App\Http\Controllers\AdminListController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactListController;
use App\Http\Controllers\CustomOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NamajTimeController;
use App\Http\Controllers\NotificationListController;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\PaymentTestController;
use App\Http\Controllers\ProductDetailsController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\ProductReviewController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SiteInfoController;
use App\Http\Controllers\SiteSEOController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SMSTestController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\VideController;
use App\Http\Controllers\VisitorListController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'HomePage'])->middleware('loginCheck');
Route::get('/HomeSummary', [HomeController::class,'HomeSummary'])->middleware('loginCheck');

//login
Route::get('/SignIn',  [AdminLoginController::class,'SignIn'])->name('login');
Route::post('/OnSignIn',  [AdminLoginController::class,'OnSignIn']);
Route::get('/OnLogOut',  [AdminLoginController::class,'OnLogOut']);

//user profile
Route::get('/userProfile/{email}',  [AdminLoginController::class,'UserProfile']);
Route::get('/userDetails/{id}',  [UserDetailsController::class,'UserDetailsIndex']);
Route::post('/UserPaymentInsert', [UserDetailsController::class,'UserPaymentInsert']);
Route::get('/userPaymentList/{id}',  [UserDetailsController::class,'UserDetailsDataList']);
Route::post('/PaymentListDelete', [UserDetailsController::class,'PaymentListDelete'])->middleware('loginCheck');


Route::get('/VisitorListPage', [VisitorListController::class,'VisitorListPage'])->middleware('loginCheck');
Route::get('/VisitorListData', [VisitorListController::class,'VisitorListData'])->middleware('loginCheck');


Route::get('/NotificationListPage', [NotificationListController::class,'NotificationListPage'])->middleware('loginCheck');
Route::get('/NotificationListData', [NotificationListController::class,'NotificationListData'])->middleware('loginCheck');
Route::post('/CreateNotification', [NotificationListController::class,'CreateNotification'])->middleware('loginCheck');


Route::get('/ContactListPage', [ContactListController::class,'ContactListPage'])->middleware('loginCheck');
Route::get('/ContactListData', [ContactListController::class,'ContactListData'])->middleware('loginCheck');
Route::post('/ContactListDelete', [ContactListController::class,'ContactListDelete'])->middleware('loginCheck');


Route::get('/AdminListPage', [AdminListController::class,'AdminListPage'])->middleware('loginCheck');
Route::get('/AdminListData', [AdminListController::class,'AdminListData'])->middleware('loginCheck');
Route::post('/AdminAdd', [AdminListController::class,'AdminAdd'])->middleware('loginCheck');
Route::get('/AdminListPage/{id}', [AdminListController::class,'AdminListPageByID'])->middleware('loginCheck');
Route::post('/AdminListDelete', [AdminListController::class,'AdminListDelete'])->middleware('loginCheck');



Route::get('/AboutPage', [SiteInfoController::class,'AboutPage'])->middleware('loginCheck');
Route::get('/TermsPage', [SiteInfoController::class,'TermsPage'])->middleware('loginCheck');
Route::get('/PolicyPage', [SiteInfoController::class,'PolicyPage'])->middleware('loginCheck');
Route::get('/PurchasePage', [SiteInfoController::class,'PurchasePage'])->middleware('loginCheck');
Route::get('/AddressPage', [SiteInfoController::class,'AddressPage'])->middleware('loginCheck');
Route::get('/AboutCompanyPage', [SiteInfoController::class,'AboutCompanyPage'])->middleware('loginCheck');


// Route::get('/MobileAppPage', [SiteInfoController::class,'MobileAppPage'])->middleware('loginCheck');
// Route::get('/SocialPage', [SiteInfoController::class,'SocialPage'])->middleware('loginCheck');


Route::get('/GetSiteInfoDetails', [SiteInfoController::class,'GetSiteInfoDetails']);
Route::post('/UpdateSiteInfo', [SiteInfoController::class,'UpdateSiteInfo'])->middleware('loginCheck');


//Blog
Route::get('/BlogPage', [BlogController::class,'BlogPage'])->middleware('loginCheck');
Route::get('/BlogListData', [BlogController::class,'BlogListData']);
Route::post('/BlogAdd', [BlogController::class,'BlogAdd'])->middleware('loginCheck');
Route::post('/BlogListDelete', [BlogController::class,'BlogDelete'])->middleware('loginCheck');
Route::post('/BlogListEditData', [BlogController::class,'BlogListEditData'])->middleware('loginCheck');
Route::post('/BlogListEdit', [BlogController::class,'BlogDataEdit'])->middleware('loginCheck');
Route::post('/ChangeBlogImage', [BlogController::class,'ChangeBlogImage'])->middleware('loginCheck');

Route::get('/GetOthersSiteInfoIndex', [SiteInfoController::class,'GetOthersSiteInfoIndex'])->middleware('loginCheck');
Route::get('/GetOthersSiteInfoDetails', [SiteInfoController::class,'GetOthersSiteInfoDetails']);
Route::post('/GetOthersSiteInfoDetailsAdd', [SiteInfoController::class,'GetOthersSiteInfoDetailsAdd'])->middleware('loginCheck');
Route::post('/GetOtherOnesEdit', [SiteInfoController::class,'GetOtherOnesEdit'])->middleware('loginCheck');
Route::post('/GetOtherOnesEditConfirm', [SiteInfoController::class,'GetOtherOnesEditConfirm'])->middleware('loginCheck');







//Slider
Route::get('/SliderListPage', [SliderController::class,'SliderListPage'])->middleware('loginCheck');
Route::get('/SliderListData', [SliderController::class,'SliderListData']);
// Route::get('/GetProductCode', [SliderController::class,'GetProductCode'])->middleware('loginCheck');
Route::post('/SliderAdd', [SliderController::class,'SliderAdd'])->middleware('loginCheck');
Route::post('/SliderDelete', [SliderController::class,'SliderDelete'])->middleware('loginCheck');
Route::post('/ChangeSliderImage', [SliderController::class,'ChangeSliderImage'])->middleware('loginCheck');
// Route::post('/SliderListEditData', [SliderController::class,'SliderListEditData'])->middleware('loginCheck');
// Route::post('/SliderDataEdit', [SliderController::class,'SliderDataEdit'])->middleware('loginCheck');

//Committee
Route::get('/CommitteeListPage', [SliderController::class,'CommitteeListPage'])->middleware('loginCheck');
Route::get('/CommitteeListData', [SliderController::class,'CommitteeListData']);
// Route::get('/GetProductCode', [SliderController::class,'GetProductCode'])->middleware('loginCheck');
Route::post('/CommitteeAdd', [SliderController::class,'CommitteeAdd'])->middleware('loginCheck');
Route::post('/CommitteeDelete', [SliderController::class,'CommitteeDelete'])->middleware('loginCheck');
Route::post('/ChangeCommitteeImage', [SliderController::class,'ChangeCommitteeImage'])->middleware('loginCheck');

//Namaj
Route::get('/NamajListPage', [NamajTimeController::class,'NamajPage'])->middleware('loginCheck');
Route::get('/NamajListData', [NamajTimeController::class,'NamajData']);

Route::post('/NamajAdd', [NamajTimeController::class,'NamajAdd'])->middleware('loginCheck');
Route::post('/NamajDelete', [NamajTimeController::class,'NamajDelete'])->middleware('loginCheck');
// Route::post('/NamajListEdit', [NamajTimeController::class,'BlogDataEdit'])->middleware('loginCheck');

//Accounts
Route::get('/AccountPage', [AccountsController::class,'AccountPage'])->middleware('loginCheck');
Route::get('/SaveAmountList', [AccountsController::class,'SaveAmountList'])->middleware('loginCheck');
Route::post('/SaveAmountAdd', [AccountsController::class,'SaveAmountAdd'])->middleware('loginCheck');

Route::post('/CostAmountAdd', [AccountsController::class,'CostAmountAdd'])->middleware('loginCheck');
Route::get('/CostAmountList', [AccountsController::class,'CostAmountList'])->middleware('loginCheck');
Route::post('/CostAmountListDelete', [AccountsController::class,'CostAmountListDelete'])->middleware('loginCheck');
Route::post('/SaveAmountListDelete', [AccountsController::class,'SaveAmountListDelete'])->middleware('loginCheck');


Route::post('/CatagoriestAdd', [AccountsController::class,'CatagoriestAdd'])->middleware('loginCheck');
Route::get('/CatagoriesList', [AccountsController::class,'CatagoriesList'])->middleware('loginCheck');
Route::post('/CatagoriesListDelete', [AccountsController::class,'CatagoriesListDelete'])->middleware('loginCheck');

// video

Route::get('/VideoIndex', [VideController::class,'VideoIndex'])->middleware('loginCheck');
Route::get('/VideoDataList', [VideController::class,'VideoDataList']);
Route::post('/VideoAdd', [VideController::class,'VideoAdd'])->middleware('loginCheck');
Route::post('/VideoDelete', [VideController::class,'VideoDelete'])->middleware('loginCheck');

Route::get('/VideoDataListLimit', [VideController::class,'VideoDataListLimit']);

// Search

Route::get('/searchSaveAmountIndex', [VideController::class,'searchSaveAmountIndex'])->middleware('loginCheck');
Route::get('/searchSaveCostIndex', [VideController::class,'searchSaveCostIndex'])->middleware('loginCheck');
Route::get('/searchSaveAmount/{catagories}/{fromDate}/{toDate}/{fromYear}', [VideController::class,'SearchByMonth']);
Route::get('/SearchByMonthCostAmount/{catagories}/{fromDate}/{toDate}/{fromYear}', [VideController::class,'SearchByMonthCostAmount']);
