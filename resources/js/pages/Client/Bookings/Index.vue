<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { Link, router } from '@inertiajs/vue3'

defineProps({ bookings: Array })

function formatPrice(n) {
  return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
}
function formatDate(d) {
  return new Date(d).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })
}

function remove(id) {
  if (confirm('Remove this booking?')) router.delete(route('bookings.destroy', id))
}

const categoryIcons = {
  catering: '🍽',
  venue_decoration: '🌸',
  entertainment_media: '🎵',
}
</script>

<template>
  <AppLayout>
    <div class="mb-8">
      <h1 class="font-display text-4xl text-stone-900 mb-1">My Bookings</h1>
      <p class="text-stone-500">All your vendor bookings across events.</p>
    </div>

    <div v-if="!bookings.length" class="card p-16 text-center text-stone-400">
      <p class="font-display text-2xl mb-2">No bookings yet</p>
      <p class="text-sm mb-6">Browse vendors and add packages to your events.</p>
      <Link :href="route('vendors.index')" class="btn-primary">Browse Vendors →</Link>
    </div>

    <div class="space-y-3">
      <div v-for="booking in bookings" :key="booking.id"
           class="card p-5 flex items-center gap-5">
        <div class="w-10 h-10 rounded-lg bg-stone-100 flex items-center justify-center text-lg shrink-0">
          {{ categoryIcons[booking.vendor_package?.vendor?.category] ?? '✦' }}
        </div>

        <div class="flex-1 min-w-0">
          <div class="flex items-start justify-between gap-2">
            <p class="font-medium text-stone-800 text-sm">{{ booking.vendor_package?.name }}</p>
            <span :class="`badge-${booking.status}`" class="badge shrink-0">{{ booking.status }}</span>
          </div>
          <p class="text-xs text-stone-400 mt-0.5">
            {{ booking.vendor_package?.vendor?.business_name }} ·
            <Link :href="route('events.show', booking.event?.id)"
                  class="hover:text-[#b5906b] transition-colors">
              {{ booking.event?.title }}
            </Link>
          </p>
          <p class="text-xs text-stone-400 mt-1">Event: {{ formatDate(booking.event?.date) }}</p>
        </div>

        <div class="text-right shrink-0">
          <p class="font-semibold text-[#b5906b]">{{ formatPrice(booking.total_price) }}</p>
          <button @click="remove(booking.id)"
                  class="mt-1.5 text-xs text-stone-300 hover:text-red-400 transition-colors">
            Remove
          </button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
