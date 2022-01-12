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
            v-model="files"
          />
          <VFileGallery
            v-model="files"
          />
        </div>
      </div>
    </div>
  </div>
  <!--end::Media-->
</template>

<script lang="ts">
import { computed, defineComponent, watch } from "vue";
import { useStore } from "vuex";
import VUppy from "resources/components/file-uploader/VUppy.vue";
import VFileGallery from "resources/components/file-gallery/VFileGallery.vue";
import { ProductFileInterface } from "resources/views/products/ts/types";
import { useField } from "vee-validate";

export default defineComponent({
  name: "VMediaSection",
  components: {
    VFileGallery,
    VUppy,
  },
  setup() {
    const store = useStore()
    const productId = store.getters['product/getId']

    const {
      errorMessage,
      handleInput,
    } = useField('productFiles', null);


    const deleteFile = (fileId) => {
      store.dispatch('file/delete', fileId).then(() => {

        if (productId) {
          store.dispatch('product/read', fileId)
        }
      })
    }

    const productFiles = computed({
      get: () => store.getters['product/getProductFiles'],
      set: (value: Array<ProductFileInterface>) => store.commit('product/setProductFiles', value)
    })

    const files = computed({
      get: () => store.getters['product/getFiles'],
      set: (value: Array<ProductFileInterface>) => store.commit('product/setFiles', value)
    })

    watch(files, (first,second) => {
      console.log('watch files')
      console.log(first)
      console.log(second)
      const localProductFiles = []
      first.forEach(productFile => {
        localProductFiles.push({
          file: productFile.file['@id'],
          position: productFile.position
        })
      })

      productFiles.value = localProductFiles
      handleInput(localProductFiles)
    })

    return {
      files,
      deleteFile,
    }
  }
})
</script>

<style scoped>
</style>