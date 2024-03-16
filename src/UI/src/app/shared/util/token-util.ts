export class TokenUtil {

  static tokenExists() :boolean
  {
    return localStorage.getItem('bearerToken') != null;
  }

  static getToken()
  {
    return localStorage.getItem('bearerToken');
  }

  static removeToken()
  {
    return localStorage.removeItem('bearerToken');
  }

  static storeToken(bearerToken: string) :void
  {
    localStorage.setItem('bearerToken', bearerToken);
  }
}
