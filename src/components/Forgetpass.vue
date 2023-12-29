<!-- ForgotPassword.vue -->

<template>
    <v-container class="fill-height">
        <v-row align="center" justify="center" class="fill-height">
            <v-col cols="12" sm="8" md="6" lg="4">
                <v-card>
                    <v-card-title class="text-h5">Reset Password</v-card-title>
                    <v-card-text>
                        <v-form @submit.prevent="resetPassword">
                            <v-text-field v-model="username" label="Username" type="text" required></v-text-field>
                            <v-text-field v-model="email" label="Email" type="email" required :rules="emailRules"></v-text-field>
                            <v-text-field v-model="password" label="Password" type="password" :rules="passwordRules"></v-text-field>
                            <v-text-field v-model="passwordConfirm" label="Confirm Password" type="password"></v-text-field>

                            <div v-if="message === 'passwordMismatch'">Passwords do not match</div>
                            <div v-if="message === 'notFound'">Username and email not found</div>

                            <v-btn type="submit" block class="mt-2">Submit</v-btn>
                            <v-btn to="/" block class="mt-4">Login</v-btn>
                        </v-form>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            username: '',
            email: '',
            password: '',
            passwordConfirm: '',
            emailRules: [
                (v) => !!v || 'Email is required',
                (v) => /.+@.+\..+/.test(v) || 'Email must be valid',
            ],
            passwordRules: [
                (v) => !!v || 'Password is required',
                (v) => /^(?=.*[!@#$%^&*_])(?=.*[a-zA-Z])(?=.*[0-9]).{8,}$/.test(v) || 'Password must contain at least one special character (including underscore) and be at least 8 characters long',
            ],
            message: '', // Added for validation messages
        };
    },
    methods: {
        async resetPassword() {
            try {
                // Check if passwords match
                if (this.password !== this.passwordConfirm) {
                    this.message = 'passwordMismatch';
                    return;
                }

                // Make an API request to your CodeIgniter backend
                const response = await axios.post('/forgotPassword', {
                    username: this.username,
                    email: this.email,
                    password: this.password,
                    confirm_password: this.passwordConfirm,
                });

                // Check if 'data' property exists in the response
                if (response && response.data) {
                    // Display success message or handle the response as needed
                    console.log(response.data.message);
                } else {
                    console.error('Invalid response format:', response);
                }
            } catch (error) {
                // Check if 'response' property exists in the error object
                if (error.response && error.response.data) {
                    if (error.response.data.message === 'Username and email not found') {
                        this.message = 'notFound';
                    } else {
                        // Display other error messages or handle the error as needed
                        console.error('Reset password error:', error.response.data);
                    }
                } else {
                    console.error('Unexpected error:', error);
                }
            }
        },
    },
};
</script>
