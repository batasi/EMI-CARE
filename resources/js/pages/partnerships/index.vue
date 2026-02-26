<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import {
    Building, Handshake, Target, TrendingUp, Award,
    Users, Heart, Briefcase,
    CheckCircle, Send, Zap,
    Phone, Mail,
    Crown, Diamond, Gem,
    GraduationCap
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
        title: 'Partnerships',
        href: '/partnerships',
    },
]

// Charity information
const charityInfo = {
    name: 'Empowerment Missions Int.',
    charityNumber: '1141696',
    companyNumber: '05893970',
    address: '65 Fairwater Drive, Woodley, Reading, RG5 3JG',
    phone: '07727208820',
    email: 'partnerships@empowermentmissions.org.uk',
}

// Partnership form
const form = useForm({
    organisationName: '',
    contactName: '',
    position: '',
    email: '',
    phone: '',
    website: '',
    address: '',
    partnershipType: '',
    partnershipGoals: '',
    additionalInfo: '',
    newsletter: true,
    consent: false
})

// Submit handler
const submit = () => {
    form.post('/partnerships/inquire', {
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

// Partnership types
const partnershipTypes = [
    {
        id: 'corporate',
        title: 'Corporate Partnership',
        icon: Building,
        color: 'from-blue-500 to-cyan-500',
        bgColor: 'bg-blue-50',
        description: 'Align your business with social impact',
        benefits: [
            'CSR fulfillment and reporting',
            'Employee engagement opportunities',
            'Brand visibility and recognition',
            'Networking opportunities',
            'Impact reports and updates'
        ],
        examples: [
            'Sponsorship of programs',
            'Pro bono services',
            'Employee volunteering',
            'Cause-related marketing'
        ]
    },
    {
        id: 'strategic',
        title: 'Strategic Alliance',
        icon: Target,
        color: 'from-purple-500 to-pink-500',
        bgColor: 'bg-purple-50',
        description: 'Long-term collaboration for systemic change',
        benefits: [
            'Co-created programs',
            'Shared expertise and resources',
            'Joint advocacy and influence',
            'Research and innovation',
            'Amplified impact'
        ],
        examples: [
            'Research partnerships',
            'Policy advocacy',
            'Program co-design',
            'Knowledge sharing'
        ]
    },
    {
        id: 'community',
        title: 'Community Partner',
        icon: Users,
        color: 'from-green-500 to-emerald-500',
        bgColor: 'bg-green-50',
        description: 'Local organizations working together',
        benefits: [
            'Local network expansion',
            'Shared community goals',
            'Resource pooling',
            'Joint events and initiatives',
            'Referral pathways'
        ],
        examples: [
            'Schools and colleges',
            'Faith organizations',
            'Local businesses',
            'Community groups'
        ]
    },
    {
        id: 'foundation',
        title: 'Foundation & Grant Partners',
        icon: Award,
        color: 'from-amber-500 to-orange-500',
        bgColor: 'bg-amber-50',
        description: 'Grant-making organizations supporting our mission',
        benefits: [
            'Funded programs',
            'Capacity building',
            'Evaluation and learning',
            'Network connections',
            'Sustainability support'
        ],
        examples: [
            'Trusts and foundations',
            'Grant-making bodies',
            'Philanthropic organizations',
            'Funding partnerships'
        ]
    }
]

// Current partners (logos would be actual images in production)
const currentPartners = [
    { name: 'Local Business 1', type: 'Corporate', logo: '' },
    { name: 'Community Group 1', type: 'Community', logo: '' },
    { name: 'Foundation 1', type: 'Foundation', logo: '' },
    { name: 'Corporate Partner 2', type: 'Corporate', logo: '' },
    { name: 'School Partnership', type: 'Community', logo: '' },
    { name: 'Strategic Alliance', type: 'Strategic', logo: '' }
]

// Partnership levels (for corporate sponsorship)
const partnershipLevels = [
    {
        level: 'Bronze',
        icon: Award,
        amount: '£1,000 - £4,999',
        color: 'from-amber-600 to-amber-400',
        bgColor: 'bg-amber-50',
        benefits: [
            'Logo on website',
            'Social media mention',
            'Quarterly newsletter recognition',
            'Certificate of partnership'
        ]
    },
    {
        level: 'Silver',
        icon: Gem,
        amount: '£5,000 - £9,999',
        color: 'from-gray-400 to-gray-300',
        bgColor: 'bg-gray-50',
        benefits: [
            'All Bronze benefits',
            'Recognition at events',
            'Employee volunteering opportunities',
            'Annual impact report',
            'Named in press releases'
        ]
    },
    {
        level: 'Gold',
        icon: Crown,
        amount: '£10,000 - £24,999',
        color: 'from-yellow-500 to-yellow-400',
        bgColor: 'bg-yellow-50',
        benefits: [
            'All Silver benefits',
            'Exclusive networking events',
            'Logo on marketing materials',
            'Speaking opportunities',
            'Site visit invitations'
        ]
    },
    {
        level: 'Platinum',
        icon: Diamond,
        amount: '£25,000+',
        color: 'from-blue-400 to-indigo-400',
        bgColor: 'bg-blue-50',
        benefits: [
            'All Gold benefits',
            'Naming opportunities',
            'Board-level engagement',
            'Strategic planning input',
            'Custom impact reports',
            'Annual partnership review'
        ]
    }
]

// Success stories
const successStories = [
    {
        partner: 'Reading Community College',
        type: 'Education Partnership',
        story: 'Together we established a mentoring program that has supported 50+ students with their studies and career aspirations.',
        impact: '50+ students mentored, 90% progression rate',
        icon: GraduationCap
    },
    {
        partner: 'Local Business Network',
        type: 'Corporate Partnership',
        story: 'Their employees raised £25,000 through fundraising events and volunteered 200+ hours at our community programs.',
        impact: '£25,000 raised, 200+ volunteer hours',
        icon: Briefcase
    },
    {
        partner: 'Health Foundation',
        type: 'Grant Partner',
        story: 'A three-year grant enabled us to launch our community health program, reaching 1,000+ families with health screenings.',
        impact: '1,000+ families reached, 3 years of funding',
        icon: Heart
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
    <Head title="Partnerships - Empowerment Missions Int." />

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
                <span class="text-green-800 font-medium">Thank you for your partnership interest! Our partnerships team will contact you within 2 business days.</span>
            </div>
        </transition>

        <!-- Hero Section -->
        <section class="relative overflow-hidden bg-gradient-to-br from-indigo-50 via-white to-primary/10">
            <div class="absolute inset-0 bg-grid-black/[0.02] bg-[size:20px_20px]" />

            <div class="absolute top-0 right-0 w-72 h-72 bg-indigo-500/10 rounded-full -translate-y-36 translate-x-36 animate-float-slow"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary/10 rounded-full translate-y-48 -translate-x-48 animate-float-slower"></div>

            <div class="container relative mx-auto px-4 py-16 lg:py-20">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="space-y-6">
                        <div class="inline-flex items-center gap-2 bg-white/80 backdrop-blur-sm px-4 py-2 rounded-full text-primary text-sm font-medium shadow-lg border border-primary/10">
                            <Handshake class="h-4 w-4" />
                            <span>Together We Can Do More</span>
                        </div>

                        <h1 class="text-4xl lg:text-5xl xl:text-5xl font-bold tracking-tight leading-tight">
                            Partner With Us
                            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-primary block mt-2">
                                For Lasting Impact
                            </span>
                        </h1>

                        <p class="text-xl text-muted-foreground leading-relaxed">
                            Whether you're a business, foundation, or community organization,
                            partnering with us amplifies your impact and transforms lives together.
                        </p>

                        <div class="flex flex-wrap gap-4">
                            <Button as-child size="lg" class="bg-primary hover:bg-primary/90">
                                <a href="#partnership-types" class="flex items-center gap-2">
                                    <Target class="h-5 w-5" />
                                    Explore Partnerships
                                </a>
                            </Button>

                            <Button as-child size="lg" variant="outline">
                                <a href="#partnership-form" class="flex items-center gap-2">
                                    <Handshake class="h-5 w-5" />
                                    Become a Partner
                                </a>
                            </Button>
                        </div>

                        <!-- Quick Stats -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pt-4 border-t">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">25+</div>
                                <div class="text-sm text-muted-foreground">Active Partners</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">4</div>
                                <div class="text-sm text-muted-foreground">Partnership Types</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">3</div>
                                <div class="text-sm text-muted-foreground">Countries</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-primary">100%</div>
                                <div class="text-sm text-muted-foreground">Funds to Mission</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content - Image Carousel -->
                    <div class="relative" @mouseenter="handleMouseEnter" @mouseleave="handleMouseLeave">
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <div class="relative h-[500px] overflow-hidden">
                                <div class="relative h-full">
                                    <!-- Image 1 - Partnership meeting -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 0, 'opacity-0': activeImage !== 0 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Partnership meeting"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-indigo-600/60 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-1">Strategic Partnerships</h3>
                                            <p class="text-sm opacity-90">Collaborating for greater impact</p>
                                        </div>
                                    </div>

                                    <!-- Image 2 - Corporate volunteering -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 1, 'opacity-0': activeImage !== 1 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1559027615-cd4628902d4a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Corporate volunteering"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-primary/60 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-1">Employee Engagement</h3>
                                            <p class="text-sm opacity-90">Team volunteering opportunities</p>
                                        </div>
                                    </div>

                                    <!-- Image 3 - Community event -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 2, 'opacity-0': activeImage !== 2 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1593113598338-cd288d649433?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Community partnership event"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-green-600/60 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-1">Community Partnerships</h3>
                                            <p class="text-sm opacity-90">Local organizations working together</p>
                                        </div>
                                    </div>

                                    <!-- Image 4 - Impact celebration -->
                                    <div class="absolute inset-0 transition-opacity duration-700 ease-in-out" :class="{ 'opacity-100': activeImage === 3, 'opacity-0': activeImage !== 3 }">
                                        <img
                                            src="https://images.unsplash.com/photo-1527529482831-f3195e8f5f2f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                            alt="Celebrating partnership impact"
                                            class="w-full h-full object-cover"
                                        />
                                        <div class="absolute inset-0 bg-gradient-to-t from-amber-600/60 to-transparent"></div>
                                        <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                            <h3 class="text-xl font-bold mb-1">Celebrating Impact</h3>
                                            <p class="text-sm opacity-90">Recognizing our partners' contributions</p>
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

        <!-- Why Partner With Us -->
        <section class="py-16 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Why Partner With Empowerment Missions?
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        Create meaningful impact while achieving your organizational goals
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-indigo-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <Target class="h-8 w-8 text-indigo-600" />
                        </div>
                        <h3 class="text-xl font-bold mb-2">Aligned Impact</h3>
                        <p class="text-muted-foreground">Your goals aligned with UN Sustainable Development Goals and local community needs</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <TrendingUp class="h-8 w-8 text-green-600" />
                        </div>
                        <h3 class="text-xl font-bold mb-2">Measurable Results</h3>
                        <p class="text-muted-foreground">Regular impact reports and transparent reporting on your contribution</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-purple-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <Users class="h-8 w-8 text-purple-600" />
                        </div>
                        <h3 class="text-xl font-bold mb-2">Engagement Opportunities</h3>
                        <p class="text-muted-foreground">Employee volunteering, site visits, and events to connect with our work</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Partnership Types -->
        <section id="partnership-types" class="py-20 bg-gradient-to-b from-primary/5 to-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full text-primary text-sm font-medium mb-4">
                        <Handshake class="h-4 w-4" />
                        <span>Partnership Opportunities</span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Find Your Partnership Model
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        Choose the type of partnership that best aligns with your organization
                    </p>
                </div>

                <div class="grid lg:grid-cols-2 gap-6 max-w-6xl mx-auto">
                    <Card
                        v-for="type in partnershipTypes"
                        :key="type.id"
                        class="group hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border-0 overflow-hidden"
                    >
                        <div :class="`h-2 w-full bg-gradient-to-r ${type.color}`"></div>
                        <CardHeader>
                            <div class="flex items-start justify-between">
                                <div :class="`w-14 h-14 ${type.bgColor} rounded-xl flex items-center justify-center`">
                                    <component :is="type.icon" :class="`h-7 w-7 text-${type.color.split('-')[1]}-600`" />
                                </div>
                                <span class="text-xs font-medium bg-primary/10 text-primary px-3 py-1 rounded-full">
                                    {{ type.id }}
                                </span>
                            </div>
                            <CardTitle class="mt-4 text-2xl">{{ type.title }}</CardTitle>
                            <CardDescription class="text-base">{{ type.description }}</CardDescription>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div>
                                <h4 class="font-semibold mb-2 flex items-center gap-2">
                                    <Zap class="h-4 w-4 text-primary" />
                                    Key Benefits:
                                </h4>
                                <ul class="space-y-2">
                                    <li v-for="benefit in type.benefits" :key="benefit" class="text-sm flex items-start gap-2">
                                        <CheckCircle class="h-4 w-4 text-green-600 shrink-0 mt-0.5" />
                                        <span>{{ benefit }}</span>
                                    </li>
                                </ul>
                            </div>
                            <Separator />
                            <div>
                                <h4 class="font-semibold mb-2 text-sm">Examples:</h4>
                                <div class="flex flex-wrap gap-2">
                                    <span v-for="example in type.examples" :key="example" class="px-3 py-1 bg-gray-100 rounded-full text-xs">
                                        {{ example }}
                                    </span>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </section>

        <!-- Corporate Partnership Levels -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="inline-flex items-center gap-2 bg-amber-100 px-4 py-2 rounded-full text-amber-700 text-sm font-medium mb-4">
                        <Crown class="h-4 w-4" />
                        <span>Corporate Partnerships</span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Partnership Levels
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        Choose the level that's right for your organization
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-7xl mx-auto">
                    <div
                        v-for="level in partnershipLevels"
                        :key="level.level"
                        class="relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 overflow-hidden group"
                    >
                        <div :class="`h-2 w-full bg-gradient-to-r ${level.color}`"></div>
                        <div class="p-6">
                            <div :class="`w-14 h-14 ${level.bgColor} rounded-xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform`">
                                <component :is="level.icon" :class="`h-7 w-7 text-${level.color.split('-')[1]}-600`" />
                            </div>
                            <h3 class="text-2xl font-bold mb-1">{{ level.level }}</h3>
                            <p class="text-primary font-semibold mb-4">{{ level.amount }}</p>
                            <Separator class="my-4" />
                            <ul class="space-y-2">
                                <li v-for="benefit in level.benefits" :key="benefit" class="text-xs flex items-start gap-2">
                                    <CheckCircle class="h-3 w-3 text-green-600 shrink-0 mt-0.5" />
                                    <span>{{ benefit }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Current Partners -->
        <section class="py-16 bg-gradient-to-b from-primary/5 to-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <h2 class="text-2xl lg:text-3xl font-bold tracking-tight mb-4">
                        Our Valued Partners
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        Organizations that are already making a difference with us
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                    <div v-for="partner in currentPartners" :key="partner.name" class="bg-white rounded-xl p-4 shadow-md hover:shadow-lg transition-all text-center">
                        <div class="w-16 h-16 bg-gray-100 rounded-full mx-auto mb-3 flex items-center justify-center">
                            <Building class="h-8 w-8 text-gray-400" />
                        </div>
                        <h4 class="font-semibold text-sm">{{ partner.name }}</h4>
                        <p class="text-xs text-primary">{{ partner.type }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Success Stories -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Partnership Success Stories
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        Real examples of how partnerships have transformed communities
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    <Card v-for="story in successStories" :key="story.partner" class="border-0 shadow-lg hover:shadow-2xl transition-all">
                        <CardHeader>
                            <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-4">
                                <component :is="story.icon" class="h-6 w-6 text-primary" />
                            </div>
                            <CardTitle>{{ story.partner }}</CardTitle>
                            <CardDescription class="text-primary font-medium">{{ story.type }}</CardDescription>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <p class="text-muted-foreground">{{ story.story }}</p>
                            <div class="bg-green-50 rounded-lg p-3">
                                <p class="text-sm font-medium text-green-700">Impact: {{ story.impact }}</p>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </section>

        <!-- Partnership Inquiry Form -->
        <section id="partnership-form" class="py-20 bg-gradient-to-b from-primary/5 to-white">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
                    <!-- Left side - Info & Contact -->
                    <div class="space-y-8">
                        <div>
                            <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full text-primary text-sm font-medium mb-4">
                                <Handshake class="h-4 w-4" />
                                <span>Start the Conversation</span>
                            </div>
                            <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                                Interested in Partnering?
                            </h2>
                            <p class="text-lg text-muted-foreground">
                                Let's explore how we can work together to create meaningful impact. Our partnerships team will respond within 2 business days.
                            </p>
                        </div>

                        <div class="space-y-4">
                            <h3 class="text-xl font-bold">What to Expect:</h3>
                            <div class="space-y-4">
                                <div class="flex gap-4">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                        <span class="text-primary font-bold">1</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Initial Discussion</h4>
                                        <p class="text-sm text-muted-foreground">We'll schedule a call to understand your goals and interests</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                        <span class="text-primary font-bold">2</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Proposal Development</h4>
                                        <p class="text-sm text-muted-foreground">We'll create a tailored partnership proposal</p>
                                    </div>
                                </div>
                                <div class="flex gap-4">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                        <span class="text-primary font-bold">3</span>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold">Agreement & Onboarding</h4>
                                        <p class="text-sm text-muted-foreground">Formalize the partnership and begin our collaboration</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Info -->
                        <Card class="border-primary/10">
                            <CardContent class="p-6">
                                <h3 class="font-bold mb-4">Partnerships Team</h3>
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

                    <!-- Right side - Inquiry Form -->
                    <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8">
                        <h3 class="text-2xl font-bold mb-6">Partnership Inquiry</h3>

                        <form @submit.prevent="submit" class="space-y-6">
                            <!-- Error Summary -->
                            <div v-if="Object.keys(form.errors).length > 0" class="bg-red-50 border border-red-200 rounded-lg p-4">
                                <p class="text-sm text-red-600 font-medium mb-2">Please fix the following errors:</p>
                                <ul class="list-disc list-inside text-sm text-red-600">
                                    <li v-for="(error, field) in form.errors" :key="field">{{ error }}</li>
                                </ul>
                            </div>

                            <!-- Organization Information -->
                            <div class="space-y-2">
                                <label class="text-sm font-medium">Organization Name <span class="text-red-500">*</span></label>
                                <input v-model="form.organisationName" type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" />
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="text-sm font-medium">Contact Name <span class="text-red-500">*</span></label>
                                    <input v-model="form.contactName" type="text" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" />
                                </div>
                                <div class="space-y-2">
                                    <label class="text-sm font-medium">Position/Title</label>
                                    <input v-model="form.position" type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" />
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
                                <label class="text-sm font-medium">Website</label>
                                <input v-model="form.website" type="url" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" placeholder="https://" />
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-medium">Address</label>
                                <input v-model="form.address" type="text" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition" />
                            </div>

                            <!-- Partnership Type -->
                            <div class="space-y-2">
                                <label class="text-sm font-medium">Partnership Type of Interest <span class="text-red-500">*</span></label>
                                <select v-model="form.partnershipType" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition">
                                    <option value="">Select type</option>
                                    <option value="corporate">Corporate Partnership</option>
                                    <option value="strategic">Strategic Alliance</option>
                                    <option value="community">Community Partnership</option>
                                    <option value="foundation">Foundation/Grant Partnership</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>

                            <!-- Partnership Goals -->
                            <div class="space-y-2">
                                <label class="text-sm font-medium">Partnership Goals <span class="text-red-500">*</span></label>
                                <textarea v-model="form.partnershipGoals" rows="4" required class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition resize-none" placeholder="Tell us about your organization's goals and how you'd like to partner..."></textarea>
                            </div>

                            <!-- Additional Info -->
                            <div class="space-y-2">
                                <label class="text-sm font-medium">Additional Information</label>
                                <textarea v-model="form.additionalInfo" rows="3" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition resize-none" placeholder="Any other details you'd like to share..."></textarea>
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
                                        Keep me updated about partnership news and opportunities
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
                                {{ form.processing ? 'Submitting...' : 'Submit Inquiry' }}
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
