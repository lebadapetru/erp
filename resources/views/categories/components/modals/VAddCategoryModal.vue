<template>
  <VBaseModal>
    <template v-slot:body>
      <div class="mb-13 text-center">
        <h1 class="mb-3">Add Category</h1>
      </div>
      <VCategoryForm ref="categoryForm" />
    </template>

    <template v-slot:footer>
      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary" @click="onSave()">Save</button>
    </template>
  </VBaseModal>
</template>

<script lang="ts">
import { defineComponent, ref } from "vue";
import VBaseModal from "resources/components/modals/VBaseModal.vue";
import VCategoryForm from "resources/views/categories/components/forms/VCategoryForm.vue";

export default defineComponent({
  name: "VAddCategoryModal",
  components: {
    VCategoryForm,
    VBaseModal,
  },
  setup () {
    const categoryForm = ref(null)
    const onSave = (): void => {
      categoryForm.value.$el.dispatchEvent(new Event('submit'));
    }

    return {
      categoryForm,
      onSave,
    }
  }
})
</script>

<style scoped>

</style>