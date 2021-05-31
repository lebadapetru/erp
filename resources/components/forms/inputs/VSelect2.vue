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
  nextTick, onUpdated
} from 'vue'
import 'select2'
import isEmpty from 'lodash/isEmpty'
import Swal from "sweetalert2";

export default {
  name: "VSelect2",
  emits: ['itemAdded'],
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
    console.log('created select2' + props.name)
    console.log(props.options)
    const createSelect2 = () => {
      $(document).ready(function () {
        console.log('init select2' + props.name)
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
            console.log('create tag')
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
          console.log('select' + props.name)
          console.log(event)
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
                  console.log('itemAdded' + response + props.name)
                  console.log(response)
                  emit(`itemAdded`)
                })
              } else {
                $(`.vue-select2 option[value='${event.params.data.id}']`).remove()
              }
            })
          }
        })
      })
    }

    onUnmounted(() => {
      $(el.value)
          .off()
          .val(null)
          .empty()
          .select2("destroy")
    })

    watch(() => props.options, (options) => {
      /*TODO there is a known issue, select2 initialize before the props.options has been received when cache is invalidated*/
      //TODO replace this with bootstrap vue 3 multiselect
      if ($(el.value).hasClass("select2-hidden-accessible")) {
        console.log(options)
        $(el.value)
            .off()
            .val(null)
            .empty()
            .select2("destroy")
      }
      createSelect2()
      $(document).ready(function () {
        $(el.value).val(['dsa']).trigger('change')
      })
    });


    return {
      el
    }
  }
}
</script>

<style scoped>
</style>