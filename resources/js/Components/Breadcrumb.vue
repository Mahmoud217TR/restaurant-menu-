<script>
import { usePage } from '@inertiajs/vue3'
import { computed } from 'vue'

export default {
    setup() {
        const insertBetween = (items, insertion) => {
            return items.flatMap(
                (value, index, array) =>
                    array.length - 1 !== index
                        ? [value, insertion]
                        : value,
            )
        }

        const breadcrumbs = computed(() => insertBetween(usePage().props.breadcrumbs || [], '/'))

        return {
            breadcrumbs,
        }
    },
}
</script>

<template>
    <nav v-if="breadcrumbs">
        <ol class="flex gap-1">
            <li v-for="page in breadcrumbs">
                <div>
                    <span v-if="page ==='/'">/</span>
                    <a
                        v-else
                        :href="page.url"
                        :class="{ 'border-b border-blue-400': page.current }"
                    >{{ page.title }}</a>
                </div>
            </li>
        </ol>
    </nav>
</template>
