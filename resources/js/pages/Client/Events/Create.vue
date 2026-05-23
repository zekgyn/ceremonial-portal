<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import EventStepper from '@/Components/EventStepper.vue'
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  title: '',
  type: 'wedding',
  date: '',
  location: '',
  budget: '',
})

const eventTypes = [
  { value: 'wedding', label: 'Wedding', icon: '💍' },
  { value: 'funeral', label: 'Funeral', icon: '🕊' },
  { value: 'birthday', label: 'Birthday', icon: '🎂' },
  { value: 'corporate', label: 'Corporate', icon: '💼' },
  { value: 'graduation', label: 'Graduation', icon: '🎓' },
  { value: 'other', label: 'Other', icon: '✦' },
]

function submit() {
  form.post(route('events.store'))
}
</script>

<template>
  <AppLayout>
    <div class="max-w-2xl mx-auto">
      <div class="mb-8">
        <h1 class="font-display text-4xl text-stone-900 mb-1">Create Event</h1>
        <p class="text-stone-500">Step 1 of 5 — Tell us about your event.</p>
      </div>

      <div class="mb-10">
        <EventStepper :current-step="0" />
      </div>

      <div class="card p-8">
        <form @submit.prevent="submit" class="space-y-6">
          <!-- Title -->
          <div>
            <label class="label">Event Name</label>
            <input v-model="form.title" type="text" class="input"
                   placeholder="e.g. Amina & Tariq Wedding" />
            <p v-if="form.errors.title" class="mt-1.5 text-xs text-red-500">{{ form.errors.title }}</p>
          </div>

          <!-- Type -->
          <div>
            <label class="label">Event Type</label>
            <div class="grid grid-cols-3 gap-3">
              <button v-for="t in eventTypes" :key="t.value" type="button"
                      @click="form.type = t.value"
                      class="flex flex-col items-center gap-1.5 py-3 px-2 rounded-xl border-2 text-sm transition-all duration-150"
                      :class="form.type === t.value
                        ? 'border-[#b5906b] bg-[#b5906b]/5 text-[#b5906b]'
                        : 'border-stone-200 text-stone-500 hover:border-stone-300'">
                <span class="text-xl">{{ t.icon }}</span>
                <span class="text-xs font-medium">{{ t.label }}</span>
              </button>
            </div>
            <p v-if="form.errors.type" class="mt-1.5 text-xs text-red-500">{{ form.errors.type }}</p>
          </div>

          <!-- Date -->
          <div>
            <label class="label">Event Date</label>
            <input v-model="form.date" type="date" class="input" />
            <p v-if="form.errors.date" class="mt-1.5 text-xs text-red-500">{{ form.errors.date }}</p>
          </div>

          <!-- Location -->
          <div>
            <label class="label">Location</label>
            <input v-model="form.location" type="text" class="input"
                   placeholder="e.g. Dar es Salaam, Tanzania" />
            <p v-if="form.errors.location" class="mt-1.5 text-xs text-red-500">{{ form.errors.location }}</p>
          </div>

          <!-- Budget -->
          <div>
            <label class="label">Budget (TZS) <span class="text-stone-300 normal-case">— optional</span></label>
            <input v-model="form.budget" type="number" class="input"
                   placeholder="e.g. 5000000" min="0" />
            <p v-if="form.errors.budget" class="mt-1.5 text-xs text-red-500">{{ form.errors.budget }}</p>
          </div>

          <div class="flex items-center gap-3 pt-2">
            <button type="submit" class="btn-primary flex-1 justify-center py-3" :disabled="form.processing">
              <span v-if="form.processing">Creating…</span>
              <span v-else>Create Event & Continue →</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  </AppLayout>
</template>
