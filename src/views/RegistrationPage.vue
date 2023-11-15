<template>
    <v-sheet width="300" class="mx-auto">
      <v-form fast-fail @submit.prevent="register">
        <div v-if="message === 'error'">Invalid response</div>
  
        <v-text-field v-model="username" label="Username"></v-text-field>
        <v-text-field v-model="email" label="Email"></v-text-field>
        <v-text-field v-model="fullname" label="Full Name"></v-text-field>
        <v-text-field v-model="password" label="Password" type="password"></v-text-field>
        <v-text-field v-model="passwordConfirm" label="Password Confirm" type="password"></v-text-field>
  
        <div v-if="message === 'passwordMismatch'">Passwords do not match</div>
  
        <v-btn type="submit" block class="mt-2">Submit</v-btn>
        <router-link to="/">Login</router-link>
      </v-form>
    </v-sheet>
  </template>
  
  <script>
  import router from '@/router';
  import axios from 'axios';
  
  export default {
    data() {
      return {
        username: '',
        email: '',
        fullname: '',
        password: '',
        passwordConfirm: '',
        message: [],
      };
    },
    methods: {
      async register() {
        if (this.password === this.passwordConfirm) {
          const data = await axios.post('register', {
            username: this.username,
            email: this.email,
            fullname: this.fullname,
            password: this.password,
          });
  
          this.message = data.data.msg;
  
          if (data.data.msg === 'okay') {
            // sessionStorage.setItem("jwt", data.data.token)
            alert('Registered successfully');
            router.push('/');
          }
        } else {
          this.message = 'passwordMismatch';
        }
      },
    },
  };
  </script>
  