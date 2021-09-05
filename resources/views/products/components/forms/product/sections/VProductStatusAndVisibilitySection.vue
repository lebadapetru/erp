<template>
  <!--begin::Product status & visibility-->
  <div class="card card-custom mb-5">
    <div class="card-header">
      <div class="card-title">
        <h3 class="card-label">Product status & visibility</h3>
      </div>
      <div class="card-toolbar">
        <VBaseCheckbox
          :name="'isPublic'"
          :wrapper-style-classes="'form-check form-switch form-check-custom form-check-solid form-check-success'"
          v-model:checked="isPublic"
        />
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12">
          <VBaseSelect
            :name="'status'"
            :options="statusOptions"
            v-model="status"
          />
          <span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="card-title mb-3">
        <h4 class="card-label">Sales channels and apps</h4>
      </div>

      <div>
        <VBaseCheckbox
          :name="'channel'"
          :label="'Online store'"
          :checked="true"
        />
        <br />
        <a href="#">Schedule availability</a>
      </div>
    </div>
  </div>
  <!--end::Product status & visibility-->
</template>

<script lang="ts">
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox.vue";
import VBaseSelect from "resources/components/forms/inputs/VBaseSelect.vue";
import { useStore } from "vuex";
import { computed, defineComponent } from "vue";

export default defineComponent({
  name: "VProductStatusAndVisibilitySection",
  components: {
    VBaseCheckbox,
    VBaseSelect,
  },
  setup() {
    const store = useStore()

    store.dispatch("product/readAndParseLookupProductStatus")
    let isPublic = computed({
      get: () => store.getters["product/getIsPublic"],
      set: (value) => store.commit("product/setIsPublic", value)
    })
    console.log('wtf')
    console.log(isPublic)
    return {
      isPublic,
      statusOptions: computed(() => store.getters["product/getStatusOptions"]),
      status: computed({
        get: () => store.getters["product/getStatus"],
        set: (value) => store.commit("product/setStatus", value)
      }),
    }
  }
})
</script>

<style scoped>
.form-check.form-check-solid .form-check-input:checked {
  background-color: #1BC5BD !important;
}
</style>