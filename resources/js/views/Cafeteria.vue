<template lang="pug">
    h1 Cafeteria
    .input-group
        .input
            label Month
            select(v-model="selected.month")
                option(v-for="month in months" :value="month") {{ month }}
        .input
            label Pocket
            select(v-model="selected.pocket")
                option(v-for="pocket in pockets" :value="pocket") {{ pocket }}
        .input
            label Amount
            input(v-model="selected.amount")
        .input
            button(@click="saveCafeteria") Save
    .input-group
        table
            tr
                th Month
                th Pocket
                th Amount
            tr(v-for="cafeteria in cafeterias")
                td {{ cafeteria.month }}
                td {{ cafeteria.pocket }}
                td {{ cafeteria.amount }}
</template>
<script>
export default {
    data() {
        return {
            cafeterias: [
                {
                    pocket: 'p',
                    amount: 1000,
                    month: 'January'
                }
            ],
            months: [
                'January',
                'February',
                'March',
                'May',
                'June',
                'July',
                'August',
                'September',
                'October',
                'November',
                'December'
            ],
            pockets: [
                'p',
                'p1',
                'p2'
            ],
            selected: {
                month: 'January',
                amount: 0,
                pocket: 'p'
            }
        }
    },
    mounted() {
        this.getCafeterias()
    },
    methods: {
        getCafeterias() {
            /*
                get all the cafeterias
             */
            console.log('get');
        },
        saveCafeteria() {
            /*
              save the cafeteria
             */
            console.log('save');
        }
    }
}
</script>
<style>
h1 {
    text-align: center;
}
table {
}
table, tr, td, th {
    border: black 1px solid;
}
tr, td, th {
    padding: 5px;
}
.input-group {
    display: flex;
    align-content: center;
    justify-content: center;
    .input {
        margin: 20px;
        label {
            margin-right: 10px;
        }
    }
}
</style>
