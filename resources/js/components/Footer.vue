<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { Facebook, Instagram, Youtube, Mail, Phone, MapPin, Heart } from 'lucide-vue-next'
import AppLogoIcon from '@/components/AppLogoIcon.vue'

export interface FooterItem {
  title: string
  href: string
}

export interface FooterSection {
  title: string
  items: FooterItem[]
}

export interface FooterProps {
  items?: FooterSection[]
}

const props = withDefaults(defineProps<FooterProps>(), {
  items: () => [
    {
      title: 'Our Work',
      items: [
        { title: 'S.E.E. Model', href: '/see-model' },
        { title: 'Education Support', href: '/education' },
        { title: 'Economic Empowerment', href: '/economic' }
      ]
    },
    {
      title: 'Get Involved',
      items: [
        { title: 'Donate', href: '/donate' },
        { title: 'Volunteer', href: '/volunteer' },
        { title: 'Prayer Requests', href: '/prayer-request' }
      ]
    },
    {
      title: 'About',
      items: [
        { title: 'Our Story', href: '/about' },
        { title: 'Contact', href: '/contact' },
        { title: 'Policies', href: '/policies' }
      ]
    }
  ]
})

const charityInfo = {
  name: 'Empowerment Missions International',
  charityNumber: '1141696',
  address: '65 Fairwater Drive, Woodley, Reading, RG5 3JG',
  email: 'enquiry@empowermentmissions.org.uk',
  phone: '07727208820'
}

const socialLinks = [
  { icon: Facebook, href: 'https://facebook.com/empowermentmissions', label: 'Facebook' },
  { icon: Instagram, href: 'https://instagram.com/empowermentmissions', label: 'Instagram' },
  { icon: Youtube, href: 'https://youtube.com/empowermentmissions', label: 'YouTube' }
]

const currentYear = new Date().getFullYear()
</script>

<template>
  <footer class="bg-green-500 text-primary">
    <!-- Main Footer Content -->
    <div class="container mx-auto px-4 py-12">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Brand & Contact (Left) -->
        <div class="lg:col-span-4 space-y-4">
            <div class="relative">
                <AppLogoIcon
                    class="w-auto h-25 sm:h-25 lg:h-25 fill-current text-primary transition-transform group-hover:scale-110"
                    style="width: auto; max-width: none;"
                />
            </div>

          <p class="font-semibold ">
            UK Registered Charity No: {{ charityInfo.charityNumber }}
          </p>

          <div class="space-y-2 font-semibold text-primary-foreground">
            <div class="flex items-center gap-2">
              <MapPin class="h-3.5 w-3.5 flex-shrink-0 font-semibold text-primary-foreground" />
              <span>{{ charityInfo.address }}</span>
            </div>
            <div class="flex items-center gap-2">
              <Mail class="h-3.5 w-3.5 flex-shrink-0 font-semibold text-primary-foreground" />
              <span>{{ charityInfo.email }}</span>
            </div>
            <div class="flex items-center gap-2">
              <Phone class="h-3.5 w-3.5 flex-shrink-0 font-semibold text-primary-foreground" />
              <span>{{ charityInfo.phone }}</span>
            </div>
          </div>

          <div class="flex gap-3 pt-2 ">
            <a
              v-for="social in socialLinks"
              :key="social.label"
              :href="social.href"
              target="_blank"
              rel="noopener noreferrer"
              class="text-gray-400 hover:text-white transition-colors"
              :aria-label="social.label"
            >
              <component :is="social.icon" class="h-4 w-4 font-semibold text-primary-foreground" />
            </a>
          </div>
        </div>

        <!-- Navigation & Subscribe (Middle) -->
        <div class="lg:col-span-5">
          <div class="grid grid-cols-3 gap-6 mb-6">
            <div v-for="section in props.items" :key="section.title">
              <h3 class="font-semibold text-sm mb-3">{{ section.title }}</h3>
              <ul class="space-y-2">
                <li v-for="item in section.items" :key="item.title">
                  <Link
                    :href="item.href"
                    class="text-gray-400 hover:text-white text-sm transition-colors"
                  >
                    {{ item.title }}
                  </Link>
                </li>
              </ul>
            </div>
          </div>

          <!-- Subscribe Section -->
          <div class="border-t border-gray-800 pt-6">
            <h3 class="font-semibold mb-2">Subscribe to our newsletter</h3>
            <p class="font-semibold text-primary-foreground mb-3">Get updates on our projects and impact</p>
            <form class="flex gap-2">
              <input
                type="email"
                placeholder="Your email address"
                class="flex-1 px-3 py-2 bg-blue-800 border border-gray-700 rounded text-white text-sm placeholder-gray-500 focus:outline-none focus:border-primary"
                required
              />
              <button
                type="submit"
                class="bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded text-sm font-medium transition-colors whitespace-nowrap"
              >
                Subscribe
              </button>
            </form>
          </div>
        </div>

        <!-- CTA (Right) -->
        <div class="lg:col-span-3">
          <Link
            href="/donations"
            class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded text-sm font-medium transition-colors mb-4"
          >
            <Heart class="h-4 w-4" />
            Donate Now
          </Link>

          <p class="font-semibold text-primary-foreground">
            Empowering communities in the UK and Africa through faith-based initiatives.
          </p>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-white">
      <div class="container mx-auto px-4 py-4">
        <div class="flex flex-col md:flex-row justify-between items-center gap-2 text-black">
          <div class="font-semibold text-primary-foreground">© {{ currentYear }} {{ charityInfo.name }}</div>
          <div class="font-semibold text-primary-foreground">Designed & Developed by <u class="font-semibold text-primary">bAtasi</u></div>
          <div class="flex gap-4 font-semibold text-primary-foreground">
            <Link href="/privacy-policy" class="hover:text-white transition-colors">Privacy</Link>
            <Link href="/terms-of-use" class="hover:text-white transition-colors">Terms</Link>
            <Link href="/safeguarding" class="hover:text-white transition-colors">Safeguarding</Link>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>
