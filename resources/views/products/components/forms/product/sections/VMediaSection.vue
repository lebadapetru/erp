<template>
  <!--begin::Media-->
  <div class="card card-custom mb-5">
    <div class="card-header">
      <div class="card-title">
        <h3 class="card-label">Media</h3>
      </div>
      <div class="card-toolbar">
        <a href="#">
          Add media from url
          <span>
            <i class="fas fa-caret-down"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-12">
<!--          <VDropZone
            v-model="files"
            @removed-file="deleteFile"
          />-->
          <VUppy
            v-model="files"
            @removed-file="deleteFile"
          />
        </div>
      </div>
    </div>
  </div>
  <!--end::Media-->
</template>

<script lang="ts">
import VDropZone from "resources/components/forms/inputs/VDropZone.vue";

import { computed, defineComponent } from "vue";
import { useStore } from "vuex";
import VUppy from "resources/components/forms/inputs/VUppy.vue";

export default defineComponent({
  name: "VMediaSection",
  components: {
    VUppy,
    VDropZone,
  },
  setup() {
    const store = useStore()
    const productId = store.getters['product/getId']

    const deleteFile = (fileId) => {
      store.dispatch('file/delete', fileId).then(() => {

        if (productId) {
          store.dispatch('product/read', fileId)
        }
      })
    }

    return {
      files: computed({
        get: () => store.getters['product/getFiles'],
        set: () => store.commit('product/setFiles')
      }),
      deleteFile,
    }
  }
})
</script>

<style scoped>

</style>