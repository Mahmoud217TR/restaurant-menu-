<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CategoryList from '@/Components/CategoryList.vue';
import CategoryItemList from '@/Components/CategoryItemList.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    category: Object,
});

const form = useForm({
    name: '',
    price: '',
    currency: '',
    category_id: props.category.id,
});

const submit = () => {
    form.post(route('item.store'));
};
</script>

<template>
    <Head :title="'Add new Item to'+props.category.name" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Add new Item to {{ props.category.name }}</h1>
        </template>

        <div class="py-6">
            <form @submit.prevent="submit" class="max-w-2xl mx-auto">
                <div class="mb-2">
                    <InputLabel for="name" value="Item Name" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autofocus
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>
                <div class="mb-2">
                    <InputLabel for="price" value="Item Price" />

                    <TextInput
                        id="price"
                        type="number"
                        step="0.01"
                        class="mt-1 block w-full"
                        v-model="form.price"
                        required
                        autofocus
                    />

                    <InputError class="mt-2" :message="form.errors.price" />
                </div>
                <div class="mb-2">
                    <InputLabel for="currency" value="Item Currency" />

                    <select
                        name="currency"
                        id="currency"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        required
                        v-model="form.currency"
                    >
                        <option>Select Currency</option>
                        <option value="USD">USD</option>
                        <option value="SYP">SYP</option>
                    </select>

                    <InputError class="mt-2" :message="form.errors.currency" />
                </div>
                <div>
                    <InputError class="mt-2" :message="form.errors.category_id" />
                </div>
                <div class="flex items-center justify-start mt-4">
                    <PrimaryButton class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Create
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
