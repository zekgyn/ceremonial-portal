<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import {  Eye, User } from '@lucide/vue'
import { dashboard } from '@/routes/admin';
import { index, show } from '@/routes/admin/clients';
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
                title: 'Clients',
                href: index(),
            },
        ],
    },
});

// function toggleVerify(id: number) {
//   router.patch(verify(id))
// }

</script>

<template>
    <main class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="space-y-5">
                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <h2 class="text-gray-900">All Clients ({{ clients?.total }})</h2>
                </div>
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-gray-100">
                                    <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                        Client</th>
                                    <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                        EMAIL</th>
                                    <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                        PHONE</th>
                                    <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                        CITY</th>
                                    <th class="text-left px-6 py-4 text-gray-500 text-xs font-semibold">
                                        ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <!-- {filteredVendors.map((vendor) => {
                                    const currentStatus = getVendorStatus(vendor);
                                    return ( -->
                                <tr v-for="client in clients?.data" :key="client.id"
                                    class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="size-9 rounded-xl bg-linear-to-br from-rose-100 to-amber-100 flex items-center justify-center shrink-0">
                                                <User class="size-6" />
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-1.5">
                                                    <span class="text-gray-900 text-sm font-medium">{{ client.name
                                                        }}</span>
                                                </div>
                                                <span class="text-gray-400 text-xs">Joined {{ new Date(client.created_at).toISOString().split('T')[0] }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-gray-600 text-sm">{{ client.email }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span
                                            :class="['px-2.5 py-1 rounded-full text-xs ${getStatusStyle(currentStatus)} font-semibold']">
                                            {{ client.phone }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="text-gray-900 text-sm font-semibold">{{
                                            client.city }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-1">
                                            <Link :href="show(client.id)"
                                                class="p-1.5 text-gray-400 hover:bg-gray-100 rounded-lg transition-colors"
                                                title="View">
                                                <Eye class="size-4" />
                                            </Link>
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
