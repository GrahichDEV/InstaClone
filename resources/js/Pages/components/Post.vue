<template>
    <div class="post-container">
        <div class="flex flex-row py-2 px-2">
            <div class="profile-image">
                <Link :href="'profile/' + post.author_username">
                    <img class="inline object-cover mr-2 rounded-full border border-gray-300 noselect" :src="'/uploads/profile/' + post.author_image"/>
                </Link>
            </div>
            <h2 class="ml-2 post-title font-medium">
                <Link :href="'profile/' + post.author_username">
                    {{ post.author_username }}
                </Link>
            </h2>
        </div>
        <p class="post-text">{{ post.text }}</p>
        <img :src="'uploads/posts/' + post.post_image">
        <!--<Fire @fire-up="$emit('fire-up', post.id)" :id="post.id" :fire="post.likes"/>-->
        <Fire :post="postIds" v-on:fireReload="fire"/>
        <p class="text-md font-medium ml-1 noselect">{{ post.post_likes }} Likes</p>
        <div class="text-md font-normal ml-3 noselect">
            <span class="font-medium">{{ authorName }}</span> {{ post.post_text }}
        </div>

        <!-- Comments -->
        <div class="my-3">
            <!-- On the comment icon click will display all comments -->
            <!-- Display only first few comments -->
        </div>
        <!-- Comment Form -->
        <div class="border-t border-gray-200 noselect">
            <input class="mt-1 py-2 px-3 text-md w-11/12 focus:outline-none" type="text" placeholder="Add a comment...">
            <button class="font-medium text-blue-200">Post</button>
        </div>
    </div>
</template>
<script>
import Fire from './Fire'
import { Link } from '@inertiajs/inertia-vue3';

export default {
    props: {
        post: Object,
    },
    components: {
        Fire,
        Link
    },
    methods: {
        fire() {
            this.$emit('fireReload');
        }
    },
    computed: {
        authorName() {
            return this.post.author_username.toLowerCase();
        },
        postIds() {
            return { 'post_id': this.post.post_id, 'author_id': this.post.author_id };
        }
    }
}
</script>
<style scoped>
.profile-image img {
    min-width: 35px;
    min-height: 35px;
    max-width:35px;
    max-height:35px;
}

.post-container {
    padding:10px 0px;
    margin-bottom:20px;
    border:1px solid gainsboro;
    border-radius:4px;
    background: #fff;
}
.post-container h2 {
    text-align: left;
    text-transform: lowercase;
}
.post-container h2, .post-container p {
    padding: 0px 7px;
}
.post-container p {
    text-align: left;
}
.post-container img {
    width:100%;
}

.noselect {
  -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome, Edge, Opera and Firefox */
}
</style>>
