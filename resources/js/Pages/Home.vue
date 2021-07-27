<template>
    <div>
        <Navigation :auth="auth" />
        <div class="mt-20 w-custom-955 m-auto flex py-8">
            <div class="w-8/12 px-1">
                <Post v-for="(post, index) in posts" :key="index" :post="post" v-on:fireReload="fire(index)"/>
            </div>
            <Profile class="w-2/12" :auth="auth"/>
        </div>
    </div>
</template>
<script>
import Navigation from './components/Navigation'
import Post from './components/Post'
import Profile from './components/Profile'

export default {
    props: {
        auth: Object,
        posts: Array,
    },
    components: {
        Navigation,
        Post,
        Profile,
    },
    methods: {
        fire(index) {
            this.posts[index].post_likes++;
        }
    }
}
</script>
<style scoped>
.w-custom-955 {
    width: 955px;
}
</style>
