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
const datePickerValue = ref(VuetifyDate.date(props.modelValue))

const datePickerDisplayValue = ref()
if (props.modelValue) {
    datePickerDisplayValue.value = VuetifyDate.format(props.modelValue, 'fullDateWithWeekday')
}

function updateDate() {
    const [month, day, year] = (datePickerValue.value).toLocaleDateString().split('/')
    const dateFormatted = year + '-' + month.padStart(2, '0') + '-' + day.padStart(2, '0');

    datePickerDisplayValue.value = VuetifyDate.format(datePickerValue.value, 'fullDateWithWeekday')

    emit('update:modelValue', dateFormatted)

    datePickerDisplay.value = false
}
</script>

<template>
    <v-menu :close-on-content-click="false" v-model="datePickerDisplay">
        <template v-slot:activator="{ props }">
            <v-text-field
                :label="label"
                v-model="datePickerDisplayValue"
                :error-messages="errorMessages"
                variant="solo-filled"
                v-bind="props"
                flat
                readonly
            />
        </template>

        <v-date-picker
            v-model="datePickerValue"
            @update:modelValue="updateDate"
        />
    </v-menu>
</template>
