<template>
  <VBaseModal
    hide-mutation="hideEditCategoryModal"
    visibility-getter="isEditCategoryModalVisible"
  >
    <template v-slot:title>
      <div class="mb-13 text-center">
        <h1 class="mb-3">Edit Category</h1>
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
      <button v-else type="button" class="btn btn-primary" @click="save()">
        Save
      </button>
    </template>

  </VBaseModal>
</template>

<script lang="ts">
import { computed, defineComponent, ref, watch } from "vue";
import VBaseForm from "resources/components/forms/VBaseForm.vue";
import { Toast } from "resources/components/alerts/toast"
import VBaseModal from "resources/components/modals/VBaseModal.vue";
import { useStore } from "vuex";
import VBaseInput from "resources/components/forms/inputs/VBaseInput.vue";
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox.vue";
import VTinyMCE from "resources/components/forms/inputs/VTinyMCE.vue";
import validationSchema from "resources/views/categories/components/forms/ts/validationSchema";

export default defineComponent({
  name: "VEditCategoryModal",
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
    const store = useStore()
    const id = computed(() => store.getters['category/getId'])
    const form = ref(null)

    watch(id, (newValue, oldValue) => {
      if (!newValue) {
        return
      }
      store.dispatch('category/readItem', newValue)
    }, { immediate: true })

    const title = computed({
      get: (): string => store.getters["category/getTitle"],
      set: (value: string) => store.commit('category/setTitle', value)
    })
    const description = computed({
      get: (): string => store.getters["category/getDescription"],
      set: (value: string) => store.commit("category/setDescription", value)
    })
    const isPublic = computed({
      get: (): boolean => store.getters["category/getIsPublic"],
      set: (value: boolean) => store.commit("category/setIsPublic", value)
    })

    const hide = () => {
      store.commit('modals/hideEditCategoryModal')
    }

    return {
      validationSchema,
      editorLoaded: () => {
        console.log('editor')
        isEditorLoaded.value = true
      },
      isLoading,
      isEditorLoaded,
      title,
      description,
      isPublic,
      form,
      hide,
      save: (): void => {
        form.value.$el.dispatchEvent(new Event('submit'));
      },
      onSubmit: (data: object) => {
        isLoading.value = true
        store.dispatch('category/updateItem', data).then(() => {
          isLoading.value = false
          Toast.success('The category was added successfully.')
          hide()
          store.dispatch('categories/readItems')
        })
      }
    }
  }
})
</script>

<style scoped>

</style>