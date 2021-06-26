<template>
  <!--begin::Pricing-->
  <div class="card card-custom">
    <div class="card-header">
      <div class="card-title">
        <h3 class="card-label">Pricing</h3>
      </div>
      <div class="card-toolbar">
      </div>
    </div>
    <div class="card-body">
      <div class="form-group row">

        <div class="col-5">
          <label>Original price</label>
          <div class="input-group">
            <div class="input-group-prepend">
                        <span class="input-group-text">
                          RON
                        </span>
            </div>
            <VBaseInput
              :type="'text'"
              :name="'originalPrice'"
              v-model:model-value="originalPrice"
              placeholder="0.00"
            />
          </div>
        </div>

        <div class="col-4">
          <label>Reduced price</label>
          <div class="input-group">
            <div class="input-group-prepend">
                        <span class="input-group-text">
                          RON
                        </span>
            </div>
            <VBaseInput
              :type="'text'"
              :name="'reducedPrice'"
              placeholder="0.00"
              v-model:model-value="reducedPrice"
            />
          </div>
        </div>

        <div class="col-3">
          <label>Discount</label>
          <div class="input-group">
            <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fas fa-percent fa-sm" style="color: unset;"></i>
                      </span>
            </div>
            <VBaseInput
              :type="'number'"
              :name="'discount'"
              placeholder="0"
              @keypress="integerFilter"
              v-model:model-value="discount"
              :min="0"
              :max="100"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end::Pricing-->
</template>

<script>
import VBaseInput from "resources/components/forms/inputs/VBaseInput";
import { integerFilter, priceFilter } from "resources/js/helpers/inputFilters";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  name: "VPriceSection",
  components: {
    VBaseInput,
  },
  setup() {
    const store = useStore()

    let originalPrice = computed({
      get: () => store.getters["product/getOriginalPrice"],
      set: (value) => {
        store.commit("product/setOriginalPrice", value)
      }
    })

    let reducedPrice = computed({
      get: () => store.getters["product/getReducedPrice"],
      set: (value) => {
        let tmpReducedPrice = (value <= originalPrice.value) ? value : originalPrice.value
        //or ((originalPrice-reducedPrice)/originalPrice))*100
        store.commit("product/setDiscount", 100 - ((tmpReducedPrice * 100) / originalPrice.value))
        store.commit("product/setReducedPrice", tmpReducedPrice)
      }
    })

    let discount = computed({
      get: () => store.getters["product/getDiscount"],
      set: (value) => {
        let tmpDiscount = (value <= 100) ? value : 100
        store.commit("product/setDiscount", tmpDiscount)
        let tmpReducedPrice = originalPrice.value - (originalPrice.value * (tmpDiscount / 100))
        reducedPrice.value = (tmpReducedPrice > 0) ? (Math.round(tmpReducedPrice) == (Math.round(tmpReducedPrice * 100) / 100) ? Math.round(tmpReducedPrice) : (Math.round(tmpReducedPrice * 100) / 100)) : 0
      }
    })

    return {
      originalPrice,
      reducedPrice,
      discount,
      integerFilter,
      priceFilter,
    }
  }
}
</script>

<style scoped>

</style>