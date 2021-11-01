<template>
  <div id="app">
    <dashboard
      :uppy="uppy"
      :plugins="plugins"
      :props="props"
    />
  </div>
</template>

<script lang="ts">
import { defineComponent, onBeforeUnmount, PropType } from "vue";
import { v4 as uuidv4 } from 'uuid';
import { Dashboard } from '@uppy/vue'
import Uppy from '@uppy/core'
import Webcam from '@uppy/webcam'
import XHRUpload from '@uppy/xhr-upload'
import ImageEditor from "@uppy/image-editor";

interface File {
  id: number,
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
  name: 'VUppy',
  components: {
    Dashboard
  },
  emits: ['removedFile', 'update:modelValue'],
  props: {
    name: {
      type: String,
      default: 'file'
    },
    endpoint: {
      type: String,
      default: '/api/files'
    },
    multiple: {
      type: Boolean,
      default: true
    },
    modelValue: {
      type: Array as PropType<ProductFile[]>,
      default: []
    }
  },
  setup(props) {
    const mimeTypes = Object.values(app.fileConfiguration.mimeTypes).map(type => {
      return Object.values(type)
    }).flat()

    console.log(httpClient.defaults)

    const uppy = new Uppy({
      debug: true,
      autoProceed: false,
      restrictions: {
        maxFileSize: 30000000,
        maxNumberOfFiles: 5,
        allowedFileTypes: mimeTypes,
      },
      onBeforeFileAdded: (currentFile, files) => {
        console.log('onBeforeFileAdded')
        console.log(currentFile)
        console.log(files)

        return {
          ...currentFile,
          id: uuidv4(),
        }
      },
      onBeforeUpload: (files) => {
        const updatedFiles = {}
        console.log('onBeforeUpload')
        console.log(files)

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
      .use(Webcam)
      .use(ImageEditor, {
        quality: 0.8,
      })

    onBeforeUnmount(() => {
      uppy.close()
    })

    return {
      uppy,
      plugins: ['Webcam', 'ImageEditor'],
      props: {
        theme: 'light',
        proudlyDisplayPoweredByUppy: false,
      }
    }
  }
})
</script>

<style lang="scss">
  @import '~@uppy/core/dist/style.css';
  @import '~@uppy/dashboard/dist/style.css';
  @import '~@uppy/image-editor/dist/style.css';
</style>