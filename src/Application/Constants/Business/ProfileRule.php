<?php

final class ProfileRule extends Rule
{
    const MAXIMUM_SIZE_DESCRIPTION = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => "
            O campo descrição deve conter no mínimo " . Profile::MINIMUM_SIZE_DESCRIPTION . " caractere 
            e no máximo " . Profile::MAXIMUM_SIZE_DESCRIPTION . " caracteres.
        ",
        LanguageIdentifier::ENGLISH => "
            The description field must contain a minimum of " . Profile::MINIMUM_SIZE_DESCRIPTION . " character 
            and a maximum of " . Profile::MAXIMUM_SIZE_DESCRIPTION . " characters.
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