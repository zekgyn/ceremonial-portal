<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'

const props = defineProps({ vendor: Object })

const form = useForm({
  business_name: props.vendor?.business_name ?? '',
  description: props.vendor?.description ?? '',
  category: props.vendor?.category ?? 'catering',
  location: props.vendor?.location ?? '',
})

const categories = [
  { value: 'catering', label: 'Catering', icon: '🍽' },
  { value: 'venue_decoration', label: 'Venue & Décor', icon: '🌸' },
  { value: 'entertainment_media', label: 'Entertainment & Media', icon: '🎵' },
]

function submit() {
  form.put(route('vendor.profile.update'))
}
</script>

<template>
  <AppLayout>
    <div class="max-w-2xl mx-auto">
      <div class="mb-8">
        <h1 class="font-display text-4xl text-stone-900 mb-1">Business Profile</h1>
        <p class="text-stone-500">How clients see your business in the marketplace.</p>
      </div>

      <div class="card p-8">
        <form @submit.prevent="submit" class="space-y-6">
          <div>
            <label class="label">Business Name</label>
            <input v-model="form.business_name" type="text" class="input" placeholder="Your business name" />
            <p v-if="form.errors.business_name" class="mt-1.5 text-xs text-red-500">{{ form.errors.business_name }}</p>
          </div>

          <div>
            <label class="label">Category</label>
            <div class="grid grid-cols-3 gap-3">
              <button v-for="cat in categories" :key="cat.value" type="button"
                      @click="form.category = cat.value"
                      class="flex flex-col items-center gap-2 py-4 px-2 rounded-xl border-2 text-sm transition-all"
                      :class="form.category === cat.value
                        ? 'border-[#b5906b] bg-[#b5906b]/5 text-[#b5906b]'
                        : 'border-stone-200 text-stone-500 hover:border-stone-300'">
                <span class="text-2xl">{{ cat.icon }}</span>
                <span class="text-xs font-medium text-center">{{ cat.label }}</span>
              </button>
            </div>
            <p v-if="form.errors.category" class="mt-1.5 text-xs text-red-500">{{ form.errors.category }}</p>
          </div>

          <div>
            <label class="label">Location</label>
            <input v-model="form.location" type="text" class="input" placeholder="e.g. Dar es Salaam" />
            <p v-if="form.errors.location" class="mt-1.5 text-xs text-red-500">{{ form.errors.location }}</p>
          </div>

          <div>
            <label class="label">About Your Business</label>
            <textarea v-model="form.description" rows="4" class="input resize-none"
                      placeholder="Describe your services, experience, and what makes you unique…" />
          </div>

          <button type="submit" class="btn-primary w-full justify-center py-3" :disabled="form.processing">
            <span v-if="form.processing">Saving…</span>
            <span v-else>Save Profile</span>
          </button>
        </form>
      </div>
    </div>
  </AppLayout>
</template>
