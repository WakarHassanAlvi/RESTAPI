<template>
  <div>
    <div>
  <b-navbar toggleable="lg" type="dark" variant="info">

    <b-collapse id="nav-collapse" is-nav>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ml-auto pr-2">
        <b-button size="sm" class="my-2 my-sm-0 ml-2" type="submit" @click.prevent="addOperator">Add Operator</b-button>
        <b-button size="sm" class="my-2 my-sm-0 ml-2" type="submit" @click.prevent="operators">Operators</b-button>
        <b-button size="sm" class="my-2 my-sm-0 ml-2" type="submit" @click.prevent="brands">Brands</b-button>
        <b-button size="sm" class="my-2 my-sm-0 ml-2" type="submit" @click.prevent="addBrand">Add Brand</b-button>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
</div>
    <nuxt />
  </div>
</template>

<script>
export default {
  methods: {
    brands() {
      this.$router.push('/brands');
    },
    operators() {
      this.$router.push('/operators');
    },
    addOperator() {
      this.$router.push('/operators/create');
    },
    addBrand() {
      this.$router.push('/brands/create');
    }
  }
}
</script>


<style>
html {
  font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI',
    Roboto, 'Helvetica Neue', Arial, sans-serif;
  font-size: 16px;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

*,
*:before,
*:after {
  box-sizing: border-box;
  margin: 0;
}

.button--green {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #3b8070;
  color: #3b8070;
  text-decoration: none;
  padding: 10px 30px;
}

.button--green:hover {
  color: #fff;
  background-color: #3b8070;
}

.button--grey {
  display: inline-block;
  border-radius: 4px;
  border: 1px solid #35495e;
  color: #35495e;
  text-decoration: none;
  padding: 10px 30px;
  margin-left: 15px;
}

.button--grey:hover {
  color: #fff;
  background-color: #35495e;
}
</style>
