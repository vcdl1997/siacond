import { Component, Input } from '@angular/core';
import { Router } from '@angular/router';
import { Condominium } from 'src/app/data/schema/condominium';
import { CondominiumService } from 'src/app/data/service/condominium-service.service';
import { environment } from 'src/environments/environment.development';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-select-condominium',
  templateUrl: './select-condominium.component.html',
  styleUrls: ['./select-condominium.component.css']
})
export class SelectCondominiumComponent {

  private readonly router: Router;

  @Input() private _authorization: any;
  private _list: Condominium[] = [];
  private _loading: boolean = true;

  constructor(
    router :Router,
    condominiumService: CondominiumService
  ) {
    this.router = router;
    this.getAll(condominiumService);
  }

  public get authorization() {
    return this._authorization;
  }

  public set authorization(authorization) {
    this._authorization = authorization;
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
    condominiumService.getAll()
      .then((response:any) => {
        this._list = response.data;
        this._loading = false;
      })
      .catch(err => {
        const {data, status} = err.response;
        Swal.fire({ icon: "error", title: "Oops...", text: data.message });
      })
    ;
  }

  public isEmpty() :boolean {
    return this._list.length == 0;
  }

  public redirectHome(condominiumId: number) :void {
    this.router.navigate([`/condominio/${condominiumId}`]);
  }
}
