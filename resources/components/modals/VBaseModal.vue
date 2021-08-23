<template>
  <transition
    enter-active-class="animate__animated animate__tada"
    leave-active-class="animate__animated animate__bounceOutRight"
  >
    <div
      v-if="isVisible"
      class="modal"
      tabindex="-1"
      aria-hidden="true"
      ref="modal"
    >
      <!--begin::Modal dialog-->
      <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
          <!--begin::Modal header-->
          <div class="modal-header pb-0 border-0 justify-content-end">
            <!--begin::Close-->
            <div
              class="btn btn-sm btn-icon btn-active-color-primary"
            >
            <span class="svg-icon svg-icon-1">
              <inline-svg src="/build/media/icons/duotone/Navigation/Close.svg" />
            </span>
            </div>
            <!--end::Close-->
          </div>
          <!--begin::Modal header-->

          <!--begin::Modal body-->
          <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
            <slot name="body" />
          </div>
          <!--end::Modal body-->

          <div class="modal-footer">
            <slot
              name="footer"
            >
              <button type="button" class="btn btn-light" @click="hide()">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </slot>
          </div>
        </div>
        <!--end::Modal content-->
      </div>
      <!--end::Modal dialog-->
    </div>
  </transition>
</template>

<script lang="ts">
import { computed, defineComponent, ref } from "vue";
import InlineSvg from 'vue-inline-svg'
import { useStore } from "vuex";

export default defineComponent({
  name: "VBaseModal",
  components: {
    InlineSvg,
  },
  props: {
    showMutation: {
      type: String,
      required: true
    },
    hideMutation: {
      type: String,
      required: true
    },
    visibilityGetter: {
      type: String,
      required: true
    }
  },
  setup(props) {
    const modal = ref(null)
    const store = useStore()
    return {
      modal,
      isVisible: computed(() => store.getters[props.visibilityGetter]),
      show: () => {
      },
      hide: () => {
      }
    }
  }
})
</script>

<style scoped>
.modal {
  display: block;
}
</style>