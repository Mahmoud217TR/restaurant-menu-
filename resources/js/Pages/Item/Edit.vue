<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CategoryItemList from '@/Components/CategoryItemList.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DiscountInput from '@/Components/DiscountInput.vue';
import { Head, useForm, Link } from '@inertiajs/vue3';

const props = defineProps({
    item: Object,
});

const form = useForm({
    name: props.item.name,
    price: props.item.price.amount,
    currency: props.item.price.currency,
});

const submit = () => {
    form.put(route('item.update', props.item.id));
};
</script>

<template>
    <Head :title="'Edit '+props.item.name" />

    <AuthenticatedLayout>
        <template #header>
            <h1 class="font-semibold text-xl text-gray-800 leading-tight">Edit {{ props.item.name }}</h1>
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
                    <DiscountInput :discountable-id="props.item.id" discountable-type="item" :discount-percentage="props.item.discount.direct_discount_percentage" :discount-id="props.item.discount.discount_id" />
                </div>
                <div class="flex items-center justify-start mt-4">
                    <Link class="me-2" :href="route('category.show', props.item.category_id)">
                        <SecondaryButton>
                                Cancel
                        </SecondaryButton>
                    </Link>
                    <PrimaryButton class="" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        Update
                    </PrimaryButton>
                </div>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
