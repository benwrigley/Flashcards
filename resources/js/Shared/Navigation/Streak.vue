<template>
    <div class="flex items-center space-x-2">

        <div class="bg-green-600 text-center px-2 rounded-full text-2xl">
            {{ $page.props.auth.user.streak }}
        </div>
        <div class="hidden lg:block">
            Streak Days
        </div>
    </div>
</template>