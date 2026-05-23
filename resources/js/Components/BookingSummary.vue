<script lang="ts" setup>
defineProps({
  bookings: Array,
  totalCost: [Number, String],
  budget: [Number, String, null],
})

const categoryLabels = {
  catering: 'Catering',
  venue_decoration: 'Venue & Décor',
  entertainment_media: 'Entertainment & Media',
}

function formatPrice(amount:number | bigint | Intl.StringNumericLiteral) {
  return new Intl.NumberFormat('sw-TZ', {
    style: 'currency',
    currency: 'TZS',
    minimumFractionDigits: 0,
  }).format(amount)
}
</script>

<template>
  <div class="card divide-y divide-stone-100">
    <div class="px-5 py-4">
      <h3 class="font-display text-lg text-stone-900">Booking Summary</h3>
    </div>

    <div v-if="!bookings?.length" class="px-5 py-6 text-center text-sm text-stone-400">
      No packages selected yet.
    </div>

    <div v-for="booking in bookings" :key="booking.id" class="px-5 py-3.5 flex items-start justify-between gap-3">
      <div class="flex-1 min-w-0">
        <p class="text-xs uppercase tracking-wider text-stone-400 mb-0.5">
          {{ categoryLabels[booking.vendor_package?.vendor?.category] ?? 'Service' }}
        </p>
        <p class="text-sm font-medium text-stone-800 truncate">{{ booking.vendor_package?.name }}</p>
        <p class="text-xs text-stone-400 truncate">{{ booking.vendor_package?.vendor?.business_name }}</p>
      </div>
      <div class="text-right shrink-0">
        <p class="text-sm font-semibold text-stone-800">{{ formatPrice(booking.total_price) }}</p>
        <span :class="`badge-${booking.status}`" class="badge mt-0.5">{{ booking.status }}</span>
      </div>
    </div>

    <div class="px-5 py-4 bg-stone-50 rounded-b-2xl">
      <div class="flex items-center justify-between">
        <span class="text-sm font-medium text-stone-600">Total Cost</span>
        <span class="text-base font-semibold text-[#b5906b]">{{ formatPrice(totalCost) }}</span>
      </div>
      <div v-if="budget" class="flex items-center justify-between mt-1.5">
        <span class="text-xs text-stone-400">Budget</span>
        <span class="text-xs" :class="Number(totalCost) > Number(budget) ? 'text-red-500' : 'text-emerald-600'">
          {{ formatPrice(budget) }}
          <span v-if="Number(totalCost) > Number(budget)"> ↑ Over budget</span>
          <span v-else> ✓ Within budget</span>
        </span>
      </div>
    </div>
  </div>
</template>
