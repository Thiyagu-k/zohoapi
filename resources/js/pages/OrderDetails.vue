<template>
  <div class="m-auto p-1">
    <div class="flex justify-between items-center mb-3">
      <h4 class="text-xl font-semibold text-gray-600">Order Details</h4>
      <div class="space-x-3">
        <router-link
          class="bg-blue-600 hover:bg-blue-700 text-white p-1 rounded no-underline hover:no-underline transition duration-300 ease-in-out"
          :to="{ name: 'ZohosalesList' }"
          >Go Back
        </router-link>
        <button
          @click="editOrder"
          class="bg-green-500 hover:bg-green-700 text-white px-[10px] py-[2px] rounded focus:outline-none focus:shadow-outline"
        >
          Edit
        </button>
      </div>
    </div>
    <div class="flex space-x-6">
      <div class="w-1/3">
        <div v-if="loading" class="loading">Loading ...</div>
        <div v-else>
          <div class="mb-3">
            <label
              class="block text-gray-700 text-sm font-medium mb-2"
              for="customer_name"
              >Customer Name</label
            >
            <input
              v-model="order.customer_name"
              class="shadow appearance-none border text-sm rounded w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="customer_name"
              type="text"
              disabled
            />
          </div>
          <div class="mb-3">
            <label
              class="block text-gray-700 text-sm font-medium mb-2"
              for="salesorder_number"
              >Sales Order No</label
            >
            <input
              v-model="order.salesorder_number"
              class="shadow appearance-none border text-sm rounded w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="salesorder_number"
              type="text"
              disabled
            />
          </div>
          <div class="mb-3">
            <label
              class="block text-gray-700 text-sm font-medium mb-2"
              for="status"
              >Status</label
            >
            <input
              v-model="order.status"
              class="shadow appearance-none border text-sm rounded w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="status"
              type="text"
              disabled
            />
          </div>
          <div class="mb-2">
            <label
              class="block text-gray-700 text-sm font-medium mb-2"
              for="total"
              >Total (₹)</label
            >
            <input
              :value="order.total.toFixed(2)"
              class="shadow appearance-none border text-sm rounded w-full py-2 px-1 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
              id="total"
              type="number"
              disabled
            />
          </div>
        </div>
      </div>
      <div class="w-2/3 mt-4 rounded-md">
        <table class="table-auto w-full border-collapse rounded">
          <thead>
            <tr class="bg-gray-700 text-white">
              <th class="border text-sm p-1">S.No</th>
              <th class="border text-sm p-1">Image</th>
              <th class="border text-sm p-1">Item Name</th>
              <th class="border text-sm p-1">Rate per Kg</th>
              <th class="border text-sm p-1">Quantity (Kg)</th>
              <th class="border text-sm p-1">Total (₹)</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item, index) in items" :key="item.item_id" class="odd:bg-white even:bg-gray-100">
              <td class="border p-1">{{ index + 1 }}</td>
              <td class="border p-1">
                <img :src="`/api/images/${item.image_name}`" alt="Item Image" class="w-9 h-9 rounded-full object-cover"/>
              </td>
              <td class="border p-1">{{ item.group_name }}</td>
              <td class="border p-1">{{ item.rate.toFixed(2) }}</td>
              <td class="border p-1">{{ item.quantity }}</td>
              <td class="border p-1">{{ item.item_total.toFixed(2) }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import axios from "axios";

let order = ref({});
let items = ref([]);
let loading = ref(true);
const route = useRoute();
const router = useRouter();

onMounted(async () => {
  await getOrderDetails();
  loading.value = false;
});

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

const editOrder = () => {
  router.push({ name: "EditSalesOrder", params: { id: route.params.id } });
};
</script>

<style>
.loading {
  font-size: 1.5em;
  color: #555;
  text-align: center;
  margin-top: 20px;
}
img {
  max-width: 50px;
  max-height: 50px;
  border-radius: 50%;
}
</style>
