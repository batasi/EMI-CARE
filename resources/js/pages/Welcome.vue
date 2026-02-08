<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { Heart, BookOpen, Globe, Phone, MapPin, Users, Calendar, Clock, Shield, GraduationCap, HandHeart, Building, ArrowRight, ChevronRight } from 'lucide-vue-next'
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

// Charity information based on provided data
const charityInfo = {
    name: 'Empowerment Missions International',
    charityNumber: '1141696',
    companyNumber: '05893970',
    tagline: 'Empowering People - Socio-spiritually, Economically & Educationally',
    description: 'A UK registered charity empowering communities through faith-based initiatives, education support, and economic development in the UK and Africa.',
    address: '65 Fairwater Drive, Woodley, Reading, RG5 3JG',
    phone: '07727208820',
    email: 'enquiry@empowermentmissions.org.uk',
    website: 'www.empowermentmissions.org.uk',
    areas: ['Bedford', 'Reading', 'Kenya']
}

// The S.E.E. Model pillars
const seeModel = [
    {
        title: 'Socio-Spiritual',
        description: 'Spiritual growth through prayer, worship, and community support',
        icon: Users,
        color: 'text-blue-500',
        bgColor: 'bg-blue-50'
    },
    {
        title: 'Economic',
        description: 'Poverty relief through grants, donations, and economic empowerment',
        icon: HandHeart,
        color: 'text-green-500',
        bgColor: 'bg-green-50'
    },
    {
        title: 'Educational',
        description: 'Education advancement through school fees, training, and materials',
        icon: GraduationCap,
        color: 'text-purple-500',
        bgColor: 'bg-purple-50'
    }
]

// Main activities of the charity
const mainActivities = [
    {
        title: 'Grant Making',
        description: 'Providing grants for school fees and educational support',
        icon: Shield
    },
    {
        title: 'Healthcare Support',
        description: 'Supporting EMI-Care UK for health and social care services',
        icon: Heart
    },
    {
        title: 'Spiritual Education',
        description: 'Teaching through Duke Randolph Ministries and Gospel outreach',
        icon: BookOpen
    },
    {
        title: 'Community Development',
        description: 'Empowering communities in the UK and Africa',
        icon: Building
    }
]

// Upcoming events - updated to reflect charity activities
const upcomingEvents = [
    {
        id: 1,
        title: 'Community Prayer Gathering',
        date: 'January 14, 2024',
        time: '10:00 AM - 12:00 PM',
        location: 'Reading Community Centre',
        description: 'Monthly prayer gathering for community needs and spiritual growth',
        category: 'Spiritual'
    },
    {
        id: 2,
        title: 'Educational Grant Workshop',
        date: 'January 20, 2024',
        time: '2:00 PM - 4:00 PM',
        location: 'Online Zoom Meeting',
        description: 'Information session on applying for educational grants and support',
        category: 'Education'
    },
    {
        id: 3,
        title: 'Charity Trustees Meeting',
        date: 'January 25, 2024',
        time: '6:30 PM - 8:30 PM',
        location: 'Bedford Office',
        description: 'Monthly trustees meeting for strategic planning and review',
        category: 'Administrative'
    }
]

// Latest updates/news
const latestUpdates = [
    {
        id: 1,
        title: 'New Partnership with Local Schools',
        description: 'Expanding our educational support program to 5 more schools in Kenya',
        date: 'December 15, 2023',
        category: 'Education',
        readTime: '3 min'
    },
    {
        id: 2,
        title: 'Winter Relief Program Launched',
        description: 'Providing warm clothing and food packages to families in need',
        date: 'November 30, 2023',
        category: 'Relief',
        readTime: '4 min'
    },
    {
        id: 3,
        title: 'Annual Report 2023 Published',
        description: 'Review our achievements and financial transparency for 2023',
        date: 'November 15, 2023',
        category: 'Report',
        readTime: '5 min'
    }
]

// Quick action cards
const quickActions = [
    {
        title: 'Make a Donation',
        description: 'Support our empowerment programs and relief efforts',
        icon: Heart,
        href: '/donate',
        color: 'text-red-500',
        bgColor: 'bg-red-50'
    },
    {
        title: 'Request Support',
        description: 'Apply for grants or request assistance',
        icon: HandHeart,
        href: '/support',
        color: 'text-blue-500',
        bgColor: 'bg-blue-50'
    },
    {
        title: 'Volunteer',
        description: 'Join our team and make a difference',
        icon: Users,
        href: '/volunteer',
        color: 'text-green-500',
        bgColor: 'bg-green-50'
    },
    {
        title: 'Prayer Request',
        description: 'Share your prayer needs with us',
        icon: BookOpen,
        href: '/prayer-request',
        color: 'text-purple-500',
        bgColor: 'bg-purple-50'
    }
]

// Check if live stream is active
const isLive = computed(() => {
    const now = new Date()
    const day = now.getDay() // 0 = Sunday
    const hour = now.getHours()
    return day === 0 && hour >= 9 && hour <= 12 // Sunday 9am-12pm
})
</script>

<template>
    <Head title="Welcome to Empowerment Missions International" />

    <FrontAppLayout :breadcrumbs="breadcrumbs" :is-live="isLive">
        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-white to-primary/10">
            <div class="absolute inset-0 bg-grid-black/[0.02] bg-[size:20px_20px]" />

            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-72 h-72 bg-primary/5 rounded-full -translate-y-36 translate-x-36" />
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-50 rounded-full translate-y-48 -translate-x-48" />

            <div class="container relative mx-auto px-4 py-16 ">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="space-y-8">


                        <h1 class="text-4xl lg:text-5xl xl:text-5xl font-bold tracking-tight leading-tight">
                            Empowering Communities
                            <span class="text-primary block">Through Faith & Action</span>
                        </h1>

                        <p class="text-xl text-muted-foreground">
                            {{ charityInfo.description }}
                            We transform lives through our S.E.E. model - empowering people Socio-spiritually,
                            Economically, and Educationally.
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <Button as-child size="lg" class="bg-primary hover:bg-primary/90">
                                <Link href="/donate" class="flex items-center gap-2">
                                    <Heart class="h-5 w-5" />
                                    Support Our Mission
                                </Link>
                            </Button>

                            <Button as-child size="lg" variant="outline">
                                <Link href="/about" class="flex items-center gap-2">
                                    <Users class="h-5 w-5" />
                                    Our S.E.E. Model
                                </Link>
                            </Button>
                        </div>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">2011</div>
                                <div class="text-sm text-muted-foreground">Founded</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">UK & Africa</div>
                                <div class="text-sm text-muted-foreground">Areas of Operation</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">S.E.E.</div>
                                <div class="text-sm text-muted-foreground">Empowerment Model</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">2</div>
                                <div class="text-sm text-muted-foreground">Trustees</div>
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

        <!-- S.E.E. Model Section -->
        <section class="py-16 lg:py-20">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-medium text-primary mb-4">
                        <Shield class="mr-2 h-4 w-4" />
                        Our Empowerment Model
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">The S.E.E. Approach</h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        We empower communities through three interconnected pillars of transformation
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div
                        v-for="pillar in seeModel"
                        :key="pillar.title"
                        class="group text-center p-8 rounded-2xl border border-gray-200 hover:border-primary/30 hover:shadow-lg transition-all duration-300"
                    >
                        <div :class="[pillar.bgColor, 'inline-flex p-4 rounded-xl mb-6']">
                            <component :is="pillar.icon" :class="[pillar.color, 'h-8 w-8']" />
                        </div>
                        <h3 class="text-xl font-bold mb-3">{{ pillar.title }}</h3>
                        <p class="text-muted-foreground mb-6">
                            {{ pillar.description }}
                        </p>
                        <div class="h-1 w-12 bg-primary mx-auto opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About & Activities Section -->
        <section class="py-16 lg:py-20 bg-gradient-to-b from-blue-50 to-transparent">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <img
                            src="https://images.unsplash.com/photo-1577896851231-70ef18881754?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                            alt="Community empowerment and support"
                            class="rounded-2xl shadow-2xl"
                        />
                    </div>

                    <div class="space-y-6">
                        <div class="inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-medium text-primary">
                            <Building class="mr-2 h-4 w-4" />
                            Our Charitable Activities
                        </div>

                        <h2 class="text-3xl lg:text-4xl font-bold tracking-tight">
                            Making a Difference Across Communities
                        </h2>

                        <p class="text-lg text-muted-foreground">
                            As a UK registered charity (No: 1141696), we're committed to transforming lives
                            through faith-based initiatives, educational support, and economic empowerment
                            in the UK and Africa.
                        </p>

                        <Separator />

                        <div class="space-y-4">
                            <div
                                v-for="activity in mainActivities"
                                :key="activity.title"
                                class="flex items-start gap-4"
                            >
                                <div class="mt-1 flex h-10 w-10 items-center justify-center rounded-full bg-primary/10 flex-shrink-0">
                                    <component :is="activity.icon" class="h-5 w-5 text-primary" />
                                </div>
                                <div>
                                    <h4 class="font-semibold">{{ activity.title }}</h4>
                                    <p class="text-sm text-muted-foreground">
                                        {{ activity.description }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <Button as-child variant="outline" class="mt-4">
                            <Link href="/about" class="flex items-center gap-2">
                                Learn About Our Work
                                <ArrowRight class="h-4 w-4" />
                            </Link>
                        </Button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Latest Updates -->
        <section class="py-16 lg:py-20">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-medium text-primary mb-4">
                        <Calendar class="mr-2 h-4 w-4" />
                        Latest Updates
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">News & Updates</h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        Stay informed about our latest projects, achievements, and community initiatives
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                    <Card v-for="update in latestUpdates" :key="update.id" class="group hover:shadow-lg transition-all duration-300 border-primary/10">
                        <CardHeader>
                            <div class="flex items-center justify-between">
                                <span class="inline-flex items-center rounded-full bg-primary/10 px-3 py-1 text-xs font-medium text-primary">
                                    {{ update.category }}
                                </span>
                                <span class="text-sm text-muted-foreground">{{ update.readTime }} read</span>
                            </div>
                            <CardTitle class="group-hover:text-primary transition-colors">
                                {{ update.title }}
                            </CardTitle>
                            <CardDescription>
                                {{ update.description }}
                            </CardDescription>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div class="flex items-center gap-2 text-sm text-muted-foreground">
                                <Calendar class="h-4 w-4" />
                                <span>{{ update.date }}</span>
                            </div>
                            <Button as-child variant="ghost" class="w-full group/btn">
                                <Link :href="`/news/${update.id}`" class="flex items-center justify-center gap-2">
                                    Read More
                                    <ChevronRight class="h-4 w-4 group-hover/btn:translate-x-1 transition-transform" />
                                </Link>
                            </Button>
                        </CardContent>
                    </Card>
                </div>

                <div class="text-center mt-12">
                    <Button as-child size="lg" class="bg-primary hover:bg-primary/90">
                        <Link href="/news" class="flex items-center gap-2">
                            View All Updates
                            <ArrowRight class="h-5 w-5" />
                        </Link>
                    </Button>
                </div>
            </div>
        </section>

        <!-- Upcoming Events -->
        <section class="py-16 lg:py-20 bg-gradient-to-b from-primary/5 to-transparent">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">Upcoming Events</h2>
                    <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                        Join us for community gatherings, workshops, and charity meetings
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
                                    Event Details
                                    <ChevronRight class="h-4 w-4 group-hover/btn:translate-x-1 transition-transform" />
                                </Link>
                            </Button>
                        </CardContent>
                    </Card>
                </div>

                <div class="text-center mt-12">
                    <Button as-child size="lg" variant="outline" class="border-primary/20 hover:bg-primary/5">
                        <Link href="/events" class="flex items-center gap-2">
                            View All Events
                            <ArrowRight class="h-5 w-5" />
                        </Link>
                    </Button>
                </div>
            </div>
        </section>

        <!-- Contact & Get Involved -->
        <section class="py-16 lg:py-20 bg-gradient-to-r from-blue-50 via-white to-primary/10">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-8">
                    <!-- Left side remains the same -->
                    <div class="space-y-6">
                        <div class="inline-flex items-center rounded-full bg-primary/10 px-4 py-2 text-sm font-medium text-primary">
                            <MapPin class="mr-2 h-4 w-4" />
                            Get in Touch
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-bold tracking-tight">
                            Connect With Us
                        </h2>
                        <p class="text-lg text-muted-foreground">
                            Whether you want to support our mission, request assistance, or learn more
                            about our work, we'd love to hear from you.
                        </p>

                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <MapPin class="h-5 w-5 text-primary flex-shrink-0" />
                                <div>
                                    <p class="font-medium">Registered Office</p>
                                    <p class="text-sm text-muted-foreground">{{ charityInfo.address }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <Phone class="h-5 w-5 text-primary flex-shrink-0" />
                                <div>
                                    <p class="font-medium">Phone</p>
                                    <p class="text-sm text-muted-foreground">{{ charityInfo.phone }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <Globe class="h-5 w-5 text-primary flex-shrink-0" />
                                <div>
                                    <p class="font-medium">Email </p>
                                    <p class="text-sm text-muted-foreground">{{ charityInfo.email }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-4 pt-4">
                            <Button as-child class="bg-primary hover:bg-primary/90">
                                <Link href="/contact" class="flex items-center gap-2">
                                    <Phone class="h-4 w-4" />
                                    Contact Us
                                </Link>
                            </Button>
                            <Button as-child variant="outline">
                                <Link href="/volunteer" class="flex items-center gap-2">
                                    <Users class="h-4 w-4" />
                                    Volunteer Inquiry
                                </Link>
                            </Button>
                        </div>
                    </div>

                    <!-- Right side - Contact Form -->
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-primary/10">
                        <h3 class="text-2xl font-bold mb-6">Send Us a Message</h3>

                        <form class="space-y-6" action="/api/contact" method="POST">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label for="firstName" class="text-sm font-medium">First Name *</label>
                                    <input
                                        type="text"
                                        id="firstName"
                                        name="firstName"
                                        required
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                        placeholder="John"
                                    >
                                </div>
                                <div class="space-y-2">
                                    <label for="lastName" class="text-sm font-medium">Last Name *</label>
                                    <input
                                        type="text"
                                        id="lastName"
                                        name="lastName"
                                        required
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                        placeholder="Doe"
                                    >
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label for="email" class="text-sm font-medium">Email Address *</label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    required
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                    placeholder="john@example.com"
                                >
                            </div>



                            <div class="space-y-2">
                                <label for="message" class="text-sm font-medium">Message *</label>
                                <textarea
                                    id="message"
                                    name="message"
                                    required
                                    rows="3"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition resize-none"
                                    placeholder="Tell us how we can help you..."
                                ></textarea>
                            </div>

                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <input
                                        type="checkbox"
                                        id="newsletter"
                                        name="newsletter"
                                        class="mt-1 h-4 w-4 text-primary rounded focus:ring-primary/20"
                                    >
                                    <label for="newsletter" class="text-sm text-muted-foreground">
                                        I'd like to receive updates about charity news and upcoming events
                                    </label>
                                </div>

                                <p class="text-xs text-muted-foreground">
                                    By submitting this form, you agree to our privacy policy and consent to
                                    being contacted regarding your inquiry.
                                </p>
                            </div>

                            <Button type="submit" class="w-full bg-primary hover:bg-primary/90 py-3 text-base">
                                Send Message
                            </Button>
                        </form>
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
