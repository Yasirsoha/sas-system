<template>
    <div>
        <div class="app-content content">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row"></div>
                <div class="content-body">
                    <div class="content-header row">
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">
                                    Loan & Advance
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- Full calendar start -->
                    <section>
                        <div class="app-calendar overflow-hidden border">
                            <div class="row g-0">
                                <!-- Sidebar -->
                                <div class="sidebar-wrapper col-md-2" style="background-color:white; border-right:1px solid lightgray">
                                    <div class=" row card-body d-flex justify-content-center">
                                        <router-link style="margin-bottom:10px" to="/payroll/dues" class="btn btn-primary btn-toggle-sidebar col-md-12">
                                            <span class="align-middle">Dues Detail </span>
                                        </router-link>

                                        <button class="col-md-12 btn btn-primary btn-toggle-sidebar w-100" data-bs-toggle="modal" data-bs-target="#emploan">
                                            <span class="align-middle">Apply for loan</span>
                                        </button>
                                    </div>
                                    <div class="card-body pb-0">
                                        <h5 class="section-label" style="margin-bottom:15px;">
                                            <span class="align-middle">Filter</span>
                                        </h5>
                                        <div class="calendar-events-filter">

                                            <select id="UserRole" @change="view_loans()" v-model="m_check" class="form-select mb-md-0 mb-2">
                                                <option value="Both">Both</option>
                                                <option value="Manager">Manager</option>
                                                <option value="HR Manager">HR Manager</option>
                                            </select>
                                            <div class="form-check form-check-success mb-1" style="margin-top: 14px;">
                                                <input type="checkbox" @change="view_loans()" v-model="check_approved" id="holiday" class="form-check-input input-filter" />
                                                <label class="form-check-label" for="holiday">Approved</label>
                                            </div>
                                            <div class="form-check form-check-warning mb-1" style="margin-top: 14px;">
                                                <input type="checkbox" @change="view_loans()" v-model="check_pending" id="family" class="form-check-input input-filter" />
                                                <label class="form-check-label" for="family">Pending</label>
                                            </div>
                                            <div class="form-check form-check-danger mb-1" style="margin-top: 14px;">
                                                <input type="checkbox" @change="view_loans()" v-model="check_rejected" id="personal" class="form-check-input input-filter" />
                                                <label class="form-check-label" for="personal">Rejected</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-auto" style="margin-top:200px">
                                        <img src="public/app-assets/images/pages/calendar-illustration.png" alt="Calendar illustration" class="img-fluid" style="margin-top:180px;" />
                                    </div>
                                </div>
                                <!-- /Sidebar -->
                                <!-- Calendar -->
                                <div class="col position-relative">
                                    <div class="card shadow-none border-0 mb-0 rounded-0">
                                        <div class="card-body pb-0">
                                            <!-- Hoverable rows start -->
                                            <div class="row" id="table-hover-row">
                                                <div class="col-12">
                                                    <div class="col-12">
                                                        <div class="card-body border-bottom">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">From date</label>
                                                                    <input type="date" v-model="from_date" class="form-control" placeholder="Name" />
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">End date</label>
                                                                    <input type="date" v-model="to_date" class="form-control" placeholder="Name" />
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Department</label>
                                                                    <select id="UserRole" v-model="department" class="form-select mb-md-0 mb-2">
                                                                        <option value="All">All</option>
                                                                        <option v-for="departments1 in departments" :value='departments1.department_name'>{{departments1.department_name}}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Designation</label>
                                                                    <select id="UserRole" v-model="designation" class="form-select mb-md-0 mb-2">
                                                                        <option value="All">All</option>
                                                                        <option v-for="designations1 in designations" :value='designations1.designation_name'>{{designations1.designation_name}}</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">Name or id</label>
                                                                    <input type="text" v-model="search_name" class="form-control" placeholder="Name" />
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div style="height:27px;"></div>
                                                                    <button @click="getbyfilter()" class="dt-button add-new btn btn-primary" tabindex="0" type="button"><span>Search</span></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover" style="font-size:small; overflow-x:scroll; margin-bottom:130px;">
                                                                <thead>
                                                                    <tr style="text-align:center;">
                                                                        <th>ID</th>
                                                                        <th>Employee Name</th>
                                                                        <th>Department</th>
                                                                        <th>Created at</th>
                                                                        <th>Reason</th>
                                                                        <th>Manager Approval</th>
                                                                        <th>HR Approval</th>
                                                                        <th>Installments</th>
                                                                        <th>Total Amount</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr v-for="loans1 in loans">
                                                                        <td>{{loans1.LoanId}}</td>
                                                                        <td>
                                                                            <div @click="fetch_emp_upSts(loans1.LoanId)" data-bs-toggle="modal" data-bs-target="#viewLoan" class="d-flex justify-content-left align-items-center">
                                                                                <div class="avatar-wrapper">
                                                                                    <div class="avatar  me-1">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="d-flex flex-column">
                                                                                    <a class="user_name text-truncate text-body"><span class="fw-bolder">{{loans1.Name}} </span></a>
                                                                                    <small class="emp_post text-muted">
                                                                                        <span>{{loans1.Designation}}</span>
                                                                                    </small>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                        <td>{{loans1.Department}}</td>
                                                                        <td>{{loans1.ApplyDate}}</td>
                                                                        <td style="max-width:100px;">{{loans1.LoanReason}}</td>
                                                                        <td style="text-align:center;">
                                                                            <span @click="fetch_emp_upSts(loans1.LoanId, 'man')" v-if="loans1.ManagerApproval=='Pen'" data-bs-toggle="modal" data-bs-target="#updateloanstatus" class="badge bg-gradient-warning">Pending</span>
                                                                            <span class="badge bg-gradient-success" v-if="loans1.ManagerApproval=='App'">Approved</span>
                                                                            <span class="badge bg-gradient-danger" v-if="loans1.ManagerApproval=='Rej'">Rejected</span>
                                                                        </td>
                                                                        <!--<td v-else style="text-align:center;">
                                                            <span class="badge bg-info">Paid</span>
                                                        </td>-->

                                                                        <td style="text-align:center;">
                                                                            <span @click="fetch_emp_upSts(loans1.LoanId, 'hr')" data-bs-toggle="modal" data-bs-target="#updateloanstatus" class="badge bg-gradient-warning" v-if="loans1.HrApproval=='Pen'">Pending</span>
                                                                            <span class="badge bg-gradient-success" v-if="loans1.HrApproval=='App'">Approved</span>
                                                                            <span class="badge bg-gradient-danger" v-if="loans1.HrApproval=='Rej'">Rejected</span>
                                                                        </td>
                                                                        <td style="text-align:center;">{{loans1.LoanInstallments}}</td>
                                                                        <td>{{loans1.LoanAmount}}</td>
                                                                        <td>
                                                                            <div class="btn-group">
                                                                                <a data-bs-toggle="dropdown" class="btn btn-sm dropdown-toggle hide-arrow"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle> <circle cx="12" cy="5" r="1"></circle> <circle cx="12" cy="19" r="1"></circle></svg></a>
                                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                                    <a @click="fetch_emp_upSts(loans1.LoanId)" data-bs-toggle="modal" data-bs-target="#viewLoan" class="dropdown-item">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" class="bi bi-eye"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path> <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path></svg>
                                                                                        View details
                                                                                    </a>
                                                                                    <a @click="fetch_emp_upSts(loans1.LoanId)" data-bs-toggle="modal" data-bs-target="#payloan" class="dropdown-item" v-if="loans1.ReqStatus == 'Approved'">
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                                                            <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z" />
                                                                                        </svg>
                                                                                        Pay
                                                                                    </a>
                                                                                    <a class="dropdown-item" v-if="loans1.ReqStatus == 'Paid'">
                                                                                        <i data-feather="file-text"></i>
                                                                                        Generate Slip
                                                                                    </a>
                                                                                    <a @click="fetch_emp_upSts(loans1.LoanId)" class="dropdown-item" v-if="loans1.ReqStatus == 'Paid'" data-bs-toggle="modal" data-bs-target="#returnLoan">
                                                                                        <i data-feather='arrow-up-left'></i>
                                                                                        Return loan
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Hoverable rows end -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /Calendar -->
                                <div class="body-content-overlay"></div>
                            </div>
                        </div>
                    </section>
                    <!-- Full calendar end -->
                    <!--Apply loan model-->
                    <div class="modal fade" id="emploan" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-3 mx-50">
                                    <h1 class="address-title text-center mb-1" id="addNewAddressTitle">Apply for Loan or Advance Salary</h1>
                                    <p class="address-subtitle text-center mb-2 pb-75">Input Details</p>
                                    <form id="addNewAddressForm" style="text-align:left;" class="row gy-1 gx-2" onsubmit="return false">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Employee code - Name</label>
                                            <span style="color: #DB4437; font-size: 11px;">*</span>
                                            <select @click="fetch_emp_detail()" v-model="name" class="form-select mb-md-0 mb-2">
                                                <option value="" selected>Select</option>
                                                <option v-for="employees1 in employees" :value='employees1.EmployeeID'>{{employees1.EmployeeCode}} - {{employees1.Name}}</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label class="form-label">Employee ID</label>
                                            <input type="text" class="form-control" disabled v-model="emp_id1" />
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label class="form-label">Date Of Joining</label>
                                            <input type="text" class="form-control" disabled v-model="doj" />
                                        </div>
                                        <div class="col-12 col-md-2">
                                            <label class="form-label">Basic Salary</label>
                                            <input type="text" class="form-control" disabled v-model="salary" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Maximum Limit</label>
                                            <input type="text" class="form-control" disabled v-model="max_advance" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Select Type</label>
                                            <span style="color: #DB4437; font-size: 11px;">*</span>
                                            <select id="modalAddressCountry" @click="count_max_limit()" v-model="type" class="select2 form-select">
                                                <option value="Advance">Advance</option>
                                                <option value="Loan">Loan</option>
                                            </select>
                                            <span style="color: #DB4437; font-size: 11px;" v-if="this.type==''">{{type_error}}</span>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Amount</label>
                                            <input type="number" class="form-control" v-model="amount" placeholder="Amount" />
                                            <span style="color: #DB4437; font-size: 11px;" v-if="this.amount==''">{{amount_error}}</span>
                                            <span style="color: #DB4437; font-size: 11px;" v-if="this.amount > this.max_advance">Ammount is too much</span>
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Number of installments</label>
                                            <span v-if="type=='Loan'" style="color: #DB4437; font-size: 11px;">*</span>
                                            <select v-if="type=='Loan'" id="modalAddressCountry" v-model="no_of_inst" class="select2 form-select">
                                                <option value="0" selected>Select</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                            </select>
                                            <select v-if="type=='Advance'" disabled class="select2 form-select" title="Advance installments could not be changed">
                                                <option>1</option>
                                            </select>
                                            <span style="color: #DB4437; font-size: 11px;" v-if="this.no_of_inst=='0' && type=='Loan'">{{installments_error}}</span>
                                        </div>
                                        <div class="col-12 col-md-12">
                                            <label class="form-label" v-if="type=='Loan'">Reason of Loan</label>
                                            <label class="form-label" v-if="type=='Advance'">Reason of Advance</label>
                                            <span style="color: #DB4437; font-size: 11px;">*</span>
                                            <label v-if="type=='Loan' && no_of_inst>0 && amount>0" style="float:right;">Each installments will be of Rs. <label>{{Math.round(this.amount/this.no_of_inst)}}</label></label>
                                            <input type="text" class="form-control" v-model="reason" placeholder="Type reason here" />
                                            <span style="color: #DB4437; font-size: 11px;" v-if="this.reason==''">{{reason_error}}</span>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button :disabled="disabled" @click="delay()" type="submit" class="btn btn-primary me-1 mt-2" data-bs-dismiss="modal" aria-label="Close">Apply</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Apply loan model-->
                    <!-- View loan Modal -->
                    <div class="modal fade" id="viewLoan" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <center>
                                            <div class="col-md-12">
                                                <table style="width:100%;">
                                                    <thead style="float:left; width:100%;">
                                                        <h2 style="text-align:center;"> Details of {{pay_type}}</h2>
                                                        <tr>
                                                            <th style="width:18%;">Loan ID: </th>
                                                            <td style="width:25%;">{{pay_loanID}}</td>
                                                            <th style="width:25%;">Application date: </th>
                                                            <td style="width:32%;">{{us_date}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Applicant ID: </th>
                                                            <td>14357</td>
                                                            <th>Applicant name: </th>
                                                            <td>{{us_c_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Department: </th>
                                                            <td>IT</td>
                                                            <th>Designation: </th>
                                                            <td>Administrator</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Amount: </th>
                                                            <td> {{us_amount}}</td>
                                                            <th>Number of installments: </th>
                                                            <td> {{us_installments}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Reason: </th>
                                                            <td> {{us_reason}}</td>
                                                            <th>Received by: </th>
                                                            <td> {{this.rcvBy}}</td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                                                    Close
                                                </button>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ View loan Modal -->
                    <!-- Update Loan status Modal -->
                    <div class="modal fade" id="updateloanstatus" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">Update Loan Status</h1>
                                        <p>Updating loan status</p>
                                    </div>
                                    <form id="editUserForm" class="row gy-1 pt-75" onsubmit="return false">
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Candidate name</label>
                                            <input type="text" disabled class="form-control" v-model="us_c_name" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label">Loan applied</label>
                                            <input type="text" disabled class="form-control" v-model="us_amount" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="modalEditUserLastName">Number of installments</label>
                                            <input type="text" disabled class="form-control" v-model="us_installments" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="modalEditUserLastName">Type</label>
                                            <input type="text" disabled class="form-control" v-model="us_type" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="modalEditUserLastName">Date Applied</label>
                                            <input type="text" disabled class="form-control" v-model="us_date" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="modalEditUserLastName">Manager Status</label>
                                            <input type="text" disabled class="form-control" v-model="us_m_sts" />
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="modalEditUserLastName">HR Status</label>
                                            <input type="text" disabled class="form-control" v-model="us_hr_sts" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="modalEditUserLastName">Reason</label>
                                            <input type="text" disabled class="form-control" v-model="us_reason" />
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label">Update status</label>
                                            <select v-model="us_man_status" class="select2 form-select">
                                                <option value="" selected>Select</option>
                                                <option value="App">Approve</option>
                                                <option value="Pen">Pending</option>
                                                <option value="Rej">Reject</option>
                                            </select>
                                        </div>
                                        <span style="color: #DB4437; font-size: 11px;" v-if="this.us_man_status==''">{{us_man_status_error}}</span>
                                        <div class="col-12 text-center mt-2 pt-50">
                                            <button type="button" :disabled="disabled1" @click="delay1()" class="btn btn-primary waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Update</button>
                                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                Close
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Update Loan status Modal -->
                    <!-- Pay loan Modal -->
                    <div class="modal fade" id="payloan" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <center>
                                            <div class="col-md-12">
                                                <table style="width:100%;">
                                                    <thead style="float:left; width:100%;">
                                                        <h2 style="text-align:center;"> Slip of {{pay_type}}</h2>
                                                        <tr>
                                                            <th style="width:18%;">Loan ID: </th>
                                                            <td style="width:25%;">{{pay_loanID}}</td>
                                                            <th style="width:25%;">Application date: </th>
                                                            <td style="width:32%;">{{us_date}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Applicant ID: </th>
                                                            <td>14357</td>
                                                            <th>Applicant name: </th>
                                                            <td>{{us_c_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Department: </th>
                                                            <td>IT</td>
                                                            <th>Designation: </th>
                                                            <td>Administrator</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Amount: </th>
                                                            <td> {{us_amount}}</td>
                                                            <th>Number of installments: </th>
                                                            <td> {{us_installments}}</td>
                                                        </tr>
                                                        <tr>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <div class="col-md-10">
                                                                    <strong>Received by:  </strong><span style="color: #DB4437; font-size: 11px;">*</span>
                                                                    <input type="text" class="form-control" v-model="rcvBy" placeholder="Name" />
                                                                    <span style="color: #DB4437; font-size: 11px;" v-if="this.rcvBy==''">{{rcvBy_error}}</span>
                                                                </div>
                                                            </td>
                                                            <td colspan="2">
                                                                <div class="col-md-10">
                                                                    <strong>Installment start from: </strong>
                                                                    <select id="UserRole" v-model="ins_start" class="form-select mb-md-0 mb-2">
                                                                        <option value="0">This month</option>
                                                                        <option value="1">Next month</option>
                                                                        <option value="2">2 months later</option>
                                                                        <option value="3">3 months later</option>
                                                                    </select>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button type="submit" :disabled="disabled2" @click="delay2()" class="btn btn-primary me-1 mt-2" data-bs-dismiss="modal" aria-label="Close">Pay & generate slip</button>
                                                <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                                                    Cancel
                                                </button>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Pay loan Modal -->
                    <!-- Return loan Modal -->
                    <div class="modal fade" id="returnLoan" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <center>
                                            <div class="col-md-12">
                                                <table style="width:100%;">
                                                    <thead style="float:left; width:100%;">
                                                        <h2 style="text-align:center;"> Return {{pay_type}}</h2>
                                                        <tr>
                                                            <th style="width:18%;">Loan ID: </th>
                                                            <td style="width:25%;">{{pay_loanID}}</td>
                                                            <th style="width:25%;">Application date: </th>
                                                            <td style="width:32%;">{{us_date}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Applicant ID: </th>
                                                            <td>14357</td>
                                                            <th>Applicant name: </th>
                                                            <td>{{us_c_name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Department: </th>
                                                            <td>IT</td>
                                                            <th>Designation: </th>
                                                            <td>Administrator</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Amount: </th>
                                                            <td> {{us_amount}}</td>
                                                            <th>Number of installments: </th>
                                                            <td> {{us_installments}}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Reason: </th>
                                                            <td> {{us_reason}}</td>
                                                            <th>Received by: </th>
                                                            <td> {{this.rcvBy}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="4">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <div class="col-md-3">
                                                                            <strong>Amount to return:  </strong><span style="color: #DB4437; font-size: 11px;">*</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input type="text" class="form-control" v-model="returnamount" placeholder="Amount to return" />
                                                                            <span style="color: #DB4437; font-size: 11px;" v-if="this.returnamount != this.us_amount">{{e_returnamount}}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                            <div class="col-12 text-center">
                                                <button type="submit" @click="return_loan(pay_loanID)" class="btn btn-primary me-1 mt-2" data-bs-dismiss="modal" aria-label="Close">Return</button>
                                                <button type="reset" class="btn btn-outline-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">
                                                    Close
                                                </button>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Return loan Modal -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                search_name: '',
                search_name1: '',
                from_date: '',
                to_date: '',
                department: 'All',
                designation: 'All',

                name: '',
                emp_id1: '',
                doj: '',
                salary: '',
                max_advance: '0',
                amount: '',
                type: "Advance",
                reason: '',
                no_of_inst: '0',
                installmentPrice: '',

                check_approved: true,
                check_pending: true,
                check_rejected: false,
                m_check: "Both",
                amount_error: '',
                type_error: '',
                reason_error: '',
                installments_error: '',

                rejected: '',
                pending: '',
                approved: '',
                check: '',
                loans: {},
                installments: {},
                employee: {},
                departments: {},
                designations: {},
                usid: '',

                us_c_name: '',
                us_amount: '',
                us_installments: '',
                us_type: '',
                us_reason: '',
                us_date: '',
                us_m_sts: '',
                us_hr_sts: '0',
                us_man_status: '',
                us_man_status_error: '',
                man_hr: '',

                returnamount: '',
                e_returnamount: '',
                loanid: '',
                rcvBy: '',
                rcvBy_error: '',
                ins_start: '0',

                pay_type: '',
                pay_date: '',
                pay_emp_id: '',
                pay_loanID: '',
                employees: {},
                empId: '',

                disabled: false,
                timeout: null,

                disabled1: false,
                timeout1: null,

                disabled2: false,
                timeout2: null,
            }
        },
        methods: {
    delay() {
        this.disabled = true
        this.timeout = setTimeout(() => {
          this.disabled = false
        }, 5000)
        this.apply_loan()
      },
    delay1() {
        this.disabled1 = true
        this.timeout1 = setTimeout(() => {
          this.disabled1 = false
        }, 5000)
        this.update_loan_status()
      },
    delay2() {
        this.disabled2 = true
        this.timeout2 = setTimeout(() => {
          this.disabled2 = false
        }, 5000)
        this.pay_loan()
      },
            return_loan(loanid) {
                this.loanid = loanid;
                if (this.returnamount > this.us_amount) {
                    this.e_returnamount = "Amount should be equal to total loan";
                    this.$toastr.e("Loan not returned.", "Error!");
                }
                else {
                    this.e_returnamount = "";
                    axios.post('./return_loan', {
                        loanid: this.loanid,
                        returnamount: this.returnamount,
                        pay_emp_id: this.pay_emp_id,
                        pay_type: this.us_type,
                    })
                        .then(data => {
                            if (data.data == "Loan returned!") {
                                this.$toastr.s("Loan returned successfully!", "Congratulations");
                                this.returnamount = "";

                                axios.get('fetch_all_loans')
                                    .then(data => this.loans = data.data)
                                    .catch(error => { });
                            }
                            else if (data.data == "Loan amount not correct!"){
                                this.$toastr.e("Enter correct amount to return.", "Loan not returned!");
                            }
                            else{
                                this.$toastr.e("Loan not returned.", "Error!");
                            }
                        })
                }

            },
            getbyfilter() {
                if (this.department == '' && this.designation == '' && this.search_name == '') {
                    this.$toastr.e("Please Select Filter First", "Important Fields Missing!")
                }
                else {
                    if (this.search_name == '') {
                        this.search_name1 = "All";
                    }
                    else {
                        this.search_name1 = this.search_name;
                    }

                    if (this.check_approved == true) {
                        this.check_approved1 = "1";
                    }
                    else {
                        this.check_approved1 = "0";
                    }


                    axios.get('./filter_loans/' + this.from_date + '/' + this.to_date + '/' + this.department + '/' + this.designation + '/' + this.search_name1)
                        .then(data => this.loans = data.data)
                        .catch(error => { });
                }
            },
            fetch_emp_detail() {
                this.empId = this.name;

                if (this.name != "") {

                    axios.get('fetch_employee_dtl/' + this.empId)
                        .then(responce => {
                            this.name = responce.data[0].EmployeeID;
                            this.salary = responce.data[0].Salary;
                            if (this.type == 'Advance') {
                                this.max_advance = this.salary * 1;
                            }
                            else {
                                this.max_advance = this.salary * 2.5;
                            }
                            this.doj = responce.data[0].JoiningDate;
                            this.emp_id1 = responce.data[0].EmployeeID;
                        })
                        .catch(error => { });
                }
                else {
                    this.name = '';
                    this.salary = '';
                    this.max_advance = '0';
                    this.doj = '';
                    this.emp_id1 = '';
                }

            },
            count_max_limit() {
                if (this.type == 'Advance') {
                    this.max_advance = this.salary * 1;
                }
                else {
                    this.max_advance = this.salary * 2.5;
                }
            },
            apply_loan() {
                if (this.amount == '' || this.amount > this.max_advance || this.type == '' || this.reason == '' || (this.type == 'Loan' && this.no_of_inst == '0')) {
                    if (this.amount == '') {
                        this.amount_error = "Enter amount";
                    }
                    else {
                        this.amount_error = "";
                    }
                    if (this.type == '') {
                        this.type_error = "Select type";
                    }
                    else {
                        this.type_error = "";
                    }
                    if (this.reason == '') {
                        this.reason_error = "Type reason";
                    }
                    else {
                        this.reason_error = "";
                    }
                    if (this.no_of_inst == '0') {
                        this.installments_error = "Select number of installments";
                    }
                    else {
                        this.installments_error = "";
                    }
                    this.$toastr.e("Loan not added.", "Error!");

                }
                else {
                    //Add loan
                    axios.post('./loan', {
                        type: this.type,
                        amount: this.amount,
                        reason: this.reason,
                        installments: this.no_of_inst,
                        installmentPrice: this.installmentPrice,
                        emp_id1: this.emp_id1,
                    })
                        .then(data => {
                            if (data.data == 'Loan added Successfully!') {
                                this.$toastr.s("Loan added successfully!", "Congratulations!");
                                this.type = "Advance";
                                this.amount = "";
                                this.reason = "";
                                this.no_of_inst = "0";
                                this.installmentPrice = "";

                                axios.get('fetch_all_loans')
                                    .then(data => this.loans = data.data)
                                    .catch(error => { });

                                axios.get('fetch_filtered_loans/' + this.check)
                                    .then(data => this.loans = data.data)
                                    .catch(error => { });
                            }
                            else {
                                this.$toastr.e("You are not elligible for loan & advance.", "Sorry!");
                            }
                        })
                }
            },
            fetch_emp_upSts(id, man) {
                this.man_hr = man;
                this.usid = id;
                axios.get('fetch_emp_upSts/' + this.usid)
                    .then(responce => {
                        this.pay_loanID = this.usid;
                        this.pay_date = responce.data[0].pay_date;
                        this.pay_type = responce.data[0].LoanType;
                        this.pay_emp_id = responce.data[0].EmployeeID;
                        this.us_reason = responce.data[0].LoanReason;
                        this.us_c_name = responce.data[0].Name;
                        this.us_amount = responce.data[0].LoanAmount;
                        this.rcvBy = responce.data[0].ReceivedBy;
                        this.us_installments = responce.data[0].LoanInstallments;
                        this.us_type = responce.data[0].LoanType;
                        this.us_date = responce.data[0].ApplyDate;
                        this.us_m_sts = responce.data[0].ManagerApproval;
                        this.us_hr_sts = responce.data[0].HrApproval;
                    })
            },
            pay_loan() {
                if (this.rcvBy == '') {
                    this.rcvBy_error = "Enter name of receiver";
                    this.$toastr.e("Loan not paied.", "Error!");

                }
                else {
                    this.rcvBy_error = "";
                    axios.post('./pay_loan', {
                        pay_loanID: this.pay_loanID,
                        pay_amount: this.us_amount,
                        pay_emp_id: this.pay_emp_id,
                        pay_installments: this.us_installments,
                        pay_type: this.pay_type,
                        rcvBy: this.rcvBy,
                        ins_start: this.ins_start,
                    })
                        .then(data => {
                            if (data.data == "Loan paid!") {
                                this.$toastr.s("Loan paid! successfully!", "Congratulations");

                                this.pay_loanID = "";
                                this.us_amount = "";
                                this.us_installments = "";
                                this.pay_type = "";
                                this.rcvBy = "";
                                axios.get('fetch_filtered_loans/' + this.check)
                                    .then(data => this.loans = data.data)
                                    .catch(error => { });
                            }
                            else if (data.data == "Loan already provided!") {
                                this.$toastr.e("Loan already paied.", "Warning!");
                            }
                        })
                }
            },
            update_loan_status() {
                if (this.us_man_status == '') {
                    this.us_man_status_error = "Select status to change";
                    this.$toastr.e("Status not changed", "Error!");
                }
                else {
                    this.us_man_status_error = "";

                    if (this.man_hr == "man") {
                        axios.post('./update_loan_m_sts', {
                            usid: this.usid,
                            manager_status: this.us_man_status,
                            pay_emp_id: this.pay_emp_id,
                            hr_status: this.us_hr_sts,
                        })
                            .then(data => {
                                if (data.data == "Status updated!") {
                                    this.$toastr.s("Loan status changed successfully!", "Congratulations");

                                    this.m_check = "Manager";
                                    this.check_approved = true;
                                    this.check_pending = true;
                                    this.check_rejected = false;
                                    this.view_loans();
                                    axios.get('fetch_filtered_loans/' + this.check)
                                        .then(data => this.loans = data.data)
                                        .catch(error => { }); this.usid = "";

                                    this.us_man_status = "";
                                    this.us_hr_sts = "";

                                }
                                else if (data.data == "Loan already provided!") {
                                    this.$toastr.e("Loan already provided.", "Error!");
                                }
                            })
                    }
                    else if (this.man_hr == "hr") {
                        axios.post('./update_loan_m_sts', {
                            usid: this.usid,
                            manager_status: this.us_m_sts,
                            hr_status: this.us_man_status,
                            pay_emp_id: this.pay_emp_id,
                            req_status: "Approved",
                        })
                            .then(data => {
                                if (data.data == "Status updated!") {
                                    this.$toastr.s("Loan status changed successfully!", "Congratulations");

                                    this.m_check = "HR Manager";
                                    this.check_approved = true;
                                    this.check_pending = true;
                                    this.check_rejected = false;
                                    this.view_loans();

                                    axios.get('fetch_filtered_loans/' + this.check)
                                        .then(data => this.loans = data.data)
                                        .catch(error => { });
                                    this.us_man_status = "";
                                    this.us_hr_sts = "";
                                }
                                else if (data.data == "Loan already provided!") {
                                    this.$toastr.e("Loan already provided.", "Error!");
                                }
                            })
                    }
                }
            },
            view_loans() {
                if (this.check_approved == false && this.check_pending == false && this.check_rejected == false && this.m_check == "Both") {
                    this.check = 0;
                }
                else if (this.check_approved == true && this.check_pending == false && this.check_rejected == false && this.m_check == "Both") {
                    this.check = 1;
                }
                else if (this.check_approved == true && this.check_pending == true && this.check_rejected == false && this.m_check == "Both") {
                    this.check = 2;
                }
                else if (this.check_approved == true && this.check_pending == true && this.check_rejected == true && this.m_check == "Both") {
                    this.check = 3;
                }
                else if (this.check_approved == true && this.check_pending == false && this.check_rejected == true && this.m_check == "Both") {
                    this.check = 4;
                }
                else if (this.check_approved == false && this.check_pending == true && this.check_rejected == true && this.m_check == "Both") {
                    this.check = 5;
                }
                else if (this.check_approved == false && this.check_pending == true && this.check_rejected == false && this.m_check == "Both") {
                    this.check = 6;
                }
                else if (this.check_approved == false && this.check_pending == false && this.check_rejected == true && this.m_check == "Both") {
                    this.check = 7;
                }
                //Department manager filter

                else if (this.check_approved == false && this.check_pending == false && this.check_rejected == false && this.m_check == "Manager") {
                    this.check = 10;
                }
                else if (this.check_approved == true && this.check_pending == false && this.check_rejected == false && this.m_check == "Manager") {
                    this.check = 11;
                }
                else if (this.check_approved == true && this.check_pending == true && this.check_rejected == false && this.m_check == "Manager") {
                    this.check = 12;
                }
                else if (this.check_approved == true && this.check_pending == true && this.check_rejected == true && this.m_check == "Manager") {
                    this.check = 13;
                }
                else if (this.check_approved == true && this.check_pending == false && this.check_rejected == true && this.m_check == "Manager") {
                    this.check = 14;
                }
                else if (this.check_approved == false && this.check_pending == true && this.check_rejected == true && this.m_check == "Manager") {
                    this.check = 15;
                }
                else if (this.check_approved == false && this.check_pending == true && this.check_rejected == false && this.m_check == "Manager") {
                    this.check = 16;
                }
                else if (this.check_approved == false && this.check_pending == false && this.check_rejected == true && this.m_check == "Manager") {
                    this.check = 17;
                }

                //HR manager filter

                else if (this.check_approved == false && this.check_pending == false && this.check_rejected == false && this.m_check == "HR Manager") {
                    this.check = 20;
                }
                else if (this.check_approved == true && this.check_pending == false && this.check_rejected == false && this.m_check == "HR Manager") {
                    this.check = 21;
                }
                else if (this.check_approved == true && this.check_pending == true && this.check_rejected == false && this.m_check == "HR Manager") {
                    this.check = 22;
                }
                else if (this.check_approved == true && this.check_pending == true && this.check_rejected == true && this.m_check == "HR Manager") {
                    this.check = 23;
                }
                else if (this.check_approved == true && this.check_pending == false && this.check_rejected == true && this.m_check == "HR Manager") {
                    this.check = 24;
                }
                else if (this.check_approved == false && this.check_pending == true && this.check_rejected == true && this.m_check == "HR Manager") {
                    this.check = 25;
                }
                else if (this.check_approved == false && this.check_pending == true && this.check_rejected == false && this.m_check == "HR Manager") {
                    this.check = 26;
                }
                else if (this.check_approved == false && this.check_pending == false && this.check_rejected == true && this.m_check == "HR Manager") {
                    this.check = 27;
                }

                axios.get('fetch_filtered_loans/' + this.check)
                    .then(data => this.loans = data.data)
                    .catch(error => { });
            },
        },
        mounted() {

            axios.get('fetch_all_loans')
                .then(data => this.loans = data.data)
                .catch(error => { });

            axios.get('fetch_all_installments')
                .then(data => this.installments = data.data)
                .catch(error => { });

            axios.get('overall_employees_pr')
                .then(response => this.employees = response.data)
                .catch(error => { });

            axios.get('overall_department')
                .then(response => this.departments = response.data)
                .catch(error => { });
            axios.get('overall_designation')
                .then(response => this.designations = response.data)
                .catch(error => { });
        },
    };
</script>
