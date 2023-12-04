<template>
     <v-container>
    <v-row>
      <v-col cols="5">
        <h2>Users</h2>
        <v-list v-if="users.length > 0">
          <v-list-item-group>
            <v-list-item v-for="user in users" :key="user.id" @click="selectUser(user)">
              <v-list-item-content>
                <v-list-item-title>{{ user.full_name }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>
      </v-col>
      <v-col v-if="selectedUser" cols="6">
        <h2>Conversation with {{ selectedUser.full_name }}</h2>
        <v-list v-if="messages.length > 0">
          <v-list-item-group v-for="message in messages" :key="message.id">
            <v-list-item :class="{ 'align-end': message.sender_id === currentUser.id }">
              <v-list-item-content>
                <v-list-item-title>{{ message.message_text }}</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-item-group>
        </v-list>
        <v-divider></v-divider>
        <v-row>
          <v-col cols="10">
            <v-textarea
              v-model="newMessage"
              :placeholder="`Type your message to ${selectedUser.full_name}...`"
              auto-grow
              clearable
            ></v-textarea>
          </v-col>
          <v-col cols="2">
      <!-- Icon button for sending message -->
      <v-btn @click="sendMessage" color="primary" icon>
        <v-icon>mdi-send</v-icon>
      </v-btn>
    </v-col>

    <v-col cols="2">
      <!-- Icon button for file -->
      <v-btn @click="uploadFile" color="primary" icon>
        <v-icon>mdi-file</v-icon>
      </v-btn>
    </v-col>
        </v-row>
      </v-col>
    </v-row>
  </v-container>
    <!-- Bottom Navigation -->
    <v-bottom-navigation v-model="value" color="teal" grow>
    <v-btn to="/Home">
      <v-icon>mdi-account-group</v-icon>
      <div class="text" v-if="isLargeScreen">Community</div>
    </v-btn>

    <v-btn to="/Market">
      <v-icon>mdi-shopping</v-icon>
      <div class="text" v-if="isLargeScreen">Market</div>
    </v-btn>

    <v-btn to="/Event">
      <v-icon>mdi-calendar</v-icon>
      <div class="text" v-if="isLargeScreen">Event</div>
    </v-btn>

    <v-btn to="/Messages">
      <v-icon>mdi-message</v-icon>
      <div class="text" v-if="isLargeScreen">Messages</div>
    </v-btn>

    <v-btn to="/Profile">
      <v-icon>mdi-account</v-icon>
      <div class="text" v-if="isLargeScreen">Profile</div>
    </v-btn>
  </v-bottom-navigation>


  </template>
  
 
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        value: 0,
        isLargeScreen: true,
        currentUser: {
          id: 1,
          full_name: 'John Doe',
        },
        selectedUser: null,
        users: [],
        messages: [],
        newMessage: "",
      };
    },
    created() {
      // Fetch users on component creation
      this.fetchUsers();
  
      // Check the screen size on component creation
      this.checkScreenSize();
  
      // Add a listener for screen size changes
      window.addEventListener('resize', this.checkScreenSize);
    },
    destroyed() {
      // Remove the listener when the component is destroyed
      window.removeEventListener('resize', this.checkScreenSize);
    },
    methods: {
      checkScreenSize() {
        // Update isLargeScreen based on the screen width
        this.isLargeScreen = window.innerWidth >= 768; // Adjust the breakpoint as needed
      },
      async fetchUsers() {
        try {
          const response = await axios.get('Users'); // Assuming the endpoint is '/api/users'
          this.users = response.data;
        } catch (error) {
          console.error('Error fetching users:', error);
        }
      },
      selectUser(user) {
        this.selectedUser = user;
        // Fetch messages for the selected user
        this.fetchMessages();
      },
      async fetchMessages() {
        try {
          // Adjust the URL to match your CodeIgniter API endpoint for fetching messages
          const response = await axios.get(`/api/messages/${this.selectedUser.id}`);
          this.messages = response.data;
        } catch (error) {
          console.error('Error fetching messages:', error);
        }
      },
      async sendMessage() {
        try {
          // Implement logic to send a message to the selected user
          // Use this.newMessage to get the message content
          // Update the messages array with the new message
          const response = await axios.post('/api/sendmessage', {
            senderId: this.currentUser.id,
            receiverId: this.selectedUser.id,
            content: this.newMessage,
          });
          // Assuming the API returns the updated messages
          this.messages = response.data;
        } catch (error) {
          console.error('Error sending message:', error);
        }
      },
    },
  };
  </script>
  