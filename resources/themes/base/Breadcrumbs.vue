<template>
  <!--begin::Page title-->
  <div
    class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1"
  >
    <!--begin::Title-->
    <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">
      {{ currentRoute.title }}
    </h1>
    <!--end::Title-->

    <span
      class="h-20px border-gray-200 border-start mx-4"
    ></span>

    <!--begin::Breadcrumb-->
    <ul
      v-if="currentRoute.matched"
      class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1"
    >
      <li class="breadcrumb-item pe-3">
        <router-link to="/dashboard" class="text-muted text-hover-primary">
          Home
        </router-link>
      </li>
      <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
      </li>
      <template
        v-for="(route, index) in currentRoute.matched"
        :key="index"
      >
        <li class="breadcrumb-item text-muted">
          <router-link
            :to="route.path"
            class="text-muted text-hover-primary">
            {{ route.title }}
          </router-link>
        </li>
        <li class="breadcrumb-item">
          <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
      </template>
      <li class="breadcrumb-item pe-3 text-dark">
        {{ currentRoute.title }}
      </li>
    </ul>
    <!--end::Breadcrumb-->
  </div>
  <!--end::Page title-->
</template>

<script>
import { useRouter } from 'vue-router'

export default {
  name: "Breadcrumbs",
  setup() {
    const router = useRouter()
    console.log(router.currentRoute)
    return {
      currentRoute: router.currentRoute
    }
  }
}
</script>

<style scoped>

</style>