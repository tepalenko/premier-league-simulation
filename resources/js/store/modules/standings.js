
import { RepositoryFactory } from './../../repositories/RepositoryFactory';
const StandingsRepository = RepositoryFactory.get("standings");
export default {
    actions: {
        fetchStandings(context) {
            context.commit('updateStandingsLoading', true);
            StandingsRepository.getTeamsStandings().then(response => {
                context.commit('updateStandings', response.data);
                context.commit('updateStandingsLoading', false);
            });
        }
    },
    mutations: {
        updateStandings(state, standings) {
            state.standings = standings;
        },
        updateStandingsLoading(state, loading) {
            state.standingsLoading = loading;
        }
    },
    state: {
        standings: [],
        standingsLoading: false
    },
    getters: {
        currentStandings(state) {
            return state.standings;
        },
        standingsLoading(state) {
            return state.standingsLoading;
        }
    },
};
