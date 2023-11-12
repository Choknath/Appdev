<template>
  <body>
    <nav> <!--navbar-->
      <div>
 
        <ul>
          <li>
            <a href="/Home">
              <div class="icon">
                <i class="fa fa-users" aria-hidden="true"></i>
              </div>
              <div class="text" data-type="Community">Community</div>
            </a>
          </li>
          <li>
            <a href="/Event">
              <div class="icon">
                <i class="fa fa-calendar" aria-hidden="true"></i>
              </div>
              <div class="text" data-type="Event">Event</div>
            </a>
          </li>
          <li>
            <a href="/Market">
              <div class="icon">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
              </div>
              <div class="text" data-type="Market">Market</div>
            </a>
          </li>
          <li>
            <a href="Profile">
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
              <div class="text" data-type="Profile">Profile</div>
            </a>
          </li>
        </ul>
      </div>
    </nav><!--end of navbar-->
    
    <div>
    <h1>Posts</h1>
    <ul>
      <li v-for="post in posts" :key="post.id">
        {{ post.content }}
      </li>
    </ul>
  </div>
  </body>
  </template>

  <style>
@import'../assets/asset/css/navbar.css';

</style>

<script>
export default {
  data() {
    return {
      posts: [],
    };
  },
  created() {
    // Fetch posts from your CodeIgniter API
    fetch('http://your-api-url/auth')
      .then((response) => response.json())
      .then((data) => {
        this.posts = data;
      })
      .catch((error) => {
        console.error('Error fetching posts: ', error);
      });
  },
};
</script>