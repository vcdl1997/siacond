import { Component } from '@angular/core';
import { Condominium } from 'src/app/data/schema/condominium';
import { CondominiumService } from 'src/app/data/service/condominium-service.service';

@Component({
  selector: 'app-select-condominium',
  templateUrl: './select-condominium.component.html',
  styleUrls: ['./select-condominium.component.css']
})
export class SelectCondominiumComponent {

  private _list: Condominium[] = [
    {
      id: 1,
      fantasyName: 'string',
      logo: 'string'
    },
    {
      id: 1,
      fantasyName: 'string',
      logo: 'string'
    },
    {
      id: 1,
      fantasyName: 'string',
      logo: 'string'
    },
    {
      id: 1,
      fantasyName: 'string',
      logo: 'string'
    },
    {
      id: 1,
      fantasyName: 'string',
      logo: 'string'
    },
    {
      id: 1,
      fantasyName: 'string',
      logo: 'string'
    },
    {
      id: 1,
      fantasyName: 'string',
      logo: 'string'
    },
    {
      id: 1,
      fantasyName: 'string',
      logo: 'string'
    },
    {
      id: 1,
      fantasyName: 'string',
      logo: 'string'
    },
  ];

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
    // condominiumService.getAll().subscribe((response: any) => {
    //   this._list = response;
    //   console.log(this._list);
    // },
    // (err) => {
    //   console.log(err);
    // });
  }
}
