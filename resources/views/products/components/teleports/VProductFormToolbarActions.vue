<template>
  <teleport
      v-if="targetForm"
      to="#toolbar"
  >
    <!--begin::Button-->
    <a href="#" class="btn btn-default font-weight-bold">
      <i class="ki ki-long-arrow-back icon-xs"></i>
      Back
    </a>
    <!--end::Button-->
    <!--begin::Dropdown-->
    <div
        class="btn-group ml-2"
        :class="{'show': isSubmitDropdownVisible}"
    >
      <button
          type="button"
          class="btn btn-primary font-weight-bold"
          @click="onSave()"
      >Save Product
      </button>
      <button
          type="button"
          class="btn btn-primary font-weight-bold dropdown-toggle dropdown-toggle-split"
          data-toggle="dropdown"
          aria-haspopup="true"
          :aria-expanded="isSubmitDropdownVisible"
          @click="toggleSubmitDropdown"
          id="kt_submit_menu_toggle"
      ></button>
      <div
          class="dropdown-menu dropdown-menu-sm p-0 m-0 dropdown-menu-right"
          :class="{'show': isSubmitDropdownVisible}"
          v-click-away="{callback: hideSubmitDropdown, trigger: '#kt_submit_menu_toggle'}"
      >
        <ul class="navi py-5">
          <li class="navi-item">
            <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="nav-icon flaticon2-reload"></i>
														</span>
              <span class="navi-text">Save &amp; continue</span>
            </a>
          </li>
          <li class="navi-item">
            <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="nav-icon flaticon2-add-1"></i>
														</span>
              <span class="navi-text">Save &amp; add new</span>
            </a>
          </li>
          <li class="navi-item">
            <a href="#" class="navi-link">
														<span class="navi-icon">
															<i class="flaticon2-left-arrow"></i>
														</span>
              <span class="navi-text">Save &amp; exit</span>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <!--end::Dropdown-->
  </teleport>
</template>

<script>
import { ref } from "vue";

export default {
  name: "VProductFormToolbarActions",
  props: {
    targetForm: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    console.log(props.targetForm)

    const isSubmitDropdownVisible = ref(false)

    const toggleSubmitDropdown = () => {
      isSubmitDropdownVisible.value = !isSubmitDropdownVisible.value
    }

    const hideSubmitDropdown = () => {
      isSubmitDropdownVisible.value = false
    }

    const onSave = () => {
      console.log('save')
      console.log(props.targetForm)
      props.targetForm.dispatchEvent(new Event('submit'));
    }

    return {
      isSubmitDropdownVisible,
      toggleSubmitDropdown,
      hideSubmitDropdown,
      onSave
    }
  }
}
</script>

<style scoped>
.dropdown-menu-right {
  position: absolute;
  transform: translate3d(-30px, 40px, 0px);
  top: 0;
  left: 0;
  will-change: transform;
}
</style>