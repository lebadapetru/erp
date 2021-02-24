<template>
  <!--begin::Add ProductForm-->
  <form class="form">
    <div class="row">
      <div class="col-xl-8">
        <!--begin::Title&Description-->
        <div class="card card-custom mt-4">
          <div class="card-body">
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
        </div>
        <!--end::Title&Description-->
        <!--begin::Media-->
        <div class="card card-custom mt-4">
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-label">Media</h3>
            </div>
            <div class="card-toolbar">
              <a href="#">
                Add media from url

                <span>
                  <i class="ki ki-bold-triangle-bottom icon-sm"></i>
                </span>

              </a>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group row">
              <div class="col-12">
                <VDropZone />
                <span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
              </div>
            </div>
          </div>
        </div>
        <!--end::Media-->
        <!--begin::Pricing-->
        <div class="card card-custom mt-4">
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-label">Pricing</h3>
            </div>
            <div class="card-toolbar">
            </div>
          </div>
          <div class="card-body">
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
        </div>
        <!--end::Pricing-->
        <!--begin::Inventory-->
        <div class="card card-custom mt-4">
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-label">Inventory</h3>
            </div>
            <div class="card-toolbar">
            </div>
          </div>
          <div class="card-body">
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
            <div class="row">
              <div class="col-12">
                <div class="checkbox-inline">
                  <label class="checkbox">
                    <input type="checkbox" />
                    <span></span>Track quantity
                  </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="checkbox-inline">
                  <label class="checkbox">
                    <input type="checkbox" />
                    <span></span>Continue selling when out of stock
                  </label>
                </div>
              </div>
            </div>
          </div>

          <div class="card-footer">
            <div class="card-title">
              <h6 class="card-label">Quantity</h6>
            </div>

            <div class="form-group row">
              <div class="col-12">
                <label>Available</label>
                  <input type="number" class="form-control" placeholder="0" value="0" />
              </div>
            </div>
          </div>
        </div>
        <!--end::Inventory-->
        <!--begin::Shipping-->
        <div class="card card-custom mt-4">
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-label">Shipping</h3>
            </div>
            <div class="card-toolbar">
            </div>
          </div>
          <div class="card-body">
            <div class="checkbox-inline">
              <label class="checkbox">
                <input type="checkbox" />
                <span></span>This is a physical product
              </label>
            </div>
          </div>
          <div class="card-footer">
            <div class="form-group row">
              <div class="col-7">
                <div class="row">
                  <div class="col-9">
                    <label>Weight</label>
                    <input type="text" class="form-control" placeholder="0.0" value="0.0" />
                  </div>
                  <div class="col-3">
                    <label>Measure unit</label>
                    <VSelect />
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="card-footer">
            <span class="form-text text-muted">Customers won’t enter their shipping address or choose a shipping method when buying this product.</span>
          </div>
        </div>
        <!--end::Shipping-->
        <!--begin::Variants-->
        <div class="card card-custom mt-4">
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-label">Variants</h3>
            </div>
            <div class="card-toolbar">
            </div>
          </div>
          <div class="card-body">
            <div class="form-group row">
              <div class="col-12">
                <div class="checkbox-inline">
                  <label class="checkbox">
                    <input type="checkbox" />
                    <span></span>This product has multiple options, like different sizes or colors
                  </label>
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
        <!--end::Variants-->
      </div>
      <div class="col-xl-4">
        <!--begin::Product status & visibility-->
        <div class="card card-custom mt-4">
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-label">Product status & visibility</h3>
            </div>
            <div class="card-toolbar">
                  <span class="switch switch-outline switch-icon switch-success">
                      <label>
                        <input type="checkbox" checked="checked" name="select" />
                        <span></span>
                      </label>
                    </span>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group row">
              <div class="col-12">
                <VSelect />
                <span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="card-title">
              <h6 class="card-label">Sales channels and apps</h6>
            </div>

            <div>
              <div class="checkbox-inline mb-2">
                <label class="checkbox">
                  <input type="checkbox" checked />
                  <span></span>Online store
                </label>
              </div>

              <a href="#">Schedule availability</a>
            </div>
          </div>
        </div>
        <!--end::Product status & visibility-->
        <!--begin::Organization-->
        <div class="card card-custom mt-4">
          <div class="card-header">
            <div class="card-title">
              <h3 class="card-label">Organization</h3>
            </div>
            <div class="card-toolbar">
            </div>
          </div>
          <div class="card-body">
            <div class="form-group row">
              <div class="col-12">
                <label>Vendor</label>
                <VSelect />
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="card-title">
              <h6 class="card-label">Categories</h6>
            </div>

            <VSelect2
                :placeholder="`Search for categories`"
                :has-tags="true"
                :has-multiple="true"
                :data='categories'
                :add-item-callback="addCategory"
            />
            <span class="form-text text-muted">Add this product to a category so it’s easy to find in your store.</span>
          </div>

          <div class="card-footer">
            <div class="card-title">
              <h6 class="card-label">Tags</h6>
            </div>

            <VSelect />
          </div>
        </div>
        <!--end::Organization-->
      </div>
    </div>
  </form>
  <!--end::AddProductForm-->

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
import VSelect from "resources/components/forms/inputs/VSelect";
import VSelect2 from "resources/components/forms/inputs/VSelect2";

export default {
  name: "AddProduct",
  components: {
    VCKEditor,
    VDropZone,
    VSelect,
    VSelect2,
  },
  setup() {
    let isSubmitDropdownVisible = ref(false)
    let categories = ref([])
    const getCategories = async () => {
      const response = await httpClient.get('/api/categories')
      response.data.forEach(category => {
        categories.value.push({
          id: category.id,
          text: category.title,
        })
      })

      console.log(categories)
    }
    getCategories()
    const addCategory = (category) => {
      httpClient.post('/api/categories', {
        title: category?.text
      }).then((response) => {
        console.log('added')
        console.log(response)
      })

      return Promise.resolve('test')
    }
    const toggleSubmitDropdown = () => {
      isSubmitDropdownVisible.value = !isSubmitDropdownVisible.value
    }

    const hideSubmitDropdown = () => {
      isSubmitDropdownVisible.value = false
    }
    return {
      toggleSubmitDropdown,
      hideSubmitDropdown,
      isSubmitDropdownVisible,
      categories,
      addCategory
    }
  }
}
</script>

<style scoped>
.dropdown-menu-right {
  position: absolute;
  transform: translate3d(-30px, 40px, 0px);
  top: 0;
  left: 0;
  will-change: transform;
}
</style>