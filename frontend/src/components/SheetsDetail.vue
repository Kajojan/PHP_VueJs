<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Przyporządkuj pytania do kolumn</h1>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <ul>
          <li v-for="question in components" :key="question.id">
            <p>{{ question.title }}</p>

            <select v-model="question.column">
                <option v-for="column in questions.columns" :key="column" :value="column">{{ column }}</option>
              
            </select>
            <button @click="console.log(question, question.column)">
              Przypisz
            </button>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
    data() {
        return {
        questions: {
  questions: [],

  columns: ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'],
},

            components: [],
        };
    },
    mounted() {
    this.loadDataFromPHP();
  },
  methods: {
    loadDataFromPHP() {
      axios
        .get("http://localhost:8000/componentsJson.php")
        .then((response) => {
          this.components = response.data.components;
          console.log(response.data);
        })
        .catch((error) => {
          console.error("Error fetching data from PHP", error);
        });
    },
  },
}
</script>

<style></style>
