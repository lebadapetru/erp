<template>
  <!--begin::Card-->
  <div class="card card-custom gutter-b card-stretch">
    <!--begin::Body-->
    <div class="card-body pt-4">
      <!--begin::Toolbar-->
      <div class="d-flex justify-content-between mb-1">
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
        <div class="my-auto">
          {{ Math.ceil(Math.random() * 100) }}
          <i class="fas fa-heart ml-1" style="color: #ef2809;"></i>
        </div>
      </div>
      <!--end::Toolbar-->
      <router-link :to="{name: 'Products'}">
        <!--begin::Pic-->
        <div
          class="d-flex mb-4"
          style="max-height: 160px;"
        >
          <img
            v-if="product.files.length > 0"
            class="img-fluid mx-auto"
            :src="thumbnail(product.files[0].file.url)"
            alt="image" />

          <img
            v-else
            class="img-fluid mx-auto"
            src="build/media/default-image.jpg"
            alt="image"
          />
        </div>
        <!--end::Pic-->
        <!--begin::Title-->
        <div class="d-flex justify-content-center mb-4 overflow-hidden" style="max-height: 50px;">
          <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">
            {{ product.title }}
          </a>
        </div>
        <!--end::Title-->

        <!--begin::Review-->
        <div class="d-flex justify-content-center mb-4">
          <div class="mr-1">
            <i class="fas fa-star" style="color: #f9bf3b;" />
            <i class="fas fa-star" style="color: #f9bf3b;" />
            <i class="fas fa-star" style="color: #f9bf3b;" />
            <i class="fas fa-star" style="color: #f9bf3b;" />
            <i class="fas fa-star-half" style="color: #f9bf3b;" />
          </div>
          <span class="mr-2">{{ (Math.random() * 5).toFixed(2) }}</span>
          <span class="mr-2">({{ Math.ceil(Math.random() * 300) }})</span>
        </div>
        <!--end::Review-->

        <!--begin::Info-->
        <div class="mb-7">
          <div class="d-flex justify-content-between align-items-center">
            <span class="text-dark-75 font-weight-bold mr-2">Original Price:</span>
            <a href="#" class="text-muted text-hover-primary">{{ product.originalPrice }} Lei</a>
          </div>
          <div class="d-flex justify-content-between align-items-cente my-1">
            <span class="text-dark-75 font-weight-bold mr-2">Discount:</span>
            <a href="#" class="text-muted text-hover-primary">{{ product.discount }} %</a>
          </div>
          <div class="d-flex justify-content-between align-items-center">
            <span class="text-dark-75 font-weight-bold mr-2">Reduced Price:</span>
            <span class="text-muted font-weight-bold">{{ reducedPrice }} Lei</span>
          </div>
        </div>
        <!--end::Info-->
      </router-link>
    </div>
    <!--end::Body-->
  </div>
  <!--end:: Card-->
</template>

<script>
import { computed } from "vue";

export default {
  name: "ProductBlock",
  props: {
    product: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    console.log(props.product)
    console.log(props.product.originalPrice)
    console.log(props.product.discount)
    console.log(props.product.discount/100)
    console.log((props.product.originalPrice - (props.product.originalPrice * (props.product.discount/100))))
    return {
      thumbnail: (url) => {
        return url.replace("{widthxheight}", '250x')
      },
      reducedPrice: computed(() => {
        return (props.product.originalPrice - (props.product.originalPrice * (props.product.discount/100)))
      })
    }
  }
}
</script>

<style scoped>

</style>