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
          <VDropZone
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
import { computed, inject, defineComponent } from "vue";
import { useStore } from "vuex";

export default defineComponent({
  name: "VMediaSection",
  components: {
    VDropZone,
  },
  setup() {
    const store = useStore()
    const productId = inject('id')

    const deleteFile = (fileId) => {
      store.dispatch('product/deleteFile', fileId).then(() => {

        if (productId) {
          store.dispatch('product/readProduct', fileId)
        }
      })
    }
    return {
      files: computed({
        get: () => store.getters['product/getFiles'],
        set: () => store.commit('product/setFiles')
      }),
      deleteFile
    }
  }
})
</script>

<style scoped>

</style>