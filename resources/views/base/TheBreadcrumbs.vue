<template>
  <!--begin::Page Title-->
  <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{ currentRoute.name }}</h5>
  <!--end::Page Title-->
  <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
  <!--begin::Breadcrumb-->
  <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li
        v-for="(route, index) in currentRoute.matched"
        :key="index"
        class="breadcrumb-item"
    >
      <router-link
          :to="route.path"
          class="text-muted"
      >
        {{ route.name }}
      </router-link>
    </li>
  </ul>
  <!--end::Breadcrumb-->
</template>

<script>
import { useRouter } from 'vue-router'

export default {
  name: "TheBreadcrumbs",
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