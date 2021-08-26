<template>
  <VBaseModal
    ref="modal"
    hide-mutation="hideAddCategoryModal"
    visibility-getter="isAddCategoryModalVisible"
  >
    <template v-slot:title>
      <div class="mb-13 text-center">
        <h1 class="mb-3">Add Category</h1>
      </div>
    </template>

    <template v-slot:content>
      <VBaseForm
        :validation-schema="validationSchema"
        @submit="onSubmit"
        ref="form"
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
            <VTinyMCE
              @loaded="editorLoaded()"
              :initial-value="description"
              v-model="description"
            />
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

    <template v-slot:footer>
      <button type="button" class="btn btn-light" @click="hide()">Close</button>
      <!--TODO create a custom directive for loader v-load which watches a ref-->
      <button
        v-if="isLoading"
        type="button"
        class="btn btn-primary"
        disabled
      >
        Saving ...
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
      </button>
      <button v-else type="button" class="btn btn-primary" @click="submit()">
        Save
      </button>
    </template>

  </VBaseModal>
</template>

<script lang="ts">
import { computed, defineComponent, ref, defineAsyncComponent } from "vue";
import VBaseForm from "resources/components/forms/VBaseForm.vue";
import { Toast } from "resources/components/alerts/toast"
import VBaseModal from "resources/components/modals/VBaseModal.vue";
import { useStore } from "vuex";
import validationSchema from "resources/views/categories/components/forms/ts/validationSchema";
import VBaseInput from "resources/components/forms/inputs/VBaseInput.vue";
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox.vue";
import VTinyMCE from "resources/components/forms/inputs/VTinyMCE.vue";

export default defineComponent({
  name: "VAddCategoryModal",
  components: {
    VBaseModal,
    VBaseForm,
    VBaseInput,
    VTinyMCE,
    VBaseCheckbox,
  },
  setup() {
    const isLoading = ref(false)
    const isEditorLoaded = ref(false)
    const modal = ref(null)
    const form = ref(null)
    const store = useStore()
    console.log('add wtf')
    return {
      modal,
      form,
      validationSchema,
      editorLoaded: () => {
        console.log('editor')
        isEditorLoaded.value = true
      },
      submit: (): void => {
        form.value.$el.dispatchEvent(new Event('submit'));
      },
      isLoading,
      isEditorLoaded,
      hide: () => {
        store.commit('categories/hideAddCategoryModal')
      },
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
        isLoading.value = true
        store.dispatch('category/createCategory', data).then(() => {
          isLoading.value = false
          Toast.success('The category was added successfully.')
          modal.value.hide()
          store.dispatch('categories/readItems')
        })
      }
    }
  }
})
</script>

<style scoped>

</style>