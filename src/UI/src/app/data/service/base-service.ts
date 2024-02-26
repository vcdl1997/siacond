export abstract class BaseService {
    
    constructor() {
    }

    protected getBaseUrlApi(): string{
        let baseUrlApi = window.location.origin;

        baseUrlApi = baseUrlApi == "http://localhost:4200" ? "http://localhost:8888" : baseUrlApi;

        return `${baseUrlApi}/api`
    }
}