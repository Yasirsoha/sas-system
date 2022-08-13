<template>
<div v-if="user_access.hr_write=='true'">
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
<li class="breadcrumb-item">
<router-link to="/hr/warning_detail" style="text-decoration: none;">Warning Details</router-link>
</li>
<li class="breadcrumb-item active">View
</li>
</ol>
</div>
</div>
<div class="content-body" v-for='warning_detail1 in warning_detail'>

<section class="invoice-preview-wrapper">
<div class="row invoice-preview">
<!-- Invoice -->
<div class="col-xl-9 col-md-8 col-12">
<div class="card invoice-preview-card">
<div class="card-body invoice-padding pb-0">
    <!-- Header starts -->
    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
      <div v-for='companydetail1 in companydetail' style="margin-left:30px">
                <div style="padding-top:10px" class="logo-wrapper">
                    <h3 class="text-primary invoice-logo">{{companydetail1.company_name}}</h3>
                </div>
                  <p class="card-text mb-25">Address: {{companydetail1.company_address}} , </p> <p class="card-text mb-25">City: {{companydetail1.city}} - {{companydetail1.country}}</p>
                <p class="card-text mb-0">Phone: {{companydetail1.phone_number}}</p>
            </div>
        <div class="mt-md-0 mt-2" style="padding-right:20px;padding-top:20px">
            <h4 class="invoice-title">
                Id#{{warning_detail1.LetterID}}
            </h4>
            <div class="invoice-date-wrapper">
                <p style="margin-bottom:5px !important" class="invoice-date-title">Date Issued:{{warning_detail1.DateIssued}}</p>
                
            </div>
            <div class="">
                <p style="margin-bottom:5px !important" class="invoice-date-title">Warning Type:<span style="color:red">{{warning_detail1.WarningType}}</span></p>
               
            </div>
        </div>
    </div>
    <!-- Header ends -->
</div>

<hr class="invoice-spacing" />
<div class="card-body invoice-padding pt-0" style="margin-left:5%;margin-right:5%;">
    <div class="row invoice-spacing">
        <div class="col-xl-8 p-0">
         <h6 class="mb-2">Employee Id:{{warning_detail1.EmployeeID}}</h6>
            <h6 class="mb-2">Name:{{warning_detail1.EmployeeName}}</h6>
            <h6 class="mb-25">Department: {{warning_detail1.Department}}</h6>
            <h6 class="card-text mb-25">Designation: {{warning_detail1.Designation}}</h6>
             <h6 class="card-text mb-25">Location:{{warning_detail1.Location}}</h6>
           
        </div>
        
    </div>
</div>
<!-- Address and Contact starts -->
<div style="margin-left:5%;margin-right:5%;" class="card-body  pt-0">
    <div class="row invoice-spacing">
     <h6 class="card-text mb-25" style="padding-left:0px;font-weight:bold">Subject:{{warning_detail1.ReasonSubject}}</h6>
     <br>
      <h6 class="card-text mb-25" style="padding-left:0px">Dear FirstName</h6>
      <br>
      <p style="padding-left:0px">
      This letter serves a written warning to you for not meeting your objectives as outlined in your Appointment Letter / Job Description / Prior performance appraisal / Goals as agreed between you and your supervisor.
      </p>
      <p  style="padding-left:0px">
      As intimated by <the management / your supervisor>, we are putting you on a Corrective Action Plan commencing from < mention date>. This plan is being introduced to bring your performance up to an acceptable standard, considering your capabilities and requirements of your job role.
      </p>
       <p style="padding-left:0px">
     Each member in our company is expected to contribute to the best of their abilities and meet the objectives laid out in their job role. Hence, we would like you to immediately improve your performance and meet expectations of your supervisor and company management.
      </p>
      <p style="padding-left:0px">
     Each member in our company is expected to contribute to the best of their abilities and meet the objectives laid out in their job role. Hence, we would like you to immediately improve your performance and meet expectations of your supervisor and company management.
      </p>
      <h6 class="card-text mb-25" style="padding-left:0px">Sincerely,</h6>
      <h6 class="card-text mb-25" style="padding-left:0px">HR Department</h6>
       <h6 v-for='companydetail1 in companydetail' class="card-text mb-25" style="padding-left:0px">{{companydetail1.company_name}}</h6>



    </div>
</div>
 <div class="card-body invoice-padding pb-0">
    <div class="row invoice-sales-total-wrapper">
       
       
    </div>
</div>

<hr class="invoice-spacing" />

</div>
</div>
<!-- /Invoice -->

<!-- Invoice Actions -->
<div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
<div class="card">
<div class="card-body">
    
    <button class="btn btn-primary w-100 btn-download-invoice mb-75">Pdf Download</button>
    
   
</div>
</div>
</div>
<!-- /Invoice Actions -->
</div>
</section>

</div>
</div>
</div>
</div>
</template>
<script>
export default {
data(){
    return {
    user_access:{},
    companydetail:{ },
   warning_detail: {},
    id: this.$route.params.id,
    }
},
mounted() {
axios.get('getwarnig_d/' + this.$route.params.id)
            .then(data => {
                this.warning_detail = data.data;
            })
axios.get('fetch_companydetail')
.then(response => this.companydetail = response.data)
axios.get('./fetch_user_hr_roles')
.then(response => this.user_access = response.data)
}
}

</script>
