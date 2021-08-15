<template>
  <!--begin::Shipping-->
  <div class="card card-custom">
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
      <div class="row">
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
                :placeholder="'kg'"
                :name="'measurementUnit'"
                :options="[]"
                :select-style-classes="'form-select form-select-solid text-muted'"
                disabled="true"
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
</template>

<script>
import VBaseInput from "resources/components/forms/inputs/VBaseInput";
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox";
import VBaseSelect from "resources/components/forms/inputs/VBaseSelect";
import { computed } from "vue";
import { useStore } from "vuex";

export default {
  name: "VShippingSection",
  components: {
    VBaseInput,
    VBaseCheckbox,
    VBaseSelect,
  },
  setup() {
    const store = useStore()

    return {
      isPhysicalProduct: computed({
        get: () => store.getters["product/getIsPhysicalProduct"],
        set: (value) => store.commit("product/setIsPhysicalProduct", value)
      }),
      weight: computed({
        get: () => store.getters["product/getWeight"],
        set: (value) => store.commit("product/setWeight", value)
      }),
    }
  }
}
</script>

<style scoped>

</style>