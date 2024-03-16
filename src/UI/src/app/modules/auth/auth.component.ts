import { AuthService } from './../../data/service/auth-service.service';
import { Component } from '@angular/core';
import { NgForm } from '@angular/forms';
import { Router } from '@angular/router';
import { Person } from 'src/app/core/enums/Person';
import { Login } from 'src/app/data/schema/login';
import { TokenUtil } from 'src/app/shared/util/token-util';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-auth',
  templateUrl: './auth.component.html',
  styleUrls: ['./auth.component.css']
})
export class AuthComponent {

  private readonly authService: AuthService;
  private readonly router: Router;
  private login: Login = {
    'username': '',
    'password': '',
    'typeOfPerson': ''
  };

  constructor(
    authService: AuthService,
    router :Router,
  ){
    this.authService = authService;
    this.router = router;
    this.redirectsIfAlreadyLoggedIn();
  }

  onSubmit(form: NgForm) {
    const {username, password} = form.value;

    this.login.username = username;
    this.login.password = password;

    if(!this.validateTypeOfPerson(this.login.typeOfPerson)){
      Swal.fire({ icon: "error", title: "Oops...", text: "Informe o Tipo do Usuário!" });
      return;
    }

    if(!this.validateUsername(username) || !this.validatePassword(password)){
      Swal.fire({ icon: "error", title: "Oops...", text: "Usuário ou Senha Inválidos!" });
      return;
    }

    this.authService.login(this.login)
      .then((response:any) => {
        const {token} = response.data;
        TokenUtil.storeToken(token);
        this.router.navigate(['/selecionar-condominio']);
      })
      .catch(err => {
        const {data, status} = err.response;
        Swal.fire({ icon: "error", title: "Oops...", text: data.message });
        return;
      })
    ;
  }

  setTypeOfPerson(typeOfPerson: string) :void {
    this.login.typeOfPerson = typeOfPerson;
  }

  private validateTypeOfPerson(typeOfPerson: string) :boolean
  {
    const options: Array<String> = [
      Person.RESIDENT,
      Person.EMPLOYEE
    ];

    return typeOfPerson.length > 0 && options.indexOf(typeOfPerson) > -1;
  }

  private validateUsername(username: string) :boolean
  {
    return username.length >= 3 &&  username.length <= 320;
  }

  private validatePassword(password: string) :boolean
  {
    const allowedSize = password.length >= 8 &&  password.length <= 100;
    const containsLetters = new RegExp(/[a-zA-Z]+/).test(password);
    const containsNumbers = new RegExp(/\d/).test(password);
    const containsSpecialCharacters = new RegExp(/[`!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?~]/).test(password);

    return allowedSize && containsLetters && containsNumbers && containsSpecialCharacters;
  }

  private redirectsIfAlreadyLoggedIn() :void
  {
    if(TokenUtil.tokenExists()){
      this.router.navigate(['/selecionar-condominio']);
    }
  }
}
