<script setup lang="ts">
import FrontAppLayout from '@/layouts/app/AppHeaderLayout.vue';
import type { BreadcrumbItem } from '@/types';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
});
</script>

<template>
    <FrontAppLayout :breadcrumbs="breadcrumbs">
        <slot />
    </FrontAppLayout>
</template>
