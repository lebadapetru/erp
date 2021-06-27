<template>
  <teleport
    v-if="targetForm"
    to="#toolbar_actions"
  >
    <!--begin::Button-->
    <router-link
      :to="{name: 'products'}"
      class="btn btn-sm btn-bg-light text-muted btn-active-color-primary me-3"
    >
      <span class="">
															<i class="flaticon2-left-arrow"></i>
														</span>
      Back
    </router-link>
    <!--end::Button-->
    <!--begin::Dropdown-->
    <div
      class="btn-group btn-group-sm ms-2"
    >
      <button
        type="button"
        class="btn btn-primary font-weight-bold"
        @click="onSave()"
      >Save Product
      </button>
      <button
        type="button"
        class="btn btn-primary px-3 font-weight-bold dropdown-toggle"
        data-bs-toggle="dropdown"
        aria-expanded="false"
        id="kt_submit_menu_toggle"
      ></button>
      <ul
        class="dropdown-menu py-5"
        aria-labelledby="saveProductGroup"
      >
        <li>
          <a href="#" class="dropdown-item text-hover-primary px-6 py-3">
														<span class="me-3">
															<i class="flaticon2-reload"></i>
														</span>
            <span class="navi-text">Save &amp; continue</span>
          </a>
        </li>
        <li>
          <a href="#" class="dropdown-item text-hover-primary px-6 py-3">
														<span class="me-3">
															<i class="flaticon2-add-1"></i>
														</span>
            <span class="navi-text">Save &amp; add new</span>
          </a>
        </li>
        <li>
          <a href="#" class="dropdown-item text-hover-primary px-6 py-3">
														<span class="me-3">
															<i class="flaticon2-left-arrow"></i>
														</span>
            <span class="navi-text">Save &amp; exit</span>
          </a>
        </li>
      </ul>
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