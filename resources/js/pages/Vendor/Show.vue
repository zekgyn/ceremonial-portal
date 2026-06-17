<script setup lang="ts">
import { Head } from '@inertiajs/vue3';

const props = defineProps<{ vendor: any }>();
const vendor = props.vendor;
</script>

<template>
    <Head :title="vendor.business_name" />

    <div class="space-y-6">
        <h1 class="text-2xl font-semibold">{{ vendor.business_name }}</h1>
        <p class="text-sm text-muted-foreground">{{ vendor.description }}</p>

        <div class="mt-4 grid grid-cols-1 gap-4 md:grid-cols-2">
            <div v-for="pkg in vendor.packages" :key="pkg.id" class="p-4 border rounded">
                <h3 class="font-medium">{{ pkg.name }}</h3>
                <p class="text-sm text-muted-foreground">{{ pkg.description }}</p>
                <div class="mt-2">${{ Number(pkg.price).toFixed(2) }}</div>
            </div>
        </div>
    </div>
</template>
