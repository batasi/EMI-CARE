<script setup lang="ts">
import { Head, Link, router, useForm } from '@inertiajs/vue3'
import { ref, computed } from 'vue'
import {
    Mail, Phone, MapPin, Calendar, Clock, Globe,
    ArrowLeft, CheckCircle, XCircle, AlertCircle,
    Send, Eye, Archive, Edit, Save, Trash2,
    User, Sparkles, MessageSquare, Shield,
    Copy, Check, ChevronLeft, MoreHorizontal
} from 'lucide-vue-next'
import { Button } from '@/components/ui/button'
import { Badge } from '@/components/ui/badge'
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card'
import { Separator } from '@/components/ui/separator'
import { Textarea } from '@/components/ui/textarea'
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
} from '@/components/ui/dialog'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'
import { format } from 'date-fns'

interface ContactSubmission {
    id: number
    first_name: string
    last_name: string
    email: string
    phone: string | null
    inquiry_type: string
    message: string
    newsletter: boolean
    status: 'new' | 'read' | 'replied' | 'archived'
    ip_address: string | null
    user_agent: string | null
    read_at: string | null
    replied_at: string | null
    admin_notes: string | null
    created_at: string
    updated_at: string
    full_name: string
}

interface Props {
    submission: ContactSubmission
}

const props = defineProps<Props>()

const breadcrumbItems: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/admin',
    },
    {
        title: 'Contact Submissions',
        href: '/admin/contact-submissions',
    },
    {
        title: `Submission #${props.submission.id}`,
        href: '#',
    },
]

// Status badge colors
const statusColors = {
    new: 'bg-blue-100 text-blue-800 border-blue-200',
    read: 'bg-yellow-100 text-yellow-800 border-yellow-200',
    replied: 'bg-green-100 text-green-800 border-green-200',
    archived: 'bg-gray-100 text-gray-800 border-gray-200'
}

// Status icons
const statusIcons = {
    new: Sparkles,
    read: Eye,
    replied: Send,
    archived: Archive
}

// Inquiry type labels
const inquiryTypeLabels: Record<string, string> = {
    general: 'General Inquiry',
    support: 'Request Support',
    donate: 'Donation/Partnership',
    volunteer: 'Volunteer Opportunity',
    prayer: 'Prayer Request',
    other: 'Other'
}

// Format date
const formatDate = (date: string) => {
    return format(new Date(date), 'MMMM d, yyyy \'at\' h:mm a')
}

// Format relative time
const formatRelativeTime = (date: string | null) => {
    if (!date) return 'Never'
    const now = new Date()
    const then = new Date(date)
    const diffInHours = Math.floor((now.getTime() - then.getTime()) / (1000 * 60 * 60))

    if (diffInHours < 24) return `${diffInHours} hours ago`
    if (diffInHours < 48) return 'Yesterday'
    return format(new Date(date), 'MMM d, yyyy')
}

// Copy functionality
const copiedField = ref<string | null>(null)

const copyToClipboard = (text: string, field: string) => {
    navigator.clipboard.writeText(text)
    copiedField.value = field
    setTimeout(() => {
        copiedField.value = null
    }, 2000)
}

// Update form
const updateForm = useForm({
    status: props.submission.status,
    admin_notes: props.submission.admin_notes || ''
})

// Handle update
const handleUpdate = () => {
    updateForm.put(route('admin.contact-submissions.update', props.submission.id), {
        preserveScroll: true,
        onSuccess: () => {
            // Show success message or toast
        }
    })
}

// Delete dialog
const deleteDialog = ref(false)

// Handle delete
const handleDelete = () => {
    router.delete(route('admin.contact-submissions.destroy', props.submission.id), {
        onSuccess: () => {
            router.get(route('admin.contact-submissions.index'))
        }
    })
}

// Handle mark as replied (quick action)
const markAsReplied = () => {
    updateForm.status = 'replied'
    handleUpdate()
}

// Handle mark as archived
const markAsArchived = () => {
    updateForm.status = 'archived'
    handleUpdate()
}

// Get user device info from user agent
const getUserDevice = (userAgent: string | null) => {
    if (!userAgent) return 'Unknown'

    if (userAgent.includes('Mobile')) return 'Mobile Device'
    if (userAgent.includes('Tablet')) return 'Tablet'
    return 'Desktop'
}

// Get browser info from user agent
const getBrowser = (userAgent: string | null) => {
    if (!userAgent) return 'Unknown'

    if (userAgent.includes('Chrome')) return 'Chrome'
    if (userAgent.includes('Firefox')) return 'Firefox'
    if (userAgent.includes('Safari')) return 'Safari'
    if (userAgent.includes('Edge')) return 'Edge'
    return 'Unknown'
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head :title="`Submission #${submission.id} - ${submission.full_name}`" />

        <div class="flex flex-col gap-6 p-6">
            <!-- Header with navigation -->
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <Button variant="ghost" size="sm" as-child>
                        <Link :href="route('admin.contact-submissions.index')" class="flex items-center gap-2">
                            <ChevronLeft class="h-4 w-4" />
                            Back to Submissions
                        </Link>
                    </Button>
                    <Separator orientation="vertical" class="h-6" />
                    <div>
                        <h1 class="text-2xl font-bold tracking-tight flex items-center gap-2">
                            Submission #{{ submission.id }}
                            <Badge :class="statusColors[submission.status]" class="capitalize">
                                <component :is="statusIcons[submission.status]" class="h-3 w-3 mr-1" />
                                {{ submission.status }}
                            </Badge>
                        </h1>
                        <p class="text-sm text-muted-foreground">
                            Received {{ formatDate(submission.created_at) }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <DropdownMenu>
                        <DropdownMenuTrigger as-child>
                            <Button variant="outline">
                                <MoreHorizontal class="h-4 w-4 mr-2" />
                                Actions
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end">
                            <DropdownMenuLabel>Quick Actions</DropdownMenuLabel>
                            <DropdownMenuItem @click="markAsReplied" :disabled="submission.status === 'replied'">
                                <Send class="h-4 w-4 mr-2" />
                                Mark as Replied
                            </DropdownMenuItem>
                            <DropdownMenuItem @click="markAsArchived" :disabled="submission.status === 'archived'">
                                <Archive class="h-4 w-4 mr-2" />
                                Archive
                            </DropdownMenuItem>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem
                                class="text-red-600 focus:text-red-600"
                                @click="deleteDialog = true"
                            >
                                <Trash2 class="h-4 w-4 mr-2" />
                                Delete Submission
                            </DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                    <Button as-child>
                        <a :href="`mailto:${submission.email}?subject=Re: Your inquiry to Empowerment Missions Int.&body=Dear ${submission.first_name},%0D%0A%0D%0AThank you for contacting us. Regarding your message:%0D%0A%0D%0A${submission.message}%0D%0A%0D%0A[Your response here]%0D%0A%0D%0ABest regards,%0D%0AThe Empowerment Missions Int. Team`">
                            <Mail class="h-4 w-4 mr-2" />
                            Reply via Email
                        </a>
                    </Button>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3">
                <!-- Main Content - Message -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Message Card -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="flex items-center gap-2">
                                <MessageSquare class="h-5 w-5" />
                                Message
                            </CardTitle>
                            <CardDescription>
                                Original message from {{ submission.full_name }}
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="bg-muted/30 rounded-lg p-4 whitespace-pre-wrap">
                                {{ submission.message }}
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Admin Notes Card -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="flex items-center gap-2">
                                <Edit class="h-5 w-5" />
                                Admin Notes
                            </CardTitle>
                            <CardDescription>
                                Internal notes about this submission
                            </CardDescription>
                        </CardHeader>
                        <CardContent>
                            <div class="space-y-4">
                                <Textarea
                                    v-model="updateForm.admin_notes"
                                    placeholder="Add private notes about this submission (only visible to admins)..."
                                    rows="4"
                                />
                                <div class="flex justify-end">
                                    <Button
                                        @click="handleUpdate"
                                        :disabled="updateForm.processing"
                                        size="sm"
                                    >
                                        <Save class="h-4 w-4 mr-2" />
                                        {{ updateForm.processing ? 'Saving...' : 'Save Notes' }}
                                    </Button>
                                </div>
                            </div>
                        </CardContent>
                    </Card>
                </div>

                <!-- Sidebar - Contact Info & Metadata -->
                <div class="space-y-6">
                    <!-- Contact Information Card -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="flex items-center gap-2">
                                <User class="h-5 w-5" />
                                Contact Information
                            </CardTitle>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div>
                                <div class="text-sm text-muted-foreground mb-1">Full Name</div>
                                <div class="font-medium flex items-center justify-between">
                                    {{ submission.full_name }}
                                    <Button
                                        variant="ghost"
                                        size="sm"
                                        @click="copyToClipboard(submission.full_name, 'name')"
                                    >
                                        <Copy v-if="copiedField !== 'name'" class="h-4 w-4" />
                                        <Check v-else class="h-4 w-4 text-green-600" />
                                    </Button>
                                </div>
                            </div>

                            <Separator />

                            <div>
                                <div class="text-sm text-muted-foreground mb-1">Email Address</div>
                                <div class="font-medium flex items-center justify-between">
                                    <a :href="`mailto:${submission.email}`" class="hover:text-primary transition-colors">
                                        {{ submission.email }}
                                    </a>
                                    <Button
                                        variant="ghost"
                                        size="sm"
                                        @click="copyToClipboard(submission.email, 'email')"
                                    >
                                        <Copy v-if="copiedField !== 'email'" class="h-4 w-4" />
                                        <Check v-else class="h-4 w-4 text-green-600" />
                                    </Button>
                                </div>
                            </div>

                            <div v-if="submission.phone">
                                <div class="text-sm text-muted-foreground mb-1">Phone Number</div>
                                <div class="font-medium flex items-center justify-between">
                                    <a :href="`tel:${submission.phone}`" class="hover:text-primary transition-colors">
                                        {{ submission.phone }}
                                    </a>
                                    <Button
                                        variant="ghost"
                                        size="sm"
                                        @click="copyToClipboard(submission.phone!, 'phone')"
                                    >
                                        <Copy v-if="copiedField !== 'phone'" class="h-4 w-4" />
                                        <Check v-else class="h-4 w-4 text-green-600" />
                                    </Button>
                                </div>
                            </div>

                            <Separator />

                            <div>
                                <div class="text-sm text-muted-foreground mb-1">Inquiry Type</div>
                                <Badge variant="outline" class="capitalize">
                                    {{ inquiryTypeLabels[submission.inquiry_type] || submission.inquiry_type }}
                                </Badge>
                            </div>

                            <div v-if="submission.newsletter">
                                <div class="flex items-center gap-2 text-sm">
                                    <CheckCircle class="h-4 w-4 text-green-600" />
                                    <span>Subscribed to newsletter</span>
                                </div>
                            </div>
                        </CardContent>
                    </Card>

                    <!-- Status Update Card -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="flex items-center gap-2">
                                <Shield class="h-5 w-5" />
                                Status Management
                            </CardTitle>
                        </CardHeader>
                        <CardContent class="space-y-4">
                            <div>
                                <div class="text-sm text-muted-foreground mb-2">Current Status</div>
                                <Select v-model="updateForm.status">
                                    <SelectTrigger>
                                        <SelectValue placeholder="Select status" />
                                    </SelectTrigger>
                                    <SelectContent>
                                        <SelectItem value="new">
                                            <div class="flex items-center gap-2">
                                                <Sparkles class="h-4 w-4 text-blue-500" />
                                                <span>New</span>
                                            </div>
                                        </SelectItem>
                                        <SelectItem value="read">
                                            <div class="flex items-center gap-2">
                                                <Eye class="h-4 w-4 text-yellow-500" />
                                                <span>Read</span>
                                            </div>
                                        </SelectItem>
                                        <SelectItem value="replied">
                                            <div class="flex items-center gap-2">
                                                <Send class="h-4 w-4 text-green-500" />
                                                <span>Replied</span>
                                            </div>
                                        </SelectItem>
                                        <SelectItem value="archived">
                                            <div class="flex items-center gap-2">
                                                <Archive class="h-4 w-4 text-gray-500" />
                                                <span>Archived</span>
                                            </div>
                                        </SelectItem>
                                    </SelectContent>
                                </Select>
                            </div>

                            <Button @click="handleUpdate" class="w-full" :disabled="updateForm.processing">
                                <Save class="h-4 w-4 mr-2" />
                                {{ updateForm.processing ? 'Updating...' : 'Update Status' }}
                            </Button>
                        </CardContent>
                    </Card>

                    <!-- Metadata Card -->
                    <Card>
                        <CardHeader>
                            <CardTitle class="flex items-center gap-2">
                                <Calendar class="h-5 w-5" />
                                Metadata
                            </CardTitle>
                        </CardHeader>
                        <CardContent class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-muted-foreground">Received</span>
                                <span class="font-medium">{{ formatRelativeTime(submission.created_at) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-muted-foreground">Read</span>
                                <span class="font-medium">{{ formatRelativeTime(submission.read_at) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-muted-foreground">Replied</span>
                                <span class="font-medium">{{ formatRelativeTime(submission.replied_at) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-muted-foreground">Last Updated</span>
                                <span class="font-medium">{{ formatRelativeTime(submission.updated_at) }}</span>
                            </div>

                            <Separator />

                            <div>
                                <div class="text-muted-foreground mb-1">IP Address</div>
                                <div class="font-mono text-xs">{{ submission.ip_address || 'Unknown' }}</div>
                            </div>

                            <div>
                                <div class="text-muted-foreground mb-1">Device</div>
                                <div class="text-xs">{{ getUserDevice(submission.user_agent) }} / {{ getBrowser(submission.user_agent) }}</div>
                            </div>

                            <div>
                                <div class="text-muted-foreground mb-1">User Agent</div>
                                <div class="text-xs break-all">{{ submission.user_agent || 'Unknown' }}</div>
                            </div>
                        </CardContent>
                    </Card>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Dialog -->
        <Dialog :open="deleteDialog" @update:open="deleteDialog = false">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Delete Submission</DialogTitle>
                    <DialogDescription>
                        Are you sure you want to delete this contact submission from
                        <span class="font-medium">{{ submission.full_name }}</span>?
                        This action cannot be undone and all associated data will be permanently removed.
                    </DialogDescription>
                </DialogHeader>
                <DialogFooter>
                    <Button variant="outline" @click="deleteDialog = false">
                        Cancel
                    </Button>
                    <Button variant="destructive" @click="handleDelete">
                        Delete Permanently
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>
