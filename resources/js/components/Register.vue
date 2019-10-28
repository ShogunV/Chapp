<template>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">Register</div>
            <div class="card-body">
                <form class="form-horizontal" role="form" method="POST">

                    <div class="form-group" :class="{'has-error' : errors.name}">
                        <label for="name" class="col-md-4 offset-md-2 control-label">Name</label>

                        <div class="col-md-8 offset-md-2">
                            <input id="name" type="text" class="form-control" name="name" placeholder="Enter username..." v-model="name" v-focus required autofocus>

                                <span class="help-block" v-if="errors.name">
                                    <strong>{{ errors.name[0] }}</strong>
                                </span>
                            
                        </div>
                    </div>

                    <div class="form-group" :class="{'has-error' : errors.email}">
                        <label for="email" class="col-md-4 offset-md-2 control-label">E-Mail Address</label>

                        <div class="col-md-8 offset-md-2">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Enter fake email..." v-model="email" required>

                                <span class="help-block" v-if="errors.email">
                                    <strong>{{ errors.email[0] }}</strong>
                                </span>
                            
                        </div>
                    </div>

                    <div class="form-group" :class="{'has-error' : errors.password}">
                        <label for="password" class="col-md-4 offset-md-2 control-label">Password</label>

                        <div class="col-md-8 offset-md-2">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Enter password..." v-model="password" required>

                                <span class="help-block" v-if="errors.password">
                                    <strong>{{ errors.password[0] }}</strong>
                                </span>
                            
                        </div>
                    </div>

                    <div class="form-group" :class="{'has-error' : errors.password_confirmation}">
                        <label for="password-confirm" class="col-md-4 offset-md-2 control-label">Confirm Password</label>

                        <div class="col-md-8 offset-md-2">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm password..." v-model="password_confirmation" required>

                                <span class="help-block" v-if="errors.password_confirmation">
                                    <strong>{{ errors.password_confirmation[0] }}</strong>
                                </span>

                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 offset-md-4">
                            <button type="button" @click="submitRegForm" class="btn btn-primary">
                                Register
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

    name: 'Register',

    data () {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
            errors: []
        };
    },

    methods: {
        submitRegForm(){
            axios({
                method: 'post',
                url: 'api/register',
                response: 'json',
                data:{
                    name: this.name,
                    email : this.email,
                    password : this.password,
                    password_confirmation: this.password_confirmation
                } 
            }).then(response => {
                this.$auth.setToken(response.data.success.token, response.data.expires_in + Date.now());
                Event.$emit('userLoggedin');
                this.$router.push('waitingroom');
            }).catch(e => {
                console.log(e);
                this.errors = e.response.data.error;
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