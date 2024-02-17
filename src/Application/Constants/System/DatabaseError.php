<?php

final class DatabaseError extends BaseError
{
    const UNSUCCESSFUL_INSERT = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'Erro ao salvar o registro ',
        LanguageIdentifier::ENGLISH => 'Error saving record '
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