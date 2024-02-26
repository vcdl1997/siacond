<?php

final class JSONError extends BaseError
{
    const UNSUCCESSFUL_DECODING = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'Erro ao decodificar string JSON.',
        LanguageIdentifier::ENGLISH => 'Error decoding JSON string.'
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