<?php

final class JWTError extends BaseError
{
    const INVALID_SIGNATURE = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'A assinatura do token é inválida.',
        LanguageIdentifier::ENGLISH => 'Token signature is invalid.'
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