<template>
  <teleport
    to="#toolbar_actions"
  >
    <!--begin::Button-->
    <router-link
      :to="{name: 'products'}"
      class="btn btn-sm btn-light text-muted ms-auto me-3"
    >
      <span class="">
        <i class="fas fa-angle-left"></i>
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
        class="btn btn-primary fw-bold"
        @click="onSave()"
      >Save Product
      </button>
      <button
        type="button"
        class="btn btn-primary px-3 fw-bold dropdown-toggle"
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
															<i class="fas fa-sync"></i>
														</span>
            <span class="navi-text">Save &amp; continue</span>
          </a>
        </li>
        <li>
          <a href="#" class="dropdown-item text-hover-primary px-6 py-3">
														<span class="me-3">
															<i class="fas fa-plus"></i>
														</span>
            <span class="navi-text">Save &amp; add new</span>
          </a>
        </li>
        <li>
          <a href="#" class="dropdown-item text-hover-primary px-6 py-3">
														<span class="me-3">
															<i class="fas fa-angle-left"></i>
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