import AboutPage from '../pages/AboutPage.vue';
import CollectionPage from '../pages/CollectionPage.vue';
import EntityPage from '../pages/EntityPage.vue';
import EntitiesPage from '../pages/EntitiesPage.vue';
import FacetsPage from '../pages/FacetsPage.vue';

export const routes = [
    { path: '/app', component: AboutPage, name: 'about' },
    { path: '/app/colecoes/:collection', component: CollectionPage, name: 'colecoes' },
    { path: '/app/colecoes/:collection/facetas', component: FacetsPage, name: 'colecoes_facetas'},
    { path: '/app/colecoes/:collection/entidades', component: EntitiesPage, name: 'colecoes_entidades' },
    { path: '/app/colecoes/:collection/entidades/:entity', component: EntityPage, name: 'colecoes_entidade' }
];
