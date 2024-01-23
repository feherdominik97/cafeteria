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
        .input
            button(@click="exportDataToCSV") Export
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
import axios from 'axios';
export default {
    data() {
        return {
            cafeterias: [],
            months: [
                'January',
                'February',
                'March',
                'April',
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
            axios.get('cafeterias').then(response => this.cafeterias = response.data);
        },
        saveCafeteria() {
            axios.post('cafeteria', this.selected).then(() => this.getCafeterias());
        },
        exportDataToCSV() {
            const csvContent = this.convertToCSV(this.cafeterias);
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8' });
            const url = URL.createObjectURL(blob);
            const link =  document.createElement('a');

            link.href = url;
            link.setAttribute('download', 'cafeteria.csv');
            link.click();
        },
        convertToCSV(data) {
            const headers = Object.keys(data[0]);
            const rows = data.map(obj => headers.map(header => obj[header]));
            const headerRow = headers.join(',');
            const csvRows = [headerRow, ...rows.map(row => row.join(','))];

            return csvRows.join('\n');
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
