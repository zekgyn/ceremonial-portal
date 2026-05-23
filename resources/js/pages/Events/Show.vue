<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

const props = defineProps<{ event: any }>();
const event = props.event;
</script>

<template>
    <Head :title="event.title" />

    <div class="space-y-6">
        <h1 class="text-2xl font-semibold">{{ event.title }}</h1>
        <div class="text-sm text-muted-foreground">{{ event.date }} — {{ event.location }}</div>

        <div class="mt-4">
            <h2 class="font-medium">Bookings</h2>
            <div v-if="event.bookings.length === 0" class="text-sm text-muted-foreground">No bookings yet.</div>
            <div v-else class="space-y-2">
                <div v-for="booking in event.bookings" :key="booking.id" class="p-3 border rounded">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="font-medium">{{ booking.vendor_package.name }}</div>
                            <div class="text-sm text-muted-foreground">{{ booking.vendor_package.vendor.business_name }}</div>
                        </div>
                        <div class="font-medium">${{ Number(booking.total_price).toFixed(2) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
