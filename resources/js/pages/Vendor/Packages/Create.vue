<script setup>
import { index, update, store, create } from '@/routes/vendor/packages'
import { dashboard } from '@/routes/vendor'
import { Form, Head } from '@inertiajs/vue3'
import { Button } from '@/components/ui/button'
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import { Card, CardContent, CardFooter, CardHeader, CardTitle } from '@/components/ui/card';

const props = defineProps({
    package: { type: Object, default: null },
})
defineOptions({
    layout: {
        breadcrumbs: [
            {
                title: 'Home',
                href: dashboard(),
            },
            {
                title: 'Packages',
                href: index(),
            },
            {
                title: 'Create',
                href: create(),
            },
        ],
    },
});

const isEdit = !!props.package
</script>

<template>

    <Head title="Create Package" />

    <main class="min-h-screen">
        <div class="mb-8 flex items-start justify-between gap-4 bg-linear-to-r from-blue-800 to-sky-600 py-10 px-4">
            <div>
                <h1 class="font-display text-4xl text-sky-100 mb-1">{{ isEdit ? 'Edit Package' : 'New Package' }}</h1>
                <p class="text-sky-300">Manage your service offerings.</p>
            </div>
        </div>

        <Card class="min-w-3xl m-8 mx-6">
            <Form v-bind="isEdit ? update(package.id) : store.form()" reset-on-success v-slot="{ errors, processing }"
                class="space-y-5">
                <CardContent class="space-y-5">
                    <div class="grid gap-2">
                        <Label class="block text-gray-700 text-sm mb-1.5">Package Name</Label>
                        <Input name="name" type="text" autofocus :tabindex="1" required placeholder="e.g. Gold Banquet" />
                        <InputError :message="errors.name" />
                    </div>
                    <div>
                        <Label class="block text-gray-700 text-sm mb-1.5">Description</Label>
                        <textarea name="description" rows="5" required
                            class="w-full px-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-900 placeholder-gray-400 outline-none focus:border-rose-400 focus:bg-white transition-colors text-sm resize-none"
                            placeholder="Describe what's included in this package…" />
                        <InputError :message="errors.description" />
                    </div>
                    <div class="grid gap-2">
                        <Label class="block text-gray-700 text-sm mb-1.5">Price (TZS)</Label>
                        <Input name="price" type="number" min="0" step="0.01" placeholder="e.g. 1500000" />
                        <InputError :message="errors.price" />
                    </div>
                    <div class="grid gap-2">
                        <Label class="block text-gray-700 text-sm mb-1.5">
                            Guest Limit
                            <span class="text-stone-300 normal-case">
                                — Optional
                            </span>
                        </Label>
                        <Input name="guest_limit" type="number" min="1" placeholder="e.g. 200" />
                        <p class="mt-1 text-xs text-stone-400">Leave empty if there's no guest limit.</p>
                        <InputError :message="errors.guest_limit" />
                    </div>
                </CardContent>
                <CardFooter class="flex gap-3">
                    <Button type="submit" :disabled="processing"
                        class="w-full py-3 bg-linear-to-r from-rose-500 to-amber-500 text-white rounded-xl hover:opacity-90 disabled:opacity-60 transition-all flex items-center justify-center gap-2">
                        <template v-if="processing">
                            <Spinner class="size-4 border-2 border-white/40 border-t-white rounded-full animate-spin" />
                            Saving…
                        </template>
                        <span v-else>{{ isEdit ? 'Save Changes' : 'Create Package →' }}</span>
                    </Button>
                </CardFooter>
            </Form>
        </Card>
    </main>
</template>
