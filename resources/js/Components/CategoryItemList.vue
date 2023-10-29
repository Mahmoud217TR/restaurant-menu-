<script setup>
import { Link, useForm } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import Modal from '@/Components/Modal.vue';
import { ref } from 'vue';

const confirmingItemDeletion = ref(false);

const props = defineProps({
    items: Object,
});

const deleteForm = useForm({});

const confirmItemDeletion = () => {
    confirmingItemDeletion.value = true;
};

const deleteItem = (id) => {
    deleteForm.delete(route('item.destroy', id), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
    });
};

const closeModal = () => {
    confirmingItemDeletion.value = false;
};
</script>

<template>
    <tr v-for="item in items" class="flex justify-between items-center odd:bg-neutral-200 even:bg-neutral-100 py-4 px-20 relative overflow-hidden">
        <td>{{ item.name }}</td>
        <td class="flex min-w-[8rem] justify-evenly items-center">
            <span v-if="item.discount_price" class="text-red-500 font-bold">
                {{ item.discount_price.formatted }}
            </span>
            <span class="font-bold" :class="{ 'line-through':item.discount_price }">
                {{ item.price.formatted }}
            </span>
        </td>
        <span class="absolute bg-red-500 text-white text-base font-bold top-0 start-0 py-2 px-12 shadow-sm shadow-neutral-500 -rotate-45 -translate-x-1/3" v-if="item.discount.discount_percentage">
            -{{ item.discount.discount_percentage }}%
        </span>
        <div class="absolute font-bold top-0 end-0 py-2 w-24 rounded-s-full h-full flex justify-center items-center text-center">
            <Link class="text-blue-600 hover:text-blue-400 me-2" :href="route('item.edit', item.id)">
                <i class="fa-solid fa-pen-to-square"></i>
            </Link>

            <button @click.prevent="confirmItemDeletion" class="text-red-600 hover:text-red-400">
                <i class="fa-solid fa-trash"></i>
            </button>

            <Modal :show="confirmingItemDeletion" @close="closeModal">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900">
                        Are you sure you want to delete this item?
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        Once this item is deleted, all of its resources and data will be permanently deleted.
                    </p>

                    <div class="mt-6 flex justify-start">
                        <SecondaryButton @click="closeModal"> Cancel </SecondaryButton>

                        <DangerButton
                            class="ml-3"
                            @click="deleteItem(item.id)"
                        >
                            Delete Category
                        </DangerButton>
                    </div>
                </div>
            </Modal>
        </div>
    </tr>
</template>

