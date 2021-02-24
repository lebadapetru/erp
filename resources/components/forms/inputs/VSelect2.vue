<template>
  <select
      ref="el"
      class="vue-select2 form-control"
  >
  </select>
</template>

<script>
import {
  onMounted,
  onUnmounted,
  watch,
  ref
} from 'vue'
import 'select2'
import isEmpty from 'lodash/isEmpty'
import trim from 'lodash/trim'
import Swal from "sweetalert2";

export default {
  name: "VSelect2",
  emits: ['item-added'],
  props: {
    placeholder: {
      type: String,
      default: 'Search for items'
    },
    hasMultiple: {
      type: Boolean,
      default: false
    },
    hasTags: {
      type: Boolean,
      default: false
    },
    allowClear: {
      type: Boolean,
      default: false
    },
    data: {
      type: Array,
      required: true
    },
    addItemCallback: {
      type: Function,
      required: false
    }
  },
  setup(props, {emit}) {
    const el = ref(null)
    onMounted(() => {
      $(document).ready(function () {
        console.log(props.data)
        $('.vue-select2').select2({
          placeholder: props.placeholder,
          multiple: props.hasMultiple,
          tags: props.hasTags,
          allowClear: props.allowClear,
          tokenSeparators: [',', ' '],
          data: props.data,
          createTag: function (params) {
            /*TODO creation constraints based on user permissions*/
            let term = trim(params.term);

            if (isEmpty(term)) {
              return null;
            }

            return {
              id: term,
              text: term,
              newTag: true // add additional parameters
            }
          },
        }).on('select2:select', function (event) {
          console.log(event)
          if (event.params.data?.newTag && props.addItemCallback !== undefined) {
            Swal.fire({
              title: 'Are you sure?',
              text: `You want to create the '${event.params.data.text}' category?`,
              icon: 'info',
              showCancelButton: true,
              buttonsStyling: false,
              cancelButtonColor: '#d33',
              confirmButtonColor: '#3085d6',
              confirmButtonText: 'Yes, create it!',
              customClass: {
                confirmButton: "btn font-weight-bold btn-light-primary",
                cancelButton: "btn font-weight-bold btn-light-primary",
              },
              heightAuto: false
            }).then((result) => {
              if (result.isConfirmed) {
                props.addItemCallback.call(this, event.params.data).then((response) => {
                  console.log(response)
                  emit('item-added')
                })
              } else {
                $(`.vue-select2 option[value='${event.params.data.id}']`).remove()
              }
            })
          }
        })
      })
    })

    onUnmounted(() => {
      $('.vue-select2')
          .off()
          .select2("destroy")
    })

    watch(props.data, (newValue) => {
      console.log(newValue)
    })

    return {
      el
    }
  }
}
</script>

<style scoped>
</style>