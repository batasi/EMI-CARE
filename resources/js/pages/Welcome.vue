<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { PlayCircle, Calendar, Clock, MapPin, Users, ArrowRight, ChevronRight, Heart, BookOpen, Globe, Phone } from 'lucide-vue-next'
import { computed } from 'vue'
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

// Quick action cards
const quickActions = [
    {
        title: 'Give Online',
        description: 'Support our ministries and missions',
        icon: Heart,
        href: '/give',
        color: 'text-red-500',
        bgColor: 'bg-red-50'
    },
    {
        title: 'Prayer Request',
        description: 'Submit your prayer needs',
        icon: Users,
        href: '/prayer-request',
        color: 'text-blue-500',
        bgColor: 'bg-blue-50'
    },
    {
        title: 'Read Bible',
        description: 'Daily Bible reading plan',
        icon: BookOpen,
        href: '/bible',
        color: 'text-green-500',
        bgColor: 'bg-green-50'
    },
    {
        title: 'Connect Online',
        description: 'Join our online community',
        icon: Globe,
        href: '/connect',
        color: 'text-purple-500',
        bgColor: 'bg-purple-50'
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
        <!-- Hero Section - No Video -->
        <section class="relative overflow-hidden bg-gradient-to-br from-primary/5 via-white to-primary/10">
            <div class="absolute inset-0 bg-grid-black/[0.02] bg-[size:20px_20px]" />

            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-72 h-72 bg-primary/5 rounded-full -translate-y-36 translate-x-36" />
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary/5 rounded-full translate-y-48 -translate-x-48" />

            <div class="container relative mx-auto px-4 py-16 lg:py-24">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="space-y-8">
                        <div class="inline-flex items-center rounded-full border border-primary/20 bg-primary/10 px-4 py-2 text-sm font-medium text-primary">
                            <PlayCircle class="mr-2 h-4 w-4" />
                            Join us this Sunday at 9:00 AM & 11:00 AM
                        </div>

                        <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold tracking-tight leading-tight">
                            Welcome to
                            <span class="text-primary">Empowerment Missions</span>
                        </h1>

                        <p class="text-xl text-muted-foreground">
                            A vibrant community of faith where lives are transformed through the power of God's Word.
                            Join us as we worship, grow, and serve together.
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

                            <Button as-child size="lg" variant="ghost">
                                <Link href="/about" class="flex items-center gap-2">
                                    <Users class="h-5 w-5" />
                                    Our Story
                                </Link>
                            </Button>
                        </div>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">2</div>
                                <div class="text-sm text-muted-foreground">Sunday Services</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">15+</div>
                                <div class="text-sm text-muted-foreground">Ministries</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">24/7</div>
                                <div class="text-sm text-muted-foreground">Prayer Line</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">All</div>
                                <div class="text-sm text-muted-foreground">Ages Welcome</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Quick Actions -->
                    <div class="grid grid-cols-2 gap-6">
                        <Card
                            v-for="action in quickActions"
                            :key="action.title"
                            class="group hover:shadow-lg transition-all duration-300 border-primary/10 hover:border-primary/30 cursor-pointer"
                            @click="$inertia.visit(action.href)"
                        >
                            <CardHeader class="pb-3">
                                <div class="flex items-center justify-between">
                                    <div :class="[action.bgColor, 'p-3 rounded-lg']">
                                        <component :is="action.icon" :class="[action.color, 'h-6 w-6']" />
                                    </div>
                                    <ArrowRight class="h-4 w-4 text-muted-foreground group-hover:text-primary transition-colors" />
                                </div>
                                <CardTitle class="mt-4 group-hover:text-primary transition-colors">
                                    {{ action.title }}
                                </CardTitle>
                            </CardHeader>
                            <CardContent>
                                <p class="text-sm text-muted-foreground">
                                    {{ action.description }}
                                </p>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </div>
        </section>

        <!-- Welcome Section -->
        <section class="py-16 lg:py-20">
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

                        <h2 class="text-3xl lg:text-4xl font-bold tracking-tight">
                            A Place to Belong, Believe & Become
                        </h2>

                        <p class="text-lg text-muted-foreground">
                            At Empowerment Missions International, we're passionate about helping people
                            discover their God-given purpose and grow in their relationship with Christ.
                            Whether you're new to faith or have been following Jesus for years,
                            there's a place for you here.
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
        <section class="py-16 lg:py-20 bg-gradient-to-b from-primary/5 to-transparent">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-medium text-primary mb-4">
                        <Calendar class="mr-2 h-4 w-4" />
                        What's Happening
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">Upcoming Events</h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        Join us for worship, teaching, and community gatherings
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
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
        <section class="py-16 lg:py-20">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-medium text-primary mb-4">
                        <PlayCircle class="mr-2 h-4 w-4" />
                        Recent Messages
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">Latest Sermons</h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        Be inspired by God's Word through our latest teachings
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                    <Card v-for="sermon in latestSermons" :key="sermon.id" class="group overflow-hidden hover:shadow-xl transition-all duration-300">
                        <div class="aspect-video overflow-hidden relative">
                            <img
                                :src="sermon.thumbnail"
                                :alt="sermon.title"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent" />
                            <div class="absolute bottom-4 left-4">
                                <span class="inline-flex items-center rounded-full bg-white/90 px-3 py-1 text-xs font-medium text-primary">
                                    {{ sermon.duration }}
                                </span>
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <Button size="icon" class="h-14 w-14 rounded-full bg-white hover:bg-white">
                                    <PlayCircle class="h-7 w-7 text-primary" />
                                </Button>
                            </div>
                        </div>

                        <CardHeader class="pb-3">
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center rounded-full bg-primary/10 px-3 py-1 text-xs font-medium text-primary">
                                    {{ sermon.category }}
                                </span>
                                <span class="text-sm text-muted-foreground">{{ sermon.date }}</span>
                            </div>
                            <CardTitle class="group-hover:text-primary transition-colors line-clamp-2">
                                {{ sermon.title }}
                            </CardTitle>
                            <CardDescription class="line-clamp-2">
                                {{ sermon.scripture }}
                            </CardDescription>
                        </CardHeader>

                        <CardContent class="pt-0">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center">
                                        <Users class="h-5 w-5 text-primary" />
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium">{{ sermon.preacher }}</p>
                                        <p class="text-xs text-muted-foreground">Preacher</p>
                                    </div>
                                </div>
                                <Button as-child size="sm" variant="ghost" class="group/btn">
                                    <Link :href="`/sermons/${sermon.id}`" class="flex items-center gap-1">
                                        Listen
                                        <ArrowRight class="h-4 w-4 group-hover/btn:translate-x-1 transition-transform" />
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

        <!-- Contact & Location -->
        <section class="py-16 lg:py-20 bg-gradient-to-r from-primary/10 via-primary/5 to-primary/10">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="lg:col-span-2">
                        <div class="space-y-6">
                            <div class="inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-medium text-primary">
                                <MapPin class="mr-2 h-4 w-4" />
                                Visit Us
                            </div>
                            <h2 class="text-3xl lg:text-4xl font-bold tracking-tight">
                                Join Us This Sunday
                            </h2>
                            <p class="text-lg text-muted-foreground">
                                We'd love to welcome you to our church family. Come as you are and experience
                                God's love in a warm, welcoming community.
                            </p>

                            <div class="grid sm:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <h4 class="font-semibold flex items-center gap-2">
                                        <Clock class="h-5 w-5 text-primary" />
                                        Service Times
                                    </h4>
                                    <ul class="space-y-2 text-sm text-muted-foreground">
                                        <li class="flex justify-between">
                                            <span>Sunday Morning</span>
                                            <span class="font-medium">9:00 AM</span>
                                        </li>
                                        <li class="flex justify-between">
                                            <span>Sunday Mid-Morning</span>
                                            <span class="font-medium">11:00 AM</span>
                                        </li>
                                        <li class="flex justify-between">
                                            <span>Wednesday Prayer</span>
                                            <span class="font-medium">6:30 PM</span>
                                        </li>
                                    </ul>
                                </div>

                                <div class="space-y-3">
                                    <h4 class="font-semibold flex items-center gap-2">
                                        <Phone class="h-5 w-5 text-primary" />
                                        Contact Info
                                    </h4>
                                    <ul class="space-y-2 text-sm text-muted-foreground">
                                        <li>123 Church Street, Nairobi</li>
                                        <li>+254 712 345 678</li>
                                        <li>info@empowermentmissions.org</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-4">
                                <Button as-child class="bg-primary hover:bg-primary/90">
                                    <Link href="/directions" class="flex items-center gap-2">
                                        <MapPin class="h-4 w-4" />
                                        Get Directions
                                    </Link>
                                </Button>
                                <Button as-child variant="outline">
                                    <Link href="/contact" class="flex items-center gap-2">
                                        <Phone class="h-4 w-4" />
                                        Contact Us
                                    </Link>
                                </Button>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-primary/10">
                        <h3 class="text-xl font-bold mb-4">First Time Visitor?</h3>
                        <p class="text-muted-foreground mb-6">
                            We know visiting a new church can be intimidating. Let us help make your first visit comfortable.
                        </p>
                        <ul class="space-y-4 mb-6">
                            <li class="flex items-start gap-3">
                                <div class="h-6 w-6 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <CheckIcon class="h-3 w-3 text-primary" />
                                </div>
                                <span class="text-sm">Free parking available</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="h-6 w-6 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <CheckIcon class="h-3 w-3 text-primary" />
                                </div>
                                <span class="text-sm">Children's ministry available</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="h-6 w-6 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <CheckIcon class="h-3 w-3 text-primary" />
                                </div>
                                <span class="text-sm">Casual dress code</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="h-6 w-6 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <CheckIcon class="h-3 w-3 text-primary" />
                                </div>
                                <span class="text-sm">Visitor's reception after service</span>
                            </li>
                        </ul>
                        <Button as-child variant="outline" class="w-full">
                            <Link href="/first-time" class="flex items-center justify-center gap-2">
                                Plan Your Visit
                                <ArrowRight class="h-4 w-4" />
                            </Link>
                        </Button>
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
