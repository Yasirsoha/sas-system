<template>
    <div>
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
                                <li class="breadcrumb-item">
                                    <router-link to="/payroll/loans" style="text-decoration: none;">Loans & Advances</router-link>
                                </li>

                                <li class="breadcrumb-item active">
                                    Dues
                                </li>
                            </ol>
                        </div>
                    </div>

                    <div class="row" id="basic-table">
                        <div class="col-12">
                            <div class="card">
                                <div class="row" style="margin-top:20px">
                                    <div class="col-md-3 col-12 mb-2 position-relative">
                                        <h5 style="padding-left:10px;padding-top:10px">Session Name: {{this.session_name}}</h5>
                                    </div>
                                    <div class="col-md-4 col-12 mb-2 position-relative">
                                        <input type="text" v-model="keyword1" class="form-control" placeholder="Search By Name or Employee code">
                                    </div>
                                    <div class="col-md-3 col-12 mb-2 position-relative">
                                        <button data-bs-toggle="modal" data-bs-target="#hireinterview" class="btn btn-primary">Apply Dues</button>
                                    </div>

                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>

                                                <th style="font-size:10px !important;">Emp. Code</th>
                                                <th style="font-size:10px !important;">Name</th>
                                                <th style="font-size:10px !important;">Date Of Joining</th>
                                                <th style="font-size:10px !important;">Dues Session</th>
                                                <th style="font-size:10px !important;">Dues Type</th>
                                                <th style="font-size:10px !important;">Amount</th>
                                                <th style="font-size:10px !important;">Description</th>

                                                <th style="font-size:10px !important;">Status</th>

                                                <th style="font-size:10px !important;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="all_sals1 in all_sals.data">

                                                <td style="text-align:center;border-right:1px solid lightgrey">{{all_sals1.EmployeeCode}}</td>
                                                <td style="border-right:1px solid lightgrey">
                                                    <div class="d-flex flex-column">
                                                        <a class="user_name text-truncate text-body"><span class="fw-bolder">{{all_sals1.Name}} </span></a><small class="emp_post text-muted">
                                                            <span v-if="all_sals1.Department!=null">{{all_sals1.Department}} - </span>
                                                            <span v-else></span>
                                                            <span v-if="all_sals1.Designation!=null">{{all_sals1.Designation}}</span>
                                                            <span v-else></span>
                                                        </small>
                                                    </div>
                                                </td>
                                                <td style="text-align:center;border-right:1px solid lightgrey">{{all_sals1.DuesDate}}</td>
                                                <td style="text-align:center;border-right:1px solid lightgrey">{{all_sals1.SessionName}}</td>
                                                <td style="text-align:center;border-right:1px solid lightgrey">{{all_sals1.DuesType}}</td>
                                                <td style="text-align:center;border-right:1px solid lightgrey">{{all_sals1.DuesAmount}}</td>
                                                <td style="border-right:1px solid lightgrey;text-align:center;">{{all_sals1.Descriptions}}</td>

                                                <td style="border-right:1px solid lightgrey;text-align:center;">
                                                    <a v-if="all_sals1.Status=='Pending'" @click="fetch_arrear_id(all_sals1.DuesID)" data-bs-toggle="modal" data-bs-target="#hireinterview1">
                                                        <span class="badge bg-gradient-warning" style="cursor: pointer;">Pending</span>
                                                    </a>
                                                    <a v-else-if="all_sals1.Status=='Approved'">
                                                        <span class="badge bg-gradient-success" style="cursor: pointer;">Approved</span>
                                                    </a>
                                                    <a v-else>
                                                        <span class="badge bg-gradient-info" style="cursor: pointer;">Paid</span>
                                                    </a>



                                                </td>

                                                <td>
                                                    <a v-if="all_sals1.Status=='Pending'" @click="fetch_emp_payroll(all_sals1.DuesID)" data-bs-toggle="modal" data-bs-target="#editpayroll"><i style="color:#d42f2f" class="fa-solid fa-pencil"></i><span></span></a>

                                                    <a v-else><i style="color:#d42f2f" class="fa-solid fa-pencil"></i><span></span></a>


                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div style="text-align:center;padding-top:20px">
                                    <pagination :data="all_sals" @pagination-change-page="getResult"></pagination>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="hireinterview1" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            np
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="fw-bolder">Confirmation</h1>
                                        <h5>Are you want to approve the bonus of selected employee?</h5>
                                        <div class="text-center" style="text-align:center">
                                            <button type="button" :disabled="disabled2" @click="delay2()" class="btn btn-primary waves-effect waves-float waves-light" data-bs-dismiss="modal" aria-label="Close">Yes</button>
                                            <button type="submit" class="btn btn-outline-primary waves-effect" data-bs-dismiss="modal" aria-label="Close">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- modal table -->

                    <div class="modal fade" id="hireinterview" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered modal-edit-user">

                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <h5>Apply Dues to Employee</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                                        <div class="col-12">
                                            <label class="form-label" for="modalAddCardNumber">Session Name</label>
                                            <input v-model="session_name" type="text" readonly id="modalAddCardName" class="form-control" />

                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="modalAddCardName">Dues Type</label>
                                            <select v-model="dues_type" class="form-control">
                                                <option value="">Select Type</option>
                                                <option value="Lunch">Lunch</option>
                                                <option value="Others">Others</option>
                                            </select>

                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="modalAddCardName">Apply Date</label>
                                            <input v-model="emp_date" type="date" class="form-control" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="modalAddCardName">Employee Code</label>
                                            <multiselect style="margin-right: 10px;"
                                                         v-model="emp_emp_id"
                                                         :multiple="true"
                                                         :options="options">
                                            </multiselect>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="modalAddCardName">Amount</label>
                                            <input v-model="emp_amount" type="number" id="modalAddCardName" class="form-control" />
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label" for="modalAddCardName">Description</label>
                                            <input v-model="emp_description" type="text" id="modalAddCardName" class="form-control" />
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" :disabled="disabled1" @click="delay1()" class="btn btn-primary me-1 mt-1" data-bs-dismiss="modal" aria-label="Close">Apply Now</button>
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
            </div>
        </div>
        <div class="modal fade" id="editpayroll" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered modal-edit-user">

                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <h5>Update Arrears of Employee</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                            <div class="col-12">
                                <label class="form-label" for="modalAddCardNumber">Session Name</label>
                                <input v-model="edit_session_name" type="text" readonly id="modalAddCardName" class="form-control" />
                                <input hidden v-model="edit_bonus_id" type="text" readonly id="modalAddCardName" class="form-control" />
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="modalAddCardName">Dues Type</label>
                                <select v-model="edit_dues_type" class="form-control">
                                    <option value="">Select Type</option>
                                    <option value="Lunch">Lunch</option>
                                    <option value="Others">Others</option>
                                </select>

                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="modalAddCardName">Apply Date</label>
                                <input v-model="edit_date" type="date" class="form-control" />
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="modalAddCardName">Employee Code</label>
                                <select v-model="edit_emp_id" class="form-control">
                                    <option value="">Select Employee</option>
                                    <option v-for='find_emp1 in find_emp' :value='find_emp1.EmployeeID'>{{ find_emp1.EmployeeCode }}-{{ find_emp1.Name }}</option>
                                </select>

                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="modalAddCardName">Amount</label>
                                <input v-model="edit_amount" type="number" id="modalAddCardName" class="form-control" />

                            </div>


                            <div class="col-md-12">
                                <label class="form-label" for="modalAddCardName">Description</label>
                                <input v-model="edit_description" type="text" id="modalAddCardName" class="form-control" />

                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" :disabled="disabled" @click="delay()" class="btn btn-primary me-1 mt-1" data-bs-dismiss="modal" aria-label="Close">Update</button>
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
import Multiselect from 'vue-multiselect'
import axios from "axios";
export default {
    data() {
        return {

        options: [],
            all_sals: {},
            find_emp: {},
            emp_emp_id:null,
            emp_amount:'',
            emp_description:'',
            emp_date:'',
            dues_type:'',

            keyword1: '',
            session_name: '',
            bonus_id:'',

            edit_emp_id:'',
            edit_session_name:'',
            edit_amount:'',
            edit_description:'',
            edit_bonus_id:'',
            edit_date:'',
            edit_dues_type:'',

            disabled: false,
            timeout: null,

            disabled1: false,
            timeout1: null,

            disabled2: false,
            timeout2: null,
        }
    },
    watch: {
        keyword1(after, before) {
            this.getResults();
        }
    },
    components: { Multiselect },
    methods: {
        delay() {
            this.disabled = true
            this.timeout = setTimeout(() => {
              this.disabled = false
            }, 5000)
            this.updatearrears()
          },
        delay1() {
            this.disabled1 = true
            this.timeout1 = setTimeout(() => {
              this.disabled1 = false
            }, 5000)
            this.applybonus()
          },
        delay2() {
            this.disabled2 = true
            this.timeout2 = setTimeout(() => {
              this.disabled2 = false
            }, 5000)
            this.update_arrear_payroll()
          },
        updatearrears(){
        axios.post('update_ind_dues', {
            edit_emp_id: this.edit_emp_id,
                edit_session_name: this.edit_session_name,
                edit_amount: this.edit_amount,
                edit_description: this.edit_description,
                edit_arrear_id: this.edit_bonus_id,
                edit_date: this.edit_date,
                edit_dues_type:this.edit_dues_type,
                  })
                        .then(data => {

                                this.$toastr.s("Updated Dues Successfully!", "Congratulations");
                                this.all_sals=data.data;
                            })
        },
        fetch_arrear_id(id){
        this.bonus_id=id;
        },
        update_arrear_payroll(){
         axios.get('./approve_dues/'+this.bonus_id)
                    .then(response => this.all_sals = response.data)
                    .catch(error => console.log(error));
        },
        fetch_emp_payroll(id){
         axios.get('find_payroll_dues/' + id)
                    .then(data => {
                        this.edit_emp_id = data.data[0].EmployeeID;
                        this.edit_session_name = data.data[0].SessionName;
                        this.edit_amount = data.data[0].DuesAmount;
                        this.edit_description = data.data[0].Descriptions;
                        this.edit_date = data.data[0].DuesDate;
                        this.edit_bonus_id=data.data[0].DuesID;
                         this.edit_dues_type=data.data[0].DuesType;
                    })
                    .catch(error => {});
        },
        applybonus(){
            axios.post('submit_dues', {
            emp_emp_id: this.emp_emp_id,
            emp_amount: this.emp_amount,
            emp_description: this.emp_description,
            emp_date: this.emp_date,
            session_name:this.session_name,
            dues_type:this.dues_type,

                    })
                        .then(data => {
                                this.$toastr.s("Submitted Arrears Successfully!", "Congratulations");
                                this.all_sals=data.data;
                        })
        },

        getResults() {
            axios.get('./search_payroll', { params: { keyword1: this.keyword1 } })
                .then(response => this.all_sals = response.data)
                .catch(error => console.log(error));

        },

        getResult(page=1) {

            axios.get('fetch_payroll_dues/')
                .then(response => this.all_sals = response.data)
                .catch(error => {});
        },

    },
    mounted() {
        this.getResult();
        axios.get('find_emp_id')
            .then(data => {
            this.find_emp = data.data
            this.options = [];

var $this = this;
for (var i = 0; i < $this.find_emp.length; i++) {

                  this.options.push($this.find_emp[i].Name+'_'+$this.find_emp[i].EmployeeCode);
            }

            })
            .catch(error => {});




        axios.get('find_session')
            .then(response => {
                this.session_name = response.data;
            })




    },

}

</script>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
