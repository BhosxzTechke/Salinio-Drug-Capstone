<?php

use App\Http\Controllers\AdminAiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\CustomersGoogleController;
use App\Http\Controllers\backend\EmployeesController;
use App\Http\Controllers\backend\CustomerController;
use App\Http\Controllers\backend\SupplierController;
use App\Http\Controllers\backend\SalaryController;
use App\Http\Controllers\backend\AttendanceController;
use App\Http\Controllers\backend\BrandController;
use App\Http\Controllers\backend\CategoryController;
use App\Http\Controllers\backend\CommerceController;
use App\Http\Controllers\backend\DeliveryController;
use App\Http\Controllers\backend\ProductController;
use App\Http\Controllers\backend\ExpenseController;
use App\Http\Controllers\backend\HeroSliderController;
use App\Http\Controllers\backend\InventoryController;
use App\Http\Controllers\backend\OnlinePaymentController;
use App\Http\Controllers\backend\PosController;
use App\Http\Controllers\backend\OrderController;
use App\Http\Controllers\backend\PurchaseOrderController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\SubCategoryController;
use App\Http\Controllers\backend\AuditController;
use App\Http\Controllers\backend\ReportController;
use App\Http\Controllers\backend\ReturnShipmentController as BackendReturnShipmentController;
use App\Http\Controllers\backend\RiderController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\frontend\AboutController;
use App\Http\Controllers\frontend\AuthCustomerController;
use App\Http\Controllers\frontend\BrandController as FrontendBrandController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\frontend\ContactController;
use App\Http\Controllers\frontend\CustomerRegisteredController;
use App\Http\Controllers\frontend\OrderController as FrontendOrderController;
use App\Http\Controllers\frontend\ReturnShipmentController;
use App\Http\Controllers\frontend\WishlistController;
use App\Http\Controllers\SupplierConfirmationController;
use App\Models\HeroSlider;  
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// |--------------------------------------------------------------------------
// | AI ROUTES
// |--------------------------------------------------------------------------

        Route::get('/admin/show', [AdminAiController::class, 'AiChatShow'])->name('ai.admin.chat');
        Route::post('/admin/ai-chat', [AdminAiController::class, 'ask'])->name('ai.admin.ask');



// |--------------------------------------------------------------------------
// | CORRIER Routes
// |--------------------------------------------------------------------------


    Route::get('/track/{tracking_number}', function($tracking_number, \App\Services\MockCourierService $courier){
        $shipment = $courier->getShipment($tracking_number);

        if(!$shipment){
            return response()->json(['error'=>'Tracking not found'], 404);
        }

        return response()->json([
            'tracking_number' => $shipment->tracking_number,
            'delivery_status' => $shipment->delivery_status,
            'last_update' => $shipment->updated_at
        ]);
    });


    Route::get('/order/{order}/shipment-status', [OrderController::class, 'shipmentStatus']);


// ---------------- PUBLIC ROUTES ----------------

            // Ecommerce home page (guest or logged in)
            Route::get('/', function () {
                return view('Ecommerce.home');
            })->name('home');



// |--------------------------------------------------------------------------
// | ADMIN Routes
// |--------------------------------------------------------------------------



            Route::controller(AdminController::class)->group(function () {

                // Only authenticated admins can logout
                Route::middleware('auth:web')->group(function () {
                Route::post('/admin/logout', 'destroy')->name('admin.logout');
                });


                // Public logout confirmation page
                Route::get('/logout', [AdminController::class, 'Logout'])->name('logout.page');

            });







            // TO PROTECT THE URL BY MANIPULATING IT IN DASHBOARD MAIN

                Route::middleware(['auth', 'web'])->group(function () {


                Route::get('/profile/view', [AdminController::class, 'Viewprofile'])->name('view.profile');
                Route::post('/profile/view/store', [AdminController::class, 'StoreProfile'])->name('admin.profile.store');
                Route::get('/profile/changePassword', [AdminController::class, 'ChangePassword'])->name('admin.change.password');
                Route::post('/profile/changePassword/store', [AdminController::class, 'UpdatePassword'])->name('password.change.store');    


                //////////// CHAT SYSTEM

                    Route::post('/chat/send', [ChatController::class, 'send']);
                    Route::get('/chat/fetch/{userId}', [ChatController::class, 'fetch']);

                    Route::get('/admin/chats', [ChatController::class, 'adminChats'])
                            ->name('view.admin.chat');

        });




        Route::get('/test-email', function () {
            Mail::raw('Test email from Salinio Drug Pharmacy system.', function ($message) {
                $message->to('tarucjohneric19@gmail.com')
                        ->subject('SMTP Test - Laravel');
            });

            return 'Email sent!';
        });




        //////////////////     MANAGE CUSTOMER       ////////////////////

        // Route::middleware(['auth', 'web'])->group(function () {


        //         Route::controller(CustomerController::class)->group(function () {
        //         //Showing Data in table
        //         Route::get('/customer/all', 'CustomerTable')->name('all.customer')->middleware('permission:view-all-customers');



        //             // form customer
        //         Route::get('/customer/create', 'AddFormCustomer')->name('create.customer')->middleware('permission:add-customer');


        //             // store customer
        //         Route::post('/customer/store', 'StoreFormCustomer')->name('store.customer');


        //             // Editing customer
        //         Route::get('/customer/edit{id}', 'EditFormCustomer')->name('edit.customer')->middleware('permission:edit-customer');


        //         // Editing customer
        //         Route::put('/customer/update', 'UpdateFormCustomer')->name('update.customer');


        //         Route::get('/customer/delete/{id}', 'DeleteCustomer')->name('delete.customer')->middleware('permission:delete-customer');

        //     });


        // });





            //////////////////     MANAGE SUPPLIER       ////////////////////


            Route::middleware(['auth', 'web'])->group(function () {

            Route::controller(SupplierController::class)->group(function () {

            //Showing Data in table
            Route::get('/supplier', 'SupplierTable')->name('all.supplier');

             //Showing AddSupplier Form 
            Route::get('/supplier/create', 'AddFormSupplier')->name('supplier.create');

             //Store Supplier fORM 
            Route::post('/supplier/store', 'StoreFormSupplier')->name('store.supplier');


                       //Edit Supplier Form 
            Route::get('/supplier/edit/{id}', 'EditFormSupplier')->name('edit.supplier');



                                 //Dekete Supplier Form 
            Route::get('/supplier/delete/{id}', 'DeleteFormSupplier')->name('delete.supplier');



         //Update Supplier fORM 
            Route::put('/supplier/update', 'UpdateSupplier')->name('update.supplier');


         //View Supplier fORM 
            Route::get('/supplier/details/{id}', 'DetailsSupplier')->name('details.supplier');

            

        });


    });




        ////////////////////// MANAGE CATEGORY ///////////////////////


        Route::middleware(['auth', 'web'])->group(function () {
        
            Route::controller(CategoryController::class)->group(function () {

            //Showing Data in table
            Route::get('/category/list', 'CategoryTable')->name('category.list');


             //Showing Data in table
            Route::post('/category/store', 'CategoryStore')->name('store.category');

            
            //Edit Data in table
            Route::get('/category/edit/{id}', 'CategoryEdit')->name('edit.category');


            //Update Data in table
            Route::put('/category/update', 'CategoryUpdate')->name('update.category');

            

            //Delete Data in table
            Route::get('/category/delete/{id}', 'CategoryDelete')->name('delete.category')->middleware('permission:delete-category');

            
        });

        });


                    ////////////////////// MANAGE SUB CATEGORY ///////////////////////


        
        
Route::middleware(['auth', 'web'])->group(function () {

        Route::controller(SubCategoryController::class)->group(function () {

            //Showing Data in table
            Route::get('/sub-category/list', 'SubCategoryTable')->name('sub-category.list');


            //Showing form
            Route::get('/sub-category/create', 'SubCategoryCreate')->name('sub-category.create');


            //Store Data in table
            Route::post('/sub-category/store', 'SubCategoryStore')->name('sub-category.store');
            

            //Edit Data in table
            Route::get('/sub-category/edit/{id}', 'EditSubCategory')->name('edit.sub-category');


            //Update Data in table
            Route::put('/sub-category/update', 'SubCategoryUpdate')->name('update.sub-category');


            //Delete Data in table
            Route::get('/sub-category/delete/{id}', 'DeleteSubCategory')->name('delete.sub-category');
        });


    });



                    ////////////////////// MANAGE BRAND ///////////////////////


                
                Route::middleware(['auth', 'web'])->group(function () {
        
                    Route::controller(BrandController::class)->group(function () {

                    //Showing Data in table
                    Route::get('/brand/list', 'BrandTable')->name('brand.list');


                    //Showing form
                    Route::get('/brand/create', 'CreateBrand')->name('brand.create');

                    //Store Data in table
                    Route::post('/brand/store', 'StoreBrand')->name('brand.store');

                    //Edit Data in table
                    Route::get('/brand/edit/{id}', 'EditBrand')->name('edit.brand');

                        
                    //Update Data in table
                    Route::put('/brand/update', 'UpdateBrand')->name('update.brand');


                    //Delete Data in table
                    Route::get('/brand/delete/{id}', 'DeleteBrand')->name('delete.brand');
                    

                });


        });





        Route::middleware(['auth', 'web'])->group(function () {


            Route::controller(ProductController::class)->group(function () {

            //Showing Data in table
            Route::get('/product/list', 'ProductTable')->name('product.list');

             //Showing form 
            Route::get('/product/create', 'FormDropdownProduct')->name('add.product');


            //Store Data in table
            Route::post('/product/store', 'StoreProduct')->name('store.product');


            //Edit Data in Form
                            
            Route::get('/product/edit/{id}', 'EditProduct')->name('edit.product');

            //Update Data in table
            Route::put('/product/update', 'UpdateProduct')->name('update.product');



            //Delete Data in table
            Route::get('/product/delete/{id}', 'DeleteProduct')->name('delete.product');




            ////////////////////////////// IMPORT EXPORT EXCELL ///////////////////////////////////////////
            //BARCODE
            Route::get('/barcode/product/{id}','BarcodeProduct')->name('barcode.product')->middleware('permission:barcode-products');


            //Import product in excel
            Route::get('/Import/product','ImportProduct')->name('import.product')->middleware('permission:import-products');


           ///// EXPORT
            Route::get('product/export', [ProductController::class, 'Export'])->name('download.export')->middleware('permission:export-products');


                      ///// EXPORT
            Route::post('product/import', [ProductController::class, 'Import'])->name('download.import');



            
        });


                          // routes/web.php

            // FOR AJAX IF SINELECT NATIN SI CATEGORIES IS LALABAS UNG MGA SUBCATEGORIES
            Route::get('/get-subcategories/{category_id}', [ProductController::class, 'getSubcategories']);
        


            Route::controller(PurchaseOrderController::class)->group(function () {


            //Showing form for purchase order
            Route::get('/Purchase/Order', 'ShowPurchaseOrder')->name('purchase.order');

            Route::get('/Purchase/test', 'TestPurchaseCart');


            // Submit purchase order

            Route::post('/Purchase/Order', 'SavePurchaseOrder')->name('save.purchaseOrder');


            /// get all and put in the table for viewing only
            Route::get('all/Purchase/Order', 'AllPurchaseOrder')->name('all.purchase.order');


            /// get all and Have a received button IN TABLE
            Route::get('all/Pending/Order', 'AllPendingOrder')->name('all.pending.order');



                ///////// SHOWING FORM DETAILS

                Route::get('Received/Order/{id}', 'ReceivedOrderDetails')->name('Received.Order');



                    ///// SAVING IN DELIVERIES
                Route::post('/Save/Order/Deliveries', 'SaveOrderdeliveries')->name('save.deliveries');


                Route::get('All/deliveries', 'CompleteDeliveries')->name('deliveries.index');


            });





                ///  FOR MODAL WHEN INSERT IT GOES ON HIS BACK TABLE  /// 
        Route::get('/cart/content', function () {
            $cart = Cart::instance('purchaseOrder')->content();

            if ($cart->isEmpty()) {
                return '<tr><td colspan="6" class="text-center">Cart is empty</td></tr>';
            }

            $html = '';
            $counter = 1; // 

            

    foreach ($cart as $item) {
        $costPrice = $item->options->cost_price ?? 0;
        $totalCost = $costPrice * $item->qty;

        $html .= '<tr data-rowid="'.$item->rowId.'" class="cart-row">';
        $html .= '<td>'.$counter++.'</td>';
        $html .= '<td class="product-name">'.$item->name.'</td>';
        $html .= '<td class="product-code">'.($item->options->code ?? '-').'</td>';
        $html .= '<td class="selling-price">'.$item->price.'</td>';

        $html .= '<td>
            <input type="number" 
                class="form-control form-control-sm cart-qty-input validate-qty" 
                data-rowid="'.$item->rowId.'" 
                value="'.$item->qty.'" 
                min="1" style="width: 70px;">
        </td>';

        $html .= '<td>
            <input type="number" 
                class="form-control form-control-sm cart-cost-input validate-cost" 
                data-rowid="'.$item->rowId.'" 
                value="'.$costPrice.'" 
                min="1" style="width: 90px;">
        </td>';

        $html .= '<td class="total-cost">'.number_format($totalCost, 2).'</td>';

        $html .= '<td>
            <button type="button" class="btn btn-success btn-sm update-cart-item" data-rowid="'.$item->rowId.'">
                <i class="fas fa-check"></i>
            </button>
            <button type="button" class="btn btn-danger btn-sm remove-cart-item" data-rowid="'.$item->rowId.'">X</button>
        </td>';

        $html .= '</tr>';
    }

            return $html;
        })->name('cart.content');



                        ///////// TABLE MAIN




        Route::post('/cart/add', function (Illuminate\Http\Request $request) {
            Cart::instance('purchaseOrder')->add([
                'id'      => $request->id,
                'name'    => $request->name,
                'qty' => $request->qty ?? 1, // fallback to 1 if null
                'price'   => $request->price,  // selling price
                'weight'  => 0,  // Add this line
                    'options' => [
                        'code' => $request->code,
                        'cost_price' => $request->cost_price ?? 0, // store cost price separately
                    ]

            ]);
            return response()->json(['success' => true]);
        })->name('cart.add');



                ////////// MODAL


        /// REMOVE
        Route::delete('/cart/remove', function (Illuminate\Http\Request $request) {
            Cart::instance('purchaseOrder')->remove($request->rowId);
            return response()->json(['success' => true]);
        })->name('cart.remove');



        Route::patch('/cart/update-item', function (Illuminate\Http\Request $request) {
            $item = Cart::instance('purchaseOrder')->get($request->rowId);

            // Preserve existing options but update cost price
            $options = $item->options->toArray();
            $options['cost_price'] = $request->cost_price;

            Cart::instance('purchaseOrder')->update($request->rowId, [
                'qty' => $request->qty,
                'options' => $options,
            ]);

            return response()->json(['success' => true]);
        })->name('cart.updateItem');



        ///////////////////// DOWNLOAD EXCELLLLL ///////////////////////////////////
            Route::get('/product/template', function () {
            $path = public_path('templates/product_import_template.xlsx');
            
            if (!file_exists($path)) {
                abort(404);
            }

            return response()->download($path, 'product_import_template.xlsx');
        })->name('product.template');





        }); ///////// MIDDLEWARE END IN PRODUCT







            // ----------------  SUPPLIER CONFIRMATION PAGE ----------------



        Route::get('/supplier/confirm/{token}', [SupplierConfirmationController::class, 'show'])
        ->name('supplier.confirm');

        Route::post('/supplier/confirm/{token}', [SupplierConfirmationController::class, 'store'])
            ->name('supplier.confirm.store');


        // ---------------------------------------------------------------------






    /////////////////////////////////// MANAGE EXPENSES ///////////////////////////////
                
        Route::middleware(['auth', 'web'])->group(function () {

                Route::controller(ExpenseController::class)->group(function () {

                //Showing add expense form
                Route::get('/add//expense', 'AddExpense')->name('add.expense');

            
                Route::post('/store//expense', 'StoreExpense')->name('store.expense');


                // showing edit expense form
                route::get('/edit/expense/{id}', 'EditExpense')->name('edit.expense');

                
                route::put('/update/expense', 'UpdateExpense')->name('update.expense');

                //Delete Expense
                route::get('/delete/expense/{id}', 'DeleteExpense')->name('delete.expense');
                
                //Showing today's expense


                Route::get('/today/expense', 'TodayExpense')->name('todays.expense');


                Route::get('/month/expense', 'MonthExpense')->name('month.expense');


                Route::get('/year/expense', 'YearExpense' )->name('year.expense');
                
            });


    });




        //////////////////////////////// vat discount SYSTEM ///////////////////////


    Route::middleware(['auth', 'web'])->group(function () {

            Route::controller(CommerceController::class)->group(function () {

            //Showing vat discount settings
            Route::get('/Commerce/Settings', 'VatDiscountPage')->name('commerce.settings')->middleware('permission:manage-commerce-settings');

            Route::post('/update/vat', 'UpdateVat')->name('update.vat');
            

            Route::post('/Add/ajax/discount', 'AddAjaxDiscount')->name('add.ajax.discount');

            Route::post('/Update/ajax/discount', [CommerceController::class, 'UpdateAjaxDiscount'])->name('update.ajax.discount');

            
            Route::delete('/Delete/ajax/discount', [CommerceController::class, 'DeleteAjaxDiscount'])->name('delete.ajax.discount');

            });

    });



        //////////////////////////////// POS SYSTEM ///////////////////////


        Route::middleware(['auth', 'web'])->group(function () {

                    Route::controller(PosController::class)->group(function () {

                    //Showing Data in TABLE
                    Route::get('/pos', 'ViewPos')->name('pos');

                    
                    //Add Data in CART Content
                    Route::post('/pos/add', 'AddPos');
                    
                //Get Data in CART Content
                    Route::get('/pos/cart', 'CartContent');

                //ChangeQty in CART Content
                    Route::post('/pos/ChangeQty/{rowId}', 'ChangeQty');

                    
                    //Remove Product in CART Content
                    Route::delete('/pos-RemovePrd/{rowId}', 'RemoveProduct');


                    //ADD Invoice Customer Opening other page
                    Route::post('/create-invoice', 'CreateInvoiceCustomer');
                    


                });



                Route::get('/invoice/print/{order_id}', [OrderController::class, 'ShowPickupInvoice'])->name('invoice.print');



                            //////////////////////////////// POS CASHIER SYSTEM ///////////////////////
                        Route::controller(PosController::class)->group(function () {

                        // Submit Walkin Payment
                        Route::post('/pos/Payment', 'PaymentWalkin')->name('payment.walkin');


                    });


                    

                    Route::get('/pos/confirm/{id}', [PosController::class, 'confirm'])->name('pos.confirm');


                    Route::get('/pos/receipt/{id}', [PosController::class, 'Receipt'])->name('POS.receipt');



            
        });







        ////////////////////////////////  INVENTORY /////////////////////


        Route::middleware(['auth', 'web'])->group(function () {
                Route::controller(InventoryController::class)->group(function () {

                Route::get('/All/Inventory', 'Inventory')->name('show.inventory');


                });

        });




         //////////////////////////////// ORDER SYSTEM ///////////////////////


        Route::middleware(['auth', 'web'])->group(function () {

            Route::controller(OrderController::class)->group(function () {

            //Insert Data in Order and OrderDetails
            Route::post('/final-invoice', 'FinalInvoice');



            Route::get('/pos/receipt/{id}', [OrderController::class, 'Receipt'])->name('POS.receipt');

        

                ////////////////////////////// PICK UP ORDER
            // Pending Orders TABLE
            Route::get('/Pending/Pickup', 'PendingPickup')->name('pending.pickup')->middleware('permission:view-pending-pickup-orders');


            // Pending Orders TABLE
            Route::post('/pickup/ajax/mark-complete', 'ajaxPickupComplete')->name('ajax.pickup.complete');


                       // Pending Orders TABLE
            Route::get('/Complete/Pickup', 'CompletePickup')->name('complete.pickup')->middleware('permission:view-complete-pickup-orders');





                Route::get('/orders/{order}/assign', [OrderController::class, 'showAssign'])
                    ->name('assigned.Riders');

                Route::post('/orders/{order}/assign', [OrderController::class, 'storeAssign'])
                    ->name('orders.assign.store');



                Route::get('/orders/riderShow/{rider_Id}', [OrderController::class, 'RiderShow'])
                    ->name('rider.show');





            Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');


                    // ->middleware(['auth', 'role:Admin']); // only admin can assign



                    
            // Pending Orders TABLE
            Route::get('/Order/Pending', 'PendingOrders')->name('pending.order');


            Route::get('/orders/MarkAsOrderConfirmed/{id}', [OrderController::class, 'MarkAsConfirmOrder'])->name('confirm.Mark.Order');




            /////////////////// SAVING TRACKING JNT

            Route::post('/orders/save-tracking', [OrderController::class, 'saveTracking'])
                    ->name('orders.saveTracking');

                Route::post('/orders/pickup/{order}', [OrderController::class, 'markPickup'])
                    ->name('orders.pickup');

                Route::get('/orders/print-label/{order}', [OrderController::class, 'printLabel'])
                    ->name('orders.printLabel');

        
            // AJAX for Mark as Shipped and Cancelled
            Route::post('/orders/ajax/mark-shipped', [OrderController::class, 'ajaxMarkAsShipped'])->name('orders.ajax.shipped');
            
            Route::post('/orders/ajax/mark-cancelled', [OrderController::class, 'ajaxOrderCancelled'])->name('orders.ajax.cancelled');






            //////////////////////////////////////////////////////////////////////
            //////////////////////// CUSTOMER ORDER SYSTEM ///////////////////////





            // Shipped Orders TABLE
            Route::get('/Order/Shipped', 'AllShippedOrders')->name('all.ship.order');



            // Cancel Orders TABLE
            Route::get('/Order/Cancel', 'AllCancelOrders')->name('all.cancel.order');
                


            // Complete Orders TABLE
            Route::get('/Order/complete', 'CompleteOrders')->name('complete.order');


            // Return Orders TABLE
            Route::get('/Order/Return', 'ReturnOrders')->name('return.order');


            //Show Order Details Form
            Route::get('/Order/Details/{order_id}', 'Details')->name('details');


            //Show Order Details Form with complete order button  Complete Table
            Route::get('/Complet/Details/{order_id}', 'CompleteDetailsOrder')->name('complete.order.details');



            //Show Order Details Form with complete order button  Complete Table
            Route::get('/Tracking/Shipment/{order_id}', 'showTrackingOrderDetails')->name('track.shipment.order');



            //Update Order Status
            Route::put('/update/status', 'StatusUpdate')->name('status.update');

            
            //Show Stock
            Route::get('/product/Stocks', 'ShowStock')->name('show.stock')->middleware('permission:Show Stock');


             //Create Order PDF
            Route::get('/product/pdf/{pdfId}', 'CreatePDF');

            
        });





});




    Route::middleware(['auth', 'web'])->group(function () {

            ///////////// BACKEND
            //////////// RETURN SHIPMENT ///////////////////////////
            Route::controller(BackendReturnShipmentController::class)->group(function () {

                route::get('/Customer/Request/pending', 'CustomerRequestPending')->name('customer.request.pending');

                route::get('/Customer/Returning/item', 'CustomerReturningItem')->name('customer.returning.item');

                Route::post('/request/approve/{orderId}', [BackendReturnShipmentController::class, 'MarkAsReturnApproved']);

        });



            ///////////// BACKEND
            //////////// RETURN SHIPMENT STATUS WITHOUT RELOAD PAGE
            Route::get('/return-shipment/{shipmentId}/status', [BackendReturnShipmentController::class, 'getReturnShipmentStatus'])
                ->name('return.shipment.status');

            
                
                Route::get('/admin/return/mark-received/{id}', [BackendReturnShipmentController::class, 'ReturnMarkReceived'])
                    ->name('admin.return.mark-received');


                ///////// ITEM RETURN IN SHOP
            Route::controller(BackendReturnShipmentController::class)->group(function () {

                route::get('/admin-confirmed/return/{request_id}', 'AdminConfirmReturned')->name('admin.confirmed.return');

                route::post('/admin-confirmed/return/{request_id}', 'ReturnhandleAction')->name('admin.handle.return');


                
                
            });

    });





        //////////////////////////////// PERMISSIONS ///////////////////////


    Route::middleware(['auth', 'web'])->group(function () {


            Route::controller(RoleController::class)->group(function () {

            //Show All Permissions AND SHOW ROLES TABLE
            Route::get('/roles', 'AllRoles')->name('all.roles');


            //Add Permissions
            Route::get('/create/permission', 'AddPermission')->name('add.permission');
            


            //// Middleware dummy so di mo mkakaklimutan
                        // Route::get('/create/permission', 'AddPermission')->name('add.permission')->middleware('permission:view-all-permissions');


            //Store Permissions
            Route::post('/store/permission', 'StorePermission')->name('permission.store');




            //Show Edit Permissions
            Route::get('/edit/permission/{id}', 'EditPermission')->name('edit.permission');


            //Show Edit Permissions
            Route::get('/delete/permission/{id}', 'DeletePermission')->name('delete.permission');

            //Update Permissions
            Route::put('/update/permission/{id}', 'UpdatePermission')->name('permission.update');



            

            ///////////////////////// Roles ///////////////////////////

                        //Show All Permissions AND SHOW ROLES TABLE
            Route::get('/permission', 'AllPermission')->name('all.permission');


                         //Add Roles Form
            Route::get('/create/roles', 'AddRoles')->name('add.roles');


                        //Store Permissions
            Route::post('/roles/permission', 'StoreRoles')->name('roles.store');


            //Show Edit Roles
            Route::get('/edit/roles/{id}', 'EditRoles')->name('edit.roles');

            //Update Roles
            Route::put('/update/roles', 'UpdateRoles')->name('update.roles');


            //Delete Roles
            Route::get('/delete/roles/{id}', 'DeleteRoles')->name('delete.roles');


            ////////////////// END ROLES    ////////////////////////////////////////////////


            /////////////////////// Roles in Permission ///////////////////////////
            Route::get('/add/roles/permission', 'AddRolesPermission')->name('add.roles.permission');


            //Store Roles in Permission
            Route::post('/store/roles/permission', 'StoreRolesPermission')->name('role.permission.store');


            //View Roles in Permission
            Route::get('/all/roles/permission', 'AllRolesPermission')->name('all.roles.permission');



            //Edit Roles in Permission form
            Route::get('/edit/roles/permission/{id}', 'EditRolesPermission')->name('edit.roles.permission');

            

            //update Roles in Permission
            Route::post('/update/roles/permission/{id}', 'UpdateRolesPermission')->name('role.permission.update');
            

             //Delete Roles in Permission
            Route::get('/delete/roles/permission/{id}', 'DeleteRolesPermission')->name('role.permission.delete');
        });



    });





        Route::middleware(['auth', 'web'])->group(function () {


                 //////////////////////////////// Admin User SYSTEM ///////////////////////
            Route::controller(AdminController::class)->group(function () {

            //All Admin User Table
            Route::get('/admin/all', 'AllAdmin')->name('all.admin');


            Route::get('/admin/Create', 'CreateAdmin')->name('create.admin');
            
            Route::post('/admin/Store', 'StoreAdmin')->name('Store.admin');

            
            // EDIT ADMIN
            Route::get('/admin/edit/{id}', 'EditAdmin')->name('edit.admin');


            // Update ADMIN
            Route::post('/admin/update', 'UpdateAdmin')->name('update.admin');
            

            
            // Update ADMIN
            Route::get('/admin/delete/{id}', 'DeleteAdmin')->name('delete.admin')->middleware('permission:delete-admin-account');


        });


    });


        /////////////// Change TITLE  SYSTEM 



    Route::middleware(['auth', 'web'])->group(function () {

        Route::controller(AdminController::class)->group(function () {

            Route::get('/BusinessName', 'BusinessName')->name('business.name');

                // update business name without table
            Route::post('/BusinessName/update', 'StoreBusinessName')->name('businesstitle.update');

        });


});




        ////////////////////// BACKUP DATABASE ///////////////////////
    Route::middleware(['auth', 'web'])->group(function () {
        Route::get('/admin/backup', [AdminController::class, 'BackupDatabase'])->name('backup.database');
            // Route::get('/admin/backup', [AdminController::class, 'BackupDatabase'])->name('backup.database')->middleware('permission:view-backup-database');

        Route::post('/backup/now', [AdminController::class, 'BackupNow'])->name('backup.now');
        Route::get('/backup/{getFilename}', [AdminController::class, 'DownloadDatabase'])->name('backup.download');
        Route::delete('/backup/{getFilename}', [AdminController::class, 'DeleteDatabase'])->name('backup.delete');
    });



    
        ////////////////////// AUDIT TRAIL ///////////////////////

        Route::middleware(['auth', 'web'])->group(function () {

        Route::controller(AuditController::class)->group(function () {
            Route::get('/audit-trail', 'AuditTrail')->name('audit.trail');

            // Route::get('/audit-trail', 'AuditTrail')->name('audit.trail')->middleware('permission:view-all-trail');

            Route::get('/audit-log', 'AuditLog')->name('audit.log');

            // Route::get('/audit-log', 'AuditLog')->name('audit.log')->middleware('permission:view-audit-trail-log');

        });

    });


            Route::middleware(['auth', 'web'])->group(function () {


                Route::controller(ReportController::class)->group(function () {

                Route::get('/Reports-Daily', 'dailyReport')->name('daily.reports');


                Route::get('/Reports-Weekly', 'weeklyReport')->name('weekly.reports');

                
                Route::get('/Reports-Monthly', 'monthlyReport')->name('monthly.reports');

                Route::get('/Top-Selling-Products', 'TopSelling')->name('top.sellings');


            });

        });

            





    Route::middleware(['auth', 'web'])->group(function () {


            ////////////////////// HERO SLIDER ///////////////////////
        Route::controller(HeroSliderController::class)->group(function () {

                Route::get('/HeroSlider', 'HeroSlider')->name('heroslider.show');

                Route::get('/HeroSlider/Add', 'AddHeroSlider')->name('add.heroslider');

                Route::post('/HeroSlider/Store', 'StoreHeroSlider')->name('store.heroslider');


                Route::get('/HeroSlider/Edit/{id}', 'EditHeroSlider')->name('edit.heroslider');

                Route::put('/HeroSlider/Update', 'UpdateHeroSlider')->name('update.heroslider');

                Route::get('/HeroSlider/Delete/{id}', 'DeleteHeroSlider')->name('delete.heroslider');
            });

        });




            // Admin route
            Route::post('/admin/chat/send', [ChatController::class, 'sendAdmin'])
                ->middleware('auth:web'); // web guard


            // Admin routes
            Route::get('/admin/chat/fetch/{customerId}', [ChatController::class,'fetchAdmin'])
                ->middleware('auth:web');




            // Customer route
            Route::post('/customer/chat/send', [ChatController::class, 'sendCustomer'])
                ->middleware('auth:customer'); // customer guard


            // Customer routes
            Route::get('/customer/chat/fetch', [ChatController::class,'fetchCustomer'])
                ->middleware('auth:customer');









// |--------------------------------------------------------------------------
// |--------------------------------------------------------------------------

// |--------------------------------------------------------------------------
// |--------------------------------------------------------------------------



// |--------------------------------------------------------------------------
// |--------------------------------------------------------------------------



// |--------------------------------------------------------------------------
// | FRONTEND CUSTOMER Routes
// |--------------------------------------------------------------------------




            
            // ---------------- CUSTOMER AUTH ----------------

                    // Customer login + register pages
                    Route::controller(AuthCustomerController::class)->group(function () {

                        //// Open Login Form
                        Route::get('/customer/login', 'create')
                            ->middleware('guest:customer')
                            ->name('customer.login');

                            ///  Login customer 
                        Route::post('/customer/login', 'store')
                            ->middleware('guest:customer')
                            ->name('customer.login.store');


                            // logout customer
                        Route::post('/customer/logout', 'destroyCustomer')
                            ->middleware('auth:customer')
                            ->name('customer.logout');
                    });






            // ----------------  OAUTH ----------------

                                
                    Route::prefix('customer')->group(function () {
                    Route::get('/auth/google', [CustomersGoogleController::class, 'redirect'])
                        ->name('customer.google.login');

                    Route::get('/auth/google/callback', [CustomersGoogleController::class, 'callback']);
                });


                    // ---------------- CUSTOMER DASHBOARD ----------------

                    Route::middleware(['auth:customer', 'guard.session'])->group(function () {
                        Route::get('/customer/dashboard', [FrontendController::class, 'index'])
                            ->name('customer.dashboard');
                    });


                ///////////////////////////// REGISTER CUSTOMER /////////////////////////
        
                Route::controller(CustomerRegisteredController::class)->group(function () {


                    route::get('/customer/register', 'create')->name('customer.register.form');

                        // REGISTER CUSTOMER
                    Route::post('/customer/Register', 'customerRegister')->name('customer.register');            

            });





                /////////////////// PROFILE CUSTOMER ////////////////////////
            Route::middleware(['auth:customer', 'customer'])->group(function () {
                Route::get('/customer/profile', [FrontendController::class, 'ProfileShow'])->name('customer.profile');
                Route::get('/customer/profile/edit', [FrontendController::class, 'ProfileEdit'])->name('customer.profile.edit');

                Route::get('/customer/chat/admin', [FrontendController::class, 'ChatAdmin'])->name('chat.admin');

                Route::get('/customer/address', [FrontendController::class, 'CustomerAddress'])->name('customer.adress');


                Route::post('/customer/address/store', [FrontendController::class, 'CustomerAddressStore'])->name('store.customer.address');





                Route::put('/customer/profile/update', [FrontendController::class, 'ProfileUpdate'])->name('update.customer.profile');

                Route::get('/customer/view/item/{id}', [FrontendController::class, 'ViewItem'])->name('customer.view.item');

                Route::get('/customer/return/item/{id}', [FrontendController::class, 'ReturnItem'])->name('return.order.item');


                Route::get('/customer/track/item/{id}', [FrontendController::class, 'TrackItem'])->name('customer.track.item');



            });





            
            Route::middleware('auth:customer')->group(function () {

                Route::get('/checkout', [FrontendOrderController::class, 'EcommercePayment'])
                    ->name('cart.payment');

                Route::post('/checkout', [FrontendOrderController::class, 'EcommerceCheckout'])
                    ->name('cart.checkout');
                                    

                Route::post('/ecommerce/change/address', [FrontendOrderController::class, 'updateAddress'])
                    ->name('cart.updateAddress');


                    Route::get('/ecommerce/payment/success', [FrontendOrderController::class, 'paypalSuccess'])
                        ->name('paypal.success');


                        /// if cash
                    Route::get('{id}/success', [FrontendOrderController::class, 'SuccesfullyOrder'])
                        ->name('success.order');


                Route::get('/ecommerce/payment/cancel', [FrontendOrderController::class, 'PaypalCancel'])
                    ->name('paypal.cancel');



                Route::post('/Customer/Order/mark-cancelled', [FrontendOrderController::class, 'ajaxMarkAsCancelled'])
                    ->name('Customer.order.cancelled');



                ////  OUTBOUND RETURN
            //////////// RETURN SHIPMENT
            Route::post('/customer/requests', [ReturnShipmentController::class, 'CustomerReturnRequest'])
                ->name('store.return.requests');

                /// hand to courier item
            Route::post('/customer/pack-item/{return_requestID}', [ReturnShipmentController::class, 'HandToCourier'])
                ->name('hand.to.courier');





                    
                });

                







            Route::controller(CartController::class)->group(function () {
                        
                ////// PRODUCT DETAILS CART /////////////////

                route::post('/ecommerce/add', 'EcommerceAddCart');

                Route::patch('/ecommerce/ChangeQty/{rowId}', 'EcommerceChangeQty');

                route::get('/ecommerce/carting', 'CartContent');


                route::DELETE('/ecommerce-RemovePrd/{rowId}', 'RemoveEcommProduct')->name('removeProd');

                /////////// CART CHECKOUT //////////////


                });



            Route::controller(FrontendController::class)->group(function () {

                Route::get('/', 'index')->name('home');

                    
                });




            //////////////////    CATEGORY WISE PRODUCT SHOW ///////////////////////
            Route::controller(FrontendCategoryController::class)->group(function () {

                Route::get('/category/{slug}', 'CategoryProduct')->name('category.show');


            });



                              //////////////////    CHECKOUT PAGE ///////////////////////

                    Route::controller(FrontendController::class)->group(function () {

                    Route::get('/cart', 'CartShow')->name('cart.show');


                    route::get('/wishlist', 'WishlistShow')->name('wishlist.show');


                    Route::get('/product/{product_id}', 'ProductDetails')->name('product.show');



                    ////////////////////// CONFIDENTIAL PAGE

                    Route::get('/privacy-policy', 'PrivacyPolicy')->name('policy.show');


                    Route::get('/terms-of-service', 'TermsAndServices')->name('terms.show');



                });



                


        
            Route::controller(ContactController::class)->group(function () {

            Route::get('/Contact/page', 'ContactShow')->name('contact.show');


                    Route::post('/Contact/message', 'send')->name('contact.send');
                });


                    Route::controller(AboutController::class)->group(function () {

                    Route::get('/About/page', 'AboutShow')->name('about.show');


                });



                Route::controller(FrontendBrandController::class)->group(function () {

                    Route::get('/Brand/page/{id}', 'BrandShow')->name('brand.show');


                });




                



            Route::controller(WishlistController::class)->group(function () {

                route::post('/ecommerce/wishlist/add', 'EcommerceAddWishlist')->name('ecommerce.wishlist.add');

                route::get('/ecommerce/wishlist', 'wishlistTest');

            route::DELETE('/ecommerce-RemoveWsh/{rowId}', 'RemoveEcommWish')->name('removeWishlist');


            });



                Route::post('/test-wishlist', function () {
                    return dd('WISHLIST CLICK WORKS ✅');
                })->name('test.wishlist');








require __DIR__.'/auth.php';





