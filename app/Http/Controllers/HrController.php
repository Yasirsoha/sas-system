<?php

namespace App\Http\Controllers;
use Session;
use DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Codedge\Fpdf\Fpdf\Fpdf;

class HrController extends Controller
{
  protected $fpdf;
    public function __construct()
    {
        $this->fpdf = new Fpdf;
        $this->fpdf->SetAutoPageBreak(true);
        $this->fpdf->SetLeftMargin(15);

    }
   public function getEmployeedetail(){
   	 $company_id=Session::get('company_id');
   	   
            // $emp_detail =DB::connection('sqlsrv2')->select('Emp_Profile.*')->table('Emp_Profile')->join('Emp_Register','Emp_Profile.EmployeeID','Emp_Register.EmployeeID')->where('Emp_Profile.CompanyID','=',$company_id)->paginate(5);
            $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('Emp_Profile.EmployeeID', 'desc')
        ->select('Emp_Profile.*','Emp_Register.*')->where('Emp_Profile.CompanyID','=',$company_id)
        ->paginate(15);
            return request()->json(200,$emp_detail);
       
    	
    }
   public function create_employee(Request $request){ 
        $username=Session::get('username'); 
        $company_id=Session::get('company_id');
        $UserFullName=Session::get('UserName');
        $full_name=$request->get('full_name');
        $father_name=$request->get('father_name');
        $gender=$request->get('gender');
        $blood_group=$request->get('blood_group');
        $email=$request->get('email');
      
        $cnic=$request->get('cnic');
        $phone_number=$request->get('phone_number');
        $phone_number2=$request->get('phone_number2');
        $dob=$request->get('dob');
    
        $religion=$request->get('religion');
        $address=$request->get('address');
        $city=$request->get('city');
        $cnic_expiry=$request->get('cnic_expiry');
        $relation=$request->get('relation');
        $m_status=$request->get('m_status');
        if($request->hasFile('image_file')){
        $file = $request->file('image_file');
        $name_image = time().$file->getClientOriginalName();
        $file->move(public_path().'/images/profile_images/', $name_image);
        } 
        DB::connection('sqlsrv2')->insert('INSERT INTO Emp_Profile(Name,FatherHusband,Gender,Religion, Email, Mobile, Phone,CNIC, CnicExpiry, MaritalStatus, DOB, BloodGroup, Address, City,Photo,CreatedBy,CompanyID,Relation) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$full_name,$father_name,$gender,$religion, $email, $phone_number, $phone_number2, $cnic,$cnic_expiry,$m_status,$dob,$blood_group,$address,$city,$name_image,$username,$company_id,$relation]);
        $find_emp_id=DB::connection('sqlsrv2')->table("Emp_Profile")->where('CompanyID','=',$company_id)->get();
        foreach ($find_emp_id as $find_emp_id1) {
            # code...
        }
        $emp_id=$find_emp_id1->EmployeeID;
        $comp_id=$find_emp_id1->CompanyID;

        $find_emp_code = DB::connection('sqlsrv2')->table("Emp_Register")->where('CompanyID','=',$company_id)->get();
        foreach ($find_emp_code as $find_emp_code1) {
            # code...
        }
        $em_co_ex = $find_emp_code1->EmployeeCode;
        $em_co_all = explode("-", $em_co_ex);
        $em_co = $em_co_all[1];

        $em_co1=$em_co+1;

        $prefix_arr = DB::table('tb_create_company')->select('company_prefix')->where('company_id','=',$company_id)->get();

        foreach ($prefix_arr as $prefix_arr1) {
        # code...
        }
        $prefix = $prefix_arr1->company_prefix;

        $em_co2 = $prefix.'-0'.$em_co1;
        DB::connection('sqlsrv2')->insert('INSERT INTO Emp_Register(EmployeeID,EmployeeCode,CompanyID,[Department], [Designation], [PostingCity], [CompanyEmail], [JoiningDate], [Status],[ReportingTo],[CreatedBy],[DeletedBy],[DeletedOn],[ReportingTo2],[JobShift],[Salary],[Stipend],[JobStatus],[ProbationEnd],[JobDescription],[ChildCompany],[SendNotification],[AllowEmployeesAttendance],[EportalAccess],[ExpStatus],[EduStatus],[DocStatus], [MethodType], [BankAccount]) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$emp_id,$em_co2,$comp_id,'', '','','', '', '', '', '','', '','', '', '','','','', '', '', '', '', '', '', '','','Cash', '']);
        DB::connection('sqlsrv2')->insert('INSERT INTO Emp_Documents(EmployeeID,CompanyID,Image1,Image2,Image3, Image4, Image5,Image6) values (?,?,?,?,?,?,?,?)', [$emp_id,$comp_id,'','','','','','']);
        DB::connection('sqlsrv2')->insert('INSERT INTO PayrollEmployeesDetail(CompanyID,EmployeeID,Statusd) values (?,?,?)', [$comp_id,$emp_id,'C']);
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
    
        DB::insert("INSERT INTO Activity_Log(CompanyId,UserEmail,EmployeeName,EventStatus,Description,ActivityTime) values (?,?,?,?,?,?)", [$company_id,$username,$UserFullName,'Insert New Employee','Add New Employee Profile of '.$full_name,$update_date]);   
    }  
     public function overall_employees(){
        $company_id=Session::get('company_id');
      
         $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->select('Emp_Profile.EmployeeID','Emp_Profile.Name','Emp_Register.EmployeeCode',)->where('Emp_Profile.CompanyID','=',$company_id)->get();


              return request()->json(200,$arr); 
        }
        public function update_employment(Request $request){
        $username=Session::get('username'); 
        $company_id=Session::get('company_id');
        
        $selected=$request->get('selected');

        $id=$request->get('id');
        $doj=$request->get('doj');
        $login_check=$request->get('login_check');
        $reporting_to=$request->get('reporting_to');
        $second_reporting=$request->get('second_reporting');
        $job_shift=$request->get('job_shift');
        $work_location=$request->get('work_location');
        $emp_salary=$request->get('emp_salary');
        $emp_stipend=$request->get('emp_stipend');
        $emp_status=$request->get('emp_status');
        $emp_job_status=$request->get('emp_job_status');
        $emp_pro_days=$request->get('emp_pro_days');
        $emp_pro_end = date('Y-m-d', strtotime($doj. " + {$emp_pro_days} days"));
        $job_description=$request->get('job_description');
        $remarks=$request->get('remarks');
        $child_company=$request->get('child_company');
        $emp_department=$request->get('emp_department');
        $emp_designation=$request->get('emp_designation');
        $hr_notifications=$request->get('hr_notifications');
        $user_email=$request->get('user_email');
        $user_password=$request->get('user_password');
        $emp_code=$request->get('emp_code');
        $company_email_id=$request->get('company_email_id');
        $att_check=$request->get('att_check');
        $methodtype=$request->get('methodtype');
        $bankaccount=$request->get('bankaccount');
        $bankname=$request->get('bankname');
        $accountname=$request->get('accountname');
        if($login_check==1){
           $check_user1= DB::table('tb_users')->where('company_id','=',$company_id)->where('email','=',$user_email)->exists();
           if($check_user1){
            $message='Email Id Already Exists';
          return request()->json(200,$message);
           }
           else {
            if($user_email==''|| $user_password==''){
             $message='empty_username';
          return request()->json(200, $message);
          }
          else if (!filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
             $message='invalid email id';
          return request()->json(200,$message);
            }
           }
           }

        if($att_check==1){
           if($selected==''||$selected==null){
             $message='Please Select Employees Attendace List';
          return request()->json(200,$message);
           }
           }

            $result=  DB::connection('sqlsrv2')->update('update  Emp_Register set EmployeeCode=?, Department=?, Designation=?, PostingCity=?, CompanyEmail=?, JoiningDate=?, Status=?, ReportingTo=?, CreatedBy=?, ReportingTo2=?, JobShift=?, Salary=?, Stipend=?,JobStatus=?,ProbationEnd=?,JobDescription=?,ChildCompany=?,SendNotification=?,AllowEmployeesAttendance=?,EportalAccess=?,MethodType=?,BankAccount=?,bank_name=?, account_name=?, remarks=? where EmployeeID=?',[$emp_code,$emp_department,$emp_designation,$work_location,$company_email_id,$doj,$emp_status,$reporting_to,$username,$second_reporting,$job_shift,$emp_salary,$emp_stipend,$emp_job_status,$emp_pro_end,$job_description,$child_company,$hr_notifications,$att_check,$login_check,$methodtype,$bankaccount,$bankname,$accountname, $remarks, $id]);
            date_default_timezone_set("Asia/Karachi");
                  $update_date=date("Y-m-d h:i:s A");
            $update_date3=date("Y-m-d");

            $emp_day= intval($emp_salary/30);
            $emp_hour=intval($emp_day/8);
                DB::connection('sqlsrv2')->update('update PayrollEmployeesDetail set UpdatedSalary=?,UpdatedPerDay=?,UpdatedPerHours=?,UpdatedDate=? where Statusd=? and CompanyID=? AND EmployeeID=?',[$emp_salary,$emp_day,$emp_hour,$update_date3,'C',$company_id,$id]);

            $check_grace= DB::connection('sqlsrv2')->table('EmpGraceHours')->where('CompanyID','=',$company_id)->where('EmployeeID','=',$id)->exists();
            if($check_grace){}
            else {
               DB::connection('sqlsrv2')->insert("INSERT INTO EmpGraceHours(CompanyID,EmployeeID,TotalGP,UsedGP) values (?,?,?,?)", [$company_id,$id,0,0]);
            }
             $UserFullName=Session::get('UserName');
  
                DB::insert("INSERT INTO Activity_Log(CompanyId,UserEmail,EmployeeName,EventStatus,Description,ActivityTime) values (?,?,?,?,?,?)", [$company_id,$username,$UserFullName,'Update Employment Detail','Update Employment Detail of Employee Id: '.$emp_code,$update_date]);

            if($login_check==1){
                $check_user= DB::table('tb_users')->where('company_id','=',$company_id)->where('emp_code','=',$emp_code)->exists();
                if($check_user){
                   $result=  DB::update('update tb_users set user_password=?,email=? where emp_code=? and company_id=?',[$user_password,$user_email,$emp_code,$company_id]);
        } 
        else {
          $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->select('Emp_Profile.*','Emp_Register.*')->where('Emp_Profile.EmployeeID','=',$id)->where('Emp_Profile.CompanyID','=',$company_id)->get();

             foreach ($emp_detail as $emp_detail1) {
               # code...
             }
         
               $name = explode(" " ,  $emp_detail1->Name);
               $em_code=$emp_detail1->EmployeeCode;
               $ofc_loc=$emp_detail1->PostingCity;
               $gen=$emp_detail1->Gender;
               $add=$emp_detail1->Address;
                $us_des=$emp_detail1->Designation;
                $sta='Active';
                 $us_dept=$emp_detail1->Department;
               DB::insert("INSERT INTO tb_users(first_name,last_name,emp_code,user_password,ofc_location,gender,user_address,created_by,created_time,email,user_role,company_id,u_status,department) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?)", [$name[0],$name[1],$em_code,$user_password,$ofc_loc,$gen,$add,$username,$update_date,$user_email,$us_des,$company_id,$sta,$us_dept]);
             }
        }


        if($att_check==1){

           for($x=0;$x<count($selected);$x++){
            $se = explode("_" , $selected[$x]);
           // 
            // $sub_emp_code=$se[1];

             $find_employee_id= DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('EmployeeCode','=',$se[1])->get();
             foreach($find_employee_id as $find_employee_id1){

             }
       
            $sub_emp_id=$find_employee_id1->EmployeeID;

             $check_att_permission= DB::connection('sqlsrv2')->table('Att_Permission')->where('CompanyID','=',$company_id)->where('SubEmpID','=',$sub_emp_id)->where('ChiefEmpID','=',$id)->where('IsMandatory','=',1)->exists();
             if(!$check_att_permission){
               DB::connection('sqlsrv2')->insert("INSERT INTO Att_Permission(SubEmpID,ChiefEmpID,IsMandatory,CreatedBy,CompanyID) values (?,?,?,?,?)", [$sub_emp_id,$id,1,$username,$company_id]);
             } 
        

           }

        }
            
          if($reporting_to!=''){

             $check_att_rep= DB::connection('sqlsrv2')->table('Att_Permission')->where('CompanyID','=',$company_id)->where('SubEmpID','=',$id)->where('ChiefEmpID','=',$reporting_to)->where('IsManager','=',1)->exists();
             if($check_att_rep){
              DB::connection('sqlsrv2')->update('update Att_Permission set ChiefEmpID=? where SubEmpID=? and CompanyID=? and IsManager=?',[$reporting_to,$id,$company_id,1]);
             } else {
               DB::connection('sqlsrv2')->insert("INSERT INTO Att_Permission(SubEmpID,ChiefEmpID,IsManager,CreatedBy,CompanyID) values (?,?,?,?,?)", [$id,$reporting_to,1,$username,$company_id]);
             }
        
          }   

        $message="Update Employee Record Successfully";

             return request()->json(200,$message); 
            }
        public function department_detail(){
        $company_id=Session::get('company_id');
         $arr=DB::table('tb_department')->where('company_id','=',$company_id)->get();
          return request()->json(200,$arr); 
    }
    public function skip_education(Request $request){
        $id=$request->get('id');
         $skip="skip";
         DB::connection('sqlsrv2')->table('Employee_Qualification')->where('EmployeeID', $id)->delete();
          $result=  DB::connection('sqlsrv2')->update('update  Emp_Register set EduStatus=? where EmployeeID=?',[$skip,$id]);
          $company_id=Session::get('company_id');
           $username=Session::get('username'); 
$UserFullName=Session::get('UserName');
  date_default_timezone_set("Asia/Karachi");
      $update_date=date("Y-m-d h:i:s A");


 $arr=DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('EmployeeID','=',$id)->get();
 foreach ($arr as $arr1) {
   # code...
 }
$emp_code=$arr1->EmployeeCode;

    DB::insert("INSERT INTO Activity_Log(CompanyId,UserEmail,EmployeeName,EventStatus,Description,ActivityTime) values (?,?,?,?,?,?)", [$company_id,$username,$UserFullName,'Update Education Detail','Skip Education Detail of Employee Code: '.$emp_code,$update_date]);
          $message="Skip the Education Step Successfully";
 return request()->json(200,$message); 
    }

    public function insert_education(Request $request){
       $company_id=Session::get('company_id');
       $username=Session::get('username');
       $degree_type = $request->get('first'); 
       $degree_name = $request->get('second');
       $inst_name = $request->get('third');
       $passing_year = $request->get('fourth');
       $id= $request->get('id');
       
      DB::connection('sqlsrv2')->table('Employee_Qualification')->where('EmployeeID', $id)->delete();
        $de_type1 = explode("," , $degree_type);
        for($x=1;$x<count($de_type1);$x++){
        $de_type = explode("," , $degree_type);
       $de_name = explode("," , $degree_name);
       $ins_name = explode("," , $inst_name);
         $pas_year = explode("," , $passing_year);

          DB::connection('sqlsrv2')->insert("insert into Employee_Qualification(EmployeeID,DegreeType,DegreeName,InstituteName
            ,PassingYear,CreatedBy,CompanyID) values (?,?,?,?,?,?,?)", [$id,$de_type[$x],$de_name[$x],$ins_name[$x],$pas_year[$x],$username,$company_id]);

       }
        $skip='Added';
       $result=  DB::connection('sqlsrv2')->update('update  Emp_Register set EduStatus=? where EmployeeID=?',[$skip,$id]);


$UserFullName=Session::get('UserName');
  date_default_timezone_set("Asia/Karachi");
      $update_date=date("Y-m-d h:i:s A");


 $arr=DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('EmployeeID','=',$id)->get();
 foreach ($arr as $arr1) {
   # code...
 }
$emp_code=$arr1->EmployeeCode;

    DB::insert("INSERT INTO Activity_Log(CompanyId,UserEmail,EmployeeName,EventStatus,Description,ActivityTime) values (?,?,?,?,?,?)", [$company_id,$username,$UserFullName,'Update Education Detail','Added Education Detail of Employee Code: '.$emp_code,$update_date]);
       $message='Successfully Added';
      return request()->json(200,$message);

    }
     public function skip_experience(Request $request){
        $id=$request->get('id');
         $skip="skip";
         DB::connection('sqlsrv2')->table('Emp_Work_Experience')->where('EmployeeID', $id)->delete();
          $result=  DB::connection('sqlsrv2')->update('update  Emp_Register set ExpStatus=? where EmployeeID=?',[$skip,$id]);

          $company_id=Session::get('company_id');
          $username=Session::get('username');
$UserFullName=Session::get('UserName');
  date_default_timezone_set("Asia/Karachi");
      $update_date=date("Y-m-d h:i:s A");


 $arr=DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('EmployeeID','=',$id)->get();
 foreach ($arr as $arr1) {
   # code...
 }
$emp_code=$arr1->EmployeeCode;

    DB::insert("INSERT INTO Activity_Log(CompanyId,UserEmail,EmployeeName,EventStatus,Description,ActivityTime) values (?,?,?,?,?,?)", [$company_id,$username,$UserFullName,'Update Experience Detail','Skipped Experience Detail of Employee Code: '.$emp_code,$update_date]);
          $message="Skip the Education Step Successfully";
 return request()->json(200,$message); 
    }
      
      public function insert_experience(Request $request){
         $company_id=Session::get('company_id');
          $username=Session::get('username');
          $position = $request->get('first'); 
       $company_name = $request->get('second');
       $starting_date = $request->get('third');
       $ending_date = $request->get('fourth');
       $reference = $request->get('fiveth');
       
       $id= $request->get('id');
       
      DB::connection('sqlsrv2')->table('Emp_Work_Experience')->where('EmployeeID', $id)->delete();
        $de_type1 = explode("," , $position);
        for($x=1;$x<count($de_type1);$x++){
             $p_position = explode("," , $position);
       $p_company_name = explode("," , $company_name);
       $p_starting_date = explode("," , $starting_date);
         $p_ending_date = explode("," , $ending_date);
         $p_reference = explode("," , $reference);
          DB::connection('sqlsrv2')->insert("insert into Emp_Work_Experience(EmployeeID,CompanyID,JobTitle,CompanyName,StartingDate,LeavingDate,Refrence,CreatedBy) values (?,?,?,?,?,?,?,?)", [$id,$company_id,$p_position[$x],$p_company_name[$x],$p_starting_date[$x],$p_ending_date[$x],$p_reference[$x],$username]);

       }
        $skip='Added';
      $result=  DB::connection('sqlsrv2')->update('update  Emp_Register set ExpStatus=? where EmployeeID=?',[$skip,$id]);
      $UserFullName=Session::get('UserName');
  date_default_timezone_set("Asia/Karachi");
      $update_date=date("Y-m-d h:i:s A");


 $arr=DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('EmployeeID','=',$id)->get();
 foreach ($arr as $arr1) {
   # code...
 }
$emp_code=$arr1->EmployeeCode;

    DB::insert("INSERT INTO Activity_Log(CompanyId,UserEmail,EmployeeName,EventStatus,Description,ActivityTime) values (?,?,?,?,?,?)", [$company_id,$username,$UserFullName,'Update Experience Detail','Added Experience Detail of Employee Code: '.$emp_code,$update_date]);
       $message='Successfully Added';
      return request()->json(200,$message);

    }






    public function geteducation_detail($id){
      $arr= DB::connection('sqlsrv2')->table('Employee_Qualification')->where('EmployeeID','=',$id)->get();
          return request()->json(200,$arr); 
    }
    public function getemployee_detail($id){
      $arr= DB::connection('sqlsrv2')->table('Emp_Profile')->where('EmployeeID','=',$id)->get();
          return request()->json(200,$arr); 
    }
    
    public function getemployment_detail($id){
      $arr= DB::connection('sqlsrv2')->table('Emp_Register')->where('EmployeeID','=',$id)->get();
          return request()->json(200,$arr); 
    }
    public function count_employees(){

    $company_id = Session::get('company_id');
    $all_users=DB::connection('sqlsrv2')->table('Emp_Profile')->where('CompanyID','=',$company_id)->count();
 $active_users =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register','Emp_Profile.EmployeeID','Emp_Register.EmployeeID')->where('Emp_Profile.CompanyID','=',$company_id)->where('Emp_Register.Status','=','Registered')->count();

$inactive_users =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register','Emp_Profile.EmployeeID','Emp_Register.EmployeeID')->where('Emp_Profile.CompanyID','=',$company_id)->where('Emp_Register.Status','!=','Registered')->count();
  $incomplete_users  =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register','Emp_Profile.EmployeeID','Emp_Register.EmployeeID')->where('Emp_Profile.CompanyID','=',$company_id)->where('Emp_Register.Status','=','')->count();
   
      $myJSON =array(
      'all_users' => $all_users,
      'active_users' => $active_users,
      'inactive_users' => $inactive_users,
      'incomplete_users' =>$incomplete_users,
      );
      return request()->json(200,$myJSON);
    }

     public function update_employee(Request $request){
        $username=Session::get('username'); 
        $company_id=Session::get('company_id');
        $full_name=$request->get('full_name');
        $father_name=$request->get('father_name');
        $gender=$request->get('gender');
        $blood_group=$request->get('blood_group');
        $email=$request->get('email');
        $id=$request->get('id');
        $cnic=$request->get('cnic');
        $phone_number=$request->get('phone_number');
        $phone_number2=$request->get('phone_number2');
        $dob=$request->get('dob');
    
        $religion=$request->get('religion');
        $address=$request->get('address');
        $city=$request->get('city');
        $cnic_expiry=$request->get('cnic_expiry');
        $relation=$request->get('relation');
        $m_status=$request->get('m_status');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $arr9=DB::connection('sqlsrv2')->table('Emp_Profile')->where('CompanyID','=',$company_id)->where('EmployeeID','=',$id)->get();
        foreach($arr9 as $arr91){
        }

        if($request->hasFile('image_file')){
            $file = $request->file('image_file');
            $name_image = time().$file->getClientOriginalName();
            $file->move(public_path().'/images/profile_images/', $name_image);

            DB::connection('sqlsrv2')->update('update  Emp_Profile set Name=?,FatherHusband=?,Gender=?,Religion=?
            ,Email=?,Mobile=?,Phone=?,CNIC=?,CnicExpiry=?,MaritalStatus=?,DOB=?,BloodGroup=?,Address=?,City=?,Photo=?,UpdatedBy=?,UpdatedOn=?,Relation=? where EmployeeID=?',[$full_name,$father_name,$gender,$religion,$email,$phone_number,$phone_number2,$cnic,$cnic_expiry,$m_status,$dob,$blood_group,$address,$city,$name_image,$username,$update_date,$relation,$id]);

        }
        else {
            DB::connection('sqlsrv2')->update('update  Emp_Profile set Name=?,FatherHusband=?,Gender=?,Religion=?
            ,Email=?,Mobile=?,Phone=?,CNIC=?,CnicExpiry=?,MaritalStatus=?,DOB=?,BloodGroup=?,Address=?,City=?,UpdatedBy=?,UpdatedOn=?,Relation=? where EmployeeID=?',[$full_name,$father_name,$gender,$religion,$email,$phone_number,$phone_number2,$cnic,$cnic_expiry,$m_status,$dob,$blood_group,$address,$city,$username,$update_date,$relation,$id]);
        }

        $UserFullName=Session::get('UserName');
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id,$username,$UserFullName,'Update employee','Update Employee profile details of '.$full_name, $update_date]);

        return request()->json(200,'hello');
    }



    public function getindemployee_detail($id){
      if($id==0){
        $id=Session::get('employee_id');
      }
       $company_id=Session::get('company_id');
      
      $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register','Emp_Profile.EmployeeID','Emp_Register.EmployeeID')->where('Emp_Profile.CompanyID','=',$company_id)
      ->where('Emp_Profile.EmployeeID','=',$id)->get();
          return request()->json(200,$emp_detail); 
    }
    public function getemployee_education($id){
       if($id==0){
        $id=Session::get('employee_id');
      }
      $arr= DB::connection('sqlsrv2')->table('Employee_Qualification')->where('EmployeeID','=',$id)->get();
          return request()->json(200,$arr); 
    }
    public function getemployee_exp($id){
       if($id==0){
        $id=Session::get('employee_id');
      }
      $arr= DB::connection('sqlsrv2')->table('Emp_Work_Experience')->where('EmployeeID','=',$id)->get();
          return request()->json(200,$arr); 
    }
    public function success_array($id){
 if($id==0){
        $id=Session::get('employee_id');
      }
            $company_id=Session::get('company_id');
       
            $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register','Emp_Profile.EmployeeID','Emp_Register.EmployeeID')->where('Emp_Profile.EmployeeID','=',$id)->get();
            foreach ($emp_detail as $emp_detail1) {
              # code...
            }
            if($emp_detail1->Address!=''){
              $address=4;
            }else {
              $address=0;
            }
            if($emp_detail1->CNIC!=''){
              $cnic=4;
            }else {
              $cnic=0;
            }
            if($emp_detail1->City!=''){
              $city=4;
            }else {
              $city=0;
            }
            if($emp_detail1->CompanyEmail!=''){
              $company_email=4;
            }else {
              $company_email=0;
            }
            if($emp_detail1->DOB!=''){
              $dob=4;
            }else {
              $dob=0;
            }
            if($emp_detail1->Department!=''){
              $department=4;
            }else {
              $department=0;
            }
            if($emp_detail1->Designation!=''){
              $designation=4;
            }else {
              $designation=0;
            }
            if($emp_detail1->EduStatus!=''){
              $edu_status=17;
            }else {
              $edu_status=0;
            }
            if($emp_detail1->ExpStatus!=''){
              $exp_status=17;
            }else {
              $exp_status=0;
            }
            if($emp_detail1->Email!=''){
              $email=4;
            }else {
              $email=0;
            }
            if($emp_detail1->EmployeeCode!=''){
              $emp_code=4;
            }else {
              $emp_code=0;
            }
            if($emp_detail1->FatherHusband!=''){
              $father=4;
            }else {
              $father=0;
            }
            if($emp_detail1->Gender!=''){
              $gender=4;
            }else {
              $gender=0;
            }
            if($emp_detail1->JobDescription!=''){
              $jds=4;
            }else {
              $jds=0;
            }
            if($emp_detail1->JobShift!=''){
              $jobshift=4;
            }else {
              $jobshift=0;
            }
            if($emp_detail1->MaritalStatus!=''){
              $marital=4;
            }else {
              $marital=0;
            }
            if($emp_detail1->Mobile!=''){
              $mobile=4;
            }else {
              $mobile=0;
            }
            if($emp_detail1->Photo!=''){
              $photo=6;
            }else {
              $photo=0;
            }
            if($emp_detail1->ReportingTo!=''){
              $reporting=4;
            }else {
              $reporting=0;
            }

return (['address'=>$address,'cnic'=>$cnic,'city'=>$city,'company_email'=>$company_email,'dob'=>$dob,'department'=>$department,'designation'=>$designation,'edu_status'=>$edu_status,'exp_status'=>$exp_status,'email'=>$email,'emp_code'=>$emp_code,'father'=>$father,'gender'=>$gender,'job_des'=>$jds,'marital'=>$marital,'mobile'=>$mobile,'photo'=>$photo,'reporting'=>$reporting,]);

    }
   public function registered($id){
   
     $result5=  DB::connection('sqlsrv2')->update('update Emp_Register set Status=?,RegDate=? where EmployeeID =?', ["Registered",'',$id]);  

         if($result5){
          $company_id=Session::get('company_id');
      $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register','Emp_Profile.EmployeeID','Emp_Register.EmployeeID')->where('Emp_Profile.CompanyID','=',$company_id)
      ->where('Emp_Profile.EmployeeID','=',$id)->get();
         return request()->json(200,$emp_detail); 
         }
   }
    public function resigned_emp($id){
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d");
        $result5 =  DB::connection('sqlsrv2')->update('update Emp_Register set Status=?,RegDate=? where EmployeeID =?', ["Resigned",$update_date,$id]);  

        if($result5){
            $company_id=Session::get('company_id');
            $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register','Emp_Profile.EmployeeID','Emp_Register.EmployeeID')->where('Emp_Profile.CompanyID','=',$company_id)
            ->where('Emp_Profile.EmployeeID','=',$id)->get();

        $username=Session::get('username'); 
        $UserFullName=Session::get('UserName');
        $update_date=date("Y-m-d h:i:s A");

        $full_name_arr = DB::connection('sqlsrv2')->table('Emp_Profile')->select('Name')->where('EmployeeID','=',$id)->get();
        foreach ($full_name_arr as $full_name_arr1) {
              # code...
            }
        $full_name = $full_name_arr1->Name;
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Update Status','Update status of '.$full_name.' to Resigned', $update_date]);


            return request()->json(200, $emp_detail); 
        }
    }
         public function suspend_emp($id){
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d");
        $result5 =  DB::connection('sqlsrv2')->update('update Emp_Register set Status=?,RegDate=? where EmployeeID =?', ["Suspended",$update_date,$id]);  
 
        if($result5){
            $company_id=Session::get('company_id');
            $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register','Emp_Profile.EmployeeID','Emp_Register.EmployeeID')->where('Emp_Profile.CompanyID','=',$company_id)
            ->where('Emp_Profile.EmployeeID','=',$id)->get();
            
        $username=Session::get('username'); 
        $UserFullName=Session::get('UserName');
        $update_date=date("Y-m-d h:i:s A");

        $full_name_arr = DB::connection('sqlsrv2')->table('Emp_Profile')->select('Name')->where('EmployeeID','=',$id)->get();
        foreach ($full_name_arr as $full_name_arr1) {
              # code...
            }
        $full_name = $full_name_arr1->Name;
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Update Status','Update status of '.$full_name.' to Suspended', $update_date]);


            return request()->json(200,$emp_detail); 
        }
    }
        public function getemployee_update_education($id){
          $arr= DB::connection('sqlsrv2')->table('Employee_Qualification')->where('EmployeeID','=',$id)->get();
          return request()->json(200,$arr);
        }
        public function getemployee_update_experience($id){
          $arr= DB::connection('sqlsrv2')->table('Emp_Work_Experience')->where('EmployeeID','=',$id)->get();
          return request()->json(200,$arr);
        }
        public function update_emp_docs(Request $request){
          $id=$request->get('id');
          if($request->hasFile('image_file')){
        $file = $request->file('image_file');
        $name_image = time().$file->getClientOriginalName();
        $file->move(public_path().'/images/documents/', $name_image);
         $result=  DB::connection('sqlsrv2')->update('update  Emp_Documents set Image1=? where EmployeeID=?',[$name_image,$id]);

          }
          elseif($request->hasFile('image_file2')){
        $file = $request->file('image_file2');
        $name_image2 = time().$file->getClientOriginalName();
        $file->move(public_path().'/images/documents/', $name_image2);
         $result=  DB::connection('sqlsrv2')->update('update  Emp_Documents set Image2=? where EmployeeID=?',[$name_image2,$id]);

          }
          elseif($request->hasFile('image_file3')){
        $file = $request->file('image_file3');
        $name_image3 = time().$file->getClientOriginalName();
        $file->move(public_path().'/images/documents/', $name_image3);
         $result=  DB::connection('sqlsrv2')->update('update  Emp_Documents set Image3=? where EmployeeID=?',[$name_image3,$id]);

          }
elseif($request->hasFile('image_file4')){
        $file = $request->file('image_file4');
        $name_image4 = time().$file->getClientOriginalName();
        $file->move(public_path().'/images/documents/', $name_image4);
         $result=  DB::connection('sqlsrv2')->update('update  Emp_Documents set Image4=? where EmployeeID=?',[$name_image4,$id]);

          }
          elseif($request->hasFile('image_file5')){
        $file = $request->file('image_file5');
        $name_image5 = time().$file->getClientOriginalName();
        $file->move(public_path().'/images/documents/', $name_image5);
         $result=  DB::connection('sqlsrv2')->update('update  Emp_Documents set Image5=? where EmployeeID=?',[$name_image5,$id]);

          }
          elseif($request->hasFile('image_file6')){
        $file = $request->file('image_file6');
        $name_image6 = time().$file->getClientOriginalName();
        $file->move(public_path().'/images/documents/', $name_image6);
         $result=  DB::connection('sqlsrv2')->update('update  Emp_Documents set Image6=? where EmployeeID=?',[$name_image6,$id]);
          $arr= DB::connection('sqlsrv2')->table('Emp_Documents')->where('EmployeeID','=',$id)->get();

          
          return request()->json(200,$arr);

          }

     DB::connection('sqlsrv2')->update('update  Emp_Register set DocStatus=? where EmployeeID=?',['Added',$id]);

        return request()->json(200,'ok'); 
        }
        public function getemployee_documents($id){
          $arr= DB::connection('sqlsrv2')->table('Emp_Documents')->where('EmployeeID','=',$id)->get();
          return request()->json(200,$arr);
        }

       public function searchemployee($department, $location, $designation, $gender, $status, $min_price, $max_price, $cnic, $emp_id, $emp_sts){
        $company_id=Session::get('company_id');
      
        if($department=="All"){
            $department ='';
        }
        if($location=="All"){
            $location ='';
        }
        if($designation=="All"){
            $designation ='';
        }
        if($gender=="All"){
            $gender ='';
        }
        if($status=="All"){
            $status ='';
        }
        if($min_price=="All"){
            $min_price ='0';
        }
        if($max_price=="All"){
            $max_price ='2147483647';
        }
        if($cnic=="All"){
            $cnic ='';
        }
        if($emp_id=="All"){
            $emp_id =null;
        }
        if($emp_sts=="All"){
            $emp_sts ='';
        }
           
        $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('Emp_Profile.EmployeeID', 'desc')
            ->select('Emp_Profile.*','Emp_Register.*')
            ->where('Emp_Profile.CompanyID','=',$company_id)
            ->where('Emp_Register.Department', 'LIKE', '%'.$department.'%')
            ->where('Emp_Register.PostingCity', 'LIKE', '%'.$location.'%')
            ->where('Emp_Register.Designation', 'LIKE', '%'.$designation.'%')
            ->where('Emp_Profile.Gender', 'LIKE', '%'.$gender.'%')
            ->where('Emp_Register.JobStatus', 'LIKE', '%'.$status.'%')
            ->where('Emp_Register.Salary','>=',$min_price)
            ->where('Emp_Register.Salary','<=',$max_price)
            ->where('Emp_Profile.CNIC', 'LIKE', '%'.$cnic.'%')
            ->where('Emp_Register.EmployeeCode', 'LIKE', '%'.$emp_id.'%')
            ->where('Emp_Register.Status', 'LIKE', '%'.$emp_sts.'%')
            ->paginate(15);
        return request()->json(200, $emp_detail);
    }


                public function search_emp(Request $request){
                $company_id = Session::get('company_id');
                $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
                ->orderBy('Emp_Profile.EmployeeID', 'desc')
                ->select('Emp_Profile.*','Emp_Register.*')->where('Emp_Profile.Name', 'LIKE', '%'.$request->keyword1.'%')->where('Emp_Profile.CompanyID','=',$company_id)
                ->paginate(15);
       
        
                  return response()->json($emp_detail); 
                  }
                  public function get_com_employee(){
                  $company_id = Session::get('company_id');
                  $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
                ->orderBy('Emp_Profile.Name', 'ASC')
                ->select('Emp_Profile.*','Emp_Register.*')->where('Emp_Profile.CompanyID','=',$company_id)
                ->get();
                  return response()->json($emp_detail); 
                  }



                  public function offer_letter(){
                    $this->fpdf->AddPage("P", ['210', '297']);
                    $this->fpdf->SetFont('Times','B',18);
                    $this->fpdf->SetTextColor(41, 46, 46);
  
                    $this->fpdf->Text(75, 15, 'Offer Letter'); 
                    $this->fpdf->SetFont('Times','',12);
                  $this->fpdf->SetTextColor(41, 46, 46 );
                  $this->fpdf->Text(30, 30,'18 Aug 2022');
                  $this->fpdf->SetFont('Times','',16);
                  $this->fpdf->SetTextColor(0,0,0);
                  $this->fpdf->Text(30, 38, "Yasir Sohail");
                  $this->fpdf->SetFont('Times','',12);
                 $this->fpdf->Text(30, 44, "yasirsohail912@gmail.com");
                 $this->fpdf->Text(30, 50, "Faisalabad");
                 $this->fpdf->SetFont('Times','',16);
                 $this->fpdf->Text(30, 60, "Dear Yasir Sohail,");
                 $this->fpdf->SetFont('Times','',12);
                 $this->fpdf->SetY(63);
                 $this->fpdf->SetX(30);
                 $this->fpdf->MultiCell(0, 5, 'Congratulations! We are pleased to confirm you have been selected to work for Company,Division and Department. We are delighted to make you the following job offer.The position we are offering is that of Job Title at a salary/wage of salary and hourly rate per (year/month/week/hour). This position reports to (Title and name of Supervisor). Your working hours will be from (state working hours) and/or (normal workdays). This is a (permanent/seasonal/contract/casual) position. (If this is a contract position state expected length of term)');
                 $this->fpdf->SetY(94);
                 $this->fpdf->SetX(30);
                 $this->fpdf->MultiCell(0, 5,'We would like you to start work on (state desired date) at (state start time). Please report to (name of person to see on start date), for documentation and orientation. If this date is not acceptable, please contact me immediately Please sign the enclosed copy of this letter and return it to me by (specify date) to indicate your acceptance of this offer We are confident you will be able to make a significant contribution to the success of our (Company/Division/Department) and look forward to working with you.');
                 $this->fpdf->Text(30, 134, "Sincerely, ");
                 $this->fpdf->Text(30, 139, "Name:  Yasir Sohail, ");
                 $this->fpdf->Text(30, 144, "Position: Software Engineer, ");
                                
                 $this->fpdf->ln(7);
                 $this->fpdf->ln(7);
 
                 $this->fpdf->Text(30, 158, "I accept the offer as outlined above.  ");
 
                 $this->fpdf->Output();
                 exit;
                  }




                  public function cv_builder($id,$emp_code,$reg_id){
                      $this->fpdf->AddPage("P", ['210', '297']);

                  
                   $company_id = Session::get('company_id');
                  $emp_detail9 =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->select('Emp_Profile.*','Emp_Register.*')->where('Emp_Profile.CompanyID','=',$company_id)->where('Emp_Profile.EmployeeID','=',$id)->where('Emp_Register.EmployeeCode','=',$emp_code)->where('Emp_Register.RegisterID','=',$reg_id)->exists(); 
                  if($emp_detail9){
                  $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->select('Emp_Profile.*','Emp_Register.*')->where('Emp_Profile.CompanyID','=',$company_id)->where('Emp_Profile.EmployeeID','=',$id)->get();   
                  foreach($emp_detail as $emp_detail1){
                  
                  }


        // Section 1
        
                  $this->fpdf->SetFont('Times','B',22);
                  $this->fpdf->SetTextColor(103, 159, 250 );

                  $this->fpdf->Text(75, 15, 'Curriculum Vitae'); 
                  $this->fpdf->Image('public/images/profile_images/pro.png',172,23,30,35);

                  $this->fpdf->SetFont('Times','I',12);
                  $this->fpdf->SetTextColor(0,0,0);

       // $this->fpdf->Image('public/images/profile_images/pro.png',15,26,5,0);
                  $this->fpdf->SetFont('Times','B',22);
                  $this->fpdf->SetTextColor(103, 159, 250 );
                  $this->fpdf->Text(30, 30,$emp_detail1->Name);
                  $this->fpdf->Image('public/images/cv/phone.png',15,32,5,0);
                  $this->fpdf->SetFont('Times','I',12);
                  $this->fpdf->SetTextColor(0,0,0);
                  $this->fpdf->Text(30, 38, $emp_detail1->Mobile);

                 $this->fpdf->Image('public/images/cv/email.png',12,38,10,0);
                 $this->fpdf->Text(30, 44, $emp_detail1->Email);
                 $this->fpdf->Image('public/images/cv/gps.png',15,47,5,0);
                 $this->fpdf->Text(30, 50, $emp_detail1->Address);
                 $this->fpdf->SetDrawColor(103, 159, 250 );
                 $this->fpdf->SetLineWidth(1);
                 $this->fpdf->Line(15, 61, 190, 61);


        //Section 2
        
                $this->fpdf->SetFont('Times','B',16);
                $this->fpdf->SetTextColor(103, 159, 250 );
                $this->fpdf->Text(15, 72, 'Objective'); 
                $this->fpdf->SetFont('Times','I',14);
                $this->fpdf->SetTextColor(0,0,0);
                $this->fpdf->SetY(77);
                $this->fpdf->SetX(15);
                $this->fpdf->MultiCell(0, 5, 'A highly creative thinker, grammar Nazi, and social media enthusiast seek the position of Social Media & Content Marketing Analyst to transform technical and digital information and processes into influencial stories.');
        
                $this->fpdf->Cell(267, 5, '_________________________________________________________________________');
                $this->fpdf->ln(7);

         // Section 3

        $this->fpdf->SetFont('Times','B',18);
        $this->fpdf->SetTextColor(103, 159, 250 );
        $this->fpdf->Cell(100, 15, 'Experience');
        $this->fpdf->ln(15);

       // $array = array(1,2,3,4,5,6,7,8);
        $array=DB::connection('sqlsrv2')->table('Emp_Work_Experience')->where('CompanyID','=',$company_id)->where('EmployeeID','=',$id)->orderBy('Id', 'desc')->get();
        
        foreach($array as $num){
        
        $this->fpdf->SetFont('Times','',14);
        $this->fpdf->SetTextColor(0,0,0);
        $this->fpdf->Cell(90, 7, "Job Position :".$num->JobTitle, 0,1, 'L');
        $this->fpdf->Cell(90, 7, "Company Name :".$num->CompanyName, 0,1, 'L');
        $this->fpdf->SetFont('Times','',14);
        $this->fpdf->SetTextColor(0,0,0);
        $this->fpdf->Cell(40, 7, "From: ".$num->StartingDate, 0,0, 'L');
        $this->fpdf->Cell(40, 7, "To: ".$num->LeavingDate, 0,1, 'L');
        $this->fpdf->ln(5);
        }

        $this->fpdf->ln(2);
        $this->fpdf->Cell(267, 5, '_________________________________________________________________________');
        $this->fpdf->ln(15);
       
        //Section 4
       
        $this->fpdf->SetFont('Times','B',18);
        $this->fpdf->SetTextColor(103, 159, 250 );
        $this->fpdf->Cell(100 ,15,"Education",0,1,'L');
        $array2=DB::connection('sqlsrv2')->table('Employee_Qualification')->where('CompanyID','=',$company_id)->where('EmployeeID','=',$id)->orderBy('Id', 'desc')->get();
        
        
        
        foreach($array2 as $num2){
        
          $this->fpdf->SetFont('Times','',14);
        $this->fpdf->SetTextColor(0,0,0);
          $this->fpdf->Cell(90, 7, $num2->DegreeType." : ".$num2->DegreeName, 0,1, 'L');
           $this->fpdf->Cell(90, 7, "Institute Name : ".$num2->InstituteName, 0,1, 'L');
        $this->fpdf->SetFont('Times','',14);
        $this->fpdf->SetTextColor(0,0,0);
        $this->fpdf->Cell(40, 7, "Passing Year: ".$num2->PassingYear, 0,1, 'L');
       
          $this->fpdf->ln(5);
        }


       

        $this->fpdf->Cell(267, 5, '_________________________________________________________________________');
        $this->fpdf->ln(15);
       
        // Section 5

        $this->fpdf->SetFont('Times','B',18);
        $this->fpdf->SetTextColor(103, 159, 250 );
        $this->fpdf->Cell(100, 10, 'Employment Details');
        $this->fpdf->ln(15);

        $this->fpdf->SetFont('Times','B',14);
        $this->fpdf->SetTextColor(0,0,0);
        $this->fpdf->Cell(50, 8, 'Employee Code:', 0,0, 'L');
        
        $this->fpdf->SetFont('Times','',14);
        $this->fpdf->Cell(50, 8, $emp_detail1->EmployeeCode, 0,0, 'L');
        $this->fpdf->SetFont('Times','B',14);
        
        $this->fpdf->Cell(50, 8, 'Designation:', 0,0, 'L');
        $this->fpdf->SetFont('Times','',14);
        $this->fpdf->Cell(50, 8, $emp_detail1->Designation, 0,1, 'L');

         $this->fpdf->SetFont('Times','B',14);
         $this->fpdf->SetTextColor(0,0,0);
         $this->fpdf->Cell(50, 8, 'Department:', 0,0, 'L');
       
         $this->fpdf->SetFont('Times','',14);
         $this->fpdf->Cell(50, 8, $emp_detail1->Department, 0,0, 'L');
         $this->fpdf->SetFont('Times','B',14);

         $this->fpdf->Cell(50, 8, 'Company Email:', 0,0, 'L');
         $this->fpdf->SetFont('Times','',14);
         $this->fpdf->Cell(50, 8, $emp_detail1->CompanyEmail, 0,1, 'L');

         $this->fpdf->SetFont('Times','B',14);
         $this->fpdf->SetTextColor(0,0,0);
         $this->fpdf->Cell(50, 8, 'Posting City:', 0,0, 'L');
     
         $this->fpdf->SetFont('Times','',14);
         $this->fpdf->Cell(50, 8, $emp_detail1->PostingCity, 0,0, 'L');
         $this->fpdf->SetFont('Times','B',14);
       
         $this->fpdf->Cell(50, 8, 'Job Shift:', 0,0, 'L');
         $this->fpdf->SetFont('Times','',14);
       
         $this->fpdf->Cell(50, 8, $emp_detail1->JobShift, 0,1, 'L');

         $this->fpdf->SetFont('Times','B',14);
         $this->fpdf->SetTextColor(0,0,0);
     
         $this->fpdf->Cell(50, 8, 'Reporting to:', 0,0, 'L');
   
         $this->fpdf->SetFont('Times','',14);
         $this->fpdf->Cell(50, 8, $emp_detail1->ReportingTo, 0,0, 'L');
         $this->fpdf->SetFont('Times','B',14);
       
       $this->fpdf->Cell(50, 8, 'Joining Date:', 0,0, 'L');
         $this->fpdf->SetFont('Times','',14);
       
         $this->fpdf->Cell(50, 8, $emp_detail1->JoiningDate, 0,1, 'L');

        
         $this->fpdf->SetFont('Times','B',14);
       
         

         $this->fpdf->SetFont('Times','B',14);
         $this->fpdf->SetTextColor(0,0,0);
       
         $this->fpdf->Cell(50, 8, 'Job Status:', 0,0, 'L');
       
         $this->fpdf->SetFont('Times','',14);
         $this->fpdf->Cell(50, 8, $emp_detail1->Status, 0,0, 'L');
         $this->fpdf->SetFont('Times','B',14);
       
         $this->fpdf->Cell(50, 8, 'Team Attendance', 0,0, 'L');
         $this->fpdf->SetFont('Times','',14);
        if($emp_detail1->AllowEmployeesAttendance==1){
          $this->fpdf->Cell(50, 8, 'Allow', 0,1, 'L');
        }
        else {
           $this->fpdf->Cell(50, 8,'Not Allow', 0,1, 'L');
        }

         $this->fpdf->SetFont('Times','B',14);
         $this->fpdf->SetTextColor(0,0,0);
      
         $this->fpdf->Cell(50, 8, 'Probation End:', 0,0, 'L');
      
         $this->fpdf->SetFont('Times','',14);
         $this->fpdf->Cell(50, 8, $emp_detail1->ProbationEnd, 0,0, 'L');
        
          $this->fpdf->SetFont('Times','B',14);
        $this->fpdf->Cell(50, 8, 'Eportal Access:', 0,0, 'L');
      
         $this->fpdf->SetFont('Times','',14);
        if($emp_detail1->EportalAccess==1){
          $this->fpdf->Cell(50, 8, 'Yes', 0,1, 'L');
        }
        else {
           $this->fpdf->Cell(50, 8,'No', 0,1, 'L');
        }
         $this->fpdf->SetFont('Times','B',14);
       
         $this->fpdf->Cell(50, 8, 'SMS Notifications', 0,0, 'L');
         $this->fpdf->SetFont('Times','',14);
        if($emp_detail1->SendNotification==1){
          $this->fpdf->Cell(50, 8, 'Allow', 0,1, 'L');
        }
        else {
           $this->fpdf->Cell(50, 8,'Not Allow', 0,1, 'L');
        }
         

        $this->fpdf->Cell(267, 5,'_________________________________________________________________________');
        $this->fpdf->ln(7);

        //Section 6

        $this->fpdf->SetFont('Times','B',18);
        $this->fpdf->SetTextColor(103, 159, 250 );
        $this->fpdf->Cell(100, 10, 'Personal Details');
        $this->fpdf->ln(10);

         $this->fpdf->SetFont('Times','B',14);
         $this->fpdf->SetTextColor(0,0,0);
      
         $this->fpdf->Cell(50, 8, 'Father Name:', 0,0, 'L');
        
         $this->fpdf->SetFont('Times','',14);
         $this->fpdf->Cell(50, 8, $emp_detail1->FatherHusband, 0,0, 'L');
         $this->fpdf->SetFont('Times','B',14);
       
         $this->fpdf->Cell(50, 8, 'Gender:', 0,0, 'L');
         $this->fpdf->SetFont('Times','',14);
            $this->fpdf->Cell(50, 8, $emp_detail1->Gender, 0,1, 'L');

         $this->fpdf->SetFont('Times','B',14);
         $this->fpdf->SetTextColor(0,0,0);
     
         $this->fpdf->Cell(50, 8, 'Date of Birth', 0,0, 'L');
       
         $this->fpdf->SetFont('Times','',14);
         $this->fpdf->Cell(50, 8, $emp_detail1->DOB, 0,0, 'L');
         $this->fpdf->SetFont('Times','B',14);
     
         $this->fpdf->Cell(50, 8, 'Religion:', 0,0, 'L');
         $this->fpdf->SetFont('Times','',14);
       
         $this->fpdf->Cell(50, 8, $emp_detail1->Religion, 0,1, 'L');

         $this->fpdf->SetFont('Times','B',14);
         $this->fpdf->SetTextColor(0,0,0);
       
         $this->fpdf->Cell(50, 8, 'City:', 0,0, 'L');
       
         $this->fpdf->SetFont('Times','',14);
         $this->fpdf->Cell(50, 8, $emp_detail1->City, 0,0, 'L');
         $this->fpdf->SetFont('Times','B',14);
     
         $this->fpdf->Cell(50, 8, 'Country:', 0,0, 'L');
         $this->fpdf->SetFont('Times','',14);
       
         $this->fpdf->Cell(50, 8, 'Pakistan', 0,1, 'L');

         $this->fpdf->SetFont('Times','B',14);
         $this->fpdf->SetTextColor(0,0,0);
       
         $this->fpdf->Cell(50, 8, 'CNIC', 0,0, 'L');
       
         $this->fpdf->SetFont('Times','',14);
         $this->fpdf->Cell(50, 8, $emp_detail1->CNIC, 0,0, 'L');
         $this->fpdf->SetFont('Times','B',14);
       
         $this->fpdf->Cell(50, 8, 'CNIC Expiry:', 0,0, 'L');
         $this->fpdf->SetFont('Times','',14);
        
         $this->fpdf->Cell(50, 8, $emp_detail1->CnicExpiry, 0,1, 'L');

         $this->fpdf->SetFont('Times','B',14);
         $this->fpdf->SetTextColor(0,0,0);
       
         $this->fpdf->Cell(50, 8, 'Relation:', 0,0, 'L');
       
         $this->fpdf->SetFont('Times','',14);
         $this->fpdf->Cell(50, 8, $emp_detail1->Relation, 0,0, 'L');
         $this->fpdf->SetFont('Times','B',14);
       
         $this->fpdf->Cell(50, 8, 'Blood Group:', 0,0, 'L');
         $this->fpdf->SetFont('Times','',14);
       
         $this->fpdf->Cell(50, 8, $emp_detail1->BloodGroup, 0,1, 'L');

         $this->fpdf->Cell(267, 5,'_________________________________________________________________________');
        $this->fpdf->ln(7);

        // Section 7

         $this->fpdf->SetFont('Times','B',18);
        $this->fpdf->SetTextColor(103, 159, 250 );
         $this->fpdf->Cell(100, 10, 'Refrences');
         $this->fpdf->ln(10);
         $this->fpdf->SetFont('Times','I',14);
         $this->fpdf->SetTextColor(0,0,0);
         $this->fpdf->Cell(100, 8, 'Refrences may provided on demand.', 0,0, 'L');
         $this->fpdf->ln(5);
         
         
         $this->fpdf->Cell(267, 5, '_________________________________________________________________________');
         $this->fpdf->ln(7);
         
         $this->fpdf->Output();
        exit;


}
else {
  "Please Type Valid Information";
}



 
        }

        public function get_emp_detail(Request $request){
           $company_id=Session::get('company_id');
         
          $emp_id = $request->get('emp_id'); 
           $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->select('Emp_Profile.*','Emp_Register.*')->where('Emp_Register.EmployeeCode','=',$emp_id)->where('Emp_Profile.CompanyID','=',$company_id)->get();
            return request()->json(200,$emp_detail); 
        }
        public function warning_reasons(){
           $company_id=Session::get('company_id');
            $warnings =DB::connection('sqlsrv2')->table('Warning_Reason')->where('CompanyID','=',$company_id)->get();
            return request()->json(200,$warnings); 
        }
         public function fetch_companydetail(){
       $company_id=Session::get('company_id');
      $message=DB::table('tb_create_company')->where('company_id','=',$company_id)->get();
    
         return request()->json(200,$message); 
    }
    public function submit_warning(Request $request){
        $company_id=Session::get('company_id');
        $username=Session::get('username'); 
        $UserFullName=Session::get('UserName');
        $dated = $request->get('dated');
        $emp_id = $request->get('emp_id'); 
        $emp_name = $request->get('emp_name'); 
        $department = $request->get('department'); 
        $designation = $request->get('designation');
        $location = $request->get('location'); 
        $subject = $request->get('subject'); 
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $find_warning=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->where('EmployeeID','=',$emp_id)->exists();
        if($find_warning){
            $find_warning1=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->where('EmployeeID','=',$emp_id)->get();
        foreach($find_warning1 as $find_warning11){
        }
        $warning_type2=$find_warning11->WarningType;
        if($warning_type2=='First'){
            $warning_type='Second';
        }
        elseif($warning_type2=='Second'){
            $warning_type='Terminate';
        }
        elseif($warning_type2=='Terminate'){
           $message='Employee is already terminated';
           return request()->json(200,$message); 
          }
        }
        else{
            $warning_type='First';
        }

        DB::connection('sqlsrv2')->insert('INSERT INTO Warning_Letter(CompanyID,DateIssued,EmployeeID,EmployeeName,Department,Designation,Location,WarningType,ReasonSubject,CreatedBy,CreatedOn) values (?,?,?,?,?,?,?,?,?,?,?)', [$company_id,$dated,$emp_id,$emp_name,$department,$designation,$location, $warning_type, $subject, $username, $update_date]);
        if($warning_type=='Terminate'){
            $result=  DB::connection('sqlsrv2')->update('update Emp_Register set Status=? where EmployeeCode=? and CompanyID=?',[$warning_type,$emp_id,$company_id]);
        }

        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Warning Issue',$warning_type.' warning Issued to '.$emp_name, $update_date]);

        $message='submitted';
        return request()->json(200,$message); 
    }

      public function warning_detail(){
        $company_id=Session::get('company_id');
         $arr=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->paginate(15);
          return request()->json(200,$arr); 
    }
   
     public function count_warnings(){
$company_id = Session::get('company_id');
$total=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->count();
$first=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->where('WarningType','=','First')->count();
$second=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->where('WarningType','=','Second')->count();
$terminate=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->where('WarningType','=','Terminate')->count();

      $myJSON =array(
      'total' => $total,
      'first' => $first,
      'second' => $second,
       'terminate' => $terminate,
      );
      return request()->json(200,$myJSON);
    }
    public function search_warnings(Request $request){
 $company_id = Session::get('company_id');
        $check_conversation=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->where('EmployeeName', 'LIKE', '%'.$request->keyword1.'%')->paginate(15);
        
        return response()->json($check_conversation); 
        }
        public function filter_warnings(Request $request){
           $company_id=Session::get('company_id');
          $location=$request->get('location');
         $department=$request->get('department');
         $designation=$request->get('designation'); 
         if($designation==''&& $department==''&&$location=='')
             {

             $arr=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->paginate(15);
              return request()->json(200,$arr); 
             }
             elseif($designation!=''&& $department==''&&$location=='')
             {

             $arr=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->where('Designation','=',$designation)->paginate(15);
              return request()->json(200,$arr); 
             }
             elseif($designation==''&& $department!=''&&$location=='')
             {

             $arr=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->where('Department','=',$department)->paginate(15);
              return request()->json(200,$arr); 
             }
              elseif($designation==''&& $department==''&&$location!='')
             {

             $arr=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->where('Location','=',$location)->paginate(15);
              return request()->json(200,$arr); 
             }
             elseif($designation!=''&& $department==''&&$location!='')
             {

             $arr=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->where('Location','=',$location)->where('Designation','=',$designation)->paginate(15);
              return request()->json(200,$arr); 
             }
             elseif($designation!=''&& $department!=''&&$location=='')
             {

             $arr=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->where('Department','=',$department)->where('Designation','=',$designation)->paginate(15);
              return request()->json(200,$arr); 
             }
             elseif($designation==''&& $department!=''&&$location!='')
             {

             $arr=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->where('Department','=',$department)->where('Location','=',$location)->paginate(15);
              return request()->json(200,$arr); 
             }
             elseif($designation!=''&& $department!=''&&$location!='')
             {

             $arr=DB::connection('sqlsrv2')->table('Warning_Letter')->where('CompanyID','=',$company_id)->where('Department','=',$department)->where('Location','=',$location)->where('Designation','=',$designation)->paginate(15);
              return request()->json(200,$arr); 
             }

        
        }
        public function getwarnig_d($id){
      $arr= DB::connection('sqlsrv2')->table('Warning_Letter')->where('LetterID','=',$id)->get();
          return request()->json(200,$arr); 
    }
    public function submit_roster(Request $request) {
        $username=Session::get('username'); 
        $company_id=Session::get('company_id');

        $roster_name=$request->get('roster_name');
        $monday_s=$request->get('monday_s');
        $monday_in=$request->get('monday_in');
        $monday_out=$request->get('monday_out');
        $tuesday_s=$request->get('tuesday_s');

        $tuesday_in=$request->get('tuesday_in');
        $tuesday_out=$request->get('tuesday_out');
        $wednesday_s=$request->get('wednesday_s');
        $wednesday_in=$request->get('wednesday_in');
        $wednesday_out=$request->get('wednesday_out');

        $thursday_s=$request->get('thursday_s');
        $thursday_in=$request->get('thursday_in');
        $thursday_out=$request->get('thursday_out');
        $friday_s=$request->get('friday_s');
        $friday_in=$request->get('friday_in');

        $friday_out=$request->get('friday_out');
        $saturday_s=$request->get('saturday_s');
        $saturday_in=$request->get('saturday_in');
        $saturday_out=$request->get('saturday_out');
        $sunday_s=$request->get('sunday_s');

        $sunday_in=$request->get('sunday_in');
        $sunday_out=$request->get('sunday_out');

        if($monday_s!=1){
            $monday_in='';
            $monday_out='';
        }
        if($tuesday_s!=1){
            $tuesday_in='';
            $tuesday_out='';
        }
        if($wednesday_s!=1){
            $wednesday_in='';
            $wednesday_out='';
        }
        if($thursday_s!=1){
            $thursday_in='';
            $thursday_out='';
        }
        if($friday_s!=1){
            $friday_in='';
            $friday_out='';
        }
        if($saturday_s!=1){
            $saturday_in='';
            $saturday_out='';
        }
        if($sunday_s!=1){
            $sunday_in='';
            $sunday_out='';
        }
        $find_name= DB::connection('sqlsrv2')->table('Roasters')->where('CompanyID','=',$company_id)->where('RosterName','=',$roster_name)->exists();
        if($find_name){
            $arr="Roster Name Already Exists";
            return request()->json(200, $arr);
        }
        else {
            DB::connection('sqlsrv2')->insert("INSERT INTO Roasters(RosterName,Mon,Tue,Wed,Thu,Fri,Sat,Sun,CreatedBy,CompanyID) values (?,?,?,?,?,?,?,?,?,?)", [$roster_name,$monday_in.'-'.$monday_out,$tuesday_in.'-'.$tuesday_out,$wednesday_in.'-'.$wednesday_out,$thursday_in.'-'.$thursday_out,$friday_in.'-'.$friday_out,$saturday_in.'-'.$saturday_out,$sunday_in.'-'.$sunday_out,$username,$company_id]);
            
            $UserFullName=Session::get('UserName');
            date_default_timezone_set("Asia/Karachi");
            $update_date=date("Y-m-d h:i:s A");
            DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Roaster Added','New roaster '.$roster_name.' added', $update_date]);

            $arr= DB::connection('sqlsrv2')->table('Roasters')->where('CompanyID','=',$company_id)->paginate();

            return request()->json(200, $arr);
        }
    }


        public function roster_detail(){
          $company_id=Session::get('company_id');
          $arr= DB::connection('sqlsrv2')->table('Roasters')->where('CompanyID','=',$company_id)->get();

        return request()->json(200,$arr); 
        }
        public function overall_grace_period(){
         $company_id=Session::get('company_id');
         
$arr =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('EmpGraceHours', 'Emp_Profile.EmployeeID', '=', 'EmpGraceHours.EmployeeID')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('EmpGraceHours.EmployeeID', 'desc')
        ->select('Emp_Profile.Name','Emp_Profile.Photo','EmpGraceHours.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('EmpGraceHours.CompanyID','=',$company_id)
        ->paginate(15);

        
        return request()->json(200,$arr);  
        }

        public function search_by_grace_period($id){
          $company_id=Session::get('company_id');
          if($id=='Department'){
           $arr=DB::table('tb_department')->select('department_name as num')->where('company_id','=',$company_id)->get();
            return request()->json(200,$arr); 
          }
          elseif($id=="Designation") {
            $arr=DB::table('tb_designation')->select('designation_name as num')->where('company_id','=',$company_id)->orderBy('designation_name','asc')->get();
             return request()->json(200,$arr); 
          }
          elseif($id=="Location") {
            $arr=DB::table('tb_company_locations')->select('location_name as num')->where('company_id','=',$company_id)->orderBy('location_name','asc')->get();
             return request()->json(200,$arr); 
          }

        }
        public function update_ind_grace(Request $request){
          $company_id=Session::get('company_id');
          $grace_id=$request->get('grace_ids');
           $em_code=$request->get('em_code');
            $em_name=$request->get('em_name');
             $em_totalgp3=$request->get('em_totalgp');
              $find_grace= DB::connection('sqlsrv2')->table('EmpGraceHours')->where('CompanyID','=',$company_id)->where('EmpGraceID','=',$grace_id)->exists();
              if($find_grace){
                date_default_timezone_set("Asia/Karachi");
      $update_date=date("Y-m-d h:i:s A");
       $find_grace5= DB::connection('sqlsrv2')->table('EmpGraceHours')->where('CompanyID','=',$company_id)->where('EmpGraceID','=',$grace_id)->get();
       foreach ($find_grace5 as $find_grace51) {
         # code...
       }
       $pre_grace=$find_grace51->TotalGP;
        $em_totalgp=$pre_grace+$em_totalgp3;



      $result=   DB::connection('sqlsrv2')->update('update EmpGraceHours set TotalGP=? where EmpGraceID=?',[$em_totalgp,$grace_id]);
        $arr =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('EmpGraceHours', 'Emp_Profile.EmployeeID', '=', 'EmpGraceHours.EmployeeID')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('EmpGraceHours.EmployeeID', 'desc')
        ->select('Emp_Profile.Name','Emp_Profile.Photo','EmpGraceHours.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('EmpGraceHours.CompanyID','=',$company_id)
        ->paginate(15);

        
        return request()->json(200,$arr);  
              }




        }
          public function update_overall_grace(Request $request){
        $company_id=Session::get('company_id');
        $username=Session::get('username'); 
        $UserFullName=Session::get('UserName');
        $search_by=$request->get('search_by');
        $search_name=$request->get('search_name');
        $overall_totalgp3=$request->get('overall_totalgp');

        if($search_by=='Department'){
            $GpTarget = "department ".$search_name;
            $find_dep_graceperiod =DB::connection('sqlsrv2')->table('Emp_Register')
            ->join('EmpGraceHours', 'Emp_Register.EmployeeID', '=', 'EmpGraceHours.EmployeeID')
            ->orderBy('EmpGraceHours.EmployeeID', 'desc')
            ->select('EmpGraceHours.EmployeeID')->where('EmpGraceHours.CompanyID','=',$company_id)->where('Emp_Register.Department','=',$search_name)->get();

            for($x=0;$x<count($find_dep_graceperiod);$x++){
                $find_grace5= DB::connection('sqlsrv2')->table('EmpGraceHours')->where('CompanyID','=',$company_id)->where('EmployeeID','=', $find_dep_graceperiod[$x]->EmployeeID)->get();
                foreach ($find_grace5 as $find_grace51) {
                 # code...
                }
                $pre_grace = $find_grace51->TotalGP;
                $overall_totalgp = $pre_grace+$overall_totalgp3;
                $result = DB::connection('sqlsrv2')->update('update EmpGraceHours set TotalGP=? where EmployeeID=?',[$overall_totalgp, $find_dep_graceperiod[$x]->EmployeeID]);
            }
        }
        elseif($search_by=='Location')
        {
            $GpTarget = "location ".$search_name;
            $find_dep_graceperiod =DB::connection('sqlsrv2')->table('Emp_Register')
            ->join('EmpGraceHours', 'Emp_Register.EmployeeID', '=', 'EmpGraceHours.EmployeeID')
            ->orderBy('EmpGraceHours.EmployeeID', 'desc')
            ->select('EmpGraceHours.EmployeeID')->where('EmpGraceHours.CompanyID','=',$company_id)->where('Emp_Register.PostingCity','=',$search_name)->get();
            for($x=0;$x<count($find_dep_graceperiod);$x++)
            {
                $find_grace5= DB::connection('sqlsrv2')->table('EmpGraceHours')->where('CompanyID','=',$company_id)->where('EmployeeID','=', $find_dep_graceperiod[$x]->EmployeeID)->get();
                foreach ($find_grace5 as $find_grace51) {
                 # code...
                }
                $pre_grace=$find_grace51->TotalGP;
                $overall_totalgp=$pre_grace+$overall_totalgp3;
                //return request()->json(200, $find_dep_graceperiod[$x]->EmployeeID.$find_grace51->TotalGP);
                $result=   DB::connection('sqlsrv2')->update('update EmpGraceHours set TotalGP=? where EmployeeID=?',[$overall_totalgp, $find_dep_graceperiod[$x]->EmployeeID]);
            }
        }
        elseif($search_by=='Designation'){
            $GpTarget = "designation ".$search_name;
            $find_dep_graceperiod =DB::connection('sqlsrv2')->table('Emp_Register')
            ->join('EmpGraceHours', 'Emp_Register.EmployeeID', '=', 'EmpGraceHours.EmployeeID')
            ->orderBy('EmpGraceHours.EmployeeID', 'desc')
            ->select('EmpGraceHours.EmployeeID')->where('EmpGraceHours.CompanyID','=',$company_id)->where('Emp_Register.Designation','=',$search_name)->get();

            for($x=0;$x<count($find_dep_graceperiod);$x++){
                $find_grace5= DB::connection('sqlsrv2')->table('EmpGraceHours')->where('CompanyID','=',$company_id)->where('EmployeeID','=', $find_dep_graceperiod[$x]->EmployeeID)->get();
                foreach ($find_grace5 as $find_grace51) {
                 # code...
                }
                $pre_grace=$find_grace51->TotalGP;
                $overall_totalgp=$pre_grace+$overall_totalgp3;
                //return request()->json(200, $find_dep_graceperiod[$x]->EmployeeID.$find_grace51->TotalGP);
                $result=   DB::connection('sqlsrv2')->update('update EmpGraceHours set TotalGP=? where EmployeeID=?',[$overall_totalgp, $find_dep_graceperiod[$x]->EmployeeID]);
            }
        }

        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
        $full_name_id=$request->get('nameId');
           
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Grace Periods Updated', 'Grace periods of '.$GpTarget.' has updated', $update_date]);


        $arr = DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('EmpGraceHours', 'Emp_Profile.EmployeeID', '=', 'EmpGraceHours.EmployeeID')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('EmpGraceHours.EmployeeID', 'desc')
        ->select('Emp_Profile.Name','Emp_Profile.Photo','EmpGraceHours.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')
        ->where('EmpGraceHours.CompanyID','=',$company_id)->paginate(15);
        return request()->json(200, $arr);
    }
    public function roster_detail1(){
      $company_id=Session::get('company_id');
      $arr=DB::connection('sqlsrv2')->table('Roasters')->select('RosterName')->where('CompanyID','=',$company_id)->orderBy('RosterName','asc')->get();
             return request()->json(200,$arr); 
    }
    public function leaves_detail(){
      
    }
    public function attendance_detail(){
       date_default_timezone_set("Asia/Karachi");
      $update_date=date("Y-m-d");
       $company_id=Session::get('company_id');
       $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('AttData', 'Emp_Profile.EmployeeID', '=', 'AttData.EmpID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('AttData.EmpID', 'desc')->select('Emp_Profile.Name','Emp_Profile.Photo','AttData.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('AttData.CompanyID','=',$company_id)->where('AttData.ATTDate','=',$update_date)->paginate(20);

        
        return request()->json(200,$arr);
    }
    public function count_today_attendance(){
       date_default_timezone_set("Asia/Karachi");
      $update_date=date("Y-m-d");
       $company_id=Session::get('company_id');


       $present  =DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)->where('ATTDate','=',$update_date)->where('AttStatus','=','P')->count();
       $Absent  =DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)->where('ATTDate','=',$update_date)->where('AttStatus','=','A')->count();
       $Late  =DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)->where('ATTDate','=',$update_date)->where('AttStatus','=','L')->count();
       $max  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('Status','=','Registered')->count();

   
      $myJSON =array(
      'pres' => $present,
      'abse' => $Absent,
      'late' => $Late,
      'max'=>$max,
      );
      return request()->json(200,$myJSON);
    }
    public function getattendance_report($department,$location,$designation,$emp_id,$start,$close){
        
        $company_id=Session::get('company_id');

        if($designation=='All'&& $department=='All'&& $location=='All'&& $emp_id=='All'){
          $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('AttData', 'Emp_Profile.EmployeeID', '=', 'AttData.EmpID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('AttData.EmpID', 'desc')->select('Emp_Profile.Name','AttData.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('AttData.CompanyID','=',$company_id)->where('AttData.ATTDate', '>=', $start)->where('AttData.ATTDate', '<=', $close)->get();
          return request()->json(200,$arr);
        }
        else {
           if($department=='All'){
            $department='';
          }
          if($designation=='All'){
            $designation='';
          }
          if($location=='All'){
            $location='';
          }
          if($emp_id=='All'){
            $emp_id='';
          }
           $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('AttData', 'Emp_Profile.EmployeeID', '=', 'AttData.EmpID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('AttData.EmpID', 'desc')->select('Emp_Profile.Name','AttData.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('AttData.CompanyID','=',$company_id)->where('AttData.ATTDate', '>=', $start)->where('AttData.ATTDate', '<=', $close)->where('Emp_Register.Department','like','%'.$department.'%')->where('Emp_Register.Designation','like','%'.$designation.'%')->where('Emp_Register.PostingCity','like','%'.$location.'%')->where('AttData.EmpID','like','%'.$emp_id.'%')->get();
          return request()->json(200,$arr);
        }
   
 

    }
    public function getattendance_summary(){     
      $company_id=Session::get('company_id');
      $find_session =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->get();
      foreach ($find_session as $find_session1) {
       
           }
            $s_date=$find_session1->StartDate;
      $e_date=$find_session1->EndDate;
      $rangArray = [];
            
        $startDate = strtotime($s_date);
        $endDate = strtotime($e_date);
        for ($currentDate = $startDate; $currentDate <= $endDate; 
             $currentDate += (86400)) {
           $date = date('Y-m-d', $currentDate);
            $rangArray[] = $date;
        }
       //  print_r($rangArray);
        $count_range= count($rangArray);


$result=DB::connection('sqlsrv2')->select("SET NOCOUNT ON ; exec [dbo].[GetMonthltAttReport]  N'".$s_date."', N'".$e_date."' ");


  # code...
 if($count_range==31){

  $i=0;
  $k='';
   foreach($result as $result1) { 
    $i=$i+1;
   $b[$i]= '<tr><td>'.$result1->Name.'</td>
  <td>'.$result1->Designation.'</td>
  <td>'.$result1->Department.'</td>
  <td>'.$result1->{$rangArray[0]}.'</td>
    <td>'.$result1->{$rangArray[1]}.'</td>
  <td>'.$result1->{$rangArray[2]}.'</td>
   <td>'.$result1->{$rangArray[3]}.'</td>
    <td>'.$result1->{$rangArray[4]}.'</td>
  <td>'.$result1->{$rangArray[5]}.'</td>
  <td>'.$result1->{$rangArray[6]}.'</td>
  <td>'.$result1->{$rangArray[7]}.'</td>
  <td>'.$result1->{$rangArray[8]}.'</td>
  <td>'.$result1->{$rangArray[9]}.'</td>
  <td>'.$result1->{$rangArray[10]}.'</td>
  <td>'.$result1->{$rangArray[11]}.'</td>
  <td>'.$result1->{$rangArray[12]}.'</td>
  <td>'.$result1->{$rangArray[13]}.'</td>
  <td>'.$result1->{$rangArray[14]}.'</td>
  <td>'.$result1->{$rangArray[15]}.'</td>
  <td>'.$result1->{$rangArray[16]}.'</td>
  <td>'.$result1->{$rangArray[17]}.'</td>
  <td>'.$result1->{$rangArray[18]}.'</td>
  <td>'.$result1->{$rangArray[19]}.'</td>
  <td>'.$result1->{$rangArray[20]}.'</td>
  <td>'.$result1->{$rangArray[21]}.'</td>
  <td>'.$result1->{$rangArray[22]}.'</td>
  <td>'.$result1->{$rangArray[23]}.'</td>
  <td>'.$result1->{$rangArray[24]}.'</td>
  <td>'.$result1->{$rangArray[25]}.'</td>
  <td>'.$result1->{$rangArray[26]}.'</td>
  <td>'.$result1->{$rangArray[27]}.'</td>
  <td>' .$result1->{$rangArray[28]}.'</td>
  <td>' .$result1->{$rangArray[29]}.'</td>
  <td>' .$result1->{$rangArray[30]}.'</td> 
  </tr>';
  $k=$k.''.$b[$i];
  }
  
 $d=$k;
 }
 elseif($count_range==30){

  $i=0;
  $k='';
   foreach($result as $result1) { 
    $i=$i+1;
   $b[$i]= '<tr><td>'.$result1->Name.'</td>
  <td>'.$result1->Designation.'</td>
  <td>'.$result1->Department.'</td>
  <td>'.$result1->{$rangArray[0]}.'</td>
    <td>'.$result1->{$rangArray[1]}.'</td>
  <td>'.$result1->{$rangArray[2]}.'</td>
   <td>'.$result1->{$rangArray[3]}.'</td>
    <td>'.$result1->{$rangArray[4]}.'</td>
  <td>'.$result1->{$rangArray[5]}.'</td>
  <td>'.$result1->{$rangArray[6]}.'</td>
  <td>'.$result1->{$rangArray[7]}.'</td>
  <td>'.$result1->{$rangArray[8]}.'</td>
  <td>'.$result1->{$rangArray[9]}.'</td>
  <td>'.$result1->{$rangArray[10]}.'</td>
  <td>'.$result1->{$rangArray[11]}.'</td>
  <td>'.$result1->{$rangArray[12]}.'</td>
  <td>'.$result1->{$rangArray[13]}.'</td>
  <td>'.$result1->{$rangArray[14]}.'</td>
  <td>'.$result1->{$rangArray[15]}.'</td>
  <td>'.$result1->{$rangArray[16]}.'</td>
  <td>'.$result1->{$rangArray[17]}.'</td>
  <td>'.$result1->{$rangArray[18]}.'</td>
  <td>'.$result1->{$rangArray[19]}.'</td>
  <td>'.$result1->{$rangArray[20]}.'</td>
  <td>'.$result1->{$rangArray[21]}.'</td>
  <td>'.$result1->{$rangArray[22]}.'</td>
  <td>'.$result1->{$rangArray[23]}.'</td>
  <td>'.$result1->{$rangArray[24]}.'</td>
  <td>'.$result1->{$rangArray[25]}.'</td>
  <td>'.$result1->{$rangArray[26]}.'</td>
  <td>'.$result1->{$rangArray[27]}.'</td>
  <td>' .$result1->{$rangArray[28]}.'</td>
  <td>' .$result1->{$rangArray[29]}.'</td>
  </tr>';
  $k=$k.''.$b[$i];
  }
  
 $d=$k;
 }
   elseif($count_range==29){

  $i=0;
  $k='';
   foreach($result as $result1) { 
    $i=$i+1;
   $b[$i]= '<tr><td>'.$result1->Name.'</td>
  <td>'.$result1->Designation.'</td>
  <td>'.$result1->Department.'</td>
  <td>'.$result1->{$rangArray[0]}.'</td>
    <td>'.$result1->{$rangArray[1]}.'</td>
  <td>'.$result1->{$rangArray[2]}.'</td>
   <td>'.$result1->{$rangArray[3]}.'</td>
    <td>'.$result1->{$rangArray[4]}.'</td>
  <td>'.$result1->{$rangArray[5]}.'</td>
  <td>'.$result1->{$rangArray[6]}.'</td>
  <td>'.$result1->{$rangArray[7]}.'</td>
  <td>'.$result1->{$rangArray[8]}.'</td>
  <td>'.$result1->{$rangArray[9]}.'</td>
  <td>'.$result1->{$rangArray[10]}.'</td>
  <td>'.$result1->{$rangArray[11]}.'</td>
  <td>'.$result1->{$rangArray[12]}.'</td>
  <td>'.$result1->{$rangArray[13]}.'</td>
  <td>'.$result1->{$rangArray[14]}.'</td>
  <td>'.$result1->{$rangArray[15]}.'</td>
  <td>'.$result1->{$rangArray[16]}.'</td>
  <td>'.$result1->{$rangArray[17]}.'</td>
  <td>'.$result1->{$rangArray[18]}.'</td>
  <td>'.$result1->{$rangArray[19]}.'</td>
  <td>'.$result1->{$rangArray[20]}.'</td>
  <td>'.$result1->{$rangArray[21]}.'</td>
  <td>'.$result1->{$rangArray[22]}.'</td>
  <td>'.$result1->{$rangArray[23]}.'</td>
  <td>'.$result1->{$rangArray[24]}.'</td>
  <td>'.$result1->{$rangArray[25]}.'</td>
  <td>'.$result1->{$rangArray[26]}.'</td>
  <td>'.$result1->{$rangArray[27]}.'</td>
  <td>' .$result1->{$rangArray[28]}.'</td>
  </tr>';
  $k=$k.''.$b[$i];
  }
  
 $d=$k;
 }
  elseif($count_range==28){

  $i=0;
  $k='';
   foreach($result as $result1) { 
    $i=$i+1;
   $b[$i]= '<tr><td>'.$result1->Name.'</td>
  <td>'.$result1->Designation.'</td>
  <td>'.$result1->Department.'</td>
  <td>'.$result1->{$rangArray[0]}.'</td>
    <td>'.$result1->{$rangArray[1]}.'</td>
  <td>'.$result1->{$rangArray[2]}.'</td>
   <td>'.$result1->{$rangArray[3]}.'</td>
    <td>'.$result1->{$rangArray[4]}.'</td>
  <td>'.$result1->{$rangArray[5]}.'</td>
  <td>'.$result1->{$rangArray[6]}.'</td>
  <td>'.$result1->{$rangArray[7]}.'</td>
  <td>'.$result1->{$rangArray[8]}.'</td>
  <td>'.$result1->{$rangArray[9]}.'</td>
  <td>'.$result1->{$rangArray[10]}.'</td>
  <td>'.$result1->{$rangArray[11]}.'</td>
  <td>'.$result1->{$rangArray[12]}.'</td>
  <td>'.$result1->{$rangArray[13]}.'</td>
  <td>'.$result1->{$rangArray[14]}.'</td>
  <td>'.$result1->{$rangArray[15]}.'</td>
  <td>'.$result1->{$rangArray[16]}.'</td>
  <td>'.$result1->{$rangArray[17]}.'</td>
  <td>'.$result1->{$rangArray[18]}.'</td>
  <td>'.$result1->{$rangArray[19]}.'</td>
  <td>'.$result1->{$rangArray[20]}.'</td>
  <td>'.$result1->{$rangArray[21]}.'</td>
  <td>'.$result1->{$rangArray[22]}.'</td>
  <td>'.$result1->{$rangArray[23]}.'</td>
  <td>'.$result1->{$rangArray[24]}.'</td>
  <td>'.$result1->{$rangArray[25]}.'</td>
  <td>'.$result1->{$rangArray[26]}.'</td>
  <td>'.$result1->{$rangArray[27]}.'</td>
  </tr>';
  $k=$k.''.$b[$i];
  }
  
 $d=$k;
 }

return request()->json(200,$d);



 
    }
    public function get_column_name(){
     // $table = 'cities';
       $company_id=Session::get('company_id');
      $find_session =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->get();
      foreach ($find_session as $find_session1) {
       
           }
            $s_date=$find_session1->StartDate;
      $e_date=$find_session1->EndDate;
     

      $table=DB::connection('sqlsrv2')->select("EXEC  [dbo].[GetDateList]
    @STARTDATE = '".$s_date."',
    @ENDDATE = '".$e_date."'");
return request()->json(200,$table);
    }
   public function submit_session(Request $request){
        date_default_timezone_set("Asia/Karachi");
         $update_date=date("Y-m-d h:i:s A");
        $company_id=Session::get('company_id');
        $username=Session::get('username');
        $UserFullName=Session::get('UserName');
      $session_start=$request->get('session_start');
      $session_end=$request->get('session_end');
      $c_session=$request->get('c_session');
      $year = date('Y', strtotime($session_end));
       $month = date('F', strtotime($session_end));
       $session_name=$month.'-'.$year;
       if($c_session==1){
          DB::connection('sqlsrv2')->update('update HrSessions set CurrentSession=? where CompanyID=?',[0,$company_id]);
       }


       $result=DB::connection('sqlsrv2')->insert('INSERT INTO HrSessions(SessionName,StartDate,EndDate,CreateBy,CreateOn,CompanyID,CurrentSession,AttClosedPayrollStart) values (?,?,?,?,?,?,?,?)', [$session_name,$session_start,$session_end,$username,$update_date,$company_id,$c_session,'Open']);
       
       if($result){
       $arr= DB::connection('sqlsrv2')->table("HrSessions")->where('CompanyID','=',$company_id)->orderBy('SessionID','desc')->paginate(5);
       
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id,$username,$UserFullName,'Insert New Session','New session '.$session_name.' added', $update_date]);

        return request()->json(200,$arr);
       }

    }
    public function session_detail(){
      $company_id=Session::get('company_id');
       $arr= DB::connection('sqlsrv2')->table("HrSessions")->where('CompanyID','=',$company_id)->orderBy('SessionID','desc')->paginate(5);

        return request()->json(200,$arr);
    }
   public function delete_session($id){
        $company_id=Session::get('company_id');
        $username=Session::get('username');
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");


        
        $session_name_arr = DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('SessionID','=', $id)->get();
        foreach ($session_name_arr as $session_name_arr1) {
           }
        $session_name=$session_name_arr1->SessionName;

        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Delete Session','Session '.$session_name.' deleted', $update_date]);
        

         $result=DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('SessionID', $id)->delete();

         
         if($result) {
        $arr= DB::connection('sqlsrv2')->table("HrSessions")->where('CompanyID','=',$company_id)->orderBy('SessionID','desc')->paginate(5);
        return request()->json(200,$arr);
    }

  }
    public function find_emp_id(){
       $company_id=Session::get('company_id');
      $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('Emp_Profile.EmployeeID', 'desc')
        ->select('Emp_Profile.Name','Emp_Register.EmployeeID','Emp_Register.EmployeeCode')->where('Emp_Profile.CompanyID','=',$company_id)->where('Emp_Register.EmployeeCode','!=','')->get();

       return request()->json(200,$emp_detail);
    }
    public function getindatt_report($id){
     
        $company_id=Session::get('company_id');
        if($id==0){
            $id=Session::get('employee_id');
        }
        $find_session =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->get();
        foreach ($find_session as $find_session1) {}
        $s_date=$find_session1->StartDate;
        $e_date=$find_session1->EndDate;

        $table  =DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)->where('ATTDate', '>=', $s_date)->where('ATTDate', '<=', $e_date)->where('EmpID','=',$id)->orderBy('ATTDate', 'desc')->get();
        return request()->json(200,$table);
    }

    public function getindatt_count($id){
       $company_id=Session::get('company_id');
      $find_session =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->get();
      foreach ($find_session as $find_session1) {
       
           }
            $s_date=$find_session1->StartDate;
            $e_date=$find_session1->EndDate;

         $totaldays  =DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)->where('ATTDate', '>=', $s_date)->where('ATTDate', '<=', $e_date)->where('EmpID','=',$id)->count();
          $present  =DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)->where('ATTDate', '>=', $s_date)->where('ATTDate', '<=', $e_date)->where('EmpID','=',$id)->where('AttStatus','=','P')->count();
          $absent  =DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)->where('ATTDate', '>=', $s_date)->where('ATTDate', '<=', $e_date)->where('EmpID','=',$id)->where('AttStatus','=','A')->count();
          $leaves  =DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)->where('ATTDate', '>=', $s_date)->where('ATTDate', '<=', $e_date)->where('EmpID','=',$id)->where('AttStatus','=','L')->count();
          $getdata =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->select('Emp_Profile.Name','Emp_Register.EmployeeCode','Emp_Register.Department','Emp_Register.Designation','Emp_Register.PostingCity')->where('Emp_Profile.CompanyID','=',$company_id)->where('Emp_Profile.EmployeeID','=',$id)->get();
        foreach($getdata as $getdata1){

        }

   
      $myJSON =array(
      'totaldays' => $totaldays,
      'present' => $present,
       'absent' => $absent,
       'leaves' => $leaves,
       'Name'=>$getdata1->Name,
       'EmployeeCode'=>$getdata1->EmployeeCode,
       'Department'=>$getdata1->Department,
       'Designation'=>$getdata1->Designation,
       'PostingCity'=>$getdata1->PostingCity,
      );
      return request()->json(200,$myJSON);   

    }
    public function get_absent_detail($start,$end){
      $company_id=Session::get('company_id');
       $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('AttData', 'Emp_Profile.EmployeeID', '=', 'AttData.EmpID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('AttData.EmpID', 'desc')->select('Emp_Profile.Name','AttData.ATTDate','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('AttData.CompanyID','=',$company_id)
       ->where('AttData.AttStatus','=','A')
       ->where('AttData.ATTDate', '>=', $start)->where('AttData.ATTDate', '<=', $end)->get();
  return request()->json(200,$arr);
      }
      public function getemploydetail($emp_department,$emp_location,$emp_designation,$emp_emp_id,$emp_type,$emp_status){
         $company_id=Session::get('company_id');
        if($emp_department=='All' && $emp_location=='All' && $emp_designation=='All' && $emp_emp_id=='All'&& $emp_type=='All'&& $emp_status=='All'){
         
         $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('Emp_Profile.EmployeeID', 'desc')
        ->select('Emp_Profile.*','Emp_Register.*')->where('Emp_Profile.CompanyID','=',$company_id)
        ->get();
            return request()->json(200,$emp_detail);
        }
        else {
          if($emp_department=='All'){
            $emp_department='';
          }
          if($emp_designation=='All'){
            $emp_designation='';
          }
          if($emp_location=='All'){
            $emp_location='';
          }
           if($emp_emp_id=='All'){
            $emp_emp_id='';
            }
            if($emp_type=='All'){
            $emp_type='';
            }
            if($emp_status=='All'){
            $emp_status='';
            }

           $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('Emp_Profile.EmployeeID', 'desc')
        ->select('Emp_Profile.*','Emp_Register.*')->where('Emp_Profile.CompanyID','=',$company_id)->where('Emp_Register.Department','like','%'.$emp_department.'%')->where('Emp_Register.Designation','like','%'.$emp_designation.'%')->where('Emp_Register.PostingCity','like','%'.$emp_location.'%')->where('Emp_Register.EmployeeID','like','%'.$emp_emp_id.'%')->where('Emp_Register.Status','like','%'.$emp_status.'%')->where('Emp_Register.JobStatus','like','%'.$emp_type.'%')
          ->get();
        return request()->json(200,$emp_detail);

        }

      }
      public function gethireemploy($hire_department,$hire_location,$hire_designation,$hire_emp_id,$hire_start_date,$hire_end_date){
      $company_id=Session::get('company_id');
        if($hire_department=='All' && $hire_location=='All'&& $hire_designation=='All' && $hire_emp_id=='All'&& $hire_start_date!='' && $hire_end_date!='') {

           $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('Emp_Profile.EmployeeID', 'desc')
        ->select('Emp_Profile.*','Emp_Register.*')->where('Emp_Profile.CompanyID','=',$company_id)->where('Emp_Register.JoiningDate', '>=', $hire_start_date)->where('Emp_Register.JoiningDate', '<=', $hire_end_date)
        ->get();
           
            return request()->json(200,$emp_detail);
          }
        else {
           if($hire_department=='All'){
            $hire_department='';
          }
          if($hire_designation=='All'){
            $hire_designation='';
          }
          if($hire_location=='All'){
            $hire_location='';
          }
           if($hire_emp_id=='All'){
            $hire_emp_id='';
            }



            $emp_detail =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('Emp_Profile.EmployeeID', 'desc')
        ->select('Emp_Profile.*','Emp_Register.*')->where('Emp_Profile.CompanyID','=',$company_id)->where('Emp_Register.JoiningDate', '>=', $hire_start_date)->where('Emp_Register.JoiningDate', '<=', $hire_end_date)->where('Emp_Register.Department','like','%'.$hire_department.'%')->where('Emp_Register.Designation','like','%'.$hire_designation.'%')->where('Emp_Register.PostingCity','like','%'.$hire_location.'%')->where('Emp_Register.EmployeeID','like','%'.$hire_emp_id.'%')->get();
         return request()->json(200,$emp_detail);
        }
       
      }
      public function gethireemploycount($hire_department,$hire_location,$hire_designation,$hire_emp_id,$hire_start_date,$hire_end_date){
         $company_id=Session::get('company_id');
         if($hire_department=='All' && $hire_location=='All'&& $hire_designation=='All' && $hire_emp_id=='All'&& $hire_start_date!='' && $hire_end_date!='')
         {
        $all_emp=DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate', '>=', $hire_start_date)->where('JoiningDate', '<=', $hire_end_date)->count();
  return request()->json(200,$all_emp);

         }
         else {
          if($hire_department=='All'){
            $hire_department='';
          }
          if($hire_designation=='All'){
            $hire_designation='';
          }
          if($hire_location=='All'){
            $hire_location='';
          }
           if($hire_emp_id=='All'){
            $hire_emp_id='';
            }
          $all_emp=DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate', '>=', $hire_start_date)->where('JoiningDate', '<=', $hire_end_date)->where('Department','like','%'.$hire_department.'%')->where('Designation','like','%'.$hire_designation.'%')->where('PostingCity','like','%'.$hire_location.'%')->where('EmployeeID','like','%'.$hire_emp_id.'%')->count();
            return request()->json(200,$all_emp);
         }


      }
      public function overall_leaves(){
        $company_id=Session::get('company_id');
         $all_emp=DB::connection('sqlsrv2')->table('leaves')->select('LeaveType')->where('CompanyID','=',$company_id)->get();
          return request()->json(200,$all_emp);
      }
      public function filter_leaves($leave_type, $department, $location, $designation){
        $company_id=Session::get('company_id');
       
            if($leave_type=='All')
            {
                $leave_type='';
            }
            if($department=='All')
            {
                $department='';
            }
            if($designation=='All')
            {
                $designation='';
            }
            if($location=='All')
            {
                $location='';
            }
            
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')
            ->join('EmpLeave', 'Emp_Profile.EmployeeID', '=', 'EmpLeave.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('EmpLeave.EmployeeID', 'desc')
            ->select('Emp_Profile.Name','Emp_Profile.Photo','EmpLeave.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')
            ->where('EmpLeave.CompanyID','=',$company_id)->where('EmpLeave.LeaveType','like','%'.$leave_type.'%')->where('Emp_Register.Department','like','%'.$department.'%')
            ->where('Emp_Register.Designation','like','%'.$designation.'%')->where('Emp_Register.PostingCity','like','%'.$location.'%')->get();
            return request()->json(200,$arr);
      }
      

      public function getleaveemploy($department,$location, $designation,$emp_id,$date_from,$date_end,$leave_type){
        $company_id=Session::get('company_id');
          if($designation=='All' && $department=='All'&& $location=='All' && $emp_id=='All' && $leave_type=='All'){

           $arr =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('leave_Requisition', 'Emp_Profile.EmployeeID', '=', 'leave_Requisition.EmployeeID')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('leave_Requisition.EmployeeID', 'desc')
        ->select('Emp_Profile.Name','leave_Requisition.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('leave_Requisition.CompanyID','=',$company_id)->where('leave_Requisition.StartDate','>=',$date_from)->where('leave_Requisition.EndDate','<=',$date_end)->get();

        
        return request()->json(200,$arr); 
       
          }
          else {
            if($department=='All'){
            $department='';
          }
          if($designation=='All'){
            $designation='';
          }
          if($location=='All'){
            $location='';
          }
          if($emp_id=='All'){
            $emp_id='';
          }
          if($leave_type=='All'){
            $leave_type='';
          }
          $arr =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('leave_Requisition', 'Emp_Profile.EmployeeID', '=', 'leave_Requisition.EmployeeID')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('leave_Requisition.EmployeeID', 'desc')
        ->select('Emp_Profile.Name','leave_Requisition.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('leave_Requisition.CompanyID','=',$company_id)->where('leave_Requisition.StartDate','>=',$date_from)->where('leave_Requisition.EndDate','<=',$date_end)->where('Emp_Register.Department','like','%'.$department.'%')->where('Emp_Register.Designation','like','%'.$designation.'%')->where('Emp_Register.PostingCity','like','%'.$location.'%')->where('Emp_Register.EmployeeCode','like','%'.$emp_id.'%')->where('leave_Requisition.Leavetype','like','%'.$leave_type.'%')->get();

        
        return request()->json(200,$arr); 



      }
    }
    public function filter_leaves1($department,$location, $designation,$emp_id,$leave_type){
        $company_id=Session::get('company_id');
       
          if($designation=='All'&& $department=='All'&& $location=='All'&& $emp_id=='All'){

           $arr =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('EmpLeave', 'Emp_Profile.EmployeeID', '=', 'EmpLeave.EmployeeID')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('EmpLeave.EmployeeID', 'desc')
        ->select('Emp_Profile.Name','EmpLeave.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('EmpLeave.CompanyID','=',$company_id)->where('EmpLeave.LeaveType','=',$leave_type)->get();

        
        return request()->json(200,$arr); 
       
          }
          else {
            if($department=='All'){
            $department='';
          }
          if($designation=='All'){
            $designation='';
          }
          if($location=='All'){
            $location='';
          }
          if($emp_id=='All'){
            $emp_id='';
          }
            
             $arr =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('EmpLeave', 'Emp_Profile.EmployeeID', '=', 'EmpLeave.EmployeeID')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('EmpLeave.EmployeeID', 'desc')
        ->select('Emp_Profile.Name','Emp_Profile.Photo','EmpLeave.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('EmpLeave.CompanyID','=',$company_id)->where('EmpLeave.LeaveType','=',$leave_type)->where('Emp_Register.Department','like','%'.$department.'%')->where('Emp_Register.Designation','like','%'.$designation.'%')->where('Emp_Register.PostingCity','like','%'.$location.'%')->where('EmpLeave.EmployeeID','like','%'.$emp_id.'%')->get();
           
      return request()->json(200,$arr);

          }


      }
      public function fetch_roster_detail($id){
         $company_id=Session::get('company_id');
        $check_roster= DB::connection('sqlsrv2')->table('Roasters')->where('CompanyID','=',$company_id)->where('RosterID','=',$id)->get();
        return request()->json(200,$check_roster);
      }
 public function submit_update_roster(Request $request) {
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
        $username=Session::get('username'); 
        $company_id=Session::get('company_id');

        $roster_id=$request->get('uroster_id');
        $roster_name=$request->get('uroster_name');
        $monday_s=$request->get('umonday_s');
        $monday_in=$request->get('umonday_in');
        $monday_out=$request->get('umonday_out');

        $tuesday_s=$request->get('utuesday_s');
        $tuesday_in=$request->get('utuesday_in');
        $tuesday_out=$request->get('utuesday_out');
        $wednesday_s=$request->get('uwednesday_s');
        $wednesday_in=$request->get('uwednesday_in');

        $wednesday_out=$request->get('uwednesday_out');
        $thursday_s=$request->get('uthursday_s');
        $thursday_in=$request->get('uthursday_in');
        $thursday_out=$request->get('uthursday_out');
        $friday_s=$request->get('ufriday_s');

        $friday_in=$request->get('ufriday_in');
        $friday_out=$request->get('ufriday_out');
        $saturday_s=$request->get('usaturday_s');
        $saturday_in=$request->get('usaturday_in');
        $saturday_out=$request->get('usaturday_out');

        $sunday_s=$request->get('usunday_s');
        $sunday_in=$request->get('usunday_in');
        $sunday_out=$request->get('usunday_out');

        if($monday_s!=1){
            $monday_in='';
            $monday_out='';
        }
        if($tuesday_s!=1){
            $tuesday_in='';
            $tuesday_out='';
        }
        if($wednesday_s!=1){
            $wednesday_in='';
            $wednesday_out='';
        }
        if($thursday_s!=1){
            $thursday_in='';
            $thursday_out='';
        }
        if($friday_s!=1){
            $friday_in='';
            $friday_out='';
        }
        if($saturday_s!=1){
            $saturday_in='';
            $saturday_out='';
        }
        if($sunday_s!=1){
            $sunday_in='';
            $sunday_out='';
        }
        $result=DB::connection('sqlsrv2')->update('update Roasters set RosterName=?,Mon=?,Tue=?,Wed=?,Thu=?,Fri=?,Sat=?,Sun=?,DeletedBy=? where CompanyID=? and RosterID=?',[$roster_name,$monday_in.'-'.$monday_out,$tuesday_in.'-'.$tuesday_out,$wednesday_in.'-'.$wednesday_out,$thursday_in.'-'.$thursday_out,$friday_in.'-'.$friday_out,$saturday_in.'-'.$saturday_out,$sunday_in.'-'.$sunday_out,$username,$company_id,$roster_id]);

        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Roaster Updated','Roaster '.$roster_name.' updated', $update_date]);

        if($result){
            $arr= DB::connection('sqlsrv2')->table('Roasters')->where('CompanyID','=',$company_id)->get();
            return request()->json(200,$arr);
        }
    }
    
     public function submit_holidays(Request $request){
        $company_id=Session::get('company_id');
        $username=Session::get('username');
        $UserFullName=Session::get('UserName');
        $holiday_name=$request->get('h_holiday_name');
           // $days=$request->get('days');
            $h_date_from=$request->get('h_date_from');
            $h_date_to=$request->get('h_date_to');
            $h_description=$request->get('h_description');
             date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
        $username=Session::get('username');

        $result=DB::connection('sqlsrv2')->insert("INSERT INTO Holiday(HolidayName,holidaystartDate,HolidayEndDate,HolidayDescription,CompanyID) values (?,?,?,?,?)", [$holiday_name,$h_date_from,$h_date_to,$h_description,$company_id]);

    
        if($result){
         $arr= DB::connection('sqlsrv2')->table("Holiday")->where('CompanyID','=',$company_id)->orderBy('HolidayID','desc')->paginate(5);


         DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Insert New Holiday','New hiliday '.$holiday_name.' added', $update_date]);
        return request()->json(200,$arr);
        }

     }
    
     public function submit_leave(Request $request){
        $company_id=Session::get('company_id');
        $emp_emp_id = $request->get('emp_emp_id');
        $selecteddays = $request->get('days');
        $emp_date_from = $request->get('emp_date_from');
        $emp_date_to = $request->get('emp_date_to');
        $emp_reason = $request->get('emp_reason');
        $emp_leave = $request->get('emp_leave');
        $username=Session::get('username');
        $rem_levs= DB::connection('sqlsrv2')->table('EmpLeave')->where('CompanyID','=',$company_id)->where('EmployeeID','=', $emp_emp_id)->where('LeaveType','=', $emp_leave)->sum('RemainingLeave');
        //count days of multiple days leave
        if($selecteddays == "Multiple Days"){
            $days1 = strtotime($emp_date_to) - strtotime($emp_date_from);
            $days = ($days1/(60*60*24))+1;
        }
        else if($selecteddays == "One Day"){
            $days = "1";
            $emp_date_to = null;
        }
          if( ($days > $rem_levs))
          {
              $pl_status = "OL";
          }
          else
          {
              $pl_status = "P";
          }
        $result=DB::connection('sqlsrv2')->insert("INSERT INTO leave_Requisition(EmployeeID,Leavetype,StartDate, EndDate, NoOfDays, Reason, AppliedBy, PendingLeaveStatus, CompanyID) values (?,?,?,?,?,?,?,?,?)", [$emp_emp_id,$emp_leave,$emp_date_from,$emp_date_to, $days, $emp_reason,$username, $pl_status, $company_id]);
        $arr="submitted";

        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
        $full_name_id=$request->get('nameId');
        $full_name_arr= DB::connection('sqlsrv2')->table('Emp_Profile')->select('Name')->where('EmployeeID', '=', $emp_emp_id)->get();
        foreach ($full_name_arr as $full_name_arr1) {
              # code...
            }
        $full_name = $full_name_arr1->Name;
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Leave Applied',$emp_leave.' leave of '.$full_name.' applied', $update_date]);

        return request()->json(200,$arr);
    }
    
        public function holiday_detail(){
           $company_id=Session::get('company_id');
       $arr= DB::connection('sqlsrv2')->table("Holiday")->where('CompanyID','=',$company_id)->orderBy('HolidayID','desc')->paginate(5);
        return request()->json(200,$arr);
        }
         public function submit_l(Request $request){
        $company_id=Session::get('company_id');
        $leave_type=$request->get('l_type');
        $username=Session::get('username');
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d");
         $update_date1=date("Y-m-d h:i:s A");
        
        $result=DB::connection('sqlsrv2')->insert("INSERT INTO leaves(LeaveType,CompanyID) values (?,?)", [$leave_type,$company_id]);
        if($result){
        $arr= DB::connection('sqlsrv2')->table("leaves")->where('CompanyID','=',$company_id)->orderBy('LeaveID','desc')->paginate(5);
            DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Insert Leave Type','New leave type '.$leave_type.' added', $update_date1]);
            return request()->json(200,$arr);
        }
    }







      public function view_leave_type(){
           $company_id=Session::get('company_id');
           
            $arr= DB::connection('sqlsrv2')->table("leaves")->where('CompanyID','=',$company_id)->orderBy('LeaveID','desc')->paginate(5);
             return request()->json(200,$arr);
           

        }
          public function submit_fine(Request $request){
           $company_id=Session::get('company_id');
           $emp_emp_id=$request->get('emp_emp_id');
        $UserFullName=Session::get('UserName');
            $emp_amount=$request->get('emp_amount');
            $emp_reason=$request->get('emp_reason');

             $username=Session::get('username');
          date_default_timezone_set("Asia/Karachi");
           $update_date=date("Y-m-d");
           $find_session =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->get();
            foreach ($find_session as $find_session1) {
       
           }
            $s_date=$find_session1->StartDate;
            $e_date=$find_session1->EndDate;
            $sessionname=$find_session1->SessionName;
            if($update_date<$e_date){
               $result=DB::connection('sqlsrv2')->insert("INSERT INTO FineDetail(CompanyID,EmployeeID,FineSession,FineAmount,FineDate,Remarks,CreatedBy) values (?,?,?,?,?,?,?)", [$company_id,$emp_emp_id,$sessionname,$emp_amount,$update_date,$emp_reason,$username]);
            }
            else {
               $var=strtotime($update_date);
                $effectiveDate = strtotime("+1 months",$var);
                $insSession = date("F-Y", $effectiveDate);
              $result=DB::connection('sqlsrv2')->insert("INSERT INTO FineDetail(CompanyID,EmployeeID,FineSession,FineAmount,FineDate,Remarks,CreatedBy,Status) values (?,?,?,?,?,?,?,?)", [$company_id,$emp_emp_id,$insSession,$emp_amount,$update_date,$emp_reason,$username,'Unpaid']);
            }
          $full_name_arr= DB::connection('sqlsrv2')->table('Emp_Register')->where('EmployeeID', '=', $emp_emp_id)->get();
        foreach ($full_name_arr as $full_name_arr1) {
              # code...
            }
        $emp_code = $full_name_arr1->EmployeeCode;
         $update_date1=date("Y-m-d h:i:s A");
             DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Fine added','Fine of '.$emp_code.' added', $update_date1]);

           if($result){
           
             $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('FineDetail', 'Emp_Profile.EmployeeID', '=', 'FineDetail.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('FineDetail.FineDate', 'desc')->select('Emp_Profile.Name','FineDetail.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('FineDetail.CompanyID','=',$company_id)->paginate(10);



             return request()->json(200,$arr);
           }
         }

         public function view_fine_detail(){
           $company_id=Session::get('company_id');
            
             $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('FineDetail', 'Emp_Profile.EmployeeID', '=', 'FineDetail.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('FineDetail.FineDate', 'desc')->select('Emp_Profile.Name','FineDetail.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('FineDetail.CompanyID','=',$company_id)->paginate(10);
           
             return request()->json(200,$arr);
           

        }
        public function delete_fine($id){
       $company_id=Session::get('company_id');
      $result=DB::connection('sqlsrv2')->table('FineDetail')->where('FineId', $id)->delete();
     if($result) {
       $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('FineDetail', 'Emp_Profile.EmployeeID', '=', 'FineDetail.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('FineDetail.FineDate', 'desc')->select('Emp_Profile.Name','FineDetail.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('FineDetail.CompanyID','=',$company_id)->paginate(10);
           
             return request()->json(200,$arr);
           
         
     }
        
    }

 public function delete_leave_type($id){
        $company_id=Session::get('company_id');
        $username=Session::get('username');
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $leave_name_arr = DB::connection('sqlsrv2')->table('leaves')->where('CompanyID','=',$company_id)->where('LeaveID','=', $id)->get();
        foreach ($leave_name_arr as $leave_name_arr1) {
           }
        $leave_name=$leave_name_arr1->LeaveType;

        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Delete Leave Type','Leave type '.$leave_name.' deleted', $update_date]);

        $result=DB::connection('sqlsrv2')->table('leaves')->where('LeaveID', $id)->delete();
        if($result) {
            $arr= DB::connection('sqlsrv2')->table("leaves")->where('CompanyID','=',$company_id)->orderBy('LeaveID','desc')->paginate(5);
            return request()->json(200,$arr);
        }
        
    }
  public function delete_holiday($id){
        $company_id=Session::get('company_id');
        $username=Session::get('username');
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");


        
        $holiday_name_arr = DB::connection('sqlsrv2')->table('Holiday')->where('CompanyID','=',$company_id)->where('HolidayID','=', $id)->get();
        foreach ($holiday_name_arr as $holiday_name_arr1) {
           }
        $holiday_name = $holiday_name_arr1->HolidayName;

        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Delete Holiay','Holiday '.$holiday_name.' deleted', $update_date]);
        

         $result=DB::connection('sqlsrv2')->table('Holiday')->where('CompanyID','=',$company_id)->where('HolidayID', $id)->delete();

         
         if($result) {
        $arr= DB::connection('sqlsrv2')->table("Holiday")->where('CompanyID','=',$company_id)->orderBy('HolidayID','desc')->paginate(5);
        
        return request()->json(200,$arr);
        }
    }
    public function getattendance_report9($department,$location,$designation,$start,$close){
        
        $company_id=Session::get('company_id');

        if($designation=='All'&& $department=='All'&& $location=='All'){
          $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('AttData', 'Emp_Profile.EmployeeID', '=', 'AttData.EmpID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('AttData.EmpID', 'desc')->select('Emp_Profile.Name','AttData.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('AttData.CompanyID','=',$company_id)->where('AttData.ATTDate', '>=', $start)->where('AttData.ATTDate', '<=', $close)->get();
          return request()->json(200,$arr);
        }
        else {
           if($department=='All'){
            $department='';
          }
          if($designation=='All'){
            $designation='';
          }
          if($location=='All'){
            $location='';
          }
          
           $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('AttData', 'Emp_Profile.EmployeeID', '=', 'AttData.EmpID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('AttData.EmpID', 'desc')->select('Emp_Profile.Name','AttData.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('AttData.CompanyID','=',$company_id)->where('AttData.ATTDate', '>=', $start)->where('AttData.ATTDate', '<=', $close)->where('Emp_Register.Department','like','%'.$department.'%')->where('Emp_Register.Designation','like','%'.$designation.'%')->where('Emp_Register.PostingCity','like','%'.$location.'%')->get();
          return request()->json(200,$arr);
        }
      }
      public function update_ind_att(Request $request){
        $att_id=$request->get('att_id');
        $check_in=$request->get('check_in');
        $check_out=$request->get('check_out');
        $company_id=Session::get('company_id');
        $username=Session::get('username');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
        $arr= DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)->where('AttDataID','=',$att_id)->get();
        foreach($arr as $arr1){
            }
        if($check_in<$arr1->OpeningTime && $check_out>$arr1->ClosingTime)
        {
            $att_status='P';
        }
        elseif($check_in>$arr1->OpeningTime || $check_out<$arr1->ClosingTime) {
            $att_status='L';
        }
     
        $result=  DB::connection('sqlsrv2')->update('update AttData set CheckIN=?,CheckOut=?,AttStatus=?,UpdatedBy=? where AttDataID=?',[$check_in.':00.0000000',$check_out.':00.0000000',$att_status,$username,$att_id]);
        $message="submitted";

        $UserFullName=Session::get('UserName');
        $emp_id_arr= DB::connection('sqlsrv2')->table('AttData')->select('EmpID')->where('CompanyID','=',$company_id)->where('AttDataID','=',$att_id)->get();
        foreach ($emp_id_arr as $emp_id_arr1) {
              # code...
            }
        $emp_id = $emp_id_arr1->EmpID;
        $full_name_arr= DB::connection('sqlsrv2')->table('Emp_Profile')->select('Name')->where('EmployeeID', '=', $emp_id)->get();
        foreach ($full_name_arr as $full_name_arr1) {
              # code...
            }
        $full_name = $full_name_arr1->Name;
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Attendace Updated','Attendace of '.$full_name.' updated', $update_date]);

        return request()->json(200,$message);
    }
      public function search_att(Request $request){
 $company_id = Session::get('company_id');
 $find_session =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->get();
      foreach ($find_session as $find_session1) {
       
           }
            $s_date=$find_session1->StartDate;
      $e_date=$find_session1->EndDate;

  $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('AttData', 'Emp_Profile.EmployeeID', '=', 'AttData.EmpID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('AttData.EmpID', 'desc')->select('Emp_Profile.Name','AttData.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('AttData.CompanyID','=',$company_id)->where('AttData.ATTDate', '>=', $s_date)->where('AttData.ATTDate', '<=', $e_date)->where('Emp_Profile.Name', 'LIKE', '%'.$request->keyword1.'%')->orwhere('Emp_Register.EmployeeCode', 'LIKE', '%'.$request->keyword1.'%')->get();
          return request()->json(200,$arr);
       
        
       
        }
        public function get_count_leave(){
          $company_id = Session::get('company_id');
 $find_session =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->get();
      foreach ($find_session as $find_session1) {
       
           }
            $s_date=$find_session1->StartDate;
      $e_date=$find_session1->EndDate;
       $sick=DB::connection('sqlsrv2')->table('leave_Requisition')->where('CompanyID','=',$company_id)->where('Leavetype','=','Sick')->where('StartDate', '>=', $s_date)->where('StartDate', '<=', $e_date)->count();
       $casual=DB::connection('sqlsrv2')->table('leave_Requisition')->where('CompanyID','=',$company_id)->where('Leavetype','=','Casual')->where('StartDate', '>=', $s_date)->where('StartDate', '<=', $e_date)->count();
       $annual=DB::connection('sqlsrv2')->table('leave_Requisition')->where('CompanyID','=',$company_id)->where('Leavetype','=','Annual')->where('StartDate', '>=', $s_date)->where('StartDate', '<=', $e_date)->count();

       $myJSON =array(
      '0' => $sick,
      '1' => $casual,
      '2' => $annual,
      );
         return request()->json(200,$myJSON);
        }
  public function get_payroll_att_detail()
  {
       $company_id = Session::get('company_id');
 $find_session =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->get();
      foreach ($find_session as $find_session1) {
       
           }
            $s_date=$find_session1->StartDate;
      $e_date=$find_session1->EndDate;



    $result=DB::connection('sqlsrv2')->select("SET NOCOUNT ON ;EXEC  [dbo].[Get_TotalReport]  N'".$s_date."', N'".$e_date."' ");

      //$result=DB::connection('sqlsrv2')->select("SET NOCOUNT ON ;EXEC  [dbo].[Get_TotalReport]' 2022-05-21','2022-06-20'");
    
     return request()->json(200,$result);
        }
        public function get_count_dailyatt(){
          $company_id = Session::get('company_id');
      date_default_timezone_set("Asia/Karachi");
      $update_date=date("Y-m-d");


       $total=DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)->where('ATTDate', '=',$update_date)->count();
       $present=DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)->where('ATTDate', '=',$update_date)->where('AttStatus', '=','P')->count();
       $absent=DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)->where('ATTDate', '=',$update_date)->where('AttStatus', '=','A')->count();
       $late=DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)->where('ATTDate', '=',$update_date)->where('AttStatus', '=','L')->count();

       $myJSON =array(
      'total' => $total,
      'present' => $present,
      'absent' => $absent,
      'late'=>$late,
      );
         return request()->json(200,$myJSON);
        }

        public function count_hiring_d(){
          $company_id = Session::get('company_id');
      date_default_timezone_set("Asia/Karachi");
      $year=date("Y");
       //$count=DB::connection('sqlsrv2')->select("SELECT   COUNT(*) as num FROM      Emp_Register WHERE     YEAR(JoiningDate) = '2022' GROUP BY  MONTH(JoiningDate)");
       $jan  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate','like',$year.'-01-%')->count();
        $feb  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate','like',$year.'-02-%')->count();
        $mar  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate','like',$year.'-03-%')->count();
        $april  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate','like',$year.'-04-%')->count();
        $may  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate','like',$year.'-05-%')->count();
        $june  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate','like',$year.'-06-%')->count();
        $july  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate','like',$year.'-07-%')->count();
        $aug  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate','like',$year.'-08-%')->count();
        $sept  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate','like',$year.'-09-%')->count();
        $oct  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate','like',$year.'-10-%')->count();
        $nov  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate','like',$year.'-11-%')->count();
        $dec  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('JoiningDate','like',$year.'-12-%')->count();
        $myJSON =array(
      '0' => $jan,
      '1' => $feb,
      '2'=>$mar,
      '3'=>$april,
      '4'=>$may,
      '5'=>$june,
      '6'=>$july,
      '7'=>$aug,
      '8'=>$sept,
      '9'=>$oct,
      '10'=>$nov,
      '11'=>$dec,
      );
      return request()->json(200,$myJSON);
       
        }
        public function count_firing_d(){
          $company_id = Session::get('company_id');
      date_default_timezone_set("Asia/Karachi");
      $year=date("Y");
       //$count=DB::connection('sqlsrv2')->select("SELECT   COUNT(*) as num FROM      Emp_Register WHERE     YEAR(JoiningDate) = '2022' GROUP BY  MONTH(JoiningDate)");
       $jan  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('RegDate','like',$year.'-01-%')->count();
        $feb  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('RegDate','like',$year.'-02-%')->count();
        $mar  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('RegDate','like',$year.'-03-%')->count();
        $april  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('RegDate','like',$year.'-04-%')->count();
        $may  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('RegDate','like',$year.'-05-%')->count();
        $june  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('RegDate','like',$year.'-06-%')->count();
        $july  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('RegDate','like',$year.'-07-%')->count();
        $aug  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('RegDate','like',$year.'-08-%')->count();
        $sept  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('RegDate','like',$year.'-09-%')->count();
        $oct  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('RegDate','like',$year.'-10-%')->count();
        $nov  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('RegDate','like',$year.'-11-%')->count();
        $dec  =DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('RegDate','like',$year.'-12-%')->count();
        $myJSON =array(
      '0' => $jan,
      '1' => $feb,
      '2'=>$mar,
      '3'=>$april,
      '4'=>$may,
      '5'=>$june,
      '6'=>$july,
      '7'=>$aug,
      '8'=>$sept,
      '9'=>$oct,
      '10'=>$nov,
      '11'=>$dec,
      );
      return request()->json(200,$myJSON);
       
        }
        public function overall_cities(){
           $company=DB::connection('sqlsrv2')->table('cities')->get();
            return request()->json(200,$company);
        }


         public function cnt_tl_emp(){
        $company_id = Session::get('company_id');
        $emp_detail =DB::connection('sqlsrv2')
        ->table('Emp_Register')
        ->where('CompanyID','=',$company_id)
        ->orderBy('EmployeeID', 'ASC')
        ->get();
       $ct_emp_detail=Count($emp_detail);
        return response()->json($ct_emp_detail); 
        }

         //Get my Attendace
    public function all_attendence(){
        $company_id= Session::get('company_id');
        $attandance = DB::connection('sqlsrv2')->table('AttData')
        ->where('CompanyID','=',$company_id)->get();
        return request()->json(200,$attandance);
    }

    //get this user attendence
    public function this_user_attendence(){
        $company_id= Session::get('company_id');


        $find_session =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->get();
           foreach ($find_session as $find_session1) {}
           $s_date=$find_session1->StartDate;
           $e_date=$find_session1->EndDate;


        $emp_id= Session::get('employee_id');
        $this_att=DB::connection('sqlsrv2')->table('AttData')
        ->orderBy('ATTDate','asc')
        ->select('AttData.*')
        ->where('CompanyID','=',$company_id)

        ->where('ATTDate','>',$s_date)
        ->where('ATTDate','<',$e_date)

        ->where('EmpID','=',$emp_id)->get();
        return request()->json(200,$this_att);
    }

    //Count current month attendence details
    public function m_att_dtl_ct(){
        $company_id= Session::get('company_id');
        $emp_id= Session::get('employee_id');
        date_default_timezone_set("Asia/Karachi");
        $this_m=date("m");
        
        $find_session =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->get();
           foreach ($find_session as $find_session1) {}
           $s_date=$find_session1->StartDate;
           $e_date=$find_session1->EndDate;

           //Late count
        $this_l=DB::connection('sqlsrv2')->table('AttData')
        ->orderBy('ATTDate','asc')
        ->select('AttData.*')
        ->whereMonth('ATTDate','=', $this_m)
        ->where('CompanyID','=',$company_id)->where('EmpID','=',$emp_id)
        
        ->where('ATTDate','>=',$s_date)
        ->where('ATTDate','<=',$e_date)

        ->where('AttStatus','=','L')->get();
        $l_ct=Count($this_l);
        
        $this_p=DB::connection('sqlsrv2')->table('AttData')
        ->orderBy('ATTDate','asc')
        ->select('AttData.*')
        ->whereMonth('ATTDate','=', $this_m)
        ->where('CompanyID','=',$company_id)->where('EmpID','=',$emp_id)
        
        ->where('ATTDate','>',$s_date)
        ->where('ATTDate','<',$e_date)

        ->where('AttStatus','=','P')->get();
        $p_ct=Count($this_p);

        $this_a=DB::connection('sqlsrv2')
        ->table('AttData')
        ->orderBy('ATTDate','asc')->select('AttData.*')
        ->whereMonth('ATTDate','=', $this_m)
        ->where('CompanyID','=',$company_id)
        
        ->where('ATTDate','>',$s_date)
        ->where('ATTDate','<',$e_date)

        ->where('EmpID','=',$emp_id)
        ->where('AttStatus','=','A')->get();
        $a_ct=Count($this_a);
        

        $t_dys="30";

        $att_ct_arr=array(
        'totalDays' => $t_dys,
        'present' => $p_ct,
        'absent' => $a_ct,
        'late' => $l_ct,
       );
        return request()->json(200,$att_ct_arr);
    }
    
    
     //Get leaves details
    public function m_lv_dtl(){
        $company_id = Session::get('company_id');
        $emp_id= Session::get('employee_id');
        
        $this_m_lvs=DB::connection('sqlsrv2')
        ->table('leave_Requisition')->select('leave_Requisition.*')
        ->where('EmployeeID','=', $emp_id)
        ->where('CompanyID','=',$company_id)->get();
        return request()->json(200,$this_m_lvs);
    }
    //Add ind Leave
     public function leave_request_fn(Request $request)
    {
        $company_id = Session::get('company_id');

        $username=Session::get('username');
        $emp_id= Session::get('employee_id');
        $type = $request->get('type');
        $d_from = $request->get('d_from');
        $d_from = $request->get('d_from');
        $d_to = $request->get('d_to');
        $reason = $request->get('reason');
        $selecteddays = $request->get('days');
        $pl_status = "P";

         //count days of multiple days leave
        if($selecteddays == "Multiple Days"){
            $days1 = strtotime($d_to) - strtotime($d_from);
            $n_oDays = ($days1/(60*60*24))+1;
        }
        else if($selecteddays == "One Day"){
            $n_oDays = "1";
            $d_to = null;
        }

        if($type!="UnPaid"){
              $rem_levs= DB::connection('sqlsrv2')->table('EmpLeave')->where('CompanyID','=',$company_id)
              ->where('EmployeeID','=', $emp_id)->where('LeaveType','=', $type)->sum('RemainingLeave');

               if( ($n_oDays > $rem_levs))
              {
                  $pl_status = "OL";
              }
              else
              {
                  $pl_status = "P";
              }
         }

        DB::connection('sqlsrv2')->insert('INSERT INTO leave_Requisition(EmployeeID, Leavetype, StartDate, EndDate, NoOfDays, Reason, PendingLeaveStatus, AppliedBy, CompanyID) values (?,?,?,?,?,?,?,?,?)', [$emp_id, $type, $d_from, $d_to, $n_oDays, $reason, $pl_status, $username, $company_id]);
        $data="Leave Applied Successfully!";
        
        return request()->json(200,$data);
    }


    //View logged-in employee detail
    public function view_profile(){
        $company_id= Session::get('company_id');
        $emp_id= Session::get('employee_id');
        $username=Session::get('username');

        $this_emp=DB::connection('sqlsrv2')->table('Emp_Register')
        ->join('Emp_Profile', 'Emp_Register.EmployeeID', '=', 'Emp_Profile.EmployeeID')
        ->join('Employee_Qualification', 'Emp_Profile.EmployeeID', '=', 'Employee_Qualification.EmployeeID')
        ->orderBy('Emp_Register.EmployeeID')
        ->select('Emp_Register.*', 'Emp_Profile.*','Employee_Qualification.*')
        ->where('Emp_Register.CompanyID','=',$company_id)
        ->where('Emp_Register.EmployeeID','=',$emp_id)
        ->where('Employee_Qualification.EmployeeID','=',$emp_id)

        ->get();
        return request()->json(200,$this_emp);
    }
    
    //View logged-in employee qualification
    public function view_profile_qual(){
        $company_id= Session::get('company_id');
        $emp_id= Session::get('employee_id');

        $this_emp_qual=DB::connection('sqlsrv2')->table('Employee_Qualification')
        ->select('Employee_Qualification.*')
        ->where('CompanyID','=',$company_id)
        ->where('EmployeeID','=',$emp_id)->get();
        return request()->json(200,$this_emp_qual);
    }
//Get all team of logged in employee
    public function all_ind_team(){
        $company_id= Session::get('company_id');
        $emp_code= Session::get('employee_id');

        $team=DB::connection('sqlsrv2')->table('Emp_Register')
        ->join('Emp_Profile', 'Emp_Register.EmployeeID', '=', 'Emp_Profile.EmployeeID')
        ->orderBy('Emp_Register.EmployeeID','asc')
        ->select('Emp_Register.*', 'Emp_Profile.Name')
        ->where('Emp_Register.CompanyID','=',$company_id)
        ->where('Emp_Register.Status','=','Registered')
        ->where('Emp_Register.ReportingTo','=',$emp_code)->get();
        return request()->json(200,$team);
    }
    

      public function team_all_leaves(){
        $company_id=Session::get('company_id');
        $EmployeeID= Session::get('employee_id');

        $team_leaves = DB::connection('sqlsrv2')->table('leave_Requisition')
        ->join('Emp_Profile', 'leave_Requisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('leave_Requisition.EmployeeID', 'asc')
        ->select('leave_Requisition.*', 'Emp_Profile.*', 'Emp_Register.*')
        ->where('leave_Requisition.CompanyID','=',$company_id)
        ->where('Emp_Register.ReportingTo','=',$EmployeeID)->get();
        return request()->json(200, $team_leaves);
      }
    
    
   
//Mark team attandence
    public function mark_team_att(Request $request)
    {
        $company_id = Session::get('company_id');
        $username=Session::get('username');
        
        date_default_timezone_set("Asia/Karachi");
        $today=date("Y-m-d h:i:s A");

        $date= $request->get('date');
        $cin = $request->get('cin');
        $cout =  $request->get('cout');
        $emp_id = $request->get('cId');
        $AttStatus = $request->get('att_sts');

        $arr= DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)
        ->where('ATTDate','=',$date)->where('EmpID','=',$emp_id)->get();
          foreach($arr as $arr1){}

          if($cin<$arr1->OpeningTime && $cout>$arr1->ClosingTime)
          {
            $AttStatus='P';
          }
          elseif($cin>$arr1->OpeningTime || $cout<$arr1->ClosingTime) {
            $AttStatus='L';
          }

        DB::connection('sqlsrv2')->update('update AttData set CheckIN=?, CheckOut=?, UpdatedBy=?, AttStatus=? where EmpID=? AND ATTDate=? AND CompanyID=?', [$cin.':00.0000000', $cout.':00.0000000', $username, $AttStatus, $emp_id, $date, $company_id]);

        $data="Attendance marked";
        return request()->json(200,$data);
    }
   //view individule att detail
    public function ind_att_detail($id){
        $company_id= Session::get('company_id');
        $find_session =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->get();
        foreach ($find_session as $find_session1) {}
            $s_date=$find_session1->StartDate;
            $e_date=$find_session1->EndDate;

        $job=DB::connection('sqlsrv2')->table('AttData')
        ->where('CompanyID','=',$company_id)
        ->where('ATTDate','<=',$e_date)
        ->where('ATTDate','>=',$s_date)
        ->where('EmpID','=',$id)
        ->orderBy('ATTDate','desc')
        ->get();
        return request()->json(200,$job);
    }

    //fetch Attandence to edit
    public function fetch_att($id, $date){
        $company_id= Session::get('company_id');
        $cand = DB::connection('sqlsrv2')->table('AttData')
        ->select('AttDataID', 'CompanyID', 'ATTDate', 'CheckIN', 'CheckOut', 'AttStatus')
        ->where('AttData.CompanyID','=',$company_id)->where('AttData.EmpID','=', $id)->where('AttData.ATTDate','=', $date)->get();
        return request()->json(200,$cand);
    }


   //Update attandence
    public function update_attandence (Request $request)
    {
        $company_id= Session::get('company_id');
        $Aid = $request->get('Aid');
        $cin = $request->get('cin');
        $cout = $request->get('cout');
        $AttStatus = $request->get('att_sts');
        $date = $request->get('date');

        if($AttStatus=="A")
        {
            $cin = "Nill";
            $cout = "Nill";
        }
        else
        {
            $arr= DB::connection('sqlsrv2')->table('AttData')->where('CompanyID','=',$company_id)
            ->where('ATTDate','=',$date)->where('EmpID','=', $Aid)->get();
            foreach($arr as $arr1){}

            if($cin<$arr1->OpeningTime && $cout>$arr1->ClosingTime)
            {
                $AttStatus='P';
            }
            elseif($cin>$arr1->OpeningTime || $cout<$arr1->ClosingTime)
            {
                $AttStatus='L';
            }
        }
        DB::connection('sqlsrv2')->update('update AttData set CheckIN=?, CheckOut=?, AttStatus=? where EmpID=? AND ATTDate=? AND CompanyID=?', [$cin.':00.0000000', $cout.':00.0000000', $AttStatus, $Aid, $date, $company_id]);
        $data="Attendance updated Successfully!";
        return request()->json(200, $data);
    }

 //view individule name
    public function ind_name($id){
        $company_id= Session::get('company_id');
        $name=DB::connection('sqlsrv2')->table('Emp_Profile')
        ->select('Name')
        ->where('CompanyID','=',$company_id)
        ->where('EmployeeID','=',$id)
        ->get();
        foreach ($name as $name1) {}
         $name=$name1->Name;
        return request()->json(200, $name);
    }
    public function view_hr_configuration(){
      $company_id= Session::get('company_id');
        $cand=DB::connection('sqlsrv2')->table('HrCompanyConfig')->where('CompanyID','=',$company_id)->get();
        return request()->json(200,$cand);
    }
   public function submit_config(Request $request){
              $company_id= Session::get('company_id');
             $username=Session::get('username');
            $UserFullName=Session::get('UserName');
            date_default_timezone_set("Asia/Karachi");
            $update_date=date("Y-m-d h:i:s A");
            $gratuty_start= $request->get('gratuty_start');
             $max_loan= $request->get('max_loan');
             $days_deduction= $request->get('days_deduction');
             $max_installment= $request->get('max_installment');
             $annual_leaves= $request->get('annual_leaves');
             $sick_leaves= $request->get('sick_leaves');
             $casual_start= $request->get('casual_start');

        DB::connection('sqlsrv2')->update('update HrCompanyConfig set GratutyStart=?, MaxLoan=?,AnnualLeaves=?,SickLeaves=?,CasualLeaves=?,MinutesDeduction=?,MaxInstallment=? where CompanyID=?', [$gratuty_start,$max_loan,$annual_leaves,$sick_leaves,$casual_start,$days_deduction,$max_installment,$company_id]);


        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'HR configuration Update','HR configuration  updated', $update_date]);

        $data="udpaded!"; 
        return request()->json(200,$data);
    }

    public function overall_payroll_employees(){
       $company_id=Session::get('company_id');
       $arr =DB::connection('sqlsrv2')->table('Emp_Profile')
       ->join('PayrollEmployeesDetail', 'Emp_Profile.EmployeeID', '=', 'PayrollEmployeesDetail.EmployeeID')
       ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
       ->orderBy('PayrollEmployeesDetail.EmployeeID', 'desc')
       ->select('PayrollEmployeesDetail.Statusd', 'Emp_Profile.Name','Emp_Profile.Photo','PayrollEmployeesDetail.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')
       ->where('PayrollEmployeesDetail.CompanyID','=',$company_id)
       ->where('PayrollEmployeesDetail.Statusd','=','C')
       ->get();
       return request()->json(200,$arr);
    }
    public function fetch_emp_detail($id){
       $company_id=Session::get('company_id');
       $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollEmployeesDetail', 'Emp_Profile.EmployeeID', '=', 'PayrollEmployeesDetail.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollEmployeesDetail.EmployeeID', 'desc')->select('Emp_Profile.Name','Emp_Profile.Photo','PayrollEmployeesDetail.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('PayrollEmployeesDetail.CompanyID','=',$company_id)->where('PayrollEmployeesDetail.Statusd','=','C')->where('PayrollEmployeesDetail.EmployeeID','=',$id)->get(); 
        return request()->json(200,$arr);

    }
    public function submit_payroll_detail(Request $request){
       $company_id= Session::get('company_id');
     
       $p_emp_id= $request->get('p_emp_id');
       $p_last_salary= $request->get('p_last_salary');
       $p_current_salary= intval($request->get('p_current_salary'));
       $p_current_day= intval($request->get('p_current_day'));
       $p_current_hour= intval($request->get('p_current_hour'));
       $p_current_remarks= $request->get('p_current_remarks');

       $current_increment=$p_current_salary-$p_last_salary;
 date_default_timezone_set("Asia/Karachi");
      $update_date=date("Y-m-d");
       $username=Session::get('username'); 
       DB::connection('sqlsrv2')->update('update PayrollEmployeesDetail set Statusd=? where CompanyID=? and EmployeeID=? and Statusd=?', ['O',$company_id,$p_emp_id,'C']);

      $result= DB::connection('sqlsrv2')->insert('INSERT INTO PayrollEmployeesDetail(CompanyID,EmployeeID,UpdatedSalary,UpdatedPerDay,UpdatedPerHours,UpdatedDate,Statusd,Remarks,UpdatedBy,UpdatedOn,LastIncrement) values (?,?,?,?,?,?,?,?,?,?,?)', [$company_id,$p_emp_id,$p_current_salary,$p_current_day,$p_current_hour,$update_date,'C',$p_current_remarks,$username,$update_date,$current_increment]);

      if($result){
        DB::connection('sqlsrv2')->update('update Emp_Register set Salary=? where CompanyID=? and EmployeeID=?', [$p_current_salary,$company_id,$p_emp_id]);



         $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollEmployeesDetail', 'Emp_Profile.EmployeeID', '=', 'PayrollEmployeesDetail.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollEmployeesDetail.EmployeeID', 'desc')->select('Emp_Profile.Name','Emp_Profile.Photo','PayrollEmployeesDetail.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('PayrollEmployeesDetail.CompanyID','=',$company_id)->where('PayrollEmployeesDetail.Statusd','=','C')->paginate(20); 
        return request()->json(200,$arr);

      }

    }
    public function filter_employees($emp_id,$department,$location,$designation){
      $company_id= Session::get('company_id');
       if($department=='All'){
            $department='';
          }
          if($designation=='All'){
            $designation='';
          }
          if($location=='All'){
            $location='';
          }
           if($emp_id=='All'){
            $emp_id='';
          }
          $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollEmployeesDetail', 'Emp_Profile.EmployeeID', '=', 'PayrollEmployeesDetail.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollEmployeesDetail.EmployeeID', 'desc')->select('Emp_Profile.Name','Emp_Profile.Photo','PayrollEmployeesDetail.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('PayrollEmployeesDetail.CompanyID','=',$company_id)->where('PayrollEmployeesDetail.Statusd','=','C')->where('Emp_Register.Department','like','%'.$department.'%')->where('Emp_Register.Designation','like','%'.$designation.'%')->where('Emp_Register.PostingCity','like','%'.$location.'%')->where('PayrollEmployeesDetail.EmployeeID','like','%'.$emp_id.'%')->paginate(20); 
        return request()->json(200,$arr);
    }
    public function update_payroll_status($id){
 $company_id=Session::get('company_id');
 $result2=  DB::connection('sqlsrv2')->update('update HrSessions set AttClosedPayrollStart=? where SessionID=? and CompanyID=?',['Closed',$id,$company_id]);
      $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
      foreach ($find_session_closed as $find_session1) {
       
           }
            $sesson_name=$find_session1->SessionName;
             $s_date=$find_session1->StartDate;
            $e_date=$find_session1->EndDate;
       
       
      
      
      $result=DB::connection('sqlsrv2')->select("SET NOCOUNT ON insert into [dbo].[SessionReport] (CompanyID,EmployeeID,EmployeeCode,Name,Designation,Department,Totaldays,TotalPeresnt,TotalAbsent,TotalLeave,GracePeriod,
OverTime,Deduction,Salary,SessionName,OAmount,DAmount,TAmount,DStatus)
EXEC   [dbo].[Get_TotalReport_Session]
    @session = N'".$sesson_name."',
    @startdate = '".$s_date."',
    @enddate = '".$e_date."' ");

   //$result2=DB::connection('sqlsrv2')->select(" ");
 $arr= DB::connection('sqlsrv2')->table("HrSessions")->where('CompanyID','=',$company_id)->orderBy('SessionID','desc')->paginate(5);
        return request()->json(200,$arr);
     


    }
    public function fetch_payroll_generation(){
       $company_id=Session::get('company_id');
      $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
      foreach ($find_session_closed as $find_session1) {
       
           }
            $sesson_name=$find_session1->SessionName;

        $result=DB::connection('sqlsrv2')->table('SessionReport')->where('CompanyID','=',$company_id)->where('SessionName','=',$sesson_name)->orderBy('Department','ASC')->get();     
      return request()->json(200,$result);
    }

    public function getpayroll_gen_report($emp_id,$department,$designation,$status){
       $company_id=Session::get('company_id');
      $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
      foreach ($find_session_closed as $find_session1) {
       
           }
            $sesson_name=$find_session1->SessionName;

if($emp_id=='All' && $department=='All' && $designation=='All'){
  $result=DB::connection('sqlsrv2')->table('SessionReport')->where('CompanyID','=',$company_id)->where('SessionName','=',$sesson_name)->orderBy('Department','ASC')->get();
    return request()->json(200,$result);
}
else {
 if($emp_id=='All'){
              $emp_id='';
            }
            if($department=='All'){
              $department='';
            }
             if($designation=='All'){
              $department='';
            }
             if($status=='All'){
              $status='';
            }


        $result=DB::connection('sqlsrv2')->table('SessionReport')->where('CompanyID','=',$company_id)->where('SessionName','=',$sesson_name)->where('EmployeeID','LIKE', '%'.$emp_id.'%')->where('Department','LIKE', '%'.$department.'%')->where('Designation','LIKE', '%'.$designation.'%')->where('DStatus','LIKE', '%'.$status.'%')->get(); 
         return request()->json(200,$result);
}


           

    }
     public function search_payroll(Request $request){
 $company_id=Session::get('company_id');
      $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
      foreach ($find_session_closed as $find_session1) {
       
           }
            $sesson_name=$find_session1->SessionName;

  
   $result=DB::connection('sqlsrv2')->table('SessionReport')->where('CompanyID','=',$company_id)->where('SessionName','=',$sesson_name)->where('Name', 'LIKE', '%'.$request->keyword1.'%')->orwhere('EmployeeCode', 'LIKE', '%'.$request->keyword1.'%')->get();

  
          return request()->json(200,$result);
       
        
       
        }
        public function find_session(){
          $company_id=Session::get('company_id');
      $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
      foreach ($find_session_closed as $find_session1) {
       
           }
            $sesson_name=$find_session1->SessionName;
             return request()->json(200,$sesson_name);
        }
        public function find_payroll_emp($id){
          $company_id=Session::get('company_id');
           $find_payroll_e =DB::connection('sqlsrv2')->table('SessionReport')->where('CompanyID','=',$company_id)->where('SessionReportID','=',$id)->get();
             return request()->json(200,$find_payroll_e);
        }

        
        public function update_payroll_ind_status(Request $request){
            $company_id=Session::get('company_id');
            $m_session_reportID=$request->get('m_session_reportID');
            $m_deduction=$request->get('m_deduction');
            $m_overtime=$request->get('m_overtime');
            $m_salary_status=$request->get('m_salary_status');
              
              $find_salary=DB::connection('sqlsrv2')->table('SessionReport')->where('CompanyID','=',$company_id)->where('SessionReportID','=',$m_session_reportID)->get();
               foreach ($find_salary as $find_salary1) {
                 # code...
               }
               $m_salary=$find_salary1->Salary;
             $damount=$m_deduction*( $m_salary/30 );
             $perday=$m_salary/30;
             $perhour=$perday/8;
             $permint=$perhour/60;
             $oamount=round($m_overtime*$permint);

             $tpayable=$m_salary+$oamount+$damount;

              $username=Session::get('username'); 
              
             $result=DB::connection('sqlsrv2')->update('update SessionReport set Deduction=?,OverTime=?,OAmount=?,DAmount=?,TAmount=?,UpdatedBy=?,DStatus=?  where SessionReportID=? and CompanyID=?',[$m_deduction,$m_overtime,$oamount,$damount,$tpayable,$username,$m_salary_status,$m_session_reportID,$company_id]);

             $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
            foreach ($find_session_closed as $find_session1) {
       
           }
          $sesson_name=$find_session1->SessionName;

        $result1=DB::connection('sqlsrv2')->table('SessionReport')->where('CompanyID','=',$company_id)->where('SessionName','=',$sesson_name)->orderBy('Department','ASC')->get();     
      
      return request()->json(200,$result1);
         }

        
         public function proceedhrapproval(){
        $company_id=Session::get('company_id');
        
        $username=Session::get('username'); 
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
        foreach ($find_session_closed as $find_session1) {      
        }
        $sesson_name=$find_session1->SessionName;
 
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Salaries moved', 'Salaries of session '.$sesson_name.' moved for HR Manager approval', $update_date]);

        $result=DB::connection('sqlsrv2')->select("SET NOCOUNT ON INSERT INTO PayrollHrApproval(EmployeeID,CompanyID,SessionName,OverTime,Deduction,Salary,OAmount,DAmount,TAmount,DStatus,HrStatus)
        SELECT EmployeeID,CompanyID,SessionName,OverTime,Deduction,Salary,OAmount,DAmount,TAmount,DStatus,'P' FROM SessionReport WHERE CompanyID='".$company_id."' AND DStatus='P' AND SessionName='".$sesson_name."'
        Delete FROM SessionReport WHERE CompanyID='".$company_id."'  AND DStatus='P' AND SessionName='".$sesson_name."'");
        $result1="submitted";

        return request()->json(200, $result1);
    }
           public function search_hr_approval(Request $request){
 $company_id=Session::get('company_id');
      $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
      foreach ($find_session_closed as $find_session1) {
       
           }
            $sesson_name=$find_session1->SessionName;
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollHrApproval', 'Emp_Profile.EmployeeID', '=', 'PayrollHrApproval.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.Department', 'Desc')->select('Emp_Profile.Name','Emp_Profile.Photo','PayrollHrApproval.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('PayrollHrApproval.CompanyID','=',$company_id)->where('PayrollHrApproval.SessionName','=',$sesson_name)->where('Name', 'LIKE', '%'.$request->keyword1.'%')->orwhere('EmployeeCode', 'LIKE', '%'.$request->keyword1.'%')->get();
          
      return request()->json(200,$arr);
        
        
       
         }
       
         public function fetch_payroll_hr_approval(){
       $company_id=Session::get('company_id');
      $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
      foreach ($find_session_closed as $find_session1) {
       
           }
            $sesson_name=$find_session1->SessionName;
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollHrApproval', 'Emp_Profile.EmployeeID', '=', 'PayrollHrApproval.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.Department', 'Desc')->select('Emp_Profile.Name','Emp_Profile.Photo','PayrollHrApproval.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('PayrollHrApproval.CompanyID','=',$company_id)->where('PayrollHrApproval.SessionName','=',$sesson_name)->get();
          
      return request()->json(200,$arr);
    }
      public function find_payroll_emp_hrapproval($id){
          $company_id=Session::get('company_id');
           $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollHrApproval', 'Emp_Profile.EmployeeID', '=', 'PayrollHrApproval.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.Department', 'Desc')->select('Emp_Profile.Name','Emp_Profile.Photo','PayrollHrApproval.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')->where('PayrollHrApproval.CompanyID','=',$company_id)->where('PayrollHrApproval.ApprovalID','=',$id)->get();
         
             return request()->json(200,$arr);
        }
       

 public function proceedfinanceapproval(){
        $company_id = Session::get('company_id');
        $username=Session::get('username'); 
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $find_session_closed = DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
        foreach ($find_session_closed as $find_session1) {
        }
        $sesson_name=$find_session1->SessionName;
        
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Salaries moved', 'Salaries of session '.$sesson_name.' moved for Finance approval', $update_date]);

        $result=DB::connection('sqlsrv2')->select("SET NOCOUNT ON INSERT INTO PayrollFinanceApproval(EmployeeID, CompanyID, SessionName, Salary, OAmount, DAmount, TAmount, InstallmentNo, InstallmentAmount, PayableSalary, DStatus, HrStatus, FStatus) SELECT EmployeeID,CompanyID,SessionName,Salary,OAmount,DAmount,TAmount,'','','',DStatus,HrStatus,'P' FROM PayrollHrApproval WHERE CompanyID='".$company_id."' AND HrStatus='P' AND SessionName='".$sesson_name."'
        Delete FROM PayrollHrApproval WHERE CompanyID='".$company_id."'  AND HrStatus='P' AND SessionName='".$sesson_name."'");
        
        $result1 = "submitted";
        return request()->json(200, $result1);
    }

      public function chech_installments(){
           $company_id=Session::get('company_id');
          $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
            foreach ($find_session_closed as $find_session1) {
       
           }
          $sesson_name=$find_session1->SessionName;

           $result =DB::connection('sqlsrv2')->table('PayrollFinanceApproval')->where('CompanyID','=',$company_id)->where('SessionName','=',$sesson_name)->get();
           foreach ($result as $result1) {
              $employee_id=$result1->EmployeeID;
              $ses_name=$result1->SessionName;
              $tpayable=$result1->TAmount;

              $find_inst=DB::connection('sqlsrv2')->table('LoanDetail')->where('CompanyID','=',$company_id)->where('InstallmentSession','=',$ses_name)->where('EmployeeID','=',$employee_id)->exists();
              if($find_inst){
                $find_inst2=DB::connection('sqlsrv2')->table('LoanDetail')->where('CompanyID','=',$company_id)->where('InstallmentStatus','=','Unpaid')->where('InstallmentSession','=',$ses_name)->where('EmployeeID','=',$employee_id)->get();
                foreach ($find_inst2 as $find_inst21) {
                  # code...
                }
              
                DB::connection('sqlsrv2')->update('update PayrollFinanceApproval set InstallmentNo=?, InstallmentAmount=? where CompanyID=? and EmployeeID=? and SessionName=?', [$find_inst21->InstallmentNo,$find_inst21->InstallmentAmount,$company_id,$employee_id,$ses_name]);

              }


               $find_fine=DB::connection('sqlsrv2')->table('FineDetail')->where('CompanyID','=',$company_id)->where('FineSession','=',$ses_name)->where('EmployeeID','=',$employee_id)->exists();

               if($find_fine){
                $find_fine9=DB::connection('sqlsrv2')->table('FineDetail')->where('CompanyID','=',$company_id)->where('FineSession','=',$ses_name)->where('EmployeeID','=',$employee_id)->sum('FineAmount');
                // foreach ($find_fine9 as $find_fine91) {
                //   # code...
                // }  

              DB::connection('sqlsrv2')->update('update PayrollFinanceApproval set Fine=? where CompanyID=? and EmployeeID=? and SessionName=?', [$find_fine9,$company_id,$employee_id,$ses_name]);
                }

                $find_dues=DB::connection('sqlsrv2')->table('PayrollDues')->where('CompanyID','=',$company_id)->where('SessionName','=',$ses_name)->where('EmployeeID','=',$employee_id)->where('Status','=','Approved')->exists();

               if($find_dues){
                $find_dues9=DB::connection('sqlsrv2')->table('PayrollDues')->where('CompanyID','=',$company_id)->where('SessionName','=',$ses_name)->where('EmployeeID','=',$employee_id)->where('Status','=','Approved')->sum('DuesAmount');
                // foreach ($find_dues9 as $find_dues91) {
                //   # code...
                // }  
              DB::connection('sqlsrv2')->update('update PayrollFinanceApproval set DuesAmount=? where CompanyID=? and EmployeeID=? and SessionName=?', [$find_dues9,$company_id,$employee_id,$ses_name]);
                }



           }



            $result55 =DB::connection('sqlsrv2')->table('PayrollFinanceApproval')->where('CompanyID','=',$company_id)->where('SessionName','=',$sesson_name)->get();
           foreach ($result55 as $result551) {
              $employee_id5=$result551->EmployeeID;
              $ses_name5=$result551->SessionName;
              $tpayable5=$result551->TAmount;
              $installment5=$result551->InstallmentAmount;
              $fine5=$result551->Fine;
              $dues5=$result551->DuesAmount;
              $arrearsAmount5=$result551->ArrearsAmount;
              $bonus5=$result551->BonusAmount;
              $allowance5=$result551->AllowanceAmount;
              
              $total_deduction=$installment5+$fine5+$dues5;
              $total_arrears=$arrearsAmount5+$bonus5+$allowance5;
              $salary_payable5=$tpayable5+$total_arrears-$total_deduction;

              DB::connection('sqlsrv2')->update('update PayrollFinanceApproval set PayableSalary=? where CompanyID=? and EmployeeID=? and SessionName=?', [$salary_payable5,$company_id,$employee_id5,$ses_name5]);

            }



  $username = Session::get('username'); 
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Salaries processed', 'Fine and Installments deductions applied on salaries of session '.$sesson_name , $update_date]);
       
  $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollFinanceApproval', 'Emp_Profile.EmployeeID', '=', 'PayrollFinanceApproval.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.Department', 'Desc')->select('Emp_Profile.Name','Emp_Profile.Photo','PayrollFinanceApproval.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.MethodType')->where('PayrollFinanceApproval.CompanyID','=',$company_id)->where('PayrollFinanceApproval.SessionName','=',$sesson_name)->get();
          
      return request()->json(200,$arr);





      }

public function allowance_arrears(){
           $company_id=Session::get('company_id');
          $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
            foreach ($find_session_closed as $find_session1) {
       
           }
          $sesson_name=$find_session1->SessionName;

           $result =DB::connection('sqlsrv2')->table('PayrollFinanceApproval')->where('CompanyID','=',$company_id)->where('SessionName','=',$sesson_name)->get();
           foreach ($result as $result1) {
              $employee_id=$result1->EmployeeID;
              $ses_name=$result1->SessionName;
              $tpayable=$result1->TAmount;

              $find_arrear=DB::connection('sqlsrv2')->table('PayrollArrears')->where('CompanyID','=',$company_id)->where('SessionName','=',$ses_name)->where('EmployeeID','=',$employee_id)->where('Status','=','Approved')->exists();
              if($find_arrear){
                $find_arrear2=DB::connection('sqlsrv2')->table('PayrollArrears')->where('CompanyID','=',$company_id)->where('SessionName','=',$ses_name)->where('EmployeeID','=',$employee_id)->where('Status','=','Approved')->sum('ArrearsAmount');
              
              
                DB::connection('sqlsrv2')->update('update PayrollFinanceApproval set ArrearsAmount=? where CompanyID=? and EmployeeID=? and SessionName=?', [$find_arrear2,$company_id,$employee_id,$ses_name]);

              }


               $find_bonus=DB::connection('sqlsrv2')->table('PayrollBonuses')->where('CompanyID','=',$company_id)->where('SessionName','=',$ses_name)->where('EmployeeID','=',$employee_id)->where('Status','=','Approved')->exists();

               if($find_bonus){
                $find_bonus9=DB::connection('sqlsrv2')->table('PayrollBonuses')->where('CompanyID','=',$company_id)->where('SessionName','=',$ses_name)->where('EmployeeID','=',$employee_id)->where('Status','=','Approved')->sum('BonusAmount');
                
              DB::connection('sqlsrv2')->update('update PayrollFinanceApproval set BonusAmount=? where CompanyID=? and EmployeeID=? and SessionName=?', [$find_bonus9,$company_id,$employee_id,$ses_name]);
                }

                date_default_timezone_set("Asia/Karachi");
                $current_date= date("Y-m-d");


                 $find_allowance=DB::connection('sqlsrv2')->table('PayrollAllowance')->where('CompanyID','=',$company_id)->where('SessionEndDate','<=',$current_date)->where('EmployeeID','=',$employee_id)->where('Status','=','Approved')->exists();

               if($find_allowance){
                $find_allowance9=DB::connection('sqlsrv2')->table('PayrollAllowance')->where('CompanyID','=',$company_id)->where('SessionEndDate','<=',$current_date)->where('EmployeeID','=',$employee_id)->where('Status','=','Approved')->sum('AllowanceAmount');
               
              DB::connection('sqlsrv2')->update('update PayrollFinanceApproval set AllowanceAmount=? where CompanyID=? and EmployeeID=? and SessionName=?', [$find_allowance9,$company_id,$employee_id,$ses_name]);
                }



           }
            $result55 =DB::connection('sqlsrv2')->table('PayrollFinanceApproval')->where('CompanyID','=',$company_id)->where('SessionName','=',$sesson_name)->get();
           foreach ($result55 as $result551) {
              $employee_id5=$result551->EmployeeID;
              $ses_name5=$result551->SessionName;
              $tpayable5=$result551->TAmount;
              $installment5=$result551->InstallmentAmount;
              $fine5=$result551->Fine;
              $dues5=$result551->DuesAmount;
              $arrearsAmount5=$result551->ArrearsAmount;
              $bonus5=$result551->BonusAmount;
              $allowance5=$result551->AllowanceAmount;
              
              $total_deduction=$installment5+$fine5+$dues5;
              $total_arrears=$arrearsAmount5+$bonus5+$allowance5;
              $salary_payable5=$tpayable5+$total_arrears-$total_deduction;

              DB::connection('sqlsrv2')->update('update PayrollFinanceApproval set PayableSalary=? where CompanyID=? and EmployeeID=? and SessionName=?', [$salary_payable5,$company_id,$employee_id5,$ses_name5]);

            }

             $username = Session::get('username'); 
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Salaries processed', 'Arrears and Allowances added in salaries of session '.$sesson_name , $update_date]);

  $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollFinanceApproval', 'Emp_Profile.EmployeeID', '=', 'PayrollFinanceApproval.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.Department', 'Desc')->select('Emp_Profile.Name','Emp_Profile.Photo','PayrollFinanceApproval.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.MethodType')->where('PayrollFinanceApproval.CompanyID','=',$company_id)->where('PayrollFinanceApproval.SessionName','=',$sesson_name)->get();
          
      return request()->json(200,$arr);

}

 public function fetch_payroll_finance_approval(){
       $company_id=Session::get('company_id');
      $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
      foreach ($find_session_closed as $find_session1) {
       
           }
            $sesson_name=$find_session1->SessionName;





            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollFinanceApproval', 'Emp_Profile.EmployeeID', '=', 'PayrollFinanceApproval.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.Department', 'Desc')->select('Emp_Profile.Name','Emp_Profile.Photo','PayrollFinanceApproval.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.MethodType')->where('PayrollFinanceApproval.CompanyID','=',$company_id)->where('PayrollFinanceApproval.SessionName','=',$sesson_name)->get();
          
      return request()->json(200,$arr);
    }
 public function search_finance_approval(Request $request){
 $company_id=Session::get('company_id');
      $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
      foreach ($find_session_closed as $find_session1) {
       
           }
            $sesson_name=$find_session1->SessionName;
           
          
      $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollFinanceApproval', 'Emp_Profile.EmployeeID', '=', 'PayrollFinanceApproval.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.Department', 'Desc')->select('Emp_Profile.Name','Emp_Profile.Photo','PayrollFinanceApproval.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.MethodType')->where('PayrollFinanceApproval.CompanyID','=',$company_id)->where('PayrollFinanceApproval.SessionName','=',$sesson_name)->where('Name', 'LIKE', '%'.$request->keyword1.'%')->orwhere('EmployeeCode', 'LIKE', '%'.$request->keyword1.'%')->get();
          
      return request()->json(200,$arr);
        
        
       
         }
public function find_payroll_emp_financeapproval($id){
          $company_id=Session::get('company_id');
           $arr = DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollFinanceApproval', 'Emp_Profile.EmployeeID', '=', 'PayrollFinanceApproval.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.Department', 'Desc')->select('Emp_Profile.Name','Emp_Profile.Photo','PayrollFinanceApproval.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.MethodType','Emp_Register.EmployeeCode')->where('PayrollFinanceApproval.CompanyID','=',$company_id)->where('PayrollFinanceApproval.FinanceApprovalID','=',$id)->get();
         
             return request()->json(200,$arr);
        }

 public function update_payroll_ind_status_hrapproval(Request $request){
        $company_id = Session::get('company_id');
        $username = Session::get('username'); 
        $UserFullName = Session::get('UserName');
        $m_ApprovalID = $request->get('m_ApprovalID');
        $m_salary_status = $request->get('m_salary_status');
        $m_name = $request->get('m_name');

        $result = DB::connection('sqlsrv2')->update('update PayrollHrApproval set HrStatus=?, UpdatedBy=?  where ApprovalID=? and CompanyID=?',[$m_salary_status, $username, $m_ApprovalID, $company_id]);

        $find_session_closed = DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
        foreach ($find_session_closed as $find_session1) {
        }
        $sesson_name = $find_session1->SessionName;
        $arr = DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollHrApproval', 'Emp_Profile.EmployeeID', '=', 'PayrollHrApproval.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.Department', 'Desc')->select('Emp_Profile.Name', 'Emp_Profile.Photo', 'PayrollHrApproval.*', 'Emp_Register.Department', 'Emp_Register.PostingCity', 'Emp_Register.Designation', 'Emp_Register.EmployeeCode')->where('PayrollHrApproval.CompanyID','=',$company_id)->where('PayrollHrApproval.SessionName', '=', $sesson_name)->get();

        if($m_salary_status=="P"){
            $m_salary_status = "Proceed";
        }
        else if($m_salary_status=="H"){
            $m_salary_status = "Hold";
        }
        $update_date=date("Y-m-d h:i:s A");
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Update Salary Detail', 'Salary status for HR manager approval of '.$m_name.' changed to '.$m_salary_status , $update_date]);
        
        return request()->json(200, $arr);
    }
     public function update_payroll_ind_status_financeapproval(Request $request){
        $company_id = Session::get('company_id');
        $username = Session::get('username'); 
        $UserFullName=Session::get('UserName');
        $m_ApprovalID = $request->get('m_ApprovalID');
        $m_salary_status = $request->get('m_salary_status');
        $m_name = $request->get('m_name');
        $result = DB::connection('sqlsrv2')->update('update PayrollFinanceApproval set FStatus=?,UpdatedBy=?  where FinanceApprovalID=? and CompanyID=?',[$m_salary_status,$username,$m_ApprovalID,$company_id]);

        $find_session_closed = DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
        foreach ($find_session_closed as $find_session1) {
        }
        $sesson_name=$find_session1->SessionName;
        $arr = DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollFinanceApproval', 'Emp_Profile.EmployeeID', '=', 'PayrollFinanceApproval.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.Department', 'Desc')->select('Emp_Profile.Name','Emp_Profile.Photo','PayrollFinanceApproval.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.MethodType')->where('PayrollFinanceApproval.CompanyID','=',$company_id)->where('PayrollFinanceApproval.SessionName','=',$sesson_name)->get();

        if($m_salary_status=="P"){
            $m_salary_status = "Proceed";
        }
        else if($m_salary_status=="H"){
            $m_salary_status = "Hold";
        }
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Update Salary Detail', 'Salary status for Finance manager approval of '.$m_name.' changed to '.$m_salary_status , $update_date]);
        
        return request()->json(200,$arr);
    }

        public function fetch_distribution_cash_payabale($department_name){
            $company_id=Session::get('company_id');
       $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
      foreach ($find_session_closed as $find_session1) {
       
           }
            $sesson_name=$find_session1->SessionName;
       
        $emp_detail=DB::connection('sqlsrv2')->table('Payroll_Distribution')->where('CompanyID','=',$company_id)->where('Department','=',$department_name)->where('MethodType','=','Cash')->where('SessionName','=',$sesson_name)->get();

            return request()->json(200,$emp_detail);


        }
        public function fetch_distribution_bank_payabale(){
            $company_id=Session::get('company_id');
       $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
      foreach ($find_session_closed as $find_session1) {
       
           }
            $sesson_name=$find_session1->SessionName;
       
        $emp_detail=DB::connection('sqlsrv2')->table('Payroll_Distribution')->where('CompanyID','=',$company_id)->where('MethodType','=','Bank Transfer')->where('SessionName','=',$sesson_name)->get();

            return request()->json(200,$emp_detail);


        }
         public function proceeddistapproval(){
        $company_id=Session::get('company_id');
        $username = Session::get('username'); 
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID', '=' ,$company_id)->where('CurrentSession', '=' ,1)->where('AttClosedPayrollStart','=','Closed')->get();
        foreach ($find_session_closed as $find_session1) {
        }
        $sesson_name=$find_session1->SessionName;

         
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Salaries moved', 'Salaries of session '.$sesson_name.' moved for Distribution', $update_date]);

        $result=DB::connection('sqlsrv2')->select("SET NOCOUNT ON EXEC [dbo].[Add_Payroll_Distribution]
        @companyID = N'".$company_id."',
        @session = N'".$sesson_name."' Delete FROM PayrollFinanceApproval WHERE CompanyID='".$company_id."'  AND FStatus='P' AND SessionName='".$sesson_name."' ");
         
        $result1="submitted";
      
        return request()->json(200,$result1);
    }

        public function view_emp_salary_slip($id){
           $company_id= Session::get('company_id');
            $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
            foreach ($find_session_closed as $find_session1) {
       
           }
          $sesson_name=$find_session1->SessionName;

        $emp_loan_dtl = DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('Payroll_Distribution', 'Payroll_Distribution.EmployeeID', '=', 'Emp_Profile.EmployeeID')->join('Emp_Register', 'Emp_Register.EmployeeID', '=', 'Emp_Profile.EmployeeID')
        ->select('Emp_Profile.CNIC','Emp_Profile.Address','Emp_Profile.DOB','Emp_Register.JobStatus','Emp_Register.JoiningDate','Emp_Profile.Mobile', 'Payroll_Distribution.*')
        ->where('Payroll_Distribution.CompanyID','=',$company_id)
        ->where('Payroll_Distribution.SessionName','=',$sesson_name)
        ->where('Payroll_Distribution.EmployeeID','=',$id)->get();
        return request()->json(200,$emp_loan_dtl);



        }
        public function generate_slip($emp_id,$slip_id,$emp_code){
            $this->fpdf->AddPage("P", ['210', '297']);
            $company_id= Session::get('company_id');
            $fetch_company_detail=DB::table('tb_create_company')->where('company_id','=',$company_id)->get();
            foreach ($fetch_company_detail as $fetch_company_detail1) {
              # code...
            }







           $check_security =DB::connection('sqlsrv2')->table('Payroll_Distribution')->where('CompanyID','=',$company_id)->where('DistributionID','=',$slip_id)->where('EmployeeID','=',$emp_id)->where('EmpCode','=',$emp_code)->exists();
           if($check_security){
               $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
            foreach ($find_session_closed as $find_session1) {
       
           }
          $sesson_name=$find_session1->SessionName;



          $emp_loan_dtl = DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('Payroll_Distribution', 'Payroll_Distribution.EmployeeID', '=', 'Emp_Profile.EmployeeID')->join('Emp_Register', 'Emp_Register.EmployeeID', '=', 'Emp_Profile.EmployeeID')
        ->select('Emp_Profile.CNIC','Emp_Profile.DOB','Emp_Register.JoiningDate','Emp_Register.JobStatus','Emp_Profile.Address','Emp_Profile.Mobile', 'Payroll_Distribution.*')
        ->where('Payroll_Distribution.CompanyID','=',$company_id)
        ->where('Payroll_Distribution.SessionName','=',$sesson_name)
        ->where('Payroll_Distribution.EmployeeID','=',$emp_id)->get();
        foreach ($emp_loan_dtl as $test1) {
          # code...
        }
       $this->fpdf->Image('public/images/profile_images/'.$test1->Photo,10,6,35,30);
         $this->fpdf->Image('public/images/'.$fetch_company_detail1->company_logo,170,6,30);
        $this->fpdf->SetFont('Arial','B',20);

        $this->fpdf->Text(80, 14, $fetch_company_detail1->company_name); 
        //$pdf->Cell(40,10,'Hello World !',1);
         $this->fpdf->SetFont('Arial','',14);
        $this->fpdf->Text(70, 20, $fetch_company_detail1->company_address); 
            $this->fpdf->SetFont('Arial','B',14);
           $this->fpdf->Text(85, 35, "Salary PaySlip"); 
         $this->fpdf->SetFont('Arial','',16);
        $this->fpdf->Text(15, 42, "Employee Copy"); 
         $this->fpdf->SetFont('Arial','B',10);
        

        $this->fpdf->Ln(40);
                               
                                $this->fpdf->Cell(105,0,"Salary Month: ".$test1->SessionName,0,0,'L');
                                  $this->fpdf->Cell(85,0,"Received Date: 2022-07-05 01:17PM ",0,1,'R');
                                   $this->fpdf->Ln(10);
                                  $this->fpdf->SetFont('Arial','',10);
                                  $this->fpdf->Cell(25,0,"Employee Code",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->EmpCode,0,0,'R');
                                    $this->fpdf->Cell(30,0,"Basic Salary",0,0,'R');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->Salary."/-",0,1,'R');
                                  $this->fpdf->Ln(5);
                                  
                                   $this->fpdf->Cell(25,0,"Employee Name",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->Name,0,0,'R');
                                  $this->fpdf->SetFont('Arial','B',10);
                                    $this->fpdf->Cell(50,0,"Allowance & Bonus",0,0,'C');
                                    $this->fpdf->SetFont('Arial','',10);
                                  $this->fpdf->Cell(1,0,"",0,1,'R');
                         

                                  $this->fpdf->Ln(5);
                                  $this->fpdf->Cell(25,0,"Department Name",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->Department,0,0,'R');
                                    $this->fpdf->Cell(30,0,"   Overtime",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->OAmount."/-",0,1,'R');

                                  $this->fpdf->Ln(5);
                                  $this->fpdf->Cell(25,0,"Designation",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->Designation,0,0,'R');
                                    $this->fpdf->Cell(30,0,"Arears",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->ArrearsAmount."/-",0,1,'R');
                                   $this->fpdf->Ln(5);
                                  $this->fpdf->Cell(25,0,"Date Of Joining",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->JoiningDate,0,0,'R');
                                    $this->fpdf->Cell(30,0,"Bonus",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->BonusAmount."/-",0,1,'R');
                                   $this->fpdf->Ln(5);
                                   
                                  $this->fpdf->Cell(25,0,"Job Status",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->JobStatus,0,0,'R');
                                    $this->fpdf->Cell(30,0,"       Allowance",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->AllowanceAmount."/-",0,1,'R');
                                   $this->fpdf->Ln(5);
                                  $this->fpdf->Cell(25,0,"Posting City",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->PostingCity,0,0,'R');
                                  $this->fpdf->SetFont('Arial','B',10);
                                    $this->fpdf->Cell(30,0,"Total",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->OAmount+$test1->AllowanceAmount+$test1->BonusAmount+$test1->ArrearsAmount."/-",0,1,'R');
                                   $this->fpdf->SetFont('Arial','',10);
                                  $this->fpdf->Ln(5);
                                  $this->fpdf->Cell(25,0,"CNIC No.",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->CNIC,0,0,'R');
                                   $this->fpdf->SetFont('Arial','B',10);
                                    $this->fpdf->Cell(50,5,"Deduction & Loan",0,0,'C');
                                       $this->fpdf->SetFont('Arial','',10);
                                  $this->fpdf->Cell(1,0,"",0,1,'R');
                                  $this->fpdf->Ln(5);
                                  $this->fpdf->Cell(25,0,"Phone No.",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->Mobile,0,0,'R');
                                    $this->fpdf->Cell(30,3,"Installment",0,0,'R');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->InstallmentAmount."/-",0,1,'R');
                                  $this->fpdf->Ln(5);
                                $this->fpdf->Cell(25,0,"Date of Birth",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->DOB,0,0,'R');
                                    $this->fpdf->Cell(30,0,"Fine",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->Fine."/-",0,1,'R');
                                   $this->fpdf->Ln(5);
                                   
                                  
                                   $this->fpdf->Cell(25,0,"Prepared By",0,0,'L');
                                  $this->fpdf->Cell(85,0,"HR Department",0,0,'R');
                                    $this->fpdf->Cell(30,0,"Dues",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->DuesAmount."/-",0,1,'R');
                                  $this->fpdf->Ln(5);
                                 $this->fpdf->Cell(25,0,"Payment Method",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->MethodType,0,0,'R');
                                    $this->fpdf->Cell(30,0,"Att.Deduction",0,0,'R');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->DAmount."/-",0,1,'R');
                                   $this->fpdf->Ln(5);
                                 $this->fpdf->Cell(25,0,"",0,0,'L');
                                  $this->fpdf->Cell(85,0,"",0,0,'R');
                                  $this->fpdf->SetFont('Arial','B',10);
                                    $this->fpdf->Cell(30,0,"Total",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->Fine+$test1->DAmount+$test1->InstallmentAmount+$test1->DuesAmount."/-",0,1,'R');
                                   $this->fpdf->SetFont('Arial','',10);

                                    $this->fpdf->Ln(5);
                                   $this->fpdf->SetFont('Arial','B',10);
                                 $this->fpdf->Cell(25,0,"",0,0,'L');
                                  $this->fpdf->Cell(90,0,"",0,0,'R');
                                   $this->fpdf->SetFont('Arial','B',13);
                                  $this->fpdf->Cell(60,5,"NET PAYABLE : ".$test1->PayableSalary."/- ",0,1,'L');
                                   $this->fpdf->SetFont('Arial','',10);
 //$this->fpdf->SetTextColor(128);
 // $this->fpdf->SetTextColor(220,50,50);
 $this->fpdf->Line(128, 70, 128, 120);

   $this->fpdf->Ln(7);
   $this->fpdf->Cell(150,5,"-----------------------",0,0,'L');
   $this->fpdf->Cell(90,5,"-----------------------",0,1,'L');
   $this->fpdf->Cell(155,5,"Prepared By",0,0,'L');
 $this->fpdf->Cell(90,5,"Received By",0,1,'L');
 $this->fpdf->Ln(5);
 $this->fpdf->Cell(170,0,"----------------------------------------------------------------------------------------------------------------------------------------------------------",0,1,'L');



 $this->fpdf->Image('public/images/profile_images/'.$test1->Photo,10,160,35,30);
         $this->fpdf->Image('public/images/'.$fetch_company_detail1->company_logo,170,160,30);
        $this->fpdf->SetFont('Arial','B',20);

        $this->fpdf->Text(85, 160, $fetch_company_detail1->company_name); 
        //$pdf->Cell(40,10,'Hello World !',1);
         $this->fpdf->SetFont('Arial','',14);
        $this->fpdf->Text(75, 166, $fetch_company_detail1->company_address); 
            $this->fpdf->SetFont('Arial','B',14);
           $this->fpdf->Text(90, 179, "Salary PaySlip"); 
         $this->fpdf->SetFont('Arial','',16);
        $this->fpdf->Text(15, 196, "Accounts Copy"); 
         $this->fpdf->SetFont('Arial','B',10);
        

        $this->fpdf->Ln(48);
                               
                                $this->fpdf->Cell(105,0,"Salary Month: ".$test1->SessionName,0,0,'L');
                                  $this->fpdf->Cell(85,0,"Received Date: 2022-07-05 01:17PM ",0,1,'R');
                                   $this->fpdf->Ln(5);
                                  $this->fpdf->SetFont('Arial','',10);
                                  $this->fpdf->Cell(25,0,"Employee Code",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->EmpCode,0,0,'R');
                                    $this->fpdf->Cell(30,0,"Basic Salary",0,0,'R');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->Salary."/-",0,1,'R');
                                  $this->fpdf->Ln(5);
                                  
                                   $this->fpdf->Cell(25,0,"Employee Name",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->Name,0,0,'R');
                                  $this->fpdf->SetFont('Arial','B',10);
                                    $this->fpdf->Cell(50,0,"Allowance & Bonus",0,0,'C');
                                    $this->fpdf->SetFont('Arial','',10);
                                  $this->fpdf->Cell(1,0,"",0,1,'R');
                         

                                  $this->fpdf->Ln(5);
                                  $this->fpdf->Cell(25,0,"Department Name",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->Department,0,0,'R');
                                    $this->fpdf->Cell(30,0,"   Overtime",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->OAmount."/-",0,1,'R');

                                  $this->fpdf->Ln(5);
                                  $this->fpdf->Cell(25,0,"Designation",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->Designation,0,0,'R');
                                    $this->fpdf->Cell(30,0,"Arears",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->ArrearsAmount."/-",0,1,'R');
                                   $this->fpdf->Ln(5);
                                  $this->fpdf->Cell(25,0,"Date Of Joining",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->JoiningDate,0,0,'R');
                                    $this->fpdf->Cell(30,0,"Bonus",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->BonusAmount."/-",0,1,'R');
                                   $this->fpdf->Ln(5);
                                   
                                  $this->fpdf->Cell(25,0,"Job Status",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->JobStatus,0,0,'R');
                                    $this->fpdf->Cell(30,0,"       Allowance",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->AllowanceAmount."/-",0,1,'R');
                                   $this->fpdf->Ln(5);
                                  $this->fpdf->Cell(25,0,"Posting City",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->PostingCity,0,0,'R');
                                  $this->fpdf->SetFont('Arial','B',10);
                                    $this->fpdf->Cell(30,0,"Total",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->OAmount+$test1->AllowanceAmount+$test1->BonusAmount+$test1->ArrearsAmount."/-",0,1,'R');
                                   $this->fpdf->SetFont('Arial','',10);
                                  $this->fpdf->Ln(5);
                                  $this->fpdf->Cell(25,0,"CNIC No.",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->CNIC,0,0,'R');
                                   $this->fpdf->SetFont('Arial','B',10);
                                    $this->fpdf->Cell(50,5,"Deduction & Loan",0,0,'C');
                                       $this->fpdf->SetFont('Arial','',10);
                                  $this->fpdf->Cell(1,0,"",0,1,'R');
                                  $this->fpdf->Ln(5);
                                  $this->fpdf->Cell(25,0,"Phone No.",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->Mobile,0,0,'R');
                                    $this->fpdf->Cell(30,3,"Installment",0,0,'R');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->InstallmentAmount."/-",0,1,'R');
                                  $this->fpdf->Ln(5);
                                $this->fpdf->Cell(25,0,"Date of Birth",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->DOB,0,0,'R');
                                    $this->fpdf->Cell(30,0,"Fine",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->Fine."/-",0,1,'R');
                                   $this->fpdf->Ln(5);
                                   
                                  
                                   $this->fpdf->Cell(25,0,"Prepared By",0,0,'L');
                                  $this->fpdf->Cell(85,0,"HR Department",0,0,'R');
                                    $this->fpdf->Cell(30,0,"Dues",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->DuesAmount."/-",0,1,'R');
                                  $this->fpdf->Ln(5);
                                 $this->fpdf->Cell(25,0,"Payment Method",0,0,'L');
                                  $this->fpdf->Cell(85,0,$test1->MethodType,0,0,'R');
                                    $this->fpdf->Cell(30,0,"Att.Deduction",0,0,'R');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->DAmount."/-",0,1,'R');
                                   $this->fpdf->Ln(5);
                                 $this->fpdf->Cell(25,0,"",0,0,'L');
                                  $this->fpdf->Cell(85,0,"",0,0,'R');
                                  $this->fpdf->SetFont('Arial','B',10);
                                    $this->fpdf->Cell(30,0,"Total",0,0,'C');
                                  $this->fpdf->Cell(45,0,"Rs. ".$test1->Fine+$test1->DAmount+$test1->InstallmentAmount+$test1->DuesAmount."/-",0,1,'R');
                                   $this->fpdf->SetFont('Arial','',10);

                                    $this->fpdf->Ln(5);
                                   $this->fpdf->SetFont('Arial','B',10);
                                 $this->fpdf->Cell(25,0,"",0,0,'L');
                                  $this->fpdf->Cell(90,0,"",0,0,'R');
                                   $this->fpdf->SetFont('Arial','B',13);
                                  $this->fpdf->Cell(60,5,"NET PAYABLE : ".$test1->PayableSalary."/- ",0,1,'L');
                                   $this->fpdf->SetFont('Arial','',10);
 //$this->fpdf->SetTextColor(128);
 // $this->fpdf->SetTextColor(220,50,50);
 $this->fpdf->Line(128, 215, 128, 265);
 $this->fpdf->Ln(10);
   $this->fpdf->Cell(150,5,"-----------------------",0,0,'L');
   $this->fpdf->Cell(90,5,"-----------------------",0,1,'L');
   $this->fpdf->Cell(155,5,"Prepared By",0,0,'L');
 $this->fpdf->Cell(90,5,"Received By",0,1,'L');

          $this->fpdf->Output();
        exit;



           }
           else {
              echo "not exists";
           }


        }

















































       








































  //payroll loans
    
      public function filter_loan_requisitions($date_from, $date_to, $dept, $desig, $name){
        $company_id=Session::get('company_id');

            if($date_from=="All"){
                $date_from='';
            }
            if($date_to=="All"){
                $date_to='';
            }
            if($dept=="All"){
                $dept='';
            }
            if($desig=="All"){
                $desig='';
            }
            if($name=="All"){
                $name='';
            }
        
        $all_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
        ->join('Emp_Register', 'LoanRequisition.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->join('Emp_Profile', 'Emp_Register.EmployeeID', '=', 'Emp_Profile.EmployeeID')
        ->orderBy('LoanRequisition.LoanId','desc')
        ->select('Emp_Profile.*','LoanRequisition.*', 'Emp_Register.*')

        ->where('LoanRequisition.ApplyDate','>=',$date_from)
        ->where('LoanRequisition.ApplyDate','<=',$date_to)
        ->where('Emp_Register.Department','like','%'.$dept.'%')
        ->where('Emp_Register.Designation','like','%'.$desig.'%')
        ->where('Emp_Profile.Name','like','%'.$name.'%')
        ->where('Emp_Profile.Name','like','%'.$name.'%')
        ->where('LoanRequisition.CompanyID','=',$company_id)->get();
        return request()->json(200, $all_loans);
      }

    //fetch Employee detail for loan and advance
    public function fetch_employee_dtl($emp_id){
        $company_id= Session::get('company_id');
        $emp_loan_dtl = DB::connection('sqlsrv2')->table('Emp_Register')
        ->join('Emp_Profile', 'Emp_Register.EmployeeID', '=', 'Emp_Profile.EmployeeID')
        ->orderBy('Emp_Register.EmployeeID','asc')
        ->select('Emp_Profile.*', 'Emp_Register.*')
        ->where('Emp_Register.CompanyID','=',$company_id)
        ->where('Emp_Register.EmployeeID','=',$emp_id)->get();
        return request()->json(200,$emp_loan_dtl);
    }
    
     //Apply for loan
    public function add_loan_req(Request $request)
    {

        $company_id = Session:: get('company_id');
        $username = Session:: get('username');
        date_default_timezone_set("Asia/Karachi");
        $add_date = date("Y-m-d");
        //$a_c_name = $request -> get('a_c_name');
        $type = $request -> get('type');
        $amount = $request -> get('amount');
        $reason = $request -> get('reason');
        $emp_id1 = $request -> get('emp_id1');

        $alreadyappliedid = DB:: connection('sqlsrv2') ->table('LoanDetail')->select('EmployeeID')
        ->where('InstallmentStatus', '=', "Unpaid")->where('EmployeeID', '=', $emp_id1)->where('CompanyID', '=', $company_id)->exists();
        if($alreadyappliedid){
             $data="Loan already provided!";
             return request() -> json(200, $data);
        }
        else{
            $loanSession = DB::connection('sqlsrv2')->table('HrSessions')->select('SessionName')->where('CompanyID', '=', $company_id)->where('CurrentSession', '=', "1")->get('SessionName');

            foreach ($loanSession as $loanSession1) {}
            $loanSession2 = $loanSession1->SessionName;

            if($type=="Loan"){
                $installments = $request->get('installments');
            }
            else{
                $installments = 1;
            }

            $UserFullName=Session::get('UserName');
            $update_date=date("Y-m-d h:i:s A");

            $full_name_arr = DB::connection('sqlsrv2')->table('Emp_Profile')->select('Name')->where('EmployeeID', '=', $emp_id1)->where('CompanyID','=', $company_id)->get();
            foreach ($full_name_arr as $full_name_arr1) {
                  # code...
            }
            $full_name = $full_name_arr1->Name;

            DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, $type.' Applied', $type.' application received from '.$full_name , $update_date]);

            DB::connection('sqlsrv2')->insert('INSERT INTO LoanRequisition(CompanyID, EmployeeID, LoanType, LoanAmount, LoanReason, LoanInstallments, LoanSession, ApplyDate, ManagerApproval, HrApproval, ReqStatus, CreatedBy) values (?,?,?,?,?,?,?,?,?,?,?,?)', [$company_id, $emp_id1, $type, $amount, $reason, $installments, $loanSession2, $add_date, "Pen", "Pen", "Pending", $username]);
            $data="Loan added Successfully!";
            return request() -> json(200, $data);
        }
    }
    
    
    //View all loans
    public function fetch_all_loans(){
        $company_id= Session::get('company_id');
        $all_loans=DB::connection('sqlsrv2')
        ->table('LoanRequisition')->select('LoanRequisition.*')
        ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('LoanRequisition.LoanId','desc')
        ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
        ->where('LoanRequisition.ManagerApproval','like','%'.'App'.'%')->where('LoanRequisition.HrApproval','like','%'.'App'.'%')
        ->orwhere('LoanRequisition.ManagerApproval','like','%'.'Pen'.'%')->where('LoanRequisition.HrApproval','like','%'.'Pen'.'%')
        ->where('LoanRequisition.CompanyID','=',$company_id)->get();
        return request()->json(200,$all_loans);
    }

    //View filtered loans
    public function fetch_filtered_loans($check)
    {
        $company_id= Session::get('company_id');
        if($check==0){
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)->get();
        }
        if($check==1)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','=','App')
            ->where('LoanRequisition.HrApproval','=','App')->get();
        }
        if($check==2)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','like','%'.'App'.'%')->where('LoanRequisition.HrApproval','like','%'.'App'.'%')
            ->orwhere('LoanRequisition.ManagerApproval','like','%'.'Pen'.'%')->where('LoanRequisition.HrApproval','like','%'.'Pen'.'%')->get();
        }
        if($check==3)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','like','%'.'App'.'%')->where('LoanRequisition.HrApproval','like','%'.'App'.'%')
            ->orwhere('LoanRequisition.ManagerApproval','like','%'.'Pen'.'%')->where('LoanRequisition.HrApproval','like','%'.'Pen'.'%')
            ->orwhere('LoanRequisition.ManagerApproval','like','%'.'Rej'.'%')->where('LoanRequisition.HrApproval','like','%'.'Rej'.'%')->get();
        }
        if($check==4)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','like','%'.'App'.'%')->where('LoanRequisition.HrApproval','like','%'.'App'.'%')
            ->orwhere('LoanRequisition.ManagerApproval','like','%'.'Rej'.'%')->where('LoanRequisition.HrApproval','like','%'.'Rej'.'%')->get();
        }
        if($check==5)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','like','%'.'Pen'.'%')->where('LoanRequisition.HrApproval','like','%'.'Pen'.'%')
            ->orwhere('LoanRequisition.ManagerApproval','like','%'.'Rej'.'%')->where('LoanRequisition.HrApproval','like','%'.'Rej'.'%')->get();
        }
        if($check==6)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','like','%'.'Pen'.'%')->where('LoanRequisition.HrApproval','like','%'.'Pen'.'%')->get();
        }
        if($check==7)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','like','%'.'Rej'.'%')->where('LoanRequisition.HrApproval','like','%'.'Rej'.'%')->get();
        }
        //Department manager

        if($check==10)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('LoanRequisition.LoanId','desc')
        ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
        ->where('LoanRequisition.CompanyID','=',$company_id)->get();
        }
        if($check==11)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','=','App')->get();
        }
        if($check==12)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','like','%'.'App'.'%')
            ->orwhere('LoanRequisition.ManagerApproval','like','%'.'Pen'.'%')->get();
        }
        if($check==13)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','like','%'.'App'.'%')
            ->orwhere('LoanRequisition.ManagerApproval','like','%'.'Pen'.'%')
            ->orwhere('LoanRequisition.ManagerApproval','like','%'.'Rej'.'%')->get();
        }
        if($check==14)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','like','%'.'App'.'%')
            ->orwhere('LoanRequisition.ManagerApproval','like','%'.'Rej'.'%')->get();
        }
        if($check==15)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','like','%'.'Pen'.'%')
            ->orwhere('LoanRequisition.ManagerApproval','like','%'.'Rej'.'%')->get();
        }
        if($check==16)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','like','%'.'Pen'.'%')->get();
        }
        if($check==17)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.ManagerApproval','like','%'.'Rej'.'%')->get();
        }

        //HR manager

        if($check==20)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)->get();
        }
        if($check==21)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.HrApproval','=','App')->get();
        }
        if($check==22)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.HrApproval','like','%'.'App'.'%')
            ->orwhere('LoanRequisition.HrApproval','like','%'.'Pen'.'%')->get();
        }
        if($check==23)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.HrApproval','like','%'.'App'.'%')
            ->orwhere('LoanRequisition.HrApproval','like','%'.'Pen'.'%')
            ->orwhere('LoanRequisition.HrApproval','like','%'.'Rej'.'%')->get();
        }
        if($check==24)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.HrApproval','like','%'.'App'.'%')
            ->orwhere('LoanRequisition.HrApproval','like','%'.'Rej'.'%')->get();
        }
        if($check==25)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.HrApproval','like','%'.'Pen'.'%')
            ->orwhere('LoanRequisition.HrApproval','like','%'.'Rej'.'%')->get();
        }
        if($check==26)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.HrApproval','like','%'.'Pen'.'%')->get();
        }
        if($check==27)
        {
            $filtered_loans=DB::connection('sqlsrv2')->table('LoanRequisition')
            ->join('Emp_Profile', 'LoanRequisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('LoanRequisition.LoanId','desc')
            ->select('Emp_Profile.Name', 'LoanRequisition.*', 'Emp_Register.Department', 'Emp_Register.Designation')
            ->where('LoanRequisition.CompanyID','=',$company_id)
            ->where('LoanRequisition.HrApproval','like','%'.'Rej'.'%')->get();
        }
        return request()->json(200,$filtered_loans);
    }

    //fetch rel loan
    public function fetch_rel_loan($cid){
        $company_id= Session::get('company_id');

        $rel_loan_dtl = DB::connection('sqlsrv2')->table('LoanRequisition')
        ->join('Emp_Register', 'LoanRequisition.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->join('Emp_Profile', 'Emp_Register.EmployeeID', '=', 'Emp_Profile.EmployeeID')
        ->orderBy('Emp_Register.EmployeeID','asc')
        ->select('Emp_Profile.Name', 'Emp_Register.*', 'LoanRequisition.*')
        ->where('Emp_Register.CompanyID','=',$company_id)
        ->where('LoanRequisition.LoanId','=',$cid)->get();
        return request()->json(200,$rel_loan_dtl);
    }

    //View all installments
    public function fetch_all_installments(){
        $company_id= Session::get('company_id');
        $all_inst=DB::connection('sqlsrv2')
        ->table('LoanDetail')->select('LoanDetail.*')
        ->where('LoanDetail.CompanyID','=',$company_id)
        ->orderby('LoanDetail.InstallmentNo', 'asc')->get();
        return request()->json(200,$all_inst);
    }

    //Update status
     public function update_loan_m_sts(Request $request)
    {
        $company_id = Session:: get('company_id');
        $username=Session::get('username'); 
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
        $usid = $request->get('usid');
        $manager_status=$request->get('manager_status');
        $hr_status=$request->get('hr_status');
        $req_status=$request->get('req_status');
        $pay_emp_id=$request->get('pay_emp_id');

        DB::connection('sqlsrv2')->update('update LoanRequisition set ManagerApproval=?, HrApproval=?, ReqStatus=?, UpdatedOn=?, UpdatedBy=? where LoanId=?', [$manager_status, $hr_status, $req_status, $update_date, $username, $usid]);

        if($hr_status=="Pen"){
            $hr_status = "Pending";
        }
        else if($hr_status=="App"){
            $hr_status = "Approved";
        }
        else if($hr_status=="Rej"){
            $hr_status = "Rejected";
        }

        if($manager_status=="Pen"){
            $manager_status = "Pending";
        }
        else if($manager_status=="App"){
            $manager_status = "Approved";
        }
        else if($manager_status=="Rej"){
            $manager_status = "Rejected";
        }
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Loan Status Updated', 'Loan status updated to HR: '.$hr_status.' and Manager: '.$manager_status , $update_date]);

        $data="Status updated!";
        
        return request()->json(200,$data);
    }


    //Pay loan
      public function pay_loan(Request $request)
    {
        $username= Session::get('username');
        $company_id= Session::get('company_id');
        $UserFullName=Session::get('UserName');
        $EmployeeID= $request->get('pay_emp_id');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $pay_loanID = $request->get('pay_loanID');
        $pay_amount = $request->get('pay_amount');
        $pay_installments = $request->get('pay_installments');
        $pay_type = $request->get('pay_type');
        $rcvBy = $request->get('rcvBy');
        $ins_start = $request->get('ins_start');

        $alreadyappliedid = DB:: connection('sqlsrv2') ->table('LoanDetail')->select('EmployeeID')->where('InstallmentStatus', '=', "Unpaid") ->where('EmployeeID', '=', $EmployeeID)->where('CompanyID', '=', $company_id)->exists();
        if($alreadyappliedid){
             $data="Loan already provided!";
             return request() -> json(200, $data);
        }
        else{
            if($pay_type=="Loan")
            {
                $find_session =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->get();
                foreach ($find_session as $find_session1) {
                }
                $s_date=$find_session1->StartDate;
                $e_date=$find_session1->EndDate;
               
                $InstallmentAmount = round( (float)$pay_amount/$pay_installments, 2);
                for($x=(0+$ins_start); $x<($pay_installments+$ins_start); $x++)
                {
                    $var=strtotime($e_date);
                    $effectiveDate = strtotime("+".$x." months",$var);
                    $insSession = date("F-Y", $effectiveDate);
                    $installmentNumber = ($x+1)-$ins_start;
                    DB::connection('sqlsrv2')->insert('INSERT INTO LoanDetail(CompanyID, EmployeeID, LoanId, InstallmentNo, InstallmentAmount, InstallmentSession, InstallmentStatus, CreatedBy, CreatedOn) values (?,?,?,?,?,?,?,?,?)', [$company_id,$EmployeeID,$pay_loanID, $installmentNumber, $InstallmentAmount, $insSession, "Unpaid", $username, $update_date]);
                }
            }
            else if($pay_type=="Advance")
            {
                $var=strtotime($update_date);
                $effectiveDate = $var;
                $insSession = date("F-Y", $effectiveDate);
                $installmentNumber = "1";
                DB::connection('sqlsrv2')->insert('INSERT INTO LoanDetail(CompanyID, EmployeeID, LoanId, InstallmentNo, InstallmentAmount, InstallmentSession, InstallmentStatus, CreatedBy, CreatedOn) values (?,?,?,?,?,?,?,?,?)', [$company_id, $EmployeeID, $pay_loanID, $installmentNumber, $pay_amount, $insSession, "Unpaid", $username, $update_date]);
            }

            DB::connection('sqlsrv2')->update('update LoanRequisition set ReqStatus=?, UpdatedOn=?, UpdatedBy=?, ReceivedDate=?, ReceivedBy=? where LoanId=?', ['Paid', $update_date, $username, $update_date, $rcvBy, $pay_loanID]);

            $full_name_arr = DB::connection('sqlsrv2')->table('Emp_Profile')->select('Name')->where('EmployeeID','=',$EmployeeID)->get();
            foreach ($full_name_arr as $full_name_arr1) {
                  # code...
                }
            $full_name = $full_name_arr1->Name;

            DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, $pay_type.' Paied', $pay_type.' paied to '.$full_name , $update_date]);

            $data="Loan paid!";
        }
        return request()->json(200,$data);
    }


    //Fetch employees to apply loan
    public function overall_employees_payroll(){
        $company_id=Session::get('company_id');
        $arr=DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('Emp_Register.EmployeeCode')
        ->select('Emp_Profile.Name', 'Emp_Profile.EmployeeID', 'Emp_Register.EmployeeCode')
        ->where('Emp_Profile.CompanyID', '=', $company_id)->get(); 
        return request()->json(200, $arr); 
        }


        //Function to be copy in "HrController.php"

public function filter_leaves_requisitions($leave_type, $department, $location, $designation){
        $company_id=Session::get('company_id');
       
            if($leave_type=='All')
            {
                $leave_type='';
            }
            if($department=='All')
            {
                $department='';
            }
            if($designation=='All')
            {
                $designation='';
            }
            if($location=='All')
            {
                $location='';
            }
            
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')
            ->join('leave_Requisition', 'Emp_Profile.EmployeeID', '=', 'leave_Requisition.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('leave_Requisition.EmployeeID', 'asc')
            ->select('Emp_Profile.Name','Emp_Profile.Photo','leave_Requisition.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')
            ->where('leave_Requisition.CompanyID','=',$company_id)->where('leave_Requisition.Leavetype','like','%'.$leave_type.'%')->where('Emp_Register.Department','like','%'.$department.'%')
            ->where('Emp_Register.Designation','like','%'.$designation.'%')->where('Emp_Register.PostingCity','like','%'.$location.'%')->get();
            return request()->json(200,$arr);
      }


       public function fetch_leave_upSts($cid){
        $company_id= Session::get('company_id');

        $rel_leave_dtl = DB::connection('sqlsrv2')->table('leave_Requisition')
        ->join('Emp_Profile', 'leave_Requisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('leave_Requisition.EmployeeID', 'asc')
        ->select('leave_Requisition.*', 'Emp_Profile.*', 'Emp_Register.*')
        ->where('leave_Requisition.LeaveRQID','=',$cid)
        ->where('leave_Requisition.CompanyID','=',$company_id)->get();
        return request()->json(200, $rel_leave_dtl);
    }



   public function update_leave_sts(Request $request)
    {
        $company_id= Session::get('company_id');
        $username=Session::get('username');
        $UserFullName=Session::get('UserName');
        $lv_app_id = $request->get('lv_app_id');
        $lv_status = $request->get('lv_status');
        $us_lv_type = $request->get('us_lv_type');
        $emp_emp_id = $request->get('us_emp_id');
        $us_lv_number = $request->get('lv_number');
        
        if($lv_status == "A")
        {
            $rem_levs= DB::connection('sqlsrv2')->table('EmpLeave')->where('CompanyID','=',$company_id)
            ->where('EmployeeID','=', $emp_emp_id)->where('LeaveType','=', $us_lv_type)->sum('RemainingLeave');

            $rem_an_levs = $rem_levs - $us_lv_number;
            DB::connection('sqlsrv2')->update('update EmpLeave set RemainingLeave=? where LeaveType=? AND EmployeeID=? AND CompanyID=?', [$rem_an_levs, $us_lv_type, $emp_emp_id, $company_id]);
        }
        DB::connection('sqlsrv2')->update('update leave_Requisition set PendingLeaveStatus=? where LeaveRQID=? AND CompanyID=?', [$lv_status, $lv_app_id, $company_id]);
        $data="Status updated!";

        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
        $full_name_id=$request->get('nameId');
        $full_name_arr= DB::connection('sqlsrv2')->table('Emp_Profile')->select('Name')->where('EmployeeID', '=', $emp_emp_id)->get();
        foreach ($full_name_arr as $full_name_arr1) {
              # code...
            }
        $full_name = $full_name_arr1->Name;
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName,'Leave Status Changed', 'Status of '.$full_name.' leave has changed', $update_date]);


        return request()->json(200,$data);
    }
    public function all_leaves(){
        $company_id=Session::get('company_id');
        $all_leaves = DB::connection('sqlsrv2')->table('leave_Requisition')
        ->join('Emp_Profile', 'leave_Requisition.EmployeeID', '=', 'Emp_Profile.EmployeeID')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('leave_Requisition.EmployeeID', 'asc')
        ->select('leave_Requisition.*', 'Emp_Profile.*', 'Emp_Register.*')
        ->where('leave_Requisition.CompanyID','=',$company_id)->get();
        return request()->json(200, $all_leaves);
      }
 public function search_member (Request $request)
    {
        $company_id = Session::get('company_id');
        $emp_code= Session::get('employee_id');
        $srch_name = $request->get('srch_name');

            $team=DB::connection('sqlsrv2')->table('Emp_Register')
        ->join('Emp_Profile', 'Emp_Register.EmployeeID', '=', 'Emp_Profile.EmployeeID')
        ->orderBy('Emp_Register.EmployeeID','asc')
        ->select('Emp_Register.*', 'Emp_Profile.Name')
        ->where('Emp_Register.CompanyID','=',$company_id)
        ->where('Emp_Profile.Name','like','%'.$srch_name.'%')
        ->where('Emp_Register.Status','=','Registered')
        ->where('Emp_Register.ReportingTo','=',$emp_code)->get();
        return request()->json(200,$team);
    }
 public function filter_team_leaves($leave_type, $department, $location, $designation){
        $company_id=Session::get('company_id');
        $EmployeeID= Session::get('employee_id');
       
            if($leave_type=='All')
            {
                $leave_type='';
            }
            if($department=='All')
            {
                $department='';
            }
            if($designation=='All')
            {
                $designation='';
            }
            if($location=='All')
            {
                $location='';
            }
            
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')
            ->join('leave_Requisition', 'Emp_Profile.EmployeeID', '=', 'leave_Requisition.EmployeeID')
            ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
            ->orderBy('leave_Requisition.EmployeeID', 'desc')
            ->select('Emp_Profile.Name','Emp_Profile.Photo','leave_Requisition.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')
            ->where('Emp_Register.ReportingTo','=',$EmployeeID)
            ->where('leave_Requisition.CompanyID','=',$company_id)->where('leave_Requisition.Leavetype','like','%'.$leave_type.'%')->where('Emp_Register.Department','like','%'.$department.'%')
            ->where('Emp_Register.Designation','like','%'.$designation.'%')->where('Emp_Register.PostingCity','like','%'.$location.'%')->get();
            return request()->json(200,$arr);
      }
       public function leaves_dtl(){
        $company_id= Session::get('company_id');
        $emp_id= Session::get('employee_id');
    
            $this_a_l=DB::connection('sqlsrv2')
            ->table('EmpLeave')->select('RemainingLeave')
            ->where('EmployeeID','=', $emp_id)
            ->where('CompanyID','=',$company_id)
            ->where('LeaveType','=','Annual')
            ->sum('RemainingLeave');
        
            $ttl_annual=DB::connection('sqlsrv2')
            ->table('EmpLeave')->select('TotalLeave')
            ->where('EmployeeID','=', $emp_id)
            ->where('CompanyID','=',$company_id)
            ->where('LeaveType','=','Annual')
            ->sum('TotalLeave');

            $this_s_l=DB::connection('sqlsrv2')
            ->table('EmpLeave')->select('RemainingLeave')
            ->where('EmployeeID','=', $emp_id)
            ->where('CompanyID','=',$company_id)
            ->where('LeaveType','=','Sick')
            ->sum('RemainingLeave');
        
            $ttl_sick=DB::connection('sqlsrv2')
            ->table('EmpLeave')->select('TotalLeave')
            ->where('EmployeeID','=', $emp_id)
            ->where('CompanyID','=',$company_id)
            ->where('LeaveType','=','Sick')
            ->sum('TotalLeave');

            $this_c_l=DB::connection('sqlsrv2')
            ->table('EmpLeave')->select('RemainingLeave')
            ->where('EmployeeID','=', $emp_id)
            ->where('CompanyID','=',$company_id)
            ->where('LeaveType','=','Casual')
            ->sum('RemainingLeave');
    
            $ttl_casual=DB::connection('sqlsrv2')
            ->table('EmpLeave')->select('TotalLeave')
            ->where('EmployeeID','=', $emp_id)
            ->where('CompanyID','=',$company_id)
            ->where('LeaveType','=','Casual')
            ->sum('TotalLeave');
    
        $leave_count=array(
        'rem_annual' => $this_a_l,
        'ttl_annual' => $ttl_annual,
        'rem_sick' => $this_s_l,
        'ttl_sick' => $ttl_sick,
        'rem_casual' => $this_c_l,
        'ttl_casual' => $ttl_casual,
        );
        return request()->json(200, $leave_count);
    }
     public function submit_arrears(Request $request){
        $company_id= Session::get('company_id');
        $username=Session::get('username'); 
        $UserFullName=Session::get('UserName');
    $emp_id=$request->get('emp_emp_id');
        $emp_amount=$request->get('emp_amount');
        $emp_description=$request->get('emp_description');
        $emp_date=$request->get('emp_date');
        $session_name=$request->get('session_name');
        $username=Session::get('username'); 
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $result=DB::connection('sqlsrv2')->insert("INSERT INTO PayrollArrears(CompanyID,EmployeeID,SessionName,ArrearDate,ArrearsAmount,Descriptions,Status,CreatedBy,CreatedOn) values (?,?,?,?,?,?,?,?,?)", [$company_id,$emp_id,$session_name,$emp_date,$emp_amount,$emp_description,'Pending',$username,$update_date]);

        $full_name_arr = DB::connection('sqlsrv2')->table('Emp_Profile')->select('Name')->where('EmployeeID','=', $emp_id)->where('CompanyID','=', $company_id)->get();
            foreach ($full_name_arr as $full_name_arr1) {
                # code...
            }
            $full_name = $full_name_arr1->Name;

            DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Arrears Applied', ' Arrears of '.$full_name.' applied' , $update_date]);
        
        if($result){
           
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollArrears', 'Emp_Profile.EmployeeID', '=', 'PayrollArrears.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollArrears.ArrearDate', 'desc')->select('Emp_Profile.Name','PayrollArrears.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.Salary','Emp_Register.JoiningDate')->where('PayrollArrears.CompanyID','=',$company_id)->paginate(15);
           
             return request()->json(200,$arr);
        }
    }
    public function fetch_payroll_arrears(){
      $company_id= Session::get('company_id');

      $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollArrears', 'Emp_Profile.EmployeeID', '=', 'PayrollArrears.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollArrears.ArrearDate', 'desc')->select('Emp_Profile.Name','PayrollArrears.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.Salary','Emp_Register.JoiningDate')->where('PayrollArrears.CompanyID','=',$company_id)->paginate(15);
           
             return request()->json(200,$arr);
    }
    public function approve_arrears($id){
        $company_id= Session::get('company_id');
        $username=Session::get('username');
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $id_arr = DB::connection('sqlsrv2')->table('PayrollArrears')->select('EmployeeID')->where('ArrearsID','=', $id)->where('CompanyID','=', $company_id)->get();
        foreach ($id_arr as $id_arr1) {
            # code...
        }
        $emp_id = $id_arr1->EmployeeID;
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Arrears Status Changed', ' Arrears of '.$emp_id.' approved' , $update_date]);

        $result=  DB::connection('sqlsrv2')->update('update PayrollArrears set Status=?,ApprovedBy=? where ArrearsID=? and CompanyID=?',['Approved', $username, $id, $company_id]);

        if($result){
          
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollArrears', 'Emp_Profile.EmployeeID', '=', 'PayrollArrears.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollArrears.ArrearDate', 'desc')->select('Emp_Profile.Name','PayrollArrears.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.Salary','Emp_Register.JoiningDate')->where('PayrollArrears.CompanyID','=',$company_id)->paginate(15);
           
        return request()->json(200,$arr);
        }
    }


    public function find_payroll_arrear($id){
      $company_id= Session::get('company_id');
      $result=DB::connection('sqlsrv2')->table('PayrollArrears')->where('CompanyID','=',$company_id)->where('ArrearsID','=',$id)->get();
       return request()->json(200,$result);

    }
     public function update_ind_arrears(Request $request){
        $company_id= Session::get('company_id');
        $emp_id=$request->get('edit_emp_id');
        $emp_amount=$request->get('edit_amount');
        $emp_description=$request->get('edit_description');
        $emp_date=$request->get('edit_date');
        $session_name=$request->get('edit_session_name');
        $edit_arrear_id=$request->get('edit_arrear_id');

        $username=Session::get('username');
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $result=  DB::connection('sqlsrv2')->update('update PayrollArrears set EmployeeID=?,ArrearDate=?,ArrearsAmount=?,Descriptions=? where ArrearsID=? and CompanyID=?',[$emp_id,$emp_date,$emp_amount,$emp_description,$edit_arrear_id,$company_id]);

        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Arrears updated', 'Arrears of '.$emp_id.' updated' , $update_date]);

        if($result){
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollArrears', 'Emp_Profile.EmployeeID', '=', 'PayrollArrears.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollArrears.ArrearDate', 'desc')->select('Emp_Profile.Name','PayrollArrears.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.Salary','Emp_Register.JoiningDate')->where('PayrollArrears.CompanyID','=',$company_id)->paginate(15);
           
             return request()->json(200,$arr);
        }
    }

    public function search_arrears(Request $request){
 $company_id = Session::get('company_id');

        $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollArrears', 'Emp_Profile.EmployeeID', '=', 'PayrollArrears.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollArrears.ArrearDate', 'desc')->select('Emp_Profile.Name','PayrollArrears.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.Salary','Emp_Register.JoiningDate')->where('PayrollArrears.CompanyID','=',$company_id)->where('Emp_Profile.Name', 'LIKE', '%'.$request->keyword1.'%')->where('Emp_Register.EmployeeCode', 'LIKE', '%'.$request->keyword1.'%')->paginate(15);
        
        return response()->json($arr); 
        }
         public function selected_emp_leaves($id){
        $company_id=Session::get('company_id');
        if($id==0){
            $id=Session::get('employee_id');
        }
        $all_leaves = DB::connection('sqlsrv2')->table('leave_Requisition')
        ->orderBy('StartDate', 'desc')
        ->select('leave_Requisition.*')
        ->where('CompanyID','=',$company_id)->where('EmployeeID','=',$id)->get();
        return request()->json(200, $all_leaves);
      }
     public function selected_emp_leaves_blnc($id){
        $company_id=Session::get('company_id');
        if($id==0){
            $id=Session::get('employee_id');
        }
        $blnc = DB::connection('sqlsrv2')->table('EmpLeave')
        ->orderBy('LeaveType', 'asc')
        ->select('EmpLeave.*')
        ->where('CompanyID','=',$company_id)->where('EmployeeID','=',$id)->get();
        return request()->json(200, $blnc);
      }
    public function selected_emp_timeTable($id){
        $company_id=Session::get('company_id');
        if($id==0){
            $id=Session::get('employee_id');
        }
        $roaster = DB::connection('sqlsrv2')->table('Emp_Register')
        ->join('Roasters', 'Emp_Register.JobShift', '=', 'Roasters.RosterID')
        ->orderBy('Roasters.RosterID', 'asc')
        ->select('Roasters.*')
        ->where('Roasters.CompanyID','=',$company_id)->where('Emp_Register.EmployeeID','=',$id)->get();
        return request()->json(200, $roaster);
      }


      
 public function reporting_employees($id)
    {
       $company_id=Session::get('company_id');
        if($id==0){
            $id=Session::get('employee_id');
        }
        $rep1ArrCheck = DB::connection('sqlsrv2')->table('Emp_Register')
        ->join('Emp_Profile', 'Emp_Register.ReportingTo', '=', 'Emp_Profile.EmployeeID')
        ->select('Emp_Profile.Name')
        ->where('Emp_Register.CompanyID', '=', $company_id)->where('Emp_Register.EmployeeID', '=', $id)->exists();
        if($rep1ArrCheck)
        {
            $rep1Arr = DB::connection('sqlsrv2')->table('Emp_Register')
            ->join('Emp_Profile', 'Emp_Register.ReportingTo', '=', 'Emp_Profile.EmployeeID')
            ->select('Emp_Profile.Name')
            ->where('Emp_Register.CompanyID', '=', $company_id)->where('Emp_Register.EmployeeID', '=', $id)->get();
            foreach ($rep1Arr as $arr1) {}
            $rep1=$arr1->Name;
        }
        else{
            $rep1="Not Assigned";
        }
       
        $rep2ArrCheck = DB::connection('sqlsrv2')->table('Emp_Register')
        ->join('Emp_Profile', 'Emp_Register.ReportingTo2', '=', 'Emp_Profile.EmployeeID')
        ->select('Emp_Profile.Name')
        ->where('Emp_Register.CompanyID', '=', $company_id)->where('Emp_Register.EmployeeID', '=', $id)->exists();

        if($rep2ArrCheck){
            $rep2Arr = DB::connection('sqlsrv2')->table('Emp_Register')
            ->join('Emp_Profile', 'Emp_Register.ReportingTo2', '=', 'Emp_Profile.EmployeeID')
            ->select('Emp_Profile.Name')
            ->where('Emp_Register.CompanyID', '=', $company_id)->where('Emp_Register.EmployeeID', '=', $id)->get();
            foreach ($rep2Arr as $arr2) {}
            $rep2=$arr2->Name;
        }
        else{
            $rep2="Not Assigned";
        }

        $rep=array(
        'rep1' => $rep1,
        'rep2' => $rep2,
        );
        return request()->json(200, $rep);
    }

   public function submit_bonus(Request $request){
        $company_id = Session::get('company_id');
        $UserFullName = Session::get('UserName');
        $emp_id = $request->get('emp_emp_id');
        $emp_amount = $request->get('emp_amount');
        $emp_description = $request->get('emp_description');
        $emp_date = $request->get('emp_date');
        $session_name = $request->get('session_name');
        $username = Session::get('username'); 
        date_default_timezone_set("Asia/Karachi");
        $update_date = date("Y-m-d h:i:s A");

        for($x=0; $x<count($emp_id); $x++){

            $se = explode("_" , $emp_id[$x]);

            $find_employee_id = DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('EmployeeCode','=',$se[1])->get();
            foreach($find_employee_id as $find_employee_id1){
            }
       
            $sub_emp_id = $find_employee_id1->EmployeeID;
            DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Bonuse Applied', ' Bonuse of '.$sub_emp_id.' applied' , $update_date]);
        
            $result=DB::connection('sqlsrv2')->insert("INSERT INTO PayrollBonuses(CompanyID, EmployeeID, SessionName, BonusDate, BonusAmount, Descriptions,Status, CreatedBy, CreatedOn) values (?,?,?,?,?,?,?,?,?)", [$company_id, $sub_emp_id, $session_name, $emp_date, $emp_amount,$emp_description, 'Pending', $username, $update_date]);
        }
        $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollBonuses', 'Emp_Profile.EmployeeID', '=', 'PayrollBonuses.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollBonuses.BonusDate', 'desc')->select('Emp_Profile.Name', 'PayrollBonuses.*','Emp_Register.Department', 'Emp_Register.PostingCity', 'Emp_Register.Designation', 'Emp_Register.EmployeeCode', 'Emp_Register.Salary','Emp_Register.JoiningDate')->where('PayrollBonuses.CompanyID','=',$company_id)->paginate(15);
           
        return request()->json(200,$arr);
    }
  public function fetch_payroll_bonus(){
    $company_id= Session::get('company_id');
     $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollBonuses', 'Emp_Profile.EmployeeID', '=', 'PayrollBonuses.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollBonuses.BonusDate', 'desc')->select('Emp_Profile.Name','PayrollBonuses.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.Salary','Emp_Register.JoiningDate')->where('PayrollBonuses.CompanyID','=',$company_id)->paginate(15);
           
             return request()->json(200,$arr);
  }
  public function approve_bonus($id){
        $company_id= Session::get('company_id');
        $username=Session::get('username'); 
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $id_arr = DB::connection('sqlsrv2')->table('PayrollBonuses')->select('EmployeeID')->where('BonusID','=', $id)->where('CompanyID','=', $company_id)->get();
        foreach ($id_arr as $id_arr1) {
            # code...
        }
        $emp_id = $id_arr1->EmployeeID;
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Bonuse Status Changed', ' Bonuse of '.$emp_id.' approved' , $update_date]);

        $result=  DB::connection('sqlsrv2')->update('update PayrollBonuses set Status=?, ApprovedBy=? where BonusID=? and CompanyID=?',['Approved', $username, $id, $company_id]);
        if($result){
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollBonuses', 'Emp_Profile.EmployeeID', '=', 'PayrollBonuses.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollBonuses.BonusDate', 'desc')->select('Emp_Profile.Name','PayrollBonuses.*','Emp_Register.Department','Emp_Register.PostingCity', 'Emp_Register.Designation', 'Emp_Register.EmployeeCode', 'Emp_Register.Salary', 'Emp_Register.JoiningDate')->where('PayrollBonuses.CompanyID','=',$company_id)->paginate(15);
           
            return request()->json(200,$arr);
        }
    }
  public function find_payroll_bonus($id){
      $company_id= Session::get('company_id');
        $result=DB::connection('sqlsrv2')->table('PayrollBonuses')->where('CompanyID','=',$company_id)->where('BonusID','=',$id)->get();
      return request()->json(200,$result);
  }

    public function update_ind_bonus(Request $request){
        $company_id= Session::get('company_id');
        $emp_id=$request->get('edit_emp_id');
        $emp_amount=$request->get('edit_amount');
        $emp_description=$request->get('edit_description');
        $emp_date=$request->get('edit_date');
        $session_name=$request->get('edit_session_name');
        $edit_arrear_id=$request->get('edit_arrear_id');

        $username=Session::get('username');
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $result=  DB::connection('sqlsrv2')->update('update PayrollBonuses set EmployeeID=?, BonusDate=?, BonusAmount=?, Descriptions=? where BonusID=? and CompanyID=?',[$emp_id, $emp_date, $emp_amount,$emp_description, $edit_arrear_id, $company_id]);

        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Bonuse updated', 'Bonuse of '.$emp_id.' updated' , $update_date]);

        if($result){
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollBonuses', 'Emp_Profile.EmployeeID', '=', 'PayrollBonuses.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollBonuses.BonusDate', 'desc')->select('Emp_Profile.Name', 'PayrollBonuses.*', 'Emp_Register.Department', 'Emp_Register.PostingCity', 'Emp_Register.Designation', 'Emp_Register.EmployeeCode', 'Emp_Register.Salary', 'Emp_Register.JoiningDate')->where('PayrollBonuses.CompanyID','=', $company_id)->paginate(15);
           
            return request()->json(200,$arr);
        }
    }

   public function submit_dues(Request $request){
        $company_id= Session::get('company_id');
        $username=Session::get('username'); 
        $UserFullName=Session::get('UserName');
        $emp_id=$request->get('emp_emp_id');
        $emp_amount=$request->get('emp_amount');

        $emp_description=$request->get('emp_description');
        $emp_date=$request->get('emp_date');
        $session_name=$request->get('session_name');
        $dues_type=$request->get('dues_type');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        for($x=0; $x<count($emp_id); $x++){
            $se = explode("_" , $emp_id[$x]);
            $find_employee_id= DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('EmployeeCode','=',$se[1])->get();
            foreach($find_employee_id as $find_employee_id1){
            }
       
            $sub_emp_id=$find_employee_id1->EmployeeID;
            $result=DB::connection('sqlsrv2')->insert("INSERT INTO PayrollDues(CompanyID,EmployeeID,SessionName,DuesType,DuesDate,DuesAmount,Descriptions,Status,CreatedBy,CreatedOn) values (?,?,?,?,?,?,?,?,?,?)", [$company_id,$sub_emp_id,$session_name,$dues_type,$emp_date,$emp_amount,$emp_description,'Pending',$username,$update_date]);

            $full_name_arr = DB::connection('sqlsrv2')->table('Emp_Profile')
            ->select('Name')->where('EmployeeID','=', $sub_emp_id)->where('CompanyID','=', $company_id)->get();
            foreach ($full_name_arr as $full_name_arr1) {
                # code...
            }
            $full_name = $full_name_arr1->Name;

            DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Dues Applied', ' Dues of '.$full_name.' applied' , $update_date]);
        }
        $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollDues', 'Emp_Profile.EmployeeID', '=', 'PayrollDues.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=',  'Emp_Register.EmployeeID')->orderBy('PayrollDues.DuesDate', 'desc')->select('Emp_Profile.Name','PayrollDues.*', 'Emp_Register.Department', 'Emp_Register.PostingCity', 'Emp_Register.Designation', 'Emp_Register.EmployeeCode', 'Emp_Register.Salary', 'Emp_Register.JoiningDate')->where('PayrollDues.CompanyID','=', $company_id)->paginate(15);
        return request()->json(200,$arr);
    }
  public function fetch_payroll_dues(){
        $company_id= Session::get('company_id');
             $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollDues', 'Emp_Profile.EmployeeID', '=', 'PayrollDues.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollDues.DuesDate', 'desc')->select('Emp_Profile.Name','PayrollDues.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.Salary','Emp_Register.JoiningDate')->where('PayrollDues.CompanyID','=',$company_id)->paginate(15);
           
             return request()->json(200,$arr);
  }
  public function find_payroll_dues($id){
      $company_id= Session::get('company_id');
        $result=DB::connection('sqlsrv2')->table('PayrollDues')->where('CompanyID','=',$company_id)->where('DuesID','=',$id)->get();
      return request()->json(200,$result);
  }
    public function update_ind_dues(Request $request){
        $company_id= Session::get('company_id');
        $username= Session::get('username');
        $UserFullName=Session::get('UserName');
        $emp_id=$request->get('edit_emp_id');
        $emp_amount=$request->get('edit_amount');
        $emp_description=$request->get('edit_description');
        $emp_date=$request->get('edit_date');
        $session_name=$request->get('edit_session_name');
        $edit_arrear_id=$request->get('edit_arrear_id');
        $edit_dues_type=$request->get('edit_dues_type');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $full_name_arr = DB::connection('sqlsrv2')->table('Emp_Profile')->select('Name')->where('EmployeeID','=', $emp_id)->where('CompanyID','=', $company_id)->get();
        foreach ($full_name_arr as $full_name_arr1) {
            # code...
        }
        $full_name = $full_name_arr1->Name;

        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Dues updated', ' Dues of '.$full_name.' updated' , $update_date]);

        $result=  DB::connection('sqlsrv2')->update('update PayrollDues set EmployeeID=?,DuesType=?,DuesDate=?,DuesAmount=?,Descriptions=? where DuesID=? and CompanyID=?',[$emp_id, $edit_dues_type,$emp_date, $emp_amount, $emp_description,$edit_arrear_id,$company_id]);
        if($result){
            $arr = DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollDues', 'Emp_Profile.EmployeeID', '=', 'PayrollDues.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollDues.DuesDate', 'desc')->select('Emp_Profile.Name','PayrollDues.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.Salary','Emp_Register.JoiningDate')->where('PayrollDues.CompanyID','=',$company_id)->paginate(15);
           
            return request()->json(200,$arr);
        }
    }

     public function approve_dues($id){
        $company_id= Session::get('company_id');
        $username=Session::get('username'); 
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $result=  DB::connection('sqlsrv2')->update('update PayrollDues set Status=?,ApprovedBy=? where DuesID=? and CompanyID=?',['Approved', $username, $id, $company_id]);
        if($result){
            
            $full_name_arr = DB::connection('sqlsrv2')->table('PayrollDues')
            ->join('Emp_Profile', 'PayrollDues.EmployeeID', '=', 'Emp_Profile.EmployeeID')
            ->select('Emp_Profile.Name')
            ->where('Emp_Profile.CompanyID','=', $company_id)->where('PayrollDues.DuesID','=', $id)->get();
            foreach ($full_name_arr as $full_name_arr1) {
                # code...
            }
            $full_name = $full_name_arr1->Name;
            DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Dues Status Changed', ' Dues of '.$full_name.' approved' , $update_date]);

            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollDues', 'Emp_Profile.EmployeeID', '=', 'PayrollDues.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollDues.DuesDate', 'desc')->select('Emp_Profile.Name','PayrollDues.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.Salary','Emp_Register.JoiningDate')->where('PayrollDues.CompanyID','=',$company_id)->paginate(15);
           
            return request()->json(200,$arr);
        }
    }

    public function fetch_payroll_allowance(){
      $company_id= Session::get('company_id');
     $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollAllowance', 'Emp_Profile.EmployeeID', '=', 'PayrollAllowance.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollAllowance.ApplyDate', 'desc')->select('Emp_Profile.Name','PayrollAllowance.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.Salary','Emp_Register.JoiningDate')->where('PayrollAllowance.CompanyID','=',$company_id)->paginate(15);
           
             return request()->json(200,$arr);
    }
    
     public function submit_allowance(Request $request){
        $company_id= Session::get('company_id');
        $UserFullName=Session::get('UserName');
        $emp_id=$request->get('emp_emp_id');
        $emp_amount=$request->get('emp_amount');
        $emp_description=$request->get('emp_description');
        $emp_date=$request->get('emp_date');
        $session_name=$request->get('session_name');
        $username=Session::get('username'); 
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");      
        $allowance_type=$request->get('allowance_type');

        $find_session =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->get();
        foreach ($find_session as $find_session1) {
        }
        $s_date=$find_session1->StartDate;
        $e_date=$find_session1->EndDate;

        for($x=0;$x<count($emp_id);$x++){

            $se = explode("_" , $emp_id[$x]);

            $find_employee_id= DB::connection('sqlsrv2')->table('Emp_Register')->where('CompanyID','=',$company_id)->where('EmployeeCode','=',$se[1])->get();
            foreach($find_employee_id as $find_employee_id1){
            }
       
            $sub_emp_id=$find_employee_id1->EmployeeID;

            DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Allowance Applied', ' Allowance of '.$sub_emp_id.' applied' , $update_date]);
        
            $result=DB::connection('sqlsrv2')->insert("INSERT INTO PayrollAllowance(CompanyID,EmployeeID,StartSession,SessionEndDate,ApplyDate,AllowanceType,AllowanceAmount,Descriptions,Status,CreatedBy,CreatedOn) values (?,?,?,?,?,?,?,?,?,?,?)", [$company_id,$sub_emp_id,$session_name,$e_date,$emp_date,$allowance_type,$emp_amount,$emp_description,'Pending',$username,$update_date]);
        }
        $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollAllowance', 'Emp_Profile.EmployeeID', '=', 'PayrollAllowance.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollAllowance.ApplyDate', 'desc')->select('Emp_Profile.Name','PayrollAllowance.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.Salary','Emp_Register.JoiningDate')->where('PayrollAllowance.CompanyID','=',$company_id)->paginate(15);
        return request()->json(200,$arr);
    }

    public function approve_allowance($id){
        $company_id= Session::get('company_id');
        $UserFullName=Session::get('UserName');
        $username=Session::get('username'); 
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $result=  DB::connection('sqlsrv2')->update('update PayrollAllowance set Status=?,ApprovedBy=? where AllowanceID=? and CompanyID=?',['Approved', $username, $id, $company_id]);

        $id_arr = DB::connection('sqlsrv2')->table('PayrollAllowance')->select('EmployeeID')->where('AllowanceID','=', $id)->where('CompanyID','=', $company_id)->get();
        foreach ($id_arr as $id_arr1) {
            # code...
        }
        $emp_id = $id_arr1->EmployeeID;
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Allowance Status Changed', ' Allowance of '.$emp_id.' approved' , $update_date]);

        if($result){
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollAllowance', 'Emp_Profile.EmployeeID', '=', 'PayrollAllowance.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollAllowance.ApplyDate', 'desc')->select('Emp_Profile.Name','PayrollAllowance.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode','Emp_Register.Salary','Emp_Register.JoiningDate')->where('PayrollAllowance.CompanyID','=',$company_id)->paginate(15);
           
            return request()->json(200,$arr);
        }
    }
 public function find_payroll_allowance($id){
      $company_id= Session::get('company_id');
        $result=DB::connection('sqlsrv2')->table('PayrollAllowance')->where('CompanyID','=',$company_id)->where('AllowanceID','=',$id)->get();
      return request()->json(200,$result);
  }
  public function update_ind_allowance(Request $request){
        $company_id= Session::get('company_id');
        $username=Session::get('username'); 
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $emp_id=$request->get('edit_emp_id');
        $emp_amount=$request->get('edit_amount');
        $emp_description=$request->get('edit_description');
        $emp_date=$request->get('edit_date');
        $session_name=$request->get('edit_session_name');
        $edit_arrear_id=$request->get('edit_bonus_id');
        $edit_allowance_type=$request->get('edit_allowance_type');
         

        $result=  DB::connection('sqlsrv2')->update('update PayrollAllowance set EmployeeID=?, ApplyDate=?, AllowanceType=?, AllowanceAmount=?, Descriptions=? where AllowanceID=? and CompanyID=?',[$emp_id, $emp_date, $edit_allowance_type, $emp_amount, $emp_description, $edit_arrear_id,$company_id]);

        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Allowance updated', 'Allowance of '.$emp_id.' updated' , $update_date]);

        if($result){
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('PayrollAllowance', 'Emp_Profile.EmployeeID', '=', 'PayrollAllowance.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('PayrollAllowance.ApplyDate', 'desc')->select('Emp_Profile.Name','PayrollAllowance.*','Emp_Register.Department','Emp_Register.PostingCity', 'Emp_Register.Designation', 'Emp_Register.EmployeeCode', 'Emp_Register.Salary', 'Emp_Register.JoiningDate')->where('PayrollAllowance.CompanyID','=',$company_id)->paginate(15);
            return request()->json(200,$arr);
        }
    }

     public function filter_leaves_byId(Request $request){
        $company_id=Session::get('company_id');
          
        $arr =DB::connection('sqlsrv2')->table('Emp_Profile')
        ->join('EmpLeave', 'Emp_Profile.EmployeeID', '=', 'EmpLeave.EmployeeID')
        ->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')
        ->orderBy('EmpLeave.EmployeeID', 'desc')
        ->select('Emp_Profile.Name','Emp_Profile.Photo','EmpLeave.*','Emp_Register.Department','Emp_Register.PostingCity','Emp_Register.Designation','Emp_Register.EmployeeCode')
        ->where('EmpLeave.CompanyID','=',$company_id)
        ->where('Emp_Register.EmployeeCode','like','%'.$request->emp_name_code.'%')->orwhere('Emp_Profile.Name','like','%'.$request->emp_name_code.'%')
        ->get();
        return request()->json(200,$arr);
      }

      //Functions
 public function session_att(){
        $company_id = Session::get('company_id');
        date_default_timezone_set("Asia/Karachi");
        $today = date("Y-m-d");
        /*
        $present = DB::connection('sqlsrv2')->table('Emp_Register')
        ->join('AttData', 'Emp_Register.EmployeeID', 'AttData.EmpID')
        ->select('Emp_Register.Department')
        ->groupBy('Emp_Register.Department')
        ->where('AttData.AttStatus', '=', "P")->where('AttData.CompanyID', '=', $company_id)->where('AttData.ATTDate', '=', $today)
        ->count();
        */
        $p='P';
        $a='A';
        $l='L';
        $result=DB::connection('sqlsrv2')->select("select Department, count (Department) as TotalEmployee ,
                sum(case when AttStatus = '".$p."' then 1 else 0 end) AS Present,
                sum(case when AttStatus = '".$a."' then 1 else 0 end) AS Absent,
              sum(case when AttStatus = '".$l."' then 1 else 0 end) AS Leave
              from  Emp_Register er
              join Attdata ad  on  er.EmployeeCode = ad.EmpCode
              where ATTDate = '$today'
               group by Department");

        return request()->json(200, $result);
    }

    public function hrdb_employee_count(Request $request){
        $company_id = Session::get('company_id');
        date_default_timezone_set("Asia/Karachi");
        $date = date("Y-m-d");

        $male = DB::connection('sqlsrv2')->table('Emp_Profile')->where('Gender', '=', "Male")->where('CompanyID', '=', $company_id)->count();
        $female = DB::connection('sqlsrv2')->table('Emp_Profile')->where('Gender', '=', "Female")->where('CompanyID', '=', $company_id)->count();
        $all_emp = DB::connection('sqlsrv2')->table('Emp_Profile')->where('CompanyID', '=', $company_id)->count();

        $sus_emp = DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->where('Emp_Register.Status', '=', "Suspended")->where('Emp_Register.RegDate', '<=', $date)->where('Emp_Profile.CompanyID', '=', $company_id)->count();
        $sus_emp_percentage = round ((float)($sus_emp/$all_emp)*100, 1);

        $exp_date = date('Y-m-d', strtotime($date. " + 30 days"));
        $cnic_exp_emp = DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.ProbationEnd', 'desc')->where('Emp_Profile.CnicExpiry', '<=', $exp_date)->where('Emp_Profile.CompanyID', '=', $company_id)->count();

        $status_exp_emp = DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.ProbationEnd', 'desc')->where('Emp_Register.ProbationEnd', '<=', $exp_date)->where('Emp_Profile.CompanyID', '=', $company_id)->count();

        $myJSON = array(
            'males' => $male,
            'females' => $female,
            'all' => $all_emp,
            'suspended' => $sus_emp,
            'sus_per' => $sus_emp_percentage,
            'cnic_exp_cnt' => $cnic_exp_emp,
            'status_exp_cnt' => $status_exp_emp,
        );
        return request()->json(200, $myJSON);
    }

    public function job_exp_employee(Request $request){
        $company_id = Session::get('company_id');
        date_default_timezone_set("Asia/Karachi");
        $date = date("Y-m-d");

        $exp_date = date('Y-m-d', strtotime($date. " + 30 days"));

        $job_exp_emp = DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.ProbationEnd', 'desc')->select('Emp_Profile.Name', 'Emp_Register.EmployeeCode', 'Emp_Register.Status', 'Emp_Register.Designation', 'Emp_Register.Department', 'Emp_Register.ProbationEnd')->where('Emp_Register.ProbationEnd', '<=', $exp_date)->where('Emp_Profile.CompanyID', '=', $company_id)->get();
        return request()->json(200, $job_exp_emp);
    }
    public function get_gracePeriods($designation,$location,$department){
        $company_id=Session::get('company_id');

        if($designation=='All' && $department=='All' && $location=='All'){
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('EmpGraceHours', 'Emp_Profile.EmployeeID', '=', 'EmpGraceHours.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('EmpGraceHours.EmployeeID', 'desc')->select('Emp_Profile.Name', 'Emp_Profile.Photo', 'EmpGraceHours.*', 'Emp_Register.Department', 'Emp_Register.PostingCity', 'Emp_Register.Designation', 'Emp_Register.EmployeeCode')->where('EmpGraceHours.CompanyID','=',$company_id)->paginate(15);
            return request()->json(200,$arr);
        }
        else{
            if($department=='All'){
                $department='';
            }
            if($designation=='All'){
                $designation='';
            }
            if($location=='All'){
                $location='';
            }
            $arr =DB::connection('sqlsrv2')->table('Emp_Profile')->join('EmpGraceHours', 'Emp_Profile.EmployeeID', '=', 'EmpGraceHours.EmployeeID')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('EmpGraceHours.EmployeeID', 'desc')->select('Emp_Profile.Name','Emp_Profile.Photo', 'EmpGraceHours.*', 'Emp_Register.Department', 'Emp_Register.PostingCity', 'Emp_Register.Designation', 'Emp_Register.EmployeeCode')->where('Emp_Register.Designation','like','%'.$designation.'%')->where('Emp_Register.PostingCity', 'like','%'.$location.'%')->where('Emp_Register.Department','like','%'.$department.'%')->where('EmpGraceHours.CompanyID', '=', $company_id)->paginate(15);
            return request()->json(200, $arr);
        }
      }
    public function cnic_exp_employee(Request $request){
        $company_id = Session::get('company_id');
        date_default_timezone_set("Asia/Karachi");
        $date = date("Y-m-d");

        $exp_date = date('Y-m-d', strtotime($date. " + 30 days"));

        $cnic_exp_emp = DB::connection('sqlsrv2')->table('Emp_Profile')->join('Emp_Register', 'Emp_Profile.EmployeeID', '=', 'Emp_Register.EmployeeID')->orderBy('Emp_Register.ProbationEnd', 'desc')->select('Emp_Profile.Name', 'Emp_Register.EmployeeCode', 'Emp_Register.Status', 'Emp_Register.Designation', 'Emp_Register.Department', 'Emp_Profile.CnicExpiry')->where('Emp_Profile.CnicExpiry', '<=', $exp_date)->where('Emp_Profile.CompanyID', '=', $company_id)->get();
        return request()->json(200, $cnic_exp_emp);
    }
    public function return_loan(Request $request){
        $company_id = Session::get('company_id');
        $username = Session::get('username');
        $UserFullName=Session::get('UserName');
        $loanid = $request->get('loanid');
        $pay_emp_id = $request->get('pay_emp_id');
        $returnamount = $request->get('returnamount');
        $pay_type = $request->get('pay_type');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
        
        
        $emp_code_arr = DB::connection('sqlsrv2')->table('Emp_Register')->select('EmployeeCode')->where('EmployeeID', '=', $pay_emp_id)->where('CompanyID', '=', $company_id)->get();
        foreach ($emp_code_arr as $emp_code_arr1) {
              # code...
            }
        $emp_code = $emp_code_arr1->EmployeeCode;
        
        
        $find_session_closed =DB::connection('sqlsrv2')->table('HrSessions')->where('CompanyID','=',$company_id)->where('CurrentSession','=',1)->where('AttClosedPayrollStart','=','Closed')->get();
        foreach ($find_session_closed as $find_session1) {
           }
        $sesson_name=$find_session1->SessionName;

        $ins_cnt = DB::connection('sqlsrv2')->table('LoanDetail')->where('CompanyID','=',$company_id)->where('LoanId','=', $loanid)->where('InstallmentSession','!=', $sesson_name)->count();

        for($x=1; $x<=$ins_cnt; $x++){
        $amt_clt = DB::connection('sqlsrv2')->table('LoanDetail')->where('CompanyID','=',$company_id)->where('LoanId','=', $loanid)->where('InstallmentSession','!=', $sesson_name)->sum('InstallmentAmount');
        }
        if($returnamount == $amt_clt){
            
            DB::connection('sqlsrv2')->update('update LoanRequisition set  ReqStatus=?, UpdatedOn=?, UpdatedBy=? where LoanId=? AND CompanyID=?',['Returned', $update_date, $username, $loanid, $company_id]);

            for($x=1; $x<=$ins_cnt; $x++){
            DB::connection('sqlsrv2')->update('update LoanDetail set InstallmentStatus=?, UpdatedOn=?, UpdatedBy=? where LoanId=? AND CompanyID=? AND InstallmentSession!=?',['Returned', $update_date, $username, $loanid, $company_id, $sesson_name]);
            }

            DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, $pay_type.' Returned', $pay_type.' of '.$emp_code.' Returned' , $update_date]);
        
            $message = "Loan returned!";
        }
        else{
            $message = "Loan amount not correct!";
        }

        return request()->json(200, $message);
    }


     public function submit_warn_reas(Request $request){
        $company_id = Session::get('company_id');
        $username=Session::get('username');
         $UserFullName=Session::get('UserName');
        $reason_name = $request->get('reason_name');
        $reason_desc = $request->get('reason_desc');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        DB::connection('sqlsrv2')->insert("INSERT INTO Warning_Reason(ReasonName, ReasonContent, CreatedBy, CreatedOn, CompanyID) values (?,?,?,?,?)", [$reason_name, $reason_desc, $username, $update_date, $company_id]);
         DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Warning Reason added','Warning Reason '.$reason_name.' added', $update_date]);


        $arr = "Warning reason added";
        return request()->json(200, $arr);
    }
    public function delete_warn_reas($id){
        $company_id=Session::get('company_id');
        $username=Session::get('username');
        $UserFullName=Session::get('UserName');
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");

        $warning_reason_arr = DB::connection('sqlsrv2')->table('Warning_Reason')->where('CompanyID','=',$company_id)->where('ReasonID','=', $id)->get();
        foreach ($warning_reason_arr as $warning_reason_arr1) {
           }
        $warning_reason=$warning_reason_arr1->ReasonName;

        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Delete Warning Reason','Warning Reason '.$warning_reason.' deleted', $update_date]);



        $result = DB::connection('sqlsrv2')->table('Warning_Reason')->where('ReasonID', $id)->delete();

        if($result) {
        $company_id=Session::get('company_id');
           
        $arr= DB::connection('sqlsrv2')->table("Warning_Reason")->where('CompanyID','=',$company_id)->orderBy('ReasonID','desc')->paginate(5);
        return request()->json(200, $arr);
    }
  }
    public function warning_reason(){
        $company_id=Session::get('company_id');
        $arr= DB::connection('sqlsrv2')->table("Warning_Reason")->where('CompanyID','=',$company_id)->orderBy('ReasonID','desc')->paginate(5);
        return request()->json(200, $arr);
    }
    public function submit_emp_leaves(Request $request){
        $company_id = Session::get('company_id');
        $username=Session::get('username');
        $UserFullName=Session::get('UserName');
        $lv_emp_id = $request->get('lv_emp_id');
        $lv_type = $request->get('lv_type');
        $lv_nmbr= $request->get('lv_nmbr');
        
        date_default_timezone_set("Asia/Karachi");
        $update_date=date("Y-m-d h:i:s A");
        $exist = DB::connection('sqlsrv2')->table('EmpLeave')->where('CompanyID', '=', $company_id)->where('EmployeeID', '=', $lv_emp_id)->where('LeaveType', '=', $lv_type)->exists();

        $full_name_arr= DB::connection('sqlsrv2')->table('Emp_Register')->where('EmployeeID', '=', $lv_emp_id)->get();
        foreach ($full_name_arr as $full_name_arr1) {
              # code...
            }
        $emp_code = $full_name_arr1->EmployeeCode;


        if($exist){
            $result = DB::connection('sqlsrv2')->table('EmpLeave')->select('TotalLeave', 'RemainingLeave')->where('CompanyID', '=', $company_id)->where('EmployeeID', '=', $lv_emp_id)->where('LeaveType', '=', $lv_type)->get();
            foreach ($result as $result1) {
                  # code...
            }
            $lv_number1 = $result1->TotalLeave;
            $rem_lvs = $result1->RemainingLeave;
            $lv_number2 = $lv_nmbr + $lv_number1;
            $rem = $rem_lvs + $lv_nmbr;
            DB::connection('sqlsrv2')->update('update EmpLeave set TotalLeave=?, RemainingLeave=?, UpdatedBy=?, UpdatedOn=? where EmployeeID=? AND LeaveType=? AND CompanyID=?',[$lv_number2, $rem, $username, $update_date, $lv_emp_id, $lv_type, $company_id]);
            
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Employee Leave updated', $lv_type.' Leaves of '.$emp_code.' updated', $update_date]);

            $arr = "Employee leave updated";
        }
        else{
            DB::connection('sqlsrv2')->insert("INSERT INTO EmpLeave(RemainingLeave, EmployeeID, LeaveType, TotalLeave, CreatedBy, CreatedOn, CompanyID) values (?,?,?,?,?,?,?)", [$lv_nmbr, $lv_emp_id, $lv_type, $lv_nmbr, $username, $update_date, $company_id]);
            
        DB::insert("INSERT INTO Activity_Log(CompanyId, UserEmail, EmployeeName, EventStatus, Description, ActivityTime) values (?,?,?,?,?,?)", [$company_id, $username, $UserFullName, 'Employee Leave added', $lv_type.' Leave of '.$emp_code.' added', $update_date]);

            $arr = "Employee leave added";
        }
        
        return request()->json(200, $arr);
    }

  }