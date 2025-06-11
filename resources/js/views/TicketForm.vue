<template>
  <el-card class="box-card" style="max-width: 600px; margin: 50px auto;">
    <h2 style="text-align: center;">Create Support Ticket</h2>
    <el-form :model="form" :rules="rules" ref="ticketForm" label-width="120px">
      <el-form-item label="Name" prop="name">
        <el-input v-model="form.name" />
      </el-form-item>
      <el-form-item label="Email" prop="email">
        <el-input v-model="form.email" />
      </el-form-item>
      <el-form-item label="Subject" prop="subject">
        <el-input v-model="form.subject" />
      </el-form-item>
      <el-form-item label="Type" prop="type">
        <el-select v-model="form.type" placeholder="Select Type">
          <el-option label="Technical Issues" value="Technical Issues" />
          <el-option label="Account & Billing" value="Account & Billing" />
          <el-option label="Product & Service" value="Product & Service" />
          <el-option label="General Inquiry" value="General Inquiry" />
          <el-option label="Feedback & Suggestions" value="Feedback & Suggestions" />
        </el-select>
      </el-form-item>
      <el-form-item label="Message" prop="message">
        <el-input type="textarea" v-model="form.message" rows="5" />
      </el-form-item>
      <el-form-item>
        <el-button :loading="loading" type="primary" @click="submitForm">Submit</el-button>
      </el-form-item>
    </el-form>
  </el-card>
</template>

<script setup>
import { reactive, ref } from 'vue'
import axios from 'axios'
import { ElMessage } from 'element-plus'

const form = reactive({
  name: '',
  email: '',
  subject: '',
  type: '',
  message: ''
})

const rules = {
  name: [{ required: true, message: 'Name is required', trigger: 'blur' }],
  email: [{ required: true, message: 'Email is required', trigger: 'blur' }],
  subject: [{ required: true, message: 'Subject is required', trigger: 'blur' }],
  type: [{ required: true, message: 'Type is required', trigger: 'change' }],
  message: [{ required: true, message: 'Message is required', trigger: 'blur' }]
}

const ticketForm = ref(null)
const loading = ref(false)

const submitForm = () => {     
  ticketForm.value.validate(async (valid) => {
    if (valid) {
      try {
        loading.value = true
        await axios.post('/api/tickets', form)
        ElMessage.success('Ticket submitted successfully')
        ticketForm.value.resetFields()
      } catch (error) {
        ElMessage.error('Something went wrong')
      } finally {
        loading.value = false
      }
    }
  })
}
</script>
