<template>
  <label v-if="label.trim().length">{{ label }}</label>
  <textarea
      class="ckeditor"
      :class="styleClasses"
      id="kt-ckeditor-5"
      :name="name"
  />
  <div class="error-message" v-if="errorMessage">
    {{ capitalize(errorMessage) }}
  </div>
</template>

<script>
import { onMounted, onUnmounted } from 'vue'
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import { useField } from "vee-validate";
import capitalize from "lodash/capitalize";

export default {
  name: "VCKEditor",
  props: {
    label: {
      type: String,
      default: ''
    },
    styleClasses: {
      type: String
    },
    name: {
      type: String,
      default: 'description'
    },
    modelValue: {
      type: String,
      default: ''
    },
    rules: {
      type: Object,
      default: undefined
    }
  },
  emits: ['update:modelValue'],
  setup(props, {emit}) {
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

    /*onUnmounted(() => {
      ClassicEditor
        .destroy( document.querySelector( '.ckeditor' ) )
        .then ( editor => {
          console.log(editor)
        } )
        .catch( error => {
          console.error( error );
        } );
    })*/
    const {
      value: inputValue,
      errorMessage,
      handleBlur,
      handleChange,
      meta,
    } = useField(props.name, props.rules, {
      initialValue: props.modelValue,
    });

    const onInput = (event) => {
      handleChange(event)
      emit('update:modelValue', event.target.value);
    }

    return {
      onInput,
      handleChange,
      handleBlur,
      errorMessage,
      inputValue,
      meta,
      capitalize
    }
  }
}
</script>

<style scoped>

</style>