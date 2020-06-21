
import { RepositoryFactory } from './../../repositories/RepositoryFactory';
const PredictionRepository = RepositoryFactory.get("prediction");
export default {
    actions: {
        fetchPrediction(context) {
            context.commit('updatePredictionLoading', true);
            PredictionRepository.getPrediction().then(response => {
                context.commit('updatePrediction', response.data.prediction);
                context.commit('updatePredictionWeek', response.data.week);
                context.commit('updatePredictionLoading', false);
            });
        }
    },
    mutations: {
        updatePrediction(state, prediction) {
            state.prediction = prediction;
        },
        updatePredictionLoading(state, loading) {
            state.predictionLoading = loading;
        },
        updatePredictionWeek(state, week) {
            state.predictionWeek = week;
        }
    },
    state: {
        prediction: [],
        predictionLoading: false,
        predictionWeek: null
    },
    getters: {
        currentPrediction(state) {
            return state.prediction;
        },
        predictionLoading(state) {
            return state.predictionLoading;
        },
        predictionWeek(state) {
            return state.predictionWeek;
        }
    }
}