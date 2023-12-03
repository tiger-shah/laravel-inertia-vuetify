<script setup>
import Layout from '../../Layouts/Auth/AuthLayout.vue'
import {useForm} from "@inertiajs/vue3"
import {ref} from "vue";
import InputDatePicker from "../../Components/InputDatePicker.vue";

defineOptions({
    layout: ( h, page ) => h( Layout, { title: 'Register' }, () => page ),
})

const props = defineProps({
    genders: Object
})

const genders = []
props.genders.forEach(function (item) {
    genders.push({title: item.charAt(0).toUpperCase() + item.substring(1), value: item})
})

const form = useForm({
    email: null,
    first_name: null,
    last_name: null,
    gender: null,
    birthday: null,
    password: null,
    password_confirmation: null,
})

// const form = useForm({
//     email: 'alireza@mala.com',
//     first_name: 'Anis',
//     last_name: 'Malayeri',
//     gender: 'male',
//     birthday: '1998-04-17',
//     // birthday: '1998-04-17',
//     password: 'Ali2415',
//     password_confirmation: 'Ali2415',
// })

let step = ref(0)
const passVisible = ref(true)

function nextStep() {
    form.clearErrors()

    let routeName = ''

    if (step.value === 0) {
        routeName = 'register.step1'
    } else if (step.value === 1) {
        routeName = 'register.step2'
    } else if (step.value === 2) {
        routeName = 'register.step3'
    } else {
        step.value = 0
        return
    }

    form.post(route(routeName), {
        preserveScroll: true,
        onSuccess: () => ++step.value,
    })
}
</script>

<template>
    <v-card max-width="500px" width="100%" class="ma-4 pa-8" :loading="form.processing">
        <v-card-title class="pa-0 mb-8">Register</v-card-title>
        <v-card-text class="pa-0">
            <v-stepper v-model="step" flat>
                <v-stepper-header style="display: none">
                    <v-stepper-item value="1"/>
                    <v-stepper-item value="2"/>
                    <v-stepper-item value="3"/>
                </v-stepper-header>

                <v-stepper-window>
                    <v-form @submit.prevent="nextStep" :disabled="form.processing">
                        <v-stepper-window-item value="1">
                            <v-text-field
                                v-model="form.email"
                                label="Email"
                                :error-messages="form.errors.email"
                                variant="solo-filled"
                                flat
                            />
                        </v-stepper-window-item>

                        <v-stepper-window-item value="2">
                            <v-text-field
                                v-model="form.first_name"
                                label="First Name"
                                :error-messages="form.errors.first_name"
                                variant="solo-filled"
                                flat
                            />

                            <v-text-field
                                v-model="form.last_name"
                                label="Last Name"
                                :error-messages="form.errors.last_name"
                                variant="solo-filled"
                                flat
                            />

                            <v-select
                                label="Gender"
                                v-model="form.gender"
                                :error-messages="form.errors.gender"
                                :items="genders"
                                variant="solo-filled"
                                flat
                            />

                            <InputDatePicker v-model="form.birthday" label="Birthday" :error-messages="form.errors.birthday" />
                        </v-stepper-window-item>

                        <v-stepper-window-item value="3">
                            <v-text-field
                                v-model="form.password"
                                label="Password"
                                :type="passVisible ? 'password' : 'text'"
                                :append-inner-icon="passVisible ? 'fa fa-eye' : 'fa fa-eye-slash'"
                                @click:append-inner="passVisible = !passVisible"
                                :error-messages="form.errors.password"
                                variant="solo-filled"
                                flat
                            />

                            <v-text-field
                                v-model="form.password_confirmation"
                                label="Password Confirmation"
                                :type="passVisible ? 'password' : 'text'"
                                :error-messages="form.errors.password_confirmation"
                                variant="solo-filled"
                                flat
                            />
                        </v-stepper-window-item>
                    </v-form>
                </v-stepper-window>

                <v-alert
                    v-if="form.errors[0]"
                    type="error"
                    :text="form.errors[0]"
                    border="start"
                    variant="tonal"
                    class="mb-6"
                />

                <v-stepper-actions disabled="false" class="pa-0">
                    <template v-slot:prev>
                        <v-btn @click="--step" :disabled="(step === 0) || form.processing"></v-btn>
                    </template>

                    <template v-slot:next>
                        <v-btn @click="nextStep" :loading="form.processing" v-if="step !== 2"></v-btn>
                        <v-btn @click="nextStep" :loading="form.processing" v-else variant="flat" color="primary">Register</v-btn>
                    </template>
                </v-stepper-actions>
            </v-stepper>
        </v-card-text>
    </v-card>
</template>

<style>
.v-stepper-window {
    margin: 0;
}
</style>
