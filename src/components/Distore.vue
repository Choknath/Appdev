<!-- Market.vue -->

<template>
    <div>
      <v-container>
        <v-row>
          <v-col v-for="(store, index) in stores" :key="index" cols="12" md="4">
            <v-card @click="viewStoreItems(store)">
              <v-card-title>{{ store.store_name }}</v-card-title>
              <v-card-subtitle>{{ store.location }}</v-card-subtitle>
            </v-card>
          </v-col>
        </v-row>
  
        <!-- Modal for Store Details -->
        <v-dialog v-model="selectedStore.dialog" max-width="600">
          <v-card>
            <v-card-title>{{ selectedStore.store_name }}</v-card-title>
            <v-card-subtitle>{{ selectedStore.location }}</v-card-subtitle>
  
            <!-- Display store items -->
            <v-row>
              <v-col v-for="(item, itemIndex) in selectedStore.items" :key="itemIndex" cols="12" md="4">
                <v-card>
                  <v-img :src="item.media_url" alt="item.name"></v-img>
                  <v-card-title>{{ item.product_name }}</v-card-title>
                  <v-card-subtitle>{{ item.description }}</v-card-subtitle>
                  <!-- Add other item details if needed -->
                </v-card>
              </v-col>
            </v-row>
  
            <v-card-actions>
              <v-btn @click="closeStoreDetails">Close</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
  
        <!-- Bottom Navigation -->
        <!-- ... Your existing bottom navigation code ... -->
      </v-container>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  export default {
    data() {
      return {
        stores: [], // Placeholder for the array of stores
        selectedStore: {
          store_name: "",
          location: "",
          items: [], // Added items property to store store items
          dialog: false,
        },
        // ... Other data properties ... (Add other properties as needed)
      };
    },
    created() {
      this.getStores();
      // ... Your existing created hook code ... (Add any other initialization code)
    },
    methods: {
      async getStores() {
        try {
          const response = await axios.get('/Stores'); // Use the correct endpoint for fetching stores
          this.stores = response.data;
        } catch (error) {
          console.error(error);
        }
      },
      async viewStoreItems(store) {
        try {
          const response = await axios.get(`/StoreItems/${store.store_id}`); // Use the correct endpoint for fetching store items
          this.selectedStore = { ...store, items: response.data, dialog: true };
        } catch (error) {
          console.error(error);
        }
      },
      closeStoreDetails() {
        this.selectedStore.dialog = false;
      },
      // ... Your existing methods ... (Add other methods as needed)
    },
  };
  </script>
  
  <style>
  /* ... Your existing style ... */
  </style>
  