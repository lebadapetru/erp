<template>
  <!--begin::Card-->
  <div class="card card-custom" id="kt_page_sticky_card">
    <div class="card-header">
      <div class="card-title">
        <h3 class="card-label">Add product</h3>
      </div>
      <div class="card-toolbar">
      </div>
    </div>
    <div class="card-body">
      <!--begin::Form-->
      <form class="form" id="kt_form">
        <div class="row">
          <div class="col-xl-8">
            <div class="my-5">
              <div class="form-group row">
                <div class="col-12">
                  <label>Title</label>
                  <input class="form-control" type="text" value="Shoes" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-12">
                  <label>Description</label>
                  <VCKEditor />
                </div>
              </div>
            </div>
            <div class="separator separator-dashed my-10"></div>
            <div class="my-5">
              <h3 class="text-dark font-weight-bold mb-10">Media</h3>
              <div class="form-group row">
                <div class="col-12">
                  <VDropZone />
                  <span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
                </div>
              </div>
            </div>
            <div class="separator separator-dashed my-10"></div>
            <div class="my-5">
              <h3 class="text-dark font-weight-bold mb-10">Pricing</h3>
              <div class="form-group row">
                <div class="col-6">
                  <label>Price</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
										  <span class="input-group-text">
											  RON
                      </span>
                    </div>
                    <input type="text" class="form-control" value="15" placeholder="0.00" />
                  </div>
                </div>

                <div class="col-6">
                  <label>Compare at price</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
											  RON
                      </span>
                    </div>
                    <input type="text" class="form-control" value="18" placeholder="0.00" />
                  </div>
                </div>
              </div>
            </div>
            <div class="separator separator-dashed my-10"></div>
            <div class="my-5">
              <h3 class="text-dark font-weight-bold mb-10">Inventory</h3>
              <div class="form-group row">
                <div class="col-6">
                  <label>SKU (Stock Keeping Unit)</label>
                  <input type="text" class="form-control" value="524" />
                </div>

                <div class="col-6">
                  <label>Barcode (ISBN, UPC, GTIN, etc.)</label>
                  <input type="text" class="form-control" value="1234567" />
                </div>
              </div>
              <div class="form-group row">
                <div class="col-12">
                  <label>Quantity</label>
                  <input type="number" class="form-control" placeholder="0" value="10" />
                </div>
              </div>
            </div>
            <div class="separator separator-dashed my-10"></div>
            <div class="my-5">
              <h3 class="text-dark font-weight-bold mb-10">Variants</h3>
              <div class="form-group row">
                <div class="col-12">
                  <div class="checkbox-inline">
                    <label class="checkbox">
                      <input type="checkbox" />
                      <span></span>This product has multiple options, like different sizes or colors</label>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-6">
                  <label>Option 1</label>
                  <input type="text" class="form-control" placeholder="Size" value="" />
                </div>

                <div class="col-6">
                  <label>Value</label>
                  <input type="text" class="form-control" placeholder="Separate options with a comma" value="" />
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4">

          </div>
        </div>
      </form>
      <!--end::Form-->
    </div>
  </div>
  <!--end::Card-->

  <teleport to="#toolbar">
    <!--begin::Button-->
    <a href="#" class="btn btn-default font-weight-bold">
      <i class="ki ki-long-arrow-back icon-xs"></i>
      Back
    </a>
    <!--end::Button-->
    <!--begin::Dropdown-->
    <div
        class="btn-group ml-2"
        :class="{'show': isSubmitDropdownVisible}"
        v-click-away="hideSubmitDropdown"
    >
      <button
          type="button"
          class="btn btn-primary font-weight-bold"
          @click="hideSubmitDropdown"
      >Save Product
      </button>
      <button
          type="button"
          class="btn btn-primary font-weight-bold dropdown-toggle dropdown-toggle-split"
          data-toggle="dropdown"
          aria-haspopup="true"
          :aria-expanded="isSubmitDropdownVisible"
          @click="toggleSubmitDropdown"
      ></button>
      <!--TODO vueClickAway to not affect the trigger      -->
      <div
          class="dropdown-menu dropdown-menu-sm p-0 m-0 dropdown-menu-right"
          :class="{'show': isSubmitDropdownVisible}"
      >
        <ul class="navi py-5">
          <li class="navi-item">
            <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="nav-icon flaticon2-reload"></i>
														</span>
              <span class="navi-text">Save &amp; continue</span>
            </a>
          </li>
          <li class="navi-item">
            <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="nav-icon flaticon2-add-1"></i>
														</span>
              <span class="navi-text">Save &amp; add new</span>
            </a>
          </li>
          <li class="navi-item">
            <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-left-arrow"></i>
														</span>
              <span class="navi-text">Save &amp; exit</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!--end::Dropdown-->
  </teleport>
</template>

<script>
import { ref } from 'vue'
import VCKEditor from "resources/components/forms/inputs/VCKEditor"
import VDropZone from "resources/components/forms/inputs/VDropZone";

export default {
  name: "AddProduct",
  components: {
    VCKEditor,
    VDropZone,
  },
  setup() {
    let isSubmitDropdownVisible = ref(false)

    const toggleSubmitDropdown = () => {
      isSubmitDropdownVisible.value = !isSubmitDropdownVisible.value
    }

    const hideSubmitDropdown = () => {
      isSubmitDropdownVisible.value = false
    }

    return {
      toggleSubmitDropdown,
      hideSubmitDropdown,
      isSubmitDropdownVisible
    }
  }
}
</script>

<style scoped>
.dropdown-menu-right {
  position: absolute;
  transform: translate3d(-72px, 38px, 0px);
  top: 0;
  left: 0;
  will-change: transform;
}
</style>