<template>
<div>
    <HeaderPage/>
<!--<MainPage/>-->
    <router-view></router-view>
</div> 
</template>

<script>
import HeaderPage from '../components/HeaderPage.vue';
import MainPage from '../components/MainPage.vue';

export default {
    name: 'App',
    components: {
        HeaderPage,
        MainPage,
    }
}
</script>

<style scoped>

</style>