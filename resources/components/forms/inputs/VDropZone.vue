<template>
  <div
    class="dropzone dropzone-default"
    id="kt_dropzone_1"
    ref="el"
  >
    <div class="dropzone-msg dz-message needsclick">
      <inline-svg
        src="/build/media/icons/duotone/Files/Upload.svg"
        width="40"
        height="40"
        class="mb-5"
      />
      <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
    </div>
  </div>
  <div v-if="errorMessage" class="error-message">
    {{ capitalize(errorMessage) }}
  </div>
</template>

<script lang="ts">
import { onMounted, ref, watch, defineComponent, PropType } from 'vue'
import Dropzone from 'dropzone'
import { useField } from 'vee-validate'
import capitalize from 'lodash/capitalize'
import Swal from "sweetalert2"
import InlineSvg from "vue-inline-svg"

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
  name: "VDropZone",
  components: {
    InlineSvg,
  },
  emits: ['removedFile', 'update:modelValue'],
  props: {
    name: {
      type: String,
      default: 'files'
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
  setup(props, { emit }) {
    const el = ref(null)
    //here we keep the actual file data
    const files = ref([])
    //this is used to assign Files to Product by @id URI
    const productFiles = ref([])

    const mimeTypes = Object.values(app.fileConfiguration.mimeTypes).map(type => {
      return Object.values(type)
    }).flat().join(',')

    const {
      errorMessage,
      handleInput,
    } = useField(props.name, null);

    Dropzone.autoDiscover = false
    onMounted(() => {
      //TODO setup chunking
      //TODO custom file block display for cropping and other edits
      new Dropzone(el.value, {
        url: "/api/files",
        headers: {
          accept: httpClient.defaults.headers.accept,
        },
        paramName: props.name,
        maxFiles: 10,
        maxFilesize: 10, // MB
        chunking: false,
        chunkSize: 2000000, //2mb
        parallelChunkUploads: false,
        retryChunks: true,   // retry chunks on failure
        retryChunksLimit: 3,
        thumbnailMethod: 'contain',
        addRemoveLinks: true,
        autoQueue: true,
        autoProcessQueue: true,
        acceptedFiles: mimeTypes,
        //set files on initial load,
        //deferred to watcher for now
        init: function () {
          console.log('dropzone init')
          this.on("removedfile", (file) => {

          });

          return
          /*let file = {}
          let thumbnail_url = ''
          // Push file to collection
          this.files.push(file);
          // Emulate event to create interface
          this.emit("addedfile", file);
          // Add thumbnail url
          this.emit("thumbnail", file, thumbnail_url);
          // Add status processing to file
          this.emit("processing", file);
          // Add status success to file AND RUN EVENT success from response
          this.emit("success", file, Dropzone.SUCCESS, false);
          // Add status complete to file
          this.emit("complete", file);*/

        },
        //construct dropzone file component and events
        addedfiles: (clientFiles) => {
          console.log('addedFiles')
          const clientFile = clientFiles[0]
          console.log(clientFile)
          // Create the remove button
          const removeButton = Dropzone.createElement('<a class="dz-remove">Removez file</a>');

          // Listen to the click event
          removeButton.addEventListener("click", (e) => {
            console.log('remove')
            // Make sure the button click doesn't submit the form:
            e.preventDefault();
            e.stopPropagation();

            Swal.fire({
              title: 'Are you sure?',
              html: `You are about to remove the file <b>${ clientFile.name }</b>  from the current product!`,
              icon: 'warning',
              showCancelButton: true,
              buttonsStyling: false,
              cancelButtonColor: '#d33',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Yes, remove it!',
              customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary",
                cancelButton: "btn font-weight-bold btn-light-primary",
              },
              input: 'checkbox',
              inputValue: 1,
              inputPlaceholder:
                'Also, delete it!',
              heightAuto: false
            }).then((result) => {
              if (result.isConfirmed) {
                // Remove the file preview.
                const index = files.value.findIndex(item => item.id === clientFile.upload.uuid)
                files.value.splice(index, 1)

                if (result.value) {
                  emit('removedFile', clientFile.upload.uuid)

                  Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                  )
                }

                el.value.dropzone.removeFile(clientFile);
              }
            })
          })
          // remove the old button
          clientFile.previewElement.lastElementChild.remove()
          // Add the button to the file preview element.
          clientFile.previewElement.appendChild(removeButton);
          console.log(clientFile.previewElement)
        },
        //send additional params beside the file object,
        //like the dropzone's generated uuid to BE
        params: (file) => {
          return { id: file[0].upload.uuid }
        },
        //after file's saved successfully,
        //
        success: (file) => {
          const response = JSON.parse(file.xhr.response)
          productFiles.value.push({
            file: response['@id'],
            position: null
          })
          handleInput(productFiles)
          files.value.push(response)
          emit('update:modelValue', files)
        },
        error: (file, error) => {
          console.log('error')
          console.log(file)
          console.log(error)
        },
      });
    })

    watch(() => props.modelValue, items => {
      console.log('watch dropzone')
      console.log(items)

      items.forEach(item => {
        const clientFile = {
          upload: {
            uuid: item.file.id,
          },
          // flag: processing is complete
          processing: true,
          // flag: file is accepted (for limiting maxFiles)
          accepted: true,
          // name of file on page
          name: item.file.fullRealName,
          // image size
          size: item.file.size,
          // image type
          type: item.file.mimeType,
          // flag: status upload
          status: Dropzone.SUCCESS,
          url: item.file.url.replace("{widthxheight}", 'x')
        }

        productFiles.value.push({
          file: item.file['@id'],
          position: null
        })
        files.value.push(item)
        handleInput(productFiles)
        //TODO custom file theme and processing
        el.value.dropzone.displayExistingFile(clientFile, clientFile.url)
      })
    })

    return {
      el,
      capitalize,
      errorMessage,
    }
  }
})
</script>

<style scoped>
.dropzone {
  min-height: 250px;
}

.dropzone .dz-message {
  opacity: 0.8;
  margin: 4em 0;
}
</style>