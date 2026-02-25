<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import {
    Phone, Mail, MapPin, Clock, Users,
    ArrowRight, CheckCircle, Send,
    HelpCircle, Shield, Sparkles, Building,
    Facebook, Twitter, Instagram, Youtube, Linkedin,
    ChevronRight, Copy, Check
} from 'lucide-vue-next'
import { computed, ref, onMounted, onBeforeUnmount } from 'vue'
import { Button } from '@/components/ui/button'
import FrontAppLayout from '@/layouts/FrontAppLayout.vue'
import { type BreadcrumbItem } from '@/types'

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Home',
        href: '/',
    },
    {
        title: 'Contact Us',
        href: '/contact',
    },
]

// Form handling with Inertia
const form = useForm({
    firstName: '',
    lastName: '',
    email: '',
    phone: '',
    inquiryType: 'general',
    message: '',
    newsletter: false,
    consent: false
})

// Submit handler
const submit = () => {
    form.post('/contact', {
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

// Success message visibility
const showSuccessMessage = ref(false)

// Copy functionality for contact details
const copiedField = ref<string | null>(null)

const copyToClipboard = (text: string, field: string) => {
    navigator.clipboard.writeText(text)
    copiedField.value = field
    setTimeout(() => {
        copiedField.value = null
    }, 2000)
}

// Carousel state for hero section
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

// Charity information
const charityInfo = {
    name: 'Empowerment Missions Int.',
    charityNumber: '1141696',
    companyNumber: '05893970',
    address: '65 Fairwater Drive, Woodley, Reading, RG5 3JG',
    phone: '07727208820',
    email: 'enquiry@empowermentmissions.org.uk',
    website: 'www.empowermentmissions.org.uk',
    hours: [
        { day: 'Monday - Friday', hours: '9:00 AM - 5:00 PM' },
        { day: 'Saturday', hours: '10:00 AM - 2:00 PM' },
        { day: 'Sunday', hours: 'Closed (Emergency Only)' }
    ],
    areas: ['Bedford', 'Reading', 'Kenya']
}

// Contact methods with enhanced details
const contactMethods = [
    {
        icon: Phone,
        title: 'Phone',
        details: [
            { label: 'Main Line', value: charityInfo.phone, type: 'phone' },
            { label: 'Emergency', value: '07727208821', type: 'phone' }
        ],
        description: 'Available during office hours',
        action: 'Call us',
        color: 'from-blue-500 to-cyan-500',
        bgColor: 'bg-blue-50',
        textColor: 'text-blue-600'
    },
    {
        icon: Mail,
        title: 'Email',
        details: [
            { label: 'General Inquiries', value: charityInfo.email, type: 'email' },
            { label: 'Support', value: 'support@empowermentmissions.org.uk', type: 'email' },
            { label: 'Partnerships', value: 'partners@empowermentmissions.org.uk', type: 'email' }
        ],
        description: 'We reply within 24-48 hours',
        action: 'Send email',
        color: 'from-green-500 to-emerald-500',
        bgColor: 'bg-green-50',
        textColor: 'text-green-600'
    },
    {
        icon: MapPin,
        title: 'Visit',
        details: [
            { label: 'Registered Office', value: charityInfo.address, type: 'address' },
            { label: 'Bedford Centre', value: '23 High Street, Bedford, MK40 1RN', type: 'address' }
        ],
        description: 'Appointments recommended',
        action: 'Get directions',
        color: 'from-purple-500 to-pink-500',
        bgColor: 'bg-purple-50',
        textColor: 'text-purple-600'
    }
]

// Social media links
const socialLinks = [
    { name: 'Facebook', icon: Facebook, url: '#', color: 'hover:bg-blue-600', followers: '2.5K' },
    { name: 'Twitter', icon: Twitter, url: '#', color: 'hover:bg-sky-500', followers: '1.8K' },
    { name: 'Instagram', icon: Instagram, url: '#', color: 'hover:bg-pink-600', followers: '3.2K' },
    { name: 'YouTube', icon: Youtube, url: '#', color: 'hover:bg-red-600', followers: '1.2K' },
    { name: 'LinkedIn', icon: Linkedin, url: '#', color: 'hover:bg-blue-700', followers: '1.5K' }
]

// Inquiry types for dropdown
const inquiryTypes = [
    { value: 'general', label: 'General Inquiry' },
    { value: 'support', label: 'Request Support' },
    { value: 'donate', label: 'Donation/Partnership' },
    { value: 'volunteer', label: 'Volunteer Opportunity' },
    { value: 'prayer', label: 'Prayer Request' },
    { value: 'other', label: 'Other' }
]

// FAQ items
const faqItems = [
    {
        question: 'How quickly do you respond to inquiries?',
        answer: 'We aim to respond to all inquiries within 24-48 hours during business days. For urgent matters, please mention "URGENT" in your message subject or call our emergency line.'
    },
    {
        question: 'Can I visit your office without an appointment?',
        answer: 'While walk-ins are welcome, we strongly recommend scheduling an appointment to ensure the right team member is available to assist you with your specific needs.'
    },
    {
        question: 'How can I support your mission?',
        answer: 'You can support us through donations, volunteering, fundraising, or partnering with us. Visit our "Get Involved" section or contact our partnerships team.'
    },
    {
        question: 'Do you provide support outside the UK?',
        answer: 'Yes, we operate in both the UK and Kenya. For international inquiries, please specify your location and needs in your message.'
    }
]

// Team contacts
const teamContacts = [
    {
        name: 'Rev. Duke Randolph',
        role: 'Founder & Senior Pastor',
        email: 'duke@empowermentmissions.org.uk',
        phone: '07727208820',
        department: 'Spiritual Leadership',
        image: 'https://images.unsplash.com/photo-1566492031773-4f4e44671857?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80'
    },
    {
        name: 'Sarah Johnson',
        role: 'Programs Director',
        email: 'sarah@empowermentmissions.org.uk',
        phone: '07727208822',
        department: 'Educational Programs',
        image: 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80'
    },
    {
        name: 'Michael Ochieng',
        role: 'Kenya Coordinator',
        email: 'michael@empowermentmissions.org.uk',
        phone: '+254 700 000000',
        department: 'Africa Operations',
        image: 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80'
    }
]

// Office locations
const officeLocations = [
    {
        city: 'Reading',
        address: '65 Fairwater Drive, Woodley, Reading, RG5 3JG',
        phone: '07727208820',
        email: 'reading@empowermentmissions.org.uk',
        hours: 'Mon-Fri: 9am-5pm, Sat: 10am-2pm'
    },
    {
        city: 'Bedford',
        address: '23 High Street, Bedford, MK40 1RN',
        phone: '07727208823',
        email: 'bedford@empowermentmissions.org.uk',
        hours: 'Mon-Fri: 9am-5pm, Sat: 10am-2pm'
    },
    {
        city: 'Nairobi, Kenya',
        address: 'Community Centre, Ngong Road, Nairobi',
        phone: '+254 700 000000',
        email: 'kenya@empowermentmissions.org.uk',
        hours: 'Mon-Fri: 8am-5pm EAT'
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
    <Head title="Contact Us - Empowerment Missions Int." />

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
                <span class="text-green-800 font-medium">Thank you! Your message has been sent successfully. We'll respond within 24-48 hours.</span>
            </div>
        </transition>

        <!-- Office Locations -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full text-primary text-sm font-medium mb-4">
                        <MapPin class="h-4 w-4" />
                        <span>Our Locations</span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Visit Us in Person
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        We have offices in the UK and Kenya. Please call ahead to schedule an appointment.
                    </p>
                </div>

                <div class="grid md:grid-cols-3 gap-6 lg:gap-8">
                    <div
                        v-for="location in officeLocations"
                        :key="location.city"
                        class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100"
                    >
                        <div class="p-8">
                            <div class="w-14 h-14 rounded-xl bg-primary/10 flex items-center justify-center mb-6">
                                <Building class="h-7 w-7 text-primary" />
                            </div>

                            <h3 class="text-xl font-bold mb-2">{{ location.city }}</h3>

                            <div class="space-y-3 mb-6">
                                <p class="text-sm text-muted-foreground flex items-start gap-2">
                                    <MapPin class="h-4 w-4 shrink-0 mt-0.5" />
                                    <span>{{ location.address }}</span>
                                </p>
                                <p class="text-sm text-muted-foreground flex items-center gap-2">
                                    <Phone class="h-4 w-4 shrink-0" />
                                    <span>{{ location.phone }}</span>
                                </p>
                                <p class="text-sm text-muted-foreground flex items-center gap-2">
                                    <Mail class="h-4 w-4 shrink-0" />
                                    <span>{{ location.email }}</span>
                                </p>
                                <p class="text-sm text-muted-foreground flex items-start gap-2">
                                    <Clock class="h-4 w-4 shrink-0 mt-0.5" />
                                    <span>{{ location.hours }}</span>
                                </p>
                            </div>

                            <Button as-child variant="outline" class="w-full border-primary/20 hover:bg-primary/5">
                                <a :href="`https://maps.google.com/?q=${encodeURIComponent(location.address)}`" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2">
                                    <span>Get Directions</span>
                                    <ArrowRight class="h-4 w-4" />
                                </a>
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

         <!-- Map Section -->
        <section class="h-[450px] relative">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2486.486877654321!2d-0.891232684229777!3d51.45125897962484!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48769a2f8b2b2b2b%3A0x123456789abcdef!2s65%20Fairwater%20Dr%2C%20Woodley%2C%20Reading%20RG5%203JG!5e0!3m2!1sen!2suk!4v1620000000000!5m2!1sen!2suk"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="Empowerment Missions Int. Location"
            ></iframe>

            <!-- Map Overlay Card -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 bg-white rounded-2xl shadow-2xl p-6 max-w-md w-full mx-4">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <MapPin class="h-6 w-6 text-primary" />
                    </div>
                    <div>
                        <h4 class="font-bold mb-1">Registered Office</h4>
                        <p class="text-sm text-muted-foreground mb-2">{{ charityInfo.address }}</p>
                        <div class="flex gap-2">
                            <Button as-child size="sm" variant="outline" class="text-xs">
                                <a :href="`https://maps.google.com/?q=${encodeURIComponent(charityInfo.address)}`" target="_blank" rel="noopener noreferrer">
                                    Get Directions
                                </a>
                            </Button>
                            <Button as-child size="sm" variant="ghost" class="text-xs">
                                <a href="tel:07727208820">
                                    Call
                                </a>
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main Contact Section with Form and Info -->
        <section class="py-20 bg-gradient-to-b from-primary/5 to-white">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-5 gap-8">
                    <!-- Contact Information - 2 columns -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Registered Charity Info -->
                        <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                                    <Building class="h-6 w-6 text-primary" />
                                </div>
                                <div>
                                    <h3 class="text-xl font-bold">Registered Charity</h3>
                                    <p class="text-sm text-muted-foreground">UK Registered</p>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-muted-foreground">Charity Number</span>
                                    <span class="text-sm font-medium">{{ charityInfo.charityNumber }}</span>
                                </div>
                                <div class="flex justify-between py-2 border-b border-gray-100">
                                    <span class="text-sm text-muted-foreground">Company Number</span>
                                    <span class="text-sm font-medium">{{ charityInfo.companyNumber }}</span>
                                </div>
                                <div class="flex justify-between py-2">
                                    <span class="text-sm text-muted-foreground">Founded</span>
                                    <span class="text-sm font-medium">2011</span>
                                </div>
                            </div>
                        </div>

                        <!-- Office Hours -->
                        <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                            <div class="flex items-center gap-3 mb-6">
                                <div class="w-12 h-12 rounded-xl bg-primary/10 flex items-center justify-center">
                                    <Clock class="h-6 w-6 text-primary" />
                                </div>
                                <h3 class="text-xl font-bold">Office Hours</h3>
                            </div>

                            <div class="space-y-3">
                                <div v-for="schedule in charityInfo.hours" :key="schedule.day" class="flex justify-between py-2 border-b border-gray-100 last:border-0">
                                    <span class="text-sm text-muted-foreground">{{ schedule.day }}</span>
                                    <span class="text-sm font-medium">{{ schedule.hours }}</span>
                                </div>
                            </div>

                            <div class="mt-4 p-3 bg-amber-50 rounded-lg">
                                <p class="text-xs text-amber-800 flex items-start gap-2">
                                    <Shield class="h-4 w-4 shrink-0 mt-0.5" />
                                    <span>Emergency support available 24/7 for urgent cases. Call our emergency line.</span>
                                </p>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                            <h3 class="text-xl font-bold mb-6">Connect With Us</h3>
                            <div class="grid grid-cols-5 gap-3">
                                <a
                                    v-for="social in socialLinks"
                                    :key="social.name"
                                    :href="social.url"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="group flex flex-col items-center p-3 rounded-xl hover:bg-gray-50 transition-colors"
                                >
                                    <div :class="`w-10 h-10 rounded-lg bg-gray-100 group-hover:${social.color} group-hover:text-white flex items-center justify-center transition-all duration-300`">
                                        <component :is="social.icon" class="h-5 w-5" />
                                    </div>
                                    <span class="text-xs mt-1 text-muted-foreground">{{ social.followers }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Form - 3 columns -->
                    <div class="lg:col-span-3">
                        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                            <!-- Form Header -->
                            <div class="p-8 bg-gradient-to-r from-green-100 to-green-200 border-b border-gray-100">
                                <h2 class="text-2xl font-bold mb-2">Send Us a Message</h2>
                                <p class="text-muted-foreground">Fill out the form below and we'll get back to you within 24-48 hours.</p>
                            </div>

                            <!-- Form -->
                            <form @submit.prevent="submit" class="p-8 space-y-6">
                                <!-- Success Message (inline) -->
                                <div v-if="form.wasSuccessful" class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-center gap-3">
                                    <CheckCircle class="h-5 w-5 text-green-600" />
                                    <span class="text-green-800 text-sm">Thank you! Your message has been sent successfully.</span>
                                </div>

                                <!-- Name Fields -->
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label for="firstName" class="text-sm font-medium">First Name <span class="text-red-500">*</span></label>
                                        <input
                                            id="firstName"
                                            v-model="form.firstName"
                                            type="text"
                                            required
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                            placeholder="John"
                                        />
                                        <p v-if="form.errors.firstName" class="text-sm text-red-600">{{ form.errors.firstName }}</p>
                                    </div>

                                    <div class="space-y-2">
                                        <label for="lastName" class="text-sm font-medium">Last Name <span class="text-red-500">*</span></label>
                                        <input
                                            id="lastName"
                                            v-model="form.lastName"
                                            type="text"
                                            required
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                            placeholder="Doe"
                                        />
                                        <p v-if="form.errors.lastName" class="text-sm text-red-600">{{ form.errors.lastName }}</p>
                                    </div>
                                </div>

                                <!-- Contact Fields -->
                                <div class="grid md:grid-cols-2 gap-6">
                                    <div class="space-y-2">
                                        <label for="email" class="text-sm font-medium">Email Address <span class="text-red-500">*</span></label>
                                        <input
                                            id="email"
                                            v-model="form.email"
                                            type="email"
                                            required
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                            placeholder="john@example.com"
                                        />
                                        <p v-if="form.errors.email" class="text-sm text-red-600">{{ form.errors.email }}</p>
                                    </div>

                                    <div class="space-y-2">
                                        <label for="phone" class="text-sm font-medium">Phone Number</label>
                                        <input
                                            id="phone"
                                            v-model="form.phone"
                                            type="tel"
                                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition"
                                            placeholder="07727 208820"
                                        />
                                    </div>
                                </div>

                                <!-- Message -->
                                <div class="space-y-2">
                                    <label for="message" class="text-sm font-medium">Message <span class="text-red-500">*</span></label>
                                    <textarea
                                        id="message"
                                        v-model="form.message"
                                        required
                                        rows="5"
                                        class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition resize-none"
                                        placeholder="Please tell us how we can help you..."
                                    ></textarea>
                                    <p v-if="form.errors.message" class="text-sm text-red-600">{{ form.errors.message }}</p>
                                </div>

                                <!-- Preferences -->
                                <div class="space-y-4">
                                    <div class="flex items-start gap-3">
                                        <input
                                            id="newsletter"
                                            v-model="form.newsletter"
                                            type="checkbox"
                                            class="mt-1 h-4 w-4 text-primary rounded focus:ring-primary/20"
                                        />
                                        <label for="newsletter" class="text-sm text-muted-foreground">
                                            I'd like to receive updates about charity news, events, and opportunities to get involved.
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
                                            <span class="text-red-500">*</span> I consent to Empowerment Missions Int. processing my personal data to respond to my inquiry. View our <Link href="/privacy" class="text-primary hover:underline">Privacy Policy</Link>.
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
                                    {{ form.processing ? 'Sending...' : 'Send Message' }}
                                </Button>

                                <!-- Response time note -->
                                <p class="text-xs text-center text-muted-foreground">
                                    By submitting this form, you agree to our privacy policy and terms of use.
                                    We typically respond within 24-48 hours.
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-4">
                <div class="text-center max-w-3xl mx-auto mb-16">
                    <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full text-primary text-sm font-medium mb-4">
                        <HelpCircle class="h-4 w-4" />
                        <span>FAQs</span>
                    </div>
                    <h2 class="text-3xl lg:text-4xl font-bold tracking-tight mb-4">
                        Frequently Asked Questions
                    </h2>
                    <p class="text-lg text-muted-foreground">
                        Quick answers to common questions about contacting us.
                    </p>
                </div>

                <div class="max-w-3xl mx-auto space-y-4">
                    <div
                        v-for="(faq, index) in faqItems"
                        :key="index"
                        class="bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100"
                    >
                        <details class="group">
                            <summary class="flex items-center justify-between p-6 cursor-pointer list-none">
                                <h3 class="text-lg font-semibold group-open:text-primary transition-colors">
                                    {{ faq.question }}
                                </h3>
                                <ChevronRight class="h-5 w-5 text-primary transform group-open:rotate-90 transition-transform" />
                            </summary>
                            <div class="px-6 pb-6 text-muted-foreground">
                                {{ faq.answer }}
                            </div>
                        </details>
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

details > summary {
    list-style: none;
}

details > summary::-webkit-details-marker {
    display: none;
}
</style>
