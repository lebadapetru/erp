<template>
  <!--begin::Card-->
  <div class="card card-custom gutter-b card-stretch">
    <!--begin::Body-->
    <div class="card-body pt-4">
      <!--begin::Toolbar-->
      <div class="d-flex card-toolbar justify-content-between mb-4">
        <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
          <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown"
             aria-haspopup="true" aria-expanded="false">
            <i class="ki ki-bold-more-hor"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
            <!--begin::Navigation-->
            <ul class="navi navi-hover">
              <li class="navi-item">
                <router-link :to="{name: 'Edit product', params: {id: product.id}}" class="navi-link">
                  <span class="navi-icon">
                    <i class="flaticon-edit-1"></i>
                  </span>
                  <span class="navi-text">Edit product</span>
                </router-link>
              </li>
              <li class="navi-item">
                <router-link :to="{name: 'Delete product', params: {id: product.id}}" class="navi-link">
                  <span class="navi-icon">
                    <i class="flaticon-edit-1"></i>
                  </span>
                  <span class="navi-text">Delete product</span>
                </router-link>
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
            <div class="stars"
                 :style="`--rating: ${rating};`"
            />
          </div>
          <span class="mr-2">{{ rating }}</span>
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
import { computed, onMounted } from "vue";

export default {
  name: "ProductBlock",
  props: {
    product: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    return {
      thumbnail: (url) => {
        return url.replace("{widthxheight}", '250x')
      },
      reducedPrice: computed(() => {
        return (props.product.originalPrice - (props.product.originalPrice * (props.product.discount / 100)))
      }),
      rating: (Math.random() * 5).toFixed(2)
    }
  }
}
</script>

<style scoped>
</style>