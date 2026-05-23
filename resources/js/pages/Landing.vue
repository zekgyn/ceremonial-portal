<script lang="ts" setup>
import { Link } from '@inertiajs/vue3'
import {  CookingPot, Flower, Music } from 'lucide-vue-next';
import { login, register } from '@/routes';
 import { index } from '@/routes/vendors';

const features = [
    { icon: CookingPot, title: 'Catering', desc: 'Curated culinary experiences from top caterers across the region.' },
    { icon: Flower, title: 'Venue & Décor', desc: 'Transform any space into the setting of your dreams.' },
    { icon: Music, title: 'Entertainment', desc: 'Live bands, DJs, photography, and cinematic coverage.' },
]

const steps = [
    { num: '01', title: 'Create Your Event', desc: 'Set your date, location, and budget in minutes.' },
    { num: '02', title: 'Browse Vendors', desc: 'Explore verified vendors across all service categories.' },
    { num: '03', title: 'Book Everything', desc: 'Bundle all your vendors into one seamless plan.' },
    { num: '04', title: 'Celebrate', desc: 'We coordinate. You enjoy the moment.' },
]
</script>

<template>
    <div class="min-h-screen bg-[#faf7f2]">
        <!-- Nav -->
        <nav class="fixed top-0 inset-x-0 z-50 bg-[#faf7f2]/90 backdrop-blur border-b border-stone-200/60">
            <div class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="text-[#b5906b] text-lg">✦</span>
                    <span class="font-display text-xl text-stone-900">Ceremony</span>
                </div>
                <div class="flex items-center gap-3">
                    <Link :href="login()" class="btn-ghost text-stone-700">Sign in</Link>
                    <Link :href="register()" class="btn-primary">Get Started</Link>
                </div>
            </div>
        </nav>

        <!-- Hero -->
        <section class="pt-32 pb-24 px-6 max-w-6xl mx-auto">
            <div class="max-w-3xl">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 bg-[#b5906b]/10 rounded-full text-xs text-[#b5906b] font-medium tracking-wide mb-6">
                    ✦ Weddings · Funerals · Celebrations
                </div>
                <h1 class="font-display text-6xl md:text-7xl text-stone-900 leading-[1.05] mb-6">
                    Every ceremony,<br />
                    <em class="text-[#b5906b]">perfectly planned.</em>
                </h1>
                <p class="text-lg text-stone-500 max-w-xl leading-relaxed mb-10">
                    A unified platform to discover, book, and coordinate every vendor for your most important events —
                    from catering to entertainment.
                </p>
                <div class="flex items-center gap-4">
                    <Link :href="register()" class="btn-primary text-base px-7 py-3.5">
                        Plan Your Event →
                    </Link>
                    <Link :href="index()" class="btn-ghost text-base text-stone-600">
                        Explore Vendors
                    </Link>
                </div>
            </div>

            <!-- Decorative grid -->
            <div class="mt-20 grid grid-cols-3 gap-4 opacity-60">
                <div class="h-48 bg-stone-200/60 rounded-2xl" />
                <div class="h-48 bg-[#b5906b]/20 rounded-2xl mt-6" />
                <div class="h-48 bg-stone-200/40 rounded-2xl mt-3" />
            </div>
        </section>

        <!-- Features -->
        <section class="py-24 bg-[#1c1814]">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="font-display text-4xl text-white mb-3">Everything in one place</h2>
                    <p class="text-stone-400 max-w-md mx-auto">Three categories. Hundreds of verified vendors. One
                        planning platform.</p>
                </div>
                <div class="grid md:grid-cols-3 gap-6">
                    <div v-for="f in features" :key="f.title"
                        class="p-6 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/8 transition-colors">
                        <component :is="f.icon" class="text-3xl mb-4" />
                        <h3 class="font-display text-xl text-white mb-2">{{ f.title }}</h3>
                        <p class="text-stone-400 text-sm leading-relaxed">{{ f.desc }}</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How it works -->
        <section class="py-24 px-6 max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-display text-4xl text-stone-900 mb-3">How it works</h2>
                <p class="text-stone-500">Four steps from idea to celebration.</p>
            </div>
            <div class="grid md:grid-cols-4 gap-8">
                <div v-for="s in steps" :key="s.num" class="flex flex-col gap-3">
                    <span class="font-display text-5xl text-[#b5906b]/30 font-semibold">{{ s.num }}</span>
                    <h3 class="font-display text-xl text-stone-900">{{ s.title }}</h3>
                    <p class="text-sm text-stone-500 leading-relaxed">{{ s.desc }}</p>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="py-20 px-6">
            <div class="max-w-2xl mx-auto text-center card p-12">
                <span class="text-[#b5906b] text-3xl">✦</span>
                <h2 class="font-display text-4xl text-stone-900 mt-4 mb-4">Ready to begin?</h2>
                <p class="text-stone-500 mb-8">Join hundreds of clients who have planned their perfect ceremony with us.
                </p>
                <Link :href="register()" class="btn-primary text-base px-8 py-3.5">
                    Create Free Account →
                </Link>
            </div>
        </section>

        <!-- Footer -->
        <footer class="border-t border-stone-200 py-8 px-6">
            <div class="max-w-6xl mx-auto flex items-center justify-between text-sm text-stone-400">
                <div class="flex items-center gap-2">
                    <span class="text-[#b5906b]">✦</span>
                    <span class="font-display text-stone-600">Ceremony</span>
                </div>
                <span>© {{ new Date().getFullYear() }} Ceremony Platform</span>
            </div>
        </footer>
    </div>
</template>
