<template>
    <div>
        <h1>Szczegóły</h1>
        <p v-for="spread in dataFromPHP" :key="spread.properties.index"> 
          <button @click="goToDetails(spread.properties.title)" >{{ spread.properties.title }}</button>
        </p>
      </div>
</template>

<script>
import axios from "axios";
import router from "../router"

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
          console.log(response.data);
        })
        .catch((error) => {
          console.error("Error fetching data from PHP", error);
        });
    },
    goToDetails(sheet_name) {
      router.push({
        path: "/details/" + this.id + "/"+sheet_name
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