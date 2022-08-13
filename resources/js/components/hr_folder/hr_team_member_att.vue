<template>
    <div>
        <div class="app-content content ">
            <div class="content-overlay"></div>
            <div class="header-navbar-shadow"></div>
            <div class="content-wrapper container-xxl p-0">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="content-header row">
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <router-link to="/" style="text-decoration: none;">Dashboard</router-link>
                                </li>
                                <li class="breadcrumb-item">
                                    <router-link to="/hr/team_attendance" style="text-decoration: none;">Team attendance</router-link>
                                </li>
                                <li class="breadcrumb-item active">
                                    Team member's attandence
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                        <div class="card">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="card-header">
                                        <h2 style="font-size:28px" class="card-title">{{name}}'s attendance Detail</h2>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="demo-inline-spacing">
                                        <a href="#" type="button" data-bs-toggle="modal" data-bs-target="#MarkAttendance" class="btn btn-outline-primary waves-effect">Mark Attandance</a>
                                    </div>
                                </div>
                            </div>

                            <table class="user-list-table table">
                                <thead class="table-light">
                                    <tr>
                                        <th style=" text-align:center;">Date</th>
                                        <th style=" text-align:center;">Status</th>
                                        <th style=" text-align:center;">Check In</th>
                                        <th style=" text-align:center;">Check Out</th>
                                        <th style=" text-align:center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="att_detail1 in att_detail">
                                        <td style="vertical-align: middle; text-align: center;">{{att_detail1.ATTDate}}</td>
                                        <td style="vertical-align: middle; text-align: center;">
                                            <label>{{att_detail1.AttStatus}}</label>
                                        </td>
                                        <td style="vertical-align: middle; text-align: center;">{{att_detail1.CheckIN}}</td>
                                        <td style="vertical-align: middle; text-align: center;">{{att_detail1.CheckOut}}</td>
                                        <td style="vertical-align: middle; text-align: center;">
                                            <div class="btn-group">
                                                <a class="btn btn-sm dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4">
                                                        <circle cx="12" cy="12" r="1"></circle>
                                                        <circle cx="12" cy="5" r="1"></circle>
                                                        <circle cx="12" cy="19" r="1"></circle>
                                                    </svg>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <a class="dropdown-item" @click="fetch_att_detail(att_detail1.EmpID, att_detail1.ATTDate)" data-bs-toggle="modal" data-bs-target="#editAttendance">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                            <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                        </svg> Edit
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <!-- Edit attendence modal  -->
                    <div class="modal fade" id="editAttendance" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <h3 class="text-center mb-1" id="addNewCardTitle">Update Attendance</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-sm-5 mx-50 pb-5">
                                    <!-- form -->
                                    <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">

                                        <div class="col-md-12">
                                            <label class="form-label" for="modalAddCardName">
                                                Date
                                                <span style="color: #DB4437; font-size: 11px;">*</span>
                                            </label>
                                            <input type="date" disabled v-model="date" class="form-control" />
                                        </div>

                                        <div class="row" style="margin-top: 3%; margin-bottom:3%;">
                                            <label class="form-label" for="modalAddCardName">
                                                Status
                                                <span style="color: #DB4437; font-size: 11px;">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input class="form-check-input" type="radio" v-model="att_sts" name="inlineRadioOptions" id="inlineRadio1" value="A">
                                                <label class="form-check-label" for="inlineRadio1">Absent</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-check-input" type="radio" v-model="att_sts" name="inlineRadioOptions" id="inlineRadio1" value="P">
                                                <label class="form-check-label" for="inlineRadio1">Present</label>
                                            </div>
                                        </div>
                                        <span style="color: #DB4437; font-size: 11px;" v-if="this.att_sts==''">{{att_sts_error}}</span>
                                        <div class="col-md-12" v-if="this.att_sts=='P'">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label" for="modalAddCardName">Check In</label>
                                                    <input type="time" v-model="cin" class="form-control" />
                                                    <span style="color: #DB4437; font-size: 11px;" v-if="this.cin==''">{{cin_error}}</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="modalAddCardName">Check Out</label>
                                                    <input type="time" v-model="cout" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <br>
                                            <button type="submit" class="btn btn-primary me-1 mt-1" :disabled="disabled1" @click="delay1()" data-bs-dismiss="modal" aria-label="Close">Update</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Edit attendence modal  -->

                    <!-- Mark attendence modal  -->
                    <div class="modal fade" id="MarkAttendance" tabindex="-1" aria-labelledby="addNewCardTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <h3 class="text-center mb-1" id="addNewCardTitle">Mark Attendance</h3>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body px-sm-5 mx-50 pb-5">
                                    <!-- form -->
                                    <form id="addNewCardValidation" class="row gy-1 gx-2 mt-75" onsubmit="return false">

                                        <div class="col-md-12">
                                            <label class="form-label" for="modalAddCardName">
                                                Date
                                                <span style="color: #DB4437; font-size: 11px;">*</span>
                                            </label>
                                            <input type="date" v-model="date" class="form-control" />
                                        </div>
                                        <span style="color: #DB4437; font-size: 11px;" v-if="this.date==''">{{date_error}}</span>

                                        <div class="row" style="margin-top: 3%; margin-bottom:3%;">
                                            <label class="form-label" for="modalAddCardName">
                                                Status
                                                <span style="color: #DB4437; font-size: 11px;">*</span>
                                            </label>
                                            <div class="col-md-6">
                                                <input class="form-check-input" type="radio" v-model="att_sts" name="inlineRadioOptions" id="inlineRadio1" value="A">
                                                <label class="form-check-label" for="inlineRadio1">Absent</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-check-input" type="radio" v-model="att_sts" name="inlineRadioOptions" id="inlineRadio1" value="P">
                                                <label class="form-check-label" for="inlineRadio1">Present</label>
                                            </div>
                                        </div>
                                        <span style="color: #DB4437; font-size: 11px;" v-if="this.att_sts==''">{{att_sts_error}}</span>
                                        <div class="col-md-12" v-if="this.att_sts=='P'">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="form-label" for="modalAddCardName">Check In</label>
                                                    <input type="time" v-model="cin" class="form-control" />
                                                    <span style="color: #DB4437; font-size: 11px;" v-if="this.cin==''">{{cin_error}}</span>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label" for="modalAddCardName">Check Out</label>
                                                    <input type="time" v-model="cout" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <br>
                                            <button type="submit" class="btn btn-primary me-1 mt-1" :disabled="disabled" @click="delay()" data-bs-dismiss="modal" aria-label="Close">Submit</button>
                                            <button type="reset" class="btn btn-outline-secondary mt-1" data-bs-dismiss="modal" aria-label="Close">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ Mark attendence modal  -->

                    <!-- Modal 1-->
                    <div class="modal fade" id="modalToggle" aria-labelledby="modalToggleLabel" tabindex="-1" style="display: none" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalToggleLabel">Update Attendance Status</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row demo-inline-spacing">
                                        <div class="col-md-3 form-check form-check-inline" style="margin-top:0px; margin-left:45%; width: 20%;">
                                            <input class="form-check-input" type="radio" v-model="attendance" name="inlineRadioOptions" id="inlineRadio1" value="Absent">
                                            <label class="form-check-label" for="inlineRadio1">Absent</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / Modal 1-->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                att_detail: {},
                id1: '',
                date: '',
                date_error: '',
                cin: '',
                cin_error: '',
                cout: '',
                att_sts: '',
                att_sts_error: '',
                name: {},
                attendance: '',
                f_date: '',

                disabled: false,
                timeout: null,

                disabled1: false,
                timeout1: null,
            }
        },
        methods: {
            delay1() {
                this.disabled1 = true
                this.timeout1 = setTimeout(() => {
                    this.disabled1 = false
                }, 5000)
                this.update_attendence()
            },
            delay() {
                this.disabled = true
                this.timeout = setTimeout(() => {
                    this.disabled = false
                }, 5000)
                this.add_attendence()
            },
            add_attendence() {
                if (this.date == '' || this.att_sts == '') {
                    if (this.date == '') {
                        this.date_error = "Select attandance status";
                    }
                    else {
                        this.date_error = '';
                    }
                    if (this.att_sts == '') {
                        this.att_sts_error = "Select attandance status";
                    }
                    else {
                        this.att_sts_error = '';
                    }
                    this.$toastr.e("Attandance not marked", "Error!");
                }
                else if (this.att_sts == "P" && this.cin == '') {
                    this.cin_error = "Select time";
                    this.$toastr.e("Attandance not marked", "Error!");
                }
                else {
                    this.date_error = '';
                    this.att_sts_error = '';
                    this.cin_error = '';

                    axios.post('./mark_team_att', {
                        date: this.date,
                        cin: this.cin,
                        cout: this.cout,
                        cId: this.$route.params.id,
                        att_sts: this.att_sts,
                    })
                        .then(data => {
                            if (data.data == 'Attendance marked') {
                                this.$toastr.s("Attandance marked successfully!", "Congratulations!");
                                axios.get('ind_att_detail2/' + this.$route.params.id)
                                    .then(data => {
                                        this.att_detail = data.data;
                                    })
                                this.date = "";
                                this.cin = "";
                                this.cout = "";
                                this.att_sts = "";
                            }
                        })
                }
            },
            fetch_att_detail(id, date) {
                this.id1 = id;
                this.f_date = date;
                axios.get('fetch_att/' + this.id1 + '/' + this.f_date)
                    .then(responce => {
                        this.date = responce.data[0].ATTDate;
                        this.cin = responce.data[0].CheckIN;
                        this.cout = responce.data[0].CheckOut;
                        this.att_sts = responce.data[0].AttStatus;
                        if (this.att_sts=="L") {
                            this.att_sts = "P";
                        }
                    })
            },
            update_attendence() {
                if (this.att_sts == '' || this.cin=='') {
                    if (this.cin == '') {
                        this.cin_error = "Select time";
                    }
                    else {
                        this.cin_error = '';
                    }
                    if (this.att_sts == '') {
                        this.att_sts_error = "Select attandance status";
                    }
                    else {
                        this.att_sts_error = '';
                    }
                    this.$toastr.e("Attandance not updated.", "Error!");
                }
                else if (this.att_sts == "P" && this.cin == '') {
                    this.cin_error = "Select time";
                    this.$toastr.e("Attandance not updated.", "Error!");
                }
                else {
                    this.date_error = '';
                    this.att_sts_error = '';
                    this.cin_error = '';

                    axios.post('./update_attandence', {
                        Aid: this.id1,
                        cin: this.cin,
                        cout: this.cout,
                        att_sts: this.att_sts,
                        date: this.date,

                    })
                        .then(data => {
                            if (data.data == 'Attendance updated Successfully!') {
                                this.$toastr.s("Attandence updated Successfully", "Congratulations!");
                                this.id1 = "";
                                this.date = "";
                                this.cin = "";
                                this.cout = "";
                                this.att_sts = "";

                                axios.get('ind_att_detail2/' + this.$route.params.id)
                                    .then(data => {
                                        this.att_detail = data.data;
                                    })
                            }
                        })
                        .catch(error => this.error = error.responce.data.errors)
                }
            }
        },
        mounted() {
            axios.get('ind_att_detail2/' + this.$route.params.id)
                .then(data => {
                    this.att_detail = data.data;
                })
                .catch(error => { });

            axios.get('ind_name/' + this.$route.params.id)
                .then(data => {
                    this.name = data.data;
                })
                .catch(error => { });
        }
    }
</script>
