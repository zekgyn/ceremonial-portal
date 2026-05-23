<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({ vendor: Object })

function formatPrice(n) {
  return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
}

const categoryMeta = {
  catering: { label: 'Catering', icon: '🍽', color: 'bg-amber-50 text-amber-700' },
  venue_decoration: { label: 'Venue & Décor', icon: '🌸', color: 'bg-rose-50 text-rose-700' },
  entertainment_media: { label: 'Entertainment & Media', icon: '🎵', color: 'bg-violet-50 text-violet-700' },
}

const meta = props.vendor?.category ? categoryMeta[props.vendor.category] : {}
</script>

<template>
  <AppLayout>
    <Link :href="route('vendors.index')" class="inline-flex items-center gap-1.5 text-sm text-stone-400 hover:text-stone-600 mb-6">
      ← Back to Marketplace
    </Link>

    <!-- Vendor header -->
    <div class="card p-8 mb-8">
      <div class="flex items-start gap-5">
        <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-3xl shrink-0"
             :class="meta.color">
          {{ meta.icon }}
        </div>
        <div class="flex-1">
          <div class="flex items-start justify-between gap-4">
            <div>
              <h1 class="font-display text-3xl text-stone-900">{{ vendor.business_name }}</h1>
              <p class="text-stone-500 text-sm mt-0.5">{{ meta.label }}</p>
            </div>
            <div class="flex flex-col items-end gap-2">
              <span v-if="vendor.verified"
                    class="inline-flex items-center gap-1 text-xs text-emerald-700 bg-emerald-50 border border-emerald-100 px-2.5 py-1 rounded-full">
                ✓ Verified
              </span>
              <span class="text-xs text-stone-400 flex items-center gap-1">
                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                </svg>
                {{ vendor.location }}
              </span>
            </div>
          </div>
          <p class="text-stone-600 text-sm mt-3 leading-relaxed max-w-xl">{{ vendor.description }}</p>
        </div>
      </div>
    </div>

    <!-- Packages -->
    <div>
      <h2 class="font-display text-2xl text-stone-900 mb-5">
        Available Packages
        <span class="text-stone-400 text-lg font-normal ml-2">({{ vendor.packages?.length ?? 0 }})</span>
      </h2>

      <div v-if="!vendor.packages?.length" class="card p-10 text-center text-stone-400">
        No packages available yet.
      </div>

      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
        <div v-for="pkg in vendor.packages" :key="pkg.id" class="card p-5 flex flex-col gap-3">
          <div class="flex items-start justify-between gap-2">
            <h3 class="font-display text-lg text-stone-900">{{ pkg.name }}</h3>
            <span class="text-[#b5906b] font-semibold text-sm whitespace-nowrap">
              {{ formatPrice(pkg.price) }}
            </span>
          </div>

          <p class="text-sm text-stone-500 leading-relaxed flex-1">{{ pkg.description }}</p>

          <div v-if="pkg.guest_limit" class="text-xs text-stone-400 flex items-center gap-1">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Up to {{ pkg.guest_limit }} guests
          </div>

          <Link :href="route('packages.show', pkg.id)" class="btn-primary justify-center text-sm mt-1">
            Select Package →
          </Link>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
