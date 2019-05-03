<template>
  <div style="padding: 20px 70px;">
    <h1 style="text-align: center; margin-bottom: 20px;">Operators</h1>
    <vue-good-table
      ref="table"
      :columns="columns"
      :rows="rows"
      :fixed-header="true"
      :pagination-options="{
            enabled: true,
            mode: 'pages'
        }"
      :select-options="{ 
        enabled: true,
      }"
    >
      <div slot="selected-row-actions">
        <button @click.prevent="addBrand">Add Brand</button>
        <button @click.prevent="edit">Edit Operator</button>
      </div>
    </vue-good-table>
  </div>
</template>

<script>
import "vue-good-table/dist/vue-good-table.css";
import { VueGoodTable } from "vue-good-table";
import axios from "axios";

export default {
  components: {
    VueGoodTable
  },
  data() {
    return {
      columns: [
        {
          label: "Name",
          field: "name",
          filterOptions: {
            enabled: true, // enable filter for this column
            placeholder: "Filter By Name", // placeholder for filter input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "URL",
          field: "url",
          sortable: false
        },
        {
          label: "Active",
          field: "active",
          type: "number",
          filterOptions: {
            enabled: true, // enable filter for this column
            placeholder: "Filter By Active", // placeholder for filter input
            filterDropdownItems: [1, 0], // dropdown (with selected values) instead of text input
            trigger: "enter" //only trigger on enter not on keyup
          }
        },
        {
          label: "Date",
          field: "date",
          type: "date",
          dateInputFormat: "YYYY-MM-DD",
          dateOutputFormat: "YYYY-MM-DD",
          filterOptions: {
            enabled: true, // enable filter for this column
            placeholder: "Filter By Date", // placeholder for filter input
            trigger: "enter" //only trigger on enter not on keyup
          }
        }
      ],
      rows: []
    };
  },
  async mounted() {
    try {
      let { data } = await this.$axios.get("/operators");
      console.log('data', data);
      this.rows = data;
    } catch (error) {
      throw error;
    }
  },
  methods: {
    addBrand() {
      if(this.$refs['table'].selectedRows.length == 1) {
        this.$router.push({
          path: '/brands/create',
          query: {
            operator_id: this.$refs['table'].selectedRows[0].id
          }
        })
      } else {
        alert('Please select only one operator!');
      }
    },
    edit() {
      if(this.$refs['table'].selectedRows.length == 1) {
        this.$router.push(`/operators/update/${this.$refs['table'].selectedRows[0].id}`)
      } else {
        alert('Please select only one operator!');
      }
    }
  }
};
</script>
