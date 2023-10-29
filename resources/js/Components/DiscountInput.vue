<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    discountableId: Number,
    discountableType: String,
    discountPercentage: Number,
    discountId: Number,
});

const form = useForm({
    discountable_id: props.discountableId,
    discountable_type: props.discountableType,
    percentage: props.discountPercentage,
});

const removeForm = useForm({
    discount_id: props.discountId,
});

const submit = () => {
    form.put(route('discount.put'));
};

const remove = () => {
    if (props.discountId) {
        form.delete(route('discount.destroy', props.discountId), {
            onFinish: function() {
                form.percentage = null;
                props.discountId = null;
                props.discountPercentage = null;
            },
        });
    }
};
</script>

<template>
    <form @submit.prevent="submit">
        <div :class="{'flex items-center justify-evenly':discountableType=='menu'}">
            <InputLabel class="me-2" for="percentage" value="Discount" />
            <div class="flex justify-center items-center">
                <TextInput
                    id="percentage"
                    type="number"
                    min="0"
                    max="100"
                    step="1"
                    class="mt-1 block w-full me-4"
                    v-model="form.percentage"
                    required
                />
                <button class="bg-green-600 text-white hover:bg-green-400 py-1 px-2 rounded-md me-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    <i class="fa-solid fa-floppy-disk"></i>
                </button>
                <button class="bg-red-600 text-white hover:bg-red-400 py-1 px-2 rounded-md me-2" :class="{ 'opacity-25': form.processing }" :disabled="form.processing" v-if="props.discountId" @click.prevent="remove">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </div>

            <InputError class="mt-2" :message="form.errors.discountable_id" />
            <InputError class="mt-2" :message="form.errors.discountable_type" />
            <InputError class="mt-2" :message="form.errors.percentage" />
        </div>
    </form>
</template>
