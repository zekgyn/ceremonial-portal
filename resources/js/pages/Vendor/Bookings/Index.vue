<script lang="ts" setup>
import { Head } from '@inertiajs/vue3'
import { dashboard } from '@/routes/vendor';
import { index, } from '@/routes/vendor/bookings';
import { Card } from '@/components/ui/card';

defineProps({ bookings: Object })
interface Booking {
    id: string
}
defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Home',
                href: dashboard(),
            },
            {
                title: 'Booking',
                href: index(),
            },
        ],
    },
});

function formatPrice(n: number) {
    return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
}
function formatDate(d: string) {
    return new Date(d).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })
}

function updateStatus(booking: Booking, status: string) {
    // router.patch(route('vendor.bookings.status', booking.id), { status })
}

const statusOptions = ['pending', 'confirmed', 'cancelled']
</script>

<template>
    <Head title="Bookings"/>

    <main class="min-h-screen">
        <div class="mb-8 flex items-start justify-between gap-4 bg-linear-to-r from-blue-800 to-sky-600 py-10 px-4">
            <div>
                <h1 class="font-display text-4xl text-sky-100 mb-1">Booking Requests</h1>
                <p class="text-sky-300">Manage incoming bookings for your packages.</p>
            </div>
        </div>

        <div v-if="!bookings?.length" class="card p-16 text-center">
            <p class="font-display text-2xl mb-2">No bookings yet</p>
            <p class="text-sm">Bookings from clients will appear here.</p>
        </div>

        <div class="space-y-4 mx-6">
            <Card v-for="booking in bookings" :key="booking.id" class="p-5">
                <div class="flex items-start justify-between gap-4 mb-4">
                    <div>
                        <p class="font-medium text-sky-800">{{ booking.vendor_package?.name }}</p>
                        <p class="text-xs text-sky-400 mt-0.5">
                            Booked by {{ booking.event?.user?.name }}
                        </p>
                    </div>
                    <span :class="`badge-${booking.status}`" class="badge">{{ booking.status }}</span>
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4 text-sm">
                    <div>
                        <p class="text-xs uppercase tracking-wider text-sky-400 mb-1">Event</p>
                        <p class="font-medium text-sky-700">{{ booking.event?.title }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-sky-400 mb-1">Event Date</p>
                        <p class="font-medium text-sky-700">{{ formatDate(booking.event?.date) }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase tracking-wider text-sky-400 mb-1">Amount</p>
                        <p class="font-semibold text-blue-600">{{ formatPrice(booking.total_price) }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-2 pt-3 border-t border-sky-50">
                    <span class="text-xs text-sky-400 mr-2">Update status:</span>
                    <button v-for="status in statusOptions" :key="status" @click="updateStatus(booking, status)"
                        class="px-3 py-1.5 rounded-lg text-xs font-medium border transition-all" :class="booking.status === status
                            ? 'border-sky-300 bg-sky-500/5 text-sky-200'
                            : 'border-sky-200 text-sky-500 hover:border-sky-300'">
                        {{ status.charAt(0).toUpperCase() + status.slice(1) }}
                    </button>
                </div>
            </Card>
        </div>
    </main>
</template>
