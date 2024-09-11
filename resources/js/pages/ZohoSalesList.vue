<template>
  <div class="p-1">
    <h4 class="text-xl font-semibold text-gray-600 mb-3">SalesOrders Details</h4>
    <div v-if="loading" class="loading">Loading sales orders.....</div>
    <div v-else>
      <table id="salesorderTable" class="display w-full border-collapse mt-3">
        <thead>
          <tr class="text-sm p-1 bg-gray-800 text-white border">
            <th class="border p-1 text-sm">S.NO</th>
            <th class="border p-1 text-sm">Order Number</th>
            <th class="border p-1 text-sm">Customer Name</th>
            <th class="border p-1 text-sm">Status</th>
            <th class="border p-1 text-sm">Total (₹)</th>
            <th class="border p-1 text-sm">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(order, index) in salesOrders" :key="order.salesorder_id" class="odd:bg-white even:bg-gray-100" >
            <td class="border px-1 py-1">{{ index + 1 }}</td>
            <td class="border px-1 py-1">{{ order.salesorder_number }}</td>
            <td class="border px-1 py-1">{{ order.customer_name }}</td>
            <td class="border px-1 py-1">{{ order.status }}</td>
            <td class="border px-1 py-1">₹ {{ order.total.toFixed(2) }}</td>
            <td class="border w-28">
              <button @click="viewDetails(order.salesorder_id)" class="bg-green-700 text-sm text-white px-1 mr-1 rounded">View</button>
              <button  @click="deleteOrder(order.salesorder_id, order.customer_name)" class="bg-red-700 text-sm text-white px-1 ml-1 rounded">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { onMounted, ref, nextTick } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

const salesOrders = ref([]);
const loading = ref(true);
const router = useRouter();

onMounted(async () => {
  await getSalesOrders();
  loading.value = false;

  nextTick(() => {
    initializeDataTable();
  });
});

// Fetch sales orders from API
const getSalesOrders = async () => {
  try {
    const response = await axios.get("/api/salesorders");
    salesOrders.value = response.data.salesorders;
  } catch (error) {
    console.error("Error fetching sales orders:", error);
    loading.value = false;
  }
};

const viewDetails = (id) => {
  router.push(`/order/${id}`);
};

// Delete an order with confirmation
const deleteOrder = async (id, customerName) => {
  if (confirm(`Are you sure you want to delete the order for ${customerName}?`)) {
    try {
      await axios.delete(`/api/salesorders/${id}`);
      await getSalesOrders();
      alert(`Order for ${customerName} deleted successfully!`);
    } catch (error) {
      console.error("Error deleting order:", error);
      alert("Failed to delete the order. Please try again.");
    }
  }
};

// Initialize DataTables on the sales order table
const initializeDataTable = () => {
  $('#salesorderTable').DataTable({
    pageLength: 7,
    lengthMenu: [5, 10, 25, 50, 75, 100],
    language: {
      search: "Search Orders:",
      lengthMenu: "Show _MENU_ orders",
      info: "Showing _START_ to _END_ of _TOTAL_ orders",
      paginate: {
        previous: "<",
        next: ">",
      },
    },
  });
};
</script>

<style>
.loading {
  font-size: 1.5em;
  color: #555;
  text-align: center;
  margin-top: 20px;
}


.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate {
  font-size: 15px;
  color: #444;
}

.dataTables_wrapper .dataTables_length select {
  padding: 0.25rem 0.5rem;
  border-radius: 0.25rem;
  border: 1px solid #ccc;
}

.dataTables_wrapper .dataTables_filter input {
  padding: 0.25rem;
  border-radius: 0.25rem;
  outline: none;
  border: 1px solid #ccc;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
  padding: 0.25rem 0.5rem;
  margin: 0 0.1rem;
  border-radius: 0.25rem;
  border: 1px solid #ccc;
  background-color: #f0f0f0;
  transition: background-color 0.3s;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  background-color: #e0e0e0;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
  background-color: #aeafb1;
  color: white;
  border-color: #c6c9cc;
}
</style>
