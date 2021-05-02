<template>
  <div v-if="currentRoute.name === 'Products'">
    <div class="row">
      <!--begin::Col-->
      <template
        v-for="product in products"
        :key="product['@id']"
      >
        <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6">
          <!--begin::Card-->
          <div class="card card-custom gutter-b card-stretch">
            <!--begin::Body-->
            <div class="card-body pt-4">
              <!--begin::Toolbar-->
              <div class="d-flex justify-content-end">
                <div class="dropdown dropdown-inline" data-toggle="tooltip" title="Quick actions" data-placement="left">
                  <a href="#" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ki ki-bold-more-hor"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                    <!--begin::Navigation-->
                    <ul class="navi navi-hover">
                      <li class="navi-header font-weight-bold py-4">
                        <span class="font-size-lg">Choose Label:</span>
                        <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right" title="Click to learn more..."></i>
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
                  <div class="symbol symbol-circle symbol-lg-75">
                    <img src="assets/media/project-logos/1.png" alt="image" />
                  </div>
                </div>
                <!--end::Pic-->
                <!--begin::Title-->
                <div class="d-flex flex-column">
                  <a href="#" class="text-dark font-weight-bold text-hover-primary font-size-h4 mb-0">Air B</a>
                  <span class="text-muted font-weight-bold">Head of Development</span>
                </div>
                <!--end::Title-->
              </div>
              <!--end::User-->
              <!--begin::Desc-->
              <p class="mb-7">I distinguish three main text objectives. First, your objective
                <a href="#" class="text-primary pr-1">#xrs-54pq</a></p>
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
              <a href="#" class="btn btn-block btn-sm btn-light-success font-weight-bolder text-uppercase py-4">write message</a>
            </div>
            <!--end::Body-->
          </div>
          <!--end:: Card-->
        </div>
      </template>
      <!--end::Col-->
    </div>
    <!--begin::Pagination-->
    <div class="card card-custom">
      <div class="card-body py-7">
        <!--begin::Pagination-->
        <div class="d-flex justify-content-between align-items-center flex-wrap">
          <div class="d-flex flex-wrap mr-3">
            <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
              <i class="ki ki-bold-double-arrow-back icon-xs"></i>
            </a>
            <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
              <i class="ki ki-bold-arrow-back icon-xs"></i>
            </a>
            <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
            <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">23</a>
            <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary active mr-2 my-1">24</a>
            <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">25</a>
            <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">26</a>
            <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">27</a>
            <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">28</a>
            <a href="#" class="btn btn-icon btn-sm border-0 btn-hover-primary mr-2 my-1">...</a>
            <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
              <i class="ki ki-bold-arrow-next icon-xs"></i>
            </a>
            <a href="#" class="btn btn-icon btn-sm btn-light-primary mr-2 my-1">
              <i class="ki ki-bold-double-arrow-next icon-xs"></i>
            </a>
          </div>
          <div class="d-flex align-items-center">
            <select class="form-control form-control-sm text-primary font-weight-bold mr-4 border-0 bg-light-primary" style="width: 75px;">
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="30">30</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
            <span class="text-muted">Displaying 10 of 230 records</span>
          </div>
        </div>
        <!--end:: Pagination-->
      </div>
    </div>
    <!--end::Pagination-->

    <VProductsToolbar />
  </div>
  <router-view></router-view>
</template>

<script>
import { useRouter } from "vue-router";
import VProductsToolbar from "resources/views/products/components/teleports/VProductsToolbar";
import { useStore } from "vuex";
import { computed, ref } from "vue";

export default {
  name: "TheProducts",
  components: {
    VProductsToolbar,
  },
  setup() {
    const router = useRouter()
    const store = useStore()

    store.dispatch('product/readAndParseProducts')

    const products = computed(() => store.getters['product/getProducts'])

    console.log(products)

    return {
      currentRoute: router.currentRoute,
      products,
    }
  }
}
</script>

<style scoped>

</style>