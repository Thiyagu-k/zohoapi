<template>
  <div class="w-screen h-screen flex">
    <!-- Side bar -->
    <div
      class="h-full bg-gray-100 overflow-y-auto scroll-smooth transition-all duration-300 ease-in-out"
      :class="{ 'w-[300px]': showSide, 'w-0': !showSide }"
      v-show="showSide || !showSide"
    >
      <!-- Header -->
      <div
        class="h-[50px] bg-gray-900 text-white flex justify-start items-center"
      >
            <!-- dashboad place -->
        <div class="px-[20px]">
          <router-link
            to=""
            class="font-bold flex text-xl no-underline text-gray-300 hover:no-underline tracking-wide hover:text-white"
          >
            <img
              :src="`/asset/images/esandhai_logo.png`"
              alt="Item Image"
              class="w-7 h-7"
            /><span class="pl-1"> - Sandhai</span></router-link
          >
        </div>
      </div>

      <div class="h-[calc(100vh-50px)] bg-gray-800 text-white py-[10px]">
        <!-- Links -->
        <div
          class="flex flex-col justify-between h-full px-[20px] space-y-[10px]"
        >
          <div class="flex flex-col justify-between space-y-[5px]">
            <router-link
              to="/home"
              class="inline-flex items-center py-[10px] px-[10px] w-full text-sm font-normal no-underline hover:text-gray-800 hover:bg-white hover:no-underline transition-colors duration-300 ease-in-out rounded-md"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="mr-3 fill-current"
              >
                <path
                  d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"
                ></path>
              </svg>
              Home
            </router-link>

            <!-- sales Link -->
            <router-link
              to="/salesList"
              class="inline-flex items-center py-[10px] px-[10px] w-full text-sm no-underline hover:text-gray-800 hover:no-underline hover:bg-white transition-colors duration-300 ease-in-out rounded-md"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="mr-3 fill-current"
              >
                <path
                  d="M21 4H2v2h2.3l3.28 9a3 3 0 0 0 2.82 2H19v-2h-8.6a1 1 0 0 1-.94-.66L9 13h9.28a2 2 0 0 0 1.92-1.45L22 5.27A1 1 0 0 0 21.27 4 .84.84 0 0 0 21 4zm-2.75 7h-10L6.43 6h13.24z"
                ></path>
                <circle cx="10.5" cy="19.5" r="1.5"></circle>
                <circle cx="16.5" cy="19.5" r="1.5"></circle>
              </svg>

              Sales orders
            </router-link>

            <!-- Items Link -->
            <router-link
              to="/items"
              class="inline-flex items-center py-[10px] px-[10px] w-full text-sm no-underline hover:text-gray-800 hover:no-underline hover:bg-white transition-colors duration-300 ease-in-out rounded-md"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="mr-3 fill-current"
              >
                <path
                  d="m21.484 7.125-9.022-5a1.003 1.003 0 0 0-.968 0l-8.978 4.96a1 1 0 0 0-.003 1.748l9.022 5.04a.995.995 0 0 0 .973.001l8.978-5a1 1 0 0 0-.002-1.749z"
                ></path>
                <path
                  d="m12 15.856-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.971-1.748L12 15.856z"
                ></path>
                <path
                  d="m12 19.856-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.971-1.748L12 19.856z"
                ></path>
              </svg>

              Items
            </router-link>
            <!-- Profile Link -->
            <router-link
              to="/contact"
              class="inline-flex items-center py-[10px] px-[10px] w-full text-sm no-underline hover:text-gray-800 hover:no-underline hover:bg-white transition-colors duration-300 ease-in-out rounded-md"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="mr-3 fill-current"
              >
                <path
                  d="M12 2C6.579 2 2 6.579 2 12s4.579 10 10 10 10-4.579 10-10S17.421 2 12 2zm0 5c1.727 0 3 1.272 3 3s-1.273 3-3 3c-1.726 0-3-1.272-3-3s1.274-3 3-3zm-5.106 9.772c.897-1.32 2.393-2.2 4.106-2.2h2c1.714 0 3.209.88 4.106 2.2C15.828 18.14 14.015 19 12 19s-3.828-.86-5.106-2.228z"
                ></path>
              </svg>
              Contact
            </router-link>
          </div>

          <div class="h-[50px]">
            <div>
              <!-- Settings Link -->
              <router-link
                to="/setting"
                class="inline-flex items-center py-[10px] px-[10px] w-full text-sm no-underline hover:text-gray-800 hover:no-underline hover:bg-white transition-colors duration-300 ease-in-out rounded-md"
              >
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  class="mr-3 fill-current"
                >
                  <path
                    d="M12 16c2.206 0 4-1.794 4-4s-1.794-4-4-4-4 1.794-4 4 1.794 4 4 4zm0-6c1.084 0 2 .916 2 2s-.916 2-2 2-2-.916-2-2 .916-2 2-2z"
                  ></path>
                  <path
                    d="m2.845 16.136 1 1.73c.531.917 1.809 1.261 2.73.73l.529-.306A8.1 8.1 0 0 0 9 19.402V20c0 1.103.897 2 2 2h2c1.103 0 2-.897 2-2v-.598a8.132 8.132 0 0 0 1.896-1.111l.529.306c.923.53 2.198.188 2.731-.731l.999-1.729a2.001 2.001 0 0 0-.731-2.732l-.505-.292a7.718 7.718 0 0 0 0-2.224l.505-.292a2.002 2.002 0 0 0 .731-2.732l-.999-1.729c-.531-.92-1.808-1.265-2.731-.732l-.529.306A8.1 8.1 0 0 0 15 4.598V4c0-1.103-.897-2-2-2h-2c-1.103 0-2 .897-2 2v.598a8.132 8.132 0 0 0-1.896 1.111l-.529-.306c-.924-.531-2.2-.187-2.731.732l-.999 1.729a2.001 2.001 0 0 0 .731 2.732l.505.292a7.683 7.683 0 0 0 0 2.223l-.505.292a2.003 2.003 0 0 0-.731 2.733zm3.326-2.758A5.703 5.703 0 0 1 6 12c0-.462.058-.926.17-1.378a.999.999 0 0 0-.47-1.108l-1.123-.65.998-1.729 1.145.662a.997.997 0 0 0 1.188-.142 6.071 6.071 0 0 1 2.384-1.399A1 1 0 0 0 11 5.3V4h2v1.3a1 1 0 0 0 .708.956 6.083 6.083 0 0 1 2.384 1.399.999.999 0 0 0 1.188.142l1.144-.661 1 1.729-1.124.649a1 1 0 0 0-.47 1.108c.112.452.17.916.17 1.378 0 .461-.058.925-.171 1.378a1 1 0 0 0 .471 1.108l1.123.649-.998 1.729-1.145-.661a.996.996 0 0 0-1.188.142 6.071 6.071 0 0 1-2.384 1.399A1 1 0 0 0 13 18.7l.002 1.3H11v-1.3a1 1 0 0 0-.708-.956 6.083 6.083 0 0 1-2.384-1.399.992.992 0 0 0-1.188-.141l-1.144.662-1-1.729 1.124-.651a1 1 0 0 0 .471-1.108z"
                  ></path>
                </svg>
                Settings
              </router-link>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Content Area -->
    <div class="w-full h-full bg-gray-400">
      <!-- Main Header -->
      <div
        class="h-[50px] bg-gray-100 flex items-center px-[20px] w-full py-[10px] z-10 border-b"
      >
        <div class="cursor-pointer w-[30px]" @click="toggleSideBar">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            style="fill: rgba(0, 0, 0, 1); transform: ; msfilter: "
          >
            <path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path>
          </svg>
        </div>

        <!-- Searching -->
        <div class="w-[calc(100%-30px)] flex">
          <div class="w-[calc(100%-200px)] flex justify-center">
            <form class="flex items-center w-[500px]">
              <label for="voice-search" class="sr-only">Search</label>
              <div class="relative w-full">
                <!-- Search Icon -->
                <div
                  class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none"
                >
                  <svg
                    aria-hidden="true"
                    class="w-5 h-5 text-gray-500 dark:text-gray-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M15 15l4.35 4.35M6.5 11a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0z"
                    ></path>
                  </svg>
                </div>

                <input
                  type="text"
                  id="voice-search"
                  class="bg-gray-50 border outline-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5"
                  placeholder="Search..."
                  required
                />

                <!-- Voice Icon -->
                <router-link
                  to="#"
                  class="absolute inset-y-0 right-0 flex items-center pr-3"
                >
                  <svg
                    aria-hidden="true"
                    class="w-5 h-5 text-gray-500 dark:text-gray-400"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M12 14c1.657 0 3-1.343 3-3V5c0-1.657-1.343-3-3-3s-3 1.343-3 3v6c0 1.657 1.343 3 3 3zm5-3v-1a1 1 0 1 1 2 0v1c0 3.392-2.686 6.218-6.085 6.784L13 21h-2l-.915-3.216C6.686 17.218 4 14.392 4 11v-1a1 1 0 1 1 2 0v1c0 3.072 2.522 5.56 5.715 5.969L12 19h.285c3.193-.409 5.715-2.897 5.715-5.969z"
                    ></path>
                  </svg>
                </router-link>
              </div>
            </form>
          </div>

          <!-- Profile Dropdown -->
          <div class="w-[200px] cursor-pointer">
            <div
              class="flex items-center justify-end space-x-3"
              @click="toggleDrop"
            >
              <img
                class="w-10 h-10 rounded-full border-2 border-gray-50 cover"
                :src="`/asset/images/profiles.png`"
                alt=""
              />
              <!-- user profile to shows error here -->
                <!-- <img
                class="w-10 h-10 rounded-full border-2 border-gray-50 cover"
                :src="userProfile.picture || '/asset/images/profiles.png'"
                alt="User Profile Picture"
              /> -->
              <div class="font-semibold dark:text-white text-left">
                <div>{{ userProfile.name }}</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">
                  {{ userProfile.email }}
                </div>
              </div>
            </div>
            <div
              v-show="showDropDown"
              class="absolute right-[10px] z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1"
            >
              <div class="py-1 text-left" role="none">
                <a
                  href="#"
                  class="text-gray-700 no-underline hover:no-underline hover:text-green-700 block px-4 py-1 text-base"
                  role="menuitem"
                  tabindex="-1"
                  id="menu-item-0"
                  >Account Setting</a
                >
                <a
                  href="#"
                  class="text-gray-700 no-underline hover:no-underline hover:text-green-700 block px-4 py-1 text-base"
                  role="menuitem"
                  tabindex="-1"
                  id="menu-item-0"
                  >Support</a
                >
                <a
                  href="#"
                  class="text-gray-700 no-underline hover:no-underline hover:text-green-700 block px-4 py-1 text-base"
                  role="menuitem"
                  tabindex="-1"
                  id="menu-item-0"
                  >About</a
                >

	              <button @click="logout" class="block ml-3 text-white p-1 mt-2 rounded text-sm bg-red-500 hover:bg-red-600">log-out</button>
                <!-- <form action="#" method="POST" role="none">
                  <button
                    type="submit"
                    class="text-gray-700 block w-full px-4 py-2 text-left text-sm"
                    role="menuitem"
                    tabindex="-1"
                    id=""
                  >hjgduhgiudrih</button>
                </form> -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="h-[calc(100vh-50px)] bg-gray-50 p-[8px]">
        <div
          class="border border-gray-300 rounded-md p-[3px] h-full overflow-x-auto overflow-y-auto"
        >
          <router-view></router-view>
          
        </div>
      </div>
    </div>
  </div>
</template>

<script >
export default {
  data() {
    return {
      showDropDown: false,
      showSide: true,
      userProfile: {
        name: "",
        email: "",
        picture: "",
        gender: "",
      },
    };
  },

    // Prepend the base URL to the relative path of the picture
  computed: {
    profilePictureUrl() {
      const baseUrl = "https://accounts.zoho.com"; // The base URL for the Zoho server
      return this.userProfile.picture
        ? `${baseUrl}${this.userProfile.picture}`
        : "/asset/images/profiles.png"; // Fallback to a default picture
    },
  },

  mounted() {
    const idToken = sessionStorage.getItem("id_token");
    if (idToken) {
      const userInfo = this.decodeJWT(idToken);
      this.userProfile.name = userInfo.name || "";
      this.userProfile.email = userInfo.email || "";
      this.userProfile.picture = userInfo.picture || ""; 
      this.userProfile.gender = userInfo.gender || "";
      console.log(userInfo);
    }
  },

  methods: {
    toggleSideBar() {
      this.showSide = !this.showSide;
    },
    toggleDrop() {
      this.showDropDown = !this.showDropDown;
    },

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

    // clear data on local and redirect to login page
    logout() {
      sessionStorage.clear();

      this.$router.push("/");
    },
  },
};
</script>

<style scoped>
</style>
