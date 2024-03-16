import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { PublicRoutes } from 'src/app/core/enums/PublicRoutes';
import { Login } from '../schema/login';
import { BaseService } from './base-service';
import { Router } from '@angular/router';
import axios from 'axios';

@Injectable({
  providedIn: 'root'
})
export class AuthService extends BaseService{

  constructor(
    http : HttpClient,
    router :Router
  ) {
    super(http, router);
  }

  public login(login: Login) :Promise<Object>
  {
    return axios.post(`${this.getBaseUrlApi()}/${PublicRoutes.LOGIN}`, login, this.getHttpHeaders());
  }
}
