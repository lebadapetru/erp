<template>
  <div>
    <div>
      <div class="row align-items-center">
        <div class="col-6">
          <h1>Products</h1>
        </div>
        <div class="col-6 text-right">
          <b-button @click="">Add product</b-button>
        </div>
      </div>

      <b-card no-body>
        <b-card-header header-tag="nav">
          <b-nav card-header tabs>
            <b-nav-item active>Active</b-nav-item>
            <b-nav-item>Inactive</b-nav-item>
            <b-nav-item disabled>Disabled</b-nav-item>
          </b-nav>
        </b-card-header>

        <b-card-body class="text-center">
          <b-table :items="items"></b-table>
        </b-card-body>
      </b-card>
    </div>
  </div>
</template>

<script>

export default {
  name: "Products",
  data() {
    return {
      items: [
        {age: 40, first_name: 'Dickerson', last_name: 'Macdonald'},
        {age: 21, first_name: 'Larsen', last_name: 'Shaw'},
        {age: 89, first_name: 'Geneva', last_name: 'Wilson'},
        {age: 38, first_name: 'Jami', last_name: 'Carney'}
      ]
    }
  }
}
</script>

<style scoped>

</style>