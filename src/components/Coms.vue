<template>
  <v-container fluid>
    <v-row>
      <v-col md="4">
        <!-- Sidebar with user list -->
        <v-card>
          <v-list>
            <v-list-item-group v-if="users.length">
              <v-list-item
                :key="user.id"
                v-for="user in users"
                @click="selectUser(user)"
              >
                <v-list-item-avatar>
                  <v-img :src="user.avatar" alt="User Avatar"></v-img>
                </v-list-item-avatar>
                <v-list-item-content>
                  <v-list-item-title>{{ user.full_name }}</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-item-group>
            <v-list-item v-else>
              <v-list-item-content>No users available</v-list-item-content>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>

      <v-col md="8">
        <!-- Main message area -->
        <v-card>
          <v-card-title>
            {{ selectedUser ? `Chat with ${selectedUser.full_name}` : 'Select a user' }}
          </v-card-title>
          <v-card-text>
            <v-list>
              <template v-for="message in messages" :key="message.id">
                <v-list-item
                  :class="{ 'message-sent': message.sender_id === currentUser.id, 'message-received': message.sender_id !== currentUser.id }"
                >
                  <v-list-item-content>
                    <v-list-item-title>{{ message.message_text }}</v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </template>
            </v-list>
          </v-card-text>
          <v-card-actions @submit.prevent="sendMessage">

            <v-text-field v-model="newMessage" label="Type your message" />
            <v-btn @click="sendMessage">Send</v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>

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
  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      users: [],
      currentUser: { id: 1, name: 'Your Name', avatar: 'your-avatar.jpg' },
      selectedUser: '',
      messages: [],
      newMessage: '',
      pollingInterval: null,
    };
  },
  created() {
    this.checkScreenSize();
    window.addEventListener('resize', this.checkScreenSize);
  },
  destroyed() {
    window.removeEventListener('resize', this.checkScreenSize);
    this.stopPolling(); // Stop polling when the component is destroyed
  },
  async mounted() {
    try {
      await this.fetchUsers();
    } catch (error) {
      console.error('Error fetching users:', error);
    }
  },
  methods: {
    checkScreenSize() {
      this.isLargeScreen = window.innerWidth >= 768;
    },
    selectUser(user) {
      this.selectedUser = user;
      this.fetchMessages(user.id);
      this.startPolling(); // Start polling for new messages
    },
    async fetchUsers() {
      try {
        const response = await axios.get('/Users'); // Adjust the endpoint as needed
        this.users = response.data;
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    },
    async sendMessage() {
      const a = sessionStorage.getItem('verification_token');
      try {
        const response = await axios.post('/sendMessage', {
          verification_token: a, // Replace with actual token
          receiver_id: this.selectedUser.id,
          message_text: this.newMessage,
        });

        // Add the sent message to the local messages array
        this.messages.push({
          sender_id: this.currentUser.id,
          receiver_id: this.selectedUser.id,
          message_text: this.newMessage,
          sent_at: new Date().toISOString(),
          is_read: false,
        });

        this.newMessage = ''; // Clear the input field after sending the message
      } catch (error) {
        console.error('Error sending message:', error);
      }
    },
    async fetchMessages(userId) {
      try {
        const response = await axios.get(`/receivemessage/${userId}`);
        this.messages = response.data;
      } catch (error) {
        console.error('Error fetching messages:', error);
      }
    },
    startPolling() {
      this.pollingInterval = setInterval(async () => {
        await this.fetchMessages(this.selectedUser.id);
      }, 5000); // Poll every 5 seconds (adjust as needed)
    },
    stopPolling() {
      clearInterval(this.pollingInterval);
    },
  },
};
</script>

<style scoped>
.message-sent {
  text-align: right;
}
</style>
