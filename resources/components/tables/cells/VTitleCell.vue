<template>
  <div class="d-flex align-items-center">
    <!--begin::Wrapper-->
    <div
      v-if="avatarPath"
      class="me-5 position-relative"
    >
      <!--begin::Avatar-->
      <div class="symbol symbol-50px">
        <img alt="Pic" :src="avatarPath" />
      </div>
      <!--end::Avatar-->
    </div>
    <!--end::Wrapper-->
    <!--begin::Info-->
    <div class="d-flex flex-column justify-content-center">
      <a
        href="javascript:;"
        class="mb-1 text-gray-800 text-hover-primary"
        @click="editItem"
      >
        {{ title }}
      </a>
    </div>
    <!--end::Info-->
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  name: "VTitleCell",
  props: {
    itemId: {
      type: Number,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    avatarPath: {
      type: String,
      required: false
    }
  },
  setup(props, { emit }) {
    return {
      editItem: () => {
        emit('editItem', props.itemId)
      }
    }
  }
})
</script>

<style scoped>

</style>