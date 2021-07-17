<template>
  <div class="d-flex justify-content-end flex-shrink-0">
    <button @click="editItem" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
      <!--begin::Svg Icon | path: icons/duotone/Communication/Write.svg-->
      <span class="svg-icon svg-icon-3">
        <inline-svg src="/build/media/icons/duotone/Communication/Write.svg" />
      </span>
      <!--end::Svg Icon-->
    </button>
    <button @click="deleteItem" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
      <!--begin::Svg Icon | path: icons/duotone/General/Trash.svg-->
      <span class="svg-icon svg-icon-3">
        <inline-svg src="/build/media/icons/duotone/General/Trash.svg" />
      </span>
      <!--end::Svg Icon-->
    </button>
  </div>
</template>

<script>
import InlineSvg from "vue-inline-svg";

export default {
  name: "VActionsCell",
  components: {
    InlineSvg,
  },
  props: {
    itemId: {
      type: Number,
      required: true
    }
  },
  emits: ['editItem', 'deleteItem'],
  setup(props, {emit}) {
    return {
      editItem: () => {
        emit('editItem', props.itemId)
      },
      deleteItem: () => {
        emit('deleteItem', props.itemId)
      },
    }
  }
}
</script>

<style scoped>

</style>