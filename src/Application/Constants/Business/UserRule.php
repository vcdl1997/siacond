<?php

final class UserRule extends Rule
{
    const INVALID_PASSWORD = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => "
            A senha do usuário deve ter no mínimo 12 e no máximo 100 caracteres, 
            a mesma deve ser composta por letras, números e caracteres especiais, 
            sendo possíveis utilizar os seguintes: `!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?~."
        ,
        LanguageIdentifier::ENGLISH => "
            The user's password must have a minimum of 12 and a maximum of 100 characters, 
            it must be composed of letters, numbers and special characters, 
            and the following can be used: `!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?~.
        "
    ];

    public static function getMessage(string $constant) :string
    {  
        try{
            $language = self::getLanguage();
            $constant_reflex = new \ReflectionClassConstant(get_class(), $constant);

            return self::formatMessage($constant_reflex->getValue()[$language]); 
        }catch(ReflectionException $e){
            throw new NotFoundException(self::NOT_DEFINED[$language]);
        }
    }
}