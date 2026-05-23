<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { Link, router } from '@inertiajs/vue3'

defineProps({ packages: Array })

function formatPrice(n) {
  return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
}

function deletePackage(id) {
  if (confirm('Delete this package?')) {
    router.delete(route('vendor.packages.destroy', id))
  }
}
</script>

<template>
  <AppLayout>
    <div class="mb-8 flex items-start justify-between gap-4">
      <div>
        <h1 class="font-display text-4xl text-stone-900 mb-1">My Packages</h1>
        <p class="text-stone-500">Manage your service offerings.</p>
      </div>
      <Link :href="route('vendor.packages.create')" class="btn-primary shrink-0">+ New Package</Link>
    </div>

    <div v-if="!packages.length" class="card p-16 text-center text-stone-400">
      <p class="font-display text-2xl mb-2">No packages yet</p>
      <p class="text-sm mb-6">Create your first service package to appear in the marketplace.</p>
      <Link :href="route('vendor.packages.create')" class="btn-primary">Create Package →</Link>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
      <div v-for="pkg in packages" :key="pkg.id" class="card p-5 flex flex-col gap-3">
        <div class="flex items-start justify-between gap-2">
          <h3 class="font-display text-lg text-stone-900">{{ pkg.name }}</h3>
          <span class="text-[#b5906b] font-semibold text-sm whitespace-nowrap shrink-0">
            {{ formatPrice(pkg.price) }}
          </span>
        </div>

        <p class="text-sm text-stone-500 leading-relaxed flex-1">{{ pkg.description }}</p>

        <div v-if="pkg.guest_limit" class="text-xs text-stone-400">
          Up to {{ pkg.guest_limit }} guests
        </div>

        <div class="flex items-center gap-2 pt-2 border-t border-stone-50">
          <Link :href="route('vendor.packages.edit', pkg.id)" class="btn-secondary text-xs flex-1 justify-center">
            Edit
          </Link>
          <button @click="deletePackage(pkg.id)"
                  class="p-2 text-stone-300 hover:text-red-400 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
          </button>
        </div>
      </div>

      <Link :href="route('vendor.packages.create')"
            class="card p-5 border-dashed flex flex-col items-center justify-center gap-2 text-stone-400 hover:text-[#b5906b] hover:border-[#b5906b]/40 transition-all min-h-[160px]">
        <span class="text-3xl font-light">+</span>
        <span class="text-sm">Add Package</span>
      </Link>
    </div>
  </AppLayout>
</template>
