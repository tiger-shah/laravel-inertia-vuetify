<script setup>
import AccountLayout from "../Layout.vue"

defineProps({
    title: String
})

const drawerItems = [
    { title: 'Dashboard', route: 'account.dashboard', icon: 'fa fa-mug-hot'},
    { title: 'Messages', route: 'account.messages', icon: 'fa fa-envelope'},
    { title: 'Settings', route: 'account.setting', icon: 'fa fa-gear'},
]
</script>

<template>
    <AccountLayout :title="title" :drawerItems="drawerItems">
        <template v-slot:options>
            <slot name="options" />
        </template>

        <slot />
    </AccountLayout>
</template>

<style scoped>
</style>
