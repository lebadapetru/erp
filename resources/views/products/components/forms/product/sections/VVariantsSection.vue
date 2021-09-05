<template>
  <!--begin::Variants-->
  <div class="card card-custom">
    <div class="card-header">
      <div class="card-title">
        <h3 class="card-label">Variants</h3>
      </div>
      <div class="card-toolbar">
      </div>
    </div>
    <div class="card-body">
      <div class="row">
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
      <div class="row">
        <div class="col-6">
          <VSelectVariantOptions />
        </div>

        <div class="col-6">
          <label>Value</label>
          <!-- TODO create a multi tag input/use select2/find a plugin -->
          <input type="text" class="form-control" placeholder="Separate options with a comma" value=""/>
        </div>
      </div>
    </div>
  </div>
  <!--end::Variants-->
</template>

<script lang="ts">
import { computed, defineComponent } from "vue";
import VSelectVariantOptions from "resources/views/products/components/forms/product/inputs/VSelectVariantOptions.vue";
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox.vue";
import { useStore } from "vuex";

export default defineComponent({
  name: "VVariantsSection",
  components: {
    VBaseCheckbox,
    VSelectVariantOptions,
  },
  setup() {
    const store = useStore()

    return {
      hasVariants: computed({
        get: () => store.getters["product/getHasVariants"],
        set: (value) => store.commit("product/setHasVariants", value)
      }),
    }
  }
})
</script>

<style scoped>

</style>