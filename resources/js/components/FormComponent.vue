<template>
    <div class="example">
        <h3>Default datepicker</h3>
        <datepicker
            format="dd/MM/yyyy"
            :bootstrap-styling="true"
            :language="language"
            v-model="dataInicial"
            name="dataInicial"
            placeholder="Select Date"
        ></datepicker>
        <code>
            &lt;datepicker placeholder="Select Date"&gt;&lt;/datepicker&gt;
        </code>
    </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import * as lang from "vuejs-datepicker/src/locale";
import moment from "moment";
moment.locale("pt-BR");

export default {
    data() {
        return {
            dataInicial: null,
            language: lang.ptBR,
            moment: moment,
            disabledDates: {
                to: new Date(2016, 0, 5),
                from: new Date(2016, 0, 26)
            }
        };
    },
    components: {
        Datepicker
    },
    mounted() {
        console.log("Component mounted.");
    },
    methods: {}
};
</script>
