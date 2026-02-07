<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import { Menu, Heart, PlayCircle, Phone, Calendar } from 'lucide-vue-next'
import { computed } from 'vue'
import AppLogoIcon from '@/components/AppLogoIcon.vue'
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar'
import { Button } from '@/components/ui/button'
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
    churchLocation: 'Nairobi, Kenya'
})

const page = usePage()
const { isCurrentUrl, whenCurrentUrl } = useCurrentUrl()

const activeItemStyles = 'text-primary bg-primary/10'

// Main Navigation Items with Dropdowns
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
            { title: 'Our Beliefs', href: '/about/beliefs' },
            { title: 'Leadership', href: '/about/leadership' },
            { title: 'Our Vision', href: '/about/vision' }
        ]
    },

    {
        title: 'Events',
        href: '/events',
        children: [
            { title: 'Upcoming Events', href: '/events/upcoming' },
            { title: 'Weekly Services', href: '/events/services' },
            { title: 'Special Events', href: '/events/special' },
            { title: 'Event Calendar', href: '/calendar' }
        ]
    },
    {
        title: 'Get Involved',
        href: '/involve',
        children: [
            { title: 'Volunteer', href: '/volunteer' },
            { title: 'Small Groups', href: '/groups' },
            { title: 'Membership', href: '/membership' },
            { title: 'Prayer Request', href: '/prayer-request' }
        ]
    }
]

// Quick Action Items
const quickActionItems: NavItemWithBadge[] = [
    {
        title: 'Live Stream',
        href: '/live',
        icon: PlayCircle,
        badge: props.showLiveBadge ? 'Live' : null
    },

    {
        title: 'Service Times',
        href: '/service-times',
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
    <div class="sticky top-0 z-50 w-full border-b bg-background/95 backdrop-blur supports-[backdrop-filter]:bg-background/60">
        <!-- Announcement Bar -->
        <div class="border-t bg-gradient-to-r from-primary/10 to-primary/5 py-1.5">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-center text-sm">
                    <span>Join us this Sunday at 9:00 AM & 11:00 AM</span>
                    <Link href="/live" class="ml-2 font-medium text-primary hover:underline">
                        Watch Live →
                    </Link>
                </div>
            </div>
        </div>
        <div class="container mx-auto flex h-24 items-center px-4">
            <!-- Mobile Menu Trigger -->
            <div class="lg:hidden">
                <Sheet>
                    <SheetTrigger :as-child="true">
                        <Button variant="ghost" size="icon" class="mr-2 h-10 w-10">
                            <Menu class="h-5 w-5" />
                        </Button>
                    </SheetTrigger>
                    <SheetContent side="left" class="w-[320px] p-6">
                        <SheetTitle class="sr-only">Navigation Menu</SheetTitle>
                        <SheetHeader class="flex justify-start text-left mb-8">
                            <div class="flex items-center gap-x-3">
                                <AppLogoIcon class="size-10 fill-current text-primary" />
                                <div>
                                    <div class="font-bold text-xl tracking-tight">{{ churchName }}</div>
                                    <div class="text-sm text-muted-foreground">{{ churchLocation }}</div>
                                </div>
                            </div>
                        </SheetHeader>

                        <!-- Mobile Navigation -->
                        <div class="flex h-full flex-col justify-between space-y-6">
                            <nav class="space-y-1">
                                <Link
                                    v-for="item in mainNavItems"
                                    :key="item.title"
                                    :href="item.href"
                                    class="flex items-center justify-between rounded-lg px-3 py-3 text-base font-medium hover:bg-accent"
                                    :class="whenCurrentUrl(item.href, activeItemStyles)"
                                >
                                    <span>{{ item.title }}</span>
                                    <ChevronRightIcon
                                        v-if="item.children"
                                        class="h-4 w-4 text-muted-foreground"
                                    />
                                </Link>
                            </nav>

                            <!-- Quick Actions Mobile -->
                            <div class="space-y-4">
                                <div class="grid grid-cols-2 gap-2">
                                    <Link
                                        v-for="action in quickActionItems"
                                        :key="action.title"
                                        :href="action.href"
                                        class="flex flex-col items-center justify-center rounded-lg border p-3 text-center hover:bg-accent"
                                    >
                                        <component
                                            :is="action.icon"
                                            class="h-5 w-5 mb-2"
                                        />
                                        <span class="text-xs font-medium">{{ action.title }}</span>
                                        <span
                                            v-if="action.badge"
                                            class="mt-1 text-xs rounded-full bg-red-500 px-2 py-0.5 text-white"
                                        >
                                            {{ action.badge }}
                                        </span>
                                    </Link>
                                </div>

                                <!-- Give Button Mobile -->
                                <Button as-child class="w-full">
                                    <Link :href="'/give'">
                                         Give Online
                                    </Link>
                                </Button>

                                <!-- Member Area Button -->
                                <Button
                                    v-if="user"
                                    as-child
                                    variant="outline"
                                    class="w-full"
                                >
                                    <Link :href="'/member'">
                                        Member Area
                                    </Link>
                                </Button>
                            </div>
                        </div>
                    </SheetContent>
                </Sheet>
            </div>

            <!-- Logo -->
            <Link href="/" class="flex items-center gap-x-3 lg:gap-x-4">
                <AppLogoIcon class="size-12 fill-current text-primary" />
                <div class="hidden sm:block">
                    <div class="font-bold text-2xl tracking-tight">{{ churchName }}</div>
                    <div class="text-sm text-muted-foreground mt-0.5">{{ churchLocation }}</div>
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
                                        'h-12 px-4 text-sm font-medium transition-colors hover:text-primary',
                                        isCurrentUrl(item.href) ? activeItemStyles : ''
                                    ]"
                                >
                                    {{ item.title }}
                                </NavigationMenuTrigger>
                                <NavigationMenuContent>
                                    <ul class="grid w-[400px] gap-3 p-4 md:w-[500px] lg:w-[600px]">
                                        <li class="row-span-3">
                                            <NavigationMenuLink as-child>
                                                <Link
                                                    :href="item.href"
                                                    class="flex h-full w-full select-none flex-col justify-end rounded-md bg-gradient-to-b from-primary/20 to-primary/5 p-6 no-underline outline-none focus:shadow-md"
                                                >
                                                    <div class="mb-2 mt-4 text-lg font-medium">
                                                        {{ item.title }}
                                                    </div>
                                                    <p class="text-sm text-muted-foreground leading-tight">
                                                        Explore our {{ item.title.toLowerCase() }} and get involved
                                                    </p>
                                                </Link>
                                            </NavigationMenuLink>
                                        </li>
                                        <li
                                            v-for="child in item.children"
                                            :key="child.title"
                                        >
                                            <NavigationMenuLink as-child>
                                                <Link
                                                    :href="child.href"
                                                    class="block select-none space-y-1 rounded-md p-3 leading-none no-underline outline-none transition-colors hover:bg-accent hover:text-accent-foreground focus:bg-accent"
                                                >
                                                    <div class="text-sm font-medium leading-none">
                                                        {{ child.title }}
                                                    </div>
                                                    <p class="line-clamp-2 text-sm leading-snug text-muted-foreground">
                                                        Learn more about our {{ child.title.toLowerCase() }}
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
                                        'h-12 px-4 text-sm font-medium cursor-pointer transition-colors hover:text-primary',
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
            <div class="ml-auto flex items-center space-x-3">
                <!-- Search -->


                <!-- Live Stream Badge -->
                <Button
                    v-if="showLiveBadge"
                    as-child
                    variant="destructive"
                    size="sm"
                    class="gap-1.5 animate-pulse"
                >
                    <Link href="/live" class="flex items-center">
                        <PlayCircle class="h-4 w-4" />
                        Live Now
                    </Link>
                </Button>

                <!-- Quick Actions Desktop -->
                <div class="hidden lg:flex items-center space-x-1">
                    <TooltipProvider v-for="action in quickActionItems" :key="action.title">
                        <Tooltip>
                            <TooltipTrigger as-child>
                                <Button
                                    variant="ghost"
                                    size="icon"
                                    as-child
                                    class="h-10 w-10 relative"
                                >
                                    <Link :href="action.href">
                                        <span class="sr-only">{{ action.title }}</span>
                                        <component
                                            :is="action.icon"
                                            class="h-5 w-5"
                                        />
                                        <span
                                            v-if="action.badge"
                                            class="absolute -top-1 -right-1 h-5 w-5 rounded-full bg-red-500 text-[10px] text-white flex items-center justify-center"
                                        >
                                            ●
                                        </span>
                                    </Link>
                                </Button>
                            </TooltipTrigger>
                            <TooltipContent>
                                <p>{{ action.title }}</p>
                            </TooltipContent>
                        </Tooltip>
                    </TooltipProvider>
                </div>

                <!-- Give Button -->
                <Button
                    v-if="showGiveButton"
                    as-child
                    size="sm"
                    class="hidden lg:flex gap-1.5 bg-primary hover:bg-primary/90 h-10"
                >
                    <Link href="/give" class="flex items-center">
                        <Heart class="h-4 w-4" />
                        Give Online
                    </Link>
                </Button>

                <!-- User Menu / Member Area -->
                <template v-if="user">
                    <DropdownMenu>
                        <DropdownMenuTrigger as-child>
                            <Button variant="ghost" size="icon" class="relative h-10 w-10 rounded-full">
                                <Avatar class="h-9 w-9">
                                    <AvatarImage
                                        v-if="user.avatar"
                                        :src="user.avatar"
                                        :alt="user.name"
                                    />
                                    <AvatarFallback class="bg-primary/10 text-primary text-sm">
                                        {{ user.name?.charAt(0).toUpperCase() }}
                                    </AvatarFallback>
                                </Avatar>
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end" class="w-56">
                            <div class="flex items-center justify-start gap-2 p-2">
                                <div class="flex flex-col space-y-1">
                                    <p class="text-sm font-medium">{{ user.name }}</p>
                                    <p class="text-xs text-muted-foreground">{{ user.email }}</p>
                                </div>
                            </div>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem as-child>
                                <Link href="/member" class="w-full">Member Dashboard</Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem as-child>
                                <Link href="/member/profile" class="w-full">My Profile</Link>
                            </DropdownMenuItem>
                            <DropdownMenuItem as-child>
                                <Link href="/member/giving" class="w-full">My Giving</Link>
                            </DropdownMenuItem>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem as-child>
                                <Link href="/logout" method="post" as="button" class="w-full text-red-600">
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
                        class="hidden lg:flex h-10"
                    >
                        <Link href="/login">Member Login</Link>
                    </Button>
                </template>
            </div>
        </div>
    </div>
</template>

<script lang="ts">
// ChevronRight icon component
const ChevronRightIcon = {
    template: `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>`
}
</script>
