<template><div class="container">
    <div class="row col-md-12">
        <div class="col-md-4 text-left mt-2"><h2>Dashboard </h2></div>

        <div class="col-md-8 text-right">
            <router-link :to="{ name: 'CreateBlog' }" class="btn btn-primary mt-2 mr-2">Create Blog+</router-link>
        </div>

    </div>

    <table class="table table-responsive col-md-12 mt-4">
        <thead class="thead-dark">
        <tr>
            <th width="100">#</th>
            <th width="100">Title</th>
            <th width="500">Content</th>
            <th class="text-center" width="400">Action</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(blog, index) in blogs" :key="blog">
            <td>{{ index + 1}}</td>
            <td>{{ blog.title }}</td>
            <td>{{ blog.content }}</td>
            <td class="text-center">
                <router-link :to="{ path: '/edit-blog/' + blog.id }" class="btn btn-sm btn-primary">Edit</router-link>
                <button class="btn btn-sm btn-danger ml-2" @click="deleteBlog(blog.id)">Delete</button>
            </td>
        </tr>
        </tbody>
    </table>
</div>

</template>

<script setup>

import {onMounted, ref} from "vue";
import axios from "axios";

    const blogs = ref([]);

    const getAllBlogPosts = async() => {
        await axios.get('/api/get-all-blog-posts-by-user').then(response => {
            blogs.value = response.data.blogs;
        })
    }

    const deleteBlog = async (blog_id) => {
        await axios.post('/api/delete-blog/',{blog_id: blog_id}).then(response => {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: response.data.message,
                showConfirmButton: false,
                timer: 1500
            })
            setTimeout(function (){
                location.reload();
            },2000)
        })
    }

    onMounted(() => {
        getAllBlogPosts();
    })
</script>

<style scoped>

</style>
