<script setup>
import Layout from "../../Layouts/Account/Panels/Admin.vue";
import {router} from "@inertiajs/vue3";

// const
</script>

<template>
    <layout title="Dashboard">
        <v-row>
            <v-col cols="12" md="4">
                <v-card
                    class="px-10 rounded-xl text-white"
                    title="New Users: 5"
                    subtitle="Total Users: 158"
                    style="background: linear-gradient(to right, #8c0030, #da1b60)"
                    @click="router.visit(route('admin.users'))"
                >
                    <template v-slot:prepend>
                        <v-icon icon="fa fa-users" size="38" class="me-6" style="opacity: var(--v-medium-emphasis-opacity);" />
                    </template>
                </v-card>
            </v-col>

            <v-col cols="12" md="4">
                <v-card
                    class="px-10 rounded-xl text-white"
                    title="New Orders: 3"
                    subtitle="Total Orders: 241"
                    style="background: linear-gradient(to right, #00418c, #126dd2)"
                >
                    <template v-slot:prepend>
                        <v-icon icon="fa fa-file-invoice-dollar" size="38" class="me-6" style="opacity: var(--v-medium-emphasis-opacity);" />
                    </template>
                </v-card>
            </v-col>

            <v-col cols="12" md="4">
                <v-card
                    class="px-10 rounded-xl text-white"
                    title="New Deposits: 560 $"
                    subtitle="Total Deposits: 11,320 $"
                    style="background: linear-gradient(to right, #288c00, #46d70e)"
                >
                    <template v-slot:prepend>
                        <v-icon icon="fa fa-money-bill-transfer" size="38" class="me-6" style="opacity: var(--v-medium-emphasis-opacity);" />
                    </template>
                </v-card>
            </v-col>
        </v-row>
    </layout>
</template>
