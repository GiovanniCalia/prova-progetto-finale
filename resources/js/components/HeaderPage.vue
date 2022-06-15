<template>
    <header class="text-center my-3">
        <router-link :to="{ name: 'home'}" class="btn btn-dark">Home</router-link>
        <router-link :to="{ name: 'IndexPage'}" class="btn btn-dark">See Posts</router-link>
        <router-link :to="{ name: 'AboutUs'}" class="btn btn-dark">About us</router-link>
        <router-link :to="{ name: 'ContactPage'}" class="btn btn-dark">Contacts</router-link>

           <!--<link rel='stylesheet' type='text/css' href='https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps.css'>
           <script type="text/javascript" src="https://api.tomtom.com/maps-sdk-for-web/cdn/6.x/6.5.0/maps/maps-web.min.js"></script>-->
    </header>
</template>

<script>
export default {
    name: 'HeaderPage'
}
</script>

<style scoped>

</style>