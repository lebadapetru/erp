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
import { toRefs, ref, onUnmounted } from 'vue'
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
import { useStore } from "vuex";

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
  props: {
    id: {
      type: String,
      required: false,
      validator: (id) => {
        //match uuid syntax
        return /^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i.test(id)
      }
    }
  },
  setup(props) {
    const store = useStore()
    const productForm = ref(null)

    if (props.id) {
      console.log(props.id)
      store.dispatch('product/readProduct', props.id)
    }

    const onSubmit = (data) => {
      //TODO in the future if additional business logic is needed before product creation
      //TODO move this into a vuex action
      console.log(data)
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

    onUnmounted(() => {
      store.commit('product/resetState')
    })

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