<template>
    <div >
        <!-- BEGIN: Content-->
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
                            <li class="breadcrumb-item active">Accounts Session
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="content-body">
                    <section class="app-user-view-account">
                        <div class="row">
                            <!-- User Sidebar -->
                          
                  
                            <!--/ User Sidebar -->
                                    <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                                <!-- User Card -->
                                <div class="card">
                                <div class="card-header">
                                                                <h4 class="card-title">Accounts Session(s) Detail</h4>
                                                                <div style="text-align: right;width: 30% !important;">
                                                                <a style="float:left" data-bs-toggle="modal" data-bs-target="#addNewCard" class="btn btn-outline-primary waves-effect" type="button">Create New</a>
                                                                <div class="" style="float:right">
                                                                 <div style=""><label>
                                                                <input autocomplete="off" class="form-control" style="" placeholder="Search By Name" />
                                                                 </label></div>
                                                                 </div>
                                                                 </div>
                                                            </div>
                                    <div class="card-body">
                                        <div style="margin-bottom:20px;" class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                                             <section id="accordion-with-border">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div id="accordionWrapa50" role="tablist" aria-multiselectable="true">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="card-title">Session Details</h4>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive" style="overflow-x: initial !important;">
                                                                    <table class="table table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Name</th>
                                                                                <th>Start</th>
                                                                                <th>End</th>
                                                                                <th></th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="odd" v-for="adsdata1 in adsdata.data" :key="adsdata1">
                                                                                <td>{{adsdata1.SessionName}}</td>
                                                                                <td>{{adsdata1.StartDate}}</td>
                                                                                <td>{{adsdata1.EndDate}}</td>
                                                                                <td>
                                                                                    <span class="badge bg-gradient-success" v-if="adsdata1.CurrentSession==1">Running</span>
                                                                                    <span v-if="user_access.hr_overall=='true'">
                                                                                        <a v-if="adsdata1.AttClosedPayrollStart=='Open'" @click="fetch_session_id(adsdata1.SessionID)" data-bs-toggle="modal" data-bs-target="#hireinterview">
                                                                                            <span class="badge bg-gradient-info" style="cursor: pointer;">Open</span>
                                                                                        </a>
                                                                                        <a v-else>
                                                                                            <span class="badge bg-gradient-warning" style="cursor: pointer;">Closed</span>
                                                                                        </a>
                                                                                    </span>
                                                                                    <span v-else>
                                                                                        <a v-if="adsdata1.AttClosedPayrollStart=='Open'">
                                                                                            <span class="badge bg-gradient-info" style="cursor: pointer;">Open</span>
                                                                                        </a>
                                                                                        <a v-else>
                                                                                            <span class="badge bg-gradient-warning" style="cursor: pointer;">Closed</span>
                                                                                        </a>
                                                                                    </span>
                                                                                </td>
                                                                                <td>
                                                                                <a @click="delete_session(adsdata1.SessionID)" class="me-25">
                                                                                        <i style="color:black" class="fa-solid fa-pencil"></i>
                                                                                    </a>
                                                                                    <a @click="delete_session(adsdata1.SessionID)" class="me-25">
                                                                                        <i style="color:#d42f2f" class="fa-solid fa-trash"></i>
                                                                                    </a>
                                                                                    </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div style="text-align:center;padding-top:20px">
                                                                    <pagination :data="adsdata" @pagination-change-page="getResult"></pagination>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        </div>
                                       
                                    </div>
                                </div>
                                <!-- /User Card -->
                            </div>
                        </div>
                    </section>
                   
                </div>
            </div>
        </div>
        <div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <h3 class="text-center mb-1" id="addNewCardTitle">Create Session</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-5 mx-50 pb-5">
                   
                            <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                            <div class="col-12">
                                <label class="form-label" for="modalAddCardName">Start From</label>
                                <input type="date" v-model="session_start" class="form-control" style="" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="modalAddCardName">Start End</label>
                                <input type="date" v-model="session_end" class="form-control" style="" />
                            </div>
                           <div>
                           <label style="width:100%">Current</label>
                             <div style="margin-bottom:10px" class="form-check form-check-info form-switch">
                              <input style="width: 50px;" type="checkbox" v-model="c_session" class="form-check-input" id="customSwitch3">
                                </div>
                             </div>
                            
                            <div class="col-12 text-center">
                                <button type="submit" @click="submit_session()" class="btn btn-primary me-1 mt-1">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            user_access: {},
            session_start: '',
            session_end: '',
            c_session: '',
            adsdata: {

            },
          
        }
    },

    methods: {
        fetch_session_id(id) {
            this.fetch_sessoin_id = id;
        },
        update_session_payroll() {
            axios.get('update_payroll_status/' + this.fetch_sessoin_id)
                .then(response => {

                    this.$toastr.s("Attendance Closed and proceed in Payroll Section!", "Information");

                })
            this.$router.go(0);
        },





        delete_session(id) {
            axios.get('delete_session/' + id)
                .then(response => {
                    this.$toastr.s("Delete Record Successfully!", "Deleted");
                    this.adsdata = response.data

                })
                .catch(error => {});

        },

        submit_session() {
             

             if(this.session_start && this.session_end){

             
            axios.post('submit_session', {
                    session_start: this.session_start,
                    session_end: this.session_end,
                    c_session: this.c_session,
                })
                .then(data => {
                    if (data.data == 'NotSubmitted') {
                        this.$toastr.e("Session Name Already Exists!", "Change Roster Name");
                    } else {
                        this.$toastr.s("Session Created Successfully!", "Congratulations");
                        this.adsdata = data.data;
                    }


                })
                .catch(error => {});


             }
        },
        getResult(page = 1) {

            axios.get('session_detail/?page=' + page)
                .then(response => this.adsdata = response.data)
                .catch(error => {});
        },


    },

    mounted() {
        axios.get('./fetch_user_hr_roles')
            .then(response => this.user_access = response.data)
        this.getResult();
        this.getResult2();
        this.getResult3();
        this.getResult4();
        axios.get('view_hr_configuration')
            .then(response => {
                this.gratuty_start = response.data[0].GratutyStart;
                this.max_loan = response.data[0].MaxLoan;
                this.days_deduction = response.data[0].MinutesDeduction;
                this.max_installment = response.data[0].MaxInstallment;
                this.annual_leaves = response.data[0].AnnualLeaves;
                this.sick_leaves = response.data[0].SickLeaves;
                this.casual_start = response.data[0].CasualLeaves;

            })
            .catch(error => {});
        axios.get('find_emp_id')
            .then(data => this.find_emp = data.data)
            .catch(error => {});
    }
}

</script>
