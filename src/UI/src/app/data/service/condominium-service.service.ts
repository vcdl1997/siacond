import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { PublicRoutes } from 'src/app/core/enums/PublicRoutes';
import { Login } from '../schema/login';
import { BaseService } from './base-service';
import { PrivateRoutes } from 'src/app/core/enums/PrivateRoutes';

@Injectable({
  providedIn: 'root'
})
export class CondominiumService extends BaseService{

  constructor(private http : HttpClient) {
    super(); 
  }

  public getAll() :Observable<Object>
  {
    let headers_object = new HttpHeaders();
    headers_object.append("Access-Control-Allow-Origin", "*");
    headers_object.append("Access-Control-Allow-Method", "POST, GET, DELETE, PUT, PATCH, OPTIONS");
    headers_object.append("Access-Control-Allow-Headers", "*");

    const httpOptions = {
      headers: headers_object
    };

    return this.http.get(`${this.getBaseUrlApi()}/${PrivateRoutes.LIST_ALL_CONDOMINIUMS}`, httpOptions);
  }
}
