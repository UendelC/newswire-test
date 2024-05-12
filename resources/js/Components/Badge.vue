<script setup>
import { computed } from 'vue';

const props = defineProps({
    color: {
        type: String,
        required: true,
    },
})

const classes = computed(() => {
    return `px-3 py-2 rounded-md text-white font-medium bg-${props.color}-500`;
})
</script>

<template>
    <span :class="classes">
        <slot />
    </span>
</template>
