<template>
  <AdminHeader />
  <el-card style="margin: 20px">
    <el-button @click="$router.back()">
      Back
    </el-button>
    <h2 style="text-align: center;">Ticket Detail</h2>
    <div v-if="ticket">
      <p><strong>Name:</strong> {{ ticket.name }}</p>
      <p><strong>Email:</strong> {{ ticket.email }}</p>
      <p><strong>Subject:</strong> {{ ticket.subject }}</p>
      <p><strong>Message:</strong> {{ ticket.message }}</p>
      <p><strong>Status:</strong> {{ ticket.status }}</p>

      <el-divider />
      <h3>Admin Note</h3>
      <span v-if="!ticket.admin_note">
        <input id="note" type="hidden" v-model="note">
        <trix-editor input="note" @trix-change="onChange"></trix-editor>    
        <el-button :loading="loading" style="margin-top: 10px;" type="primary" @click="submitNote">Submit Note</el-button>
      </span>
      <span v-else>
        <div v-html="ticket.admin_note"></div>
      </span>
    </div>
    <div v-else>
      <el-skeleton :rows="5" animated />
    </div>
  </el-card>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { useRoute, useRouter } from 'vue-router'
import { ElMessage } from 'element-plus'
import AdminHeader from './AdminHeader.vue'


const route = useRoute()
const router = useRouter()
const ticket = ref(null)
const note = ref('')
const loading = ref(false)

onMounted(async () => {
  const res = await axios.get(`/api/admin/tickets/${route.params.type}/${route.params.id}`, {
    headers: {
      Authorization: `Bearer ${localStorage.getItem('token')}`
    }
  })
  ticket.value = res.data
  note.value = res.data.admin_note || ''
})

const submitNote = async () => {
  try {
    loading.value = true
    await axios.post(`/api/admin/tickets/${route.params.type}/${route.params.id}/note`, {
      admin_note: note.value
    }, {
      headers: {
        Authorization: `Bearer ${localStorage.getItem('token')}`
      }
    })
    ElMessage.success('Note added successfully')
    router.push('/admin/tickets')
  } catch (error) {
    ElMessage.error(error.response.data.message)
  } finally {
    loading.value = false
  }
}
const onChange = (e) => {
  note.value = e.target.innerHTML
}
</script>
