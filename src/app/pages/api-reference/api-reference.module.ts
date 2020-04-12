import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {ApiReferenceComponent} from './api-reference.component';
import {RouterModule, Routes} from '@angular/router';
import {TranslateModule} from '@ngx-translate/core';
import {CodeBlockComponent} from 'src/app/components/code-block/code-block.component';
import {PipesModule} from 'src/app/modules/pipes/pipes.module';

const routes: Routes = [
  {path: '', component: ApiReferenceComponent}
];

@NgModule({
  declarations: [ApiReferenceComponent, CodeBlockComponent],
  imports: [
    CommonModule,
    RouterModule.forChild(routes),
    TranslateModule,
    PipesModule
  ]
})
export class ApiReferenceModule {
}
