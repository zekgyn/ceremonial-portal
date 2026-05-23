<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import BookingSummary from '@/Components/BookingSummary.vue'
import { Link, router } from '@inertiajs/vue3'

const props = defineProps({
  event: Object,
  bookings_by_category: Object,
  total_cost: [Number, String],
})

function formatDate(d) {
  return new Date(d).toLocaleDateString('en-GB', { weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' })
}
function formatPrice(n) {
  return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
}

const categoryMeta = {
  catering: { label: 'Catering', icon: '🍽', color: 'bg-amber-50 text-amber-700' },
  venue_decoration: { label: 'Venue & Décor', icon: '🌸', color: 'bg-rose-50 text-rose-700' },
  entertainment_media: { label: 'Entertainment & Media', icon: '🎵', color: 'bg-violet-50 text-violet-700' },
}

function removeBooking(bookingId) {
  if (confirm('Remove this booking?')) {
    router.delete(route('bookings.destroy', bookingId))
  }
}

const allBookings = Object.values(props.bookings_by_category).flat()
</script>

<template>
  <AppLayout>
    <!-- Back -->
    <Link :href="route('events.index')" class="inline-flex items-center gap-1.5 text-sm text-stone-400 hover:text-stone-600 mb-6">
      ← Back to Events
    </Link>

    <div class="grid lg:grid-cols-3 gap-8">
      <!-- Main -->
      <div class="lg:col-span-2 space-y-6">
        <!-- Header card -->
        <div class="card p-6">
          <div class="flex items-start justify-between gap-4 mb-4">
            <div>
              <h1 class="font-display text-3xl text-stone-900">{{ event.title }}</h1>
              <p class="text-stone-500 text-sm mt-1 capitalize">{{ event.type }}</p>
            </div>
            <Link :href="route('events.edit', event.id)" class="btn-secondary text-sm shrink-0">
              Edit Event
            </Link>
          </div>

          <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mt-4">
            <div>
              <p class="text-xs uppercase tracking-wider text-stone-400 mb-1">Date</p>
              <p class="text-sm font-medium text-stone-700">{{ formatDate(event.date) }}</p>
            </div>
            <div>
              <p class="text-xs uppercase tracking-wider text-stone-400 mb-1">Location</p>
              <p class="text-sm font-medium text-stone-700">{{ event.location }}</p>
            </div>
            <div v-if="event.budget">
              <p class="text-xs uppercase tracking-wider text-stone-400 mb-1">Budget</p>
              <p class="text-sm font-medium text-stone-700">{{ formatPrice(event.budget) }}</p>
            </div>
          </div>
        </div>

        <!-- Bookings by category -->
        <div v-for="(bookings, category) in bookings_by_category" :key="category">
          <div class="flex items-center justify-between mb-3">
            <div class="flex items-center gap-2">
              <span class="text-lg">{{ categoryMeta[category]?.icon }}</span>
              <h2 class="font-display text-xl text-stone-800">{{ categoryMeta[category]?.label }}</h2>
            </div>
            <Link :href="route('vendors.index', { category })" class="text-xs text-[#b5906b] hover:text-[#8c6a47]">
              {{ bookings.length ? 'Change' : 'Browse' }} →
            </Link>
          </div>

          <div v-if="!bookings.length"
               class="card border-dashed p-6 flex items-center justify-between text-sm text-stone-400">
            <span>No {{ categoryMeta[category]?.label?.toLowerCase() }} package selected</span>
            <Link :href="route('vendors.index', { category })" class="btn-primary text-xs">
              Browse →
            </Link>
          </div>

          <div v-else class="space-y-3">
            <div v-for="booking in bookings" :key="booking.id"
                 class="card p-4 flex items-start justify-between gap-4">
              <div class="flex-1 min-w-0">
                <p class="font-medium text-stone-800 text-sm">{{ booking.vendor_package?.name }}</p>
                <p class="text-xs text-stone-400 mt-0.5">{{ booking.vendor_package?.vendor?.business_name }}</p>
                <div class="flex items-center gap-3 mt-2">
                  <span :class="`badge-${booking.status}`" class="badge">{{ booking.status }}</span>
                  <span class="text-sm font-semibold text-[#b5906b]">{{ formatPrice(booking.total_price) }}</span>
                </div>
              </div>
              <button @click="removeBooking(booking.id)"
                      class="p-1.5 text-stone-300 hover:text-red-400 transition-colors shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
              </button>
            </div>
          </div>
        </div>

        <!-- Add more packages CTA -->
        <div class="card p-6 text-center">
          <p class="text-stone-500 text-sm mb-4">Need more services?</p>
          <Link :href="route('vendors.index')" class="btn-primary">
            Browse Vendor Marketplace →
          </Link>
        </div>
      </div>

      <!-- Sidebar summary -->
      <div class="space-y-4">
        <BookingSummary
          :bookings="allBookings"
          :total-cost="total_cost"
          :budget="event.budget"
        />

        <div class="card p-4 text-center">
          <p class="text-xs text-stone-400 mb-3">Ready to finalise?</p>
          <Link :href="route('vendors.index')" class="btn-secondary w-full justify-center text-sm">
            Add More Packages
          </Link>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
