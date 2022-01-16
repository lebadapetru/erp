<template>
  <div
    :class="'badge badge-light-' + badge.type"
  >
    {{ badge.label }}
  </div>
</template>

<script lang="ts">
const BADGE_TYPE_SUCCESS   = 'success'
const BADGE_TYPE_INFO      = 'info'
const BADGE_TYPE_WARNING   = 'warning'
const BADGE_TYPE_DANGER    = 'danger'
const BADGE_TYPE_DARK      = 'dark'
const BADGE_TYPE_SECONDARY = 'secondary'
const BADGE_TYPE_PRIMARY   = 'primary'
const BADGE_TYPE_LIGHT     = 'light'
const BADGE_TYPE_WHITE     = 'white'

import { computed, defineComponent } from "vue";
import {
  STATUSES,
  VISIBILITIES,
  PRODUCT_VISIBILITY_PUBLIC,
  PRODUCT_VISIBILITY_PRIVATE,
  PRODUCT_STATUS_DRAFTED,
  PRODUCT_STATUS_ACTIVE
} from "resources/views/products/ts/constants"

export default defineComponent({
  name: "VStatusBadgeCell",
  props: {
    status: {
      type: String,
      required: true,
      validator: (status: string) => {
        return [
          ...STATUSES,
          ...VISIBILITIES
        ].includes(status)
      }
    }
  },
  setup(props) {

    return {
      badge: computed(() => {

        const BADGE_STATUS_MAPPING = {
          [BADGE_TYPE_DARK]: [
            PRODUCT_STATUS_DRAFTED,
          ],
          [BADGE_TYPE_PRIMARY]: [
            PRODUCT_STATUS_ACTIVE,
          ],
          [BADGE_TYPE_SUCCESS]: [
            PRODUCT_VISIBILITY_PUBLIC,,
          ],
          [BADGE_TYPE_DANGER]: [
            PRODUCT_VISIBILITY_PRIVATE
          ],
        }

        let type

        Object.keys(BADGE_STATUS_MAPPING).forEach((key) => {
         if (BADGE_STATUS_MAPPING[key].includes(props.status)) {
           type = key
         }
        })

        return {
          type: type,
          label: props.status
        }
      })
    }
  }
})
</script>

<style scoped>

</style>