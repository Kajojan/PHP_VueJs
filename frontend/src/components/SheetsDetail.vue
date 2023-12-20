<template>
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h2 v-if="this.added">Dodałeś Pytania do arkusza</h2>
        <h1>Przyporządkuj pytania do kolumn </h1>
        <p>odpowiedzi zostaną dodane pod np A1-pytanie A2-odpowiedź,  dlatego musisz zostawić odstęp </p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <ul>
          <li v-for="question in components" :key="question.id">
            <p>{{ question.title }}</p>

            <input placeholder="column: A" v-model="question.column" />
            <input placeholder="rekor: 1" v-model="question.number" />
          </li>
          <button type="submit" @click="onSubmit()">Przypisz</button>
          <a v-if="this.error.status"> {{ this.error.message }}</a>
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
      questions: {},
      components: [],
      id: this.$route.params.id,
      sheet_id: this.$route.params.sheet,
      added: false,
      error: { status: false, message: "" },
    };
  },
  mounted() {
    this.loadDataFromPHP();
  },
  methods: {
    onSubmit() {
      const questions = this.components;
      const regex_column = /^[a-zA-Z]+$/;
      const regex_rekord = /^[0-9]+$/;

      questions.forEach((question) => {
        if (
          regex_column.test(question.column) &&
          regex_rekord.test(question.number)
        ) {
          const column_rekord = `${question.column}${question.number}:${
            parseInt(question.number) + 1
          }`;
          const validation_down = `${question.column}${
            parseInt(question.number) - 1
          }:${parseInt(question.number)}`;
          const validation_up = `${question.column}${
            parseInt(question.number) + 1
          }:${parseInt(question.number) + 2}`;
          if (
            this.questions[column_rekord] == undefined &&
            this.questions[validation_down] == undefined &&
            this.questions[validation_up] == undefined
          ) {
            this.questions[column_rekord] = question;
          } else {
            this.error = { status: true, message: `${column_rekord} komórki sie nakładają` };
          }
        }
      });
      if (!this.error.status) {
        this.sendData();
        for (let index = 0; index < this.components.length; index++) {
          this.components[index].column = "";
          this.components[index].number = "";
          
        }
        this.questions={}
        this.added = true;

      }

    },
    loadDataFromPHP() {
      axios
        .get("http://localhost:8000/componentsJson.php")
        .then((response) => {
          this.components = response.data.components;
          this.components.forEach((question) => {
            question.column = "";
          });
        })
        .catch((error) => {
          console.error("Error fetching data from PHP", error);
        });
    },
    sendData() {
      const data = this.questions;

      axios
        .post(
          "http://localhost:8000/addData.php",
          { id: this.id, sheetName: this.sheet_id, data: data },
          {
            headers: {
              "Content-Type": "application/json",
            },
          }
        )
        
    },
  },
};
</script>

<style scope>
#container {
  position: static;
  top: 0;
  left: 0;
}
h2 {
  color: #4caf50;
}
a {
  margin: 5px;
  color: red;
}
</style>
