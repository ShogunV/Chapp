export default function(Vue) {
  let authenicatedUser = {};

  Vue.auth = {
    getToken() {
      // let token = localStorage.getItem('token');
      let token = localStorage["token"];
      // let expiration = localStorage.getItem('expiration');
      let expiration = localStorage["expiration"];

      if (!token || !expiration) {
        return null;
      }

      if (Date.now() > parseInt(expiration)) {
        this.destroyToken();
        return null;
      } else {
        return token;
      }
    },

    setToken(token, expiration) {
      // localStorage.setItem('token', token);
      localStorage["token"] = token;
      // localStorage.setItem('expiration', expiration);
      localStorage["expiration"] = expiration;
      window.axios.defaults.headers.common.Authorization = `Bearer ${localStorage["token"]}`;
      window.Echo.connector.pusher.config.auth.headers[
        "Authorization"
      ] = `Bearer ${localStorage["token"]}`;
    },

    destroyToken() {
      localStorage.token = undefined;
      localStorage.removeItem("token");
      localStorage.expiration = undefined;
      localStorage.removeItem("expiration");
      window.axios.defaults.headers.common.Authorization = "";
      window.Echo.connector.pusher.config.auth.headers["Authorization"] = "";
    },

    isAuthenticated() {
      if (this.getToken()) {
        return true;
      } else {
        return false;
      }
    },

    setAuthenticatedUser(user) {
      authenicatedUser = user;
    },

    getAuthenticatedUser() {
      return authenicatedUser;
    }
  };

  Object.defineProperties(Vue.prototype, {
    $auth: {
      get: () => {
        return Vue.auth;
      }
    }
  });
}
