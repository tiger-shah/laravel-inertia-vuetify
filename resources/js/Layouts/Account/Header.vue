<script setup>

import {usePage} from "@inertiajs/vue3";

defineProps({
    title: String,
    drawer: Boolean
})

defineEmits(['update:drawer'])

import { useTheme } from 'vuetify'

const theme = useTheme()

function toggleTheme () {
    theme.global.name.value = theme.global.current.value.dark ? 'light' : 'dark'
    localStorage.setItem("theme", theme.global.name.value);
}

const page = usePage()
const links = []
if (page.props.user.roles.includes("Super Admin")) {
    links.push(
        { title: 'Admin', route: 'admin.dashboard', icon: 'fa fa-user-shield'},
    )
}

links.push(
    { title: 'Account', route: 'account.dashboard', icon: 'fa fa-user'},
    { title: 'Setting', route: 'account.setting', icon: 'fa fa-gear'},
)
</script>

<template>
    <v-app-bar flat class="px-4" rounded="0" title="GrandPa">
        <template v-slot:prepend>
            <v-btn
                icon="fa fa-bars" rounded="xl"
                @click="$emit('update:drawer', !drawer)"
            />
        </template>

        <v-btn rounded="xl">
            <v-badge dot color="error" >
                <v-icon icon="fa fa-envelope" size="24" />
            </v-badge>
        </v-btn>

        <v-btn append-icon="fa fa-angle-down" class="no-uppercase" rounded="xl">
            <template v-slot:prepend>
                <v-avatar image="https://cdn.vuetifyjs.com/images/john.jpg" size="32" rounded="xl" />
            </template>

            <span class="hidden-md-and-down">{{ $page.props.user.first_name + ' ' + $page.props.user.last_name }}</span>

            <v-menu activator="parent">
                <v-list class="px-3 py-2 mt-2" rounded="lg" elevation="2">
                    <v-list-item
                        v-for="link in links"
                        :prepend-icon="link.icon"
                        :title="link.title"
                        :to="route(link.route)"
                        density="compact"
                        rounded="lg"
                        class="mb-1"
                    />

                    <v-list-item
                        :prepend-icon="theme.global.current.value.dark ? 'fa fa-sun' : 'fa fa-moon'"
                        :title="theme.global.current.value.dark ? 'Light Theme' : 'Dark Theme'"
                        @click="toggleTheme"
                        rounded="lg"
                        density="compact"
                        class="mb-1"
                    />

                    <v-divider />

                    <v-list-item
                        prepend-icon="fa fa-right-from-bracket"
                        title="Logout"
                        :to="route('logout')"
                        base-color="error"
                        rounded="lg"
                        density="compact"
                        class="mt-1"
                    />
                </v-list>
            </v-menu>
        </v-btn>
    </v-app-bar>
</template>
