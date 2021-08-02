<template>
<!-- Modal -->
    <div v-show="modal_visible" @click="hideModal()" tabindex="0" class="modal-container fixed top-0 left-0 z-50 bg-opacity-60 bg-black w-screen h-screen flex items-center justify-center">
        <div @click.stop tabindex="1" class="w-custom-965 h-custom-600 h-custom-600 bg-white flex">

            <div class="w-custom-600">
                <!--<img :src="'../uploads/posts/' + post.image">-->
                <img class="modal-img" :src="'../uploads/posts/' + post.image">
            </div>
            <div class="w-custon-355">
                <div class="flex flex-row py-5 px-4 border-b border-gray-300">
                    <img class="inline object-cover w-9 h-9 mr-2 rounded-full border border-gray-300" :src="'/uploads/profile/' + profile.image"/>
                    <p class="font-medium text-sm mt-2 ml-2">{{ toLower(profile.username) }}</p>
                </div>

                <!-- All comments scrollable without scroll -->
                <!-- Must load all comments and the users that commented desc ... -->
                <div class="comments-container">
                        <!--
                        <img class="inline object-cover w-9 h-9 mr-2 rounded-full border border-gray-300" :src="'/uploads/profile/' + profile.image"/>
                        <p class="text-sm ml-2"><span class="font-medium">{{ profile.username }} </span> Dummy text this will be the text of this post test example test text test dummy.</p>
                        -->
                        <div class="comment flex flex-row py-3 px-4" v-for="(comment, index) in post.post_comments" :key="index">
                        <img class="inline object-cover w-9 h-9 mr-2 rounded-full border border-gray-300" :src="'/uploads/profile/' + comment.author_image"/>
                            <p class="text-sm ml-2">
                                <Link :href="'profile/' + comment.author"><span class="font-medium">{{ toLower(comment.author) }} </span></Link>
                            {{ comment.text }}</p>
                        </div>
                </div>

                <!--Like comment share button -->
                <div class="border-t border-gray-300 noselect">
                    <Fire :postIds="postIds" v-on:fireReload="fire(postIds.post_id)"/>
                    <span class="text-sm font-medium ml-2 noselect">{{ post.likes }} likes</span>
                </div>

                <!--Comment Form -->
                <div>
                    <div class="border-t border-gray-200 noselect">
                        <!-- Maybe use textarea so it can go in next line if you type long comment -->
                        <input v-model="modal.comment" class="py-3 px-3 text-sm w-10/12 focus:outline-none" type="text" placeholder="Add a comment...">
                        <button class="text-sm font-medium text-blue-200"><span :class="onValueEnter">Post</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Fire from './Fire'
import { Link } from '@inertiajs/inertia-vue3'

export default {
    props: {
        postIds: Object,
        profile: Object,
        post: Object,
        modal_visible: Boolean,
    },
    data() {
        return {
            modal: {
                modal_id: 0,
                comment: null,
            }
        }
    },
    methods: {
        hideModal() {
            console.log(this.postIds);
            this.$emit('modal_hide');
        },
        fire(id) {
            console.log("Modal: Fire: " + id);
            this.$emit('post_liked', id);

            this.profile.likes++;
            this.post.likes++;
        },
        toLower(str) {
            return str.toLowerCase();
        }
    },
    components: {
        Fire,
        Link
    }
}
</script>
<style scoped>
.noselect {
  -webkit-touch-callout: none; /* iOS Safari */
    -webkit-user-select: none; /* Safari */
     -khtml-user-select: none; /* Konqueror HTML */
       -moz-user-select: none; /* Old versions of Firefox */
        -ms-user-select: none; /* Internet Explorer/Edge */
            user-select: none; /* Non-prefixed version, currently
                                  supported by Chrome, Edge, Opera and Firefox */
}

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
