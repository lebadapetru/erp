<template>
  <file-pond
    name="test"
    ref="pond"
    allow-multiple="true"
    v-bind:files="myFiles"
    accepted-file-types="image/jpeg, image/png"
  />
</template>

<script lang="ts">
import { defineComponent, onBeforeUnmount, PropType, watch } from "vue";
import vueFilePond, { VueFilePondComponent } from 'vue-filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.esm.js';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.esm.js';
import { useField } from "vee-validate";

const FilePond = vueFilePond(
  FilePondPluginFileValidateType,
  FilePondPluginImagePreview,
) as VueFilePondComponent;

interface File {
  id: string, //uuid
  fullRealName: string,
  mimeType: string,
  url: string,
  size: number,
}

interface ProductFile {
  file: File,
  position: number | null
}

export default defineComponent({
  name: "VFilePond",
  data: function() {
    return { myFiles: [] }
  },
  components: {
    FilePond
  }
})
</script>

<style scoped>
@import "~filepond/dist/filepond.min.css";
@import "~filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
</style>