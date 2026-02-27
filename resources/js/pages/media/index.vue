<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import {
    Youtube, Calendar, Clock, Eye, ThumbsUp,
    Share2, Play, Radio,
    ListVideo, Grid3X3,
    ChevronRight, Sparkles,
    Users, Bell, X,
    Maximize2, Minimize2, Volume2, VolumeX,
    Loader2
} from 'lucide-vue-next'
import { computed, ref, onMounted, nextTick } from 'vue'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import FrontAppLayout from '@/layouts/FrontAppLayout.vue'
import { type BreadcrumbItem } from '@/types'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: '/',
    },
    {
        title: 'Media',
        href: '/media',
    },
]

// YouTube API configuration
const YOUTUBE_API_KEY = 'AIzaSyC2DO4xkI5XO7LKWWxDqXneCJ7MvP8L8HA'
const CHANNEL_ID = 'UC2GiTzYiq67dIioduTtO8QA' // ← REPLACE WITH YOUR ACTUAL CHANNEL ID

// Loading states
const isLoading = ref(true)
const isLoadingMore = ref(false)
const error = ref<string | null>(null)

// YouTube channel info
const youtubeChannel = ref({
    name: 'Empowerment Missions Int.',
    handle: '@EmpowermentMissions',
    url: 'https://www.youtube.com/@EmpowermentMissions',
    channelId: CHANNEL_ID,
    subscriberCount: '0',
    videoCount: '0',
    viewCount: '0',
    description: 'Transforming lives through S.E.E. Empowerment - Socio-spiritual, Economic, and Educational support.',
    thumbnail: '',
    banner: ''
})

// Videos data
const videos = ref<any[]>([])
const nextPageToken = ref<string | null>(null)
const totalResults = ref(0)

// Playlists
const playlists = ref<any[]>([])

// Live stream info
const liveStream = ref({
    isLive: false,
    videoId: null as string | null,
    title: '',
    viewers: 0,
    startedAt: '',
    thumbnail: '',
    scheduledStreams: [] as any[]
})

// Player state
const currentVideo = ref<any>(null)
const player = ref<any>(null)
const isPlayerReady = ref(false)
const isPlaying = ref(false)
const playerVolume = ref(100)
const isMuted = ref(false)
const isFullscreen = ref(false)
const showPlayer = ref(false)
const playerContainer = ref<HTMLElement | null>(null)

// View mode and filters
const viewMode = ref<'grid' | 'list'>('grid')
const sortBy = ref<'latest' | 'popular' | 'oldest'>('latest')
const selectedCategory = ref<string>('all')

// Video categories (you can customize these)
const categories = [
    { id: 'all', name: 'All Videos' },
    { id: 'sermons', name: 'Sermons' },
    { id: 'impact', name: 'Impact Stories' },
    { id: 'health', name: 'Health' },
    { id: 'education', name: 'Education' },
    { id: 'events', name: 'Events' }
]

// Format numbers (e.g., 1200 -> 1.2K)
const formatNumber = (num: number): string => {
    if (num >= 1000000) {
        return (num / 1000000).toFixed(1) + 'M'
    }
    if (num >= 1000) {
        return (num / 1000).toFixed(1) + 'K'
    }
    return num.toString()
}

// Format duration (ISO 8601 to readable format)
const formatDuration = (duration: string): string => {
    const match = duration.match(/PT(\d+H)?(\d+M)?(\d+S)?/)
    if (!match) return '0:00'

    const hours = (match[1] || '').replace('H', '')
    const minutes = (match[2] || '').replace('M', '')
    const seconds = (match[3] || '').replace('S', '')

    let result = ''
    if (hours) {
        result += `${hours}:`
        result += `${minutes.padStart(2, '0')}:`
    } else if (minutes) {
        result += `${minutes}:`
    } else {
        result += '0:'
    }

    result += seconds.padStart(2, '0')
    return result
}

// Format date
const formatDate = (dateString: string): string => {
    const date = new Date(dateString)
    const now = new Date()
    const diffTime = Math.abs(now.getTime() - date.getTime())
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24))

    if (diffDays === 1) return 'Yesterday'
    if (diffDays < 7) return `${diffDays} days ago`
    if (diffDays < 30) return `${Math.floor(diffDays / 7)} weeks ago`
    if (diffDays < 365) return `${Math.floor(diffDays / 30)} months ago`
    return `${Math.floor(diffDays / 365)} years ago`
}

// Fetch channel statistics
const fetchChannelStats = async () => {
    try {
        const response = await fetch(
            `https://www.googleapis.com/youtube/v3/channels?part=snippet,statistics,brandingSettings&id=${CHANNEL_ID}&key=${YOUTUBE_API_KEY}`
        )
        const data = await response.json()

        if (data.items && data.items.length > 0) {
            const channel = data.items[0]
            youtubeChannel.value = {
                ...youtubeChannel.value,
                name: channel.snippet.title,
                description: channel.snippet.description,
                subscriberCount: formatNumber(parseInt(channel.statistics.subscriberCount)),
                videoCount: formatNumber(parseInt(channel.statistics.videoCount)),
                viewCount: formatNumber(parseInt(channel.statistics.viewCount)),
                thumbnail: channel.snippet.thumbnails.high.url,
                banner: channel.brandingSettings?.image?.bannerExternalUrl || ''
            }
        }
    } catch (err) {
        console.error('Error fetching channel stats:', err)
        error.value = 'Failed to load channel information'
    }
}

// Fetch videos
const fetchVideos = async (pageToken: string | null = null) => {
    try {
        const url = `https://www.googleapis.com/youtube/v3/search?key=${YOUTUBE_API_KEY}&channelId=${CHANNEL_ID}&part=snippet,id&order=date&maxResults=12${pageToken ? `&pageToken=${pageToken}` : ''}`

        const response = await fetch(url)
        const data = await response.json()

        // Get video IDs to fetch additional details
        const videoIds = data.items
            .filter((item: any) => item.id.videoId)
            .map((item: any) => item.id.videoId)
            .join(',')

        // Fetch video details (duration, statistics)
        const detailsResponse = await fetch(
            `https://www.googleapis.com/youtube/v3/videos?key=${YOUTUBE_API_KEY}&id=${videoIds}&part=contentDetails,statistics`
        )
        const detailsData = await detailsResponse.json()

        // Create a map of video details
        const detailsMap = new Map()
        detailsData.items.forEach((item: any) => {
            detailsMap.set(item.id, {
                duration: formatDuration(item.contentDetails.duration),
                views: formatNumber(parseInt(item.statistics?.viewCount || '0')),
                likes: formatNumber(parseInt(item.statistics?.likeCount || '0'))
            })
        })

        // Combine search results with details
        const newVideos = data.items
            .filter((item: any) => item.id.videoId)
            .map((item: any) => {
                const details = detailsMap.get(item.id.videoId) || {}
                return {
                    id: item.id.videoId,
                    videoId: item.id.videoId,
                    title: item.snippet.title,
                    description: item.snippet.description,
                    thumbnail: item.snippet.thumbnails.high.url,
                    publishedAt: formatDate(item.snippet.publishedAt),
                    ...details
                }
            })

        if (pageToken) {
            videos.value = [...videos.value, ...newVideos]
        } else {
            videos.value = newVideos
        }

        nextPageToken.value = data.nextPageToken || null
        totalResults.value = data.pageInfo.totalResults
    } catch (err) {
        console.error('Error fetching videos:', err)
        error.value = 'Failed to load videos'
    }
}

// Fetch playlists
const fetchPlaylists = async () => {
    try {
        const response = await fetch(
            `https://www.googleapis.com/youtube/v3/playlists?key=${YOUTUBE_API_KEY}&channelId=${CHANNEL_ID}&part=snippet,contentDetails&maxResults=12`
        )
        const data = await response.json()

        playlists.value = data.items.map((item: any) => ({
            id: item.id,
            playlistId: item.id,
            title: item.snippet.title,
            description: item.snippet.description,
            thumbnail: item.snippet.thumbnails.high.url,
            videoCount: item.contentDetails.itemCount
        }))
    } catch (err) {
        console.error('Error fetching playlists:', err)
    }
}

// Check for live streams
const checkLiveStreams = async () => {
    try {
        // First, check for ongoing live streams
        const liveResponse = await fetch(
            `https://www.googleapis.com/youtube/v3/search?key=${YOUTUBE_API_KEY}&channelId=${CHANNEL_ID}&eventType=live&type=video&part=snippet`
        )
        const liveData = await liveResponse.json()

        if (liveData.items && liveData.items.length > 0) {
            const liveItem = liveData.items[0]
            liveStream.value.isLive = true
            liveStream.value.videoId = liveItem.id.videoId
            liveStream.value.title = liveItem.snippet.title
            liveStream.value.thumbnail = liveItem.snippet.thumbnails.high.url

            // Get live stream details
            const detailsResponse = await fetch(
                `https://www.googleapis.com/youtube/v3/videos?key=${YOUTUBE_API_KEY}&id=${liveItem.id.videoId}&part=liveStreamingDetails`
            )
            const detailsData = await detailsResponse.json()

            if (detailsData.items && detailsData.items.length > 0) {
                const details = detailsData.items[0].liveStreamingDetails
                liveStream.value.viewers = parseInt(details.concurrentViewers || '0')
                liveStream.value.startedAt = formatDate(details.actualStartTime)
            }
        }

        // Get upcoming live streams
        const upcomingResponse = await fetch(
            `https://www.googleapis.com/youtube/v3/search?key=${YOUTUBE_API_KEY}&channelId=${CHANNEL_ID}&eventType=upcoming&type=video&part=snippet&maxResults=6`
        )
        const upcomingData = await upcomingResponse.json()

        liveStream.value.scheduledStreams = upcomingData.items.map((item: any) => ({
            title: item.snippet.title,
            date: new Date(item.snippet.publishedAt).toLocaleString(),
            thumbnail: item.snippet.thumbnails.high.url,
            videoId: item.id.videoId
        }))
    } catch (err) {
        console.error('Error checking live streams:', err)
    }
}

// Load more videos
const loadMoreVideos = async () => {
    if (!nextPageToken.value || isLoadingMore.value) return

    isLoadingMore.value = true
    await fetchVideos(nextPageToken.value)
    isLoadingMore.value = false
}

// Initialize all data
const initializeData = async () => {
    isLoading.value = true
    error.value = null

    try {
        await Promise.all([
            fetchChannelStats(),
            fetchVideos(),
            fetchPlaylists(),
            checkLiveStreams()
        ])
    } catch (err) {
        error.value = 'Failed to load media content'
        console.error(err)
    } finally {
        isLoading.value = false
    }
}

// Computed properties
const featuredVideo = computed(() => {
    return videos.value[0] || null
})

const sortedVideos = computed(() => {
    let sorted = [...videos.value]
    if (sortBy.value === 'popular') {
        return sorted.sort((a, b) => {
            const aViews = parseInt(a.views) || 0
            const bViews = parseInt(b.views) || 0
            return bViews - aViews
        })
    }
    // Latest is default from API
    return sorted
})

const filteredVideos = computed(() => {
    if (selectedCategory.value === 'all') {
        return sortedVideos.value
    }
    // In a real implementation, you'd filter based on video categories/tags
    // For now, just return all
    return sortedVideos.value
})

// Check if live (based on actual data)
const isLive = computed(() => liveStream.value.isLive)

// Player functions
const loadYouTubeAPI = () => {
    return new Promise((resolve) => {
        if (window.YT) {
            resolve(window.YT)
            return
        }

        const tag = document.createElement('script')
        tag.src = 'https://www.youtube.com/iframe_api'
        const firstScriptTag = document.getElementsByTagName('script')[0]
        firstScriptTag.parentNode?.insertBefore(tag, firstScriptTag)

        window.onYouTubeIframeAPIReady = () => {
            resolve(window.YT)
        }
    })
}

const playVideo = async (video: any) => {
    currentVideo.value = video
    showPlayer.value = true

    await nextTick()

    const YT = await loadYouTubeAPI()

    if (player.value) {
        player.value.destroy()
    }

    player.value = new YT.Player('youtube-player', {
        height: '100%',
        width: '100%',
        videoId: video.videoId,
        playerVars: {
            autoplay: 1,
            modestbranding: 1,
            rel: 0,
            showinfo: 0,
            iv_load_policy: 3,
            cc_load_policy: 0,
            fs: 1,
            enablejsapi: 1
        },
        events: {
            onReady: onPlayerReady,
            onStateChange: onPlayerStateChange,
            onError: onPlayerError
        }
    })
}

const onPlayerReady = (event: any) => {
    isPlayerReady.value = true
    if (currentVideo.value) {
        event.target.playVideo()
    }
}

const onPlayerStateChange = (event: any) => {
    isPlaying.value = event.data === 1
}

const onPlayerError = (event: any) => {
    console.error('YouTube player error:', event)
}

const togglePlay = () => {
    if (player.value) {
        if (isPlaying.value) {
            player.value.pauseVideo()
        } else {
            player.value.playVideo()
        }
    }
}

const toggleMute = () => {
    if (player.value) {
        if (isMuted.value) {
            player.value.unMute()
            player.value.setVolume(playerVolume.value)
        } else {
            player.value.mute()
        }
        isMuted.value = !isMuted.value
    }
}

const toggleFullscreen = () => {
    if (!document.fullscreenElement) {
        playerContainer.value?.requestFullscreen()
        isFullscreen.value = true
    } else {
        document.exitFullscreen()
        isFullscreen.value = false
    }
}

const closePlayer = () => {
    if (player.value) {
        player.value.pauseVideo()
        player.value.destroy()
        player.value = null
    }
    showPlayer.value = false
    currentVideo.value = null
    isPlaying.value = false
}

const watchLive = () => {
    if (isLive.value && liveStream.value.videoId) {
        playVideo({
            videoId: liveStream.value.videoId,
            title: liveStream.value.title,
            description: 'Live stream',
            isLive: true
        })
    }
}

const handleSubscribe = () => {
    window.open(youtubeChannel.value.url, '_blank')
}

const watchPlaylist = (playlist: any) => {
    if (playlist.playlistId) {
        window.open(`${youtubeChannel.value.url}/playlist?list=${playlist.playlistId}`, '_blank')
    }
}

// Lifecycle
onMounted(() => {
    initializeData()
})
</script>

<template>
    <Head title="Media - Empowerment Missions Int." />

    <FrontAppLayout :breadcrumbs="breadcrumbs" :is-live="isLive">
        <!-- Loading State -->
        <div v-if="isLoading" class="min-h-[60vh] flex items-center justify-center">
            <div class="text-center">
                <Loader2 class="h-12 w-12 animate-spin text-primary mx-auto mb-4" />
                <p class="text-muted-foreground">Loading media content...</p>
            </div>
        </div>

        <!-- Error State -->
        <div v-else-if="error" class="min-h-[60vh] flex items-center justify-center">
            <div class="text-center max-w-md">
                <div class="text-red-600 text-6xl mb-4">😕</div>
                <h2 class="text-2xl font-bold mb-2">Oops! Something went wrong</h2>
                <p class="text-muted-foreground mb-4">{{ error }}</p>
                <Button @click="initializeData">Try Again</Button>
            </div>
        </div>

        <!-- Main Content -->
        <template v-else>
            <!-- Video Player Modal -->
            <Teleport to="body">
                <div
                    v-if="showPlayer && currentVideo"
                    class="fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4"
                    @click.self="closePlayer"
                >
                    <div class="relative w-full max-w-6xl">
                        <!-- Player Controls -->
                        <div class="absolute -top-12 right-0 flex gap-2 text-white">
                            <button
                                @click="togglePlay"
                                class="p-2 hover:bg-white/20 rounded-lg transition"
                                :title="isPlaying ? 'Pause' : 'Play'"
                            >
                                <Play v-if="!isPlaying" class="h-5 w-5" />
                                <span v-else class="text-sm">⏸️</span>
                            </button>
                            <button
                                @click="toggleMute"
                                class="p-2 hover:bg-white/20 rounded-lg transition"
                                :title="isMuted ? 'Unmute' : 'Mute'"
                            >
                                <VolumeX v-if="isMuted" class="h-5 w-5" />
                                <Volume2 v-else class="h-5 w-5" />
                            </button>
                            <button
                                @click="toggleFullscreen"
                                class="p-2 hover:bg-white/20 rounded-lg transition"
                                :title="isFullscreen ? 'Exit Fullscreen' : 'Fullscreen'"
                            >
                                <Maximize2 v-if="!isFullscreen" class="h-5 w-5" />
                                <Minimize2 v-else class="h-5 w-5" />
                            </button>
                            <button
                                @click="closePlayer"
                                class="p-2 hover:bg-white/20 rounded-lg transition"
                                title="Close"
                            >
                                <X class="h-5 w-5" />
                            </button>
                        </div>

                        <!-- Video Title -->
                        <div class="absolute -top-12 left-0 text-white font-medium truncate max-w-md">
                            {{ currentVideo.title }}
                        </div>

                        <!-- YouTube Player Container -->
                        <div
                            ref="playerContainer"
                            class="relative pt-[56.25%] bg-black rounded-lg overflow-hidden"
                        >
                            <div id="youtube-player" class="absolute top-0 left-0 w-full h-full"></div>
                        </div>

                        <!-- Video Info -->
                        <div v-if="currentVideo && !currentVideo.isLive" class="mt-4 text-white">
                            <div class="flex items-center gap-4 text-sm text-white/80">
                                <span class="flex items-center gap-1">
                                    <Eye class="h-4 w-4" />
                                    {{ currentVideo.views }} views
                                </span>
                                <span class="flex items-center gap-1">
                                    <ThumbsUp class="h-4 w-4" />
                                    {{ currentVideo.likes }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <Clock class="h-4 w-4" />
                                    {{ currentVideo.publishedAt }}
                                </span>
                            </div>
                            <p class="mt-2 text-white/70">{{ currentVideo.description }}</p>
                        </div>

                        <!-- Live Indicator -->
                        <div v-if="currentVideo?.isLive" class="mt-4 flex items-center gap-2">
                            <div class="relative">
                                <div class="w-3 h-3 bg-red-600 rounded-full animate-ping absolute"></div>
                                <div class="w-3 h-3 bg-red-600 rounded-full relative"></div>
                            </div>
                            <span class="text-red-600 font-bold">LIVE</span>
                            <span class="text-white/80 text-sm">{{ liveStream.viewers }} watching</span>
                        </div>
                    </div>
                </div>
            </Teleport>

            <!-- Hero Section -->
            <section class="relative overflow-hidden bg-gradient-to-br from-red-600 via-red-500 to-primary">
                <!-- Background Pattern -->
                <div class="absolute inset-0 bg-grid-white/[0.05] bg-[size:20px_20px]" />

                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full -translate-y-48 translate-x-48 blur-3xl"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-black/10 rounded-full translate-y-48 -translate-x-48 blur-3xl"></div>

                <div class="container relative mx-auto px-4 py-16 lg:py-20">
                    <div class="max-w-4xl mx-auto text-center text-white">

                        <!-- Channel Info -->
                        <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold tracking-tight mb-4">
                            {{ youtubeChannel.name }}
                        </h1>

                        <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                            {{ youtubeChannel.description }}
                        </p>

                        <!-- Channel Stats -->
                        <div class="flex flex-wrap justify-center gap-8 mb-8">
                            <div class="text-center">
                                <div class="text-2xl font-bold">{{ youtubeChannel.subscriberCount }}</div>
                                <div class="text-sm text-white/80">Subscribers</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">{{ youtubeChannel.videoCount }}</div>
                                <div class="text-sm text-white/80">Videos</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold">{{ youtubeChannel.viewCount }}</div>
                                <div class="text-sm text-white/80">Views</div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-wrap justify-center gap-4">
                            <Button
                                size="lg"
                                class="bg-white text-red-600 hover:bg-white/90 hover:text-red-700"
                                @click="handleSubscribe"
                            >
                                <Youtube class="h-5 w-5 mr-2" />
                                Subscribe to Channel
                            </Button>

                            <Button
                                v-if="isLive"
                                size="lg"
                                variant="outline"
                                class="border-white text-white hover:bg-white/20"
                                @click="watchLive"
                            >
                                <Radio class="h-5 w-5 mr-2 animate-pulse" />
                                Watch Live Now
                            </Button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Live Stream Section (if live) -->
            <section v-if="isLive" class="py-8 bg-gradient-to-r from-red-500 to-red-600">
                <div class="container mx-auto px-4">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <div class="w-4 h-4 bg-white rounded-full animate-ping absolute"></div>
                                <div class="w-4 h-4 bg-white rounded-full relative"></div>
                            </div>
                            <div>
                                <span class="text-white font-bold text-lg">LIVE NOW</span>
                                <p class="text-white/90 text-sm">{{ liveStream.title }}</p>
                            </div>
                            <div class="hidden md:flex items-center gap-2 text-white/80 text-sm">
                                <Users class="h-4 w-4" />
                                <span>{{ liveStream.viewers }} watching</span>
                                <Clock class="h-4 w-4 ml-2" />
                                <span>{{ liveStream.startedAt }}</span>
                            </div>
                        </div>
                        <Button
                            size="lg"
                            class="bg-white text-red-600 hover:bg-white/90"
                            @click="watchLive"
                        >
                            <Play class="h-5 w-5 mr-2 fill-current" />
                            Join Live Stream
                        </Button>
                    </div>
                </div>
            </section>

            <!-- Main Content -->
            <section class="py-12 bg-gray-50">
                <div class="container mx-auto px-4">
                    <!-- Featured Video -->
                    <div v-if="featuredVideo" class="mb-12">
                        <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                            <Sparkles class="h-5 w-5 text-primary" />
                            Featured Video
                        </h2>

                        <div class="grid lg:grid-cols-2 gap-8 bg-white rounded-2xl shadow-xl overflow-hidden">
                            <!-- Video Thumbnail -->
                            <div
                                class="relative group cursor-pointer"
                                @click="playVideo(featuredVideo)"
                            >
                                <img
                                    :src="featuredVideo.thumbnail"
                                    :alt="featuredVideo.title"
                                    class="w-full h-[300px] object-cover"
                                />
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <div class="w-20 h-20 bg-white/90 rounded-full flex items-center justify-center">
                                        <Play class="h-10 w-10 text-red-600 ml-1" />
                                    </div>
                                </div>
                                <div class="absolute bottom-4 right-4 bg-black/80 text-white px-2 py-1 rounded text-sm">
                                    {{ featuredVideo.duration }}
                                </div>
                            </div>

                            <!-- Video Info -->
                            <div class="p-8">
                                <h3 class="text-2xl font-bold mb-3">{{ featuredVideo.title }}</h3>
                                <p class="text-muted-foreground mb-4">{{ featuredVideo.description }}</p>

                                <div class="flex items-center gap-4 text-sm text-muted-foreground mb-6">
                                    <span class="flex items-center gap-1">
                                        <Eye class="h-4 w-4" />
                                        {{ featuredVideo.views }} views
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <ThumbsUp class="h-4 w-4" />
                                        {{ featuredVideo.likes }}
                                    </span>
                                    <span class="flex items-center gap-1">
                                        <Clock class="h-4 w-4" />
                                        {{ featuredVideo.publishedAt }}
                                    </span>
                                </div>

                                <div class="flex gap-3">
                                    <Button class="bg-red-600 hover:bg-red-700" @click="playVideo(featuredVideo)">
                                        <Play class="h-4 w-4 mr-2 fill-current" />
                                        Watch Now
                                    </Button>
                                    <Button variant="outline">
                                        <Share2 class="h-4 w-4 mr-2" />
                                        Share
                                    </Button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Controls Bar -->
                    <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                        <!-- Categories -->
                        <div class="flex flex-wrap gap-2">
                            <Button
                                v-for="category in categories"
                                :key="category.id"
                                variant="outline"
                                size="sm"
                                :class="[
                                    'rounded-full',
                                    selectedCategory === category.id ? 'bg-primary text-white border-primary' : ''
                                ]"
                                @click="selectedCategory = category.id"
                            >
                                {{ category.name }}
                            </Button>
                        </div>

                        <!-- View Controls -->
                        <div class="flex items-center gap-4">
                            <!-- Sort -->
                            <select
                                v-model="sortBy"
                                class="px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-primary/20"
                            >
                                <option value="latest">Latest</option>
                                <option value="popular">Most Popular</option>
                            </select>

                            <!-- View Mode Toggle -->
                            <div class="flex border rounded-lg overflow-hidden">
                                <button
                                    @click="viewMode = 'grid'"
                                    :class="[
                                        'p-2',
                                        viewMode === 'grid' ? 'bg-primary text-white' : 'bg-white hover:bg-gray-50'
                                    ]"
                                >
                                    <Grid3X3 class="h-5 w-5" />
                                </button>
                                <button
                                    @click="viewMode = 'list'"
                                    :class="[
                                        'p-2',
                                        viewMode === 'list' ? 'bg-primary text-white' : 'bg-white hover:bg-gray-50'
                                    ]"
                                >
                                    <ListVideo class="h-5 w-5" />
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Videos Grid/List -->
                    <div v-if="filteredVideos.length === 0" class="text-center py-12">
                        <p class="text-muted-foreground">No videos found</p>
                    </div>

                    <template v-else>
                        <!-- Grid View -->
                        <div v-if="viewMode === 'grid'" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div
                                v-for="video in filteredVideos"
                                :key="video.id"
                                class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all overflow-hidden group cursor-pointer"
                                @click="playVideo(video)"
                            >
                                <!-- Thumbnail -->
                                <div class="relative">
                                    <img
                                        :src="video.thumbnail"
                                        :alt="video.title"
                                        class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                    />
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                        <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center">
                                            <Play class="h-8 w-8 text-red-600 ml-1" />
                                        </div>
                                    </div>
                                    <div class="absolute bottom-2 right-2 bg-black/80 text-white px-2 py-1 rounded text-xs">
                                        {{ video.duration }}
                                    </div>
                                </div>

                                <!-- Info -->
                                <div class="p-4">
                                    <h3 class="font-semibold line-clamp-2 mb-2 group-hover:text-primary transition-colors">
                                        {{ video.title }}
                                    </h3>
                                    <p class="text-sm text-muted-foreground line-clamp-2 mb-3">
                                        {{ video.description }}
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-muted-foreground">
                                        <span class="flex items-center gap-1">
                                            <Eye class="h-3 w-3" />
                                            {{ video.views }}
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <ThumbsUp class="h-3 w-3" />
                                            {{ video.likes }}
                                        </span>
                                        <span>{{ video.publishedAt }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- List View -->
                        <div v-else class="space-y-4">
                            <div
                                v-for="video in filteredVideos"
                                :key="video.id"
                                class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all p-4 flex gap-4 group cursor-pointer"
                                @click="playVideo(video)"
                            >
                                <!-- Thumbnail -->
                                <div class="relative w-48 shrink-0">
                                    <img
                                        :src="video.thumbnail"
                                        :alt="video.title"
                                        class="w-full h-28 object-cover rounded-lg group-hover:scale-105 transition-transform duration-300"
                                    />
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                                        <Play class="h-8 w-8 text-white" />
                                    </div>
                                    <div class="absolute bottom-2 right-2 bg-black/80 text-white px-2 py-1 rounded text-xs">
                                        {{ video.duration }}
                                    </div>
                                </div>

                                <!-- Info -->
                                <div class="flex-1">
                                    <h3 class="font-semibold group-hover:text-primary transition-colors mb-2">
                                        {{ video.title }}
                                    </h3>
                                    <p class="text-sm text-muted-foreground line-clamp-2 mb-2">
                                        {{ video.description }}
                                    </p>
                                    <div class="flex items-center gap-4 text-xs text-muted-foreground">
                                        <span class="flex items-center gap-1">
                                            <Eye class="h-3 w-3" />
                                            {{ video.views }} views
                                        </span>
                                        <span class="flex items-center gap-1">
                                            <ThumbsUp class="h-3 w-3" />
                                            {{ video.likes }}
                                        </span>
                                        <span>{{ video.publishedAt }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Load More Button -->
                        <div v-if="nextPageToken" class="text-center mt-8">
                            <Button
                                variant="outline"
                                size="lg"
                                :disabled="isLoadingMore"
                                @click="loadMoreVideos"
                            >
                                <Loader2 v-if="isLoadingMore" class="h-4 w-4 mr-2 animate-spin" />
                                {{ isLoadingMore ? 'Loading...' : 'Load More Videos' }}
                            </Button>
                        </div>
                    </template>
                </div>
            </section>

            <!-- Playlists Section -->
            <section v-if="playlists.length > 0" class="py-12 bg-white">
                <div class="container mx-auto px-4">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold">Video Playlists</h2>
                        <Link :href="`${youtubeChannel.url}/playlists`" target="_blank" class="text-primary hover:underline flex items-center gap-1">
                            View All Playlists
                            <ChevronRight class="h-4 w-4" />
                        </Link>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <Card
                            v-for="playlist in playlists"
                            :key="playlist.id"
                            class="group hover:shadow-xl transition-all cursor-pointer"
                            @click="watchPlaylist(playlist)"
                        >
                            <div class="relative">
                                <img
                                    :src="playlist.thumbnail"
                                    :alt="playlist.title"
                                    class="w-full h-40 object-cover rounded-t-xl group-hover:scale-105 transition-transform duration-300"
                                />
                                <div class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                    <Play class="h-12 w-12 text-white" />
                                </div>
                                <div class="absolute bottom-2 right-2 bg-black/80 text-white px-2 py-1 rounded text-xs flex items-center gap-1">
                                    <ListVideo class="h-3 w-3" />
                                    {{ playlist.videoCount }} videos
                                </div>
                            </div>
                            <CardHeader>
                                <CardTitle class="text-lg">{{ playlist.title }}</CardTitle>
                                <CardDescription>{{ playlist.description }}</CardDescription>
                            </CardHeader>
                        </Card>
                    </div>
                </div>
            </section>

            <!-- Upcoming Live Streams -->
            <section v-if="liveStream.scheduledStreams.length > 0" class="py-12 bg-gray-50">
                <div class="container mx-auto px-4">
                    <div class="flex items-center gap-2 mb-8">
                        <Calendar class="h-6 w-6 text-primary" />
                        <h2 class="text-2xl font-bold">Upcoming Live Streams</h2>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6">
                        <Card v-for="stream in liveStream.scheduledStreams" :key="stream.title" class="hover:shadow-lg transition-all">
                            <CardContent class="p-6">
                                <div class="flex items-start gap-4">
                                    <div class="w-20 h-20 rounded-lg overflow-hidden shrink-0">
                                        <img
                                            :src="stream.thumbnail"
                                            :alt="stream.title"
                                            class="w-full h-full object-cover"
                                        />
                                    </div>
                                    <div>
                                        <h3 class="font-semibold mb-2">{{ stream.title }}</h3>
                                        <p class="text-sm text-muted-foreground flex items-center gap-1">
                                            <Calendar class="h-3 w-3" />
                                            {{ stream.date }}
                                        </p>
                                        <Button
                                            size="sm"
                                            class="mt-3 bg-primary hover:bg-primary/90 text-xs"
                                            @click="playVideo(stream)"
                                        >
                                            <Bell class="h-3 w-3 mr-1" />
                                            Remind Me
                                        </Button>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </section>

            <!-- Subscribe CTA -->
            <section class="py-16 bg-gradient-to-r from-red-600 to-red-500 text-white">
                <div class="container mx-auto px-4 text-center">
                    <Youtube class="h-16 w-16 mx-auto mb-6" />
                    <h2 class="text-3xl font-bold mb-4">Stay Connected With Our Ministry</h2>
                    <p class="text-xl text-white/90 mb-8 max-w-2xl mx-auto">
                        Subscribe to our YouTube channel for weekly messages, impact stories, and live streams.
                    </p>
                    <Button
                        size="lg"
                        class="bg-white text-red-600 hover:bg-white/90 hover:text-red-700 text-lg px-8"
                        @click="handleSubscribe"
                    >
                        <Youtube class="h-5 w-5 mr-2" />
                        Subscribe Now
                    </Button>
                    <p class="text-sm text-white/80 mt-4">
                        {{ youtubeChannel.subscriberCount }} subscribers • New videos every week
                    </p>
                </div>
            </section>
        </template>
    </FrontAppLayout>
</template>

<style scoped>
@keyframes float-slow {
    0%, 100% { transform: translateY(0px) translateX(0px); }
    33% { transform: translateY(-20px) translateX(10px); }
    66% { transform: translateY(10px) translateX(-10px); }
}

@keyframes float-slower {
    0%, 100% { transform: translateY(0px) translateX(0px); }
    25% { transform: translateY(15px) translateX(-15px); }
    75% { transform: translateY(-15px) translateX(15px); }
}

.animate-float-slow {
    animation: float-slow 8s ease-in-out infinite;
}

.animate-float-slower {
    animation: float-slower 12s ease-in-out infinite;
}

.bg-grid-white\/\[0\.05\] {
    background-image: linear-gradient(to right, rgba(255,255,255,0.05) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255,255,255,0.05) 1px, transparent 1px);
    background-size: 20px 20px;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
