import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { PublicRoutes } from 'src/app/core/enums/PublicRoutes';
import { environment } from 'src/environments/environment.development';
import { Login } from '../schema/login';

@Injectable({
  providedIn: 'root'
})
export class AuthService {

  constructor(private http : HttpClient) {
  }

  public login(login: Login) :Observable<Object>
  {
    let headers_object = new HttpHeaders();
    headers_object.append('Content-Type', 'application/json');
    headers_object.append("Access-Control-Allow-Origin", "*");

    const httpOptions = {
      headers: headers_object
    };

    return this.http.post(`${environment.baseUrl}/${PublicRoutes.LOGIN}`, login, httpOptions);
  }
}
