<template>
  <!--begin::Aside-->
  <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand">
      <TheBrand />
      <!--end::Toolbar-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <VuePerfectScrollbar
        class="aside-menu-wrapper scroll"
        id="kt_aside_menu_wrapper"
    >
      <!--begin::Menu Container-->
      <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
           data-menu-dropdown-timeout="500">
        <!--begin::Menu Nav-->
        <ul class="menu-nav">
<!--          <li class="menu-section">-->
<!--            <h4 class="menu-text">E-Commerce</h4>-->
<!--            <i class="menu-icon ki ki-bold-more-hor icon-md"></i>-->
<!--          </li>-->
          <li
              v-for="(parentRoute, parentIndex) in routes"
              :key="parentIndex"
              class="menu-item menu-item-submenu"
              aria-haspopup="true"
              data-menu-toggle="hover"
              :class="{'menu-item-open': ((selectedMenuItem === parentIndex) && parentRoute.hasChildren)}"
              @click="toggleMenuItem(parentRoute, parentIndex, this)"
          >
            <router-link
                :to="parentRoute.path"
                class="menu-link menu-toggle"
            >
              <!--begin::Svg Icon-->
              <span class="svg-icon menu-icon" v-html="parentRoute.meta.icon"></span>
              <!--end::Svg Icon-->
              <span class="menu-text">{{ parentRoute.name }}</span>
              <i
                  v-if="parentRoute.hasChildren"
                  class="menu-arrow"
              ></i>
            </router-link>
            <div
                v-if="parentRoute.hasChildren"
                class="menu-submenu"
                :id="'menu-submenu-'+parentIndex"
                @click.stop
            >
              <i class="menu-arrow"></i>
              <ul class="menu-subnav">
                <li class="menu-item menu-item-parent" aria-haspopup="true">
												<span class="menu-link">
													<span class="menu-text">{{ parentRoute.name }}</span>
												</span>
                </li>
                <li
                    v-for="(childRoute, childIndex) in parentRoute.children"
                    :key="childIndex"
                    class="menu-item"
                    aria-haspopup="true"
                    data-menu-toggle="hover"
                >
                  <router-link
                      class="menu-link"
                      :to="childRoute.path"
                  >
                    <i class="menu-bullet menu-bullet-dot">
                      <span></span>
                    </i>
                    <span class="menu-text">{{ childRoute.name }}</span>
                  </router-link>
                </li>
              </ul>
            </div>
          </li>
        </ul>
        <!--end::Menu Nav-->
      </div>
      <!--end::Menu Container-->
    </VuePerfectScrollbar>
    <!--end::Aside Menu-->
  </div>
  <!--end::Aside-->
</template>

<script>
import { useRouter } from 'vue-router'
import TheBrand from "resources/views/base/TheBrand";
import { ref } from 'vue'

export default {
  name: "TheLeftNav",
  components: {
    TheBrand
  },
  setup() {
    let selectedMenuItem = ref(null)
    const router = useRouter()

    let processRoutes = (routes) => {
      return routes
          .filter((route) => (
              !route.meta.hasOwnProperty('isSystem') ||
              (route.meta.hasOwnProperty('isSystem') && !route.meta.isSystem)
          ))
          .map((route) => {
            route.hasChildren = false
            if (
                Array.isArray(route.children) &&
                route.children.length > 0
            ) {
              let children = route.children.filter((child) => {
                return !child.path.includes('/:')
              })
              if (!children.length) {
                return route
              }
              route.children = processRoutes(children)
              route.hasChildren = true

              return route
            }

            return route
          })
    }

    const routes = processRoutes(router.options.routes)

    const toggleMenuItem = (item, index) => {
      if (!item.hasChildren) {
        return;
      }
      $('#kt_aside_menu>ul:first-child>li>div[class=menu-submenu]').slideUp('fast')

      if (selectedMenuItem.value === index) {
        selectedMenuItem.value = null

        return
      }

      $('#menu-submenu-' + index).slideDown('fast')
      selectedMenuItem.value = index
    }

    return {
      routes,
      toggleMenuItem,
      selectedMenuItem
    }
  }
}
</script>

<style scoped>
</style>