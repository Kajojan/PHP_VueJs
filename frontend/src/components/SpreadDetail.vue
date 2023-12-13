<template>
    <div>
        <h1>Szczegóły</h1>
        <p>{{ dataFromPHP }}</p>
      </div>
</template>

<script>
import axios from "axios";

export default {
  mounted() {
    this.loadDataFromPHP();
  },
  methods: {
    loadDataFromPHP() {
      axios
        .post("http://localhost:8000/sheets.php", {id: this.id},{headers: {
    'Content-Type': 'application/json',}
  },)
        .then((response) => {
          this.dataFromPHP = response.data;
          console.log(response);
        })
        .catch((error) => {
          console.error("Error fetching data from PHP", error);
        });
    },
  },
  data() {
    return {
      id: this.$route.params.id,
      dataFromPHP: null,
    };
  }

}
</script>

<style>

</style>