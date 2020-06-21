import Repository from "./Repository";

const resource = "prediction";
export default {
  getPrediction() {
    return Repository.get(`${resource}`);
  },
};
