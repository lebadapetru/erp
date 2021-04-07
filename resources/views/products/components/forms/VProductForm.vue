<template>
  <!--begin::Add ProductForm-->
  <VBaseForm
    ref="productForm"
    :validation-schema="validationSchema"
    @submit="onSubmit"
  >
    <div class="row">
      <div class="col-xl-8">
        <!--begin::Title&Description-->
        <div class="card card-custom mt-4">
          <div class="card-body">
            <div class="form-group row">
              <div class="col-12">
                <VBaseInput
                  :label="'Title'"
                  :type="'text'"
                  placeholder="Cotton blue jeans"
                  :name="'title'"
                  v-model="title"
                />
              </div>
            </div>
            <div class="form-group row">
              <div class="col-12">
                <label>Description</label>
                <VTinyMCE v-model="description"/>
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
                <VDropZone/>
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

              <div class="col-5">
                <label>Original price</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                        <span class="input-group-text">
                          RON
                        </span>
                  </div>
                  <VBaseInput
                    :type="'text'"
                    :name="'originalPrice'"
                    @keypress="priceFilter"
                    :modelValue="originalPrice"
                    @update:modelValue="setOriginalPrice"
                    placeholder="0.00"
                  />
                </div>
              </div>

              <div class="col-4">
                <label>Reduced price</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                        <span class="input-group-text">
                          RON
                        </span>
                  </div>
                  <VBaseInput
                    :type="'text'"
                    :name="'reducedPrice'"
                    placeholder="0.00"
                    @keypress="priceFilter"
                    :modelValue="reducedPrice"
                    @update:modelValue="setReducedPrice"
                  />
                </div>
              </div>

              <div class="col-3">
                <label>Discount</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-percent fa-sm" style="color: unset;"></i>
                      </span>
                  </div>
                  <VBaseInput
                    :type="'number'"
                    :name="'discount'"
                    placeholder="0"
                    @keypress="integerFilter"
                    :modelValue="discount"
                    @update:modelValue="setDiscount"
                    :min="0"
                    :max="100"
                  />
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
                <VBaseInput
                  :label="'SKU (Stock Keeping Unit)'"
                  :name="'sku'"
                  :placeholder="'KS93528TUT'"
                  v-model="sku"
                />
              </div>

              <div class="col-6">
                <VBaseInput
                  :label="'Barcode (ISBN, UPC, GTIN, etc.)'"
                  :name="'barcode'"
                  :placeholder="'480528304523'"
                  v-model="barcode"
                />
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="checkbox-inline">
                  <VBaseCheckbox
                    :label="'Track quantity'"
                    :name="'isTrackQuantity'"
                    v-model:checked="isTrackQuantity"
                  />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="checkbox-inline">
                  <VBaseCheckbox
                    :label="'Continue selling when out of stock'"
                    :name="'isContinueSellingOutOfStock'"
                    v-model:checked="isContinueSellingOutOfStock"
                  />
                </div>
              </div>
            </div>
          </div>

          <div
            v-show="isTrackQuantity"
            class="card-footer"
          >
            <div class="card-title">
              <h6 class="card-label">Quantity</h6>
            </div>

            <div class="form-group row">
              <div class="col-12">
                <VBaseInput
                  :label="'Available'"
                  :type="'number'"
                  :name="'quantity'"
                  placeholder="0"
                  @keypress="integerFilter"
                  :min="0"
                  v-model="quantity"
                />
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
              <VBaseCheckbox
                :label="'This is a physical product'"
                :name="'isPhysicalProduct'"
                v-model:checked="isPhysicalProduct"
              />
            </div>
          </div>
          <div
            v-if="isPhysicalProduct"
            class="card-footer"
          >
            <div class="form-group row">
              <div class="col-12">
                <div class="row">
                  <div class="col-8">
                    <VBaseInput
                      :label="'Weight'"
                      :type="'number'"
                      :min="0"
                      :name="'weight'"
                      :placeholder="'0.00'"
                      v-model="weight"
                    />
                  </div>
                  <div class="col-4">
                    <VBaseSelect
                      :label="'Measurement unit'"
                      :name="'measurementUnit'"
                      :options="measurementUnits"
                      v-model="measurementUnit"
                    />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div
            v-else
            class="card-footer"
          >
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
                  <VBaseCheckbox
                    :label="'This product has multiple options, like different sizes or colors'"
                    :name="'hasVariants'"
                    v-model:checked="hasVariants"
                  />
                </div>
              </div>
            </div>
          </div>
          <div
            v-if="hasVariants"
            class="card-footer"
          >
            <div class="form-group row">
              <div class="col-6">
                <label>Option 1</label>
<!--                <VBaseSelect
                  :placeholder="'Separate options with a comma'"
                />-->
              </div>

              <div class="col-6">
                <label>Value</label>
                <input type="text" class="form-control" placeholder="Separate options with a comma" value=""/>
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
                <VBaseCheckbox
                  :name="'isPublic'"
                  :style-classes="''"
                  v-model:checked="isPublic"
                />
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
                  <input type="checkbox" checked/>
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
                <VSelect/>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="card-title">
              <h6 class="card-label">Categories</h6>
            </div>

            <VSelectCategories/>

            <span class="form-text text-muted">Add this product to a category so it’s easy to find in your store.</span>
          </div>

          <div class="card-footer">
            <div class="card-title">
              <h6 class="card-label">Tags</h6>
            </div>

            <VSelect/>
          </div>
        </div>
        <!--end::Organization-->
      </div>
    </div>
    <VProductFormToolbarActions
      v-if="productForm"
      :target-form="productForm"
    />
  </VBaseForm>
  <!--end::AddProductForm-->


</template>

<script>
import { toRefs, reactive, ref, watch } from 'vue'
import { object, string, number, boolean, ref as yupRef } from 'yup'
import VBaseForm from "resources/components/forms/VBaseForm";
import VCKEditor from "resources/components/forms/inputs/VCKEditor"
import VTinyMCE from "resources/components/forms/inputs/VTinyMCE";
import VDropZone from "resources/components/forms/inputs/VDropZone";
import VSelect from "resources/components/forms/inputs/VSelect";
import VSelectCategories from "resources/views/products/components/forms/inputs/VSelectCategories";
import VProductFormToolbarActions from "resources/views/products/components/teleports/VProductFormToolbarActions";
import VBaseInput from "resources/components/forms/inputs/VBaseInput";
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox";
import { priceFilter, integerFilter } from "resources/js/helpers/inputFilters";
import VBaseSelect from "resources/components/forms/inputs/VBaseSelect";

export default {
  name: "VProductForm",
  components: {
    VBaseSelect,
    VBaseForm,
    VBaseInput,
    VBaseCheckbox,
    VProductFormToolbarActions,
    VCKEditor,
    VTinyMCE,
    VDropZone,
    VSelect,
    VSelectCategories,
  },
  setup() {
    const state = reactive({
      title: '',
      description: '',
      originalPrice: 0,
      reducedPrice: 0,
      discount: 0,
      sku: '',
      barcode: '',
      isTrackQuantity: true,
      isContinueSellingOutOfStock: false,
      quantity: 0,
      isPhysicalProduct: true,
      weight: 0,
      measurementUnit: 1,
      //TODO add a setting to let user choose the measurement system
      //create a table for them
      measurementUnits: [
        {
          label: 'kg',
          value: 1
        },
        {
          label: 'g',
          value: 2
        }
      ],
      hasVariants: false,
      //TODO create table
      variantOptions: [],
      variants: [
        {}
      ],
      isPublic: true
    })
    const productForm = ref(null)

    const validationSchema = object().shape({
      title: string().trim().required('Title is required.'),
      description: string(),
      originalPrice: number()
        .nullable()
        .min(0)
        .transform((v) => (v === '' || Number.isNaN(v) ? null : v)),
      reducedPrice: number()
        .nullable()
        .min(0)
        .transform((v) => (v === '' || Number.isNaN(v) ? null : v)),
      discount: number()
        .nullable()
        .min(0)
        .max(100)
        .transform((v) => (v === '' || Number.isNaN(v) ? null : v)),
      sku: string().trim(),
      barcode: string().trim(),
      isTrackQuantity: boolean(),
      isContinueSellingOutOfStock: boolean(),
      quantity: number()
        .nullable()
        .integer()
        .min(0)
        .transform((v) => (v === '' || Number.isNaN(v) ? null : v)),
      isPhysicalProduct: boolean(),
      weight: number()
        .nullable()
        .min(0)
        .transform((v) => (v === '' || Number.isNaN(v) ? null : v)),
      measurementUnit: number().integer()
    });

    const onSubmit = (data) => {
      console.log('final submit')
      console.log(data)
    }

    const setOriginalPrice = (value) => {
      console.log('setOriginalPrice')
      state.originalPrice = value
    }
    const setReducedPrice = (value) => {
      console.log('setReducedPrice')
      let tmpReducedPrice = (value <= state.originalPrice) ? value : state.reducedPrice
      console.log(100 - ((tmpReducedPrice * 100) / state.originalPrice))
      console.log(tmpReducedPrice)
      //or ((originalPrice-reducedPrice)/originalPrice))*100
      state.discount = 100 - ((tmpReducedPrice * 100) / state.originalPrice)
      state.reducedPrice = tmpReducedPrice
    }
    const setDiscount = (value) => {
      console.log('setDiscount')
      state.discount = (value <= 100) ? value : state.discount
      let tmpReducedPrice = state.originalPrice - (state.originalPrice * (state.discount / 100))
      state.reducedPrice = (tmpReducedPrice > 0) ? (Math.round(tmpReducedPrice) == (Math.round(tmpReducedPrice * 100) / 100) ? Math.round(tmpReducedPrice) : (Math.round(tmpReducedPrice * 100) / 100)) : 0
      console.log(tmpReducedPrice)
      console.log((tmpReducedPrice > 0) ? (Math.round(tmpReducedPrice) == (Math.round(tmpReducedPrice * 100) / 100) ? Math.round(tmpReducedPrice) : (Math.round(tmpReducedPrice * 100) / 100)) : 0)

    }

    /*watch(() => state.originalPrice, () => {
      if (state.originalPrice === '' || isNaN(state.originalPrice)) {
        return
      }
      console.log('watcher')
      setReducedPrice()
      setDiscount()
    })*/

    return {
      ...toRefs(state),
      productForm,
      onSubmit,
      validationSchema,
      priceFilter,
      integerFilter,
      setOriginalPrice,
      setReducedPrice,
      setDiscount,

    }
  }
}
</script>

<style scoped>
</style>