<template>
    <div>
        <Navigation :auth="auth" />
        <div class="mt-20 w-custom-955 m-auto py-8">
            <div class="profile w-full px-14 flex mb-10">
                <div class="profile-image p-1 bg-white border-2 border-1 rounded-full border-gray-300 mr-5">
                    <img class="inline object-cover w-16 h-16 rounded-full border border-gray-400" :src="'../uploads/profile/' + profile.image" alt="Profile image"/>
                </div>
                <div class="profile-info ml-14 mt-3">
                    <div class="flex flex-row">
                        <h2 class="text-2xl">{{ profileUsername }}</h2>

                        <!-- If own user profile -->
                        <di class="ml-3 mt-1 flex flex-row" v-if="profile.id == auth.id">
                            <Link class="ml-2 border border-gray-300 py-1 px-2 rounded text-sm font-medium" href="/settings">Edit Profile</Link>
                        </di>

                        <!-- If other user profile-->
                        <div class="ml-3 mt-1 flex flex-row" v-if="profile.id != auth.id">
                            <Link class="ml-2 border border-gray-300 py-1 px-2 rounded text-sm font-medium" href="/settings">Message</Link>
                            <Link class="ml-2 border border-gray-300 py-1 px-2 rounded text-sm font-medium" href="/settings">Follow</Link>
                        </div>
                    </div>
                    <div class="flex mt-3 flex-row">
                        <div class="mr-8"><span class="font-medium">{{ profile.posts }}</span> posts</div>
                        <div class="mx-8"><span class="font-medium">{{ profile.likes }}</span> likes</div>
                        <div class="mx-8"><span class="font-medium">0</span> following</div>
                    </div>
                    <div class="mt-3">
                        <div class="font-medium">{{ profile.name }}</div>
                    </div>
                    <div class="mt-1">
                        Dummy text profile description not added yet.
                    </div>
                </div>
            </div>
            <!-- Seperator -->
            <div class="my-5 border-t-2"></div>
            <!-- Posts foreach ... -->
            <div class="flex flex-row flex-wrap">
                <div v-for="(post, index) in posts" :key="index" @click="showModal(post)">
                    <div class="post-full relative">
                        <img class="post-image object-cover h-80 w-80 p-2" :src="'../uploads/posts/' + post.image">
                        <div class="post-likes absolute top-36 right-36 bg-black h-11 h-11 text-sm font-medium text-center rounded-full p-3 text-white m-auto">
                            <!--<i class="fas fa-fire mr-1"></i>{{ post.likes }}-->
                            <i class="fas fa-heart mr-1"></i> {{ post.likes }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <Modal v-on:modal_hide="hideModal()" :modal_visible="modalVisible" v-if="modalVisible" :post="post" :postIds="postIds" :profile="profile"/>
    </div>
</template>
<script>
import Navigation from './components/Navigation'
import { Link } from '@inertiajs/inertia-vue3'
import Fire from './components/Fire'
import Modal from './components/Modal'

export default {
    props: {
        auth: Object,
        username: String,
        profile: Object,
        posts: Array,
    },
    data() {
        return {
            modalVisible: false,
            post: {},
            postIds: {},
        }
    },
    methods: {
        showModal(post) {
            // Load all modal data
            /*
            this.post.image = post.image;
            this.post.likes = post.likes;
            this.post.author = this.profile;
            */

            this.post = post;
            console.log("this is the post");
        	console.log(this.post);

            this.postIds = { 'post_id': this.post.id, 'author_id': this.post.authorID };

            this.modalVisible = true;
        },
        hideModal() {
            this.modalVisible = false;
        },
    },
    components: {
        Navigation,
        Link,
        Fire,
        Modal
    },
    computed: {
        profileUsername() {
            return this.profile.username.toLowerCase();
        }
    }
}
</script>
<style scoped>
.post-full {
    cursor: pointer;
}

.post-full:hover > .post-likes {
    display: inline-block;
    animation: show 1s infinite;
      animation-iteration-count: 1;
}

.post-full:hover > .post-image {
    opacity: 0.5;
    transition: 0.3s ease;
}

.post-likes {
    display: none;
}

@keyframes show {
  0% {
    opacity: 0;
  }
  100% {
    opacity: 1;
  }
}

.profile-image img {
    width: 160px;
    height: 160px;
}

.w-custom-955 {
    width: 960px;
}

.modal-container {
    z-index: 999;
    animation: show 500ms infinite;
    animation-iteration-count: 1;
}

.comments-container {
    min-height: 390px;
    max-height: 390px;
    overflow-y: scroll;
}

::-webkit-scrollbar {
    width: 0;  /* Remove scrollbar space */
    background: transparent;  /* Optional: just make scrollbar invisible */
}
/* Optional: show position indicator in red */
::-webkit-scrollbar-thumb {
    background: #fff;
}

.modal-img {
    min-height: 600px;
    max-height: 600px;

    min-width: 600px;
    max-width: 600px;

    object-fit: cover;
}

.w-custom-965 {
    width: 964px;
}

.w-custon-355 {
    width: 364px;
}

.w-custom-600 {
    width: 600px;
}

.h-custom-600 {
    height: 600px;
}
</style>
