<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineOptions({
    layout: {
        title: 'Log in to your account',
        description: 'Enter your email and password below to log in',
    },
});

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
</script>

<template>
    <Head title="Log in" />

    <div class="min-h-screen bg-[#faf7f2] flex">
        <!-- Left panel -->
        <div class="hidden lg:flex lg:w-1/2 bg-[#1c1814] flex-col justify-between p-12">
            <TextLink href="/" class="flex items-center gap-2">
                <span class="text-[#b5906b] text-xl">✦</span>
                <span class="font-display text-white text-2xl">Ceremony</span>
            </TextLink>
            <div>
                <p class="font-display text-5xl text-white leading-tight mb-4">
                    Welcome<br />back.
                </p>
                <p class="text-stone-400 text-sm max-w-xs">
                    Continue planning extraordinary events with your trusted vendors.
                </p>
            </div>
            <p class="text-stone-600 text-xs">© {{ new Date().getFullYear() }} Ceremony Platform</p>
        </div>

        <!-- Right panel -->
        <div class="flex-1 flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-md">
                <div class="mb-10 lg:hidden">
                    <TextLink href="/" class="flex items-center gap-2">
                        <span class="text-[#b5906b]">✦</span>
                        <span class="font-display text-xl">Ceremony</span>
                    </TextLink>
                </div>

                <h1 class="font-display text-3xl text-stone-900 mb-1">Sign in</h1>
                <p class="text-stone-500 text-sm mb-8">Enter your credentials to continue.</p>

                <!-- <form @submit.prevent="submit" class="space-y-5">
                    <div>
                        <label class="label">Email address</label>
                        <input v-model="form.email" type="email" class="input" placeholder="you@example.com"
                            autocomplete="email" />
                        <p v-if="form.errors.email" class="mt-1.5 text-xs text-red-500">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <label class="label">Password</label>
                        <input v-model="form.password" type="password" class="input" placeholder="••••••••"
                            autocomplete="current-password" />
                        <p v-if="form.errors.password" class="mt-1.5 text-xs text-red-500">{{ form.errors.password }}
                        </p>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 text-sm text-stone-600 cursor-pointer">
                            <input v-model="form.remember" type="checkbox"
                                class="rounded border-stone-300 text-[#b5906b] focus:ring-[#b5906b]" />
                            Remember me
                        </label>
                        <TextLink v-if="canResetPassword" :href="request()"
                            class="text-sm text-[#b5906b] hover:text-[#8c6a47]">
                        Forgot password?
                        </TextLink>
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center py-3" :disabled="form.processing">
                        <span v-if="form.processing">Signing in…</span>
                        <span v-else>Sign in →</span>
                    </button>
                </form> -->

                <p class="mt-6 text-sm text-stone-500 text-center">
                    Don't have an account?
                    <TextLink :href="register()" class="text-[#b5906b] hover:text-[#8c6a47] font-medium">Create one
                    </TextLink>
                </p>
            </div>
        </div>
    </div>

    <!-- <div
        v-if="status"
        class="mb-4 text-center text-sm font-medium text-green-600"
    >
        {{ status }}
    </div>

    <Form
        v-bind="store.form()"
        :reset-on-success="['password']"
        v-slot="{ errors, processing }"
        class="flex flex-col gap-6"
    >
        <div class="grid gap-6">
            <div class="grid gap-2">
                <Label for="email">Email address</Label>
                <Input
                    id="email"
                    type="email"
                    name="email"
                    required
                    autofocus
                    :tabindex="1"
                    autocomplete="email"
                    placeholder="email@example.com"
                />
                <InputError :message="errors.email" />
            </div>

            <div class="grid gap-2">
                <div class="flex items-center justify-between">
                    <Label for="password">Password</Label>
                    <TextLink
                        v-if="canResetPassword"
                        :href="request()"
                        class="text-sm"
                        :tabindex="5"
                    >
                        Forgot password?
                    </TextLink>
                </div>
                <PasswordInput
                    id="password"
                    name="password"
                    required
                    :tabindex="2"
                    autocomplete="current-password"
                    placeholder="Password"
                />
                <InputError :message="errors.password" />
            </div>

            <div class="flex items-center justify-between">
                <Label for="remember" class="flex items-center space-x-3">
                    <Checkbox id="remember" name="remember" :tabindex="3" />
                    <span>Remember me</span>
                </Label>
            </div>

            <Button
                type="submit"
                class="mt-4 w-full"
                :tabindex="4"
                :disabled="processing"
                data-test="login-button"
            >
                <Spinner v-if="processing" />
                Log in
            </Button>
        </div>

        <div
            class="text-center text-sm text-muted-foreground"
            v-if="canRegister"
        >
            Don't have an account?
            <TextLink :href="register()" :tabindex="5">Sign up</TextLink>
        </div>
    </Form> -->
</template>
