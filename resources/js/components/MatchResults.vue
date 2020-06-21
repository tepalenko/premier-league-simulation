<template>
    <div class="container">
        <div class="title">Match Results</div>
        <div v-if="matchesResultsLoading" class="spinner" data-demo-id="2"></div>
        <div v-if="!matchesResultsLoading && matchesResultsWeek > 0">
            <div class="match-result-title">{{matchesResultsWeek}}th Week Match Result</div>
            <dl>
                <div v-for="match in currentWeekMatches" :key="match.home_team_name"  class="bg-gray-50 px-4 py-5">
                    <dd class="mt-1 text-sm leading-5 text-gray-900 ">
                        <div class="home-team">{{match.home_team_name}}</div>
                        <div class="score">{{match.home_team_score}}:{{match.away_team_score}}</div>
                        <span class="away-team">{{match.away_team_name}}</span>
                    </dd>
                </div>
            </dl>
        </div>
        <div v-if="!matchesResultsLoading && matchesResultsWeek === 0" class="no-matches-message">
            No matches in current season. Push "Next Week" button for start simulation.
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        computed: mapGetters(['currentWeekMatches', 'matchesResultsLoading', 'matchesResultsWeek']),
        mounted() {
            this.$store.dispatch('fetchMatchResults');
        },
    }
</script>
<style scoped>
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
    .no-matches-message {
        font-size: 12px;
        text-align: center;
        line-height: 16px;
    }
</style>
