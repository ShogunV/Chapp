<template>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">Create room</div>
            
            <div class="card-body">
                <form class="form-horizontal" @submit.prevent="submit">

                    <div class="form-group" :class="{'has-error' : errors}">
                        <label for="name" class="col-md-4 control-label">Room name</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" v-model="name" v-focus required autofocus>

                            <span class="help-block" v-if="errors">
                                <strong>{{ errors.name[0] }}</strong>
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">Create</button>

                            <router-link to="/waitingroom" class="btn btn-default pull-right">Back</router-link>

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

    name: 'NewRoom',

    data () {
        return {
            name: null,
            errors: null
        };
    },

    methods:{
        submit() {
            let token = this.$auth.getToken();
            let user = this.$auth.getAuthenticatedUser();
            axios({
                method: 'post',
                url: 'api/room',
                data: {
                    name: this.name,
                    user: user
                },
                headers: {
                    'Authorization': 'Bearer ' + token
                }
            }).then(response => {
                this.$router.push('waitingroom');
            }).catch(e => {
                console.log(e.response.data.errors);
                this.errors = e.response.data.errors;
            })
        }
    }
};
</script>

<style lang="css" scoped>
</style>