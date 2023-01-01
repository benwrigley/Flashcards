
<div x-data="{ show:true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        class="text-white fixed bottom-10 right-10 bg-blue-500 p-5 rounded-2xl">
    <p>{{ $slot }} </p>
</div>

