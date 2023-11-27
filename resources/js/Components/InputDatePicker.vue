<script setup>
import {ref} from "vue"
import {useDate} from "vuetify"

const props = defineProps([
    'label',
    'modelValue',
    'errorMessages'
])
const emit = defineEmits(['update:modelValue'])

const VuetifyDate = useDate()

const datePickerDisplay = ref(false)
const datePickerValue = ref(props.modelValue)

const datePickerDisplayValue = ref()
if (props.modelValue) {
    datePickerDisplayValue.value = VuetifyDate.format(props.modelValue, 'fullDateWithWeekday')
}

// function updateDate(date) {
//     const [month, day, year] = new Date(date).toLocaleDateString().split('/')
//
//     datePickerValue.value = year + '-' + month.padStart(2, '0') + '-' + day.padStart(2, '0')
//     datePickerDisplayValue.value = VuetifyDate.format(datePickerValue.value, 'fullDateWithWeekday')
//
//     emit('update:modelValue', datePickerValue.value)
// }
function updateDate() {
    const [month, day, year] = (datePickerValue.value).toLocaleDateString().split('/')
    const dateFormatted = year + '-' + month.padStart(2, '0') + '-' + day.padStart(2, '0');

    datePickerDisplayValue.value = VuetifyDate.format(datePickerValue.value, 'fullDateWithWeekday')

    emit('update:modelValue', dateFormatted)
}
</script>

<template>
    <v-menu :close-on-content-click="true" v-model="datePickerDisplay">
        <template v-slot:activator="{ props }">
            <v-text-field
                :label="label"
                v-model="datePickerDisplayValue"
                :error-messages="errorMessages"
                variant="solo-filled"
                v-bind="props"
                placeholder="dd/mm/yyyy"
                flat
                readonly
            />
        </template>

<!--        <v-date-picker-->
<!--            v-model="datePickerValue"-->
<!--            @update:modelValue="updateDate"-->
<!--            @click:save="datePickerDisplay = false"-->
<!--        />-->
        <v-date-picker
            v-model="datePickerValue"
            @update:modelValue="updateDate"
        />
    </v-menu>
</template>
