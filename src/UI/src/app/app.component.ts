import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { TokenUtil } from './shared/util/token-util';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
})
export class AppComponent {

  constructor(router:Router) {
    this.redirectsIfAlreadyLoggedIn(router);
  }

  private redirectsIfAlreadyLoggedIn(router: Router) :void
  {
    if(!TokenUtil.tokenExists()){
      router.navigate(['/login']);
    }else{
      router.navigate(['/selecionar-condominio']);
    }
  }
}
