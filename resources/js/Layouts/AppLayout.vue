<script setup>
import {Head} from "@inertiajs/vue3"
import { useTheme } from 'vuetify'

defineProps({
    title: String,
})

const theme = useTheme()

const themeName = localStorage.getItem("theme");
if (themeName) {
    theme.global.name.value = themeName
} else if (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) {
    theme.global.name.value = 'dark'
    localStorage.setItem("theme", "dark")
} else {
    theme.global.name.value = 'light'
    localStorage.setItem("theme", 'light')
}
</script>

<template>
    <Head :title="title" />

    <v-app>
        <slot />
    </v-app>
</template>

<style scoped>

</style>
