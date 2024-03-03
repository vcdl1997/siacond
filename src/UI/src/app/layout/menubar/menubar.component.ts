import { Component, Input, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { environment } from 'src/environments/environment.development';

@Component({
  selector: 'app-menubar',
  templateUrl: './menubar.component.html',
  styleUrls: ['./menubar.component.css']
})
export class MenubarComponent implements OnInit {

  private readonly router: Router;

  menu = environment.menu.employee;

  @Input() showOptionsMenu = false;

  constructor(
    router :Router
  ) {
    this.router = router;
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
