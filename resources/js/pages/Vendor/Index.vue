<script setup lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps<{ vendors: any }>();
const vendors = computed(() => props.vendors);
</script>

<template>
    <Head title="Vendors" />

    <div class="space-y-6">
        <h1 class="text-2xl font-semibold">Vendors</h1>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div v-for="vendor in vendors.data" :key="vendor.id" class="p-4 border rounded">
                <h2 class="font-medium">{{ vendor.business_name }}</h2>
                <p class="text-sm text-muted-foreground">{{ vendor.description }}</p>
                <div class="mt-2">
                    <Link :href="`/vendors/${vendor.id}`" class="text-primary underline">View</Link>
                </div>
            </div>
        </div>
    </div>
</template>
