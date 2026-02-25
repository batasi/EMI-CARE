<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

type Props = {
    className?: HTMLAttributes['class'];
    src?: string; // Add src prop for the image
    alt?: string; // Add alt prop for accessibility
};

defineProps<Props>();
</script>

<template>
    <img
        :src="src || '/images/emi.png'"
        :alt="alt || ''"
        :class="className"
        v-bind="$attrs"
    />
</template>
