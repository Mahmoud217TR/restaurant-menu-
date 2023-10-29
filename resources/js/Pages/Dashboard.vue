<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CategoryList from '@/Components/CategoryList.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DiscountInput from '@/Components/DiscountInput.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import { Head, Link } from '@inertiajs/vue3';


const props = defineProps({
    menu: Object,
});
</script>

<template>
    <Head title="My Menu" />

    <AuthenticatedLayout>
        <template #header>
            <div class="absolute bg-red-500 text-white text-xl font-bold top-0 start-0 py-2 px-16 shadow-sm shadow-neutral-500 -rotate-45 -translate-x-1/4 translate-y-1/4" v-if="menu.discount.discount_percentage">
                -{{ menu.discount.discount_percentage }}%
            </div>
            <div class="flex justify-between items-center flex-col gap-4 md:flex-row">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Menu</h2>
                <div class="">
                    <Breadcrumb />
                </div>
                <DiscountInput :discountable-id="props.menu.id" discountable-type="menu" :discount-percentage="props.menu.discount.direct_discount_percentage" :discount-id="props.menu.discount.discount_id" />
            </div>
        </template>

        <template #crudBox>
            <Link :href="route('category.create')">
                <PrimaryButton>
                    Add Category
                </PrimaryButton>
            </Link>
        </template>

        <div class="py-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 mx-auto sm:px-6 lg:px-8 gap-4">
                <CategoryList v-for="category in menu.categories" :category="category" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
