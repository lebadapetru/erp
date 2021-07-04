<template>
  <Multiselect
    v-model="value"
    :options="options"
    mode="tags"
    :searchable="true"
    :createTag="true"
    :hideSelected="false"
  />
</template>

<script>
import Multiselect from '@vueform/multiselect'
import { ref } from "vue";

export default {
  name: "VMultiSelect",
  components: {
    Multiselect,
  },
  setup() {
    return {
      value: ref([]),
      options: [
        'Batman',
        'Robin',
        'Joker',
      ]
    }
  }
}
</script>

<style scoped>
@import "~@vueform/multiselect/themes/default.css";
.multiselect.is-active {
  box-shadow: 0 0 0;
}
</style>