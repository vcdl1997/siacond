import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { AuthComponent } from './modules/auth/auth.component';
import { SelectCondominiumComponent } from './modules/select-condominium/select-condominium.component';
import { LoggedOutGuard } from './core/guards/logged-out.guard';
import { LoggedGuard } from './core/guards/logged.guard';
import { HomeComponent } from './modules/home/home.component';

const routes: Routes = [
  {
    path: 'login',
    component: AuthComponent,
    canActivate: [LoggedOutGuard]
  },
  {
    path: 'selecionar-condominio',
    component: SelectCondominiumComponent,
    canActivate: [LoggedGuard]
  },
  {
    path: 'condominio/:id',
    component: HomeComponent,
    canActivate: [LoggedGuard]
  }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }



