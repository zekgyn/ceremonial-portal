<template>

    <Head title="Register" />

    <div class="min-h-screen flex">
        <!-- {/* Left — Form */} -->
        <div class="flex-1 flex flex-col justify-center px-6 py-12 lg:px-16 bg-white">
            <div class="max-w-md w-full mx-auto">

                <div class="flex items-center gap-2 mb-8">
                    <div
                        class="size-9 rounded-xl bg-linear-to-br from-rose-500 to-amber-500 flex items-center justify-center">
                        <Sparkles class="size-5 text-white" />
                    </div>
                    <span class="text-rose-900 font-bold text-[1.2rem]">CeremoniQ</span>
                </div>

                <h1 class="text-gray-900 mb-1 font-bold text-[1.75rem]">
                    Create your account
                </h1>

                <Form class="space-y-4" v-bind="store.form()" :reset-on-success="['password', 'password_confirmation']"
                    v-slot="{ errors, processing }">

                    <!-- {/* Role Toggle */} -->
                    <RadioGroup name="role" :default-value="usertype"
                        @update:model-value="(v) => { usertype = v as string }">
                        <div class="flex gap-4 items-center justify-center mt-2">
                            <label for="r1"
                                class="flex flex-col items-center gap-2 p-4 rounded-2xl border-2 transition-all w-full"
                                :class="[
                                    'border-gray-200 bg-gray-50 hover:border-gray-300',
                                    usertype === 'client' && 'border-rose-400 bg-rose-50'
                                ]">
                                <RadioGroupItem id="r1" value="client" class="hidden" />
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center" :class="[
                                    'bg-gray-200 text-gray-500',
                                    usertype === 'client' && 'bg-linear-to-br from-rose-500 to-amber-500 text-white'
                                ]">
                                    <User class="size-5" />
                                </div>
                                <span class="text-sm capitalize" :class="[
                                    'text-gray-600 font-normal',
                                    usertype === 'client' && 'text-rose-700 font-semibold'
                                ]">
                                    I'm a Client
                                </span>
                            </label>
                            <label for="r2"
                                class="flex flex-col items-center gap-2 p-4 rounded-2xl border-2 transition-all w-full"
                                :class="[
                                    'border-gray-200 bg-gray-50 hover:border-gray-300',
                                    usertype === 'vendor' && 'border-rose-400 bg-rose-50'
                                ]">
                                <RadioGroupItem id="r2" value="vendor" class="hidden" />
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center" :class="[
                                    'bg-gray-200 text-gray-500',
                                    usertype === 'vendor' && 'bg-linear-to-br from-rose-500 to-amber-500 text-white'
                                ]">
                                    <Building2 class="size-5" />
                                </div>
                                <span class="text-sm capitalize" :class="[
                                    'text-gray-600 font-normal',
                                    usertype === 'vendor' && 'text-rose-700 font-semibold'
                                ]">
                                    I'm a Vendor
                                </span>
                            </label>
                        </div>
                        <InputError :message="errors.role" />
                    </RadioGroup>

                    <div class="space-y-4">
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Full name</Label>
                            <Input id="name" type="text" autofocus :tabindex="1" required autocomplete="name"
                                name="name" placeholder="Full name" />
                            <InputError :message="errors.name" />
                        </div>
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Email address</Label>
                            <Input id="email" type="email" required :tabindex="2" autocomplete="email" name="email"
                                placeholder="you@example.com" />
                            <InputError :message="errors.email" />
                        </div>
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Password</Label>
                            <PasswordInput id="password" required :tabindex="3" autocomplete="new-password"
                                name="password" placeholder="Min. 8 characters" />
                            <InputError :message="errors.password" />
                        </div>
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Confirm password</Label>
                            <PasswordInput id="password_confirmation" required :tabindex="4" autocomplete="new-password"
                                name="password_confirmation" placeholder="Re-enter your password" />
                            <InputError :message="errors.password_confirmation" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Phone</Label>
                            <Input name="phone" type="tel" placeholder="+255 123 456 789" />
                        </div>
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">City</Label>
                            <Input name="city" type="text" placeholder="e.g. Dar es Salaam" />
                        </div>
                    </div>

                    <!-- Vendor Input -->
                    <div v-if="usertype === 'vendor'" class="flex flex-col gap-4">
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Business Name</Label>
                            <Input type="text" name="business_name" placeholder="Your business name" />
                        </div>
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Vendor Category</Label>
                            <select name="category" class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-900
                                    outline-none focus:border-rose-400 focus:bg-white transition-colors text-sm">
                                <option value="">Select a category</option>
                                <option v-for="c in vendorCategories" :key="c.values" :value="c.values">{{ c.label }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Brief Description</Label>
                            <textarea name="description" placeholder="Tell clients about your services..." rows="3"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 outline-none focus:border-rose-400 focus:bg-white transition-colors text-sm resize-none" />
                            <InputError :message="errors.description" />
                        </div>
                    </div>
                    <!-- Vendor Input End -->

                    <div class="flex items-start gap-2 mt-1">
                        <input type="checkbox" id="terms" class="mt-0.5 accent-rose-500" required />
                        <label for="terms" class="text-gray-500 text-xs leading-relaxed">
                            By creating an account you agree to our{{ " " }}
                            <span class="text-rose-500">Terms of Service</span> and{{ " " }}
                            <span class="text-rose-500">Privacy Policy</span>.
                        </label>
                    </div>

                    <div class="flex gap-3">
                        <Button type="submit" :disabled="processing"
                            class="flex-1 py-3 bg-linear-to-r from-rose-500 to-amber-500 text-white rounded-xl hover:opacity-90 disabled:opacity-60 transition-all flex items-center justify-center gap-2 font-semibold">
                            <template v-if="processing">
                                <Spinner
                                    class="size-4 border-2 border-white/40 border-t-white rounded-full animate-spin" />
                                Creating…
                            </template>
                            <span v-else>Create Account</span>
                        </Button>
                    </div>
                </Form>

                <p class="text-center text-gray-500 text-sm mt-6">
                    Already have an account? {{ " " }}
                    <TextLink :href="login()" class="text-rose-500 hover:underline font-semibold">
                        Sign in
                    </TextLink>
                </p>
            </div>
        </div>

        <!-- {/* Right — Decorative */} -->
        <div class="hidden lg:flex flex-1 relative lg:overflow-hidden">
            <img :src="AUTH_BG" alt="" class="absolute inset-0 w-full h-full object-cover" />
            <div class="absolute inset-0 bg-linear-to-br from-rose-950/80 via-rose-800/50 to-amber-700/30" />
            <div class="relative z-10 flex flex-col justify-center p-14 text-white">
                <h2 class="mb-6 font-bold leading-[1.4] text-[1.6rem]">
                    {{ usertype === "client" ? "Plan your perfect ceremony" : "Grow your event business" }}
                </h2>
                <ul class="space-y-3">
                    <!-- perks[role].map((perk)-->
                    <li v-for="(perk, index) in perks['client']" :key="index" class="flex items-center gap-3 text-sm">
                        <CheckCircle class="size-5 text-amber-300 shrink-0" />
                        <span class="text-rose-100">{{ perk }}</span>
                    </li>
                </ul>
                <div class="mt-10 p-4 bg-white/10 backdrop-blur-sm rounded-2xl border border-white/20">
                    <p class="text-rose-200 text-xs mb-1">Trusted by</p>
                    <p class="text-white text-2xl font-bold">18,000+ events</p>
                    <p class="text-rose-300 text-xs mt-0.5">across 50+ cities worldwide</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { Sparkles, CheckCircle, User, Building2 } from '@lucide/vue';
import { ref } from 'vue';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { RadioGroup, RadioGroupItem, } from '@/components/ui/radio-group'
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { store } from '@/routes/register';

const usertype = ref<string>('client')

const AUTH_BG =
    "https://images.unsplash.com/photo-1767986012138-4893f40932d5?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx3ZWRkaW5nJTIwY2VyZW1vbnklMjBlbGVnYW50JTIwdmVudWV8ZW58MXx8fHwxNzc5Mjg2MjIzfDA&ixlib=rb-4.1.0&q=80&w=1080";

const vendorCategories = [
    { label: "Catering", values: "catering" },
    { label: "Venue & Decoration", values: "venue_decoration" },
    { label: "Entertainment & Media", values: "entertainment_media" }
];

const perks = {
    client: ["Free event dashboard", "Unlimited vendor browsing", "Budget & timeline tools", "Booking management"],
    vendor: ["Vendor profile listing", "Booking calendar", "Analytics dashboard", "Commission-based — no upfront cost"],
};
</script>
