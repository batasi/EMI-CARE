<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { Facebook, Instagram, Youtube, Mail, Phone, MapPin, Heart, Shield, Building } from 'lucide-vue-next'
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
        { title: 'Economic Empowerment', href: '/economic' },
        { title: 'Spiritual Growth', href: '/spiritual' },
        { title: 'EMI-Care UK', href: '/emi-care' }
      ]
    },
    {
      title: 'Get Involved',
      items: [
        { title: 'Make a Donation', href: '/donate' },
        { title: 'Volunteer', href: '/volunteer' },
        { title: 'Request Support', href: '/support' },
        { title: 'Prayer Requests', href: '/prayer-request' },
        { title: 'Partnerships', href: '/partnerships' }
      ]
    },
    {
      title: 'About Us',
      items: [
        { title: 'Our Story', href: '/about' },
        { title: 'Trustees', href: '/trustees' },
        { title: 'Annual Reports', href: '/reports' },
        { title: 'Policies', href: '/policies' },
        { title: 'Contact', href: '/contact' }
      ]
    }
  ]
})

// Updated with UK charity information
const charityInfo = {
  name: 'Empowerment Missions International',
  charityNumber: '1141696',
  tagline: 'Empowering People - Socio-spiritually, Economically & Educationally',
  address: '65 Fairwater Drive, Woodley, Reading, RG5 3JG',
  phone: '07727208820',
  email: 'enquiry@empowermentmissions.org.uk',
  website: 'www.empowermentmissions.org.uk',
  companyNumber: '05893970'
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
                <h2 class="text-xl font-bold">{{ charityInfo.name }}</h2>
                <div class="flex items-center gap-2 mt-1">
                  <Shield class="h-4 w-4 text-primary" />
                  <p class="text-gray-300 text-sm">
                    UK Registered Charity No: {{ charityInfo.charityNumber }}
                  </p>
                </div>
              </div>
            </div>

            <p class="text-gray-300 text-sm">
              {{ charityInfo.tagline }}. Empowering communities in the UK and Africa through faith-based initiatives.
            </p>
          </div>

          <!-- Contact Information -->
          <div class="space-y-3">
            <div class="flex items-start gap-3">
              <MapPin class="h-4 w-4 text-gray-400 flex-shrink-0 mt-0.5" />
              <div>
                <p class="text-sm text-gray-300">Registered Office:</p>
                <p class="text-sm text-gray-300">{{ charityInfo.address }}</p>
              </div>
            </div>
            <div class="flex items-center gap-3">
              <Phone class="h-4 w-4 text-gray-400 flex-shrink-0" />
              <span class="text-sm text-gray-300">{{ charityInfo.phone }}</span>
            </div>
            <div class="flex items-center gap-3">
              <Mail class="h-4 w-4 text-gray-400 flex-shrink-0" />
              <span class="text-sm text-gray-300">{{ charityInfo.email }}</span>
            </div>
            <div class="flex items-center gap-3">
              <Building class="h-4 w-4 text-gray-400 flex-shrink-0" />
              <span class="text-sm text-gray-300">Company No: {{ charityInfo.companyNumber }}</span>
            </div>
          </div>

          <!-- Social Media -->
          <div class="pt-4">
            <p class="text-sm text-gray-300 mb-3">Follow our journey</p>
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
                    class="text-gray-400 hover:text-white text-sm transition-colors hover:pl-1 duration-200"
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
                Subscribe for updates on our projects, impact reports, and community initiatives.
              </p>
              <form class="flex flex-col sm:flex-row gap-2">
                <input
                  type="email"
                  placeholder="Your email address"
                  class="flex-1 px-4 py-2.5 rounded bg-gray-800 border border-gray-700 text-white text-sm placeholder-gray-500 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary"
                  required
                />
                <button
                  type="submit"
                  class="bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded text-sm font-medium transition-colors whitespace-nowrap"
                >
                  Subscribe
                </button>
              </form>
              <p class="text-gray-500 text-xs pt-1">
                We respect your privacy. Unsubscribe at any time.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-gray-800">
      <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
          <!-- Copyright & Charity Info -->
          <div class="text-gray-500 text-sm text-center md:text-left">
            <p>© {{ currentYear }} {{ charityInfo.name }}</p>
            <p class="text-gray-400 mt-1">A UK Registered Charity (No: {{ charityInfo.charityNumber }})</p>
          </div>

          <!-- Legal & Policy Links -->
          <div class="flex flex-wrap justify-center gap-4 text-sm">
            <Link href="/privacy-policy" class="text-gray-400 hover:text-white transition-colors">
              Privacy Policy
            </Link>
            <Link href="/terms-of-use" class="text-gray-400 hover:text-white transition-colors">
              Terms of Use
            </Link>
            <Link href="/safeguarding" class="text-gray-400 hover:text-white transition-colors">
              Safeguarding
            </Link>
            <Link href="/accessibility" class="text-gray-400 hover:text-white transition-colors">
              Accessibility
            </Link>
            <Link href="/sitemap" class="text-gray-400 hover:text-white transition-colors">
              Sitemap
            </Link>
          </div>

          <!-- Donate Button -->
          <Link
            href="/donate"
            class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-5 py-2.5 rounded text-sm font-medium transition-colors group"
          >
            <Heart class="h-4 w-4 group-hover:scale-110 transition-transform" />
            Donate Now
          </Link>
        </div>

        <!-- Additional Charity Information -->
        <div class="mt-6 pt-6 border-t border-gray-800">
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center md:text-left">
            <div>
              <p class="text-gray-400 text-xs">
                Gift Aid Registered
              </p>
            </div>
            <div>
              <p class="text-gray-400 text-xs">
                Areas of Operation: Bedford, Reading, Kenya
              </p>
            </div>
            <div>
              <p class="text-gray-400 text-xs">
                Company Limited by Guarantee (No: {{ charityInfo.companyNumber }})
              </p>
            </div>
          </div>
        </div>

        <!-- Charity Commission Link -->
        <div class="mt-4 text-center">
          <a
            href="https://register-of-charities.charitycommission.gov.uk/charity-search/-/charity-details/1141696"
            target="_blank"
            rel="noopener noreferrer"
            class="inline-flex items-center gap-2 text-gray-400 hover:text-white text-sm transition-colors"
          >
            <Shield class="h-4 w-4" />
            View our charity details on the Charity Commission Register
          </a>
        </div>
      </div>
    </div>
  </footer>
</template>
