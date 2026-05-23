<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { router } from '@inertiajs/vue3'

defineProps({ bookings: Array })

function formatPrice(n) {
  return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
}
function formatDate(d) {
  return new Date(d).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })
}

function updateStatus(booking, status) {
  router.patch(route('vendor.bookings.status', booking.id), { status })
}

const statusOptions = ['pending', 'confirmed', 'cancelled']
</script>

<template>
  <AppLayout>
    <div class="mb-8">
      <h1 class="font-display text-4xl text-stone-900 mb-1">Booking Requests</h1>
      <p class="text-stone-500">Manage incoming bookings for your packages.</p>
    </div>

    <div v-if="!bookings.length" class="card p-16 text-center text-stone-400">
      <p class="font-display text-2xl mb-2">No bookings yet</p>
      <p class="text-sm">Bookings from clients will appear here.</p>
    </div>

    <div class="space-y-4">
      <div v-for="booking in bookings" :key="booking.id" class="card p-5">
        <div class="flex items-start justify-between gap-4 mb-4">
          <div>
            <p class="font-medium text-stone-800">{{ booking.vendor_package?.name }}</p>
            <p class="text-xs text-stone-400 mt-0.5">
              Booked by {{ booking.event?.user?.firstname }} {{ booking.event?.user?.lastname }}
            </p>
          </div>
          <span :class="`badge-${booking.status}`" class="badge">{{ booking.status }}</span>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 mb-4 text-sm">
          <div>
            <p class="text-xs uppercase tracking-wider text-stone-400 mb-1">Event</p>
            <p class="font-medium text-stone-700">{{ booking.event?.title }}</p>
          </div>
          <div>
            <p class="text-xs uppercase tracking-wider text-stone-400 mb-1">Event Date</p>
            <p class="font-medium text-stone-700">{{ formatDate(booking.event?.date) }}</p>
          </div>
          <div>
            <p class="text-xs uppercase tracking-wider text-stone-400 mb-1">Amount</p>
            <p class="font-semibold text-[#b5906b]">{{ formatPrice(booking.total_price) }}</p>
          </div>
        </div>

        <div class="flex items-center gap-2 pt-3 border-t border-stone-50">
          <span class="text-xs text-stone-400 mr-2">Update status:</span>
          <button v-for="status in statusOptions" :key="status"
                  @click="updateStatus(booking, status)"
                  class="px-3 py-1.5 rounded-lg text-xs font-medium border transition-all"
                  :class="booking.status === status
                    ? 'border-[#b5906b] bg-[#b5906b]/5 text-[#b5906b]'
                    : 'border-stone-200 text-stone-500 hover:border-stone-300'">
            {{ status.charAt(0).toUpperCase() + status.slice(1) }}
          </button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
