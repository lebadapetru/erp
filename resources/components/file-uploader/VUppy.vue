<template>
  <div id="v-uppy" class="pb-5">
    <DragDrop
      :uppy="uppy"
      :props="props"
    />
  </div>
</template>

<script lang="ts">
import { defineComponent, onBeforeUnmount, PropType, ref, watch } from "vue";
import { DragDrop } from '@uppy/vue'
import Uppy from '@uppy/core'
import XHRUpload from '@uppy/xhr-upload'
import { ProductFileInterface } from "resources/views/products/ts/types";
import VFileGallery from "resources/components/file-gallery/VFileGallery.vue";

export default defineComponent({
  name: 'VUppy',
  components: {
    VFileGallery,
    DragDrop
  },
  emits: ['update:modelValue'],
  props: {
    name: {
      type: String,
      default: 'file'
    },
    endpoint: {
      type: String,
      default: '/api/files'
    },
    modelValue: {
      type: Array as PropType<ProductFileInterface[]>,
      default: []
    }
  },
  setup(props, { emit }) {
    const files = ref([])
    const mimeTypes = Object.values(app.fileConfiguration.mimeTypes).map(type => {
      return Object.values(type)
    }).flat()

    const uppy = new Uppy({
      debug: true,
      autoProceed: true,
      restrictions: {
        maxFileSize: 10485760, //in bytes
        maxNumberOfFiles: 10,
        allowedFileTypes: mimeTypes,
      },
      onBeforeFileAdded: (currentFile, files) => {
        return currentFile
      },
      onBeforeUpload: (files) => {
        return files
      },
    })
      .use(XHRUpload, {
        endpoint: props.endpoint,
        headers: {
          accept: httpClient.defaults.headers.accept,
          'X-CSRF-TOKEN': httpClient.defaults.headers['X-CSRF-TOKEN']
        },
        fieldName: props.name,
      })

    uppy.on('upload-success', (file, response) => {
      console.log('upload-success')
      console.log(file)
      console.log(response.body)
      files.value.push({
        file: response.body,
        position: null
      })

      emit('update:modelValue', files.value)
    })

    uppy.on('upload-error', (file, error, response) => {
      console.log('error with file:', file)
      console.log('error message:', error)
      console.log('response:', response)
    })

    onBeforeUnmount(() => {
      uppy.close()
    })

    watch(() => props.modelValue, items => {
      console.log('watch')
      console.log(items)
      files.value = []
      items.forEach(item => {
        files.value.push(item)
      })
    })

    return {
      uppy,
      plugins: ['Webcam', 'ImageEditor'],
      props: {
        target: null,
        width: '100%',
        height: '100%',
        note: null,
        locale: {},
      },
    }
  }
})
</script>

<style lang="scss">
@import '~@uppy/core/dist/style.css';
@import "~@uppy/drag-drop/dist/style.css";

.uppy-DragDrop-container {
  max-height: 150px;
}

</style>