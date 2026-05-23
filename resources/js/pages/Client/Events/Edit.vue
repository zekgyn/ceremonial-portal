<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({ event: Object })

const form = useForm({
  title: props.event.title,
  type: props.event.type,
  date: props.event.date,
  location: props.event.location,
  budget: props.event.budget ?? '',
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
  form.put(route('events.update', props.event.id))
}
</script>

<template>
  <AppLayout>
    <div class="max-w-2xl mx-auto">
      <Link :href="route('events.show', event.id)" class="inline-flex items-center gap-1.5 text-sm text-stone-400 hover:text-stone-600 mb-6">
        ← Back to Event
      </Link>

      <h1 class="font-display text-4xl text-stone-900 mb-8">Edit Event</h1>

      <div class="card p-8">
        <form @submit.prevent="submit" class="space-y-6">
          <div>
            <label class="label">Event Name</label>
            <input v-model="form.title" type="text" class="input" />
            <p v-if="form.errors.title" class="mt-1.5 text-xs text-red-500">{{ form.errors.title }}</p>
          </div>

          <div>
            <label class="label">Event Type</label>
            <div class="grid grid-cols-3 gap-3">
              <button v-for="t in eventTypes" :key="t.value" type="button"
                      @click="form.type = t.value"
                      class="flex flex-col items-center gap-1.5 py-3 px-2 rounded-xl border-2 text-sm transition-all"
                      :class="form.type === t.value
                        ? 'border-[#b5906b] bg-[#b5906b]/5 text-[#b5906b]'
                        : 'border-stone-200 text-stone-500 hover:border-stone-300'">
                <span class="text-xl">{{ t.icon }}</span>
                <span class="text-xs font-medium">{{ t.label }}</span>
              </button>
            </div>
          </div>

          <div>
            <label class="label">Event Date</label>
            <input v-model="form.date" type="date" class="input" />
            <p v-if="form.errors.date" class="mt-1.5 text-xs text-red-500">{{ form.errors.date }}</p>
          </div>

          <div>
            <label class="label">Location</label>
            <input v-model="form.location" type="text" class="input" />
            <p v-if="form.errors.location" class="mt-1.5 text-xs text-red-500">{{ form.errors.location }}</p>
          </div>

          <div>
            <label class="label">Budget (TZS) <span class="text-stone-300 normal-case">— optional</span></label>
            <input v-model="form.budget" type="number" class="input" min="0" />
          </div>

          <div class="flex items-center gap-3 pt-2">
            <Link :href="route('events.show', event.id)" class="btn-secondary flex-1 justify-center">
              Cancel
            </Link>
            <button type="submit" class="btn-primary flex-1 justify-center py-3" :disabled="form.processing">
              Save Changes
            </button>
          </div>
        </form>
      </div>
    </div>
  </AppLayout>
</template>
