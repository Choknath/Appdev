<template>
  <v-container fluid>
    <v-row justify="center">
      <v-col cols="12" sm="8" md="6" lg="4">
        <v-card class="edit-profile-card">
          <v-card-title class="text-h5">Edit Profile</v-card-title>
          <v-card-text>
            <v-form ref="profileForm">
              <v-text-field v-model="editedProfile.fullName" label="Full Name"></v-text-field>
              <v-text-field v-model="editedProfile.email" label="Email"></v-text-field>
              <v-textarea v-model="editedProfile.bio" label="Bio"></v-textarea>

              <v-divider class="my-4"></v-divider>

              <!-- Input field for updating profile picture -->
              <v-file-input v-model="editedProfile.profilePicture" label="Profile Picture"></v-file-input>

              <v-text-field
                v-model="editedProfile.currentPassword"
                label="Current Password"
                type="password"
              ></v-text-field>
              <v-text-field v-model="editedProfile.newPassword" label="New Password" type="password"></v-text-field>
              <v-text-field v-model="editedProfile.confirmPassword" label="Confirm Password" type="password"></v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-btn @click="saveChanges" color="primary">Save Changes</v-btn>
            <v-btn @click="goBack">Cancel</v-btn>
          </v-card-actions>
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
      editedProfile: {
        fullName: '',
        email: '',
        bio: '',
        profilePicture: null, // Store the selected file
        currentPassword: '',
        newPassword: '',
        confirmPassword: '',
      },
    };
  },
  methods: {
    async Update(){
    
    },
    saveChanges() {
      // Add logic to save changes to the profile, including the profile picture
      console.log('Changes saved!', this.editedProfile);
      // After saving, you can navigate back to the profile page
      this.$router.push('/profile');
    },
    goBack() {
      // Add logic to handle cancel or navigate back to the profile page without saving
      this.$router.push('/profile');
    },
  },
};
</script>

<style scoped>
/* Add your styles for the edit profile page */
.edit-profile-card {
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  background-color: #fff;
}

.edit-profile-card v-card-title {
  font-size: 1.5rem;
  font-weight: bold;
}

.edit-profile-card v-divider {
  border-color: #ccc;
}

.edit-profile-card v-btn {
  margin-left: 8px;
}
</style>
