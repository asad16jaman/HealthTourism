<?php

use App\Http\Controllers\Admin\ApoinmentController;
use App\Http\Controllers\Admin\AuthMessageController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\MissionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\WellcomeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\FeedbackController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ManagemenController;
use App\Http\Controllers\Admin\PhotoGalleryController;
use Illuminate\Support\Facades\Http;


Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/about',[HomeController::class,'companyAbout'])->name('about');
Route::get('/contact',[HomeController::class,'contact'])->name('contact');
Route::post('/contact',[HomeController::class,'storeContact'])->name('contact');
Route::get('/service',[HomeController::class,'service'])->name('service');
Route::get('/services/{uid}/detail',[HomeController::class,'servicesDetail'])->name('service_detail');
Route::post('/services/{uid}/detail',[HomeController::class,'servicesMessageStore'])->name('service_detail');
Route::get('/hospitals',[HomeController::class,'hospitals'])->name('all_hospital');
Route::get('/patent-report',[HomeController::class,'pationReportPage'])->name('pagentReport');
Route::post('/patent-report',[HomeController::class,'savePataintReport'])->name('pagentReport');
Route::get('/apointment',[HomeController::class,'apointment'])->name('apointment');
Route::post('/apointment',[HomeController::class,'storeApointment'])->name('apointment');


// Route::get('/mission-vission',[HomeController::class,'misionVision'])->name('misionvision');
// Route::get('/chairman-message',[HomeController::class,'chairmanMessage'])->name('chairmanMessage');

Route::prefix('admin')->group(function(){
    Route::get('/login',[DashboardController::class,'login'])->name('admin.login');
    Route::post('/login',[DashboardController::class,'authenticate'])->name('admin.login');
    Route::get('/error',[DashboardController::class,'errorpage'])->name('error');
    //registring admin/users
    Route::get('/register',[DashboardController::class,'register'])->name('admin.register');
    Route::post('/register',[DashboardController::class,'store'])->name('admin.register');
});


Route::group(['prefix'=> '/admin','middleware'=>'checkAdminAuth'], function () {
    Route::get('/',[DashboardController::class,'index'])->name('admin');
});

Route::group(['prefix'=> '/admin','middleware'=>'checkAdminAuth','as'=>'admin.'], function () {
    
    //handling users from admin pannel
    Route::get("/users/{id?}",[UsersController::class,"index"])->name("users");
    Route::post("/users/{id?}",[UsersController::class,"storeUser"])->name("users");
    Route::post("/users/{id}/delete",[UsersController::class,"deleteUser"])->name("user.delete");

    //edit user from user side
    Route::get("/users/{id}/edit",[UsersController::class,"editUser"])->name("user.edit");
    Route::post("/users/{id}/edit",[UsersController::class,"editUserStore"])->name("user.edit");

    //company maintain url
    Route::get("/company",[CompanyController::class,"index"])->name("company");
    Route::post("/company",[CompanyController::class,"create"])->name("company");

    //slider maintaining url
    Route::get("/sliders/{id?}",[SliderController::class,"index"])->name("slider");
    Route::post("/sliders/{id?}",[SliderController::class,"store"])->name("slider");
    Route::post("/sliders/{id}/delete",[SliderController::class,"destroy"])->name("slider.delete");
   
    //Country url hare
    Route::get("/country",[CountryController::class,"index"])->name("country");
    Route::post("/country",[CountryController::class,"store"])->name("country");
    Route::post("/country/{id}/delete",[CountryController::class,"destroy"])->name("country.delete");

    //Service url hare
    Route::get("/service/{id?}",[ServiceController::class,"index"])->name("service");
    Route::post("/service/{id?}",[ServiceController::class,"store"])->name("service");
    Route::post("/service/{id}/delete",[ServiceController::class,"destroy"])->name("service.delete");

    //Contact url hare+++++
    Route::get('/apoint',[ApoinmentController::class,'index'])->name('apoint');
    Route::get('/apoint/download/{id}',[ApoinmentController::class,'downloadFile'])->name('fileDownload');
    Route::post('/apoint/{id}',[ApoinmentController::class,'deleteApoint'])->name('apoint.delete');
    Route::post('/apoint/{id}/status',[ApoinmentController::class,'changeStatus'])->name('apoint.changeStatus');

    //service Contact...
    Route::get("/service-message/{id?}",[ServiceController::class,"getServiceMessage"])->name("service.message");
    Route::post("/service-message/{id}/delete",[ServiceController::class,"deleteServiceMessage"])->name("service.message.delete");

    //chairman-message
    Route::get('/chairman-message',[AuthMessageController::class,'index'])->name('ch-message');
    Route::post('/chairman-message',[AuthMessageController::class,'store'])->name('ch-message');
    

    //Mission & Vision 
    Route::get('/mission-vision',[MissionController::class,'index'])->name('mision');
    Route::post('/mission-vision',[MissionController::class,'store'])->name('mision');

 
    //Photo Gallery url hare
    Route::get("/photogallery/{id?}",[PhotoGalleryController::class,"index"])->name("photogallery");
    Route::post("/photogallery/{id?}",[PhotoGalleryController::class,"store"])->name("photogallery");
    Route::post("/photogallery/{id}/delete",[PhotoGalleryController::class,"destory"])->name("photogallery.delete");

    
    //Managment url hare
    Route::get('/manage/{id?}',[ManagemenController::class,'index'])->name('management');
    Route::post('/manage/{id?}',[ManagemenController::class,'store'])->name('management');
    Route::post('/management/{id}/delete',[ManagemenController::class,'destroy'])->name('management.delete');

    //about url hare
    Route::get('/about',[AboutController::class,'index'])->name('about');
    Route::post('/about',[AboutController::class,'store'])->name('about');

    // faq hare
    Route::get('/faq',[FaqController::class,'index'])->name('faq');
    Route::post('/faq',[FaqController::class,'store'])->name('faq');
    Route::post('/faq/{id}/delete',[FaqController::class,'destroy'])->name('faq.delete');

    //Contact url hare
    Route::get('/contact',[ContactController::class,'index'])->name('message');
    Route::post('/contact/{id}',[ContactController::class,'destroy'])->name('message.delete');

    //Contact url hare
    Route::get('/report',[ContactController::class,'report'])->name('report');
    Route::post('/report/{id}',[ContactController::class,'destroyreport'])->name('report.delete');
    Route::get('/report/{id}/reportDownload',[ContactController::class,'reportDownload'])->name('report.download');

     //Client url hare
    Route::get('/hospital',[ClientController::class,'index'])->name('client');
    Route::post('/hospital',[ClientController::class,'store'])->name('client');
    Route::post('/hospital/{id}',[ClientController::class,'destroy'])->name('client.delete');

    //Wellcome Node url hare
    Route::get('/create-wellcome-node',[WellcomeController::class,'index'])->name('wellcome');
    Route::post('/create-wellcome-node',[WellcomeController::class,'store'])->name('wellcome');

    //feedback maintaining url
    Route::get("/feedback/{id?}",[FeedbackController::class,"index"])->name("feedback");
    Route::post("/feedback/{id?}",[FeedbackController::class,"store"])->name("feedback");
    Route::post("/feedback/{id}/delete",[FeedbackController::class,"destroy"])->name("feedback.delete");
    
    //admin logout
    Route::get('/logout',[DashboardController::class,'logout'])->name('logout');
});



 Route::get('link', function(){
     Artisan::call('storage:link');
     return 'Done';
 });


