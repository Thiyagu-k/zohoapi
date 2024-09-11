<template>
  <div class="p-2">
    <h1 class="text-xl font-semibold text-gray-600">Inventory Items</h1>
    <div v-if="loading" class="loading">Loading Items...</div>
    <div v-else class="mt-3">
      <table id="inventoryTable" class="display w-full border-collapse mt-3">
        <thead>
          <tr class="bg-gray-200">
            <th class="text-sm p-1 w-16 bg-gray-900 text-white border">S.No</th>
            <th class="text-sm p-1 bg-gray-900 text-white border">Images</th>
            <th class="text-sm p-1 bg-gray-900 text-white border">Name</th>
            <th class="text-sm p-1 bg-gray-900 text-white border">Status</th>
            <th class="text-sm p-1 bg-gray-900 text-white border">Rate</th>
            <th class="text-sm p-1 bg-gray-900 text-white border">Unit</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(item, index) in items"  :key="item.item_id" class="odd:bg-white even:bg-gray-100">
            <td class="p-1 border text-sm">{{ index + 1 }}</td>
            <td class="p-1 border text-sm">
				<img :src="`/api/images/${item.image_name}`" alt="Item Image" class="w-8 h-8 rounded-full object-cover"/>
            </td>
            <td class="p-1 border text-sm capitalize">{{ item.name }}</td>
            <td class="p-1 border text-sm capitalize">{{ item.status }}</td>
            <td class="p-1 border text-sm">₹ {{ item.rate.toFixed(2) }}</td>
            <td class="p-1 border text-sm capitalize">{{ item.weight_unit }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue';
import axios from 'axios';

// Reactive state variables
const items = ref([]);
const loading = ref(true);

// Fetch data and initialize DataTables
onMounted(async () => {
  await getZohoItems();
  loading.value = false;

  // Initialize DataTable once data is loaded and DOM is updated
  nextTick(() => {
    initializeDataTable();
  });
});

// Fetch inventory items from API
const getZohoItems = async () => {
  try {
    const response = await axios.get('/api/items');
    items.value = response.data.items;
  } catch (error) {
    console.log('Error fetching items:', error);
    loading.value = false; 
  }
};

const initializeDataTable = () => {
  $('#inventoryTable').DataTable({
    pageLength: 7,
    lengthMenu: [5, 10, 25, 50, 75, 100],
    language: {
      search: 'Search Items:',
      lengthMenu: 'Show _MENU_ items',
      info: 'Showing _START_ to _END_ of _TOTAL_ items',
      paginate: {
        previous: '<',
        next: '>',
      },
    },
    destroy: true, 
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

img {
  display: block;
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
