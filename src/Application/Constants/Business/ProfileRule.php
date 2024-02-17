<?php

final class ProfileRule extends Rule
{
    const MAXIMUM_SIZE_DESCRIPTION = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'O campo descrição deve conter no mínimo 1 caractere e no máximo 1000 caracteres.',
        LanguageIdentifier::ENGLISH => 'The description field must contain a minimum of 1 character and a maximum of 1000 characters.'
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