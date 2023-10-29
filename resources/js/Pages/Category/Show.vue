<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import CategoryList from '@/Components/CategoryList.vue';
import CategoryItemList from '@/Components/CategoryItemList.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Breadcrumb from '@/Components/Breadcrumb.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    category: Object,
    canHaveItems: Boolean,
    canHaveSubcategories: Boolean,
});
</script>

<template>
    <Head :title="category.name" />

    <AuthenticatedLayout>
        <template #header>
            <div class="absolute bg-red-500 text-white text-xl font-bold top-0 start-0 py-2 px-16 shadow-sm shadow-neutral-500 -rotate-45 -translate-x-1/4 translate-y-1/4" v-if="category.discount.discount_percentage">
                -{{ category.discount.discount_percentage }}%
            </div>
            <div class="flex justify-between items-center flex-wrap flex-col gap-4 md:flex-row">
                <h1 class="font-semibold text-xl text-gray-800 leading-tight text-center md:text-start">{{ category.name }}</h1>
                <div class="">
                    <Breadcrumb />
                </div>
            </div>
        </template>

        <template #crudBox>
            <Link class="me-4" :href="route('category.create')+'?parent='+category.id" v-if="!category.items">
                <PrimaryButton>
                    Add Category
                </PrimaryButton>
            </Link>
            <Link class="me-4" :href="route('item.create')+'?category='+category.id" v-if="!category.subcategories">
                <PrimaryButton>
                    Add Items
                </PrimaryButton>
            </Link>
        </template>

        <div class="py-6">
            <div class="grid grid-cols-3 mx-auto sm:px-6 lg:px-8 gap-4" v-if="category.subcategories">
                <CategoryList v-for="category in category.subcategories" :category="category" />
            </div>
            <div class="grid mx-auto sm:px-6 lg:px-8 gap-4" v-if="category.items">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-neutral-300">
                    <table class="w-full">
                        <CategoryItemList :items="category.items" />
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
