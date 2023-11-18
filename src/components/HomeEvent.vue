<template>
  <div>
    <!-- Event Page -->
    <v-container>
      <!-- Event List -->
      <v-row>
        <v-col v-for="(event, index) in events" :key="index" cols="12" md="4">
          <v-card>
            <v-img :src="event.image" alt="event.name"></v-img>
            <v-card-title>{{ event.name }}</v-card-title>
            <v-card-subtitle>{{ event.date }}</v-card-subtitle>
            <v-card-text>{{ event.description }}</v-card-text>
            <v-card-actions>
              <v-btn @click="viewEventDetails(index)">View Details</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>

      <!-- Modal for each event -->
      <v-dialog v-model="selectedEvent.dialog" max-width="600">
        <v-card>
          <v-card-title>{{ selectedEvent.name }}</v-card-title>
          <v-card-subtitle>{{ selectedEvent.date }}</v-card-subtitle>
          <v-card-text>{{ selectedEvent.description }}</v-card-text>
          <v-card-actions>
            <v-btn @click="closeEventDetails">Close</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-container>

    <!-- Bottom Navigation -->
    <v-bottom-navigation v-model="value" color="teal" grow>
      <!-- Your bottom navigation buttons here -->
      <v-btn>
  <v-icon>
    <a href="/Home">
      <div class="icon" style="font-size: 16px;"> <!-- Adjust the font-size as needed -->
        <i class="fa fa-users" aria-hidden="true"></i>
      </div>
      <div class="text" data-type="Community" style="font-size: 12px;"> <!-- Adjust the font-size as needed -->
        Community
      </div>
    </a>
  </v-icon>
</v-btn>

<v-btn>
  <v-icon>
    <a href="/Event">
      <div class="icon" style="font-size: 16px;"> <!-- Adjust the font-size as needed -->
        <i class="fa fa-calendar" aria-hidden="true"></i>
      </div>
      <div class="text" data-type="Event" style="font-size: 12px;"> <!-- Adjust the font-size as needed -->
        Event
      </div>
    </a>
  </v-icon>
</v-btn>

<v-btn>
  <v-icon>
    <a href="/Market">
      <div class="icon" style="font-size: 16px;"> <!-- Adjust the font-size as needed -->
        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
      </div>
      <div class="text" data-type="Market" style="font-size: 12px;"> <!-- Adjust the font-size as needed -->
        Market
      </div>
    </a>
  </v-icon>
</v-btn>
<v-btn>
  <v-icon>
    <a href="Profile">
      <div class="icon" style="font-size: 16px;"> <!-- Adjust the font-size as needed -->
        <i class="fa fa-user"></i>
      </div>
      <div class="text" data-type="Profile" style="font-size: 12px;"> <!-- Adjust the font-size as needed -->
        Profile
      </div>
    </a>
  </v-icon>
</v-btn>
    </v-bottom-navigation>
  </div>
</template>

<script>
export default {
  data() {
    return {
      events: [
        {
          name: "Event 1",
          date: "Event Date 1",
          description: "Description of Event 1",
          image: "event1.jpg", // Update with correct image paths
        },
        {
          name: "Event 2",
          date: "Event Date 2",
          description: "Description of Event 2",
          image: "event2.jpg", // Update with correct image paths
        },
        // Add more events here
      ],
      selectedEvent: {
        name: "",
        date: "",
        description: "",
        dialog: false,
      },
      value: 0,
    };
  },
  methods: {
    viewEventDetails(index) {
      this.selectedEvent = { ...this.events[index], dialog: true };
    },
    closeEventDetails() {
      this.selectedEvent.dialog = false;
    },
    navigateTo(route) {
      this.$router.push(route);
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
