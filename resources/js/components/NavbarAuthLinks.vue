<template>
<ul class="nav navbar-nav navbar-right">
    <!-- Authentication Links -->
    
    <li v-if="!isAuth" class="nav-item"><router-link to="/login" exact class="nav-link">Login</router-link></li>
    <li v-if="!isAuth" class="nav-item"><router-link to="/register" class="nav-link">Register</router-link></li>

    <li class="nav-item dropdown" v-else>
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
            {{ user }} <span class="caret"></span>
        </a>

        <ul class="dropdown-menu dropdown-menu-right" role="menu">
            <li v-if="isAuth" class="dropdown-item"><router-link to="/waitingroom" tag="li">Waitingroom</router-link></li>
            <li @click="logout" class="text-center dropdown-item">Logout</li>
        </ul>
    </li>

</ul>
</template>

<script>
export default {

    name: 'NavbarAuthLinks',

    data () {
        return {
            isAuth: null,
            user: null
        };
    },

    methods: {
        logout(){
            this.$auth.destroyToken();
            this.isAuth = this.$auth.isAuthenticated();
            this.user = null;
            this.$router.push('/');
        },

        setAuthenticatedUser() {

            let token = this.$auth.getToken();

            axios({
                method: 'get',
                url: '/api/user',
                response: 'json',
                headers: {
                  'Authorization': 'Bearer ' + token
              },
            }).then(response => {
                this.$auth.setAuthenticatedUser(response.data);
                this.user = this.$auth.getAuthenticatedUser().name;   
            }).catch(e => {

            });
        }
    },

    created(){
        if(this.isAuth = this.$auth.isAuthenticated()) {
            this.setAuthenticatedUser();  
        }

        Event.$on('userLoggedin', () => {
            this.isAuth = this.$auth.isAuthenticated();
            this.setAuthenticatedUser();
        });
    }
};
</script>

<style lang="css" scoped>
li {
    cursor: pointer;
}
</style>