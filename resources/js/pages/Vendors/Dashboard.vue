<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

defineProps({
  vendor: Object,
  bookings: Array,
  stats: Object,
})

function formatPrice(n) {
  return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
}
function formatDate(d) {
  return new Date(d).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })
}
</script>

<template>
  <AppLayout>
    <div class="mb-8 flex items-start justify-between gap-4">
      <div>
        <h1 class="font-display text-4xl text-stone-900">Vendor Dashboard</h1>
        <p class="text-stone-500 mt-1">{{ vendor.business_name }}</p>
      </div>
      <div class="flex items-center gap-2">
        <span v-if="vendor.verified"
              class="inline-flex items-center gap-1 text-xs text-emerald-700 bg-emerald-50 border border-emerald-100 px-2.5 py-1.5 rounded-full">
          ✓ Verified
        </span>
        <span v-else
              class="inline-flex items-center gap-1 text-xs text-amber-700 bg-amber-50 border border-amber-100 px-2.5 py-1.5 rounded-full">
          ⏳ Pending Verification
        </span>
      </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mb-10">
      <div class="stat-card">
        <span class="text-xs uppercase tracking-wider text-stone-400">Packages</span>
        <span class="font-display text-4xl text-stone-900">{{ stats.total_packages }}</span>
      </div>
      <div class="stat-card">
        <span class="text-xs uppercase tracking-wider text-stone-400">Bookings</span>
        <span class="font-display text-4xl text-stone-900">{{ stats.total_bookings }}</span>
      </div>
      <div class="stat-card">
        <span class="text-xs uppercase tracking-wider text-stone-400">Pending</span>
        <span class="font-display text-4xl text-amber-600">{{ stats.pending }}</span>
      </div>
      <div class="stat-card">
        <span class="text-xs uppercase tracking-wider text-stone-400">Confirmed</span>
        <span class="font-display text-4xl text-emerald-600">{{ stats.confirmed }}</span>
      </div>
      <div class="stat-card col-span-2 lg:col-span-1">
        <span class="text-xs uppercase tracking-wider text-stone-400">Revenue</span>
        <span class="font-display text-2xl text-[#b5906b]">{{ formatPrice(stats.revenue) }}</span>
      </div>
    </div>

    <!-- Recent bookings -->
    <div class="mb-5 flex items-center justify-between">
      <h2 class="font-display text-2xl text-stone-900">Recent Bookings</h2>
      <Link :href="route('vendor.bookings.index')" class="text-sm text-[#b5906b] hover:text-[#8c6a47]">View all →</Link>
    </div>

    <div v-if="!bookings.length" class="card p-10 text-center text-stone-400">
      <p class="font-display text-xl mb-2">No bookings yet</p>
      <p class="text-sm">Create packages to start receiving bookings.</p>
    </div>

    <div class="space-y-3">
      <div v-for="booking in bookings" :key="booking.id"
           class="card p-4 flex items-center gap-4">
        <div class="flex-1 min-w-0">
          <p class="font-medium text-stone-800 text-sm">{{ booking.vendor_package?.name }}</p>
          <p class="text-xs text-stone-400 mt-0.5">
            {{ booking.event?.title }} · {{ booking.event?.user?.firstname }} {{ booking.event?.user?.lastname }}
          </p>
          <p class="text-xs text-stone-400">Event on {{ formatDate(booking.event?.date) }}</p>
        </div>
        <div class="text-right shrink-0">
          <p class="font-semibold text-[#b5906b] text-sm">{{ formatPrice(booking.total_price) }}</p>
          <span :class="`badge-${booking.status}`" class="badge mt-1">{{ booking.status }}</span>
        </div>
      </div>
    </div>

    <!-- Quick links -->
    <div class="mt-10 grid sm:grid-cols-2 gap-4">
      <Link :href="route('vendor.packages.create')" class="card p-5 flex items-center gap-3 hover:shadow-md transition-all group">
        <span class="text-2xl">📦</span>
        <div>
          <p class="font-medium text-stone-800 group-hover:text-[#b5906b] transition-colors">Add Package</p>
          <p class="text-xs text-stone-400">Create a new service package</p>
        </div>
      </Link>
      <Link :href="route('vendor.profile.show')" class="card p-5 flex items-center gap-3 hover:shadow-md transition-all group">
        <span class="text-2xl">✏️</span>
        <div>
          <p class="font-medium text-stone-800 group-hover:text-[#b5906b] transition-colors">Edit Profile</p>
          <p class="text-xs text-stone-400">Update your business information</p>
        </div>
      </Link>
    </div>
  </AppLayout>
</template>
