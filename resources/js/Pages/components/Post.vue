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

        <div v-if="postIds">
            <Fire :postIds="postIds" v-on:fireReload="fire"/>
        </div>

        <div v-else>
            <Fire :postIds="altPostIds" v-on:fireReload="fire"/>
        </div>

        <p class="text-sm font-medium ml-1 noselect"> {{ post.post_likes }} Likes</p>
        <div class="text-sm font-normal ml-3 noselect">
            <Link :href="'profile/' + post.author_username"><span class="font-medium">{{ toLower(post.author_username) }}</span></Link> {{ post.post_text }}
        </div>

        <div class="ml-3 mt-3 noselect">
            <a @click="openModal(post.post_id)" class="url text-sm text-gray-400 font-medium">View all comments</a>
        </div>
        <!-- Comments -->
        <div class="my-1 text-sm font-normal ml-3 noselect">
            <!-- On the comment icon click will display all comments -->
            <div v-for="(comment, index) in post.post_comments.slice(Math.max(post.post_comments.length - 3 , 1))" :key="index">
                <Link :href="'profile/' + post.post_comments[index].author.username">
                    <span class="font-medium">{{ toLower(post.post_comments[index].author) }}</span>
                </Link> {{ post.post_comments[index].text }}
            </div>
            <!-- Display only first few comments -->
        </div>

        <!-- Comment Form -->
        <div class="border-t border-gray-200 noselect">
            <form @submit.prevent="addComment">
                <input v-model="comment.text" class="mt-1 py-2 px-3 text-md w-11/12 focus:outline-none" type="text" placeholder="Add a comment...">
                <button class="font-medium text-blue-200"><span :class="onValueEnter">Post</span></button>
            </form>
        </div>
    </div>
</template>
<script>
import Fire from './Fire'
import { Link } from '@inertiajs/inertia-vue3';
import axios from 'axios';

export default {
    props: {
        postIds: Object,
        post: Object,
        author: Object,
    },
    components: {
        Fire,
        Link
    },
    data() {
        return {
            altPostIds: {'post_id': this.post.post_id, 'author_id': this.post.author_id},
            comment: {
                post_id: this.post.post_id,
                author_username: this.author.username,
                author_image: this.author.image,
                text: "",
            },
            onValueEnter: null,
        }
    },
    methods: {
        fire() {
            this.$emit('fireReload');
        },
        addComment() {
           axios.post('/api/comment', this.comment)
           .then(response => {
               //  Reload comments
               this.getComments(this.post.post_id, 5)

               // Reset input to "",
               this.comment.text = ""

               // Add on the client side
               return response.data;
           })
           .catch(error => {
               return error;
           });
        },
        getComments(id, limit) {
           axios.get(`/api/comments/${id}/${limit}`)
           .then(response => {
               // Add on the client side
               this.post.post_comments =  response.data;
           })
           .catch(error => {
               return error;
           });
        },

        toLower(str) {
            return str.toLowerCase();
        },
        // Will pass id of the post to the Home.vue
        openModal(e) {
            this.$emit('open-modal', e)
            console.log("Post: Open Modal: " + e);
        }
    },
    computed: {
        onValueEnter() {
            if(this.comment.text) {
                if( this.comment.text.length > 0)
                    return 'transition duration-300 ease-in-out text-blue-400'
            }

            return 'transition duration-300 ease-in-out text-blue-200'
        },
    },
    mounted() {
        console.log(this.altPostIds);
    }
}
</script>
<style scoped>
.url {
    cursor: pointer;
}

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
