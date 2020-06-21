<template>
    <div v-if="showSeasonWeeksMatches" class="container season-result">
        <div class="title">Season Match Results</div>
        <div v-if="seasonWeeksMatchesLoading" class="spinner" data-demo-id="2"></div>
        <div v-if="!seasonWeeksMatchesLoading">
            <div  v-for="(week, index) in seasonWeeksMatches" :key="index">
                <div class="seasson-result-week-title">{{index}}th Week Match Result</div>
                <dl>
                    <div v-for="(match, matchIndex) in week" :key="matchIndex"  class="bg-gray-50 px-4 py-5">
                        <dd class="mt-1 text-sm leading-5 text-gray-900 ">
                            <div class="home-team">{{match.home_team_name}}</div>
                            <div class="score">
                                <input 
                                    v-on:input="updateScore($event, match['match_id'], 'home_team_score')"
                                    v-model="score[index][matchIndex].home_team_score"
                                    debounce="1500"
                                >
                                :
                                <input
                                    v-on:input="updateScore($event, match['match_id'], 'away_team_score')"
                                    v-model="score[index][matchIndex].away_team_score"
                                    debounce="1500"
                                >
                                </div>
                            <span class="away-team">{{match.away_team_name}}</span>
                        </dd>
                    </div>
                </dl>
            </div>
            
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        computed: {
            ...mapGetters(['seasonWeeksMatches', 'seasonWeeksMatchesLoading', 'showSeasonWeeksMatches']),
            score: {
                get () {
                    return this.$store.state.seasonResults.seasonWeeksMatches;
                }
            },
        },
        mounted() {
            this.$store.dispatch('fetchSeasonResults');
        },
        methods: {
            updateScore(event, matchId, field){
                if (event.target.value.length > 0) {
                    const payload = {score:event.target.value, matchId, field };
                    setTimeout(function () { this.saveData(payload) }.bind(this), 1000)
                }
            },
            saveData(payload) {
                this.$store.dispatch('updateMatchResult', payload);
            }
        }
    }
</script>
<style scoped>
    .season-result{
        margin: 0 auto;
        padding: 10px;
    }
    .home-team{
        width: 40%;
        float: left;
        text-align: left;
    }
    .score{
        width: 20%;
        float: left;
        text-align: center;
    }
    .score input {
        width: 20px;
        text-align: center;
    }
    .away-team{
        width: 40%;
        float: left;
        text-align: right;
    }
    .match-result-title{
        text-align: center;
        font-size: 12px;
    }
    .title{
        text-align: center;
        margin-bottom: 10px;
        padding: 5px;
    }
    .seasson-result-week-title {
        margin: 10px;
        text-align: center;
        line-height: 16px;
    }
</style>
