<script>
export default {
  name: 'App',
  data: function() {
    return {
      id: 0,
      separator: '',
      resultData: '',
      resultError: ''
    }
  },
  methods: {
    getCrumb() {
      this.resultData = '';
      this.resultError;
      this.axios
        .get('/api/crumb.php?id=' + encodeURIComponent(this.id) + '&separator=' + encodeURIComponent(this.separator))
        .then((response) => {
          this.resultData = (response.data['crumb'] ? decodeURIComponent(response.data['crumb']) : '');
          this.resultError = (response.data['error'] ? response.data['error'] : '');
        })
        .catch(function(err) {
          this.resultError = err;
        });
    }
  }
}
</script>

<template>
  <header>
    <h1>{{"Clothing Crumb Retriever"}}</h1>
  </header>
  <main>
    <div class="inputRow">
      <label>{{"ID: "}}</label>
      <input type="text" v-model="id" />
    </div>
    <div class="inputRow">
      <label>{{"Separator: "}}</label>
      <input type="text" v-model="separator" />
    </div>
    <button type="text" @click="getCrumb()">{{"Send"}}</button>
    <p>{{resultData}}</p>
    <p>{{resultError}}</p>
  </main>
</template>

<style>
body {
  padding: 0;
  margin: 0;
}

header {
  width: 100%;
  text-align: center;
  background-color: #6633CC;
  padding: 20px;;
  margin: 0;
}

h1 {
  margin: 0;
  padding: 0;
  color: white;
}
main {
  width: calc(100vw - 80px);
  min-height: 100px;
  display: flex;
  flex-direction: column;
  align-content: center;
  align-items: center;
  padding: 20px;
  margin: 20px;
  background-color: #9999FF;
  border-radius: 15px;
}

.inputRow {
  width: 100%;
  display: flex;
  flex-direction: row;
  align-content: center;
  align-items: center;
  justify-content: center;
  margin: 10px 0;
}

label {
  width: calc(25% - 20px);
  text-align: right;
  padding-right: 20px;
  font-size: 18px;
  line-height: 25px;
  color: white;
  font-weight: bold;
}

input {
  width: 100%;
  font-size: 18px;
  line-height: 25px;
  padding: 5px 10px;
  border-radius: 5px;
  border: none;
}

button {
  width: 100px;
  height: 40px;
  font-size: 18px;
  font-weight: bold;
  line-height: 25px;
  padding-left: 10px;
  background-color: #6633CC;
  color: white;
  border: none;
  border-radius: 15px;
}

button:hover {
  cursor: pointer;
  background-color: #6600CC
}

p {
  color: white;
  font: 18px;
  line-height: 25px;
  font-weight: bold;
}
</style>
