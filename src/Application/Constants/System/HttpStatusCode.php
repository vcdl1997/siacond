<?php

class HttpStatusCode{
    const OK = 200; // Indica que uma solicitação simples como uma consulta, foi feita com sucesso.
    const CREATED = 201; // Indica que um novo registro foi criado com sucesso.
    const ACCEPTED = 202; // Indica que a solicitação foi feita com sucesso, porém não há retorno (processamentos assincronos).
    const NO_CONTENT = 204; // Indica que a solicitação foi feita com sucesso, porém não há retorno (exclusões).
    const BAD_REQUEST = 400; // Indica que a solicitação não foi processada com sucesso (erros genéricos).
    const UNAUTHORIZED = 401; // Indica que a solicitação não foi autorizada (não autenticado).
    const FORBIDDEN = 403; // Indica que não é possível acessar o recurso por falta de privilégios.
    const NOT_FOUND = 404; // Indica que não é possível encontrar o recurso.
    const METHOD_NOT_ALLOWED = 405; // Indica que o método HTTP informado é incompátivel com a rota informada.
    const UNPROCESSABLE_ENTITY = 422; // Indica que a solicitação foi processada, porém existem erros (regras de négocio não atendidas).
    const INTERNAL_SERVER_ERROR = 500; // Indica que a solicitação não pode ser processada (erros a nível de sistema).
}