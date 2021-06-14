<template>
  <teleport
    v-if="targetForm"
    to="#toolbar-right"
  >
    <!--begin::Button-->
    <router-link
      :to="{name: 'Products'}"
      class="btn btn-default font-weight-bold"
    >
      <i class="ki ki-long-arrow-back icon-xs"></i>
      Back
    </router-link>
    <!--end::Button-->
    <!--begin::Dropdown-->
    <div
      class="btn-group ml-2"
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
        aria-expanded="false"
        id="kt_submit_menu_toggle"
      ></button>
      <div
        class="dropdown-menu dropdown-menu-sm p-0 m-0 dropdown-menu-left"
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

export default {
  name: "VProductFormToolbarActions",
  props: {
    targetForm: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    const onSave = () => {
      props.targetForm.el.dispatchEvent(new Event('submit'));
    }

    return {
      onSave
    }
  }
}
</script>

<style scoped>
</style>