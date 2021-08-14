<template>
  <VBaseModal>
    <template v-slot:body>
      <VCategoryForm ref="categoryForm" />
    </template>

    <template v-slot:footer>

    </template>
  </VBaseModal>
</template>

<script lang="ts">
import { defineComponent, onMounted, ref } from "vue";
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
      categoryForm.targetForm.el.dispatchEvent(new Event('submit'));
    }
    console.log(categoryForm)
    //console.log(categoryForm.value.$el)
    onMounted(() => {
      console.log(categoryForm.value)
      console.log(categoryForm.value.$el)
      console.log(categoryForm.value.title)
      categoryForm.value.$el.dispatchEvent(new Event('submit'))
    })
    return {
      categoryForm,
      onSave,
    }
  }
})
</script>

<style scoped>

</style>