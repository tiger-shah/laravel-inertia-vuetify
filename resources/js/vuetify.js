import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { aliases, fa as fontAwesome } from 'vuetify/iconsets/fa'
import '@fortawesome/fontawesome-free/css/all.css'
import {VDatePicker} from "vuetify/labs/components"

export default createVuetify({
    components: {
        ...components,
        VDatePicker,
    },
    directives,
    theme: {
        defaultTheme: 'light',
        themes: {
            light: {
                dark: false,
                colors: {
                    background: '#F5F5F5',
                    surface: '#FFF',
                    primary: '#1B5E20',
                    secondary: '#FFCDD2',
                }
            },
            dark: {
                dark: true,
                colors: {
                    primary: '#1B5E20',
                    secondary: '#FFCDD2',
                }
            },
        },
    },
    icons: {
        defaultSet: 'fontAwesome',
        aliases: {
            ...aliases,
            error: 'fa-solid fa-circle-exclamation'
        },
        sets: {
            fontAwesome,
        },
    },
    defaults: {
        global: {
            rounded: 'lg',
        },
        VCard: {
            class: ['pa-4']
        },
        VCardTitle: {
            class: ['mb-4']
        },
    },
})
