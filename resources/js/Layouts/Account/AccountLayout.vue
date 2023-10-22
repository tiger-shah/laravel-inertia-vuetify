<script setup>
import {ref} from "vue"
import {useDisplay} from "vuetify"
import App from "../AppLayout.vue"
import Header from "./HeaderLayout.vue"
import {usePage} from "@inertiajs/vue3";

defineProps({
    title: String
})

const { lgAndUp } = useDisplay()

const drawer = ref(false)
if (lgAndUp.value) {
    drawer.value = true
}

let breadcrumbsItemRoute = ''
const routeParts = route().current().split('.')
routeParts.forEach(function (item, key) {
    if (key === 0) {
        breadcrumbsItemRoute = item
    } else {
        breadcrumbsItemRoute = breadcrumbsItemRoute + '.' + item
    }

    routeParts[key] = {
        title: item.charAt(0).toUpperCase() + item.slice(1),
        disabled: (!routeParts[key + 1]),
        to: route(breadcrumbsItemRoute),
    }
});

const page = usePage()
const drawerLinks = [
    { title: 'Dashboard', route: 'account.dashboard', icon: 'fa fa-mug-hot'},
]

if (page.props.user.roles.includes("Super Admin")) {
    drawerLinks.push(
        { title: 'Users', route: 'account.users', icon: 'fa fa-users'},
    )
}

drawerLinks.push(
    { title: 'Settings', route: 'account.setting', icon: 'fa fa-gear'},
)
</script>

<template>
    <App :title="title">
        <Header :drawer="drawer" @update:drawer="newValue => drawer = newValue" />

        <v-navigation-drawer
            v-model="drawer"
            :width="lgAndUp ? 375 : 325"
            :temporary="!lgAndUp"
            border="0"
            color="transparent"
            class="pa-lg-6"
        >
            <v-sheet
                color="primary"
                class="h-100 overflow-auto"
                :rounded="lgAndUp ? 'xl' : '0'"
            >
                <v-list class="pa-4">
                    <v-list-item
                        v-for="link in drawerLinks"
                        :prepend-icon="link.icon"
                        :title="link.title"
                        :to="route(link.route)"
                        :active="route().current(link.route)"
                        class="mb-2"
                    />
                </v-list>
            </v-sheet>
        </v-navigation-drawer>

        <v-main>
            <v-sheet class="py-6 px-4 pl-md-0 pr-md-6 bg-transparent">
                <v-sheet class="bg-transparent px-2 px-md-6 pb-6 d-flex justify-space-between">
                    <div>
                        <h2>{{ title }}</h2>
                        <v-breadcrumbs :items="routeParts" class="px-0 py-2">
                            <template v-slot:divider>
                                <v-icon icon="fa fa-chevron-right" size="12"></v-icon>
                            </template>
                        </v-breadcrumbs>
                    </div>

                    <div class="d-flex align-center">
                        <slot name="options" />
                    </div>
                </v-sheet>

                <slot />
            </v-sheet>
        </v-main>
    </App>
</template>

<style scoped>
</style>
