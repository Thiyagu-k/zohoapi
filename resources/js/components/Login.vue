<template>
  <div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="text-center">
      <h1 class="text-4xl font-bold mb-6 text-green-700">E-Sandhai</h1>
      <button @click="loginWithZoho" class="px-4 py-2 bg-green-500 text-white font-semibold rounded hover:bg-green-600">
        Login with Zoho
      </button>
    </div>
  </div>
</template>

<script>
export default {
  methods: {
    loginWithZoho() {
      const clientId = '1000.GVLQCZIVGKDXZ2M4JIHCDB2P2C248P';
      const redirectUri = 'http://localhost:8000/callback';
    //   const scope = 'email';
      const scope = 'email,profile,AaaServer.profile.READ,ZohoInventory.salesorders.READ,ZohoInventory.salesorders.UPDATE';

      const zohoAuthUrl = `https://accounts.zoho.com/oauth/v2/auth?response_type=token&client_id=${clientId}&scope=${scope}&redirect_uri=${redirectUri}`;

      window.location.href = zohoAuthUrl;
    },
  },
};
</script>

