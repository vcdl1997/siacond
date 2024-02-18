<?php

final class UserRule extends Rule
{
    const USERNAME_IN_USE = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => "O valor informado no campo “usuário” já está sendo utilizado.",
        LanguageIdentifier::ENGLISH => "The value entered in the “user” field is already being used."
    ];

    const INVALID_USERNAME = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => "
            O valor informado no campo “usuário” deve ter no mínimo " . User::MINIMUM_SIZE_USERNAME . " 
            e no máximo " . User::MAXIMUM_SIZE_USERNAME . " caracteres.
        ",
        LanguageIdentifier::ENGLISH => "
            The value entered in the “user” field must have a minimum of " . User::MINIMUM_SIZE_USERNAME . " 
            and a maximum of " . User::MAXIMUM_SIZE_USERNAME . " characters.
        "
    ];

    const INVALID_PASSWORD = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => "
            O valor informado no campo “senha” deve ter no mínimo " . User::MINIMUM_SIZE_PASSWORD . " 
            e no máximo " . User::MAXIMUM_SIZE_PASSWORD . " caracteres, a mesma deve ser composta por letras, números e caracteres especiais, 
            sendo possíveis utilizar os seguintes: `!@#$%^&*()_+\-=\[\]{};':\"\\|,.<>\/?~.
        ",
        LanguageIdentifier::ENGLISH => "
            The value entered in the “password” field must have a minimum of " . User::MINIMUM_SIZE_PASSWORD . " 
            and a maximum of " . User::MAXIMUM_SIZE_PASSWORD . " characters, it must be composed of letters, numbers and special characters, 
            and the following can be used: `!@#$%^&*()_ +\-=\[\]{};':\"\\|,.<>\/?~.
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