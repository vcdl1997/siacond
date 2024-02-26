export class TokenUtil {

  static tokenExists() :boolean
  {
    return localStorage.getItem('bearerToken') != null;
  }

  static getToken(bearerToken: string)
  {
    return localStorage.getItem('bearerToken');
  }

  static storeToken(bearerToken: string) :void
  {
    localStorage.setItem('bearerToken', bearerToken);
  }
}
