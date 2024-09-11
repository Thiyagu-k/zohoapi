<template>
  <div class="callback-container">
    <h1>Authenticating...</h1>
  </div>
</template>

<script>
// import decode from 'jwt-decode';

export default {
  name: "Callback",
  mounted() {
    const hash = window.location.hash.substr(1); // Get the hash part of the URL
    const params = new URLSearchParams(hash);
    const idToken = params.get('id_token'); // Extract the ID token

    if (idToken) {
      try {
        const userData = decode(idToken);

        localStorage.setItem('user', JSON.stringify(userData));

        // Redirect to Dashboard
        this.$router.push({ name: 'Dashboard' });
      } catch (error) {
        console.error("Invalid token:", error);
        // Redirect back to login in case of error
        this.$router.push({ name: 'Login' });
      }
    } else {
      // If no token is found, redirect to login
      this.$router.push({ name: 'Login' });
    }
  }
};
</script>

<style scoped>
.callback-container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh;
  text-align: center;
}
</style>
