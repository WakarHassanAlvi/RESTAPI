<template>
  <div style="padding: 20px 70px; text-align: center;">
    <h1 style="text-align: center; margin-bottom: 20px;">Add Operator</h1>
    <div style="width: 60%; text-align: left; margin:auto;">
      <b-form @submit="onSubmit" @reset="onReset">
        <b-form-group id="input-group-1" label="Name:" label-for="name">
          <b-form-input id="name" v-model="form.name" required placeholder="Enter Name"></b-form-input>
        </b-form-group>

        <b-form-group id="input-group-2" label="URL:" label-for="url">
          <b-form-input id="url" v-model="form.url" required placeholder="Enter URL"></b-form-input>
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

        <b-form-group id="input-group-3" label="Date:" label-for="date">
          <b-form-input id="date" type="date" v-model="form.date" required></b-form-input>
        </b-form-group>

        <b-button type="submit" variant="primary">Add</b-button>
        <b-button type="reset" variant="secondary">Reset</b-button>
      </b-form>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      form: {
        name: "",
        url: "",
        active: null,
        date: ''
      },
      options: [
        { text: 'Yes', value: true },
        { text: 'No', value: false }
      ],
    };
  },
  methods: {
    async onSubmit(evt) {
      try {
        evt.preventDefault();
        let { data } = await this.$axios.post('/operators', this.form);

        if(data) {
          this.$router.push('/operators');
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

