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
    parent: String,
});

const form = useForm({
    name: '',
    parent_id: props.parent,
});

const submit = () => {
    form.post(route('category.store'));
};
</script>

<template>
    <Head title="Add new Category" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Add new Category</h1>
        </template>

        <div class="py-6">
            <form @submit.prevent="submit" class="max-w-2xl mx-auto">
                <div>
                    <InputLabel for="name" value="Category Name" />

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
                <div>
                    <InputError class="mt-2" :message="form.errors.parent_id" />
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
