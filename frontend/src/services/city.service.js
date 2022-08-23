import axios from 'axios';
import authHeader from './auth-header';

const API_URL = 'http://localhost:801/api/v1/';

class CityService {
  getContent() {
    return axios.get(API_URL, { headers: authHeader() });
  }

  update(city_id) {
    return axios.get(API_URL+ 'update/' + city_id, { headers: authHeader() });
  }
}

export default new CityService();
