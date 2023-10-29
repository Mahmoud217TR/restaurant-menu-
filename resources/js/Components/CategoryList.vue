<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';

const confirmingCategoryDeletion = ref(false);

const props = defineProps({
    category: Object,
});

const deleteForm = useForm({});

const confirmCategoryDeletion = () => {
    confirmingCategoryDeletion.value = true;
};

const deleteCategory = () => {
    deleteForm.delete(route('category.destroy', props.category.id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};

const closeModal = () => {
    confirmingCategoryDeletion.value = false;
};
</script>

<template>
    <Link :href="route('category.show', category.id)" class="bg-white overflow-hidden shadow-sm shadow-neutral-500 sm:rounded-lg p-6 flex flex-col items-center justify-center relative">
        <h2 class="p-6 text-gray-900 font-bold text-2xl text-center relative">
            {{ category.name }}
        </h2>
        <div class="absolute bg-red-500 text-white text-xl font-bold top-0 start-0 py-2 px-12 shadow-sm shadow-neutral-500 -rotate-45 -translate-x-1/3" v-if="category.discount.discount_percentage">
            -{{ category.discount.discount_percentage }}%
        </div>
        <div class="absolute bg-neutral-100 text-xl font-bold top-0 end-0 py-2 px-2 rounded-s-full shadow-sm shadow-neutral-500">
            <Link class="text-blue-600 hover:text-blue-400 me-2" :href="route('category.edit', category.id)">
                <i class="fa-solid fa-pen-to-square"></i>
            </Link>

            <button @click.prevent="confirmCategoryDeletion" class="text-red-600 hover:text-red-400">
                <i class="fa-solid fa-trash"></i>
            </button>

            <Modal :show="confirmingCategoryDeletion" @close="closeModal">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        Are you sure you want to delete this category?
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Once this category is deleted, all of its resources and data will be permanently deleted.
                    </p>

                    <div class="mt-6 flex justify-start">
                        <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                        <DangerButton
                            class="ml-3"
                            @click="deleteCategory()"
                        >
                            Delete Category
                        </DangerButton>
                    </div>
                </div>
            </Modal>
        </div>
    </Link>
</template>
