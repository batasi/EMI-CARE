<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import { Menu, Heart, PlayCircle, Phone, Calendar, ChevronDown, Shield } from 'lucide-vue-next'
import { computed, ref } from 'vue'
import AppLogoIcon from '@/components/AppLogoIcon.vue'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { Button } from '@/components/ui/button'
import {
    Collapsible,
    CollapsibleContent,
    CollapsibleTrigger,
} from '@/components/ui/collapsible'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuTrigger,
    DropdownMenuItem,
    DropdownMenuSeparator,
} from '@/components/ui/dropdown-menu'
import {
    NavigationMenu,
    NavigationMenuItem,
    NavigationMenuList,
    NavigationMenuContent,
    NavigationMenuTrigger,
    NavigationMenuLink,
    navigationMenuTriggerStyle,
} from '@/components/ui/navigation-menu'
import {
    Sheet,
    SheetContent,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
    SheetClose,
} from '@/components/ui/sheet'
import {
    Tooltip,
    TooltipContent,
    TooltipProvider,
    TooltipTrigger,
} from '@/components/ui/tooltip'
import { useCurrentUrl } from '@/composables/useCurrentUrl'
import type { NavItem } from '@/types'

type NavItemWithExact = NavItem & {
    exact?: boolean
    children?: NavItem[]
}

type NavItemWithBadge = NavItem & {
    badge?: string | null
}

type Props = {
    showLiveBadge?: boolean
    showGiveButton?: boolean
    churchName?: string
    churchLocation?: string
}

const props = withDefaults(defineProps<Props>(), {
    showLiveBadge: false,
    showGiveButton: true,
    churchName: 'Empowerment Missions International',
    churchLocation: ''
})

const page = usePage()
const { isCurrentUrl, whenCurrentUrl } = useCurrentUrl()

const activeItemStyles = 'text-primary bg-primary/10 dark:bg-primary/20'

// Track expanded mobile menu items
const expandedMobileItems = ref<Record<string, boolean>>({})

const toggleMobileItem = (title: string) => {
    expandedMobileItems.value[title] = !expandedMobileItems.value[title]
}

// Updated navigation items for charity organization
const mainNavItems: NavItemWithExact[] = [
    {
        title: 'Home',
        href: '/',
        exact: true
    },
    {
        title: 'About Us',
        href: '/about',
        children: [
            { title: 'Our Story', href: '/about/story' },
            { title: 'S.E.E. Model', href: '/about/see-model' },
            { title: 'Leadership', href: '/about/leadership' },
            { title: 'Annual Reports', href: '/about/reports' },
            { title: 'Our Policies', href: '/about/policies' }
        ]
    },
    {
        title: 'Our Work',
        href: '/work',
        children: [
            { title: 'Education Support', href: '/work/education' },
            { title: 'Economic Empowerment', href: '/work/economic' },
            { title: 'Spiritual Growth', href: '/work/spiritual' },
            { title: 'EMI-Care UK', href: '/work/emi-care' },
            { title: 'Community Projects', href: '/work/projects' }
        ]
    },
    {
        title: 'Get Involved',
        href: '/involve',
        children: [
            { title: 'Make a Donation', href: '/donate' },
            { title: 'Volunteer', href: '/volunteer' },
            { title: 'Request Support', href: '/support' },
            { title: 'Prayer Requests', href: '/prayer-request' },
            { title: 'Partnerships', href: '/partnerships' }
        ]
    },
    {
        title: 'Events',
        href: '/events',
        children: [
            { title: 'Upcoming Events', href: '/events/upcoming' },
            { title: 'Community Gatherings', href: '/events/community' },
            { title: 'Workshops', href: '/events/workshops' },
            { title: 'Event Calendar', href: '/calendar' }
        ]
    }
]

// Updated quick action items for charity
const quickActionItems: NavItemWithBadge[] = [
    {
        title: 'Live Stream',
        href: '/live',
        icon: PlayCircle,
        badge: props.showLiveBadge ? 'Live' : null
    },
    {
        title: 'Events',
        href: '/events',
        icon: Calendar
    },
    {
        title: 'Contact Us',
        href: '/contact',
        icon: Phone
    }
]

// Check if user is logged in (for member area)
const user = computed(() => page.props.auth?.user)
</script>

<template>
    <div class="sticky top-0 z-50 w-full border-b bg-green-500 backdrop-blur-lg supports-[backdrop-filter]:bg-green-500 dark:border-gray-800">


        <div class="container mx-auto flex h-16 lg:h-20 items-center px-4">
            <!-- Mobile Menu Trigger -->
            <div class="lg:hidden mr-2">
                <Sheet>
                    <SheetTrigger :as-child="true">
                        <Button variant="ghost" size="icon" class="h-10 w-10 hover:bg-primary/10">
                            <Menu class="h-5 w-5" />
                        </Button>
                    </SheetTrigger>
                    <SheetContent side="left" class="w-[320px] sm:w-[400px] p-6 overflow-y-auto bg-background dark:bg-gray-900">
                        <SheetTitle class="sr-only">Navigation Menu</SheetTitle>
                        <SheetHeader class="flex justify-start text-left mb-8">
                            <div class="flex items-center gap-x-3">
                                <AppLogoIcon class="size-10 fill-current text-primary" />
                                <div>
                                    <div class="font-bold text-xl tracking-tight text-foreground">{{ churchName }}</div>
                                </div>
                            </div>
                        </SheetHeader>

                        <!-- Mobile Navigation -->
                        <div class="flex h-[calc(100%-8rem)] flex-col">
                            <nav class="space-y-1 flex-grow overflow-y-auto">
                                <!-- Sign-in button for mobile (if not logged in) -->
                                <div v-if="!user" class="mb-4">
                                    <Button as-child class="w-full" variant="outline">
                                        <Link href="/login">
                                            Member Login
                                        </Link>
                                    </Button>
                                </div>

                                <template v-for="item in mainNavItems" :key="item.title">
                                    <div v-if="item.children" class="space-y-1">
                                        <Collapsible
                                            v-model:open="expandedMobileItems[item.title]"
                                            @update:open="toggleMobileItem(item.title)"
                                            class="w-full"
                                        >
                                            <div class="flex items-center">
                                                <Link
                                                    :href="item.href"
                                                    class="flex items-center justify-between rounded-lg px-3 py-3 text-base font-medium hover:bg-accent flex-grow transition-colors"
                                                    :class="whenCurrentUrl(item.href, activeItemStyles)"
                                                    @click.stop.prevent="toggleMobileItem(item.title)"
                                                >
                                                    <span>{{ item.title }}</span>
                                                </Link>
                                                <CollapsibleTrigger as-child>
                                                    <Button
                                                        variant="ghost"
                                                        size="icon"
                                                        class="h-10 w-10 ml-1 hover:bg-accent"
                                                    >
                                                        <ChevronDown
                                                            class="h-4 w-4 transition-transform duration-200"
                                                            :class="expandedMobileItems[item.title] ? 'rotate-180' : ''"
                                                        />
                                                    </Button>
                                                </CollapsibleTrigger>
                                            </div>

                                            <CollapsibleContent>
                                                <div class="ml-4 mt-1 space-y-1 border-l-2 border-primary/20 pl-3">
                                                    <SheetClose as-child v-for="child in item.children" :key="child.title">
                                                        <Link
                                                            :href="child.href"
                                                            class="flex items-center rounded-lg px-3 py-2.5 text-sm font-medium hover:bg-accent transition-colors"
                                                            :class="whenCurrentUrl(child.href, activeItemStyles)"
                                                        >
                                                            {{ child.title }}
                                                        </Link>
                                                    </SheetClose>
                                                </div>
                                            </CollapsibleContent>
                                        </Collapsible>
                                    </div>
                                    <SheetClose v-else as-child>
                                        <Link
                                            :href="item.href"
                                            class="flex items-center justify-between rounded-lg px-3 py-3 text-base font-medium hover:bg-accent transition-colors"
                                            :class="whenCurrentUrl(item.href, activeItemStyles)"
                                        >
                                            <span>{{ item.title }}</span>
                                        </Link>
                                    </SheetClose>
                                </template>
                            </nav>

                            <!-- Quick Actions Mobile -->
                            <div class="pt-4 mt-4 border-t border-border">
                                <div class="grid grid-cols-2 gap-2 mb-4">
                                    <SheetClose v-for="action in quickActionItems" :key="action.title" as-child>
                                        <Link
                                            :href="action.href"
                                            class="flex flex-col items-center justify-center rounded-lg border border-border p-3 text-center hover:bg-accent transition-colors"
                                        >
                                            <component
                                                :is="action.icon"
                                                class="h-5 w-5 mb-2 text-primary"
                                            />
                                            <span class="text-xs font-medium">{{ action.title }}</span>
                                            <span
                                                v-if="action.badge"
                                                class="mt-1 text-xs rounded-full bg-destructive px-2 py-0.5 text-destructive-foreground"
                                            >
                                                {{ action.badge }}
                                            </span>
                                        </Link>
                                    </SheetClose>
                                </div>

                                <!-- Donate Button Mobile -->
                                <SheetClose as-child>
                                    <Button as-child class="w-full mb-4 bg-primary hover:bg-primary/90 text-primary-foreground">
                                        <Link :href="'/donate'" class="flex items-center justify-center gap-2">
                                            <Heart class="h-4 w-4" />
                                            Donate Now
                                        </Link>
                                    </Button>
                                </SheetClose>

                                <!-- Member Area Button for logged in users -->
                                <SheetClose v-if="user" as-child>
                                    <Button as-child variant="outline" class="w-full border-primary/20 hover:bg-primary/5">
                                        <Link :href="'/member'">
                                            Member Area
                                        </Link>
                                    </Button>
                                </SheetClose>
                            </div>
                        </div>
                    </SheetContent>
                </Sheet>
            </div>

            <!-- Logo -->
            <Link href="/" class="flex items-center gap-x-2 sm:gap-x-3 lg:gap-x-4 group">
                <div class="relative">
                    <AppLogoIcon class="size-8 sm:size-10 lg:size-12 fill-current text-primary transition-transform group-hover:scale-110" />
                    <div class="absolute -top-1 -right-1 h-3 w-3 bg-accent rounded-full animate-pulse"></div>
                </div>
                <div class="hidden xs:block">
                    <div class="font-bold text-lg sm:text-xl lg:text-2xl tracking-tight text-foreground">{{ churchName }}</div>

                </div>
            </Link>

            <!-- Desktop Navigation -->
            <div class="hidden h-full lg:flex lg:flex-1">
                <NavigationMenu class="ml-10 flex h-full items-stretch">
                    <NavigationMenuList class="flex h-full items-stretch space-x-1">
                        <NavigationMenuItem
                            v-for="(item, index) in mainNavItems"
                            :key="index"
                            class="relative flex h-full items-center"
                        >
                            <template v-if="item.children">
                                <NavigationMenuTrigger
                                    :class="[
                                        'h-12 px-4 text-md  font-medium transition-all duration-200 bg-green-500 hover:text-primary data-[state=open]:text-primary data-[state=open]:bg-primary/10',
                                        isCurrentUrl(item.href) ? activeItemStyles : 'hover:bg-accent'
                                    ]"
                                >
                                    {{ item.title }}
                                </NavigationMenuTrigger>
                                <NavigationMenuContent class="bg-green-500">
                                    <ul class="grid w-[400px] gap-3 p-4 md:w-[500px] lg:w-[600px]">

                                        <li
                                            v-for="child in item.children"
                                            :key="child.title"
                                         >
                                            <NavigationMenuLink as-child>
                                                <Link
                                                    :href="child.href"
                                                    class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-all hover:bg-accent hover:text-accent-foreground focus:bg-accent hover:translate-x-1"
                                                >
                                                    <div class="text-lg font-medium leading-none text-primary">
                                                        {{ child.title }}
                                                    </div>
                                                    <p class="line-clamp-2 text-lg leading-snug text-primary-foreground">
                                                        Discover our {{ child.title.toLowerCase() }} programs
                                                    </p>
                                                </Link>
                                            </NavigationMenuLink>
                                        </li>
                                    </ul>
                                </NavigationMenuContent>
                            </template>
                            <template v-else>
                                <Link
                                    :class="[
                                        navigationMenuTriggerStyle(),
                                        'h-12 px-4 text-sm font-medium cursor-pointer transition-all duration-200 hover:text-primary hover:bg-accent',
                                        isCurrentUrl(item.href) ? activeItemStyles : ''
                                    ]"
                                    :href="item.href"
                                >
                                    {{ item.title }}
                                </Link>
                            </template>
                            <div
                                v-if="isCurrentUrl(item.href)"
                                class="absolute bottom-0 left-0 h-0.5 w-full bg-primary"
                            ></div>
                        </NavigationMenuItem>
                    </NavigationMenuList>
                </NavigationMenu>
            </div>

            <!-- Right Side Actions -->
            <div class="ml-auto flex items-center space-x-2 sm:space-x-3">
                <!-- Live Stream Badge - Responsive -->
                <template v-if="showLiveBadge">
                    <Button
                        as-child
                        variant="destructive"
                        size="sm"
                        class="gap-1.5 animate-pulse hidden xs:flex btn-glow"
                    >
                        <Link href="/live" class="flex items-center">
                            <PlayCircle class="h-4 w-4" />
                            <span class="sm:inline">Live Now</span>
                        </Link>
                    </Button>
                    <Button
                        as-child
                        variant="destructive"
                        size="icon"
                        class="animate-pulse xs:hidden btn-glow"
                    >
                        <Link href="/live">
                            <PlayCircle class="h-4 w-4" />
                        </Link>
                    </Button>
                </template>

                <!-- Quick Actions Desktop -->
                <div class="hidden lg:flex items-center space-x-1">
                    <TooltipProvider v-for="action in quickActionItems" :key="action.title">
                        <Tooltip>
                            <TooltipTrigger as-child>
                                <Button
                                    variant="ghost"
                                    size="icon"
                                    as-child
                                    class="h-10 w-10 relative hover:bg-accent"
                                >
                                    <Link :href="action.href">
                                        <span class="sr-only">{{ action.title }}</span>
                                        <component
                                            :is="action.icon"
                                            class="h-5 w-5 text-foreground"
                                        />
                                        <span
                                            v-if="action.badge"
                                            class="absolute -top-1 -right-1 h-5 w-5 rounded-full bg-destructive text-[10px] text-destructive-foreground flex items-center justify-center"
                                        >
                                            ●
                                        </span>
                                    </Link>
                                </Button>
                            </TooltipTrigger>
                            <TooltipContent class="bg-background border-border">
                                <p class="text-foreground">{{ action.title }}</p>
                            </TooltipContent>
                        </Tooltip>
                    </TooltipProvider>
                </div>

                <!-- Donate Button -->
                <Button
                    v-if="showGiveButton"
                    as-child
                    size="sm"
                    class="hidden lg:flex gap-1.5 bg-primary hover:bg-primary/90 h-10 text-primary-foreground btn-glow"
                >
                    <Link href="/donate" class="flex items-center">
                        <Heart class="h-4 w-4" />
                        Donate Now
                    </Link>
                </Button>

                <!-- User Menu / Member Area -->
                <template v-if="user">
                    <DropdownMenu>
                        <DropdownMenuTrigger as-child>
                            <Button variant="ghost" size="icon" class="relative h-9 w-9 sm:h-10 sm:w-10 rounded-full hover:bg-accent">
                                <Avatar class="h-8 w-8 sm:h-9 sm:w-9 border border-primary/20">
                                    <AvatarImage
                                        v-if="user.avatar"
                                        :src="user.avatar"
                                        :alt="user.name"
                                    />
                                    <AvatarFallback class="bg-primary/10 text-primary text-xs sm:text-sm">
                                        {{ user.name?.charAt(0).toUpperCase() }}
                                    </AvatarFallback>
                                </Avatar>
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end" class="w-56 bg-background dark:bg-gray-900 border-border">
                            <div class="flex items-center justify-start gap-2 p-2">
                                <Avatar class="h-10 w-10">
                                    <AvatarImage
                                        v-if="user.avatar"
                                        :src="user.avatar"
                                        :alt="user.name"
                                    />
                                    <AvatarFallback class="bg-primary/10 text-primary">
                                        {{ user.name?.charAt(0).toUpperCase() }}
                                    </AvatarFallback>
                                </Avatar>
                                <div class="flex flex-col space-y-1">
                                    <p class="text-sm font-medium text-foreground">{{ user.name }}</p>
                                    <p class="text-xs text-muted-foreground">{{ user.email }}</p>
                                </div>
                            </div>
                            <DropdownMenuSeparator class="bg-border" />
                            <DropdownMenuItem as-child class="hover:bg-accent focus:bg-accent">
                                <Link href="/member" class="w-full text-foreground">Member Dashboard</Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem as-child class="hover:bg-accent focus:bg-accent">
                                <Link href="/member/profile" class="w-full text-foreground">My Profile</Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem as-child class="hover:bg-accent focus:bg-accent">
                                <Link href="/member/giving" class="w-full text-foreground">My Giving</Link>
                            </DropdownMenuItem>
                            <DropdownMenuSeparator class="bg-border" />
                            <DropdownMenuItem as-child class="hover:bg-destructive/10 focus:bg-destructive/10 text-destructive">
                                <Link href="/logout" method="post" as="button" class="w-full">
                                    Log Out
                                </Link>
                            </DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                </template>
                <template v-else>
                    <Button
                        as-child
                        variant="outline"
                        size="sm"
                        class="hidden lg:flex h-10 border-primary/20 hover:bg-primary/5 hover:text-primary"
                    >
                        <Link href="/login">Member Login</Link>
                    </Button>
                    <!-- Mobile login button (only visible on mobile) -->
                    <Button
                        as-child
                        variant="outline"
                        size="sm"
                        class="lg:hidden h-9 border-primary/20 hover:bg-primary/5 hover:text-primary"
                    >
                        <Link href="/login">Login</Link>
                    </Button>
                </template>
            </div>
        </div>
        <!-- Announcement Bar -->
        <div class="border-t bg-gradient-to-r from-primary-foreground via-primary-foreground to-primary-foreground py-2 dark:from-primary/20 dark:via-accent/10 dark:to-secondary/20">
            <div class="container mx-auto px-4">
                <div class="flex flex-col sm:flex-row items-center justify-center text-sm gap-2 sm:gap-0">
                    <div class="flex items-center gap-2">
                        <Shield class="h-4 w-4 text-primary" />
                        <span class="font-medium">UK Registered Charity No: 1141696</span>
                    </div>
                    <span class="hidden sm:inline mx-2 text-gray-500">•</span>
                    <span class="text-center">Empowering Communities in the UK & Africa</span>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Responsive breakpoints */
@media (max-width: 639px) {
    .xs\:block {
        display: block !important;
    }
    .xs\:hidden {
        display: none !important;
    }
}

/* Smooth transitions */
* {
    transition-property: color, background-color, border-color, transform;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 200ms;
}

/* Glass effect for dark mode */
.dark [class*="bg-background/"] {
    background-color: hsl(222.2 84% 4.9% / 0.8);
}

.dark .border-b {
    border-bottom-color: hsl(217.2 32.6% 17.5%);
}
</style>
