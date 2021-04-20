<template>
  <!--begin::Add ProductForm-->
  <VBaseForm
    ref="productForm"
    :validation-schema="validationSchema"
    @submit="onSubmit"
  >
    <div class="row">
      <div class="col-xl-8">
        <VTitleAndDescriptionSection />
        <VMediaSection />
        <VPriceSection />
        <VInventorySection />
        <VShippingSection />
        <VVariantsSection />
      </div>
      <div class="col-xl-4">
        <VProductStatusAndVisibilitySection />
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
                <VBaseSelect
                  :label="'Vendor'"
                  :name="'vendor'"
                  :options="vendors"
                  v-model="vendor"
                />
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

            <VSelectTags />
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
import validationSchema from "./validationSchema"
import VBaseForm from "resources/components/forms/VBaseForm";
import VCKEditor from "resources/components/forms/inputs/VCKEditor"
import VTinyMCE from "resources/components/forms/inputs/VTinyMCE";
import VDropZone from "resources/components/forms/inputs/VDropZone";
import VSelect from "resources/components/forms/inputs/VSelect";
import VSelectCategories from "resources/views/products/components/forms/product/inputs/VSelectCategories";
import VSelectTags from "resources/views/products/components/forms/product/inputs/VSelectTags";
import VProductFormToolbarActions from "resources/views/products/components/teleports/VProductFormToolbarActions";
import VBaseInput from "resources/components/forms/inputs/VBaseInput";
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox";
import { priceFilter, integerFilter } from "resources/js/helpers/inputFilters";
import VBaseSelect from "resources/components/forms/inputs/VBaseSelect";
import { useStore } from 'vuex'
import VTitleAndDescriptionSection
  from "resources/views/products/components/forms/product/sections/VTitleAndDescriptionSection";
import VMediaSection from "resources/views/products/components/forms/product/sections/VMediaSection";
import VPriceSection from "resources/views/products/components/forms/product/sections/VPriceSection";
import VInventorySection from "resources/views/products/components/forms/product/sections/VInventorySection";
import VShippingSection from "resources/views/products/components/forms/product/sections/VShippingSection";
import VVariantsSection from "resources/views/products/components/forms/product/sections/VVariantsSection";
import VProductStatusAndVisibilitySection
  from "resources/views/products/components/forms/product/sections/VProductStatusAndVisibilitySection";

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
    VSelectTags,
    VTitleAndDescriptionSection,
    VMediaSection,
    VPriceSection,
    VInventorySection,
    VShippingSection,
    VVariantsSection,
    VProductStatusAndVisibilitySection,
  },
  setup() {
    const state = reactive({
      isPublic: true,
      vendors: [],
      vendor: ''
    })
    const productForm = ref(null)

    const store = useStore();



    const onSubmit = (data) => {
      console.log('final submit')
      console.log(data)
    }

    return {
      ...toRefs(state),
      productForm,
      onSubmit,
      validationSchema,
      priceFilter,
      integerFilter,
    }
  }
}
</script>

<style scoped>
</style>