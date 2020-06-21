import StandingsRepository from "./standingsRepository";
import MatchesRepository from "./matchesRepository";
import SimulateRepository from "./simulateRepository";
import PredictionRepository from "./predictionRepository";

const repositories = {
  standings: StandingsRepository,
  matches: MatchesRepository,
  simulate: SimulateRepository,
  prediction: PredictionRepository
};

export const RepositoryFactory = {
  get: name => repositories[name]
};