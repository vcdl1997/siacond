import { CanActivateFn } from '@angular/router';
import { TokenUtil } from 'src/app/shared/util/token-util';

export const LoggedOutGuard: CanActivateFn = (route, state) => {
  const tokenUtil = new TokenUtil();
  return !tokenUtil.tokenExists();
};
