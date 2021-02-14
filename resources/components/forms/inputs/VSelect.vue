<template>
  <select class="custom-select form-control">
    <option selected="selected">Open this select menu</option>
    <option value="1">One</option>
    <option value="2">Two</option>
    <option value="3">Three</option>
  </select>
</template>

<script>

export default {
  name: "VSelect",
  components: {
  },
  setup() {
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