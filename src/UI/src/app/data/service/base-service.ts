import { HttpClient, HttpHeaders } from "@angular/common/http";
import { Router } from "@angular/router";
import axios from "axios";
import { Observable } from "rxjs";
import { PrivateRoutes } from "src/app/core/enums/PrivateRoutes";
import { TokenUtil } from "src/app/shared/util/token-util";

export abstract class BaseService {

    constructor(
      protected http : HttpClient,
      protected router :Router
    ) {
    }

    protected getBaseUrlApi(): string{
        let baseUrlApi = window.location.origin;

        baseUrlApi = baseUrlApi == "http://localhost:4200" ? "http://localhost:8888" : baseUrlApi;

        return `${baseUrlApi}/api`
    }

    protected getHttpHeaders() :object{
      return {
          headers: {
            "Authorization": `Bearer ${TokenUtil.getToken()}`
          }
      };
    }

    protected renewToken(callback: any) :Promise<Object>{
      return axios
        .post(`${this.getBaseUrlApi()}/${PrivateRoutes.TOKENS}`, {}, this.getHttpHeaders())
        .then((response :any)=> {
          TokenUtil.storeToken(response.data.token);
          return callback();
        })
        .catch(err => {
          TokenUtil.removeToken();
          this.router.navigate([`/login`]);
        })
      ;
    }
}
