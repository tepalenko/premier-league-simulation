import axios from "axios";

const baseURL = 'api';

let axiosRepository = axios.create({
  baseURL
});

export default axiosRepository;