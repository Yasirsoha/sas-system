<template>
 <div>
   <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><router-link to="/hr/dashboard" style="text-decoration: none;">Dashboard</router-link>
                                    </li>
                                    <li class="breadcrumb-item">
                                    <router-link to="/hr/employees_detail" style="text-decoration: none;">Employees Detail</router-link>
                                    </li>
                                    <li class="breadcrumb-item active">Employee Finance
                                    </li>
                                </ol>
                                <b-progress :value="value" variant="success" :striped="striped" animated class="mb-3"></b-progress>
                </div>
            </div>
            <div class="content-body">
                <section class="app-user-view-account">
                    <div class="row">
                        <!-- User Sidebar -->
                        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
                            <!-- User Card -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="user-avatar-section">
                                        <div class="d-flex align-items-center flex-column">
                                            <img class="img-fluid rounded mt-3 mb-2" src="public/app-assets/images/portrait/small/avatar-s-2.jpg" height="110" width="110" alt="User avatar" />
                                            <div class="user-info text-center">
                                                <h4>Full Name</h4>
                                                <span class="badge bg-light-secondary">Designation</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-around my-2 pt-75">
                                        <div class="d-flex align-items-start me-2">
                                            <span class="badge bg-light-primary p-75 rounded">
                                                <i data-feather="check" class="font-medium-2"></i>
                                            </span>
                                            <div class="ms-75">
                                                <h4 class="mb-0">4</h4>
                                                <small>Years Completed</small>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start">
                                            <span class="badge bg-light-primary p-75 rounded">
                                                <i data-feather="briefcase" class="font-medium-2"></i>
                                            </span>
                                            <div class="ms-75">
                                                <h4 class="mb-0">90%</h4>
                                                <small>Progress</small>
                                            </div>
                                        </div>
                                    </div>
                                    <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
                                    <div class="info-container">
                                        <ul class="list-unstyled">
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Username:</span>
                                                <span>violet.dev</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Billing Email:</span>
                                                <span>vafgot@vultukir.org</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Status:</span>
                                                <span class="badge bg-light-success">Active</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Role:</span>
                                                <span>Author</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Tax ID:</span>
                                                <span>Tax-8965</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Contact:</span>
                                                <span>+1 (609) 933-44-22</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Language:</span>
                                                <span>English</span>
                                            </li>
                                            <li class="mb-75">
                                                <span class="fw-bolder me-25">Country:</span>
                                                <span>Wake Island</span>
                                            </li>
                                        </ul>
                                        <div class="d-flex justify-content-center pt-2">
                                            <a href="javascript:;" class="btn btn-primary me-1" data-bs-target="#editUser" data-bs-toggle="modal">
                                              Warning
                                            </a>
                                            <a href="javascript:;" class="btn btn-outline-danger suspend-user">Suspend</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /User Card -->
                            <!-- Plan Card -->
                            <div class="card border-primary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <span class="badge bg-light-primary">Salary</span>
                                        <div class="d-flex justify-content-center">
                                            <sup class="h5 pricing-currency text-primary mt-1 mb-0" >Rs.</sup>
                                            <span class="fw-bolder display-5 mb-0 text-primary" style="font-size:18px">50,000</span>
                                            <sub class="pricing-duration font-small-4 ms-25 mt-auto mb-2">/month</sub>
                                        </div>
                                    </div>
                                    <div style="font-size:18px;margin-top:20px"><span class="fw-bolder display-5 mb-0 text-primary" style="font-size:18px" >Job Description</span>
                                    </div>
                                    <ul class="ps-1 mb-2" style="padding-left:20px !important">
                                        <li class="mb-50">10 Users</li>
                                        <li class="mb-50">Up to 10 GB storage</li>
                                        <li>Front End Development</li>
                                         <li>Front End Development</li>
                                          <li>Office Assistant</li>
                                           <li>Basic Support</li>
                                            <li>Basic Support</li>
                                             <li>Basic Support</li>
                                    </ul>
                                    
                                </div>
                            </div>
                            <!-- /Plan Card -->
                        </div>
                        <!--/ User Sidebar -->

                        <!-- User Content -->
                        <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
                            <!-- User Pills -->
                            <!-- User Pills -->
                            <ul class="nav nav-pills mb-2" style="padding-left:20px !important">
                                <li class="nav-item">
                                    <router-link to="/hr/employee_detail"  class="nav-link" >
                                        <i class="fa-solid fa-person"></i>
                                        <span class="fw-bold">Personal</span></router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/hr/employee_leaves" class="nav-link" >
                                       <i class="fa-solid fa-candy-cane"></i>
                                        <span class="fw-bold">Leaves</span>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/hr/employee_attendance" class="nav-link" >
                                      <i class="fa-solid fa-file-powerpoint"></i>
                                        <span class="fw-bold">Attendance</span>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link to="/hr/employee_financial" class="nav-link  active" >
                                       <i class="fa-solid fa-receipt"></i><span class="fw-bold">Financial History</span>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link class="nav-link" to="/hr/employee_perfomance">
                                        <i class="fa-solid fa-link"></i><span class="fw-bold">Performance</span>
                                    </router-link>
                                </li>
                            </ul>
                            <!--/ User Pills -->
                         <!-- Project table -->
                            <div class="card">
                                <h4 class="card-header">Salary History</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead style="text-align:center">
                                            <tr>
                                                <th>Month</th>
                                                <th>Basic</th>
                                                <th>Received Amount</th>
                                                 <th>Received Date</th>
                                                <th>Status</th>
                                               
                                           </tr>
                                        </thead>
                                        <tbody style="text-align:center">
                                        <tr>
                                        
                                         <td>July,2022</td>
                                          <td>25000</td>
                                           <td>25000</td>
                                            <td>20-03-2022</td>
                                            <td>Received</td>
                                            </tr>
                                           <tr>
                                        
                                         <td>July,2022</td>
                                          <td>25000</td>
                                           <td>25000</td>
                                            <td>20-03-2022</td>
                                            <td>Received</td>
                                            </tr>
                                           <tr>
                                        
                                         <td>July,2022</td>
                                          <td>25000</td>
                                           <td>25000</td>
                                            <td>20-03-2022</td>
                                            <td>Received</td>
                                            </tr>
                                           <tr>
                                        
                                         <td>July,2022</td>
                                          <td>25000</td>
                                           <td>25000</td>
                                            <td>20-03-2022</td>
                                            <td>Received</td>
                                            </tr>
                                           <tr>
                                        
                                         <td>July,2022</td>
                                          <td>25000</td>
                                           <td>25000</td>
                                            <td>20-03-2022</td>
                                            <td>Received</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /Project table -->
                          
                               <!-- Project table -->
                            <div class="card">
                                <h4 class="card-header">Loan History</h4>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead style="text-align:center">
                                            <tr>
                                                <th>Month</th>
                                                <th>Basic</th>
                                                <th>Received Amount</th>
                                                 <th>Received Date</th>
                                                <th>Status</th>
                                               
                                           </tr>
                                        </thead>
                                        <tbody style="text-align:center">
                                        <tr>
                                        
                                         <td>July,2022</td>
                                          <td>25000</td>
                                           <td>25000</td>
                                            <td>20-03-2022</td>
                                            <td>Received</td>
                                            </tr>
                                          
                                       
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /Project table -->
                        </div>
                        <!--/ User Content -->
                    </div>
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->
   
   </div>
</template>

<script>
    export default {
    data() {
        return {
       value: 75,
       striped:true,
        }
        },
        methods:{
            
        },
        mounted() {
        
        }
    }
</script>