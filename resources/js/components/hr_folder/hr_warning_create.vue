<template>
    <div v-if="user_access.hr_write=='true'">
        <div class="app-content content ">
            <div class="noprint content-overlay"></div>
            <div class="noprint cheader-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="noprint content-header row">
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <router-link to="/hr/dashboard" style="text-decoration: none;">Dashboard</router-link>
                            </li>
                            <li class="breadcrumb-item">
                                <router-link to="/hr/warning_detail" style="text-decoration: none;">Warning Details</router-link>
                            </li>
                            <li class="breadcrumb-item active">
                                New Warning
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="content-body">
                    <section class="invoice-preview-wrapper">
                        <div class="row invoice-preview">
                            <!-- Invoice -->
                            <div class="col-xl-9 col-md-8 col-12">
                                <div id="thisid">
                                    <div class="card invoice-preview-card">
                                        <div class="card-body invoice-padding pb-0">
                                            <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
                                                <div v-for='companydetail1 in companydetail' style="margin-left:30px">
                                                    <div style="padding-top:10px" class="logo-wrapper">
                                                        <h3 class="text-primary invoice-logo">{{companydetail1.company_name}}</h3>
                                                    </div>
                                                    <p class="card-text mb-25">Address: {{companydetail1.company_address}} , </p> <p class="card-text mb-25">City: {{companydetail1.city}} - {{companydetail1.country}}</p>
                                                    <p class="card-text mb-0">Phone: {{companydetail1.phone_number}}</p>
                                                </div>
                                                <div class="mt-md-0 mt-2" style="padding-right:20px;padding-top:20px">

                                                    <div class="invoice-date-wrapper">
                                                        <p style="margin-bottom:5px !important" class="invoice-date-title">
                                                            <strong>Date Issued:</strong>
                                                            <input type="date" v-model="date" />
                                                        </p>
                                                    </div>
                                                    <label style="color: #d93025" v-if="date==''">{{mydate}}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="invoice-spacing" />
                                        <div class="card-body invoice-padding pt-0" style="margin-left:5%;margin-right:5%;">
                                            <div class="row invoice-spacing">
                                                <div class="col-xl-8 p-0">
                                                    <h6 class="mb-2">
                                                        <strong>Employee Id:</strong>
                                                        <select class="" v-model="emp_id" @change="getemp_detail()" style="width:40%">
                                                            <option value="">Select id</option>
                                                            <option v-for='empcode1 in empcode' :value='empcode1.EmployeeCode'>{{ empcode1.EmployeeCode }}</option>
                                                        </select>
                                                        <label style="color: #d93025" v-if="emp_id==''">{{e_emp_id}}</label>
                                                    </h6>
                                                    <h6 class="mb-2">
                                                        <strong>Name:</strong>
                                                        <input type="text" style="width:50%" v-model="emp_name" readonly />
                                                        <label style="color: #d93025" v-if="emp_id==''">{{e_emp_name}}</label>
                                                    </h6>
                                                    <h6 class="mb-25">
                                                        <strong>Department:</strong>
                                                        <input type="text" style="width:50%" v-model="department" readonly />

                                                        <label style="color: #d93025" v-if="department==''">{{e_department}}</label>
                                                    </h6>
                                                    <h6 class="card-text mb-25">
                                                        <strong>Designation:</strong>
                                                        <input type="text" style="width:50%" v-model="designation" readonly />
                                                        <label style="color: #d93025" v-if="designation==''">{{e_designation}}</label>
                                                    </h6>
                                                    <h6 class="card-text mb-25">
                                                        <strong>Location:</strong>
                                                        <input type="text" style="width:50%" v-model="location" readonly />
                                                        <label style="color: #d93025" v-if="location==''">{{e_location}}</label>
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Address and Contact starts -->
                                        <div style="margin-left:5%;margin-right:5%;" class="card-body  pt-0">
                                            <div class="row invoice-spacing">
                                                <h6 class="card-text mb-25" style="padding-left:0px">
                                                    <strong>Subject:</strong>
                                                    <select class="" v-model="subject" style="width:50%">
                                                        <option value="">Select Reason</option>
                                                        <option v-for='reason1 in reason' :value='reason1.ReasonName'>{{ reason1.ReasonName }}</option>
                                                    </select>


                                                    <label style="color: #d93025" v-if="subject==''">{{e_subject}}</label>
                                                </h6>

                                                <br>
                                                <p style="padding-left:0px; text-align:justify;">
                                                    This letter serves a written warning to you for not meeting your objectives as outlined in your Appointment Letter / Job Description / Prior performance appraisal / Goals as agreed between you and your supervisor.
                                                </p>
                                                <p style="padding-left: 0px; text-align: justify;">
                                                    As intimated by the management / your supervisor, we are putting you on a Corrective Action Plan commencing from <label>{{date}}</label>. This plan is being introduced to bring your performance up to an acceptable standard, considering your capabilities and requirements of your job role.
                                                </p>
                                                <p style="padding-left: 0px; text-align: justify;">
                                                    Each member in our company is expected to contribute to the best of their abilities and meet the objectives laid out in their job role. Hence, we would like you to immediately improve your performance and meet expectations of your supervisor and company management.
                                                </p>
                                                <p style="padding-left: 0px; text-align: justify;">
                                                    Each member in our company is expected to contribute to the best of their abilities and meet the objectives laid out in their job role. Hence, we would like you to immediately improve your performance and meet expectations of your supervisor and company management.
                                                </p>
                                                <h6 class="card-text mb-25" style="padding-left:0px">Sincerely,</h6>
                                                <h6 class="card-text mb-25" style="padding-left:0px">HR Department</h6>
                                                <h6 v-for='companydetail1 in companydetail' class="card-text mb-25" style="padding-left:0px">{{companydetail1.company_name}}</h6>
                                            </div>
                                        </div>
                                        <div class="noprint card-body invoice-padding pb-0">
                                            <div class="row invoice-sales-total-wrapper">
                                            </div>
                                        </div>
                                        <hr class="noprint invoice-spacing" />
                                    </div>
                                </div>
                            </div>
                            <!-- /Invoice -->
                            <!-- Invoice Actions -->
                            <div class="noprint col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
                                <div class="card">
                                    <div class="card-body">
                                        <button :disabled="disabled" @click="delay()" class="btn btn-primary w-100 btn-download-invoice mb-75">Save</button>
                                        <button onclick="window.print()" class="btn btn-outline-success  w-100 mb-75">Save & Print</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /Invoice Actions -->
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { reverse } from "lodash"
    export default {
        data() {
            return {
                user_access: {},
                date: new Date().toJSON().slice(0, 10),
                mydate: this.date,
                emp_id: '',
                emp_name: '',
                department: '',
                designation: '',
                location: '',
                subject: '',
                empcode: {},
                e_date: '',
                e_emp_id: '',
                e_department: '',
                e_designation: '',
                e_location: '',
                e_subject: '',
                e_emp_name: '',
                adsdata: {},
                reason: {},
                companydetail: {},

                disabled: false,
                timeout: null,
            }
        },
        methods: {
            delay() {
                this.disabled = true
                this.timeout = setTimeout(() => {
                    this.disabled = false
                }, 5000)
                this.issue_warning()
            },
            issue_warning() {

                if (this.emp_id == '' || this.department == '' || this.designation == '' || this.location == '' || this.subject == '' || this.emp_name == '') {
                    if (this.emp_id == '') {
                        this.e_emp_id = 'Select employee id!'
                    }
                    else {
                        this.e_emp_id = ''
                    }
                    if (this.department == '') {
                        this.e_department = 'Select department!'
                    }
                    else {
                        this.e_department = ''
                    }
                    if (this.designation == '') {
                        this.e_designation = 'Select designation!'
                    }
                    else {
                        this.e_designation = ''
                    }
                    if (this.location == '') {
                        this.e_location = 'Select location!'
                    }
                    else {
                        this.e_location = ''
                    }
                    if (this.subject == '') {
                        this.e_subject = 'Subject is required!'
                    }
                    else {
                        this.e_subject = ''
                    }
                    if (this.emp_name == '') {
                        this.e_emp_name = 'Select Employee Name'
                    }
                    else {
                        this.e_emp_name = ''
                    }
                }
                else {
                    axios.post('./submit_warning', {
                        dated: this.date,
                        emp_id: this.emp_id,
                        emp_name: this.emp_name,
                        department: this.department,
                        designation: this.designation,
                        location: this.location,
                        subject: this.subject,

                    })
                        .then(response => {
                            console.log('ok');
                            if (response.data == 'submitted') {
                                this.$toastr.s("Warning Letter issued Successfully", "Congratulations!");
                                this.emp_id = '';
                                this.emp_name = '';
                                this.department = '';
                                this.designation = '';
                                this.location = '';
                                this.subject = '';
                            }
                            else if (response.data == 'Employee is already terminated') {
                                this.$toastr.i("Employee is already terminated", "Information!");
                                this.emp_id = '';
                                this.emp_name = '';
                                this.department = '';
                                this.designation = '';
                                this.location = '';
                                this.subject = '';
                            }

                        })
                }

            },
            getemp_detail() {

                axios.post('./get_emp_detail', {
                    emp_id: this.emp_id,
                })
                    .then(response => {

                        this.department = response.data[0].Department;
                        this.designation = response.data[0].Designation;
                        this.location = response.data[0].PostingCity;
                        this.emp_name = response.data[0].Name;
                    })
                    .catch(error => this.error = error.response.data.errors)

            },
        },
        mounted() {
            axios.get('overall_empcode')
                .then(response => this.empcode = response.data)
                .catch(error => { });
            axios.get('warning_reasons')
                .then(response => this.reason = response.data)
            axios.get('fetch_companydetail')
                .then(response => this.companydetail = response.data)
            console.log('warning')
            axios.get('./fetch_user_hr_roles')
                .then(response => this.user_access = response.data)
        }
    }
</script>
<style>
    @media print {
        .noprint {
            visibility: hidden;
        }
    }
</style>
