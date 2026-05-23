<script setup>
import { Link } from '@inertiajs/vue3'

const props = defineProps({
  package: Object,
  showBookButton: { type: Boolean, default: true },
})

function formatPrice(amount) {
  return new Intl.NumberFormat('sw-TZ', {
    style: 'currency',
    currency: 'TZS',
    minimumFractionDigits: 0,
  }).format(amount)
}
</script>

<template>
  <div class="card p-5 flex flex-col gap-3 hover:shadow-md transition-shadow duration-200">
    <div class="flex items-start justify-between gap-2">
      <h4 class="font-display text-lg text-stone-900">{{ pkg.name }}</h4>
      <span class="text-[#b5906b] font-semibold text-base whitespace-nowrap">
        {{ formatPrice(pkg.price) }}
      </span>
    </div>

    <p class="text-sm text-stone-500 leading-relaxed">{{ pkg.description }}</p>

    <div v-if="pkg.guest_limit" class="text-xs text-stone-400 flex items-center gap-1">
      <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
      </svg>
      Up to {{ pkg.guest_limit }} guests
    </div>

    <!-- Extra metadata items -->
    <div v-if="pkg.metadata && Object.keys(pkg.metadata).length" class="flex flex-wrap gap-1.5">
      <span v-for="(val, key) in pkg.metadata" :key="key"
            class="text-xs px-2 py-0.5 bg-stone-100 text-stone-600 rounded-full">
        {{ key }}: {{ val }}
      </span>
    </div>

    <Link v-if="showBookButton" :href="route('packages.show', pkg.id)"
          class="btn-primary mt-1 justify-center text-center">
      Select Package →
    </Link>
  </div>
</template>

<script>
// alias so template can use `pkg`
export default {
  computed: {
    pkg() { return this.package }
  }
}
</script>
