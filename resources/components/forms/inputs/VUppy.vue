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
import { defineComponent, onBeforeUnmount, PropType, watch } from "vue";
import { v4 as uuidv4 } from 'uuid';
import { Dashboard } from '@uppy/vue'
import Uppy from '@uppy/core'
import Webcam from '@uppy/webcam'
import XHRUpload from '@uppy/xhr-upload'
import ImageEditor from "@uppy/image-editor";

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
    modelValue: {
      type: Array as PropType<ProductFile[]>,
      default: []
    }
  },
  setup(props) {
    const mimeTypes = Object.values(app.fileConfiguration.mimeTypes).map(type => {
      return Object.values(type)
    }).flat()

    const uppy = new Uppy({
      debug: true,
      autoProceed: false,
      restrictions: {
        maxFileSize: 10485760, //in bytes
        maxNumberOfFiles: 10,
        allowedFileTypes: mimeTypes,
      },
      onBeforeFileAdded: (currentFile, files) => {
        console.log('onBeforeFileAdded')
        console.log(currentFile)
        console.log(files)

        if (currentFile.meta.hasOwnProperty('id')) {
          //bcuz uploadStarted is of type number || null, i have to set a timestamp in the past
          //to tell uppy this file has been uploaded
          currentFile.progress.uploadStarted = Date.now() - 5 * 60 * 1000
          currentFile.progress.uploadComplete = true
        }

        return {
          ...currentFile
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

    watch(() => props.modelValue, items => {
      console.log('watch')
      console.log(items)
      items.forEach(item => {
        httpClient.get(item.file.url.replace("{widthxheight}", 'x'), { responseType: 'blob' }).then((response) => {
          uppy.addFile({
            name: item.file.fullRealName,
            type: item.file.mimeType,
            data: response.data,
            meta: { id: item.file.id },
          });
        })
      })

    })

    uppy.on('upload-success', () => {
      console.log('upload-success')
      uppy.getFiles().forEach((file) => {
        uppy.setFileState(file.id, {
          progress: {
            uploadComplete: false,
            uploadStarted: null
          }
        })
      })
    })

    uppy.on('upload-error', () => {
      console.log('upload-error')

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