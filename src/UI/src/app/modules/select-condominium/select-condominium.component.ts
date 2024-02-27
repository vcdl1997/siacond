import { Component } from '@angular/core';
import { Condominium } from 'src/app/data/schema/condominium';
import { CondominiumService } from 'src/app/data/service/condominium-service.service';
import { environment } from 'src/environments/environment.development';

@Component({
  selector: 'app-select-condominium',
  templateUrl: './select-condominium.component.html',
  styleUrls: ['./select-condominium.component.css']
})
export class SelectCondominiumComponent {

  private _list: Condominium[] = [];

  constructor(
    condominiumService: CondominiumService
  ){
    this.getAll(condominiumService);
  }

  public get list()
  {
    return this._list;
  }

  public set list(list)
  {
    this._list = list;
  }

  public getAll(condominiumService: CondominiumService)
  {
    condominiumService.getAll().subscribe((response: any) => {
      this._list = response;
    },
    (err) => {
      console.log(err);
    });
  }

  public isEmpty() :boolean
  {
    return this._list.length == 0;
  }
}
