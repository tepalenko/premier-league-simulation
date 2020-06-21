<template>
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        Premier League Simulation 2020
                    </h3>
                </div>
                <div class="main-container">
                    <div class="table-container"><TableStangings /></div>
                    <div class="match-results-container"><MatchResults /></div>
                    <div class="prediction-container"><Predictions /></div>
                </div>
                <div>
                    <SimulateButtons />
                </div>
                <div>
                    <SeasonResults />
                </div>
            </div>
        </div>
    </main>
    
</template>

<script>
    import MatchResults from './MatchResults'
    import Predictions from './Predictions'
    import TableStangings from './TableStandings'
    import SimulateButtons from './SimulateButtons'
    import SeasonResults from './SeasonResults'
    export default {
        name: "PremierLeagueSimulator",
        components: {
            MatchResults,
            Predictions,
            TableStangings,
            SimulateButtons,
            SeasonResults
        },
    }
</script>

<style>
    @keyframes spinner {
        to {transform: rotate(360deg);}
    }
    
    .spinner:before {
        content: '';
        box-sizing: border-box;
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin-top: -10px;
        margin-left: -10px;
        border-radius: 50%;
        border: 2px solid #ccc;
        border-top-color: #000;
        animation: spinner .6s linear infinite;
    }
    .main-container{
        overflow: hidden;
    }
    .table-container {
        width: 600px;
        float: left;
        min-height: 237px;
        position: relative;
    }
    .match-results-container{
        width: 300px;
        float: left;
        min-height: 237px;
        position: relative;
    }
    .prediction-container{
        width: 350px;
        float: left;
        min-height: 237px;
        position: relative;
    }
</style>