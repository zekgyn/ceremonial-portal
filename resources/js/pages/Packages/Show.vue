<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{ package: any }>();
const pkg = props.package;
</script>

<template>
    <Head :title="pkg.name" />

    <div class="space-y-6">
        <h1 class="text-2xl font-semibold">{{ pkg.name }}</h1>
        <p class="text-sm text-muted-foreground">{{ pkg.description }}</p>
        <div class="text-lg font-medium">Price: ${{ Number(pkg.price).toFixed(2) }}</div>

        <div class="mt-4">
            <form method="post" action="/bookings">
                <input type="hidden" name="vendor_package_id" :value="pkg.id" />
                <label class="block mb-2">Select Event</label>
                <select name="event_id" class="border p-2 rounded w-full">
                    <!-- events should be populated by server-side props in a fuller implementation -->
                </select>
                <button type="submit" class="mt-3 px-4 py-2 bg-primary text-white rounded">Book</button>
            </form>
        </div>
    </div>
</template>
