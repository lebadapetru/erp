<template>
  <div id="v-uppy" class="pb-5">
    <DragDrop
      :uppy="uppy"
      :props="props"
    />
    <div v-if="errorMessage" class="error-message">
      {{ capitalize(errorMessage) }}
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent, onBeforeUnmount, PropType, ref, watch } from "vue";
import { DragDrop } from '@uppy/vue'
import Uppy from '@uppy/core'
import XHRUpload from '@uppy/xhr-upload'
import { ProductFile } from "resources/ts/types";
import { useField } from "vee-validate";
import VFileGallery from "resources/components/file-gallery/VFileGallery.vue";
import capitalize from 'lodash/capitalize'

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
      type: Array as PropType<ProductFile[]>,
      default: []
    }
  },
  setup(props, { emit }) {
    const productFiles = ref([])
    const mimeTypes = Object.values(app.fileConfiguration.mimeTypes).map(type => {
      return Object.values(type)
    }).flat()

    const {
      errorMessage,
      handleInput,
    } = useField('productFiles', null);

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
      productFiles.value.push({
        file: response.body,
        position: null
      })
      handleInput(productFiles.value)
      emit('update:modelValue', productFiles.value)
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
      productFiles.value = []
      items.forEach(item => {
        productFiles.value.push(item)
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
      productFiles,
      capitalize,
      errorMessage
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