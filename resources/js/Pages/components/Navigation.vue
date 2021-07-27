<template>
    <div class="bg-white border-b border-gray-200 fixed top-0 w-full">
        <nav class="w-custom-955 m-auto flex flex-row justify-between">
            <ul class="flex flex-row justify-between">
                <li class="logo p-2 mt-2"><Link href="/"><img src="/logo.png"></Link></li>
            </ul>
            <ul class="flex flex-row justify-between">
                <li class="p-2 mr-1"><Link href="/"><i class="fas fa-home"></i></Link></li>
                <li class="p-2 mr-1"><Link href="/settings"><i class="fas fa-cog"></i></Link></li>
                <!--<li class="p-2 mr-1"><Link href=""><i class="fas fa-sign-out-alt"></i></Link></li>-->
                <li class="p-1"><Link href="/logout"><img class="inline object-cover w-6 h-6 mr-2 rounded-full border border-gray-300" :src="'/uploads/profile/' + auth.image"/></Link></li>
            </ul>
        </nav>
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
    }
}
</script>
<style scoped>
.w-custom-955 {
    width: 955px;
}

li {
    line-height: 40px;
}

li i {
    font-size: 20px;
}
</style>
