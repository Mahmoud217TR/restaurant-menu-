<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CategoryList from '@/Components/CategoryList.vue';
import CategoryItemList from '@/Components/CategoryItemList.vue';
import DiscountInput from '@/Components/DiscountInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    category: Object,
});

const form = useForm({
    name: props.category.name,
});

const submit = () => {
    form.put(route('category.update', props.category.id));
};
</script>

<template>
    <Head :title="'Edit '+props.category.name" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Edit {{ props.category.name }}</h1>
        </template>

        <div class="py-6">
            <form @submit.prevent="submit" class="max-w-2xl mx-auto">
                <div class="mb-2">
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
                    <DiscountInput :discountable-id="props.category.id" discountable-type="category" :discount-percentage="props.category.discount.direct_discount_percentage" :discount-id="props.category.discount.discount_id" />
                </div>
                <div>
                    <InputError class="mt-2" :message="form.errors.parent_id" />
                </div>
                <div class="flex items-center justify-start mt-4">
                    <PrimaryButton class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
