<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({
  package: Object,
  user_events: Array,
})

const form = useForm({
  event_id: '',
  vendor_package_id: props.package.id,
})

function submit() {
  form.post(route('bookings.store'))
}

function formatPrice(n) {
  return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
}

function formatDate(d) {
  return new Date(d).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })
}

const categoryMeta = {
  catering: { label: 'Catering', icon: '🍽' },
  venue_decoration: { label: 'Venue & Décor', icon: '🌸' },
  entertainment_media: { label: 'Entertainment', icon: '🎵' },
}
</script>

<template>
  <AppLayout>
    <div class="max-w-2xl mx-auto">
      <Link :href="route('vendors.show', package.vendor.id)"
            class="inline-flex items-center gap-1.5 text-sm text-stone-400 hover:text-stone-600 mb-6">
        ← Back to {{ package.vendor.business_name }}
      </Link>

      <h1 class="font-display text-4xl text-stone-900 mb-8">Add to Event</h1>

      <!-- Package summary card -->
      <div class="card p-6 mb-6">
        <div class="flex items-start gap-4">
          <div class="w-12 h-12 rounded-xl bg-stone-100 flex items-center justify-center text-2xl shrink-0">
            {{ categoryMeta[package.vendor.category]?.icon }}
          </div>
          <div class="flex-1">
            <p class="text-xs uppercase tracking-wider text-stone-400 mb-1">
              {{ categoryMeta[package.vendor.category]?.label }} · {{ package.vendor.business_name }}
            </p>
            <h2 class="font-display text-2xl text-stone-900">{{ package.name }}</h2>
            <p class="text-stone-500 text-sm mt-1.5 leading-relaxed">{{ package.description }}</p>

            <div class="flex items-center gap-4 mt-4">
              <span class="text-xl font-semibold text-[#b5906b]">{{ formatPrice(package.price) }}</span>
              <span v-if="package.guest_limit" class="text-sm text-stone-400">
                · Up to {{ package.guest_limit }} guests
              </span>
            </div>
          </div>
        </div>
      </div>

      <!-- Event selection -->
      <div class="card p-6">
        <h3 class="font-display text-xl text-stone-900 mb-4">Choose an Event</h3>

        <div v-if="!user_events.length" class="text-center py-6">
          <p class="text-stone-500 text-sm mb-4">You don't have any events yet.</p>
          <Link :href="route('events.create')" class="btn-primary">Create an Event first →</Link>
        </div>

        <form v-else @submit.prevent="submit" class="space-y-4">
          <div class="space-y-2">
            <label v-for="event in user_events" :key="event.id"
                   class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-150"
                   :class="form.event_id == event.id
                     ? 'border-[#b5906b] bg-[#b5906b]/5'
                     : 'border-stone-200 hover:border-stone-300'">
              <input v-model="form.event_id" type="radio" :value="event.id"
                     class="text-[#b5906b] focus:ring-[#b5906b]" />
              <div class="flex-1">
                <p class="font-medium text-stone-800">{{ event.title }}</p>
                <p class="text-xs text-stone-400 mt-0.5">{{ formatDate(event.date) }}</p>
              </div>
            </label>
          </div>

          <p v-if="form.errors.event_id" class="text-xs text-red-500">{{ form.errors.event_id }}</p>

          <div class="pt-2 border-t border-stone-100 flex items-center justify-between">
            <div>
              <p class="text-xs text-stone-400">Package total</p>
              <p class="text-lg font-semibold text-[#b5906b]">{{ formatPrice(package.price) }}</p>
            </div>
            <button type="submit" class="btn-primary px-8 py-3"
                    :disabled="form.processing || !form.event_id">
              <span v-if="form.processing">Booking…</span>
              <span v-else>Confirm Booking →</span>
            </button>
          </div>
        </form>
      </div>

      <p class="mt-4 text-xs text-center text-stone-400">
        This will replace any existing {{ categoryMeta[package.vendor.category]?.label?.toLowerCase() }} booking for the selected event.
      </p>
    </div>
  </AppLayout>
</template>
