<!-- Profevent  ang may ari nitp -->
<!-- kakambal ito ni EvetnProf -->


<template>
    <div>
      <v-skeleton-loader :elevation="24" type="card">
      <!-- Event Page -->
      <v-container>
        <!-- Event List -->
        
        <v-row>
          <v-col v-for="(event, index) in events" :key="index" cols="12" md="4">
            <v-card>
              <v-img :src="event.image" alt="event.name"></v-img>
              <v-card-title>{{ event.event_name }}</v-card-title>
           
              <v-card-actions>
                <v-btn @click="viewEventDetails(index)">View Details</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
  
        <!-- Modal for each event -->
        <v-dialog v-model="selectedEvent.dialog" max-width="600">
          <v-card class="mx-auto">
            <v-card-title>{{ selectedEvent.event_name }}</v-card-title>
            <v-card-text>{{ selectedEvent.event_description }}</v-card-text>
            <v-card-text>{{ selectedEvent.event_location }}</v-card-text>
            <v-card-subtitle>{{ selectedEvent.event_date }}</v-card-subtitle>
            <v-card-actions>
              <v-btn @click="closeEventDetails">Close</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      
      </v-container>
    </v-skeleton-loader>
    </div>
  </template>


<script>
import axios from 'axios';


export default {
  data() {
    return {
      events: [],
      selectedEvent: {
        event_name: "",
        event_description: "",
        event_location: "",
        event_date: "",
        dialog: false,
      },
      value: 0,
    };
  },
   async mounted() {
    try {
        await this.Eventdiplay();
      } catch (error) {
        console.error('Error fetching posts:', error);
        // Handle the error, e.g., show an error message to the user
      }
  },
  methods: {
      async Eventdiplay() {
    try {
      const id = sessionStorage.getItem("verification_token");
      const response = await axios.get(`/displayevent/${id}`);
      this.events = response.data;  // Update events array with the received data
      this.loading = false;
    } catch (error) {
      console.error('Error fetching events:', error);
      // Handle the error, e.g., show an error message to the user
      throw error;
    }
  },
      viewEventDetails(index) {
      this.selectedEvent = { ...this.events[index], dialog: true };
    },
    closeEventDetails() {
      this.selectedEvent.dialog = false;
    },
    },
};
</script>

<style scoped>
/* Scoped styling for the component */
/* Additional styling for the event page */
.title {
  text-align: center;
  font-size: 2em;
  color: #333;
  margin-bottom: 20px;
}

/* Styling for the event card */
.event-card {
  margin: 15px;
  padding: 15px;
  border: 2px solid #ddd;
  width: 300px;
  text-align: center;
  background-color: #fff;
}

.event-card img {
  max-width: 100%;
  height: auto;
  border: 1px solid #ddd;
}

.event-card h3 {
  font-size: 1.3rem;
  margin: 12px 0;
  color: #3366cc;
}

.event-card p {
  font-size: 1rem;
  margin: 8px 0;
}

.event-card .view-details-btn {
  background-color: #ff6600;
  color: #fff;
  border: none;
  padding: 8px 12px;
  cursor: pointer;
}

.event-card .view-details-btn:hover {
  background-color: #e65100;
}

/* Additional styling for the event details modal */
.v-dialog {
  z-index: 999999; /* Ensure modal appears on top of other elements */
}

/* Additional styling for the bottom navigation */
.v-bottom-navigation {
  position: fixed;
  bottom: 0;
  width: 100%;
}

/* Styling for bottom navigation buttons */
.v-btn {
  flex: 1;
}

.icon {
  font-size: 16px;
}

.text {
  font-size: 12px;
}

.text, .icon {
  margin-top: 4px;
  text-align: center;
}
</style>


