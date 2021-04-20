<template>
  <!--begin::Title&Description-->
  <div class="card card-custom mt-4">
    <div class="card-body">
      <div class="form-group row">
        <div class="col-12">
          <VBaseInput
            :label="'Title'"
            :type="'text'"
            placeholder="Cotton blue jeans"
            :name="'title'"
            v-model="title"
          />
        </div>
      </div>
      <div class="form-group row">
        <div class="col-12">
          <label>Description</label>
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