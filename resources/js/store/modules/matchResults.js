
import { RepositoryFactory } from './../../repositories/RepositoryFactory';
const MatchesRepository = RepositoryFactory.get("matches");
export default {
    actions: {
        fetchMatchResults(context) {
            context.commit('updateMatchesResultsLoading', true);
            MatchesRepository.getLastWeekMatches().then(response => {
                context.commit('updateMatches', response.data.matches);
                context.commit('updateMatchesResultsWeek', response.data.week);
                context.commit('updateMatchesResultsLoading', false);
            });
        },
    },
    mutations: {
        updateMatches(state, matches) {
            state.matches = matches;
        },
        updateMatchesResultsLoading(state, loading) {
            state.matchesResultsLoading = loading;
        },
        updateMatchesResultsWeek(state, week) {
            state.matchesResultsWeek = week;
        }
    },
    state: {
        matches: [],
        matchesResultsLoading: false,
        matchesResultsWeek: null
    },
    getters: {
        currentWeekMatches(state) {
            return state.matches;
        },
        matchesResultsLoading(state) {
            return state.matchesResultsLoading;
        },
        matchesResultsWeek(state) {
            return state.matchesResultsWeek;
        }
    }
}