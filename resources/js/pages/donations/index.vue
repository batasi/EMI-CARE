<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import {
    Heart, Shield, CheckCircle, ArrowRight, ChevronRight,
    CreditCard, Banknote, Calendar, Users, Target,
    TrendingUp, Award, PieChart, Clock, Phone,
    Lock,  GraduationCap,
    HandHeart, Building, Zap,
    Briefcase
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
        title: 'Donate',
        href: '/donate',
    },
]

// Charity information (reused from home page)
const charityInfo = {
    name: 'Empowerment Missions Int.',
    charityNumber: '1141696',
    companyNumber: '05893970',
    tagline: 'Empowering People - Socio-spiritually, Economically & Educationally',
    address: '65 Fairwater Drive, Woodley, Reading, RG5 3JG',
    phone: '07727208820',
    email: 'enquiry@empowermentmissions.org.uk',
    website: 'www.empowermentmissions.org.uk',
}

// Donation form handling
const donationForm = useForm({
    amount: '',
    customAmount: '',
    frequency: 'one-time',
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    address: '',
    city: '',
    postcode: '',
    country: 'UK',
    paymentMethod: 'card',
    giftAid: false,
    newsletter: false,
    anonymous: false,
    dedication: '',
    message: '',
    consent: false
})

// Predefined donation amounts
const donationAmounts = [10, 25, 50, 100, 250, 500]

// Submit handler
const submit = () => {
    donationForm.post('/donate', {
        preserveScroll: true,
        onSuccess: () => {
            donationForm.reset()
            showSuccessMessage.value = true
            setTimeout(() => {
                showSuccessMessage.value = false
            }, 5000)
        }
    })
}

// Success message visibility
const showSuccessMessage = ref(false)

// Carousel state (reused from home page)
const activeImage = ref(0)
const totalImages = 4
let autoPlayInterval: ReturnType<typeof setInterval> | null = null

const nextImage = () => {
    activeImage.value = (activeImage.value + 1) % totalImages
}

const prevImage = () => {
    activeImage.value = (activeImage.value - 1 + totalImages) % totalImages
}

const startAutoPlay = () => {
    autoPlayInterval = setInterval(() => {
        nextImage()
    }, 5000)
}

const stopAutoPlay = () => {
    if (autoPlayInterval) {
        clearInterval(autoPlayInterval)
        autoPlayInterval = null
    }
}

onMounted(() => {
    startAutoPlay()
})

onBeforeUnmount(() => {
    stopAutoPlay()
})

const carouselHover = ref(false)

const handleMouseEnter = () => {
    carouselHover.value = true
    stopAutoPlay()
}

const handleMouseLeave = () => {
    carouselHover.value = false
    startAutoPlay()
}

// Impact stories
const impactStories = [
    {
        id: 1,
        title: 'Mary\'s Educational Journey',
        description: 'With your support, Mary became the first in her family to attend university, now studying to become a teacher.',
        amount: '£25/month',
        impact: 'Supported 4 years of education',
        image: 'https://images.unsplash.com/photo-1544717302-de2939b7ef71?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        icon: GraduationCap
    },
    {
        id: 2,
        title: 'Community Health Initiative',
        description: 'Your donations helped provide health screenings for 200+ families in Reading and Bedford.',
        amount: '£50 one-time',
        impact: '200+ health screenings',
        image: 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        icon: Heart
    },
    {
        id: 3,
        title: 'Economic Empowerment',
        description: 'Supporting 15 women entrepreneurs with micro-loans and business training in Kenya.',
        amount: '£100/month',
        impact: '15 businesses started',
        image: 'https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
        icon: TrendingUp
    }
]

// Ways to give
const waysToGive = [
    {
        title: 'One-Time Gift',
        description: 'Make a single donation to support our mission',
        icon: Heart,
        color: 'text-blue-500',
        bgColor: 'bg-blue-50',
        features: ['Immediate impact', 'Flexible amount', 'Tax deductible']
    },
    {
        title: 'Monthly Giving',
        description: 'Sustained support through regular donations',
        icon: Calendar,
        color: 'text-green-500',
        bgColor: 'bg-green-50',
        features: ['Predictable funding', 'Lower fees', 'Sustained impact'],
        popular: true
    },
    {
        title: 'Annual Partnership',
        description: 'Commit to year-round support',
        icon: Award,
        color: 'text-purple-500',
        bgColor: 'bg-purple-50',
        features: ['Exclusive updates', 'Recognition', 'Strategic impact']
    }
]

// Where your money goes
const allocationStats = [
    { label: 'Program Services', percentage: 85, color: 'bg-blue-500', icon: Target },
    { label: 'Fundraising', percentage: 10, color: 'bg-green-500', icon: TrendingUp },
    { label: 'Administration', percentage: 5, color: 'bg-purple-500', icon: Shield }
]

// Fund allocation details
const fundAllocations = [
    {
        area: 'Educational Programs',
        percentage: 40,
        description: 'School fees, materials, and educational support',
        icon: GraduationCap
    },
    {
        area: 'Health & Social Care',
        percentage: 25,
        description: 'Medical support and wellness programs',
        icon: Heart
    },
    {
        area: 'Economic Empowerment',
        percentage: 20,
        description: 'Skills training and livelihood programs',
        icon: Briefcase
    },
    {
        area: 'Community & Spiritual',
        percentage: 15,
        description: 'Community building and spiritual support',
        icon: Users
    }
]

// Gift Aid information
const giftAidInfo = {
    benefit: '25%',
    description: 'With Gift Aid, your donation of £100 becomes £125 at no extra cost to you.',
    requirements: [
        'UK taxpayer',
        'Pay sufficient Income Tax or Capital Gains Tax',
        'Confirm your consent'
    ]
}

// Check if live stream is active (reused)
const isLive = computed(() => {
    const now = new Date()
    const day = now.getDay()
    const hour = now.getHours()
    return day === 0 && hour >= 9 && hour <= 12
})
</script>

<template>
    <Head title="Donate - Support Our Mission - Empowerment Missions Int." />

    <FrontAppLayout :breadcrumbs="breadcrumbs" :is-live="isLive">
        <!-- Success Message Banner -->
        <transition
            enter-active-class="transition duration-300 ease-out"
            enter-from-class="transform -translate-y-full opacity-0"
            enter-to-class="transform translate-y-0 opacity-100"
            leave-active-class="transition duration-200 ease-in"
            leave-from-class="transform translate-y-0 opacity-100"
            leave-to-class="transform -translate-y-full opacity-0"
        >
            <div v-if="showSuccessMessage" class="fixed top-20 left-1/2 transform -translate-x-1/2 z-50 bg-green-50 border border-green-200 rounded-lg shadow-lg px-6 py-4 flex items-center gap-3">
                <CheckCircle class="h-5 w-5 text-green-600" />
                <span class="text-green-800 font-medium">Thank you for your generosity! Your donation will transform lives.</span>
            </div>
        </transition>

        <!-- Hero Section - Matching home page style -->
        <section class="relative overflow-hidden bg-gradient-to-br from-rose-50 via-white to-primary/10">
            <!-- Background Pattern -->
            <div class="absolute inset-0 bg-grid-black/[0.02] bg-[size:20px_20px]" />

            <!-- Decorative elements -->
            <div class="absolute top-0 right-0 w-72 h-72 bg-rose-500/10 rounded-full -translate-y-36 translate-x-36 animate-float-slow"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary/10 rounded-full translate-y-48 -translate-x-48 animate-float-slower"></div>
            <div class="absolute top-1/3 left-1/4 w-64 h-64 bg-amber-500/5 rounded-full blur-3xl animate-pulse-soft"></div>

            <div class="container relative mx-auto px-4 py-16 lg:py-20">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="space-y-6">
                        <!-- Pill badge -->
                        <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full text-primary text-sm font-medium shadow-lg border border-primary/10">
                            <Heart class="h-4 w-4" />
                            <span>Make a Difference Today</span>
                        </div>

                        <h1 class="text-4xl lg:text-5xl xl:text-5xl font-bold tracking-tight leading-tight">
                            Your Generosity
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-rose-600 to-primary block mt-2">
                                Transforms Lives
                            </span>
                        </h1>

                        <p class="text-xl text-muted-foreground leading-relaxed">
                            Every donation, whether large or small, helps us empower communities through
                            <span class="font-semibold text-gray-900">education, healthcare, and economic opportunities</span>
                            in the UK and Africa.
                        </p>

                        <!-- Quick Impact Stats -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t border-gray-200">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">85%</div>
                                <div class="text-sm text-muted-foreground">to Programs</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">£25</div>
                                <div class="text-sm text-muted-foreground">Supports 1 Child</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">500+</div>
                                <div class="text-sm text-muted-foreground">Lives Changed</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">25%</div>
                                <div class="text-sm text-muted-foreground">Gift Aid</div>
                            </div>
                        </div>

                        <!-- Charity Registration -->
                        <div class="flex items-center gap-4 bg-white/50 backdrop-blur-sm rounded-lg p-3 border border-gray-100">
                            <Shield class="h-5 w-5 text-primary shrink-0" />
                            <p class="text-xs text-muted-foreground">
                                UK Registered Charity No: {{ charityInfo.charityNumber }} |
                                Company No: {{ charityInfo.companyNumber }}
                            </p>
                        </div>
                    </div>

                    <!-- Right Content - Image Carousel (donation focused) -->
                    <div class="relative" @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <div class="relative h-[500px] overflow-hidden">
                                <div class="relative h-full">
                                    <!-- Image 1 - Education Impact -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 0, 'opacity-0': activeImage !== 0 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Students receiving educational support"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-blue-600/60 via-blue-600/20 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <div class="flex items-center gap-2 mb-2">
                                                <GraduationCap class="h-5 w-5" />
                                                <span class="text-sm font-medium bg-white/20 px-2 py-1 rounded-full">Education</span>
                                            </div>
                                            <h3 class="text-xl font-bold mb-1">Support a Child's Education</h3>
                                            <p class="text-sm opacity-90">£25/month provides school fees & materials</p>
                                        </div>
                                    </div>

                                    <!-- Image 2 - Healthcare Impact -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 1, 'opacity-0': activeImage !== 1 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1469571486292-0ba58a3f068b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Community health support"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-green-600/60 via-green-600/20 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <div class="flex items-center gap-2 mb-2">
                                                <Heart class="h-5 w-5" />
                                                <span class="text-sm font-medium bg-white/20 px-2 py-1 rounded-full">Healthcare</span>
                                            </div>
                                            <h3 class="text-xl font-bold mb-1">Provide Medical Care</h3>
                                            <p class="text-sm opacity-90">£50 provides health screenings for 10 families</p>
                                        </div>
                                    </div>

                                    <!-- Image 3 - Economic Empowerment -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 2, 'opacity-0': activeImage !== 2 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1571772995611-9cb1cb6d0e3e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Economic empowerment programs"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-amber-600/60 via-amber-600/20 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <div class="flex items-center gap-2 mb-2">
                                                <TrendingUp class="h-5 w-5" />
                                                <span class="text-sm font-medium bg-white/20 px-2 py-1 rounded-full">Economic</span>
                                            </div>
                                            <h3 class="text-xl font-bold mb-1">Empower Entrepreneurs</h3>
                                            <p class="text-sm opacity-90">£100 seed funding for small business startups</p>
                                        </div>
                                    </div>

                                    <!-- Image 4 - Community Impact -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 3, 'opacity-0': activeImage !== 3 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Community gathering and support"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-purple-600/60 via-purple-600/20 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <div class="flex items-center gap-2 mb-2">
                                                <Users class="h-5 w-5" />
                                                <span class="text-sm font-medium bg-white/20 px-2 py-1 rounded-full">Community</span>
                                            </div>
                                            <h3 class="text-xl font-bold mb-1">Strengthen Communities</h3>
                                            <p class="text-sm opacity-90">Support community programs and gatherings</p>
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

        <!-- Ways to Give Section -->
        <section class="py-20 bg-gradient-to-b from-white to-primary/5">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full text-primary text-sm font-medium mb-4">
                        <HandHeart class="h-4 w-4" />
                        <span>Ways to Give</span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Choose How You Want to Support
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        Flexible giving options to suit your preference and make the biggest impact
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div
                        v-for="(way) in waysToGive"
                        :key="way.title"
                        class="group relative"
                    >
                        <!-- Popular Badge -->
                        <div v-if="way.popular" class="absolute -top-4 left-1/2 transform -translate-x-1/2 z-20">
                            <div class="bg-gradient-to-r from-amber-500 to-orange-500 text-white text-xs font-bold px-4 py-2 rounded-full shadow-lg flex items-center gap-1">
                                <Zap class="h-3 w-3" />
                                <span>Most Popular</span>
                            </div>
                        </div>

                        <div class="relative bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 h-full flex flex-col">
                            <!-- Icon -->
                            <div :class="`w-16 h-16 ${way.bgColor} rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-500`">
                                <component :is="way.icon" :class="`h-8 w-8 ${way.color}`" />
                            </div>

                            <h3 class="text-2xl font-bold mb-3">{{ way.title }}</h3>
                            <p class="text-muted-foreground mb-6">{{ way.description }}</p>

                            <!-- Features -->
                            <div class="space-y-3 mb-8 flex-grow">
                                <div v-for="feature in way.features" :key="feature" class="flex items-center gap-2">
                                    <CheckCircle :class="`h-4 w-4 ${way.color}`" />
                                    <span class="text-sm">{{ feature }}</span>
                                </div>
                            </div>

                            <!-- CTA -->
                            <Button
                                @click="donationForm.frequency = way.title === 'One-Time Gift' ? 'one-time' : way.title === 'Monthly Giving' ? 'monthly' : 'annual'"
                                :class="way.popular ? 'bg-primary hover:bg-primary/90' : 'bg-white border-2 border-primary/20 hover:border-primary hover:bg-primary/5'"
                                :variant="way.popular ? 'default' : 'outline'"
                                class="w-full"
                            >
                                <span>Select</span>
                                <ArrowRight class="h-4 w-4 ml-2" />
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Donation Form Section -->
        <section class="py-20 bg-white" id="donate-form">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-3 gap-8">
                    <!-- Left Side - Impact & Information -->
                    <div class="lg:col-span-1 space-y-8">
                        <!-- Where Your Money Goes -->
                        <Card class="border-primary/10">
                            <CardHeader>
                                <CardTitle class="flex items-center gap-2">
                                    <PieChart class="h-5 w-5 text-primary" />
                                    Where Your Money Goes
                                </CardTitle>
                                <CardDescription>
                                    85% of donations directly fund our programs
                                </CardDescription>
                            </CardHeader>
                            <CardContent class="space-y-6">
                                <!-- Allocation Bars -->
                                <div class="space-y-4">
                                    <div v-for="stat in allocationStats" :key="stat.label" class="space-y-1">
                                        <div class="flex justify-between text-sm">
                                            <span>{{ stat.label }}</span>
                                            <span class="font-medium">{{ stat.percentage }}%</span>
                                        </div>
                                        <div class="w-full bg-gray-100 rounded-full h-2.5">
                                            <div class="h-2.5 rounded-full transition-all duration-500" :class="stat.color" :style="{ width: stat.percentage + '%' }"></div>
                                        </div>
                                    </div>
                                </div>

                                <Separator />

                                <!-- Detailed Allocation -->
                                <div class="space-y-3">
                                    <h4 class="font-semibold text-sm">Program Breakdown</h4>
                                    <div v-for="item in fundAllocations" :key="item.area" class="flex items-start gap-3">
                                        <div class="mt-1">
                                            <component :is="item.icon" class="h-4 w-4 text-primary" />
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex justify-between text-sm">
                                                <span>{{ item.area }}</span>
                                                <span class="font-medium">{{ item.percentage }}%</span>
                                            </div>
                                            <p class="text-xs text-muted-foreground">{{ item.description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>

                        <!-- Gift Aid Information -->
                        <Card class="border-green-200 bg-green-50">
                            <CardHeader>
                                <CardTitle class="flex items-center gap-2 text-green-700">
                                    <Percent class="h-5 w-5" />
                                    Gift Aid: Make Your Donation Go Further
                                </CardTitle>
                            </CardHeader>
                            <CardContent class="space-y-4">
                                <div class="bg-white rounded-lg p-4">
                                    <div class="text-2xl font-bold text-green-600 mb-2">+{{ giftAidInfo.benefit }}</div>
                                    <p class="text-sm">{{ giftAidInfo.description }}</p>
                                </div>

                                <div class="space-y-2">
                                    <p class="text-sm font-medium">Requirements:</p>
                                    <ul class="space-y-1">
                                        <li v-for="req in giftAidInfo.requirements" :key="req" class="flex items-start gap-2 text-xs">
                                            <CheckCircle class="h-3 w-3 text-green-600 shrink-0 mt-0.5" />
                                            <span>{{ req }}</span>
                                        </li>
                                    </ul>
                                </div>

                                <p class="text-xs text-muted-foreground">
                                    We can claim 25p for every £1 you donate at no extra cost to you.
                                </p>
                            </CardContent>
                        </Card>

                        <!-- Secure Donation Badge -->
                        <div class="bg-gray-50 rounded-xl p-6 text-center">
                            <Lock class="h-8 w-8 text-primary mx-auto mb-3" />
                            <h4 class="font-semibold mb-1">100% Secure</h4>
                            <p class="text-xs text-muted-foreground">
                                Your payment information is encrypted and secure. We never store your card details.
                            </p>
                        </div>
                    </div>

                    <!-- Right Side - Donation Form -->
                    <div class="lg:col-span-2">
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden sticky top-24">
                            <!-- Form Header -->
                            <div class="p-8 bg-gradient-to-r from-primary/10 to-primary/5 border-b border-gray-100">
                                <h2 class="text-2xl font-bold mb-2">Make a Donation</h2>
                                <p class="text-muted-foreground">Your support transforms lives and builds stronger communities.</p>
                            </div>

                            <!-- Form -->
                            <form @submit.prevent="submit" class="p-8 space-y-8">
                                <!-- Error Summary -->
                                <div v-if="Object.keys(donationForm.errors).length > 0" class="bg-red-50 border border-red-200 rounded-lg p-4">
                                    <p class="text-sm text-red-600 font-medium mb-2">Please fix the following errors:</p>
                                    <ul class="list-disc list-inside text-sm text-red-600">
                                        <li v-for="(error, field) in donationForm.errors" :key="field">{{ error }}</li>
                                    </ul>
                                </div>

                                <!-- Donation Type -->
                                <div class="space-y-4">
                                    <label class="text-sm font-medium block">Giving Frequency</label>
                                    <div class="grid grid-cols-3 gap-3">
                                        <button
                                            type="button"
                                            @click="donationForm.frequency = 'one-time'"
                                            class="py-3 px-4 rounded-xl border-2 transition-all"
                                            :class="donationForm.frequency === 'one-time' ? 'border-primary bg-primary/5 text-primary' : 'border-gray-200 hover:border-primary/50'"
                                        >
                                            One-Time
                                        </button>
                                        <button
                                            type="button"
                                            @click="donationForm.frequency = 'monthly'"
                                            class="py-3 px-4 rounded-xl border-2 transition-all relative"
                                            :class="donationForm.frequency === 'monthly' ? 'border-primary bg-primary/5 text-primary' : 'border-gray-200 hover:border-primary/50'"
                                        >
                                            Monthly
                                            <span class="absolute -top-2 -right-2 bg-green-500 text-white text-xs px-2 py-0.5 rounded-full">Save fees</span>
                                        </button>
                                        <button
                                            type="button"
                                            @click="donationForm.frequency = 'annual'"
                                            class="py-3 px-4 rounded-xl border-2 transition-all"
                                            :class="donationForm.frequency === 'annual' ? 'border-primary bg-primary/5 text-primary' : 'border-gray-200 hover:border-primary/50'"
                                        >
                                            Annual
                                        </button>
                                    </div>
                                </div>

                                <!-- Donation Amount -->
                                <div class="space-y-4">
                                    <label class="text-sm font-medium block">Select Amount</label>
                                    <div class="grid grid-cols-3 md:grid-cols-6 gap-2">
                                        <button
                                            v-for="amount in donationAmounts"
                                            :key="amount"
                                            type="button"
                                            @click="donationForm.amount = amount.toString(); donationForm.customAmount = ''"
                                            class="py-3 px-2 rounded-xl border-2 text-sm font-medium transition-all"
                                            :class="donationForm.amount === amount.toString() ? 'border-primary bg-primary/5 text-primary' : 'border-gray-200 hover:border-primary/50'"
                                        >
                                            £{{ amount }}
                                        </button>
                                    </div>

                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-muted-foreground">£</span>
                                        <input
                                            v-model="donationForm.customAmount"
                                            type="number"
                                            min="1"
                                            step="1"
                                            placeholder="Other amount"
                                            class="w-full pl-8 pr-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                            @input="donationForm.amount = ''"
                                        />
                                    </div>
                                </div>

                                <Separator />

                                <!-- Personal Information -->
                                <div class="space-y-4">
                                    <h3 class="text-lg font-semibold">Your Information</h3>

                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label for="firstName" class="text-sm font-medium">First Name <span class="text-red-500">*</span></label>
                                            <input
                                                id="firstName"
                                                v-model="donationForm.firstName"
                                                type="text"
                                                required
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                                placeholder="John"
                                            />
                                        </div>

                                        <div class="space-y-2">
                                            <label for="lastName" class="text-sm font-medium">Last Name <span class="text-red-500">*</span></label>
                                            <input
                                                id="lastName"
                                                v-model="donationForm.lastName"
                                                type="text"
                                                required
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                                placeholder="Doe"
                                            />
                                        </div>
                                    </div>

                                    <div class="grid md:grid-cols-2 gap-6">
                                        <div class="space-y-2">
                                            <label for="email" class="text-sm font-medium">Email <span class="text-red-500">*</span></label>
                                            <input
                                                id="email"
                                                v-model="donationForm.email"
                                                type="email"
                                                required
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                                placeholder="john@example.com"
                                            />
                                        </div>

                                        <div class="space-y-2">
                                            <label for="phone" class="text-sm font-medium">Phone</label>
                                            <input
                                                id="phone"
                                                v-model="donationForm.phone"
                                                type="tel"
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                                placeholder="07727 208820"
                                            />
                                        </div>
                                    </div>

                                    <!-- Address -->
                                    <div class="space-y-2">
                                        <label for="address" class="text-sm font-medium">Address</label>
                                        <input
                                            id="address"
                                            v-model="donationForm.address"
                                            type="text"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                            placeholder="Street address"
                                        />
                                    </div>

                                    <div class="grid md:grid-cols-3 gap-4">
                                        <div class="space-y-2">
                                            <label for="city" class="text-sm font-medium">City</label>
                                            <input
                                                id="city"
                                                v-model="donationForm.city"
                                                type="text"
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                                placeholder="Reading"
                                            />
                                        </div>

                                        <div class="space-y-2">
                                            <label for="postcode" class="text-sm font-medium">Postcode</label>
                                            <input
                                                id="postcode"
                                                v-model="donationForm.postcode"
                                                type="text"
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                                placeholder="RG5 3JG"
                                            />
                                        </div>

                                        <div class="space-y-2">
                                            <label for="country" class="text-sm font-medium">Country</label>
                                            <select
                                                id="country"
                                                v-model="donationForm.country"
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                            >
                                                <option value="UK">United Kingdom</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Method -->
                                <div class="space-y-4">
                                    <h3 class="text-lg font-semibold">Payment Method</h3>
                                    <div class="grid grid-cols-2 gap-4">
                                        <button
                                            type="button"
                                            @click="donationForm.paymentMethod = 'card'"
                                            class="py-4 px-4 rounded-xl border-2 transition-all flex items-center justify-center gap-2"
                                            :class="donationForm.paymentMethod === 'card' ? 'border-primary bg-primary/5 text-primary' : 'border-gray-200 hover:border-primary/50'"
                                        >
                                            <CreditCard class="h-5 w-5" />
                                            <span class="font-medium">Card</span>
                                        </button>
                                        <button
                                            type="button"
                                            @click="donationForm.paymentMethod = 'bank'"
                                            class="py-4 px-4 rounded-xl border-2 transition-all flex items-center justify-center gap-2"
                                            :class="donationForm.paymentMethod === 'bank' ? 'border-primary bg-primary/5 text-primary' : 'border-gray-200 hover:border-primary/50'"
                                        >
                                            <Banknote class="h-5 w-5" />
                                            <span class="font-medium">Bank Transfer</span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Dedication (Optional) -->
                                <div class="space-y-4">
                                    <h3 class="text-lg font-semibold">Dedication (Optional)</h3>
                                    <div class="space-y-2">
                                        <label for="dedication" class="text-sm font-medium">In honour or memory of</label>
                                        <input
                                            id="dedication"
                                            v-model="donationForm.dedication"
                                            type="text"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                            placeholder="e.g., In memory of John Smith"
                                        />
                                    </div>
                                    <div class="space-y-2">
                                        <label for="message" class="text-sm font-medium">Personal message (optional)</label>
                                        <textarea
                                            id="message"
                                            v-model="donationForm.message"
                                            rows="3"
                                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition resize-none"
                                            placeholder="Add a personal message..."
                                        ></textarea>
                                    </div>
                                </div>

                                <!-- Options -->
                                <div class="space-y-4">
                                    <div class="flex items-start gap-3">
                                        <input
                                            id="giftAid"
                                            v-model="donationForm.giftAid"
                                            type="checkbox"
                                            class="mt-1 h-4 w-4 text-primary rounded focus:ring-primary/20"
                                        />
                                        <label for="giftAid" class="text-sm text-muted-foreground">
                                            <span class="font-medium text-green-600">Boost your donation by 25%</span> - I am a UK taxpayer and want Gift Aid applied to my donation.
                                        </label>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <input
                                            id="anonymous"
                                            v-model="donationForm.anonymous"
                                            type="checkbox"
                                            class="mt-1 h-4 w-4 text-primary rounded focus:ring-primary/20"
                                        />
                                        <label for="anonymous" class="text-sm text-muted-foreground">
                                            I would like to remain anonymous
                                        </label>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <input
                                            id="newsletter"
                                            v-model="donationForm.newsletter"
                                            type="checkbox"
                                            class="mt-1 h-4 w-4 text-primary rounded focus:ring-primary/20"
                                        />
                                        <label for="newsletter" class="text-sm text-muted-foreground">
                                            Keep me updated about the impact of my donation and news from Empowerment Missions Int.
                                        </label>
                                    </div>

                                    <div class="flex items-start gap-3">
                                        <input
                                            id="consent"
                                            v-model="donationForm.consent"
                                            type="checkbox"
                                            required
                                            class="mt-1 h-4 w-4 text-primary rounded focus:ring-primary/20"
                                        />
                                        <label for="consent" class="text-sm text-muted-foreground">
                                            <span class="text-red-500">*</span> I confirm that the information provided is accurate and I agree to the <Link href="/terms" class="text-primary hover:underline">Terms</Link> and <Link href="/privacy" class="text-primary hover:underline">Privacy Policy</Link>.
                                        </label>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <Button
                                    type="submit"
                                    :disabled="donationForm.processing || !donationForm.consent || (!donationForm.amount && !donationForm.customAmount)"
                                    class="w-full bg-primary hover:bg-primary/90 py-4 text-base disabled:opacity-50 disabled:cursor-not-allowed"
                                >
                                    <Heart class="h-5 w-5 mr-2" />
                                    {{ donationForm.processing ? 'Processing...' : `Complete Donation${donationForm.frequency === 'monthly' ? ' (Monthly)' : donationForm.frequency === 'annual' ? ' (Annual)' : ''}` }}
                                </Button>

                                <!-- Security Note -->
                                <div class="flex items-center justify-center gap-2 text-xs text-muted-foreground">
                                    <Lock class="h-3 w-3" />
                                    <span>256-bit SSL secure payment</span>
                                    <span class="mx-2">•</span>
                                    <Shield class="h-3 w-3" />
                                    <span>GDPR compliant</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Impact Stories Section -->
        <section class="py-20 bg-gradient-to-b from-primary/5 to-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full text-primary text-sm font-medium mb-4">
                        <Users class="h-4 w-4" />
                        <span>Real Impact</span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Your Donation in Action
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        See how previous donations have transformed lives in our communities
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <Card v-for="story in impactStories" :key="story.id" class="group hover:shadow-2xl transition-all duration-500 overflow-hidden border-0">
                        <div class="relative h-48 overflow-hidden">
                            <img
                                :src="story.image"
                                :alt="story.title"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                            />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <div class="flex items-center gap-2">
                                    <component :is="story.icon" class="h-4 w-4" />
                                    <span class="text-xs font-medium bg-white/20 px-2 py-1 rounded-full">{{ story.amount }}</span>
                                </div>
                            </div>
                        </div>
                        <CardHeader>
                            <CardTitle class="group-hover:text-primary transition-colors">{{ story.title }}</CardTitle>
                            <CardDescription>{{ story.description }}</CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="flex items-center gap-2 text-sm text-green-600">
                                <CheckCircle class="h-4 w-4" />
                                <span>{{ story.impact }}</span>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </section>

        <!-- Other Ways to Support -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Other Ways to Support
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        Can't donate right now? There are many other ways to make a difference
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <Clock class="h-8 w-8 text-primary" />
                        </div>
                        <h3 class="text-xl font-bold mb-2">Volunteer</h3>
                        <p class="text-muted-foreground mb-4">Share your time and skills with our community programs</p>
                        <Link href="/volunteer" class="text-primary hover:underline inline-flex items-center gap-1 text-sm font-medium">
                            Learn more <ArrowRight class="h-4 w-4" />
                        </Link>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <Users class="h-8 w-8 text-primary" />
                        </div>
                        <h3 class="text-xl font-bold mb-2">Fundraise</h3>
                        <p class="text-muted-foreground mb-4">Organize a fundraising event in your community</p>
                        <Link href="/fundraise" class="text-primary hover:underline inline-flex items-center gap-1 text-sm font-medium">
                            Learn more <ArrowRight class="h-4 w-4" />
                        </Link>
                    </div>

                    <div class="text-center p-6">
                        <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <Building class="h-8 w-8 text-primary" />
                        </div>
                        <h3 class="text-xl font-bold mb-2">Corporate Partnership</h3>
                        <p class="text-muted-foreground mb-4">Partner your business with our mission</p>
                        <Link href="/partnerships" class="text-primary hover:underline inline-flex items-center gap-1 text-sm font-medium">
                            Learn more <ArrowRight class="h-4 w-4" />
                        </Link>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section (Donation Specific) -->
        <section class="py-20 bg-gradient-to-b from-primary/5 to-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Donation FAQs
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        Common questions about donating to Empowerment Missions Int.
                    </p>
                </div>

                <div class="max-w-3xl mx-auto space-y-4">
                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                        <details class="group">
                            <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                                <h3 class="text-lg font-semibold group-open:text-primary transition-colors">
                                    Is my donation tax-deductible?
                                </h3>
                                <ChevronRight class="h-5 w-5 text-primary transform group-open:rotate-90 transition-transform" />
                            </summary>
                            <div class="px-6 pb-6 text-muted-foreground">
                                Yes, as a UK registered charity (No. 1141696), all donations are eligible for Gift Aid, allowing us to claim an additional 25% from HMRC at no extra cost to you, provided you are a UK taxpayer.
                            </div>
                        </details>
                    </div>

                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                        <details class="group">
                            <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                                <h3 class="text-lg font-semibold group-open:text-primary transition-colors">
                                    How secure is my payment information?
                                </h3>
                                <ChevronRight class="h-5 w-5 text-primary transform group-open:rotate-90 transition-transform" />
                            </summary>
                            <div class="px-6 pb-6 text-muted-foreground">
                                We use industry-standard 256-bit SSL encryption to protect your data. We never store your card details on our servers. All payments are processed through secure, PCI-DSS compliant payment gateways.
                            </div>
                        </details>
                    </div>

                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                        <details class="group">
                            <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                                <h3 class="text-lg font-semibold group-open:text-primary transition-colors">
                                    Can I change or cancel my monthly donation?
                                </h3>
                                <ChevronRight class="h-5 w-5 text-primary transform group-open:rotate-90 transition-transform" />
                            </summary>
                            <div class="px-6 pb-6 text-muted-foreground">
                                Absolutely. You can modify or cancel your monthly donation at any time by contacting us at enquiry@empowermentmissions.org.uk or by calling 07727208820.
                            </div>
                        </details>
                    </div>

                    <div class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100">
                        <details class="group">
                            <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                                <h3 class="text-lg font-semibold group-open:text-primary transition-colors">
                                    Will I receive a receipt for my donation?
                                </h3>
                                <ChevronRight class="h-5 w-5 text-primary transform group-open:rotate-90 transition-transform" />
                            </summary>
                            <div class="px-6 pb-6 text-muted-foreground">
                                Yes, you will receive an email receipt immediately after your donation. For annual statements or if you need a duplicate receipt, please contact our office.
                            </div>
                        </details>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact CTA -->
        <section class="py-16 bg-primary/5">
            <div class="container mx-auto px-4 text-center">
                <h2 class="text-2xl lg:text-3xl font-bold mb-4">Have Questions About Donating?</h2>
                <p class="text-muted-foreground mb-8 max-w-2xl mx-auto">
                    Our team is here to help with any questions about donations, Gift Aid, or other ways to support our mission.
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <Button as-child size="lg" class="bg-primary hover:bg-primary/90">
                        <Link href="/contact" class="flex items-center gap-2">
                            <Phone class="h-5 w-5" />
                            Contact Us
                        </Link>
                    </Button>
                    <Button as-child size="lg" variant="outline">
                        <a href="mailto:enquiry@empowermentmissions.org.uk" class="flex items-center gap-2">
                            <Mail class="h-5 w-5" />
                            Email Us
                        </a>
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

details > summary {
    list-style: none;
}

details > summary::-webkit-details-marker {
    display: none;
}
</style>
