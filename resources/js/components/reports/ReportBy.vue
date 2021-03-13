<template>
    <div class="flex justify-center flex-wrap">
        <button class="text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 mr-4 rounded px-4 py-2" @click.prevent="getReport(today)">Hoy</button>
        <button class="text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 mr-4 rounded px-4 py-2" href="#" @click.prevent="getReport(week)">Semana</button>
        <button class="text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:ring-opacity-50 rounded px-4 py-2" href="#" @click.prevent="getReport(month)">Mes</button>
    </div>
</template>
<script>
export default {
    props: {
        uri: {
            type: String
        }
    },
    data() {
        return {
            today: {
                "filter[today]": ""
            },
            week: {
                "filter[week]": ""
            },
            month: {
                "filter[currentMonth]": ""
            },
            status:{ "filter[status]": "completed" }
        };
    },
    methods: {
        getReport(value) {
            axios
                .get(this.uri, {
                    params: _.merge(value,this.status), //_.merge une o conbina dos objetos json
                })
                .then(res => {
                    console.log(res.data);
                });
        }
    }
};
</script>
