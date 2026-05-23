<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import PasswordInput from '@/components/PasswordInput.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { login } from '@/routes';
import { store } from '@/routes/register';

defineOptions({
    layout: {
        title: 'Create an account',
        description: 'Enter your details below to create your account',
    },
});
</script>

<template>
    <Head title="Register" />


    <div class="min-h-screen bg-[#faf7f2] flex">
        <!-- Left panel -->
        <div class="hidden lg:flex lg:w-1/2 bg-[#1c1814] flex-col justify-between p-12">
            <Link href="/" class="flex items-center gap-2">
            <span class="text-[#b5906b] text-xl">✦</span>
            <span class="font-display text-white text-2xl">Ceremony</span>
            </Link>
            <div>
                <p class="font-display text-5xl text-white leading-tight mb-4">
                    Start planning<br /><em class="text-[#b5906b]">today.</em>
                </p>
                <p class="text-stone-400 text-sm max-w-xs">
                    Join as a client to plan events, or as a vendor to showcase your services.
                </p>
            </div>
            <p class="text-stone-600 text-xs">© {{ new Date().getFullYear() }} Ceremony Platform</p>
        </div>

        <!-- Right panel -->
        <div class="flex-1 flex items-center justify-center px-6 py-12 overflow-y-auto">
            <div class="w-full max-w-md">
                <div class="mb-8 lg:hidden">
                    <Link href="/" class="flex items-center gap-2">
                    <span class="text-[#b5906b]">✦</span>
                    <span class="font-display text-xl">Ceremony</span>
                    </Link>
                </div>

                <h1 class="font-display text-3xl text-stone-900 mb-1">Create account</h1>
                <p class="text-stone-500 text-sm mb-8">Fill in your details to get started.</p>

                <!-- <form @submit.prevent="submit" class="space-y-4">

                    <div>
                        <label class="label">I am a</label>
                        <div class="grid grid-cols-2 gap-3">
                            <button type="button" @click="form.role = 'client'"
                                class="px-4 py-3 rounded-lg border-2 text-sm font-medium transition-all" :class="form.role === 'client'
                                    ? 'border-[#b5906b] bg-[#b5906b]/5 text-[#b5906b]'
                                    : 'border-stone-200 text-stone-500 hover:border-stone-300'">
                                🎉 Client
                            </button>
                            <button type="button" @click="form.role = 'vendor'"
                                class="px-4 py-3 rounded-lg border-2 text-sm font-medium transition-all" :class="form.role === 'vendor'
                                    ? 'border-[#b5906b] bg-[#b5906b]/5 text-[#b5906b]'
                                    : 'border-stone-200 text-stone-500 hover:border-stone-300'">
                                🏪 Vendor
                            </button>
                        </div>
                    </div>


                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="label">First name</label>
                            <input v-model="form.firstname" type="text" class="input" placeholder="Amina" />
                            <p v-if="form.errors.firstname" class="mt-1 text-xs text-red-500">{{ form.errors.firstname
                                }}</p>
                        </div>
                        <div>
                            <label class="label">Last name</label>
                            <input v-model="form.lastname" type="text" class="input" placeholder="Mbeki" />
                            <p v-if="form.errors.lastname" class="mt-1 text-xs text-red-500">{{ form.errors.lastname }}
                            </p>
                        </div>
                    </div>

                    <div>
                        <label class="label">Middle name <span class="text-stone-300">(optional)</span></label>
                        <input v-model="form.middlename" type="text" class="input" placeholder="Juma" />
                    </div>

                    <div>
                        <label class="label">Phone</label>
                        <input v-model="form.phone" type="tel" class="input" placeholder="+255 700 000 000" />
                        <p v-if="form.errors.phone" class="mt-1 text-xs text-red-500">{{ form.errors.phone }}</p>
                    </div>

                    <div>
                        <label class="label">Email address</label>
                        <input v-model="form.email" type="email" class="input" placeholder="you@example.com" />
                        <p v-if="form.errors.email" class="mt-1 text-xs text-red-500">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <label class="label">Password</label>
                        <input v-model="form.password" type="password" class="input" placeholder="Min 8 characters" />
                        <p v-if="form.errors.password" class="mt-1 text-xs text-red-500">{{ form.errors.password }}</p>
                    </div>

                    <div>
                        <label class="label">Confirm password</label>
                        <input v-model="form.password_confirmation" type="password" class="input"
                            placeholder="••••••••" />
                    </div>

                    <button type="submit" class="btn-primary w-full justify-center py-3 mt-2"
                        :disabled="form.processing">
                        <span v-if="form.processing">Creating account…</span>
                        <span v-else>Create Account →</span>
                    </button>
                </form> -->

                <p class="mt-6 text-sm text-stone-500 text-center">
                    Already have an account?
                    <Link :href="login()" class="text-[#b5906b] hover:text-[#8c6a47] font-medium">Sign in</Link>
                </p>
            </div>
        </div>
    </div>
</template>
