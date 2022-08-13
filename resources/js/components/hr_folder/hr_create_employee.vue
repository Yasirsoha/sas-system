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
                                <router-link to="/hr/employees_detail" style="text-decoration: none;">Employees Detail</router-link>
                            </li>
                            <li class="breadcrumb-item active">
                                Create Employee
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="content-body">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Create New Employee</h4>
                        </div>
                        <div class="card-body">
                            <div class="card">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="card-header border-bottom">
                                        <h4 class="card-title">Profile Details</h4>
                                    </div>
                                    <div class="card-body py-2 my-25">
                                        <!-- header section -->
                                        <div class="d-flex">
                                            <img v-if="url" :src="url" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image" style="width:155px;height:180px">
                                            <img v-else src="public/app-assets/images/portrait/small/profile.jpg" id="account-upload-img" class="uploadedAvatar rounded me-50" alt="profile image">
                                            <!-- upload and reset button -->
                                            <div class="d-flex align-items-end mt-75 ms-1">
                                                <div>
                                                    <input type="file" id="image_file" :v-model="image_file" name="image_file" @change="onFileChange" accept="image/*" class="input-file">
                                                    <button type="button" @click="clear_image()" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75 waves-effect">Clear</button>
                                                    <p class="mb-0">Add profile image(png, jpg, jpeg. ) </p>
                                                </div>
                                            </div>
                                            <!--/ upload and reset button -->
                                        </div>
                                        <span style="color: #d93025" v-if="this.url==null">{{e_url}}</span>
                                        <!--/ header section -->
                                        <!-- form -->
                                        <div class="row">
                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label" for="accountFirstName">Full Name</label>
                                                <label style="color: #d93025">*</label>
                                                <input type="text" class="form-control" id="accountFirstName" v-model="full_name" placeholder="Full Name Here">
                                                <span style="color: #d93025" v-if="full_name==''">{{e_full_name}}</span>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label" for="accountLastName">Father's Name</label>
                                                <label style="color: #d93025">*</label>
                                                <input type="text" class="form-control" id="accountLastName" v-model="father_name" placeholder="Father's Name Here">
                                                <span style="color: #d93025" v-if="father_name==''">{{e_father_name}}</span>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <div class="mb-1">
                                                    <label class="form-label" for="basicSelect">Gender</label>
                                                    <label style="color: #d93025">*</label>
                                                    <div class="demo-inline-spacing">
                                                        <div class="form-check form-check-inline" style="margin-top:0px">
                                                            <input class="form-check-input" type="radio" v-model="gender" name="inlineRadioOptions" id="inlineRadio1" value="Male" checked="">
                                                            <label class="form-check-label" for="inlineRadio1">Male</label>
                                                        </div>
                                                        <div class="form-check form-check-inline" style="margin-top:0px">
                                                            <input class="form-check-input" type="radio" v-model="gender" name="inlineRadioOptions" id="inlineRadio2" value="Female">
                                                            <label class="form-check-label" for="inlineRadio2">Female</label>
                                                        </div>
                                                    </div>
                                                    <span style="color: #d93025" v-if="gender==''">{{e_gender}}</span>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label">Martial Status</label>
                                                <label style="color: #d93025">*</label>
                                                <select class="form-select" v-model="m_status">
                                                    <option value="" selected>Select Status</option>
                                                    <option value="Single">Single</option>
                                                    <option value="Married">Married</option>
                                                </select>
                                                <span style="color: #d93025" v-if="m_status==''">{{e_m_status}}</span>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label">Blood Group</label>
                                                <select class="form-select" v-model="blood_group">

                                                    <option value="">Select Group</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label" for="accountEmail">Email</label>
                                                <input type="email" class="form-control" id="accountEmail" v-model="email" placeholder="abc@gmail.com">
                                                <span style="color: #d93025" v-if="!validEmail(email)">{{e_email}}</span>
                                            </div>

                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label" for="accountOrganization">CNIC No.</label>
                                                <label style="color: #d93025">*</label>
                                                <masked-input class="form-control account-number-mask" mask="11111-1111111-1" v-model="cnic" placeholder="00000-0000000-0" />
                                                <span style="color: #d93025" v-if="cnic==''">{{e_cnic}}</span>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label" for="accountOrganization">CNIC Expiry</label>
                                                <label style="color: #d93025">*</label>
                                                <input type="date" class="form-control" v-model="cnic_expiry">
                                                <span style="color: #d93025" v-if="cnic_expiry==''">{{e_cnic_expiry}}</span>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label" for="accountPhoneNumber">Personal Number</label>
                                                <label style="color: #d93025">*</label>
                                                <masked-input class="form-control account-number-mask" v-model="phone_number" mask="0311-1111111" placeholder="Phone Number Here" />
                                                <span style="color: #d93025" v-if="phone_number==''">{{e_phone_number}}</span>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label" for="accountPhoneNumber">Date of Birth</label>
                                                <label style="color: #d93025">*</label>
                                                <input type="date" class="form-control account-number-mask" v-model="dob">
                                                <span style="color: #d93025" v-if="dob==''">{{e_dob}}</span>
                                            </div>

                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label">Religion</label>
                                                <label style="color: #d93025">*</label>
                                                <select class="form-select" v-model="religion">
                                                    <option value="">Select Religion</option>
                                                    <option value="Islam">Islam</option>
                                                    <option value="Christan">Christan</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                <span style="color: #d93025" v-if="religion==''">{{e_religion}}</span>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label" for="accountPhoneNumber">Emergency Number</label>
                                                <label style="color: #d93025">*</label>
                                                <masked-input class="form-control account-number-mask" mask="0311-1111111" v-model="phone_number2" placeholder="Phone Number Here" />
                                                <span style="color: #d93025" v-if="phone_number2==''">{{e_phone_number2}}</span>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label" for="accountPhoneNumber">Relationship</label>
                                                <label style="color: #d93025">*</label>
                                                <input type="text" class="form-control account-number-mask" id="accountPhoneNumber" v-model="relation" placeholder="Contact Number Relationship">
                                                <span style="color: #d93025" v-if="relation==''">{{e_relation}}</span>
                                            </div>
                                            <div class="col-12 col-sm-6 mb-1">
                                                <label class="form-label" for="accountState">City Name</label>
                                                <label style="color: #d93025">*</label>
                                                <select class="form-select" v-model="city" placeholder="City Name Here">
                                                    <option value="">Select City</option>

                                                    <option v-for='cities1 in cities' :key="cities1" :value='cities1.city_name'>{{ cities1.city_name }}</option>
                                                </select>

                                                <span style="color: #d93025" v-if="city==''">{{e_city}}</span>
                                            </div>
                                            <div class="col-12 col-sm-12 mb-1">
                                                <label class="form-label" for="accountAddress">Address</label>
                                                <label style="color: #d93025">*</label>
                                                <input type="text" class="form-control" v-model="address" placeholder="Your Address">
                                                <span style="color: #d93025" v-if="address==''">{{e_address}}</span>
                                            </div>

                                        </div>
                                        <!--/ form -->

                                    </div>
                                </form>
                                <div class="col-12" style="text-align:center">
                                    <button :disabled="disabled" @click="delay()" type="button" class="btn btn-primary mt-1 me-1 waves-effect waves-float waves-light">Save Employee Profiles</button>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Content-->
    </div>
</template>
<script>
    import MaskedInput from 'vue-masked-input'
    const image = "";
    export default {
        components: {
            MaskedInput
        },
        data() {

            return {
                user_access: {},
                url: null,
                e_url: '',
                image_file: '',
                image,
                cnic_expiry: '',
                e_cnic_expiry: '',

                full_name: '',
                e_full_name: '',

                father_name: '',
                e_father_name: '',

                gender: '',
                e_gender: '',

                m_status: '',
                e_m_status: '',

                blood_group: '',
                email: '',
                e_email: '',

                company_email: '',
                cnic: '',
                e_cnic: '',

                phone_number: '',
                e_phone_number: '',

                phone_number2: '',
                e_phone_number2: '',
                dob: '',
                e_dob: '',


                religion: '',
                e_religion: '',

                address: '',
                e_address: '',

                city: '',
                e_city: '',

                relation: '',
                e_relation: '',

                image_path: '',

                cities: {},

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
                this.submit_employee()
            },

            validEmail: function (email) {
                var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(email);
            },
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length) {
                    console.log('no files');
                }

                console.log(files[0]);
                const file = files[0];
                this.image = files[0];
                this.url = URL.createObjectURL(file);

            },
            submit_form(e) {


                const formData = new FormData();
                formData.append('image_file', this.image, this.image.name);
                axios.post('./test_image/submit', formData, {}).then((response) => {
                    this.image_path = response.data;
                    alert(this.image_path);
                })
                    .catch(function (err) {
                        console.log(err)
                    });
            },
            submit_employee() {
                if (this.url == null || this.full_name == '' || this.father_name == '' || this.gender == '' || this.m_status == '' ||
                    this.cnic == '' || this.cnic_expiry == '' || this.phone_number == '' ||
                    this.relation == '' || this.address == '' || this.city == '') {
                    if (this.full_name == '') {
                        this.e_full_name = 'Full name is required'
                    } else {
                        this.e_full_name = ''
                    }
                    if (this.url == null) {
                        this.e_url = 'Profile Image is required'
                    } else {
                        this.e_url = ''
                    }
                    if (this.father_name == '') {
                        this.e_father_name = 'Father\'s name is required'
                    } else {
                        this.e_father_name = ''
                    }
                    if (this.gender == '') {
                        this.e_gender = 'Select your gender'
                    } else {
                        this.e_gender = ''
                    }
                    if (this.m_status == '') {
                        this.e_m_status = 'Select marital status'
                    } else {

                        this.e_m_status = ''
                    }
                    if (this.cnic == '') {
                        this.e_cnic = 'CNIC required'
                    } else {
                        this.e_cnic = ''
                    }
                    if (this.cnic_expiry == '') {
                        this.e_cnic_expiry = 'CNIC expiry date is required'
                    } else {
                        this.e_cnic_expiry = ''
                    }

                    if (this.phone_number == '') {
                        this.e_phone_number = 'Phone number required!'
                    } else {
                        this.e_phone_number = ''
                    }
                    if (this.dob == '') {
                        this.e_dob = 'Date of birth required'
                    } else {
                        this.e_dob = ''
                    }

                    if (this.religion == '') {
                        this.e_religion = 'Select religion'
                    } else {
                        this.e_religion = ''
                    }
                    if (this.phone_number2 == '') {
                        this.e_phone_number2 = 'Emergency phone number required'
                    } else {
                        this.e_phone_number2 = ''
                    }
                    if (this.relation == '') {
                        this.e_relation = 'Enter relationship'
                    } else {
                        this.e_relation = ''
                    }
                    if (this.address == '') {
                        this.e_address = 'Address is required'
                    } else {
                        this.e_address = ''
                    }
                    if (this.city == '') {
                        this.e_city = 'Address is required'
                    } else {
                        this.e_city = ''
                    }
                } else {

                    const formData = new FormData();
                    formData.append('image_file', this.image, this.image.name);
                    formData.append('full_name', this.full_name);
                    formData.append('father_name', this.father_name);
                    formData.append('gender', this.gender);
                    formData.append('blood_group', this.blood_group);
                    formData.append('dob', this.dob);
                    formData.append('email', this.email);
                    formData.append('cnic', this.cnic);
                    formData.append('phone_number', this.phone_number);
                    formData.append('phone_number2', this.phone_number2);
                    formData.append('religion', this.religion);
                    formData.append('address', this.address);
                    formData.append('city', this.city);
                    formData.append('m_status', this.m_status);
                    formData.append('relation', this.relation);
                    formData.append('cnic_expiry', this.cnic_expiry);


                    axios.post('./create_employee', formData)
                        .then(data => {
                            this.$toastr.s("New Employee Added Successfully.Please Complete The Profile", "Congratulations");
                            this.image_file = '';
                            this.cnic_expiry = '';
                            this.full_name = '';
                            this.father_name = '';
                            this.gender = '';
                            this.m_status = '';
                            this.blood_group = '';
                            this.email = '';
                            this.company_email = '';
                            this.cnic = '';
                            this.phone_number = '';
                            this.phone_number2 = '';
                            this.dob = '';
                            this.religion = '';
                            this.address = '';
                            this.city = '';
                            this.relation = '';
                            this.image_path = '';
                            console.log(data.data);
                        })
                        .catch(error => this.error = error.response.data.errors)
                }



            },



            clear_image() {
                this.url = null;
                this.image_file = '';
                this.image = '';
            }

        },
        mounted() {
            axios.get('overall_cities')
                .then(response => this.cities = response.data)
                .catch(error => { });
            axios.get('./fetch_user_hr_roles')
                .then(response => this.user_access = response.data)
        }
    }

</script>
