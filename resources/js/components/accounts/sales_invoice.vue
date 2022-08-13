<template>
  <div >
    <div class="app-content content">
      <div class="noprint content-overlay"></div>
      <div class="noprint cheader-navbar-shadow"></div>
      <div class="content-wrapper container-xxl p-0">
        <div class="noprint content-header row">
          <div class="breadcrumb-wrapper">
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <router-link to="/hr/dashboard" style="text-decoration: none"
                  >Accounts Dashboard</router-link
                >
              </li>
              <li class="breadcrumb-item active">Sale(s) Invoice</li>
            </ol>
          </div>
        </div>
        <div class="content-body">
          <section class="invoice-add-wrapper">
            <div class="row invoice-add">
              <!-- Invoice Add Left starts -->
              <div class="col-xl-9 col-md-8 col-12">
                <div class="card invoice-preview-card">
                  <!-- Header starts -->
                  <div class="card-body pb-0">
                    <div
                      class="
                        d-flex
                        justify-content-between
                        flex-md-row flex-column
                        invoice-spacing
                        mt-0
                      "
                      style="margin-bottom: 0px"
                    >
                      <div
                        v-for="companydetail1 in companydetail"
                        :key="companydetail1"
                        style="margin-left: 30px"
                      >
                        <div
                          style="padding-top: 10px; margin-bottom: 0px"
                          class="logo-wrapper"
                        >
                          <h3
                            class="text-primary invoice-logo"
                            style="margin-left: 0px"
                          >
                            {{ companydetail1.company_name }}
                          </h3>
                        </div>
                        <p class="card-text mb-25">
                          Address: {{ companydetail1.company_address }} ,
                        </p>
                        <p class="card-text mb-25">
                          City: {{ companydetail1.city }} -
                          {{ companydetail1.country }}
                        </p>
                        <p class="card-text mb-0">
                          Phone: {{ companydetail1.phone_number }}
                        </p>
                      </div>
                      <div class="invoice-number-date mt-md-0 mt-2">
                        <div
                          class="
                            d-flex
                            align-items-center
                            justify-content-md-end
                            mb-1
                          "
                        >
                          <h4 class="invoice-title">Invoice</h4>
                          <div
                            class="
                              input-group input-group-merge
                              invoice-edit-input-group
                            "
                          >
                            <div class="input-group-text">
                              <i class="fa-solid fa-hashtag"></i>
                            </div>
                            <input
                              type="text"
                              v-model="invoice_input"
                              class="form-control invoice-edit-input"
                              placeholder="53634"
                            />
                            <span
                              style="color: #db4437; font-size: 11px"
                              v-if="invoice_input == ''"
                              >{{ invoice_input_error }}</span
                            >
                          </div>
                        </div>
                        <div class="d-flex align-items-center mb-1 flex-column">
                          <span class="title">Date:</span>
                          <input
                            type="date"
                            class="form-control invoice-edit-input"
                            v-model="invoice_input_date"
                          />
                          <span
                            style="color: #db4437; font-size: 11px"
                            v-if="invoice_input_date == ''"
                            >{{ invoice_input_date_error }}</span
                          >
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Header ends -->
                  <div class="divider">
                    <div
                      class="divider-text"
                      style="font-size: 24px; font-weight: 900"
                    >
                      Sales Invoice
                    </div>
                  </div>
                  <!-- Address and Contact starts -->
                  <div class="card-body invoice-padding pt-0">
                    <div
                      class="row row-bill-to invoice-spacing"
                      style="margin-top: 0px"
                    >
                      <div class="col-xl-8 mb-lg-1 col-bill-to ps-0">
                        <h6 class="invoice-to-title" style="margin-bottom: 5px">
                          Invoice To:
                        </h6>
                        <div class="invoice-customer">
                          <select
                            class="invoiceto form-select"
                            v-model="select_company"
                          >
                            <option></option>
                            <option value="shelby">
                              Shelby Company Limited
                            </option>
                            <option value="hunters">Hunters Corp</option>
                          </select>
                          <span
                            style="color: #db4437; font-size: 11px"
                            v-if="select_company == ''"
                            >{{ select_company_error }}</span
                          >
                        </div>
                      </div>
                      <div class="col-xl-4 p-0 ps-xl-2 mt-xl-0 mt-2">
                        <h6 class="mb-2">Payment Details:</h6>
                        <table>
                          <tbody>
                            <tr>
                              <td class="pe-1">Total Due:</td>
                              <td><strong>$12,110.55</strong></td>
                            </tr>
                            <tr>
                              <td class="pe-1">Bank name:</td>
                              <td>American Bank</td>
                            </tr>
                            <tr>
                              <td class="pe-1">Country:</td>
                              <td>United States</td>
                            </tr>
                            <tr>
                              <td class="pe-1">IBAN:</td>
                              <td>ETD95476213874685</td>
                            </tr>
                            <tr>
                              <td class="pe-1">SWIFT code:</td>
                              <td>BR91905</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                  <!-- Address and Contact ends -->
                  <!-- Product Details starts -->
                  <div
                    class="card-body invoice-padding invoice-product-details"
                  >
                    <div
                      class="form-group xz_form row animated slideInDown"
                      v-for="count in counter"
                      :key="count"
                      style="margin-top: 40px"
                    >
                      <div data-repeater-list="" class="col-lg-12">
                        <slot class="source-item">
                          <div data-repeater-list="group-a">
                            <div class="repeater-wrapper" data-repeater-item>
                              <div class="row">
                                <div
                                  class="
                                    col-12
                                    d-flex
                                    product-details-border
                                    position-relative
                                    pe-0
                                  "
                                >
                                  <div class="row w-100 pe-lg-0 pe-1 py-2">
                                    <div
                                      class="
                                        col-lg-5 col-12
                                        mb-lg-0 mb-2
                                        mt-lg-0 mt-2
                                      "
                                    >
                                      <p
                                        class="
                                          card-text
                                          col-title
                                          mb-md-50 mb-0
                                        "
                                      >
                                        Item
                                      </p>
                                      <select
                                        class="form-select item-details"
                                        name="first[]"
                                        v-model="items_details"
                                      >
                                        <option value="App Design">
                                          App Design
                                        </option>
                                        <option
                                          value="App Customization"
                                          selected
                                        >
                                          App Customization
                                        </option>
                                        <option value="ABC Template">
                                          ABC Template
                                        </option>
                                        <option value="App Development">
                                          App Development
                                        </option>
                                      </select>
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="items_details == ''"
                                        >{{ items_details_error }}</span
                                      >
                                      <textarea
                                        name="second[]"
                                        class="form-control mt-2"
                                        rows="1"
                                        placeholder="Customization & Bug Fixes"
                                        v-model="bug_fixes"
                                      ></textarea>
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="bug_fixes == ''"
                                        >{{ bug_fixes_error }}</span
                                      >
                                    </div>
                                    <div class="col-lg-3 col-12 my-lg-0 my-2">
                                      <p
                                        class="card-text col-title mb-md-2 mb-0"
                                      >
                                        Cost
                                      </p>
                                      <input
                                        name="third[]"
                                        type="number"
                                        class="form-control"
                                        placeholder="Per Item Cost"
                                        v-model="item_cost"
                                      />
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="item_cost == ''"
                                        >{{ item_cost_error }}</span
                                      >
                                      <div class="mt-2">
                                        <div class="row form-row mt-50">
                                          <div class="mb-1 col-md-12">
                                            <select
                                              name="fourth[]"
                                              id="tax-1-input"
                                              class="form-select tax-select"
                                              v-model="tax_input"
                                            >
                                              <option value="">
                                                Select Tax
                                              </option>
                                              <option value="0%">0%</option>
                                              <option value="1%">1%</option>
                                              <option value="10%">10%</option>
                                              <option value="18%">18%</option>
                                              <option value="40%">40%</option>
                                            </select>
                                            <span
                                              style="
                                                color: #db4437;
                                                font-size: 11px;
                                              "
                                              v-if="tax_input == ''"
                                              >{{ tax_input_error }}</span
                                            >
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="col-lg-2 col-12 my-lg-0 my-2">
                                      <p
                                        class="card-text col-title mb-md-2 mb-0"
                                      >
                                        Qty
                                      </p>
                                      <input
                                        type="number"
                                        class="form-control"
                                        name="fourth[]"
                                        value="1"
                                        placeholder="1"
                                        v-model="qty"
                                      />
                                      <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="qty == ''"
                                        >{{ qty_error }}</span
                                      >
                                    </div>
                                    <div class="col-lg-2 col-12 mt-lg-0 mt-2">
                                      <p
                                        class="
                                          card-text
                                          col-title
                                          mb-md-50 mb-0
                                        "
                                      >
                                        Price
                                      </p>
                                      <input
                                        name="fiveth[]"
                                        type="number"
                                        readonly
                                        class="form-control"
                                        placeholder=""
                                        v-model="price"
                                      />
                                      <!-- <span
                                        style="color: #db4437; font-size: 11px"
                                        v-if="price == ''"
                                        >{{ price_error }}</span
                                      > -->
                                    </div>
                                  </div>
                                  <div
                                    style="margin-left: 10px"
                                    class="
                                      d-flex
                                      flex-column
                                      align-items-centerjustify-content-between
                                      border-start
                                      invoice-product-actions
                                      py-50
                                      px-25
                                    "
                                  >
                                    <div
                                      class="delete_btn"
                                      style="border-radius: 14px"
                                    >
                                      <div
                                        data-repeater-delete=""
                                        class=""
                                        style="margin-right: 6px"
                                        v-on:click="delete_xz_form(count)"
                                      >
                                        <span
                                          style="
                                            padding-top: 14px;
                                            padding-left: 7px;
                                          "
                                        >
                                          <i class="fa-solid fa-xmark"></i>
                                        </span>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </slot>
                      </div>
                    </div>

                    <div class="row mt-1">
                      <div class="col-12 px-0">
                        <div
                          data-repeater-create=""
                          class="btn btn-primary btn-sm btn-add-new"
                          v-on:click="add_xz_repeater()"
                        >
                          <i data-feather="plus" class="me-25"></i>
                          <span class="align-middle">Add Item</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Product Details ends -->
                  <!-- Invoice Total starts -->
                  <div class="card-body invoice-padding">
                    <div class="row invoice-sales-total-wrapper">
                      <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                        <div class="d-flex flex-column align-items-center mb-1">
                          <label for="salesperson" class="form-label"
                            >Salesperson:</label
                          >
                          <input
                            type="text"
                            class="form-control ms-50"
                            id="salesperson"
                            placeholder="Edward Crowley"
                            v-model="salesperson"
                          />
                          <span
                            style="color: #db4437; font-size: 11px"
                            v-if="salesperson == ''"
                            >{{ salesperson_error }}</span
                          >
                        </div>
                      </div>
                      <div
                        class="
                          col-md-6
                          d-flex
                          justify-content-end
                          order-md-2 order-1
                        "
                      >
                        <div class="invoice-total-wrapper">
                          <div class="invoice-total-item">
                            <p class="invoice-total-title">Subtotal:</p>
                            <p class="invoice-total-amount">$1800</p>
                          </div>
                          <div class="invoice-total-item">
                            <p class="invoice-total-title">Discount:</p>
                            <p class="invoice-total-amount">$28</p>
                          </div>
                          <div class="invoice-total-item">
                            <p class="invoice-total-title">Tax:</p>
                            <p class="invoice-total-amount">21%</p>
                          </div>
                          <hr class="my-50" />
                          <div class="invoice-total-item">
                            <p class="invoice-total-title">Total:</p>
                            <p class="invoice-total-amount">$1690</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- Invoice Total ends -->
                  <hr class="invoice-spacing mt-0" />
                  <div class="card-body invoice-padding py-0">
                    <!-- Invoice Note starts -->
                    <div class="row">
                      <div class="col-12">
                        <div class="mb-2">
                          <label for="note" class="form-label fw-bold"
                            >Note:</label
                          >
                          <textarea class="form-control" rows="2" id="note">
It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance projects. Thank You!</textarea
                          >
                        </div>
                      </div>
                    </div>
                    <!-- Invoice Note ends -->
                  </div>
                </div>
              </div>
              <!-- Invoice Add Left ends -->
              <!-- Invoice Add Right starts -->
              <div class="col-xl-3 col-md-4 col-12">
                <div class="card">
                  <div class="card-body">
                    <button
                      class="btn btn-primary w-100 mb-75"
                      @click="post_invoice_btn_handler"
                    >
                      Post Invoice
                    </button>
                    <a href="#" class="btn btn-outline-primary w-100 mb-75"
                      >Preview</a
                    >
                  </div>
                </div>
              </div>
              <!-- Invoice Add Right ends -->
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      user_access: {},
      counter: 1,
      companydetail: {},
      invoice_input: "",
      invoice_input_error: "",
      invoice_input_date: "",
      invoice_input_date_error: "",
      select_company: "",
      select_company_error: "",
      items_details: "",
      items_details_error: "",
      salesperson: "",
      salesperson_error: "",
      tax_input: "",
      tax_input_error: "",
      disabled: false,
      timeout: null,
      price: "",
      price_error: "",
      qty: "",
      qty_error: "",
      item_cost: "",
      item_cost_error: "",
      bug_fixes: "",
      bug_fixes_error: "",
    };
  },
  methods: {
    post_invoice_btn_handler() {
      if (
        this.invoice_input == "" ||
        this.invoice_input_date == "" ||
        this.select_company == "" ||
        this.items_details == "" ||
        this.salesperson == "" ||
        this.tax_input == "" ||
        this.price == "" ||
        this.item_cost == "" ||
        this.bug_fixes == ""
      ) {
        this.$toastr.e("Please fill required fields!", "Caution!");
        if (this.invoice_input == "") {
          this.invoice_input_error = "Please enter edit invoice input";
        }
        if (this.invoice_input_date == "") {
          this.invoice_input_date_error = "Please enter invoice date input";
        }
        if (this.select_company == "") {
          this.select_company_error = "Please select company";
        }
        if (this.items_details == "") {
          this.items_details_error = "Please select item";
        }
        if (this.salesperson == "") {
          this.salesperson_error = "Please enter salesperson field";
        }
        if (this.tax_input == "") {
          this.tax_input_error = "Please select tax field";
        }
        if (this.price == "") {
          this.price_error = "Please enter price";
        }
        if (this.qty == "") {
          this.qty_error = "Please enter qty";
        }
        if (this.item_cost == "") {
          this.item_cost_error = "Please enter item cost ";
        }
        if (this.bug_fixes == "") {
          this.bug_fixes_error = "Please enter costomization & bug fixes";
        }
      }
    },
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
    delay() {
      this.disabled = true;
      this.timeout = setTimeout(() => {
        this.disabled = false;
      }, 5000);
      this.issue_warning();
    },
  },
  mounted() {
    
  },
};
</script>
<style scoped>
@media print {
  .noprint {
    visibility: hidden;
  }
}
.invoice-preview .invoice-padding,
.invoice-edit .invoice-padding,
.invoice-add .invoice-padding {
  padding-left: 2.5rem;
  padding-right: 2.5rem;
}

.invoice-preview .table th:first-child,
.invoice-preview .table td:first-child,
.invoice-edit .table th:first-child,
.invoice-edit .table td:first-child,
.invoice-add .table th:first-child,
.invoice-add .table td:first-child {
  padding-left: 2.5rem;
}

.invoice-preview .logo-wrapper,
.invoice-edit .logo-wrapper,
.invoice-add .logo-wrapper {
  display: flex;
  align-items: center;
  margin-bottom: 1.9rem;
}

.invoice-preview .logo-wrapper .invoice-logo,
.invoice-edit .logo-wrapper .invoice-logo,
.invoice-add .logo-wrapper .invoice-logo {
  font-size: 2.142rem;
  font-weight: bold;
  letter-spacing: -0.54px;
  margin-left: 1rem;
  margin-bottom: 0;
}

.invoice-preview .invoice-title,
.invoice-edit .invoice-title,
.invoice-add .invoice-title {
  font-size: 1.285rem;
  margin-bottom: 1rem;
}

.invoice-preview .invoice-title .invoice-number,
.invoice-edit .invoice-title .invoice-number,
.invoice-add .invoice-title .invoice-number {
  font-weight: 600;
}

.invoice-preview .invoice-date-wrapper,
.invoice-edit .invoice-date-wrapper,
.invoice-add .invoice-date-wrapper {
  display: flex;
  align-items: center;
}

.invoice-preview .invoice-date-wrapper:not(:last-of-type),
.invoice-edit .invoice-date-wrapper:not(:last-of-type),
.invoice-add .invoice-date-wrapper:not(:last-of-type) {
  margin-bottom: 0.5rem;
}

.invoice-preview .invoice-date-wrapper .invoice-date-title,
.invoice-edit .invoice-date-wrapper .invoice-date-title,
.invoice-add .invoice-date-wrapper .invoice-date-title {
  width: 7rem;
  margin-bottom: 0;
}

.invoice-preview .invoice-date-wrapper .invoice-date,
.invoice-edit .invoice-date-wrapper .invoice-date,
.invoice-add .invoice-date-wrapper .invoice-date {
  margin-left: 0.5rem;
  font-weight: 600;
  margin-bottom: 0;
}

.invoice-preview .invoice-spacing,
.invoice-edit .invoice-spacing,
.invoice-add .invoice-spacing {
  margin: 1.45rem 0;
}

.invoice-preview .invoice-number-date .title,
.invoice-edit .invoice-number-date .title,
.invoice-add .invoice-number-date .title {
  width: 115px;
}

.invoice-preview .invoice-total-wrapper,
.invoice-edit .invoice-total-wrapper,
.invoice-add .invoice-total-wrapper {
  width: 100%;
  max-width: 12rem;
}

.invoice-preview .invoice-total-wrapper .invoice-total-item,
.invoice-edit .invoice-total-wrapper .invoice-total-item,
.invoice-add .invoice-total-wrapper .invoice-total-item {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.invoice-preview
  .invoice-total-wrapper
  .invoice-total-item
  .invoice-total-title,
.invoice-edit .invoice-total-wrapper .invoice-total-item .invoice-total-title,
.invoice-add .invoice-total-wrapper .invoice-total-item .invoice-total-title {
  margin-bottom: 0.35rem;
}

.invoice-preview
  .invoice-total-wrapper
  .invoice-total-item
  .invoice-total-amount,
.invoice-edit .invoice-total-wrapper .invoice-total-item .invoice-total-amount,
.invoice-add .invoice-total-wrapper .invoice-total-item .invoice-total-amount {
  margin-bottom: 0.35rem;
  font-weight: 600;
}

@media (min-width: 768px) {
  .invoice-preview .invoice-title,
  .invoice-edit .invoice-title,
  .invoice-add .invoice-title {
    text-align: right;
    margin-bottom: 3rem;
  }
}

.invoice-edit .invoice-preview-card .invoice-title,
.invoice-add .invoice-preview-card .invoice-title {
  text-align: left;
  margin-right: 3.5rem;
  margin-bottom: 0;
}

.invoice-edit .invoice-preview-card .invoice-edit-input,
.invoice-edit .invoice-preview-card .invoice-edit-input-group,
.invoice-add .invoice-preview-card .invoice-edit-input,
.invoice-add .invoice-preview-card .invoice-edit-input-group {
  max-width: 11.21rem;
}

.invoice-edit .invoice-preview-card .invoice-product-details,
.invoice-add .invoice-preview-card .invoice-product-details {
  background-color: #fcfcfc;
  padding: 3.75rem 3.45rem 2.3rem 3.45rem;
}

.invoice-edit
  .invoice-preview-card
  .invoice-product-details
  .product-details-border,
.invoice-add
  .invoice-preview-card
  .invoice-product-details
  .product-details-border {
  border: 1px solid #ebe9f1;
  border-radius: 0.357rem;
}

.invoice-edit .invoice-preview-card .invoice-to-title,
.invoice-add .invoice-preview-card .invoice-to-title {
  margin-bottom: 1.9rem;
}

.invoice-edit .invoice-preview-card .col-title,
.invoice-add .invoice-preview-card .col-title {
  position: absolute;
  top: -1.75rem;
}

.invoice-edit .invoice-preview-card .item-options-menu,
.invoice-add .invoice-preview-card .item-options-menu {
  min-width: 20rem;
}

.invoice-edit .invoice-preview-card .repeater-wrapper:not(:last-child),
.invoice-add .invoice-preview-card .repeater-wrapper:not(:last-child) {
  margin-bottom: 3rem;
}

.invoice-edit .invoice-preview-card .invoice-calculations .total-amt-title,
.invoice-add .invoice-preview-card .invoice-calculations .total-amt-title {
  width: 100px;
}

@media (max-width: 769px) {
  .invoice-edit .invoice-preview-card .invoice-title,
  .invoice-add .invoice-preview-card .invoice-title {
    margin-right: 0;
    width: 115px;
  }
  .invoice-edit .invoice-preview-card .invoice-edit-input,
  .invoice-add .invoice-preview-card .invoice-edit-input {
    max-width: 100%;
  }
}

@media (max-width: 992px) {
  .invoice-edit .col-title,
  .invoice-add .col-title {
    position: unset !important;
    top: -1.5rem !important;
  }
}
</style>
