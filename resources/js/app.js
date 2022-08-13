/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue'
import VueRouter from 'vue-router'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
export const bus = new Vue();
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
Vue.use(VueRouter)
import VueToastr from "vue-toastr";
// use plugin
Vue.use(VueToastr);
import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)

import vfr from 'vue_form_repeater';

Vue.use(vfr);
Vue.component('apexchart', VueApexCharts)
Vue.component('pagination', require('laravel-vue-pagination'));

import VueTour from 'vue-tour'
require('vue-tour/dist/vue-tour.css')
Vue.use(VueTour)
import fullCalendar from 'vue-fullcalendar'


// Vue.config.devtools = false
// Vue.config.debug = false
// Vue.config.silent = true




/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

const first=  require('./components/ExampleComponent.vue').default;
const dashboard=  require('./components/main_dashboard.vue').default;
const second=  require('./components/second.vue').default;
const comp_dashboard=require('./components/layout/company_dashboard.vue').default;
Vue.component('footer_bottom', require('./components/footer.vue').default);
Vue.component('navbar', require('./components/layout/navbar.vue').default);
Vue.component('login_page', require('./components/user_folder/login_page.vue').default);
Vue.component('navbar1', require('./components/layout/navbar1.vue').default);
Vue.component('mainmenu1', require('./components/layout/mainmenu1.vue').default);
Vue.component('mainmenu', require('./components/layout/mainmenu.vue').default);
Vue.component('main_dashboard', require('./components/main_dashboard.vue').default);
const create_company=require('./components/layout/create_company.vue').default;
const chat=require('./components/layout/chat.vue').default;
const overall_companies=require('./components/layout/overall_companies.vue').default;
const company_detail=require('./components/layout/company_detail.vue').default;
const company_edit=require('./components/layout/company_edit.vue').default;
//const forget_password=require('./components/user_folder/forget_password.vue').default;
//user-admin side components
const users_page=require('./components/client_admin_side/users_page.vue').default;
const create_user=require('./components/client_admin_side/create_user.vue').default;
const location_detail=require('./components/client_admin_side/location_detail.vue').default;
const designation_detail=require('./components/client_admin_side/designation_detail.vue').default;
const department_detail=require('./components/client_admin_side/department_detail.vue').default;
const activity_log = require('./components/client_admin_side/activity_log.vue').default;
const update_user=require('./components/client_admin_side/update_user.vue').default;
const faq_page = require('./components/user_folder/faq.vue').default;


//HR SIDE

const hr_dashboard=require('./components/hr_folder/hr_dashboard.vue').default;
const account_dash=require('./components/hr_folder/account_dashboard.vue').default;
const hr_employee_detail=require('./components/hr_folder/hr_employee_detail.vue').default;
const employee_detail=require('./components/hr_folder/ind_employee_detail.vue').default;
const employee_leaves=require('./components/hr_folder/ind_employee_leaves.vue').default;
const employee_attendance=require('./components/hr_folder/ind_employee_attendance.vue').default;
const employee_financial=require('./components/hr_folder/ind_employee_financial.vue').default;
const employee_perfomance=require('./components/hr_folder/ind_employee_connection.vue').default;
const create_employee=require('./components/hr_folder/hr_create_employee.vue').default;
const create_employee_education=require('./components/hr_folder/hr_create_emp_education.vue').default;
const create_employee_experience=require('./components/hr_folder/hr_create_emp_experience.vue').default;
const create_employee_employeement=require('./components/hr_folder/hr_create_emp_employment.vue').default;
const edit_employee=require('./components/hr_folder/hr_edit_employee.vue').default;
const update_employee_profile=require('./components/hr_folder/update_employee_profile.vue').default;
const update_education_profile=require('./components/hr_folder/update_education_profile.vue').default;
const create_documents=require('./components/hr_folder/ind_documents.vue').default;

const update_experience_profile=require('./components/hr_folder/update_experience_profile.vue').default;
const warning_detail=require('./components/hr_folder/hr_warning_detail.vue').default;
const warning_view=require('./components/hr_folder/hr_warning_view.vue').default;
const warning_create=require('./components/hr_folder/hr_warning_create.vue').default;
const hr_reports=require('./components/hr_folder/hr_reports.vue').default;
//attendance
const hr_att_rosters=require('./components/hr_folder/hr_att_rosters.vue').default;
const attendance_grace_periods=require('./components/hr_folder/attendance_grace_periods.vue').default;
const hr_attendance_dashboard=require('./components/hr_folder/hr_attendance_dashboard.vue').default;
const hr_attendance_emp=require('./components/hr_folder/hr_emp_att_detail.vue').default;
const hr_emp_overtime=require('./components/hr_folder/hr_emp_att_overtime.vue').default;
const hr_leaves_detail=require('./components/hr_folder/hr_leaves_dashboard.vue').default;

const int_att = require('./components/hr_folder/hr_team_member_att.vue').default; //individual team member attandence
const ind_view_dashboard=require('./components/hr_folder/ind_view_dashboard.vue').default;
const ind_team_attendance=require('./components/hr_folder/ind_team_attendance.vue').default;
const ind_emp_detail=require('./components/hr_folder/ind_emp_detail.vue').default;
const hr_controller=require('./components/hr_folder/hr_controller.vue').default;
const hr_configuration=require('./components/hr_folder/hr_configuration.vue').default;
const employee_all_leaves = require('./components/hr_folder/hr_leaves.vue').default;
const team_leaves = require('./components/hr_folder/hr_leaves_team.vue').default;

//Recruitment components
const recruitment_jobs = require('./components/Hr_Rec/jobs.vue').default;
const recruitment_job_detail = require('./components/Hr_Rec/job_details.vue').default;
const recruitment_candidates = require('./components/Hr_Rec/candidates.vue').default;
const recruitment_interviews = require('./components/Hr_Rec/interviews.vue').default;
const recruitment_dashboard = require('./components/Hr_Rec/rec_dashboard.vue').default;

//Payroll dashboard
const advance_loans = require('./components/payroll_folder/py_loan.vue').default;

const py_salary_generation = require('./components/payroll_folder/py_salary_generation.vue').default;

const payroll_employees_detail= require('./components/payroll_folder/payroll_employees_detail.vue').default;
const payroll_hr_approval= require('./components/payroll_folder/payroll_hr_approval.vue').default;
const payroll_finance_approval= require('./components/payroll_folder/payroll_finance_approval.vue').default;
const payroll_distribution=require('./components/payroll_folder/payroll_distribution.vue').default;
const payroll_arrears=require('./components/payroll_folder/py_arrears.vue').default;
const payroll_bonuses=require('./components/payroll_folder/py_bonuses.vue').default;
const payroll_dues=require('./components/payroll_folder/py_dues.vue').default;
const payroll_allowance=require('./components/payroll_folder/py_allowance.vue').default;
const payroll_cash_distribution=require('./components/payroll_folder/payroll_cash_distribution.vue').default;

//payroll_arrears

const ind_emp_leaves = require('./components/hr_folder/ind_emp_leaves.vue').default;
const ind_emp_attendance = require('./components/hr_folder/ind_emp_attendance.vue').default;
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
 //Accounts
 const config_general=require('./components/accounts/config_general.vue').default;
 const accounts_session=require('./components/accounts/confg_accounts_sessions.vue').default;
 const currencies=require('./components/accounts/confg_currencies.vue').default;
 const product_categories=require('./components/accounts/confg_products_categories.vue').default;
  const acc_heads_types=require('./components/accounts/confg_acc_heads_types.vue').default;
 const confg_taxes=require('./components/accounts/confg_taxes.vue').default;
 const confg_coa=require('./components/accounts/confg_coa.vue').default;
  const confg_payment_terms=require('./components/accounts/payment_terms.vue').default;
  const sales_customer_details=require('./components/accounts/sales_customer_detail.vue').default;
   const products_detail=require('./components/accounts/products_detail.vue').default;
 const sales_invoice=require('./components/accounts/sales_invoice.vue').default;
 const sales_invoice_detail=require('./components/accounts/sales_invoice_detail.vue').default;
 const sales_received_voucher_detail=require('./components/accounts/sales_payment_received_detail.vue').default;
 const sales_received_voucher=require('./components/accounts/sales_received_voucher.vue').default;
 const create_credit_notes=require('./components/accounts/sales_credit_notes.vue').default;
 const credit_notes_detail=require('./components/accounts/sales_credit_notes_detail.vue').default;
 const sales_quotation=require('./components/accounts/sales_quotation.vue').default;
 const sales_quotation_detail=require('./components/accounts/sales_quotation_detail.vue').default;
 const purchase_po_detail=require('./components/accounts/purchase_po_detail.vue').default;
 const purchase_po_create=require('./components/accounts/purchase_po_create.vue').default;
 const requistion_detail=require('./components/accounts/purchase_requistion_detail.vue').default;
 const requistion_create=require('./components/accounts/purchase_requistion.vue').default;
 const purchase_vendor_detail=require('./components/accounts/purchase_vendor_detail.vue').default;
 const purchase_payment_voucher_detail=require('./components/accounts/purchase_payment_detail.vue').default;
 const create_payment_voucher=require('./components/accounts/purchase_payment_voucher.vue').default;
 const create_debit_notes=require('./components/accounts/purchase_debit_notes.vue').default;
 const credit_debit_detail=require('./components/accounts/purchase_debit_note_detail.vue').default;
 const accounting_jv_detail=require('./components/accounts/accounting_jv_detail.vue').default;
 const accounting_jv_create=require('./components/accounts/accounting_jv_create.vue').default;
















 const PathNotFound=require('./components/404.vue').default;


const routes = [
      {
        path: '/sales/create_credit_notes',
        name: 'create_credit_notes',
        component:create_credit_notes,
    },
    {
        path: '/sales/credit_notes_detail',
        name: 'credit_notes_detail',
        component:credit_notes_detail,
    }, 
        {
        path: '/sales/create_received_voucher',
        name: 'sales_received_voucher',
        component:sales_received_voucher,
    },
    {
        path: '/sales/received_voucher_detail',
        name: 'sales_received_voucher_detail',
        component:sales_received_voucher_detail,
    }, 
    {
        path: '/sales/invoice_detail',
        name: 'sales_invoice_detail',
        component:sales_invoice_detail,
    },
     {
        path: '/sales/invoice',
        name: 'sales_invoice',
        component:sales_invoice,
    }, 
    {
        path: '/sales/customer_details',
        name: 'sales_customer_details',
        component:sales_customer_details,
    }, 
     {
        path: '/products_detail',
        name: 'products_detail',
        component:products_detail,
    },

     {
        path: '/accounts/sessions',
        name: 'accounts_session',
        component:accounts_session,
    },   
    {
        path: '/accounts/currencies',
        name: 'currencies',
        component:currencies,
    },   
    {
        path: '/accounts/product_categories',
        name: 'product_categories',
        component:product_categories,
    },
    {
        path: '/accounts/heads_types',
        name: 'acc_heads_types',
        component:acc_heads_types,
    },
    {
        path: '/accounts/taxes',
        name: 'confg_taxes',
        component:confg_taxes,
    },
     {
        path: '/accounts/chart_of_accounts',
        name: 'confg_coa',
        component:confg_coa,
    },
    {
         path: '/accounts/payment_terms',
        name: 'confg_payment_terms',
        component:confg_payment_terms,
    },{
        path: '/accounting/journal_voucher',
        name: 'accounting_jv_detail',
        component:accounting_jv_detail,
    },
    {
        path: '/accounting/create_journal_voucher',
        name: 'accounting_jv_create',
        component:accounting_jv_create,
    },
    {
        path: '/purchase/create_debit_notes',
        name: 'create_debit_notes',
        component:create_debit_notes,
    },
    {
        path: '/purchase/debit_detail',
        name: 'credit_debit_detail',
        component:credit_debit_detail,
    },
    {
        path: '/purchase/create_payment_voucher',
        name: 'create_payment_voucher',
        component:create_payment_voucher,
    },
    {
        path: '/purchase/payment_detail',
        name: 'purchase_payment_voucher_detail',
        component:purchase_payment_voucher_detail,
    },
 {
        path: '/purchase/vendor_detail',
        name: 'purchase_vendor_detail',
        component:purchase_vendor_detail,
    },
     {
        path: '/purchase/requistion_detail',
        name: 'requistion_detail',
        component:requistion_detail,
    },
    {
          path: '/purchase/requistion_create',
        name: 'requistion_create',
        component:requistion_create,
    },
    {
        path: '/purchase/detail',
        name: 'purchase_po_detail',
        component:purchase_po_detail,
    },
    {
          path: '/purchase/create',
        name: 'purchase_po_create',
        component:purchase_po_create,
    },
    {
        path: '/sales/quotation',
        name: 'sales_quotation',
        component:sales_quotation,
    },
    {
          path: '/sales/quotation_detail',
        name: 'sales_quotation_detail',
        component:sales_quotation_detail,
    },
     
  
    {
         path: '/accounts/config',
        name: 'config_general',
        component:config_general,
    },


//HRMS & PAYROLL
{
        path: '/first',
        name: 'first',
        component:first,
    },
{
    path:'/FAQs',
    name:'faq_page',
    component: faq_page,
},

    {
        path: '/payroll/employees_detail',
        name: 'payroll_employees_detail',
        component: payroll_employees_detail,
    },
    {
        path: '/payroll/salary_generation',
        name: 'py_salary_generation',
        component: py_salary_generation,
    },
     {
        path: '/payroll/payroll_hr_approval',
        name: 'payroll_hr_approval',
        component: payroll_hr_approval,
    },
   {
        path: '/payroll/payroll_finance_approval',
        name: 'payroll_finance_approval',
        component: payroll_finance_approval,
    },
    {
        path: '/payroll/distribution',
        name: 'payroll_distribution',
        component: payroll_distribution,
    },
   
   {
        path: '/payroll/loans',
        name: 'payroll_loans',
        component: advance_loans,
    },
    {
        path: '/payroll/arrears',
        name: 'payroll_arrears',
        component: payroll_arrears,
    },
    {
        path: '/payroll/bonuses',
        name: 'payroll_bonuses',
        component: payroll_bonuses,
    },
    {
        path: '/payroll/dues',
        name: 'payroll_dues',
        component: payroll_dues,
    },
    {
        path: '/payroll/allowance',
        name: 'payroll_allowance',
        component: payroll_allowance,
    },
    
    
{
        path: '/hr/member_att/:id',
        name: 'int_att',
        component: int_att,
    },
{
        path: '/hr/team_leaves',
        name: 'team_leaves',
        component: team_leaves,
    },
{
    path:'/hr/leaves_dashbaord',
     name:'hr_leaves_detail',
    component:hr_leaves_detail,
},
{
    path:'/hr/attendance_rosters',
     name:'hr_att_rosters',
    component:hr_att_rosters,
},
{
    path:'/hr/emp_leaves',
    name:'ind_emp_leaves',
    component: ind_emp_leaves,
},
{
    path:'/hr/emp_attendance',
    name:'ind_emp_attendance',
    component: ind_emp_attendance,
},
{
    path:'/hr/attendance_grace_periods',
     name:'attendance_grace_periods',
    component:attendance_grace_periods,
},

{
    path:'/hr/update_employee_profile/:id',
     name:'update_employee_profile',
    component:update_employee_profile,
},
{
    path:'/hr/hr_controller',
     name:'hr_controller',
    component:hr_controller,
},
{
    path:'/hr/configuration',
     name:'hr_configuration',
    component:hr_configuration,
},
{
        path: '/hr/employee_all_leaves',
        name: 'employee_all_leaves',
        component: employee_all_leaves,
    },
{
    path:'/hr/emp_detail',
     name:'ind_emp_detail',
    component:ind_emp_detail,
},
{
    path:'/hr/team_attendance',
     name:'ind_team_attendance',
    component:ind_team_attendance,
},
// {
//     path:'/',
//      name:'ind_view_dashboard',
//     component:ind_view_dashboard,
// },
{
    path:'/hr/employee_dashboard',
     name:'ind_view_dashboard',
    component:ind_view_dashboard,
},
{
    path:'/hr/attendance_emp',
     name:'hr_attendance_emp',
    component:hr_attendance_emp,
},
{
    path:'/hr/employee_overtime',
     name:'hr_emp_overtime',
    component:hr_emp_overtime,
},
{
    path:'/hr/attendance/dashboard',
     name:'hr_attendance_dashboard',
    component:hr_attendance_dashboard,
},
{
    path:'/hr/reports',
     name:'hr_reports',
    component:hr_reports,
},
{
    path:'/hr/warning_detail',
     name:'warning_detail',
    component:warning_detail,
},
{
    path:'/hr/create_warning',
     name:'warning_create',
    component:warning_create,
},
{
    path:'/hr/warning_view/:id',
     name:'warning_view',
    component:warning_view,
},
{
    path:'/hr/employee_perfomance',
     name:'employee_perfomance',
    component:employee_perfomance,
},

{
    path:'/hr/create_employee',
     name:'create_employee',
    component:create_employee,
},
{
    path:'/hr/edit_employee',
     name:'edit_employee',
    component:edit_employee,
},
{
    path:'/hr/employee_education/:id',
     name:'create_employee_education',
    component:create_employee_education,
},
{
    path:'/hr/update_education_profile/:id',
     name:'update_education_profile',
    component:update_education_profile,
},
{
    path:'/hr/update_experience_profile/:id',
     name:'update_experience_profile',
    component:update_experience_profile,
},
{
    path:'/hr/add_documents/:id',
     name:'create_documents',
    component:create_documents,
},

{
    path:'/hr/employee_experience/:id',
     name:'create_employee_experience',
    component:create_employee_experience,
},
{
    path:'/hr/employee_employeement/:id',
     name:'create_employee_employeement',
    component:create_employee_employeement,
},
{
    path:'/hr/employee_detail/:id',
     name:'employee_detail',
    component:employee_detail,
},
{
    path:'/hr/employee_attendance/:id',
     name:'employee_attendance',
    component:employee_attendance,
},
{
    path:'/hr/employee_financial',
     name:'employee_financial',
    component:employee_financial,
},
{
    path:'/hr/employee_leaves/:id',
     name:'employee_leaves',
    component:employee_leaves,
},
{
    path:'/hr/employees_detail',
     name:'hr_employee_detail',
    component:hr_employee_detail,
},
{
    path:'/hr/dashboard',
     name:'hr_dashboard',
    component:hr_dashboard,
},
{
    path:'/hr/account_dash',
     name:'account_dash',
    component:account_dash,
},
{
    path:'/settings/users',
     name:'users_page',
    component:users_page,
},
{
        path: '/settings/activity_log',
        name: 'activity_log',
        component: activity_log,
    },
{
    path:'/settings/location_detail',
     name:'location_detail',
    component:location_detail,
},
{
    path:'/settings/designation_detail',
     name:'designation_detail',
    component:designation_detail,
},
{
    path:'/settings/department_detail',
     name:'department_detail',
    component:department_detail,
},

{
    path:'/settings/create_user',
     name:'create_user',
    component:create_user,
},
{
    path:'/settings/update_user/:id',
     name:'update_user',
    component:update_user,
},
// {
//     path:'/',
//      name:'dashboard',
//     component:dashboard,
// },
{
    path:'/chat',
     name:'chat',
    component:chat,
},
{
    path:'/create_company',
     name:'create_company',
    component:create_company,
},
{
    path:'/overall_companies',
     name:'overall_companies',
    component:overall_companies,
},
{
    path:'/company_detail/:id',
     name:'company_detail',
    component:company_detail,
},
{
    path:'/company_edit/:id',
     name:'company_edit',
    component:company_edit,
},


 
    {
    path:'/company_dashboard',
    name:'comp_dashboard',
    component: comp_dashboard,
    },
 {
        path: '/recruitment/recDashboard',
        name: 'recruitment_dashboard',
        component: recruitment_dashboard,
    },
    {
        path: '/recruitment/interviews',
        name: 'recruitment_interviews',
        component: recruitment_interviews,
    },
    {
        path: '/recruitment/candidates',
        name: 'recruitment_candidates',
        component: recruitment_candidates,
    },
    {
        path: '/recruitment/job/detail/:id',
        name: 'recruitment_job_detail',
        component: recruitment_job_detail,
    },
    {
        path: '/recruitment/jobs',
        name: 'recruitment_jobs',
        component:recruitment_jobs,
    },
      { 
            path: '/:pathMatch(.*)*',
         component: PathNotFound
          },

];
const router= new VueRouter({
    routes
})
const app = new Vue({
    el: '#app',
    router,
});
