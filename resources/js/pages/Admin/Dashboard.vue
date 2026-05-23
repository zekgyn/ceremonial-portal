<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { Link, router } from '@inertiajs/vue3'

defineProps({
  stats: Object,
  recentVendors: Array,
})

function formatPrice(n) {
  return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
}

function toggleVerify(id) {
  router.patch(route('admin.vendors.verify', id))
}

const categoryLabels = {
  catering: 'Catering',
  venue_decoration: 'Venue & Décor',
  entertainment_media: 'Entertainment',
}
</script>

<template>
  <AppLayout>
    <div class="mb-8">
      <h1 class="font-display text-4xl text-stone-900 mb-1">Admin Overview</h1>
      <p class="text-stone-500">Platform-wide metrics and vendor management.</p>
    </div>

    <!-- Stats grid -->
    <div class="grid grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-10">
      <div class="stat-card">
        <span class="text-xs uppercase tracking-wider text-stone-400">Users</span>
        <span class="font-display text-3xl text-stone-900">{{ stats.users }}</span>
      </div>
      <div class="stat-card">
        <span class="text-xs uppercase tracking-wider text-stone-400">Vendors</span>
        <span class="font-display text-3xl text-stone-900">{{ stats.vendors }}</span>
      </div>
      <div class="stat-card">
        <span class="text-xs uppercase tracking-wider text-stone-400">Events</span>
        <span class="font-display text-3xl text-stone-900">{{ stats.events }}</span>
      </div>
      <div class="stat-card">
        <span class="text-xs uppercase tracking-wider text-stone-400">Bookings</span>
        <span class="font-display text-3xl text-stone-900">{{ stats.bookings }}</span>
      </div>
      <div class="stat-card">
        <span class="text-xs uppercase tracking-wider text-stone-400">Pending Verify</span>
        <span class="font-display text-3xl text-amber-600">{{ stats.pending_vendors }}</span>
      </div>
      <div class="stat-card col-span-2 xl:col-span-1">
        <span class="text-xs uppercase tracking-wider text-stone-400">Revenue</span>
        <span class="font-display text-xl text-[#b5906b]">{{ formatPrice(stats.revenue) }}</span>
      </div>
    </div>

    <!-- Vendor management -->
    <div class="mb-5 flex items-center justify-between">
      <h2 class="font-display text-2xl text-stone-900">Vendors</h2>
      <Link :href="route('admin.vendors.index')" class="text-sm text-[#b5906b] hover:text-[#8c6a47]">
        View all →
      </Link>
    </div>

    <div class="card overflow-hidden">
      <table class="w-full text-sm">
        <thead>
          <tr class="border-b border-stone-100 text-left">
            <th class="px-5 py-3.5 text-xs uppercase tracking-wider text-stone-400 font-medium">Business</th>
            <th class="px-5 py-3.5 text-xs uppercase tracking-wider text-stone-400 font-medium">Category</th>
            <th class="px-5 py-3.5 text-xs uppercase tracking-wider text-stone-400 font-medium">Location</th>
            <th class="px-5 py-3.5 text-xs uppercase tracking-wider text-stone-400 font-medium">Status</th>
            <th class="px-5 py-3.5 text-xs uppercase tracking-wider text-stone-400 font-medium">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-stone-50">
          <tr v-for="vendor in recentVendors" :key="vendor.id" class="hover:bg-stone-50/50 transition-colors">
            <td class="px-5 py-3.5">
              <p class="font-medium text-stone-800">{{ vendor.business_name }}</p>
              <p class="text-xs text-stone-400">{{ vendor.user?.firstname }} {{ vendor.user?.lastname }}</p>
            </td>
            <td class="px-5 py-3.5 text-stone-500">{{ categoryLabels[vendor.category] }}</td>
            <td class="px-5 py-3.5 text-stone-500">{{ vendor.location }}</td>
            <td class="px-5 py-3.5">
              <span v-if="vendor.verified" class="badge badge-confirmed">Verified</span>
              <span v-else class="badge badge-pending">Unverified</span>
            </td>
            <td class="px-5 py-3.5">
              <button @click="toggleVerify(vendor.id)"
                      class="text-xs font-medium transition-colors"
                      :class="vendor.verified
                        ? 'text-red-400 hover:text-red-600'
                        : 'text-[#b5906b] hover:text-[#8c6a47]'">
                {{ vendor.verified ? 'Revoke' : 'Verify' }}
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AppLayout>
</template>
