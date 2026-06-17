<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  business_name: '',
  description: '',
  category: 'catering',
  location: '',
})

const categories = [
  { value: 'catering', label: 'Catering', icon: '🍽', desc: 'Food and beverage services' },
  { value: 'venue_decoration', label: 'Venue & Décor', icon: '🌸', desc: 'Decoration and floral design' },
  { value: 'entertainment_media', label: 'Entertainment', icon: '🎵', desc: 'Music, photo, and video' },
]

function submit() {
  form.post(route('vendor.profile.store'))
}
</script>

<template>
  <AppLayout>
    <div class="max-w-2xl mx-auto">
      <div class="text-center mb-10">
        <span class="text-[#b5906b] text-4xl">✦</span>
        <h1 class="font-display text-4xl text-stone-900 mt-3 mb-2">Set Up Your Vendor Profile</h1>
        <p class="text-stone-500">Tell clients about your business to start receiving bookings.</p>
      </div>

      <div class="card p-8">
        <form @submit.prevent="submit" class="space-y-6">
          <div>
            <label class="label">Business Name</label>
            <input v-model="form.business_name" type="text" class="input" placeholder="Your business name" />
            <p v-if="form.errors.business_name" class="mt-1.5 text-xs text-red-500">{{ form.errors.business_name }}</p>
          </div>

          <div>
            <label class="label">Service Category</label>
            <div class="space-y-3">
              <label v-for="cat in categories" :key="cat.value"
                     class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all"
                     :class="form.category === cat.value
                       ? 'border-[#b5906b] bg-[#b5906b]/5'
                       : 'border-stone-200 hover:border-stone-300'">
                <input v-model="form.category" type="radio" :value="cat.value"
                       class="text-[#b5906b] focus:ring-[#b5906b]" />
                <span class="text-2xl">{{ cat.icon }}</span>
                <div>
                  <p class="font-medium text-stone-800">{{ cat.label }}</p>
                  <p class="text-xs text-stone-400">{{ cat.desc }}</p>
                </div>
              </label>
            </div>
          </div>

          <div>
            <label class="label">Location</label>
            <input v-model="form.location" type="text" class="input" placeholder="e.g. Dar es Salaam, Tanzania" />
            <p v-if="form.errors.location" class="mt-1.5 text-xs text-red-500">{{ form.errors.location }}</p>
          </div>

          <div>
            <label class="label">About Your Business</label>
            <textarea v-model="form.description" rows="4" class="input resize-none"
                      placeholder="Describe your services, experience, and what makes you unique…" />
          </div>

          <button type="submit" class="btn-primary w-full justify-center py-3.5" :disabled="form.processing">
            <span v-if="form.processing">Creating Profile…</span>
            <span v-else>Create Profile & Go to Dashboard →</span>
          </button>
        </form>
      </div>
    </div>
  </AppLayout>
</template>
