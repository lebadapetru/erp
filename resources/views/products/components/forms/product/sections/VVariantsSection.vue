<template>
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
          <VSelectVariantOptions />
        </div>

        <div class="col-6">
          <label>Value</label>
          <input type="text" class="form-control" placeholder="Separate options with a comma" value=""/>
        </div>
      </div>
    </div>
  </div>
  <!--end::Variants-->
</template>

<script>
import { computed } from "vue";
import VSelectVariantOptions from "resources/views/products/components/forms/product/inputs/VSelectVariantOptions";
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox";
import VSelect2 from "resources/components/forms/inputs/VSelect2";
import { useStore } from "vuex";

export default {
  name: "VVariantsSection",
  components: {
    VBaseCheckbox,
    VSelect2,
    VSelectVariantOptions,
  },
  setup() {
    const store = useStore()

    let hasVariants = computed({
      get: () => store.getters["product/getHasVariants"],
      set: (value) => store.commit("product/setHasVariants", value)
    })

    return {
      hasVariants,
    }
  }
}
</script>

<style scoped>

</style>