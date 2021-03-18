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
                <label>Title</label>
                <VBaseInput
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
                <VTinyMCE v-model="description" />
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
                      v-model="originalPrice"
                      placeholder="0.00"
                      @keypress="allowMoneyValues"
                  />
                </div>
              </div>

              <div class="col-5">
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
                      v-model="reducedPrice"
                      placeholder="0.00"
                      @keypress="allowMoneyValues"
                  />
                </div>
              </div>

              <div class="col-2">
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
                      v-model="discount"
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

            <VSelectCategories />

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
    <VProductFormToolbarActions
        v-if="productForm"
        :target-form="productForm"
    />
  </VBaseForm>
  <!--end::AddProductForm-->


</template>

<script>
import { toRefs, reactive, ref } from 'vue'
import { object, string } from 'yup'
import VBaseForm from "resources/components/forms/VBaseForm";
import VCKEditor from "resources/components/forms/inputs/VCKEditor"
import VTinyMCE from "resources/components/forms/inputs/VTinyMCE";
import VDropZone from "resources/components/forms/inputs/VDropZone";
import VSelect from "resources/components/forms/inputs/VSelect";
import VSelectCategories from "resources/views/products/components/forms/inputs/VSelectCategories";
import VProductFormToolbarActions from "resources/views/products/components/teleports/VProductFormToolbarActions";
import VBaseInput from "resources/components/forms/inputs/VBaseInput";

export default {
  name: "VProductForm",
  components: {
    VBaseForm,
    VBaseInput,
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
    })
    const productForm = ref(null)

    const validationSchema = object().shape({
      title: string().trim().required('Title is required.'),
      description: string().required('Description is required.'),
    });

    const onSubmit = (data) => {
      console.log('final submit')
      console.log(data)
    }

    function setInputFilter(textbox, inputFilter) {
      ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
        textbox.addEventListener(event, function() {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          } else {
            this.value = "";
          }
        });
      });
    }

    return {
      ...toRefs(state),
      allowMoneyValues: (value) => {
        setInputFilter(value)
      },
      productForm,
      onSubmit,
      validationSchema
    }
  }
}
</script>

<style scoped>
</style>