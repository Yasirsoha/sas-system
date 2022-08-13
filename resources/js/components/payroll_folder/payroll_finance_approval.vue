<template>
    <div v-if="user_access.payroll_write=='true'">
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-body">
                    <div class="content-header row">
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <router-link to="/" style="text-decoration: none;">Payroll</router-link>
                                </li>
                                <li class="breadcrumb-item active">
                                    Financial Approval
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-primary" style="padding-top:0px;padding-bottom:0px" role="alert">
                                <div class="alert-body" style="min-height: 55px;margin-bottom: 10px;">
                                    <ul class="nav nav-pills mb-2" style="width:80%; float:left">
                                        <li class="nav-item">
                                            <router-link to="/payroll/salary_generation" class="nav-link ">
                                                <i class="fa-solid fa-person"></i>
                                                <span class="fw-bold">HR Salary Generation</span>
                                            </router-link>
                                        </li>
                                        <li class="nav-item">
                                            <router-link to="/payroll/payroll_hr_approval" class="nav-link">
                                                <i class="fa-solid fa-candy-cane"></i>
                                                <span class="fw-bold">HR Approval</span>
                                            </router-link>
                                        </li>
                                        <li class="nav-item">
                                            <router-link to="/payroll/payroll_finance_approval" class="nav-link active">
                                                <i class="fa-solid fa-file-powerpoint"></i>
                                                <span class="fw-bold">Finance Approval</span>
                                            </router-link>
                                        </li>
                                        <li class="nav-item">
                                            <router-link to="/payroll/distribution" class="nav-link">
                                                <i class="fa-solid fa-receipt"></i><span class="fw-bold">Distribution</span>
                                            </router-link>
                                        </li>
                                        <li class="nav-item">
                                            <router-link class="nav-link" to="/payroll/archive">
                                                <i class="fa-solid fa-link"></i><span class="fw-bold">Archive</span>
                                            </router-link>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="basic-table">
                        <div class="col-12">
                            <div class="card">
                                <div class="row" style="margin-top:20px">
                                    <div class="col-md-3 col-12 mb-2 position-relative">
                                        <h5 style="padding-left:10px;padding-top:10px">Session Name: {{this.session_name}}</h5>
                                    </div>
                                    <div class="col-md-3 col-12 mb-2 position-relative">
                                        <input type="text" v-model="keyword1" class="form-control" placeholder="Search By Name or Employee code">
                                    </div>
                                    <div class="col-md-6 col-12 mb-2 position-relative">
                                        <button :disabled="disabled" @click="delay()" v-if="user_access.payroll_overall=='true' && user_session.dept=='Accounts'" data-bs-toggle="modal" data-bs-target="#hireinterview" class="btn btn-primary">Proceed</button>
                                        <button :disabled="disabled1" @click="delay1()" v-if="user_access.payroll_write=='true' && user_session.dept=='Accounts'" class="btn btn-primary">Apply Inst.& Fine</button>
                                        <button :disabled="disabled2" @click="delay2()" v-if="user_access.payroll_write=='true' && user_session.dept=='Accounts'" class="btn btn-primary">Apply Arrears & Allow.</button>
                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th style="">Status</th>
                                                <th style="">Employee Detail</th>
                                                <th style="width:150px">Att. Detail</th>

                                                <th style="">Pending Dues</th>
                                                <th style="">Arrears & Allowance</th>
                                                <th style="">Payable Salary</th>

                                                <th style=""></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="all_sals1 in all_sals">
                                                <td style="border-right:1px solid lightgrey;text-align:center;font-size:10px !important;">{{all_sals1.FStatus}}</td>

                                                <td style="width:250px;border-right:1px solid lightgrey;">
                                                    <div class="d-flex justify-content-left align-items-center">
                                                        <div class="avatar-wrapper">
                                                            <div class="avatar  me-1">
                                                                <img v-if="all_sals1.Photo=='' || all_sals1.Photo==null" src="public/images/profile_images/pro.png" alt="Avatar" height="32" width="32">
                                                                <img v-else v-bind:src="`public/images/profile_images/${all_sals1.Photo}`" alt="Avatar" height="32" width="32">

                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a class="user_name text-truncate text-body"><span class="fw-bolder">{{all_sals1.Name}} </span></a><small class="emp_post text-muted">

                                                                <span v-if="all_sals1.PostingCity!=null">{{all_sals1.PostingCity}} - </span>
                                                                <span v-else></span>
                                                                <span v-if="all_sals1.Department!=null">{{all_sals1.Department}} - </span>
                                                                <span v-else></span>
                                                                <span v-if="all_sals1.Designation!=null">{{all_sals1.Designation}}</span>
                                                                <span v-else></span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="padding-left: 12%;">
                                                        <div class="mt-display-flex">
                                                            <div>
                                                                <strong>
                                                                    Salary:
                                                                </strong> Rs.{{all_sals1.Salary}}/-
                                                            </div>
                                                            <div>
                                                                <span><strong>Payment Type:</strong> {{all_sals1.MethodType}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="border-right:1px solid lightgrey;">
                                                    <div class="row" style="">
                                                        <div class="mt-display-flex">
                                                            <div>
                                                                <span><strong>Overtime:</strong> Rs. {{Math.round(all_sals1.OAmount)}}</span>
                                                            </div>
                                                            <div>
                                                                <span><strong>Deduction:</strong>Rs.{{Math.round(all_sals1.DAmount)}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="border-right:1px solid lightgrey;">
                                                    <div class="row" style="">
                                                        <div class="mt-display-flex">
                                                            <div>
                                                                <span><strong>Installment:</strong> Rs. {{all_sals1.InstallmentAmount}}</span>
                                                            </div>
                                                            <div>
                                                                <span><strong>Dues Amt:</strong> Rs.{{all_sals1.DuesAmount}}</span>
                                                            </div>
                                                            <div>
                                                                <span><strong>Fine:</strong> Rs. {{all_sals1.Fine}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="border-right:1px solid lightgrey;">
                                                    <div class="row" style="">
                                                        <div class="mt-display-flex">
                                                            <div>
                                                                <span><strong>Arrears:</strong> Rs.{{all_sals1.ArrearsAmount}}</span>
                                                            </div>
                                                            <div>
                                                                <span><strong>Bonus:</strong> Rs.{{all_sals1.BonusAmount}}</span>
                                                            </div>
                                                            <div>
                                                                <span><strong>Allowance:</strong> Rs.{{all_sals1.AllowanceAmount}}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="border-right:1px solid lightgrey;">
                                                    <div class="row" style="">
                                                        <div class="mt-display-flex">
                                                            <div>
                                                                <span>Rs. {{all_sals1.PayableSalary}}/-</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td v-if="user_access.payroll_write=='true' && user_session.dept=='Accounts'">
                                                    <a @click="fetch_emp_payroll(all_sals1.FinanceApprovalID)" data-bs-toggle="modal" data-bs-target="#update_hr_approval"><i style="color:#d42f2f" class="fa-solid fa-pencil"></i><span></span></a>
                                                </td>
                                                <td v-else>
                                                    <a><i style="color:#d42f2f" class="fa-solid fa-pencil"></i><span></span></a>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal table -->

                    <div class="modal fade" id="hireinterview" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            np
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="fw-bolder">Confirmation</h1>
                                        <h5>Do you want to move employees salaries from Finance Approval to Distribution?</h5>
                                        <div class="text-center" style="text-align:center">
                                            <button type="button" @click="proceedtodistributionapproval()" class="btn btn-primary waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Yes</button>
                                            <button type="submit" class="btn btn-outline-primary waves-effect" data-bs-dismiss="modal" aria-label="Close">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="modal fade" id="update_hr_approval" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">

                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <h5>Update Employee Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="modalEditUserCode">Employee Code</label>
                                            <input type="text" class="form-control" v-model="m_ApprovalID" hidden />
                                            <input type="text" readonly class="form-control" v-model="m_emp_code" />
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="modalEditUserName"> Name</label>
                                            <input type="text" class="form-control" readonly v-model="m_name" />
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="modalEditOvertime">Salary Status</label>
                                            <div class="demo-inline-spacing">
                                                <div class="form-check form-check-inline" style="margin-top:0px">
                                                    <input class="form-check-input" type="radio" v-model="m_salary_status" name="inlineRadioOptions" checked="checked" id="inlineRadio1" value="P">
                                                    <label class="form-check-label" for="inlineRadio1">Proceed</label>
                                                </div>
                                                <div class="form-check form-check-inline" style="margin-top:0px">
                                                    <input class="form-check-input" type="radio" v-model="m_salary_status" name="inlineRadioOptions" id="inlineRadio2" value="H">
                                                    <label class="form-check-label" for="inlineRadio2">Hold</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center mt-2 pt-50">
                                            <button :disabled="disabled3" @click="delay3()" type="submit" class="btn btn-primary me-1" data-bs-dismiss="modal" aria-label="Close">Update</button>
                                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                Discard
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>

    </div>
</template>
<script>
    import axios from "axios";
    export default {
        data() {
            return {
                all_sals: {},
                find_emp: {},
                designations: {},
                departments: {},
                emp_id: 'All',
                designation: 'All',
                department: 'All',
                status: 'All',
                keyword1: '',
                session_name: '',
                m_emp_id: '',
                m_name: '',

                m_emp_code: '',
                m_ApprovalID: '',
                m_salary_status: '',
                user_session: {},
                user_access: {},

                disabled: false,
                timeout: null,

                disabled1: false,
                timeout1: null,

                disabled2: false,
                timeout2: null,

                disabled3: false,
                timeout3: null,
            }
        },
        watch: {
            keyword1(after, before) {
                this.getResults();
            }
        },
        methods: {
            delay() {
                this.disabled = true
                this.timeout = setTimeout(() => {
                    this.disabled = false
                }, 5000)
                this.update_status()
            },
            delay1() {
                this.disabled1 = true
                this.timeout1 = setTimeout(() => {
                    this.disabled1 = false
                }, 5000)
                applydeductions()
            },
            delay2() {
                this.disabled2 = true
                this.timeout2 = setTimeout(() => {
                    this.disabled2 = false
                }, 5000)
                this.applyarrears()
            },
            delay3() {
                this.disabled3 = true
                this.timeout3 = setTimeout(() => {
                    this.disabled3 = false
                }, 5000)
                this.update_emp_payroll()
            },
            applydeductions() {

                axios.get('chech_installments/')
                    .then(data => {
                        this.all_sals = data.data
                        this.$toastr.s("Applied Installment & Fines to All Employees!", "Congratulations");
                    })
                    .catch(error => { });
            },
            applyarrears() {
                axios.get('allowance_arrears/')
                    .then(data => {
                        this.all_sals = data.data
                        this.$toastr.s("Applied Arrears & Allowance to All Employees!", "Congratulations");
                    })
                    .catch(error => { });
            },
            fetch_emp_payroll(id) {
                axios.get('find_payroll_emp_financeapproval/' + id)
                    .then(data => {
                        this.m_emp_id = data.data[0].EmployeeID;
                        this.m_emp_code = data.data[0].EmployeeCode;
                        this.m_name = data.data[0].Name;
                        this.m_ApprovalID = data.data[0].FinanceApprovalID
                        this.m_salary_status = data.data[0].HrStatus
                    })
                    .catch(error => { });
            },
            proceedtodistributionapproval() {
                axios.get('./proceeddistapproval')
                    .then(response => {
                        this.all_sals = response.data
                    })
                    .catch(error => console.log(error));

                this.$toastr.s("Proceed Payroll to Distribution Successfully!", "Congratulations");

                this.$router.go(0);
            },
            update_emp_payroll() {
                axios.post('update_payroll_ind_status_financeapproval', {
                    m_ApprovalID: this.m_ApprovalID,
                    m_salary_status: this.m_salary_status,
                    m_name: this.m_name,
                })
                    .then(data => {
                        this.all_sals = data.data
                        this.$toastr.s("Updated Employee Salary Detail Successfully!", "Congratulations");
                    })
            },
            getResults() {
                axios.get('./search_finance_approval', { params: { keyword1: this.keyword1 } })
                    .then(response => this.all_sals = response.data)
                    .catch(error => console.log(error));
            },
            getResult() {

                axios.get('fetch_payroll_finance_approval/')
                    .then(response => this.all_sals = response.data)
                    .catch(error => { });
            },
        },
        mounted() {
            this.getResult();
            axios.get('find_emp_id')
                .then(data => this.find_emp = data.data)
                .catch(error => { });
            axios.get('department_detail2')
                .then(data => this.departments = data.data)
                .catch(error => { });

            axios.get('overall_designation')
                .then(response => {
                    this.designations = response.data;

                })
            axios.get('find_session')
                .then(response => {
                    this.session_name = response.data;
                })
            axios.get('./user_session')
                .then((response) => this.user_session = response.data)
            axios.get('./fetch_user_payroll_roles')
                .then(response => this.user_access = response.data)
        },

    }

</script>
