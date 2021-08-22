<template>
  <VBaseForm
    :validation-schema="validationSchema"
    @submit="onSubmit"
  >
    <div class="row mb-6">
      <div class="col-12">
        <VBaseInput
          name="title"
          label="Title"
          placeholder="Electronics"
          v-model="title"
          label-style-classes="form-label required"
        />
      </div>
    </div>

    <div class="row mb-6">
      <div class="col-12">
        <VTinyMCE v-model="description" />
      </div>
    </div>

    <div class="d-flex align-items-center mb-6">
      <span
        class="fw-bold me-3"
        :class="{'text-gray-400': isPublic}"
      > Private </span>
      <VBaseCheckbox
        :name="'isPublic'"
        :wrapper-style-classes="'me-3 form-check form-switch form-check-custom form-check-solid form-check-success'"
        v-model:checked="isPublic"
      />
      <span
        class="me-3 fw-bold"
        :class="{'text-gray-400': !isPublic}"
      > Public </span>
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
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox.vue";

export default defineComponent({
  name: "VCategoryForm",
  components: {
    VBaseCheckbox,
    VTinyMCE,
    VBaseInput,
    VBaseForm
  },
  emits: ['saved', 'loading'],
  setup(props, { emit }) {
    const store = useStore()

    return {
      validationSchema,
      title: computed({
        get: (): string => store.getters["category/getTitle"],
        set: (value: string) => store.commit('category/setTitle', value)
      }),
      description: computed({
        get: (): string => store.getters["category/getDescription"],
        set: (value: string) => store.commit("category/setDescription", value)
      }),
      isPublic: computed({
        get: (): boolean => store.getters["category/getIsPublic"],
        set: (value: boolean) => store.commit("category/setIsPublic", value)
      }),
      onSubmit: (data: object) => {
        emit('loading')
        store.dispatch('category/createCategory', data).then(() => {
          emit('saved')
        })
      }
    }
  }
})
</script>

<style scoped>

</style>