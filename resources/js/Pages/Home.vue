<template>
    <div>
        <Navigation class="noselect z-50" :auth="auth" />
        <div class="mt-20 w-custom-955 m-auto flex py-8">
            <div class="noselect w-8/12 px-1">
                <Post @open-modal="openModal" v-for="(post, index) in posts" :key="index" :post="post" :author="auth" v-on:fireReload="fire(index)"/>
            </div>
            <Profile class="noselect w-2/12" :auth="auth"/>
        </div>

        <Modal @post_liked="incrementLikes" v-if="modalVisible" :modal_visible="modalVisible" :post="modal.post" :postIds="modal.postIds" :profile="modal.profile" v-on:modal_hide="hideModal()" />
    </div>
</template>
<script>
import Navigation from './components/Navigation'
import Post from './components/Post'
import Profile from './components/Profile'
import Modal from './components/Modal'

export default {
    props: {
        auth: Object,
        posts: Array,
    },
    components: {
        Navigation,
        Post,
        Profile,
        Modal,
    },
    data() {
        return {
            modalVisible: false,
            modal_post: {},
            modal_profile: {},
            modal: {
                post: {},
                profile: {},
                postIds: {}
            },
        }
    },
    methods: {
        fire(index) {
            this.posts[index].post_likes++;
            // This emit event reload comments
        },
        openModal(id) {
            console.log("Home: opening modal for id: " + id);

            // Find the post with
            let post = this.filterByValue(this.posts, `,"post_id":${id},`);
            this.setProfile(post)

            console.log("Home-> found post: ")
            console.log(post[0]);

            this.modalVisible = true;

            // console.log(JSON.stringify(this.posts));
            // console.log(postWithId);
        },
        hideModal() {
            this.modal.post = {},
            this.modal.profile = {},
            this.modal.postIds = {},

            this.modalVisible = false;
        },
        filterByValue(array, value) {
            return array.filter((data) =>  JSON.stringify(data).toLowerCase().indexOf(value.toLowerCase()) !== -1);
        },
        setProfile(post) {
            this.modal.post.image = post[0].post_image;
            this.modal.post.likes = post[0].post_likes;

            // Profile
            this.modal.profile.image = post[0].author_image;
            this.modal.profile.username = post[0].author_username;
            this.modal.postIds = { 'post_id': post[0].post_id, 'author_id': post[0].author_id };
            this.modal.post.post_comments = post[0].post_comments;

            /*
            let index = this.posts.findIndex(element => element == post[0]);
            this.posts[index].likes++;
            */

            post[0].likes++;

            // PostIDs
        },
        incrementLikes(id) {
            console.log("Post liked");
            let found_post = this.posts.find(element => element.post_id = id).post_likes++;

            console.log(found_post);

        }
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

.modal {
    z-index: 999;
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

.w-custom-955 {
    width: 955px;
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
