<template>
        <!--<div class="container">-->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
<!--            <router-link class="navbar-brand" :to="{name: 'Home' }">Home</router-link>-->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link class="text-white" :to="{name: 'Login'}">Login</router-link>
                </li>
                <li class="navbar-item">
                    <router-link class="text-white ml-2" :to="{name: 'Register'}"> Register</router-link>
                </li>
                <li class="navbar-item">
                    <router-link class="text-white ml-2" :to="{name: 'AllBlogs'}"> Blogs</router-link>
                </li>
            </ul>
        </nav>
        <router-view></router-view>
        <!--</div>-->
</template>

<script>
export default {
    name: "App"
}
</script>

<style scoped>

</style>
