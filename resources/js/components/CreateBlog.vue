<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 mt-4">

                <h2>Create Blog</h2>

                <form @submit.prevent="onSubmit">

                    <div class="form-group">
                        <label>Title </label>
                        <input type="text" class="form-control" v-model="form.title">
                    </div>
                    <div class="form-group">
                        <label>Blog Content</label>
                        <textarea class="form-control" v-model="form.blog_content"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Published Date</label>
                        <input type="date" class="form-control" v-model="form.published_date">
                    </div>
                    <p class="text-danger" v-for="error in errors" :key="error">
                        <span v-for="err in error" :key="err">{{ err }}</span>
                    </p>
                    <button type="submit" class="btn btn-primary">Save</button>

                </form>
            </div>
        </div>
    </div>
</template>

<script setup>

import {reactive,ref} from "vue";
import axios from "axios";
import router from "../router/index.js";

    const form = reactive({
        title: '',
        blog_content: '',
        published_date: '',
    });

    const errors = ref([]);

    const onSubmit = async () => {
        await axios.post('/api/create-blog',form).then(response => {
            if (response.data.code === 200) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: response.data.message,
                    showConfirmButton: false,
                    timer: 1500
                })
                router.push({name: 'Dashboard'})
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
