<template>
    <div>
    <h1>Zoho Inventory Items</h1>
    <button @click="fetchItems">Fetch Items</button>
    <div v-if="loadingItems" class="loading">Loading Items...</div>
    <table v-else class="table table-striped">
      <thead>
        <tr>
          <th>Item ID</th>
          <th>Item Name</th>
          <th>Item Code</th>
          <th>Rate</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="item in items" :key="item.item_id">
          <td>{{ item.item_id }}</td>
          <td>{{ item.name }}</td>
          <td>{{ item.item_code }}</td>
          <td>{{ item.rate }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
    import axios from 'axios';
    import { onMounted, ref } from 'vue';

    const items = ref([]);
    const loading = ref(false);

    onMounted( async () => {
        await getZohoItems();
        loading.value = false;
    })

    const getZohoItems = async () => {
        try{
            let response = await axios.get('/api/items');
            items.value = response.data.items;
            loading.value = false;

        }
        catch(error){
            console.log('error ', error);
            loading.value = false;
        }
    }
</script>
<style>
.table {
  margin-top: 20px;
}
.loading {
  font-size: 1.5em;
  color: #555;
  text-align: center;
  margin-top: 20px;
}
</style>