<template>
  <div>
    <v-container>
      <v-row justify="center">
        <v-col cols="12" md="8">
          <v-card>
            <v-card-title>Edit Profile</v-card-title>
            <v-card-text>
              <!-- Edit Profile Form -->
              <v-form @submit.prevent="handleUploadAndSave">
                <!-- Add input fields for each editable property -->
                <v-text-field v-model="editedUser.full_name" label="Full Name"></v-text-field>
                <v-text-field v-model="editedUser.email" label="Email"></v-text-field>
                <v-textarea v-model="editedUser.bio" label="Bio"></v-textarea>
                <input type="file" ref="fileInput" @change="handleFileChange" />
                <div v-if="previewUrl">
                  <h4>Preview:</h4>
                  <img :src="previewUrl" alt="File Preview" />
                </div>
                <v-btn class="mx-3" type="submit" color="primary">Upload and Save Changes</v-btn>
              </v-form>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      editedUser: {},
      previewUrl: null,
    };
  },
  created() {
    this.getProfile();
  },
  methods: {
    handleFileChange() {
      const fileInput = this.$refs.fileInput;
      const file = fileInput.files[0];

      if (file) {
        this.displayFilePreview(file);
      } else {
        this.previewUrl = null;
        console.error('No file selected');
      }
    },
    displayFilePreview(file) {
      const reader = new FileReader();

      reader.onload = (event) => {
        this.previewUrl = event.target.result;
      };

      reader.readAsDataURL(file);
    },
    handleUploadAndSave() {
      this.uploadFile();
      this.submitForm();
    },
    uploadFile() {
      const fileInput = this.$refs.fileInput;
      const file = fileInput.files[0];

      if (file) {
        this.uploadFileToServer(file);
      } else {
        this.previewUrl = null;
        console.error('No file selected');
      }
    },
    uploadFileToServer(file) {
      const formData = new FormData();
      formData.append('file', file);

      axios
        .post('/user/uploadFile', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        })
        .then((response) => {
          console.log('File uploaded successfully', response.data);
        })
        .catch((error) => {
          console.error('Error uploading file', error);
        });
    },
    async getProfile() {
      try {
        const id = sessionStorage.getItem('verification_token');
        const response = await axios.get(`/userprofile/${id}`);
        this.editedUser = { ...response.data.info }; // Copy the user object to avoid modifying the original
      } catch (error) {
        console.log(error);
      }
    },
    async submitForm() {
      try {
        const id = sessionStorage.getItem('verification_token');
        await axios.put(`/updateProfile/${id}`, this.editedUser);
        this.$router.push('/Profile');
      } catch (error) {
        console.log(error);
      }
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
