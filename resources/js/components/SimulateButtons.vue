<template>
    <div class="container buttons-container">
        <div class="left-container">
            <button v-on:click="simulateAll" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Play All
            </button>
            <button v-on:click="flushData" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Flush data
            </button>
        </div>
        <div class="right-container">
            <button  v-on:click="simulateWeek" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Next Week
            </button>
        </div>
    </div>
</template>

<script>
    import { RepositoryFactory } from "../repositories/RepositoryFactory";
    const SimulateRepository = RepositoryFactory.get("simulate");
    export default {
        methods: {
            simulateWeek() {
                SimulateRepository.simulate('week').then(response => {
                    if (response.data.success === true) {
                        this.refillData();
                    }
                });
            },
            simulateAll() {
                SimulateRepository.simulate('all').then(response => {
                    this.refillData();
                    this.$store.dispatch('showSeasonWeekMatches');
                });
            },
            flushData() {
                SimulateRepository.flushAllSimulates().then(response => {
                    this.refillData();
                    this.$store.dispatch('hideSeasonWeekMatches');
                });
            },
            refillData() {
                this.$store.dispatch('fetchStandings');
                this.$store.dispatch('fetchPrediction');
                this.$store.dispatch('fetchMatchResults');
            }
        }
    }
</script>
<style scoped>
    .buttons-container{
        overflow: hidden;
        padding: 10px 15px;
        width: 900px;
    }
    .left-container{
        width: 50%;
        float: left;
        text-align: left;
    }
    .right-container{
        width: 50%;
        float: left;
        text-align: right;
    }
</style>
