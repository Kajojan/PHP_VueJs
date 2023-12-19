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

            <input placeholder="A1" v-model="question.column" />
          </li>
          <button type="submit" @click="onSubmit()">Przypisz</button>
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
    };
  },
  mounted() {
    this.loadDataFromPHP();
  },
  methods: {
    onSubmit() {
      const questions = this.components;
      const regex = /^[a-zA-Z]+[0-9]+$/;
      questions.forEach((question) => {
        if (
          this.questions[question.column] == undefined &&
          regex.test(question.column)
        ) {
          this.questions[question.column] = question;
        }
      });

      console.log(this.questions);
      this.sendData();
    },
    loadDataFromPHP() {
      axios
        .get("http://localhost:8000/componentsJson.php")
        .then((response) => {
          this.components = response.data.components;
          this.components.forEach((question) => {
            question.column = "";
          });
          console.log(this.components);
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
        .then((response) => {
          this.dataFromPHP = response.data;
          console.log(response.data);
        })
        .catch((error) => {
          console.error("Error fetching data from PHP", error);
        });
    },
  },
};
</script>

<style></style>
