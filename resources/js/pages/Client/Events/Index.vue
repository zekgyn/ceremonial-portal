<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { Link, router } from '@inertiajs/vue3'

defineProps({ events: Array })

function formatPrice(n) {
  return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
}
function formatDate(d) {
  return new Date(d).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })
}

const typeEmoji = { wedding: '💍', funeral: '🕊', birthday: '🎂', corporate: '💼' }

function deleteEvent(id) {
  if (confirm('Delete this event and all its bookings?')) {
    router.delete(route('events.destroy', id))
  }
}
</script>

<template>
  <AppLayout>
    <div class="mb-8 flex items-start justify-between gap-4">
      <div>
        <h1 class="font-display text-4xl text-stone-900">My Events</h1>
        <p class="text-stone-500 mt-1">Manage your ceremonies and bookings.</p>
      </div>
      <Link :href="route('events.create')" class="btn-primary shrink-0">+ New Event</Link>
    </div>

    <div v-if="!events.length" class="card p-16 text-center text-stone-400">
      <p class="font-display text-3xl mb-2">No events yet</p>
      <p class="text-sm mb-6">Plan your first ceremony in minutes.</p>
      <Link :href="route('events.create')" class="btn-primary">Plan an Event →</Link>
    </div>

    <div class="space-y-4">
      <div v-for="event in events" :key="event.id"
           class="card p-5 flex items-center gap-5">
        <div class="w-12 h-12 rounded-xl bg-stone-100 flex items-center justify-center text-2xl shrink-0">
          {{ typeEmoji[event.type] ?? '✦' }}
        </div>
        <div class="flex-1 min-w-0">
          <div class="flex items-start justify-between gap-2">
            <Link :href="route('events.show', event.id)"
                  class="font-display text-xl text-stone-900 hover:text-[#b5906b] transition-colors truncate">
              {{ event.title }}
            </Link>
            <span class="text-xs text-stone-400 whitespace-nowrap">{{ formatDate(event.date) }}</span>
          </div>
          <p class="text-sm text-stone-400 mt-0.5">{{ event.location }}</p>
          <div class="flex items-center gap-4 mt-2 text-xs text-stone-400">
            <span>{{ event.bookings_count }} bookings</span>
            <span class="text-[#b5906b] font-medium">{{ formatPrice(event.total_cost) }}</span>
            <span v-if="event.budget" class="text-stone-300">/ {{ formatPrice(event.budget) }} budget</span>
          </div>
        </div>
        <div class="flex items-center gap-2 shrink-0">
          <Link :href="route('events.edit', event.id)" class="btn-ghost text-xs">Edit</Link>
          <Link :href="route('events.show', event.id)" class="btn-secondary text-xs">View →</Link>
          <button @click="deleteEvent(event.id)"
                  class="p-2 text-stone-300 hover:text-red-400 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
