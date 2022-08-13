<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;


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
//Live Chat

Route::get('/chat_allusers','App\Http\Controllers\companyController@chat_allusers') ;
Route::get('/userlivesearch','App\Http\Controllers\companyController@userlivesearch') ;
Route::post('conv_messages','App\Http\Controllers\companyController@conv_messages');
Route::post('conv_messages2','App\Http\Controllers\companyController@conv_messages2');
Route::post('get_userdetail','App\Http\Controllers\companyController@get_userdetail');
Route::get('/fetch_user_session','App\Http\Controllers\companyController@fetch_user_session') ;
Route::post('submit_messages','App\Http\Controllers\companyController@submit_messages');











//Recruitement routes
Route::post('jobs','App\Http\Controllers\RecruitementController@post_job');  //Post job
Route::get('/job_detail2', 'App\Http\Controllers\RecruitementController@job_detail');  //view job detail
Route::get('/rec_activities', 'App\Http\Controllers\RecruitementController@all_rec_act');  //view recruitment activities

Route::get('fetch_jobs/{id}', 'App\Http\Controllers\RecruitementController@edit_job_fetch');  //edit job
Route::post('update_job', 'App\Http\Controllers\RecruitementController@update_job');
Route::get('ind_job_detail2/{id}', 'App\Http\Controllers\RecruitementController@ind_job_detail');  //Individule job
// candidate
Route::post('candidate','App\Http\Controllers\RecruitementController@add_candidate'); //Add
Route::get('/candidate_detail2', 'App\Http\Controllers\RecruitementController@candidate_detail');  //View
Route::get('/get_candidate_detail/{id}', 'App\Http\Controllers\RecruitementController@view_detail');  //Details
Route::post('searchcandidates', 'App\Http\Controllers\RecruitementController@searchcandidates');  //search
Route::get('fetch_candidates/{id}', 'App\Http\Controllers\RecruitementController@edit_candidate_fetch');  //fetch candidate to update
Route::post('update_candidate', 'App\Http\Controllers\RecruitementController@update_candidate');  //update candidate
Route::post('update_status', 'App\Http\Controllers\RecruitementController@update_status');  //update status
Route::post('update_status_int', 'App\Http\Controllers\RecruitementController@update_status_int');  //update status

//Interview
Route::post('schInterview','App\Http\Controllers\RecruitementController@schedule_interview');  //Schedule
Route::post('searchinterviews', 'App\Http\Controllers\RecruitementController@searchinterviews');  //search
Route::post('update_interview', 'App\Http\Controllers\RecruitementController@update_interview');  //update
Route::post('int_hire', 'App\Http\Controllers\RecruitementController@hire_interview');  //hire interview
Route::post('int_hire1', 'App\Http\Controllers\RecruitementController@hire_interview1');  //hire interview1
Route::get('/interview_detail2', 'App\Http\Controllers\RecruitementController@view_interviews');
Route::get('fetch_can/{id}', 'App\Http\Controllers\RecruitementController@fetch_can_post');//fetch rel candidate post
Route::get('fetch_interviews/{id}', 'App\Http\Controllers\RecruitementController@edit_interview_fetch');//fetch interviews to update
Route::get('/mnth_hired', 'App\Http\Controllers\RecruitementController@mnth_hired');  //Get hired candidates of last 30 days
Route::get('/cnd_hired', 'App\Http\Controllers\RecruitementController@cnd_hired');   //Count hired candidates


Route::get('/rel_cand_count', 'App\Http\Controllers\RecruitementController@rel_cand_count'); //Count relevent job candidates
Route::get('/top_counters', 'App\Http\Controllers\RecruitementController@top_counters'); //Count top list of dashboard

Route::get('/forgot_password',function(){
return view('forgot_password');
});
Route::get('/verify_email',function(){
return view('verify_email');
});
Route::get('/reset_password',function(){
return view('reset_password');
});








Route::post('test_image/submit',function(Request $request){
	
     if($request->hasFile('image_file')){
        $file = $request->file('image_file');
        $name_image = time().$file->getClientOriginalName();
        $file->move(public_path().'/images/', $name_image);
     return request()->json(200,$name_image);
    }

      
});
Route::post('submit_company_roles1','App\Http\Controllers\companyController@submit_company_roles1');
Route::post('submit_company_roles','App\Http\Controllers\companyController@submit_company_roles');

Route::post('submit_company_payroll','App\Http\Controllers\companyController@submit_company_payroll');
Route::post('submit_company_payroll1','App\Http\Controllers\companyController@submit_company_payroll1');

Route::post('submit_company_accounts','App\Http\Controllers\companyController@submit_company_accounts');
Route::post('submit_company_accounts1','App\Http\Controllers\companyController@submit_company_accounts1');

Route::get('/check_company_id','App\Http\Controllers\companyController@check_company_id') ;
Route::get('/overall_cities','App\Http\Controllers\HrController@overall_cities');

Route::get('/','App\Http\Controllers\companyController@home');
Route::get('/logout','App\Http\Controllers\companyController@logout') ;
Auth::routes();
Route::get('getcompanydetail','App\Http\Controllers\companyController@getcompanydetail');
Route::post('/login_success/', 'App\Http\Controllers\companyController@login_success' );
Route::get('/session_check2/', 'App\Http\Controllers\companyController@session_check2' );
Route::get('/session_check/', 'App\Http\Controllers\companyController@session_check' );
Route::post('create_company', 'App\Http\Controllers\companyController@create_company');
Route::post('submit_company_roles','App\Http\Controllers\companyController@submit_company_roles');
Route::get('/companies_detail', 'App\Http\Controllers\companyController@companies_detail' );
Route::get('/getcompany_detail/{id}', 'App\Http\Controllers\companyController@getcompany_detail');
Route::get('getcompany_modules/{id}','App\Http\Controllers\companyController@getcompany_modules');
Route::post('update_company','App\Http\Controllers\companyController@update_company');
Route::get('/deactivate_company/{id}','App\Http\Controllers\companyController@deactivate_company');
Route::get('/activate_company/{id}','App\Http\Controllers\companyController@activate_company');
Route::get('/deactivate_company1/{id}','App\Http\Controllers\companyController@deactivate_company1');
Route::get('/activate_company1/{id}','App\Http\Controllers\companyController@activate_company1');
Route::get('/fetch_user_hr_roles','App\Http\Controllers\companyController@fetch_user_hr_roles');
Route::get('/fetch_user_payroll_roles','App\Http\Controllers\companyController@fetch_user_payroll_roles');
Route::get('/fetch_emp_code','App\Http\Controllers\companyController@fetch_emp_code');


//Client Admin Routes
Route::get('view_cities/','App\Http\Controllers\clientAdminController@view_cities');
Route::post('submit_c','App\Http\Controllers\clientAdminController@submit_c');

Route::get('fetch_locations/{id}', 'App\Http\Controllers\clientAdminController@fetch_locations');  //fetch location to update
Route::get('fetch_department/{id}', 'App\Http\Controllers\clientAdminController@fetch_department');  //fetch departmrnt to update
Route::get('fetch_designations/{id}', 'App\Http\Controllers\clientAdminController@fetch_designations');  //fetch designations to update

Route::post('update_location', 'App\Http\Controllers\clientAdminController@update_location');  //update location
Route::post('update_designation', 'App\Http\Controllers\clientAdminController@update_designation');  //update designation
Route::post('update_department', 'App\Http\Controllers\clientAdminController@update_department');  //update department

Route::get('/delete_city/{id}', 'App\Http\Controllers\clientAdminController@delete_city');
Route::get('/delete_department/{id}', 'App\Http\Controllers\clientAdminController@delete_department');
Route::get('/delete_designation/{id}', 'App\Http\Controllers\clientAdminController@delete_designation');
Route::get('/delete_location/{id}', 'App\Http\Controllers\clientAdminController@delete_location');


Route::get('/users_detail', 'App\Http\Controllers\clientAdminController@users_detail' );
Route::get('/getuser_detail/{id}', 'App\Http\Controllers\clientAdminController@getuser_detail' );
Route::get('/location_detail', 'App\Http\Controllers\clientAdminController@location_detail');

Route::post('submit_location','App\Http\Controllers\clientAdminController@submit_location');
Route::get('/deactivate_location/{id}','App\Http\Controllers\clientAdminController@deactivate_location');
Route::get('/activate_location/{id}','App\Http\Controllers\clientAdminController@activate_location');
Route::get('/search_location/','App\Http\Controllers\clientAdminController@search_location');

Route::post('submit_designation','App\Http\Controllers\clientAdminController@submit_designation');
Route::get('/designation_detail', 'App\Http\Controllers\clientAdminController@designation_detail');

Route::get('/deactivate_designation/{id}','App\Http\Controllers\clientAdminController@deactivate_designation');
Route::get('/activate_designation/{id}','App\Http\Controllers\clientAdminController@activate_designation');
Route::get('/search_designation/','App\Http\Controllers\clientAdminController@search_designation');
Route::get('/search_department/','App\Http\Controllers\clientAdminController@search_department');

Route::post('submit_department','App\Http\Controllers\clientAdminController@submit_department');
Route::get('/department_detail', 'App\Http\Controllers\clientAdminController@department_detail');
Route::get('/deactivate_department/{id}','App\Http\Controllers\clientAdminController@deactivate_department');
Route::get('/activate_department/{id}','App\Http\Controllers\clientAdminController@activate_department');
Route::get('/overall_users','App\Http\Controllers\clientAdminController@overall_users');
Route::get('/overall_empcode','App\Http\Controllers\clientAdminController@overall_empcode');

Route::get('/overall_location','App\Http\Controllers\clientAdminController@overall_location');
Route::get('/overall_designation','App\Http\Controllers\clientAdminController@overall_designation');

Route::get('/overall_department','App\Http\Controllers\clientAdminController@overall_department');
Route::post('create_user', 'App\Http\Controllers\clientAdminController@create_user');
Route::post('update_user/{id}', 'App\Http\Controllers\clientAdminController@update_user');

Route::get('/search_users/','App\Http\Controllers\clientAdminController@search_users');
Route::post('get_statuswise_users', 'App\Http\Controllers\clientAdminController@get_statuswise_users');
Route::post('get_designationwise_users', 'App\Http\Controllers\clientAdminController@get_designationwise_users');
Route::post('get_locationwise_users', 'App\Http\Controllers\clientAdminController@get_locationwise_users');
Route::get('/deactivate_user/{id}','App\Http\Controllers\clientAdminController@deactivate_user');
Route::get('/activate_user/{id}','App\Http\Controllers\clientAdminController@activate_user');
Route::post('submit_user_roles','App\Http\Controllers\clientAdminController@submit_user_roles');
Route::get('/fetch_user_roles/{email}','App\Http\Controllers\clientAdminController@fetch_user_roles');
Route::get('/fetch_company_roles/{company_id}','App\Http\Controllers\companyController@fetch_company_roles');
Route::get('/fetch_company_roles_payroll/{company_id}','App\Http\Controllers\companyController@fetch_company_roles_payroll');
Route::get('/fetch_company_roles_accounts/{company_id}','App\Http\Controllers\companyController@fetch_company_roles_accounts');


Route::get('/count_users','App\Http\Controllers\clientAdminController@count_users');

Route::get('/user_session/', 'App\Http\Controllers\companyController@user_session' );
Route::get('/fetch_image', 'App\Http\Controllers\clientAdminController@fetch_image');

//Route::get('/dark_status/', 'App\Http\Controllers\companyController@dark_status' );
 Route::post('/updatepic', 'App\Http\Controllers\companyController@updatepic');


Route::get('/fetch_tour_status', 'App\Http\Controllers\companyController@fetch_tour_status');
Route::get('/update_tour_status', 'App\Http\Controllers\companyController@update_tour_status');

//HR ind 
Route::get('/cnt_tl_empl', 'App\Http\Controllers\RecruitementController@cnt_tl_emp');  // Count all employees
Route::get('/dept_att', 'App\Http\Controllers\HrController@all_attendence');  //Get all dept att
Route::get('/this_user_attendence', 'App\Http\Controllers\HrController@this_user_attendence');  //get this user attendence
Route::get('/m_att_dtl_ct', 'App\Http\Controllers\HrController@m_att_dtl_ct');  //Count current month attendence details
Route::post('leave_request_rt','App\Http\Controllers\HrController@leave_request_fn'); //Add leave Request
Route::get('/view_profile', 'App\Http\Controllers\HrController@view_profile');  //View logged-in employee detail
Route::get('/view_profile_qual', 'App\Http\Controllers\HrController@view_profile_qual');  //View logged-in employee qualification
Route::get('/m_lv_dtl_rt', 'App\Http\Controllers\HrController@m_lv_dtl');  //Get leaves details

Route::get('/ind_team_att', 'App\Http\Controllers\HrController@all_ind_team');  //Get all team of logged in employee
Route::post('mark_team_att','App\Http\Controllers\HrController@mark_team_att'); //Add Candidate
Route::get('ind_att_detail2/{id}', 'App\Http\Controllers\HrController@ind_att_detail');  //Individule attendence
Route::get('fetch_att/{id}', 'App\Http\Controllers\HrController@fetch_att');  //fetch candidate to update
Route::post('update_attandence', 'App\Http\Controllers\HrController@update_attandence');  //update attandence
Route::get('team_all_leaves','App\Http\Controllers\HrController@team_all_leaves');  //team leaves of logged in employee
Route::get('/find_team_id','App\Http\Controllers\HrController@all_ind_team');  //team members to apply leave

//HRMS Routes
Route::get('hr/getEmployeedetail', 'App\Http\Controllers\HrController@getEmployeedetail');

Route::post('create_employee', 'App\Http\Controllers\HrController@create_employee');
Route::post('update_employee', 'App\Http\Controllers\HrController@update_employee');


Route::get('/overall_employees','App\Http\Controllers\HrController@overall_employees');
Route::post('update_employment','App\Http\Controllers\HrController@update_employment');
Route::get('/department_detail2', 'App\Http\Controllers\HrController@department_detail');
Route::post('/skip_education', 'App\Http\Controllers\HrController@skip_education');
Route::post('insert_education','App\Http\Controllers\HrController@insert_education');
Route::post('update_education','App\Http\Controllers\HrController@update_education');

 Route::post('insert_experience','App\Http\Controllers\HrController@insert_experience');
Route::get('/geteducation_detail/{id}','App\Http\Controllers\HrController@geteducation_detail');

Route::get('/getemployee_detail/{id}','App\Http\Controllers\HrController@getemployee_detail');
Route::get('/getemployment_detail/{id}','App\Http\Controllers\HrController@getemployment_detail');

Route::post('/skip_experience', 'App\Http\Controllers\HrController@skip_experience');
Route::get('/count_employees','App\Http\Controllers\HrController@count_employees');
Route::get('/getindemployee_detail/{id}','App\Http\Controllers\HrController@getindemployee_detail');
Route::get('/getemployee_education/{id}','App\Http\Controllers\HrController@getemployee_education');

Route::get('/getemployee_exp/{id}','App\Http\Controllers\HrController@getemployee_exp');
Route::get('/success_array/{id}','App\Http\Controllers\HrController@success_array');
Route::get('/resigned_emp/{id}','App\Http\Controllers\HrController@resigned_emp');
Route::get('/registered/{id}','App\Http\Controllers\HrController@registered');

Route::get('/suspend_emp/{id}','App\Http\Controllers\HrController@suspend_emp');
Route::get('/getemployee_update_education/{id}','App\Http\Controllers\HrController@getemployee_update_education');
Route::get('/getemployee_update_experience/{id}','App\Http\Controllers\HrController@getemployee_update_experience');

Route::post('update_emp_docs', 'App\Http\Controllers\HrController@update_emp_docs');

Route::get('/getemployee_documents/{id}','App\Http\Controllers\HrController@getemployee_documents');

Route::get('/filter_leaves_byId/','App\Http\Controllers\HrController@filter_leaves_byId');
Route::get('searchemployee/{dep}/{loc}/{des}/{gen}/{sts}/{min}/{max}/{cnic}/{id}/{ests}','App\Http\Controllers\HrController@searchemployee');
Route::get('/search_emp/','App\Http\Controllers\HrController@search_emp');
Route::post('filter_activity','App\Http\Controllers\clientAdminController@filter_activity');
Route::get('/get_com_employee/','App\Http\Controllers\HrController@get_com_employee');
Route::get('/org_employees/{id}','App\Http\Controllers\HrController@org_employees');
Route::get('cv_builder/{id}/{emp_code}/{reg_id}','App\Http\Controllers\HrController@cv_builder');
Route::post('get_emp_detail','App\Http\Controllers\HrController@get_emp_detail');

Route::get('warning_reasons','App\Http\Controllers\HrController@warning_reasons');
Route::get('fetch_companydetail','App\Http\Controllers\HrController@fetch_companydetail');

Route::post('submit_warning','App\Http\Controllers\HrController@submit_warning');
Route::get('warning_detail','App\Http\Controllers\HrController@warning_detail');
Route::get('/count_warnings','App\Http\Controllers\HrController@count_warnings');

Route::get('/search_warnings/','App\Http\Controllers\HrController@search_warnings');
Route::post('filter_warnings','App\Http\Controllers\HrController@filter_warnings');
Route::get('/getwarnig_d/{id}','App\Http\Controllers\HrController@getwarnig_d');
Route::post('submit_roster','App\Http\Controllers\HrController@submit_roster');
Route::post('submit_update_roster','App\Http\Controllers\HrController@submit_update_roster');

Route::get('/roster_detail','App\Http\Controllers\HrController@roster_detail');
Route::get('overall_grace_period','App\Http\Controllers\HrController@overall_grace_period');

Route::get('/search_by_grace_period/{id}','App\Http\Controllers\HrController@search_by_grace_period');
Route::post('update_ind_grace','App\Http\Controllers\HrController@update_ind_grace');
Route::post('update_overall_grace','App\Http\Controllers\HrController@update_overall_grace');
Route::get('/roster_detail1','App\Http\Controllers\HrController@roster_detail1');

Route::get('/attendance_detail','App\Http\Controllers\HrController@attendance_detail');
Route::get('/count_today_attendance','App\Http\Controllers\HrController@count_today_attendance');
Route::get('getattendance_report/{department}/{location}/{designation}/{emp_id}/{opening}/{closing}','App\Http\Controllers\HrController@getattendance_report');
Route::get('getattendance_report9/{department}/{location}/{designation}/{opening}/{closing}','App\Http\Controllers\HrController@getattendance_report9');
Route::get('getattendance_summary','App\Http\Controllers\HrController@getattendance_summary');

Route::get('/get_column_name', 'App\Http\Controllers\HrController@get_column_name');

Route::post('submit_session','App\Http\Controllers\HrController@submit_session');

Route::get('/session_detail', 'App\Http\Controllers\HrController@session_detail');
Route::get('/delete_session/{id}', 'App\Http\Controllers\HrController@delete_session');
Route::get('/delete_session/{id}', 'App\Http\Controllers\HrController@delete_session');
Route::get('/find_emp_id','App\Http\Controllers\HrController@find_emp_id');
Route::get('/getindatt_report/{id}','App\Http\Controllers\HrController@getindatt_report');
Route::get('/getindatt_count/{id}','App\Http\Controllers\HrController@getindatt_count');
Route::get('get_absent_detail/{opening}/{closing}','App\Http\Controllers\HrController@get_absent_detail');
Route::get('getemploydetail/{emp_department}/{emp_location}/{emp_designation}/{emp_emp_id}/{emp_type}/{emp_status}','App\Http\Controllers\HrController@getemploydetail');
Route::get('gethireemploy/{hire_department}/{hire_location}/{hire_designation}/{hire_emp_id}/{hire_start_date}/{hire_end_date}','App\Http\Controllers\HrController@gethireemploy');
Route::get('gethireemploycount/{hire_department}/{hire_location}/{hire_designation}/{hire_emp_id}/{hire_start_date}/{hire_end_date}','App\Http\Controllers\HrController@gethireemploycount');

Route::get('overall_leaves','App\Http\Controllers\HrController@overall_leaves');
Route::get('filter_leaves/{leave}/{dept}/{loc}/{des}','App\Http\Controllers\HrController@filter_leaves');

Route::get('getleaveemploy/{dept}/{loc}/{des}/{emp_id}/{date_from}/{date_end}/{leave_type}','App\Http\Controllers\HrController@getleaveemploy');
Route::get('filter_leaves1/{dept}/{loc}/{des}/{emp_id}/{leave}/','App\Http\Controllers\HrController@filter_leaves1');
Route::get('fetch_roster_detail/{id}','App\Http\Controllers\HrController@fetch_roster_detail');

Route::post('submit_holidays','App\Http\Controllers\HrController@submit_holidays');

Route::get('holiday_detail/','App\Http\Controllers\HrController@holiday_detail');

Route::post('submit_leave','App\Http\Controllers\HrController@submit_leave');
Route::post('submit_l','App\Http\Controllers\HrController@submit_l');
Route::post('submit_fine','App\Http\Controllers\HrController@submit_fine');

Route::get('view_leave_type/','App\Http\Controllers\HrController@view_leave_type');
Route::get('view_fine_detail/','App\Http\Controllers\HrController@view_fine_detail');
 
 Route::get('/delete_fine/{id}', 'App\Http\Controllers\HrController@delete_fine');
Route::get('/delete_leave_type/{id}', 'App\Http\Controllers\HrController@delete_leave_type');
Route::get('/delete_holiday/{id}', 'App\Http\Controllers\HrController@delete_holiday');

Route::post('update_ind_att','App\Http\Controllers\HrController@update_ind_att');
Route::get('/search_att/','App\Http\Controllers\HrController@search_att');
Route::get('/get_count_leave/','App\Http\Controllers\HrController@get_count_leave');

Route::get('/get_payroll_att_detail/','App\Http\Controllers\HrController@get_payroll_att_detail');

Route::get('/get_count_dailyatt/','App\Http\Controllers\HrController@get_count_dailyatt');
Route::get('/count_firing_d/','App\Http\Controllers\HrController@count_firing_d');
Route::get('/count_hiring_d/','App\Http\Controllers\HrController@count_hiring_d');
Route::get('/view_hr_configuration/','App\Http\Controllers\HrController@view_hr_configuration');
Route::post('submit_config','App\Http\Controllers\HrController@submit_config');
Route::get('/overall_payroll_employees','App\Http\Controllers\HrController@overall_payroll_employees');
Route::get('/fetch_emp_detail/{id}','App\Http\Controllers\HrController@fetch_emp_detail');
Route::post('submit_payroll_detail','App\Http\Controllers\HrController@submit_payroll_detail');
Route::get('filter_employees/{emp_id}/{dept}/{loc}/{des}','App\Http\Controllers\HrController@filter_employees');
Route::get('update_payroll_status/{id}','App\Http\Controllers\HrController@update_payroll_status');
Route::get('fetch_payroll_generation','App\Http\Controllers\HrController@fetch_payroll_generation');
Route::get('getpayroll_gen_report/{emp_id}/{department}/{designation}/{status}','App\Http\Controllers\HrController@getpayroll_gen_report');
Route::get('/search_payroll/','App\Http\Controllers\HrController@search_payroll');
Route::get('/find_session/','App\Http\Controllers\HrController@find_session');

Route::get('/find_payroll_emp/{id}','App\Http\Controllers\HrController@find_payroll_emp');
Route::post('update_payroll_ind_status','App\Http\Controllers\HrController@update_payroll_ind_status');
Route::get('/proceedhrapproval','App\Http\Controllers\HrController@proceedhrapproval');
Route::get('/proceedfinanceapproval','App\Http\Controllers\HrController@proceedfinanceapproval');

Route::get('/search_hr_approval/','App\Http\Controllers\HrController@search_hr_approval');


Route::get('fetch_payroll_hr_approval','App\Http\Controllers\HrController@fetch_payroll_hr_approval');

Route::get('/find_payroll_emp_hrapproval/{id}','App\Http\Controllers\HrController@find_payroll_emp_hrapproval');
Route::post('update_payroll_ind_status_hrapproval','App\Http\Controllers\HrController@update_payroll_ind_status_hrapproval');

Route::get('fetch_payroll_finance_approval','App\Http\Controllers\HrController@fetch_payroll_finance_approval');

Route::get('chech_installments','App\Http\Controllers\HrController@chech_installments');
Route::get('/search_finance_approval/','App\Http\Controllers\HrController@search_finance_approval');



Route::get('/find_payroll_emp_financeapproval/{id}','App\Http\Controllers\HrController@find_payroll_emp_financeapproval');

Route::post('update_payroll_ind_status_financeapproval','App\Http\Controllers\HrController@update_payroll_ind_status_financeapproval');
Route::get('/fetch_distribution_cash_payabale/{department_name}','App\Http\Controllers\HrController@fetch_distribution_cash_payabale');
Route::get('/fetch_distribution_bank_payabale/','App\Http\Controllers\HrController@fetch_distribution_bank_payabale');

Route::get('/proceeddistapproval','App\Http\Controllers\HrController@proceeddistapproval');
Route::get('/view_emp_salary_slip/{id}','App\Http\Controllers\HrController@view_emp_salary_slip');
Route::get('/generate_slip/{emp_id}/{slip_id}/{emp_code}','App\Http\Controllers\HrController@generate_slip');

Route::post('submit_arrears', 'App\Http\Controllers\HrController@submit_arrears'); 
Route::get('/fetch_payroll_arrears','App\Http\Controllers\HrController@fetch_payroll_arrears');

Route::get('approve_arrears/{id}', 'App\Http\Controllers\HrController@approve_arrears');

Route::get('find_payroll_arrear/{id}', 'App\Http\Controllers\HrController@find_payroll_arrear');
Route::post('update_ind_arrears', 'App\Http\Controllers\HrController@update_ind_arrears');

Route::post('submit_bonus', 'App\Http\Controllers\HrController@submit_bonus'); 
Route::get('/fetch_payroll_bonus','App\Http\Controllers\HrController@fetch_payroll_bonus');
Route::get('approve_bonus/{id}', 'App\Http\Controllers\HrController@approve_bonus');
Route::get('find_payroll_bonus/{id}', 'App\Http\Controllers\HrController@find_payroll_bonus');

Route::post('update_ind_bonus', 'App\Http\Controllers\HrController@update_ind_bonus');
Route::post('submit_dues', 'App\Http\Controllers\HrController@submit_dues');

Route::get('/fetch_payroll_dues','App\Http\Controllers\HrController@fetch_payroll_dues');
Route::get('find_payroll_dues/{id}', 'App\Http\Controllers\HrController@find_payroll_dues');
Route::post('update_ind_dues', 'App\Http\Controllers\HrController@update_ind_dues');

Route::get('approve_dues/{id}', 'App\Http\Controllers\HrController@approve_dues');
Route::get('/fetch_payroll_allowance','App\Http\Controllers\HrController@fetch_payroll_allowance');

Route::post('submit_allowance', 'App\Http\Controllers\HrController@submit_allowance'); 
Route::get('approve_allowance/{id}', 'App\Http\Controllers\HrController@approve_allowance');

Route::get('find_payroll_allowance/{id}', 'App\Http\Controllers\HrController@find_payroll_allowance');
Route::get('allowance_arrears','App\Http\Controllers\HrController@allowance_arrears');



Route::post('update_ind_allowance', 'App\Http\Controllers\HrController@update_ind_allowance');
//Payroll loans
Route::get('fetch_employee_dtl/{id}', 'App\Http\Controllers\HrController@fetch_employee_dtl');  //fetch Employee detail for loan and advance
Route::post('loan','App\Http\Controllers\HrController@add_loan_req'); //Add loan
Route::get('/fetch_all_loans', 'App\Http\Controllers\HrController@fetch_all_loans');  //View loans
Route::get('/fetch_filtered_loans/{id}','App\Http\Controllers\HrController@fetch_filtered_loans'); //Fetch filtered loans
Route::get('fetch_emp_upSts/{id}', 'App\Http\Controllers\HrController@fetch_rel_loan');  //Fetch rel loan
Route::get('/fetch_all_installments', 'App\Http\Controllers\HrController@fetch_all_installments');  //View installments
Route::post('update_loan_m_sts', 'App\Http\Controllers\HrController@update_loan_m_sts');  //update loan manager status
Route::post('pay_loan', 'App\Http\Controllers\HrController@pay_loan');  //Pay loan
Route::get('/overall_employees_pr','App\Http\Controllers\HrController@overall_employees_payroll');
Route::get('filter_loans/{from}/{to}/{dept}/{desig}/{name}','App\Http\Controllers\HrController@filter_loan_requisitions');

Route::get('/search_arrears','App\Http\Controllers\HrController@search_arrears');

Route::get('filter_leaves_requisitions/{leave}/{dept}/{loc}/{des}','App\Http\Controllers\HrController@filter_leaves_requisitions');
Route::get('fetch_leave_upSts/{id}', 'App\Http\Controllers\HrController@fetch_leave_upSts');  //Fetch rel leave
Route::post('update_leave_sts', 'App\Http\Controllers\HrController@update_leave_sts');  //update leave status
Route::get('all_leaves','App\Http\Controllers\HrController@all_leaves');
Route::get('ind_name/{id}', 'App\Http\Controllers\HrController@ind_name');  //Individule name for attendence
Route::post('search_member', 'App\Http\Controllers\HrController@search_member');  //search team member
Route::get('filter_team_leaves/{leave}/{dept}/{loc}/{des}','App\Http\Controllers\HrController@filter_team_leaves');
Route::get('/leaves_dtl', 'App\Http\Controllers\HrController@leaves_dtl');  //Count leaves detail

Route::get('selected_emp_leaves/{id}', 'App\Http\Controllers\HrController@selected_emp_leaves');  //Fetch rel leave
Route::get('selected_emp_leaves_blnc/{id}', 'App\Http\Controllers\HrController@selected_emp_leaves_blnc');  //Fetch rel leave balance
Route::get('selected_emp_timeTable/{id}', 'App\Http\Controllers\HrController@selected_emp_timeTable');  //Fetch rel timeTable
Route::get('/selected_emp_attendance/{id}','App\Http\Controllers\HrController@getindatt_report'); //Fetch rel session attandence
Route::get('reporting_employees/{id}','App\Http\Controllers\HrController@reporting_employees');

//Routes
Route::get('/session_att/','App\Http\Controllers\HrController@session_att');
Route::get('/hrdb_employee_count/','App\Http\Controllers\HrController@hrdb_employee_count');
Route::get('/job_exp_employee/','App\Http\Controllers\HrController@job_exp_employee');
Route::get('/cnic_exp_employee/','App\Http\Controllers\HrController@cnic_exp_employee');
Route::get('get_gracePeriods/{designation}/{location}/{department}','App\Http\Controllers\HrController@get_gracePeriods');
Route::get('get_faqs/{catagory}','App\Http\Controllers\companyController@get_faqs');
Route::get('/get_faqs_cat','App\Http\Controllers\companyController@get_faqs_cat');

Route::post('return_loan', 'App\Http\Controllers\HrController@return_loan');  //Return loan



Route::post('confirm_oldPass','App\Http\Controllers\clientAdminController@confirm_oldPass');  //Submit old pass
Route::post('change_Pass','App\Http\Controllers\clientAdminController@change_Pass');  //Change pass
Route::get('warning_reason/','App\Http\Controllers\HrController@warning_reason');
Route::get('emp_leaves/','App\Http\Controllers\HrController@emp_leaves');
Route::post('submit_warn_reas','App\Http\Controllers\HrController@submit_warn_reas');
Route::post('submit_emp_leaves','App\Http\Controllers\HrController@submit_emp_leaves');
Route::get('/delete_warn_reas/{id}', 'App\Http\Controllers\HrController@delete_warn_reas');