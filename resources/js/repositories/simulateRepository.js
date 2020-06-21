import Repository from "./Repository";

const resource = "simulate/";
export default {
  simulate(type) {
    return Repository.post(`${resource}${type}`);
  },
  flushAllSimulates() {
    return Repository.post(`${resource}flush`);
  }
};
