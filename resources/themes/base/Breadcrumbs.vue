<template>
  <!--begin::Page title-->
  <div
    class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1"
  >
    <!--begin::Title-->
    <h1 class="d-flex align-items-center text-dark fw-bolder my-1 fs-3">
      {{ currentRoute.meta.title }}
    </h1>
    <!--end::Title-->

    <span
      class="h-20px border-gray-200 border-start mx-4"
    ></span>

    <!--begin::Breadcrumb-->
    <ul
      v-if="currentRoute.matched.length > 0"
      class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1"
    >
      <template
        v-for="(route, index) in currentRoute.matched"
        :key="index"
      >
        <template
          v-if="!route.meta.isSystem"
        >
          <li
            class="breadcrumb-item text-muted"
          >
            <router-link
              :to="route.path"
              class="text-muted text-hover-primary">
              {{ route.meta.title }}
            </router-link>
          </li>
          <li
            v-if="currentRoute.name !== route.name"
            class="breadcrumb-item"
          >
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
          </li>
        </template>
      </template>
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
    console.log('here')
    console.log(router.currentRoute)
    return {
      currentRoute: router.currentRoute
    }
  }
}
</script>

<style scoped>

</style>