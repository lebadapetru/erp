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
        <VOrganizationSection />
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
import { toRefs, ref } from 'vue'
import validationSchema from "./validationSchema"
import VBaseForm from "resources/components/forms/VBaseForm";
import VProductFormToolbarActions from "resources/views/products/components/teleports/VProductFormToolbar";
import VTitleAndDescriptionSection
  from "resources/views/products/components/forms/product/sections/VTitleAndDescriptionSection";
import VMediaSection from "resources/views/products/components/forms/product/sections/VMediaSection";
import VPriceSection from "resources/views/products/components/forms/product/sections/VPriceSection";
import VInventorySection from "resources/views/products/components/forms/product/sections/VInventorySection";
import VShippingSection from "resources/views/products/components/forms/product/sections/VShippingSection";
import VVariantsSection from "resources/views/products/components/forms/product/sections/VVariantsSection";
import VProductStatusAndVisibilitySection
  from "resources/views/products/components/forms/product/sections/VProductStatusAndVisibilitySection";
import VOrganizationSection from "resources/views/products/components/forms/product/sections/VOrganizationSection";
import { createProduct } from "resources/js/api/Product";
import Swal from "sweetalert2";

export default {
  name: "VProductForm",
  components: {
    VBaseForm,
    VProductFormToolbarActions,
    VTitleAndDescriptionSection,
    VMediaSection,
    VPriceSection,
    VInventorySection,
    VShippingSection,
    VVariantsSection,
    VProductStatusAndVisibilitySection,
    VOrganizationSection,
  },
  setup() {
    const productForm = ref(null)

    const onSubmit = (data) => {
      //TODO in the future if additional business logic is needed before product creation
      //TODO move this into a vuex action
      createProduct(data).then(() => {
        Swal.fire({
          text: 'The product has been created!',
          icon: "success",
          buttonsStyling: false,
          confirmButtonText: "Ok, got it!",
          customClass: {
            confirmButton: "btn font-weight-bold btn-light-primary"
          },
          heightAuto: false
        }).then(() => {
          //TODO based on the submit type, redirect or do something else
        })
      })
    }

    return {
      productForm,
      onSubmit,
      validationSchema,
    }
  }
}
</script>

<style scoped>
</style>