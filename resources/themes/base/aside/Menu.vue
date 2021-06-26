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
      <template v-for="(parentRoute, parentIndex) in routes" :key="parentIndex">
        <template v-if="!parentRoute.hasChildren">
          <div class="menu-item">
            <router-link
              v-slot="{ href, navigate, isActive, isExactActive }"
              :to="parentRoute.path"
            >
              <a
                :class="[isActive && 'active', isExactActive && 'active']"
                :href="href"
                class="menu-link"
                @click="navigate"
              >
                    <span
                      v-if="(parentRoute.meta.hasOwnProperty('svgIcon') && parentRoute.meta.svgIcon) || (parentRoute.meta.hasOwnProperty('fontIcon') && parentRoute.meta.fontIcon)"
                      class="menu-icon"
                    >
                  <i
                    v-if="(parentRoute.meta.hasOwnProperty('fontIcon') && parentRoute.meta.fontIcon)"
                    :class="parentRoute.meta.fontIcon"
                    class="bi fs-3"
                  ></i>
                  <span
                    v-else-if="(parentRoute.meta.hasOwnProperty('svgIcon') && parentRoute.meta.svgIcon)"
                    class="svg-icon svg-icon-2"
                  >
                    <inline-svg :src="parentRoute.meta.svgIcon" />
                  </span>
                </span>
                <span class="menu-title">{{ parentRoute.meta.title }}</span>
              </a>
            </router-link>
          </div>
        </template>
        <div
          v-else
          class="menu-item menu-accordion"
          @click="toggleMenuItem(parentRoute)"
          :class="{ showing: (selectedMenuItems.includes(parentRoute.name)), here: activeTree.includes(parentRoute.name) }"
        >
              <span class="menu-link">
                <span
                  v-if="(parentRoute.meta.hasOwnProperty('svgIcon') && parentRoute.meta.svgIcon) || (parentRoute.meta.hasOwnProperty('fontIcon') && parentRoute.meta.fontIcon)"
                  class="menu-icon"
                >
                  <i
                    v-if="(parentRoute.meta.hasOwnProperty('fontIcon') && parentRoute.meta.fontIcon)"
                    :class="parentRoute.meta.fontIcon"
                    class="bi fs-3"
                  ></i>
                  <span
                    v-else-if="(parentRoute.meta.hasOwnProperty('svgIcon') && parentRoute.meta.svgIcon)"
                    class="svg-icon svg-icon-2"
                  >
                    <inline-svg :src="parentRoute.meta.svgIcon" />
                  </span>
                </span>
                <span class="menu-title">{{ parentRoute.meta.title }}</span>
                <span class="menu-arrow"></span>
            </span>
          <div
            v-if="parentRoute.hasChildren"
            class="menu-sub menu-sub-accordion"
            :id="'menu-submenu-'+parentRoute.name"
            @click.stop
          >
            <template v-for="(childRoute, childIndex) in parentRoute.children" :key="childIndex">
              <template v-if="!childRoute.hasChildren">
                <div class="menu-item">
                  <router-link
                    v-slot="{ href, navigate, isActive, isExactActive }"
                    :to="childRoute.path"
                  >
                    <a
                      :class="[
                          isActive && 'active',
                          isExactActive && 'active'
                        ]"
                      :href="href"
                      class="menu-link"
                      @click="navigate"
                    >
                        <span class="menu-bullet">
                          <span class="bullet bullet-dot"></span>
                        </span>
                      <span class="menu-title">{{ childRoute.meta.title }}</span>
                    </a>
                  </router-link>
                </div>
              </template>
              <div
                v-else
                class="menu-item menu-accordion"
                @click="toggleMenuItem(childRoute)"
                :class="{ showing: (selectedMenuItems.includes(childRoute.name)), here: activeTree.includes(childRoute.name) }"
              >
                    <span class="menu-link">
                      <span class="menu-bullet">
                        <span class="bullet bullet-dot"></span>
                      </span>
                      <span class="menu-title">{{ childRoute.meta.title }}</span>
                      <span class="menu-arrow"></span>
                    </span>
                <div
                  v-if="childRoute.hasChildren"
                  class="menu-sub menu-sub-accordion"
                  :id="'menu-submenu-'+childRoute.name"
                  @click.stop
                >
                  <template v-for="(grandChildRoute, grandChildIndex) in childRoute.children" :key="grandChildIndex">
                    <div class="menu-item">
                      <router-link
                        v-slot="{ href, navigate, isActive, isExactActive }"
                        :to="grandChildRoute.path"
                      >
                        <a
                          class="menu-link"
                          :class="[
                                isActive && 'active',
                                isExactActive && 'active'
                              ]"
                          :href="href"
                          @click="navigate"
                        >
                              <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                              </span>
                          <span class="menu-title">{{ grandChildRoute.meta.title }}</span>
                        </a>
                      </router-link>
                    </div>
                  </template>
                </div>
              </div>
            </template>
          </div>
        </div>

      </template>
    </div>
    <!--end::Menu-->
  </div>
  <!--end::Menu wrapper-->
</template>

<script lang="ts">
import { computed, defineComponent, onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import InlineSvg from 'vue-inline-svg'

export default defineComponent({
  name: "Menu",
  components: {
    InlineSvg,
  },
  setup() {
    const selectedMenuItems = ref([])
    const router = useRouter()

    const toggleMenuItem = (item) => {
      if (!item.hasChildren) {
        return;
      }
      $(function () {
        console.log('toggle: ' + '#kt_aside_menu_wrapper #menu-submenu-' + item.name)
        $('#kt_aside_menu_wrapper #menu-submenu-' + item.name).slideToggle('fast')
      })

      if (!selectedMenuItems.value.includes(item.name)) {
        selectedMenuItems.value.push(item.name)
      } else {
        selectedMenuItems.value.splice(selectedMenuItems.value.indexOf(item.name), 1)
      }
    }

    const processRoutes = (routes) => {
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
            route.hasOwnProperty('children') &&
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

            //collapse menu item on page load
            const matched = router.currentRoute.value.matched.some((matched) => (matched.name === route.name))
            if (matched && route.hasChildren) {
              toggleMenuItem(route)
            }

            return route
          }

          return route
        })
    }
    console.log(router)
    const routes = processRoutes(router.options.routes[1].children)

    return {
      routes,
      toggleMenuItem,
      selectedMenuItems,
      activeTree: computed(() => {
        return router.currentRoute.value.matched.map((match) => match.name)
      })
    }
  }
})
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
