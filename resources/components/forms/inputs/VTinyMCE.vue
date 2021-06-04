<template>
  <editor
      :api-key="apiKey"
      :init="config"
      v-model="modelValue"
      @init="onInit"
  />
  <div
    v-if="errorMessage"
    class="error-message"
  >
    {{ capitalize(errorMessage) }}
  </div>
</template>

<script>
import Editor from '@tinymce/tinymce-vue'
import { useField } from 'vee-validate'
import capitalize from 'lodash/capitalize'
import { watch } from "vue";

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
    rules: {
      type: Object,
      default: undefined
    },
    name: {
      type: String,
      default: 'description'
    }
  },
  emits: ['update:modelValue'],
  setup(props, { emit }) {
    /*TODO add htmlpurifier to sanitize the user input*/
    const {
      value: inputValue,
      errorMessage,
      handleChange,
    } = useField(props.name, props.rules, {
      initialValue: props.modelValue,
    });

    const onInit = (event, editor) => {
      console.log('tinymce loaded')
    }

    watch(() => props.modelValue, value => {
      inputValue.value = value
    })

    return {
      onInit,
      inputValue,
      handleChange,
      errorMessage,
      capitalize,
      apiKey: app.tinymceApiKey,
      config: {
        branding: false,
        menubar: true,
        statusbar: true,
        resize: true,
        height: 400,
        plugins: [
          'advlist autolink autosave link image media lists charmap hr anchor',
          'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime nonbreaking',
          'table template paste importcss textpattern spellchecker'
        ],
        toolbar: [
          'undo redo | bold italic underline strikethrough | alignleft aligncenter alignright  | blockquote | formatselect | spellchecker',
          'cut copy paste removeformat | searchreplace | bullist numlist | outdent indent | hr | link unlink anchor image code | inserttime',
          'table | subscript superscript | charmap | visualchars visualblocks nonbreaking | template | helloworld'
        ],
        setup: (editor) => {
          console.log(editor.isDirty())
          editor.on('change input', () => {
            console.log('input: ', editor.getContent());
            handleChange(editor.getContent())
            emit('update:modelValue', editor.getContent())
          })
        }
      }
    }
  }
}
</script>

<style scoped>

</style>