<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import {
    Heart, Clock, Users, Award, Calendar, MapPin,
    ArrowRight, CheckCircle, Send,
    GraduationCap, HandHeart, Building,
    Briefcase, Coffee, Globe, Phone, Mail,
    Target, Mic, Camera, PenTool,
    Code, Truck, Shield
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
        title: 'Volunteer',
        href: '/volunteer',
    },
]

// Charity information
const charityInfo = {
    name: 'Empowerment Missions Int.',
    charityNumber: '1141696',
    companyNumber: '05893970',
    address: '65 Fairwater Drive, Woodley, Reading, RG5 3JG',
    phone: '07727208820',
    email: 'volunteer@empowermentmissions.org.uk',
}

// Volunteer form
const form = useForm({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    address: '',
    city: '',
    postcode: '',
    areaOfInterest: '',
    skills: [] as string[],
    availability: '',
    hoursPerWeek: '',
    experience: '',
    motivation: '',
    emergencyContact: '',
    emergencyPhone: '',
    references: '',
    newsletter: true,
    consent: false
})

// Submit handler
const submit = () => {
    form.post('/volunteer/apply', {
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            showSuccessMessage.value = true
            setTimeout(() => {
                showSuccessMessage.value = false
            }, 5000)
        }
    })
}

const showSuccessMessage = ref(false)

// Carousel state
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

// Volunteer opportunities
const volunteerOpportunities = [
    {
        id: 'mentoring',
        title: 'Youth Mentor',
        location: 'Reading & Bedford',
        commitment: '2-4 hours/week',
        icon: GraduationCap,
        color: 'from-blue-500 to-cyan-500',
        bgColor: 'bg-blue-50',
        description: 'Support and guide young people in their educational journey.',
        responsibilities: [
            'Provide academic support and tutoring',
            'Be a positive role model',
            'Help with homework and study skills',
            'Organize educational activities'
        ],
        requirements: [
            'Enhanced DBS check required',
            'Experience with young people',
            'Patience and empathy',
            'Minimum 6 months commitment'
        ]
    },
    {
        id: 'community',
        title: 'Community Outreach Assistant',
        location: 'All Locations',
        commitment: 'Flexible',
        icon: Users,
        color: 'from-green-500 to-emerald-500',
        bgColor: 'bg-green-50',
        description: 'Help organize and run community events and programs.',
        responsibilities: [
            'Assist with event organization',
            'Welcome and engage community members',
            'Help with setup and coordination',
            'Distribute information materials'
        ],
        requirements: [
            'Friendly and approachable',
            'Good communication skills',
            'Team player',
            'Weekend availability helpful'
        ]
    },
    {
        id: 'admin',
        title: 'Administrative Support',
        location: 'Reading Office',
        commitment: '4-8 hours/week',
        icon: Building,
        color: 'from-purple-500 to-pink-500',
        bgColor: 'bg-purple-50',
        description: 'Provide vital behind-the-scenes support to our team.',
        responsibilities: [
            'Data entry and record keeping',
            'Answer phone calls and emails',
            'Assist with mailings and communications',
            'Organize files and documents'
        ],
        requirements: [
            'Basic computer skills',
            'Attention to detail',
            'Organized and reliable',
            'Confidentiality awareness'
        ]
    },
    {
        id: 'fundraising',
        title: 'Fundraising Volunteer',
        location: 'Remote/Hybrid',
        commitment: 'Flexible',
        icon: HandHeart,
        color: 'from-amber-500 to-orange-500',
        bgColor: 'bg-amber-50',
        description: 'Help raise funds and awareness for our mission.',
        responsibilities: [
            'Organize fundraising events',
            'Coordinate with local businesses',
            'Manage online campaigns',
            'Engage with donors'
        ],
        requirements: [
            'Enthusiastic and proactive',
            'Good communication skills',
            'Creative thinking',
            'Basic social media knowledge'
        ]
    },
    {
        id: 'skills',
        title: 'Skills-Based Volunteer',
        location: 'Remote/Office',
        commitment: 'Project-based',
        icon: Briefcase,
        color: 'from-red-500 to-rose-500',
        bgColor: 'bg-red-50',
        description: 'Use your professional skills to support our mission.',
        skills: [
            'Graphic Design',
            'Photography/Videography',
            'Web Development',
            'Social Media Management',
            'Translation',
            'Legal Advice'
        ],
        responsibilities: [
            'Apply professional expertise',
            'Work on specific projects',
            'Collaborate with staff',
            'Deliver quality outputs'
        ]
    },
    {
        id: 'drivers',
        title: 'Driver/Transport Volunteer',
        location: 'Reading & Bedford',
        commitment: 'Flexible',
        icon: Truck,
        color: 'from-teal-500 to-cyan-500',
        bgColor: 'bg-teal-50',
        description: 'Help transport goods, supplies, or community members.',
        responsibilities: [
            'Collect and deliver donations',
            'Transport elderly to appointments',
            'Deliver food parcels',
            'Vehicle maintenance checks'
        ],
        requirements: [
            'Valid UK driving license',
            'Access to vehicle',
            'Clean driving record',
            'Business insurance (if using own vehicle)'
        ]
    }
]

// Skill options
const skillOptions = [
    { value: 'teaching', label: 'Teaching/Tutoring', icon: GraduationCap },
    { value: 'admin', label: 'Administration', icon: Building },
    { value: 'events', label: 'Event Planning', icon: Calendar },
    { value: 'socialMedia', label: 'Social Media', icon: Globe },
    { value: 'design', label: 'Graphic Design', icon: PenTool },
    { value: 'photography', label: 'Photography', icon: Camera },
    { value: 'writing', label: 'Writing/Editing', icon: Mic },
    { value: 'coding', label: 'Web/IT', icon: Code },
    { value: 'driving', label: 'Driving', icon: Truck },
    { value: 'cooking', label: 'Cooking', icon: Coffee },
    { value: 'firstAid', label: 'First Aid', icon: Heart },
    { value: 'counselling', label: 'Counselling', icon: Users }
]

// Areas of interest
const areasOfInterest = [
    { value: 'education', label: 'Education & Youth' },
    { value: 'community', label: 'Community Outreach' },
    { value: 'fundraising', label: 'Fundraising' },
    { value: 'admin', label: 'Administration' },
    { value: 'events', label: 'Events' },
    { value: 'health', label: 'Health & Social Care' },
    { value: 'elderly', label: 'Elderly Support' },
    { value: 'food', label: 'Food Bank/Parcel Delivery' }
]

// Availability options
const availabilityOptions = [
    'Weekdays (Daytime)',
    'Weekdays (Evenings)',
    'Weekends',
    'Flexible'
]

// Hours per week options
const hoursOptions = [
    '1-2 hours',
    '3-5 hours',
    '6-10 hours',
    '10+ hours',
    'Project based'
]

// Benefits of volunteering
const volunteerBenefits = [
    {
        icon: Award,
        title: 'Gain Experience',
        description: 'Develop new skills and enhance your CV'
    },
    {
        icon: Users,
        title: 'Meet New People',
        description: 'Join a community of like-minded individuals'
    },
    {
        icon: Heart,
        title: 'Make a Difference',
        description: 'Directly impact lives in your community'
    },
    {
        icon: Clock,
        title: 'Flexible Commitment',
        description: 'Volunteer on your own schedule'
    }
]

// Volunteer stories
const volunteerStories = [
    {
        name: 'Sarah Johnson',
        role: 'Youth Mentor',
        duration: '2 years',
        quote: 'Mentoring young people has been the most rewarding experience. Seeing them grow in confidence and achieve their goals is priceless.',
        image: 'https://images.unsplash.com/photo-1494790108777-766d1e5b1c4f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
    },
    {
        name: 'Solomon Batasi',
        role: 'Software Engineer',
        duration: '3 Years',
        quote: 'Using my software engineering skills to help build and maintain our digital presence has been incredibly fulfilling.',
        image: '/images/volunteers/photooo.jpg'
    },
    {
        name: 'Patricia Okonkwo',
        role: 'Community Outreach',
        duration: '3 years',
        quote: 'Being part of the community events has connected me with so many wonderful people. Its like being part of a big family.',
        image: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80'
    }
]

// Check if live stream is active
const isLive = computed(() => {
    const now = new Date()
    const day = now.getDay()
    const hour = now.getHours()
    return day === 0 && hour >= 9 && hour <= 12
})
</script>

<template>
    <Head title="Volunteer With Us - Empowerment Missions Int." />

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
                <span class="text-green-800 font-medium">Thank you for your interest in volunteering! We'll be in touch within 48 hours.</span>
            </div>
        </transition>

        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-br from-amber-50 via-white to-primary/10">
            <div class="absolute inset-0 bg-grid-black/[0.02] bg-[size:20px_20px]" />

            <div class="absolute top-0 right-0 w-72 h-72 bg-amber-500/10 rounded-full -translate-y-36 translate-x-36 animate-float-slow"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary/10 rounded-full translate-y-48 -translate-x-48 animate-float-slower"></div>

            <div class="container relative mx-auto px-4 py-16 lg:py-20">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="space-y-6">
                        <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full text-primary text-sm font-medium shadow-lg border border-primary/10">
                            <Heart class="h-4 w-4" />
                            <span>Give Your Time, Change Lives</span>
                        </div>

                        <h1 class="text-4xl lg:text-5xl xl:text-5xl font-bold tracking-tight leading-tight">
                            Volunteer
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-primary block mt-2">
                                With Purpose
                            </span>
                        </h1>

                        <p class="text-xl text-muted-foreground leading-relaxed">
                            Join our community of dedicated volunteers making a real difference in the UK and Africa.
                            Your time and skills can transform lives.
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <Button as-child size="lg" class="bg-primary hover:bg-primary/90">
                                <a href="#opportunities" class="flex items-center gap-2">
                                    <Users class="h-5 w-5" />
                                    View Opportunities
                                </a>
                            </Button>

                            <Button as-child size="lg" variant="outline">
                                <a href="#volunteer-form" class="flex items-center gap-2">
                                    <HandHeart class="h-5 w-5" />
                                    Apply Now
                                </a>
                            </Button>
                        </div>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">50+</div>
                                <div class="text-sm text-muted-foreground">Active Volunteers</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">6</div>
                                <div class="text-sm text-muted-foreground">Program Areas</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">2,000+</div>
                                <div class="text-sm text-muted-foreground">Hours/Year</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">100%</div>
                                <div class="text-sm text-muted-foreground">Training Provided</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Image Carousel -->
                    <div class="relative" @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <div class="relative h-[500px] overflow-hidden">
                                <div class="relative h-full">
                                    <!-- Image 1 - Volunteers helping -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 0, 'opacity-0': activeImage !== 0 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1593113598338-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Volunteers working together"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-1">Community Food Program</h3>
                                            <p class="text-sm opacity-90">Volunteers packing food parcels</p>
                                        </div>
                                    </div>

                                    <!-- Image 2 - Mentoring -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 1, 'opacity-0': activeImage !== 1 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1526976668912-1a811878dd37?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Volunteer mentoring youth"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-blue-600/60 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-1">Youth Mentoring</h3>
                                            <p class="text-sm opacity-90">Supporting young people's education</p>
                                        </div>
                                    </div>

                                    <!-- Image 3 - Event volunteers -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 2, 'opacity-0': activeImage !== 2 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Volunteers at community event"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-green-600/60 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-1">Community Events</h3>
                                            <p class="text-sm opacity-90">Bringing people together</p>
                                        </div>
                                    </div>

                                    <!-- Image 4 - Skills volunteers -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 3, 'opacity-0': activeImage !== 3 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Professional skills volunteering"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-purple-600/60 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-1">Skills-Based Volunteering</h3>
                                            <p class="text-sm opacity-90">Using professional expertise</p>
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

        <!-- Benefits Section -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Why Volunteer With Us?
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        More than just giving back - it's about growth, connection, and purpose
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div v-for="benefit in volunteerBenefits" :key="benefit.title" class="text-center p-6">
                        <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <component :is="benefit.icon" class="h-8 w-8 text-primary" />
                        </div>
                        <h3 class="text-lg font-bold mb-2">{{ benefit.title }}</h3>
                        <p class="text-sm text-muted-foreground">{{ benefit.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Volunteer Opportunities -->
        <section id="opportunities" class="py-20 bg-gradient-to-b from-primary/5 to-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full text-primary text-sm font-medium mb-4">
                        <Target class="h-4 w-4" />
                        <span>Current Opportunities</span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Find Your Perfect Role
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        From mentoring to event support, there's a place for everyone
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-7xl mx-auto">
                    <Card
                        v-for="opportunity in volunteerOpportunities"
                        :key="opportunity.id"
                        class="group hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border-0 overflow-hidden"
                    >
                        <div :class="`h-2 w-full bg-gradient-to-r ${opportunity.color}`"></div>
                        <CardHeader>
                            <div class="flex items-start justify-between">
                                <div :class="`w-12 h-12 ${opportunity.bgColor} rounded-xl flex items-center justify-center`">
                                    <component :is="opportunity.icon" :class="`h-6 w-6 text-${opportunity.color.split('-')[1]}-600`" />
                                </div>
                                <div class="flex items-center gap-1 text-xs text-muted-foreground">
                                    <MapPin class="h-3 w-3" />
                                    <span>{{ opportunity.location }}</span>
                                </div>
                            </div>
                            <CardTitle class="mt-4 group-hover:text-primary transition-colors">
                                {{ opportunity.title }}
                            </CardTitle>
                            <CardDescription>{{ opportunity.description }}</CardDescription>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div class="flex items-center gap-2 text-sm">
                                <Clock class="h-4 w-4 text-muted-foreground" />
                                <span>{{ opportunity.commitment }}</span>
                            </div>

                            <Separator />

                            <div>
                                <h4 class="text-sm font-semibold mb-2">Key Responsibilities:</h4>
                                <ul class="space-y-1">
                                    <li v-for="item in opportunity.responsibilities" :key="item" class="text-xs text-muted-foreground flex items-start gap-2">
                                        <CheckCircle class="h-3 w-3 text-green-600 shrink-0 mt-0.5" />
                                        <span>{{ item }}</span>
                                    </li>
                                </ul>
                            </div>

                            <div v-if="opportunity.skills">
                                <h4 class="text-sm font-semibold mb-2">Skills Needed:</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span v-for="skill in opportunity.skills" :key="skill" class="px-2 py-1 bg-gray-100 rounded-full text-xs">
                                        {{ skill }}
                                    </span>
                                </div>
                            </div>

                            <div v-else>
                                <h4 class="text-sm font-semibold mb-2">Requirements:</h4>
                                <ul class="space-y-1">
                                    <li v-for="req in opportunity.requirements" :key="req" class="text-xs text-muted-foreground flex items-start gap-2">
                                        <Shield class="h-3 w-3 text-primary shrink-0 mt-0.5" />
                                        <span>{{ req }}</span>
                                    </li>
                                </ul>
                            </div>

                            <Button variant="outline" class="w-full mt-4" @click="$scrollTo('#volunteer-form')">
                                Apply for this Role
                                <ArrowRight class="h-4 w-4 ml-2" />
                            </Button>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </section>

        <!-- Volunteer Stories -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Hear From Our Volunteers
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        Real stories from people like you who chose to make a difference
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <div v-for="story in volunteerStories" :key="story.name" class="bg-gradient-to-b from-primary/5 to-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all">
                        <div class="flex items-center gap-4 mb-6">
                            <img :src="story.image" :alt="story.name" class="w-16 h-16 rounded-full object-cover border-4 border-white shadow-lg" />
                            <div>
                                <h4 class="font-bold">{{ story.name }}</h4>
                                <p class="text-sm text-primary">{{ story.role }}</p>
                                <p class="text-xs text-muted-foreground">{{ story.duration }}</p>
                            </div>
                        </div>
                        <p class="text-muted-foreground italic">"{{ story.quote }}"</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Volunteer Application Form -->
        <section id="volunteer-form" class="py-20 bg-gradient-to-b from-primary/5 to-white">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
                    <!-- Left side - Info & Contact -->
                    <div class="space-y-8">
                        <div>
                            <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full text-primary text-sm font-medium mb-4">
                                <HandHeart class="h-4 w-4" />
                                <span>Start Your Journey</span>
                            </div>
                            <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                                Ready to Volunteer?
                            </h2>
                            <p class="text-lg text-muted-foreground">
                                Complete the application form and our volunteer coordinator will contact you within 48 hours to discuss opportunities.
                            </p>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-xl font-bold">What Happens Next?</h3>
                            <div class="space-y-4">
                                <div class="flex gap-4">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                        <span class="text-primary font-bold">1</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Application Review</h4>
                                        <p class="text-sm text-muted-foreground">We'll review your application and match you with suitable opportunities</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                        <span class="text-primary font-bold">2</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Informal Chat</h4>
                                        <p class="text-sm text-muted-foreground">Meet with our team to discuss your interests and availability</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                        <span class="text-primary font-bold">3</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Induction & Training</h4>
                                        <p class="text-sm text-muted-foreground">Complete our volunteer induction and any role-specific training</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                        <span class="text-primary font-bold">4</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Start Volunteering</h4>
                                        <p class="text-sm text-muted-foreground">Begin making a difference with ongoing support from our team</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <Card class="border-primary/10">
                            <CardContent class="p-6">
                                <h3 class="font-bold mb-4">Questions? Contact Our Volunteer Coordinator</h3>
                                <div class="space-y-3">
                                    <div class="flex items-center gap-3">
                                        <Phone class="h-4 w-4 text-primary" />
                                        <span class="text-sm">{{ charityInfo.phone }}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <Mail class="h-4 w-4 text-primary" />
                                        <span class="text-sm">{{ charityInfo.email }}</span>
                                    </div>
                                </div>
                            </CardContent>
                        </Card>
                    </div>

                    <!-- Right side - Application Form -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
                        <h3 class="text-2xl font-bold mb-6">Volunteer Application</h3>

                        <form @submit.prevent="submit" class="space-y-6">
                            <!-- Error Summary -->
                            <div v-if="Object.keys(form.errors).length > 0" class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <p class="text-sm text-red-600 font-medium mb-2">Please fix the following errors:</p>
                                <ul class="list-disc list-inside text-sm text-red-600">
                                    <li v-for="(error, field) in form.errors" :key="field">{{ error }}</li>
                                </ul>
                            </div>

                            <!-- Personal Information -->
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium">First Name <span class="text-red-500">*</span></label>
                                    <input v-model="form.firstName" type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-medium">Last Name <span class="text-red-500">*</span></label>
                                    <input v-model="form.lastName" type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" />
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium">Email <span class="text-red-500">*</span></label>
                                    <input v-model="form.email" type="email" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-medium">Phone <span class="text-red-500">*</span></label>
                                    <input v-model="form.phone" type="tel" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" />
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-medium">Address</label>
                                <input v-model="form.address" type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" />
                            </div>

                            <div class="grid md:grid-cols-3 gap-4">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium">City</label>
                                    <input v-model="form.city" type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-medium">Postcode</label>
                                    <input v-model="form.postcode" type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-medium">Area of Interest <span class="text-red-500">*</span></label>
                                    <select v-model="form.areaOfInterest" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                                        <option value="">Select an area</option>
                                        <option v-for="area in areasOfInterest" :key="area.value" :value="area.value">
                                            {{ area.label }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Skills -->
                            <div class="space-y-2">
                                <label class="text-sm font-medium">Skills (Select all that apply)</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <div v-for="skill in skillOptions" :key="skill.value" class="flex items-center gap-2">
                                        <input
                                            type="checkbox"
                                            :id="`skill-${skill.value}`"
                                            :value="skill.value"
                                            v-model="form.skills"
                                            class="rounded border-gray-300 text-primary focus:ring-primary/20"
                                        />
                                        <label :for="`skill-${skill.value}`" class="text-sm flex items-center gap-1">
                                            <component :is="skill.icon" class="h-3 w-3" />
                                            {{ skill.label }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Availability -->
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium">Availability <span class="text-red-500">*</span></label>
                                    <select v-model="form.availability" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                                        <option value="">Select availability</option>
                                        <option v-for="option in availabilityOptions" :key="option" :value="option">
                                            {{ option }}
                                        </option>
                                    </select>
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-medium">Hours per week <span class="text-red-500">*</span></label>
                                    <select v-model="form.hoursPerWeek" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                                        <option value="">Select hours</option>
                                        <option v-for="option in hoursOptions" :key="option" :value="option">
                                            {{ option }}
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Experience & Motivation -->
                            <div class="space-y-2">
                                <label class="text-sm font-medium">Relevant Experience</label>
                                <textarea v-model="form.experience" rows="3" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition resize-none" placeholder="Tell us about any relevant experience..."></textarea>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-medium">Why do you want to volunteer? <span class="text-red-500">*</span></label>
                                <textarea v-model="form.motivation" rows="3" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition resize-none" placeholder="Share your motivation..."></textarea>
                            </div>

                            <!-- Emergency Contact -->
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium">Emergency Contact Name <span class="text-red-500">*</span></label>
                                    <input v-model="form.emergencyContact" type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-medium">Emergency Contact Phone <span class="text-red-500">*</span></label>
                                    <input v-model="form.emergencyPhone" type="tel" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" />
                                </div>
                            </div>

                            <!-- References -->
                            <div class="space-y-2">
                                <label class="text-sm font-medium">References (Optional)</label>
                                <textarea v-model="form.references" rows="2" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition resize-none" placeholder="Names and contact details of references..."></textarea>
                            </div>

                            <!-- Consent -->
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <input
                                        id="newsletter"
                                        v-model="form.newsletter"
                                        type="checkbox"
                                        class="mt-1 h-4 w-4 text-primary rounded focus:ring-primary/20"
                                    />
                                    <label for="newsletter" class="text-sm text-muted-foreground">
                                        I'd like to receive updates about volunteer opportunities and news
                                    </label>
                                </div>

                                <div class="flex items-start gap-3">
                                    <input
                                        id="consent"
                                        v-model="form.consent"
                                        type="checkbox"
                                        required
                                        class="mt-1 h-4 w-4 text-primary rounded focus:ring-primary/20"
                                    />
                                    <label for="consent" class="text-sm text-muted-foreground">
                                        <span class="text-red-500">*</span> I confirm that the information provided is accurate and I agree to the <Link href="/privacy" class="text-primary hover:underline">Privacy Policy</Link>.
                                    </label>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <Button
                                type="submit"
                                :disabled="form.processing || !form.consent"
                                class="w-full bg-primary hover:bg-primary/90 py-3 text-base disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <Send class="h-5 w-5 mr-2" />
                                {{ form.processing ? 'Submitting...' : 'Submit Application' }}
                            </Button>
                        </form>
                    </div>
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
</style>
