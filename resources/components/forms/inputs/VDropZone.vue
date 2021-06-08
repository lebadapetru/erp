<template>
  <div
    class="dropzone dropzone-default"
    id="kt_dropzone_1"
    ref="el"
  >
    <div class="dropzone-msg dz-message needsclick">
      <svg class="mb-4" width="50px" height="50px" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
           xmlns:xlink="http://www.w3.org/1999/xlink">
        <!-- Generator: Sketch 50.2 (55047) - http://www.bohemiancoding.com/sketch -->
        <title>Stockholm-icons / Files / Upload</title>
        <desc>Created with Sketch.</desc>
        <defs></defs>
        <g id="Stockholm-icons-/-Files-/-Upload" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
          <rect id="bound" x="0" y="0" width="24" height="24"></rect>
          <path
            d="M2,13 C2,12.5 2.5,12 3,12 C3.5,12 4,12.5 4,13 C4,13.3333333 4,15 4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 C2,15 2,13.3333333 2,13 Z"
            id="Path-57" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
          <rect id="Rectangle" fill="#000000" opacity="0.3" x="11" y="2" width="2" height="14" rx="1"></rect>
          <path
            d="M12.0362375,3.37797611 L7.70710678,7.70710678 C7.31658249,8.09763107 6.68341751,8.09763107 6.29289322,7.70710678 C5.90236893,7.31658249 5.90236893,6.68341751 6.29289322,6.29289322 L11.2928932,1.29289322 C11.6689749,0.916811528 12.2736364,0.900910387 12.6689647,1.25670585 L17.6689647,5.75670585 C18.0794748,6.12616487 18.1127532,6.75845471 17.7432941,7.16896473 C17.3738351,7.57947475 16.7415453,7.61275317 16.3310353,7.24329415 L12.0362375,3.37797611 Z"
            id="Path-102" fill="#000000" fill-rule="nonzero"></path>
        </g>
      </svg>
      <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>
    </div>
  </div>
  <div v-if="errorMessage" class="error-message">
    {{ capitalize(errorMessage) }}
  </div>
</template>

<script>
import { onMounted, onUnmounted, ref, watch } from 'vue'
import Dropzone from 'dropzone'
import { useField } from 'vee-validate'
import capitalize from 'lodash/capitalize'
import { useStore } from "vuex";
import Swal from "sweetalert2";

export default {
  name: "VDropZone",
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
      type: Array,
      default: []
    }
  },
  setup(props, {emit}) {
    const el = ref(null)
    const files = ref([])
    const store = useStore()

    const mimeTypes = Object.values(app.fileConfiguration.mimeTypes).map(type=> {
      return Object.values(type)
    }).flat().join(',')

    const {
      value: inputValue,
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
        params: (file, xhr) => { //send additional params beside the file object
          console.log(file)
          console.log(xhr)

          return {
            id: file[0].upload.uuid
          }
        },
        success: (file, response) => {
          console.log('success')
          console.log(response)
          //TODO why does it come as string instead of json
          files.value.push({
            file: JSON.parse(response)['@id'],
            position: null
          })
          //TODO save the whole response object for each file, into vuex state
          handleInput(files)
          emit('update:modelValue', files)
        },
        error: (file, error) => {
          console.log('error')
          console.log(file)
          console.log(error)
        },
        dictRemoveFileConfirmation: true,
        addedfiles: (files) => {
          // Create the remove button
          let removeButton = Dropzone.createElement('<a class="dz-remove">Remove file</a>');

          // Listen to the click event
          removeButton.addEventListener("click", (e) => {
            // Make sure the button click doesn't submit the form:
            e.preventDefault();
            e.stopPropagation();

            Swal.fire({
              title: 'Are you sure?',
              html: `You are about to remove the file <b>${files[0].name}</b>!`,
              icon: 'warning',
              showCancelButton: true,
              buttonsStyling: false,
              cancelButtonColor: '#d33',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Yes, delete it!',
              customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary",
                cancelButton: "btn font-weight-bold btn-light-primary",
              },
              heightAuto: false
            }).then((result) => {
              if (result.isConfirmed) {
                // Remove the file preview.
                el.value.dropzone.removeFile(files[0]);
              }
            })

            // If you want to the delete the file on the server as well,
            // you can do the AJAX request here.
          })

          files[0].previewElement.lastElementChild.remove()
          // Add the button to the file preview element.
          files[0].previewElement.appendChild(removeButton);
        },
        init: () => {
          console.log('dropzone init')

          this.on("removedfile", (file) => {
            console.log('removed file')
            console.log(file)
            console.log(files)
            const index = files.value.findIndex(item => item.id === file.id);
            files.value.splice(index, 1)
            console.log(files)
            emit('removedFile', file.id)
          });

          return
          let file = {}
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
          this.emit("complete", file);

        }
      });

      console.log(el.value.dropzone)
    })

    watch(() => props.modelValue, items => {
      console.log('watch dropzone')
      console.log(items)

      items.forEach(item => {
        let file = {
          id: item.file.id,
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
          url: "http://erp.local:80/image/f0af0e83-bdf2-4296-9c65-f4f31c33dbc1/scale/x/res-1785a69cd0dd722d5fd777071ac65b4d-60b522e45bc40.webp"
        }

        files.value.push({
          file: item.file['@id'],
          position: null
        })
        handleInput(files)

        el.value.dropzone.displayExistingFile(file, file.url)
      })
    })

    return {
      el,
      capitalize,
      errorMessage,
    }
  }
}
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