<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import FrontAppLayout from '@/layouts/FrontAppLayout.vue';
import { dashboard } from '@/routes';
import { type BreadcrumbItem } from '@/types';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: dashboard().url,
    },
];
</script>

<template>

    <Head title="Dashboard" />
   <!-- Top Announcement Bar -->
    <div class="bg-blue-800 text-white py-2 px-4 text-center text-sm">
        <div class="container mx-auto flex items-center justify-center">
            Join us this Sunday at 9:00 AM & 11:00 AM |
            <a href="/live" class="ml-2 font-semibold underline hover:text-yellow-300 transition-colors">
            Watch Live Stream →
            </a>
        </div>
    </div>
    <FrontAppLayout :breadcrumbs="breadcrumbs">
        <div class="min-h-screen bg-gray-50">


            <!-- Navigation -->
            <nav class="bg-white shadow-md sticky top-0 z-50">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-xl">EMI</span>
                    </div>
                    <div>
                    <h1 class="text-2xl font-bold text-gray-900">Empowerment Missions International</h1>
                    <p class="text-sm text-gray-600">Nairobi, Kenya</p>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="/" class="font-semibold text-blue-600 hover:text-blue-800 transition-colors">Home</a>
                    <a href="/about" class="text-gray-700 hover:text-blue-600 transition-colors">About Us</a>
                    <a href="/ministries" class="text-gray-700 hover:text-blue-600 transition-colors">Ministries</a>
                    <a href="/sermons" class="text-gray-700 hover:text-blue-600 transition-colors">Sermons</a>
                    <a href="/events" class="text-gray-700 hover:text-blue-600 transition-colors">Events</a>
                    <a href="/give" class="bg-yellow-500 text-gray-900 px-4 py-2 rounded-lg font-semibold hover:bg-yellow-600 transition-colors">
                    Give Online
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                </div>
            </div>
            </nav>

            <!-- Hero Section -->
            <section class="relative h-[80vh] min-h-[600px] flex items-center overflow-hidden">
            <!-- Background -->
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 to-purple-900/60"></div>
                <img
                src="https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                alt="Church worship"
                class="w-full h-full object-cover"
                />
            </div>

            <!-- Content -->
            <div class="container mx-auto px-4 relative z-10">
                <div class="max-w-3xl">
                <span class="inline-flex items-center px-4 py-2 rounded-full bg-white/10 backdrop-blur-sm text-white text-sm font-semibold mb-6">
                    Experience God's Presence
                </span>

                <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                    A Community of
                    <span class="text-yellow-400">Faith</span>,
                    <span class="text-yellow-400">Hope</span> &
                    <span class="text-yellow-400">Love</span>
                </h1>

                <p class="text-xl text-white/90 mb-8 max-w-2xl">
                    Join us as we worship, grow in faith, and serve our community in Nairobi and beyond.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="/live" class="bg-yellow-500 text-gray-900 px-8 py-3 rounded-lg font-semibold text-lg hover:bg-yellow-600 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                    </svg>
                    Watch Live
                    </a>

                    <a href="/service-times" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-semibold text-lg hover:bg-white/10 transition-colors">
                    Service Times
                    </a>
                </div>
                </div>
            </div>
            </section>

            <!-- Quick Stats -->
            <div class="bg-white py-8 shadow-lg -mt-12 relative z-20 rounded-t-3xl">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">2</div>
                    <div class="text-gray-600">Sunday Services</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">24/7</div>
                    <div class="text-gray-600">Prayer Line</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">15+</div>
                    <div class="text-gray-600">Ministries</div>
                </div>
                <div class="text-center">
                    <div class="text-3xl font-bold text-blue-600 mb-2">Online</div>
                    <div class="text-gray-600">Live Streaming</div>
                </div>
                </div>
            </div>
            </div>

            <!-- Welcome Section -->
            <section class="py-20">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="md:w-1/2">
                    <img
                    src="https://images.unsplash.com/photo-1563492065599-3520f775eeed?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                    alt="Church community"
                    class="rounded-2xl shadow-xl"
                    />
                </div>

                <div class="md:w-1/2">
                    <span class="text-blue-600 font-semibold uppercase tracking-wider">Welcome</span>
                    <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-6">
                    You're Welcome Here
                    </h2>
                    <p class="text-gray-600 text-lg mb-6">
                    At Empowerment Missions, we are passionate about helping people discover their purpose and grow in their relationship with God. Whether you're new to faith or have been following Jesus for years, there's a place for you here.
                    </p>
                    <div class="space-y-4 mb-8">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        </div>
                        <span class="text-gray-700">Vibrant worship and biblical teaching</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        </div>
                        <span class="text-gray-700">Loving community for all ages</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        </div>
                        <span class="text-gray-700">Opportunities to serve and grow</span>
                    </div>
                    </div>
                    <a href="/about" class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-800 transition-colors">
                    Learn more about us
                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                    </a>
                </div>
                </div>
            </div>
            </section>

            <!-- Upcoming Events -->
            <section class="py-20 bg-gray-100">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                <span class="text-blue-600 font-semibold uppercase tracking-wider">What's Happening</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-4">Upcoming Events</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Join us for our upcoming services, conferences, and community events</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Event 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex flex-col items-center justify-center mr-4">
                        <span class="text-blue-600 font-bold text-lg">SUN</span>
                        <span class="text-gray-900 font-bold">14</span>
                        </div>
                        <div>
                        <h3 class="font-bold text-lg text-gray-900">Sunday Service</h3>
                        <p class="text-gray-600">9:00 AM & 11:00 AM</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">Join us for worship, prayer, and biblical teaching.</p>
                    <a href="/events/sunday-service" class="text-blue-600 font-semibold hover:text-blue-800 transition-colors">
                        More details →
                    </a>
                    </div>
                </div>

                <!-- Event 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex flex-col items-center justify-center mr-4">
                        <span class="text-blue-600 font-bold text-lg">WED</span>
                        <span class="text-gray-900 font-bold">17</span>
                        </div>
                        <div>
                        <h3 class="font-bold text-lg text-gray-900">Midweek Prayer</h3>
                        <p class="text-gray-600">6:30 PM - 8:00 PM</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">Corporate prayer and intercession night.</p>
                    <a href="/events/prayer-night" class="text-blue-600 font-semibold hover:text-blue-800 transition-colors">
                        More details →
                    </a>
                    </div>
                </div>

                <!-- Event 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex flex-col items-center justify-center mr-4">
                        <span class="text-blue-600 font-bold text-lg">SAT</span>
                        <span class="text-gray-900 font-bold">20</span>
                        </div>
                        <div>
                        <h3 class="font-bold text-lg text-gray-900">Youth Conference</h3>
                        <p class="text-gray-600">10:00 AM - 4:00 PM</p>
                        </div>
                    </div>
                    <p class="text-gray-700 mb-4">Empowering the next generation.</p>
                    <a href="/events/youth-conference" class="text-blue-600 font-semibold hover:text-blue-800 transition-colors">
                        More details →
                    </a>
                    </div>
                </div>
                </div>

                <div class="text-center mt-12">
                <a href="/events" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-colors">
                    View All Events
                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
                </div>
            </div>
            </section>

            <!-- Latest Sermons -->
            <section class="py-20">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12">
                <span class="text-blue-600 font-semibold uppercase tracking-wider">Recent Messages</span>
                <h2 class="text-4xl font-bold text-gray-900 mt-2 mb-4">Latest Sermons</h2>
                <p class="text-gray-600 text-lg max-w-2xl mx-auto">Listen to our latest messages and be inspired</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Sermon 1 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="h-48 bg-blue-100 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <button class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center hover:bg-white transition-colors">
                        <svg class="w-8 h-8 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                        </svg>
                        </button>
                    </div>
                    </div>
                    <div class="p-6">
                    <span class="text-sm text-blue-600 font-semibold">January 14, 2024</span>
                    <h3 class="text-xl font-bold text-gray-900 my-2">The Power of Faith</h3>
                    <p class="text-gray-600 mb-4">How faith transforms challenges into victories</p>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700 font-medium">Pastor John Kamau</span>
                        <span class="text-sm text-gray-500">45 min</span>
                    </div>
                    </div>
                </div>

                <!-- Sermon 2 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="h-48 bg-purple-100 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <button class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center hover:bg-white transition-colors">
                        <svg class="w-8 h-8 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                        </svg>
                        </button>
                    </div>
                    </div>
                    <div class="p-6">
                    <span class="text-sm text-purple-600 font-semibold">January 7, 2024</span>
                    <h3 class="text-xl font-bold text-gray-900 my-2">Finding Hope in Christ</h3>
                    <p class="text-gray-600 mb-4">Discovering hope in difficult seasons</p>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700 font-medium">Rev. Sarah Mwangi</span>
                        <span class="text-sm text-gray-500">52 min</span>
                    </div>
                    </div>
                </div>

                <!-- Sermon 3 -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="h-48 bg-yellow-100 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <button class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center hover:bg-white transition-colors">
                        <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/>
                        </svg>
                        </button>
                    </div>
                    </div>
                    <div class="p-6">
                    <span class="text-sm text-yellow-600 font-semibold">December 31, 2023</span>
                    <h3 class="text-xl font-bold text-gray-900 my-2">New Year, New Vision</h3>
                    <p class="text-gray-600 mb-4">Setting godly goals for the new year</p>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-700 font-medium">Bishop David Ochieng</span>
                        <span class="text-sm text-gray-500">58 min</span>
                    </div>
                    </div>
                </div>
                </div>

                <div class="text-center">
                <a href="/sermons" class="inline-flex items-center px-6 py-3 bg-gray-900 text-white font-semibold rounded-lg hover:bg-black transition-colors">
                    Browse All Sermons
                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </a>
                </div>
            </div>
            </section>

            <!-- Footer -->
            <footer class="bg-gray-900 text-white py-12">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                        <span class="text-white font-bold">EMI</span>
                    </div>
                    <div>
                        <h3 class="font-bold text-lg">Empowerment Missions International</h3>
                        <p class="text-gray-400 text-sm">Nairobi, Kenya</p>
                    </div>
                    </div>
                    <p class="text-gray-400">
                    A vibrant community of faith where lives are transformed through the power of the Holy Spirit.
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                    <li><a href="/about" class="text-gray-400 hover:text-white transition-colors">About Us</a></li>
                    <li><a href="/beliefs" class="text-gray-400 hover:text-white transition-colors">Our Beliefs</a></li>
                    <li><a href="/leadership" class="text-gray-400 hover:text-white transition-colors">Leadership</a></li>
                    <li><a href="/ministries" class="text-gray-400 hover:text-white transition-colors">Ministries</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-6">Connect</h4>
                    <ul class="space-y-3">
                    <li><a href="/sermons" class="text-gray-400 hover:text-white transition-colors">Sermons</a></li>
                    <li><a href="/events" class="text-gray-400 hover:text-white transition-colors">Events</a></li>
                    <li><a href="/give" class="text-gray-400 hover:text-white transition-colors">Give Online</a></li>
                    <li><a href="/contact" class="text-gray-400 hover:text-white transition-colors">Contact Us</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-lg mb-6">Contact Info</h4>
                    <ul class="space-y-3 text-gray-400">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                        </svg>
                        123 Church Street, Nairobi
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                        </svg>
                        +254 700 123 456
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                        </svg>
                        info@empowermentmissions.org.uk
                    </li>
                    </ul>
                </div>
                </div>

                <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>© 2024 Empowerment Missions International. All rights reserved.</p>
                </div>
            </div>
            </footer>
        </div>
    </FrontAppLayout>

</template>
