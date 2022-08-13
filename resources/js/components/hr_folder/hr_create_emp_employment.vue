<template>
    <div v-if="user_access.hr_write=='true'">
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <router-link to="/hr/dashboard" style="text-decoration: none;">Dashboard</router-link>
                            </li>
                            <li class="breadcrumb-item">
                                <router-link to="/hr/employees_detail" style="text-decoration: none;">Employees Detail</router-link>
                            </li>
                            <li class="breadcrumb-item active">
                                Add Employement
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="content-body">
                    <div class="card">
                        <div class="card-body">
                            <p>
                                <div class="row" style="border: 1px solid lightgrey;padding-top:20px;padding-bottom:10px">
                                    <div class=" col-12 col-sm-12 mb-1card-header"><h4 class="card-title">Employement Detail</h4></div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label">Reporting To</label>
                                        <select class="form-select" v-model="reporting_to">
                                            <option value="">Select Employee</option>

                                            <option v-for='employees_detail1 in employees_detail' :key="employees_detail1" :value='employees_detail1.EmployeeID'>{{ employees_detail1.Name }}_{{ employees_detail1.EmployeeCode }}</option>
                                        </select>
                                        <label style="color: #d93025" v-if="reporting_to==''">{{e_reporting_to}}</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label" for="accountPhoneNumber">Second Reporting</label>
                                        <select class="form-select" v-model="second_reporting">
                                            <option value="">Select Employee</option>
                                            <option v-for='employees_detail2 in employees_detail' :key="employees_detail2" :value='employees_detail2.EmployeeID'>{{ employees_detail2.Name }}_{{ employees_detail2.EmployeeCode }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label">Job Shift</label>
                                        <select class="form-select" v-model="job_shift">
                                            <option value="">Select Shift</option>
                                            <option v-for='roster2 in rosters' :value='roster2.RosterName' :key="roster2">{{ roster2.RosterName }}</option>

                                        </select>
                                        <label style="color: #d93025" v-if="job_shift==''">{{e_job_shift}}</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label">Work Location</label>
                                        <select class="form-select" v-model="work_location">
                                            <option value="">Select Location </option>
                                            <option v-for='locations1 in locations' :key="locations1" :value='locations1.location_name'>{{ locations1.location_name }}</option>
                                        </select>
                                        <label style="color: #d93025" v-if="work_location==''">{{e_work_location}}</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label" for="accountEmail">Date Of Joining</label>
                                        <input type="date" class="form-control" id="accountEmail" v-model="doj" placeholder="">
                                        <label style="color: #d93025" v-if="doj==''">{{e_doj}}</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label" for="accountEmail">Employee Code</label>
                                        <input type="text" class="form-control" id="accountEmail" readonly="" v-model="emp_code" placeholder="">
                                        <label style="color: #d93025" v-if="emp_code==''">{{e_emp_code}}</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label" for="accountEmail1">Company Email Id</label>
                                        <input type="email" class="form-control" id="accountEmail1" v-model="company_email_id" placeholder="">
                                        <span style="color: #d93025" v-if="company_email_id==''">{{e_company_email_id}}</span>
                                    </div>

                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label" for="accountEmail">Salary</label>
                                        <input v-if="this.emp_salary9==''||this.emp_salary9==0" type="number" class="form-control" v-model="emp_salary">
                                        <input v-else readonly type="number" class="form-control" v-model="emp_salary">
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label" for="accountOrganization">Stipend</label>
                                        <input type="number" class="form-control" v-model="emp_stipend">
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label" for="accountPhoneNumber">Employee Status</label>
                                        <select class="form-select" v-model="emp_status">
                                            <option value="">Select Status</option>
                                            <option value="Suspended">Suspended</option>
                                            <option value="Terminate">Terminate</option>
                                            <option value="Resigned">Resigned</option>
                                            <option value="Registered">Registered</option>
                                        </select>
                                        <label style="color: #d93025" v-if="emp_status==''">{{e_emp_status}}</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label" for="accountPhoneNumber">Job Status</label>
                                        <select class="form-select" v-model="emp_job_status">
                                            <option value="">Select Status</option>
                                            <option value="Probation">Probation</option>
                                            <option value="Contract">Contract</option>
                                            <option value="Parmanent">Parmanent</option>
                                        </select>
                                        <label style="color: #d93025" v-if="emp_job_status==''">{{e_emp_job_status}}</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label" for="accountPhoneNumber">Probation Days</label>
                                        <input type="number" class="form-control account-number-mask" v-model="emp_pro_days" placeholder="Enter number of days">
                                        <label style="color: #d93025" v-if="emp_pro_days==''">{{e_emp_pro_days}}</label>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-1">
                                        <label class="form-label">Job Description</label>
                                        <label style="color: #d93025">*</label>
                                        <vue-editor style="height:200px;" v-model="job_description" placeholder="Add Job Description"></vue-editor>
                                        <div style="height:80px;"></div>
                                        <label style="color: #d93025" v-if="job_description==''">{{e_job_description}}</label>
                                    </div>
                                    <div class="col-md-6 col-sm-12 mb-1">
                                        <label class="form-label">Remarks</label>
                                        <vue-editor style="height:200px;" v-model="remarks" placeholder="Add Remarks"></vue-editor>
                                        <div style="height:80px;"></div>
                                    </div>
                                    <div class="col-md-2 col-sm-12 mb-1">
                                        <div class="mb-1">
                                            <label class="form-label" for="basicSelect">Method Type</label>
                                            <label style="color: #d93025">*</label>
                                            <div class="demo-inline-spacing">
                                                <div class="form-check form-check-inline" style="margin-top:0px">
                                                    <input class="form-check-input" type="radio" v-model="methodtype" name="inlineRadioOptions" id="inlineRadio1" value="Cash" checked="">
                                                    <label class="form-check-label" for="inlineRadio1">Cash</label>
                                                </div>
                                                <div class="form-check form-check-inline" style="margin-top:0px">
                                                    <input class="form-check-input" type="radio" v-model="methodtype" name="inlineRadioOptions" id="inlineRadio2" value="Bank Transfer">
                                                    <label class="form-check-label" for="inlineRadio2">Bank Transfer</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-12 mb-1" v-if="methodtype=='Bank Transfer'">
                                        <label class="form-label" for="accountpassword">Bank Name</label>
                                        <input type="text" placeholder="" class="form-control" v-model="bankname" />
                                    </div>
                                    <div class="col-md-4 col-sm-12 mb-1" v-if="methodtype=='Bank Transfer'">
                                        <label class="form-label" for="accountpassword">Account Number</label>
                                        <input type="text" placeholder="Bank Account Number" class="form-control" v-model="bankaccount" />
                                    </div>
                                    <div class="col-md-3 col-sm-12 mb-1" v-if="methodtype=='Bank Transfer'">
                                        <label class="form-label" for="accountpassword">Account Name</label>
                                        <input type="text" placeholder="" class="form-control" v-model="accountname" />
                                    </div>
                                </div>
                                <div class="row" style="border: 1px solid lightgrey;margin-top:20px;padding-top:20px;padding-bottom:20px">
                                    <div class=" col-12 col-sm-12 mb-1card-header"><h4 class="card-title">Add Designation And Department</h4></div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label">Child Company</label>
                                        <select class="form-select" v-model="child_company">
                                            <option value="">Child Company</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label" for="accountPhoneNumber">Department</label>
                                        <select class="form-select" v-model="emp_department">
                                            <option value="">Select Department</option>

                                            <option v-for='departments1 in departments' :key="departments1" :value='departments1.department_name'>{{ departments1.department_name }}</option>
                                        </select>
                                        <label style="color: #d93025" v-if="emp_department==''">{{e_emp_department}}</label>
                                    </div>
                                    <div class="col-md-4 col-sm-6 mb-1">
                                        <label class="form-label" for="accountPhoneNumber">Designation</label>
                                        <select class="form-select" v-model="emp_designation">
                                            <option value="">Select Designation </option>
                                            <option v-for='designation1 in designations' :key="designation1" :value='designation1.designation_name'>{{ designation1.designation_name }}</option>
                                        </select>
                                        <label style="color: #d93025" v-if="emp_designation==''">{{e_emp_designation}}</label>
                                    </div>
                                </div>
                                <div class="row" style="border: 1px solid lightgrey;margin-top:20px;padding-top:20px;padding-bottom:20px">
                                    <table style="margin-left:9px;">
                                        <tr>
                                            <td style="width:130px;">
                                                <label class="form-label" style="font-size:14px;padding-right:20px">Notifications:</label>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" v-model="hr_notifications" id="inlineCheckbox2">
                                                <label class="form-check-label" for="inlineCheckbox2">Send eMail,SMS notification of HR Activities</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="form-label" style="font-size:14px;padding-right:20px" for="accountPhoneNumber">Permissions:</label>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" v-model="att_check" id="inlineCheckbox1">
                                                <label class="form-check-label" for="inlineCheckbox1">Allow to other employees  Punch In & Out from the employee's Application</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div v-if="att_check==true" class="row">
                                                    <div class="col-md-12 col-sm-12 mb-1">
                                                        <multiselect style="margin-right: 10px;"
                                                                     v-model="selected"
                                                                     :multiple="true"
                                                                     :options="options">
                                                        </multiselect>

                                                    </div>

                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label class="form-label" style="font-size:14px;padding-right:20px" for="accountPhoneNumber">Portal Access:</label>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" v-model="login_check" id="inlineCheckbox3">
                                                <label class="form-check-label" for="inlineCheckbox3">Login to the  Application, Employee can login with their eMail and Password to the Application</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <div class="col-md-12 col-sm-6 mb-1">
                                                    <div v-if="login_check==true" class="row">
                                                        <div class="col-md-4 col-sm-6 mb-1">
                                                            <label class="form-label" for="accountEmail">User Email</label>
                                                            <input type="email" class="form-control" id="accountEmail" v-model="user_email" placeholder="abc@gmail.com">
                                                            <label style="color: #d93025" v-if="!validEmail(user_email)">{{e_user_email}}</label>
                                                        </div>
                                                        <div class="col-md-4 col-sm-6 mb-1">
                                                            <label class="form-label" for="accountpassword">User Password</label>
                                                            <input type="password" class="form-control" id="password" v-model="user_password">
                                                            <label style="color: #d93025" v-if="user_password==''">{{e_user_password}}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <label style="color: #d93025" v-if="hr_notifications != true && att_check != true && login_check!=true">{{e_check}}</label>
                                    <div class="col-12" style="text-align:center">
                                        <button :disabled="disabled" @click="delay()" type="button" class="btn btn-primary mt-1 me-1 waves-effect waves-float waves-light">Update Employee Profile</button>
                                        <div>
                                        </div>
                                    </div>
                                </div>
                          
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- END: Content-->
    </div>
</template>
<script>
    import Multiselect from 'vue-multiselect'
    export default {

        data() {

            return {
                selected: null,
                designations: {},
                user_access: {},
                options: [],

                emp_data: {},
                employees_detail5: {},
                locations: {},
                employees_detail: {},
                departments: {},
                emp_code: '',
                company_email_id: '',
                e_company_email_id: '',
                e_emp_code: '',
                doj: '',
                e_doj: '',

                login_check: '',
                m_status: '',

                reporting_to: '',
                e_reporting_to: '',

                second_reporting: '',
                job_shift: '',
                e_job_shift: '',

                work_location: '',
                e_work_location: '',

                emp_salary: '',
                emp_stipend: '',
                emp_status: '',
                e_emp_status: '',

                emp_job_status: '',
                e_emp_job_status: '',

                emp_pro_days: '',
                e_emp_pro_days: '',

                job_description: '',
                e_job_description: '',

                remarks: '',

                child_company: '',
                emp_department: '',
                e_emp_department: '',

                emp_designation: '',
                e_emp_designation: '',

                hr_notifications: '',
                att_check: '',
                e_check: '',

                user_email: '',
                e_user_email: '',

                user_password: '',
                e_user_password: '',
                rosters: {},
                id: this.$route.params.id,
                emp_salary9: '',
                methodtype: 'Cash',
                bankaccount: '',
                bankname: '',
                accountname: '',

                disabled: false,
                timeout: null,
            }
        },
        components: { Multiselect },
        methods: {
            delay() {
                this.disabled = true
                this.timeout = setTimeout(() => {
                    this.disabled = false
                }, 5000)
                this.submit_employment()
            },
            validEmail: function (email) {
                var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            submit_employment() {

                if (this.reporting_to == '' || this.job_shift == '' || this.work_location == '' || this.doj == '' || this.emp_status == '' || this.emp_code == null ||
                    this.emp_job_status == '' || this.emp_pro_days == '' || this.job_description == '' || this.emp_department == '' ||
                    this.emp_designation == '') {
                    //Form validation starts

                    if (this.company_email_id != '') {
                        if (!this.validEmail(this.company_email_id)) {
                            this.e_company_email_id = 'Valid email required!'
                        }
                    }
                    if (this.reporting_to == '') {
                        this.e_reporting_to = 'Select a person to report whome!'
                    } else {
                        this.e_reporting_to = ''
                    }
                    if (this.emp_code == '') {
                        this.e_emp_code = 'Select the employee code'
                    } else {
                        this.e_emp_code = ''
                    }
                    if (this.job_shift == '') {
                        this.e_job_shift = 'Select job shift!'
                    } else {
                        this.e_job_shift = ''
                    }
                    if (this.work_location == '') {
                        this.e_work_location = 'Select work location!'
                    } else {
                        this.e_work_location = ''
                    }
                    if (this.doj == '') {
                        this.e_doj = 'Select date of joining!'
                    } else {
                        this.e_doj = ''
                    }
                    if (this.emp_status == '') {
                        this.e_emp_status = 'Select employee status!'
                    } else {
                        this.e_emp_status = ''
                    }
                    if (this.emp_job_status == '') {
                        this.e_emp_job_status = 'Select job status!'
                    } else {
                        this.e_emp_job_status = ''
                    }
                    if (this.emp_pro_days == '') {
                        this.e_emp_pro_days = 'Select probation days!'
                    } else {
                        this.e_emp_pro_days = ''
                    }
                    if (this.job_description == '') {
                        this.e_job_description = 'Enter job description!'
                    } else {
                        this.e_job_description = ''
                    }
                    if (this.emp_department == '') {
                        this.e_emp_department = 'Select department!'
                    } else {
                        this.e_emp_department = ''
                    }
                    if (this.emp_designation == '') {
                        this.e_emp_designation = 'Select designation!'
                    } else {
                        this.e_emp_designation = ''
                    }
                    this.$toastr.e("Please fill required fields!", "Caution!");

                } else {

                    axios.post('./update_employment', {
                        selected: this.selected,
                        id: this.id,
                        doj: this.doj,
                        login_check: this.login_check,
                        reporting_to: this.reporting_to,
                        second_reporting: this.second_reporting,
                        job_shift: this.job_shift,
                        work_location: this.work_location,
                        emp_salary: this.emp_salary,
                        emp_stipend: this.emp_stipend,
                        emp_status: this.emp_status,
                        emp_job_status: this.emp_job_status,
                        emp_pro_days: this.emp_pro_days,
                        job_description: this.job_description,
                        remarks: this.remarks,
                        child_company: this.child_company,
                        emp_department: this.emp_department,
                        emp_designation: this.emp_designation,
                        hr_notifications: this.hr_notifications,
                        att_check: this.att_check,
                        user_email: this.user_email,
                        user_password: this.user_password,
                        emp_code: this.emp_code,
                        company_email_id: this.company_email_id,
                        methodtype: this.methodtype,
                        bankaccount: this.bankaccount,
                        bankname: this.bankname,
                        accountname: this.accountname,
                    })
                        .then(data => {
                            if (data.data == "Update Employee Record Successfully") {
                                this.$toastr.s("Update Employee Record Successfully", "Congratulations");
                            }
                            else if (data.data == 'empty_username') {
                                this.$toastr.e("Please Type Username && Password", "Error!");
                            }
                            else if (data.data == 'invalid email id') {
                                this.$toastr.e("Please Type Valid User Email Id of Username", "Error!");
                            }
                            else if (data.data == 'Email Id Already Exists') {
                                this.$toastr.e("User Email Id Already Exists", "Error!");
                            }
                            else if (data.data == 'Please Select Employees Attendace List') {
                                this.$toastr.e("Please Select Employees Attendace List", "Error!");
                            }
                            console.log(data.data);
                        })
                        .catch(error => this.error = error.response.data.errors)
                }
            }

        },
        mounted() {
            axios.get('./fetch_user_hr_roles')
                .then(response => this.user_access = response.data)
            axios.get('overall_designation')
                .then(response => {
                    this.designations = response.data;

                })
                .catch(error => { });
            axios.get('overall_location')
                .then(response => this.locations = response.data)
                .catch(error => { });
            axios.get('overall_employees')
                .then(response => {
                    this.employees_detail = response.data


                })
            axios.get('get_com_employee')
                .then(response => {
                    this.employees_detail5 = response.data;
                    this.options = [];

                    var $this = this;
                    for (var i = 0; i < $this.employees_detail5.length; i++) {

                        this.options.push($this.employees_detail5[i].Name + '_' + $this.employees_detail5[i].EmployeeCode);


                    }
                })
            axios.get('department_detail2')
                .then(data => this.departments = data.data)
                .catch(error => { });
            axios.get('roster_detail1')
                .then(data => this.rosters = data.data)
                .catch(error => { });

            axios.get('getemployment_detail/' + this.$route.params.id)
                .then(data => {
                    this.emp_data = data.data;

                    this.doj = data.data[0].JoiningDate;

                    var login = data.data[0].EportalAccess;
                    if (login == 0) {
                        this.login_check = false;
                    } else {
                        this.login_check = true;
                    }
                    this.reporting_to = data.data[0].ReportingTo;
                    this.second_reporting = data.data[0].ReportingTo2;
                    this.job_shift = data.data[0].JobShift;
                    this.work_location = data.data[0].PostingCity;
                    this.emp_salary = data.data[0].Salary;
                    this.emp_salary9 = data.data[0].Salary;
                    this.emp_stipend = data.data[0].Stipend;
                    this.emp_status = data.data[0].Status;
                    this.emp_job_status = data.data[0].JobStatus;

                    this.emp_pro_days = data.data[0].ProbationEnd;
                    this.job_description = data.data[0].JobDescription;
                    this.remarks = data.data[0].remarks;
                    this.child_company = data.data[0].ChildCompany;
                    this.emp_department = data.data[0].Department;
                    this.emp_designation = data.data[0].Designation;
                    this.methodtype = data.data[0].MethodType;
                    this.bankaccount = data.data[0].BankAccount;
                    this.bankname = data.data[0].bank_name;
                    this.accountname = data.data[0].account_name;

                    var notif = data.data[0].SendNotification;
                    if (notif == 0) {
                        this.hr_notifications = false;
                    } else {
                        this.hr_notifications = true;
                    }

                    var attt = data.data[0].AllowEmployeesAttendance;
                    if (attt == 0) {
                        this.att_check = false;
                    } else {
                        this.att_check = true;
                    }
                    this.emp_code = data.data[0].EmployeeCode;
                    this.company_email_id = data.data[0].CompanyEmail;
                })



        }
    }

</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
