import { createRouter, createWebHistory } from 'vue-router';
import TaskIndex from '../../Components/TaskIndex.vue';
import TaskCreate from '../../Components/TaskCreate.vue';
import TaskEdit from '../../Components/TaskEdit.vue';
import Dashboard from '../Pages/Dashboard.vue';

const routes = [
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard,
  },  
  {
    path: '/tasks',
    name: 'taskIndex',
    component: () => import('../Pages/Tasks/Index.vue'),
  },
  {
    path: '/tasks/create',
    name: 'taskCreate',
    component: () => import('../Pages/Tasks/Create.vue'),
  },
  {
    path: '/tasks/edit/:id',
    name: 'taskEdit',
    component: () => import('../Pages/Tasks/Edit.vue'),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
