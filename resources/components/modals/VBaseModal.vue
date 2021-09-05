<template>
  <transition
    enter-active-class="animate__animated animate__fadeInDown"
    leave-active-class="animate__animated animate__fadeOutUp"
  >
    <div
      @click="hide()"
      v-if="isVisible"
      class="modal"
      tabindex="-1"
      aria-hidden="true"
    >
      <!--begin::Modal dialog-->
      <div @click.stop class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
          <!--begin::Modal header-->
          <div class="modal-header border-0 mb-7">
            <slot name="header" />
            <!--begin::Close-->
            <div
              class="btn btn-sm btn-icon btn-active-color-primary ms-auto"
            >
                <span @click="hide()" class="svg-icon svg-icon-1">
                  <inline-svg src="/build/media/icons/duotone/Navigation/Close.svg" />
                </span>
            </div>
            <!--end::Close-->
          </div>
          <!--begin::Modal header-->

          <!--begin::Modal body-->
          <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
            <suspense>
              <template #default>
                <slot name="body">
                  <slot name="title" />
                  <slot name="content" />
                </slot>
              </template>
              <template #fallback>
                <div class="d-flex justify-content-center">
                  <div class="spinner-grow" role="status">
                    <span class="sr-only">Loading...</span>
                  </div>
                </div>
              </template>
            </suspense>
          </div>
          <!--end::Modal body-->

          <div class="modal-footer">
            <slot
              name="footer"
            >
              <slot name="cancelButton" >
               <button type="button" class="btn btn-light" @click="hide()">Close</button>
              </slot>
              <slot name="saveButton">
               <button type="button" class="btn btn-primary">Save changes</button>
              </slot>
            </slot>
          </div>
        </div>
        <!--end::Modal content-->
      </div>
      <!--end::Modal dialog-->
    </div>
  </transition>
  <transition
    name="fade"
  >
    <div class="modal-backdrop" v-if="isVisible"></div>
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
    const store = useStore()
    return {
      isVisible: computed(() => store.getters['modals/' + props.visibilityGetter]),
      hide: () => {
        store.commit('modals/' + props.hideMutation)
      }
    }
  }
})
</script>

<style scoped>
.modal {
  display: block;
}

.modal-backdrop {
  opacity: 0.3;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity .15s linear;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}

.animate__animated.animate__fadeInDown,
.animate__animated.animate__fadeOutUp {
  --animate-duration: .3s;
}
</style>