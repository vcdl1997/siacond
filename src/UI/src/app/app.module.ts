import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import {HttpClientModule} from '@angular/common/http';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { AuthComponent } from './modules/auth/auth.component';
import { SelectCondominiumComponent } from './modules/select-condominium/select-condominium.component';
import { FormsModule } from '@angular/forms';
import { NgFor, NgIf } from '@angular/common';
import { HomeComponent } from './modules/home/home.component';
import { MenubarComponent } from './layout/menubar/menubar.component';
import { MessageComponent } from './shared/components/message/message.component';

@NgModule({
  declarations: [
    AppComponent,
    AuthComponent,
    SelectCondominiumComponent,
    HomeComponent,
    MenubarComponent,
    MessageComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule,
    FormsModule,
    NgIf,
    NgFor,
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
