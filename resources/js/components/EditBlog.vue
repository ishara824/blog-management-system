<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-6 mt-4">
                <h2>Edit Blog</h2>
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
import {onMounted, reactive, ref} from "vue";
import { useRouter,useRoute } from "vue-router";
import axios from "axios";

    onMounted(() => {
        getBlogDetails();
    })

    const router = useRouter();

    const route = useRoute();

    const form = reactive({
        title: '',
        blog_content: '',
        published_date: '',
        blog_id: route.params.id
    });

    const errors = ref([]);

    const getBlogDetails = async () => {
        await axios.get('/api/get-blog-by-id/' + route.params.id).then(response => {
            form.title = response.data.title;
            form.blog_content = response.data.content;
            form.published_date = response.data.published_date;
        })
    }

    const onSubmit = async () => {
        await axios.post('/api/edit-blog',form).then(response => {
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
