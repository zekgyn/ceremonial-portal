<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { useForm, Link } from '@inertiajs/vue3'

const props = defineProps({ package: Object })

const form = useForm({
  name: props.package.name,
  description: props.package.description ?? '',
  price: props.package.price,
  guest_limit: props.package.guest_limit ?? '',
})

function submit() {
  form.put(route('vendor.packages.update', props.package.id))
}
</script>

<template>
  <AppLayout>
    <div class="max-w-xl mx-auto">
      <Link :href="route('vendor.packages.index')"
            class="inline-flex items-center gap-1.5 text-sm text-stone-400 hover:text-stone-600 mb-6">
        ← Back to Packages
      </Link>

      <h1 class="font-display text-4xl text-stone-900 mb-8">Edit Package</h1>

      <div class="card p-8">
        <form @submit.prevent="submit" class="space-y-5">
          <div>
            <label class="label">Package Name</label>
            <input v-model="form.name" type="text" class="input" />
            <p v-if="form.errors.name" class="mt-1.5 text-xs text-red-500">{{ form.errors.name }}</p>
          </div>

          <div>
            <label class="label">Description</label>
            <textarea v-model="form.description" rows="3" class="input resize-none" />
          </div>

          <div>
            <label class="label">Price (TZS)</label>
            <input v-model="form.price" type="number" min="0" step="0.01" class="input" />
            <p v-if="form.errors.price" class="mt-1.5 text-xs text-red-500">{{ form.errors.price }}</p>
          </div>

          <div>
            <label class="label">Guest Limit <span class="text-stone-300 normal-case">— optional</span></label>
            <input v-model="form.guest_limit" type="number" min="1" class="input" />
          </div>

          <div class="flex items-center gap-3 pt-2">
            <Link :href="route('vendor.packages.index')" class="btn-secondary flex-1 justify-center">Cancel</Link>
            <button type="submit" class="btn-primary flex-1 justify-center py-3" :disabled="form.processing">
              {{ form.processing ? 'Saving…' : 'Save Changes' }}
            </button>
          </div>
        </form>
      </div>
    </div>
  </AppLayout>
</template>
