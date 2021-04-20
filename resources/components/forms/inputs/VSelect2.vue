<template>
  <label v-if="label">{{ label }}</label>
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
  ref,
  nextTick
} from 'vue'
import 'select2'
import isEmpty from 'lodash/isEmpty'
import Swal from "sweetalert2";

export default {
  name: "VSelect2",
  emits: ['itemAdded', 'categoryAdded', 'variantOptionAdded'],
  props: {
    label: {
      type: String,
      default: ''
    },
    name: {
      type: String,
      required: true
    },
    itemTitle: {
      type: String,
      default: 'item'
    },
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
    options: {
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

    const createSelect2 = () => {
      $(document).ready(function () {
        console.log(props.options)
        console.log(isEmpty(props.options))
        $(el.value).select2({
          placeholder: props.placeholder,
          multiple: props.hasMultiple,
          tags: props.hasTags && props.addItemCallback,
          allowClear: props.allowClear,
          tokenSeparators: props.hasMultiple ? [',', ' '] : null,
          data: props.options,
          createTag: function (params) {
            /*TODO creation constraints based on user permissions*/
            let term = (params.term).trim();

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
          if (event.params.data?.newTag && props.addItemCallback !== undefined) {
            Swal.fire({
              title: 'Are you sure?',
              text: `You want to create the '${event.params.data.text}' ${props.itemTitle}?`,
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
                props.addItemCallback(event.params.data).then((response) => {
                  console.log(response)
                  emit(`${props.itemTitle}Added`)
                  console.log(`${props.itemTitle}Added`)
                })
              } else {
                $(`.vue-select2 option[value='${event.params.data.id}']`).remove()
              }
            })
          }
        })
      })
    }

    onMounted(() => {
      /*TODO there is a known issue, select2 initialize before the props.options has been received when cache is invalidated*/
      createSelect2()
    })

    onUnmounted(() => {
      $(el.value)
          .off()
          .val(null)
          .empty()
          .select2("destroy")
    })

    watch(() => props.options, (newValue, oldValue) => {
      if ($(el.value).hasClass("select2-hidden-accessible")) {
        $(el.value)
            .off()
            .val(null)
            .empty()
            .select2("destroy")
      }
      createSelect2()
    });


    return {
      el
    }
  }
}
</script>

<style scoped>
</style>