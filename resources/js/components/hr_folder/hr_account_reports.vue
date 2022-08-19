<template>
    <div>
        <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper container-xxl p-0">
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
                  Account Reports
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
             
             
             
            <br />
            <br />
            <br />
          </div>
        </div>
        </div>
        </div>
        </div>
    </div>
</template>
<script>
    export default {

    }
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