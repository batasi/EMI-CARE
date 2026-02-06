<!-- resources/js/Pages/Welcome.vue -->
<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import FrontAppLayout from '@/layouts/FrontAppLayout.vue'
import { PlayCircle, Calendar, Clock, MapPin, Users, ArrowRight, ChevronRight } from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Separator } from '@/components/ui/separator'
import { type BreadcrumbItem } from '@/types'
import { computed } from 'vue'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: '/',
    },
];

// Mock data for events
const upcomingEvents = [
    {
        id: 1,
        title: 'Sunday Worship Service',
        date: 'January 14, 2024',
        time: '9:00 AM & 11:00 AM',
        location: 'Main Sanctuary',
        description: 'Join us for powerful worship and biblical teaching',
        category: 'Weekly Service'
    },
    {
        id: 2,
        title: 'Midweek Prayer Night',
        date: 'January 17, 2024',
        time: '6:30 PM - 8:00 PM',
        location: 'Prayer Chapel',
        description: 'Corporate prayer and intercession',
        category: 'Prayer'
    },
    {
        id: 3,
        title: 'Youth Conference 2024',
        date: 'January 20-21, 2024',
        time: '10:00 AM - 4:00 PM',
        location: 'Youth Center',
        description: 'Empowering the next generation',
        category: 'Conference'
    }
]

// Mock data for sermons
const latestSermons = [
    {
        id: 1,
        title: 'The Power of Faith in Difficult Times',
        preacher: 'Pastor John Kamau',
        date: 'January 14, 2024',
        duration: '45 min',
        scripture: 'Hebrews 11:1',
        category: 'Teaching',
        thumbnail: 'https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
    },
    {
        id: 2,
        title: 'Finding Hope in Christ',
        preacher: 'Rev. Sarah Mwangi',
        date: 'January 7, 2024',
        duration: '52 min',
        scripture: 'Jeremiah 29:11',
        category: 'Encouragement',
        thumbnail: 'https://images.unsplash.com/photo-1563492065599-3520f775eeed?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
    },
    {
        id: 3,
        title: 'New Year, New Vision',
        preacher: 'Bishop David Ochieng',
        date: 'December 31, 2023',
        duration: '58 min',
        scripture: 'Proverbs 29:18',
        category: 'Vision',
        thumbnail: 'https://images.unsplash.com/photo-1518834103325-6725c4b54c14?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
    }
]

// Check if live stream is active
const isLive = computed(() => {
    const now = new Date()
    const day = now.getDay() // 0 = Sunday
    const hour = now.getHours()
    return day === 0 && hour >= 8 && hour <= 13 // Sunday 8am-1pm
})
</script>

<template>
    <Head title="Welcome to Empowerment Missions International" />

    <FrontAppLayout :breadcrumbs="breadcrumbs" :is-live="isLive">
        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-br from-primary/5 via-white to-primary/5">
            <div class="absolute inset-0 bg-grid-black/[0.02] bg-[size:20px_20px]" />

            <div class="container relative mx-auto px-4 py-24 lg:py-32">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="space-y-8">
                        <div class="inline-flex items-center rounded-full border border-primary/20 bg-primary/10 px-4 py-2 text-sm font-medium text-primary">
                            <PlayCircle class="mr-2 h-4 w-4" />
                            Join us this Sunday at 9:00 AM & 11:00 AM
                        </div>

                        <h1 class="text-4xl lg:text-6xl font-bold tracking-tight">
                            A Community of
                            <span class="text-primary">Faith</span>,
                            <span class="text-primary">Hope</span> &
                            <span class="text-primary">Love</span>
                        </h1>

                        <p class="text-xl text-muted-foreground">
                            At Empowerment Missions International, we're passionate about helping people
                            discover their God-given purpose and grow in their relationship with Christ.
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <Button as-child size="lg" class="bg-primary hover:bg-primary/90">
                                <Link href="/live" class="flex items-center gap-2">
                                    <PlayCircle class="h-5 w-5" />
                                    Watch Live Stream
                                </Link>
                            </Button>

                            <Button as-child size="lg" variant="outline">
                                <Link href="/service-times" class="flex items-center gap-2">
                                    <Calendar class="h-5 w-5" />
                                    Service Times
                                </Link>
                            </Button>
                        </div>
                    </div>

                    <!-- Right Content - Stats -->
                    <div class="grid grid-cols-2 gap-6">
                        <Card class="border-primary/20 bg-gradient-to-br from-primary/5 to-transparent">
                            <CardHeader class="pb-2">
                                <CardTitle class="text-4xl font-bold text-primary">2</CardTitle>
                                <CardDescription>Sunday Services</CardDescription>
                            </CardHeader>
                        </Card>

                        <Card class="border-primary/20 bg-gradient-to-br from-primary/5 to-transparent">
                            <CardHeader class="pb-2">
                                <CardTitle class="text-4xl font-bold text-primary">15+</CardTitle>
                                <CardDescription>Active Ministries</CardDescription>
                            </CardHeader>
                        </Card>

                        <Card class="border-primary/20 bg-gradient-to-br from-primary/5 to-transparent">
                            <CardHeader class="pb-2">
                                <CardTitle class="text-4xl font-bold text-primary">24/7</CardTitle>
                                <CardDescription>Prayer Line Available</CardDescription>
                            </CardHeader>
                        </Card>

                        <Card class="border-primary/20 bg-gradient-to-br from-primary/5 to-transparent">
                            <CardHeader class="pb-2">
                                <CardTitle class="text-4xl font-bold text-primary">Online</CardTitle>
                                <CardDescription>Global Live Streaming</CardDescription>
                            </CardHeader>
                        </Card>
                    </div>
                </div>
            </div>
        </section>

        <!-- Welcome Section -->
        <section class="py-20">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <img
                            src="https://images.unsplash.com/photo-1563492065599-3520f775eeed?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                            alt="Church community worship"
                            class="rounded-2xl shadow-2xl"
                        />
                    </div>

                    <div class="space-y-6">
                        <div class="inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-medium text-primary">
                            <Users class="mr-2 h-4 w-4" />
                            Welcome Home
                        </div>

                        <h2 class="text-4xl font-bold tracking-tight">
                            You're Welcome Here
                        </h2>

                        <p class="text-lg text-muted-foreground">
                            Whether you're new to faith or have been following Jesus for years,
                            there's a place for you here. We're a diverse community united by
                            our love for God and passion for seeing lives transformed.
                        </p>

                        <Separator />

                        <div class="space-y-4">
                            <div class="flex items-start gap-4">
                                <div class="mt-1 flex h-8 w-8 items-center justify-center rounded-full bg-primary/10">
                                    <CheckIcon class="h-4 w-4 text-primary" />
                                </div>
                                <div>
                                    <h4 class="font-semibold">Biblical Teaching</h4>
                                    <p class="text-sm text-muted-foreground">
                                        Practical, relevant messages from God's Word
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="mt-1 flex h-8 w-8 items-center justify-center rounded-full bg-primary/10">
                                    <CheckIcon class="h-4 w-4 text-primary" />
                                </div>
                                <div>
                                    <h4 class="font-semibold">Authentic Community</h4>
                                    <p class="text-sm text-muted-foreground">
                                        Genuine relationships and support for all ages
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start gap-4">
                                <div class="mt-1 flex h-8 w-8 items-center justify-center rounded-full bg-primary/10">
                                    <CheckIcon class="h-4 w-4 text-primary" />
                                </div>
                                <div>
                                    <h4 class="font-semibold">Purposeful Service</h4>
                                    <p class="text-sm text-muted-foreground">
                                        Opportunities to make a difference in our world
                                    </p>
                                </div>
                            </div>
                        </div>

                        <Button as-child variant="outline" class="mt-4">
                            <Link href="/about" class="flex items-center gap-2">
                                Learn More About Us
                                <ArrowRight class="h-4 w-4" />
                            </Link>
                        </Button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Upcoming Events -->
        <section class="py-20 bg-gradient-to-b from-primary/5 to-transparent">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-medium text-primary mb-4">
                        <Calendar class="mr-2 h-4 w-4" />
                        What's Happening
                    </div>
                    <h2 class="text-4xl font-bold tracking-tight mb-4">Upcoming Events</h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        Join us for worship, teaching, and community gatherings
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <Card v-for="event in upcomingEvents" :key="event.id" class="group hover:shadow-lg transition-all duration-300 border-primary/10">
                        <CardHeader>
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center rounded-full bg-primary/10 px-3 py-1 text-xs font-medium text-primary">
                                    {{ event.category }}
                                </span>
                                <Calendar class="h-5 w-5 text-muted-foreground" />
                            </div>
                            <CardTitle class="group-hover:text-primary transition-colors">
                                {{ event.title }}
                            </CardTitle>
                            <CardDescription>
                                {{ event.description }}
                            </CardDescription>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div class="flex items-center gap-2 text-sm">
                                <Clock class="h-4 w-4 text-muted-foreground" />
                                <span>{{ event.date }} • {{ event.time }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-sm">
                                <MapPin class="h-4 w-4 text-muted-foreground" />
                                <span>{{ event.location }}</span>
                            </div>
                            <Button as-child variant="ghost" class="w-full group/btn">
                                <Link :href="`/events/${event.id}`" class="flex items-center justify-center gap-2">
                                    View Details
                                    <ChevronRight class="h-4 w-4 group-hover/btn:translate-x-1 transition-transform" />
                                </Link>
                            </Button>
                        </CardContent>
                    </Card>
                </div>

                <div class="text-center mt-12">
                    <Button as-child size="lg" class="bg-primary hover:bg-primary/90">
                        <Link href="/events" class="flex items-center gap-2">
                            View All Events
                            <ArrowRight class="h-5 w-5" />
                        </Link>
                    </Button>
                </div>
            </div>
        </section>

        <!-- Latest Sermons -->
        <section class="py-20">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-medium text-primary mb-4">
                        <PlayCircle class="mr-2 h-4 w-4" />
                        Recent Messages
                    </div>
                    <h2 class="text-4xl font-bold tracking-tight mb-4">Latest Sermons</h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        Be inspired by God's Word through our latest teachings
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <Card v-for="sermon in latestSermons" :key="sermon.id" class="group overflow-hidden hover:shadow-xl transition-all duration-300">
                        <div class="aspect-video overflow-hidden">
                            <img
                                :src="sermon.thumbnail"
                                :alt="sermon.title"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent" />
                            <div class="absolute inset-0 flex items-center justify-center">
                                <Button size="icon" class="h-16 w-16 rounded-full bg-white/90 hover:bg-white">
                                    <PlayCircle class="h-8 w-8 text-primary" />
                                </Button>
                            </div>
                        </div>

                        <CardHeader>
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center rounded-full bg-primary/10 px-3 py-1 text-xs font-medium text-primary">
                                    {{ sermon.category }}
                                </span>
                                <span class="text-sm text-muted-foreground">{{ sermon.duration }}</span>
                            </div>
                            <CardTitle class="group-hover:text-primary transition-colors line-clamp-2">
                                {{ sermon.title }}
                            </CardTitle>
                            <CardDescription class="line-clamp-2">
                                {{ sermon.scripture }}
                            </CardDescription>
                        </CardHeader>

                        <CardContent>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center">
                                        <Users class="h-5 w-5 text-primary" />
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">{{ sermon.preacher }}</p>
                                        <p class="text-xs text-muted-foreground">{{ sermon.date }}</p>
                                    </div>
                                </div>
                                <Button as-child size="sm" variant="ghost">
                                    <Link :href="`/sermons/${sermon.id}`" class="flex items-center gap-1">
                                        Listen
                                        <ArrowRight class="h-4 w-4" />
                                    </Link>
                                </Button>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <div class="text-center mt-12">
                    <Button as-child size="lg" variant="outline" class="border-primary/20 hover:bg-primary/5">
                        <Link href="/sermons" class="flex items-center gap-2">
                            Browse All Sermons
                            <ArrowRight class="h-5 w-5" />
                        </Link>
                    </Button>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="py-20 bg-gradient-to-r from-primary/10 via-primary/5 to-primary/10">
            <div class="container mx-auto px-4">
                <div class="text-center">
                    <h2 class="text-4xl font-bold tracking-tight mb-6">
                        Experience God's Presence With Us
                    </h2>
                    <p class="text-xl text-muted-foreground max-w-3xl mx-auto mb-10">
                        Whether you join us in person or online, we'd love to welcome you
                        into our community of faith, hope, and love.
                    </p>

                    <div class="grid md:grid-cols-2 gap-8 max-w-4xl mx-auto mb-12">
                        <Card class="bg-white/50 backdrop-blur-sm border-primary/20">
                            <CardHeader>
                                <CardTitle class="flex items-center gap-3">
                                    <MapPin class="h-6 w-6 text-primary" />
                                    In Person
                                </CardTitle>
                            </CardHeader>
                            <CardContent class="space-y-4">
                                <p class="text-muted-foreground">Join us at our church campus in Nairobi</p>
                                <div class="space-y-2 text-sm">
                                    <div class="flex items-center gap-2">
                                        <MapPin class="h-4 w-4 text-muted-foreground" />
                                        <span>123 Church Street, Nairobi, Kenya</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <Clock class="h-4 w-4 text-muted-foreground" />
                                        <span>Sunday: 9:00 AM & 11:00 AM</span>
                                    </div>
                                </div>
                                <Button as-child variant="outline" class="w-full">
                                    <Link href="/directions" class="flex items-center justify-center gap-2">
                                        <MapPin class="h-4 w-4" />
                                        Get Directions
                                    </Link>
                                </Button>
                            </CardContent>
                        </Card>

                        <Card class="bg-white/50 backdrop-blur-sm border-primary/20">
                            <CardHeader>
                                <CardTitle class="flex items-center gap-3">
                                    <PlayCircle class="h-6 w-6 text-primary" />
                                    Online
                                </CardTitle>
                            </CardHeader>
                            <CardContent class="space-y-4">
                                <p class="text-muted-foreground">Join our live stream from anywhere in the world</p>
                                <div class="space-y-2 text-sm">
                                    <div class="flex items-center gap-2">
                                        <PlayCircle class="h-4 w-4 text-muted-foreground" />
                                        <span>YouTube Live Stream</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <Users class="h-4 w-4 text-muted-foreground" />
                                        <span>Facebook Live</span>
                                    </div>
                                </div>
                                <Button as-child class="w-full bg-primary hover:bg-primary/90">
                                    <Link href="/live" class="flex items-center justify-center gap-2">
                                        <PlayCircle class="h-4 w-4" />
                                        Watch Online Now
                                    </Link>
                                </Button>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </div>
        </section>
    </FrontAppLayout>
</template>

<script lang="ts">
const CheckIcon = {
    template: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6 9 17l-5-5"/></svg>`
}
</script>
