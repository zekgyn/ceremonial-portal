<template>

    <Head title="Log in" />
    <div class="min-h-screen flex">
        <!-- {/* Left — Form */} -->
        <div class="flex-1 flex flex-col justify-center px-6 py-12 lg:px-16 bg-white">
            <div class="max-w-md w-full mx-auto">
                <div class="flex items-center gap-2 mb-8">
                    <div
                        class="w-9 h-9 rounded-xl bg-linear-to-br from-rose-500 to-amber-500 flex items-center justify-center">
                        <Sparkles class="w-5 h-5 text-white" />
                    </div>
                    <span class="text-rose-900 font-bold text-[1.2rem]">CeremoniQ</span>
                </div>

                <h1 class="text-gray-900 mb-1 font-bold text-[1.75rem]">Welcome back</h1>
                <p class="text-gray-500 mb-8 text-sm">Sign in to continue planning unforgettable events.</p>

                <Form v-bind="store.form()" :reset-on-success="['password']" v-slot="{ errors, processing }"
                    class="space-y-4">
                    <div class="grid gap-2">
                        <Label for="email" class="block text-gray-700 text-sm mb-1.5">Email address</Label>
                        <!-- <Label for="email">Email address</Label> -->
                        <Input id="email" type="email" name="email" required autofocus :tabindex="1"
                            autocomplete="email" placeholder="you@example.com" />
                        <InputError :message="errors.email" />
                    </div>

                    <div>
                        <label class="block text-gray-700 text-sm mb-1.5">Password</label>

                        <PasswordInput id="password" name="password" required :tabindex="2"
                            autocomplete="current-password" placeholder="Password" />
                        <InputError :message="errors.password" />
                        <div class="text-right mt-1.5">
                            <TextLink v-if="canResetPassword" :href="request()" class=" text-rose-500 text-xs"
                                :tabindex="5" type="button">
                                Forgot password?
                            </TextLink>
                        </div>
                    </div>

                    <Button type="submit" :tabindex="4" :disabled="processing" data-test="login-button"
                        class="w-full py-3 bg-linear-to-r from-rose-500 to-amber-500 text-white rounded-xl hover:opacity-90 disabled:opacity-60 transition-all mt-2 flex items-center justify-center gap-2">
                        <template v-if="processing">
                            <Spinner class="size-4 border-2 border-white/40 border-t-white rounded-full animate-spin" />
                            Signing in…
                        </template>
                        <span v-else>Sign In</span>
                    </Button>
                </Form>

                <p class="text-center text-gray-500 text-sm mt-7">
                    Don't have an account?{{ " " }}
                    <TextLink :href="register()" :tabindex="5" class="text-rose-500 hover:underline font-semibold">
                        Sign up free
                    </TextLink>
                </p>
            </div>
        </div>

        <!-- {/* Right — Decorative */} -->
        <div class="hidden lg:flex flex-1 relative overflow-hidden">
            <img :src="AUTH_BG" alt="" class="absolute inset-0 w-full h-full object-cover" />
            <div class="absolute inset-0 bg-linear-to-br from-rose-950/80 via-rose-800/60 to-amber-800/40" />
            <div class="relative z-10 flex flex-col justify-end p-14 text-white">
                <blockquote class="mb-6 max-w-xs font-semibold text-[1.3rem] leading-6">
                    "CeremoniQ turned our chaotic wedding planning into a beautiful experience."
                </blockquote>
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 rounded-full bg-linear-to-br from-rose-300 to-amber-300 flex items-center justify-center text-rose-900 font-bold">
                        A</div>
                    <div>
                        <p class="text-sm font-semibold">Amara Okonkwo</p>
                        <p class="text-rose-300 text-xs">Client — Lagos, Nigeria</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import { Sparkles } from "lucide-vue-next";
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineProps<{
    status?: string;
    canResetPassword: boolean;
}>();

const AUTH_BG = "https://images.unsplash.com/photo-1769812344142-00c7f6584885?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwzfHx3ZWRkaW5nJTIwY2VyZW1vbnklMjBlbGVnYW50JTIwdmVudWV8ZW58MXx8fHwxNzc5Mjg2MjIzfDA&ixlib=rb-4.1.0&q=80&w=1080";

</script>
