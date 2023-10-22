<script setup>
import Layout from '../../Layouts/Auth/AuthLayout.vue'
import {useForm} from "@inertiajs/vue3"
import {VBtn} from "vuetify/components";

defineOptions({
    layout: ( h, page ) => h( Layout, { title: 'Register' }, () => page ),
})

const form = useForm({
    first_name: null,
    last_name: null,
    email: null,
    password: null,
})
</script>

<template>
    <v-card title="Register" max-width="500px" width="100%" class="ma-4" :loading="form.processing">
        <v-card-text>
            <v-form @submit.prevent="form.post(route('api.register'))" :disabled="form.processing">
                <v-text-field
                    v-model="form.first_name"
                    label="First name"
                    :error-messages="form.errors.first_name"
                    variant="solo-filled"
                    flat
                />

                <v-text-field
                    v-model="form.last_name"
                    label="Last name"
                    :error-messages="form.errors.last_name"
                    variant="solo-filled"
                    flat
                />

                <v-text-field
                    v-model="form.email"
                    label="Email"
                    :error-messages="form.errors.email"
                    variant="solo-filled"
                    flat
                />

                <v-text-field
                    v-model="form.password"
                    label="Password"
                    :error-messages="form.errors.password"
                    variant="solo-filled"
                    flat
                />

                <v-btn type="submit" variant="tonal" block :loading="form.processing" class="mt-4">Register</v-btn>

                <p class="text-center mt-4">OR</p>

                <v-btn :to="route('login')" variant="outlined" block class="mt-4">Login</v-btn>
            </v-form>
        </v-card-text>
    </v-card>
</template>
