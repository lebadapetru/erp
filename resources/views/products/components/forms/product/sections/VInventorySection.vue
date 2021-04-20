<template>
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
          <VBaseInput
            :label="'SKU (Stock Keeping Unit)'"
            :name="'sku'"
            :placeholder="'KS93528TUT'"
            v-model="sku"
          />
        </div>

        <div class="col-6">
          <VBaseInput
            :label="'Barcode (ISBN, UPC, GTIN, etc.)'"
            :name="'barcode'"
            :placeholder="'480528304523'"
            v-model="barcode"
          />
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="checkbox-inline">
            <VBaseCheckbox
              :label="'Track quantity'"
              :name="'isTrackQuantity'"
              v-model:checked="isTrackQuantity"
            />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="checkbox-inline">
            <VBaseCheckbox
              :label="'Continue selling when out of stock'"
              :name="'isContinueSellingOutOfStock'"
              v-model:checked="isContinueSellingOutOfStock"
            />
          </div>
        </div>
      </div>
    </div>

    <div
      v-show="isTrackQuantity"
      class="card-footer"
    >
      <div class="card-title">
        <h6 class="card-label">Quantity</h6>
      </div>

      <div class="form-group row">
        <div class="col-12">
          <VBaseInput
            :label="'Available'"
            :type="'number'"
            :name="'quantity'"
            placeholder="0"
            @keypress="integerFilter"
            :min="0"
            v-model="quantity"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VBaseInput from "resources/components/forms/inputs/VBaseInput";
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox";
import { integerFilter } from "resources/js/helpers/inputFilters";
import { computed } from "vue";
import { useStore } from "vuex";

export default {
  name: "VInventorySection",
  components: {
    VBaseInput,
    VBaseCheckbox,
  },
  setup() {
    const store = useStore()

    return {
      integerFilter,
      sku: computed({
        get: () => store.getters["product/getSku"],
        set: (value) => store.commit("product/setSku", value)
      }),
      barcode: computed({
        get: () => store.getters["product/getBarcode"],
        set: (value) => store.commit("product/setBarcode", value)
      }),
      isTrackQuantity: computed({
        get: () => store.getters["product/getIsTrackQuantity"],
        set: (value) => store.commit("product/setIsTrackQuantity", value)
      }),
      isContinueSellingOutOfStock: computed({
        get: () => store.getters["product/getIsContinueSellingOutOfStock"],
        set: (value) => store.commit("product/setIsContinueSellingOutOfStock", value)
      }),
      quantity: computed({
        get: () => store.getters["product/getQuantity"],
        set: (value) => store.commit("product/setQuantity", value)
      })
    }
  }
}
</script>

<style scoped>

</style>