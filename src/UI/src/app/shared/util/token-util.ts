export class TokenUtil {

  tokenExists() :boolean
  {
    return localStorage.getItem('bearerToken') != null;
  }

  getToken(bearerToken: string)
  {
    return localStorage.getItem('bearerToken');
  }

  storeToken(bearerToken: string) :void
  {
    localStorage.setItem('bearerToken', bearerToken);
  }
}
