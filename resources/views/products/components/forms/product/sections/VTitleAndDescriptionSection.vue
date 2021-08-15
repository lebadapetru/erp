<template>
  <!--begin::Title&Description-->
  <div class="card card-custom mb-5">
    <div class="card-body">
      <div class="row mb-6">
        <div class="col-12">
          <VBaseInput
            :label="'Title'"
            :type="'text'"
            placeholder="Cotton blue jeans"
            :name="'title'"
            :label-style-classes="'form-label required'"
            v-model="title"
          />
        </div>
      </div>
      <div class="row mb-6">
        <div class="col-12">
          <label class="form-label">Description</label>
          <VTinyMCE v-model="description" />
        </div>
      </div>
    </div>
  </div>
  <!--end::Title&Description-->
</template>

<script>
import VBaseInput from "resources/components/forms/inputs/VBaseInput";
import VTinyMCE from "resources/components/forms/inputs/VTinyMCE";
import { useStore } from "vuex";
import { computed } from "vue";

export default {
  name: "VTitleAndDescriptionSection",
  components: {
    VBaseInput,
    VTinyMCE,
  },
  setup() {
    const store = useStore()

    return {
      title: computed({
        get: () => store.getters["product/getTitle"],
        set: (value) => store.commit('product/setTitle', value)
      }),
      description: computed({
        get: () => store.getters["product/getDescription"],
        set: (value) => store.commit("product/setDescription", value)
      })
    }
  }
}
</script>

<style scoped>

</style>