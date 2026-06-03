<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import AppLayout from '@/layouts/AppLayout.vue'

const props = defineProps({
  events: Array,
  stats: Object,
})

function formatPrice(n) {
  return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
}

function formatDate(d) {
  return new Date(d).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })
}

const eventTypeEmoji = {
  wedding: '💍',
  funeral: '🕊',
  birthday: '🎂',
  corporate: '💼',
}
</script>

<template>
  <AppLayout>
    <!-- Header -->
    <div class="mb-8 flex items-start justify-between gap-4">
      <div>
        <h1 class="font-display text-4xl text-stone-900">Dashboard</h1>
        <p class="text-stone-500 mt-1">Good to see you. Here's what's happening.</p>
      </div>
      <!-- route('events.create') -->
      <Link href="/" class="btn-primary shrink-0">
        + New Event
      </Link>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
      <div class="stat-card">
        <span class="text-xs uppercase tracking-wider text-stone-400">Total Events</span>
        <span class="font-display text-4xl text-stone-900">{{ stats.total_events }}</span>
      </div>
      <div class="stat-card">
        <span class="text-xs uppercase tracking-wider text-stone-400">Upcoming</span>
        <span class="font-display text-4xl text-[#b5906b]">{{ stats.upcoming_events }}</span>
      </div>
      <div class="stat-card col-span-2 lg:col-span-1">
        <span class="text-xs uppercase tracking-wider text-stone-400">Total Bookings</span>
        <span class="font-display text-4xl text-stone-900">{{ stats.total_bookings }}</span>
      </div>
    </div>

    <!-- Recent events -->
    <div class="mb-6 flex items-center justify-between">
      <h2 class="font-display text-2xl text-stone-900">Recent Events</h2>
      <!-- route('events.index') -->
      <Link href="/" class="text-sm text-[#b5906b] hover:text-[#8c6a47]">View all →</Link>
    </div>

    <div v-if="!events.length" class="card p-12 text-center text-stone-400">
      <p class="font-display text-2xl mb-2">No events yet</p>
      <p class="text-sm mb-5">Start planning your first ceremony.</p>
      <!-- route('events.create') -->
      <Link href="/" class="btn-primary">Plan an Event →</Link>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        <!-- route('events.show', event.id) -->
      <Link v-for="event in events" :key="event.id" href="/"
            class="card p-5 flex flex-col gap-3 hover:shadow-md hover:border-stone-200 transition-all duration-200 group">
        <div class="flex items-center justify-between">
          <span class="text-2xl">{{ eventTypeEmoji[event.type] ?? '✦' }}</span>
          <span class="text-xs text-stone-400">{{ formatDate(event.date) }}</span>
        </div>
        <div>
          <h3 class="font-display text-xl text-stone-900 group-hover:text-[#b5906b] transition-colors">
            {{ event.title }}
          </h3>
          <p class="text-xs text-stone-400 mt-0.5 flex items-center gap-1">
            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            </svg>
            {{ event.location }}
          </p>
        </div>
        <div class="flex items-center justify-between pt-3 border-t border-stone-50 text-sm">
          <span class="text-stone-500">{{ event.bookings }} packages</span>
          <span class="font-semibold text-[#b5906b]">{{ formatPrice(event.total_cost) }}</span>
        </div>
      </Link>

      <!-- Add new card -->
       <!-- route('events.create') -->
      <Link href="/"
            class="card p-5 border-dashed flex flex-col items-center justify-center gap-2 text-stone-400 hover:text-[#b5906b] hover:border-[#b5906b]/40 transition-all duration-200 min-h-[160px]">
        <span class="text-3xl font-light">+</span>
        <span class="text-sm">New Event</span>
      </Link>
    </div>

    <!-- Quick actions -->
    <div class="mt-10">
      <h2 class="font-display text-2xl text-stone-900 mb-4">Explore Vendors</h2>
      <div class="grid grid-cols-3 gap-4">
        <!-- route('vendors.index', { category: 'catering' }) -->
        <Link href="/"
              class="card p-4 flex items-center gap-3 hover:shadow-md hover:border-stone-200 transition-all">
          <span class="text-2xl">🍽</span>
          <span class="font-medium text-stone-700">Catering</span>
        </Link>
        <!-- route('vendors.index', { category: 'venue_decoration' }) -->
        <Link href="/"
              class="card p-4 flex items-center gap-3 hover:shadow-md hover:border-stone-200 transition-all">
          <span class="text-2xl">🌸</span>
          <span class="font-medium text-stone-700">Venue & Décor</span>
        </Link>
        <!-- route('vendors.index', { category: 'entertainment_media' }) -->
        <Link href="/"
              class="card p-4 flex items-center gap-3 hover:shadow-md hover:border-stone-200 transition-all">
          <span class="text-2xl">🎵</span>
          <span class="font-medium text-stone-700">Entertainment</span>
        </Link>
      </div>
    </div>
  </AppLayout>
</template>
