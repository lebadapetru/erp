<template>
  <!--begin::Menu wrapper-->
  <div
    id="kt_aside_menu_wrapper"
    class="hover-scroll-overlay-y my-5 my-lg-5"
  >
    <!--begin::Menu-->
    <div
      id="#kt_header_menu"
      class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
    >
      <template>
        <template
          v-for="(parentRoute, parentIndex) in routes"
          :key="parentIndex"
        >
          <div class="menu-item">
            <div class="menu-content pt-8 pb-2">
              <span class="menu-section text-muted text-uppercase fs-8 ls-1">
                {{ parentRoute.title }}
              </span>
            </div>
          </div>
          <template
            v-if="parentRoute.hasChildren"
          >
            <template
              v-for="(childRoute, childIndex) in parentRoute.children"
              :key="childIndex"
            >
              <div class="menu-item">
                <router-link
                  v-slot="{ href, navigate, isActive, isExactActive }"
                  :to="childRoute.path"
                >
                  <a
                    :class="[isActive && 'active', isExactActive && 'active']"
                    :href="href"
                    class="menu-link"
                    @click="navigate"
                  >
                    <span
                      v-if="(childRoute.hasOwnProperty('svgIcon') && childRoute.svgIcon) || (childRoute.hasOwnProperty('fontIcon') && childRoute.fontIcon)"
                      class="menu-icon"
                    >
                      <i
                        v-if="(childRoute.hasOwnProperty('fontIcon') && childRoute.fontIcon)"
                        :class="childRoute.fontIcon"
                        class="bi fs-3"
                      ></i>
                      <span
                        v-else-if="(childRoute.hasOwnProperty('svgIcon') && childRoute.svgIcon)"
                        class="svg-icon svg-icon-2"
                      >
                        <inline-svg :src="childRoute.svgIcon" />
                      </span>
                    </span>
                    <span class="menu-title">{{ childRoute.title }}</span>
                  </a>
                </router-link>
              </div>
            </template>
          </template>
        </template>
      </template>
    </div>
    <!--end::Menu-->
  </div>
  <!--end::Menu wrapper-->
</template>

<script>
import { ref } from "vue";
import { useRouter } from "vue-router";
import InlineSvg from 'vue-inline-svg'

export default {
  name: "Menu",
  components: {
    InlineSvg,
  },
  setup() {
    let selectedMenuItem = ref(null)
    const router = useRouter()

    let processRoutes = (routes) => {
      return routes
        .filter((route) => (
          route.hasOwnProperty('meta') && (
            !route.meta.hasOwnProperty('isSystem') ||
            (route.meta.hasOwnProperty('isSystem') && !route.meta.isSystem)
          )
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

<style lang="scss">
.aside-menu .menu .menu-sub .menu-item a a.menu-link {
  padding-left: calc(0.75rem + 25px);
  cursor: pointer;
  display: flex;
  align-items: center;
  flex: 0 0 100%;
  transition: none;
  outline: none !important;
}

.aside-menu .menu .menu-sub .menu-sub .menu-item a a.menu-link {
  padding-left: calc(1.5rem + 25px);
  cursor: pointer;
  display: flex;
  align-items: center;
  flex: 0 0 100%;
  transition: none;
  outline: none !important;
}
</style>
