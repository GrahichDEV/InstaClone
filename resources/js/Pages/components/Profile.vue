<template>
<div class="w-2/12">
    <div class="profile">
        <div class="flex flex-row justify-between m-6">
            <Link :href="'/profile/' + auth.username">
                <img class="inline object-cover w-16 h-16 mr-2 rounded-full border border-gray-300" :src="'uploads/profile/' + auth.image" alt="Profile image"/>
            </Link>
            <div class="ml-3 w-8/12 align-middle flex flex-col justify-center text-sm">
                <div class="font-medium "><Link :href="'/profile/' + auth.username">{{ usernameToLower }}</Link></div>
                <div class="text-gray-400">{{ auth.name }}</div>
            </div>
            <div class="flex flex-col justify-center">
                <div class="font-medium text-blue-400 text-sm"></div>
            </div>
        </div>
        <div>
            <Link href="/post" class="w-11/12 m-auto block bg-blue-500 text-center py-1 text-white rounded">Add Post</Link>
        </div>
    </div>
</div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
    props: {
        auth: Object,
    },
    data() {
        return {
            defaultPrfileImage: "https://i0.wp.com/uberinsta.com/images/default_avatar.jpg",
        }
    },
    components: {
        Link,
    },
    computed: {
        usernameToLower() {
            return this.auth.username.toLowerCase();
        }
    }
}
</script>
<style scoped>
.profile {
    position: fixed;
    width: 320px;
}
</style>
