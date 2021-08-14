<template>
  <VBaseForm
    :validation-schema="validationSchema"
  >
    <div class="form-group row mb-6">
      <div class="col-12">
        <VBaseInput
          name="title"
          label="Title"
          placeholder="Electronics"
          v-model="title"
        />
      </div>
    </div>

    <div class="form-group row mb-6">
      <div class="col-12">
        <VTinyMCE v-model="description" />
      </div>
    </div>
  </VBaseForm>
</template>

<script lang="ts">
import { computed, defineComponent } from "vue";
import VBaseForm from "resources/components/forms/VBaseForm.vue";
import validationSchema from "./ts/validationSchema"
import VBaseInput from "resources/components/forms/inputs/VBaseInput.vue";
import { useStore } from "vuex";
import VTinyMCE from "resources/components/forms/inputs/VTinyMCE.vue";

export default defineComponent({
  name: "VCategoryForm",
  components: {
    VTinyMCE,
    VBaseInput,
    VBaseForm
  },
  setup() {
    const store = useStore()

    return {
      validationSchema,
      title: computed({
        get: () => store.getters["category/getTitle"],
        set: (value: string) => store.commit('category/setTitle', value)
      }),
      description: computed({
        get: () => store.getters["category/getDescription"],
        set: (value: string) => store.commit("category/setDescription", value)
      })
    }
  }
})
</script>

<style scoped>

</style>