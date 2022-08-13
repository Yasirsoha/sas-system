<template>
  <div>
    <!-- BEGIN: Content-->
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <router-link to="/hr/dashboard" style="text-decoration: none"
                  >Accounts Configuration</router-link
                >
              </li>
              <li class="breadcrumb-item active">General Configuration</li>
            </ol>
          </div>
        </div>
        <div class="content-body">
          <section class="app-user-view-account">
            <div class="row">
              <!--/ User Sidebar -->
              <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 order-1 order-md-0">
                  <!-- User Card -->
                  <div class="card">
                    <div class="card-body">
                      <section id="accordion-with-border">
                        <div class="row">
                          <div class="col-sm-12">
                            <div
                              id="accordionWrapa50"
                              role="tablist"
                              aria-multiselectable="true"
                            >
                              <div class="card">
                                <div class="card-header">
                                  <h4 class="card-title">
                                    Accounts Configuration
                                  </h4>
                                </div>
                                <div class="card-body">
                                  <div class="row">
                                    <div class="card-header">
                                      <h6 class="card-title">Sales Prefix</h6>
                                    </div>
                                    <div class="col-12 col-sm-3 mb-1">
                                      <label
                                        class="form-label"
                                        for="accountFirstName"
                                        >Customer Invoice</label
                                      >
                                      <label style="color: #d93025">*</label>
                                      <masked-input
                                        class="form-control account-number-mask"
                                        mask="aaa"
                                        v-model="customer_inv"
                                        placeholder=""
                                      />
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="
                                          customer_inv == '' ||
                                          customer_inv.length > 3
                                        "
                                        >{{ customer_inv_error }}</span
                                      >
                                    </div>
                                    <div class="col-12 col-sm-3 mb-1">
                                      <label
                                        class="form-label"
                                        for="accountFirstName"
                                        >Credit Notes</label
                                      >
                                      <label style="color: #d93025">*</label>
                                      <masked-input
                                        class="form-control account-number-mask"
                                        mask="aaa"
                                        v-model="customer_credit"
                                        placeholder=""
                                      />
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="
                                          customer_credit == '' ||
                                          customer_credit.length > 3
                                        "
                                        >{{ customer_credit_error }}</span
                                      >
                                    </div>
                                    <div class="col-12 col-sm-2 mb-1">
                                      <label
                                        class="form-label"
                                        for="accountFirstName"
                                        >Received Voucher</label
                                      >
                                      <label style="color: #d93025">*</label>
                                      <masked-input
                                        class="form-control account-number-mask"
                                        mask="aaa"
                                        v-model="customer_voucher"
                                        placeholder=""
                                      />
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="
                                          customer_voucher == '' ||
                                          customer_voucher.length > 3
                                        "
                                        >{{ customer_voucher_error }}</span
                                      >
                                    </div>
                                    <div class="col-12 col-sm-2 mb-1">
                                      <label
                                        class="form-label"
                                        for="accountFirstName"
                                        >Customer</label
                                      >
                                      <label style="color: #d93025">*</label>
                                      <masked-input
                                        class="form-control account-number-mask"
                                        mask="aaaa"
                                        v-model="customer_pre"
                                        placeholder=""
                                      />
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="
                                          customer_pre == '' ||
                                          customer_pre.length > 4
                                        "
                                        >{{ customer_pre_error }}</span
                                      >
                                    </div>
                                    <div class="col-12 col-sm-2 mb-1">
                                      <label
                                        class="form-label"
                                        for="accountFirstName"
                                        >Quotation</label
                                      >
                                      <label style="color: #d93025">*</label>
                                      <masked-input
                                        class="form-control account-number-mask"
                                        mask="aaaa"
                                        v-model="quotation"
                                        placeholder=""
                                      />
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="
                                          quotation == '' ||
                                          quotation.length > 4
                                        "
                                        >{{ quotation_error }}</span
                                      >
                                    </div>
                                    <div class="card-header">
                                      <h6 class="card-title">
                                        Purchase Prefix
                                      </h6>
                                    </div>
                                    <div class="col-12 col-sm-3 mb-1">
                                      <label
                                        class="form-label"
                                        for="accountFirstName"
                                        >Purchase Order</label
                                      >
                                      <label style="color: #d93025">*</label>
                                      <masked-input
                                        class="form-control account-number-mask"
                                        mask="aaa"
                                        v-model="vendor_inv"
                                        placeholder=""
                                      />
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="
                                          vendor_inv == '' ||
                                          vendor_inv.length > 3
                                        "
                                        >{{ vendor_inv_error }}</span
                                      >
                                    </div>
                                    <div class="col-12 col-sm-3 mb-1">
                                      <label
                                        class="form-label"
                                        for="accountFirstName"
                                        >Debit Notes</label
                                      >
                                      <label style="color: #d93025">*</label>
                                      <masked-input
                                        class="form-control account-number-mask"
                                        mask="aaa"
                                        v-model="vendor_debit"
                                        placeholder=""
                                      />
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="
                                          vendor_debit == '' ||
                                          vendor_debit.length > 3
                                        "
                                        >{{ vendor_debit_error }}</span
                                      >
                                    </div>
                                    <div class="col-12 col-sm-2 mb-1">
                                      <label
                                        class="form-label"
                                        for="accountFirstName"
                                        >Payment Voucher</label
                                      >
                                      <label style="color: #d93025">*</label>
                                      <masked-input
                                        class="form-control account-number-mask"
                                        mask="aaa"
                                        v-model="vendor_voucher"
                                        placeholder=""
                                      />
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="
                                          vendor_voucher == '' ||
                                          vendor_voucher.length > 3
                                        "
                                        >{{ vendor_voucher_error }}</span
                                      >
                                    </div>
                                    <div class="col-12 col-sm-2 mb-1">
                                      <label
                                        class="form-label"
                                        for="accountFirstName"
                                        >Vendor</label
                                      >
                                      <label style="color: #d93025">*</label>
                                      <masked-input
                                        class="form-control account-number-mask"
                                        mask="aaaa"
                                        v-model="vendor_pre"
                                        placeholder=""
                                      />
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="
                                          vendor_pre == '' ||
                                          vendor_pre.length > 4
                                        "
                                        >{{ vendor_pre_error }}</span
                                      >
                                    </div>
                                    <div class="col-12 col-sm-2 mb-1">
                                      <label
                                        class="form-label"
                                        for="accountFirstName"
                                        >Requistion</label
                                      >
                                      <label style="color: #d93025">*</label>
                                      <masked-input
                                        class="form-control account-number-mask"
                                        mask="aaaa"
                                        v-model="requistion"
                                        placeholder=""
                                      />
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="
                                          requistion == '' ||
                                          requistion.length > 4
                                        "
                                        >{{ requistion_error }}</span
                                      >
                                    </div>
                                    <div class="card-header">
                                      <h6 class="card-title">
                                        Accounting Prefix
                                      </h6>
                                    </div>
                                    <div class="col-12 col-sm-2 mb-1">
                                      <label
                                        class="form-label"
                                        for="accountFirstName"
                                        >Journal Voucher</label
                                      >
                                      <label style="color: #d93025">*</label>
                                      <masked-input
                                        class="form-control account-number-mask"
                                        mask="aaaa"
                                        v-model="journal_voucher"
                                        placeholder=""
                                      />
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="
                                          journal_voucher == '' ||
                                          journal_voucher.length > 4
                                        "
                                        >{{ journal_voucher_error }}</span
                                      >
                                    </div>
                                    <div class="col-12 col-sm-4 mb-1"></div>
                                    <div
                                      class="col-12 col-sm-3 mb-1"
                                      style="padding-top: 25px"
                                    >
                                      <button
                                        type="submit"
                                        :disabled="disabled3"
                                        @click="delay3()"
                                        style="width: 100%"
                                        class="btn btn-primary me-1 mt-1"
                                      >
                                        Update
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                    </div>
                  </div>
                  <!-- /User Card -->
                  <!-- User Card -->
                  <div class="card">
                    <div class="card-body">
                      <section id="accordion-with-border">
                        <div class="row">
                          <div class="col-sm-12">
                            <div
                              id="accordionWrapa50"
                              role="tablist"
                              aria-multiselectable="true"
                            >
                              <div class="card">
                                <div class="card-header">
                                  <h4 class="card-title">
                                    Company Configuration
                                  </h4>
                                </div>
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-12 col-sm-12 mb-1">
                                      <div class="mb-1">
                                        <label
                                          class="form-label"
                                          for="basicSelect"
                                          >Settings</label
                                        >
                                        <label style="color: #d93025">*</label>
                                        <div class="demo-inline-spacing">
                                          <div
                                            class="form-check form-check-inline"
                                            style="margin-top: 0px"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              v-model="company_settings"
                                              name="inlineRadioOptions"
                                              id="inlineRadio1"
                                              value="individual"
                                              checked=""
                                            />
                                            <label
                                              class="form-check-label"
                                              for="inlineRadio1"
                                              >Individual</label
                                            >
                                          </div>
                                          <div
                                            class="form-check form-check-inline"
                                            style="margin-top: 0px"
                                          >
                                            <input
                                              class="form-check-input"
                                              type="radio"
                                              v-model="company_settings"
                                              name="inlineRadioOptions"
                                              id="inlineRadio2"
                                              value="group"
                                            />
                                            <label
                                              class="form-check-label"
                                              for="inlineRadio2"
                                              >Group of Companies</label
                                            >
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div
                                      class="card-body"
                                      v-if="company_settings == 'group'"
                                    >
                                      <div
                                        data-repeater-create=""
                                        class="btn btn-primary"
                                        v-on:click="add_xz_repeater()"
                                      >
                                        <span>
                                          <i class="fa fas-plus"></i>
                                          <span>Add</span>
                                        </span>
                                      </div>
                                      <div
                                        class="
                                          form-group
                                          xz_form
                                          row
                                          animated
                                          slideInDown
                                        "
                                        v-for="count in counter"
                                        :key="count"
                                        style="
                                          border: 2px solid lightgrey;
                                          padding: 10px;
                                          margin-top: 5px;
                                          margin-bottom: 5px;
                                        "
                                      >
                                        <div
                                          data-repeater-list=""
                                          class="col-lg-12"
                                        >
                                          <div
                                            data-repeater-item=""
                                            class="
                                              form-group
                                              row
                                              align-items-center
                                            "
                                          >
                                            <div
                                              class="col-xs-1 delete_btn"
                                              style="border-radius: 14px"
                                            >
                                              <div
                                                data-repeater-delete=""
                                                class="btn"
                                                style="margin-right: 6px"
                                                v-on:click="
                                                  delete_xz_form(count)
                                                "
                                              >
                                                <span
                                                  style="
                                                    padding-top: 14px;
                                                    padding-left: 7px;
                                                  "
                                                >
                                                  <i
                                                    class="fas fa-trash-alt"
                                                  ></i>
                                                </span>
                                              </div>
                                            </div>
                                            <slot>
                                              <div class="col-md-3">
                                                <div class="form__group">
                                                  <div class="form__label">
                                                    <label class="label"
                                                      >Company Name</label
                                                    >
                                                  </div>
                                                  <input
                                                    name="first[]"
                                                    type="text"
                                                    class="form-control"
                                                    v-model="name"
                                                  />
                                                  <span
                                                    style="
                                                      color: #db4437;
                                                      font-size: 11px;
                                                    "
                                                    v-if="name == ''"
                                                    >{{ name_error }}</span
                                                  >
                                                </div>
                                              </div>
                                              <div class="col-md-3">
                                                <div class="form__group">
                                                  <div class="form__label">
                                                    <label class="label"
                                                      >Company Address</label
                                                    >
                                                  </div>
                                                  <div class="form_control">
                                                    <input
                                                      name="second[]"
                                                      v-model="address"
                                                      type="text"
                                                      class="form-control"
                                                    />
                                                    <span
                                                      style="
                                                        color: #db4437;
                                                        font-size: 11px;
                                                      "
                                                      v-if="address == ''"
                                                      >{{ address_error }}</span
                                                    >
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-3">
                                                <div class="form__group">
                                                  <div class="form__label">
                                                    <label class="label"
                                                      >Company Email</label
                                                    >
                                                  </div>
                                                  <div class="form_control">
                                                    <input
                                                      name="third[]"
                                                      type="text"
                                                      class="form-control"
                                                      v-model="email"
                                                    />
                                                    <span
                                                      style="
                                                        color: #db4437;
                                                        font-size: 11px;
                                                      "
                                                      v-if="email == ''"
                                                      >{{ email_error }}</span
                                                    >
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="col-md-3">
                                                <div class="form__group">
                                                  <div class="form__label">
                                                    <label class="label"
                                                      >Contact Number</label
                                                    >
                                                  </div>
                                                  <div class="form_control">
                                                    <input
                                                      name="fourth[]"
                                                      v-model="number"
                                                      type="number"
                                                      class="form-control"
                                                    />
                                                    <span
                                                      style="
                                                        color: #db4437;
                                                        font-size: 11px;
                                                      "
                                                      v-if="number == ''"
                                                      >{{ number_error }}</span
                                                    >
                                                  </div>
                                                </div>
                                              </div>
                                            </slot>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div
                                      class="col-12"
                                      style="text-align: center"
                                    >
                                      <button
                                        :disabled="disabled1"
                                        @click="delay1()"
                                        type="button"
                                        class="
                                          btn btn-primary
                                          mt-1
                                          me-1
                                          waves-effect waves-float waves-light
                                        "
                                      >
                                        Save Company Detail
                                      </button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                    </div>
                  </div>
                  <!-- /User Card -->
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import MaskedInput from "vue-masked-input";
export default {
  data() {
    return {
      company_settings: "individual",
      counter: 1,
      disabled: false,
      disabled1: false,
      disabled3: false,
      timeout: null,
      customer_inv: "",
      customer_inv_error: "",
      customer_credit: "",
      customer_credit_error: "",
      customer_pre: "",
      customer_pre_error: "",
      customer_voucher: "",
      customer_voucher_error: "",
      quotation: "",
      quotation_error: "",
      vendor_debit: "",
      vendor_debit_error: "",
      vendor_inv: "",
      vendor_inv_error: "",
      vendor_pre: "",
      vendor_pre_error: "",
      vendor_voucher: "",
      vendor_voucher_error: "",
      requistion: "",
      requistion_error: "",
      journal_voucher: "",
      journal_voucher_error: "",
      name: "",
      email: "",
      address: "",
      number: "",
      name_error: "",
      address_error: "",
      email_error: "",
      number_error: "",
    };
  },
  components: {
    MaskedInput,
  },
  methods: {
    add_xz_repeater() {
      this.counter++;
      // let itm  = document.getElementsByClassName("xz_form")[0];
      // let cln = itm.cloneNode(true);
      // cln.id = this.counter;
      // document.getElementsByClassName("container")[0].insertBefore(cln,document.getElementsByClassName("adding")[0]);
    },
    delete_xz_form(id) {
      const r = confirm("Are you sure?");
      if (r == true) {
        let node = document.getElementById(id);
        node.remove();
      }
    },
    delay3() {
      if (
        this.customer_inv == "" ||
        this.customer_credit == "" ||
        this.customer_pre == "" ||
        this.customer_voucher == "" ||
        this.quotation == "" ||
        this.vendor_debit == "" ||
        this.vendor_inv == "" ||
        this.vendor_pre == "" ||
        this.vendor_voucher == "" ||
        this.requistion == "" ||
        this.journal_voucher == ""
      ) {
        this.$toastr.e("Please fill required fields!", "Caution!");
        if (this.customer_inv.length < 3) {
          this.customer_inv_error = "maximum 3 chracters required";
        }
        if (this.customer_credit.length < 3) {
          this.customer_credit_error = "maximum 3 chracters required";
        }
        if (this.customer_pre.length < 4) {
          this.customer_pre_error = "maximum 4 chracters required";
        }
        if (this.customer_voucher.length < 3) {
          this.customer_voucher_error = "maximum 3 chracters required";
        }
        if (this.quotation.length < 4) {
          this.quotation_error = "maximum 4 chracters required";
        }
        if (this.vendor_debit.length < 3) {
          this.vendor_debit_error = "maximum 3 chracters required";
        }
        if (this.vendor_inv.length < 3) {
          this.vendor_inv_error = "maximum 3 chracters required";
        }
        if (this.vendor_pre.length < 4) {
          this.vendor_pre_error = "maximum 4 chracters required";
        }
        if (this.vendor_voucher.length < 3) {
          this.vendor_voucher_error = "maximum 3 chracters required";
        }
        if (this.requistion.length < 3) {
          this.requistion_error = "maximum 4 chracters required";
        }
        if (this.journal_voucher.length < 4) {
          this.journal_voucher_error = "maximum 4 chracters required";
        }
      }
    },
    delay1() {
      if (
        this.name == "" ||
        this.email == "" ||
        this.address == "" ||
        this.number == ""
      ) {
        this.$toastr.e("Please fill required fields!", "Caution!");
        if (this.name == "") {
          this.name_error = "Please enter name";
        }
        if (this.email == "") {
          this.email_error = "Please enter email";
        }
        if (this.address == "") {
          this.address_error = "Please enter address";
        }
        if (this.number == "") {
          this.number_error = "Please enter number";
        }
      }
      this.disabled1 = true;
      this.disabled3 = true;
      this.timeout1 = setTimeout(() => {
        this.disabled1 = false;
        this.disabled3 = false;
      }, 5000);
      this.test_array();
    },
    test_array() {
      var first = document.getElementsByName("first[]");
      var second = document.getElementsByName("second[]");
      var third = document.getElementsByName("third[]");
      var fourth = document.getElementsByName("fourth[]");
      var k = "zero";
      var l = "zero";
      var m = "zero";
      var n = "zero";
      for (var i = 0; i < first.length; i++) {
        var a = first[i];
        k = k + "," + a.value;
      }
      for (var j = 0; j < second.length; j++) {
        var b = second[j];
        l = l + "," + b.value;
      }
      for (var g = 0; g < third.length; g++) {
        var c = third[g];
        m = m + "," + c.value;
      }

      for (var h = 0; h < fourth.length; h++) {
        var d = fourth[h];
        n = n + "," + d.value;
      }

      axios
        .post("./insert_education", {
          first: k,
          second: l,
          third: m,
          fourth: n,
          id: this.id,
        })
        .then((data) => {
          this.$toastr.s(
            "Inserted Education Step Successfully",
            "Congratulations"
          );
        })
        .catch((error) => console.log(error));
    },
  },

  mounted() {},
};
</script>
