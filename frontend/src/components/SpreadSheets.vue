<template>
  <div id="spreads">
    <p v-for="spread in dataFromPHP" :key="spread.id">
      <button @click="goToDetails(spread.id)" >{{ spread.name }}</button>
    </p>
  </div>
</template>

<script>
import axios from "axios";
import router from "../router"
export default {
  watch: {
  },
  data() {
    return {
      dataFromPHP: null,
    };
  },
  mounted() {
    this.loadDataFromPHP();
  },
  methods: {
    loadDataFromPHP() {
      axios
        .get("http://localhost:8000/SpreadSheets.php")
        .then((response) => {
          this.dataFromPHP = response.data;
          console.log(response);
        })
        .catch((error) => {
          console.error("Error fetching data from PHP", error);
        });
    },
    goToDetails(id) {
      router.push({
        path: "/details/" + id,
      });
    },
  },
};
</script>

<style scoped>
#spreads {
  display: grid;
  grid-template-columns: repeat(3, 300px);
  grid-column-gap: 20px;
  grid-row-gap: 20px;
}

p {
  width: 250px;
  height: 150px;
  background-color: #4caf50;
}
button {
  background-color: #4caf50;

  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  width: 100%;
  height: 100%;
  max-width: 100%;
  cursor: pointer;
}
</style>
