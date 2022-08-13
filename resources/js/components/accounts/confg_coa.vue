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
                            <li class="breadcrumb-item active">Chart of Accounts
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
                        <h4 class="card-title">Chart of Accounts Detail</h4>
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
  														   <div class="row">
  														   <div class="col-md-3" style="border-right: 1px solid lightgray;padding-right: 0px">
  														   <div class="" style="background:#0d6efd !important;margin-bottom:10px;padding:4px;border-radius:0px !important;font-size:16px">
								                            <h6 style="color:white !important">Types</h6>
								                        </div>

													<ul id="myUL">

													  <li><span class="caret">All</span>
													    <ul class="nested">
													      <li ><span class="caret">2 : Assets</span>
													        <ul class="nested">
													          <li><a class="tea" href="#">201 : Equity</a></li>
													          <li><a class="tea" href="#">202 : Current Liabilities</a></li>
													          
													        </ul>
													      </li>  
													     <li><span class="caret">Libilitis</span>
													        <ul class="nested">
													           <li><a class="tea" href="#">201 : Equity</a></li>
													          <li><a class="tea" href="#">202 : Current Liabilities</a></li>
													          
													        </ul>
													      </li>  
													      <li><span class="caret">Revenue</span>
													        <ul class="nested">
													         <li><a class="tea" href="#">201 : Equity</a></li>
													          <li><a class="tea" href="#">202 : Current Liabilities</a></li>
													          
													        </ul>
													      </li>  
													      <li><span class="caret">Expense</span>
													        <ul class="nested">
													          <li><a class="tea" href="#">201 : Equity</a></li>
													          <li><a class="tea" href="#">202 : Current Liabilities</a></li>
													          
													        </ul>
													      </li>  
													    </ul>
													  </li>
													</ul>
  														   </div>
  														   <div class="col-md-9" style="padding-left: 0px">
  														   <div class="" style="background:#0d6efd !important;padding:4px;border-radius:0px !important;font-size:16px">
								                            <h6 style="color:white !important">Detail</h6>
								                        </div>
  														    <div class="table-responsive" style="overflow-x: initial !important;">
                                                                    <table class="table table-hover">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Code</th>
                                                                                <th>Account Name</th>
                                                                                <th>Type</th>
                                                                                <th>Main Head</th>
                                                                                <th>Allow Reconciliation</th>
                                                                               
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr class="odd" v-for="adsdata1 in adsdata" :key="adsdata1">
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


  														   </div>
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
                        <h3 class="text-center mb-1" id="addNewCardTitle">Create New Ledger Account</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-5 mx-50 pb-5">
                   
                            <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                            <div class="col-md-6 col-12">
                                <label class="form-label" for="modalAddCardName">Account Name</label>
                                <input type="text" v-model="account_name" class="form-control" style="" />
                                 <span
                              style="color: #db4437; font-size: 11px"
                              v-if="account_name == ''"
                              >{{ account_name_error }}</span
                            >
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label" for="modalAddCardName">Type</label>
                               <select class="form-select" v-model="category_type">
                               <option value="Assets">Assets</option>
                               <option value="Liabilities">Liabilities</option>
                               <option value="None">None</option>
                               </select>
                                <span
                              style="color: #db4437; font-size: 11px"
                              v-if="category_type == ''"
                              >{{ category_type_error }}</span
                            >
                            </div>
                             <div class="col-md-6 col-12">
                                <label class="form-label" for="modalAddCardName">Main Head</label>
                               <select class="form-select" v-model="main_head">
                               <option value="Fixed">Fixed</option>
                               <option value="Percentage">Percentage of Price</option>
                              
                               </select>
                                <span
                              style="color: #db4437; font-size: 11px"
                              v-if="main_head == ''"
                              >{{ main_head_error }}</span
                            >
                            </div>
                           
                             <div class="col-md-6 col-12">
                           <label style="width:100%;padding-left:60px">Allow Reconcilation</label>
                             <div style="margin-bottom:10px;margin-top:10px;padding-left: 100px;" class="form-check form-check-info form-switch">
                              <input style="width: 50px;" type="checkbox" v-model="tax_status" class="form-check-input" id="customSwitch3">
                                </div>
                             </div>

                             <div class="col-md-6 col-12" v-if="this.tax_computation=='Percentage'">
                                <label class="form-label" for="modalAddCardName">Amount</label>
                                <input type="number" v-model="tax_amount" placeholder="Type Percentage Value of Tax" class="form-control" style="" />
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
            tax_status:'true',
            account_name:"",
            account_name_error:"",
            category_type:"",
            category_type_error:"",
            main_head:"",
            main_head_error:"",
            adsdata: {

            },
          
        }
    },

    methods: {
       





       

        submit_session() {
if (
        this.account_name == "" ||
        this.category_type == "" ||
        this.main_head == "" 
      ) {
        this.$toastr.e("Please fill required fields!", "Caution!");
        if (this.account_name == "") {
          this.account_name_error = "Please enter name";
        }
        if (this.category_type == "") {
          this.category_type_error = "Please select type";
        }
        if (this.main_head == "") {
          this.main_head_error = "Please select main head";
        }
        
      }
      if(this.account_name && this.category_type && this.main_head){

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
            .then(response => {
            this.user_access = response.data
            var toggler = document.getElementsByClassName("caret");
			var i;

			for (i = 0; i < toggler.length; i++) {
			  toggler[i].addEventListener("click", function() {
			    this.parentElement.querySelector(".nested").classList.toggle("active");
			    this.classList.toggle("caret-down");
			  });
			}

            })
       
       
       
    }
}

</script>
<style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; 
  -moz-user-select: none; 
  -ms-user-select: none; 
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); 
  -webkit-transform: rotate(90deg); 
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}
.tea:link {
color: #000;
text-decoration: none;
}
.tea:visited {
color: #000;
font-weight: bold;
}
.tea:active {
color: #000;
font-weight: bold;
}
</style>
