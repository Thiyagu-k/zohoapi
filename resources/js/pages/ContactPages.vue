<template>
  <div class="p-2">
    <h1 class="text-xl font-semibold text-gray-600">Contacts Details</h1>
    <div v-if="loading" class="loading">Loading Contacts...</div>
    <div v-else class="mt-3">
      <table id="contactsTable" class="display w-full border-collapse mt-3">
        <thead>
          <tr class="bg-gray-200">
            <th class="text-sm p-2 w-max-15 bg-gray-900 text-white border">S.No</th>
            <!-- <th class="text-sm p-1 bg-gray-900 text-white border">Contacts ID</th> -->
            <th class="text-sm p-2 bg-gray-900 text-white border">Company Name</th>
            <th class="text-sm p-2 bg-gray-900 text-white border">Name</th>
            <th class="text-sm p-2 bg-gray-900 text-white border">Email</th>
            <th class="text-sm p-2 bg-gray-900 text-white border">Branch</th>
            <th class="text-sm p-2 bg-gray-900 text-white border">Phone</th>
            <th class="text-sm p-2 bg-gray-900 text-white border">Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(contact, index) in contacts" :key="contact.contact_id" class="odd:bg-white even:bg-gray-100">
            <td class="p-2 border text-sm">{{ index + 1 }}</td>
            <!-- <td class="p-1 border text-sm">{{ contact.contact_id }}</td> -->
            <td class="p-2 border text-sm capitalize">{{contact.company_name }}</td>
            <td class="p-2 border text-sm capitalize">{{contact.contact_name }}</td>
            <td class="p-2 border text-sm">{{contact.email }}</td>
            <td class="p-2 border text-sm capitalize">Trichy DC</td>
            <td class="p-2 border text-sm">{{contact.phone }}</td>
            <td class="p-2 border text-sm capitalize">{{contact.status }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, nextTick } from 'vue';
import axios from 'axios';

const contacts = ref([]);
const loading = ref(true);

onMounted(async () => {
  await getZohoItems();
  loading.value = false;
  nextTick(() => {
    initializeDataTable();
  });
});

const getZohoItems = async () => {
  try {
    const response = await axios.get('/api/contacts');
    contacts.value = response.data.contacts;
  } catch (error) {
    console.log('Error: ', error);
  }
};

const initializeDataTable = () => {
  $('#contactsTable').DataTable({
    pageLength: 10,
    lengthMenu: [5, 10, 25, 50, 75, 100],
    language: {
      search: "Search Contacts:",
      lengthMenu: "Show _MENU_ contacts",
      info: "Showing _START_ to _END_ of _TOTAL_ contacts",
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
  background-color: #f7eaea08;
  transition: background-color 0.3s;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
  background-color: #e0e0e093;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
  background-color: #d9dadd95;
  color: white;
  border-color: #c6c9cc;
}
</style>
 