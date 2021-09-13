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

<script lang="ts">
import { ref ,defineComponent } from 'vue'
import validationSchema from "./validationSchema"
import VBaseForm from "resources/components/forms/VBaseForm.vue";
import VProductFormToolbarActions from "resources/views/products/components/teleports/VProductFormToolbar.vue";
import VTitleAndDescriptionSection
  from "resources/views/products/components/forms/product/sections/VTitleAndDescriptionSection.vue";
import VMediaSection from "resources/views/products/components/forms/product/sections/VMediaSection.vue";
import VPriceSection from "resources/views/products/components/forms/product/sections/VPriceSection.vue";
import VInventorySection from "resources/views/products/components/forms/product/sections/VInventorySection.vue";
import VShippingSection from "resources/views/products/components/forms/product/sections/VShippingSection.vue";
import VVariantsSection from "resources/views/products/components/forms/product/sections/VVariantsSection.vue";
import VProductStatusAndVisibilitySection
  from "resources/views/products/components/forms/product/sections/VProductStatusAndVisibilitySection.vue";
import VOrganizationSection from "resources/views/products/components/forms/product/sections/VOrganizationSection.vue";
import Swal from "sweetalert2";
import { useStore } from "vuex";
import isEqual from 'lodash/isEqual'
import clone from 'lodash/clone'
import { onBeforeRouteLeave } from 'vue-router'

export default defineComponent({
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
      default: null,
      validator: (id: string) => {
        //match uuid syntax
        return /^[0-9a-f]{8}-[0-9a-f]{4}-[1-5][0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i.test(id)
      }
    }
  },
  setup(props) {
    const store = useStore()
    const productForm = ref(null)
    if (props.id) {
      store.dispatch('product/read', props.id)
    }

    const initialState = clone(store.getters['product/getProduct'])

    const onSubmit = (data) => {
      console.log(data)
      if (props.id) {
        store.dispatch('product/update', {
          id: props.id,
          data
        })
      } else {
        store.dispatch('product/create', data)
      }
    }

    onBeforeRouteLeave((to, from, next) => {
      console.log('route leave')
      console.log(initialState)
      console.log(store.getters['product/getProduct'])
      console.log(isEqual(store.getters['product/getProduct'], initialState))
      if(!isEqual(store.getters['product/getProduct'], initialState)) {
        Swal.fire({
          title: 'You want to leave the page?',
          text: `There are unsaved changes that will be lost!`,
          icon: 'warning',
          showCancelButton: true,
          buttonsStyling: false,
          cancelButtonColor: '#d33',
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Yes, leave!',
          customClass: {
            confirmButton: "btn font-weight-bold btn-light-primary",
            cancelButton: "btn font-weight-bold btn-light-primary",
          },
          heightAuto: false
        }).then((result) => {
          if (result.isConfirmed) {
            store.commit('product/resetState')
            next()
          }
        })
      } else {
        next()
      }
    })

    return {
      productForm,
      onSubmit,
      validationSchema,
    }
  }
})
</script>

<style scoped>
</style>