<template>
   
    <!-- BEGIN: Main Menu-->
    <div  class="main-menu menu-fixed menu-accordion menu-shadow" v-bind:class="[(toggle=='dark-theme-toggle')? 'menu-dark' : 'menu-light']" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto">
                <router-link class="navbar-brand" to="/"><span class="brand-logo">
                    <img v-bind:src="`public/images/${session_detail.company_logo}`" class="me-75" height="40" width="40" /> 
                            </span>
                        <h2 class="brand-text" style="padding-left:5px; font-size: 18px;width: 130px;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;">{{session_detail.company_name}}</h2>
                    </router-link></li>
                <li class="nav-item nav-toggle"><a style="margin-top: 35px;" class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
         <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

                <li class=" nav-item" ><a class="d-flex align-items-center" ><i class="fa-solid fa-house-user"></i><span class="menu-title text-truncate"  style="padding-top: 10px;">Dashboards</span><span class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>
                    <ul class="menu-content">
                      <li @click="activate(1)" :class="{ active : active_el == 1 }" v-if="session_detail.hr_read=='true'&&session_detail.company_hr_status=='true'">
                            <router-link to="/recruitment/recDashboard" class="d-flex align-items-center">
                                <i data-feather="circle"></i>
                                <span class="menu-item text-truncate" data-i18n="Analytics">Rec. Dashboards</span>
                            </router-link>
                        </li>
                        <li @click="activate(2)" :class="{ active : active_el == 2 }" v-if="session_detail.hr_read=='true'&&session_detail.company_hr_status=='true'"">
                        <router-link to="/hr/dashboard" class="d-flex align-items-center" ><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" data-i18n="Analytics">HR Dashboard</span></router-link>
                        </li>
                        <li @click="activate(3)" :class="{ active : active_el == 3 }" v-if="session_detail.payroll_read=='true'&&session_detail.company_payroll_plan=='true'">
                        <router-link to="/" class="d-flex align-items-center" ><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Payroll Dashboard</span></router-link>
                        </li>
                        <li @click="activate(4)" :class="{ active : active_el == 4 }" v-if="session_detail.accounts_read=='true'">
                        <router-link to="/" class="d-flex align-items-center" ><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Accounts Dashboard</span></router-link>
                        </li>
                       
                    </ul>
                </li>
                <li v-if="session_detail.hr_write=='true'&&session_detail.company_hr_status=='true'" class=" navigation-header"><span>Human Resource Module</span><i data-feather="more-horizontal"></i>
                </li>
                <li  class=" nav-item" v-if="session_detail.hr_write=='true'&&session_detail.company_hr_status=='true'">
                    <a class="d-flex align-items-center" >
                   <i class="fa-solid fa-user"></i>
                        <span class="menu-title text-truncate" >Recruitment</span>
                    </a>
                    <ul class="menu-content">
                        <li @click="activate(6)" :class="{ active : active_el == 6 }">
                            <router-link class="d-flex align-items-center" to="/recruitment/jobs">
                                <i class="fa-regular fa-circle"></i>
                                <span class="menu-item text-truncate" >Job openings</span>
                            </router-link></li>
                            <li @click="activate(7)" :class="{ active : active_el == 7 }">
                            <router-link class="d-flex align-items-center" to="/recruitment/candidates">
                               <i class="fa-regular fa-circle"></i>
                                <span class="menu-item text-truncate" >Candidates</span>
                            </router-link></li>
                             <li @click="activate(8)" :class="{ active : active_el ==8 }">
                            <router-link class="d-flex align-items-center" to="/recruitment/interviews">
                               <i class="fa-regular fa-circle"></i>
                                <span class="menu-item text-truncate">Interviews</span>
                            </router-link></li>
                          
                      
                    </ul>
                </li>
                <li v-if="session_detail.hr_write=='true'&&session_detail.company_hr_status=='true'"  class=" nav-item"><a class="d-flex align-items-center" ><i class="fa-solid fa-file"></i><span class="menu-title text-truncate">HRMS</span></a>
                    <ul class="menu-content">
                        <li @click="activate(5)" :class="{ active : active_el ==5 }"><router-link class="d-flex align-items-center" to="/hr/employees_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" data-i18n="List">Employees Detail</span></router-link>
                        </li>
                        <li @click="activate(9)" :class="{ active : active_el ==9 }"><router-link to="/hr/warning_detail" class="d-flex align-items-center" ><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate">Warning Detail</span></router-link>
                        </li>
                        <li @click="activate(10)" :class="{ active : active_el ==10 }"><router-link to="/hr/leaves_dashbaord" class="d-flex align-items-center" ><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate">Leaves Detail</span></router-link>
                        </li>
                        <li @click="activate(11)" :class="{ active : active_el ==11 }"><router-link to="/hr/attendance/dashboard" class="d-flex align-items-center" ><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Attendance</span></router-link>
                        </li>
                        <li @click="activate(12)" :class="{ active : active_el ==12 }"><router-link to="/hr/reports" class="d-flex align-items-center" ><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate">Reports</span></router-link>
                        </li>
                        <li @click="activate(13)" :class="{ active : active_el ==13 }" v-if="session_detail.hr_superadmin=='true'"><router-link to="/hr/configuration" class="d-flex align-items-center" ><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate">HR Controller</span></router-link>
                        </li>
                    </ul>
                </li>
               <li v-if="session_detail.payroll_write=='true'&&session_detail.company_payroll_plan=='true'" class="nav-item">
                    <a class="d-flex align-items-center">
                        <i class="fa-solid fa-building-columns"></i><span class="menu-title text-truncate" data-i18n="Invoice">PayRoll</span>
                    </a>
                    <ul class="menu-content">
                        <li @click="activate(13)" :class="{ active : active_el ==13 }" >
                            <router-link class="d-flex align-items-center" to="/payroll/salary_generation">
                                <i class="fa-regular fa-circle"></i>
                                <span class="menu-item text-truncate" data-i18n="List">Salaries</span>
                            </router-link>
                        </li>
                        <li @click="activate(14)" :class="{ active : active_el ==14 }" >
                            <router-link class="d-flex align-items-center" to="/payroll/loans">
                                <i class="fa-regular fa-circle"></i>
                                <span class="menu-item text-truncate" data-i18n="List">Loan & Advance</span>
                            </router-link>
                        </li>
                        <li @click="activate(15)" :class="{ active : active_el ==15 }">
                            <router-link class="d-flex align-items-center" to="/payroll/arrears">
                                <i class="fa-regular fa-circle"></i>
                                <span class="menu-item text-truncate">Arrears & Bonuses</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li v-if="session_detail.accounts_write=='true' && session_detail.company_accounts_plan=='true'" class=" navigation-header"><span >Accounts Module</span><i data-feather="more-horizontal"></i>
                </li>
                <li  v-if="session_detail.accounts_write=='true' && session_detail.company_accounts_plan=='true'"  class=" nav-item"><a class="d-flex align-items-center" ><i class="fa-solid fa-file-invoice"></i><span class="menu-title text-truncate" >Sales</span></a>
                    <ul class="menu-content">

                        <li @click="activate(16)" :class="{ active : active_el ==16 }"><router-link  class="d-flex align-items-center" to="/sales/invoice_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Invoices</span></router-link>
                        <li @click="activate(17)" :class="{ active : active_el ==17}"><router-link  class="d-flex align-items-center" to="/sales/credit_notes_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Credit Notes</span></router-link>
                        <li @click="activate(18)" :class="{ active : active_el ==18}"><router-link  class="d-flex align-items-center" to="/sales/received_voucher_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Received Voucher</span></router-link>
                        <li @click="activate(19)" :class="{ active : active_el ==19}"><router-link  class="d-flex align-items-center" to="/products_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Products</span></router-link>
                        <li @click="activate(20)" :class="{ active : active_el ==20}"><router-link  class="d-flex align-items-center" to="/sales/customer_details"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Customers</span></router-link>
                        <li @click="activate(21)" :class="{ active : active_el ==21}"><router-link  class="d-flex align-items-center" to="/sales/quotation_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Quotation</span></router-link>
                        </li>
                    </ul>
                </li>
                <li  v-if="session_detail.accounts_write=='true' && session_detail.company_accounts_plan=='true'"  class=" nav-item"><a class="d-flex align-items-center" ><i class="fa-solid fa-basket-shopping"></i><span class="menu-title text-truncate" >Purchase</span></a>
                    <ul class="menu-content">
                        <li @click="activate(22)" :class="{ active : active_el ==22}"><router-link  class="d-flex align-items-center" to="/purchase/detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Purchase Order</span></router-link>
                        <li @click="activate(23)" :class="{ active : active_el ==23}"><router-link  class="d-flex align-items-center" to="/purchase/debit_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Debit Notes</span></router-link>
                        <li @click="activate(24)" :class="{ active : active_el ==24}"><router-link  class="d-flex align-items-center" to="/purchase/payment_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Payments Voucher</span></router-link>
                        <li @click="activate(25)" :class="{ active : active_el ==25}"><router-link  class="d-flex align-items-center" to="/products_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Products</span></router-link>
                        <li @click="activate(26)" :class="{ active : active_el ==26}"><router-link  class="d-flex align-items-center" to="/purchase/vendor_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Vendors</span></router-link>
                        </li>
                        <li @click="activate(27)" :class="{ active : active_el ==27}"><router-link  class="d-flex align-items-center" to="/purchase/requistion_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Requisition</span></router-link>
                        </li>
                    </ul>
                </li>
                <li  v-if="session_detail.accounts_write=='true' && session_detail.company_accounts_plan=='true'"  class=" nav-item"><a class="d-flex align-items-center" ><i class="fa-solid fa-receipt"></i><span class="menu-title text-truncate" >Accounting</span></a>
                    <ul class="menu-content">
                    
                        <li @click="activate(28)" :class="{ active : active_el ==28}"><router-link  class="d-flex align-items-center" to="/accounting/journal_voucher"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Journal Voucher</span></router-link>
                        </li>
                    </ul>
                </li>
                <li  v-if="session_detail.accounts_write=='true' && session_detail.company_accounts_plan=='true'"  class=" nav-item"><a class="d-flex align-items-center" ><i class="fa-solid fa-file"></i><span class="menu-title text-truncate" >Reporting</span></a>
                    <ul class="menu-content">
                    
                        <li @click="activate(29)" :class="{ active : active_el ==29}"><router-link  class="d-flex align-items-center" to="/settings/users"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Currencies</span></router-link>
                        </li>
                    </ul>
                </li>
                
                <li  v-if="session_detail.accounts_write=='true' && session_detail.company_accounts_plan=='true'"  class=" nav-item"><a class="d-flex align-items-center" ><i class="fa-solid fa-gear"></i><span class="menu-title text-truncate" >Configuration</span></a>
                    <ul class="menu-content">
                    
                        <li @click="activate(30)" :class="{ active : active_el ==30}"><router-link  class="d-flex align-items-center" to="/accounts/payment_terms"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Payment Terms</span></router-link>
                        </li>
                        <li @click="activate(31)" :class="{ active : active_el ==31}"><router-link  class="d-flex align-items-center" to="/settings/users"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Banks Detail</span></router-link></li>
                        <li @click="activate(32)" :class="{ active : active_el ==32}"><router-link  class="d-flex align-items-center" to="/accounts/chart_of_accounts"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >COA</span></router-link></li>
                        <li @click="activate(33)" :class="{ active : active_el ==33}"><router-link  class="d-flex align-items-center" to="/accounts/taxes"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Taxes</span></router-link></li>
                        <li @click="activate(34)" :class="{ active : active_el ==34}"><router-link  class="d-flex align-items-center" to="/accounts/heads_types"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Acc. Heads/Types</span></router-link></li>
                        <li @click="activate(35)" :class="{ active : active_el ==35}"><router-link  class="d-flex align-items-center" to="/accounts/currencies"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Currencies</span></router-link></li>
                        <li @click="activate(36)" :class="{ active : active_el ==36}"><router-link  class="d-flex align-items-center" to="/accounts/product_categories"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Product Categories</span></router-link></li>
                        <li @click="activate(37)" :class="{ active : active_el ==37}"><router-link  class="d-flex align-items-center" to="/accounts/sessions"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >Session</span></router-link></li>
                         <li @click="activate(43)" :class="{ active : active_el ==43}"><router-link  class="d-flex align-items-center" to="/accounts/config"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" >General</span></router-link></li>
                    </ul>
                </li>






                 <li v-if="session_detail.hr_superadmin=='true' && session_detail.company_hr_status=='true'" class=" navigation-header"><span data-i18n="">Roles & Permissions</span><i data-feather="more-horizontal"></i>
                </li>
                <li  v-if="session_detail.hr_superadmin=='true' && session_detail.company_hr_status=='true'"  class=" nav-item"><a class="d-flex align-items-center" ><i class="fa-solid fa-gear"></i><span class="menu-title text-truncate" data-i18n="Settings">Settings</span></a>
                    <ul class="menu-content">
                        <li @click="activate(38)" :class="{ active : active_el ==38}"><router-link  class="d-flex align-items-center" to="/settings/users"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" data-i18n="List">Users Detail</span></router-link>
                        </li>
                        <li @click="activate(39)" :class="{ active : active_el ==39}"><router-link  class="d-flex align-items-center" to="/settings/location_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" data-i18n="List">Locations Detail</span></router-link>
                        </li>
                        <li @click="activate(40)" :class="{ active : active_el ==40}"><router-link  class="d-flex align-items-center" to="/settings/designation_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" data-i18n="List">Designation Detail</span></router-link>
                        <li @click="activate(41)" :class="{ active : active_el ==41}"><router-link  class="d-flex align-items-center" to="/settings/department_detail"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" data-i18n="List">Departments Detail</span></router-link>
                        </li>
                        <li @click="activate(42)" :class="{ active : active_el ==42}"><router-link  class="d-flex align-items-center" to="/settings/activity_log"><i class="fa-regular fa-circle"></i><span class="menu-item text-truncate" data-i18n="List">Activity Logs</span></router-link>
                        </li>
                        
                        
                    </ul>
                </li>


             
             </ul>

        </div>
    </div>
    <!-- END: Main Menu-->
</template>

<script>
import { bus } from "../../app";
export default {
    data() {
    return {
      toggle: "theme-toggle",
      active_el: 0,
      session_detail: {},
    };
  },
  mounted() {
    bus.$on("showId", (mode) => {
      console.log("sidebar",mode);
      this.toggle = mode;
    });
    axios
      .get("./session_check")
      .then((response) => (this.session_detail = response.data))
      .catch((error) => console.log(error));
    console.log("Footer");
  },
  
  methods: {
    activate: function (el) {
      this.active_el = el;
    },
  },
};
</script>
<style>
.menu-dark {
  background-color: #283046;
}
</style>