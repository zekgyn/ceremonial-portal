<script lang="ts" setup>
import { usePage } from '@inertiajs/vue3'
import { BadgeCheck, BadgeX, Clock, DollarSign, CheckCircle, Boxes } from '@lucide/vue';
import { Badge } from '@/components/ui/badge';
// import { Link } from '@inertiajs/vue3'

const props = defineProps({
    vendor: Object,
    bookings: Array,
    stat: Object
})

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Welcome'
            }
        ],
    },
});

// function formatPrice(n) {
//   return new Intl.NumberFormat('sw-TZ', { style: 'currency', currency: 'TZS', minimumFractionDigits: 0 }).format(n)
// }

// function formatDate(d) {
//   return new Date(d).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })
// }

const stats = [
    {
        label: "Revenue",
        value: `${props.stat?.revenue.toLocaleString()}`,
        icon: DollarSign,
        color: "from-teal-400 to-emerald-400"
    },
    {
        label: "Pending Bookings",
        value: props.stat?.confirmed.toLocaleString(),
        icon: Clock,
        color: "from-amber-400 to-orange-400"
    },
    {
        label: "Confirmed Booking",
        value: props.stat?.confirmed.toLocaleString(),
        icon:  CheckCircle,
        color: "from-rose-400 to-pink-400"
    },
    {
        label: "Total Packages",
        value: `${props.stat?.total_packages}`,
        icon: Boxes,
        color: "from-purple-400 to-violet-400"
    },

]
const { user } = usePage().props.auth
</script>

<template>
    <main class="min-h-screen bg-gray-50">
        <!-- {/* Header */} -->
        <div class="bg-linear-to-r from-blue-800 to-sky-600 py-10 px-4">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
                    <div>
                        <p class="text-sky-300 text-sm mb-1">
                            Welcome back,
                            {{ user.name.split(" ")[0] || 'Client' }} ✨</p>
                        <h1 class="text-sky-100 font-bold text-[1.75rem]">
                            {{ user.vendor.business_name }}
                        </h1>
                    </div>
                    <Badge v-if="user.vendor.verified" class="flex items-center gap-2 px-5 py-2.5 bg-white/10 border border-white/30 text-white
                            rounded-xl hover:bg-white/20 transition-colors text-sm [&>svg]:size-5">
                        <BadgeCheck class="text-green-400" />
                        Verified
                    </Badge>
                    <Badge v-else class="flex items-center px-5 py-2.5 bg-white/10 border border-white/30 text-white
                            rounded-xl hover:bg-white/20 transition-colors text-sm [&>svg]:size-5">
                        <BadgeX class="size-5 text-amber-400" />
                        Pending
                    </Badge>
                </div>

                <!-- {/* Stats */} -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mt-8">

                    <div v-for="stat in stats" :key="stat.label"
                        class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/10">
                        <div
                            :class="[`size-9 rounded-xl bg-linear-to-br ${stat.color} flex items-center justify-center text-white mb-2`]">
                            <component :is="stat.icon" :size="20" />
                        </div>
                        <div class="text-white font-bold text-[1.4rem]">{{ stat.value }}
                        </div>
                        <div class="text-sky-200 text-xs mt-0.5">{{ stat.label }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            {{ user.vendor }}
        </div>
    </main>
</template>
