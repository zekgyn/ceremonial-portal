<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { Link, router } from '@inertiajs/vue3'

defineProps({ vendors: Object })

function toggleVerify(id) {
  router.patch(route('admin.vendors.verify', id))
}

const categoryLabels = {
  catering: 'Catering',
  venue_decoration: 'Venue & Décor',
  entertainment_media: 'Entertainment',
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
      <h1 class="font-display text-4xl text-stone-900 mb-1">Vendor Management</h1>
      <p class="text-stone-500">Verify and oversee all vendor accounts.</p>
    </div>

    <div class="card overflow-hidden">
      <table class="w-full text-sm">
        <thead>
          <tr class="border-b border-stone-100">
            <th class="px-5 py-4 text-left text-xs uppercase tracking-wider text-stone-400 font-medium">Vendor</th>
            <th class="px-5 py-4 text-left text-xs uppercase tracking-wider text-stone-400 font-medium">Category</th>
            <th class="px-5 py-4 text-left text-xs uppercase tracking-wider text-stone-400 font-medium">Location</th>
            <th class="px-5 py-4 text-left text-xs uppercase tracking-wider text-stone-400 font-medium">Packages</th>
            <th class="px-5 py-4 text-left text-xs uppercase tracking-wider text-stone-400 font-medium">Bookings</th>
            <th class="px-5 py-4 text-left text-xs uppercase tracking-wider text-stone-400 font-medium">Status</th>
            <th class="px-5 py-4 text-left text-xs uppercase tracking-wider text-stone-400 font-medium">Action</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-stone-50">
          <tr v-for="vendor in vendors.data" :key="vendor.id" class="hover:bg-stone-50/50 transition-colors">
            <td class="px-5 py-4">
              <p class="font-medium text-stone-800">{{ vendor.business_name }}</p>
              <p class="text-xs text-stone-400 mt-0.5">
                {{ vendor.user?.firstname }} {{ vendor.user?.lastname }}
                · {{ vendor.user?.email }}
              </p>
            </td>
            <td class="px-5 py-4">
              <span class="flex items-center gap-1.5 text-stone-600">
                {{ categoryIcons[vendor.category] }}
                {{ categoryLabels[vendor.category] }}
              </span>
            </td>
            <td class="px-5 py-4 text-stone-500">{{ vendor.location }}</td>
            <td class="px-5 py-4 text-stone-600 font-medium">{{ vendor.packages_count }}</td>
            <td class="px-5 py-4 text-stone-600 font-medium">{{ vendor.bookings_count }}</td>
            <td class="px-5 py-4">
              <span v-if="vendor.verified" class="badge badge-confirmed">Verified</span>
              <span v-else class="badge badge-pending">Unverified</span>
            </td>
            <td class="px-5 py-4">
              <button @click="toggleVerify(vendor.id)"
                      class="text-xs font-medium px-3 py-1.5 rounded-lg border transition-all"
                      :class="vendor.verified
                        ? 'border-red-200 text-red-500 hover:bg-red-50'
                        : 'border-[#b5906b]/40 text-[#b5906b] hover:bg-[#b5906b]/5'">
                {{ vendor.verified ? 'Revoke' : 'Verify' }}
              </button>
            </td>
          </tr>
        </tbody>
      </table>

      <div v-if="vendors.last_page > 1"
           class="flex items-center justify-between px-5 py-4 border-t border-stone-100">
        <p class="text-xs text-stone-400">
          Showing {{ vendors.from }}–{{ vendors.to }} of {{ vendors.total }} vendors
        </p>
        <div class="flex items-center gap-2">
          <Link v-if="vendors.prev_page_url" :href="vendors.prev_page_url" class="btn-secondary text-xs">← Previous</Link>
          <Link v-if="vendors.next_page_url" :href="vendors.next_page_url" class="btn-secondary text-xs">Next →</Link>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
