<template><div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-6 mt-4">
            <h2>Register</h2>

            <form @submit.prevent="onSubmit">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" id="first_name" v-model="form.first_name">
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" id="last_name" v-model="form.last_name">
                </div>
                <div class="form-group">
                    <label>Email Address: </label>
                    <input type="email" class="form-control" id="email" v-model="form.email">
                </div>
                <div class="form-group">
                    <label>Password: </label>
                    <input type="password" class="form-control" id="password" v-model="form.password">
                </div>
                <div class="form-group">
                    <label>Confirm Password: </label>
                    <input type="password" class="form-control" id="confirm_password" v-model="form.confirm_password">
                </div>
                <p class="text-danger" v-for="error in errors" :key="error">
                    <span v-for="err in error" :key="err">{{ err }}</span>
                </p>
                <button type="submit" class="btn btn-primary">Register</button>

            </form>

        </div>
    </div>
</div>
</template>

<script setup>

import {reactive, ref} from "vue";
import axios from "axios";
import router from "../router/index.js";

    const form = reactive({
        first_name: '',
        last_name: '',
        email: '',
        password: '',
        confirm_password: '',
    })

    const errors = ref([]);

    const onSubmit = async () => {
        await axios.post('/api/register',form).then(response => {
            if (response.data.code === 200) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'User Registered Successfully!',
                    showConfirmButton: false,
                    timer: 1500
                })
                router.push({name: 'Login'})
            } else {
                errors.value = response.data.errors
            }
        }).catch(errors => {
            console.log(errors);

        })
    }

</script>

<style scoped>

</style>
