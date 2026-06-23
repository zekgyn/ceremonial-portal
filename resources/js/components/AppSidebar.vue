<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { Building2, Users2, LayoutGrid, List, Balloon } from '@lucide/vue';
import AppLogo from '@/components/AppLogo.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard as adminDashboard } from '@/routes/admin';
import { index as adminBookings } from '@/routes/admin/bookings';
import { index as adminClients } from '@/routes/admin/clients';
import { index as adminEvents } from '@/routes/admin/events';
import { index as adminVendors } from '@/routes/admin/vendors';
import { dashboard as clientDashboard } from '@/routes/client';
import { index as clientBookings } from '@/routes/client/bookings';
import { index as clientVendors } from '@/routes/client/vendors';
import { dashboard as vendorDashboard } from '@/routes/vendor';
import { index as vendorBookings } from '@/routes/vendor/bookings';
import { index as vendorPackages } from '@/routes/vendor/packages';
import type { NavItem } from '@/types';
// import { index as events } from '@/routes/client/events'

const adminNavItems: NavItem[] = [
    {
        title: 'Overview',
        href: adminDashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Vendors',
        href: adminVendors(),
        icon: Building2,
    },
    {
        title: 'Clients',
        href: adminClients(),
        icon: Users2,
    },
    {
        title: 'Bookings',
        href: adminBookings(),
        icon: List,
    },
    {
        title: 'Events',
        href: adminEvents(),
        icon: Balloon,
    }
];
const vendorNavItems: NavItem[] = [
    {
        title: 'Overview',
        href: vendorDashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Packages',
        href: vendorPackages(),
        icon: Building2,
    },
    {
        title: 'Bookings',
        href: vendorBookings(),
        icon: List,
    }
];
const clientNavItems: NavItem[] = [
    {
        title: 'Overview',
        href: clientDashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Vendors',
        href: clientVendors(),
        icon: Building2,
    },
    {
        title: 'Bookings',
        href: clientBookings(),
        icon: Balloon,
    }
];

const { user } = usePage().props.auth
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link href="/">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain v-if="user.role === 'admin'" :items="adminNavItems" />
            <NavMain v-if="user.role === 'vendor'" :items="vendorNavItems" />
            <NavMain v-if="user.role === 'client'" :items="clientNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
