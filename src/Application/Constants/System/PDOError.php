<?php

final class PDOError extends BaseError
{
    const INVALID_FORMAT = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'Formato de retorno incompátivel com o esperado.',
        LanguageIdentifier::ENGLISH => 'Return format incompatible with expectations.'
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