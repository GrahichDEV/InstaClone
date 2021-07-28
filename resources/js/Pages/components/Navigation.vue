<template>
    <div class="bg-white border-b border-gray-200 fixed top-0 w-full">
        <nav class="w-custom-955 m-auto flex flex-row justify-between">
            <ul class="flex flex-row justify-between">
                <li class="logo p-2 mt-2"><Link href="/"><img src="/logo.png"></Link></li>
            </ul>
            <ul class="flex flex-row justify-between">
                <li class="p-2 mr-1">
                    <Link href="/">
                        <!--<i class="fas fa-home"></i>-->
                        <svg aria-label="Home" class="mt-2" fill="#262626" height="22" role="img" viewBox="0 0 48 48" width="22">
                            <path d="M45.3 48H30c-.8 0-1.5-.7-1.5-1.5V34.2c0-2.6-2-4.6-4.6-4.6s-4.6 2-4.6 4.6v12.3c0 .8-.7 1.5-1.5 1.5H2.5c-.8 0-1.5-.7-1.5-1.5V23c0-.4.2-.8.4-1.1L22.9.4c.6-.6 1.5-.6 2.1 0l21.5 21.5c.4.4.6 1.1.3 1.6 0 .1-.1.1-.1.2v22.8c.1.8-.6 1.5-1.4 1.5zm-13.8-3h12.3V23.4L24 3.6l-20 20V45h12.3V34.2c0-4.3 3.3-7.6 7.6-7.6s7.6 3.3 7.6 7.6V45z"></path>
                        </svg>
                    </Link>
                </li>
                <!--<li class="p-2 mr-1"><Link href=""><i class="fas fa-sign-out-alt"></i></Link></li>-->
                <!--
                Place of the image
                <li class="p-1"><Link href="/logout"><img class="inline object-cover w-6 h-6 mr-2 rounded-full border border-gray-300" :src="'/uploads/profile/' + auth.image"/></Link></li>
                -->
                <div class="relative inline-block text-left dropdown">
                    <span class="rounded-md shadow-sm">
                    <button class="" type="button" aria-haspopup="true" aria-expanded="true" aria-controls="headlessui-menu-items-117">
                        <li class="p-1"><img class="inline object-cover w-6 h-6 mr-2 rounded-full border border-gray-300" :src="'/uploads/profile/' + auth.image"/></li>
                    </button>
                    </span>
                    <div class="z-50 opacity-0 invisible dropdown-menu transition-all duration-300 transform origin-top-right -translate-y-2 scale-95">
                        <div class="absolute right-0 w-56 mt-2 origin-top-right bg-white border border-gray-200 divide-y divide-gray-100 rounded-md shadow-lg outline-none" aria-labelledby="headlessui-menu-button-1" id="headlessui-menu-items-117" role="menu">
                            <!--
                            <div class="px-4 py-3">
                                <p class="text-sm leading-5">Signed in as</p>
                                <p class="text-sm font-medium leading-5 text-gray-900 truncate">tom@example.com</p>
                            </div>
                            -->
                            <div class="py-1">
                                <Link :href="'/profile/' + auth.username">
                                <div tabindex="0" class="text-gray-700 flex justify-start w-full px-4 py-2 text-sm leading-5 text-left"  role="menuitem" >
                                    <svg aria-label="Profile" class="mr-3" fill="#262626" height="19" role="img" viewBox="0 0 32 32" width="19">
                                        <path d="M16 0C7.2 0 0 7.1 0 16c0 4.8 2.1 9.1 5.5 12l.3.3C8.5 30.6 12.1 32 16 32s7.5-1.4 10.2-3.7l.3-.3c3.4-3 5.5-7.2 5.5-12 0-8.9-7.2-16-16-16zm0 29c-2.8 0-5.3-.9-7.5-2.4.5-.9.9-1.3 1.4-1.8.7-.5 1.5-.8 2.4-.8h7.2c.9 0 1.7.3 2.4.8.5.4.9.8 1.4 1.8-2 1.5-4.5 2.4-7.3 2.4zm9.7-4.4c-.5-.9-1.1-1.5-1.9-2.1-1.2-.9-2.7-1.4-4.2-1.4h-7.2c-1.5 0-3 .5-4.2 1.4-.8.6-1.4 1.2-1.9 2.1C4.2 22.3 3 19.3 3 16 3 8.8 8.8 3 16 3s13 5.8 13 13c0 3.3-1.2 6.3-3.3 8.6zM16 5.7c-3.9 0-7 3.1-7 7s3.1 7 7 7 7-3.1 7-7-3.1-7-7-7zm0 11c-2.2 0-4-1.8-4-4s1.8-4 4-4 4 1.8 4 4-1.8 4-4 4z"></path>
                                    </svg> <span class="text-sm">Profile</span>
                                </div>
                                </Link>

                                <Link href="">
                                <div tabindex="1" class="text-gray-700 flex w-full px-4 py-2 text-sm leading-5 text-left"  role="menuitem" >
                                    <svg aria-label="Saved" class="mr-3" fill="#262626" height="19" role="img" viewBox="0 0 32 32" width="19">
                                        <path d="M28.7 32c-.4 0-.8-.2-1.1-.4L16 19.9 4.4 31.6c-.4.4-1.1.6-1.6.3-.6-.2-.9-.8-.9-1.4v-29C1.8.7 2.5 0 3.3 0h25.4c.8 0 1.5.7 1.5 1.5v29c0 .6-.4 1.2-.9 1.4-.2.1-.4.1-.6.1zM4.8 3v23.9l9.4-9.4c.9-.9 2.6-.9 3.5 0l9.4 9.4V3H4.8z"></path>
                                    </svg> <span class="text-sm">Saved</span>
                                </div>
                                </Link>

                                <Link href="/settings">
                                    <span role="menuitem" tabindex="-1" class="text-gray-700 flex w-full px-4 py-2 text-sm leading-5 text-left" aria-disabled="true">
                                            <svg aria-label="Settings" class="mr-3 " fill="#262626" height="19" role="img" viewBox="0 0 32 32" width="19">
                                                <path d="M31.2 13.4l-1.4-.7c-.1 0-.2-.1-.2-.2v-.2c-.3-1.1-.7-2.1-1.3-3.1v-.1l-.2-.1v-.3l.5-1.5c.2-.5 0-1.1-.4-1.5l-1.9-1.9c-.4-.4-1-.5-1.5-.4l-1.5.5H23l-.1-.1h-.1c-1-.5-2-1-3.1-1.3h-.2c-.1 0-.1-.1-.2-.2L18.6.9c-.2-.5-.7-.9-1.2-.9h-2.7c-.5 0-1 .3-1.3.8l-.7 1.4c0 .1-.1.2-.2.2h-.2c-1.1.3-2.1.7-3.1 1.3h-.1l-.1.2h-.3l-1.5-.5c-.5-.2-1.1 0-1.5.4L3.8 5.7c-.4.4-.5 1-.4 1.5l.5 1.5v.5c-.5 1-1 2-1.3 3.1v.2c0 .1-.1.1-.2.2l-1.4.7c-.6.2-1 .7-1 1.2v2.7c0 .5.3 1 .8 1.3l1.4.7c.1 0 .2.1.2.2v.2c.3 1.1.7 2.1 1.3 3.1v.1l.2.1v.3l-.5 1.5c-.2.5 0 1.1.4 1.5l1.9 1.9c.3.3.6.4 1 .4.2 0 .3 0 .5-.1l1.5-.5H9l.1.1h.1c1 .5 2 1 3.1 1.3h.2c.1 0 .1.1.2.2l.7 1.4c.2.5.7.8 1.3.8h2.7c.5 0 1-.3 1.3-.8l.7-1.4c0-.1.1-.2.2-.2h.2c1.1-.3 2.1-.7 3.1-1.3h.1l.1-.1h.3l1.5.5c.1 0 .3.1.5.1.4 0 .7-.1 1-.4l1.9-1.9c.4-.4.5-1 .4-1.5l-.5-1.5V23l.1-.1v-.1c.5-1 1-2 1.3-3.1v-.2c0-.1.1-.1.2-.2l1.4-.7c.5-.2.8-.7.8-1.3v-2.7c0-.5-.4-1-.8-1.2zM16 27.1c-6.1 0-11.1-5-11.1-11.1S9.9 4.9 16 4.9s11.1 5 11.1 11.1-5 11.1-11.1 11.1z"></path>
                                            </svg> <span class="text-sm">Settings</span>
                                    </span>
                                </Link>
                            </div>

                            <div class="py-1">
                                <Link href="/logout">
                                    <div tabindex="3" class="text-gray-700 flex justify-between w-full px-4 py-2 text-sm leading-5 text-left"  role="menuitem" >Log Out</div>
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>
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

.dropdown:focus-within .dropdown-menu {
  opacity:1;
  transform: translate(0) scale(1);
  visibility: visible;
}
</style>
