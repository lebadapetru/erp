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
import { toRefs, reactive, ref } from 'vue'
import validationSchema from "./validationSchema"
import VBaseForm from "resources/components/forms/VBaseForm";
import VProductFormToolbarActions from "resources/views/products/components/teleports/VProductFormToolbarActions";
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
import VOrganizationSection from "resources/views/products/components/forms/product/sections/VOrganizationSection";

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
    const state = reactive({})
    const productForm = ref(null)

    const store = useStore();



    const onSubmit = (data) => {
      console.log('final submit')
      console.log(data)
      httpClient.post('/api/products', data).then((response) => {
        console.log('sent')
        console.log(response)
      })
    }

    return {
      ...toRefs(state),
      productForm,
      onSubmit,
      validationSchema,
    }
  }
}
</script>

<style scoped>
</style>