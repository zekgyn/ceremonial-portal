<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import {
    SidebarGroup,
    SidebarGroupLabel,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { useCurrentUrl } from '@/composables/useCurrentUrl';
import type { NavItem } from '@/types';

defineProps<{
    items: NavItem[];
}>();

const { role } = usePage().props.auth.user

const { isCurrentUrl } = useCurrentUrl();
</script>

<template>
    <SidebarGroup class="px-2 py-0">
        <SidebarGroupLabel>Platform</SidebarGroupLabel>
        <SidebarMenu>
            <SidebarMenuItem v-for="item in items" :key="item.title">
                <SidebarMenuButton :class="[
                    role === 'admin' && 'data-[active=true]:bg-linear-to-r data-[active=true]:from-gray-900 data-[active=true]:to-gray-700 data-[active=true]:text-white',
                    role === 'vendor' && 'data-[active=true]:bg-linear-to-r data-[active=true]:from-blue-800 data-[active=true]:to-sky-600 data-[active=true]:text-white',
                    role === 'client' && 'data-[active=true]:bg-linear-to-r data-[active=true]:from-rose-800 data-[active=true]:to-rose-600 data-[active=true]:text-white'
                ]" as-child :is-active="isCurrentUrl(item.href)" :tooltip="item.title">
                    <Link :href="item.href">
                        <component :is="item.icon" />
                        <span>{{ item.title }}</span>
                    </Link>
                </SidebarMenuButton>
            </SidebarMenuItem>
        </SidebarMenu>
    </SidebarGroup>
</template>
