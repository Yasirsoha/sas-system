<?php
namespace App\Http\Controllers;
use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\FileUpload;
class companyController extends Controller
{
	public function home(){
    // try {
    //     DB::connection('sqlsrv2')->getPdo();
    //     if(DB::connection('sqlsrv2')->getDatabaseName()){
    //         echo "Yes! Successfully connected to the DB: " . DB::connection('sqlsrv2')->getDatabaseName();
    //     }else{
    //         die("Could not find the database. Please check your configuration.");
    //     }
    // } catch (\Exception $e) {
    //     die("Could not open connection to database server.  Please check your configuration.");
    // }
    //  $find_company_id=DB::connection('sqlsrv2')->table('tb_users')->get();
    //  print_r($find_company_id);

        if(Session::get('company_id')=='a'){
          return view('dashboard');
        }elseif(Session::get('username')!=''&&Session::get('company_id')!='a'){
        	 return view('main_dashboard');
        }else{
		   return view('index');
        }
	}
  public function check_company_id(){
   $arr=Session::get('company_id');
     return request()->json(200, $arr); 
  }
    public function create_company(Request $request){
        $company_name=$request->get('company_name');
        $phone_number=$request->get('phone_number');
        $company_prefix = $request->get('company_prefix');
        $license_id=$request->get('license_id');
        $address=$request->get('address');
        $website_link=$request->get('website_link');
        $city=$request->get('city');
        $country=$request->get('country');
        $username=$request->get('username');
        $password=$request->get('password');
        $email=$request->get('email');
        $sector=$request->get('sector');
        $image="test.png";
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("d-m-Y h:i:s A");

        $check_company_email = DB::table('tb_create_company')->where('company_name','=',$company_name)->orwhere('company_email','=',$email)->exists();
        if($check_company_email){
            $data="Company Already Exists in Our Database.Please Try Other One!";
            return request()->json(200,$data); 
        }
        else{
            $unique_id=uniqid();
            DB::insert('INSERT INTO tb_create_company(company_name, company_prefix, license_id, phone_number, company_email, company_link, company_address, city,country, company_logo, created_at, company_id, c_status) values (?,?,?,?,?,?,?,?,?,?,?,?,?)', [$company_name, $company_prefix, $license_id, $phone_number, $email, $website_link, $address.",".$sector, $city,$country, $image,$update_date, $unique_id, 'Active']);  

            $find_company_id=DB::table('tb_create_company')->where('company_name','=',$company_name)->where('company_email','=',$email)->get();
            foreach ($find_company_id as $find_company_id1) {
                # code...
            }  
            $company_id=$find_company_id1->company_id;
    
            DB::connection('sqlsrv2')->insert('INSERT INTO HrCompanyConfig(CompanyID) values (?)', [$company_id]);
            DB::connection('sqlsrv2')->insert('INSERT INTO Emp_Register(EmployeeCode,CompanyID) values (?,?)', ['-1',$company_id]);
    
            DB::insert('INSERT INTO tb_users(emp_code,username,user_password,created_time,email,user_role,company_id,u_status) values (?,?,?,?,?,?,?,?)', ['-1',$username, $password, $update_date, $email, 'superadmin', $company_id, 'Active']);

            $find_user_id=DB::table('tb_users')->where('email','=',$email)->where('company_id','=',$company_id)->where('user_role','=','superadmin')->get();
            foreach ($find_user_id as $find_user_id1) {
              # code...
            } 
            $user_id=$find_user_id1->id;

            DB::insert('INSERT INTO tb_roles_permissions(user_id,user_email,hr_read,hr_write,hr_restricted,company_id,hr_superadmin,hr_overall) values (?,?,?,?,?,?,?,?)', [$user_id,$email, 'true', 'true', 'true',$company_id,'true','true']);

            $data="Data Submit Successfully";
            return request()->json(200,$data); 
        }
    }
    public function getcompanydetail(){
    	 $company=DB::table('tb_create_company')->get();
            return request()->json(200,$company);
    }
    public function login_success(Request $request){
         $username = $request->get('username');
         $password = $request->get('password');
		
        $staff_detail = DB::table('tb_users')->where('email', '=', $username)->where('user_password', '=',$password)->exists();
    				if($staff_detail){
               $user_detail = DB::table('tb_users')->where('email', '=', $username)->where('user_password', '=',$password)->get();
               foreach ($user_detail as $user_detail1) {
                 
               }
               $company_id=$user_detail1->company_id;
               




               $company_detail = DB::table('tb_create_company')->where('company_id', '=',$company_id)->get();
               foreach ($company_detail as $company_detail1) {
                 # code...
               }
               $find_status=$company_detail1->c_status;
                 $company_name=$company_detail1->company_name;
                 $company_logo=$company_detail1->company_logo;
               if($find_status=='Not Active'){
                $message='Your company is deactivated.';
               return request()->json(200,$message); 
               }else{
            if($company_detail1->company_id!='a'){
            $roles_detail =DB::table('tb_roles_permissions')->where('company_id', '=',$company_id)->where('user_email', '=',$username)->get();
               foreach ($roles_detail as $roles_detail1) {
                 # code...
               }
               $hr_read=$roles_detail1->hr_read;
               $hr_write=$roles_detail1->hr_write;
               $hr_restricted=$roles_detail1->hr_restricted;
               $hr_superadmin=$roles_detail1->hr_superadmin;
               $hr_overall=$roles_detail1->hr_overall;

              $payroll_read=$roles_detail1->payroll_read;
               $payroll_write=$roles_detail1->payroll_write;
               $payroll_restricted=$roles_detail1->payroll_restricted;
               $payroll_superadmin=$roles_detail1->payroll_superadmin;
               $payroll_overall=$roles_detail1->payroll_overall;

               $accounts_read=$roles_detail1->accounts_read;
               $accounts_write=$roles_detail1->accounts_write;
               $accounts_superadmin=$roles_detail1->accounts_superadmin;
               $accounts_overall=$roles_detail1->accounts_overall;







               $company_hr_roles=DB::table('tb_company_roles')->where('company_id', '=',$company_id)->where('permission_module','=','hr')->exists();
               if($company_hr_roles){
                $company_hr_roles1 =DB::table('tb_company_roles')->where('company_id', '=',$company_id)->where('permission_module', '=','hr')->get();
                foreach ($company_hr_roles1 as $company_hr_roles11) {
                  # code...
                }
                $hr_status2=$company_hr_roles11->module_status;
                 $mo_st = explode("_" ,  $hr_status2);

                Session::put('company_hr_status',$mo_st[0]);
                 Session::put('company_hr_plan',$mo_st[1]);
                }
                 $company_hr_roles=DB::table('tb_company_roles')->where('company_id', '=',$company_id)->where('permission_module','=','payroll')->exists();
               if($company_hr_roles){
                $company_hr_roles1 =DB::table('tb_company_roles')->where('company_id', '=',$company_id)->where('permission_module', '=','payroll')->get();
                foreach ($company_hr_roles1 as $company_hr_roles11) {
                  # code...
                }
                $payroll_status=$company_hr_roles11->module_status;
                 
                 Session::put('company_payroll_plan',$payroll_status);
                }
               $company_accounts_roles=DB::table('tb_company_roles')->where('company_id', '=',$company_id)->where('permission_module','=','accounts')->exists();
               if($company_accounts_roles){
                $company_accounts_roles1 =DB::table('tb_company_roles')->where('company_id', '=',$company_id)->where('permission_module', '=','accounts')->get();
                foreach ($company_accounts_roles1 as $company_accounts_roles11) {
                  # code...
                }
                $accounts_status=$company_accounts_roles11->module_status;
                 
                 Session::put('company_accounts_plan',$accounts_status);
                }
            $user_detail5 = DB::table('tb_users')->where('email', '=', $username)->where('user_password', '=',$password)->get();
               foreach ($user_detail5 as $user_detail51) {
                 
               }
              
                $user_code=$user_detail51->emp_code;

                $emp_reg_detail = DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID', '=',$company_id)->where('EmployeeCode', '=',$user_code)->get();
                foreach ($emp_reg_detail as $emp_reg_detail1) {
                  # code...
                }
                $emp_i=$emp_reg_detail1->EmployeeID;

                Session::put('employee_id',$emp_i); 

                 Session::put('company_id',$user_detail1->company_id);
                Session::put('user_role',$user_detail1->user_role);
                Session::put('hr_read',$hr_read);
                Session::put('hr_write',$hr_write);
                Session::put('hr_restricted',$hr_restricted);
                Session::put('hr_superadmin',$hr_superadmin);
                Session::put('hr_overall',$hr_overall);

                Session::put('payroll_read',$payroll_read);
                Session::put('payroll_write',$payroll_write);
                Session::put('payroll_restricted',$payroll_restricted);
                Session::put('payroll_superadmin',$payroll_superadmin);
                Session::put('payroll_overall',$payroll_overall);
                
                 Session::put('accounts_read',$accounts_read);
                Session::put('accounts_write',$accounts_write);
                Session::put('accounts_overall',$accounts_overall);
                Session::put('accounts_superadmin',$accounts_superadmin);

              Session::put('username',$user_detail1->email); 
              Session::put('company_name',$company_name) ;
              Session::put('company_logo',$company_logo) ;
               Session::put('emp_code',$user_detail1->emp_code);
              
            }else{
              Session::put('username',$user_detail1->email); 
              Session::put('emp_code',$user_detail1->emp_code);
               Session::put('company_id',$user_detail1->company_id);
               Session::put('UserName',$user_detail1->first_name." ".$user_detail1->last_name);

            }
                
                 $message='Valid Email Id and Password';
               return request()->json(200,$message); 
               }

               
 					 }
					    else{
					         $message='Invalid Email Id and Password';
					       return request()->json(200,$message); 
					 }

        }

   
    public function logout(){
         Session::flush();
       
          $message="user logout";
            return request()->json(200,$message);
    }
    public function fetch_emp_code(){
        $emp_code=Session::get('emp_code');
            return request()->json(200,$emp_code);
    }
     public function fetch_tour_status(){
         $emp_code=Session::get('username');
          $user_detail5 = DB::table('tb_users')->where('email', '=', $emp_code)->get();
               foreach ($user_detail5 as $user_detail51) {
                 
               }

            return request()->json(200,$user_detail51->tour_status);
    }
    public function update_tour_status(){
         $emp_code=Session::get('username');
          // $result=  DB::update('update tb_users set tour_status = ? where email = ?',['1',$emp_code]);
            return request()->json(200,'ok');
    }
    public function session_check(){

       $myJSON =array(
      'username' => Session::get('username'),
      'company_id'=>Session::get('company_id'),
      'user_role'=>Session::get('user_role'),
      'hr_read'=>Session::get('hr_read'),
      'hr_write'=>Session::get('hr_write'),
      'hr_restricted'=>Session::get('hr_restricted'),
      'hr_superadmin'=>Session::get('hr_superadmin'),
      'hr_restricted'=>Session::get('hr_restricted'),
      'hr_overall'=>Session::get('hr_overall'),
      'payroll_read'=>Session::get('payroll_read'),
      'payroll_write'=>Session::get('payroll_write'),
      'payroll_restricted'=>Session::get('payroll_restricted'),
      'payroll_superadmin'=>Session::get('payroll_superadmin'),
      'payroll_overall'=>Session::get('payroll_overall'),
       'accounts_read'=>Session::get('accounts_read'),
      'accounts_write'=>Session::get('accounts_write'),
      'accounts_overall'=>Session::get('accounts_overall'),
      'accounts_superadmin'=>Session::get('accounts_superadmin'),
       'company_name'=>Session::get('company_name'),
      'company_logo'=>Session::get('company_logo'),
      'company_hr_status'=>Session::get('company_hr_status'),
      'company_payroll_plan'=>Session::get('company_payroll_plan'),
      'company_accounts_plan'=>Session::get('company_accounts_plan'),
       );
      return request()->json(200,$myJSON); 
    }
    public function fetch_user_hr_roles(){

       $myJSON =array(
      'hr_read'=>Session::get('hr_read'),
      'hr_write'=>Session::get('hr_write'),
      'hr_restricted'=>Session::get('hr_restricted'),
      'hr_superadmin'=>Session::get('hr_superadmin'),
      'hr_restricted'=>Session::get('hr_restricted'),
      'hr_overall'=>Session::get('hr_overall'),
       );
      return request()->json(200,$myJSON); 
    }
    public function fetch_user_payroll_roles(){

       $myJSON =array(
      'payroll_read'=>Session::get('payroll_read'),
      'payroll_write'=>Session::get('payroll_write'),
      'payroll_restricted'=>Session::get('payroll_restricted'),
      'payroll_superadmin'=>Session::get('payroll_superadmin'),
      'payroll_overall'=>Session::get('payroll_overall'),
       );
      return request()->json(200,$myJSON); 
    }
    public function session_check2(){
    $company_id=Session::get('company_id');
    return request()->json(200,$company_id); 
    }
    public function companies_detail(){
     // $arr=DB::connection('sqlsrv2')->table('sub_budget_reports')->paginate(20);
     $arr=DB::table('tb_create_company')->where('company_id','!=','a')->paginate(10);
  return request()->json(200,$arr); 
    }

    public function submit_company_roles(Request $request){
      $company_id=$request->get('company_id');
       $hr_permisson=$request->get('hr_permisson');
        $company_name=$request->get('company_name');
       $module_name=$request->get('module_name');
       $hr_plans=array($request->get('hr_plans'));
       $plan=implode("'_'",$hr_plans);

            
       $hr_planstatus=$hr_permisson.("_").$plan;
      
       if($hr_permisson!='true')
       {
        $hr_permisson=='false';
  
       }
         $check_company_detail=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=',$module_name)->exists();
         if($check_company_detail){

           $check_company_detail_get=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=',$module_name)->get();
           foreach ($check_company_detail_get as $check_company_detail_get ) {
             # code...
           }
           $com_id=$check_company_detail_get->id;
          $result=  DB::update('update tb_company_roles set module_status = ? where id = ?',[$hr_planstatus,$com_id]);
         }else{
           DB::insert('INSERT INTO tb_company_roles(company_name,company_id,permission_module,module_status) values (?,?,?,?)', [$company_name,$company_id,$module_name,$hr_planstatus]);
         }

         $message='Updated Status Successfully';
         return request()->json(200,$message); 

    }
 public function submit_company_roles1(Request $request){
      $hr_permission=$request->get('hr_status');
      $module_name=$request->get('module_name');
      $company_id=$request->get('company_id');
      $check_company_detail=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=',$module_name)->exists();
    
      if($check_company_detail){

        $check_company_detail_get=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=',$module_name)->get();
        foreach ($check_company_detail_get as $check_company_detail_get ) {
          # code...
        }
        $com_id=$check_company_detail_get->id;
       $result=  DB::update('update tb_company_roles set module_status = ? where id = ?',[$hr_permission,$com_id]);
      }else{
        DB::insert('INSERT INTO tb_company_roles(company_name,company_id,permission_module,module_status) values (?,?,?,?)', [$company_name,$company_id,$module_name,$hr_permission]);
      }

    }
    public function submit_company_accounts(Request $request){
       $payroll_status=$request->get('accounts_status');
      $payroll_module_name=$request->get('accounts_module_name');
      $company_id=$request->get('company_id');
      $check_company_detail=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=',$payroll_module_name)->exists();
    
      if($check_company_detail){

        $check_company_detail_get=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=',$payroll_module_name)->get();
        foreach ($check_company_detail_get as $check_company_detail_get ) {
          # code...
        }
        $com_id=$check_company_detail_get->id;
       $result=  DB::update('update tb_company_roles set module_status = ? where id = ?',[$payroll_status,$com_id]);
      }else{
        DB::insert('INSERT INTO tb_company_roles(company_name,company_id,permission_module,module_status) values (?,?,?,?)', [$company_name,$company_id,$payroll_module_name,$payroll_status]);
      }

 $message="Updated Status Successfully";
    
         return request()->json(200,$message); 
    }
    public function submit_company_accounts1(Request $request){
      $payroll_status=$request->get('accounts_status');
      $payroll_module_name=$request->get('accounts_module_name');
      $company_id=$request->get('company_id');
       $company_name=$request->get('company_name');
      $check_company_detail=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=',$payroll_module_name)->exists();
    
      if($check_company_detail){

        $check_company_detail_get=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=',$payroll_module_name)->get();
        foreach ($check_company_detail_get as $check_company_detail_get ) {
          # code...
        }
        $com_id=$check_company_detail_get->id;
       $result=  DB::update('update tb_company_roles set module_status = ? where id = ?',[$payroll_status,$com_id]);
      }else{
        DB::insert('INSERT INTO tb_company_roles(company_name,company_id,permission_module,module_status) values (?,?,?,?)', [$company_name,$company_id,$payroll_module_name,$payroll_status]);
      }

        $message="Updated Status Successfully";
    
         return request()->json(200,$message);
    }
    public function submit_company_payroll(Request $request){
      $payroll_status=$request->get('payroll_status');
      $payroll_module_name=$request->get('payroll_module_name');
      $company_id=$request->get('company_id');
      $check_company_detail=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=',$payroll_module_name)->exists();
    
      if($check_company_detail){

        $check_company_detail_get=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=',$payroll_module_name)->get();
        foreach ($check_company_detail_get as $check_company_detail_get ) {
          # code...
        }
        $com_id=$check_company_detail_get->id;
       $result=  DB::update('update tb_company_roles set module_status = ? where id = ?',[$payroll_status,$com_id]);
      }else{
        DB::insert('INSERT INTO tb_company_roles(company_name,company_id,permission_module,module_status) values (?,?,?,?)', [$company_name,$company_id,$payroll_module_name,$payroll_status]);
      }

 $message="Updated Status Successfully";
    
         return request()->json(200,$message); 
    }

     public function submit_company_payroll1(Request $request){
      $payroll_status=$request->get('payroll_status');
      $payroll_module_name=$request->get('payroll_module_name');
      $company_id=$request->get('company_id');
       $company_name=$request->get('company_name');
      $check_company_detail=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=',$payroll_module_name)->exists();
    
      if($check_company_detail){

        $check_company_detail_get=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=',$payroll_module_name)->get();
        foreach ($check_company_detail_get as $check_company_detail_get ) {
          # code...
        }
        $com_id=$check_company_detail_get->id;
       $result=  DB::update('update tb_company_roles set module_status = ? where id = ?',[$payroll_status,$com_id]);
      }else{
        DB::insert('INSERT INTO tb_company_roles(company_name,company_id,permission_module,module_status) values (?,?,?,?)', [$company_name,$company_id,$payroll_module_name,$payroll_status]);
      }

 $message="Updated Status Successfully";
    
         return request()->json(200,$message); 
    }
    public function getcompany_detail($id){
      $message=DB::table('tb_create_company')->where('company_id','=',$id)->get();
    
         return request()->json(200,$message); 
    }
    public function getcompany_modules($id){
       $message1=DB::table('tb_company_roles')->where('company_id','=',$id)->get();
     return request()->json(200,$message1); 

    }
    public function update_company(Request $request){
       $company_name=$request->get('company_name');
       $phone_number=$request->get('phone_number');
       $license_id=$request->get('license_id');
       $address=$request->get('address');
       $website_link=$request->get('website_link');
       $city=$request->get('city');
      
       $email=$request->get('email');
      $id=$request->get('id');

    $result=  DB::update('update tb_create_company set company_name = ?,license_id= ?,phone_number = ?,company_email = ?,company_link = ?,company_address = ?,city = ? where id = ?',[$company_name,$license_id,$phone_number,$email,$website_link,$address,$city,$id]);  

   return request()->json(200,'Record Updated Successfully'); 
    }
 public function deactivate_company($id)
        {
        
         $result5=  DB::update('update tb_create_company set c_status=? where company_id =?', ["Not Active",$id]);  

         if($result5){
         $message=DB::table('tb_create_company')->where('company_id','=',$id)->get();
    
         return request()->json(200,$message); 
         }

        }
        public function activate_company($id)
        {
        
         $result5=  DB::update('update tb_create_company set c_status=? where company_id =?', ["Active",$id]);  

         if($result5){
         $message=DB::table('tb_create_company')->where('company_id','=',$id)->get();
    
         return request()->json(200,$message); 
         }

        }

        public function deactivate_company1($id)
        {
        
         $result5=  DB::update('update tb_create_company set c_status=? where company_id =?', ["Not Active",$id]);  

         if($result5){
          $message=DB::table('tb_create_company')->where('company_id','!=','a')->paginate(1);
    
         return request()->json(200,$message); 
         }

        }
        public function activate_company1($id)
        {
        
         $result5=  DB::update('update tb_create_company set c_status=? where company_id =?', ["Active",$id]);  

         if($result5){
         $message=DB::table('tb_create_company')->where('company_id','!=','a')->paginate(1);
    
         return request()->json(200,$message); 
         }

        }
        public function fetch_company_roles($company_id){
        $message=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=','hr')->get();
       return request()->json(200,$message); 
        }
        public function fetch_company_roles_payroll($company_id){
        $message=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=','payroll')->get();
       return request()->json(200,$message); 
        }
         public function fetch_company_roles_accounts($company_id){
          $message=DB::table('tb_company_roles')->where('company_id','=',$company_id)->where('permission_module','=','accounts')->get();
           return request()->json(200,$message); 
        }

        public function user_session(){


 $message=DB::table('tb_users')->where('company_id','=',Session::get('company_id'))->where('email','=',Session::get('username'))->get();
foreach ($message as $message1) {
  # code...
} 
$first_name=$message1->first_name;
$last_name=$message1->last_name;
$user_role=$message1->user_role;
$dept=$message1->department;

       $myJSON =array(
      'first_name' => $first_name,
      'last_name'=>$last_name,
      'user_role'=>$user_role,
      'dept'=>$dept,
       );
      return request()->json(200,$myJSON); 
    }
     public function dark_status(){
      $message='dark';
           return request()->json(200,$message); 
        }
        public function updatepic(Request $request){
        $image = $request->get('image');
        $message='dark';
           return request()->json(200,$image); 



           
          // $filename = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
          // \Image::make($request->get('image'))->save(public_path('images/adsd/').$filename);
    


    }
     public function get_faqs($cat){
        $arr = DB::table('tb_faqs')->where('Catagory', '=', $cat)->get();
        return request()->json(200, $arr);
    }


    public function get_faqs_cat(){
        $arr = DB::table('tb_faqs')->select('Catagory')->groupBy('Catagory')->get();
        return request()->json(200, $arr);
    }



    //Live Chat
    public function chat_allusers(){
    $username=Session::get('username');
    $company_id=Session::get('company_id');
   
      //   $allusers1=DB::table('tb_users')->join('tb_conversations','tb_users.email','tb_conversations.user_one')->where('tb_conversations.user_two', '=', $username)->where('tb_conversations.CompanyID', '=', $company_id)->get();
    $allusers1=DB::select("select  m.con_id,u.emp_code, u.first_name, u.last_name,u.email,u.photo, user_to, count (status) as num from tb_messages
m join tb_users u on m.user_to=u.email 
where status = 0 and  user_from = '".$username."'
group by user_to ,user_from, u.first_name, u.last_name,u.email,u.photo, m.con_id,u.emp_code");


     

   //  $allusers2=DB::select("select  m.con_id, u.first_name, u.last_name,u.email,u.photo, user_to, count (status) as num from tb_messages m join tb_users u on m.user_from=u.email where status = 0 and  user_to = '".$username."' group by user_to ,user_from, u.first_name, u.last_name,u.email,u.photo, m.con_id");

       //  return array_merge($allusers1, $allusers2);

        return request()->json(200,$allusers1); 
    }

     public function userlivesearch()
        {
          $username=Session::get('username');
          $company_id=Session::get('company_id');
          $check_conversation=DB::table('tb_users')->where('company_id','=',$company_id)->where('email','!=',$username)->orderby('first_name','asc')->get();        
        return response()->json($check_conversation); 
        }


        public function conv_messages(Request $request){
           $id=$request->get('id');
    $username=Session::get('username');
    $company_id=Session::get('company_id');
   $check_conversation=DB::table('tb_conversations')->where('user_two', '=', $id)->where('user_one', '=', $username)->where('CompanyID', '=', $company_id)->get();
    $check_conversation2=DB::table('tb_conversations')->where('user_two', '=', $username)->where('user_one', '=', $id)->where('CompanyID', '=', $company_id)->get();
      if(count($check_conversation)!=0)
        {  
            $check_conversation=DB::table('tb_conversations')->where('user_two', '=', $id)->where('user_one', '=', $username)->where('CompanyID', '=', $company_id)->get();
            foreach ($check_conversation as $check_conversation1) {
                $conId=  $check_conversation1->id;
            }
           //$conId=  $check_conversation1->id;
          //DB::update('update tb_messages set status = ? where con_id = ? and status=?',[1,$check_conversation1->id,0]);
          $message=DB::table('tb_messages')->where('CompanyID', '=', $company_id)->where('con_id', '=', $check_conversation1->id)->get();

            return request()->json(200,$message); 

        }
    elseif(count($check_conversation2)!=0){
       $check_conversation2=DB::table('tb_conversations')->where('user_two', '=', $username)->where('user_one', '=', $id)->where('CompanyID', '=', $company_id)->get();
            foreach ($check_conversation2 as $check_conversation21) {
                $conId=  $check_conversation21->id;
            }
           //$conId=  $check_conversation1->id;

          $message=DB::table('tb_messages')->where('con_id', '=', $check_conversation21->id)->where('CompanyID', '=', $company_id)->get();
   //DB::update('update tb_messages set status = ? where con_id = ? and status=?',[1,$check_conversation21->id,0]);
            return request()->json(200,$message); 
    }
    else{
         $message="No Messages";
        return request()->json(200,$message); 
    }
    
 
  }

  public function conv_messages2(Request $request){
           $id=$request->get('id');
    $username=Session::get('username');
    $company_id=Session::get('company_id');
   $check_conversation=DB::table('tb_conversations')->where('user_two', '=', $id)->where('user_one', '=', $username)->where('CompanyID', '=', $company_id)->get();
    $check_conversation2=DB::table('tb_conversations')->where('user_two', '=', $username)->where('user_one', '=', $id)->where('CompanyID', '=', $company_id)->get();
      if(count($check_conversation)!=0)
        {  
            $check_conversation=DB::table('tb_conversations')->where('user_two', '=', $id)->where('user_one', '=', $username)->where('CompanyID', '=', $company_id)->get();
            foreach ($check_conversation as $check_conversation1) {
                $conId=  $check_conversation1->id;
            }
           //$conId=  $check_conversation1->id;
          DB::update('update tb_messages set status = ? where con_id = ? and status=?',[1,$check_conversation1->id,0]);
          $message=DB::table('tb_messages')->where('CompanyID', '=', $company_id)->where('con_id', '=', $check_conversation1->id)->get();

            return request()->json(200,$message); 

        }
    elseif(count($check_conversation2)!=0){
       $check_conversation2=DB::table('tb_conversations')->where('user_two', '=', $username)->where('user_one', '=', $id)->where('CompanyID', '=', $company_id)->get();
            foreach ($check_conversation2 as $check_conversation21) {
                $conId=  $check_conversation21->id;
            }
           //$conId=  $check_conversation1->id;

          $message=DB::table('tb_messages')->where('con_id', '=', $check_conversation21->id)->where('CompanyID', '=', $company_id)->get();
   //DB::update('update tb_messages set status = ? where con_id = ? and status=?',[1,$check_conversation21->id,0]);
            return request()->json(200,$message); 
    }
    else{
         $message="No Messages";
        return request()->json(200,$message); 
    }
    
 
  }
  public function get_userdetail(Request $request){
          $id=$request->get('id');
         $users_detail = DB::table('tb_users')->where('email', '=', $id)->get();
         return request()->json(200,$users_detail);
    }
   public function fetch_user_session(){
      $message=Session::get('username');
      return request()->json(200,$message); 
   }
   public function submit_messages(Request $request){

      $company_id=Session::get('company_id');
      $status=0;
      $message_input=$request->get('message_input');
      $id=$request->get('user_to');
      $username=$request->get('user_from');
      $conid=$request->get('conid');
      date_default_timezone_set("Asia/Karachi");
      $update_date=date("d-m-Y h:i:s A");
      if($conid=='a'){
          DB::insert('insert into tb_conversations (user_one,user_two,con_date,CompanyID) values (?,?,?,?)', [$username,$id,$update_date,$company_id]);
          $find_conv=DB::table('tb_conversations')->where('user_one','=',$username)->where('user_two','=',$id)->where('CompanyID','=',$company_id)->get();

          foreach ($find_conv as $find_conv1) {
              # code...

          }
           $fetch_conid=$find_conv1->id;

       DB::insert('insert into tb_messages(user_from,user_to,con_id,message,status,m_date,CompanyID) values (?,?,?,?,?,?,?)', [$username,$id,$fetch_conid,$message_input,0,$update_date,$company_id]);

      }
      else {
         DB::insert('INSERT INTO tb_messages(user_from,user_to,con_id,message,status,m_date,CompanyID) values (?,?,?,?,?,?,?)', [$username,$id,$conid,$message_input,$status,$update_date,$company_id]);
      }

      



$check_conversation=DB::table('tb_conversations')->where('user_two', '=', $id)->where('user_one', '=', $username)->where('CompanyID', '=', $company_id)->get();
    $check_conversation2=DB::table('tb_conversations')->where('user_two', '=', $username)->where('user_one', '=', $id)->where('CompanyID', '=', $company_id)->get();
      if(count($check_conversation)!=0)
        {  
            $check_conversation=DB::table('tb_conversations')->where('user_two', '=', $id)->where('user_one', '=', $username)->where('CompanyID', '=', $company_id)->get();
            foreach ($check_conversation as $check_conversation1) {
                $conId=  $check_conversation1->id;
            }
           //$conId=  $check_conversation1->id;
         
          $message=DB::table('tb_messages')->where('CompanyID', '=', $company_id)->where('con_id', '=', $check_conversation1->id)->get();

            return request()->json(200,$message); 

        }
    elseif(count($check_conversation2)!=0){
       $check_conversation2=DB::table('tb_conversations')->where('user_two', '=', $username)->where('user_one', '=', $id)->where('CompanyID', '=', $company_id)->get();
            foreach ($check_conversation2 as $check_conversation21) {
                $conId=  $check_conversation21->id;
            }
           //$conId=  $check_conversation1->id;

          $message=DB::table('tb_messages')->where('con_id', '=', $check_conversation21->id)->where('CompanyID', '=', $company_id)->get();
   
            return request()->json(200,$message); 
    }
    else{
         $message="No Messages";
        return request()->json(200,$message); 
    }










   }

}

