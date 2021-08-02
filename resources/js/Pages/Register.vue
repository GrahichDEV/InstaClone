<template>
    <div class="flex flex-col h-screen">
        <div class="m-auto">
            <div class="border bg-white border-gray-300 w-custom-955 py-7 flex flex-col">
                <div class="text-center">
                    <h2 class="logo text-5xl">Instagram</h2>
                    <p class="my-4 w-10/12 m-auto">Sign up to see photos and videos from your friends.</p>
                    <button class="w-10/12 bg-blue-500 text-white py-1 rounded">
                    <i class="fab fa-facebook-square"></i> Log in with Facebook
                    </button>
                </div>
                <div class="w-10/12 text-sm text-gray-300 font-medium text-center m-auto my-3">
                    ――――――――― <span class="px-1 text-gray-400">OR</span> ―――――――――
                </div>
                <form @submit.prevent="register" class="mb-3 text-center">
                    <div class="w-10/12 m-auto text-left text-xs text-red-500" v-if="errors.email">{{ errors.email }}</div>
                    <input autocomplete="off" class="w-10/12 py-2 px-2 text-xs my-1 border border-gray-200 bg-gray-100 focus:outline-none" type="text" v-model="form.email" name="email" placeholder="Email">
                    <div class="w-10/12 m-auto text-left text-xs text-red-500" v-if="errors.name">{{ errors.name }}</div>
                    <input autocomplete="off" class="w-10/12 py-2 px-2 text-xs my-1 border border-gray-200 bg-gray-100 focus:outline-none" type="text" v-model="form.name" name="name" placeholder="Full Name">
                    <div class="w-10/12 m-auto text-left text-xs text-red-500" v-if="errors.username">{{ errors.username }}</div>
                    <input autocomplete="off" class="w-10/12 py-2 px-2 text-xs my-1 border border-gray-200 bg-gray-100 focus:outline-none" type="text" v-model="form.username" name="username" placeholder="Username">
                    <div class="w-10/12 m-auto text-left text-xs text-red-500" v-if="errors.password">{{ errors.password }}</div>
                    <input autocomplete="off" class="w-10/12 py-2 px-2 text-xs my-1 border border-gray-200 bg-gray-100 focus:outline-none" type="password" v-model="form.password" name="password" placeholder="Password">
                    <input autocomplete="off" class="w-10/12 py-2 px-2 text-xs my-1 border border-gray-200 bg-gray-100 focus:outline-none"  type="password" v-model="form.password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                    <button type="submit" :class="onValueEnter" class="w-10/12 bg-blue-200 mt-3 text-white py-1 rounded">
                    Next
                    </button>
                </form>
                <p class="w-10/12 text-xs text-center m-auto">
                    By signing up, you agree to our Terms . Learn how we collect,
                    use and share your data in our Data Policy and how we use
                    cookies and similar technology in our Cookies Policy .
                </p>
            </div>
            <div class="border bg-white border-gray-300 w-custom-955 mt-3 mb-10 m-auto py-7 text-center text-sm">
                Have an account ? <Link class="text-blue-400 font-medium" href="/login">Log in</Link>
            </div>
            <div class="w-custom-955 mt-3 mb-5 m-auto py-7 text-center text-sm">
            </div>
        </div>

    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    props: {
        errors: Object,
    },
    data() {
        return {
            form: {
                email: "",
                name: "",
                username: "",
                password: "",
                password_confirmation: ""
            }
        }
    },
    methods: {
        register() {
            this.$inertia.post("/register", this.form);
        }
    },
    components: {
        Link,
    },
    computed: {
        onValueEnter() {
            if(this.form.email && this.form.name && this.form.username && this.form.password && this.form.password_confirmation) {
                if(this.form.email.length > 0 && this.form.name.length > 0 && this.form.username.length > 0 && this.form.password.length > 0 && this.form.password_confirmation.length > 0)
                    return 'transition duration-500 ease-in-out bg-blue-400'
            }

            return 'transition duration-500 ease-in-out bg-blue-200'
        }
    }
}
</script>
<style scoped>
.w-custom-955 {
    width: 350px;
}

.logo {
    font-family: 'Grand Hotel', cursive;
}
</style>
