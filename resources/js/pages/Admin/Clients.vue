<script setup lang="ts">
// import { Link, router } from '@inertiajs/vue3'
import { Star, Eye, CheckCircle } from '@lucide/vue'
import AppLayout from '@/layouts/AppLayout.vue'
import { dashboard } from '@/routes/admin';
import { index } from '@/routes/admin/clients';
// import { verify } from '@/routes/admin/vendors';

defineProps({ clients: Object })

defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Dashboard',
                href: dashboard(),
            },
            {
                title: 'Vendors',
                href: index(),
            },
        ],
    },
});

// function toggleVerify(id: number) {
//   router.patch(verify(id))
// }

const vendorz = [
    { id: "v1", name: "The Grand Feast", category: "Catering", status: "Active", rating: 4.9, bookings: 142, revenue: 15800, joined: "Jan 2025", verified: true },
    { id: "v2", name: "Ivory Palace Events", category: "Venue & Decoration", status: "Active", rating: 4.8, bookings: 98, revenue: 22400, joined: "Mar 2025", verified: true },
    { id: "v3", name: "Pulse Entertainment", category: "Entertainment", status: "Active", rating: 4.7, bookings: 215, revenue: 12900, joined: "Feb 2025", verified: true },
    { id: "v4", name: "Timeless Frames Studio", category: "Entertainment", status: "Pending", rating: 4.95, bookings: 87, revenue: 8700, joined: "May 2026", verified: false },
    { id: "v5", name: "Saveur Catering Co.", category: "Catering", status: "Active", rating: 4.6, bookings: 63, revenue: 6800, joined: "Jun 2025", verified: true },
    { id: "v6", name: "Elysian Gardens Venue", category: "Venue & Decoration", status: "Under Review", rating: 4.7, bookings: 54, revenue: 9200, joined: "Apr 2026", verified: false },
];

</script>

<template>
  <AppLayout>
        <div class="min-h-screen bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="space-y-5">
                    <div class="flex items-center justify-between gap-4 flex-wrap">
                        <h2 class="text-gray-900">All Clients ({{ clients?.length}})</h2>
                        <div class="flex gap-2 flex-wrap">
                            <!-- {["All", "Active", "Pending", "Under Review"].map((f) => (
                            <button key={f} onClick={()=> setVendorFilter(f)}
                                class={`px-3 py-1.5 rounded-full text-sm transition-colors ${
                                vendorFilter === f ? "bg-gray-900 text-white" : "bg-white border border-gray-200 text-gray-600
                                hover:border-gray-300"
                                }`}
                                style={{ fontWeight: vendorFilter === f ? 600 : 400 }}
                                >
                                {f}
                            </button>
                            ))} -->
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
                                            RATING</th>
                                        <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                            BOOKINGS</th>
                                        <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                            REVENUE</th>
                                        <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                            ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    <!-- {filteredVendors.map((vendor) => {
                                    const currentStatus = getVendorStatus(vendor);
                                    return ( -->
                                    <tr v-for="vendor in vendorz" :key="vendor.id" class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="size-9 rounded-xl bg-linear-to-br from-rose-100 to-amber-100 flex items-center justify-center shrink-0">
                                                    <span class="text-sm">
                                                        {{vendor.category === "Catering" ? "🍽️" :
                                                         vendor.category === "Venue & Decoration" ? "🏛️" : "🎵"}}
                                                    </span>
                                                </div>
                                                <div>
                                                    <div class="flex items-center gap-1.5">
                                                        <span class="text-gray-900 text-sm font-medium" >{{vendor.name}}</span>

                                                        <CheckCircle v-if="vendor.verified" class="size-3.5 text-blue-500" />
                                                    </div>
                                                    <span class="text-gray-400 text-xs">Joined {{vendor.joined}}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-gray-600 text-sm">{{vendor.category}}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span :class="['px-2.5 py-1 rounded-full text-xs ${getStatusStyle(currentStatus)} font-semibold']">
                                                <!-- {{currentStatus}} -->
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-1">
                                                <Star class="w-3.5 h-3.5 text-amber-400 fill-amber-400" />
                                                <span class="text-gray-900 text-sm font-semibold" >{{vendor.rating}}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-gray-700 text-sm">{{vendor.bookings}}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="text-gray-900 text-sm font-semibold" >${{vendor.revenue.toLocaleString()}}</span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-1">
                                                <!-- {(currentStatus === "Pending" || currentStatus === "Under Review") && (
                                                <>
                                                    <button onClick={()=> updateStatus(vendor.id, "Active")}
                                                        class="p-1.5 text-green-600 hover:bg-green-50 rounded-lg
                                                        transition-colors"
                                                        title="Approve"
                                                        >
                                                        <CheckCircle class="w-4 h-4" />
                                                    </button>
                                                    <button onClick={()=> updateStatus(vendor.id, "Rejected")}
                                                        class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg
                                                        transition-colors"
                                                        title="Reject"
                                                        >
                                                        <XCircle class="w-4 h-4" />
                                                    </button>
                                                </>
                                                )} -->
                                                <button
                                                    class="p-1.5 text-gray-400 hover:bg-gray-100 rounded-lg transition-colors"
                                                    title="View">
                                                    <Eye class="w-4 h-4" />
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
        </div>

  </AppLayout>
</template>
