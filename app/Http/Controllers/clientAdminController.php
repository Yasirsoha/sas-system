<?php
namespace App\Http\Controllers;
use Session;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\FileUpload;

class clientAdminController extends Controller
{
   
	public function users_detail(){
		$company_id=Session::get('company_id');
		 $arr=DB::table('tb_users')->where('company_id','=',$company_id)->paginate(15);
 			 return request()->json(200,$arr); 
	}
    public function location_detail(){
        $company_id=Session::get('company_id');
         $arr=DB::table('tb_company_locations')->where('company_id','=',$company_id)->paginate(5);
          return request()->json(200,$arr); 
    }
	public function getuser_detail($id){
		$company_id=Session::get('company_id');
		 $arr=DB::table('tb_users')->where('company_id','=',$company_id)->where('id','=',$id)->get();
		  return request()->json(200,$arr); 
	}
	public function submit_location(Request $request){
		$company_id=Session::get('company_id');
		$username=Session::get('username');
		 $location_name=$request->get('location_name');
		  $l_address=$request->get('l_address');
		   $head_office=$request->get('head_office');

		   date_default_timezone_set("Asia/Karachi");
		  $update_date=date("d-m-Y h:i:s A");



		   $result=DB::table('tb_company_locations')->where('company_id','=',$company_id)->where('location_name','=',$location_name)->exists();
		   if($result){
		   	$data="Location Already Exists In Your Company";
      		return request()->json(200,$data); 
		   }
		   else{


		   	$submit_successfully=DB::insert('INSERT INTO tb_company_locations(location_name,location_address,created_by,created_time,company_id,head_office,l_status) values (?,?,?,?,?,?,?)', [$location_name,$l_address,$username,$update_date,$company_id,$head_office,'Active']);
		   	if($submit_successfully){
		   		$arr=DB::table('tb_company_locations')->where('company_id','=',$company_id)->paginate(5);
		  			return request()->json(200,$arr);
		   	}

		   }

	}
	public function deactivate_location($id)
        {
        	$company_id=Session::get('company_id');
        
         $result5=  DB::update('update tb_company_locations set l_status=? where id =?', ["Not Active",$id]);  

         if($result5){
         $message=DB::table('tb_company_locations')->where('company_id','=',$company_id)->paginate(5);
    
         return request()->json(200,$message); 
         }

        }
        public function activate_location($id)
        {
        $company_id = Session::get('company_id');
         $result5=DB::update('update tb_company_locations set l_status=? where id =?', ["Active",$id]);  

         if($result5){
         $message=DB::table('tb_company_locations')->where('company_id','=',$company_id)->paginate(5);
    
         return request()->json(200,$message); 
         }

        }
         public function search_location(Request $request){
 $company_id = Session::get('company_id');
        $check_conversation=DB::table('tb_company_locations')->where('company_id','=',$company_id)->where('location_name', 'LIKE', '%'.$request->keyword1.'%')->paginate(5);
        
        return response()->json($check_conversation); 
        }
        
    	public function submit_designation(Request $request){
		$company_id=Session::get('company_id');
		$username=Session::get('username');
		 $designation_name=$request->get('designation_name');
		  
		   date_default_timezone_set("Asia/Karachi");
		  $update_date=date("d-m-Y h:i:s A");



		   $result=DB::table('tb_designation')->where('company_id','=',$company_id)->where('designation_name','=',$designation_name)->exists();
		   if($result){
		   	$data="Designation Already Exists In Your Company";
      		return request()->json(200,$data); 
		   }
		   else{


		   	$submit_successfully=DB::insert('INSERT INTO tb_designation(designation_name,created_by,created_time,company_id,d_status) values (?,?,?,?,?)', [$designation_name,$username,$update_date,$company_id,'Active']);
		   	if($submit_successfully){
		   		$arr=DB::table('tb_designation')->where('company_id','=',$company_id)->paginate(5);
		  			return request()->json(200,$arr);
		   	}

		   }

	}
	public function designation_detail(){
		$company_id=Session::get('company_id');
		 $arr=DB::table('tb_designation')->where('company_id','=',$company_id)->paginate(5);
		  return request()->json(200,$arr); 
	}

	public function deactivate_designation($id)
        {
        	$company_id=Session::get('company_id');
        
         $result5=  DB::update('update tb_designation set d_status=? where id =?', ["Not Active",$id]);  

         if($result5){
         $message=DB::table('tb_designation')->where('company_id','=',$company_id)->paginate(5);
    
         return request()->json(200,$message); 
         }

        }
        public function activate_designation($id)
        {
        $company_id = Session::get('company_id');
         $result5=DB::update('update tb_designation set d_status=? where id =?', ["Active",$id]);  

         if($result5){
         $message=DB::table('tb_designation')->where('company_id','=',$company_id)->paginate(5);
    
         return request()->json(200,$message); 
         }

        }
         public function search_designation(Request $request){
 $company_id = Session::get('company_id');
        $check_conversation=DB::table('tb_designation')->where('company_id','=',$company_id)->where('designation_name', 'LIKE', '%'.$request->keyword1.'%')->paginate(5);
        
        return response()->json($check_conversation); 
        }
        public function search_department(Request $request){
 		$company_id = Session::get('company_id');
        $check_conversation=DB::table('tb_department')->where('company_id','=',$company_id)->where('department_name', 'LIKE', '%'.$request->keyword1.'%')->paginate(5);
        
        return response()->json($check_conversation); 
        }

        public function submit_department(Request $request){
		$company_id=Session::get('company_id');
		$username=Session::get('username');
		 $department_name=$request->get('department_name');
		  
		   date_default_timezone_set("Asia/Karachi");
		  $update_date=date("d-m-Y h:i:s A");



		   $result=DB::table('tb_department')->where('company_id','=',$company_id)->where('department_name','=',$department_name)->exists();
		   if($result){
		   	$data="Department Already Exists In Your Company";
      		return request()->json(200,$data); 
		   }
		   else{


		   	$submit_successfully=DB::insert('INSERT INTO tb_department(department_name,created_by,created_time,company_id,dd_status) values (?,?,?,?,?)', [$department_name,$username,$update_date,$company_id,'Active']);
		   	if($submit_successfully){
		   		$arr=DB::table('tb_department')->where('company_id','=',$company_id)->paginate(5);
		  			return request()->json(200,$arr);
		   	}

		   }

	}
	public function department_detail(){
		$company_id=Session::get('company_id');
		 $arr=DB::table('tb_department')->where('company_id','=',$company_id)->paginate(5);
		  return request()->json(200,$arr); 
	}

	public function deactivate_department($id)
        {
        	$company_id=Session::get('company_id');
        
         $result5=  DB::update('update tb_department set dd_status=? where id =?', ["Not Active",$id]);  

         if($result5){
         $message=DB::table('tb_department')->where('company_id','=',$company_id)->paginate(5);
    
         return request()->json(200,$message); 
         }

        }
        public function activate_department($id)
        {
        $company_id = Session::get('company_id');
         $result5=DB::update('update tb_department set dd_status=? where id =?', ["Active",$id]);  

         if($result5){
         $message=DB::table('tb_department')->where('company_id','=',$company_id)->paginate(5);
    
         return request()->json(200,$message); 
         }

        }
        public function overall_designation(){
		$company_id=Session::get('company_id');
		 $arr=DB::table('tb_designation')->select('designation_name','id')->where('company_id','=',$company_id)->orderBy('designation_name','asc')->get();
		  return request()->json(200,$arr); 
		}
        public function overall_empcode(){
        $company_id=Session::get('company_id');
         $arr=DB::connection('sqlsrv2')->table('Emp_Register')->select('EmployeeCode')->where('CompanyId','=',$company_id)->orderBy('EmployeeCode','asc')->get();
          return request()->json(200,$arr); 
        }
        
        public function overall_users(){
        $company_id=Session::get('company_id');
         $arr=DB::table('tb_users')->select('email','first_name','last_name')->where('company_id','=',$company_id)->orderBy('first_name','asc')->get();
          return request()->json(200,$arr); 
        }
       
		public function overall_department(){
		$company_id=Session::get('company_id');
		 $arr=DB::table('tb_department')->select('department_name')->where('company_id','=',$company_id)->orderBy('department_name','asc')->get();
		  return request()->json(200,$arr); 
		}
		public function overall_location(){
		$company_id=Session::get('company_id');
		 $arr=DB::table('tb_company_locations')->select('location_name')->where('company_id','=',$company_id)->orderBy('location_name','asc')->get();
		  return request()->json(200,$arr); 
		}
		public function create_user(Request $request){
			$company_id=Session::get('company_id');
			 date_default_timezone_set("Asia/Karachi");
		  $update_date=date("d-m-Y h:i:s A");
		  $username=Session::get('username');
		 $address=$request->get('address');
        $password=$request->get('password');
		$email=$request->get('email');
		$emp_code=$request->get('emp_code');
		$last_name=$request->get('last_name');
		$first_name=$request->get('first_name');
		$location=$request->get('location');
		$designation=$request->get('designation');
		$department=$request->get('department');

		 $check_user_email=DB::table('tb_users')->where('company_id','=',$company_id)->where('email','=',$email)->exists();
       if($check_user_email){
          $data="User Already Exists In Your Company Database!";
      return request()->json(200,$data); 
       }else{
       
       $find_pic=DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('EmployeeCode','=',$emp_code)->get();
       foreach ($find_pic as $find_pic1) {
           # code...
       }
        $find_pic5=DB::connection('sqlsrv2')->table('Emp_Profile')->where('CompanyID','=',$company_id)->where('EmployeeID','=',$find_pic1->EmployeeID)->get();
         foreach ($find_pic5 as $find_pic51) {
           # code...
       }

       DB::insert('INSERT INTO tb_users(first_name,last_name,emp_code,user_password,ofc_location,user_address,created_by,created_time,email,user_role,company_id,u_status,department,photo) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$first_name,$last_name,$emp_code,$password,$location,$address,$username,$update_date,$email,$designation,$company_id,'Active',$department,$find_pic51->Photo]);
       $data="User Created Successfully!";
      return request()->json(200,$data); 

   }
	}
    public function update_user($id,Request $request)
    {
            $company_id=Session::get('company_id');
             date_default_timezone_set("Asia/Karachi");
          $update_date=date("d-m-Y h:i:s A");
          $username=Session::get('username');
         $address=$request->get('address');
        $password=$request->get('password');
        $email=$request->get('email');
        $emp_code=$request->get('emp_code');
        $last_name=$request->get('last_name');
        $first_name=$request->get('first_name');
        $location=$request->get('location');
        $designation=$request->get('designation');
        $department=$request->get('department');

        
       
    $result5=  DB::update('update tb_users set first_name=?,last_name=?,emp_code=?,user_password=?,ofc_location=?,user_address=?,updated_by=?,updated_time=?,email=?,user_role=?,company_id=?,department=? where id =?', [$first_name,$last_name,$emp_code,$password,$location,$address,$username,$update_date,$email,$designation,$company_id,$department,$id]);



    $data='User Created Successfully!';
      
      return request()->json(200,$data); 

    }
	public function search_users(Request $request){
 $company_id = Session::get('company_id');
        $check_conversation=DB::table('tb_users')->where('company_id','=',$company_id)->where('first_name', 'LIKE', '%'.$request->keyword1.'%')->paginate(15);
        
        return response()->json($check_conversation); 
        }
        public function get_statuswise_users(Request $request){
        	$status=$request->status;
        	$company_id = Session::get('company_id');
        	if($status==''){
        		$message=DB::table('tb_users')->where('company_id', '=',$company_id)->paginate(15);
        return request()->json(200,$message);
        	} else{
        		$message=DB::table('tb_users')->where('company_id', '=',$company_id)->where('u_status', '=',$status)->paginate(15);
        return request()->json(200,$message);
        	}
        	
        }
        public function get_designationwise_users(Request $request){
        	$designation=$request->designation;
        	$company_id = Session::get('company_id');
        	if($designation==''){
        		$message=DB::table('tb_users')->where('company_id', '=',$company_id)->paginate(15);
        return request()->json(200,$message);
        	} else {
        		$message=DB::table('tb_users')->where('company_id', '=',$company_id)->where('user_role', '=',$designation)->paginate(15);
        		return request()->json(200,$message);
        	}
        	
        }

        public function get_locationwise_users(Request $request){
        	$location=$request->location;
        	$company_id = Session::get('company_id');
        	if($location==''){
        		$message=DB::table('tb_users')->where('company_id', '=',$company_id)->paginate(15);
        return request()->json(200,$message);
        	} else {
        		$message=DB::table('tb_users')->where('company_id', '=',$company_id)->where('ofc_location', '=',$location)->paginate(15);
        return request()->json(200,$message);
        	}
        	
        }

        public function deactivate_user($id)
        {
        	$company_id=Session::get('company_id');
        
         $result5=  DB::update('update tb_users set u_status=? where id =?', ["Not Active",$id]);  

         if($result5){
         $message=DB::table('tb_users')->where('company_id','=',$company_id)->paginate(15);
    
         return request()->json(200,$message); 
         }

        }
        public function activate_user($id)
        {
        $company_id = Session::get('company_id');
         $result5=DB::update('update tb_users set u_status=? where id =?', ["Active",$id]);  

         if($result5){
         $message=DB::table('tb_users')->where('company_id','=',$company_id)->paginate(15);
    
         return request()->json(200,$message); 
         }

        }
          public function submit_user_roles(Request $request){
          	 $company_id = Session::get('company_id');
          
      $id=$request->get('id');
       $email=$request->get('email');
        $hr_read=$request->get('hr_read');
       $hr_write=$request->get('hr_write');
        $hr_restricted=$request->get('hr_restricted');
         $hr_superadmin=$request->get('hr_superadmin');
          $hr_overall=$request->get('hr_overall');

          $payroll_read=$request->get('payroll_read');
          $payroll_write=$request->get('payroll_write');
          $payroll_overall=$request->get('payroll_overall');
          $payroll_restricted=$request->get('payroll_restricted');
          $payroll_superadmin=$request->get('payroll_superadmin');
          
          $accounts_read=$request->get('accounts_read');
          $accounts_write=$request->get('accounts_write');
          $accounts_overall=$request->get('accounts_overall');
          $accounts_superadmin=$request->get('accounts_superadmin');

         $check_user_detail=DB::table('tb_roles_permissions')->where('company_id','=',$company_id)->where('user_email','=',$email)->exists();
         if($check_user_detail){

           $check_user_detail_get=DB::table('tb_roles_permissions')->where('company_id','=',$company_id)->where('user_email','=',$email)->get();
           foreach ($check_user_detail_get as $check_user_detail_get1 ) {
             # code...
           }
           $role_id=$check_user_detail_get1->id;
          $result=  DB::update('update tb_roles_permissions set hr_read = ?,hr_write=?,hr_restricted=?,hr_superadmin=?,hr_overall=?,payroll_read=?,payroll_write=?,payroll_restricted=?,payroll_superadmin=?,payroll_overall=?,accounts_read=?,accounts_write=?,accounts_overall=?,accounts_superadmin=? where id = ?',[$hr_read,$hr_write,$hr_restricted,$hr_superadmin,$hr_overall,$payroll_read,$payroll_write,$payroll_restricted,$payroll_superadmin,$payroll_overall,$accounts_read,$accounts_write,$accounts_overall,$accounts_superadmin,$role_id]);
         }else{
           DB::insert('INSERT INTO tb_roles_permissions(user_id,user_email,hr_read,hr_write,hr_restricted,company_id,hr_superadmin,hr_overall,payroll_read,payroll_write,payroll_restricted,payroll_superadmin,payroll_overall,accounts_read,accounts_write,accounts_overall,accounts_superadmin) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$id,$email,$hr_read,$hr_write,$hr_restricted,$company_id,$hr_superadmin,$hr_overall,$payroll_read,$payroll_write,$payroll_restricted,$payroll_superadmin,$payroll_overall,$accounts_read,$accounts_write,$accounts_overall,$accounts_superadmin]);
         }

         $message='Updated Status Successfully';
         return request()->json(200,$message); 


    }
    public function fetch_user_roles($email){
    	 $company_id = Session::get('company_id');
    	 $message=DB::table('tb_roles_permissions')->where('company_id','=',$company_id)->where('user_email','=',$email)->get();
    	 return request()->json(200,$message);
    }
    public function count_users(){
$company_id = Session::get('company_id');
$all_users=DB::table('tb_users')->where('company_id','=',$company_id)->count();
$active_users=DB::table('tb_users')->where('company_id','=',$company_id)->where('u_status','=','Active')->count();
$inactive_users=DB::table('tb_users')->where('company_id','=',$company_id)->where('u_status','=','Not Active')->count();
    	$myJSON =array(
      'all_users' => $all_users,
      'active_users' => $active_users,
      'inactive_users' => $inactive_users,
      );
      return request()->json(200,$myJSON);
    }
public function filter_activity(Request $request){
        $company_id = Session::get('company_id');
        $fromDate=$request->get('fromDate');
        $toDate=$request->get('toDate');
        $users=$request->get('users');
        $check_conversation=DB::table('Activity_Log')->where('CompanyId','=',$company_id)
        ->where('UserEmail','=',$users)->where('ActivityTime','>=',$fromDate )->where('ActivityTime','<=',$toDate)->get();
        
        return response()->json($check_conversation); 
        }

        public function fetch_image(){
             $company_id = Session::get('company_id');
            $emp_id=Session::get('employee_id');
               $check_conversation=DB::connection('sqlsrv2')->table('Emp_Profile')->where('CompanyID','=',$company_id)->where('EmployeeID','=',$emp_id)->get();
         foreach($check_conversation as $check_conversation1){

         }
           // return $check_conversation1->Name;
         return response()->json($check_conversation1->Photo); 

        }

        //Add city
    public function submit_c(Request $request){
        $city = $request->get('city_name');
        $result=DB::connection('sqlsrv2')->insert("INSERT INTO cities(city_name) values (?)", [$city]);
        if($result){
            $arr= DB::connection('sqlsrv2')->table("cities")->orderBy('city_name','asc')->paginate(5);
            return request()->json(200,$arr);
        }
    }
    public function view_cities()
    {
        $arr= DB::connection('sqlsrv2')->table("cities")->orderBy('city_name','asc')->paginate(20);
        return request()->json(200,$arr);
    }
    public function delete_city($id)
    {
        $result=DB::connection('sqlsrv2')->table('cities')->where('id', $id)->delete();
        if($result)
        {
            $arr= DB::connection('sqlsrv2')->table("cities")->orderBy('city_name','asc')->paginate(20);
            return request()->json(200,$arr);
        }
    }

    //fetch location to edit
    public function fetch_locations($id)
    {
        $company_id= Session::get('company_id');
        $loc=DB::table('tb_company_locations')->select('tb_company_locations.*')
        ->where('company_id','=',$company_id)->where('tb_company_locations.id','=', $id)->get();
        return request()->json(200, $loc);
    }

    //fetch designation to edit
    public function fetch_designations($id)
    {
        $company_id= Session::get('company_id');
        $des=DB::table('tb_designation')->select('tb_designation.*')
        ->where('company_id','=',$company_id)->where('tb_designation.id','=', $id)->get();
        return request()->json(200, $des);
    }
    
     //fetch department to edit
    public function fetch_department($id)
    {
        $company_id= Session::get('company_id');
        $dept=DB::table('tb_department')->select('tb_department.*')
        ->where('company_id','=',$company_id)->where('tb_department.id','=', $id)->get();
        return request()->json(200, $dept);
    }

    //Update location
    public function update_location (Request $request)
    {
        $company_id= Session::get('company_id');
        $loc_id = $request->get('loc_id');
        $ed_location_name = $request->get('ed_location_name');
        $ed_l_address = $request->get('ed_l_address');
        
        $result=DB::table('tb_company_locations')->where('company_id','=',$company_id)->where('location_name','=',$ed_location_name)->exists();
        if($result)
        {
            $data="Location matched!";
            return request()->json(200, $data); 
        }
        else
        {
            DB::update('update tb_company_locations set location_name=?, location_address=? where id=? AND company_id=?', [$ed_location_name, $ed_l_address, $loc_id, $company_id]);
            $arr=DB::table('tb_company_locations')->where('company_id','=',$company_id)->paginate(5);
            return request()->json(200,$arr);
        }
    }

    //Update designation
    public function update_designation (Request $request)
    {
        $company_id= Session::get('company_id');
        $des_id= $request->get('des_id');
        $ed_designation_name = $request->get('ed_designation_name');
        
        $result=DB::table('tb_designation')->where('company_id','=',$company_id)->where('designation_name','=',$ed_designation_name)->exists();
        if($result)
        {
            $data="Designation matched!";
            return request()->json(200, $data); 
        }
        else
        {
            DB::update('update tb_designation set designation_name=? where id=? AND company_id=?', [$ed_designation_name, $des_id, $company_id]);
            $arr=DB::table('tb_designation')->where('company_id','=',$company_id)->paginate(5);
            return request()->json(200,$arr);
        }
    }

    //Update department
    public function update_department (Request $request)
    {
        $company_id= Session::get('company_id');
        $dep_id= $request->get('dep_id');
        $ed_department_name = $request->get('ed_department_name');
        
        $result=DB::table('tb_department')->where('company_id','=',$company_id)->where('department_name','=',$ed_department_name)->exists();
        if($result)
        {
            $data="Department matched!";
            return request()->json(200, $data); 
        }
        else
        {
            DB::update('update tb_department set department_name=? where id=? AND company_id=?', [$ed_department_name, $dep_id, $company_id]);
            $arr=DB::table('tb_department')->where('company_id','=',$company_id)->paginate(5);
            return request()->json(200,$arr);
        }
    }

    //Delete department
    public function delete_department($id)
    {
        $company_id= Session::get('company_id');
        $result=DB::table('tb_department')->where('id', $id)->delete();
        if($result)
        {
            $arr= DB::table("tb_department")->where('company_id','=',$company_id)->paginate(5);
            return request()->json(200,$arr);
        }
    }

    //Delete designation
    public function delete_designation($id)
    {
        $company_id= Session::get('company_id');
        $result=DB::table('tb_designation')->where('id', $id)->delete();
        if($result)
        {
            $arr= DB::table("tb_designation")->where('company_id','=',$company_id)->paginate(5);
            return request()->json(200,$arr);
        }
    }

    //Delete location
    public function delete_location($id)
    {
        $company_id= Session::get('company_id');
        $result=DB::table('tb_company_locations')->where('id', $id)->delete();
        if($result)
        {
            $arr= DB::table("tb_company_locations")->where('company_id','=',$company_id)->paginate(5);
            return request()->json(200,$arr);
        }
    }

     public function confirm_oldPass(Request $request){
        $company_id=Session::get('company_id');
        $username = Session::get('username');
        $oldPass = $request->get('oldPass');
        
        $is_pass_exist = DB::table('tb_users')
        ->where('email', '=', $username)
        ->where('user_password', '=', $oldPass)
        ->where('company_id', '=', $company_id)->exists();
        
        if($is_pass_exist){
            $arr="Password exist!";
        }
        else{
            $arr="Password not exist!";
        }
        
        //$arr="Password not exist!";
        return request()->json(200,$arr);
    }
    


   public function change_Pass(Request $request){
        $company_id=Session::get('company_id');
        $username = Session::get('username');
        $newPass1 = $request->get('newPass1');
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("d-m-Y h:i:s A");

        DB::update('update tb_users set user_password=? where email=? AND company_id=?', [$newPass1, $username, $company_id]);  

        
        $arr = DB::table('tb_users')->where('company_id', '=', $company_id)->where('email', '=', $username)->get();
        foreach ($arr as $arr1) {
            # code...
        }
        $emp_code = $arr1->emp_code;
        
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Password Changed', 'Password of '.$emp_code.' changed', $update_date]);
        

        $arr="Password changed!";
        return request()->json(200,$arr);
    }

  }