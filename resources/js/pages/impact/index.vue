<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import {
    Users, GraduationCap,
    HeartPulse, Church, Briefcase, ArrowRight,
    CheckCircle, Target, ClipboardList,
    Mail, Calendar, Globe
} from 'lucide-vue-next'
import { Sparkles } from 'lucide-vue-next'
import { computed, ref } from 'vue'
import { Button } from '@/components/ui/button'
import FrontAppLayout from '@/layouts/FrontAppLayout.vue'
import { type BreadcrumbItem } from '@/types'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: '/',
    },
    {
        title: 'Our Services',
        href: '/services',
    },
];



// Service categories based on your S.E.E. model
const serviceCategories = [
    {
        id: 'educational',
        title: 'Educational Empowerment',
        icon: GraduationCap,
        color: 'from-blue-500 to-cyan-500',
        lightBg: 'bg-blue-50',
        description: 'Breaking cycles of poverty through quality education and academic support.',
        services: [
            {
                title: 'School Fee Support Program',
                description: 'Full and partial sponsorship for children who cannot afford quality education.',
                features: [
                    'Full & partial school fee sponsorship',
                    'Educational resources & materials',
                    'Uniform and supplies assistance',
                    'Mentorship & academic guidance'
                ]
            },
            {
                title: 'Educational Resources',
                description: 'Providing essential learning materials and resources for academic success.',
                features: [
                    'Textbooks and learning materials',
                    'School supplies and equipment',
                    'Digital learning resources',
                    'Library access programs'
                ]
            }
        ]
    },
    {
        id: 'health',
        title: 'Health & Social Care',
        icon: HeartPulse,
        color: 'from-green-500 to-emerald-500',
        lightBg: 'bg-green-50',
        description: 'Comprehensive healthcare services through our EMI-Care UK partnership.',
        services: [
            {
                title: 'EMI-Care UK Health Services',
                description: 'Professional medical care and health support for vulnerable populations.',
                features: [
                    'Medical consultation & support',
                    'Health education & prevention programs',
                    'Social care assistance & counseling',
                    'Community health initiatives'
                ]
            },
            {
                title: 'Wellness Programs',
                description: 'Holistic wellness initiatives promoting physical and mental wellbeing.',
                features: [
                    'Health screening camps',
                    'Nutrition guidance',
                    'Mental health support',
                    'Senior care assistance'
                ]
            }
        ]
    },
    {
        id: 'spiritual',
        title: 'Spiritual & Community Building',
        icon: Church,
        color: 'from-purple-500 to-pink-500',
        lightBg: 'bg-purple-50',
        description: 'Nurturing spiritual growth and building strong community bonds.',
        services: [
            {
                title: 'Spiritual Guidance & Ministry',
                description: 'Faith-based programs through Duke Randolph Ministries for spiritual development.',
                features: [
                    'Spiritual counseling & guidance',
                    'Faith-based community programs',
                    'Prayer & spiritual support services',
                    'Community engagement initiatives'
                ]
            },
            {
                title: 'Community Building',
                description: 'Creating strong, supportive communities through connection and shared values.',
                features: [
                    'Community events and gatherings',
                    'Support groups',
                    'Leadership development',
                    'Youth mentoring programs'
                ]
            }
        ]
    },
    {
        id: 'economic',
        title: 'Economic Empowerment',
        icon: Briefcase,
        color: 'from-amber-500 to-orange-500',
        lightBg: 'bg-amber-50',
        description: 'Creating pathways to financial independence and sustainable livelihoods.',
        services: [
            {
                title: 'Sustainable Livelihood Programs',
                description: 'Skills development and economic opportunity creation for lasting change.',
                features: [
                    'Skills training & vocational programs',
                    'Livelihood opportunity creation',
                    'Financial literacy education',
                    'Entrepreneurship support'
                ]
            },
            {
                title: 'Micro-Enterprise Support',
                description: 'Helping individuals start and sustain small businesses.',
                features: [
                    'Business skills training',
                    'Micro-loan programs',
                    'Market access support',
                    'Business mentorship'
                ]
            }
        ]
    }
]

// Process steps for accessing services
const processSteps = [
    {
        number: '01',
        title: 'Reach Out',
        description: 'Contact us through email, phone, or our website to inquire about our services.',
        icon: Mail,
        color: 'bg-blue-100 text-blue-600'
    },
    {
        number: '02',
        title: 'Assessment',
        description: 'We conduct a personalized assessment to understand your needs and circumstances.',
        icon: ClipboardList,
        color: 'bg-green-100 text-green-600'
    },
    {
        number: '03',
        title: 'Support Plan',
        description: 'Our team creates a customized support plan tailored to your specific situation.',
        icon: Target,
        color: 'bg-purple-100 text-purple-600'
    },
    {
        number: '04',
        title: 'Implementation',
        description: 'We work alongside you to implement and monitor your support journey.',
        icon: Calendar,
        color: 'bg-amber-100 text-amber-600'
    }
]

// Impact statistics
const impactStats = [
    { value: '500+', label: 'Students Supported', icon: GraduationCap },
    { value: '1000+', label: 'Health Consultations', icon: HeartPulse },
    { value: '300+', label: 'Families Empowered', icon: Users },
    { value: '5', label: 'Countries Reached', icon: Globe }
]

// Check if live stream is active (reusing from story)
const isLive = computed(() => {
    const now = new Date()
    const day = now.getDay()
    const hour = now.getHours()
    return day === 0 && hour >= 9 && hour <= 12
})
// Carousel state (add this after your existing computed properties)
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
</script>

<template>
    <Head title="Our Services - Empowerment Missions Int." />

    <FrontAppLayout :breadcrumbs="breadcrumbs" :is-live="isLive">
        <!-- Hero Section with S.E.E. Model - Enhanced like Home Page -->
        <section class="relative overflow-hidden bg-gradient-to-br from-primary/5 via-white to-blue-50/30">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-grid-black/[0.02] bg-[size:20px_20px]" />

            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-72 h-72 bg-primary/10 rounded-full -translate-y-36 translate-x-36 animate-float-slow"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-500/10 rounded-full translate-y-48 -translate-x-48 animate-float-slower"></div>
            <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-green-500/5 rounded-full blur-3xl animate-pulse-soft"></div>

            <!-- Additional floating shapes -->
            <div class="absolute top-40 left-10 w-32 h-32 bg-amber-500/5 rounded-full blur-2xl"></div>
            <div class="absolute bottom-40 right-10 w-40 h-40 bg-purple-500/5 rounded-full blur-2xl"></div>

            <div class="container relative mx-auto px-4 py-16 lg:py-20">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="space-y-6">
                        <!-- Pill badge -->
                        <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full text-primary text-sm font-medium shadow-lg border border-primary/10">
                            <Sparkles class="h-4 w-4" />
                            <span>What We Offer</span>
                        </div>

                        <h1 class="text-4xl lg:text-5xl xl:text-5xl font-bold tracking-tight leading-tight">
                            Transforming Lives Through
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-blue-600 block mt-2">
                                S.E.E. Empowerment
                            </span>
                        </h1>

                        <p class="text-xl text-muted-foreground leading-relaxed">
                            Holistic support across
                            <span class="font-semibold text-gray-900">Socio-spiritual, Economic, and Educational</span>
                            dimensions for lasting community transformation.
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <Button as-child size="lg" class="bg-primary hover:bg-primary/90 shadow-lg hover:shadow-xl transition-all">
                                <Link href="#services" class="flex items-center gap-2">
                                    Explore Our Services
                                    <ArrowRight class="h-5 w-5" />
                                </Link>
                            </Button>

                            <Button as-child size="lg" variant="outline" class="bg-white/80 backdrop-blur-sm border-primary/20 hover:bg-primary/5">
                                <Link href="/contact" class="flex items-center gap-2">
                                    <Phone class="h-5 w-5" />
                                    Get In Touch
                                </Link>
                            </Button>
                        </div>

                        <!-- Quick Stats - Services Focused -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t border-gray-200">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">4</div>
                                <div class="text-sm text-muted-foreground">Core Pillars</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">8+</div>
                                <div class="text-sm text-muted-foreground">Programs</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">100%</div>
                                <div class="text-sm text-muted-foreground">Funds to Mission</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">UK & Kenya</div>
                                <div class="text-sm text-muted-foreground">Service Areas</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Image Carousel (adapted for services) -->
                    <div class="relative" @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <!-- Carousel Container -->
                            <div class="relative h-[500px] overflow-hidden">
                                <!-- Carousel Images -->
                                <div class="relative h-full">
                                    <!-- Image 1 - Educational -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 0, 'opacity-0': activeImage !== 0 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Educational empowerment programs"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-blue-600/40 via-blue-600/20 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-2">Educational Empowerment</h3>
                                            <p class="text-sm opacity-90">School fee support and learning resources</p>
                                        </div>
                                    </div>

                                    <!-- Image 2 - Health -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 1, 'opacity-0': activeImage !== 1 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Health and social care services"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-green-600/40 via-green-600/20 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-2">Health & Social Care</h3>
                                            <p class="text-sm opacity-90">Medical consultation and wellness programs</p>
                                        </div>
                                    </div>

                                    <!-- Image 3 - Spiritual -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 2, 'opacity-0': activeImage !== 2 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Spiritual guidance and community building"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-purple-600/40 via-purple-600/20 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-2">Spiritual & Community</h3>
                                            <p class="text-sm opacity-90">Faith-based programs and community support</p>
                                        </div>
                                    </div>

                                    <!-- Image 4 - Economic -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 3, 'opacity-0': activeImage !== 3 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Economic empowerment programs"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-amber-600/40 via-amber-600/20 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-2">Economic Empowerment</h3>
                                            <p class="text-sm opacity-90">Skills training and livelihood support</p>
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

        <!-- How to Access Services -->
        <section class="py-20 bg-gradient-to-b from-primary/5 to-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        How to Access Our Services
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        A simple, supportive process to begin your journey with us
                    </p>
                </div>

                <!-- Process Steps -->
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                    <div
                        v-for="(step, index) in processSteps"
                        :key="step.number"
                        class="relative"
                    >
                        <!-- Connector Line (except last) -->
                        <div
                            v-if="index < processSteps.length - 1"
                            class="hidden lg:block absolute top-16 left-1/2 w-full h-0.5 bg-gradient-to-r from-primary/20 to-transparent"
                        ></div>

                        <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 text-center relative z-10">
                            <!-- Step Number -->
                            <div class="text-5xl font-bold text-primary/10 mb-4">{{ step.number }}</div>

                            <!-- Icon -->
                            <div :class="`w-16 h-16 ${step.color} rounded-2xl flex items-center justify-center mx-auto mb-4`">
                                <component :is="step.icon" class="h-8 w-8" />
                            </div>

                            <h3 class="text-lg font-bold mb-2">{{ step.title }}</h3>
                            <p class="text-sm text-muted-foreground">{{ step.description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Impact Stats Bar -->
        <section class="py-12 bg-green-100 border-y border-gray-100">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 max-w-4xl mx-auto">
                    <div v-for="stat in impactStats" :key="stat.label" class="text-center">
                        <div class="text-3xl lg:text-4xl font-bold text-primary mb-2">{{ stat.value }}</div>
                        <div class="text-sm text-muted-foreground flex items-center justify-center gap-1">
                            <component :is="stat.icon" class="h-4 w-4" />
                            <span>{{ stat.label }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Services Sections - Redesigned -->
        <section class="py-20 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-grid-slate-100 [mask-image:radial-gradient(ellipse_at_center,white,transparent)]"></div>

            <div class="container mx-auto px-4 relative z-10">
                <!-- Section Header -->
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full text-primary text-sm font-medium mb-4">
                        <Target class="h-4 w-4" />
                        <span>Our Services</span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Comprehensive Support Through
                        <span class="text-primary">Four Pillars</span>
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        Each service area is designed to provide holistic empowerment and lasting change
                    </p>
                </div>

                <!-- Service Categories - Redesigned Layout -->
                <div class="space-y-20">
                    <div
                        v-for="(category, index) in serviceCategories"
                        :key="category.id"
                        class="relative"
                    >
                        <!-- Alternating Layout -->
                        <div class="grid lg:grid-cols-12 gap-8 items-start">
                            <!-- Category Sidebar - Sticky on desktop -->
                            <div class="lg:col-span-4 lg:sticky lg:top-24">
                                <div class="bg-white rounded-2xl p-6 shadow-xl border border-gray-100">
                                    <!-- Category Icon & Title -->
                                    <div class="flex items-center gap-4 mb-4">
                                        <div :class="`w-16 h-16 rounded-2xl bg-gradient-to-r ${category.color} flex items-center justify-center shadow-lg`">
                                            <component :is="category.icon" class="h-8 w-8 text-white" />
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-muted-foreground mb-1">
                                                Pillar {{ index + 1 }}
                                            </div>
                                            <h3 class="text-2xl font-bold">{{ category.title }}</h3>
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <p class="text-muted-foreground mb-6 leading-relaxed">
                                        {{ category.description }}
                                    </p>

                                    <!-- Quick Stats / Highlights -->
                                    <div class="space-y-3">
                                        <div class="flex items-center gap-2 text-sm">
                                            <div :class="`w-2 h-2 rounded-full bg-gradient-to-r ${category.color}`"></div>
                                            <span>{{ category.services.length }} core programs</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-sm">
                                            <div :class="`w-2 h-2 rounded-full bg-gradient-to-r ${category.color}`"></div>
                                            <span>{{ category.services[0].features.length }}+ support areas</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Services Grid - Right Column -->
                            <div class="lg:col-span-8 space-y-6">
                                <div
                                    v-for="service in category.services"
                                    :key="service.title"
                                    class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100"
                                >
                                    <!-- Decorative gradient line -->
                                    <div :class="`absolute top-0 left-0 w-full h-1 bg-gradient-to-r ${category.color} transform origin-left scale-x-0 group-hover:scale-x-100 transition-transform duration-500`"></div>

                                    <div class="p-8">
                                        <!-- Service Title with Icon -->
                                        <div class="flex items-start justify-between mb-4">
                                            <h4 class="text-xl font-bold group-hover:text-primary transition-colors">
                                                {{ service.title }}
                                            </h4>
                                            <div :class="`w-10 h-10 rounded-lg bg-gradient-to-r ${category.color} bg-opacity-10 flex items-center justify-center`">
                                                <component :is="category.icon" :class="`h-5 w-5 text-${category.color.split('-')[1]}-600`" />
                                            </div>
                                        </div>

                                        <!-- Description -->
                                        <p class="text-muted-foreground mb-6 leading-relaxed">
                                            {{ service.description }}
                                        </p>

                                        <!-- Features Grid -->
                                        <div class="grid sm:grid-cols-2 gap-3 mb-6">
                                            <div
                                                v-for="feature in service.features"
                                                :key="feature"
                                                class="flex items-start gap-2"
                                            >
                                                <div class="shrink-0 mt-1">
                                                    <CheckCircle :class="`h-4 w-4 text-${category.color.split('-')[1]}-500`" />
                                                </div>
                                                <span class="text-sm text-gray-600">{{ feature }}</span>
                                            </div>
                                        </div>

                                        <!-- Action Footer -->
                                        <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                            <span class="text-xs text-muted-foreground">
                                                Free consultation available
                                            </span>
                                            <Link
                                                :href="`/services/${category.id}`"
                                                class="inline-flex items-center gap-2 text-sm font-medium text-primary group/link"
                                            >
                                                <span>Learn more</span>
                                                <ArrowRight class="h-4 w-4 transition-transform group-hover/link:translate-x-1" />
                                            </Link>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Optional divider between categories -->
                        <div v-if="index < serviceCategories.length - 1" class="absolute -bottom-10 left-0 right-0 flex justify-center">
                            <div class="w-20 h-1 bg-gradient-to-r from-transparent via-primary/20 to-transparent rounded-full"></div>
                        </div>
                    </div>
                </div>

                <!-- Bottom CTA -->
                <div class="text-center mt-16">
                    <p class="text-muted-foreground mb-4">
                        Not sure which service is right for you?
                    </p>
                    <Button as-child variant="outline" class="border-primary/20 hover:bg-primary/5">
                        <Link href="/contact" class="flex items-center gap-2">
                            <Phone class="h-4 w-4" />
                            Talk to our team
                        </Link>
                    </Button>
                </div>
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
.bg-grid-slate-100 {
    background-image: linear-gradient(to right, rgb(148 163 184 / 0.1) 1px, transparent 1px),
        linear-gradient(to bottom, rgb(148 163 184 / 0.1) 1px, transparent 1px);
    background-size: 40px 40px;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.animate-float {
    animation: float 3s ease-in-out infinite;
}
</style>
