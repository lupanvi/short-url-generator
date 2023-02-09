<template>
    <div v-if="errors.errors">
        <div
            v-for="(v, k) in errors.errors"
            :key="k"
            class="text-red-500 rounded border-red-500 border mb-4 py-2 px-4 pr-0"
        >
            <p v-for="error in v" :key="error" class="text-sm">
                {{ error }}
            </p>
        </div>
    </div>
</template>
<script setup>

const errors = defineProps(['errors'])

</script>