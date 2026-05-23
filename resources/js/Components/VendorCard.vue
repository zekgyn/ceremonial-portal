<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
  vendor: Object,
})

const categoryColors = {
  catering: 'bg-amber-50 text-amber-700',
  venue_decoration: 'bg-rose-50 text-rose-700',
  entertainment_media: 'bg-violet-50 text-violet-700',
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
  <Link :href="route('vendors.show', vendor.id)" class="card p-5 flex flex-col gap-4 hover:shadow-md hover:border-stone-200 transition-all duration-200 group">
    <!-- Header -->
    <div class="flex items-start justify-between gap-3">
      <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl"
           :class="categoryColors[vendor.category]">
        {{ categoryIcons[vendor.category] }}
      </div>
      <span v-if="vendor.verified"
            class="inline-flex items-center gap-1 text-[10px] uppercase tracking-wider text-emerald-700 bg-emerald-50 px-2 py-0.5 rounded-full font-medium">
        ✓ Verified
      </span>
    </div>

    <!-- Info -->
    <div>
      <h3 class="font-display text-lg text-stone-900 group-hover:text-[#b5906b] transition-colors">
        {{ vendor.business_name }}
      </h3>
      <p class="text-sm text-stone-500 mt-1 line-clamp-2">{{ vendor.description }}</p>
    </div>

    <!-- Footer -->
    <div class="flex items-center justify-between pt-1 border-t border-stone-50 text-xs text-stone-400">
      <span class="flex items-center gap-1">
        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
        </svg>
        {{ vendor.location }}
      </span>
      <span>{{ vendor.packages_count ?? 0 }} packages</span>
    </div>
  </Link>
</template>
