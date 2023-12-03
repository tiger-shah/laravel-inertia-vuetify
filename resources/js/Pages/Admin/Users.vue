<script setup>
import Layout from "../../Layouts/Account/Panels/Admin.vue"
import {useDate} from "vuetify"
import {router} from "@inertiajs/vue3";
import {ref} from "vue";

const props = defineProps(['items', 'items_count', 'per_page'])

const VuetifyDate = useDate()

const url = new URL(window.location.href);
const pageCurrent = ref(parseInt(url.searchParams.get('page')))
const search = ref(url.searchParams.get('search'))

if (! pageCurrent.value) {
    pageCurrent.value = 1
}

function updatePage() {
    router.reload({
        data: {
            page: pageCurrent.value,
            search: search.value,
        },
    })
}
</script>

<template>
    <layout title="Users">
        <template v-slot:options>
            <v-text-field
                v-model="search"
                @input="pageCurrent = 1; updatePage();"
                density="compact"
                flat
                hide-details
                label="Search"
                single-line
                variant="solo-inverted"
                style="width: 180px"
            />
        </template>

        <v-card rounded="xl">
            <v-table>
                <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody>
                <tr
                    v-for="(item, key) in items"
                    :key="key"
                >
                    <td>{{ ((pageCurrent - 1) * props.per_page) + (++key) }}</td>
                    <td>{{ item.first_name }}</td>
                    <td>{{ item.last_name }}</td>
                    <td>{{ item.gender ? item.gender.charAt(0).toUpperCase() + item.gender.substring(1) : '-' }}</td>
                    <td>{{ item.birthday ? VuetifyDate.format(item.birthday, 'fullDateWithWeekday') : '-' }}</td>
                    <td>{{ item.email }}</td>
                </tr>
                </tbody>
            </v-table>
        </v-card>

        <v-pagination
            v-model="pageCurrent"
            :length="Math.ceil(props.items_count / props.per_page)"
            rounded="circle"
            @update:modelValue="updatePage"
            class="mt-6"
        />
    </layout>
</template>

<style scoped>
</style>
