<?php

final class ViewError extends BaseError
{
    const NOT_FOUND = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'Não foi possível encontrar a página de visualização informada.',
        LanguageIdentifier::ENGLISH => 'Unable to find the reported preview page.'
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