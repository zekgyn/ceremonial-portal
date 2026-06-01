<template>

    <Head title="Register" />

    <div class="min-h-screen flex">
        <!-- {/* Left — Form */} -->
        <div class="flex-1 flex flex-col justify-center px-6 py-12 lg:px-16 bg-white overflow-y-auto">
            <div class="max-w-md w-full mx-auto">

                <div class="flex items-center gap-2 mb-8">
                    <div
                        class="size-9 rounded-xl bg-linear-to-br from-rose-500 to-amber-500 flex items-center justify-center">
                        <Sparkles class="size-5 text-white" />
                    </div>
                    <span class="text-rose-900 font-bold text-[1.2rem]">CeremoniQ</span>
                </div>

                <h1 class="text-gray-900 mb-1 font-bold text-[1.75rem]">Create your account
                </h1>
                <Form class="space-y-4">

                    <!-- {/* Role Toggle */} -->
                    <div class="hidden outline">
                        <RadioGroup class="flex gap-6 justify-around  outline w-full " required>
                            <div class="rounded-md p-auto border items-center justify-items-center">
                                <Label for="local-route" class="">
                                    <!-- <Field orientation="horizontal">
                                        <FieldContent>
                                            <FieldTitle> -->
                                                <span class="text-black">dfd</span>
                                    <User class="size-4.5 text-info/75 text-black" /> I'm a Client
                                    <!-- </FieldTitle>
                                        </FieldContent> -->
                                    <RadioGroupItem class="hidde" id="local-route" value="local" />
                                    <!-- </Field>-->
                                </Label>
                            </div>

                            <Label for="transit-route" class=" rounded border">
                                <!-- <Field orientation="horizontal">
                                    <FieldContent>
                                        <FieldTitle> -->
                                <Building2 class="size-4.5 text-alert/75" />I'm a Vendor
                                <!-- </FieldTitle>
                                        <FieldDescription>
                                            Cross Border Route.
                                        </FieldDescription>
                                    </FieldContent> -->
                                <RadioGroupItem class="hidden" id="transit-route" value="transit" />
                                <!-- </Field> -->
                            </Label>
                        </RadioGroup>
                        <!-- {(["client", "vendor"] as const).map((r) => ( -->
                        <!-- <button key={r} onClick={()=> setRole(r)}
                        class={`flex flex-col items-center gap-2 p-4 rounded-2xl border-2 transition-all ${
                        role === r ? "border-rose-400 bg-rose-50" : "border-gray-200 bg-gray-50 hover:border-gray-300"
                        }`}
                        >
                        <div class={`w-10 h-10 rounded-xl flex items-center justify-center ${role===r
                            ? "bg-linear-to-br from-rose-500 to-amber-500 text-white" : "bg-gray-200 text-gray-500"
                            }`}>
                            {r === "client" ?
                            <User class="size-5" /> :
                            <Building2 class="size-5" />}
                        </div>
                        <span class={`text-sm capitalize ${role===r ? "text-rose-700" : "text-gray-600" }`} style={{
                            fontWeight: role===r ? 600 : 400 }}>
                            {r === "client" ? "I'm a Client" : "I'm a Vendor"}
                        </span>
                    </button> -->
                    </div>

                    <div class="space-y-4">
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Full name</Label>
                            <Input type="text" placeholder="Jane Doe"/>
                        </div>
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Email address</Label>
                            <Input type="email" placeholder="you@example.com"/>
                        </div>
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Password</Label>
                            <PasswordInput placeholder="Min. 6 characters" />
                        </div>
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Confirm password</Label>
                            <Input type="password" placeholder="Re-enter your password" />
                        </div>

                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Phone</Label>
                            <Input type="tel" placeholder="+255 123 456 789" />
                        </div>
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">City</Label>
                            <Input type="text" placeholder="e.g. Dar es Salaam" />
                        </div>
                    </div>
                    <!-- Vendor Input -->
                    <div v-if="false" class="flex flex-col gap-4">
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Business Name</Label>
                            <Input type="text" placeholder="Your business name" />
                        </div>
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Vendor Category</Label>
                            <select class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-900
                                    outline-none focus:border-rose-400 focus:bg-white transition-colors text-sm">
                                <option value="">Select a category</option>
                                <option v-for="c in vendorCategories" :key="c" :value="c">{{ c }}</option>
                            </select>
                        </div>
                        <div>
                            <Label class="block text-gray-700 text-sm mb-1.5">Brief Description</Label>
                            <textarea placeholder="Tell clients about your services..." rows="3"
                                class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 outline-none focus:border-rose-400 focus:bg-white transition-colors text-sm resize-none" />
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
                        <Button type="submit"
                            class="flex-1 py-3 bg-linear-to-r from-rose-500 to-amber-500 text-white rounded-xl hover:opacity-90 disabled:opacity-60 transition-all flex items-center justify-center gap-2 font-semibold">
                            <template v-if="false">
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
        <div class="hidden lg:flex flex-1 relative overflow-hidden">
            <img :src="AUTH_BG" alt="" class="absolute inset-0 w-full h-full object-cover" />
            <div class="absolute inset-0 bg-linear-to-br from-rose-950/80 via-rose-800/50 to-amber-700/30" />
            <div class="relative z-10 flex flex-col justify-center p-14 text-white">
                <h2 class="mb-6 font-bold leading-[1.4] text-[1.6rem]">
                    {{ "client" === "client" ? "Plan your perfect ceremony" : "Grow your event business" }}
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
import { Sparkles, CheckCircle, AlertCircle, User, Building2 } from 'lucide-vue-next';
// import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { RadioGroup, RadioGroupItem, } from '@/components/ui/radio-group'
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { store } from '@/routes/register';

const AUTH_BG =
    "https://images.unsplash.com/photo-1767986012138-4893f40932d5?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx3ZWRkaW5nJTIwY2VyZW1vbnklMjBlbGVnYW50JTIwdmVudWV8ZW58MXx8fHwxNzc5Mjg2MjIzfDA&ixlib=rb-4.1.0&q=80&w=1080";

const vendorCategories = ["Catering", "Venue & Decoration", "Entertainment & Media"];

const perks = {
    client: ["Free event dashboard", "Unlimited vendor browsing", "Budget & timeline tools", "Booking management"],
    vendor: ["Vendor profile listing", "Booking calendar", "Analytics dashboard", "Commission-based — no upfront cost"],
};
</script>
