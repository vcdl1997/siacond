import { Component, Input, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { environment } from 'src/environments/environment.development';
import DisableDevtool from 'disable-devtool';
import { TokenUtil } from 'src/app/shared/util/token-util';

@Component({
  selector: 'app-menubar',
  templateUrl: './menubar.component.html',
  styleUrls: ['./menubar.component.css']
})
export class MenubarComponent implements OnInit {

  private readonly router: Router;

  profile: string = "tester";

  menu = environment.menu.employee;

  @Input() showOptionsMenu = false;

  constructor(
    router :Router
  ) {
    this.router = router;
    // DisableDevtool({
    //   ignore: () => {
    //     return this.profile === "admin";
    //   },
    //   ondevtoolopen(type, next){
    //     TokenUtil.removeToken();
    //     const body:any = document.querySelector("body");
    //     body.innerHTML = '';
    //     confirm("Foi detectado o uso da ferramenta Devtools (F12), você será desconectado do sistema.");
    //     next();
    //   }
    // });
  }

  ngOnInit(): void {
  }

  toggleClass(event: any) {
    let element = event.target;
    const isLabel = element.tagName == "LABEL";

    if(!isLabel){
      element = element.closest("label");
    }

    element.classList.toggle('focus-menu-item');
  }

  navigate(url:string){
    this.router.navigate([url]);
  }
}
