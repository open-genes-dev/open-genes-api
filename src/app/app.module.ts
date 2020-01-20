import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { APP_ROUTES, ROUTER_OPTIONS } from './app-routing';
import { HttpClientModule } from '@angular/common/http';

import { AppComponent } from './app.component';

// import ngx-translate and the http loader
import { TranslateLoader, TranslateModule, TranslateService } from '@ngx-translate/core';
import { TranslateHttpLoader } from '@ngx-translate/http-loader';
import { HttpClient } from '@angular/common/http';
import { HeaderComponent } from './components/header/header.component';
import { FooterComponent } from './components/footer/footer.component';
import { LanguageComponent } from './modules/language/language.component';
import { BurgerMenuComponent } from './components/burger-menu/burger-menu.component';
import {MenuModule} from './components/context-menu/app-menu.module';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    LanguageComponent,
    BurgerMenuComponent
  ],
  imports: [
    BrowserModule,
    RouterModule.forRoot(APP_ROUTES, ROUTER_OPTIONS),
    HttpClientModule,
    // ngx-translate and the loader module
    TranslateModule.forRoot({
      loader: {
        provide: TranslateLoader,
        useFactory: HttpLoaderFactory,
        deps: [HttpClient]
      }
    }),
    MenuModule
  ],
  providers: [TranslateService],
  exports: [
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }

// required for AOT compilation
export function HttpLoaderFactory(http: HttpClient) {
  return new TranslateHttpLoader(http);
}
