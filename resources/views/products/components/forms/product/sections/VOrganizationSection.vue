<template>
  <!--begin::Organization-->
  <div class="card card-custom mt-4">
    <div class="card-header">
      <div class="card-title">
        <h3 class="card-label">Organization</h3>
      </div>
      <div class="card-toolbar">
      </div>
    </div>
    <div class="card-body">
      <div class="form-group row">
        <div class="col-12">
          <VBaseSelect
            :label="'Vendor'"
            :name="'vendor'"
            :options="vendorOptions"
            v-model="vendor"
          />
        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="card-title">
        <h6 class="card-label">Categories</h6>
      </div>

      <VSelectCategories />

      <span class="form-text text-muted">Add this product to a category so it’s easy to find in your store.</span>
    </div>

    <div class="card-footer">
      <div class="card-title">
        <h6 class="card-label">Tags</h6>
      </div>

      <VSelectTags />
    </div>
  </div>
  <!--end::Organization-->
</template>

<script>
import VBaseSelect from "resources/components/forms/inputs/VBaseSelect";
import VSelectCategories from "resources/views/products/components/forms/product/inputs/VSelectCategories";
import VSelectTags from "resources/views/products/components/forms/product/inputs/VSelectTags";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  name: "VOrganizationSection",
  components: {
    VBaseSelect,
    VSelectCategories,
    VSelectTags,
  },
  setup() {
    const store = useStore()

    store.dispatch("product/readAndParseVendorOptions")

    return {
      vendorOptions: computed(() => store.getters["product/getVendorOptions"]),
      vendor: computed({
        get: () => store.getters["product/getVendor"],
        set: (value) => store.commit("product/setVendor", value),
      }),
    }
  }
}
</script>

<style scoped>

</style>