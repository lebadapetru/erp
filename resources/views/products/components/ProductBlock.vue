<template>
  <!--begin::Card-->
  <div class="card card-custom gutter-b card-stretch">
    <!--begin::Body-->
    <div class="card-body pt-4">
      <!--begin::Toolbar-->
      <div class="d-flex justify-content-end">
        <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
          <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown"
             aria-haspopup="true" aria-expanded="false">
            <i class="ki ki-bold-more-hor"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
            <!--begin::Navigation-->
            <ul class="navi navi-hover">
              <li class="navi-header font-weight-bold py-4">
                <span class="font-size-lg">Choose Label:</span>
                <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right"
                   title="Click to learn more..."></i>
              </li>
              <li class="navi-separator mb-3 opacity-70"></li>
              <li class="navi-item">
                <a href="#" class="navi-link">
																		<span class="navi-text">
																			<span class="label label-xl label-inline label-light-success">Customer</span>
																		</span>
                </a>
              </li>
              <li class="navi-item">
                <a href="#" class="navi-link">
																		<span class="navi-text">
																			<span class="label label-xl label-inline label-light-danger">Partner</span>
																		</span>
                </a>
              </li>
              <li class="navi-item">
                <a href="#" class="navi-link">
																		<span class="navi-text">
																			<span class="label label-xl label-inline label-light-warning">Suplier</span>
																		</span>
                </a>
              </li>
              <li class="navi-item">
                <a href="#" class="navi-link">
																		<span class="navi-text">
																			<span class="label label-xl label-inline label-light-primary">Member</span>
																		</span>
                </a>
              </li>
              <li class="navi-item">
                <a href="#" class="navi-link">
																		<span class="navi-text">
																			<span class="label label-xl label-inline label-light-dark">Staff</span>
																		</span>
                </a>
              </li>
              <li class="navi-separator mt-3 opacity-70"></li>
              <li class="navi-footer py-4">
                <a class="btn btn-clean font-weight-bold btn-sm" href="#">
                  <i class="ki ki-plus icon-sm"></i>Add new</a>
              </li>
            </ul>
            <!--end::Navigation-->
          </div>
        </div>
      </div>
      <!--end::Toolbar-->
      <!--begin::User-->
      <div class="d-flex align-items-center mb-7">
        <!--begin::Pic-->
        <div class="flex-shrink-0 mr-4">
          <div
            v-if="product.files.length > 0"
            class="symbol symbol-circle symbol-lg-100"
          >
            <img :src="thumbnail(product.files[0].file.url)" alt="image" />
          </div>
          <div
            v-else
            class="symbol symbol-circle symbol-lg-100"
          >
            <img src="build/media/default-image.jpg" alt="image" />
          </div>
        </div>
        <!--end::Pic-->
        <!--begin::Title-->
        <div class="d-flex flex-column">
          <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">
            {{ product.title }}
          </a>
          <span class="text-muted font-weight-bold">Head of Development</span>
        </div>
        <!--end::Title-->
      </div>
      <!--end::User-->
      <!--begin::Desc-->
      <p class="mb-7">
        {{ product.shortDescription }}
        <a href="#" class="text-primary pr-1">...</a>
      </p>
      <!--end::Desc-->
      <!--begin::Info-->
      <div class="mb-7">
        <div class="d-flex justify-content-between align-items-center">
          <span class="text-dark-75 font-weight-bolder mr-2">Budget:</span>
          <a href="#" class="text-muted text-hover-primary">$249,500</a>
        </div>
        <div class="d-flex justify-content-between align-items-cente my-1">
          <span class="text-dark-75 font-weight-bolder mr-2">Expences:</span>
          <a href="#" class="text-muted text-hover-primary">$76,810</a>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <span class="text-dark-75 font-weight-bolder mr-2">Due Date:</span>
          <span class="text-muted font-weight-bold">21.05.2016</span>
        </div>
      </div>
      <!--end::Info-->
      <a href="#" class="btn btn-block btn-sm btn-light-success font-weight-bolder text-uppercase py-4">write
        message</a>
    </div>
    <!--end::Body-->
  </div>
  <!--end:: Card-->
</template>

<script>
export default {
  name: "ProductBlock",
  props: {
    product: {
      type: Object,
      required: true
    }
  },
  setup() {
    return {
      thumbnail: (url) => {
        return url.replace("{widthxheight}", '300x')
      }
    }
  }
}
</script>

<style scoped>

</style>