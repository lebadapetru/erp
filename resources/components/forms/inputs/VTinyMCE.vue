<template>
  <editor
    api-key="no-api-key"
    :init="config"
  />
</template>

<script>
import Editor from '@tinymce/tinymce-vue'

export default {
  name: "VTinyMCE",
  components: {
    editor: Editor
  },
  props: {
    modelValue: {
      type: String,
      default: ''
    },
  },
  emits: ['update:modelValue'],
  setup(props, { emit }) {

    function cra() {
      console.log('done')
    }

    const onInput = (event) => {
      console.log('on textarea input')
      emit('update:modelValue', event.target.value)
    }

    return {
      onInput,
      config: {
        height: 200,
        menubar: true,
        resize: true,
        statusbar: true,
        plugins: [
          'advlist autolink autosave autoresize link image lists charmap hr anchor',
          'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
          'table template paste importcss textpattern spellchecker'
        ],
        toolbar: [
          'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright  | blockquote | formatselect | spellchecker',
          'cut copy paste removeformat | searchreplace | bullist numlist | outdent indent | hr | link unlink anchor image code | inserttime',
          'table | subscript superscript | charmap | visualchars visualblocks nonbreaking | template | helloworld'
        ],
        setup: function (editor) {
          editor.on('init', cra);
          editor.on('change', function(e) {
            var value=editor.getContent();
            emit('update:modelValue', value)
          })
          editor.on("keyup",function(e) {
            var value=editor.getContent();
            emit('update:modelValue', value)
          })
        }
      }
    }
  }
}
</script>

<style scoped>

</style>