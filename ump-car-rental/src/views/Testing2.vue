<template>
  <v-container>
    <v-layout row>
      <label>
        Files
        <input type="file" ref="files" multiple id="files" accept="image/*" @change="handleFilesUpload()">
      </label>
    </v-layout>
    <!-- <v-layout column>
      <v-flex xs12 sm12 md12>
        <div v-for="(file, key) in files" :key="key">{{ file.name }} <span><v-btn color="red darken-3" dark small fab @click="removeKey(key)"><v-icon>close</v-icon></v-btn></span> </div>
      </v-flex>
    </v-layout> -->
    <v-layout row wrap>
      <v-flex v-for="(img,key) in imageUrl" :key="key" xs4 d-flex>
        <v-img :src="img"  height="100" width="20"></v-img>
        <span><v-btn color="red darken-3" dark small fab @click="removeKey(key)"><v-icon>close</v-icon></v-btn></span>
      </v-flex>
    </v-layout>
    <v-layout row>
      <div class="pt-4">
        <v-btn color="red darken-3" dark large @click="addFiles()">Add Files</v-btn>
      </div>
      <div class="pt-4">
        <v-btn color="red darken-3" dark large @click="removeAll()">delete Files</v-btn>
      </div>
    </v-layout>
  </v-container>
</template>

<script>

export default {
  name: 'Testing2',
  data() {
    return {
      files: [],
      imageUrl: []
    }
  },
  methods: {
    addFiles: function() {
      this.$refs.files.click()
    },
    handleFilesUpload: function() {
      let selectFile = this.$refs.files.files
      for (let index = 0; index < selectFile.length; index++) {
        this.imageUrl.push(window.URL.createObjectURL(selectFile[index]))
      }
      if (selectFile.length > 3) {
        for (let index = this.imageUrl.length; index > 3; index--) {
          this.imageUrl.splice(0,1)
          console.log(this.imageUrl.length);
        }
      }
      console.log(typeof this.imageUrl);
    },
    removeKey: function(key) {
      this.imageUrl.splice(key,1)
    },
    removeAll: function() {
      for (let index = 3; index < this.imageUrl.length; index++) {
        this.imageUrl.splice(0,1)
      }
    }
  }
}
</script>

<style scoped>
input[type="file"] {
  position: absolute;
  top: -500px;
}
</style>
