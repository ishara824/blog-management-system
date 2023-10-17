<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 mt-4">
                <h2>Login</h2>
                <form @submit.prevent="onSubmit">
                    <div class="form-group">
                        <label>Email Address: </label>
                        <input type="email" class="form-control" id="email" v-model="form.email">
                    </div>
                    <div class="form-group">
                        <label>Password: </label>
                        <input type="password" class="form-control" id="password" v-model="form.password">
                    </div>
                    <p class="text-danger" v-for="error in errors" :key="error">
                        <span v-for="err in error" :key="err">{{ err }}</span>
                    </p>

                    <p class="text-danger">
                        <span>{{ unauth.error }}</span>
                    </p>


                    <button type="submit" class="btn btn-primary">Login</button>
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
    email: '',
    password: '',
});

const errors = ref([]);
const unauth = reactive({
    error: ''
});

const onSubmit = async() => {
    await axios.post('/api/login',form).then(response => {
        if (response.data.code === 200) {
            localStorage.setItem('token', response.data.data.token);
            router.push({name: 'Dashboard'})
        }else if (response.data.code === 401) {
            unauth.error = response.data.error;
        } else {
            errors.value = response.data.errors;
        }
    }).catch(errors => {
        console.log(errors);
    })
}

</script>

<style scoped>

</style>
