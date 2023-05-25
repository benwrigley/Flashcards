<script setup>

import ChevronDown from '@/Shared/SVG/ChevronDown.vue';
import MenuDown from '@/Shared/SVG/MenuDown.vue';
import IconButton from '@/Shared/IconButton.vue';
import Home from '@/Shared/SVG/Home.vue';
import Logout from '@/Shared/SVG/Logout.vue';


import { ref} from 'vue';
import { Link } from '@inertiajs/vue3';

const showPanel = ref(false);

</script>

<template>

    <div class="relative">

        <div>
            <!-- Large screen menu -->
            <div
                class="lg:flex items-center hidden lg:visible"
                @mouseover="showPanel = true"
            >
                {{ $page.props.auth.user.name }}
                <ChevronDown width="15" height="15" class="fill-white ml-3 " />
            </div>

            <!-- Mobile drop down -->
            <div
                class="visible lg:hidden"
                @click="showPanel= !showPanel">
                <MenuDown width="20" height="20" class="fill-white ml-3" />
            </div>

            <div
                id="dropdownHover"
                class="z-50 rounded-lg shadow-md mx-auto bg-gray-700 absolute  w-max right-0 text-center p-4 space-x-2 normal-case "
                v-show="showPanel"
                @mouseleave="showPanel = false"
            >
                <div class="grid grid-cols-3 border-b p-2 mb-2">
                    <div class="col-span-2  border-r pr-2 pb-1">Total Flashcards</div>
                    <div>{{ $page.props.auth.user.totalFlashcards }}</div>
                    <div class="col-span-2  border-r pr-2 pb-1">Completed Tests</div>
                    <div>{{ $page.props.auth.user.testsCompleted }}</div>
                    <div class="col-span-2  border-r pr-2">Avg Test Score</div>
                    <div>{{ $page.props.auth.user.averageScore }}%</div>
                </div>
                <div class="space-y-2">

                    <div class="flex place-content-center">
                        <Link :href="route('topics.home')" class="flex items-center">
                            <IconButton tooltip="Main Topics">
                                <Home width="20" height="20"/>
                            </IconButton>
                            <span>Home</span>
                        </Link>
                    </div>

                    <div class="flex place-content-center">
                        <Link :href="route('logout')" class="flex items-center">
                            <IconButton tooltip="Logout">
                                <Logout width="20" height="20"/>
                            </IconButton>
                            <span>Logout</span>
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>


</template>