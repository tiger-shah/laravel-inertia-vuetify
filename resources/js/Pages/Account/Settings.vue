<script setup>
import Layout from "../../Layouts/Account/AccountLayout.vue"
import {useForm, usePage} from "@inertiajs/vue3"
import InputDatePicker from "../../Components/InputDatePicker.vue"
import {ref} from "vue"

const props = defineProps({
    genders: Object,
})

const page = usePage()

const form = useForm(page.props.user)

const genders = []
props.genders.forEach(function (item) {
    genders.push({title: item.charAt(0).toUpperCase() + item.substring(1), value: item})
})

const emailModal = ref(false)
</script>

<template>
    <layout title="Settings">
        <v-form @submit.prevent="$page.props.message = null; form.put(route('account.setting.update'))" :disabled="form.processing">
            <v-card rounded="xl" title="Basic Info">
                <v-card-text class="d-flex align-content-start flex-wrap">
                    <v-row>
                        <v-col cols="12" md="4" lg="3">
                            <v-text-field label="First Name" v-model="form.first_name" :error-messages="form.errors.first_name" variant="solo-filled" flat/>
                        </v-col>

                        <v-col cols="12" md="4" lg="3">
                            <v-text-field label="Last Name" v-model="form.last_name" :error-messages="form.errors.last_name" variant="solo-filled" flat />
                        </v-col>

                        <v-col cols="12" md="4" lg="3">
                            <v-select
                                label="Gender"
                                v-model="form.gender"
                                :error-messages="form.errors.gender"
                                :items="genders"
                                variant="solo-filled"
                                flat
                            />
                        </v-col>

                        <v-col cols="12" md="4" lg="3">
                            <InputDatePicker v-model="form.birthday" label="Birthday" :error-messages="form.errors.birthday" />
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>

            <v-card title="Contact Info" rounded="xl" class="mt-10">
                <v-card-text class="d-flex align-content-start flex-wrap">
                    <v-row>
                        <v-col cols="12" md="4" lg="3">
                            <v-text-field label="Mobile" v-model="form.mobile" :error-messages="form.errors.mobile" variant="solo-filled" readonly flat/>
                        </v-col>

                        <v-col cols="12" md="4" lg="3">
                            <v-text-field
                                label="Email"
                                v-model="form.email"
                                :error-messages="form.errors.email"
                                @click="emailModal = true"
                                variant="solo-filled"
                                flat
                            />
                        </v-col>
                    </v-row>
                </v-card-text>
            </v-card>

            <v-sheet class="bg-transparent mt-10 d-flexflex-column">
                <v-alert
                    v-if="$page.props.message"
                    :type="$page.props.message.type"
                    :text="$page.props.message.text"
                    border="start"
                    variant="tonal"
                    class="mb-6"
                />

                <div class="d-flex justify-end ">
                    <v-btn type="submit" text="Save" :loading="form.processing" color="primary" variant="elevated" class="px-16" />
                </div>
            </v-sheet>
        </v-form>
    </layout>
</template>
