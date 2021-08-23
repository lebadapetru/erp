<template>
  <VBaseModal
    ref="modal"
    show-mutation="categories/showAddCategoryModal"
    hide-mutation="categories/hideAddCategoryModal"
    visibility-getter="categories/isAddCategoryModalVisible"
  >
    <template v-slot:body>
      <div class="mb-13 text-center">
        <h1 class="mb-3">Add Category</h1>
      </div>
      <VCategoryForm
        ref="categoryForm"
        @loading="onLoading()"
        @saved="onSaved()"
      />
    </template>

    <template v-slot:footer>
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
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
import { defineComponent, ref } from "vue";
import VBootstrapModal from "resources/components/modals/VBootstrapModal.vue";
import VCategoryForm from "resources/views/categories/components/forms/VCategoryForm.vue";
import { Toast } from "resources/components/alerts/toast"
import VBaseModal from "resources/components/modals/VBaseModal.vue";

export default defineComponent({
  name: "VAddCategoryModal",
  components: {
    VBaseModal,
    VCategoryForm,
    VBootstrapModal,
  },
  setup () {
    const categoryForm = ref(null)
    const isLoading = ref(false)
    const modal = ref(null)

    return {
      modal,
      categoryForm,
      submit: (): void => {
        categoryForm.value.$el.dispatchEvent(new Event('submit'));
      },
      isLoading,
      onLoading: (): void => {
        isLoading.value = true
      },
      onSaved: (): void => {
        isLoading.value = false
        Toast.success('The category was added successfully.')
        modal.value.hide()
      }
    }
  }
})
</script>

<style scoped>

</style>