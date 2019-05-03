<template>
  <div style="padding: 20px 70px; text-align: center;">
    <h1 style="text-align: center; margin-bottom: 20px;">Update Operator</h1>
    <div style="width: 60%; text-align: left; margin:auto;">
      <b-form @submit="onSubmit">
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

        <b-button type="submit" variant="primary">Update</b-button>
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
        active: null,
        date: ''
      },
      options: [
        { text: 'Yes', value: 1 },
        { text: 'No', value: 0 }
      ],
    };
  },
  async mounted() {
    try {
      let { data } = await this.$axios.get(`/operators/${this.$route.params.id}`);

      this.form.name = data.name;
      this.form.url = data.url;
      this.form.active = data.active;
      this.form.date = data.date;
    } catch(err) {
      console.log(err);
    }
  },
  methods: {
    async onSubmit(evt) {
      try {
        evt.preventDefault();
        let { data } = await this.$axios.put(`/operators/${this.$route.params.id}`, this.form);

        if(data) {
          this.$router.push('/operators');
        } else {
          alert('Request Failed!');
        }
      } catch(err) {
        alert('Request Failed!');
      }
    }
  }
};
</script>

