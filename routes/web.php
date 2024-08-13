<?php

use App\Http\Middleware\AdminCheck;
use App\Http\Middleware\SessionGuard;
use App\Http\Middleware\UserLoginCheck;
use Illuminate\Support\Facades\Route;

//Auth View
Route::get('/', function () {
   $data['title'] = 'CPESD MIS LOGIN';
   return view('system_auth.login')->with($data);
})->middleware(UserLoginCheck::class);
//Auth Login Action
Route::post('/v-u', [App\Http\Controllers\auth\AuthController::class, 'verify_user']);
Route::get('/logout', [App\Http\Controllers\auth\AuthController::class, 'logout']);


Route::get('/home', function () {
   $data['title'] = 'CPESD MIS MANAGEMENT INFORMATION SYSTEM';
   $data['link']  = session('user_type') == 'user' ? 'user' : 'admin';
   return view('home.index')->with($data);
})->middleware(SessionGuard::class);



            ////SYSTEM MANAGEMENT


//SYSTEM MANAGEMENT ROUTES
Route::middleware([SessionGuard::class, AdminCheck::class])->prefix('/admin/sysm')->group(function () {
   Route::get("/dashboard",[ App\Http\Controllers\system_management\DashboardController::class, 'index']);
   Route::get("/login-history",[ App\Http\Controllers\system_management\LoginHistoryController::class, 'index']);
   //Manage USer
   Route::get("/manage-users",[ App\Http\Controllers\system_management\ManageUserController::class, 'index']);
   Route::get("/user/{id}",[ App\Http\Controllers\system_management\ManageUserController::class, 'view_profile']);
});
//SYSTEM MANAGEMENT ACTIONS
Route::middleware([SessionGuard::class, AdminCheck::class])->prefix('/admin/sysm/act')->group(function () {
   Route::get("/g-a-l-l",[ App\Http\Controllers\system_management\LoginHistoryController::class, 'get_all_login_logs']);
   //Manage User
   Route::get("/g-a-u",[ App\Http\Controllers\system_management\ManageUserController::class, 'get_all_users']);
   //System Authorization
   Route::post("/a-s",[ App\Http\Controllers\system_management\ManageUserController::class, 'authorize_system']);
});


            ////LABOR LOCALIZATION AND WHIP


//USER VIEW WHIP
Route::middleware([SessionGuard::class])->prefix('/user')->group(function () {
   //LLS
      //Dashboard
      Route::get("/lls/dashboard",[ App\Http\Controllers\systems\lls_whip\lls\user\DashboardController::class, 'index']);
      //Establishments
         Route::get("/lls/add-new-establishment",[ App\Http\Controllers\systems\lls_whip\lls\both\EstablishmentsController::class, 'add_new_establishments']);
         Route::get("/lls/establishments-list",[ App\Http\Controllers\systems\lls_whip\lls\both\EstablishmentsController::class, 'establishments_list']);
         Route::get("/lls/establishment/{id}",[App\Http\Controllers\systems\lls_whip\lls\both\EstablishmentsController::class, 'establishments_view_information']);
      //Positions
         Route::get("/lls/establishments-positions",[ App\Http\Controllers\systems\lls_whip\lls\both\PositionsController::class, 'index']);
      //Employees Record
         Route::get("/lls/employees-record",[ App\Http\Controllers\systems\lls_whip\both\EmployeeController::class, 'index']);
        
   //WHIP
      //Dashboard
         Route::get("/whip/dashboard",[ App\Http\Controllers\systems\lls_whip\whip\user\DashboardController::class, 'index']);
      //Employees Record
         Route::get("/whip/employees-record",[ App\Http\Controllers\systems\lls_whip\both\EmployeeController::class, 'index']);
      //Contractors
         Route::get("/whip/add-new-contractor",[ App\Http\Controllers\systems\lls_whip\whip\both\ContractorsController::class, 'add_new_contractor']);
         Route::get("/whip/contractors-list",[ App\Http\Controllers\systems\lls_whip\whip\both\ContractorsController::class, 'contractors_list']);
      //Projects
         Route::get("/whip/add-new-project",[ App\Http\Controllers\systems\lls_whip\whip\both\ProjectsController::class, 'add_new_project']);
         Route::get("/whip/projects-list",[ App\Http\Controllers\systems\lls_whip\whip\both\ProjectsController::class, 'projects_list']);
      //Project Monitoring
         Route::get("/whip/add-monitoring",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'add_monitoring_view']);
         Route::get("/whip/pending-projects-monitoring",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'pending_project_monitoring_view']);
         Route::get("/whip/project-monitoring-info/{id}",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'project_monitoring_information']);
         //Reports
         Route::get("/whip/monitoring-report/{id}",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'view_monitoring_report']);
      //Positions
         Route::get("/whip/whip-positions",[ App\Http\Controllers\systems\lls_whip\both\PositionsController::class, 'index']);

   
                                                   //DOCUMENT TRACKING SYSTEM//
      //USER
         //Dashboard
         Route::get("/dts/dashboard",[ App\Http\Controllers\systems\dts\user\DashboardController::class, 'index']);
         //My documents
         Route::get("/dts/my-documents",[ App\Http\Controllers\systems\dts\user\MyDocumentsController::class, 'index']);
         //Add Documents
         Route::get("/dts/add-document",[ App\Http\Controllers\systems\dts\user\AddDocumentController::class, 'index']);
         //Incoming
         Route::get("/dts/incoming",[ App\Http\Controllers\systems\dts\user\IncomingController::class, 'index']);
         //Received
         Route::get("/dts/received",[ App\Http\Controllers\systems\dts\user\ReceivedController::class, 'index']);
         //Forwarded
         Route::get("/dts/forwarded",[ App\Http\Controllers\systems\dts\user\ForwardedController::class, 'index']);
         //Outgoing
         Route::get("/dts/outgoing",[ App\Http\Controllers\systems\dts\user\OutgoingController::class, 'index']);

});

//USER ACTION LLS_WHIP
Route::middleware([SessionGuard::class])->prefix('/user/act')->group(function () {
   //LLS
      //POSITIONS
      Route::get("/lls/a-p",[App\Http\Controllers\systems\lls_whip\both\PositionsController::class, 'get_all_lls_positions']);
      Route::post("/lls/i-u-p",[App\Http\Controllers\systems\lls_whip\both\PositionsController::class, 'insert_update_position_lls']);
      //ESTABLISHMENTS
      Route::post("/lls/insert-es",[App\Http\Controllers\systems\lls_whip\lls\both\EstablishmentsController::class, 'insert_establishment']);
      Route::get("/lls/g-a-e",[App\Http\Controllers\systems\lls_whip\lls\both\EstablishmentsController::class, 'get_all_establishment']);
      Route::post("/lls/d-e",[App\Http\Controllers\systems\lls_whip\lls\both\EstablishmentsController::class, 'delete_establishment']);
      Route::post("/lls/u-e",[App\Http\Controllers\systems\lls_whip\lls\both\EstablishmentsController::class, 'update_establishment']);
   //WHIP
      //Employees Record
         Route::get("/g-a-em",[ App\Http\Controllers\systems\lls_whip\both\EmployeeController::class, 'get_all_employees']);
         Route::post("/i-e",[ App\Http\Controllers\systems\lls_whip\both\EmployeeController::class, 'insert_employee']);
         Route::post("/d-em",[ App\Http\Controllers\systems\lls_whip\both\EmployeeController::class, 'delete_employee']);
         Route::get("/search-emp",[ App\Http\Controllers\systems\lls_whip\both\EmployeeController::class, 'search_employee']);
      //Contractors
         Route::post("/whip/insert-contractor",[ App\Http\Controllers\systems\lls_whip\whip\both\ContractorsController::class, 'insert_contractor']);
         Route::get("/whip/g-a-c",[App\Http\Controllers\systems\lls_whip\whip\both\ContractorsController::class, 'get_all_contractors']);
         Route::post("/whip/d-c",[App\Http\Controllers\systems\lls_whip\whip\both\ContractorsController::class, 'delete_contractors']);
         Route::get("/whip/search-query",[App\Http\Controllers\systems\lls_whip\whip\both\ContractorsController::class, 'search_query']);  
      //Projects
         Route::post("/whip/insert-project",[ App\Http\Controllers\systems\lls_whip\whip\both\ProjectsController::class, 'insert_project']);
         Route::get("/whip/g-a-p",[App\Http\Controllers\systems\lls_whip\whip\both\ProjectsController::class, 'get_all_projects']);
         Route::post("/whip/d-p",[App\Http\Controllers\systems\lls_whip\whip\both\ProjectsController::class, 'delete_projects']);
         Route::get("/whip/search-project",[App\Http\Controllers\systems\lls_whip\whip\both\ProjectsController::class, 'search_project']);
      //Projects Monitoring
         Route::post("/whip/i-p-m",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'insert_project_monitoring']);
         Route::get("/whip/g-u-p-m",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'get_user_project_monitoring']);
         Route::post("/whip/u-p-m",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'update_project_monitoring']);
         Route::post("/whip/d-p-m",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'delete_project_monitoring']);
         Route::post("/whip/i-u-p-e",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'insert_update_project_employee']);
         Route::post("/whip/g-a-p-e",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'get_all_project_employee']);
         Route::post("/whip/d-p-e",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'delete_project_employee']);
         //Reports
            Route::post("/whip/g-n-e-i",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'get_nature_employee_inside']);
            Route::post("/whip/g-n-e-o",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'get_nature_employee_outside']);
            Route::post("/whip/g-s-u-t",[ App\Http\Controllers\systems\lls_whip\whip\user\MonitoringController::class, 'get_skilled_unskilled_total']);
      //WHIP POSITIONS
         Route::post("/whip/i-u-p",[App\Http\Controllers\systems\lls_whip\both\PositionsController::class, 'insert_update_position_whip']);
         Route::get("/whip/a-p",[App\Http\Controllers\systems\lls_whip\both\PositionsController::class, 'get_all_whip_positions']);
         Route::post("/d-p",[App\Http\Controllers\systems\lls_whip\both\PositionsController::class, 'delete_positions']);
   //DTS
      //My Documents
         Route::post("/dts/g-m-d",[App\Http\Controllers\systems\dts\user\MyDocumentsController::class, 'get_my_documents']);
      //Add Document
         Route::get("/dts/g-l-d",[App\Http\Controllers\systems\dts\user\AddDocumentController::class, 'get_documents_limit']);
         Route::get("/dts/g-t-n",[App\Http\Controllers\systems\dts\user\AddDocumentController::class, 'get_last_tracking_number']);
         Route::post("/dts/i-d",[App\Http\Controllers\systems\dts\user\AddDocumentController::class, 'insert_document']);
      //Incoming Documents
         Route::get('/dts/incoming-documents', [App\Http\Controllers\systems\dts\user\IncomingController::class, 'get_incoming_documents']);
         Route::post('dts/receive-documents', [App\Http\Controllers\systems\dts\user\IncomingController::class, 'receive_documents']);
      //Recieved Documents
         Route::get('dts/received-documents', [App\Http\Controllers\systems\dts\user\ReceivedController::class, 'get_received_documents']);
      //Forwarded Documents
         Route::get('dts/forwarded-documents', [App\Http\Controllers\systems\dts\user\ForwardedController::class, 'get_forwarded_documents']);
       //Forwarded Documents
         Route::get('dts/outgoing-documents', [App\Http\Controllers\systems\dts\user\OutgoingController::class, 'get_outgoing_documents']);
});



//ADMIN VIEW LLS_WHIP
Route::middleware([SessionGuard::class,AdminCheck::class])->prefix('/admin')->group(function () {
   //LLS

   //WHIP
      //Dashboard
         Route::get("/whip/dashboard",[ App\Http\Controllers\systems\lls_whip\whip\admin\DashboardController::class, 'index']);
      //Employees Record
         Route::get("/whip/employees-record",[ App\Http\Controllers\systems\lls_whip\both\EmployeeController::class, 'index']);
      //Contractors
         Route::get("/whip/add-new-contractor",[ App\Http\Controllers\systems\lls_whip\whip\both\ContractorsController::class, 'add_new_contractor']);
         Route::get("/whip/contractors-list",[ App\Http\Controllers\systems\lls_whip\whip\both\ContractorsController::class, 'contractors_list']);
      //Projects
         Route::get("/whip/add-new-project",[ App\Http\Controllers\systems\lls_whip\whip\both\ProjectsController::class, 'add_new_project']);
         Route::get("/whip/projects-list",[ App\Http\Controllers\systems\lls_whip\whip\both\ProjectsController::class, 'projects_list']);
      //Positions
         Route::get("/whip/whip-positions",[ App\Http\Controllers\systems\lls_whip\both\PositionsController::class, 'index']);
      //Employment Status
         Route::get("/whip/employment-status",[ App\Http\Controllers\systems\lls_whip\both\EmploymentStatusController::class, 'index']);
      //Project Nature
          Route::get("/whip/project-nature",[ App\Http\Controllers\systems\lls_whip\whip\admin\ProjectNatureController::class, 'index']);
   
});


// ADMIN ACTION LLS WHIP
Route::middleware([SessionGuard::class])->prefix('/admin/act')->group(function () {
   //LLS 




   // WHIP
     
      //Project Nature
         Route::post("/whip/i-u-p-n",[App\Http\Controllers\systems\lls_whip\whip\admin\ProjectNatureController::class, 'insert_update_nature']);
         Route::get("/whip/a-p-n",[App\Http\Controllers\systems\lls_whip\whip\admin\ProjectNatureController::class, 'get_all_project_nature']);
         Route::post("/whip/d-p-n",[App\Http\Controllers\systems\lls_whip\whip\admin\ProjectNatureController::class, 'delete_project_nature']);

   //Employment Status
      Route::get("/a-e-s",[App\Http\Controllers\systems\lls_whip\both\EmploymentStatusController::class, 'get_all_status']);
      Route::post("/i-u-e-s",[App\Http\Controllers\systems\lls_whip\both\EmploymentStatusController::class, 'insert_update_status']);
      Route::post("/d-s",[App\Http\Controllers\systems\lls_whip\both\EmploymentStatusController::class, 'delete_status']);

    
});