<template>
  <div class="mx-auto px-3">
    <!-- Title and Navigation Button -->
    <div class="flex justify-between items-center mb-6 pt-2">
      <h4 class="text-xl font-semibold text-gray-600">
        Edit Order Details
        <span class="font-semibold text-green-600 capitalize text-xl">
          - {{ order.customer_name }}
        </span>
      </h4>
      <router-link
        class="bg-blue-600 hover:bg-blue-700 hover:no-underline text-white p-1 rounded transition duration-300 ease-in-out ml-5"
        :to="{ name: 'OrderDetails', params: { id: order.salesorder_id } }"
      >
        Go Back
      </router-link>
    </div>

    <!-- Loading Indicator -->
    <div v-if="loading" class="loading">Loading ...</div>

    <!-- Order Details Form -->
    <div v-else class="flex flex-wrap -mx-3 bg-gray-200">
      <div class="w-full lg:w-1/3 px-3 mb-6 py-2">
        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-medium mb-2"
            for="customer_name"
            >Customer Name</label
          >
          <input
            v-model="order.customer_name"
            class="shadow appearance-none border rounded text-sm w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="customer_name"
            type="text"
          />
        </div>

        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-medium mb-2"
            for="salesorder_number"
            >Sales Order No</label
          >
          <input
            v-model="order.salesorder_number"
            class="shadow appearance-none border rounded text-sm w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="salesorder_number"
            type="text"
          />
        </div>

        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-medium mb-2"
            for="shipment_date"
            >SO Date</label
          >
          <input
            v-model="order.date"
            class="shadow appearance-none border rounded text-sm w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="shipment_date"
            type="date"
          />
        </div>

        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-medium mb-2"
            for="shipment_date"
            >Order Delivery Date</label
          >
          <input
            v-model="order.shipment_date"
            class="shadow appearance-none border rounded text-sm w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="shipment_date"
            type="date"
          />
        </div>

        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-medium mb-2"
            for="status"
            >Status</label
          >
          <input
            v-model="order.status"
            class="shadow appearance-none border rounded text-sm w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="status"
            type="text"
          />
        </div>

        <div class="mb-4">
          <label
            class="block text-gray-700 text-sm font-medium mb-2"
            for="total"
            >Total (₹)</label
          >
          <input
            :value="total.toFixed(2)"
            class="shadow appearance-none border text-sm rounded w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
            id="total"
            type="number"
            disabled
          />
        </div>
      </div>
      <!-- Items Table -->
      <div class="w-full lg:w-2/3 bg-zinc-50">
        <table class="table-auto w-full border-collapse m-1">
          <thead>
            <tr class="bg-gray-700 text-white text-sm p-2">
              <th class="border px-2 py-1">S.No</th>
              <th class="border px-2 py-1">Item Name</th>
              <th class="border px-2 py-1">Image</th>
              <th class="border px-2 py-1">Rate (₹) per Kg</th>
              <th class="border px-2 py-1">Quantity (Kg)</th>
              <th class="border px-2 py-1">Total (₹)</th>
            </tr>
          </thead>
          <tbody>
            <tr
              v-for="(item, index) in items"
              :key="item.item_id"
              class="odd:bg-white even:bg-gray-100 relative h-auto w-auto"
              @mouseover="hoveredRow = index"
              @mouseleave="hoveredRow = null"
            >
              <td class="border p-1 items-center">
                {{ index + 1 }} <br />
                <span
                  v-if="hoveredRow === index"
                  class="ml-1 text-xs cursor-pointer capitalize bg-red-500 hover:bg-red-600 hover:text-white px-[3px] py-[1px] rounded"
                  title="Delete Row Data"
                  @click="deleteData(index)"
                >
                  Delete
                </span>
              </td>
              <td class="border px-2 py-1 relative">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="15"
                  height="15"
                  viewBox="0 0 24 24"
                  class="absolute top-4 right-3 cursor-pointer text-red-500"
                  @click="removeData(index)"
                  title="Delete"
                >
                  <path
                    d="M9.172 16.242 12 13.414l2.828 2.828 1.414-1.414L13.414 12l2.828-2.828-1.414-1.414L12 10.586 9.172 7.758 7.758 9.172 10.586 12l-2.828 2.828z"
                  ></path>
                  <path
                    d="M12 22c5.514 0 10-4.486 10-10S17.514 2 12 2 2 6.486 2 12s4.486 10 10 10zm0-18c4.411 0 8 3.589 8 8s-3.589 8-8 8-8-3.589-8-8 3.589-8 8-8z"
                  ></path>
                </svg>

                <input
                  v-model="item.name"
                  @focus="showItemDropdown = index"
                  @input="filterItems(index)"
                  @blur="hideItemDropdown"
                  placeholder="Type or click to select an item"
                  class="shadow appearance-none border rounded w-full px-2 py-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  type="text"
                />
                <ul
                  v-if="showItemDropdown === index && filteredItems.length"
                  class="absolute z-10 w-full bg-white border text-center border-gray-300 rounded-md shadow-lg mt-1 max-h-40 overflow-auto"
                >
                  <li
                    v-for="filteredItem in filteredItems"
                    :key="filteredItem.item_id"
                    @mousedown.prevent="selectItem(filteredItem, item)"
                    class="p-2 cursor-pointer hover:bg-blue-500 hover:text-white flex text-center justify-around items-center"
                  >
                    {{ filteredItem.name }} -
                    <img
                      :src="`/api/images/${filteredItem.image_name}`"
                      alt=""
                      class="w-10 h-10 rounded bg-cover object-fit"
                    />
                  </li>
                </ul>
              </td>
              <td class="border px-4 py-1">
                <img
                  :src="`/api/images/${item.image_name}`"
                  alt="item image"
                  class="w-10 h-10 rounded-full bg-cover object-fit"
                />
              </td>
              <td class="border px-2 py-1">
                <input
                  v-model.number="item.rate"
                  @input="updateTotal(item)"
                  class="shadow appearance-none border rounded w-16 p-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  type="number"
                />
              </td>
              <td class="border px-2 py-1">
                <input
                  v-model.number="item.quantity"
                  @input="updateTotal(item)"
                  class="shadow appearance-none border rounded w-16 p-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                  type="number"
                />
              </td>
              <td class="border px-2 py-1">
                {{ (item.rate * item.quantity).toFixed(2) }}
              </td>
            </tr>	
            <tr>
              <td colspan="1">
                <span
                  class="text-center px-2 py-1 rounded text-gray font-normal hover:bg-green-600 cursor-pointer hover:text-white bg-green-400"
                  @click="addItem"
                  >Add</span
                >
              </td>
              <td colspan="4" class="text-right font-bold pr-2">Total :</td>
              <td class="border px-2 py-2 font-bold">
                ₹ {{ total.toFixed(2) }}
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Save Button and Messages -->
    <div class="w-full">
      <button
        @click="checkForDuplicateItems"
        class="bg-green-500 hover:bg-green-700 text-white font-bold px-2 py-1 mb-1 rounded focus:outline-none focus:shadow-outline mt-4"
      >
        UPDATE
      </button>
      <div
        v-if="successMessage"
        class="mt-1 font-semibold border w-1/2 bg-green-50 p-1 rounded text-green-500"
      >
        {{ successMessage }}
      </div>
      <div v-if="errorMessage" class="mt-4 text-red-500">
        {{ errorMessage }}
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import axios from "axios";

// Reactive references for order and items
let order = ref({});
let items = ref([]);
let filteredItems = ref([]);
let showItemDropdown = ref(null);
let hoveredRow = ref(null);
let loading = ref(true);
let successMessage = ref("");
let errorMessage = ref("");
const route = useRoute();
const router = useRouter();

// Fetch order details on component mount
onMounted(async () => {
  await getOrderDetails();
  loading.value = false;
});

// Function to fetch order details
const getOrderDetails = async () => {
  try {
    let response = await axios.get(`/api/salesorders/${route.params.id}`);
    order.value = response.data.order.salesorder;
    items.value = response.data.order.salesorder.line_items;
  } catch (error) {
    console.error("Error fetching order details:", error);
    loading.value = false;
  }
};

// Computed property for total amount
const total = computed(() => {
  return items.value.reduce((sum, item) => sum + item.rate * item.quantity, 0);
});

// Update total for individual items
// const updateTotal = (item) => {
//   item.total = item.rate * item.quantity;
// };
const updateTotal = (item) => {
      if (item.rate < 1) {
        item.rate = 1;
      }
      if (item.quantity < 0) {
        item.quantity = 0;
      }
      this.calculateTotal();
    },
    calculateTotal = () => {
      this.total = this.items.reduce(
        (acc, item) => acc + item.rate * item.quantity,
        0
      );
    }

// Function to filter items based on user input
const filterItems = async (index) => {
  try {
    let response = await axios.get("/api/items");
    let searchTerm = items.value[index].name.toLowerCase();
    filteredItems.value = response.data.items.filter((item) =>
      item.name.toLowerCase().includes(searchTerm)
    );
  } catch (error) {
    console.error("Error fetching items:", error);
  }
};

// Function to select an item from the dropdown
const selectItem = (selectedItem, currentItem) => {
  currentItem.item_id = selectedItem.item_id;
  currentItem.name = selectedItem.name;
  currentItem.rate = selectedItem.rate;
  currentItem.image_name = selectedItem.image_name;
  currentItem.quantity = 1; // Default quantity
  updateTotal(currentItem);
  showItemDropdown.value = null;
};

// Function to hide the dropdown
const hideItemDropdown = () => {
  setTimeout(() => {
    showItemDropdown.value = null;
  }, 200);
};

// Function to add a new item row
const addItem = () => {
  items.value.push({
    item_id: "",
    name: "",
    image_name: "",
    rate: 0.0,
    quantity: 1,
    total: 0.0,
  });
};

// Function to check for duplicate items
const checkForDuplicateItems = () => {
  const itemNames = items.value.map((item) => item.name);
  const duplicates = itemNames.filter(
    (name, index) => itemNames.indexOf(name) !== index
  );

  if (duplicates.length > 0) {
    alert(`More Time ${duplicates.join(", ")} items order palced`);
  } else {
    // Proceed with the update logic
    updateOrder();
  }
};

// Function to update order details
const updateOrder = async () => {
  try {
    // Prepare data to send
    const updatedData = {
        // customer_name: order.value.customer_name,
        // salesorder_number: order.value.salesorder_number,
      date: order.value.date,
      shipment_date: order.value.shipment_date,
      status: order.value.status,
      line_items: items.value.map((item) => ({
        item_id: item.item_id,
        rate: item.rate,
        quantity: item.quantity,
      })),
    };

    // Send update request to the server
    const response = await axios.put(
      `/api/salesorders/${order.value.salesorder_id}`,
      updatedData
    );

    successMessage.value =
      response.data.message || "Order updated successfully!";
    errorMessage.value = "";

    // Optionally, redirect back to order details page
    setTimeout(() => {
      router.push({
        name: "OrderDetails",
        params: { id: order.value.salesorder_id },
      });
    }, 1500);
  } catch (error) {
    console.error("Error updating order:", error);
    alert(error.response?.data?.message || "Error updating order.");
  }
};

// Function to delete an item row
const deleteData = (index) => {
  if (items.value && items.value.length > index) {
    items.value.splice(index, 1);
  } else {
    console.error("Cannot delete: items is undefined or index is out of range");
  }
};

const removeData = (index) => {
  items.value[index].name = "";
  // items.value[index].item_id = "";
  items.value[index].rate = 0;
  items.value[index].quantity = 1;
  items.value[index].image_name = "";
  items.value[index].total = 0;
};
</script>

<style scoped>
/* Loading spinner styles */
.loading {
  font-size: 1.5rem;
  font-weight: bold;
  text-align: center;
  margin: 2rem 0;
}

ul {
  list-style: none;
  padding: 0;
  margin: 0;
}
</style>
