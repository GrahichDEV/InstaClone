<template>
    <div class="flex flex-col h-screen">
        <div class="m-auto">
            <div class="border bg-white border-gray-300 w-custom-955 py-7 flex flex-col">
                <div class="text-center mb-7">
                    <h2 class="logo text-5xl">Instagram</h2>
                </div>
                <form @submit.prevent="login" class="mb-3 text-center">
                    <div class="w-10/12 m-auto text-left text-xs text-red-500" v-if="errors.account">{{ errors.account }}</div>
                    <input autocomplete="off" class="w-10/12 py-2 px-2 text-xs my-1 border border-gray-200 bg-gray-100 focus:outline-none" v-model="form.email" name="email" type="text" placeholder="Email">
                    <input autocomplete="off" class="w-10/12 py-2 px-2 text-xs my-1 border border-gray-200 bg-gray-100 focus:outline-none" v-model="form.password" name="password" type="password" placeholder="Password">
                    <button :class="onValueEnter" class="w-10/12 bg-blue-200 mt-3 text-white py-1 rounded">
                    Log in
                    </button>
                </form>
                <div class="w-10/12 text-sm text-gray-300 font-medium text-center m-auto my-3">
                    ――――――――― <span class="px-1 text-gray-400">OR</span> ―――――――――
                </div>
                <button class="w-10/12 m-auto  py-1 rounded">
                    <p class="text-blue-500 text-white font-medium"><i class="fab fa-facebook-square mr-1"></i> Log in with Facebook</p>
                    <p class="my-3 text-xs"><Link href="/">Forgot password ?</Link></p>
                </button>
            </div>
            <div class="border bg-white border-gray-300 w-custom-955 mt-3 mb-10 m-auto py-7 text-center text-sm">
                <p>Don't have an account ? <Link class="text-blue-400 font-medium" href="/register">Sign up</Link></p>
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
    components: {
        Link,
    },
    data() {
        return {
            form: {
                email: "",
                password: "",
            }
        }
    },
    methods: {
        login() {
            // Send data to our backend
            this.$inertia.post("/login", this.form);
        }
    },
    computed: {
        onValueEnter() {
            if(this.form.email && this.form.password) {
                if( this.form.email.length > 0 && this.form.password.length)
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
