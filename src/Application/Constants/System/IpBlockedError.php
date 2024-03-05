<?php

final class IpBlockedError extends BaseError
{
    const ACCESS_BLOCKED = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'IP com restrições de acesso.',
        LanguageIdentifier::ENGLISH => 'IP with access restrictions.'
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