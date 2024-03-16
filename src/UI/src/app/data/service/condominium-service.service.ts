import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { PublicRoutes } from 'src/app/core/enums/PublicRoutes';
import { Login } from '../schema/login';
import { BaseService } from './base-service';
import { PrivateRoutes } from 'src/app/core/enums/PrivateRoutes';
import { Router } from '@angular/router';
import axios from 'axios';

@Injectable({
  providedIn: 'root'
})
export class CondominiumService extends BaseService{

  constructor(
    http : HttpClient,
    router :Router
  ) {
    super(http, router);
  }

  public getAll() :Promise<Object>
  {
    return this.renewToken(() => {
      return axios.get(`${this.getBaseUrlApi()}/${PrivateRoutes.LIST_ALL_CONDOMINIUMS}`, this.getHttpHeaders());
    });
  }
}
