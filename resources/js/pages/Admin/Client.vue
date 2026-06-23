<script setup lang="ts">
// import { Link } from '@inertiajs/vue3'
// import { Eye, User } from '@lucide/vue'
import { dashboard } from '@/routes/admin';
import { index, show } from '@/routes/admin/clients';
import { computed } from 'vue';
// import { verify } from '@/routes/admin/vendors';

const props = defineProps({ user: Object })
const user = props.user

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
            {
                title: 'Client',
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
                    <h2 class="text-gray-900">{{ user?.name }}</h2>
                    <div class="flex gap-2 flex-wrap">

                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                    <div class="overflow-x-auto p-6">
                        {{ user }}
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>
