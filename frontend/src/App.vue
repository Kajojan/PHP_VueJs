<template>
  <Header/>
  <div id="body">
    <MainPage/>
  </div>
  

</template>

<script>
import MainPage from './components/MainPage.vue';
import Header from './components/HeaderComponent.vue'
export default {
  name: 'App',
  components:{
    MainPage,
    Header
  }

}
</script>

<style>
#app{
  height: 100vh;
  margin: 0;
  padding: 0;
  font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;

}

#body {
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  margin: 0;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;

}

</style>
