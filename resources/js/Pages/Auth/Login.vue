<script setup>
import Layout from '../../Layouts/Auth/AuthLayout.vue'
import {useForm} from "@inertiajs/vue3"
import {ref} from "vue";

const passVisible = ref(true)

const form = useForm({
    email: null,
    password: null,
})
</script>

<template>
    <layout title="Login">
        <v-card title="Register" max-width="500px" width="100%" class="ma-4" :loading="form.processing">
            <v-card-text>
                <v-form @submit.prevent="$page.props.message = null; form.post(route('login'))" :disabled="form.processing">
                    <v-text-field
                        v-model="form.email"
                        label="Email"
                        :error-messages="form.errors.email"
                        variant="solo-filled"
                        flat
                    />

                    <v-text-field
                        :type="passVisible ? 'password' : 'text'"
                        v-model="form.password"
                        label="Password"
                        :error-messages="form.errors.password"
                        :append-inner-icon="passVisible ? 'fa fa-eye' : 'fa fa-eye-slash'"
                        @click:append-inner="passVisible = !passVisible"
                        variant="solo-filled"
                        flat
                    />

                    <v-alert
                        v-if="$page.props.message"
                        :type="$page.props.message.type"
                        :text="$page.props.message.text"
                        border="start"
                        variant="tonal"
                    />

                    <v-btn type="submit" variant="tonal" block :loading="form.processing" class="mt-4">Login</v-btn>

                    <p class="text-center mt-4">OR</p>

                    <v-btn :to="route('register')" variant="outlined" block class="mt-4" text="Register" />
                </v-form>
            </v-card-text>
        </v-card>
    </layout>
</template>
