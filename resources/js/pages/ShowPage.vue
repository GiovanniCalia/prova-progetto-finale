<template>
    <div v-if="post" class="text-center box m-auto">
        <h1>{{ post.title }}</h1>
        <h4>From the creator: <b>{{ post.creator }}</b></h4>
        <p>{{ post.description }}</p>
    </div>
</template>

<script>
export default {
    name: 'ShowPage',
    props: ['slug'],
    data () {
        return {
            post: null,
            baseUrl: 'http://127.0.0.1:8000/api/posts',
        }
    },
    created(){
        this.getArray(this.baseUrl + '/' + this.slug)
    },
    methods: {
        getArray(http) {
            if (http) {
                Axios.get(http)
                .then(element => {
                    if (element.data.success){
                        this.post = element.data.response.data;
                    } else {
                        console.log('Unable to access');
                    }
                });
            }
        }
    }
}
</script>

<style style="scss" scoped>
    .box{
        width: 500px;
    }

</style>