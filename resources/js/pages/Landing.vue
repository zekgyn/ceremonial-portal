<template>
    <div class="min-h-screen bg-background text-foreground">
        <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm border-b border-rose-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <Link>
                        <button  class="cursor-pointer flex items-center gap-2">
                            <div
                                class="size-8 rounded-lg bg-linear-to-br from-rose-500 to-amber-500 flex items-center justify-center">
                                <Sparkles class="size-4 text-white" />
                            </div>
                            <span class="text-rose-900 font-bold text-[1.125rem]">CeremoniQ</span>
                        </button>
                    </Link>

                    <div class="hidden md:flex items-center gap-8">
                        <Link href="/">
                            <button class="cursor-pointer text-sm transition-colors text-gray-600 hover:text-rose-600" :class="[
                                'marketplace' !== 'marketplace' && 'text-rose-600']">
                                Marketplace
                            </button>
                        </Link>
                    </div>

                    <div class="hidden md:flex items-center gap-3">
                        <Link :href="login()">
                            <Button
                                class="cursor-pointer px-4 py-2 text-sm text-rose-600 border border-rose-200 rounded-full hover:bg-rose-50 transition-colors">
                                Sign In
                            </Button>
                        </Link>
                        <Link :href="register()">
                            <Button
                                class="cursor-pointer px-4 py-2 text-sm text-white bg-linear-to-r from-rose-500 to-amber-500 rounded-full hover:opacity-90 transition-opacity">
                                Get Started
                            </Button>
                        </Link>
                    </div>

                    <button class="md:hidden p-2 text-gray-600">
                        <X v-if="false" class="size-5" />
                        <Menu v-else class="size-5" />
                    </button>
                </div>

                <div v-if="false" class="md:hidden border-t border-rose-100 py-4 space-y-3">
                    <button class="block w-full text-left px-2 py-2 text-sm text-gray-700 hover:text-rose-600">
                        Marketplace
                    </button>
                    <div class="flex gap-2 pt-2">
                        <Link :href="login()">
                            <Button
                                class="flex-1 py-2 text-sm text-rose-600 border border-rose-200 rounded-full hover:bg-rose-50">
                                Sign In
                            </Button>
                        </Link>
                        <Link :href="register()">
                            <Button
                                class="flex-1 py-2 text-sm text-white bg-linear-to-r from-rose-500 to-amber-500 rounded-full">
                                Get Started
                            </Button>
                        </Link>
                    </div>
                </div>
            </div>
        </nav>

        <div class="min-h-screen bg-white">
            <!-- {/* Hero */} -->
            <section class="relative min-h-[92vh] flex items-center overflow-hidden">
                <div class="absolute inset-0 bg-cover bg-center bg-[url('https://images.unsplash.com/photo-1769812344142-00c7f6584885')]" />
                <div class="absolute inset-0 bg-linear-to-r from-rose-950/85 via-rose-900/70 to-transparent" />
                <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16">
                    <div class="max-w-2xl">
                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-sm rounded-full border border-white/20 mb-6">
                            <Star class="size-4 text-amber-400 fill-amber-400" />
                            <span class="text-white/90 text-sm">Trusted by 18,000+ events worldwide</span>
                        </div>
                        <h1 class="text-white mb-4 font-bold text-[3.5rem] leading-[1.15]">
                            Plan Your Perfect
                            <span class="block text-transparent bg-clip-text bg-linear-to-r from-amber-300 to-rose-300">
                                Ceremony
                            </span>
                        </h1>
                        <p class="text-white/80 mb-8 leading-[1.7] text-[1.2rem]">
                            Discover, compare, and book verified vendors for weddings, graduations, corporate events,
                            and more — all in one beautiful platform.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <Button class="flex items-center gap-2 px-8 py-4 bg-linear-to-r from-rose-500 to-amber-500
                                text-white rounded-full hover:opacity-90 transition-opacity shadow-lg font-semibold">
                                Start Planning Free
                                <ArrowRight class="size-5" />
                            </Button>
                            <Button class="flex items-center gap-2 px-8 py-4 bg-white/10 backdrop-blur-sm text-white
                                border border-white/30 rounded-full hover:bg-white/20 transition-colors font-semibold">
                                Browse Vendors
                            </Button>
                        </div>

                        <!-- {/* Event type pills */} -->
                        <div class="flex flex-wrap gap-2 mt-8">

                            <Button v-for="e in eventTypes" :key="e.label" class="flex items-center gap-1.5 px-3 py-1.5 bg-white/10 backdrop-blur-sm
                                text-white/90 rounded-full border border-white/20 hover:bg-white/20 transition-colors
                                text-sm">
                                <span>{{ e.emoji }}</span>
                                {{ e.label }}
                            </Button>

                        </div>
                    </div>
                </div>
            </section>

            <!-- {/* Stats */} -->
            <section class="bg-linear-to-r from-rose-600 to-amber-500 py-12">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div v-for="s in stats" :key="s.label" class="text-center text-white">
                            <div class="text-[2rem] font-bold">{{ s.value }}</div>
                            <div class="text-white/80 text-sm mt-1">{{ s.label }}</div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- {/* Vendor Categories */} -->
            <section class="py-20 bg-gray-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-14">
                        <h2 class="text-gray-900 mb-3 text-[2.25rem] font-bold">
                            Three Vendor Categories
                        </h2>
                        <p class="text-gray-500 max-w-xl mx-auto">
                            Everything you need for a perfect ceremony, organized into logical service bundles.
                        </p>
                    </div>
                    <div class="grid md:grid-cols-3 gap-8">
                        <div v-for="cat in vendorCategories" :key="cat.title"
                            class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow cursor-pointer group">
                            <Link :href="cat.link">
                                <div class="relative h-52 overflow-hidden">
                                    <img :src="cat.image" :alt="cat.title"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" />
                                    <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent" />
                                    <div class="absolute top-4 left-4 p-2.5 rounded-xl bg-linear-to-br text-white"
                                        :class="`${cat.color}`">
                                        <component :is='cat.icon'></component>
                                    </div>
                                    <div class="absolute bottom-4 left-4 right-4">
                                        <span class="text-white/80 text-xs bg-black/30 px-2 py-1 rounded-full">{{ cat.count
                                        }}</span>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-gray-900 mb-2">{{cat.title}}</h3>
                                    <p class="text-gray-500 text-sm leading-relaxed">{{cat.description}}</p>
                                    <Link>
                                        <Button
                                            :class="`mt-4 flex items-center gap-1.5 text-sm bg-linear-to-r ${cat.color} bg-clip-text text-transparent font-semibold`">
                                            Explore
                                            <ArrowRight class="size-4 text-amber-500" />
                                        </Button>
                                    </Link>
                                </div>
                            </Link>
                        </div>

                    </div>
                </div>
            </section>

            <!-- {/* How It Works */} -->
            <section class="py-20">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="text-center mb-14">
                        <h2 class="text-gray-900 mb-3 font-bold text-[2.25rem]">
                            How CeremoniQ Works
                        </h2>
                        <p class="text-gray-500 max-w-xl mx-auto">
                            From discovery to booking, manage your entire ceremony in 4 simple steps.
                        </p>
                    </div>
                    <div class="grid md:grid-cols-4 gap-8">

                        <div v-for="(step, i) in howItWorks" :key="step.step" class="relative">
                            <div v-if="i < howItWorks.length - 1"
                                class="hidden md:block absolute top-7 left-1/2 w-full h-0.5 bg-gray-200 z-0" />
                            <div class="relative z-10 flex flex-col items-center text-center">
                                <div
                                    :class="`size-14 rounded-full ${step.color} text-white flex items-center justify-center mb-4 shadow-lg font-bold text-[1.25rem]`">
                                    {{ step.step }}
                                </div>
                                <h4 class="text-gray-900 mb-2">{{ step.title }}</h4>
                                <p class="text-gray-500 text-sm leading-relaxed">{{ step.desc }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- {/* Features */} -->
            <section class="py-20 bg-linear-to-br from-rose-950 to-rose-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <div>
                            <h2 class="text-white mb-4 font-bold text-[2.25rem]">
                                Everything You Need to Plan the Perfect Event
                            </h2>
                            <p class="text-rose-200 mb-8 leading-relaxed">
                                Our platform addresses every pain point in traditional ceremony planning —
                                from fragmented vendor discovery to manual coordination challenges.
                            </p>
                            <div class="grid grid-cols-1 gap-3">
                                <div v-for="f in features" :key="f" class="flex items-center gap-3">
                                    <CheckCircle class="size-5 text-amber-400 shrink-0" />
                                    <span class="text-rose-100 text-sm">{{f}}</span>
                                </div>
                            </div>
                            <button
                                class="mt-8 flex items-center gap-2 px-8 py-4 bg-linear-to-r from-amber-400 to-rose-400 text-white rounded-full hover:opacity-90 transition-opacity font-semibold">
                                Start Your Event Now
                                <ArrowRight class="size-5" />
                            </button>
                        </div>
                        <div class="grid grid-cols-2 gap-4">

                            <div v-for="item in featureItems" :key="item.title"
                                class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/15 transition-colors">
                                <div
                                    class="w-10 h-10 bg-linear-to-br from-amber-400 to-rose-400 rounded-xl flex items-center justify-center text-white mb-3">
                                    <component :is="item.icon" :size="6" />
                                </div>
                                <h4 class="text-white mb-1">{{ item.title }}</h4>
                                <p class="text-rose-300 text-sm">{{ item.desc }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- {/* CTA */} -->
            <section class="py-20 bg-amber-50">
                <div class="max-w-3xl mx-auto px-4 text-center">
                    <h2 class="text-gray-900 mb-4 text-[2rem] font-bold">
                        Ready to Plan Your Next Ceremony?
                    </h2>
                    <p class="text-gray-500 mb-8">
                        Join thousands of clients and vendors already using CeremoniQ to create unforgettable events.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4">
                        <Button class="px-8 py-4 bg-linear-to-r from-rose-500 to-amber-500 text-white rounded-full
                            hover:opacity-90 shadow-lg font-semibold">
                            I'm Planning an Event
                        </Button>
                        <Button
                            class="px-8 py-4 border-2 border-rose-300 text-rose-600 rounded-full hover:bg-rose-50 font-semibold">
                            I'm a Vendor
                        </Button>
                    </div>
                </div>
            </section>

            <!-- {/* Footer */} -->
            <footer class="bg-gray-900 py-12 text-gray-400">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid md:grid-cols-4 gap-8 mb-8">
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                <div
                                    class="w-7 h-7 rounded-lg bg-linear-to-br from-rose-500 to-amber-500 flex items-center justify-center">
                                    <Star class="w-3.5 h-3.5 text-white fill-white" />
                                </div>
                                <span class="text-white font-bold">CeremoniQ</span>
                            </div>
                            <p class="text-sm leading-relaxed">
                                Your all-in-one ceremony planning and vendor marketplace platform.
                            </p>
                        </div>

                        <div v-for="col in columns" :key="col.title">
                            <h4 class="text-white mb-3 text-sm font-semibold">{{ col.title }}</h4>
                            <ul class="space-y-2">
                                <li v-for="l in col.links" :key="l"><a href="#"
                                        class="text-sm hover:text-white transition-colors">{{ l }}</a>
                                </li>
                            </ul>
                        </div>
                        <div
                            class="border-t border-gray-800 pt-6 flex flex-col md:flex-row justify-between items-center gap-3">
                            <span class="text-sm">© {{ 2026 }} CeremoniQ. All rights reserved.</span>
                            <div class="flex gap-4 text-sm">
                                <a href="#" class="hover:text-white">Privacy</a>
                                <a href="#" class="hover:text-white">Terms</a>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</template>

<script setup lang="ts">
    import { Link } from '@inertiajs/vue3';
import { Calendar, Users, ChefHat, MapPin, Utensils, Building2, Music, Sparkles, Star, X, Menu, ArrowRight, CheckCircle } from 'lucide-vue-next';
import { Button } from '@/components/ui/button'
import { login, register } from '@/routes';
import vendor from '@/routes/vendor'

const featureItems = [
    { icon: Calendar, title: "Timeline Planner", desc: "Track every milestone" },
    { icon: Users, title: "Vendor Hub", desc: "All contacts in one place" },
    { icon: ChefHat, title: "Service Bundles", desc: "Pre-curated packages" },
    { icon: MapPin, title: "Location Mapping", desc: "Find nearby vendors" },
]

const columns = [
    { title: "Platform", links: ["Browse Vendors", "Plan Event", "Pricing", "Enterprise"] },
    { title: "Vendors", links: ["Join as Vendor", "Vendor Dashboard", "Partnerships", "Resources"] },
    { title: "Company", links: ["About Us", "Careers", "Blog", "Contact"] },
]
const CATERING_IMG = "https://images.unsplash.com/photo-1769638913840-2ca96d90e8a9?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxldmVudCUyMGNhdGVyaW5nJTIwZm9vZCUyMGJhbnF1ZXR8ZW58MXx8fHwxNzc5Mjg2MjIzfDA&ixlib=rb-4.1.0&q=80&w=1080";
const VENUE_IMG = "https://images.unsplash.com/photo-1767986012138-4893f40932d5?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx3ZWRkaW5nJTIwY2VyZW1vbnklMjBlbGVnYW50JTIwdmVudWV8ZW58MXx8fHwxNzc5Mjg2MjIzfDA&ixlib=rb-4.1.0&q=80&w=1080";
const ENTERTAINMENT_IMG = "https://images.unsplash.com/photo-1766650552198-e92415bc8ce7?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxESiUyMG11c2ljJTIwZW50ZXJ0YWlubWVudCUyMHBhcnR5JTIwZXZlbnR8ZW58MXx8fHwxNzc5Mjg2MjI5fDA&ixlib=rb-4.1.0&q=80&w=1080";

const eventTypes = [
    { label: "Wedding", emoji: "💍", color: "bg-rose-100 text-rose-700 border-rose-200" },
    { label: "Graduation", emoji: "🎓", color: "bg-amber-100 text-amber-700 border-amber-200" },
    { label: "Anniversary", emoji: "🥂", color: "bg-purple-100 text-purple-700 border-purple-200" },
    { label: "Corporate", emoji: "🏢", color: "bg-blue-100 text-blue-700 border-blue-200" },
    { label: "Funeral", emoji: "🕊️", color: "bg-gray-100 text-gray-700 border-gray-200" },
    { label: "Birthday", emoji: "🎂", color: "bg-pink-100 text-pink-700 border-pink-200" },
];

const stats = [
    { value: "2,400+", label: "Verified Vendors" },
    { value: "18,000+", label: "Events Planned" },
    { value: "50+", label: "Cities Covered" },
    { value: "4.9★", label: "Average Rating" },
];

const vendorCategories = [
    {
        icon: Utensils,
        title: "Catering",
        description: "Food preparation, drinks, and professional serving staff for any event size.",
        image: CATERING_IMG,
        count: "840 vendors",
        color: "from-amber-500 to-orange-500",
        link: vendor.packages.index()
    },
    {
        icon: Building2,
        title: "Venue & Decoration",
        description: "Venue booking, decoration setup, seating arrangement, and theme customization.",
        image: VENUE_IMG,
        count: "620 vendors",
        color: "from-rose-500 to-pink-500",
        link: vendor.packages.index()
    },
    {
        icon: Music,
        title: "Entertainment & Media",
        description: "MC, photographer, videographer, and DJ/music services.",
        image: ENTERTAINMENT_IMG,
        count: "980 vendors",
        color: "from-purple-500 to-indigo-500",
        link: vendor.packages.index()
    },
];

const howItWorks = [
    {
        step: "1",
        title: "Choose Your Event Type",
        desc: "Select from weddings, graduations, corporate events, and more.",
        color: "bg-rose-500",
    },
    {
        step: "2",
        title: "Browse & Compare Vendors",
        desc: "Filter by category, rating, location, and budget.",
        color: "bg-amber-500",
    },
    {
        step: "3",
        title: "Book a Bundle",
        desc: "Select vendor packages and confirm bookings in one place.",
        color: "bg-purple-500",
    },
    {
        step: "4",
        title: "Manage Your Event",
        desc: "Track your timeline, payments, and communications easily.",
        color: "bg-teal-500",
    },
];

const features = [
    "Centralized vendor discovery & comparison",
    "Real-time budget estimator",
    "Automated timeline planner",
    "Secure in-platform booking",
    "Vendor review & rating system",
    "24/7 event coordination support",
];
</script>
