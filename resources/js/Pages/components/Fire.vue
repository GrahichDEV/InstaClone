<template>
<div class="fire">
    <span class="btn" @click="fire"><i class="fas fa-fire"></i></span>
    <span class="btn"><i class="fas fa-comment-alt"></i></span>
    <!--<span class="btn"><i class="fas fa-share-alt"></i></span>-->
</div>
</template>
<script>
export default {
    props: {
        id: Number,
    },
    name: 'Fire',
    methods: {
        fire() {
            // console.log("test" + this.id);
            this.$inertia.get(`/post/like/${this.id}`);
            this.$emit('fireReload');
        }
    }
}
</script>
<style scoped>
.btn {
    margin-right: 15px;
}
.fas {
    font-size:25px;
}
.fa-fire:hover {
    transition:0.3s ease;
    color:orangered;
    cursor: pointer;
}
.fa-comment-alt:hover, .fa-share-alt:hover {
    transition:0.3s ease;
    color:rgb(63, 63, 63);
    cursor: pointer;
}
.fire {
    padding:10px 15px;
}
</style>
