<script setup lang="ts">
import AppHeader from '@/components/AppHeader.vue'
import AppShell from '@/components/AppShell.vue'
import Footer from '@/components/Footer.vue'
import type { BreadcrumbItem } from '@/types';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
    isLive?: boolean;
    showAnnouncement?: boolean;
    footerItems?: any[];
};

withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
    isLive: false,
    showAnnouncement: true,
    footerItems: () => []
});
</script>

<template>
    <AppShell class="flex-col min-h-screen">
        <AppHeader
            :breadcrumbs="breadcrumbs"
            :is-live="isLive"
            :show-announcement="showAnnouncement"
        />

        <main class="flex-1">
            <slot />
        </main>

        <Footer :items="footerItems" />
    </AppShell>
</template>
