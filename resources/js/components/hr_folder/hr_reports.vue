<template>
  <div>
    <!-- <loader
      v-if="spinner"
      object="#ff9633"
      color1="#ffffff"
      color2="#17fd3d"
      size="5"
      speed="2"
      bg="#343a40"
      objectbg="#999793"
      opacity="80"
      name="circular"
    ></loader> -->
    <div class="app-content content" v-if="user_access.hr_write == 'true'">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <router-link to="/hr/dashboard" style="text-decoration: none"
                  >Dashboard</router-link
                >
              </li>
              <li class="breadcrumb-item active">Reports</li>
            </ol>
          </div>
        </div>
        <div class="content-body">
          <div class="card">
            <br />
            <br />
            <br />
            <div
              class="row"
              style="
                margin-left: 5%;
                margin-right: 5%;
                margin-top: 20px;
                margin-bottom: 20px;
              "
            >
              <div class="col-md-4">
                <h6
                  class="mb-25"
                  style="
                    font-weight: bold;
                    padding-left: 0px;
                    padding-top: 10px;
                  "
                >
                  <i
                    class="fa-solid fa-address-card"
                    style="padding-right: 10px"
                  ></i>
                  Employee Overview Reports
                </h6>
                <div class="ng-star-inserted">
                  <a data-bs-toggle="modal" data-bs-target="#modalToggle"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Employee Detail</span></a
                  >
                  <a data-bs-toggle="modal" data-bs-target="#employeehire1"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Employee Hire</span></a
                  >
                  <a data-bs-toggle="modal" data-bs-target="#employeeappraisal"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span>Employee Appraisals</span></a
                  >
                </div>
              </div>
              <div class="col-md-4">
                <h6
                  class="mb-25"
                  style="
                    font-weight: bold;
                    padding-left: 0px;
                    padding-top: 10px;
                  "
                >
                  <i
                    class="fa-solid fa-address-card"
                    style="padding-right: 10px"
                  ></i>
                  Employee Attendance Reports
                </h6>
                <div class="ng-star-inserted">
                  <a data-bs-toggle="modal" data-bs-target="#att_detail"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Overall Attendance Detail</span></a
                  >

                  <a data-bs-toggle="modal" data-bs-target="#ind_att_report"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span>Session Wise Individual</span></a
                  >

                  <a
                    data-bs-toggle="modal"
                    data-bs-target="#att_summary"
                    style="max-width: 300px"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span>Session Wise Summary</span></a
                  >
                  <a
                    data-bs-toggle="modal"
                    data-bs-target="#att_payroll"
                    style="max-width: 300px"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span>Session Wise Payrol Att.</span></a
                  >
                </div>
              </div>
              <div class="col-md-4">
                <h6
                  class="mb-25"
                  style="
                    font-weight: bold;
                    padding-left: 0px;
                    padding-top: 10px;
                  "
                >
                  <i
                    class="fa-solid fa-address-card"
                    style="padding-right: 10px"
                  ></i>
                  Employee Leave Reports
                </h6>
                <div class="ng-star-inserted">
                  <a data-bs-toggle="modal" data-bs-target="#absent_summary"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Absent Summary</span></a
                  >
                  <a data-bs-toggle="modal" data-bs-target="#leave_detail"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span>Employees Leaves Detail</span></a
                  >
                  <a data-bs-toggle="modal" data-bs-target="#leave_summary"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span>Leave Balance Summary</span></a
                  >
                </div>
              </div>
              <div class="col-md-4" style="margin-top: 30px">
                <h6
                  class="mb-25"
                  style="
                    font-weight: bold;
                    padding-left: 0px;
                    padding-top: 10px;
                  "
                >
                  <i
                    class="fa-solid fa-address-card"
                    style="padding-right: 10px"
                  ></i>
                  Recruitment Reports
                </h6>
                <div class="ng-star-inserted">
                  <a
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Today's Candidate</span></a
                  >
                  <a
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Candidate By Status</span></a
                  >
                  <a
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Interview vs User</span></a
                  >
                  <a
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Published Job Openings</span></a
                  >
                  <a style="max-width: 300px"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> JobOpenings vs Candidates</span></a
                  >
                </div>
              </div>
              <div class="col-md-4" style="margin-top: 30px">
                <h6
                  class="mb-25"
                  style="
                    font-weight: bold;
                    padding-left: 0px;
                    padding-top: 10px;
                  "
                >
                  <i
                    class="fa-solid fa-address-card"
                    style="padding-right: 10px"
                  ></i>
                  Other Reports
                </h6>
                <div class="ng-star-inserted">
                  <a
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Company Docs Expiry Detail</span></a
                  >
                  <a
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Employee Docs Expiry Detail</span></a
                  >
                </div>
                <h6
                  class="mb-25"
                  style="
                    font-weight: bold;
                    padding-left: 0px;
                    padding-top: 10px;
                  "
                >
                  <i
                    class="fa-solid fa-address-card"
                    style="padding-right: 10px"
                  ></i>
                  Employee Performance Reports
                </h6>
                <div class="ng-star-inserted">
                  <a
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Goals</span></a
                  >
                  <a
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Appraisals</span></a
                  >
                </div>
              </div>
              <div class="col-md-4" style="margin-top: 30px">
                <h6
                  class="mb-25"
                  style="
                    font-weight: bold;
                    padding-left: 0px;
                    padding-top: 10px;
                  "
                >
                  <i
                    class="fa-solid fa-address-card"
                    style="padding-right: 10px"
                  ></i>
                  Employee Payroll Reports
                </h6>
                <div class="ng-star-inserted">
                  <a
                    data-bs-toggle="modal"
                    data-bs-target="#EmployeeReportToggle"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Individual wise Payroll Report</span></a
                  >
                  <a
                    data-bs-toggle="modal"
                    data-bs-target="#SessionPayrollToggle"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Session wise Payroll Report</span></a
                  >

                  <a data-bs-toggle="modal" data-bs-target="#LoanReportToggle"
                    ><i
                      class="fa-solid fa-star"
                      style="font-size: 16px !important; padding-right: 20px"
                    ></i
                    ><span> Loan Report</span></a
                  >
                </div>
              </div>
            </div>
            <br />
            <br />
            <br />
          </div>
        </div>
      </div>

      <!-- session wise payroll report -->
      <div
        class="modal fade"
        id="SessionPayrollToggle"
        aria-labelledby="SessionPayrollToggle"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div
          v-if="session_payroll_report == ''"
          class="modal-dialog modal-dialog-centered"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">
                Session Wise Employee Report
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Work Location</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Department</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Designation</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Code</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="session_summary()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 80%">
                <span style="width: 80%">Session wise Employee Report</span>
              </h4>
              <span>Session Name: {{ this.session_name }}</span>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="session_summary1()"
              ></button>
            </div>

            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="1400"
              filename="Sessionwise_Employee_Attendance"
              :pdf-quality="2"
              :manual-pagination="false"
              pdf-format="a4"
              pdf-orientation="landscape"
              pdf-content-width="1100px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="sessionpayroll"
            >
              <table style="width: 100%" slot="pdf-content">
                <thead class="grid-header">
                  <tr class="mat-header-row">
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th
                      v-for="attandance_header1 in aatestArray"
                      :key="attandance_header1"
                    >
                      {{ attandance_header1.EmpDetID.substring(8, 10) }}
                    </th>
                  </tr>
                </thead>
                <tr
                  v-for="attandance_header1 in aatestArray"
                  :key="attandance_header1"
                >
                  <td>{{ attandance_header1.Name }}</td>
                  <td>{{ attandance_header1.Designation }}</td>
                  <td>{{ attandance_header1.Department }}</td>
                </tr>
              </table>
            </vue-html2pdf>
            <div class="modal-body">
              <table style="width: 100%" id="Employees_Session_Summary">
                <thead class="grid-header">
                  <tr class="mat-header-row">
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th v-for="attandance_header1 in attandance_header">
                      {{ attandance_header1.DT.substring(8, 10) }}
                    </th>
                  </tr>
                </thead>
                <tr
                  v-for="attandance_header1 in aatestArray"
                  :key="attandance_header1"
                >
                  <td>{{ attandance_header1.Name }}</td>
                  <td>{{ attandance_header1.Designation }}</td>
                  <td>{{ attandance_header1.Department }}</td>
                </tr>
              </table>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                @click="
                  html_table_to_excel('xlsx', 'Employees_Session_Summary')
                "
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                @click="generateSessionPayrollReport()"
                class="btn btn-gradient-info"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="session_summary1()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal 1-->
      <div
        class="modal fade"
        id="EmployeeReportToggle"
        aria-labelledby="EmployeeReportToggle"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div
          v-if="ind_employee_report == ''"
          class="modal-dialog modal-dialog-centered"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">
                Individual wise Payroll Report
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-12">
                    <label class="form-label" for="modalAddCardName"
                      >Person Code</label
                    >
                    <select v-model="ind_payroll_report" class="form-control">
                      <option value="">Select Employee</option>
                      <option
                        v-for="find_emp1 in find_emp"
                        :value="find_emp1.EmployeeID"
                      >
                        {{ find_emp1.EmployeeCode }}-{{ find_emp1.Name }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="ind_payroll_handler()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 60%">
                <span style="width: 60%">Individual wise Payroll Report </span>
              </h4>
              <span>Session Name: {{ this.session_name }} </span>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="ind_payroll_re2()"
              ></button>
            </div>

            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="1400"
              filename="ind_payroll_report"
              :pdf-quality="2"
              :manual-pagination="false"
              pdf-format="a4"
              pdf-orientation="portrait"
              pdf-content-width="800px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="indpayroll"
            >
              <div slot="pdf-content">
                <div class="modal-header d-flex justify-content-between">
                  <h4 class="modal-title" style="width: 60%">
                    <span style="width: 60%">
                      Individual wise Payroll Report
                    </span>
                  </h4>
                </div>
                <div class="modal-body">
                  <div class="table-responsive">
                    <table class="" style="width: 100%" id="">
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Employee Code: </strong>
                        </td>
                        <td style="width: 30%; font-size: bold">
                          <strong>Department: </strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Name: </strong>
                        </td>
                        <td style="width: 30%; font-size: bold">
                          <strong>Destignation:</strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Posting City: </strong>
                        </td>
                        <td style="width: 30%; font-size: bold">
                          <strong>Mobile: </strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Cnic: </strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Address: </strong>
                        </td>
                      </tr>
                    </table>
                  </div>

                  <div class="table-responsive">
                    <table class="table ind_payroll_report">
                      <thead style="">
                        <tr>
                          <th scope="col">Dues Amount</th>
                          <th scope="col">Salary</th>
                          <th scope="col">Name</th>
                          <th scope="col">Employee Code</th>
                        </tr>
                      </thead>
                      <tbody>
                        <td>Yasir Sohail</td>
                        <td>xxxxxxxxxxxxx32</td>
                        <td>xxxxx-xxxxxx8-7</td>
                        <td>30,000 RS</td>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </vue-html2pdf>
            <div class="modal-body" id="ind_payroll_report">
              <div class="table-responsive">
                <table class="" style="width: 100%" id="">
                  <tr>
                    <td style="width: 70%; font-size: bold">
                      <strong>Employee Code: </strong>
                    </td>
                    <td style="width: 30%; font-size: bold">
                      <strong>Department: </strong>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 70%; font-size: bold">
                      <strong>Name: </strong>
                    </td>
                    <td style="width: 30%; font-size: bold">
                      <strong>Destignation:</strong>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 70%; font-size: bold">
                      <strong>Posting City: </strong>
                    </td>
                    <td style="width: 30%; font-size: bold">
                      <strong>Mobile: </strong>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 70%; font-size: bold">
                      <strong>Cnic: </strong>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 70%; font-size: bold">
                      <strong>Address: </strong>
                    </td>
                  </tr>
                </table>
              </div>

              <div class="table-responsive">
                <table class="table ind_payroll_report">
                  <thead style="">
                    <tr>
                      <th scope="col">Dues Amount</th>
                      <th scope="col">Salary</th>
                      <th scope="col">Name</th>
                      <th scope="col">Employee Code</th>
                    </tr>
                  </thead>
                  <tbody>
                    <td>Yasir Sohail</td>
                    <td>xxxxxxxxxxxxx32</td>
                    <td>xxxxx-xxxxxx8-7</td>
                    <td>30,000 RS</td>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                @click="html_table_to_excel('xlsx', 'ind_payroll_report')"
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                @click="generateIndPayrollReport()"
                class="btn btn-gradient-info"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="ind_payroll_re2()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal 1-->
      <div
        class="modal fade"
        id="LoanReportToggle"
        aria-labelledby="LoanReportToggle"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div
          v-if="loan_report == ''"
          class="modal-dialog modal-dialog-centered"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">Loan Report</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-12">
                    <label class="form-label" for="modalAddCardName"
                      >Person Code</label
                    >
                    <select v-model="loan_employee_report" class="form-control">
                      <option value="">Select Person</option>
                      <option
                        v-for="find_emp1 in find_emp"
                        :value="find_emp1.EmployeeID"
                      >
                        {{ find_emp1.EmployeeCode }}-{{ find_emp1.Name }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="loan_report_handler()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 60%">
                <span style="width: 60%">Loan Report </span>
              </h4>
              <span>Session Name: </span>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="ind_loan_re2()"
              ></button>
            </div>

            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="1400"
              filename="loan_employee_report"
              :pdf-quality="2"
              :manual-pagination="false"
              pdf-format="a4"
              pdf-orientation="portrait"
              pdf-content-width="800px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="loan"
            >
              <div slot="pdf-content">
                <div class="modal-header d-flex justify-content-between">
                  <h4 class="modal-title" style="width: 60%">
                    <span style="width: 60%"> Loan Report </span>
                  </h4>
                </div>
                <div class="modal-body">
                  <div class="table-responsive">
                    <table class="" style="width: 100%" id="">
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Person Code: </strong>
                        </td>
                        <td style="width: 30%; font-size: bold">
                          <strong>Passport /Cnic number: </strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Name: </strong>
                        </td>
                        <td style="width: 30%; font-size: bold">
                          <strong>Address:</strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Amount: </strong>
                        </td>
                        <td style="width: 30%; font-size: bold">
                          <strong>Bank Statement: </strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Salary Details: </strong>
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Location: </strong>
                        </td>
                      </tr>
                    </table>
                  </div>

                  <div class="table-responsive">
                    <table class="table loan_employee_report">
                      <thead style="">
                        <tr>
                          <th scope="col">Name</th>
                          <th scope="col">Bank Statement</th>
                          <th scope="col">Cnic</th>
                          <th scope="col">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <td>Yasir Sohail</td>
                        <td>xxxxxxxxxxxxx32</td>
                        <td>xxxxx-xxxxxx8-7</td>
                        <td>30,000 RS</td>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </vue-html2pdf>
            <div class="modal-body" id="loan_employee_report">
              <div class="table-responsive">
                <table class="" style="width: 100%" id="">
                  <tr>
                    <td style="width: 70%; font-size: bold">
                      <strong>Person Code: </strong>
                    </td>
                    <td style="width: 30%; font-size: bold">
                      <strong>Passport /Cnic number: </strong>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 70%; font-size: bold">
                      <strong>Name: </strong>
                    </td>
                    <td style="width: 30%; font-size: bold">
                      <strong>Address:</strong>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 70%; font-size: bold">
                      <strong>Amount: </strong>
                    </td>
                    <td style="width: 30%; font-size: bold">
                      <strong>Bank Statement: </strong>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 70%; font-size: bold">
                      <strong>Salary Details: </strong>
                    </td>
                  </tr>
                  <tr>
                    <td style="width: 70%; font-size: bold">
                      <strong>Location: </strong>
                    </td>
                  </tr>
                </table>
              </div>

              <div class="table-responsive">
                <table class="table loan_employee_report">
                  <thead style="">
                    <tr>
                      <th scope="col">Name</th>
                      <th scope="col">Bank Statement</th>
                      <th scope="col">Cnic</th>
                      <th scope="col">Amount</th>
                    </tr>
                  </thead>
                  <tbody>
                    <td>Yasir Sohail</td>
                    <td>xxxxxxxxxxxxx32</td>
                    <td>xxxxx-xxxxxx8-7</td>
                    <td>30,000 RS</td>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                @click="html_table_to_excel('xlsx', 'loan_employee_report')"
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                @click="generateLoanReport()"
                class="btn btn-gradient-info"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="ind_loan_re2()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal 1-->

      <div
        class="modal fade"
        id="att_detail"
        aria-labelledby="employeehire1Label"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div v-if="daily_att == ''" class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">
                Daily Attendance Report
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Range From</label
                    >
                    <input
                      v-model="att_startingdate"
                      type="date"
                      class="form-control"
                    />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Range To</label
                    >
                    <input
                      v-model="att_closingdate"
                      type="date"
                      class="form-control"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Work Location</label
                    >
                    <select v-model="att_location" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="locations1 in locations"
                        :value="locations1.location_name"
                      >
                        {{ locations1.location_name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Department</label
                    >
                    <select v-model="att_department" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="departments1 in departments"
                        :value="departments1.department_name"
                      >
                        {{ departments1.department_name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Designation</label
                    >
                    <select v-model="att_designation" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="designation1 in designations"
                        :value="designation1.designation_name"
                      >
                        {{ designation1.designation_name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Id</label
                    >
                    <select v-model="att_emp_id" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="find_emp1 in find_emp"
                        :value="find_emp1.EmployeeID"
                      >
                        {{ find_emp1.EmployeeCode }}-{{ find_emp1.Name }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="daily_attendance()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 80%">
                <span style="width: 80%"
                  >Overall Attendance Detail Report
                </span>
              </h4>
              <span class="role-edit-modal">
                {{ this.att_startingdate }}-{{ this.att_closingdate }}</span
              >
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="daily_attendance1()"
              ></button>
            </div>
            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="1400"
              filename="Overall_att_Detail"
              :pdf-quality="2"
              :manual-pagination="false"
              pdf-format="a4"
              pdf-orientation="landscape"
              pdf-content-width="1100px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="htmloverallattPdf"
            >
              <div class="modal-body" slot="pdf-content">
                <div class="table-responsive">
                  <table
                    border="1"
                    class="table tableMain payrollSheetTable"
                    style="
                      font-family: Arial !important;
                      font-size: 10px !important;
                      margin-bottom: 30px;
                    "
                  >
                    <thead>
                      <tr>
                        <th>Emp Code</th>
                        <th>Employee Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="ng-star-inserted">
                      <tr v-for="att_report1 in att_report">
                        <td>{{ att_report1.EmployeeCode }}</td>
                        <td>{{ att_report1.Name }}</td>
                        <td>{{ att_report1.Designation }}</td>
                        <td>{{ att_report1.Department }}</td>
                        <td>{{ att_report1.ATTDate }}</td>
                        <td>{{ att_report1.CheckIN }}</td>
                        <td>{{ att_report1.CheckOut }}</td>
                        <td>{{ att_report1.AttStatus }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </vue-html2pdf>
            <div class="modal-body">
              <div class="table-responsive" id="Employees_Overall_Attendance">
                <table
                  border="1"
                  class="table tableMain payrollSheetTable"
                  style="
                    font-family: Arial !important;
                    font-size: 10px !important;
                    margin-bottom: 30px;
                  "
                >
                  <thead>
                    <tr>
                      <th>Emp Code</th>
                      <th>Employee Name</th>
                      <th>Designation</th>
                      <th>Department</th>
                      <th>Date</th>
                      <th>Check In</th>
                      <th>Check Out</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody class="ng-star-inserted">
                    <tr v-for="att_report1 in att_report">
                      <td>{{ att_report1.EmployeeCode }}</td>
                      <td>{{ att_report1.Name }}</td>
                      <td>{{ att_report1.Designation }}</td>
                      <td>{{ att_report1.Department }}</td>
                      <td>{{ att_report1.ATTDate }}</td>
                      <td>{{ att_report1.CheckIN }}</td>
                      <td>{{ att_report1.CheckOut }}</td>
                      <td>{{ att_report1.AttStatus }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                @click="
                  html_table_to_excel('xlsx', 'Employees_Overall_Attendance')
                "
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                class="btn btn-gradient-info"
                @click="generateoverallattreport()"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="daily_attendance1()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- modal2 -->
      <div
        class="modal fade"
        id="att_payroll"
        aria-labelledby="employeehire1Label"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div v-if="att_pay == ''" class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">
                Attendance Payroll Report
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Work Location</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Department</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Designation</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Id</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="attendance_payroll()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 80%">
                <span style="width: 80%">Attendance Summary Report</span>
              </h4>
              <span>Session Name: {{ this.session_name }}</span>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="attendance_payroll1()"
              ></button>
            </div>
            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="1400"
              filename="Sessionwise_Payroll_Employee_Attendance"
              :pdf-quality="2"
              :manual-pagination="true"
              pdf-format="a4"
              pdf-orientation="landscape"
              pdf-content-width="1100px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="htmlsessionpayrollPdf"
            >
              <div slot="pdf-content">
                <div class="modal-body">
                  <table style="width: 100%">
                    <thead class="grid-header">
                      <tr class="mat-header-row">
                        <th>Emp. Code</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>T. Days</th>
                        <th>Presents</th>
                        <th>Absents</th>
                        <th>Leaves</th>
                        <th>Used GP</th>
                        <th>Overtime</th>
                        <th>Deduction</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="att_payroll_detail1 in att_payroll_detail">
                        <td>{{ att_payroll_detail1.EmpCode }}</td>
                        <td>{{ att_payroll_detail1.Name }}</td>
                        <td>{{ att_payroll_detail1.Designation }}</td>
                        <td>{{ att_payroll_detail1.Department }}</td>
                        <td>{{ att_payroll_detail1.TotalDays }}</td>
                        <td>{{ att_payroll_detail1.TotalPresent }}</td>
                        <td>{{ att_payroll_detail1.TotalAbsent }}</td>
                        <td>{{ att_payroll_detail1.TotalLeave }}</td>
                        <td>{{ att_payroll_detail1.GP }}</td>
                        <td>{{ att_payroll_detail1.OT }}</td>
                        <td>{{ att_payroll_detail1.Deduction }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </vue-html2pdf>
            <div class="modal-body">
              <table style="width: 100%" id="Employees_Payroll_Attendance">
                <thead class="grid-header">
                  <tr class="mat-header-row">
                    <th>Emp. Code</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>T. Days</th>
                    <th>Presents</th>
                    <th>Absents</th>
                    <th>Leaves</th>
                    <th>Used GP</th>
                    <th>Overtime</th>
                    <th>Deduction</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="att_payroll_detail1 in att_payroll_detail">
                    <td>{{ att_payroll_detail1.EmpCode }}</td>
                    <td>{{ att_payroll_detail1.Name }}</td>
                    <td>{{ att_payroll_detail1.Designation }}</td>
                    <td>{{ att_payroll_detail1.Department }}</td>
                    <td>{{ att_payroll_detail1.TotalDays }}</td>
                    <td>{{ att_payroll_detail1.TotalPresent }}</td>
                    <td>{{ att_payroll_detail1.TotalAbsent }}</td>
                    <td>{{ att_payroll_detail1.TotalLeave }}</td>
                    <td>{{ att_payroll_detail1.GP }}</td>
                    <td>{{ att_payroll_detail1.OT }}</td>
                    <td>{{ att_payroll_detail1.Deduction }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                @click="
                  html_table_to_excel('xlsx', 'Employees_Payroll_Attendance')
                "
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                @click="generatesessionpayrollReport()"
                class="btn btn-gradient-info"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="attendance_payroll1()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal 1-->
      <div
        class="modal fade"
        id="modalToggle"
        aria-labelledby="modalToggleLabel"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div v-if="emp_detail == ''" class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">Filter Reports</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Work Location</label
                    >
                    <select v-model="emp_location" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="locations1 in locations"
                        :value="locations1.location_name"
                      >
                        {{ locations1.location_name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Department</label
                    >
                    <select class="form-control" v-model="emp_department">
                      <option value="All">All</option>
                      <option
                        v-for="departments1 in departments"
                        :value="departments1.department_name"
                      >
                        {{ departments1.department_name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Designation</label
                    >
                    <select v-model="emp_designation" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="designation1 in designations"
                        :value="designation1.designation_name"
                      >
                        {{ designation1.designation_name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Id</label
                    >
                    <select v-model="emp_emp_id" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="find_emp1 in find_emp"
                        :value="find_emp1.EmployeeID"
                      >
                        {{ find_emp1.EmployeeCode }}-{{ find_emp1.Name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Type</label
                    >
                    <select v-model="emp_type" class="form-control">
                      <option value="All">All</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Status</label
                    >
                    <select v-model="emp_status" class="form-control">
                      <option value="All">All</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="view_report()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel16">
                Employee Detail Report
              </h4>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="view_report1()"
              ></button>
            </div>
            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="5000"
              filename="Employee_Detail_Report"
              :pdf-quality="2"
              :manual-pagination="false"
              pdf-format="a4"
              pdf-orientation="landscape"
              pdf-content-width="1100px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="htmlempdetailPdf"
            >
              <div slot="pdf-content">
                <div class="modal-body">
                  <div
                    class="table-responsive"
                    style="overflow-x: initial !important"
                  >
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Employment Detail</th>
                          <th scope="col">Basic Info</th>
                          <th scope="col">Contact Info</th>
                          <th scope="col">Home Address</th>
                          <th scope="col">Payment</th>
                        </tr>
                      </thead>
                      <tbody>
                        <!---->
                        <tr
                          class="ng-star-inserted"
                          v-for="getemployee1 in getemployee"
                        >
                          <td>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Name:</strong>
                                </div>
                                <div>
                                  <span
                                    >{{ getemployee1.EmployeeCode }} -
                                    {{ getemployee1.Name }}</span
                                  >
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Department:</strong>
                                </div>
                                <div>
                                  <span>{{ getemployee1.Department }}</span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Designation:</strong>
                                </div>
                                <div>
                                  <span>{{ getemployee1.Designation }}</span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Location:</strong>
                                </div>
                                <div>
                                  <span>{{ getemployee1.PostingCity }}</span>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Gender:</strong>
                                </div>
                                <div>
                                  <!----><span class="ng-star-inserted">{{
                                    getemployee1.Gender
                                  }}</span>
                                  <!---->
                                  <!---->
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>DOB:</strong>
                                </div>
                                <div>
                                  <span>{{ getemployee1.DOB }}</span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Hired:</strong>
                                </div>
                                <div>
                                  <span>{{ getemployee1.JoiningDate }}</span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Job Shift:</strong>
                                </div>
                                <div>
                                  <span>{{ getemployee1.JobShift }}</span>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Email:</strong>
                                </div>
                                <div>
                                  <span>{{ getemployee1.Email }}</span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Mobile:</strong>
                                </div>
                                <div>
                                  <span>{{ getemployee1.Mobile }}</span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Job Status:</strong>
                                </div>
                                <div>
                                  <span>{{ getemployee1.JobStatus }}</span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Relation:</strong>
                                </div>
                                <div>
                                  <span>{{ getemployee1.Relation }}</span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Emergency Phone:</strong>
                                </div>
                                <div>
                                  <span>{{ getemployee1.Phone }}</span>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td style="width: 300px !important">
                            <p rows="6" readonly>
                              {{ getemployee1.Address }},
                              {{ getemployee1.City }}
                            </p>
                          </td>
                          <td>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Method:</strong>
                                </div>
                                <div>
                                  <span>{{ getemployee1.MethodType }}</span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Salary:</strong>
                                </div>
                                <div>
                                  <span>{{ getemployee1.Salary }}</span>
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  <strong>Job Description:</strong>
                                </div>
                                <div>
                                  <span></span>
                                </div>
                              </div>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </vue-html2pdf>
            <div class="modal-body">
              <div
                class="table-responsive"
                style="overflow-x: initial !important"
              >
                <table class="table" id="Employees_Detail">
                  <thead>
                    <tr>
                      <th scope="col">Employment Detail</th>
                      <th scope="col">Basic Info</th>
                      <th scope="col">Contact Info</th>
                      <th scope="col">Home Address</th>
                      <th scope="col">Payment</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!---->
                    <tr
                      class="ng-star-inserted"
                      v-for="getemployee1 in getemployee"
                    >
                      <td rows="6">
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Name:</strong>
                            </div>
                            <div>
                              <span
                                >{{ getemployee1.EmployeeCode }} -
                                {{ getemployee1.Name }}</span
                              >
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Department:</strong>
                            </div>
                            <div>
                              <span>{{ getemployee1.Department }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Designation:</strong>
                            </div>
                            <div>
                              <span>{{ getemployee1.Designation }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Location:</strong>
                            </div>
                            <div>
                              <span>{{ getemployee1.PostingCity }}</span>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td rows="6">
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Gender:</strong>
                            </div>
                            <div>
                              <!----><span class="ng-star-inserted">{{
                                getemployee1.Gender
                              }}</span>
                              <!---->
                              <!---->
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>DOB:</strong>
                            </div>
                            <div>
                              <span>{{ getemployee1.DOB }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Hired:</strong>
                            </div>
                            <div>
                              <span>{{ getemployee1.JoiningDate }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Job Shift:</strong>
                            </div>
                            <div>
                              <span>{{ getemployee1.JobShift }}</span>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td rows="6">
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Email:</strong>
                            </div>
                            <div>
                              <span>{{ getemployee1.Email }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Mobile:</strong>
                            </div>
                            <div>
                              <span>{{ getemployee1.Mobile }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Job Status:</strong>
                            </div>
                            <div>
                              <span>{{ getemployee1.JobStatus }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Relation:</strong>
                            </div>
                            <div>
                              <span>{{ getemployee1.Relation }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Emergency Phone:</strong>
                            </div>
                            <div>
                              <span>{{ getemployee1.Phone }}</span>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td style="width: 300px !important">
                        <p rows="6" readonly>
                          {{ getemployee1.Address }}, {{ getemployee1.City }}
                        </p>
                      </td>
                      <td rows="6">
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Method:</strong>
                            </div>
                            <div>
                              <span>{{ getemployee1.MethodType }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Salary:</strong>
                            </div>
                            <div>
                              <span>{{ getemployee1.Salary }}</span>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              <strong>Job Description:</strong>
                            </div>
                            <div>
                              <span></span>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                @click="html_table_to_excel('xlsx', 'Employees_Detail')"
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                @click="generateempdetailReport()"
                class="btn btn-gradient-info"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                @click="view_report1()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- end modal -->

      <!-- Modal 1-->
      <div
        class="modal fade"
        id="employeehire1"
        aria-labelledby="employeehire1Label"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div v-if="emp_hire == ''" class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">Hiring Report</h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Range From</label
                    >
                    <input
                      type="date"
                      v-model="hire_start_date"
                      class="form-control"
                    />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Range To</label
                    >
                    <input
                      v-model="hire_end_date"
                      type="date"
                      class="form-control"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Work Location</label
                    >
                    <select v-model="hire_location" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="locations1 in locations"
                        :value="locations1.location_name"
                      >
                        {{ locations1.location_name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Department</label
                    >
                    <select v-model="hire_department" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="departments1 in departments"
                        :value="departments1.department_name"
                      >
                        {{ departments1.department_name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Designation</label
                    >
                    <select v-model="hire_designation" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="designation1 in designations"
                        :value="designation1.designation_name"
                      >
                        {{ designation1.designation_name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Id</label
                    >
                    <select v-model="hire_emp_id" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="find_emp1 in find_emp"
                        :value="find_emp1.EmployeeID"
                      >
                        {{ find_emp1.EmployeeCode }}-{{ find_emp1.Name }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="employee_hire_report()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 80%">
                <span style="width: 80%">Employee Hire Report </span>
              </h4>
              <span class="role-edit-modal">
                {{ this.hire_start_date }} - {{ this.hire_end_date }}</span
              >
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="employee_hire_report1()"
              ></button>
            </div>
            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="5000"
              filename="Employee_Hiring_Report"
              :pdf-quality="2"
              :manual-pagination="false"
              pdf-format="a4"
              pdf-orientation="landscape"
              pdf-content-width="1100px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="htmlemphirePdf"
            >
              <div slot="pdf-content">
                <div class="modal-header d-flex justify-content-between">
                  <h4 class="modal-title" style="width: 80%">
                    <span style="width: 80%">Employee Hire Report </span>
                  </h4>
                  <span class="role-edit-modal">
                    {{ this.hire_start_date }} - {{ this.hire_end_date }}</span
                  >
                </div>
                <div class="modal-body">
                  <div class="table-responsive EmployeeHireReport">
                    <table
                      class="table employeeHireReport"
                      id="Employees_Hiring_Report"
                    >
                      <thead style="">
                        <tr>
                          <th scope="col" style="width: 20%">
                            Employment Detail
                          </th>
                          <th scope="col" style="width: 80%; min-width: 500px">
                            <table style="width: 100%">
                              <thead>
                                <tr>
                                  <th scope="col" style="width: 50%">
                                    Personal Detail
                                  </th>
                                  <th scope="col" style="width: 25%">
                                    Hire Date
                                  </th>
                                  <th scope="col" style="width: 25%">
                                    Job Detail
                                  </th>
                                </tr>
                              </thead>
                            </table>
                          </th>
                        </tr>
                      </thead>
                      <tfoot style="">
                        <tr>
                          <th scope="col"></th>
                          <!---->
                          <!---->
                          <th scope="col" class="ng-star-inserted">
                            Total Employees:{{ this.gethireemplocount }}
                          </th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <!---->
                        <tr
                          class="ng-star-inserted"
                          v-for="gethireemplo1 in gethireemplo"
                        >
                          <td style="width: 20%">
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  Department:{{ gethireemplo1.Department }}
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  Designation:{{ gethireemplo1.Designation }}
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="mt-display-flex">
                                <div>
                                  Location:{{ gethireemplo1.PostingCity }}
                                </div>
                              </div>
                            </div>
                          </td>
                          <td style="width: 80%; min-width: 500px">
                            <table style="width: 100%">
                              <tbody>
                                <!---->
                                <tr class="ng-star-inserted">
                                  <td style="width: 50%">
                                    <div class="row">
                                      <div class="mt-display-flex">
                                        <div>
                                          <span
                                            >{{ gethireemplo1.EmployeeCode }} -
                                            {{ gethireemplo1.Name }}</span
                                          >
                                        </div>
                                        <div>
                                          <span
                                            >Cnic:{{ gethireemplo1.CNIC }}
                                          </span>
                                        </div>
                                        <div>
                                          <span
                                            >Phone:{{ gethireemplo1.Mobile }}
                                          </span>
                                        </div>
                                      </div>
                                    </div>
                                  </td>
                                  <td style="width: 25%">
                                    <div>
                                      <span>
                                        {{ gethireemplo1.JoiningDate }}</span
                                      >
                                    </div>
                                    <div>
                                      <span>
                                        {{ gethireemplo1.JobStatus }}
                                      </span>
                                    </div>
                                  </td>
                                  <td style="width: 25%">
                                    <div>
                                      <span
                                        >Salary: {{ gethireemplo1.Salary }}/-
                                      </span>
                                    </div>
                                    <div>
                                      <span>
                                        {{ gethireemplo1.JobDescription }}
                                      </span>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </vue-html2pdf>
            <div class="modal-body">
              <div class="table-responsive EmployeeHireReport">
                <table class="table employeeHireReport">
                  <thead style="">
                    <tr>
                      <th scope="col" style="width: 20%">Employment Detail</th>
                      <th scope="col" style="width: 80%; min-width: 500px">
                        <table style="width: 100%">
                          <thead>
                            <tr>
                              <th scope="col" style="width: 50%">
                                Personal Detail
                              </th>
                              <th scope="col" style="width: 25%">Hire Date</th>
                              <th scope="col" style="width: 25%">Job Detail</th>
                            </tr>
                          </thead>
                        </table>
                      </th>
                    </tr>
                  </thead>
                  <tfoot style="">
                    <tr>
                      <th scope="col"></th>
                      <!---->
                      <!---->
                      <th scope="col" class="ng-star-inserted">
                        Total Employees:{{ this.gethireemplocount }}
                      </th>
                      <th scope="col"></th>
                      <th scope="col"></th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <!---->
                    <tr
                      class="ng-star-inserted"
                      v-for="gethireemplo1 in gethireemplo"
                    >
                      <td style="width: 20%">
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>Department:{{ gethireemplo1.Department }}</div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>
                              Designation:{{ gethireemplo1.Designation }}
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="mt-display-flex">
                            <div>Location:{{ gethireemplo1.PostingCity }}</div>
                          </div>
                        </div>
                      </td>
                      <td style="width: 80%; min-width: 500px">
                        <table style="width: 100%">
                          <tbody>
                            <!---->
                            <tr class="ng-star-inserted">
                              <td style="width: 50%">
                                <div class="row">
                                  <div class="mt-display-flex">
                                    <div>
                                      <span
                                        >{{ gethireemplo1.EmployeeCode }} -
                                        {{ gethireemplo1.Name }}</span
                                      >
                                    </div>
                                    <div>
                                      <span
                                        >Cnic:{{ gethireemplo1.CNIC }}
                                      </span>
                                    </div>
                                    <div>
                                      <span
                                        >Phone:{{ gethireemplo1.Mobile }}
                                      </span>
                                    </div>
                                  </div>
                                </div>
                              </td>
                              <td style="width: 25%">
                                <div>
                                  <span> {{ gethireemplo1.JoiningDate }}</span>
                                </div>
                                <div>
                                  <span> {{ gethireemplo1.JobStatus }} </span>
                                </div>
                              </td>
                              <td style="width: 25%">
                                <div>
                                  <span
                                    >Salary: {{ gethireemplo1.Salary }}/-
                                  </span>
                                </div>
                                <div>
                                  <span>
                                    {{ gethireemplo1.JobDescription }}
                                  </span>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                @click="html_table_to_excel('xlsx', 'Employees_Hiring_Report')"
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                @click="htmlemphirereport()"
                class="btn btn-gradient-info"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="employee_hire_report1()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- div end -->
      <div
        class="modal fade"
        id="employeeappraisal"
        aria-labelledby="employeehire1Label"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div
          v-if="emp_appraisal == ''"
          class="modal-dialog modal-dialog-centered"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">
                Employee Appraisal Report
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Range From</label
                    >
                    <input type="date" class="form-control" />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Range To</label
                    >
                    <input type="date" class="form-control" />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Work Location</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Department</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Designation</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Id</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button
                class="btn btn-primary"
                @click="employee_appraisal_report()"
              >
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 80%">
                <span style="width: 80%">Employee Appraisal Report </span>
              </h4>
              <span class="role-edit-modal"> 01/01/2022 - 31/12/2022</span>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="employee_appraisal_report1()"
              ></button>
            </div>
            <div class="modal-body">
              <div class="table-responsive EmployeeHireReport">
                <table class="table employeeHireReport">
                  <thead style="">
                    <tr>
                      <th>Name</th>
                      <th>Designation</th>
                      <th>Department</th>
                      <th>Appraisal Amount</th>
                      <th>Date</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-gradient-info">Excel</button>
              <button type="button" class="btn btn-gradient-info">Pdf</button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="employee_appraisal_report1()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>

      <div
        class="modal fade"
        id="absent_summary"
        aria-labelledby="employeehire1Label"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div
          v-if="abs_summary == ''"
          class="modal-dialog modal-dialog-centered"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">
                Absent Summary Report
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Range From</label
                    >
                    <input
                      type="date"
                      v-model="absent_from"
                      class="form-control"
                    />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Range To</label
                    >
                    <input
                      type="date"
                      v-model="absent_to"
                      class="form-control"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Work Location</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Department</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Designation</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Id</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="absent_summary()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 80%">
                <span style="width: 80%">Absent Summary Report </span>
              </h4>
              <span class="role-edit-modal">
                {{ this.absent_from }} - {{ this.absent_to }}</span
              >
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="absent_summary1()"
              ></button>
            </div>
            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="1400"
              filename="Employee_Absent_Report"
              :pdf-quality="2"
              :manual-pagination="false"
              pdf-format="a4"
              pdf-orientation="portrait"
              pdf-content-width="800px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="htmlempabsentPdf"
            >
              <div class="modal-body" slot="pdf-content">
                <div class="table-responsive">
                  <table
                    class="table attendancesummaryreport"
                    id="Employees_Absent_Report"
                  >
                    <thead style="">
                      <tr>
                        <th scope="col" colspan="6">Absent Report</th>
                      </tr>
                    </thead>
                    <thead style="">
                      <tr>
                        <th scope="col">Emp. Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Department</th>
                        <th scope="col">Location</th>
                        <th scope="col">Date</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="absent_detail1 in absent_detail">
                        <td>{{ absent_detail1.EmployeeCode }}</td>
                        <td>{{ absent_detail1.Name }}</td>
                        <td>{{ absent_detail1.Designation }}</td>
                        <td>{{ absent_detail1.Department }}</td>
                        <td>{{ absent_detail1.PostingCity }}</td>
                        <td>{{ absent_detail1.ATTDate }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </vue-html2pdf>
            <div class="modal-body">
              <div class="table-responsive">
                <table class="table attendancesummaryreport">
                  <thead style="">
                    <tr>
                      <th scope="col">Emp. Code</th>
                      <th scope="col">Name</th>
                      <th scope="col">Designation</th>
                      <th scope="col">Department</th>
                      <th scope="col">Location</th>
                      <th scope="col">Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="absent_detail1 in absent_detail">
                      <td>{{ absent_detail1.EmployeeCode }}</td>
                      <td>{{ absent_detail1.Name }}</td>
                      <td>{{ absent_detail1.Designation }}</td>
                      <td>{{ absent_detail1.Department }}</td>
                      <td>{{ absent_detail1.PostingCity }}</td>
                      <td>{{ absent_detail1.ATTDate }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                @click="html_table_to_excel('xlsx', 'Employees_Absent_Report')"
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                @click="empabsentpdfreport()"
                class="btn btn-gradient-info"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="absent_summary1()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>

      <div
        class="modal fade"
        id="att_detail"
        aria-labelledby="employeehire1Label"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div v-if="daily_att == ''" class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">
                Daily Attendance Report
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Range From</label
                    >
                    <input
                      v-model="att_startingdate"
                      type="date"
                      class="form-control"
                    />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Range To</label
                    >
                    <input
                      v-model="att_closingdate"
                      type="date"
                      class="form-control"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Work Location</label
                    >
                    <select v-model="att_location" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="locations1 in locations"
                        :value="locations1.location_name"
                      >
                        {{ locations1.location_name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Department</label
                    >
                    <select v-model="att_department" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="departments1 in departments"
                        :value="departments1.department_name"
                      >
                        {{ departments1.department_name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Designation</label
                    >
                    <select v-model="att_designation" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="designation1 in designations"
                        :value="designation1.designation_name"
                      >
                        {{ designation1.designation_name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Id</label
                    >
                    <select v-model="att_emp_id" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="find_emp1 in find_emp"
                        :value="find_emp1.EmployeeID"
                      >
                        {{ find_emp1.EmployeeCode }}-{{ find_emp1.Name }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="daily_attendance()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 80%">
                <span style="width: 80%"
                  >Overall Attendance Detail Report
                </span>
              </h4>
              <span class="role-edit-modal">
                {{ this.att_startingdate }}-{{ this.att_closingdate }}</span
              >
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="daily_attendance1()"
              ></button>
            </div>
            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="1400"
              filename="Overall_att_Detail"
              :pdf-quality="2"
              :manual-pagination="false"
              pdf-format="a4"
              pdf-orientation="landscape"
              pdf-content-width="1100px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="htmloverallattPdf"
            >
              <div class="modal-body" slot="pdf-content">
                <div class="table-responsive">
                  <table
                    border="1"
                    class="table tableMain payrollSheetTable"
                    style="
                      font-family: Arial !important;
                      font-size: 10px !important;
                      margin-bottom: 30px;
                    "
                  >
                    <thead>
                      <tr>
                        <th>Emp Code</th>
                        <th>Employee Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>Date</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody class="ng-star-inserted">
                      <tr v-for="att_report1 in att_report">
                        <td>{{ att_report1.EmployeeCode }}</td>
                        <td>{{ att_report1.Name }}</td>
                        <td>{{ att_report1.Designation }}</td>
                        <td>{{ att_report1.Department }}</td>
                        <td>{{ att_report1.ATTDate }}</td>
                        <td>{{ att_report1.CheckIN }}</td>
                        <td>{{ att_report1.CheckOut }}</td>
                        <td>{{ att_report1.AttStatus }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </vue-html2pdf>
            <div class="modal-body">
              <div class="table-responsive" id="Employees_Overall_Attendance">
                <table
                  border="1"
                  class="table tableMain payrollSheetTable"
                  style="
                    font-family: Arial !important;
                    font-size: 10px !important;
                    margin-bottom: 30px;
                  "
                >
                  <thead>
                    <tr>
                      <th>Emp Code</th>
                      <th>Employee Name</th>
                      <th>Designation</th>
                      <th>Department</th>
                      <th>Date</th>
                      <th>Check In</th>
                      <th>Check Out</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody class="ng-star-inserted">
                    <tr v-for="att_report1 in att_report">
                      <td>{{ att_report1.EmployeeCode }}</td>
                      <td>{{ att_report1.Name }}</td>
                      <td>{{ att_report1.Designation }}</td>
                      <td>{{ att_report1.Department }}</td>
                      <td>{{ att_report1.ATTDate }}</td>
                      <td>{{ att_report1.CheckIN }}</td>
                      <td>{{ att_report1.CheckOut }}</td>
                      <td>{{ att_report1.AttStatus }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                @click="
                  html_table_to_excel('xlsx', 'Employees_Overall_Attendance')
                "
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                class="btn btn-gradient-info"
                @click="generateoverallattreport()"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="daily_attendance1()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>
      <div
        class="modal fade"
        id="att_payroll"
        aria-labelledby="employeehire1Label"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div v-if="att_pay == ''" class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">
                Attendance Payroll Report
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Work Location</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Department</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Designation</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Id</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="attendance_payroll()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 80%">
                <span style="width: 80%">Attendance Summary Report</span>
              </h4>
              <span>Session Name: {{ this.session_name }}</span>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="attendance_payroll1()"
              ></button>
            </div>
            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="1400"
              filename="Sessionwise_Payroll_Employee_Attendance"
              :pdf-quality="2"
              :manual-pagination="true"
              pdf-format="a4"
              pdf-orientation="landscape"
              pdf-content-width="1100px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="htmlsessionpayrollPdf"
            >
              <div slot="pdf-content">
                <div class="modal-body">
                  <table style="width: 100%">
                    <thead class="grid-header">
                      <tr class="mat-header-row">
                        <th>Emp. Code</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Department</th>
                        <th>T. Days</th>
                        <th>Presents</th>
                        <th>Absents</th>
                        <th>Leaves</th>
                        <th>Used GP</th>
                        <th>Overtime</th>
                        <th>Deduction</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="att_payroll_detail1 in att_payroll_detail">
                        <td>{{ att_payroll_detail1.EmpCode }}</td>
                        <td>{{ att_payroll_detail1.Name }}</td>
                        <td>{{ att_payroll_detail1.Designation }}</td>
                        <td>{{ att_payroll_detail1.Department }}</td>
                        <td>{{ att_payroll_detail1.TotalDays }}</td>
                        <td>{{ att_payroll_detail1.TotalPresent }}</td>
                        <td>{{ att_payroll_detail1.TotalAbsent }}</td>
                        <td>{{ att_payroll_detail1.TotalLeave }}</td>
                        <td>{{ att_payroll_detail1.GP }}</td>
                        <td>{{ att_payroll_detail1.OT }}</td>
                        <td>{{ att_payroll_detail1.Deduction }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </vue-html2pdf>
            <div class="modal-body">
              <table style="width: 100%" id="Employees_Payroll_Attendance">
                <thead class="grid-header">
                  <tr class="mat-header-row">
                    <th>Emp. Code</th>
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>T. Days</th>
                    <th>Presents</th>
                    <th>Absents</th>
                    <th>Leaves</th>
                    <th>Used GP</th>
                    <th>Overtime</th>
                    <th>Deduction</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="att_payroll_detail1 in att_payroll_detail">
                    <td>{{ att_payroll_detail1.EmpCode }}</td>
                    <td>{{ att_payroll_detail1.Name }}</td>
                    <td>{{ att_payroll_detail1.Designation }}</td>
                    <td>{{ att_payroll_detail1.Department }}</td>
                    <td>{{ att_payroll_detail1.TotalDays }}</td>
                    <td>{{ att_payroll_detail1.TotalPresent }}</td>
                    <td>{{ att_payroll_detail1.TotalAbsent }}</td>
                    <td>{{ att_payroll_detail1.TotalLeave }}</td>
                    <td>{{ att_payroll_detail1.GP }}</td>
                    <td>{{ att_payroll_detail1.OT }}</td>
                    <td>{{ att_payroll_detail1.Deduction }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                @click="
                  html_table_to_excel('xlsx', 'Employees_Payroll_Attendance')
                "
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                @click="generatesessionpayrollReport()"
                class="btn btn-gradient-info"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="attendance_payroll1()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>

      <div
        class="modal fade"
        id="att_summary"
        aria-labelledby="employeehire1Label"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div v-if="att_sum == ''" class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">
                Attendance Summary Report
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Work Location</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Department</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Designation</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Id</label
                    >
                    <select class="form-control">
                      <option value="">All</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="attendance_summary()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 80%">
                <span style="width: 80%">Attendance Summary Report</span>
              </h4>
              <span>Session Name: {{ this.session_name }}</span>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="attendance_summary1()"
              ></button>
            </div>

            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="1400"
              filename="Sessionwise_Employee_Attendance"
              :pdf-quality="2"
              :manual-pagination="false"
              pdf-format="a4"
              pdf-orientation="landscape"
              pdf-content-width="1100px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="htmlsessionEmpPdf"
            >
              <table style="width: 100%" slot="pdf-content">
                <thead class="grid-header">
                  <tr class="mat-header-row">
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th v-for="attandance_header1 in attandance_header">
                      {{ attandance_header1.DT.substring(8, 10) }}
                    </th>
                  </tr>
                </thead>
                <tbody v-html="attandance_summary"></tbody>
              </table>
            </vue-html2pdf>
            <div class="modal-body">
              <table style="width: 100%" id="Employees_Attendance_Summary">
                <thead class="grid-header">
                  <tr class="mat-header-row">
                    <th>Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th v-for="attandance_header1 in attandance_header">
                      {{ attandance_header1.DT.substring(8, 10) }}
                    </th>
                  </tr>
                </thead>
                <tbody v-html="attandance_summary"></tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                @click="
                  html_table_to_excel('xlsx', 'Employees_Attendance_Summary')
                "
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                @click="generatesessionReport()"
                class="btn btn-gradient-info"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="attendance_summary1()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>
      <div
        class="modal fade"
        id="leave_detail"
        aria-labelledby="employeehire1Label"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div v-if="lve_detail == ''" class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">
                Employees Leaves Detail Report
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Range From</label
                    >
                    <input
                      type="date"
                      v-model="l_date_from"
                      class="form-control"
                    />
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Range To</label
                    >

                    <input
                      type="date"
                      v-model="l_date_end"
                      class="form-control"
                    />
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <label class="form-label" for="modalAddCardName"
                      >Leave Type</label
                    >
                    <select v-model="l_leave_type" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="leaves1 in leaves"
                        :value="leaves1.LeaveType"
                      >
                        {{ leaves1.LeaveType }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Work Location</label
                    >
                    <select v-model="l_location" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="locations1 in locations"
                        :value="locations1.location_name"
                      >
                        {{ locations1.location_name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Department</label
                    >
                    <select v-model="l_department" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="departments1 in departments"
                        :value="departments1.department_name"
                      >
                        {{ departments1.department_name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Designation</label
                    >
                    <select v-model="l_designation" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="designation1 in designations"
                        :value="designation1.designation_name"
                      >
                        {{ designation1.designation_name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Id</label
                    >
                    <select v-model="l_emp_id" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="find_emp1 in find_emp"
                        :value="find_emp1.EmployeeID"
                      >
                        {{ find_emp1.EmployeeCode }}-{{ find_emp1.Name }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="leave_detail_()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 80%">
                <span style="width: 80%">Leave Detail Report </span>
              </h4>
              <span class="role-edit-modal"
                >{{ this.l_date_from }} - {{ this.l_date_end }}
              </span>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="leave_detail_1()"
              ></button>
            </div>
            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="1400"
              filename="Leave_Employees"
              :pdf-quality="2"
              :manual-pagination="false"
              pdf-format="a4"
              pdf-orientation="landscape"
              pdf-content-width="1100px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="htmlleavedetailEmpPdf"
            >
              <div class="modal-body" slot="pdf-content">
                <div class="table-responsive">
                  <table class="table attendancesummaryreport">
                    <thead style="">
                      <tr>
                        <th scope="col">Employee Code</th>
                        <th scope="col">Name</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Department</th>
                        <th scope="col">Location</th>
                        <th scope="col">Leave Type</th>
                        <th scope="col">Period</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="getleavedetail1 in getleavedetail">
                        <td>{{ getleavedetail1.EmployeeCode }}</td>
                        <td>{{ getleavedetail1.Name }}</td>
                        <td>{{ getleavedetail1.Designation }}</td>
                        <td>{{ getleavedetail1.Department }}</td>
                        <td>{{ getleavedetail1.PostingCity }}</td>
                        <td>{{ getleavedetail1.Leavetype }}</td>
                        <td>
                          {{ getleavedetail1.StartDate }}-{{
                            getleavedetail1.EndDate
                          }}
                        </td>
                        <td>{{ getleavedetail1.Reason }}</td>
                        <td>{{ getleavedetail1.HRApproval }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </vue-html2pdf>
            <div class="modal-body" slot="pdf-content">
              <div class="table-responsive">
                <table
                  class="table attendancesummaryreport"
                  id="Employees_Leaves_Detail"
                >
                  <thead style="">
                    <tr>
                      <th scope="col">Employee Code</th>
                      <th scope="col">Name</th>
                      <th scope="col">Designation</th>
                      <th scope="col">Department</th>
                      <th scope="col">Location</th>
                      <th scope="col">Leave Type</th>
                      <th scope="col">Period</th>
                      <th scope="col">Reason</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="getleavedetail1 in getleavedetail">
                      <td>{{ getleavedetail1.EmployeeCode }}</td>
                      <td>{{ getleavedetail1.Name }}</td>
                      <td>{{ getleavedetail1.Designation }}</td>
                      <td>{{ getleavedetail1.Department }}</td>
                      <td>{{ getleavedetail1.PostingCity }}</td>
                      <td>{{ getleavedetail1.Leavetype }}</td>
                      <td>
                        {{ getleavedetail1.StartDate }}-{{
                          getleavedetail1.EndDate
                        }}
                      </td>
                      <td>{{ getleavedetail1.Reason }}</td>
                      <td>{{ getleavedetail1.HRApproval }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                @click="html_table_to_excel('xlsx', 'Employees_Leaves_Detail')"
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                @click="generateleavedetailReport()"
                class="btn btn-gradient-info"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="leave_detail_1()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>

      <div
        class="modal fade"
        id="leave_summary"
        aria-labelledby="employeehire1Label"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div
          v-if="lve_summary == ''"
          class="modal-dialog modal-dialog-centered"
        >
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">
                Leaves Summary Report
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-12">
                    <label class="form-label" for="modalAddCardName"
                      >Leave Type</label
                    >
                    <select v-model="s_leave_type" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="leaves1 in leaves"
                        :value="leaves1.LeaveType"
                      >
                        {{ leaves1.LeaveType }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Work Location</label
                    >
                    <select v-model="s_location" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="locations1 in locations"
                        :value="locations1.location_name"
                      >
                        {{ locations1.location_name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Department</label
                    >
                    <select v-model="s_department" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="departments1 in departments"
                        :value="departments1.department_name"
                      >
                        {{ departments1.department_name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Designation</label
                    >
                    <select v-model="s_designation" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="designation1 in designations"
                        :value="designation1.designation_name"
                      >
                        {{ designation1.designation_name }}
                      </option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Id</label
                    >
                    <select v-model="s_emp_id" class="form-control">
                      <option value="All">All</option>
                      <option
                        v-for="find_emp1 in find_emp"
                        :value="find_emp1.EmployeeID"
                      >
                        {{ find_emp1.EmployeeCode }}-{{ find_emp1.Name }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="leave_summary()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 80%">
                <span style="width: 80%">Leave Summary Report </span>
              </h4>

              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="leave_summary1()"
              ></button>
            </div>
            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="1400"
              filename="Emp_Leaves_Detail"
              :pdf-quality="2"
              :manual-pagination="false"
              pdf-format="a4"
              pdf-orientation="landscape"
              pdf-content-width="1100px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="htmlleavesummaryEmpPdf"
            >
              <div class="modal-body" slot="pdf-content">
                <div class="table-responsive">
                  <table class="table attendancesummaryreport">
                    <thead style="">
                      <tr>
                        <th scope="col">Employee Code</th>
                        <th scope="col">Employee Name</th>
                        <th scope="col">Designation</th>
                        <th scope="col">Department</th>
                        <th scope="col">Location</th>
                        <th scope="col">Leave Type</th>
                        <th scope="col">Total Leaves</th>
                        <th scope="col">Remaining Balance</th>
                      </tr>
                    </thead>
                    <tbody v-for="getleavesummary1 in getleavesummary">
                      <tr>
                        <td>{{ getleavesummary1.EmployeeCode }}</td>
                        <td>{{ getleavesummary1.Name }}</td>
                        <td>{{ getleavesummary1.Designation }}</td>
                        <td>{{ getleavesummary1.Department }}</td>
                        <td>{{ getleavesummary1.PostingCity }}</td>
                        <td>{{ getleavesummary1.LeaveType }}</td>
                        <td>{{ getleavesummary1.TotalLeave }}</td>
                        <td>{{ getleavesummary1.RemainingLeave }}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </vue-html2pdf>
            <div class="modal-body">
              <div class="table-responsive">
                <table
                  class="table attendancesummaryreport"
                  id="Employees_Leaves_Summary"
                >
                  <thead style="">
                    <tr>
                      <th scope="col">Employee Code</th>
                      <th scope="col">Employee Name</th>
                      <th scope="col">Designation</th>
                      <th scope="col">Department</th>
                      <th scope="col">Location</th>
                      <th scope="col">Leave Type</th>
                      <th scope="col">Total Leaves</th>
                      <th scope="col">Remaining Balance</th>
                    </tr>
                  </thead>
                  <tbody v-for="getleavesummary1 in getleavesummary">
                    <tr>
                      <td>{{ getleavesummary1.EmployeeCode }}</td>
                      <td>{{ getleavesummary1.Name }}</td>
                      <td>{{ getleavesummary1.Designation }}</td>
                      <td>{{ getleavesummary1.Department }}</td>
                      <td>{{ getleavesummary1.PostingCity }}</td>
                      <td>{{ getleavesummary1.LeaveType }}</td>
                      <td>{{ getleavesummary1.TotalLeave }}</td>
                      <td>{{ getleavesummary1.RemainingLeave }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="modal-footer">
              <button
                type="button"
                @click="html_table_to_excel('xlsx', 'Employees_Leaves_Summary')"
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                @click="empleavesummary()"
                class="btn btn-gradient-info"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="leave_summary1()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>
      <div
        class="modal fade"
        id="ind_att_report"
        aria-labelledby="ind_att_report"
        tabindex="-1"
        style="display: none"
        aria-hidden="true"
      >
        <div v-if="ind_report == ''" class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalToggleLabel">
                Session wise Individual Report
              </h5>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
              ></button>
            </div>
            <div class="modal-body">
              <!-- form -->
              <div
                id="addNewCardValidation"
                class="row gy-1 gx-2 mt-75"
                onsubmit="return false"
              >
                <div class="row">
                  <div class="col-md-12">
                    <label class="form-label" for="modalAddCardName"
                      >Employee Code</label
                    >
                    <select v-model="ind_emp_id" class="form-control">
                      <option value="">Select Employee</option>
                      <option
                        v-for="find_emp1 in find_emp"
                        :value="find_emp1.EmployeeID"
                      >
                        {{ find_emp1.EmployeeCode }}-{{ find_emp1.Name }}
                      </option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-primary" @click="ind_attendance_re()">
                View Report
              </button>
              <button
                type="button"
                class="btn btn-primary"
                data-bs-dismiss="modal"
                aria-label="Close"
              >
                Close
              </button>
            </div>
          </div>
        </div>
        <div v-else class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between">
              <h4 class="modal-title" style="width: 60%">
                <span style="width: 60%">Session Wise Indivdual Report </span>
              </h4>
              <span>Session Name: {{ this.session_name }}</span>
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
                aria-label="Close"
                @click="ind_attendance_re1()"
              ></button>
            </div>

            <vue-html2pdf
              :show-layout="false"
              :float-layout="true"
              :enable-download="true"
              :preview-modal="false"
              :paginate-elements-by-height="1400"
              filename="Ind_Employee_Attendance"
              :pdf-quality="2"
              :manual-pagination="false"
              pdf-format="a4"
              pdf-orientation="portrait"
              pdf-content-width="800px"
              @progress="onProgress($event)"
              @hasStartedGeneration="hasStartedGeneration()"
              @hasGenerated="hasGenerated($event)"
              ref="html2Pdf"
            >
              <div slot="pdf-content">
                <div class="modal-header d-flex justify-content-between">
                  <h4 class="modal-title" style="width: 60%">
                    <span style="width: 60%"
                      >Session Wise Indivdual Report
                    </span>
                  </h4>
                </div>
                <div class="modal-body">
                  <div class="table-responsive">
                    <table class="" style="width: 100%">
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Employee Code: </strong
                          >{{ att_individual_count.EmployeeCode }}
                        </td>
                        <td style="width: 30%; font-size: bold">
                          <strong>Total Days: </strong
                          >{{ att_individual_count.totaldays }}
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Name: </strong>{{ att_individual_count.Name }}
                        </td>
                        <td style="width: 30%; font-size: bold">
                          <strong>Present Days:</strong
                          >{{ att_individual_count.present }}
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Designation: </strong
                          >{{ att_individual_count.Designation }}
                        </td>
                        <td style="width: 30%; font-size: bold">
                          <strong>Absent Days: </strong
                          >{{ att_individual_count.absent }}
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Department: </strong
                          >{{ att_individual_count.Department }}
                        </td>
                        <td style="width: 30%; font-size: bold">
                          <strong>Leaves: </strong
                          >{{ att_individual_count.leaves }}
                        </td>
                      </tr>
                      <tr>
                        <td style="width: 70%; font-size: bold">
                          <strong>Location: </strong
                          >{{ att_individual_count.PostingCity }}
                        </td>
                        <td style="width: 30%; font-size: bold">
                          <strong>Deduction: </strong>__
                        </td>
                      </tr>
                    </table>
                  </div>

                  <div class="table-responsive">
                    <table class="table attendancesummaryreport">
                      <thead style="">
                        <tr>
                          <th scope="col">Date</th>
                          <th scope="col">CheckIn</th>
                          <th scope="col">CheckOut</th>
                          <th scope="col">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr
                          v-for="att_individual_report1 in att_individual_report"
                        >
                          <td>{{ att_individual_report1.ATTDate }}</td>
                          <td>{{ att_individual_report1.CheckIN }}</td>
                          <td>{{ att_individual_report1.CheckOut }}</td>
                          <td>{{ att_individual_report1.AttStatus }}</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </vue-html2pdf>
            <div class="modal-body" id="Individual_Employees_Attendance">
              <div class="table-responsive">
                <table class="" style="width: 100%">
                  <tr>
                    <td rows="2" style="width: 70%; font-size: bold">
                      <strong>Employee Code: </strong
                      >{{ att_individual_count.EmployeeCode }}
                    </td>
                    <td rows="2" style="width: 30%; font-size: bold">
                      <strong>Total Days: </strong
                      >{{ att_individual_count.totaldays }}
                    </td>
                  </tr>
                  <tr>
                    <td rows="2" style="width: 70%; font-size: bold">
                      <strong>Name: </strong>{{ att_individual_count.Name }}
                    </td>
                    <td rows="2" style="width: 30%; font-size: bold">
                      <strong>Present Days:</strong
                      >{{ att_individual_count.present }}
                    </td>
                  </tr>
                  <tr>
                    <td rows="2" style="width: 70%; font-size: bold">
                      <strong>Designation: </strong
                      >{{ att_individual_count.Designation }}
                    </td>
                    <td rows="2" style="width: 30%; font-size: bold">
                      <strong>Absent Days: </strong
                      >{{ att_individual_count.absent }}
                    </td>
                  </tr>
                  <tr>
                    <td rows="2" style="width: 70%; font-size: bold">
                      <strong>Department: </strong
                      >{{ att_individual_count.Department }}
                    </td>
                    <td rows="2" style="width: 30%; font-size: bold">
                      <strong>Leaves: </strong>{{ att_individual_count.leaves }}
                    </td>
                  </tr>
                  <tr>
                    <td rows="2" style="width: 70%; font-size: bold">
                      <strong>Location: </strong
                      >{{ att_individual_count.PostingCity }}
                    </td>
                    <td rows="2" style="width: 30%; font-size: bold">
                      <strong>Deduction: </strong>__
                    </td>
                  </tr>
                </table>
              </div>

              <div class="table-responsive">
                <table class="table attendancesummaryreport">
                  <thead style="">
                    <tr>
                      <th scope="col">Date</th>
                      <th scope="col">CheckIn</th>
                      <th scope="col">CheckOut</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="att_individual_report1 in att_individual_report">
                      <td>{{ att_individual_report1.ATTDate }}</td>
                      <td>{{ att_individual_report1.CheckIN }}</td>
                      <td>{{ att_individual_report1.CheckOut }}</td>
                      <td>{{ att_individual_report1.AttStatus }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                @click="
                  html_table_to_excel('xlsx', 'Individual_Employees_Attendance')
                "
                class="btn btn-gradient-info"
              >
                Excel
              </button>
              <button
                type="button"
                @click="generateReport()"
                class="btn btn-gradient-info"
              >
                Pdf
              </button>
              <button
                type="button"
                class="btn btn-gradient-primary"
                data-bs-dismiss="modal"
                @click="ind_attendance_re1()"
              >
                close
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import VueHtml2pdf from "vue-html2pdf";
export default {
  data() {
    return {
      user_access: {},
      session_name: "",
      lve_summary: "",
      lve_detail: "",
      att_sum: "",
      emp_detail: "",
      ind_emp_det: "",
      emp_hire: "",
      emp_appraisal: "",
      abs_summary: "",
      daily_att: "",
      test: "",
      ind_report: "",
      ind_report1: "",
      loan_report: "",
      ind_employee_report: "",
      session_payroll_report: "",
      att_department: "All",
      att_startingdate: "",
      att_closingdate: "",
      att_designation: "All",
      att_location: "All",
      att_emp_id: "All",

      att_report: {},
      attandance_summary: "",
      attandance_header: {},
      find_emp: {},
      locations: {},
      designations: {},
      departments: {},
      ind_emp_id: "",
      att_individual_report: {},
      att_individual_count: {},
      absent_to: "",
      absent_from: "",
      absent_detail: {},
      getemployee: {},
      emp_department: "All",
      emp_location: "All",
      emp_designation: "All",
      emp_emp_id: "All",
      emp_type: "All",
      emp_status: "All",
      hire_department: "All",
      hire_location: "All",
      hire_designation: "All",
      hire_emp_id: "All",
      hire_start_date: "",
      hire_end_date: "",
      gethireemplo: {},
      gethireemplocount: "",
      spinner: false,
      l_date_from: "",
      l_date_end: "",
      loan_employee_report: "",
      ind_payroll_report: "",
      session_wise_report: "",
      l_leave_type: "All",
      l_department: "All",
      l_location: "All",
      l_designation: "All",
      l_emp_id: "All",
      getleavedetail: {},
      leaves: {},
      getleavesummary: {},
      s_leave_type: "All",
      s_department: "All",
      s_location: "All",
      s_designation: "All",
      s_emp_id: "All",

      aatestArray: {},

      att_pay: "",
      att_payroll_detail: {},
      htmlToPdfOptions: {
        margin: 0,

        filename: `hehehe.pdf`,

        image: {
          type: "jpeg",
          quality: 0.98,
        },

        enableLinks: false,

        html2canvas: {
          scale: 1,
          useCORS: true,
        },

        jsPDF: {
          unit: "in",
          format: "a4",
          orientation: "portrait",
        },
      },
    };
  },
  components: {
    VueHtml2pdf,
  },
  methods: {
    generatesessionpayrollReport() {
      this.$refs.htmlsessionpayrollPdf.generatePdf();
    },
    empabsentpdfreport() {
      this.$refs.htmlempabsentPdf.generatePdf();
    },
    htmlemphirereport() {
      this.$refs.htmlemphirePdf.generatePdf();
    },
    generateReport() {
      this.$refs.html2Pdf.generatePdf();
    },
    generateLoanReport() {
      this.$refs.loan.generatePdf();
    },
    generateIndPayrollReport() {
      this.$refs.indpayroll.generatePdf();
    },
    generateSessionPayrollReport() {
      this.$refs.sessionpayroll.generatePdf();
    },
    generateReport1() {
      this.$refs.ind.generatePdf();
    },
    generatesessionReport() {
      this.$refs.htmlsessionEmpPdf.generatePdf();
    },

    generateempdetailReport() {
      this.$refs.htmlempdetailPdf.generatePdf();
    },
    generateleavedetailReport() {
      this.$refs.htmlleavedetailEmpPdf.generatePdf();
    },
    empleavesummary() {
      this.$refs.htmlleavesummaryEmpPdf.generatePdf();
    },

    generateoverallattreport() {
      this.$refs.htmloverallattPdf.generatePdf();
    },
    getemployeedetail() {
      axios
        .get(
          "./getemploydetail/" +
            this.emp_department +
            "/" +
            this.emp_location +
            "/" +
            this.emp_designation +
            "/" +
            this.emp_emp_id +
            "/" +
            this.emp_type +
            "/" +
            this.emp_status
        )
        .then((response) => {
          this.getemployee = response.data;
        });
    },
    view_report() {
      this.emp_detail = 1;
      this.getemployeedetail();
    },

    view_report1() {
      this.getemployee = {};
      this.emp_detail = "";
      this.emp_department = "All";
      this.emp_location = "All";
      this.emp_designation = "All";
      this.emp_emp_id = "All";
      this.emp_type = "All";
      this.emp_status = "All";
    },
    getleave_summary() {
      axios
        .get(
          "./filter_leaves1/" +
            this.s_department +
            "/" +
            this.s_location +
            "/" +
            this.s_designation +
            "/" +
            this.s_emp_id +
            "/" +
            this.s_leave_type
        )
        .then((response) => {
          this.getleavesummary = response.data;
          this.spinner = false;
        })
        .catch(() => {
          this.spinner = true;
        });
    },
    getleave_detail() {
      axios
        .get(
          "./getleaveemploy/" +
            this.l_department +
            "/" +
            this.l_location +
            "/" +
            this.l_designation +
            "/" +
            this.l_emp_id +
            "/" +
            this.l_date_from +
            "/" +
            this.l_date_end +
            "/" +
            this.l_leave_type
        )
        .then((response) => {
          this.getleavedetail = response.data;
          this.spinner = false;
        })
        .catch(() => {
          this.spinner = true;
        });
    },
    gethireemployee() {
      axios
        .get(
          "./gethireemploy/" +
            this.hire_department +
            "/" +
            this.hire_location +
            "/" +
            this.hire_designation +
            "/" +
            this.hire_emp_id +
            "/" +
            this.hire_start_date +
            "/" +
            this.hire_end_date
        )
        .then((response) => {
          this.gethireemplo = response.data;
          this.spinner = false;
        })
        .catch(() => {
          this.spinner = true;
        });
      axios
        .get(
          "./gethireemploycount/" +
            this.hire_department +
            "/" +
            this.hire_location +
            "/" +
            this.hire_designation +
            "/" +
            this.hire_emp_id +
            "/" +
            this.hire_start_date +
            "/" +
            this.hire_end_date
        )
        .then((response) => {
          this.gethireemplocount = response.data;
          this.spinner = false;
        })
        .catch(() => {
          this.spinner = true;
        });
    },
    employee_hire_report() {
      if (this.hire_start_date == "" && this.hire_end_date == "") {
        this.$toastr.e("Please Select From and End Date(s)", "Error!");
      } else {
        this.gethireemployee();
        this.emp_hire = 1;
      }
    },
    employee_hire_report1() {
      this.emp_hire = "";
      hire_department = "All";
      hire_location = "All";
      hire_designation = "All";
      hire_emp_id = "All";
      hire_start_date = "";
      hire_end_date = "";
      this.gethireemplo = {};
      gethireemplocount = "";
    },
    employee_appraisal_report() {
      this.emp_appraisal = 1;
    },
    employee_appraisal_report1() {
      this.emp_appraisal = "";
    },
    attendance_payroll() {
      this.att_pay = 1;
      this.getpayrollreport();
    },
    attendance_payroll1() {
      this.att_pay = "";
    },
    absent_summary() {
      this.abs_summary = 1;
      this.getabsentreport();
    },
    absent_summary1() {
      this.abs_summary = "";
      this.absent_to = "";
      this.absent_from = "";
      this.absent_detail = {};
    },
    daily_attendance() {
      if (this.att_startingdate == "" && this.att_closingdate == "") {
        this.$toastr.e("Please Select From and End Date(s)", "Error!");
      } else {
        this.daily_att = 1;
        this.getdailyattendancereport();
      }
    },
    daily_attendance1() {
      this.daily_att = "";
      this.att_department = "All";
      this.att_startingdate = "";
      this.att_closingdate = "";
      this.att_location = "All";
      this.att_designation = "All";
      this.att_emp_id = "All";
      this.att_report = {};
    },
    attendance_summary() {
      this.att_sum = 1;
      this.getattendance_summary();
    },
    session_summary() {
      this.session_payroll_report = 1;
      this.getattendance_summary();
    },
    attendance_summary1() {
      this.att_sum = "";
      this.attandance_summary = "";
    },
    session_summary1() {
      this.session_payroll_report = "";
      this.attandance_summary = "";
    },
    leave_detail_() {
      if (this.l_date_from == "" && this.l_date_end == "") {
        this.$toastr.e("Please Select From and End Date(s)", "Error!");
      } else {
        this.getleave_detail();
        this.lve_detail = 1;
      }
    },
    leave_detail_1() {
      this.lve_detail = "";
      this.l_date_from = "";
      this.l_date_end = "";
      this.l_leave_type = "All";
      this.l_department = "All";
      this.l_location = "All";
      this.l_designation = "All";
      this.l_emp_id = "All";
      this.getleavedetail = {};
    },
    leave_summary() {
      if (this.s_leave_type == "All") {
        this.$toastr.e("Please Select Leave Type First", "Error!");
      } else {
        this.getleave_summary();
        this.lve_summary = 1;
      }
    },
    leave_summary1() {
      this.lve_summary = "";
      this.getleavesummary = {};
      this.s_leave_type = "All";
      this.s_department = "All";
      this.s_location = "All";
      this.s_designation = "All";
      this.s_emp_id = "All";
    },

    getindattendance() {
      axios
        .get("./getindatt_count" + this.ind_emp_id)
        .then((response) => {
          this.att_individual_count = response.data;
        })
        .catch(() => {
          this.spinner = true;
        });

      axios
        .get("./getindatt_report/" + this.ind_emp_id)
        .then((response) => {
          this.att_individual_report = response.data;
        })
        .catch(() => {
          this.spinner = true;
        });
    },
    getindattendance_ind() {
      axios
        .get("./getindatt_count/" + this.loan_employee_report)
        .then((response) => {
          this.att_individual_count = response.data;
        })
        .catch(() => {
          this.spinner = true;
        });

      axios
        .get("./getindatt_report/" + this.loan_employee_report)
        .then((response) => {
          this.att_individual_report = response.data;
        })
        .catch(() => {
          this.spinner = true;
        });
    },
    // function ind report
    ind_attendance_re() {
      this.ind_report = 1;
      ind_emp_id: "";

      this.getindattendance();
    },
    individual_report_handler() {
      // alert("clicked")
      this.ind_report = 1;
      ind_employee_report: "";

      this.getindattendance_ind();
    },
    loan_report_handler() {
      // alert("clicked")
      this.loan_report = 1;
      loan_employee_report: "";

      this.getindattendance_ind();
    },
    ind_payroll_handler() {
      // alert("clicked")
      this.ind_employee_report = 1;
      loan_employee_report: "";

      this.getindattendance_ind();
    },
    session_payroll_handler() {
      // alert("clicked")
      this.session_payroll_report = 1;
      loan_employee_report: "";

      this.getindattendance_ind();
    },
    ind_attendance_re1() {
      this.ind_report = "";
      this.att_individual_report = {};
      this.att_individual_count = {};
    },
    ind_attendance_re2() {
      this.ind_report = "";
      this.att_individual_report = {};
      this.att_individual_count = {};
    },
    ind_loan_re2() {
      this.loan_report = "";
      this.att_individual_report = {};
      this.att_individual_count = {};
    },
    ind_payroll_re2() {
      this.ind_employee_report = "";
      this.att_individual_report = {};
      this.att_individual_count = {};
    },
    session_payroll_re2() {
      this.session_payroll_report = "";
      this.att_individual_report = {};
      this.att_individual_count = {};
    },

    test1() {
      this.test = 1;
    },

    getdailyattendancereport() {
      axios
        .get(
          "./getattendance_reportwssw/wssw" +
            this.att_department +
            "/" +
            this.att_location +
            "/" +
            this.att_designation +
            "/" +
            this.att_emp_id +
            "/" +
            this.att_startingdate +
            "/" +
            this.att_closingdate
        )
        .then((response) => {
          this.att_report = response.data;
          this.spinner = false;
        })
        .catch((error) => {
          this.spinner = true;
        });
    },
    getattendance_summary() {
      axios
        .get("./getattendance_summary/")
        .then((response) => {
          this.attandance_summary = response.data;
          this.spinner = false;
        })
        .catch((error) => {
          this.spinner = true;
        });

      axios
        .get("./get_column_name")
        .then((response) => {
          this.attandance_header = response.data;
          this.spinner = false;
        })
        .catch((error) => {
          this.spinner = true;
        });
    },
    getabsentreport() {
      axios
        .get("./get_absent_detail/" + this.absent_from + "/" + this.absent_to)
        .then((response) => {
          this.absent_detail = response.data;
          this.spinner = false;
        })
        .catch((error) => {
          this.spinner = true;
        });
    },

    getpayrollreport() {
      axios
        .get("./get_payroll_att_detail/")
        .then((response) => {
          this.att_payroll_detail = response.data;
          this.spinner = false;
        })
        .catch((error) => {
          this.spinner = true;
        });
    },
    html_table_to_excel(type, tableID) {
      var uri = "data:application/vnd.ms-excel;base64,",
        template =
          '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table border="1">{table}</table></body></html>',
        base64 = function (s) {
          return window.btoa(unescape(encodeURIComponent(s)));
        },
        format = function (s, c) {
          return s.replace(/{(\w+)}/g, function (m, p) {
            return c[p];
          });
        };

      var data = document.getElementById(tableID).innerHTML;

      var ctx = {
        worksheet: name || "",
        table: data,
      };
      var link = document.createElement("a");
      link.download = tableID + ".xls";
      link.href = uri + base64(format(template, ctx));
      link.click();
    },
  },
  mounted() {
    axios
      .get("overall_payroll_employees")
      .then((response) => {
        this.aatestArray = response.data;
        console.log("session payroll employes", response);
        this.spinner = false;
      })
      .catch((error) => {
        console.log("session payroll employess", error);
        this.spinner = true;
      });
    let pdfJS = document.createElement("script");
    pdfJS.setAttribute(
      "src",
      "https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"
    );
    document.head.appendChild(pdfJS);

    console.log("reports");
    axios
      .get("department_detail2")
      .then((data) => (this.departments = data.data))
      .catch(() => {
        this.spinner = true;
      });
    axios
      .get("overall_location")
      .then((response) => (this.locations = response.data))
      .catch(() => {
        this.spinner = true;
      });
    axios.get("overall_designation").then((response) => {
      this.designations = response.data;
    });

    //    axios.get('./proceeddistapproval')
    //                     .then(response => {
    //                         console.log("payroll finance",response);
    //                     })
    //                     .catch(error => console.log(error));
    axios
      .get("find_emp_id")
      .then((data) => {
        this.find_emp = data.data;
      })
      .catch(() => {
        this.spinner = true;
      });
    axios
      .get("overall_leaves")
      .then((response) => (this.leaves = response.data))
      .catch(() => {
        this.spinner = true;
      });

    axios.get("find_session").then((response) => {
      this.session_name = response.data;
    });
    axios
      .get("./fetch_user_hr_roles")
      .then((response) => (this.user_access = response.data))
      .catch(() => {
        this.spinner = true;
      });
  },
};
</script>
<style scoped>
.ng-star-inserted > a {
  cursor: pointer;
  border-bottom: 1px dashed #ccc;
  padding-top: 5px;
  padding-bottom: 5px;
  display: block;
  max-width: 250px;
  margin-left: 20px;
  color: #2485e8;
  text-decoration: none;
}
.mt-HeaderDialouge .table-responsive {
  height: calc(80vh - 100px);
  overflow-y: auto;
}
</style>
