<script setup>
import { ref,watch } from 'vue';

const props = defineProps({
  score : {
    type: Number,
    default:0
  }
});

const streakClasses = ref('bg-green-600');

watch(
  () => props.score,
  (newValue, oldValue) => {
    pulse();
  }
);

function pulse() {
  streakClasses.value = 'bg-red-500 scale-150';
  setTimeout(() => {
    streakClasses.value = 'bg-green-600 scale-200';
  }, 1000);
}
</script>


<style>
.streak {
  transition-property: background-color, transform;
  transition-duration: 300ms;
  transition-timing-function: ease;
}
</style>


<template>
    <div class="flex items-center space-x-2">

        <div class="text-center px-2 rounded-full text-2xl"
            :class="[streakClasses, 'streak']">
            {{ score }}
        </div>
        <div class="hidden lg:block">
            Streak Days
        </div>
    </div>
</template>