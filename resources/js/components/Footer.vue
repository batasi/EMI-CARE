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
      title: 'About',
      items: [
        { title: 'Our Story', href: '/about/story' },
        { title: 'Leadership', href: '/about/leadership' },
        { title: 'Beliefs', href: '/about/beliefs' },
        { title: 'Ministries', href: '/ministries' }
      ]
    },
    {
      title: 'Connect',
      items: [
        { title: 'Service Times', href: '/service-times' },
        { title: 'Location', href: '/directions' },
        { title: 'Live Stream', href: '/live' },
        { title: 'Contact', href: '/contact' }
      ]
    },
    {
      title: 'Resources',
      items: [
        { title: 'Sermons', href: '/sermons' },
        { title: 'Events', href: '/events' },
        { title: 'Prayer', href: '/prayer-request' },
        { title: 'Give', href: '/give' }
      ]
    }
  ]
})

const churchInfo = {
  name: 'Empowerment Missions International',
  location: '123 Church Street, Nairobi, Kenya',
  phone: '+254 712 345 678',
  email: 'info@empowermentmissions.org'
}

const socialLinks = [
  { icon: Facebook, href: 'https://facebook.com/empowermentmissions', label: 'Facebook' },
  { icon: Instagram, href: 'https://instagram.com/empowermentmissions', label: 'Instagram' },
  { icon: Youtube, href: 'https://youtube.com/empowermentmissions', label: 'YouTube' }
]

const currentYear = new Date().getFullYear()
</script>

<template>
  <footer class="bg-gray-900 text-white">
    <!-- Main Footer Content -->
    <div class="container mx-auto px-4 py-12">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-8">
        <!-- Brand & Contact -->
        <div class="lg:col-span-5 space-y-6">
          <div class="space-y-4">
            <div class="flex items-center gap-3">
              <AppLogoIcon class="h-10 w-10 fill-white" />
              <div>
                <h2 class="text-xl font-bold">{{ churchInfo.name }}</h2>
                <p class="text-gray-400 text-sm">Transforming Lives Through Christ</p>
              </div>
            </div>

            <p class="text-gray-300 text-sm">
              A vibrant community of faith where lives are transformed through the power of God's Word.
            </p>
          </div>

          <!-- Contact Information -->
          <div class="space-y-3">
            <div class="flex items-center gap-3">
              <MapPin class="h-4 w-4 text-gray-400 flex-shrink-0" />
              <span class="text-sm text-gray-300">{{ churchInfo.location }}</span>
            </div>
            <div class="flex items-center gap-3">
              <Phone class="h-4 w-4 text-gray-400 flex-shrink-0" />
              <span class="text-sm text-gray-300">{{ churchInfo.phone }}</span>
            </div>
            <div class="flex items-center gap-3">
              <Mail class="h-4 w-4 text-gray-400 flex-shrink-0" />
              <span class="text-sm text-gray-300">{{ churchInfo.email }}</span>
            </div>
          </div>

          <!-- Social Media -->
          <div class="pt-2">
            <div class="flex gap-3">
              <a
                v-for="social in socialLinks"
                :key="social.label"
                :href="social.href"
                target="_blank"
                rel="noopener noreferrer"
                class="h-9 w-9 rounded-full bg-gray-800 hover:bg-primary transition-colors flex items-center justify-center"
                :aria-label="`Follow us on ${social.label}`"
              >
                <component
                  :is="social.icon"
                  class="h-4 w-4 text-gray-300 hover:text-white transition-colors"
                />
              </a>
            </div>
          </div>
        </div>

        <!-- Navigation Links -->
        <div class="lg:col-span-7">
          <div class="grid grid-cols-2 md:grid-cols-3 gap-6 md:gap-8">
            <div v-for="section in props.items" :key="section.title" class="space-y-3">
              <h3 class="font-semibold text-white text-base mb-2">
                {{ section.title }}
              </h3>
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

          <!-- Newsletter Signup -->
          <div class="mt-8 pt-8 border-t border-gray-800">
            <div class="space-y-3">
              <h3 class="font-semibold text-white">Stay Updated</h3>
              <p class="text-gray-400 text-sm">
                Subscribe for updates and spiritual insights.
              </p>
              <form class="flex gap-2">
                <input
                  type="email"
                  placeholder="Your email"
                  class="flex-1 px-4 py-2 rounded bg-gray-800 border border-gray-700 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-primary"
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
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-gray-800">
      <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
          <!-- Copyright -->
          <div class="text-gray-500 text-sm">
            © {{ currentYear }} {{ churchInfo.name }}
          </div>

          <!-- Legal Links -->
          <div class="flex flex-wrap justify-center gap-4 text-sm">
            <Link href="/privacy-policy" class="text-gray-500 hover:text-gray-300 transition-colors">
              Privacy
            </Link>
            <Link href="/terms-of-use" class="text-gray-500 hover:text-gray-300 transition-colors">
              Terms
            </Link>
            <Link href="/sitemap" class="text-gray-500 hover:text-gray-300 transition-colors">
              Sitemap
            </Link>
          </div>

          <!-- Give Button -->
          <Link
            href="/give"
            class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded text-sm font-medium transition-colors"
          >
            <Heart class="h-4 w-4" />
            Give Online
          </Link>
        </div>
      </div>
    </div>
  </footer>
</template>
