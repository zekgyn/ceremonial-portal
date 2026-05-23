<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

const props = defineProps<{ bookings: any }>();
const bookings = props.bookings;
</script>

<template>
    <Head title="Bookings" />

    <div class="space-y-6">
        <h1 class="text-2xl font-semibold">Bookings</h1>

        <div class="space-y-2">
            <div v-for="booking in bookings" :key="booking.id" class="p-3 border rounded">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="font-medium">{{ booking.vendor_package.name }}</div>
                        <div class="text-sm text-muted-foreground">{{ booking.vendor_package.vendor.business_name }}</div>
                    </div>
                    <div class="font-medium">{{ booking.status }}</div>
                </div>
            </div>
        </div>
    </div>
</template>
