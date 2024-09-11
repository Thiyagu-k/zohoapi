<template>
  <div>
    <h1>Processing Login...</h1>
  </div>
</template>

<script>
export default {
  mounted() {
    const hashParams = new URLSearchParams(window.location.hash.slice(1));

    const accessToken = hashParams.get('access_token');
    const idToken = hashParams.get('id_token');
    const at_hash = hashParams.get('at_hash');

    if (accessToken && idToken) {
      sessionStorage.setItem('access_token', accessToken);
      sessionStorage.setItem('id_token', idToken);
      sessionStorage.setItem('at_hash', at_hash);
      sessionStorage.setItem('access_token_time', Date.now());

      this.$router.push('/dashboard');
    } else {
      console.error('Authentication failed: Tokens not found.');
    }
  },
};
</script>
