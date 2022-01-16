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
import { ref, defineComponent, onUnmounted } from 'vue'
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
import { useStore } from "vuex";
import isEqual from 'lodash/isEqual'
import clone from 'lodash/clone'
import { onBeforeRouteLeave } from 'vue-router'
import { Popup } from 'resources/components/alerts/popup';
import {
  ALERT_CONFIRM_BUTTON_TEXT_LEAVE_PAGE,
  ALERT_TEXT_LEAVE_PAGE,
  ALERT_TITLE_LEAVE_PAGE
} from 'resources/components/alerts/ts/constants';
import { uuidValidator } from "resources/ts/validators";

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
      validator: uuidValidator
    }
  },
  setup(props) {
    const store = useStore()
    const productForm = ref(null)
    let initialState = clone((store.getters['product/getProduct']))
    if (props.id) {
      store.dispatch('product/read', props.id).then(() => {
        initialState = clone((store.getters['product/getProduct']))
      })
    }

    const onSubmit = (data) => {
      console.log(data)
      if (props.id) {
        store.dispatch('product/update', {
          id: props.id,
          data
        }).then(() => {
          initialState = clone((store.getters['product/getProduct']))
        })
      } else {
        store.dispatch('product/create', data).then(() => {
          initialState = clone((store.getters['product/getProduct']))
        })
      }
    }

    onBeforeRouteLeave((to, from, next) => {
      if (!isEqual((store.getters['product/getProduct']), initialState)) {
        Popup.warning({
          title: ALERT_TITLE_LEAVE_PAGE,
          text: ALERT_TEXT_LEAVE_PAGE,
          confirmButtonText: ALERT_CONFIRM_BUTTON_TEXT_LEAVE_PAGE
        }).then((result) => {
          if (result.isConfirmed) {
            next()
          }
        })
      } else {
        next()
      }
    })

    onUnmounted(() => {
      store.commit('product/resetState')
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