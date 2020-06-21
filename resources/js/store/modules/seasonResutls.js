
import { RepositoryFactory } from './../../repositories/RepositoryFactory';
const MatchesRepository = RepositoryFactory.get("matches");
export default {
    actions: {
        fetchSeasonResults(context) {
            context.commit('updateMatchesResultsLoading', true);
            MatchesRepository.getSeasonMatches().then(response => {
                context.commit('updateSeasonWeeksMatches', response.data.weeks);
                context.commit('updateMatchesResultsLoading', false);
            });
        },
        updateMatchResult({dispatch, commit }, payload) {
            commit('updateMatchesResultsLoading', true);
            MatchesRepository.updateMatchScore(payload.matchId, payload.score, payload.field).then(response => {
                if (response.data.success === true) {
                    dispatch('fetchStandings');
                    dispatch('fetchPrediction');
                    dispatch('fetchMatchResults');
                }
            });
        },
        showSeasonWeekMatches(context) {
            context.commit('updateShowSeasonWeeksMatches', true);
        },
        hideSeasonWeekMatches(context) {
            context.commit('updateShowSeasonWeeksMatches', false);
        },
    },
    mutations: {
        updateSeasonWeeksMatches(state, matches) {
            state.seasonWeeksMatches = matches;
        },
        updateMatchesResultsLoading(state, loading) {
            state.seasonWeeksMatchesLoading = loading;
        },
        updateShowSeasonWeeksMatches(state, show) {
            state.showSeasonWeeksMatches = show;
        },
    },
    state: {
        seasonWeeksMatches: [],
        seasonWeeksMatchesLoading: false,
        showSeasonWeeksMatches: false
    },
    getters: {
        seasonWeeksMatches(state) {
            return state.seasonWeeksMatches;
        },
        seasonWeeksMatchesLoading(state) {
            return state.seasonWeeksMatchesLoading;
        },
        showSeasonWeeksMatches(state) {
            return state.showSeasonWeeksMatches;
        },
    }
}