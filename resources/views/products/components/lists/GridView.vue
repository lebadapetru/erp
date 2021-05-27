<template>
  <VPagination
    v-if="totalProducts"
    :style-classes="'mb-8'"
    :total-items="totalProducts"
  />
  <!--begin::List-->
  <div class="row">
    <template
      v-for="product in products"
      :key="product['@id']"
    >
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">
        <ProductBlock
          v-if="product"
          :product="product"
        />
      </div>
    </template>
  </div>
  <!--end::List-->

  <VPagination
    v-if="totalProducts"
    :total-items="totalProducts"
  />

</template>

<script>
import { useStore } from "vuex";
import { computed } from "vue";
import VPagination from "resources/components/VPagination";
import ProductBlock from "resources/views/products/components/ProductBlock";
import { usePagination } from "resources/views/products/js/pagination";

export default {
  name: "GridView",
  components: {
    ProductBlock,
    VPagination,
  },
  setup() {
    const store = useStore()
    const pagination = usePagination()
    console.log(pagination.totalProducts)
    const products = computed(() => store.getters['product/getProducts'])

    console.log(products)

    return {
      products,
      totalProducts: pagination.totalProducts
    }
  }
}
</script>

<style scoped>

</style>