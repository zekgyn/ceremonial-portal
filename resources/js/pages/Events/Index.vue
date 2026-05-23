<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps<{ events: any }>();
const events = props.events;
</script>

<template>
    <Head title="Events" />

    <div class="space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Your events</h1>
            <Link href="/events/create" class="text-primary underline">Create event</Link>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div v-for="event in events" :key="event.id" class="p-4 border rounded">
                <h2 class="font-medium">{{ event.title }}</h2>
                <div class="text-sm text-muted-foreground">{{ event.date }} — {{ event.location }}</div>
                <div class="mt-2">
                    <Link :href="`/events/${event.id}`" class="text-primary underline">Manage</Link>
                </div>
            </div>
        </div>
    </div>
</template>
