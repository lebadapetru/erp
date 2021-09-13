<template>
  <VBaseModal
    hide-mutation="hideEditCategoryModal"
    visibility-getter="isEditCategoryModalVisible"
    ref="modal"
    v-if="hasLoaded"
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
              @loaded="onEditorLoaded()"
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

    <template v-slot:saveButton>
      <!--TODO create a custom directive for loader v-load who watches a ref-->
      <button
        v-if="isSaving"
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
import validationSchema from "resources/views/categories/components/forms/ts/validationSchema";
import VBaseInput from "resources/components/forms/inputs/VBaseInput.vue";
import VBaseCheckbox from "resources/components/forms/inputs/VBaseCheckbox.vue";
import VTinyMCE from "resources/components/forms/inputs/VTinyMCE.vue";

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
    const isSaving = ref(false)
    const hasLoaded = ref(false)
    const hasEditorLoaded = ref(false)
    const form = ref(null)
    const modal = ref(null)
    const store = useStore()
    const id = computed(() => store.getters['category/getId'])

    watch(id, newValue => {
      if (!newValue) {
        return
      }
      store.dispatch('category/read', newValue).then(() => {
        hasLoaded.value = true
      })
    }, { immediate: true })

    return {
      hasLoaded,
      form,
      modal,
      validationSchema,
      isSaving,
      hasEditorLoaded,
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
      onEditorLoaded: () => {
        console.log('editor')
        hasEditorLoaded.value = true
      },
      save: (): void => {
        form.value.$el.dispatchEvent(new Event('submit'));
      },
      onSubmit: (data: object) => {
        isSaving.value = true
        store.dispatch('category/update', { id: id.value, data }).then(() => {
          isSaving.value = false
          Toast.success({ title: 'The category was edited successfully.' })
          modal.value.hide()
          store.dispatch('categories/read')
        })
      }
    }
  }
})
</script>

<style scoped>

</style>