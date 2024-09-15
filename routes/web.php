<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\WebsiteController;

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

Route::any('/admin',[AdminController::class,'login']);

Route::any('/admin/login',[AdminController::class,'login'])->name('admin.postlogin');;

// Route::group(['middleware' => 'admin.login'], function () 
// {
// });

//Admin 
Route::group(['middleware' => 'admin.login'], function () 
{	
	//Admin
	Route::any('/admin/create-admin',[AdminController::class,'create_admin'])->name('admin.create-admin');
	Route::post('/admin/updateadmin', [AdminController::class, 'updateAdmin'])->name('admin.updateadmin');
	Route::any('/admin/deleteadmin/{id}', [AdminController::class, 'deleteadmin'])->name('admin.deleteadmin');

	//Category
	Route::any('/admin/menu-category',[AdminController::class,'category_menu'])->name('admin.category_menu');
	Route::post('/admin/updatecategory', [AdminController::class, 'updateCategory'])->name('admin.updatecategory');
	Route::any('/admin/deletecategory/{id}', [AdminController::class, 'deletecategory'])->name('admin.deletecategory');

	Route::any('/admin/orders',[AdminController::class,'orderslist']);
	Route::any('/admin/allergy',[AdminController::class,'allergy']);
	Route::any('/admin/dashboard',[AdminController::class,'dashboard']);
	
	Route::any('/admin/logout',[AdminController::class,'logout']);

	//Allergy
	Route::any('/admin/allergy',[AdminController::class,'allergy'])->name('admin.allergy');
	Route::post('/admin/updateallergy', [AdminController::class, 'updateAllergy'])->name('admin.updateallergy');
	Route::any('/admin/deleteallergy/{id}', [AdminController::class, 'deleteallergy'])->name('admin.deleteallergy');

	//Food Menu   
	Route::any('/admin/food-menu',[AdminController::class,'food_menu'])->name('admin.food-menu');
	Route::post('/admin/updatefoodmenu', [AdminController::class, 'updateFoodMenu'])->name('admin.updatefoodmenu');
	Route::any('/admin/deletefoodmenu/{id}', [AdminController::class, 'deletefoodmenu'])->name('admin.deletefoodmenu');
	Route::any('/admin/update-status', [AdminController::class, 'updateStatus'])->name('admin.update-status');

	//Meal -Plan
	Route::any('/admin/meal-plan',[AdminController::class,'meal_plan'])->name('admin.meal-plan');
	Route::post('/admin/updatemealplan', [AdminController::class, 'updateMealPlan'])->name('admin.updatemealplan');
	Route::any('/admin/deletemealplan/{id}', [AdminController::class, 'deletemealplan'])->name('admin.deletemealplan');
	Route::any('/admin/fetch-menu', [AdminController::class, 'fetchMenu'])->name('admin.fetch-menu');
	Route::post('/admin/save-food-selection', [AdminController::class, 'saveFoodSelection'])->name('admin.saveFoodSelection');

	
	//Delivery Location
	Route::any('/admin/delivery-location',[AdminController::class,'delivery_location'])->name('admin.delivery-location');
	Route::post('/admin/updatedeliveryloc', [AdminController::class, 'updateDeliveryLoc'])->name('admin.updatedeliveryloc');
	Route::any('/admin/deletedeliveryloc/{id}', [AdminController::class, 'deletedeliveryloc'])->name('admin.deletedeliveryloc');
	Route::any('/admin/delivery-status', [AdminController::class, 'deliveryStatus'])->name('admin.delivery-status');

	//Membership Plan
	Route::any('/admin/membership-plan',[AdminController::class,'membershipPlan'])->name('admin.membership-plan');
	Route::post('/admin/updateplan', [AdminController::class, 'updateMembership'])->name('admin.updateplan');
	Route::any('/admin/deleteplan/{id}', [AdminController::class, 'deletemembership'])->name('admin.deleteplan');

	//Delivery Team
	Route::any('/admin/delivery-team',[AdminController::class,'deliveryTeam'])->name('admin.delivery-team');
	Route::post('/admin/updateteam', [AdminController::class, 'updateTeam'])->name('admin.updateteam');
	Route::any('/admin/deleteteam/{id}', [AdminController::class, 'deleteteam'])->name('admin.deleteteam');

	//Inventory
	Route::any('/admin/inventory',[AdminController::class,'inventory'])->name('admin.inventory');
	Route::post('/admin/updateinventory', [AdminController::class, 'updateInventory'])->name('admin.updateinventory');
	Route::any('/admin/deleteinventory/{id}', [AdminController::class, 'deleteinventory'])->name('admin.deleteinventory');
	Route::any('/admin/inventory-status', [AdminController::class, 'inventoryStatus'])->name('admin.inventory-status');

	//User Detail
	Route::any('/admin/user-detail',[AdminController::class,'userDetail'])->name('admin.user-detail');
	Route::post('/admin/updateuser', [AdminController::class, 'updateUser'])->name('admin.updateuser');
	Route::any('/admin/deleteuser/{id}', [AdminController::class, 'deleteuser'])->name('admin.deleteuser');

	//Pickup Delivery
	Route::any('/admin/pickup-delivery',[AdminController::class,'pickupDelivery'])->name('admin.pickup-delivery');
	Route::post('/admin/updatepickup', [AdminController::class, 'updatePickupDel'])->name('admin.updatepickup');
	Route::any('/admin/deletepickup/{id}', [AdminController::class, 'deletepickup'])->name('admin.deletepickup');

	//Pickup Delivery
	Route::any('/admin/order-list',[AdminController::class,'orderList'])->name('admin.order-list');
	Route::any('/admin/freeze-membership',[AdminController::class,'freezeMembership'])->name('admin.freeze-membership');
	Route::get('/order/next-start-date/{orderId}', [AdminController::class, 'getUpcomingMembershipStartDate'])->name('order.upcoming-start-date');
	Route::post('/pause-membership', [AdminController::class, 'pauseMembership'])->name('pause.membership');

	Route::any('/admin/coupon',[AdminController::class,'coupon'])->name('admin.coupon');
    Route::post('/admin/updatecoupon', [AdminController::class, 'updateCoupon'])->name('admin.updatecoupon');
    Route::any('/admin/deletecoupon/{id}', [AdminController::class, 'deletecoupon'])->name('admin.deletecoupon');
    Route::any('/admin/coupon-status', [AdminController::class, 'couponStatus'])->name('admin.coupon-status');

    //Order Report
    Route::any('/admin/orders',[AdminController::class,'orderslist']);
    Route::any('/admin/orders-report',[AdminController::class,'ordersReport']);
    Route::get('/admin/export-order-csv', [AdminController::class, 'exportCsv']);

	Route::any('/admin/generate-plan/{id}', [AdminController::class, 'generate_plan'])->name('admin.generate-plan');
	Route::any('/admin/view-order/{id}',[AdminController::class,'OrderDetail'])->name('admin.view-order');
	Route::any('/admin/order-status', [AdminController::class, 'updateOrderStatus'])->name('admin.order-status');
	
	Route::post('/admin/update-meal', [AdminController::class, 'updateMeal'])->name('admin.updateMeal');
	Route::any('/admin/meals', [AdminController::class, 'getMeals'])->name('admin.getMeals');

});



// Website
Route::any('/',[WebsiteController::class,'index']);
Route::any('/login',[WebsiteController::class,'login'])->name('login');
Route::any('/logout', [WebsiteController::class, 'logout'])->name('logout');
Route::any('/register',[WebsiteController::class,'register'])->name('register');
Route::any('/contactus',[WebsiteController::class,'contactUs'])->name('contactus');
Route::any('/ourmenu',[WebsiteController::class,'ourMenu']);
Route::any('/howitworks',[WebsiteController::class,'howItWorks']);
Route::any('/faq',[WebsiteController::class,'Faq']);
Route::any('/blogs',[WebsiteController::class,'blogs']);
Route::any('/privacypolicy',[WebsiteController::class,'privacyPolicy'])->name('privacypolicy');
Route::any('/termsofservice',[WebsiteController::class,'termsConditions'])->name('termsofservice');
Route::any('/refundpolicy',[WebsiteController::class,'refundPolicy'])->name('refundpolicy');


Route::any('/mealplans1/{id}',[WebsiteController::class,'mealPlans1'])->name('mealplans1');
Route::any('/mealsplan2',[WebsiteController::class,'mealPlans2'])->name('mealsplan2');
Route::any('/fetch-generated-plans',[WebsiteController::class,'getGeneratedPlans'])->name('fetch-generated-plans');

Route::any('/cart',[WebsiteController::class,'addToCart'])->name('cart');
Route::any('/meal-options',[WebsiteController::class,'getMealOptions']);
Route::any('/meals',[WebsiteController::class,'getMeals']);
Route::any('/my-account',[WebsiteController::class,'user_account']);
Route::any('/update-account', [WebsiteController::class, 'updateAccount'])->name('update-account');

Route::get('/get-allergy-options', [WebsiteController::class, 'getAllergyOptions'])->name('get-allergy-options');
Route::any('/checkout',[WebsiteController::class,'checkoutPage'])->name('checkout');
Route::any('/order-place',[WebsiteController::class,'placeOrderPage'])->name('order-place');
Route::any('/order-detail/{id}',[WebsiteController::class,'userOrderDetail'])->name('order-detail');

Route::any('/replace-meal',[WebsiteController::class,'replaceMeal'])->name('replace-meal');
Route::any('/get-meal-data/{mealId}',[WebsiteController::class,'getMealData'])->name('get-meal-data');
