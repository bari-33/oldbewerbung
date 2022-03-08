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

Route::get('test_email',[
       'uses' => 'HomeController@test_email',
       'as' => 'test_email'
  ]);


Route::get('/chat', 'ChatsController@index');
Route::get('messages', 'ChatsController@fetchMessages');
Route::post('messages', 'ChatsController@sendMessage');


Route::get('thankyou',function ()
{
    return view('orders.thanks_for_payment');
});



Route::get('employees/inProcess/{order}','EmployeeController@inProcess');
Route::get('employees/completed/{order}','EmployeeController@completed');

Route::get('/employees_dashboard','DashboardController@employee');
Route::get('employees/tasks','EmployeeController@tasks');
Route::get('employees/check1/{id}/{checked}/{checked1}','EmployeeController@check1');
Route::get('employees/uncheck/{id}/{checked}/{checked1}','EmployeeController@uncheck');
Route::get('employees/invoices','EmployeeController@invoices');
Route::get('employees/orders','EmployeeController@orders');
Route::post('employees/saveNotes/{order}','EmployeeController@saveNotes');
Route::patch('employees/editOrderStatus/{order}','EmployeeController@editOrderStatus');
Route::get('employees/editOrder/{order}','EmployeeController@editOrder');
Route::resource('employees','EmployeeController');

// ORDERS CONTROLLER
Route::get('orders/customerOrders/getFinishedDocuments/{id}','OrderController@getFinishedDocuments');
Route::get('orders/customerOrders/getTrialDocuments/{id}','OrderController@getTrialDocuments');
Route::get('orders/customerOrders/{customer}','OrderController@customerOrders');
Route::post('orders/addOrder','OrderController@addOrder');

Route::resource('orders','OrderController');

Route::get('orders/current/{order}','OrderController@currentOrder');
Route::get('orders/release/{order}','OrderController@releaseOrder');
Route::post('orders/personal/{order}','OrderController@personalData');
Route::post('orders/job/{order}','OrderController@jobData');
Route::post('orders/qualifications/{order}','OrderController@qualificationsData');
Route::post('orders/qualificationsSkip/{order}','OrderController@qualificationsSkip');

Route::post('orders/documents/{order}','OrderController@documentsData');
Route::post('orders/documents','OrderController@documentsDestroy');
Route::get('orders/documentsDelete/{document}','OrderController@documentsDelete');

Route::get('orders/allDocuments/{order}','OrderController@allDocuments');
Route::post('orders/motivation/{order}','OrderController@motivationData');
Route::post('orders/motivationSkip/{order}','OrderController@motivationSkip');
Route::get('orders/express/{order}','OrderController@expressOrder');



Route::get('orders/paypal/{order}', 'PaymentController@payWithpaypal');
Route::get('orders/payment/{order}', 'OrderController@paymentDone');

// AdminOrder and Employees Shared routes



Route::get('adminorders/deletefinisheddocuments/{id}','AdminOrderController@deletefinishedDocuments');
Route::get('adminorders/deletetrialdocuments/{id}','AdminOrderController@deletetrialDocuments');

Route::post('adminorders/finisheddocuments/{order}','AdminOrderController@finishedDocuments');
Route::post('adminorders/finisheddocuments','AdminOrderController@finishedDocumentsDestroy');
Route::post('adminorders/trialdocuments/{order}','AdminOrderController@trialDocuments');
Route::post('adminorders/trialdocuments','AdminOrderController@trialDocumentsDestroy');

// AdminOrder and Employees Shared routes END
Route::post('invoices/search','InvoiceController@search');
Route::get('invoices/pdf/{order}','InvoiceController@pdf')->middleware('auth');
Route::get('invoices/view/','InvoiceController@view')->middleware('auth');
Route::resource('invoices','InvoiceController')->middleware('auth');


Route::resource('faqs','faqController')->middleware('auth');
Route::resource('expration','exprationController')->middleware('auth');
Route::resource('settings','settingController')->middleware('auth');


// temporary routes end here



    Auth::routes();


    Route::resource('clients','ClientController')->middleware('auth');



Route::get('/customer', 'DashboardController@customer')->middleware('auth');

Route::get('/', function (){
    return redirect('login');
});



// UserDetail controller routes
Route::get('userdetails/{client}/editClient','UserDetailController@editClient')->middleware('auth');
Route::patch('userdetails/updateClient/{client}','UserDetailController@updateClient')->middleware('auth');

Route::post('userdetails/search', 'UserDetailController@search');

Route::get('userdetails/delete/{id}', 'UserDetailController@delete');

Route::group(['middleware' => ['auth', 'admin']], function() {

    Route::resource('userdetails','UserDetailController')->middleware('auth','admin');;

    Route::get('/admin', 'DashboardController@admin')->middleware('auth');


    // Products controller routes
    Route::resource('products','ProductController')->middleware('auth','admin');

    Route::get('product/destroy/{id}','ProductController@delete')->middleware('auth','admin');


    Route::post('products/search', 'ProductController@search');
    Route::post('products/searchCategory', 'ProductController@searchCategory');


    // Design controller routes
    Route::resource('designs','DesignController');
    Route::post('designs/search', 'DesignController@search');
    Route::post('designs/searchCategory', 'DesignController@searchCategory');
    Route::get('designs/destroy/{id}','DesignController@delete')->middleware('auth','admin');


    // Website controller routes
    Route::resource('websites','WebsiteController');
    Route::post('websites/search', 'WebsiteController@search');
    Route::post('websites/searchCategory', 'WebsiteController@searchCategory');
    Route::get('websites/destroy/{id}','WebsiteController@delete')->middleware('auth','admin');



    // Categories custom controller routes
    Route::get('/categories', 'CategoryController@index');
    Route::get('/categories/create', 'CategoryController@create');
    Route::post('/categories', 'CategoryController@store');
    Route::get('/categories', 'CategoryController@index');
    Route::get('/categories/edit/{id}/{flag}', 'CategoryController@edit');
    Route::patch('/categories/update/{id}/{flag}', 'CategoryController@update');
    Route::get('/categories/delete/{id}/{flag}', 'CategoryController@destroy');

//Packages Controller routes
    Route::resource('packages','PackageController');


    //admin orders controller
    Route::get('todo/{order}','AdminOrderController@todo');
    Route::get('running/{order}','AdminOrderController@running');
    Route::get('check/{order}','AdminOrderController@check');
    Route::get('finished/{order}','AdminOrderController@finished');
    Route::get('activated/{order}','AdminOrderController@activated');
    Route::get('cancelled/{order}','AdminOrderController@cancelled');
    Route::get('seen/{id}','AdminOrderController@seen');
    Route::post('adminorders/addEmployee/{order}','AdminOrderController@addEmployee');
    Route::post('adminorders/removeEmployee/{order}','AdminOrderController@removeEmployee');
    Route::post('adminorders/search','AdminOrderController@search');
    Route::get('dropupdate/{id}/{order}','AdminOrderController@dropupdate');
    Route::get('unassingemploy/{id}/{order}','AdminOrderController@unassingemploy');

    Route::resource('adminorders','AdminOrderController');
    Route::get('adminorders/deleteOrder/{order}','AdminOrderController@deleteOrder');
    Route::post('adminorders/deleteall','AdminOrderController@deleteall');
    Route::post('adminorders/paid','AdminOrderController@paid');
    Route::post('adminorders/allinvoice','AdminOrderController@allinvoice');
    Route::post('adminorders/restore','AdminOrderController@restore');




    Route::post('adminorders/saveNotes/{order}','AdminOrderController@saveNotes');



});


//CHAT ROUTES

Route::post('/chat/send','ChatController@send');
Route::post('/chat/read','ChatController@read');
Route::post('/chat/readreceipt','ChatController@readreceipt');
Route::post('/chat/accept','ChatController@accept');
Route::get('/chat/getAll/{id}','ChatController@getAll');

// task
Route::resource('task','taskController');
Route::get('check/{id}/{checked}/{checked1}','taskController@check');
Route::get('uncheck1/{id}/{checked}/{checked1}','taskController@uncheck1');

// message
Route::resource('message','messageController');
Route::get('lang/{locale}','LanguageController@swap');

