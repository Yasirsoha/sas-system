<template>
  <div>
    <loader
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
    ></loader>
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item active">HR Dashboard</li>
            </ol>
          </div>
        </div>
        <div class="content-body">
          <div class="row match-height">
            <!-- Medal Card -->
            <div class="col-xl-4 col-md-6 col-12 col-xs-12">
              <div class="card card-congratulation-medal">
                <div
                  class="card-body"
                  v-bind:style="
                    receiveId == 'dark-theme-toggle'
                      ? 'background-color: black;'
                      : 'background-color: ;'
                  "
                >
                  <h5>Welcome Back 🎉</h5>
                  <p class="card-text font-small-3">View your overall report</p>
                  <h3 class="mb-75 mt-2 pt-50"></h3>
                  <router-link
                    to="/hr/employee_dashboard"
                    class="btn btn-primary waves-effect waves-float waves-light"
                    >View Profile</router-link
                  >
                  <img
                    src="public/app-assets/images/illustration/badge.svg"
                    class="congratulation-medal"
                    alt="Medal Pic"
                  />
                </div>
              </div>
            </div>
            <!--/ Medal Card -->
            <!-- Statistics Card -->
            <div class="col-xl-8 col-md-6 col-12">
              <div class="card card-statistics">
                <div
                  class="card-header"
                  v-bind:style="
                    receiveId == 'dark-theme-toggle'
                      ? 'background-color: black;'
                      : 'background-color: ;'
                  "
                >
                  <h4 class="card-title">Today's Employee Attendance</h4>
                </div>
                <div
                  class="card-body statistics-body"
                  v-bind:style="
                    receiveId == 'dark-theme-toggle'
                      ? 'background-color: black;'
                      : 'background-color: ;'
                  "
                >
                  <div class="row">
                    <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
                      <div class="d-flex flex-row">
                        <div class="avatar bg-light-info me-2">
                          <div class="avatar-content">
                            <svg
                              xmlns="http://www.w3.org/2000/svg"
                              width="14"
                              height="14"
                              viewBox="0 0 24 24"
                              fill="none"
                              stroke="currentColor"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              class="feather feather-user avatar-icon"
                            >
                              <path
                                d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"
                              ></path>
                              <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                          </div>
                        </div>
                        <div class="my-auto">
                          <h4 class="fw-bolder mb-0">
                            {{ att_daily_count.total }}
                          </h4>
                          <p class="card-text font-small-3 mb-0">
                            Total Employees
                          </p>
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
                          <h4 class="fw-bolder mb-0">
                            {{ att_daily_count.present }}
                          </h4>
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
                          <h4 class="fw-bolder mb-0">
                            {{ att_daily_count.absent }}
                          </h4>
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
                          <h4 class="fw-bolder mb-0">
                            {{ att_daily_count.late }}
                          </h4>
                          <p class="card-text font-small-3 mb-0">Late</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Statistics Card -->
          </div>
          <div class="row match-height">
            <!-- Medal Card -->
            <div class="col-xl-4 col-md-6 col-12">
              <div class="card card-developer-meetup">
                <div
                  class="meetup-img-wrapper rounded-top text-center"
                  v-bind:style="
                    receiveId == 'dark-theme-toggle'
                      ? 'background-color: black;'
                      : 'background-color: ;'
                  "
                >
                  <img
                    src="public/app-assets/images/illustration/email.svg"
                    alt="Meeting Pic"
                    height="170"
                  />
                </div>
                <div
                  class="card-body"
                  v-bind:style="
                    receiveId == 'dark-theme-toggle'
                      ? 'background-color: black;'
                      : 'background-color: ;'
                  "
                >
                  <div class="meetup-header d-flex align-items-center">
                    <div class="meetup-day">
                      <h6 class="mb-0">THU</h6>
                      <h3 class="mb-0">24</h3>
                    </div>
                    <div class="my-auto">
                      <h4 class="card-title mb-25">HR Meet Up</h4>
                      <p class="card-text mb-0">Visit your schedule events</p>
                    </div>
                  </div>
                  <div class="mt-0" style="margin-bottom: 10px">
                    <div
                      class="avatar float-start bg-light-primary rounded me-1"
                    >
                      <div class="avatar-content">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="14"
                          height="14"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          class="
                            feather feather-calendar
                            avatar-icon
                            font-medium-3
                          "
                        >
                          <rect
                            x="3"
                            y="4"
                            width="18"
                            height="18"
                            rx="2"
                            ry="2"
                          ></rect>
                          <line x1="16" y1="2" x2="16" y2="6"></line>
                          <line x1="8" y1="2" x2="8" y2="6"></line>
                          <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                      </div>
                    </div>
                    <div class="more-info">
                      <h6 class="mb-0">Sat, May 25, 2020</h6>
                      <small>10:AM to 6:PM</small>
                    </div>
                  </div>
                  <div class="mt-0" style="margin-bottom: 10px">
                    <div
                      class="avatar float-start bg-light-primary rounded me-1"
                    >
                      <div class="avatar-content">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="14"
                          height="14"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          class="
                            feather feather-calendar
                            avatar-icon
                            font-medium-3
                          "
                        >
                          <rect
                            x="3"
                            y="4"
                            width="18"
                            height="18"
                            rx="2"
                            ry="2"
                          ></rect>
                          <line x1="16" y1="2" x2="16" y2="6"></line>
                          <line x1="8" y1="2" x2="8" y2="6"></line>
                          <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                      </div>
                    </div>
                    <div class="more-info">
                      <h6 class="mb-0">Sat, May 25, 2020</h6>
                      <small>10:AM to 6:PM</small>
                    </div>
                  </div>
                  <div class="mt-0" style="margin-bottom: 10px">
                    <div
                      class="avatar float-start bg-light-primary rounded me-1"
                    >
                      <div class="avatar-content">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="14"
                          height="14"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          class="
                            feather feather-calendar
                            avatar-icon
                            font-medium-3
                          "
                        >
                          <rect
                            x="3"
                            y="4"
                            width="18"
                            height="18"
                            rx="2"
                            ry="2"
                          ></rect>
                          <line x1="16" y1="2" x2="16" y2="6"></line>
                          <line x1="8" y1="2" x2="8" y2="6"></line>
                          <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                      </div>
                    </div>
                    <div class="more-info">
                      <h6 class="mb-0">Sat, May 25, 2020</h6>
                      <small>10:AM to 6:PM</small>
                    </div>
                  </div>

                  <div class="mt-2">
                    <div
                      class="avatar float-start bg-light-primary rounded me-1"
                    >
                      <div class="avatar-content">
                        <svg
                          xmlns="http://www.w3.org/2000/svg"
                          width="14"
                          height="14"
                          viewBox="0 0 24 24"
                          fill="none"
                          stroke="currentColor"
                          stroke-width="2"
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          class="
                            feather feather-map-pin
                            avatar-icon
                            font-medium-3
                          "
                        >
                          <path
                            d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"
                          ></path>
                          <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                      </div>
                    </div>
                    <div class="more-info">
                      <h6 class="mb-0">Central Park</h6>
                      <small>Manhattan, New york City</small>
                    </div>
                  </div>
                  <div class="avatar-group">
                    <div
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="bottom"
                      title=""
                      class="avatar pull-up"
                      data-bs-original-title="Billy Hopkins"
                    >
                      <img
                        src="public/app-assets/images/portrait/small/avatar-s-9.jpg"
                        alt="Avatar"
                        width="33"
                        height="33"
                      />
                    </div>
                    <div
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="bottom"
                      title=""
                      class="avatar pull-up"
                      data-bs-original-title="Amy Carson"
                    >
                      <img
                        src="public/app-assets/images/portrait/small/avatar-s-6.jpg"
                        alt="Avatar"
                        width="33"
                        height="33"
                      />
                    </div>
                    <div
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="bottom"
                      title=""
                      class="avatar pull-up"
                      data-bs-original-title="Brandon Miles"
                    >
                      <img
                        src="public/app-assets/images/portrait/small/avatar-s-8.jpg"
                        alt="Avatar"
                        width="33"
                        height="33"
                      />
                    </div>
                    <div
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="bottom"
                      title=""
                      class="avatar pull-up"
                      data-bs-original-title="Daisy Weber"
                    >
                      <img
                        src="public/app-assets/images/portrait/small/avatar-s-20.jpg"
                        alt="Avatar"
                        width="33"
                        height="33"
                      />
                    </div>
                    <div
                      data-bs-toggle="tooltip"
                      data-popup="tooltip-custom"
                      data-bs-placement="bottom"
                      title=""
                      class="avatar pull-up"
                      data-bs-original-title="Jenny Looper"
                    >
                      <img
                        src="public/app-assets/images/portrait/small/avatar-s-20.jpg"
                        alt="Avatar"
                        width="33"
                        height="33"
                      />
                    </div>
                    <h6 class="align-self-center cursor-pointer ms-50 mb-0">
                      +42
                    </h6>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Medal Card -->
            <!-- Statistics Card -->
            <div class="col-xl-8 col-md-6 col-12">
              <div class="card card-statistics">
                <div
                  class="card-header"
                  v-bind:style="
                    receiveId == 'dark-theme-toggle'
                      ? 'background-color: black;'
                      : 'background-color: ;'
                  "
                >
                  <h4 class="card-title">Month-wise Employees Report</h4>
                </div>
                <div
                  class="card-body statistics-body"
                  v-bind:style="
                    receiveId == 'dark-theme-toggle'
                      ? 'background-color: black;'
                      : 'background-color: ;'
                  "
                >
                  <apexchart
                    type="bar"
                    :options="options"
                    :series="series"
                  ></apexchart>
                </div>
              </div>
            </div>
            <!--/ Statistics Card -->
          </div>
          <div class="row match-height">
            <!-- Company Table Card -->
            <div class="col-lg-8 col-12">
              <div
                class="card-header"
                v-bind:style="
                  receiveId == 'dark-theme-toggle'
                    ? 'background-color: black;'
                    : 'background-color: ;'
                "
              >
                <h4 style="font-size: 14px">
                  Today's Attendance Of All Departments
                </h4>
              </div>
              <div class="card card-company-table">
                <div
                  class="card-body p-0"
                  v-bind:style="
                    receiveId == 'dark-theme-toggle'
                      ? 'background-color: black;'
                      : 'background-color: ;'
                  "
                >
                  <div class="table-responsive">
                    <table class="table text-center">
                      <thead>
                        <tr>
                          <th style="width: 40%">Department</th>
                          <th>Employees</th>
                          <th>Present</th>
                          <th>Absent</th>
                          <th style="width: 13%; text-align: left !important">
                            Late
                          </th>
                        </tr>
                      </thead>
                    </table>
                    <div
                      class="card-body"
                      style="height: 233px; overflow-y: scroll"
                      v-bind:style="
                        receiveId == 'dark-theme-toggle'
                          ? 'background-color: black;'
                          : 'background-color: ;'
                      "
                    >
                      <table class="table text-center">
                        <tbody>
                          <tr
                            v-for="attendance1 in attendance"
                            :key="attendance1"
                          >
                            <td style="width: 38%">
                              <div class="d-flex align-items-center">
                                <div class="avatar bg-light-primary me-1">
                                  <div class="avatar-content">
                                    <svg
                                      xmlns="http://www.w3.org/2000/svg"
                                      width="14"
                                      height="14"
                                      viewBox="0 0 24 24"
                                      fill="none"
                                      stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                      class="
                                        feather feather-monitor
                                        font-medium-3
                                      "
                                    >
                                      <rect
                                        x="2"
                                        y="3"
                                        width="20"
                                        height="14"
                                        rx="2"
                                        ry="2"
                                      ></rect>
                                      <line
                                        x1="8"
                                        y1="21"
                                        x2="16"
                                        y2="21"
                                      ></line>
                                      <line
                                        x1="12"
                                        y1="17"
                                        x2="12"
                                        y2="21"
                                      ></line>
                                    </svg>
                                  </div>
                                </div>
                                <span>{{ attendance1.Department }}</span>
                              </div>
                            </td>
                            <td class="text-nowrap">
                              <div class="d-flex flex-column">
                                <span class="fw-bolder mb-25">{{
                                  attendance1.TotalEmployee
                                }}</span>
                              </div>
                            </td>
                            <td>{{ attendance1.Present }}</td>
                            <td>{{ attendance1.Absent }}</td>
                            <td>{{ attendance1.Leave }}</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--/ Company Table Card -->
            <!-- Developer Meetup Card -->
            <div class="col-lg-4 col-md-6 col-12">
              <div class="row match-height">
                <!-- Bar Chart - Orders -->
                <div class="col-lg-6 col-md-3 col-6">
                  <div class="card">
                    <div
                      class="card-body pb-50"
                      style="position: relative"
                      v-bind:style="
                        receiveId == 'dark-theme-toggle'
                          ? 'background-color: black;'
                          : 'background-color: ;'
                      "
                    >
                      <h6>Males</h6>
                      <h2 class="fw-bolder mb-1">{{ emp_count.males }}</h2>
                      <div id="statistics-order-chart" style="min-height: 85px">
                        <div
                          id="apexchartsscen1q2n"
                          class="
                            apexcharts-canvas
                            apexchartsscen1q2n
                            apexcharts-theme-light
                          "
                          style="width: 135px; height: 70px"
                        >
                          <svg
                            id="SvgjsSvg6020"
                            width="135"
                            height="70"
                            xmlns="http://www.w3.org/2000/svg"
                            version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:svgjs="http://svgjs.com/svgjs"
                            class="apexcharts-svg apexcharts-zoomable"
                            xmlns:data="ApexChartsNS"
                            transform="translate(0, 0)"
                            style="background: transparent"
                          >
                            <g
                              id="SvgjsG6022"
                              class="apexcharts-inner apexcharts-graphical"
                              transform="translate(13.5, 15)"
                            >
                              <defs id="SvgjsDefs6021">
                                <linearGradient
                                  id="SvgjsLinearGradient6025"
                                  x1="0"
                                  y1="0"
                                  x2="0"
                                  y2="1"
                                >
                                  <stop
                                    id="SvgjsStop6026"
                                    stop-opacity="0.4"
                                    stop-color="rgba(216,227,240,0.4)"
                                    offset="0"
                                  ></stop>
                                  <stop
                                    id="SvgjsStop6027"
                                    stop-opacity="0.5"
                                    stop-color="rgba(190,209,230,0.5)"
                                    offset="1"
                                  ></stop>
                                  <stop
                                    id="SvgjsStop6028"
                                    stop-opacity="0.5"
                                    stop-color="rgba(190,209,230,0.5)"
                                    offset="1"
                                  ></stop>
                                </linearGradient>
                                <clipPath id="gridRectMaskscen1q2n">
                                  <rect
                                    id="SvgjsRect6030"
                                    width="139"
                                    height="55"
                                    x="-11.5"
                                    y="0"
                                    rx="0"
                                    ry="0"
                                    opacity="1"
                                    stroke-width="0"
                                    stroke="none"
                                    stroke-dasharray="0"
                                    fill="#fff"
                                  ></rect>
                                </clipPath>
                                <clipPath id="gridRectMarkerMaskscen1q2n">
                                  <rect
                                    id="SvgjsRect6031"
                                    width="120"
                                    height="59"
                                    x="-2"
                                    y="-2"
                                    rx="0"
                                    ry="0"
                                    opacity="1"
                                    stroke-width="0"
                                    stroke="none"
                                    stroke-dasharray="0"
                                    fill="#fff"
                                  ></rect>
                                </clipPath>
                              </defs>
                              <rect
                                id="SvgjsRect6029"
                                width="5.8"
                                height="55"
                                x="0"
                                y="0"
                                rx="0"
                                ry="0"
                                opacity="1"
                                stroke-width="0"
                                stroke-dasharray="3"
                                fill="url(#SvgjsLinearGradient6025)"
                                class="apexcharts-xcrosshairs"
                                y2="55"
                                filter="none"
                                fill-opacity="0.9"
                              ></rect>
                              <g
                                id="SvgjsG6045"
                                class="apexcharts-xaxis"
                                transform="translate(0, 0)"
                              >
                                <g
                                  id="SvgjsG6046"
                                  class="apexcharts-xaxis-texts-g"
                                  transform="translate(0, -4)"
                                ></g>
                              </g>
                              <g id="SvgjsG6048" class="apexcharts-grid">
                                <g
                                  id="SvgjsG6049"
                                  class="apexcharts-gridlines-horizontal"
                                  style="display: none"
                                >
                                  <line
                                    id="SvgjsLine6051"
                                    x1="-9.5"
                                    y1="0"
                                    x2="125.5"
                                    y2="0"
                                    stroke="#e0e0e0"
                                    stroke-dasharray="0"
                                    class="apexcharts-gridline"
                                  ></line>
                                  <line
                                    id="SvgjsLine6052"
                                    x1="-9.5"
                                    y1="11"
                                    x2="125.5"
                                    y2="11"
                                    stroke="#e0e0e0"
                                    stroke-dasharray="0"
                                    class="apexcharts-gridline"
                                  ></line>
                                  <line
                                    id="SvgjsLine6053"
                                    x1="-9.5"
                                    y1="22"
                                    x2="125.5"
                                    y2="22"
                                    stroke="#e0e0e0"
                                    stroke-dasharray="0"
                                    class="apexcharts-gridline"
                                  ></line>
                                  <line
                                    id="SvgjsLine6054"
                                    x1="-9.5"
                                    y1="33"
                                    x2="125.5"
                                    y2="33"
                                    stroke="#e0e0e0"
                                    stroke-dasharray="0"
                                    class="apexcharts-gridline"
                                  ></line>
                                  <line
                                    id="SvgjsLine6055"
                                    x1="-9.5"
                                    y1="44"
                                    x2="125.5"
                                    y2="44"
                                    stroke="#e0e0e0"
                                    stroke-dasharray="0"
                                    class="apexcharts-gridline"
                                  ></line>
                                  <line
                                    id="SvgjsLine6056"
                                    x1="-9.5"
                                    y1="55"
                                    x2="125.5"
                                    y2="55"
                                    stroke="#e0e0e0"
                                    stroke-dasharray="0"
                                    class="apexcharts-gridline"
                                  ></line>
                                </g>
                                <g
                                  id="SvgjsG6050"
                                  class="apexcharts-gridlines-vertical"
                                  style="display: none"
                                ></g>
                                <line
                                  id="SvgjsLine6058"
                                  x1="0"
                                  y1="55"
                                  x2="116"
                                  y2="55"
                                  stroke="transparent"
                                  stroke-dasharray="0"
                                ></line>
                                <line
                                  id="SvgjsLine6057"
                                  x1="0"
                                  y1="1"
                                  x2="0"
                                  y2="55"
                                  stroke="transparent"
                                  stroke-dasharray="0"
                                ></line>
                              </g>
                              <g
                                id="SvgjsG6032"
                                class="
                                  apexcharts-bar-series apexcharts-plot-series
                                "
                              >
                                <g
                                  id="SvgjsG6033"
                                  class="apexcharts-series"
                                  seriesName="2020"
                                  rel="1"
                                  data:realIndex="0"
                                >
                                  <rect
                                    id="SvgjsRect6035"
                                    width="5.8"
                                    height="55"
                                    x="-2.9"
                                    y="0"
                                    rx="5"
                                    ry="5"
                                    opacity="1"
                                    stroke-width="0"
                                    stroke="none"
                                    stroke-dasharray="0"
                                    fill="#f3f3f3"
                                    class="apexcharts-backgroundBar"
                                  ></rect>
                                  <path
                                    id="SvgjsPath6036"
                                    d="M -2.9 53.55L -2.9 30.25L 2.9 30.25L 2.9 30.25L 2.9 53.55Q 0 56.449999999999996 -2.9 53.55z"
                                    fill="rgba(255,159,67,0.85)"
                                    fill-opacity="1"
                                    stroke-opacity="1"
                                    stroke-linecap="square"
                                    stroke-width="0"
                                    stroke-dasharray="0"
                                    class="apexcharts-bar-area"
                                    index="0"
                                    clip-path="url(#gridRectMaskscen1q2n)"
                                    pathTo="M -2.9 53.55L -2.9 30.25L 2.9 30.25L 2.9 30.25L 2.9 53.55Q 0 56.449999999999996 -2.9 53.55z"
                                    pathFrom="M -2.9 53.55L -2.9 55L 2.9 55L 2.9 55L 2.9 55L -2.9 55"
                                    cy="30.25"
                                    cx="2.9000000000000012"
                                    j="0"
                                    val="45"
                                    barHeight="24.75"
                                    barWidth="5.8"
                                  ></path>
                                  <rect
                                    id="SvgjsRect6037"
                                    width="5.8"
                                    height="55"
                                    x="26.1"
                                    y="0"
                                    rx="5"
                                    ry="5"
                                    opacity="1"
                                    stroke-width="0"
                                    stroke="none"
                                    stroke-dasharray="0"
                                    fill="#f3f3f3"
                                    class="apexcharts-backgroundBar"
                                  ></rect>
                                  <path
                                    id="SvgjsPath6038"
                                    d="M 26.1 53.55L 26.1 8.25L 31.900000000000002 8.25L 31.900000000000002 8.25L 31.900000000000002 53.55Q 29 56.449999999999996 26.1 53.55z"
                                    fill="rgba(255,159,67,0.85)"
                                    fill-opacity="1"
                                    stroke-opacity="1"
                                    stroke-linecap="square"
                                    stroke-width="0"
                                    stroke-dasharray="0"
                                    class="apexcharts-bar-area"
                                    index="0"
                                    clip-path="url(#gridRectMaskscen1q2n)"
                                    pathTo="M 26.1 53.55L 26.1 8.25L 31.900000000000002 8.25L 31.900000000000002 8.25L 31.900000000000002 53.55Q 29 56.449999999999996 26.1 53.55z"
                                    pathFrom="M 26.1 53.55L 26.1 55L 31.900000000000002 55L 31.900000000000002 55L 31.900000000000002 55L 26.1 55"
                                    cy="8.25"
                                    cx="31.900000000000002"
                                    j="1"
                                    val="85"
                                    barHeight="46.75"
                                    barWidth="5.8"
                                  ></path>
                                  <rect
                                    id="SvgjsRect6039"
                                    width="5.8"
                                    height="55"
                                    x="55.1"
                                    y="0"
                                    rx="5"
                                    ry="5"
                                    opacity="1"
                                    stroke-width="0"
                                    stroke="none"
                                    stroke-dasharray="0"
                                    fill="#f3f3f3"
                                    class="apexcharts-backgroundBar"
                                  ></rect>
                                  <path
                                    id="SvgjsPath6040"
                                    d="M 55.1 53.55L 55.1 19.25L 60.9 19.25L 60.9 19.25L 60.9 53.55Q 58 56.449999999999996 55.1 53.55z"
                                    fill="rgba(255,159,67,0.85)"
                                    fill-opacity="1"
                                    stroke-opacity="1"
                                    stroke-linecap="square"
                                    stroke-width="0"
                                    stroke-dasharray="0"
                                    class="apexcharts-bar-area"
                                    index="0"
                                    clip-path="url(#gridRectMaskscen1q2n)"
                                    pathTo="M 55.1 53.55L 55.1 19.25L 60.9 19.25L 60.9 19.25L 60.9 53.55Q 58 56.449999999999996 55.1 53.55z"
                                    pathFrom="M 55.1 53.55L 55.1 55L 60.9 55L 60.9 55L 60.9 55L 55.1 55"
                                    cy="19.25"
                                    cx="60.89999999999999"
                                    j="2"
                                    val="65"
                                    barHeight="35.75"
                                    barWidth="5.8"
                                  ></path>
                                  <rect
                                    id="SvgjsRect6041"
                                    width="5.8"
                                    height="55"
                                    x="84.1"
                                    y="0"
                                    rx="5"
                                    ry="5"
                                    opacity="1"
                                    stroke-width="0"
                                    stroke="none"
                                    stroke-dasharray="0"
                                    fill="#f3f3f3"
                                    class="apexcharts-backgroundBar"
                                  ></rect>
                                  <path
                                    id="SvgjsPath6042"
                                    d="M 84.1 53.55L 84.1 30.25L 89.89999999999999 30.25L 89.89999999999999 30.25L 89.89999999999999 53.55Q 87 56.449999999999996 84.1 53.55z"
                                    fill="rgba(255,159,67,0.85)"
                                    fill-opacity="1"
                                    stroke-opacity="1"
                                    stroke-linecap="square"
                                    stroke-width="0"
                                    stroke-dasharray="0"
                                    class="apexcharts-bar-area"
                                    index="0"
                                    clip-path="url(#gridRectMaskscen1q2n)"
                                    pathTo="M 84.1 53.55L 84.1 30.25L 89.89999999999999 30.25L 89.89999999999999 30.25L 89.89999999999999 53.55Q 87 56.449999999999996 84.1 53.55z"
                                    pathFrom="M 84.1 53.55L 84.1 55L 89.89999999999999 55L 89.89999999999999 55L 89.89999999999999 55L 84.1 55"
                                    cy="30.25"
                                    cx="89.89999999999999"
                                    j="3"
                                    val="45"
                                    barHeight="24.75"
                                    barWidth="5.8"
                                  ></path>
                                  <rect
                                    id="SvgjsRect6043"
                                    width="5.8"
                                    height="55"
                                    x="113.1"
                                    y="0"
                                    rx="5"
                                    ry="5"
                                    opacity="1"
                                    stroke-width="0"
                                    stroke="none"
                                    stroke-dasharray="0"
                                    fill="#f3f3f3"
                                    class="apexcharts-backgroundBar"
                                  ></rect>
                                  <path
                                    id="SvgjsPath6044"
                                    d="M 113.1 53.55L 113.1 19.25L 118.89999999999999 19.25L 118.89999999999999 19.25L 118.89999999999999 53.55Q 116 56.449999999999996 113.1 53.55z"
                                    fill="rgba(255,159,67,0.85)"
                                    fill-opacity="1"
                                    stroke-opacity="1"
                                    stroke-linecap="square"
                                    stroke-width="0"
                                    stroke-dasharray="0"
                                    class="apexcharts-bar-area"
                                    index="0"
                                    clip-path="url(#gridRectMaskscen1q2n)"
                                    pathTo="M 113.1 53.55L 113.1 19.25L 118.89999999999999 19.25L 118.89999999999999 19.25L 118.89999999999999 53.55Q 116 56.449999999999996 113.1 53.55z"
                                    pathFrom="M 113.1 53.55L 113.1 55L 118.89999999999999 55L 118.89999999999999 55L 118.89999999999999 55L 113.1 55"
                                    cy="19.25"
                                    cx="118.89999999999999"
                                    j="4"
                                    val="65"
                                    barHeight="35.75"
                                    barWidth="5.8"
                                  ></path>
                                </g>
                                <g
                                  id="SvgjsG6034"
                                  class="apexcharts-datalabels"
                                  data:realIndex="0"
                                ></g>
                              </g>
                              <line
                                id="SvgjsLine6059"
                                x1="-9.5"
                                y1="0"
                                x2="125.5"
                                y2="0"
                                stroke="#b6b6b6"
                                stroke-dasharray="0"
                                stroke-width="1"
                                class="apexcharts-ycrosshairs"
                              ></line>
                              <line
                                id="SvgjsLine6060"
                                x1="-9.5"
                                y1="0"
                                x2="125.5"
                                y2="0"
                                stroke-dasharray="0"
                                stroke-width="0"
                                class="apexcharts-ycrosshairs-hidden"
                              ></line>
                              <g
                                id="SvgjsG6061"
                                class="apexcharts-yaxis-annotations"
                              ></g>
                              <g
                                id="SvgjsG6062"
                                class="apexcharts-xaxis-annotations"
                              ></g>
                              <g
                                id="SvgjsG6063"
                                class="apexcharts-point-annotations"
                              ></g>
                              <rect
                                id="SvgjsRect6064"
                                width="0"
                                height="0"
                                x="0"
                                y="0"
                                rx="0"
                                ry="0"
                                opacity="1"
                                stroke-width="0"
                                stroke="none"
                                stroke-dasharray="0"
                                fill="#fefefe"
                                class="apexcharts-zoom-rect"
                              ></rect>
                              <rect
                                id="SvgjsRect6065"
                                width="0"
                                height="0"
                                x="0"
                                y="0"
                                rx="0"
                                ry="0"
                                opacity="1"
                                stroke-width="0"
                                stroke="none"
                                stroke-dasharray="0"
                                fill="#fefefe"
                                class="apexcharts-selection-rect"
                              ></rect>
                            </g>
                            <g
                              id="SvgjsG6047"
                              class="apexcharts-yaxis"
                              rel="0"
                              transform="translate(-18, 0)"
                            ></g>
                            <g
                              id="SvgjsG6023"
                              class="apexcharts-annotations"
                            ></g>
                          </svg>
                          <div
                            class="apexcharts-legend"
                            style="max-height: 35px"
                          ></div>
                          <div
                            class="apexcharts-tooltip apexcharts-theme-light"
                          >
                            <div
                              class="apexcharts-tooltip-series-group"
                              style="order: 1"
                            >
                              <span
                                class="apexcharts-tooltip-marker"
                                style="background-color: rgb(255, 159, 67)"
                              ></span>
                              <div
                                class="apexcharts-tooltip-text"
                                style="
                                  font-family: Helvetica, Arial, sans-serif;
                                  font-size: 12px;
                                "
                              >
                                <div class="apexcharts-tooltip-y-group">
                                  <span
                                    class="apexcharts-tooltip-text-label"
                                  ></span
                                  ><span
                                    class="apexcharts-tooltip-text-value"
                                  ></span>
                                </div>
                                <div class="apexcharts-tooltip-z-group">
                                  <span
                                    class="apexcharts-tooltip-text-z-label"
                                  ></span
                                  ><span
                                    class="apexcharts-tooltip-text-z-value"
                                  ></span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="
                              apexcharts-yaxistooltip
                              apexcharts-yaxistooltip-0
                              apexcharts-yaxistooltip-left
                              apexcharts-theme-light
                            "
                          >
                            <div class="apexcharts-yaxistooltip-text"></div>
                          </div>
                        </div>
                      </div>
                      <div class="resize-triggers">
                        <div class="expand-trigger">
                          <div style="width: 178px; height: 181px"></div>
                        </div>
                        <div class="contract-trigger"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Bar Chart - Orders -->
                <!-- Line Chart - Profit -->
                <div class="col-lg-6 col-md-3 col-6">
                  <div class="card card-tiny-line-stats">
                    <div
                      class="card-body pb-50"
                      style="position: relative"
                      v-bind:style="
                        receiveId == 'dark-theme-toggle'
                          ? 'background-color: black;'
                          : 'background-color: ;'
                      "
                    >
                      <h6>Female</h6>
                      <h2 class="fw-bolder mb-1">{{ emp_count.females }}</h2>
                      <div
                        id="statistics-profit-chart"
                        style="min-height: 85px"
                      >
                        <div
                          id="apexchartsrpjmi0ko"
                          class="
                            apexcharts-canvas
                            apexchartsrpjmi0ko
                            apexcharts-theme-light
                          "
                          style="width: 135px; height: 70px"
                        >
                          <svg
                            id="SvgjsSvg6066"
                            width="135"
                            height="70"
                            xmlns="http://www.w3.org/2000/svg"
                            version="1.1"
                            xmlns:xlink="http://www.w3.org/1999/xlink"
                            xmlns:svgjs="http://svgjs.com/svgjs"
                            class="apexcharts-svg"
                            xmlns:data="ApexChartsNS"
                            transform="translate(0, 0)"
                            style="background: transparent"
                          >
                            <g
                              id="SvgjsG6068"
                              class="apexcharts-inner apexcharts-graphical"
                              transform="translate(12, 0)"
                            >
                              <defs id="SvgjsDefs6067">
                                <clipPath id="gridRectMaskrpjmi0ko">
                                  <rect
                                    id="SvgjsRect6073"
                                    width="120"
                                    height="68"
                                    x="-3.5"
                                    y="-1.5"
                                    rx="0"
                                    ry="0"
                                    opacity="1"
                                    stroke-width="0"
                                    stroke="none"
                                    stroke-dasharray="0"
                                    fill="#fff"
                                  ></rect>
                                </clipPath>
                                <clipPath id="gridRectMarkerMaskrpjmi0ko">
                                  <rect
                                    id="SvgjsRect6074"
                                    width="125"
                                    height="77"
                                    x="-6"
                                    y="-6"
                                    rx="0"
                                    ry="0"
                                    opacity="1"
                                    stroke-width="0"
                                    stroke="none"
                                    stroke-dasharray="0"
                                    fill="#fff"
                                  ></rect>
                                </clipPath>
                              </defs>
                              <line
                                id="SvgjsLine6072"
                                x1="0"
                                y1="0"
                                x2="0"
                                y2="65"
                                stroke="#b6b6b6"
                                stroke-dasharray="3"
                                class="apexcharts-xcrosshairs"
                                x="0"
                                y="0"
                                width="1"
                                height="65"
                                fill="#b1b9c4"
                                filter="none"
                                fill-opacity="0.9"
                                stroke-width="1"
                              ></line>
                              <g
                                id="SvgjsG6091"
                                class="apexcharts-xaxis"
                                transform="translate(0, 0)"
                              >
                                <g
                                  id="SvgjsG6092"
                                  class="apexcharts-xaxis-texts-g"
                                  transform="translate(0, -4)"
                                >
                                  <text
                                    id="SvgjsText6094"
                                    font-family="Helvetica, Arial, sans-serif"
                                    x="0"
                                    y="94"
                                    text-anchor="middle"
                                    dominant-baseline="auto"
                                    font-size="0px"
                                    font-weight="400"
                                    fill="#373d3f"
                                    class="
                                      apexcharts-text apexcharts-xaxis-label
                                    "
                                    style="
                                      font-family: Helvetica, Arial, sans-serif;
                                    "
                                  >
                                    <tspan id="SvgjsTspan6095">1</tspan>
                                    <title>1</title>
                                  </text>
                                  <text
                                    id="SvgjsText6097"
                                    font-family="Helvetica, Arial, sans-serif"
                                    x="22.600000000000005"
                                    y="94"
                                    text-anchor="middle"
                                    dominant-baseline="auto"
                                    font-size="0px"
                                    font-weight="400"
                                    fill="#373d3f"
                                    class="
                                      apexcharts-text apexcharts-xaxis-label
                                    "
                                    style="
                                      font-family: Helvetica, Arial, sans-serif;
                                    "
                                  >
                                    <tspan id="SvgjsTspan6098">2</tspan>
                                    <title>2</title>
                                  </text>
                                  <text
                                    id="SvgjsText6100"
                                    font-family="Helvetica, Arial, sans-serif"
                                    x="45.2"
                                    y="94"
                                    text-anchor="middle"
                                    dominant-baseline="auto"
                                    font-size="0px"
                                    font-weight="400"
                                    fill="#373d3f"
                                    class="
                                      apexcharts-text apexcharts-xaxis-label
                                    "
                                    style="
                                      font-family: Helvetica, Arial, sans-serif;
                                    "
                                  >
                                    <tspan id="SvgjsTspan6101">3</tspan>
                                    <title>3</title>
                                  </text>
                                  <text
                                    id="SvgjsText6103"
                                    font-family="Helvetica, Arial, sans-serif"
                                    x="67.80000000000001"
                                    y="94"
                                    text-anchor="middle"
                                    dominant-baseline="auto"
                                    font-size="0px"
                                    font-weight="400"
                                    fill="#373d3f"
                                    class="
                                      apexcharts-text apexcharts-xaxis-label
                                    "
                                    style="
                                      font-family: Helvetica, Arial, sans-serif;
                                    "
                                  >
                                    <tspan id="SvgjsTspan6104">4</tspan>
                                    <title>4</title>
                                  </text>
                                  <text
                                    id="SvgjsText6106"
                                    font-family="Helvetica, Arial, sans-serif"
                                    x="90.40000000000002"
                                    y="94"
                                    text-anchor="middle"
                                    dominant-baseline="auto"
                                    font-size="0px"
                                    font-weight="400"
                                    fill="#373d3f"
                                    class="
                                      apexcharts-text apexcharts-xaxis-label
                                    "
                                    style="
                                      font-family: Helvetica, Arial, sans-serif;
                                    "
                                  >
                                    <tspan id="SvgjsTspan6107">5</tspan>
                                    <title>5</title>
                                  </text>
                                  <text
                                    id="SvgjsText6109"
                                    font-family="Helvetica, Arial, sans-serif"
                                    x="113.00000000000001"
                                    y="94"
                                    text-anchor="middle"
                                    dominant-baseline="auto"
                                    font-size="0px"
                                    font-weight="400"
                                    fill="#373d3f"
                                    class="
                                      apexcharts-text apexcharts-xaxis-label
                                    "
                                    style="
                                      font-family: Helvetica, Arial, sans-serif;
                                    "
                                  >
                                    <tspan id="SvgjsTspan6110">6</tspan>
                                    <title>6</title>
                                  </text>
                                </g>
                              </g>
                              <g id="SvgjsG6112" class="apexcharts-grid">
                                <g
                                  id="SvgjsG6113"
                                  class="apexcharts-gridlines-horizontal"
                                ></g>
                                <g
                                  id="SvgjsG6114"
                                  class="apexcharts-gridlines-vertical"
                                >
                                  <line
                                    id="SvgjsLine6115"
                                    x1="0"
                                    y1="0"
                                    x2="0"
                                    y2="65"
                                    stroke="#ebebeb"
                                    stroke-dasharray="5"
                                    class="apexcharts-gridline"
                                  ></line>
                                  <line
                                    id="SvgjsLine6116"
                                    x1="22.6"
                                    y1="0"
                                    x2="22.6"
                                    y2="65"
                                    stroke="#ebebeb"
                                    stroke-dasharray="5"
                                    class="apexcharts-gridline"
                                  ></line>
                                  <line
                                    id="SvgjsLine6117"
                                    x1="45.2"
                                    y1="0"
                                    x2="45.2"
                                    y2="65"
                                    stroke="#ebebeb"
                                    stroke-dasharray="5"
                                    class="apexcharts-gridline"
                                  ></line>
                                  <line
                                    id="SvgjsLine6118"
                                    x1="67.80000000000001"
                                    y1="0"
                                    x2="67.80000000000001"
                                    y2="65"
                                    stroke="#ebebeb"
                                    stroke-dasharray="5"
                                    class="apexcharts-gridline"
                                  ></line>
                                  <line
                                    id="SvgjsLine6119"
                                    x1="90.4"
                                    y1="0"
                                    x2="90.4"
                                    y2="65"
                                    stroke="#ebebeb"
                                    stroke-dasharray="5"
                                    class="apexcharts-gridline"
                                  ></line>
                                  <line
                                    id="SvgjsLine6120"
                                    x1="113"
                                    y1="0"
                                    x2="113"
                                    y2="65"
                                    stroke="#ebebeb"
                                    stroke-dasharray="5"
                                    class="apexcharts-gridline"
                                  ></line>
                                </g>
                                <line
                                  id="SvgjsLine6122"
                                  x1="0"
                                  y1="65"
                                  x2="113"
                                  y2="65"
                                  stroke="transparent"
                                  stroke-dasharray="0"
                                ></line>
                                <line
                                  id="SvgjsLine6121"
                                  x1="0"
                                  y1="1"
                                  x2="0"
                                  y2="65"
                                  stroke="transparent"
                                  stroke-dasharray="0"
                                ></line>
                              </g>
                              <g
                                id="SvgjsG6075"
                                class="
                                  apexcharts-line-series apexcharts-plot-series
                                "
                              >
                                <g
                                  id="SvgjsG6076"
                                  class="apexcharts-series"
                                  seriesName="seriesx1"
                                  data:longestSeries="true"
                                  rel="1"
                                  data:realIndex="0"
                                >
                                  <path
                                    id="SvgjsPath6090"
                                    d="M 0 65L 22.6 39L 45.2 58.5L 67.8 26L 90.4 45.5L 113 6.5"
                                    fill="none"
                                    fill-opacity="1"
                                    stroke="rgba(0,207,232,0.85)"
                                    stroke-opacity="1"
                                    stroke-linecap="butt"
                                    stroke-width="3"
                                    stroke-dasharray="0"
                                    class="apexcharts-line"
                                    index="0"
                                    clip-path="url(#gridRectMaskrpjmi0ko)"
                                    pathTo="M 0 65L 22.6 39L 45.2 58.5L 67.8 26L 90.4 45.5L 113 6.5"
                                    pathFrom="M -1 65L -1 65L 22.6 65L 45.2 65L 67.8 65L 90.4 65L 113 65"
                                  ></path>
                                  <g
                                    id="SvgjsG6077"
                                    class="apexcharts-series-markers-wrap"
                                    data:realIndex="0"
                                  >
                                    <g
                                      id="SvgjsG6079"
                                      class="apexcharts-series-markers"
                                      clip-path="url(#gridRectMarkerMaskrpjmi0ko)"
                                    >
                                      <circle
                                        id="SvgjsCircle6080"
                                        r="2"
                                        cx="0"
                                        cy="65"
                                        class="
                                          apexcharts-marker
                                          no-pointer-events
                                          wq2gd821d
                                        "
                                        stroke="#00cfe8"
                                        fill="#00cfe8"
                                        fill-opacity="1"
                                        stroke-width="2"
                                        stroke-opacity="1"
                                        rel="0"
                                        j="0"
                                        index="0"
                                        default-marker-size="2"
                                      ></circle>
                                      <circle
                                        id="SvgjsCircle6081"
                                        r="2"
                                        cx="22.6"
                                        cy="39"
                                        class="
                                          apexcharts-marker
                                          no-pointer-events
                                          w7yjz4r7lk
                                        "
                                        stroke="#00cfe8"
                                        fill="#00cfe8"
                                        fill-opacity="1"
                                        stroke-width="2"
                                        stroke-opacity="1"
                                        rel="1"
                                        j="1"
                                        index="0"
                                        default-marker-size="2"
                                      ></circle>
                                    </g>
                                    <g
                                      id="SvgjsG6082"
                                      class="apexcharts-series-markers"
                                      clip-path="url(#gridRectMarkerMaskrpjmi0ko)"
                                    >
                                      <circle
                                        id="SvgjsCircle6083"
                                        r="2"
                                        cx="45.2"
                                        cy="58.5"
                                        class="
                                          apexcharts-marker
                                          no-pointer-events
                                          wt8vo4vstj
                                        "
                                        stroke="#00cfe8"
                                        fill="#00cfe8"
                                        fill-opacity="1"
                                        stroke-width="2"
                                        stroke-opacity="1"
                                        rel="2"
                                        j="2"
                                        index="0"
                                        default-marker-size="2"
                                      ></circle>
                                    </g>
                                    <g
                                      id="SvgjsG6084"
                                      class="apexcharts-series-markers"
                                      clip-path="url(#gridRectMarkerMaskrpjmi0ko)"
                                    >
                                      <circle
                                        id="SvgjsCircle6085"
                                        r="2"
                                        cx="67.8"
                                        cy="26"
                                        class="
                                          apexcharts-marker
                                          no-pointer-events
                                          w837vaxksk
                                        "
                                        stroke="#00cfe8"
                                        fill="#00cfe8"
                                        fill-opacity="1"
                                        stroke-width="2"
                                        stroke-opacity="1"
                                        rel="3"
                                        j="3"
                                        index="0"
                                        default-marker-size="2"
                                      ></circle>
                                    </g>
                                    <g
                                      id="SvgjsG6086"
                                      class="apexcharts-series-markers"
                                      clip-path="url(#gridRectMarkerMaskrpjmi0ko)"
                                    >
                                      <circle
                                        id="SvgjsCircle6087"
                                        r="2"
                                        cx="90.4"
                                        cy="45.5"
                                        class="
                                          apexcharts-marker
                                          no-pointer-events
                                          w879hv5e
                                        "
                                        stroke="#00cfe8"
                                        fill="#00cfe8"
                                        fill-opacity="1"
                                        stroke-width="2"
                                        stroke-opacity="1"
                                        rel="4"
                                        j="4"
                                        index="0"
                                        default-marker-size="2"
                                      ></circle>
                                    </g>
                                    <g
                                      id="SvgjsG6088"
                                      class="apexcharts-series-markers"
                                      clip-path="url(#gridRectMarkerMaskrpjmi0ko)"
                                    >
                                      <circle
                                        id="SvgjsCircle6089"
                                        r="5"
                                        cx="113"
                                        cy="6.5"
                                        class="
                                          apexcharts-marker
                                          no-pointer-events
                                          wpht4qkyn
                                        "
                                        stroke="#00cfe8"
                                        fill="#ffffff"
                                        fill-opacity="1"
                                        stroke-width="2"
                                        stroke-opacity="1"
                                        rel="5"
                                        j="5"
                                        index="0"
                                        default-marker-size="5"
                                      ></circle>
                                    </g>
                                  </g>
                                </g>
                                <g
                                  id="SvgjsG6078"
                                  class="apexcharts-datalabels"
                                  data:realIndex="0"
                                ></g>
                              </g>
                              <line
                                id="SvgjsLine6123"
                                x1="0"
                                y1="0"
                                x2="113"
                                y2="0"
                                stroke="#b6b6b6"
                                stroke-dasharray="0"
                                stroke-width="1"
                                class="apexcharts-ycrosshairs"
                              ></line>
                              <line
                                id="SvgjsLine6124"
                                x1="0"
                                y1="0"
                                x2="113"
                                y2="0"
                                stroke-dasharray="0"
                                stroke-width="0"
                                class="apexcharts-ycrosshairs-hidden"
                              ></line>
                              <g
                                id="SvgjsG6125"
                                class="apexcharts-yaxis-annotations"
                              ></g>
                              <g
                                id="SvgjsG6126"
                                class="apexcharts-xaxis-annotations"
                              ></g>
                              <g
                                id="SvgjsG6127"
                                class="apexcharts-point-annotations"
                              ></g>
                            </g>
                            <rect
                              id="SvgjsRect6071"
                              width="0"
                              height="0"
                              x="0"
                              y="0"
                              rx="0"
                              ry="0"
                              opacity="1"
                              stroke-width="0"
                              stroke="none"
                              stroke-dasharray="0"
                              fill="#fefefe"
                            ></rect>
                            <g
                              id="SvgjsG6111"
                              class="apexcharts-yaxis"
                              rel="0"
                              transform="translate(-18, 0)"
                            ></g>
                            <g
                              id="SvgjsG6069"
                              class="apexcharts-annotations"
                            ></g>
                          </svg>
                          <div
                            class="apexcharts-legend"
                            style="max-height: 35px"
                          ></div>
                          <div
                            class="apexcharts-tooltip apexcharts-theme-light"
                          >
                            <div
                              class="apexcharts-tooltip-series-group"
                              style="order: 1"
                            >
                              <span
                                class="apexcharts-tooltip-marker"
                                style="background-color: rgb(0, 207, 232)"
                              ></span>
                              <div
                                class="apexcharts-tooltip-text"
                                style="
                                  font-family: Helvetica, Arial, sans-serif;
                                  font-size: 12px;
                                "
                              >
                                <div class="apexcharts-tooltip-y-group">
                                  <span
                                    class="apexcharts-tooltip-text-label"
                                  ></span
                                  ><span
                                    class="apexcharts-tooltip-text-value"
                                  ></span>
                                </div>
                                <div class="apexcharts-tooltip-z-group">
                                  <span
                                    class="apexcharts-tooltip-text-z-label"
                                  ></span
                                  ><span
                                    class="apexcharts-tooltip-text-z-value"
                                  ></span>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div
                            class="
                              apexcharts-xaxistooltip
                              apexcharts-xaxistooltip-bottom
                              apexcharts-theme-light
                            "
                          >
                            <div
                              class="apexcharts-xaxistooltip-text"
                              style="
                                font-family: Helvetica, Arial, sans-serif;
                                font-size: 12px;
                              "
                            ></div>
                          </div>
                          <div
                            class="
                              apexcharts-yaxistooltip
                              apexcharts-yaxistooltip-0
                              apexcharts-yaxistooltip-left
                              apexcharts-theme-light
                            "
                          >
                            <div class="apexcharts-yaxistooltip-text"></div>
                          </div>
                        </div>
                      </div>
                      <div class="resize-triggers">
                        <div class="expand-trigger">
                          <div style="width: 178px; height: 181px"></div>
                        </div>
                        <div class="contract-trigger"></div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Line Chart - Profit -->
                <!-- Earnings Card -->
                <div class="col-lg-12 col-md-6 col-12">
                  <div class="card earnings-card">
                    <div
                      class="card-body"
                      v-bind:style="
                        receiveId == 'dark-theme-toggle'
                          ? 'background-color: black;'
                          : 'background-color: ;'
                      "
                    >
                      <div class="row">
                        <div class="col-6">
                          <h4 class="card-title mb-1" style="font-size: 14px">
                            Overall Employees
                          </h4>

                          <h5 class="mb-1">{{ emp_count.all }}</h5>
                          <p class="card-text text-muted font-small-2">
                            <span class="fw-bolder">{{
                              emp_count.suspended
                            }}</span
                            ><span> Employees are suspended till today</span>
                          </p>
                        </div>
                        <div class="col-6" style="position: relative">
                          <div id="earnings-chart" style="min-height: 126.8px">
                            <div
                              id="apexcharts4nq7gp7l"
                              class="
                                apexcharts-canvas
                                apexcharts4nq7gp7l
                                apexcharts-theme-light
                              "
                              style="width: 156px; height: 126.8px"
                            >
                              <svg
                                id="SvgjsSvg6128"
                                width="156"
                                height="126.8"
                                xmlns="http://www.w3.org/2000/svg"
                                version="1.1"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                xmlns:svgjs="http://svgjs.com/svgjs"
                                class="apexcharts-svg"
                                xmlns:data="ApexChartsNS"
                                transform="translate(0, 0)"
                                style="background: transparent"
                              >
                                <g
                                  id="SvgjsG6130"
                                  class="apexcharts-inner apexcharts-graphical"
                                  transform="translate(-2, 0)"
                                >
                                  <defs id="SvgjsDefs6129">
                                    <clipPath id="gridRectMask4nq7gp7l">
                                      <rect
                                        id="SvgjsRect6132"
                                        width="164"
                                        height="128"
                                        x="-2"
                                        y="0"
                                        rx="0"
                                        ry="0"
                                        opacity="1"
                                        stroke-width="0"
                                        stroke="none"
                                        stroke-dasharray="0"
                                        fill="#fff"
                                      ></rect>
                                    </clipPath>
                                    <clipPath id="gridRectMarkerMask4nq7gp7l">
                                      <rect
                                        id="SvgjsRect6133"
                                        width="164"
                                        height="132"
                                        x="-2"
                                        y="-2"
                                        rx="0"
                                        ry="0"
                                        opacity="1"
                                        stroke-width="0"
                                        stroke="none"
                                        stroke-dasharray="0"
                                        fill="#fff"
                                      ></rect>
                                    </clipPath>
                                  </defs>
                                  <g id="SvgjsG6134" class="apexcharts-pie">
                                    <g
                                      id="SvgjsG6135"
                                      transform="translate(0, 0) scale(1)"
                                    >
                                      <circle
                                        id="SvgjsCircle6136"
                                        r="37.98536585365854"
                                        cx="80"
                                        cy="64"
                                        fill="transparent"
                                      ></circle>
                                      <g
                                        id="SvgjsG6137"
                                        class="apexcharts-slices"
                                      >
                                        <g
                                          id="SvgjsG6138"
                                          class="
                                            apexcharts-series
                                            apexcharts-pie-series
                                          "
                                          seriesName="App"
                                          rel="1"
                                          data:realIndex="0"
                                        >
                                          <path
                                            id="SvgjsPath6139"
                                            d="M 69.85216991000085 6.448795702018273 A 58.43902439024391 58.43902439024391 0 1 1 79.1840638026197 122.43332798844617 L 79.46964147170281 101.98166319249002 A 37.98536585365854 37.98536585365854 0 1 0 73.40391044150056 26.591717206311877 L 69.85216991000085 6.448795702018273 z"
                                            fill="#28c76f66"
                                            fill-opacity="1"
                                            stroke-opacity="1"
                                            stroke-linecap="butt"
                                            stroke-width="0"
                                            stroke-dasharray="0"
                                            class="
                                              apexcharts-pie-area
                                              apexcharts-donut-slice-0
                                            "
                                            index="0"
                                            j="0"
                                            data:angle="190.8"
                                            data:startAngle="-10"
                                            data:strokeWidth="0"
                                            data:value="53"
                                            data:pathOrig="M 69.85216991000085 6.448795702018273 A 58.43902439024391 58.43902439024391 0 1 1 79.1840638026197 122.43332798844617 L 79.46964147170281 101.98166319249002 A 37.98536585365854 37.98536585365854 0 1 0 73.40391044150056 26.591717206311877 L 69.85216991000085 6.448795702018273 z"
                                          ></path>
                                        </g>
                                        <g
                                          id="SvgjsG6140"
                                          class="
                                            apexcharts-series
                                            apexcharts-pie-series
                                          "
                                          seriesName="Service"
                                          rel="2"
                                          data:realIndex="1"
                                        >
                                          <path
                                            id="SvgjsPath6141"
                                            d="M 79.1840638026197 122.43332798844617 A 58.43902439024391 58.43902439024391 0 0 1 30.22590892178677 94.6212251391295 L 47.646840799161396 83.90379634043418 A 37.98536585365854 37.98536585365854 0 0 0 79.46964147170281 101.98166319249002 L 79.1840638026197 122.43332798844617 z"
                                            fill="#28c76f33"
                                            fill-opacity="1"
                                            stroke-opacity="1"
                                            stroke-linecap="butt"
                                            stroke-width="0"
                                            stroke-dasharray="0"
                                            class="
                                              apexcharts-pie-area
                                              apexcharts-donut-slice-1
                                            "
                                            index="0"
                                            j="1"
                                            data:angle="57.599999999999994"
                                            data:startAngle="180.8"
                                            data:strokeWidth="0"
                                            data:value="16"
                                            data:pathOrig="M 79.1840638026197 122.43332798844617 A 58.43902439024391 58.43902439024391 0 0 1 30.22590892178677 94.6212251391295 L 47.646840799161396 83.90379634043418 A 37.98536585365854 37.98536585365854 0 0 0 79.46964147170281 101.98166319249002 L 79.1840638026197 122.43332798844617 z"
                                          ></path>
                                        </g>
                                        <g
                                          id="SvgjsG6142"
                                          class="
                                            apexcharts-series
                                            apexcharts-pie-series
                                          "
                                          seriesName="Product"
                                          rel="3"
                                          data:realIndex="2"
                                        >
                                          <path
                                            id="SvgjsPath6143"
                                            d="M 30.22590892178677 94.6212251391295 A 58.43902439024391 58.43902439024391 0 0 1 69.84212548457727 6.4505677090342814 L 73.39738156497522 26.592869010872285 A 37.98536585365854 37.98536585365854 0 0 0 47.646840799161396 83.90379634043418 L 30.22590892178677 94.6212251391295 z"
                                            fill="rgba(40,199,111,1)"
                                            fill-opacity="1"
                                            stroke-opacity="1"
                                            stroke-linecap="butt"
                                            stroke-width="0"
                                            stroke-dasharray="0"
                                            class="
                                              apexcharts-pie-area
                                              apexcharts-donut-slice-2
                                            "
                                            index="0"
                                            j="2"
                                            data:angle="111.6"
                                            data:startAngle="238.4"
                                            data:strokeWidth="0"
                                            data:value="31"
                                            data:pathOrig="M 30.22590892178677 94.6212251391295 A 58.43902439024391 58.43902439024391 0 0 1 69.84212548457727 6.4505677090342814 L 73.39738156497522 26.592869010872285 A 37.98536585365854 37.98536585365854 0 0 0 47.646840799161396 83.90379634043418 L 30.22590892178677 94.6212251391295 z"
                                          ></path>
                                        </g>
                                      </g>
                                    </g>
                                    <g
                                      id="SvgjsG6144"
                                      class="apexcharts-datalabels-group"
                                      transform="translate(0, 0) scale(1)"
                                    >
                                      <text
                                        id="SvgjsText6145"
                                        font-family="Helvetica, Arial, sans-serif"
                                        x="80"
                                        y="79"
                                        text-anchor="middle"
                                        dominant-baseline="auto"
                                        font-size="16px"
                                        font-weight="400"
                                        fill="#373d3f"
                                        class="
                                          apexcharts-text
                                          apexcharts-datalabel-label
                                        "
                                        style="
                                          font-family: Helvetica, Arial,
                                            sans-serif;
                                        "
                                      >
                                        %
                                      </text>
                                      <text
                                        id="SvgjsText6146"
                                        font-family="Helvetica, Arial, sans-serif"
                                        x="80"
                                        y="65"
                                        text-anchor="middle"
                                        dominant-baseline="auto"
                                        font-size="20px"
                                        font-weight="400"
                                        fill="#373d3f"
                                        class="
                                          apexcharts-text
                                          apexcharts-datalabel-value
                                        "
                                        style="
                                          font-family: Helvetica, Arial,
                                            sans-serif;
                                        "
                                      >
                                        {{ emp_count.sus_per }}
                                      </text>
                                    </g>
                                  </g>
                                  <line
                                    id="SvgjsLine6147"
                                    x1="0"
                                    y1="0"
                                    x2="160"
                                    y2="0"
                                    stroke="#b6b6b6"
                                    stroke-dasharray="0"
                                    stroke-width="1"
                                    class="apexcharts-ycrosshairs"
                                  ></line>
                                  <line
                                    id="SvgjsLine6148"
                                    x1="0"
                                    y1="0"
                                    x2="160"
                                    y2="0"
                                    stroke-dasharray="0"
                                    stroke-width="0"
                                    class="apexcharts-ycrosshairs-hidden"
                                  ></line>
                                </g>
                                <g
                                  id="SvgjsG6131"
                                  class="apexcharts-annotations"
                                ></g>
                              </svg>
                              <div class="apexcharts-legend"></div>
                              <div
                                class="apexcharts-tooltip apexcharts-theme-dark"
                              >
                                <div
                                  class="apexcharts-tooltip-series-group"
                                  style="order: 1"
                                >
                                  <span
                                    class="apexcharts-tooltip-marker"
                                    style="
                                      background-color: rgba(40, 199, 111, 0.4);
                                    "
                                  ></span>
                                  <div
                                    class="apexcharts-tooltip-text"
                                    style="
                                      font-family: Helvetica, Arial, sans-serif;
                                      font-size: 12px;
                                    "
                                  >
                                    <div class="apexcharts-tooltip-y-group">
                                      <span
                                        class="apexcharts-tooltip-text-label"
                                      ></span
                                      ><span
                                        class="apexcharts-tooltip-text-value"
                                      ></span>
                                    </div>
                                    <div class="apexcharts-tooltip-z-group">
                                      <span
                                        class="apexcharts-tooltip-text-z-label"
                                      ></span
                                      ><span
                                        class="apexcharts-tooltip-text-z-value"
                                      ></span>
                                    </div>
                                  </div>
                                </div>
                                <div
                                  class="apexcharts-tooltip-series-group"
                                  style="order: 2"
                                >
                                  <span
                                    class="apexcharts-tooltip-marker"
                                    style="
                                      background-color: rgba(40, 199, 111, 0.2);
                                    "
                                  ></span>
                                  <div
                                    class="apexcharts-tooltip-text"
                                    style="
                                      font-family: Helvetica, Arial, sans-serif;
                                      font-size: 12px;
                                    "
                                  >
                                    <div class="apexcharts-tooltip-y-group">
                                      <span
                                        class="apexcharts-tooltip-text-label"
                                      ></span
                                      ><span
                                        class="apexcharts-tooltip-text-value"
                                      ></span>
                                    </div>
                                    <div class="apexcharts-tooltip-z-group">
                                      <span
                                        class="apexcharts-tooltip-text-z-label"
                                      ></span
                                      ><span
                                        class="apexcharts-tooltip-text-z-value"
                                      ></span>
                                    </div>
                                  </div>
                                </div>
                                <div
                                  class="apexcharts-tooltip-series-group"
                                  style="order: 3"
                                >
                                  <span
                                    class="apexcharts-tooltip-marker"
                                    style="background-color: rgb(40, 199, 111)"
                                  ></span>
                                  <div
                                    class="apexcharts-tooltip-text"
                                    style="
                                      font-family: Helvetica, Arial, sans-serif;
                                      font-size: 12px;
                                    "
                                  >
                                    <div class="apexcharts-tooltip-y-group">
                                      <span
                                        class="apexcharts-tooltip-text-label"
                                      ></span
                                      ><span
                                        class="apexcharts-tooltip-text-value"
                                      ></span>
                                    </div>
                                    <div class="apexcharts-tooltip-z-group">
                                      <span
                                        class="apexcharts-tooltip-text-z-label"
                                      ></span
                                      ><span
                                        class="apexcharts-tooltip-text-z-value"
                                      ></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="resize-triggers">
                            <div class="expand-trigger">
                              <div style="width: 185px; height: 128px"></div>
                            </div>
                            <div class="contract-trigger"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--/ Earnings Card -->
              </div>
            </div>
            <!--/ Developer Meetup Card -->
          </div>
        </div>
        <div class="row match-height">
          <!-- Company Table Card -->
          <div class="col-lg-6 col-12">
            <div class="card-header">
              <h4 style="font-size: 14px">
                Employees Job Status Expiry Detail ({{
                  emp_count.status_exp_cnt
                }})
              </h4>
            </div>
            <div class="card card-company-table">
              <div
                class="card-body p-0"
                v-bind:style="
                  receiveId == 'dark-theme-toggle'
                    ? 'background-color: black;'
                    : 'background-color: ;'
                "
              >
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-center">
                      <tr>
                        <th style="width: 53%">Name</th>
                        <th style="width: 21%">Department</th>
                        <th style="width: 26%">Status Expiry</th>
                      </tr>
                    </thead>
                  </table>
                  <div
                    class="card-body"
                    style="height: 402px; overflow-y: scroll"
                    v-bind:style="
                      receiveId == 'dark-theme-toggle'
                        ? 'background-color: black;'
                        : 'background-color: ;'
                    "
                  >
                    <table class="table">
                      <tbody>
                        <tr v-for="exp_emp1 in exp_emp" :key="exp_emp1">
                          <td class="sorting_1" style="width: 50%">
                            <div
                              class="
                                d-flex
                                justify-content-left
                                align-items-center
                              "
                            >
                              <div class="avatar-wrapper">
                                <div class="avatar me-1">
                                  <img
                                    src="public/images/profile_images/pro.png"
                                    alt="Avatar"
                                    height="32"
                                    width="32"
                                  />
                                </div>
                              </div>
                              <div class="d-flex flex-column">
                                <a class="user_name text-truncate text-body">
                                  <span class="fw-bolder">{{
                                    exp_emp1.Name
                                  }}</span>
                                </a>
                                <small class="emp_post text-muted">
                                  <span
                                    >{{ exp_emp1.Designation }}-{{
                                      exp_emp1.EmployeeCode
                                    }}
                                    ({{ exp_emp1.Status }})</span
                                  >
                                </small>
                              </div>
                            </div>
                          </td>
                          <td class="text-center" style="width: 28%">
                            {{ exp_emp1.Department }}
                          </td>
                          <td style="text-align: right; width: 22%">
                            {{ exp_emp1.ProbationEnd }}
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--/ Company Table Card -->
          <!-- Developer Meetup Card -->
          <div class="col-lg-6 col-md-6 col-12">
            <div class="card-header">
              <h4 style="font-size: 14px">
                Employees CNIC Expiry Detail ({{ emp_count.cnic_exp_cnt }})
              </h4>
            </div>
            <div class="card card-company-table">
              <div
                class="card-body p-0"
                v-bind:style="
                  receiveId == 'dark-theme-toggle'
                    ? 'background-color: black;'
                    : 'background-color: ;'
                "
              >
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-center">
                      <tr>
                        <th style="width: 53%">Name</th>
                        <th style="width: 21%">Department</th>
                        <th style="width: 26%">CNIC Expiry</th>
                      </tr>
                    </thead>
                  </table>
                  <div
                    class="card-body"
                    style="height: 402px; overflow-y: scroll"
                    v-bind:style="
                      receiveId == 'dark-theme-toggle'
                        ? 'background-color: black;'
                        : 'background-color: ;'
                    "
                  >
                    <table class="table">
                      <tbody>
                        <tr v-for="exp_cnic1 in exp_cnic" :key="exp_cnic1">
                          <td class="sorting_1" style="width: 50%">
                            <div
                              class="
                                d-flex
                                justify-content-left
                                align-items-center
                              "
                            >
                              <div class="avatar-wrapper">
                                <div class="avatar me-1">
                                  <img
                                    src="public/images/profile_images/pro.png"
                                    alt="Avatar"
                                    height="32"
                                    width="32"
                                  />
                                </div>
                              </div>
                              <div class="d-flex flex-column">
                                <a class="user_name text-truncate text-body"
                                  ><span class="fw-bolder">{{
                                    exp_cnic1.Name
                                  }}</span></a
                                ><small class="emp_post text-muted">
                                  <span
                                    >{{ exp_cnic1.Designation }}-{{
                                      exp_cnic1.EmployeeCode
                                    }}
                                    ({{ exp_cnic1.Status }})</span
                                  >
                                </small>
                              </div>
                            </div>
                          </td>
                          <td class="text-center" style="width: 28%">
                            {{ exp_cnic1.Department }}
                          </td>
                          <td style="text-align: right; width: 22%">
                            {{ exp_cnic1.CnicExpiry }}
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
  </div>
</template>

<script>
import VueApexCharts from "vue-apexcharts";
import { bus } from "../../app";
export default {
  components: {
    apexchart: VueApexCharts,
  },
  data: function () {
    return {
      att_daily_count: {},
      toggle: null,
      spinner: false,
      attendance: {},
      emp_count: {},
      exp_emp: {},
      exp_cnic: {},
      toggleMode: false,
      receiveId: "theme-toggle",
      dde: [],
      ddf: [],

      options: {
        chart: {
          id: "vuechart-example",
          height: 150,
        },
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "55%",
            endingShape: "rounded",
          },
        },
        xaxis: {
          categories: [
            "Jan",
            "Feb",
            "Mar",
            "Apr",
            "May",
            "Jun",
            "Jul",
            "Aug",
            "Sep",
            "Oct",
            "Nov",
            "Dec",
          ],
        },
      },
      series: [
        {
          name: "Hiring",
          data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        },
        {
          name: "Firing",
          data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        },
      ],
    };
  },
  methods: {},
  created() {
    const app = document.getElementById("app");
    console.log("app data", app.className);
    // this.id=app;
    bus.$on("darkToggle", (modify) => {
      console.log("rec log", modify);
      if (modify) {
        this.toggleMode = true;
      } else {
        this.toggleMode = false;
      }
    });
    bus.$on("showId", (toggling) => {
      console.log("show id", toggling);
      if (toggling == "dark-theme-toggle") {
        this.receiveId = "dark-theme-toggle";
      } else {
        this.receiveId = "theme-toggle";
      }
    });
  },
  mounted() {
    axios
      .get("./get_count_dailyatt/")
      .then((response) => {
        this.att_daily_count = response.data;
        this.spinner = false;
      })
      .catch((err) => {
        this.spinner = true;
      });

    axios
      .get("./count_hiring_d/")
      .then((response) => {
        this.dde = response.data;
        axios.get("./count_firing_d/").then((data) => {
          this.spinner = false;
          this.ddf = data.data;

          this.series = [
            {
              name: "Hiring",
              data: this.dde,
            },
            {
              name: "Firing",
              data: this.ddf,
            },
          ];
        });
      })
      .catch((err) => {
        this.spinner = true;
      });

    axios
      .get("./session_att")
      .then((data) => {
        this.spinner = false;
        this.attendance = data.data;
      })
      .catch((error) => {
        this.spinner = true;
      });

    axios
      .get("./hrdb_employee_count")
      .then((data) => {
        this.spinner = false;
        this.emp_count = data.data;
      })
      .catch((error) => {
        this.spinner = true;
      });

    axios
      .get("./job_exp_employee")
      .then((data) => {
        (this.spinner = false), (this.exp_emp = data.data);
      })
      .catch((error) => {
        this.spinner = true;
      });

    axios
      .get("./cnic_exp_employee")
      .then((data) => {
        this.spinner = false;
        this.exp_cnic = data.data;
      })
      .catch((error) => {
        this.spinner = true;
      });

    console.log("Footer");
  },
};
</script>
