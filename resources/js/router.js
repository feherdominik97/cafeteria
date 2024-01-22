import { createWebHistory, createRouter } from "vue-router";
import Cafeteria from "./views/Cafeteria.vue";

const routes = [
    {
        path: "/",
        name: "Cafeteria",
        component: Cafeteria,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
