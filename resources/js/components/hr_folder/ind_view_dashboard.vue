<template>
    <div>
        <div v-if="this.fetchempcode!='a'" class="app-content content ">
            <div class="row" style="margin-top:-20px">
                <div id="v-step-0" style="transform: none !important;margin-left:-10px " class="col-md-1"></div>
                <div class="col-md-1 v-step-1"></div>
                <div data-v-step="2" class="col-md-1" ></div>
                <div class="col-md-3"></div>
                <div class="col-md-2"></div>
                <div class="col-md-3"></div>
                <div data-v-step="3" class="col-md-1"></div>
            </div>
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0" style="margin-top:20px">
                <div class="content-header row">
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active">
                                Employee Dashboard
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="content-body">
                    <div class="row match-height">
                        <!-- Statistics Card -->
                        <div  class="col-xl-8 full_div col-md-6 col-12">
                            <div data-v-step="4" class="card card-statistics">
                                <div class="card-header ">
                                    <h4 class="card-title">Current Month Attendance</h4>
                                    <router-link data-v-step="5" to="/hr/team_leaves" class="role-edit-modal" style="text-decoration:none; color: #0d6efd; margin-left:35%;"> <small class="fw-bolder">Team Leaves</small></router-link>
                                    <router-link data-v-step="6" to="/hr/team_attendance" class="role-edit-modal" style="text-decoration:none;color: #0d6efd;"> <small class="fw-bolder">Team Attendance</small></router-link>
                                </div>
                                <div class="card-body statistics-body" style="padding-top: 5px !important; padding-bottom: 10px !important;">
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-info me-2">
                                                    <div class="avatar-content">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user avatar-icon">
                                                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                            <circle cx="12" cy="7" r="4"></circle>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{ct_att.totalDays}}</h4>
                                                    <p class="card-text font-small-3 mb-0">Total Days</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-primary me-2">
                                                    <div class="avatar-content">
                                                        <i class="fa-solid fa-check"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{ct_att.present}}</h4>
                                                    <p class="card-text font-small-3 mb-0">Present</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-danger me-2">
                                                    <div class="avatar-content">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{ct_att.absent}}</h4>
                                                    <p class="card-text font-small-3 mb-0">Absent</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 col-sm-6 col-12">
                                            <div class="d-flex flex-row">
                                                <div class="avatar bg-light-success me-2">
                                                    <div class="avatar-content">
                                                        <i class="fa-solid fa-litecoin-sign"></i>
                                                    </div>
                                                </div>
                                                <div class="my-auto">
                                                    <h4 class="fw-bolder mb-0">{{ct_att.late}}</h4>
                                                    <p class="card-text font-small-3 mb-0">Late</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Statistics Card -->
                        <!-- Medal Card -->
                        <div class="col-xl-4 col-md-6 col-12">
                            <div class="row match-height" >
                                <!-- Bar Chart - Orders -->
                                <div class="col-lg-6 col-md-3 col-6">
                                    <div class="card" data-v-step="7">
                                        <div class="card-body pb-50" style="position: relative;">
                                            <h6>
                                                Apply For
                                            </h6>
                                            <h3 class="fw-bolder mb-1" style="padding-bottom: 15px;">Leaves</h3>
                                            <a @click="fetch_emp_leave()" data-bs-toggle="modal" data-bs-target="#addNewCard" style="width:100%;" class="btn btn-primary waves-effect waves-float waves-light">Apply Now</a>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Bar Chart - Orders -->
                                <!-- Line Chart - Profit -->
                                <div class="col-lg-6 col-md-3 col-6">
                                    <div class="card card-tiny-line-stats" data-v-step="8">
                                        <div class="card-body pb-50" style="position: relative;">
                                            <h6>View Your</h6>
                                            <h3 class="fw-bolder mb-1" style="padding-bottom: 15px;">Profile</h3>
                                            <router-link style="width:100%;" to="/hr/emp_detail" class="btn btn-primary waves-effect waves-float waves-light">Click Here</router-link>
                                        </div>
                                    </div>
                                </div>
                                <!--/ Line Chart - Profit -->
                            </div>
                        </div>
                        <!--/ Medal Card -->
                    </div>
                    <div class="row match-height">
                        <div class="col-lg-4 col-md-4 col-12">
                            <div  class="card shadow-none border cursor-pointer">
                                <div class="card-body" >
                                    <div class="d-flex justify-content-between">
                                        <img src="public/app-assets/images/icons/annual.png" alt="google drive" height="38" />
                                        <a data-v-step="9" data-bs-toggle="modal" data-bs-target="#annual_leaves" class="role-edit-modal" style="text-decoration:none;color:#0d6efd"> <small class="fw-bolder">View Detail</small></a>
                                    </div>
                                    <div class="my-1">
                                        <h5>Annual Leaves</h5>
                                    </div>
                                    <div class="d-flex justify-content-between mb-50">
                                        <span class="text-truncate">{{leaves_dtl.ttl_annual - leaves_dtl.rem_annual}} Used</span>
                                        <small class="text-muted">Out of {{leaves_dtl.ttl_annual}}</small>
                                    </div>
                                    <b-progress :max="`${leaves_dtl.ttl_annual}`">
                                        <b-progress-bar :value="`${(leaves_dtl.ttl_annual - leaves_dtl.rem_annual)}`" :label="`${((1 - (leaves_dtl.rem_annual / leaves_dtl.ttl_annual)) * 100).toFixed(0)}%`"></b-progress-bar>
                                    </b-progress>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="card shadow-none border cursor-pointer">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <img src="public/app-assets/images/icons/fever.png" alt="google drive" height="38" />
                                        <a data-v-step="10" data-bs-toggle="modal" data-bs-target="#sick_leaves" class="role-edit-modal" style="text-decoration:none;color:#0d6efd"> <small class="fw-bolder">View Detail</small></a>
                                    </div>
                                    <div class="my-1">
                                        <h5>Sick Leaves</h5>
                                    </div>
                                    <div class="d-flex justify-content-between mb-50">
                                        <span class="text-truncate">{{leaves_dtl.ttl_sick - leaves_dtl.rem_sick}} Used</span>
                                        <small class="text-muted">Out of {{leaves_dtl.ttl_sick}}</small>
                                    </div>
                                    <b-progress :max="`${leaves_dtl.ttl_sick}`">
                                        <b-progress-bar :value="`${(leaves_dtl.ttl_sick - leaves_dtl.rem_sick)}`" :label="`${((1 - (leaves_dtl.rem_sick / leaves_dtl.ttl_sick)) * 100).toFixed(0)}%`"></b-progress-bar>
                                    </b-progress>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12">
                            <div class="card shadow-none border cursor-pointer">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <img src="public/app-assets/images/icons/casual.png" alt="google drive" height="38" />
                                        <a data-v-step="11" data-bs-toggle="modal" data-bs-target="#casual_leaves" class="role-edit-modal" style="text-decoration:none;color:#0d6efd"> <small class="fw-bolder">View Detail</small></a>
                                    </div>
                                    <div class="my-1">
                                        <h5>Casual Leaves</h5>
                                    </div>
                                    <div class="d-flex justify-content-between mb-50">
                                        <span class="text-truncate">{{leaves_dtl.ttl_casual - leaves_dtl.rem_casual}} Used</span>
                                        <small class="text-muted">Out of {{leaves_dtl.ttl_casual}}</small>
                                    </div>
                                    <b-progress :max="`${leaves_dtl.ttl_casual}`">
                                        <b-progress-bar :value="`${(leaves_dtl.ttl_casual - leaves_dtl.rem_casual)}`" :label="`${((1 - (leaves_dtl.rem_casual / leaves_dtl.ttl_casual)) * 100).toFixed(0)}%`"></b-progress-bar>
                                    </b-progress>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row match-height">
                        <!-- Company Table Card -->
                        <div class="col-lg-12 col-12">
                            <div class="card card-company-table">
                                <div class="card-body p-0">
                                    <div class="table-responsive" data-v-step="12">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Day</th>
                                                    <th>Check In</th>
                                                    <th>Check Out</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="attendance1 in attendance">
                                                    <td>{{attendance1.ATTDate}}</td>
                                                    <td>Monday</td>
                                                    <td>{{attendance1.CheckIN.substring(0,5)}}</td>
                                                    <td>{{attendance1.CheckOut.substring(0,5)}}</td>
                                                    <td>On Time</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Company Table Card -->
                        <!-- Developer Meetup Card -->
                        <div class="col-lg-4 col-md-6 col-12">
                        </div>
                        <!--/ Developer Meetup Card -->
                    </div>
                   
                </div>
            </div>
             <div class="row" >
                    <div data-v-step="13" class="col-md-2"></div>
                    <div class="col-md-10"></div>
                    </div>
        </div>
        <div v-else class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                    <div class=" breadcrumb-wrapper">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Dashboard</h2>
                        </div>
                    </div>
                </div>
                <!-- Main content body-->
                <div class="content-body">
                    <!--/ Edit User Modal -->
                    <div class="row match-height">
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <h2 class="fw-bolder mb-0">2000</h2>
                                        <p class="card-text">Total Companies</p>
                                    </div>
                                    <div class="avatar bg-light-danger p-50 m-0">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user avatar-icon">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <h2 class="fw-bolder mb-0">400</h2>
                                        <p class="card-text">Active</p>
                                    </div>
                                    <div class="avatar bg-light-primary me-2">
                                        <div class="avatar-content">
                                            <i class="fa-solid fa-check"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <h2 class="fw-bolder mb-0">7</h2>
                                        <p class="card-text">Suspended</p>
                                    </div>
                                    <div class="avatar bg-light-danger p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="alert-octagon" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        <h2 class="fw-bolder mb-0">2.38k</h2>
                                        <p class="card-text">Earnings</p>
                                    </div>
                                    <div class="avatar bg-light-danger p-50 m-0">
                                        <div class="avatar-content">
                                            <i data-feather="activity" class="font-medium-5"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row match-height">
                        <!-- Sales Line Chart Card -->
                        <div class="col-8">
                            <div class="card" style="height: 400px">
                                <div class="card-header align-items-start">
                                    <div>
                                        <h4 class="card-title mb-25">Sales</h4>
                                        <p class="card-text mb-0">2022 Total Sales: 12.84k</p>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings font-medium-3 text-muted cursor-pointer">
                                        <circle cx="12" cy="12" r="3"></circle>
                                        <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                                    </svg>
                                </div>
                                <div class="card-body pb-0" style="position: relative;">
                                    <div id="sales-line-chart" style="min-height: 255px;">
                                        <div id="apexchartsprawomrai" class="apexcharts-canvas apexchartsprawomrai apexcharts-theme-light" style="width: 674px; height: 240px;"><svg id="SvgjsSvg2046" width="674" height="240" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(-10, 0)" style="background: transparent;">
                                                <g id="SvgjsG2048" class="apexcharts-inner apexcharts-graphical" transform="translate(57.60058403015137, 10)">
                                                    <defs id="SvgjsDefs2047">
                                                        <clipPath id="gridRectMaskprawomrai">
                                                            <rect id="SvgjsRect2054" width="601.2350635528564" height="190.0296284866333" x="-4" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <clipPath id="gridRectMarkerMaskprawomrai">
                                                            <rect id="SvgjsRect2055" width="597.2350635528564" height="190.0296284866333" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                                                        </clipPath>
                                                        <linearGradient id="SvgjsLinearGradient2060" x1="0" y1="1" x2="1" y2="1">
                                                            <stop id="SvgjsStop2061" stop-opacity="1" stop-color="rgba(223,135,242,1)" offset="0"></stop>
                                                            <stop id="SvgjsStop2062" stop-opacity="1" stop-color="rgba(115,103,240,1)" offset="1"></stop>
                                                            <stop id="SvgjsStop2063" stop-opacity="1" stop-color="rgba(115,103,240,1)" offset="1"></stop>
                                                            <stop id="SvgjsStop2064" stop-opacity="1" stop-color="rgba(223,135,242,1)" offset="1"></stop>
                                                        </linearGradient>
                                                        <filter id="SvgjsFilter2066" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%">
                                                            <feFlood id="SvgjsFeFlood2067" flood-color="#000000" flood-opacity="0.2" result="SvgjsFeFlood2067Out" in="SourceGraphic"></feFlood>
                                                            <feComposite id="SvgjsFeComposite2068" in="SvgjsFeFlood2067Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite2068Out"></feComposite>
                                                            <feOffset id="SvgjsFeOffset2069" dx="2" dy="18" result="SvgjsFeOffset2069Out" in="SvgjsFeComposite2068Out"></feOffset>
                                                            <feGaussianBlur id="SvgjsFeGaussianBlur2070" stdDeviation="5 " result="SvgjsFeGaussianBlur2070Out" in="SvgjsFeOffset2069Out"></feGaussianBlur>
                                                            <feMerge id="SvgjsFeMerge2071" result="SvgjsFeMerge2071Out" in="SourceGraphic">
                                                                <feMergeNode id="SvgjsFeMergeNode2072" in="SvgjsFeGaussianBlur2070Out"></feMergeNode>
                                                                <feMergeNode id="SvgjsFeMergeNode2073" in="[object Arguments]"></feMergeNode>
                                                            </feMerge>
                                                            <feBlend id="SvgjsFeBlend2074" in="SourceGraphic" in2="SvgjsFeMerge2071Out" mode="normal" result="SvgjsFeBlend2074Out"></feBlend>
                                                        </filter>
                                                    </defs>
                                                    <line id="SvgjsLine2053" x1="0" y1="0" x2="0" y2="186.0296284866333" stroke="#b6b6b6" stroke-dasharray="3" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="186.0296284866333" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                                                    <g id="SvgjsG2075" class="apexcharts-xaxis" transform="translate(0, 0)">
                                                        <g id="SvgjsG2076" class="apexcharts-xaxis-texts-g" transform="translate(0, 1)"><text id="SvgjsText2078" font-family="Helvetica, Arial, sans-serif" x="0" y="220.0296284866333" text-anchor="middle" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan2079">Jan</tspan>
                                                                <title>Jan</title>
                                                            </text><text id="SvgjsText2081" font-family="Helvetica, Arial, sans-serif" x="53.930460322986946" y="220.0296284866333" text-anchor="middle" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan2082">Feb</tspan>
                                                                <title>Feb</title>
                                                            </text><text id="SvgjsText2084" font-family="Helvetica, Arial, sans-serif" x="107.86092064597389" y="220.0296284866333" text-anchor="middle" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan2085">Mar</tspan>
                                                                <title>Mar</title>
                                                            </text><text id="SvgjsText2087" font-family="Helvetica, Arial, sans-serif" x="161.79138096896085" y="220.0296284866333" text-anchor="middle" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan2088">Apr</tspan>
                                                                <title>Apr</title>
                                                            </text><text id="SvgjsText2090" font-family="Helvetica, Arial, sans-serif" x="215.7218412919478" y="220.0296284866333" text-anchor="middle" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan2091">May</tspan>
                                                                <title>May</title>
                                                            </text><text id="SvgjsText2093" font-family="Helvetica, Arial, sans-serif" x="269.65230161493474" y="220.0296284866333" text-anchor="middle" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan2094">Jun</tspan>
                                                                <title>Jun</title>
                                                            </text><text id="SvgjsText2096" font-family="Helvetica, Arial, sans-serif" x="323.5827619379217" y="220.0296284866333" text-anchor="middle" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan2097">July</tspan>
                                                                <title>July</title>
                                                            </text><text id="SvgjsText2099" font-family="Helvetica, Arial, sans-serif" x="377.51322226090866" y="220.0296284866333" text-anchor="middle" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan2100">Aug</tspan>
                                                                <title>Aug</title>
                                                            </text><text id="SvgjsText2102" font-family="Helvetica, Arial, sans-serif" x="431.4436825838956" y="220.0296284866333" text-anchor="middle" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan2103">Sep</tspan>
                                                                <title>Sep</title>
                                                            </text><text id="SvgjsText2105" font-family="Helvetica, Arial, sans-serif" x="485.3741429068826" y="220.0296284866333" text-anchor="middle" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan2106">Oct</tspan>
                                                                <title>Oct</title>
                                                            </text><text id="SvgjsText2108" font-family="Helvetica, Arial, sans-serif" x="539.3046032298696" y="220.0296284866333" text-anchor="middle" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan2109">Nov</tspan>
                                                                <title>Nov</title>
                                                            </text><text id="SvgjsText2111" font-family="Helvetica, Arial, sans-serif" x="593.2350635528566" y="220.0296284866333" text-anchor="middle" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                                <tspan id="SvgjsTspan2112">Dec</tspan>
                                                                <title>Dec</title>
                                                            </text></g>
                                                    </g>
                                                    <g id="SvgjsG2127" class="apexcharts-grid">
                                                        <g id="SvgjsG2128" class="apexcharts-gridlines-horizontal">
                                                            <line id="SvgjsLine2130" x1="0" y1="0" x2="593.2350635528564" y2="0" stroke="#ebe9f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine2131" x1="0" y1="37.20592569732666" x2="593.2350635528564" y2="37.20592569732666" stroke="#ebe9f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine2132" x1="0" y1="74.41185139465333" x2="593.2350635528564" y2="74.41185139465333" stroke="#ebe9f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine2133" x1="0" y1="111.61777709197999" x2="593.2350635528564" y2="111.61777709197999" stroke="#ebe9f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine2134" x1="0" y1="148.82370278930665" x2="593.2350635528564" y2="148.82370278930665" stroke="#ebe9f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                            <line id="SvgjsLine2135" x1="0" y1="186.02962848663333" x2="593.2350635528564" y2="186.02962848663333" stroke="#ebe9f1" stroke-dasharray="0" class="apexcharts-gridline"></line>
                                                        </g>
                                                        <g id="SvgjsG2129" class="apexcharts-gridlines-vertical"></g>
                                                        <line id="SvgjsLine2137" x1="0" y1="186.0296284866333" x2="593.2350635528564" y2="186.0296284866333" stroke="transparent" stroke-dasharray="0"></line>
                                                        <line id="SvgjsLine2136" x1="0" y1="1" x2="0" y2="186.0296284866333" stroke="transparent" stroke-dasharray="0"></line>
                                                    </g>
                                                    <g id="SvgjsG2056" class="apexcharts-line-series apexcharts-plot-series">
                                                        <g id="SvgjsG2057" class="apexcharts-series" seriesName="Sales" data:longestSeries="true" rel="1" data:realIndex="0">
                                                            <path id="SvgjsPath2065" d="M 0 156.26488792877197C 18.87566111304543 156.26488792877197 35.05479920994152 126.50014737091064 53.93046032298695 126.50014737091064C 72.80612143603238 126.50014737091064 88.98525953292847 148.82370278930665 107.8609206459739 148.82370278930665C 126.73658175901933 148.82370278930665 142.91571985591543 107.89718452224733 161.79138096896085 107.89718452224733C 180.66704208200628 107.89718452224733 196.8461801789024 141.3825176498413 215.7218412919478 141.3825176498413C 234.59750240499324 141.3825176498413 250.77664050188932 40.92651826705932 269.65230161493474 40.92651826705932C 288.5279627279802 40.92651826705932 304.70710082487625 167.42666563796996 323.5827619379217 167.42666563796996C 342.45842305096716 167.42666563796996 358.6375611478632 70.69125882492065 377.51322226090866 70.69125882492065C 396.3888833739541 70.69125882492065 412.56802147085017 107.89718452224733 431.4436825838956 107.89718452224733C 450.319343696941 107.89718452224733 466.49848179383713 33.485333127594004 485.3741429068825 33.485333127594004C 504.249804019928 33.485333127594004 520.428942116824 81.85303653411864 539.3046032298695 81.85303653411864C 558.1802643429149 81.85303653411864 574.359402439811 40.92651826705932 593.2350635528564 40.92651826705932" fill="none" fill-opacity="1" stroke="url(#SvgjsLinearGradient2060)" stroke-opacity="1" stroke-linecap="butt" stroke-width="4" stroke-dasharray="0" class="apexcharts-line" index="0" clip-path="url(#gridRectMaskprawomrai)" filter="url(#SvgjsFilter2066)" pathTo="M 0 156.26488792877197C 18.87566111304543 156.26488792877197 35.05479920994152 126.50014737091064 53.93046032298695 126.50014737091064C 72.80612143603238 126.50014737091064 88.98525953292847 148.82370278930665 107.8609206459739 148.82370278930665C 126.73658175901933 148.82370278930665 142.91571985591543 107.89718452224733 161.79138096896085 107.89718452224733C 180.66704208200628 107.89718452224733 196.8461801789024 141.3825176498413 215.7218412919478 141.3825176498413C 234.59750240499324 141.3825176498413 250.77664050188932 40.92651826705932 269.65230161493474 40.92651826705932C 288.5279627279802 40.92651826705932 304.70710082487625 167.42666563796996 323.5827619379217 167.42666563796996C 342.45842305096716 167.42666563796996 358.6375611478632 70.69125882492065 377.51322226090866 70.69125882492065C 396.3888833739541 70.69125882492065 412.56802147085017 107.89718452224733 431.4436825838956 107.89718452224733C 450.319343696941 107.89718452224733 466.49848179383713 33.485333127594004 485.3741429068825 33.485333127594004C 504.249804019928 33.485333127594004 520.428942116824 81.85303653411864 539.3046032298695 81.85303653411864C 558.1802643429149 81.85303653411864 574.359402439811 40.92651826705932 593.2350635528564 40.92651826705932" pathFrom="M -1 260.4414798812866L -1 260.4414798812866L 53.93046032298695 260.4414798812866L 107.8609206459739 260.4414798812866L 161.79138096896085 260.4414798812866L 215.7218412919478 260.4414798812866L 269.65230161493474 260.4414798812866L 323.5827619379217 260.4414798812866L 377.51322226090866 260.4414798812866L 431.4436825838956 260.4414798812866L 485.3741429068825 260.4414798812866L 539.3046032298695 260.4414798812866L 593.2350635528564 260.4414798812866"></path>
                                                            <g id="SvgjsG2058" class="apexcharts-series-markers-wrap" data:realIndex="0">
                                                                <g class="apexcharts-series-markers">
                                                                    <circle id="SvgjsCircle2143" r="0" cx="0" cy="0" class="apexcharts-marker wm6hvs4wn no-pointer-events" stroke="#ffffff" fill="#df87f2" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle>
                                                                </g>
                                                            </g>
                                                        </g>
                                                        <g id="SvgjsG2059" class="apexcharts-datalabels" data:realIndex="0"></g>
                                                    </g>
                                                    <line id="SvgjsLine2138" x1="0" y1="0" x2="593.2350635528564" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line>
                                                    <line id="SvgjsLine2139" x1="0" y1="0" x2="593.2350635528564" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line>
                                                    <g id="SvgjsG2140" class="apexcharts-yaxis-annotations"></g>
                                                    <g id="SvgjsG2141" class="apexcharts-xaxis-annotations"></g>
                                                    <g id="SvgjsG2142" class="apexcharts-point-annotations"></g>
                                                </g>
                                                <rect id="SvgjsRect2052" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                                                <g id="SvgjsG2113" class="apexcharts-yaxis" rel="0" transform="translate(19.600584030151367, 0)">
                                                    <g id="SvgjsG2114" class="apexcharts-yaxis-texts-g"><text id="SvgjsText2115" font-family="Helvetica, Arial, sans-serif" x="20" y="11.5" text-anchor="end" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan2116">350</tspan>
                                                        </text><text id="SvgjsText2117" font-family="Helvetica, Arial, sans-serif" x="20" y="48.70592569732666" text-anchor="end" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan2118">300</tspan>
                                                        </text><text id="SvgjsText2119" font-family="Helvetica, Arial, sans-serif" x="20" y="85.91185139465333" text-anchor="end" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan2120">250</tspan>
                                                        </text><text id="SvgjsText2121" font-family="Helvetica, Arial, sans-serif" x="20" y="123.11777709197999" text-anchor="end" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan2122">200</tspan>
                                                        </text><text id="SvgjsText2123" font-family="Helvetica, Arial, sans-serif" x="20" y="160.32370278930665" text-anchor="end" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan2124">150</tspan>
                                                        </text><text id="SvgjsText2125" font-family="Helvetica, Arial, sans-serif" x="20" y="197.52962848663333" text-anchor="end" dominant-baseline="auto" font-size="0.857rem" font-weight="400" fill="#b9b9c3" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                                                            <tspan id="SvgjsTspan2126">100</tspan>
                                                        </text></g>
                                                </g>
                                                <g id="SvgjsG2049" class="apexcharts-annotations"></g>
                                            </svg>
                                            <div class="apexcharts-legend" style="max-height: 120px;"></div>
                                            <div class="apexcharts-tooltip apexcharts-theme-light">
                                                <div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(223, 135, 242);"></span>
                                                    <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                                                        <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label"></span><span class="apexcharts-tooltip-text-value"></span></div>
                                                        <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light">
                                                <div class="apexcharts-xaxistooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                                            </div>
                                            <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                                                <div class="apexcharts-yaxistooltip-text"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="resize-triggers">
                                        <div class="expand-trigger">
                                            <div style="width: 717px; height: 256px;"></div>
                                        </div>
                                        <div class="contract-trigger"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sales Line Chart Card -->
                        <!-- Product Order Card -->
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <h4 class="card-title">Product Orders</h4>
                                    <div class="dropdown chart-dropdown">
                                        <button class="btn btn-sm border-0 dropdown-toggle px-50" type="button" id="dropdownItem2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Last 7 Days
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownItem2">
                                            <a class="dropdown-item" href="#">Last 28 Days</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                            <a class="dropdown-item" href="#">Last Year</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="product-order-chart"></div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="d-flex align-items-center">
                                            <i data-feather="circle" class="font-medium-1 text-primary"></i>
                                            <span class="fw-bold ms-75">Finished</span>
                                        </div>
                                        <span>23043</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <div class="d-flex align-items-center">
                                            <i data-feather="circle" class="font-medium-1 text-warning"></i>
                                            <span class="fw-bold ms-75">Pending</span>
                                        </div>
                                        <span>14658</span>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <i data-feather="circle" class="font-medium-1 text-danger"></i>
                                            <span class="fw-bold ms-75">Rejected</span>
                                        </div>
                                        <span>4758</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Product Order Card -->
                    </div>
                    <div class="row match-height">
                        <!-- Plan Card -->
                        <div class="col-4">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                    </div>
                                    <ul class="ps-1 mb-2">
                                        <li class="mb-50">50 Users</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center fw-bolder mb-50">
                                        <span>Users</span>
                                        <span>4 of 50 Used</span>
                                    </div>
                                    <div class="progress mb-50" style="height: 8px">
                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="65" aria-valuemax="100" aria-valuemin="80"></div>
                                    </div>
                                    <span>4 are active</span>
                                    <div class="d-grid w-100 mt-2">
                                        <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">
                                            Total Users
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Plan Card -->
                        <!-- Plan Card -->
                        <div class="col-4">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                    </div>
                                    <ul class="ps-1 mb-2">
                                        <li class="mb-50">10 Modules</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center fw-bolder mb-50">
                                        <span>Modules</span>
                                        <span>4 of 10 Used</span>
                                    </div>
                                    <div class="progress mb-50" style="height: 8px">
                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="65" aria-valuemax="100" aria-valuemin="80"></div>
                                    </div>
                                    <span>4 are active</span>
                                    <div class="d-grid w-100 mt-2">
                                        <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">
                                            Total Modules
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Plan Card -->
                        <!-- Plan Card -->
                        <div class="col-4">
                            <div class="card border-primary">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-start">
                                    </div>
                                    <ul class="ps-1 mb-2">
                                        <li class="mb-50">30 Companies</li>
                                    </ul>
                                    <div class="d-flex justify-content-between align-items-center fw-bolder mb-50">
                                        <span>Companies</span>
                                        <span>10 of 30</span>
                                    </div>
                                    <div class="progress mb-50" style="height: 8px">
                                        <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="65" aria-valuemax="100" aria-valuemin="80"></div>
                                    </div>
                                    <span>10 are active</span>
                                    <div class="d-grid w-100 mt-2">
                                        <button class="btn btn-primary" data-bs-target="#upgradePlanModal" data-bs-toggle="modal">
                                            Total Companies
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /Plan Card -->
                    </div>
                    <div class="row match-height">
                        <!-- Company Table Card -->
                        <div class="col-lg-8 col-12">
                            <div class="card card-company-table">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Company</th>
                                                    <th>Category</th>
                                                    <th>Views</th>
                                                    <th>Revenue</th>
                                                    <th>Sales</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="public/app-assets/images/icons/toolbox.svg" alt="Toolbar svg" />
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Dixons</div>
                                                                <div class="font-small-2 text-muted">meguc@ruj.io</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-light-primary me-1">
                                                                <div class="avatar-content">
                                                                    <i data-feather="monitor" class="font-medium-3"></i>
                                                                </div>
                                                            </div>
                                                            <span>Technology</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-bolder mb-25">23.4k</span>
                                                            <span class="font-small-2 text-muted">in 24 hours</span>
                                                        </div>
                                                    </td>
                                                    <td>$891.2</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="fw-bolder me-1">68%</span>
                                                            <i data-feather="trending-down" class="text-danger font-medium-1"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="public/app-assets/images/icons/parachute.svg" alt="Parachute svg" />
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Motels</div>
                                                                <div class="font-small-2 text-muted">vecav@hodzi.co.uk</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-light-success me-1">
                                                                <div class="avatar-content">
                                                                    <i data-feather="coffee" class="font-medium-3"></i>
                                                                </div>
                                                            </div>
                                                            <span>Grocery</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-bolder mb-25">78k</span>
                                                            <span class="font-small-2 text-muted">in 2 days</span>
                                                        </div>
                                                    </td>
                                                    <td>$668.51</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="fw-bolder me-1">97%</span>
                                                            <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="public/app-assets/images/icons/brush.svg" alt="Brush svg" />
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Zipcar</div>
                                                                <div class="font-small-2 text-muted">davcilse@is.gov</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-light-warning me-1">
                                                                <div class="avatar-content">
                                                                    <i data-feather="watch" class="font-medium-3"></i>
                                                                </div>
                                                            </div>
                                                            <span>Fashion</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-bolder mb-25">162</span>
                                                            <span class="font-small-2 text-muted">in 5 days</span>
                                                        </div>
                                                    </td>
                                                    <td>$522.29</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="fw-bolder me-1">62%</span>
                                                            <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="public/app-assets/images/icons/star.svg" alt="Star svg" />
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Owning</div>
                                                                <div class="font-small-2 text-muted">us@cuhil.gov</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-light-primary me-1">
                                                                <div class="avatar-content">
                                                                    <i data-feather="monitor" class="font-medium-3"></i>
                                                                </div>
                                                            </div>
                                                            <span>Technology</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-bolder mb-25">214</span>
                                                            <span class="font-small-2 text-muted">in 24 hours</span>
                                                        </div>
                                                    </td>
                                                    <td>$291.01</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="fw-bolder me-1">88%</span>
                                                            <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="public/app-assets/images/icons/book.svg" alt="Book svg" />
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Cafés</div>
                                                                <div class="font-small-2 text-muted">pudais@jife.com</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-light-success me-1">
                                                                <div class="avatar-content">
                                                                    <i data-feather="coffee" class="font-medium-3"></i>
                                                                </div>
                                                            </div>
                                                            <span>Grocery</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-bolder mb-25">208</span>
                                                            <span class="font-small-2 text-muted">in 1 week</span>
                                                        </div>
                                                    </td>
                                                    <td>$783.93</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="fw-bolder me-1">16%</span>
                                                            <i data-feather="trending-down" class="text-danger font-medium-1"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="public/app-assets/images/icons/rocket.svg" alt="Rocket svg" />
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Kmart</div>
                                                                <div class="font-small-2 text-muted">bipri@cawiw.com</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-light-warning me-1">
                                                                <div class="avatar-content">
                                                                    <i data-feather="watch" class="font-medium-3"></i>
                                                                </div>
                                                            </div>
                                                            <span>Fashion</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-bolder mb-25">990</span>
                                                            <span class="font-small-2 text-muted">in 1 month</span>
                                                        </div>
                                                    </td>
                                                    <td>$780.05</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="fw-bolder me-1">78%</span>
                                                            <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="public/app-assets/images/icons/speaker.svg" alt="Speaker svg" />
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Payers</div>
                                                                <div class="font-small-2 text-muted">luk@izug.io</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar bg-light-warning me-1">
                                                                <div class="avatar-content">
                                                                    <i data-feather="watch" class="font-medium-3"></i>
                                                                </div>
                                                            </div>
                                                            <span>Fashion</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-nowrap">
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-bolder mb-25">12.9k</span>
                                                            <span class="font-small-2 text-muted">in 12 hours</span>
                                                        </div>
                                                    </td>
                                                    <td>$531.49</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <span class="fw-bolder me-1">42%</span>
                                                            <i data-feather="trending-up" class="text-success font-medium-1"></i>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Company Table Card -->
                        <!-- Transaction Card -->
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card card-transaction">
                                <div class="card-header">
                                    <h4 class="card-title">Summary</h4>
                                    <div class="dropdown chart-dropdown">
                                        <i data-feather="more-vertical" class="font-medium-3 cursor-pointer" data-bs-toggle="dropdown"></i>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Last 28 Days</a>
                                            <a class="dropdown-item" href="#">Last Month</a>
                                            <a class="dropdown-item" href="#">Last Year</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="transaction-item">
                                        <div class="d-flex">
                                            <div class="avatar bg-light-primary rounded float-start">
                                                <div class="avatar-content">
                                                    <i data-feather="pocket" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="transaction-percentage">
                                                <h6 class="transaction-title">Hr-Module</h6>
                                                <small>Total-Users</small>
                                            </div>
                                        </div>
                                        <div class="fw-bolder text-danger">74</div>
                                    </div>
                                    <div class="transaction-item">
                                        <div class="d-flex">
                                            <div class="avatar bg-light-success rounded float-start">
                                                <div class="avatar-content">
                                                    <i data-feather="check" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="transaction-percentage">
                                                <h6 class="transaction-title">Recruitment Module</h6>
                                                <small>Total-Users</small>
                                            </div>
                                        </div>
                                        <div class="fw-bolder text-success">40</div>
                                    </div>
                                    <div class="transaction-item">
                                        <div class="d-flex">
                                            <div class="avatar bg-light-danger rounded float-start">
                                                <div class="avatar-content">
                                                    <i data-feather="dollar-sign" class="avatar-icon font-medium-3"></i>
                                                </div>
                                            </div>
                                            <div class="transaction-percentage">
                                                <h6 class="transaction-title">Payroll Module</h6>
                                                <small>Total-Users</small>
                                            </div>
                                        </div>
                                        <div class="fw-bolder text-success">10</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Transaction Card -->
                    </div>
                </div>
            </div>
        </div>
        <!-- View annual leave modal -->
        <div class="modal fade" id="annual_leaves" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">Your Annual Leave Detail</h1>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Leave Type</th>
                                        <th>Reason</th>
                                        <th>Applied by</th>
                                        <th>Manager status</th>
                                        <th>HR status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="this_m_lvs1 in this_m_lvs" v-if="this_m_lvs1.Leavetype=='Annual Leave'">
                                        <td>22-05-2022</td>
                                        <td>{{this_m_lvs1.Leavetype}}</td>
                                        <td>{{this_m_lvs1.Reason}}</td>
                                        <td>{{this_m_lvs1.AppliedBy}}</td>
                                        <td v-if="this_m_lvs1.ManagerApproval=='1'">Approved</td>
                                        <td v-else>Not Approved</td>
                                        <td v-if="this_m_lvs1.HRApproval=='1'">Approved</td>
                                        <td v-else>Not Approved</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ View annual leave modal -->
        <!-- View Sick leave modal -->
        <div class="modal fade" id="sick_leaves" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">Your Annual Leave Detail</h1>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Leave Type</th>
                                        <th>Reason</th>
                                        <th>Applied by</th>
                                        <th>Manager status</th>
                                        <th>HR status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="this_m_lvs1 in this_m_lvs" v-if="this_m_lvs1.Leavetype=='Sick Leave'">
                                        <td>22-05-2022</td>
                                        <td>{{this_m_lvs1.Leavetype}}</td>
                                        <td>{{this_m_lvs1.Reason}}</td>
                                        <td>{{this_m_lvs1.AppliedBy}}</td>
                                        <td v-if="this_m_lvs1.ManagerApproval=='1'">Approved</td>
                                        <td v-else>Not Approved</td>
                                        <td v-if="this_m_lvs1.HRApproval=='1'">Approved</td>
                                        <td v-else>Not Approved</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ View sick leave modal -->
        <!-- View Casual leave modal -->
        <div class="modal fade" id="casual_leaves" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-5 px-sm-5 pt-50">
                        <div class="text-center mb-2">
                            <h1 class="mb-1">Your Annual Leave Detail</h1>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Leave Type</th>
                                        <th>Reason</th>
                                        <th>Applied by</th>
                                        <th>Manager status</th>
                                        <th>HR status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="this_m_lvs1 in this_m_lvs" v-if="this_m_lvs1.Leavetype=='Casual Leave'">
                                        <td>22-05-2022</td>
                                        <td>{{this_m_lvs1.Leavetype}}</td>
                                        <td>{{this_m_lvs1.Reason}}</td>
                                        <td>{{this_m_lvs1.AppliedBy}}</td>
                                        <td v-if="this_m_lvs1.ManagerApproval=='1'">Approved</td>
                                        <td v-else>Not Approved</td>
                                        <td v-if="this_m_lvs1.HRApproval=='1'">Approved</td>
                                        <td v-else>Not Approved</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ View Casual leave modal -->
        <!-- Apply for leave modal  -->
        <div class="modal fade" id="addNewCard" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-transparent">
                        <h3 class="text-center mb-1" id="addNewCardTitle">Apply For Leave</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-sm-5 mx-50 pb-5">
                        <!-- form -->
                        <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">
                            <div class="col-12">
                                <table class="table" v-if="this.isLvEmpty != 'Empty'">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Granted</th>
                                            <th>Used</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="leavesblnc1 in leavesblnc">
                                            <td>{{leavesblnc1.LeaveType}}</td>
                                            <td>{{leavesblnc1.TotalLeave}}</td>
                                            <td>{{leavesblnc1.TotalLeave - leavesblnc1.RemainingLeave}}</td>
                                            <td>{{leavesblnc1.RemainingLeave}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <label class="form-label" for="modalAddCardNumber">Leave Type</label>
                                <select v-model="type" class="form-control">
                                    <option value="">Select Type</option>
                                    <option value="Annual">Annual</option>
                                    <option value="Casual">Casual</option>
                                    <option value="Sick">Sick</option>
                                    <option value="CPL">CPL</option>
                                </select>
                                <span style="color: #DB4437; font-size: 11px;" v-if="type==''">{{type_error}}</span>
                            </div>
                            <div class="col-12 col-sm-12 mb-1">
                                <label class="form-label" for="basicSelect">Select Duration Type</label>
                                <div class="row demo-inline-spacing" style="padding-left: 5%;">
                                    <div class="col-md-5 form-check form-check-inline" style="margin-top:0px">
                                        <input class="form-check-input" type="radio" v-model="days" name="inlineRadioOptions" id="inlineRadio1" value="One Day" checked="">
                                        <label class="form-check-label" for="inlineRadio1">One Day</label>
                                    </div>
                                    <div class=" col-md-5 form-check form-check-inline" style="margin-top:0px">
                                        <input class="form-check-input" type="radio" v-model="days" name="inlineRadioOptions" id="inlineRadio2" value="Multiple Days">
                                        <label class="form-check-label" for="inlineRadio2">Multiple Days</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-02">
                                <label class="form-label" for="modalAddCardName">Date</label>
                                <label class="form-label" v-if="this.days=='Multiple Days'" for="modalAddCardName"> From</label>
                                <input type="date" v-model="d_from" id="modalAddCardName" class="form-control" />
                                <span style="color: #DB4437; font-size: 11px;" v-if="d_from==''">{{d_from_error}}</span>
                            </div>
                            <div class="col-md-02" v-if="this.days=='Multiple Days'">
                                <label class="form-label" for="modalAddCardName">Date To</label>
                                <input type="date" v-model="d_to" id="modalAddCardName" class="form-control" />
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="modalAddCardName">Reason</label>
                                <input type="text" v-model="reason" id="modalAddCardName" class="form-control" placeholder="Reason of leave" />
                                <span style="color: #DB4437; font-size: 11px;" v-if="reason==''">{{reason_error}}</span>
                            </div>
                            <div class="col-12 text-center" style="margin-top:6%">
                                <button type="submit" :disabled="disabled" @click="delay()" class="btn btn-primary me-1 mt-1" data-bs-dismiss="modal" aria-label="Close">Submit</button>
                                <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Apply for leave modal  -->
        <v-tour name="myTour" :steps="steps"></v-tour>
    </div>
</template>
<script>
export default {
    name: 'my-tour',
    data: function() {
        return {
            steps: [{
                    target: '#v-step-0', // We're using document.querySelector() under the hood
                    header: {
                        title: 'Get Started',
                    },
                    content: `Discover <strong>Application Tour</strong>!`,
                    params: {
                        placement: 'top'
                    }
                },
                {
                    target: '.v-step-1',
                    content: '<strong>Left MenuBar</strong><br> You Can Visit Complete Menu Bar<br> And Explore Application'
                },
                {
                    target: '[data-v-step="2"]',
                    content: '<strong>Top LeftNavbar</strong><br> Explore Live Chat,Task Manager <br>and Search Bar from here.',
                    params: {
                        placement: 'top' // Any valid Popper.js placement. See https://popper.js.org/popper-documentation.html#Popper.placements
                    }
                },
                {
                    target: '[data-v-step="3"]',
                    content: '<strong>Top Right Navbar</strong><br>Explore Profile Setting From Top <br> Right Navbar. If you need any help,Please Visit FAQ(s) From Here.',
                    params: {
                        placement: 'top' // Any valid Popper.js placement. See https://popper.js.org/popper-documentation.html#Popper.placements
                    }
                },
                {
                    target: '[data-v-step="4"]',
                    content: '<strong>Current Session Attendance</strong><br>Check your Monthly Attendance Summary ',
                    params: {
                        placement: 'top' // Any valid Popper.js placement. See https://popper.js.org/popper-documentation.html#Popper.placements
                    }
                },
                {
                    target: '[data-v-step="5"]',
                    content: 'Please Visit <strong>Team Leaves </strong> For Leaves Approval Or Apply Leave Of Your Reporting Employees',
                    params: {
                        placement: 'top' // Any valid Popper.js placement. See https://popper.js.org/popper-documentation.html#Popper.placements
                    }
                },
                {
                    target: '[data-v-step="6"]',
                    content: 'Explore <strong>Team Attendance</strong> For Update And View Attendance Of Your Team',
                    params: {
                        placement: 'top' // Any valid Popper.js placement. See https://popper.js.org/popper-documentation.html#Popper.placements
                    }
                },
                {
                    target: '[data-v-step="7"]',
                    content: '<strong>For Personal Leave</strong>, Please Click on Apply Now Button',
                    params: {
                        placement: 'top' // Any valid Popper.js placement. See https://popper.js.org/popper-documentation.html#Popper.placements
                    }
                },
                {
                    target: '[data-v-step="8"]',
                    content: 'If You Need To Visit Your Profile.Please on View Profile Button',
                    params: {
                        placement: 'top' // Any valid Popper.js placement. See https://popper.js.org/popper-documentation.html#Popper.placements
                    }
                },
                {
                    target: '[data-v-step="9"]',
                    content: 'You Can Check Your Annual Leaves by Clicking on View Detail Link .',
                    params: {
                        placement: 'top' // Any valid Popper.js placement. See https://popper.js.org/popper-documentation.html#Popper.placements
                    }
                },
                {
                    target: '[data-v-step="10"]',
                    content: 'You Can Check Your Sick Leaves by Clicking on View Detail Link .',
                    params: {
                        placement: 'top' // Any valid Popper.js placement. See https://popper.js.org/popper-documentation.html#Popper.placements
                    }
                },
                {
                    target: '[data-v-step="11"]',
                    content: 'You Can Check Your Casual Leaves by Clicking on View Detail Link .',
                    params: {
                        placement: 'top' // Any valid Popper.js placement. See https://popper.js.org/popper-documentation.html#Popper.placements
                    }
                },
                {
                    target: '[data-v-step="12"]',
                    content: '<strong>Current Session Attendance</strong><br>Check your Date Wise Monthly Attendance Detail',
                    params: {
                        placement: 'top' // Any valid Popper.js placement. See https://popper.js.org/popper-documentation.html#Popper.placements
                    }
                },
                {
                    target: '[data-v-step="13"]',
                    content: 'Developed By <strong> SA Systems</strong> <br>Any Kind Of Support.Please Visit our Website Or Contact Us',
                    params: {
                        placement: 'top' // Any valid Popper.js placement. See https://popper.js.org/popper-documentation.html#Popper.placements
                    }
                }

            ],
            fetchempcode: '',
            days: 'One Day',
            attendance: {},
            ct_att: {},
            this_m_lvs: {},
            leaves_dtl: {},
            leavesblnc: {},

            type: '',
            isLvEmpty: 'Empty',
            d_from: '',
            d_to: '',
            reason: '',
            type_error: '',
            d_from_error: '',
            reason_error: '',
            ct_att: '',

            value: 1,
            max: 14,
            max_cas: '',
            max_sick: '',
            max_annual: '',
            fetchtour: '',
            disabled: false,
            timeout: null,
        }
    },
    methods: {
        delay() {
            this.disabled = true
            this.timeout = setTimeout(() => {
                this.disabled = false
            }, 5000)
            this.leave_request()
        },
        leave_request() //Add ind Leave
        {
            if (this.type == '' || this.d_from == '' || this.reason == '') {
                if (this.type == '') {
                    this.type_error = 'Selest leave type';
                } else {
                    this.type_error = '';
                }

                if (this.d_from == '') {
                    this.d_from_error = 'Select date';
                } else {
                    this.d_from_error = '';
                }

                if (this.reason == '') {
                    this.reason_error = 'Type reason';
                } else {
                    this.reason_error = '';
                }
                this.$toastr.e("Leave not applied", "Important Fields Missing!")

            } else {
                if (this.days == 'One Day') {
                    this.d_to = null;
                } else {
                    this.d_to = this.d_to;
                }
                axios.post('./leave_request_rt', {
                        type: this.type,
                        d_from: this.d_from,
                        d_to: this.d_to,
                        reason: this.reason,
                        days: this.days,
                    })
                    .then(data => {
                        if (data.data == 'Leave Applied Successfully!') {
                            this.$toastr.s("Leave Applied successfully!", "Congratulations!");

                            axios.get('this_user_attendence') //Get current session attendance of logged in employee
                                .then(data => this.attendance = data.data)
                                .catch(error => {});

                            this.type = '';
                            this.d_from = '';
                            this.d_to = '';
                            this.reason = '';
                        }
                    })
            }
        }
    },
    mounted() {
        axios.get('fetch_tour_status')
            .then(data => {

                if (data.data != '1') {
                    this.$tours['myTour'].start();
                }

            })


        axios.get('fetch_emp_code')
            .then(data => this.fetchempcode = data.data)

        axios.get('selected_emp_leaves_blnc/' + 0)
            .then(data => {
                this.leavesblnc = data.data;
                if (this.leavesblnc == '') {
                    this.isLvEmpty = "Empty";
                } else {
                    this.isLvEmpty = "Not empty";
                }
            })
            .catch(error => {});

        axios.get('this_user_attendence') //Get current session attendance of logged in employee
            .then(data => this.attendance = data.data)
            .catch(error => {});

        axios.get('m_att_dtl_ct') //Count current month attendance details
            .then(data => this.ct_att = data.data)
            .catch(error => {});

        axios.get('leaves_dtl') //Count leaves detail
            .then(data => this.leaves_dtl = data.data)
            .catch(error => {});

        axios.get('m_lv_dtl_rt') //Get leaves details
            .then(data => this.this_m_lvs = data.data)
            .catch(error => {});
        axios.get('update_tour_status')
            .then(data => {
                console.log('ok');
            })

    }
}

</script>
<style>
#v-step-46f34eda {
    transform: none !important;
}

#v-step-3b771d9f>.v-step__arrow {
    transform: translate(-5px, 40px) !important;
}

@media(max-width:576px) {
    .full_div {
        width: 100% !important;
    }
}

</style>
