import Repository from "./Repository";

const resource = "matches/";
export default {
  getLastWeekMatches() {
    return Repository.get(`${resource}last-week`);
  },
  getSeasonMatches() {
    return Repository.get(`${resource}season`);
  },
  updateMatchScore(matchId, score, field) {
    return Repository.post(`${resource}update/${matchId}`, { score, field });
  }
};
