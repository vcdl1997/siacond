import { Component } from '@angular/core';
import { Router } from '@angular/router';
import { Condominium } from 'src/app/data/schema/condominium';
import { CondominiumService } from 'src/app/data/service/condominium-service.service';
import { environment } from 'src/environments/environment.development';

@Component({
  selector: 'app-select-condominium',
  templateUrl: './select-condominium.component.html',
  styleUrls: ['./select-condominium.component.css']
})
export class SelectCondominiumComponent {

  private readonly router: Router;
  private _list: Condominium[] = [];
  private _loading: boolean = true;

  constructor(
    router :Router,
    condominiumService: CondominiumService
  ) {
    this.router = router;
    this.getAll(condominiumService);
  }

  public get list() {
    return this._list;
  }

  public set list(list) {
    this._list = list;
  }

  public get loading() {
    return this._loading;
  }

  public set loading(loading) {
    this._loading = loading;
  }

  public getAll(condominiumService: CondominiumService) {
    condominiumService.getAll().subscribe((response: any) => {
      this._list = response;
      this._loading = false;
    },
    (err: any) => {
      this._list = [
        {
          id: 1,
          fantasyName: "Marina Park",
          logo: environment.image_test
        }
      ];
      this._loading = false;
    });
  }

  public isEmpty() :boolean {
    return this._list.length == 0;
  }

  public redirectHome(condominiumId: number) :void {
    this.router.navigate([`/condominio/${condominiumId}`]);
  }
}
