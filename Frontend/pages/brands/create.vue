<template>
  <div style="padding: 20px 70px; text-align: center;">
    <h1 style="text-align: center; margin-bottom: 20px;">Add Brand</h1>
    <div style="width: 60%; text-align: left; margin:auto;">
      <b-form @submit="onSubmit" @reset="onReset">
        <b-form-group id="input-group-1" label="Name:" label-for="name">
          <b-form-input id="name" v-model="form.name" required placeholder="Enter Name"></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-2" label="URL:" label-for="url">
          <b-form-input id="url" v-model="form.url" required placeholder="Enter URL"></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-3" label="Operator ID:" label-for="operator_id">
          <b-form-input id="operator_id" v-model="form.operator_id" required placeholder="Enter Operator"></b-form-input>
        </b-form-group>

        <b-form-group label="Active:">
          <b-form-radio-group
            id="active"
            v-model="form.active"
            :options="options"
            buttons
            required
            button-variant="outline-primary"
            size="lg"
            name="radio-btn-outline"
          ></b-form-radio-group>
        </b-form-group>

        <b-form-group id="input-group-4" label="Date:" label-for="date">
          <b-form-input id="date" type="date" v-model="form.date" required ></b-form-input>
        </b-form-group>

        <b-button type="submit" variant="primary">Add</b-button>
        <b-button type="reset" variant="secondary">Reset</b-button>
      </b-form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      form: {
        name: "",
        url: "",
        operator_id: '',
        active: null,
        date: ''
      },
      options: [
        { text: 'Yes', value: true },
        { text: 'No', value: false }
      ],
    };
  },
  mounted() {
    if(this.$route.query.operator_id) {
      this.form.operator_id = this.$route.query.operator_id;
    }
  },
  methods: {
    async onSubmit(evt) {
      try {
        evt.preventDefault();
        let { data } = await this.$axios.post('/brands', this.form);

        if(data) {
          this.$router.push('/brands');
        } else {
          alert('Request Failed!');
        }
      } catch(err) {
        alert('Request Failed!');
      }
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      this.form.name = "";
      this.form.url = "";
      this.form.active = null;
      this.form.date = '';
    }
  }
};
</script>

