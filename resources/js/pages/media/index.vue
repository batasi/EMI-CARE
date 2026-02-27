<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import {
    Youtube, Calendar, Clock, Eye, ThumbsUp,
    MessageCircle, Share2, Play, Radio,
    Film, ListVideo, Grid3X3, Grid2X2,
    ChevronLeft, ChevronRight, Sparkles,
    Tv2, Users, Globe, Bell
} from 'lucide-vue-next'
import { computed, ref, onMounted, onBeforeUnmount } from 'vue'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Separator } from '@/components/ui/separator'
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

// YouTube channel info
const youtubeChannel = {
    name: 'Empowerment Missions Int.',
    handle: '@EmpowermentMissions',
    url: 'https://www.youtube.com/@EmpowermentMissions',
    subscriberCount: '1.2K',
    videoCount: '45+',
    viewCount: '50K+',
    description: 'Transforming lives through S.E.E. Empowerment - Socio-spiritual, Economic, and Educational support.'
}

// Check if live stream is active
const isLive = computed(() => {
    const now = new Date()
    const day = now.getDay()
    const hour = now.getHours()
    // Example: Live every Sunday 9am-12pm (you can adjust this)
    return day === 0 && hour >= 9 && hour <= 12
})

// Mock YouTube videos data (replace with actual YouTube API data later)
const videos = ref([
    {
        id: 'vid1',
        title: 'Empowerment Missions Impact Story: Transforming Lives Through Education',
        thumbnail: 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        duration: '12:34',
        views: '2.5K',
        likes: '245',
        publishedAt: '2 days ago',
        description: 'See how our educational programs are changing lives in Kenya and the UK.',
        isLive: false
    },
    {
        id: 'vid2',
        title: 'Sunday Service Live - Empowerment Missions International',
        thumbnail: 'https://images.unsplash.com/photo-1438232992991-995b7058bbb3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        duration: '1:45:22',
        views: '1.8K',
        likes: '156',
        publishedAt: '5 days ago',
        description: 'Join us for our weekly Sunday service with Pastor Duke Randolph.',
        isLive: false
    },
    {
        id: 'vid3',
        title: 'EMI-Care UK: Health Outreach Program in Reading',
        thumbnail: 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        duration: '8:15',
        views: '3.2K',
        likes: '312',
        publishedAt: '1 week ago',
        description: 'Our health team providing free consultations and wellness checks.',
        isLive: false
    },
    {
        id: 'vid4',
        title: 'Community Empowerment: Skills Training Program',
        thumbnail: 'https://images.unsplash.com/photo-1524178232363-1fb2b075b655?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        duration: '15:45',
        views: '1.2K',
        likes: '98',
        publishedAt: '2 weeks ago',
        description: 'Vocational training helping community members gain valuable skills.',
        isLive: false
    },
    {
        id: 'vid5',
        title: 'Partnership Spotlight: Working Together for Change',
        thumbnail: 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        duration: '10:22',
        views: '890',
        likes: '67',
        publishedAt: '3 weeks ago',
        description: 'Highlighting our corporate partners and their impact.',
        isLive: false
    },
    {
        id: 'vid6',
        title: 'Student Testimonials: How Sponsorship Changed My Life',
        thumbnail: 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        duration: '7:18',
        views: '4.1K',
        likes: '423',
        publishedAt: '1 month ago',
        description: 'Hear directly from students whose lives have been transformed.',
        isLive: false
    }
])

// Playlists
const playlists = ref([
    {
        id: 'play1',
        title: 'Sunday Services',
        videoCount: 12,
        thumbnail: 'https://images.unsplash.com/photo-1438232992991-995b7058bbb3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        description: 'Weekly messages and worship services'
    },
    {
        id: 'play2',
        title: 'Impact Stories',
        videoCount: 8,
        thumbnail: 'https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        description: 'Testimonials and transformation stories'
    },
    {
        id: 'play3',
        title: 'Health & Wellness',
        videoCount: 6,
        thumbnail: 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        description: 'Health tips and program updates'
    },
    {
        id: 'play4',
        title: 'Community Events',
        videoCount: 10,
        thumbnail: 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
        description: 'Outreach programs and community gatherings'
    }
])

// Live stream info (mock data)
const liveStream = ref({
    isLive: true,
    title: 'Sunday Service Live - Empowerment Missions',
    viewers: 234,
    startedAt: '1 hour ago',
    thumbnail: 'https://images.unsplash.com/photo-1438232992991-995b7058bbb3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80',
    scheduledStreams: [
        {
            title: 'Wednesday Bible Study',
            date: 'Tomorrow, 7:00 PM',
            thumbnail: 'https://images.unsplash.com/photo-1504052434569-70ad5836ab65?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'
        },
        {
            title: 'Community Prayer Meeting',
            date: 'Friday, 6:00 PM',
            thumbnail: 'https://images.unsplash.com/photo-1529070538774-1843cb3265df?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'
        },
        {
            title: 'Sunday Service',
            date: 'Sunday, 10:00 AM',
            thumbnail: 'https://images.unsplash.com/photo-1544427920-c49ccfb85579?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80'
        }
    ]
})

// View mode (grid or list)
const viewMode = ref<'grid' | 'list'>('grid')

// Filter and sort
const sortBy = ref<'latest' | 'popular' | 'oldest'>('latest')
const selectedCategory = ref<string>('all')

// Video categories
const categories = [
    { id: 'all', name: 'All Videos' },
    { id: 'sermons', name: 'Sermons' },
    { id: 'impact', name: 'Impact Stories' },
    { id: 'health', name: 'Health' },
    { id: 'education', name: 'Education' },
    { id: 'events', name: 'Events' }
]

// Featured video (latest or most important)
const featuredVideo = computed(() => {
    return videos.value[0]
})

// Sort videos based on selection
const sortedVideos = computed(() => {
    let sorted = [...videos.value]
    if (sortBy.value === 'latest') {
        return sorted // Assuming original order is latest first
    } else if (sortBy.value === 'popular') {
        return sorted.sort((a, b) => parseInt(b.views) - parseInt(a.views))
    } else if (sortBy.value === 'oldest') {
        return sorted.reverse()
    }
    return sorted
})

// Filtered videos (by category)
const filteredVideos = computed(() => {
    if (selectedCategory.value === 'all') {
        return sortedVideos.value
    }
    // In a real implementation, you'd filter based on actual categories
    return sortedVideos.value
})

// Subscribe handler
const handleSubscribe = () => {
    window.open(youtubeChannel.url, '_blank')
}

// Watch live handler
const watchLive = () => {
    window.open(`${youtubeChannel.url}/live`, '_blank')
}
</script>

<template>
    <Head title="Media - Empowerment Missions Int." />

    <FrontAppLayout :breadcrumbs="breadcrumbs" :is-live="isLive">
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
                    <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium mb-6">
                        <Youtube class="h-4 w-4" />
                        <span>YouTube Channel</span>
                    </div>

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
                <div class="mb-12">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
                        <Sparkles class="h-5 w-5 text-primary" />
                        Featured Video
                    </h2>

                    <div class="grid lg:grid-cols-2 gap-8 bg-white rounded-2xl shadow-xl overflow-hidden">
                        <!-- Video Thumbnail -->
                        <div class="relative group cursor-pointer" @click="watchLive">
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
                                <Button class="bg-red-600 hover:bg-red-700" @click="watchLive">
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
                            <option value="oldest">Oldest</option>
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
                <div v-if="viewMode === 'grid'" class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div
                        v-for="video in filteredVideos"
                        :key="video.id"
                        class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all overflow-hidden group cursor-pointer"
                        @click="watchLive"
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
                            <div v-if="video.isLive" class="absolute top-2 left-2 bg-red-600 text-white px-2 py-1 rounded text-xs flex items-center gap-1">
                                <Radio class="h-3 w-3 animate-pulse" />
                                LIVE
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
                        @click="watchLive"
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
                <div class="text-center mt-8">
                    <Button variant="outline" size="lg">
                        Load More Videos
                    </Button>
                </div>
            </div>
        </section>

        <!-- Playlists Section -->
        <section class="py-12 bg-white">
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
                        @click="watchLive"
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
        <section class="py-12 bg-gray-50">
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
                                        @click="watchLive"
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
