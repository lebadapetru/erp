<template>
  <textarea
      class="ckeditor"
      :class="classStyles"
      id="kt-ckeditor-5"
      :name="name"
  />
</template>

<script>
import { onMounted } from 'vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
  name: "VCKEditor",
  props: {
    classStyles: {
      type: String
    },
    name: {
      type: String,
      default: 'description'
    }
  },
  setup() {
    onMounted(() => {
      ClassicEditor
          .create( document.querySelector( '.ckeditor' ), {

          } )
          .then ( editor => {
            console.log(editor)
          } )
          .catch( error => {
            console.error( error );
          } );

    })

  }
}
</script>

<style scoped>

</style>