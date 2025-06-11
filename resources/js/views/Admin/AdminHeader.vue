<template>
  <el-card>
    <el-page-header icon="" :title="user?.name || 'Admin'">
        <template #content> </template>
        <template #extra>
        <div class="flex items-center">        
            <el-button type="primary" class="ml-2" @click="logout">Logout</el-button>
        </div>
        </template>
    </el-page-header>
  </el-card>
</template>


<script setup>
import { useRouter } from 'vue-router'
import { ref } from 'vue'
import axios from 'axios'
const router = useRouter()
const user = ref(JSON.parse(localStorage.getItem('user')))

const logout = async () => {
  try {
    await axios.post('/api/admin/logout', null, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      }
    })
  } catch (e) {
    
  } finally {
    localStorage.clear()
    router.push('/admin/login')
  }
}
</script>
