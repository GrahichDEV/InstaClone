<template>
    <div>
        <Navigation :auth="auth" />
        <div class="border bg-white border-gray-200 w-custom-350 flex flex-col mt-20 py-7 m-auto text-center">
            <form @submit.prevent="submit">
                <div class="w-10/12 m-auto">
                    <h3 class="mt-3 block text-sm font-medium text-gray-400 text-left">
                    Change profile image
                    </h3>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border border-gray-200 bg-gray-100">
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
                <button class="w-10/12 my-3 py-1 bg-blue-500 text-white rounded">Update Profile</button>
            </form>
        </div>
    </div>
</template>
<script>
import Navigation from './components/Navigation'

export default {
    props: {
        auth: Object,
    },
    data() {
        return {
            form: {
                image: null
            }
        }
    },
    components: {
        Navigation,
    },
    methods: {
        submit() {
            this.$inertia.post("/settings", this.form);
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
