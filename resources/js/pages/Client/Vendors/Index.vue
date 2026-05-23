<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import VendorCard from '@/Components/VendorCard.vue'
import { Link, router } from '@inertiajs/vue3'
import { ref, watch } from 'vue'

const props = defineProps({
  vendors: Object,
  filters: Object,
})

const search = ref(props.filters?.search ?? '')
const category = ref(props.filters?.category ?? '')

const categories = [
  { value: '', label: 'All Categories', icon: '✦' },
  { value: 'catering', label: 'Catering', icon: '🍽' },
  { value: 'venue_decoration', label: 'Venue & Décor', icon: '🌸' },
  { value: 'entertainment_media', label: 'Entertainment', icon: '🎵' },
]

let debounce = null
watch([search, category], () => {
  clearTimeout(debounce)
  debounce = setTimeout(() => {
    router.get(route('vendors.index'), {
      search: search.value || undefined,
      category: category.value || undefined,
    }, { preserveState: true, replace: true })
  }, 350)
})
</script>

<template>
  <AppLayout>
    <div class="mb-8">
      <h1 class="font-display text-4xl text-stone-900 mb-1">Vendor Marketplace</h1>
      <p class="text-stone-500">Discover and book verified service providers.</p>
    </div>

    <!-- Filters -->
    <div class="flex flex-col sm:flex-row gap-3 mb-8">
      <div class="relative flex-1 max-w-sm">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input v-model="search" type="text" placeholder="Search vendors…"
               class="input pl-9" />
      </div>

      <div class="flex items-center gap-2">
        <button v-for="cat in categories" :key="cat.value"
                @click="category = cat.value"
                class="flex items-center gap-1.5 px-3.5 py-2 rounded-lg text-sm border transition-all duration-150"
                :class="category === cat.value
                  ? 'border-[#b5906b] bg-[#b5906b]/5 text-[#b5906b]'
                  : 'border-stone-200 text-stone-500 hover:border-stone-300 bg-white'">
          <span>{{ cat.icon }}</span>
          <span class="hidden sm:inline">{{ cat.label }}</span>
        </button>
      </div>
    </div>

    <!-- Results -->
    <div v-if="vendors.data.length" class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
      <VendorCard v-for="vendor in vendors.data" :key="vendor.id" :vendor="vendor" />
    </div>

    <div v-else class="card p-16 text-center text-stone-400">
      <p class="font-display text-2xl mb-2">No vendors found</p>
      <p class="text-sm">Try adjusting your filters.</p>
    </div>

    <!-- Pagination -->
    <div v-if="vendors.last_page > 1" class="mt-8 flex items-center justify-center gap-2">
      <Link v-if="vendors.prev_page_url" :href="vendors.prev_page_url"
            class="btn-secondary text-sm">← Previous</Link>
      <span class="text-sm text-stone-400">Page {{ vendors.current_page }} of {{ vendors.last_page }}</span>
      <Link v-if="vendors.next_page_url" :href="vendors.next_page_url"
            class="btn-secondary text-sm">Next →</Link>
    </div>
  </AppLayout>
</template>
