<?php

final class RouteError extends BaseError
{
    const NOT_FOUND = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'A rota informada não foi encontrada.',
        LanguageIdentifier::ENGLISH => 'The given route was not found.'
    ];

    const INVALID_HTTP_VERB = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'O verbo HTTP é Inválido.',
        LanguageIdentifier::ENGLISH => 'The HTTP verb is Invalid.'
    ];

    const RECOVER_DATA = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'Erro ao recuperar dados.',
        LanguageIdentifier::ENGLISH => 'Error when recovering data.'
    ];

    const NUMBER_OF_INVALID_PATH_PARAMETERS = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'O número de parâmetros informados no path é diferente do que foi declarado.',
        LanguageIdentifier::ENGLISH => 'The number of parameters informed in the path is different from what was declared.'
    ];

    const UNDECLARED_FUNCTION = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'A função informada não foi declarada no controlador.',
        LanguageIdentifier::ENGLISH => 'The specified function was not declared in the controller.'
    ];

    const INVALID_PROCESSING = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'Erro ao processar solicitação.',
        LanguageIdentifier::ENGLISH => 'Error processing request.'
    ];

    public static function getMessage(string $constant) :string
    {  
        try{
            $language = Environment::getLanguage();
            $constant_reflex = new \ReflectionClassConstant(get_class(), $constant);

            return self::formatMessage($constant_reflex->getValue()[$language]); 
        }catch(ReflectionException $e){
            throw new NotFoundException(self::NOT_DEFINED[$language]);
        }
    }
}