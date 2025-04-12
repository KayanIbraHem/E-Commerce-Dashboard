<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product\Product\Product;
use App\Http\Controllers\Dashboard\Cart\CartController;
use App\Http\Controllers\Dashboard\Order\OrderController;
use App\Http\Controllers\Dashboard\Coupon\CouponController;
use App\Http\Controllers\Dashboard\Driver\DriverController;
use App\Http\Controllers\Dashboard\Product\ProductController;
use App\Http\Controllers\Dashboard\Category\CategoryController;
use App\Http\Controllers\Dashboard\Position\PositionController;
use App\Http\Controllers\Dashboard\Geography\Area\AreaController;
use App\Http\Controllers\Dashboard\Geography\City\CityController;
use App\Http\Controllers\Dashboard\Permission\PermissionController;
use App\Http\Controllers\Dashboard\Product\ProductDetailsController;
use App\Http\Controllers\Dashboard\EndPoint\City\FetchCityController;
use App\Http\Controllers\Dashboard\ShippingType\ShippingTypeController;
use App\Http\Controllers\Dashboard\Employee\Employee\EmployeeController;
use App\Http\Controllers\Dashboard\ClientAddress\ClientAddressController;
use App\Http\Controllers\Dashboard\ComplaintType\ComplaintTypeController;
use App\Http\Controllers\Dashboard\Employee\Auth\EmployeeLoginController;
use App\Http\Controllers\Dashboard\EndPoint\Client\FetchClientController;
use App\Http\Controllers\Dashboard\EndPoint\Coupon\ApplyCouponController;
use App\Http\Controllers\Dashboard\Employee\Auth\EmployeeLogoutController;
use App\Http\Controllers\Dashboard\EndPoint\Client\SearchClientController;
use App\Http\Controllers\Dashboard\EndPoint\Search\GlobalSearchController;
use App\Http\Controllers\Dashboard\EndPoint\Cart\CartItemDetailsController;
use App\Http\Controllers\Dashboard\EndPoint\Product\SearchProductController;
use App\Http\Controllers\Dashboard\EndPoint\Position\FetchPositionController;
use App\Http\Controllers\Dashboard\Employee\Profile\EmployeeProfileController;
use App\Http\Controllers\Dashboard\Geography\Governorate\GovernorateController;
use App\Http\Controllers\Dashboard\EndPoint\Permission\FetchPermissionController;
use App\Http\Controllers\Dashboard\Employee\Auth\EmployeeChangePasswordController;
use App\Http\Controllers\Dashboard\EndPoint\Client\FetchClientAddressesController;
use App\Http\Controllers\Dashboard\Employee\Profile\EmployeeProfileImageController;
use App\Http\Controllers\Dashboard\EndPoint\Governorate\FetchGovernorateController;
use App\Http\Controllers\Dashboard\EndPoint\Order\FetchOrderProductDetailsController;
use App\Http\Controllers\Dashboard\EndPoint\ShippingType\FetchShippingTypeController;
use App\Http\Controllers\Dashboard\EndPoint\ComplaintType\FetchComplaintTypeController;
use App\Http\Controllers\Dashboard\Employee\Notification\NotificationSettingsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/



Route::group(
    [
        "prefix" => "dashboard",
    ],
    function () {
        // // //CART
        // Route::controller(CartController::class)->group(function () {
        //     Route::post('add_item_to_cart', 'addItemToCart');
        //     Route::get('show_cart_items', 'showCartItems');
        //     Route::get('show_cart_item/{item}', 'showCartItems');
        //     Route::delete('remove_item_from_cart/{item}', 'removeItemFromCart');
        // });
        //AUTH
        Route::post('employee_login', EmployeeLoginController::class);
        Route::group(['middleware' => ['auth:employee']], function () {

            //CHANGE PASSWORD
            Route::post('employee_change_password', EmployeeChangePasswordController::class);
            //LOGOUT
            Route::post('employee_logout', EmployeeLogoutController::class);

            /*ENDPOINT START*/
            //POSITION
            Route::get('fetch_positions', FetchPositionController::class);
            //PERMISSION
            Route::get('fetch_permissions', FetchPermissionController::class);
            //SHIPPING TYPE
            Route::get('fetch_shipping_types', FetchShippingTypeController::class);
            //GOVERNORATE
            Route::get('fetch_governorates', FetchGovernorateController::class);
            //CITY
            Route::get('fetch_cities', FetchCityController::class);
            //COMPLAINT TYPE
            Route::get('fetch_complaint_types', FetchComplaintTypeController::class);
            //CLIENT ADDRESS
            Route::get('fetch_client_addresses/{client}', FetchClientAddressesController::class);
            //CART
            Route::get('cart_item_details/{product}', CartItemDetailsController::class);
            //APPLY COUPON
            Route::post('apply_coupon', ApplyCouponController::class);
            /*ENDPOINT END*/

            /*QUERIES START*/
            //CLIENT
            Route::post('search_client', SearchClientController::class);
            //PRODUCT
            Route::post('search_product', SearchProductController::class);
            //GLOBAL SEARCH
            Route::post('global_search', GlobalSearchController::class);
            /*QUERIES END*/

            /*EMPLOYEE PROFILE START*/
            //EMPLOYEE
            Route::controller(EmployeeController::class)->group(function () {
                Route::post('store_employee', 'store');
                Route::post('employees', 'index');
                Route::post('update_employee/{employee}', 'update');
                Route::get('show_employee/{employee}', 'show');
                Route::delete('delete_employee/{employee}', 'delete');
            });
            //EMPLOYEE PROFILE
            Route::controller(EmployeeProfileController::class)->group(function () {
                Route::post('update_employee_profile', 'updateProfile');
                Route::get('show_employee_profile', 'showProfile');
            });
            Route::post('delete_employee_profile_image', EmployeeProfileImageController::class);
            //NOTIFICATION SETTINGS
            Route::controller(NotificationSettingsController::class)->group(function () {
                Route::post('change_employee_notification_sound_status', 'changeNotificationSoundStatus');
                Route::post('change_employee_send_notifications_to_email_status', 'changeSendNotificationsToEmailStatus');
                Route::post('change_employee_show_notification_status', 'changeShowNotificationStatus');
            });
            /*EMPLOYEE PROFILE END*/

            //POSITION
            Route::controller(PositionController::class)->group(function () {
                Route::post('store_position', 'store');
                Route::post('positions', 'index');
                Route::get('show_position/{position}', 'show');
                Route::post('update_position/{position}', 'update');
                Route::delete('delete_position/{position}', 'delete');
            });
            //PERMISSION
            Route::controller(PermissionController::class)->group(function () {
                Route::post('store_permission', 'store');
                Route::post('permissions', 'index');
                Route::post('update_permission/{permission}', 'update');
                Route::get('show_permission/{permission}', 'show');
                Route::delete('delete_permission/{permission}', 'delete');
            });
            //SHIPPING TYPE
            Route::controller(ShippingTypeController::class)->group(function () {
                Route::post('store_shippingType', 'store');
                Route::post('shippingTypes', 'index');
                Route::post('update_shippingType/{shippingType}', 'update');
                Route::get('show_shippingType/{shippingType}', 'show');
                Route::delete('delete_shippingType/{shippingType}', 'delete');
            });
            //DRIVER
            Route::controller(DriverController::class)->group(function () {
                Route::post('store_driver', 'store');
                Route::post('drivers', 'index');
                Route::post('update_driver/{driver}', 'update');
                Route::get('show_driver/{driver}', 'show');
                Route::delete('delete_driver/{driver}', 'delete');
            });

            /*GEOGRAPHY START*/
            //GOVERNORATE
            Route::controller(GovernorateController::class)->group(function () {
                Route::post('store_governorate', 'store');
                Route::post('governorates', 'index');
                Route::post('update_governorate/{governorate}', 'update');
                Route::get('show_governorate/{governorate}', 'show');
                Route::delete('delete_governorate/{governorate}', 'delete');
            });
            //CITY
            Route::controller(CityController::class)->group(function () {
                Route::post('store_city', 'store');
                Route::post('cities', 'index');
                Route::post('update_city/{city}', 'update');
                Route::get('show_city/{city}', 'show');
                Route::delete('delete_city/{city}', 'delete');
            });
            //AREA
            Route::controller(AreaController::class)->group(function () {
                Route::post('store_area', 'store');
                Route::post('areas', 'index');
                Route::post('update_area/{area}', 'update');
                Route::get('show_area/{area}', 'show');
                Route::delete('delete_area/{area}', 'delete');
            });
            /*GEOGRAPHY END*/

            //CATEGORY
            Route::controller(CategoryController::class)->group(function () {
                Route::post('store_category', 'store');
                Route::post('categories', 'index');
                Route::post('update_category/{category}', 'update');
                Route::get('show_category/{category}', 'show');
                Route::delete('delete_category/{category}', 'delete');
            });

            /*PRODUCT START*/
            //PRODUCT
            Route::controller(ProductController::class)->group(function () {
                Route::post('store_product', 'store');
                Route::post('products', 'index');
                Route::post('update_product/{product}', 'update');
                Route::get('show_product/{product}', 'show');
                Route::delete('delete_product/{product}', 'delete');
            });
            //PRODUCT DETAILS
            Route::get('product_details/{product}', ProductDetailsController::class);
            /*PRODUCT END*/

            //COMPLAINT TYPE
            Route::controller(ComplaintTypeController::class)->group(function () {
                Route::post('store_complaintType', 'store');
                Route::post('complaintTypes', 'index');
                Route::get('show_complaintType/{complaintType}', 'show');
                Route::post('update_complaintType/{complaintType}', 'update');
                Route::delete('delete_complaintType/{complaintType}', 'delete');
            });
            /*CLIENT START*/
            //CLIENT ADDRESSES
            Route::controller(ClientAddressController::class)->group(function () {
                Route::post('store_clientAddress', 'store');
                Route::post('clientAddresses', 'index');
                Route::get('show_clientAddress/{clientAddress}', 'show');
                Route::post('update_clientAddress/{clientAddress}', 'update');
                Route::delete('delete_clientAddress/{clientAddress}', 'delete');
            });
            /*CLIENT END*/

            //COUPON
            Route::controller(CouponController::class)->group(function () {
                Route::post('store_coupon', 'store');
                Route::post('coupons', 'index');
                Route::get('show_coupon/{coupon}', 'show');
                Route::post('update_coupon/{coupon}', 'update');
                Route::delete('delete_coupon/{coupon}', 'delete');
            });
            //CART
            Route::controller(CartController::class)->group(function () {
                Route::post('add_item_to_cart', 'addItemToCart');
                Route::get('show_cart_items', 'showCartItems');
                Route::get('show_cart_item/{item}', 'showCartItems');
                Route::delete('remove_item_from_cart/{item}', 'removeItemFromCart');
            });
            //ORDER
            Route::controller(OrderController::class)->group(function () {
                Route::post('store_order', 'store');
                Route::post('orders', 'index');
                Route::get('show_order/{order}', 'show');
                Route::get('update_order/{order}', 'update');
                Route::delete('delete_order/{order}', 'delete');
            });
        });
    }
);
