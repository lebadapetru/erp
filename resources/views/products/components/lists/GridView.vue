<template>
  <!--begin::List-->
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
  <!--end::List-->
</template>

<script>
import { useStore } from "vuex";
import { computed } from "vue";
import ProductBlock from "resources/views/products/components/ProductBlock";

export default {
  name: "GridView",
  components: {
    ProductBlock,
  },
  setup() {
    const store = useStore()

    store.dispatch('product/readAndParseProducts')

    const products = computed(() => store.getters['product/getProducts'])

    console.log(products)

    return {
      products
    }
  }
}
</script>

<style scoped>

</style>