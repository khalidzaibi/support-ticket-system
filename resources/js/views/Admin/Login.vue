<template>
  <el-card style="max-width: 400px; margin: 100px auto;">
    <h3 style="text-align: center;">Admin Login</h3>
    <el-form :model="form" @submit.prevent="login">
      <el-form-item label="Email">
        <el-input v-model="form.email" />
      </el-form-item>
      <el-form-item label="Password">
        <el-input type="password" v-model="form.password" />
      </el-form-item>
      <el-form-item>
        <el-button type="primary" :loading="loading" @click="login">Login</el-button>
      </el-form-item>
    </el-form>
  </el-card>
</template>

<script setup>
import { reactive, ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'
import { ElMessage } from 'element-plus'

const form = reactive({ email: '', password: '' })
const router = useRouter()
const isLoggedIn = localStorage.getItem('token')
const loading = ref(false)

if (isLoggedIn) {
  router.push('/admin/tickets')
}

const login = async () => {
  try {
    loading.value = true
    const { data } = await axios.post('/api/admin/login', form)
    localStorage.setItem('token', data.token)
    localStorage.setItem('user', JSON.stringify(data.user))
    axios.defaults.headers.common['Authorization'] = `Bearer ${data.token}`
    router.push('/admin/tickets')
  } catch (e) {
    ElMessage.error('Invalid credentials')
  } finally {
    loading.value = false
  }
}
</script>
