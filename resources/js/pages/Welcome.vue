<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { Heart, BookOpen, Globe, Phone, MapPin, Users, Calendar, Clock, Shield, GraduationCap, HandHeart, Building, ArrowRight, ChevronRight } from 'lucide-vue-next'
import { computed } from 'vue'
import { ref, onMounted, onBeforeUnmount } from 'vue'
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
// Carousel state
const activeImage = ref(0)
const totalImages = 4
let autoPlayInterval: ReturnType<typeof setInterval> | null = null

// Navigation methods
const nextImage = () => {
    activeImage.value = (activeImage.value + 1) % totalImages
}

const prevImage = () => {
    activeImage.value = (activeImage.value - 1 + totalImages) % totalImages
}

// Auto-play functionality
const startAutoPlay = () => {
    autoPlayInterval = setInterval(() => {
        nextImage()
    }, 5000) // Change image every 5 seconds
}

const stopAutoPlay = () => {
    if (autoPlayInterval) {
        clearInterval(autoPlayInterval)
        autoPlayInterval = null
    }
}

// Initialize auto-play on mount
onMounted(() => {
    startAutoPlay()
})

// Clean up on unmount
onBeforeUnmount(() => {
    stopAutoPlay()
})

// Optional: Pause on hover
const carouselHover = ref(false)

const handleMouseEnter = () => {
    carouselHover.value = true
    stopAutoPlay()
}

const handleMouseLeave = () => {
    carouselHover.value = false
    startAutoPlay()
}
// Charity information based on provided data
const charityInfo = {
    name: 'Empowerment Missions Int.',
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



// Check if live stream is active
const isLive = computed(() => {
    const now = new Date()
    const day = now.getDay() // 0 = Sunday
    const hour = now.getHours()
    return day === 0 && hour >= 9 && hour <= 12 // Sunday 9am-12pm
})
</script>
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

@keyframes pulse-soft {
    0%, 100% { opacity: 0.3; transform: scale(1); }
    50% { opacity: 0.6; transform: scale(1.1); }
}

.animate-float-slow {
    animation: float-slow 8s ease-in-out infinite;
}

.animate-float-slower {
    animation: float-slower 12s ease-in-out infinite;
}

.animate-pulse-soft {
    animation: pulse-soft 6s ease-in-out infinite;
}

.bg-grid-black\/\[0\.02\] {
    background-image: linear-gradient(to right, rgb(0 0 0 / 0.02) 1px, transparent 1px),
        linear-gradient(to bottom, rgb(0 0 0 / 0.02) 1px, transparent 1px);
}
</style>
<template>
    <Head title="Empowerment Missions Int." />

    <FrontAppLayout :breadcrumbs="breadcrumbs" :is-live="isLive">
        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-green-100 from-blue-50 via-white to-primary/10">
            <div class="absolute inset-0 bg-grid-black/[0.02] bg-[size:20px_20px]" />

            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-72 h-72 bg-green-500 rounded-full -translate-y-36 translate-x-36" />
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-green-500 rounded-full translate-y-48 -translate-x-48" />

            <div class="container relative mx-auto px-4 py-16 ">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="space-y-4">


                        <h1 class="text-4xl lg:text-5xl xl:text-5xl font-bold tracking-tight leading-tight">
                            Empowering Communities
                            <span class="text-green-700 block">Through Faith & Action</span>
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
                                <div class="text-2xl font-bold text-green-700">2011</div>
                                <div class="text-sm text-muted-foreground">Founded</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-700">UK & Africa</div>
                                <div class="text-sm text-muted-foreground">Areas of Operation</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-700">S.E.E.</div>
                                <div class="text-sm text-muted-foreground">Empowerment Model</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-green-700">2</div>
                                <div class="text-sm text-muted-foreground">Trustees</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Image Carousel -->
                    <div class="relative" @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <!-- Carousel Container -->
                            <div class="relative h-[500px] overflow-hidden">
                                <!-- Carousel Images -->
                                <div class="relative h-full">
                                    <!-- Image 1 - Community Gathering -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 0, 'opacity-0': activeImage !== 0 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Community prayer gathering and fellowship"
                                            class="w-full h-full object-cover"
                                        />
                                        <!-- Image Overlay -->
                                        <div class="absolute inset-0 bg-gradient-to-t from-primary/40 via-primary/20 to-transparent"></div>
                                        <!-- Caption -->
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-2">Community Fellowship</h3>
                                            <p class="text-sm opacity-90">Bringing people together through faith and support</p>
                                        </div>
                                    </div>

                                    <!-- Image 2 - Education Support -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 1, 'opacity-0': activeImage !== 1 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Educational support and school programs"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-blue-600/40 via-blue-600/20 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-2">Educational Empowerment</h3>
                                            <p class="text-sm opacity-90">Supporting students with grants and learning materials</p>
                                        </div>
                                    </div>

                                    <!-- Image 3 - Economic Development -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 2, 'opacity-0': activeImage !== 2 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Economic empowerment and development programs"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-green-600/40 via-green-600/20 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-2">Economic Growth</h3>
                                            <p class="text-sm opacity-90">Empowering communities through sustainable initiatives</p>
                                        </div>
                                    </div>

                                    <!-- Image 4 - Outreach Programs -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 3, 'opacity-0': activeImage !== 3 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1509099836639-18ba1795216d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Charity outreach and support programs"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-purple-600/40 via-purple-600/20 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-2">Outreach Programs</h3>
                                            <p class="text-sm opacity-90">Making a difference in communities across UK and Africa</p>
                                        </div>
                                    </div>
                                </div>

                                <!-- Navigation Buttons -->
                                <button
                                    @click="prevImage"
                                    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white p-2 rounded-full transition-all duration-300"
                                >
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button
                                    @click="nextImage"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white p-2 rounded-full transition-all duration-300"
                                >
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>

                                <!-- Indicators -->
                                <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2">
                                    <button
                                        v-for="index in 4"
                                        :key="index"
                                        @click="activeImage = index - 1"
                                        class="w-3 h-3 rounded-full transition-all duration-300"
                                        :class="activeImage === index - 1 ? 'bg-white w-8' : 'bg-white/50 hover:bg-white/70'"
                                        :aria-label="`Go to slide ${index}`"
                                    ></button>
                                </div>


                            </div>
                        </div>
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

        <!-- S.E.E. Model Section -->
        <section class="relative bg-green-100 overflow-hidden">
            <!-- Main background with gradient and pattern -->

            <!-- Abstract pattern overlay -->
            <div class="absolute inset-0 opacity-30">
                <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, rgb(0 0 0 / 0.05) 1px, transparent 0); background-size: 40px 40px;"></div>
            </div>

            <!-- Layered geometric shapes -->
            <div class="absolute inset-0 overflow-hidden">
                <!-- Large floating shapes -->
                <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary/5 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl"></div>

                <!-- Diagonal lines pattern -->
                <div class="absolute inset-0 opacity-[0.02]" style="background-image: repeating-linear-gradient(45deg, #000 0px, #000 2px, transparent 2px, transparent 20px);"></div>

                <!-- Floating orbs with different colors -->
                <div class="absolute top-20 left-10 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl animate-float-slow"></div>
                <div class="absolute bottom-20 right-10 w-80 h-80 bg-emerald-500/5 rounded-full blur-3xl animate-float-slower"></div>
                <div class="absolute top-1/2 left-1/3 w-96 h-96 bg-rose-500/5 rounded-full blur-3xl animate-pulse-soft"></div>

                <!-- Scattered dots -->
                <div class="absolute top-1/4 right-1/4 w-2 h-2 bg-primary/20 rounded-full"></div>
                <div class="absolute bottom-1/3 left-1/4 w-3 h-3 bg-blue-400/20 rounded-full"></div>
                <div class="absolute top-2/3 right-1/3 w-1.5 h-1.5 bg-green-400/20 rounded-full"></div>
            </div>

            <!-- Subtle grid overlay -->
            <div class="absolute inset-0 bg-grid-black/[0.02] bg-[size:30px_30px]" />

            <div class="container relative mx-auto">
                <!-- Section Header (same as before) -->
                <div class="text-center max-w-3xl mx-auto mb-2">
                    <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full text-primary text-sm font-medium mb-6 border border-primary/20 shadow-sm">
                        <Shield class="h-4 w-4" />
                        <span>How We Transform Lives</span>
                    </div>

                    <h2 class="text-4xl lg:text-5xl font-bold tracking-tight mb-4">
                        The <span class="text-primary">S.E.E.</span> Approach
                    </h2>

                    <p class="text-lg text-muted-foreground leading-relaxed max-w-2xl mx-auto">
                        Three interconnected pillars working together to create lasting transformation
                        in communities across the UK and Africa
                    </p>
                </div>

                <!-- Interactive Pillars Display (same as before) -->
                <div class="grid lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div
                        v-for="(pillar, index) in seeModel"
                        :key="pillar.title"
                        class="group relative"
                    >
                        <!-- Connection Lines (only visible on desktop) -->
                        <div
                            v-if="index < seeModel.length - 1"
                            class="hidden lg:block absolute top-1/3 -right-8 w-16 h-[2px] bg-gradient-to-r from-primary/20 to-primary/40 z-10"
                        >
                            <div class="absolute right-0 top-1/2 -translate-y-1/2 w-2 h-2 bg-primary/40 rounded-full"></div>
                        </div>

                        <!-- Main Card with glass effect -->
                        <div class="relative bg-white/90 backdrop-blur-sm rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-white/50 overflow-hidden h-full">
                            <!-- Card background gradient on hover -->
                            <div
                                class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700"
                                :class="[
                                    pillar.title === 'Socio-Spiritual' ? 'bg-gradient-to-br from-rose-100/50 via-white to-amber-100/50' :
                                    pillar.title === 'Economic' ? 'bg-gradient-to-br from-emerald-100/50 via-white to-teal-100/50' :
                                    'bg-gradient-to-br from-blue-100/50 via-white to-indigo-100/50'
                                ]"
                            ></div>

                            <!-- Content (same as before) -->
                            <div class="relative">
                                <!-- Icon with animated ring -->
                                <div class="relative inline-block mb-6">
                                    <div
                                        class="absolute inset-0 rounded-2xl blur-xl opacity-50 group-hover:opacity-100 transition-opacity duration-500"
                                        :class="pillar.bgColor"
                                    ></div>
                                    <div
                                        class="relative p-4 rounded-2xl transition-all duration-500 group-hover:scale-110 group-hover:rotate-3"
                                        :class="pillar.bgColor"
                                    >
                                        <component :is="pillar.icon" :class="[pillar.color, 'h-8 w-8']" />
                                    </div>
                                </div>

                                <h3 class="text-2xl font-bold mb-3 group-hover:text-primary transition-colors">
                                    {{ pillar.title }}
                                </h3>

                                <p class="text-muted-foreground mb-8 leading-relaxed">
                                    {{ pillar.description }}
                                </p>

                                <!-- Impact Metrics -->
                                <div class="space-y-4">
                                    <div class="flex items-center gap-3 text-sm">
                                        <div class="w-2 h-2 rounded-full" :class="pillar.color.replace('text', 'bg')"></div>
                                        <span class="text-muted-foreground">Active in UK & Kenya</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-sm">
                                        <div class="w-2 h-2 rounded-full" :class="pillar.color.replace('text', 'bg')"></div>
                                        <span class="text-muted-foreground">Regular community programs</span>
                                    </div>
                                    <div class="flex items-center gap-3 text-sm">
                                        <div class="w-2 h-2 rounded-full" :class="pillar.color.replace('text', 'bg')"></div>
                                        <span class="text-muted-foreground">Measurable impact tracking</span>
                                    </div>
                                </div>

                                <!-- Decorative element -->
                                <div class="absolute bottom-0 right-0 opacity-5 group-hover:opacity-10 transition-opacity">
                                    <component :is="pillar.icon" class="h-24 w-24" :class="pillar.color" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Quote with enhanced styling -->
                <div class="text-center mt-16 max-w-2xl mx-auto relative">
                    <!-- Decorative quote marks -->
                    <div class="absolute -top-6 left-0 text-6xl text-primary/10 font-serif">"</div>
                    <div class="absolute -bottom-6 right-0 text-6xl text-primary/10 font-serif">"</div>

                    <p class="text-lg text-muted-foreground italic relative z-10 px-8">
                        "Together, these three pillars create a foundation for sustainable community development
                        and lasting positive change."
                    </p>

                    <!-- Quick stats with better styling -->
                    <div class="flex justify-center gap-8 mt-10 pt-6 border-t border-primary/10">

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

