<template>
    <v-layout class="overflow-visible" style="height: 56px;">
      <v-bottom-navigation v-model="value" color="teal" grow>
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
    </v-layout>
    
  </template>
  <script>
    export default {
      data: () => ({ value: 1 }),
    }
  </script>