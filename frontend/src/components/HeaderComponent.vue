<template>
    <header>
      <div class="right-text"> Task </div>
      <button v-if="!nameParam" @click="googleLinkLogin" class="login-button">Login</button>
      <p v-else>Welcome, {{ nameParam }}!</p>
    </header>
  </template>

<script>
import axios from 'axios';
export default {
  data () {
    return {
      nameParam: null,
    }
  },
  methods: {
    async googleLinkLogin() {
      
      try {
        const response = await axios.get('http://localhost:8000/index.php');

        const apiLink = response.data;
        console.log(response);

        window.location.href = apiLink;
      } catch (error) {
        console.error('Błąd podczas pobierania linku z API', error);
      }
    }
  },
  mounted(){
    const urlParams = new URLSearchParams(window.location.search);
    this.nameParam = urlParams.get('name');
  }
};
</script>
  
  <style>
  header {
    
    display: flex;
    justify-content: space-between;

    align-items: center;
    padding: 10px;
    background-color: #333;
    border-radius: 4px;
    color: #fff;
  }
  
  .login-button {
    background-color: #4caf50;
    color: #fff;
    padding: 8px 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-align: right;
  }

  </style>
  