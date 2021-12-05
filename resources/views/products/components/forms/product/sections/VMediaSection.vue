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
          <VUppy
            v-model="productFiles"
          />
          <VFileGallery
            v-model="productFiles"
          />
        </div>
      </div>
    </div>
  </div>
  <!--end::Media-->
</template>

<script lang="ts">
import VDropZone from "resources/components/file-uploader/VDropZone.vue";

import { computed, defineComponent } from "vue";
import { useStore } from "vuex";
import VUppy from "resources/components/file-uploader/VUppy.vue";
import VFilePond from "resources/components/file-uploader/VFilePond.vue";
import VFileGallery from "resources/components/file-gallery/VFileGallery.vue";
import { ProductFile } from "resources/ts/types";

export default defineComponent({
  name: "VMediaSection",
  components: {
    VFileGallery,
    VFilePond,
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
      productFiles: computed({
        get: () => store.getters['product/getProductFiles'],
        set: (value: Array<ProductFile>) => store.commit('product/setProductFiles', value)
      }),
      deleteFile,
    }
  }
})
</script>

<style scoped>
</style>