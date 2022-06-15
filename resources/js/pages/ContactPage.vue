<template>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Contacts</h1>
                <div v-if="validity" class="alert alert-success" role="alert">
                    {{ validity }}
                </div>
                <form @submit.prevent="SendMessage" action="api/contact" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" v-model="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">email</label>
                        <input type="text" class="form-control" id="email" name="email" v-model="email">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" name="message" v-model="message"></textarea>
                    </div>
                    <button class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    name: 'ContactPage',
    data() {
        return{
            ApiUrl: "/api/contact",
            name: "",
            email: "",
            message: "",
            validity: "",

        }
    },
    methods: {
        SendMessage() {
            Axios.post(this.ApiUrl, {
                name: this.name,
                email: this.email,
                message: this.message,
            })
            .then(element => this.validity = element.data.validity)
            console.log(this.validity)
        }
        
    }
}
</script>

<style scoped>

</style>
