import axios from 'axios';

const API_URL = 'http://localhost:801/api/v1/auth/';

class AuthService {
  login(user) {
    return axios
      .post(API_URL + 'login', {
        login: user.login,
        password: user.password
      })
      .then(response => {
        if (response.data.result.access_token) {
          localStorage.setItem('user', JSON.stringify(response.data.result));
        }

        return response.data;
      });
  }
  logout() {
    localStorage.removeItem('user');
  }
}

export default new AuthService();
