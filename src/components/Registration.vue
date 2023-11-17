<template>
  <div class="container d-flex align-items-center justify-content-center h-100">
    <div class="v-container theme-container">
    <v-sheet  width="300" class="mx-auto" >
  <v-form fast-fail @submit.prevent="register" class="text-center">
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
    </div>
  </div>
  </template>
    
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        username: '',
        email: '',
        fullname: '',
        password: '',
        passwordConfirm: '',
      message: null,
      
      };
    },
    methods: {
      async register() {
        try {
  const ins = await axios.post('register', {
    username: this.username,
    email: this.email,
    fullname: this.fullname,
    password: this.password,
  });
  // Assuming your backend sends a JSON ins with a 'success' property
  if (ins.data.success) {
    // Registration successful
    console.log('Registration successful');
    // You can redirect or show a success message here
  } 
  else {
    // Registration failed
    console.error('Registration failed');
    // You might want to set an error message or handle it in some way
  }
}
  catch (error) {
  // Handle other errors, such as network issues or server errors
  console.error('An error occurred during registration:', error);
  // You might want to set an error message or handle it in some way
}

        //     try {
    //     // Check if passwords match
    //     if (this.password !== this.passwordConfirm) {
    //       this.message = 'passwordMismatch';
    //       return;
    //     }

    //     // Make the API call to your CodeIgniter 4 backend
    //     const response = await axios.post('register', {
    //       username: this.username,
    //       email: this.email,
    //       fullname: this.fullname,
    //       password: this.password,
    //     });

    //     // Handle the response from the backend
    //     if (response.data.success) {
    //       // Registration successful
    //       console.log('Registration successful');
    //       // You can redirect or show a success message here
    //     } else {
    //       // Registration failed
    //       console.error('Registration failed');
    //       this.message = 'error';
    //     }
    //   } catch (error) {
    //     // Handle other errors, such as network issues or server errors
    //     console.error('An error occurred during registration:', error);
    //     this.message = 'error';
    //   }
      
        // if (this.password === this.passwordConfirm) {
        //   const data = await axios.post('register', {
        //     username: this.username,
        //     email: this.email,
        //     fullname: this.fullname,
        //     password: this.password,
        //   });
  
        //   this.message = data.data.msg;
  
        //   if (data.data.msg === 'okay') {
        //     // sessionStorage.setItem("jwt", data.data.token)
        //     alert('Registered successfully');
        //     router.push('/');
        //   }
        // } else {
        //   this.message = 'passwordMismatch';
        // }
      },
    },
  };
  </script>