import Repository from "./Repository";

const resource = "standings";
export default {
  getTeamsStandings() {
    return Repository.get(`${resource}`);
  },
};
