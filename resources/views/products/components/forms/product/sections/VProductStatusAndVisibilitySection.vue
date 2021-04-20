<template>
  <!--begin::Product status & visibility-->
  <div class="card card-custom mt-4">
    <div class="card-header">
      <div class="card-title">
        <h3 class="card-label">Product status & visibility</h3>
      </div>
      <div class="card-toolbar">
        <span class="switch switch-outline switch-icon switch-success">
          <VBaseCheckbox
            :name="'isPublic'"
            :style-classes="''"
            v-model:checked="isPublic"
          />
        </span>
      </div>
    </div>
    <div class="card-body">
      <div class="form-group row">
        <div class="col-12">
          <VBaseSelect
            :name="status"
            :options="statuses"
          />
          <span class="form-text text-muted">If you want your invoices addressed to a company. Leave blank to use your full name.</span>
        </div>
      </div>
    </div>
    <div class="card-footer">
      <div class="card-title">
        <h6 class="card-label">Sales channels and apps</h6>
      </div>

      <div>
        <div class="checkbox-inline mb-2">
          <label class="checkbox">
            <input type="checkbox" checked />
            <span></span>Online store
          </label>
        </div>

        <a href="#">Schedule availability</a>
      </div>
    </div>
  </div>
  <!--end::Product status & visibility-->
</template>

<script>
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox";
import VBaseSelect from "resources/components/forms/inputs/VBaseSelect";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  name: "VProductStatusAndVisibilitySection",
  components: {
    VBaseCheckbox,
    VBaseSelect,
  },
  setup() {
    const store = useStore()

    return {
      isPublic: computed({
        get: () => store.getters["product/getIsPublic"],
        set: (value) => store.commit("product/setIsPublic", value)
      }),
      statuses: [
        {
          label: 'Test',
          value: 1
        }
      ]
    }
  }
}
</script>

<style scoped>

</style>