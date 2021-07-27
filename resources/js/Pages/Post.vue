<template>
    <div>
        <Navigation :auth="auth" />
        <div class="border bg-white border-gray-200 w-custom-350 py-7 flex flex-col mt-20 m-auto text-center">
            <form @submit.prevent="submit">
                <h3 class="w-10/12 m-auto mt-3 block text-sm font-medium text-gray-400 text-left">
                    Add new post
                </h3>
                <input class="w-10/12 py-2 px-2  text-sm my-1 border border-gray-200 bg-gray-100" v-model="form.title" name="title" type="title" placeholder="Post Title">
                <div class="w-10/12 m-auto text-left text-xs text-red-500 mb-2" v-if="errors.title">{{ errors.title }}</div>
                <textarea class="w-10/12 py-2 px-2 border border-gray-20 bg-gray-100 text-sm" v-model="form.text" name="text" rows="5" placeholder="Post Text"></textarea>
                <div class="w-10/12 m-auto text-left text-xs text-red-500 mb-2" v-if="errors.text">{{ errors.text }}</div>
                <div class="w-10/12 bg-gray-100 m-auto">
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border border-gray-200">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                        <label for="file" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none">
                            <span>Upload a file</span>
                            <input id="file" name="file" type="file" class="sr-only" @input="form.image = $event.target.files[0]">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">
                        PNG, JPG, GIF up to 10MB
                        </p>
                    </div>
                    </div>
                </div>
                <div class="w-10/12 m-auto text-left text-xs text-red-500 mb-1" v-if="errors.image">{{ errors.image }}</div>

                <button class="w-10/12 my-3 py-1 bg-blue-500 text-white rounded">Add Post</button>
            </form>
        </div>
    </div>
</template>
<script>
import Navigation from './components/Navigation'

export default {
    props: {
        auth: Object,
        errors: Object,
    },
    data() {
        return {
            form: {
                title: null,
                text: null,
                image: null
            },
        }
    },
    components: {
        Navigation,
    },
    methods: {
        submit() {
            this.$inertia.post("/post", this.form);
        }
    }
}
</script>
<style scoped>
.w-custom-955 {
    width: 935px;
}

.w-custom-350 {
    width: 350px;
}
</style>
