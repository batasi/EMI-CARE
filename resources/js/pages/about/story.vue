<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { Heart, Phone, Users, Shield,  Target, Eye, Award, CheckCircle, Building, Globe } from 'lucide-vue-next'
import { computed } from 'vue'
import { Button } from '@/components/ui/button'
import FrontAppLayout from '@/layouts/FrontAppLayout.vue'
import { type BreadcrumbItem } from '@/types'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: '/',
    },
    {
        title: 'About Us',
        href: '/about',
    },
    {
        title: 'Our Story',
        href: '/about/story',
    },
];

// Charity information
const charityInfo = {
    name: 'Empowerment Missions International',
    charityNumber: '1141696',
    companyNumber: '05893970',
    tagline: 'Empowering People - Socio-spiritually, Economically & Educationally',
    description: 'A UK registered charity dedicated to transforming lives through holistic empowerment.',
    address: '65 Fairwater Drive, Woodley, Reading, RG5 3JG',
    phone: '07727208820',
    email: 'enquiry@empowermentmissions.org.uk',
    website: 'www.empowermentmissions.org.uk',
    areas: ['Bedford', 'Reading', 'Kenya'],
    financialYear: 'Ending August 31, 2024',
    status: 'Active & Reporting'
}

// Core values from your actual content
const coreValues = [
    {
        title: 'Compassion',
        description: 'We approach every situation with empathy and genuine care for those we serve.',
        icon: Heart
    },
    {
        title: 'Transparency',
        description: '100% of funds go directly to our mission. No trustee payments. Complete accountability.',
        icon: Shield
    },
    {
        title: 'Sustainability',
        description: 'We create lasting change, not temporary fixes. Building futures, not just providing aid.',
        icon: Target
    },
    {
        title: 'Community',
        description: 'We believe in the power of collective action and community-driven solutions.',
        icon: Users
    }
]

// Why Choose EMI features
const whyChooseFeatures = [
    {
        title: 'Registered & Verified',
        description: 'Charity Number: 1141696, UK Charity Commission',
        icon: CheckCircle
    },
    {
        title: 'Transparent Operations',
        description: 'Zero trustee payments, 100% funds to mission',
        icon: Shield
    },
    {
        title: 'Community-Focused',
        description: 'Supported by dedicated trustees and volunteers',
        icon: Users
    },
    {
        title: 'Multi-Sector Impact',
        description: 'Education, health, spiritual care, economic support',
        icon: Building
    },
    {
        title: 'Proven Results',
        description: 'Years of experience transforming lives',
        icon: Award
    },
    {
        title: 'Strategic Partnerships',
        description: 'Working with trusted organizations to maximize impact',
        icon: Globe
    }
]

// Charity information details
const charityDetails = [
    { label: 'Organization Name', value: 'Empowerment Missions International' },
    { label: 'Charity Number', value: '1141696' },
    { label: 'Registration Authority', value: 'UK Charity Commission' },
    { label: 'Status', value: 'Active & Reporting' },
    { label: 'Financial Year', value: 'Ending August 31, 2024' },
    { label: 'Operating Since', value: 'Committed to long-term change' }
]

// Timeline milestones (keep as is, but you can update with actual dates if available)
const timelineMilestones = [
    {
        year: '2011',
        title: 'The Beginning',
        description: 'Empowerment Missions International was founded with a vision to empower communities through faith and action.',
        image: 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
    },
    {
        year: '2013',
        title: 'First International Outreach',
        description: 'Expanded our work to Kenya, beginning community development projects and educational support programs.',
        image: 'https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
    },
    {
        year: '2015',
        title: 'S.E.E. Model Developed',
        description: 'Formalized our approach into the Socio-spiritual, Economic, and Educational empowerment model.',
        image: 'https://images.unsplash.com/photo-1557804506-669a67965ba0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
    },
    {
        year: '2018',
        title: 'Educational Grants Program',
        description: 'Launched comprehensive educational support program, providing school fees and materials to students.',
        image: 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
    },
    {
        year: '2020',
        title: 'EMI-Care UK Established',
        description: 'Expanded healthcare support services through EMI-Care UK partnership.',
        image: 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
    },
    {
        year: '2023',
        title: 'Continued Growth',
        description: 'Now serving communities across Bedford, Reading, and multiple regions in Kenya.',
        image: 'https://images.unsplash.com/photo-1593113598330-4c5e61c6e8c1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
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
    <Head title="Our Story - Empowerment Missions Int." />

    <FrontAppLayout :breadcrumbs="breadcrumbs" :is-live="isLive">


        <!-- Founding Story Section (updated with your content) -->
        <section class="py-16 lg:py-20">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="relative">
                            <img
                                src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80"
                                alt="Founding members"
                                class="rounded-2xl shadow-2xl"
                            />
                            <div class="absolute -bottom-6 -right-6 bg-primary text-white p-4 rounded-2xl shadow-lg">
                                <div class="text-3xl font-bold">2011</div>
                                <div class="text-sm">Founded</div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full text-primary text-sm font-medium">
                            <Shield class="h-4 w-4" />
                            <span>Our Story</span>
                        </div>

                        <h2 class="text-3xl lg:text-4xl font-bold tracking-tight">
                            Transforming Lives Through
                            <span class="text-primary">Holistic Empowerment</span>
                        </h2>

                        <p class="text-lg text-muted-foreground">
                            Empowerment Missions International is a registered charity dedicated to transforming lives through holistic empowerment. We believe that every individual deserves access to spiritual guidance, quality education, and economic opportunity.
                        </p>

                        <p class="text-muted-foreground">
                            Founded on the principles of compassion and community service, EMI works tirelessly to break cycles of poverty and empower individuals to reach their full potential. Our integrated approach ensures that we address not just immediate needs, but create pathways to sustainable, long-term change.
                        </p>

                        <div class="flex items-center gap-4 pt-4">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-primary">13+</div>
                                <div class="text-sm text-muted-foreground">Years of Service</div>
                            </div>
                            <div class="w-px h-12 bg-gray-300"></div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-primary">100%</div>
                                <div class="text-sm text-muted-foreground">Funds to Mission</div>
                            </div>
                            <div class="w-px h-12 bg-gray-300"></div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-primary">2</div>
                                <div class="text-sm text-muted-foreground">Continents</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Mission, Vision & Charity Information -->
        <section class="py-16 lg:py-20 bg-gradient-to-b from-primary/5 to-white">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
                    <!-- Left Column: Mission & Vision -->
                    <div class="space-y-8">
                        <!-- Mission Card -->
                        <div class="bg-white rounded-2xl p-8 shadow-xl border border-primary/10 hover:shadow-2xl transition-all duration-300">
                            <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mb-6">
                                <Target class="h-8 w-8 text-primary" />
                            </div>
                            <h3 class="text-2xl font-bold mb-4">Our Mission</h3>
                            <p class="text-muted-foreground leading-relaxed">
                                To empower individuals and communities socio-spiritually, economically, and educationally
                                through faith-based initiatives that create lasting, sustainable change.
                            </p>
                        </div>

                        <!-- Vision Card -->
                        <div class="bg-white rounded-2xl p-8 shadow-xl border border-primary/10 hover:shadow-2xl transition-all duration-300">
                            <div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mb-6">
                                <Eye class="h-8 w-8 text-primary" />
                            </div>
                            <h3 class="text-2xl font-bold mb-4">Our Vision</h3>
                            <p class="text-muted-foreground leading-relaxed">
                                A world where every community has the resources, support, and opportunities to thrive
                                and where individuals are empowered to reach their full potential.
                            </p>
                        </div>
                    </div>

                    <!-- Right Column: Charity Information -->
                    <div class="lg:pl-8">
                        <div class="bg-white rounded-2xl shadow-xl border border-primary/10 overflow-hidden h-full hover:shadow-2xl transition-all duration-300">
                            <div class="bg-gradient-to-r from-primary/10 to-primary/5 px-6 py-5 border-b border-primary/10">
                                <h3 class="text-xl font-bold flex items-center gap-2">
                                    <Shield class="h-5 w-5 text-primary" />
                                    <span>Charity Information</span>
                                </h3>
                                <p class="text-sm text-muted-foreground mt-1">
                                    UK Registered Charity No: {{ charityInfo.charityNumber }}
                                </p>
                            </div>

                            <div class="p-6">
                                <dl class="space-y-4">
                                    <div v-for="detail in charityDetails"
                                        :key="detail.label"
                                        class="flex flex-col border-b border-gray-100 pb-3 last:border-0 last:pb-0">
                                        <dt class="text-sm text-muted-foreground mb-1">{{ detail.label }}</dt>
                                        <dd class="font-medium text-base">{{ detail.value }}</dd>
                                    </div>
                                </dl>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

         <!-- Timeline Section (keep as is - it's perfect!) -->
        <section class="py-16 lg:py-20 bg-gradient-to-b from-primary/5 to-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Our Journey Through the Years
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        Key milestones that have shaped our organization and impact
                    </p>
                </div>

                <div class="relative max-w-4xl mx-auto">
                    <!-- Timeline line -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-0.5 h-full bg-primary/20 hidden md:block"></div>

                    <div class="space-y-12">
                        <div
                            v-for="(milestone, index) in timelineMilestones"
                            :key="index"
                            class="relative"
                        >
                            <div class="flex flex-col md:flex-row items-center gap-8"
                                 :class="index % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse'">

                                <!-- Content -->
                                <div class="flex-1 md:w-1/2">
                                    <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100">
                                        <div class="text-primary font-bold text-xl mb-2">{{ milestone.year }}</div>
                                        <h3 class="text-xl font-bold mb-2">{{ milestone.title }}</h3>
                                        <p class="text-muted-foreground">{{ milestone.description }}</p>
                                    </div>
                                </div>

                                <!-- Timeline dot -->
                                <div class="absolute left-1/2 transform -translate-x-1/2 w-4 h-4 bg-primary rounded-full border-4 border-white shadow hidden md:block"></div>

                                <!-- Image -->
                                <div class="flex-1 md:w-1/2">
                                    <div class="rounded-xl overflow-hidden shadow-lg">
                                        <img
                                            :src="milestone.image"
                                            :alt="milestone.title"
                                            class="w-full h-48 object-cover hover:scale-105 transition-transform duration-500"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Why Choose EMI Section (NEW) -->
        <section class="py-16 lg:py-20">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-12">

                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">Trusted & Transparent</h2>
                    <p class="text-lg text-muted-foreground">
                        Committed to accountability and lasting impact
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                    <div
                        v-for="feature in whyChooseFeatures"
                        :key="feature.title"
                        class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100"
                    >
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                            <component :is="feature.icon" class="h-6 w-6 text-primary" />
                        </div>
                        <h3 class="text-lg font-bold mb-2">{{ feature.title }}</h3>
                        <p class="text-sm text-muted-foreground">{{ feature.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Core Values (updated with your actual values) -->
        <section class="py-16 lg:py-20 bg-gradient-to-b from-white to-primary/5">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-12">

                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">Our Core Values</h2>
                    <p class="text-lg text-muted-foreground">
                        The principles that shape every decision and action we take
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
                    <div
                        v-for="value in coreValues"
                        :key="value.title"
                        class="bg-white rounded-xl p-6 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1 border border-gray-100"
                    >
                        <div class="w-12 h-12 bg-primary/10 rounded-lg flex items-center justify-center mb-4">
                            <component :is="value.icon" class="h-6 w-6 text-primary" />
                        </div>
                        <h3 class="text-lg font-bold mb-2">{{ value.title }}</h3>
                        <p class="text-sm text-muted-foreground">{{ value.description }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Call to Action (updated) -->
        <section class="py-16 lg:py-20 bg-green-200">
            <div class="container mx-auto px-4">
                <div class="bg-gradient-to-r from-primary/10 via-white to-blue-50/50 rounded-3xl p-8 lg:p-12 shadow-xl border border-primary/20 max-w-4xl mx-auto text-center">
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">Be Part of Our Story</h2>
                    <p class="text-lg text-muted-foreground mb-8 max-w-2xl mx-auto">
                        Join us in writing the next chapter of community transformation and empowerment
                    </p>

                    <div class="flex flex-wrap gap-4 justify-center">
                        <Button as-child size="lg" class="bg-primary hover:bg-primary/90">
                            <Link href="/donate" class="flex items-center gap-2">
                                <Heart class="h-5 w-5" />
                                Support Our Mission
                            </Link>
                        </Button>

                        <Button as-child size="lg" variant="outline">
                            <Link href="/volunteer" class="flex items-center gap-2">
                                <Users class="h-5 w-5" />
                                Volunteer With Us
                            </Link>
                        </Button>

                        <Button as-child size="lg" variant="outline">
                            <Link href="/contact" class="flex items-center gap-2">
                                <Phone class="h-5 w-5" />
                                Get in Touch
                            </Link>
                        </Button>
                    </div>

                    <p class="text-sm text-muted-foreground mt-8">
                        UK Registered Charity No: {{ charityInfo.charityNumber }} | 100% of funds go directly to our mission
                    </p>
                </div>
            </div>
        </section>
    </FrontAppLayout>
</template>

<style scoped>
@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

.bg-grid-black\/\[0\.02\] {
    background-image: linear-gradient(to right, rgb(0 0 0 / 0.02) 1px, transparent 1px),
        linear-gradient(to bottom, rgb(0 0 0 / 0.02) 1px, transparent 1px);
}
</style>
