import { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
  {
    path: '/',
    component: () => import('layouts/MainLayout.vue'),
    children: [
      { path: '', component: () => import('pages/IndexPage.vue') },
      { path: 'personas', component: () => import('pages/PersonasPage.vue') },
      { path: 'create', component: () => import('pages/PersonaCreatePage.vue') }
    ],
  },
  // Ruta para 404 si es necesario
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/Error404.vue'),
  },
];

export default routes;
