<script lang="ts" setup>
// import { Link, router } from '@inertiajs/vue3'
import { Shield, DollarSign, CheckCircle, Users, TrendingUp } from '@lucide/vue';

const props = defineProps({
    stats: Object,
    recentVendors: Array,
})

// function formatPrice(n) {
//   return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
// }

// function toggleVerify(id) {
// //   router.patch(route('admin.vendors.verify', id))
// }

// const categoryLabels = {
//   catering: 'Catering',
//   venue_decoration: 'Venue & Décor',
//   entertainment_media: 'Entertainment',
// }

const statistics = [
    {
        label: "Total Revenue",
        value: `Tsh ${(props.stats?.revenue / 1000).toFixed(1)}k`,
        sub: "+18% this month",
        icon: DollarSign,
        color: "from-amber-500 to-orange-500"
    },
    {
        label: "Total Bookings", value: props.stats?.bookings, sub: "+12% this month", icon:
            CheckCircle, color: "from-green-500 to-emerald-500"
    },
    {
        label: "Active Vendors", value: props.stats?.vendors, sub: `${props.stats?.pending_vendors} pending`, icon:
            Users, color: "from-blue-500 to-cyan-500"
    },
    {
        label: "Avg Commission", value: "5%", sub: "Per booking", icon:
            TrendingUp, color: "from-purple-500 to-violet-500"
    },
]
</script>

<template>

    <main class="min-h-screen bg-gray-50">
        <!-- {/* Header */} -->
        <div class="bg-linear-to-r from-gray-900 to-gray-700 py-10 px-4">
            <div class="max-w-7xl mx-auto">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <Shield class="w-5 h-5 text-amber-400" />
                            <span class="text-amber-400 text-sm font-semibold">Admin Panel</span>
                        </div>
                        <h1 class="text-white font-bold text-[1.75rem]">CeremoniQ
                            Dashboard</h1>
                    </div>
                    <!-- {pendingVendors > 0 && (
                        <div
                            class="flex items-center gap-2 bg-amber-500/20 border border-amber-500/40 text-amber-300 px-4 py-2 rounded-xl">
                            <AlertTriangle class="w-4 h-4" />
                            <span class="text-sm">{pendingVendors} vendors pending review</span>
                        </div>
                        )} -->
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">

                    <div v-for="stat in statistics" :key="stat.label"
                        class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/10">
                        <div
                            :class="[
                                'size-9 rounded-xl bg-linear-to-br flex items-center justify-center text-white mb-2', stat.color]">
                            <component :is="stat.icon" :size="20" />
                        </div>
                        <div class="text-white font-bold text-[1.4rem]">{{ stat.value }}
                        </div>
                        <div class="text-gray-400 text-xs mt-0.5">{{ stat.label }}</div>
                        <div class="text-green-400 text-xs mt-1">{{ stat.sub }}</div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
