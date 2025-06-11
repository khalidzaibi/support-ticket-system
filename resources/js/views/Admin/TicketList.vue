<template>
  <AdminHeader />
  <el-card style="margin: 20px">
    <h2>All Support Tickets</h2>
    <el-table :data="tickets"
        stripe
        style="width: 100%"
        v-loading="loading"
        empty-text="No tickets found" >
        <el-table-column prop="name" label="Name" />
        <el-table-column prop="email" label="Email" />
        <el-table-column prop="subject" label="Subject" />
        <el-table-column prop="type" label="Type" />
        <el-table-column prop="status" label="Status" />
        <el-table-column prop="dept_type" label="Department" />
        <el-table-column label="Actions">
          <template #default="scope">
            <el-button size="small" type="primary" @click="goToView(scope.row)">View</el-button>
          </template>
        </el-table-column>
      </el-table>

  </el-card>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import AdminHeader from './AdminHeader.vue'
import { tr } from 'element-plus/es/locales.mjs'

const tickets = ref([])
const loading = ref(true)
const router = useRouter()

onMounted(async () => {
  try {      
    const res = await axios.get('/api/admin/tickets', {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      }
    })  
    tickets.value = res.data
  } catch (error) {
    ElMessage.error(error.response.data.message)
  } finally {
    loading.value = false
  }
})

const goToView = (row) => {
  const type = row.dept_type.toLowerCase().split(' ')[0]
  router.push(`/admin/tickets/${type}/${row.id}`)
}
</script>
