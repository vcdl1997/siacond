<?php

final class SQLError extends BaseError
{
    const UNSUCCESSFUL_COMMAND = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'Erro ao executar comando DML.',
        LanguageIdentifier::ENGLISH => 'Error executing DML command.'
    ];

    const UNSUPPORTED_COMMAND = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'O comando DML informado não é suportado por essa função.',
        LanguageIdentifier::ENGLISH => 'The DML command provided is not supported by this function.'
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