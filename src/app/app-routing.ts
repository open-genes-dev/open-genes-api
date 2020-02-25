import {ExtraOptions, Routes} from '@angular/router';

export const APP_ROUTES: Routes = [
  {
    path: '',
    loadChildren: () => import('./pages/home/home.module').then(m => m.HomeModule)
  },
  {
    path: 'gene/:id',
    loadChildren: () => import('./pages/gene/gene.module').then(m => m.GeneModule)
  },
  {
    path: 'favorites',
    loadChildren: () => import('./pages/favorites/favorites.module').then(m => m.FavoritesModule)
  },
  {
    path: 'about',
    loadChildren: () => import('./pages/about/about.module').then(m => m.AboutModule)
  },
  {
    path: 'developers',
    loadChildren: () => import('./pages/api-reference/api-reference.module').then(m => m.ApiReferenceModule)
  },
  {
    path: '**',
    loadChildren: () => import('./pages/404/404.module').then(m => m.Error404Module)
  },
  {
    path: '**/**', redirectTo: '**'
  }
];

export const ROUTER_OPTIONS: ExtraOptions = {
  anchorScrolling: 'enabled'
};
