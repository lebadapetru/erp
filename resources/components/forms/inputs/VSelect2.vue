<template>
  <v-select :options="options" label="country" />
</template>

<script>
import { onMounted } from 'vue'
import vSelect from '../../../../node_modules/vue-select/src/index.js';

export default {
  name: "VSelect2",
  components: {
    vSelect
  },
  setup() {
    onMounted(() => {
      console.log(vSelect)
    })
    return {
      options: [
        'option1',
        'option2'
      ]
    }
  }
}
</script>

<style scoped>

</style>