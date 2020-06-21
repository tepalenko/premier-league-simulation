<template>
    <div class="container prediction border border-gray-200">
        <div v-if="predictionLoading" class="spinner" data-demo-id="2"></div>
        <div v-if="!predictionLoading">
            <div class="match-result-title">
                <span v-if="predictionWeek > 0">{{predictionWeek}}th Week </span>
                Predictions of Championship
            </div>
            <dl>
                <div v-for="team in currentPrediction" :key="team.name"  class="bg-gray-50 px-4 py-5">
                    <dd class="mt-1 text-sm leading-5 text-gray-900 ">
                        <div class="team-name">{{team.name}}</div>
                        <div class="percent">%{{team.win_probability}}</div>
                    </dd>
                </div>
            </dl>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex';
    export default {
        computed: mapGetters(['currentPrediction', 'predictionLoading', 'predictionWeek']),
        mounted() {
            this.$store.dispatch('fetchPrediction');
        },
    }
</script>
<style scoped>
    .prediction{
        border: 1px;
    }
    .team-name{
        width: 80%;
        float: left;
        text-align: left;
    }
    .percent{
        width: 20%;
        float: left;
        text-align: right;
    }
    .match-result-title{
        text-align: center;
        padding: 5px;
    }
</style>