import AboutPage from '../pages/AboutPage.vue';
import CollectionPage from '../pages/ClassificationPage.vue';
import EntityPage from '../pages/EntityPage.vue';
import EntitiesPage from '../pages/EntitiesPage.vue';
import FacetsPage from '../pages/FacetsPage.vue';
import ApproachesPage from '../pages/ApproachesPage.vue';

export const routes = [
    { path: '/app', component: AboutPage, name: 'about' },
    { path: '/app/classificacoes/:classification', component: CollectionPage, name: 'classificacoes' },
    { path: '/app/abordagens', component: ApproachesPage, name: 'abordagens' },
    { path: '/app/classificacoes/:classification/facetas', component: FacetsPage, name: 'classificacoes_facetas'},
    { path: '/app/classificacoes/:classification/entidades', component: EntitiesPage, name: 'classificacoes_entidades' },
    { path: '/app/classificacoes/:classification/entidades/:entity', component: EntityPage, name: 'classificacoes_entidade' }
];
