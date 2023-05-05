<script setup>

    const props = defineProps({
        label: {
            type: String,
            default: null
        },
        id : {
            type : Number,
            required: true
        }
    });

    const emit = defineEmits(['optionSelected'])

    function emitOptionSelected(){
        emit('optionSelected', props.id);
    };

</script>

<template>

      <input type="checkbox" :id="id" :value="id" @click.stop="emitOptionSelected()">
      <label v-if="label" :for="id">{{ label }}</label>

</template>

<script>
  // declare the 'optionSelected' event using the 'emits' option
  const emits = ['optionSelected'];
</script>