<script setup>
import AppLayout from '@/layouts/AppLayout.vue'
import { create, destroy, edit, index } from '@/routes/vendor/packages'
import { Link, router } from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import { DollarSign, CheckCircle, Users, Plus, Calendar, MapPin, Clock } from '@lucide/vue';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';
import { dashboard } from '@/routes/vendor';

defineProps({ packages: Array })
defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Home',
                href: dashboard(),
            },
            {
                title: 'Packages',
                href: index(),
            },
        ],
    },
});

function formatPrice(n) {
    return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
}

function deletePackage(id) {
    if (confirm('Delete this package?')) {
        router.delete(destroy(id))
    }
}

</script>

<template>
        <div class="mb-8 flex items-start justify-between gap-4 bg-linear-to-r from-blue-800 to-sky-600 py-10 px-4">
            <div>
                <h1 class="font-display text-4xl text-sky-100 mb-1">My Packages</h1>
                <p class="text-sky-300">Manage your service offerings.</p>
            </div>
            <Link :href="create()">
                <button as="a" class="flex items-center gap-2 px-5 py-2.5 bg-white/10 border border-white/30 text-white rounded-xl
                    hover:bg-white/20 transition-colors text-sm">
                    <Plus class="size-4" />
                    New Package
                </button>
            </Link>
        </div>

        <div v-if="!packages.length" class="card p-16 text-center text-sky-400">
            <p class="font-display text-2xl mb-2">No packages yet</p>
            <p class="text-sm mb-6">Create your first service package to appear in the marketplace.</p>
            <Link :href="create()" class="btn-primary">Create Package →</Link>
        </div>

        <div v-else class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5 px-4">
            <Card v-for="pkg in packages" :key="pkg.id" class="p-5 flex flex-col gap-3 border-blue-200 hover:border-blue-500">
                <div class="flex items-start justify-between gap-2">
                    <h3 class="font-display text-lg text-stone-900">{{ pkg.name }}</h3>
                    <span class="text-blue-600 font-semibold text-sm whitespace-nowrap shrink-0">
                        {{ formatPrice(pkg.price) }}
                    </span>
                </div>

                <p class="text-sm text-stone-500 leading-relaxed flex-1">{{ pkg.description }}</p>

                <div v-if="pkg.guest_limit" class="text-xs text-stone-400">
                    Up to {{ pkg.guest_limit }} guests
                </div>

                <div class="flex items-center gap-2 pt-2 border-t border-stone-50">
                    <Link :href="edit(pkg.id)" class="text-sky-300 hover:text-sky-500 text-xs flex-1 justify-center">
                        Edit
                    </Link>
                    <button @click="deletePackage(pkg.id)"
                        class="p-2 text-rose-300 hover:text-red-400 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </button>
                </div>
            </Card>

            <Link :href="create()"
                class="border rounded-lg p-5 border-dashed flex flex-col items-center justify-center gap-2 text-sky-400 hover:text-blue-600 hover:border-sky-400/40 transition-all min-h-40">
                <span class="text-3xl font-light">+</span>
                <span class="text-sm">Add Package</span>
            </Link>
        </div>
</template>
