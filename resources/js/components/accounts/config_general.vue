<template>
<div>
<!-- BEGIN: Content-->
<div class="app-content content">
<div class="content-overlay"></div>
<div class="header-navbar-shadow"></div>
<div class="content-wrapper container-xxl p-0">
<div class="content-header row">
<div class="breadcrumb-wrapper">
<ol class="breadcrumb">
<li class="breadcrumb-item">
<router-link to="/hr/dashboard" style="text-decoration: none">Accounts Configuration</router-link>
</li>
<li class="breadcrumb-item active">General Configuration</li>
</ol>
</div>
</div>
<div class="content-body">
<section class="app-user-view-account">
<div class="row">
<!--/ User Sidebar -->
<div class="row">
<div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
<!-- User Card -->
<div class="card">
<div class="card-body">
    <section id="accordion-with-border">
        <div class="row">
            <div class="col-sm-12">
                <div id="accordionWrapa50" role="tablist" aria-multiselectable="true">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                Accounts Configuration
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="card-header">
                                    <h6 class="card-title">Sales Prefix</h6>
                                </div>
                                <div class="col-12 col-sm-3 mb-1">
                                    <label class="form-label" for="accountFirstName">Customer Invoice</label>
                                    <label style="color: #d93025">*</label>
                                    <masked-input class="form-control account-number-mask" mask="aaa" v-model="customer_inv" placeholder="" />
                                    <span style="color: #db4437; font-size: 11px" v-if="
customer_inv == '' ||
customer_inv.length > 3
">{{ customer_inv_error }}</span>
                                </div>
                                <div class="col-12 col-sm-3 mb-1">
                                    <label class="form-label" for="accountFirstName">Credit Notes</label>
                                    <label style="color: #d93025">*</label>
                                    <masked-input class="form-control account-number-mask" mask="aaa" v-model="customer_credit" placeholder="" />
                                    <span style="color: #db4437; font-size: 11px" v-if="
customer_credit == '' ||
customer_credit.length > 3
">{{ customer_credit_error }}</span>
                                </div>
                                <div class="col-12 col-sm-2 mb-1">
                                    <label class="form-label" for="accountFirstName">Received Voucher</label>
                                    <label style="color: #d93025">*</label>
                                    <masked-input class="form-control account-number-mask" mask="aaa" v-model="customer_voucher" placeholder="" />
                                    <span style="color: #db4437; font-size: 11px" v-if="
customer_voucher == '' ||
customer_voucher.length > 3
">{{ customer_voucher_error }}</span>
                                </div>
                                <div class="col-12 col-sm-2 mb-1">
                                    <label class="form-label" for="accountFirstName">Customer</label>
                                    <label style="color: #d93025">*</label>
                                    <masked-input class="form-control account-number-mask" mask="aaaa" v-model="customer_pre" placeholder="" />
                                    <span style="color: #db4437; font-size: 11px" v-if="
customer_pre == '' ||
customer_pre.length > 4
">{{ customer_pre_error }}</span>
                                </div>
                                <div class="col-12 col-sm-2 mb-1">
                                    <label class="form-label" for="accountFirstName">Quotation</label>
                                    <label style="color: #d93025">*</label>
                                    <masked-input class="form-control account-number-mask" mask="aaaa" v-model="quotation" placeholder="" />
                                    <span style="color: #db4437; font-size: 11px" v-if="
quotation == '' ||
quotation.length > 4
">{{ quotation_error }}</span>
                                </div>
                                <div class="card-header">
                                    <h6 class="card-title">
                                        Purchase Prefix
                                    </h6>
                                </div>
                                <div class="col-12 col-sm-3 mb-1">
                                    <label class="form-label" for="accountFirstName">Purchase Order</label>
                                    <label style="color: #d93025">*</label>
                                    <masked-input class="form-control account-number-mask" mask="aaa" v-model="vendor_inv" placeholder="" />
                                    <span style="color: #db4437; font-size: 11px" v-if="
vendor_inv == '' ||
vendor_inv.length > 3
">{{ vendor_inv_error }}</span>
                                </div>
                                <div class="col-12 col-sm-3 mb-1">
                                    <label class="form-label" for="accountFirstName">Debit Notes</label>
                                    <label style="color: #d93025">*</label>
                                    <masked-input class="form-control account-number-mask" mask="aaa" v-model="vendor_debit" placeholder="" />
                                    <span style="color: #db4437; font-size: 11px" v-if="
vendor_debit == '' ||
vendor_debit.length > 3
">{{ vendor_debit_error }}</span>
                                </div>
                                <div class="col-12 col-sm-2 mb-1">
                                    <label class="form-label" for="accountFirstName">Payment Voucher</label>
                                    <label style="color: #d93025">*</label>
                                    <masked-input class="form-control account-number-mask" mask="aaa" v-model="vendor_voucher" placeholder="" />
                                    <span style="color: #db4437; font-size: 11px" v-if="
vendor_voucher == '' ||
vendor_voucher.length > 3
">{{ vendor_voucher_error }}</span>
                                </div>
                                <div class="col-12 col-sm-2 mb-1">
                                    <label class="form-label" for="accountFirstName">Vendor</label>
                                    <label style="color: #d93025">*</label>
                                    <masked-input class="form-control account-number-mask" mask="aaaa" v-model="vendor_pre" placeholder="" />
                                    <span style="color: #db4437; font-size: 11px" v-if="
vendor_pre == '' ||
vendor_pre.length > 4
">{{ vendor_pre_error }}</span>
                                </div>
                                <div class="col-12 col-sm-2 mb-1">
                                    <label class="form-label" for="accountFirstName">Requistion</label>
                                    <label style="color: #d93025">*</label>
                                    <masked-input class="form-control account-number-mask" mask="aaaa" v-model="requistion" placeholder="" />
                                    <span style="color: #db4437; font-size: 11px" v-if="requistion == '' ||requistion.length > 4">{{ requistion_error }}</span>
                                </div>
                                <div class="card-header">
                                    <h6 class="card-title">
                                        Accounting Prefix
                                    </h6>
                                </div>
                                <div class="col-12 col-sm-2 mb-1">
                                    <label class="form-label" for="accountFirstName">Journal Voucher</label>
                                    <label style="color: #d93025">*</label>
                                    <masked-input class="form-control account-number-mask" mask="aaaa" v-model="journal_voucher" placeholder="" />
                                    <span style="color: #db4437; font-size: 11px" v-if="
journal_voucher == '' ||
journal_voucher.length > 4
">{{ journal_voucher_error }}</span>
                                </div>
                                <div class="col-12 col-sm-4 mb-1"></div>
                                <div class="col-12 col-sm-3 mb-1" style="padding-top: 25px">
                                    <button type="submit" :disabled="disabled" @click="delay()" style="width: 100%" class="btn btn-primary me-1 mt-1">
                                        Update
                                    </button>
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
<!-- /User Card -->
  <section class="app-user-view-account">
                        <div class="row">
                            
                            <!-- User Sidebar -->
                            <div class="col-xl-6 col-lg-6 col-md-6 order-1 order-md-0">
                                <div class="card">
                                    <div class="card-body">
                                        <section id="accordion-with-border">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div id="accordionWrapa50" role="tablist" aria-multiselectable="true">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="card-title">Child Companies</h4>
                                                                <a data-bs-toggle="modal" data-bs-target="#addNewCard" class="btn btn-outline-primary waves-effect">Create New</a>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive" style="overflow-x: initial !important;">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Company Name</th>
                                                                                <th>Phone No</th>
                                                                                <th>Email Id</th>
                                                                                <th>Address</th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div style="text-align:center;padding-top:20px">
                                                                    <pagination :data="company_data" @pagination-change-page="getResult2"></pagination>
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
                            <!--/ User Sidebar -->
                            
                            <div class="col-xl-6 col-lg-6 col-md-6 order-1 order-md-0">
                                <!-- User Card -->
                                <div class="card">
                                    <div class="card-body">
                                        <section id="accordion-with-border">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div id="accordionWrapa50" role="tablist" aria-multiselectable="true">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h4 class="card-title">Company Projects</h4>
                                                                <a data-bs-toggle="modal" data-bs-target="#leavetype" class="btn btn-outline-primary waves-effect">Add Project</a>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="table-responsive" style="overflow-x: initial !important; min-height:271px">
                                                                    <table class="table">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Project Name</th>
                                                                                <th>Child Company</th>
                                                                                <th></th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                           
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div style="text-align:center;padding-top:20px">
                                                                    <pagination :data="project_data" @pagination-change-page="getResult3"></pagination>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                <!-- /User Card -->
                            </div>
                           
                          
                            <!-- Add holiday model-->
                            <div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header bg-transparent">
                                            <h3 class="text-center mb-1" id="addNewCardTitle">Create Child Company</h3>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body px-sm-5 mx-50 pb-5">
                                            <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                                                <div class="col-12">
                                                    <label class="form-label" for="modalAddCardName">Company Name</label>
                                                    <span style="color: #DB4437; font-size: 11px;">*</span>
                                                    <input type="text" v-model="company_name" class="form-control" placeholder="Child Company Name">
                                                   <span
                                                    style="color: #db4437; font-size: 11px"
                                                     v-if="company_name == ''"
                                                      >{{ company_name_error }}</span>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label" for="modalAddCardName">Phone No.</label>
                                                    <span style="color: #DB4437; font-size: 11px;">*</span>
                                                    <input v-model="phone_no" type="number" id="modalAddCardName" class="form-control" placeholder="Please type phone number" />
                                                   <span
                                                    style="color: #db4437; font-size: 11px"
                                                     v-if="phone_no == ''"
                                                      >{{ phone_no_error }}</span>
                                                </div>
                                                <div class="col-12 col-sm-12 mb-1">
                                                    <label class="form-label" for="basicSelect">Email Address</label>
                                                  <input v-model="company_email" type="number" id="modalAddCardName" class="form-control" />
                                                  <span
                                                    style="color: #db4437; font-size: 11px"
                                                     v-if="company_email == ''"
                                                      >{{ company_email_error }}</span>
                                                </div>
                                           
                                                <div class="col-md-12">
                                                    <label class="form-label" for="modalAddCardName">Address</label>
                                                    <input v-model="company_address" type="text" id="modalAddCardName" class="form-control" />
                                                    <span
                                                    style="color: #db4437; font-size: 11px"
                                                     v-if="company_address == ''"
                                                      >{{ company_address_error }}</span>                                          
                                              </div>
                                                <div class="col-12 text-center">
                                                    <button type="submit" :disabled="disabled1" @click="delay1()" class="btn btn-primary me-1 mt-1" >Submit</button>
                                                    <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                                        Cancel
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- / Add holiday model-->
                             <div class="modal fade" id="leavetype" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <h3 class="text-center mb-1" id="addNewCardTitle">Add New Project</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-5 mx-50 pb-5">
                        <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                            <div class="col-12">
                                <label class="form-label" for="modalAddCardName">Project Name</label>
                                <span style="color: #DB4437; font-size: 11px;">*</span>
                                <input type="text" v-model="project_name" class="form-control" placeholder="Project Names">
                                <span
                                style="color: #db4437; font-size: 11px"
                                 v-if="project_name == ''"
                                >{{ project_name_error }}</span>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="modalAddCardName">Child Company</label>
                                <span style="color: #DB4437; font-size: 11px;">*</span>
                                <select id="modalAddCardName"  class="form-select" v-model="child_company">
                                <option value="">select</option>
                                 <option value="1">company 1</option>
                                 <option value="2">company 2</option>
                                 </select>
                                <span
                                 style="color: #db4437; font-size: 11px"
                                v-if="child_company == ''"
                                >{{ child_company_error }}</span>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" :disabled="disabled2" @click="delay2()" class="btn btn-primary me-1 mt-1" >Submit</button>
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
                    </section>
</div>
</div>
</div>
</section>
</div>
</div>
</div>
</div>
</template>
<script>
import MaskedInput from "vue-masked-input";
export default {
data() {
return {
disabled2: false,
timeout2: null,
company_settings: "individual",
counter: 1,
disabled: false,
disabled1: false,
timeout1: null,
timeout: null,
customer_inv: "",
customer_inv_error: "",
customer_credit: "",
customer_credit_error: "",
customer_pre: "",
customer_pre_error: "",
customer_voucher: "",
customer_voucher_error: "",
quotation: "",
quotation_error: "",
vendor_debit: "",
vendor_debit_error: "",
vendor_inv: "",
vendor_inv_error: "",
vendor_pre: "",
vendor_pre_error: "",
vendor_voucher: "",
vendor_voucher_error: "",
requistion: "",
requistion_error: "",
journal_voucher: "",
journal_voucher_error: "",



company_name: "",
company_email: "",
company_address: "",
phone_no: "",
company_name_error:"",
company_email_error:"",
company_address_error:"",
phone_no_error:"",
project_name:'',
project_name_error:"",
child_company_error:"",
child_company:'',
child_company:{},



company_data:{},
project_data:{},
};
},
components: {
MaskedInput,
},
methods: {


  delay() {
                this.disabled = true
                this.timeout = setTimeout(() => {
                    this.disabled = false
                }, 5000)
                this.submit_configuration()
            },
submit_configuration() {
if(this.individual)
if (
this.customer_inv == "" ||
this.customer_credit == "" ||
this.customer_pre == "" ||
this.customer_voucher == "" ||
this.quotation == "" ||
this.vendor_debit == "" ||
this.vendor_inv == "" ||
this.vendor_pre == "" ||
this.vendor_voucher == "" ||
this.requistion == "" ||
this.journal_voucher == ""
) {
this.$toastr.e("Please fill required fields!", "Caution!");
if (this.customer_inv.length < 3) {
this.customer_inv_error = "maximum 3 chracters required";
}
if (this.customer_credit.length < 3) {
this.customer_credit_error = "maximum 3 chracters required";
}
if (this.customer_pre.length < 4) {
this.customer_pre_error = "maximum 4 chracters required";
}
if (this.customer_voucher.length < 3) {
this.customer_voucher_error = "maximum 3 chracters required";
}
if (this.quotation.length < 4) {
this.quotation_error = "maximum 4 chracters required";
}
if (this.vendor_debit.length < 3) {
this.vendor_debit_error = "maximum 3 chracters required";
}
if (this.vendor_inv.length < 3) {
this.vendor_inv_error = "maximum 3 chracters required";
}
if (this.vendor_pre.length < 4) {
this.vendor_pre_error = "maximum 4 chracters required";
}
if (this.vendor_voucher.length < 3) {
this.vendor_voucher_error = "maximum 3 chracters required";
}
if (this.requistion.length < 3) {
this.requistion_error = "maximum 4 chracters required";
}
if (this.journal_voucher.length < 4) {
this.journal_voucher_error = "maximum 4 chracters required";
}
} else {
axios.post("update_accounts_configuration", {
customer_inv: this.customer_inv,
customer_credit: this.customer_credit,
customer_pre: this.customer_pre,
customer_voucher: this.customer_voucher,
quotation: this.quotation,
vendor_debit: this.vendor_debit,
vendor_inv: this.vendor_inv,
vendor_pre: this.vendor_pre,
vendor_voucher: this.vendor_voucher,
requistion: this.requistion,
journal_voucher: this.journal_voucher,
})
.then((data) => {
alert(data.data);
})
.catch((error) => console.log(error));
}
},

 delay1() {
                this.disabled1 = true
                this.timeout1 = setTimeout(() => {
                    this.disabled1 = false
                }, 5000)
                this.submit_company_record()
            },
delay2() {
                this.disabled2 = true
                this.timeout2 = setTimeout(() => {
                    this.disabled2 = false
                }, 5000)
                this.submit_project_record()
            },
submit_company_record() {
  if (this.company_name == "" || this.company_email == "" || this.company_address == "" || this.phone_no=="") {
        this.$toastr.e("Please fill required fields!", "Caution!");
        if (this.company_name == "") {
          this.company_name_error = "Please enter name";
        }
        if (this.company_address == "") {
          this.company_address_error = "Please enter address";
        }
        if (this.company_email == "") {
          this.company_email_error = "Please enter email";
        }
        if (this.phone_no == "") {
          this.phone_no_error = "Please enter phone number";
        }
      }
},
submit_project_record(){
 if (this.project_name == "" || this.child_company == "" ) {
        this.$toastr.e("Please fill required fields!", "Caution!");
        if (this.project_name == "") {
          this.project_name_error = "Please enter project name";
        }
        if (this.child_company == "") {
          this.child_company_error = "Please select company";
        }
      
      }

},
 getResult2(page = 1) {

                axios.get('accounts/child_detail/?page=' + page)
                    .then(response => this.company_data = response.data)
                    .catch(error => { });
            },
            getResult3(page = 1) {

                axios.get('accounts/project_data/?page=' + page)
                    .then(response => this.project_data = response.data)
                    .catch(error => { });
            },
},

mounted() {
      this.getResult2();
            this.getResult3();
},
}

</script>
