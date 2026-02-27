<script setup lang="ts">
import { ref, onMounted, onBeforeUnmount } from 'vue'
import AppHeader from '@/components/AppHeader.vue'
import AppShell from '@/components/AppShell.vue'
import Footer from '@/components/Footer.vue'
import type { BreadcrumbItem } from '@/types';

type Props = {
    breadcrumbs?: BreadcrumbItem[];
    isLive?: boolean; // This can be overridden by the page
    showAnnouncement?: boolean;
    footerItems?: any[];
};

const props = withDefaults(defineProps<Props>(), {
    breadcrumbs: () => [],
    isLive: false,
    showAnnouncement: true,
    footerItems: () => []
});

// YouTube API configuration
const YOUTUBE_API_KEY = 'AIzaSyC2DO4xkI5XO7LKWWxDqXneCJ7MvP8L8HA'
const CHANNEL_ID = 'UCqYw-CTd1dU2yGI71sEyqNw'

// Live stream state
const isLive = ref(props.isLive)
const liveViewerCount = ref(0)
const liveTitle = ref('Live Now')

// Check for live streams
const checkLiveStreams = async () => {
    try {
        // Check for ongoing live streams
        const liveResponse = await fetch(
            `https://www.googleapis.com/youtube/v3/search?key=${YOUTUBE_API_KEY}&channelId=${CHANNEL_ID}&eventType=live&type=video&part=snippet`
        )
        const liveData = await liveResponse.json()

        if (liveData.items && liveData.items.length > 0) {
            const liveItem = liveData.items[0]
            isLive.value = true
            liveTitle.value = liveItem.snippet.title

            // Get live stream details for viewer count
            const detailsResponse = await fetch(
                `https://www.googleapis.com/youtube/v3/videos?key=${YOUTUBE_API_KEY}&id=${liveItem.id.videoId}&part=liveStreamingDetails`
            )
            const detailsData = await detailsResponse.json()

            if (detailsData.items && detailsData.items.length > 0) {
                const details = detailsData.items[0].liveStreamingDetails
                liveViewerCount.value = parseInt(details.concurrentViewers || '0')
            }
        } else {
            isLive.value = false
            liveViewerCount.value = 0
            liveTitle.value = 'Live Now'
        }
    } catch (err) {
        console.error('Error checking live streams:', err)
        isLive.value = false
    }
}

// Poll for live status every minute
let interval: ReturnType<typeof setInterval> | null = null

onMounted(() => {
    checkLiveStreams()
    interval = setInterval(checkLiveStreams, 60000) // Check every minute
})

onBeforeUnmount(() => {
    if (interval) {
        clearInterval(interval)
    }
})
</script>

<template>
    <AppShell class="flex-col min-h-screen">
        <AppHeader
            :breadcrumbs="breadcrumbs"
            :is-live="isLive"
            :live-viewer-count="liveViewerCount"
            :live-title="liveTitle"
            :show-announcement="showAnnouncement"
        />

        <main class="flex-1">
            <slot :live-data="{ isLive, liveViewerCount, liveTitle }" />
        </main>

        <Footer :items="footerItems" />
    </AppShell>
</template>
