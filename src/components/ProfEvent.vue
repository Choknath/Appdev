<template>
    <div>
     <v-container>
        <!-- Form for adding a new event with image upload -->
        <v-form @submit.prevent="save">
          <!-- Event Name, Date, and Description inputs -->
          <v-text-field v-model="event_name" label="Event Name"></v-text-field>
          <v-text-field v-model="event_description" label="Event Description"></v-text-field>
          <v-text-field v-model="event_date" label="Event Date"></v-text-field>
          <v-text-field v-model="event_location" label="Event Location"></v-text-field>
  
          <!-- Image Upload -->
          <v-row>
            <v-col>
              <v-file-input
                v-model="event_image_url"
                label="Event Image"
                accept="image/*"
                show-size
                small-chips
                chips
              ></v-file-input>
            </v-col>
            <v-col>
              <v-icon>mdi-image</v-icon>
            </v-col>
          </v-row>
  
          <!-- Add Event Button -->
          <v-btn type="submit"  @click="redirectToEvent">submit</v-btn>
        </v-form>
  
      </v-container>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
   data(){
    return{
        event_name: "",
        event_description: "",
        event_date: "",
        event_location: "",
        event_image_url: ""

    }
   },
   methods:{
    redirectToEvent(){
      this.$router.push('/ProfEvent');
    },
    async save() {
    try {
        const response = await axios.post('/addEvent', {
            event_name: this.event_name,
            event_description: this.event_description,
            event_date: this.event_date,
            event_location: this.event_location,
            event_image_url: this.event_image_url,
        });

        console.log(response.data);  // Log the response data

        // Handle the response as needed
    } catch (error) {
        console.error('Error:', error);
        // Handle the error, log it, or show a user-friendly message
    }
}


   }
}
     
  </script>
  
  <style scoped>
  @import '../assets/asset/css/Profile.css';
  /* Additional styling for the event page, if needed */
  </style>
  