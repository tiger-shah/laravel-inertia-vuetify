<script setup>
import App from "../AppLayout.vue"

defineProps({
    title: {
        type: String,
        required: true
    },
})
</script>

<template>
    <App :title="title">
        <v-main class="d-flex justify-center align-center">
            <slot />
        </v-main>
    </App>
</template>
