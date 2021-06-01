<template>
  <!--begin::Media-->
  <div class="card card-custom mt-4">
    <div class="card-header">
      <div class="card-title">
        <h3 class="card-label">Media</h3>
      </div>
      <div class="card-toolbar">
        <a href="#">
          Add media from url
          <span>
            <i class="ki ki-bold-triangle-bottom icon-sm"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="card-body">
      <div class="form-group row">
        <div class="col-12">
          <VDropZone v-model="files" />
        </div>
      </div>
    </div>
  </div>
  <!--end::Media-->
</template>

<script>
import VDropZone from "resources/components/forms/inputs/VDropZone";
import { computed } from "vue";
import { useStore } from "vuex";

export default {
  name: "VMediaSection",
  components: {
    VDropZone,
  },
  setup() {
    const store = useStore()
    return {
      files: computed({
        get: () => store.getters['product/getFiles'],
        set: () => store.commit('product/setFiles')
      })
    }
  }
}
</script>

<style scoped>

</style>