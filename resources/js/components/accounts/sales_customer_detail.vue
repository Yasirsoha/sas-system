<template>
    <div>
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
			            <li class="breadcrumb-item active">Customer Details
			            </li>
			        	</ol>
                    </div>
                </div>
                <div class="content-body">
                    <!-- users list start -->
                    <section class="app-user-list">
                       
                        <div clas="card" style="background-color:white !important">
                            
                            <div style="margin-bottom:20px;padding-top:20px" class="d-flex justify-content-between align-items-center header-actions mx-2 row mt-75">
                            	<div class="col-sm-6 col-lg-6 ps-xl-75 ps-0">
                            	<h4 class="card-title">Search & Filter</h4>
                            	</div>
								 <div class="col-sm-6 col-lg-6 ps-xl-75 ps-0">
                                    <div class="dt-action-buttons d-flex align-items-center justify-content-center justify-content-lg-end flex-lg-nowrap flex-wrap">
                                        <div class="me-1">
                                            <div class="dataTables_filter" style="margin-top:5px">
                                                <label>
                                                    <input autocomplete="off" id="keyword1" type="text" name="keyword1" v-model="keyword1" class="form-control" style="" placeholder="Search By Name" />
                                                </label>
                                            </div>
                                        </div>
                                        <div class="dt-buttons d-inline-flex mt-50">
                                            <a style="float:left" data-bs-toggle="modal" data-bs-target="#addNewCard" class="btn btn-outline-primary waves-effect" type="button">Create New Customer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" style="overflow-x: initial !important;">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone</th>
                                            <th>Mobile</th>
                                            <th>Email</th>
                                            <th>Website</th>
                                            <th>City</th>
                                            <th>Salesperson</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    <td>Mustafa Furnishing</td>
                                     <td>03454821950</td>
                                      <td>03454821950</td>
                                       <td>email@gmail.com</td>
                                        <td>www.google.com</td>
                                         <td>Lahore</td>
                                          <td>Rohan</td>
                                            <td>Active</td>
                                            <td style="vertical-align: middle; text-align: center;">
                                    <div class="btn-group">
                                        <a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4">
                                                <circle cx="12" cy="12" r="1"></circle>
                                                <circle cx="12" cy="5" r="1"></circle>
                                                <circle cx="12" cy="19" r="1"></circle>
                                            </svg>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a data-bs-toggle="modal" class="dropdown-item" @click="fetch_candidate_detail(candidates1.CandID)" data-bs-target="#viewcandidate">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                    <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                                </svg> View Detail
                                            </a>
                                            <a data-bs-toggle="modal" @click="fetch_candidate_detail(candidates1.CandID)" data-bs-target="#editcandidate" class="dropdown-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg> Edit Customer
                                            </a>
                                            <span  data-bs-target="#upd_sts" class="dropdown-item">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                                                    <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z" />
                                                    <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z" />
                                                </svg> Deactivate 
                                            </span>
                                        </div>
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
                    </section>
                    <!-- users list ends -->
                </div>
            </div>
        </div>
        <!-- END: Content-->
         <div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <h3 class="text-center mb-1" id="addNewCardTitle">Create New Customer</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-5 mx-50 pb-5">
                   
                            <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                            <div class="col-12 col-sm-12 mb-1">
					        <div class="mb-1">
					          
					            
					            <div class="demo-inline-spacing">
					                <div class="form-check form-check-inline" style="margin-top:0px">
					                    <input class="form-check-input" type="radio" v-model="c_type" name="inlineRadioOptions" id="inlineRadio1" value="Individual" >
					                    <label class="form-check-label" for="inlineRadio1">Individual</label>
					                </div>
					                <div class="form-check form-check-inline" style="margin-top:0px">
					                    <input class="form-check-input" checked="" type="radio" v-model="c_type" name="inlineRadioOptions" id="inlineRadio2" value="Company">
					                    <label class="form-check-label" for="inlineRadio2">Company</label>
					                </div>
					            </div>
					          
					        </div>
					    </div>
                            <div class="col-md-12 col-12" v-if="this.c_type=='Individual'">
                                <label class="form-label" for="modalAddCardName">Custome Name</label>
                                <input type="text" v-model="customer_name" class="form-control" placeholder='Type Customer Name' style="" />
                                <span
                            style="color: #db4437; font-size: 11px"
                            v-if="customer_name == ''"
                            >{{ customer_name_error}}</span
                          >
                            </div>
                            <div class="col-md-12 col-12" v-if="this.c_type=='Company'">
                                <label class="form-label" for="modalAddCardName">Company Name</label>
                                <input type="text" placeholder='Type Company Name' v-model="customer_name" class="form-control" style="" />
                                <span
                            style="color: #db4437; font-size: 11px"
                            v-if="customer_name == ''"
                            >{{ customer_name_error}}</span
                          >
                            </div>
                           
                             <div class="col-md-6 col-12">
                                <label class="form-label" for="modalAddCardName">Phone Number</label>
                                <masked-input class="form-control account-number-mask" mask="0311-1111111" v-model="phone_number" placeholder="Phone Number Here" />
                                <span
                            style="color: #db4437; font-size: 11px"
                            v-if="phone_number == ''"
                            >{{ phone_number_error}}</span
                          >
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label" for="modalAddCardName">Email Address</label>
                                 <input type="number" placeholder="Type Email Address" v-model="email" class="form-control" style="" value="0" />
                                 <span
                            style="color: #db4437; font-size: 11px"
                            v-if="email == ''"
                            >{{ email_error}}</span
                          >
                              
                            </div>
                            <div class="col-md-6 col-12" >
                                <label class="form-label" for="modalAddCardName">Mobile Number</label>
                               <masked-input class="form-control account-number-mask" mask="0311-1111111" v-model="mobile_number" placeholder="Phone Number Here" />
                               <span
                            style="color: #db4437; font-size: 11px"
                            v-if="mobile_number == ''"
                            >{{mobile_number_error}}</span
                          >
                            </div>
                            <div class="col-md-6 col-12" >
                                <label class="form-label" for="modalAddCardName">Website Link</label>
                               <input type="text" placeholder="Type website link" v-model="website" class="form-control" style=""  />
                               <span
                            style="color: #db4437; font-size: 11px"
                            v-if="website == ''"
                            >{{ website_error}}</span
                          >
                            </div>
                            <div class="col-md-12 col-12" >
                                <label class="form-label" for="modalAddCardName">Website Link</label>
                               <textarea placeholder="Type Office Or Delivery Address" v-model="delivery_address" class="form-control" style="" ></textarea>
                               <span
                            style="color: #db4437; font-size: 11px"
                            v-if="delivery_address == ''"
                            >{{ delivery_address_error}}</span
                          >
                            </div>
                            <div class="col-12" style="text-align:center">
							<button @click="submit_customer()" type="button" class="btn btn-primary mt-1 me-1 waves-effect waves-float waves-light">Save  Customer</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import MaskedInput from 'vue-masked-input'
export default {
    data() {
        return {
        user_access:{},
            adsdata: {

            },
            success: '',

            keyword1: '',
            c_type:'Company',
            customer_name:'',
            phone_number:'',
            mobile_number:'',
            email:'',
            website:'',
            sales_person:'',
            delivery_address:'',
            customer_name_error:"",
            phone_number_error:"",
            mobile_number_error:"",
            email_error:"",
            website_error:"",
            delivery_address_error:""

           
        }
    },
    components: {
MaskedInput
},
    methods: {
        submit_customer(){
         if(this.customer_name=="" || this.phone_number=="" || this.mobile_number=="" || this.email=="" || this.website=="" || this.delivery_address==""){
                    this.$toastr.e("Please fill required fields!", "Caution!");
                    {
                        if (this.customer_name == "") {
            this.customer_name_error = "Please enter customer name";
          }
          if (this.phone_number == "") {
            this.phone_number_error = "Please enter phone number";
          }
          if (this.mobile_number == "") {
            this.mobile_number_error = "Please enter mobile number";
          }
          if (this.email == "") {
            this.email_error = "Please enter email";
          }
          if(this.website==""){
            this.website_error="Please paster website link"
          }
          if(this.delivery_address==""){
            this.delivery_address_error="Please eneter full delivery or office address"
          }
                    }
          }
        },
        getbyfilter() {
            axios.post('./filter_warnings', {
                    location: this.location,
                    designation: this.designation,
                    department: this.department,


                })
                .then(data => {
                    this.adsdata = data.data;

                })



        },

        getResult(page = 1) {

            axios.get('warning_detail/?page=' + page)
                .then(response => this.adsdata = response.data)
                .catch(error => {});
        },
        getResults() {
            axios.get('./search_warnings', { params: { keyword1: this.keyword1 } })
                .then(response => this.adsdata = response.data)
                .catch(error => console.log(error));
        },
    },
    watch: {
        keyword1(after, before) {
            this.getResults();
        }
    },
    mounted() {
        axios.get('department_detail2')
            .then(data => this.departments = data.data)
        axios.get('overall_designation')
            .then(response => this.designations = response.data)
            .catch(error => {});
        axios.get('overall_location')
            .then(response => this.locations = response.data)
            .catch(error => {});
        axios.get('./count_warnings')
            .then(response => this.count_users = response.data)
            .catch(error => {});
            axios.get('./fetch_user_hr_roles')
.then(response => this.user_access = response.data)
        this.getResult();
    }
}

</script>
