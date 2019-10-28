<template>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">Login</div>
            <div class="card-body">
                <form class="form-horizontal" role="form" method="POST">

                    <div class="form-group" :class="{'has-error' : errors}">
                        <label for="email" class="col-md-4 offset-md-2 control-label">E-Mail Address</label>

                        <div class="col-md-8 offset-md-2">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Enter email..." v-model="email" v-focus required autofocus>

                                <span class="help-block" v-if="errors">
                                    <strong>{{ errors }}</strong>
                                </span>
                            
                        </div>
                    </div>

                    <div class="form-group" :class="{'has-error' : errors}">
                        <label for="password" class="col-md-4 offset-md-2 control-label">Password</label>

                        <div class="col-md-8 offset-md-2">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Enter password..." v-model="password" required>

                                <span class="help-block" v-if="errors">
                                    <strong>{{ errors }}</strong>
                                </span>
                            
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 offset-md-4">
                            <button type="button" @click="submitForm" class="btn btn-primary">
                                Login
                            </button>
                            <button type="button" @click="goBack" class="btn btn-default">
                                Back
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {

    name: 'LogIn',

    data () {
        return {
            email: '',
            password: '',
            errors: null
        };
    },

    methods: {
        submitForm(){
            let data = {
                client_id: 2,
                grant_type: 'password',
                client_secret: process.env.MIX_PASSPORT_CLIENT_SECRET,
                username: this.email,
                password: this.password
            }
            axios({
                method: 'post',
                url: 'oauth/token',
                response: 'json',
                data: data 
            }).then(response => {
                this.$auth.setToken(response.data.access_token, response.data.expires_in + Date.now());
                Event.$emit('userLoggedin');
                this.$router.push('./waitingroom');
            }).catch(e => {
                if(e.response.data.hint) {
                    this.errors = 'The user credentials were incorrect.';
                } else { 
                    this.errors = e.response.data.message;
                }
            });
        },

        goBack() {
            this.$router.push('/');
        }
    }
};
</script>

<style lang="css" scoped>
</style>