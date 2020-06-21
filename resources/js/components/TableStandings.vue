<template>
    <div class="container">
        <div v-if="standingsLoading" class="spinner" data-demo-id="2"></div>
        <table class="min-w-full" v-if="!standingsLoading">
            <thead>
            <tr>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                Teams
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                PTS
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                P
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                W
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                D
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                L
                </th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                GD
                </th>
            </tr>
            </thead>
            <tbody class="bg-white">
                <tr v-for="team in currentStandings" :key="team.name">
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{team.name}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{team.stats.points}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{team.stats.game_played}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{team.stats.wins}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{team.stats.draws}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{team.stats.loses}}</td>
                    <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">{{team.stats.goals_diff}}</td>
                </tr>
            </tbody>
        </table> 
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';
    export default {
        computed: mapGetters(['currentStandings', 'standingsLoading']),
        mounted() {
            this.$store.dispatch('fetchStandings');
        },
    }
</script>
