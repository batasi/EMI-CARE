<script setup lang="ts">
import { Head, Link, router, useForm } from '@inertiajs/vue3'
import { format } from 'date-fns'
import {
    Mail, Phone, Calendar,
    Eye, Trash2,  AlertCircle,
     Download, Search, Filter, RefreshCw,
    MoreHorizontal,  Archive,
    MessageSquare, User, Inbox, Send, Sparkles
} from 'lucide-vue-next'
import { ref } from 'vue'
import { Badge } from '@/components/ui/badge'
import { Button } from '@/components/ui/button'
import { Card, CardContent,  CardHeader, CardTitle } from '@/components/ui/card'
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
import { Input } from '@/components/ui/input'
import {
    Pagination,
    PaginationNext,
    PaginationPrevious,
} from '@/components/ui/pagination'
import {
    Select,
    SelectContent,
    SelectItem,
    SelectTrigger,
    SelectValue,
} from '@/components/ui/select'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import AppLayout from '@/layouts/AppLayout.vue'
import { type BreadcrumbItem } from '@/types'

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
    full_name: string
}

interface Props {
    submissions: {
        data: ContactSubmission[]
        current_page: number
        last_page: number
        per_page: number
        total: number
        links: any[]
    }
    filters: {
        status?: string
        search?: string
    }
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
]

// Status badge colors
const statusColors = {
    new: 'bg-blue-100 text-blue-800 border-blue-200',
    read: 'bg-yellow-100 text-yellow-800 border-yellow-200',
    replied: 'bg-green-100 text-green-800 border-green-200',
    archived: 'bg-gray-100 text-gray-800 border-gray-200'
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
    return format(new Date(date), 'MMM d, yyyy h:mm a')
}

// Search and filter state
const search = ref(props.filters.search || '')
const statusFilter = ref(props.filters.status || 'all')
const deleteDialog = ref(false)
const selectedSubmission = ref<ContactSubmission | null>(null)

// Delete form
const deleteForm = useForm({
    id: null as number | null
})

// Handle search with debounce
let searchTimeout: ReturnType<typeof setTimeout>
const handleSearch = () => {
    clearTimeout(searchTimeout)
    searchTimeout = setTimeout(() => {
        router.get(
            route('admin.contact-submissions.index'),
            { search: search.value, status: statusFilter.value !== 'all' ? statusFilter.value : undefined },
            { preserveState: true, replace: true }
        )
    }, 500)
}

// Handle status filter change
const handleStatusChange = (value: string) => {
    statusFilter.value = value
    router.get(
        route('admin.contact-submissions.index'),
        { status: value !== 'all' ? value : undefined, search: search.value },
        { preserveState: true, replace: true }
    )
}

// Handle delete confirmation
const confirmDelete = (submission: ContactSubmission) => {
    selectedSubmission.value = submission
    deleteDialog.value = true
}

// Handle delete
const handleDelete = () => {
    if (!selectedSubmission.value) return

    deleteForm.delete(route('admin.contact-submissions.destroy', selectedSubmission.value.id), {
        preserveScroll: true,
        onSuccess: () => {
            deleteDialog.value = false
            selectedSubmission.value = null
        }
    })
}



// Handle export
const handleExport = () => {
    window.location.href = route('admin.contact-submissions.export')
}

// Handle refresh
const handleRefresh = () => {
    router.reload({ preserveState: true })
}

// Get status icon
const getStatusIcon = (status: string) => {
    switch (status) {
        case 'new':
            return Sparkles
        case 'read':
            return Eye
        case 'replied':
            return Send
        case 'archived':
            return Archive
        default:
            return AlertCircle
    }
}
</script>

<template>
    <AppLayout :breadcrumbs="breadcrumbItems">
        <Head title="Contact Submissions" />

        <div class="flex flex-col gap-6 p-6">
            <!-- Header -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold tracking-tight">Contact Submissions</h1>
                    <p class="text-muted-foreground">
                        Manage and respond to messages from your website visitors
                    </p>
                </div>
                <div class="flex items-center gap-2">
                    <Button variant="outline" @click="handleRefresh">
                        <RefreshCw class="h-4 w-4 mr-2" />
                        Refresh
                    </Button>
                    <Button variant="outline" @click="handleExport">
                        <Download class="h-4 w-4 mr-2" />
                        Export CSV
                    </Button>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid gap-4 md:grid-cols-4">
                <Card>
                    <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle class="text-sm font-medium">Total Submissions</CardTitle>
                        <Inbox class="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">{{ submissions.total }}</div>
                        <p class="text-xs text-muted-foreground">
                            All time submissions
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle class="text-sm font-medium">New</CardTitle>
                        <Sparkles class="h-4 w-4 text-blue-500" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold text-blue-600">
                            {{ submissions.data.filter(s => s.status === 'new').length }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Awaiting attention
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle class="text-sm font-medium">Replied</CardTitle>
                        <Send class="h-4 w-4 text-green-500" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold text-green-600">
                            {{ submissions.data.filter(s => s.status === 'replied').length }}
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Responses sent
                        </p>
                    </CardContent>
                </Card>
                <Card>
                    <CardHeader class="flex flex-row items-center justify-between space-y-0 pb-2">
                        <CardTitle class="text-sm font-medium">Response Rate</CardTitle>
                        <MessageSquare class="h-4 w-4 text-muted-foreground" />
                    </CardHeader>
                    <CardContent>
                        <div class="text-2xl font-bold">
                            {{ Math.round((submissions.data.filter(s => s.status === 'replied').length / submissions.total) * 100) || 0 }}%
                        </div>
                        <p class="text-xs text-muted-foreground">
                            Of total submissions
                        </p>
                    </CardContent>
                </Card>
            </div>

            <!-- Filters -->
            <Card>
                <CardContent class="p-4">
                    <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div class="flex flex-1 items-center gap-4">
                            <div class="relative flex-1 max-w-sm">
                                <Search class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-muted-foreground" />
                                <Input
                                    v-model="search"
                                    placeholder="Search by name, email, or message..."
                                    class="pl-9"
                                    @input="handleSearch"
                                />
                            </div>
                            <Select :value="statusFilter" @update:modelValue="handleStatusChange">
                                <SelectTrigger class="w-[180px]">
                                    <Filter class="h-4 w-4 mr-2" />
                                    <SelectValue placeholder="Filter by status" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectItem value="all">All Statuses</SelectItem>
                                    <SelectItem value="new">New</SelectItem>
                                    <SelectItem value="read">Read</SelectItem>
                                    <SelectItem value="replied">Replied</SelectItem>
                                    <SelectItem value="archived">Archived</SelectItem>
                                </SelectContent>
                            </Select>
                        </div>
                        <div class="text-sm text-muted-foreground">
                            Showing {{ submissions.data.length }} of {{ submissions.total }} submissions
                        </div>
                    </div>
                </CardContent>
            </Card>

            <!-- Submissions Table -->
            <Card>
                <CardContent class="p-0">
                    <Table>
                        <TableHeader>
                            <TableRow>
                                <TableHead class="w-[50px]">ID</TableHead>
                                <TableHead>
                                    <div class="flex items-center gap-1">
                                        <User class="h-4 w-4" />
                                        Name
                                    </div>
                                </TableHead>
                                <TableHead>Contact</TableHead>
                                <TableHead>Inquiry Type</TableHead>
                                <TableHead>Status</TableHead>
                                <TableHead>
                                    <div class="flex items-center gap-1">
                                        <Calendar class="h-4 w-4" />
                                        Received
                                    </div>
                                </TableHead>
                                <TableHead class="text-right">Actions</TableHead>
                            </TableRow>
                        </TableHeader>
                        <TableBody>
                            <TableRow v-for="submission in submissions.data" :key="submission.id">
                                <TableCell class="font-medium">#{{ submission.id }}</TableCell>
                                <TableCell>
                                    <div>
                                        <div class="font-medium">{{ submission.full_name }}</div>
                                        <div class="text-sm text-muted-foreground line-clamp-1 max-w-[200px]">
                                            {{ submission.message.substring(0, 50) }}...
                                        </div>
                                    </div>
                                </TableCell>
                                <TableCell>
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-1 text-sm">
                                            <Mail class="h-3 w-3 text-muted-foreground" />
                                            <span>{{ submission.email }}</span>
                                        </div>
                                        <div v-if="submission.phone" class="flex items-center gap-1 text-sm">
                                            <Phone class="h-3 w-3 text-muted-foreground" />
                                            <span>{{ submission.phone }}</span>
                                        </div>
                                    </div>
                                </TableCell>
                                <TableCell>
                                    <Badge variant="outline">
                                        {{ inquiryTypeLabels[submission.inquiry_type] || submission.inquiry_type }}
                                    </Badge>
                                </TableCell>
                                <TableCell>
                                    <Badge :class="statusColors[submission.status]" class="capitalize">
                                        <component :is="getStatusIcon(submission.status)" class="h-3 w-3 mr-1" />
                                        {{ submission.status }}
                                    </Badge>
                                </TableCell>
                                <TableCell>
                                    <div class="text-sm">
                                        {{ formatDate(submission.created_at) }}
                                    </div>
                                </TableCell>
                                <TableCell class="text-right">
                                    <DropdownMenu>
                                        <DropdownMenuTrigger as-child>
                                            <Button variant="ghost" class="h-8 w-8 p-0">
                                                <span class="sr-only">Open menu</span>
                                                <MoreHorizontal class="h-4 w-4" />
                                            </Button>
                                        </DropdownMenuTrigger>
                                        <DropdownMenuContent align="end">
                                            <DropdownMenuLabel>Actions</DropdownMenuLabel>
                                            <DropdownMenuItem as-child>
                                                <Link :href="route('admin.contact-submissions.show', submission.id)" class="w-full cursor-pointer">
                                                    <Eye class="h-4 w-4 mr-2" />
                                                    View Details
                                                </Link>
                                            </DropdownMenuItem>
                                            <DropdownMenuSeparator />
                                            <DropdownMenuItem
                                                class="text-red-600 focus:text-red-600"
                                                @click="confirmDelete(submission)"
                                            >
                                                <Trash2 class="h-4 w-4 mr-2" />
                                                Delete
                                            </DropdownMenuItem>
                                        </DropdownMenuContent>
                                    </DropdownMenu>
                                </TableCell>
                            </TableRow>
                            <TableRow v-if="submissions.data.length === 0">
                                <TableCell colspan="7" class="h-32 text-center">
                                    <div class="flex flex-col items-center justify-center text-muted-foreground">
                                        <Inbox class="h-8 w-8 mb-2" />
                                        <p>No submissions found</p>
                                    </div>
                                </TableCell>
                            </TableRow>
                        </TableBody>
                    </Table>
                </CardContent>
            </Card>

            <!-- Pagination -->
            <div v-if="submissions.last_page > 1" class="flex items-center justify-end">
                <Pagination>
                    <PaginationPrevious :href="submissions.links[0]?.url" />
                    <PaginationList>
                        <template v-for="(link, index) in submissions.links.slice(1, -1)" :key="index">
                            <Link
                                v-if="link.url"
                                :href="link.url"
                                class="inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors hover:bg-accent hover:text-accent-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-background hover:bg-accent hover:text-accent-foreground h-10 px-4 py-2"
                                :class="{ 'bg-primary text-primary-foreground hover:bg-primary/90': link.active }"
                                v-html="link.label"
                            />
                        </template>
                    </PaginationList>
                    <PaginationNext :href="submissions.links[submissions.links.length - 1]?.url" />
                </Pagination>
            </div>
        </div>

        <!-- Delete Confirmation Dialog -->
        <Dialog :open="deleteDialog" @update:open="deleteDialog = false">
            <DialogContent>
                <DialogHeader>
                    <DialogTitle>Delete Submission</DialogTitle>
                    <DialogDescription>
                        Are you sure you want to delete this contact submission from
                        <span class="font-medium">{{ selectedSubmission?.full_name }}</span>?
                        This action cannot be undone.
                    </DialogDescription>
                </DialogHeader>
                <DialogFooter>
                    <Button variant="outline" @click="deleteDialog = false">
                        Cancel
                    </Button>
                    <Button
                        variant="destructive"
                        @click="handleDelete"
                        :disabled="deleteForm.processing"
                    >
                        {{ deleteForm.processing ? 'Deleting...' : 'Delete' }}
                    </Button>
                </DialogFooter>
            </DialogContent>
        </Dialog>
    </AppLayout>
</template>
