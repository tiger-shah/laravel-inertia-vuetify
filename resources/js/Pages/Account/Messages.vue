<script setup>
import Layout from "../../Layouts/Account/Panels/User.vue"
import { ref } from 'vue'
import {useDisplay} from "vuetify"

const { lgAndUp } = useDisplay()

const drawer = ref(null)
</script>

<template>
    <layout title="Messages">
        <v-layout class="rounded-xl" full-height>
            <v-navigation-drawer
                v-model="drawer"
                :temporary="!lgAndUp"
                rounded="0"
                class="pa-4"
                width="325"
            >
                <v-text-field
                    label="Search"
                    variant="solo-filled"
                    density="comfortable"
                    rounded="xl"
                    hide-details
                    single-line
                    flat
                >
                    <template v-slot:append-inner>
                        <v-icon icon="fa fa-magnifying-glass" size="16" />
                    </template>
                </v-text-field>

                <v-list>
                    <v-list-item
                        prepend-avatar="https://cdn.vuetifyjs.com/images/john.png"
                        title="John Leider"
                        subtitle="Hey, we gonna have a meeting in ..."
                        @click=""
                    />
                </v-list>
            </v-navigation-drawer>

            <v-app-bar rounded="0" title="Messages">
                <v-app-bar-nav-icon icon="fa fa-home" @click="drawer = !drawer" v-if="!lgAndUp" />
            </v-app-bar>

            <v-main class="h-100">
                dddddddd
            </v-main>
        </v-layout>
    </layout>
</template>
