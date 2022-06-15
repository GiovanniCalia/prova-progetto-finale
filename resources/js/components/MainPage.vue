<template>
<div>
    <div class="row">
        <li class="text-center">
            <h5>Page {{ currentPage }} of {{ lastPage }}</h5>
        </li>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item" :class="{disabled: !prevPageUrl}" @click="getArray(prevPageUrl)">
                    <a class="page-link">Previous</a>
                </li>

                <li class="page-item mx-2 d-flex align-items-center">
                    <form @submit.prevent="getArray(apiUrl + '/?page=' + newPage)">
                        <input type="text" v-model="newPage" placeholder="Insert page">
                    </form>
                </li>

                <li class="page-item" :class="{disabled: !nextPageUrl}" @click="getArray(nextPageUrl)">
                    <a class="page-link">Next</a>
                </li>
            </ul>
        </nav>
    </div>

      <div class="row">
        <div class="card m-3" style="width: 18rem;" v-for="post in posts" :key="post.id">
            <img src="" class="card-img-top" alt="">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ post.title }}</h5>
                <p class="card-text">{{ post.description }}</p>
                <a href="#" class="btn btn-primary mt-auto">View</a>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'MainPage',
    data () {
        return {
            posts: [],

            newPage: null,

            apiUrl: 'http://127.0.0.1:8000/api/posts',

            currentPage: null,
            firstPageUrl: null,
            lastPage: null,
            lastPageUrl: null,
            nextPageUrl: null,
            prevPageUrl: null,
        }
    },
    created() {
        this.getArray('http://127.0.0.1:8000/api/posts')
    },
    methods: {
        getArray(http) {
            if (http) {
                Axios.get(http)
                .then(element => {
                    this.posts = element.data.response.data;
                    this.currentPage = element.data.response.current_page;
                    this.firstPageUrl = element.data.response.first_page_url;
                    this.lastPage = element.data.response.last_page;
                    this.lastPageUrl = element.data.response.last_page_url;
                    this.nextPageUrl = element.data.response.next_page_url;
                    this.prevPageUrl = element.data.response.prev_page_url;

                    this.newPage = null
                })
            }
        }
    }
}
</script>

<style scoped>
li{
    list-style-type: none;
}

</style>