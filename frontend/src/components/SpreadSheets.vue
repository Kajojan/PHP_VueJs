<template>
  <div id="spreads">
    <p v-for="spread in dataFromPHP" :key="spread.id">
      <button>{{ spread.name }}</button>
    </p>
  </div>
</template>

<script>
import axios from "axios";
export default {
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
      // Użyj biblioteki Axios do zapytania AJAX
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
  },
};
</script>

<style scoped>
#spreads {
    display: flex;
    flex-wrap: wrap;
    columns: 4;
    column-width: 1500px;
    justify-content: space-between;
    margin: 0 auto;
}

p {
  width: 150px;
  margin: 10px;
  background-color: #04aa6d; /* Green */
}
button {
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  width: 100%;
  max-width: 100%;
  cursor: pointer;
}
</style>
