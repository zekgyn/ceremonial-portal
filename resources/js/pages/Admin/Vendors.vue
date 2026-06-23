<script setup lang="ts">
import { router } from '@inertiajs/vue3'
import { Eye, CheckCircle, XCircle } from '@lucide/vue'
import { dashboard } from '@/routes/admin';
import { index as vendorIndex, verify } from '@/routes/admin/vendors';
// import { verify } from '@/routes/admin/vendors';

defineProps({ vendors: { type: Object, required: true } })

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
            {
                title: 'Vendors',
                href: vendorIndex(),
            },
        ],
    },
});

function updateStatus(id: number) {
    router.patch(verify(id))
}

// const vendorz = [
//     { id: "v1", name: "The Grand Feast", category: "Catering", status: "Active", rating: 4.9, bookings: 142, revenue: 15800, joined: "Jan 2025", verified: true },
//     { id: "v2", name: "Ivory Palace Events", category: "Venue & Decoration", status: "Active", rating: 4.8, bookings: 98, revenue: 22400, joined: "Mar 2025", verified: true },
//     { id: "v3", name: "Pulse Entertainment", category: "Entertainment", status: "Active", rating: 4.7, bookings: 215, revenue: 12900, joined: "Feb 2025", verified: true },
//     { id: "v4", name: "Timeless Frames Studio", category: "Entertainment", status: "Pending", rating: 4.95, bookings: 87, revenue: 8700, joined: "May 2026", verified: false },
//     { id: "v5", name: "Saveur Catering Co.", category: "Catering", status: "Active", rating: 4.6, bookings: 63, revenue: 6800, joined: "Jun 2025", verified: true },
//     { id: "v6", name: "Elysian Gardens Venue", category: "Venue & Decoration", status: "Under Review", rating: 4.7, bookings: 54, revenue: 9200, joined: "Apr 2026", verified: false },
// ];

</script>

<template>
    <main class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="space-y-5">
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <h2 class="text-gray-900">All Vendors ({{ vendors.total }})</h2>
                    <div class="flex gap-2 flex-wrap">
                        <!-- @click="()=> setVendorFilter(f)"  vendorFilter === f -->
                        <button v-for="f in ['All', 'Active', 'Pending', 'Under Review']" :key="f"
                            :class="[
                                'px-3 py-1.5 rounded-full text-sm transition-colors',
                                false ? 'bg-gray-900 text-white font-semibold' : 'bg-white border border-gray-200 text-gray-600 hover:border-gray-300 font-normal']">
                            {{ f }}
                        </button>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-100">
                                    <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                        VENDOR</th>
                                    <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                        CATEGORY</th>
                                    <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                        STATUS</th>
                                    <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                        LOCATION</th>
                                    <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                        BOOKINGS</th>
                                    <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                        PACKAGES</th>
                                    <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                        ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <!-- {filteredVendors.map((vendor) => {
                                    const currentStatus = getVendorStatus(vendor);
                                    return ( -->
                                <tr v-for="vendor in vendors.data" :key="vendor.id"
                                    class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="size-9 rounded-xl bg-linear-to-br from-rose-100 to-amber-100 flex items-center justify-center shrink-0">
                                                <span class="text-sm">
                                                    {{ vendor.category === "catering" ? "🍽️" :
                                                        vendor.category === "venue_decoration" ? "🏛️" : "🎵" }}
                                                </span>
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-1.5">
                                                    <span class="text-gray-900 text-sm font-medium">
                                                        {{ vendor.business_name }}
                                                    </span>

                                                    <CheckCircle v-if="vendor.verified"
                                                        class="size-3.5 text-blue-500" />
                                                    <XCircle v-else class="size-3.5 text-red-500" />
                                                </div>
                                                <span class="text-gray-400 text-xs">
                                                    Joined {{ new Date(vendor.created_at).toISOString().split('T')[0] }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span v-if="vendor.category === 'venue_decoration'"
                                            class="text-gray-600 text-sm">
                                            Venue & Decoration
                                        </span>
                                        <span v-if="vendor.category === 'catering'" class="text-gray-600 text-sm">
                                            Catering
                                        </span>
                                        <span v-if="vendor.category === 'entertainment_media'"
                                            class="text-gray-600 text-sm">
                                            Entertainment
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            :class="['px-2.5 py-1 rounded-full text-xs ${getStatusStyle(currentStatus)} font-semibold']">
                                            {{ vendor.verified ? 'Verified' : 'Pending' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1">
                                            <span class="text-gray-900 text-sm font-semibold">{{ vendor.location
                                            }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-gray-900 text-sm font-semibold">{{ vendor.bookings_count
                                        }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <span class="text-gray-900 text-sm font-semibold">{{
                                            vendor.packages_count }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1">
                                            <!-- {(currentStatus === "Pending" || currentStatus === "Under Review") && (
                                                -->


                                            <button v-if="vendor.verified" @click="updateStatus(vendor.id)"
                                                class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition-colors"
                                                title="Reject">
                                                <XCircle class="size-4" />
                                            </button>
                                            <button v-else @click="() => updateStatus(vendor.id)"
                                                class="p-1.5 text-green-600 hover:bg-green-50 rounded-lg transition-colors"
                                                title="Approve">
                                                <CheckCircle class="size-4" />
                                            </button>

                                            <button
                                                class="p-1.5 text-gray-400 hover:bg-gray-100 rounded-lg transition-colors"
                                                title="View">
                                                <Eye class="size-4" />
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
