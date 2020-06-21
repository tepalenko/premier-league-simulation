import Vue from 'vue';
import Vuex from 'vuex';
import standings from './modules/standings';
import prediction from './modules/prediction';
import matchResults from './modules/matchResults';
import seasonResults from './modules/seasonResutls';

Vue.use(Vuex);

export default new Vuex.Store({
    modules:{
        standings,
        prediction,
        matchResults,
        seasonResults
    }
});