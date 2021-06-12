<template>
  <!--begin::Cards-->
  <div class="row">
    <template
      v-for="product in products"
      :key="product.id"
    >
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
        <ProductBlock
          v-if="product"
          :product="product"
        />
      </div>
    </template>
  </div>
  <!--end::Cards-->

</template>

<script>
import { useStore } from "vuex";
import { computed } from "vue";
import VPagination from "resources/components/VPagination";
import ProductBlock from "resources/views/products/components/ProductBlock";

export default {
  name: "GridView",
  components: {
    ProductBlock,
    VPagination,
  },
  setup() {
    const store = useStore()
    const products = computed(() => store.getters['products/getProducts'])

    return {
      products,
    }
  }
}
</script>

<style scoped>

</style>