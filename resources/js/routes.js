import VueRouter from 'vue-router';

let routes = [
    {
        path:'/',
        component: require('./components/Start.vue').default
    },
    {
        path:'/login',
        component: require('./components/LogIn.vue').default,
        meta: {
            forVisitors: true
        }
    },
    {
        path:'/register',
        component: require('./components/Register.vue').default,
        meta: {
            forVisitors: true
        }
    },
    {
        path:'/waitingroom',
        component: require('./components/WaitingRoom.vue').default,
        meta: {
            forAuth: true
        }
    },
    {
        path:'/newroom',
        component: require('./components/NewRoom.vue').default,
        meta: {
            forAuth: true
        }
    },
    {
        path:'/room/:id',
        component: require('./components/Room.vue').default,
        props: true,
        name: 'room',
        meta: {
            forAuth: true
        }
    },
    {
        path:'/*',
        component: require('./components/NotFound.vue').default
    }
];

export default new VueRouter({
    mode: 'history',
    routes
});