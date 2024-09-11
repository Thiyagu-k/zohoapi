<template>
  <div class="container mx-auto p-8">
    <div class="bg-white p-6 rounded-lg shadow-lg flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold mb-4 text-gray-800">User Settings</h1>
        <div class="text-lg">
          <p class="mb-2"><strong>Name:</strong> {{ userProfile.name }}</p>
          <p class="mb-2"><strong>Email:</strong> {{ userProfile.email }}</p>
        </div>
      </div>
      <div class="relative">
        <img
        :src="`/api/images/${profilePictureUrl}`"
          alt="Profile Image"
          class="w-52 h-52 rounded-full object-cover"
        />
      </div>
    </div>

    <div class="mt-8 flex justify-end">
      <button
        @click="logout"
        class="px-6 py-2 bg-red-500 text-white font-semibold rounded hover:bg-red-600 transition-colors"
      >
        Logout
      </button>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      userProfile: {
        name: "",
        email: "",
        picture: "",
      },
    };
  },
  computed: {
    profilePictureUrl() {
      // Check if the picture URL is a complete URL or a relative path
      if (this.userProfile.picture.startsWith("http")) {
        return this.userProfile.picture;
      } else if (this.userProfile.picture) {
        return `https://accounts.zoho.in${this.userProfile.picture}`;
      } else {
        // Fallback to a default profile image if picture is not available
        return "/path/to/default/profile.png";
      }
    },
  },
  mounted() {
    const idToken = sessionStorage.getItem("id_token");
    if (idToken) {
      const userInfo = this.decodeJWT(idToken);
      this.userProfile.name = userInfo.name || "";
      this.userProfile.email = userInfo.email || "";
      this.userProfile.picture = userInfo.picture || "";
    }
  },
  methods: {
    decodeJWT(token) {
      const base64Url = token.split(".")[1];
      const base64 = base64Url.replace(/-/g, "+").replace(/_/g, "/");
      const jsonPayload = decodeURIComponent(
        atob(base64)
          .split("")
          .map(function (c) {
            return "%" + ("00" + c.charCodeAt(0).toString(16)).slice(-2);
          })
          .join("")
      );

      return JSON.parse(jsonPayload);
    },
    logout() {
      sessionStorage.clear();
      this.$router.push("/");
    },
  },
};
</script>

<style scoped>
.container {
  max-width: 800px;
}

.bg-white {
  background-color: #f9f9f9;
}

.shadow-lg {
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.object-cover {
  object-fit: cover;
}

.rounded-full {
  border-radius: 50%;
}
</style>
