<template>
    <div class="container d-flex align-items-center justify-content-center h-100">
      <div class="v-container theme-container">
        <v-sheet width="300" class="mx-auto">
          <v-form fast-fail @submit.prevent="register" class="text-center">
            <div v-if="message === 'error'">Invalid response</div>
            
            <div v-if="registrationSuccess" class="success-message">
              Registration successful! You can now log in.
            </div>
  
            <v-text-field v-model="username" label="Username" :rules="usernameRules"></v-text-field>
            <v-text-field v-model="email" label="Email" :rules="emailRules"></v-text-field>
            <v-text-field v-model="full_name" label="Full Name" :rules="fullNameRules"></v-text-field>
            <v-text-field v-model="password" label="Password" type="password" :rules="passwordRules"></v-text-field>
            <v-text-field v-model="passwordConfirm" label="Password Confirm" type="password"></v-text-field>
  
            <div v-if="message === 'passwordMismatch'">Passwords do not match</div>
            <div v-if="message === 'usernameTaken'">Username is already taken</div>
            <div v-if="message === 'emailTaken'">Email is already taken</div>
            <div v-if="message === 'fullNameTaken'">Full Name is already taken</div>
            <div v-if="message === 'passwordRequirements'">Password must contain at least one special character and be at least 8 characters long</div>
  
            <v-btn type="submit" block class="mt-2">Submit</v-btn>
            <v-btn to="/" block class="mt-4"> Login</v-btn>
  
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
        full_name: '',
        password: '',
        passwordConfirm: '',
        message: null,
        registrationSuccess: false,
        usernameRules: [
          (v) => !!v || 'Username is required',
          (v) => (v && v.length >= 4) || 'Username must be at least 4 characters',
        ],
        // Removed email validation rule
        emailRules: [
          (v) => !!v || 'Email is required',
        ],
        fullNameRules: [
          (v) => !!v || 'Full Name is required',
        ],
        passwordRules: [
          (v) => !!v || 'Password is required',
          (v) => /^(?=.*[!@#$%^&*_])(?=.*[a-zA-Z])(?=.*[0-9]).{8,}$/.test(v) || 'Password must contain at least one special character (including underscore) and be at least 8 characters long',
        ],
      };
    },
    methods: {
      async register() {
        try {
          // Check if passwords match
          if (this.password !== this.passwordConfirm) {
            this.message = 'passwordMismatch';
            return;
          }
  
          // Make the API call to check if the username exists
          const usernameCheckResponse = await axios.post('/checkusername', {
            username: this.username,
          });
  
          // Handle the response from the username check
          if (!usernameCheckResponse.data.available) {
            // Username is not available
            console.error('Username already exists');
            this.message = 'usernameTaken';
            return;
          }
  
          // Proceed with user registration
          const registrationResponse = await axios.post('/Superacc', {
            username: this.username,
            email: this.email,
            full_name: this.full_name,
            password: this.password,
            role: 'admin', // Set the user role to 'admin'
          });
  
          // Handle the response from the backend registration
          if (registrationResponse.data.success) {
            // Registration successful
            console.log('Registration successful');
            this.registrationSuccess = true;
            // You can redirect or show a success message here
          } else {
            // Registration failed for some reason
            console.error('Registration failed:', registrationResponse.data.message);
            this.message = 'registrationFailed';
          }
        } catch (error) {
          // Handle other errors, such as network issues or server errors
          console.error('An error occurred during registration:', error);
          this.message = 'error';
        }
      },
    },
  };
  </script>
  
  <style scoped>
  .success-message {
    color: green;
    font-weight: bold;
    margin-top: 10px;
  }
  </style>
  