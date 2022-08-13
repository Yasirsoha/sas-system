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
                                <router-link to="/hr/dashboard" style="text-decoration: none;">Accounts Dashboard</router-link>
                            </li>
                            <li class="breadcrumb-item active">Taxes
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
                        <h4 class="card-title">Taxes Detail</h4>
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
                                                            
                                                            <div class="card-body">
                                                                <div class="table-responsive" style="overflow-x: initial !important;">
                                                                    <table class="table table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Tax Name</th>
                                                                                <th>Tax Type</th>
                                                                                <th>Tax Scope</th>
                                                                                <th>Label On Invoices</th>
                                                                                <th>Value</th>
                                                                                <th>Status</th>
                                                                                
                                                                               
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="odd" v-for="adsdata1 in adsdata.data" :key="adsdata1">
                                                                            <td>PKR</td>
                                                                                <td>PKR</td>
                                                                                <td>Rs.</td>
                                                                                <td>Pakistani y-09876Rupee</td>
                                                                                 <td>Rs.</td>
                                                                                <td>
                                                                                   <div style="margin-bottom:10px" class="form-check form-check-info form-switch">
                                                                                    <input style="width: 50px;" type="checkbox" v-model="c_session" class="form-check-input" id="customSwitch3">
                                                                                </div> 
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
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <h3 class="text-center mb-1" id="addNewCardTitle">Create Taxes Head</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-5 mx-50 pb-5">
                   
                            <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                            <div class="col-md-6 col-12">
                                <label class="form-label" for="modalAddCardName">Tax Name</label>
                                <input type="text" v-model="tax_name" class="form-control" style="" />
                                <span
                              style="color: #db4437; font-size: 11px"
                              v-if="tax_name == ''"
                              >{{ tax_name_error }}</span
                            >
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label" for="modalAddCardName">Tax Type</label>
                               <select class="form-select" v-model="tax_type">
                               <option value="Sales">Sales</option>
                               <option value="Purchase">Purchase</option>
                               <option value="None">None</option>
                               </select>
                               <span
                              style="color: #db4437; font-size: 11px"
                              v-if="tax_type == ''"
                              >{{ tax_type_error }}</span
                            >
                            </div>
                             <div class="col-md-6 col-12">
                                <label class="form-label" for="modalAddCardName">Tax Computation</label>
                               <select class="form-select" v-model="tax_computation">
                               <option value="Fixed">Fixed</option>
                               <option value="Percentage">Percentage of Price</option>
                              
                               </select>
                               <span
                              style="color: #db4437; font-size: 11px"
                              v-if="tax_computation == ''"
                              >{{ tax_computation_error }}</span
                            >
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label" for="modalAddCardName">Tax Scope</label>
                               <select class="form-select" v-model="tax_scope">
                               <option value="Goods">Goods</option>
                               <option value="Services">Services</option>
                                </select>
                                <span
                              style="color: #db4437; font-size: 11px"
                              v-if="tax_scope == ''"
                              >{{ tax_scope_error }}</span
                            >
                            </div>
                             <div class="col-md-6 col-12">
                           <label style="width:100%">Active</label>
                             <div style="margin-bottom:10px;margin-top:5px" class="form-check form-check-info form-switch">
                              <input style="width: 50px;" type="checkbox" v-model="tax_status" class="form-check-input" id="customSwitch3">
                                </div>
                             </div>




                             <div class="col-md-6 col-12" v-if="this.tax_computation=='Percentage'">
                                <label class="form-label" for="modalAddCardName">Amount</label>
                                <input type="number" v-model="tax_amount" placeholder="Type Percentage Value of Tax" class="form-control" style="" />
                                <span
                              style="color: #db4437; font-size: 11px"
                              v-if="tax_amount == ''"
                              >{{ tax_amount_error }}</span
                            >
                            </div>
                            <div class="col-md-6 col-12" v-if="this.tax_computation=='Fixed'">
                                <label class="form-label" for="modalAddCardName">Amount</label>
                                <input type="number" placeholder="Type Fixed Value of Tax" v-model="tax_amount" class="form-control" style="" />
                                 <span
                              style="color: #db4437; font-size: 11px"
                              v-if="tax_amount == ''"
                              >{{ tax_amount_error }}</span
                            >
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
             tax_name:'',
            tax_type:'Sales',
            tax_computation:'Fixed',
            tax_amount:'',
            tax_scope:'Goods',
            tax_name_error:"",
            tax_type_error:"",
            tax_computation_error:"",
            tax_amount_error:"",
            tax_scope_error:"",
            tax_status:'true',
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
if (
        this.tax_name == "" ||
        this.tax_type == "" ||
        this.tax_computation=="" ||
        this.tax_amount=="" ||
        this.tax_scope==""
      ) {
        this.$toastr.e("Please fill required fields!", "Caution!");
        if (this.tax_name == "") {
          this.tax_name_error = "Please enter name";
        }
        if (this.tax_type == "") {
          this.tax_type_error = "Please select type";
        }
        }
        if (this.tax_computation == "") {
          this.tax_computation_error = "Please select computation";
        }
        if (this.tax_amount == "") {
          this.tax_amount_error = "Please enter amount";
        }
        if (this.tax_scope == "") {
          this.tax_scope_error = "Please select scope";
        }
        if(this.tax_name && this.tax_type && this.tax_computation && this.tax_scope && this.tax_amount){

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
