<?php

final class SQLError extends BaseError
{
    const UNSUCCESSFUL_INSERT = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'Erro ao salvar o registro ',
        LanguageIdentifier::ENGLISH => 'Error saving record '
    ];

    const UNSUPPORTED_COMMAND = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'O comando DML informado não é suportado por essa função.',
        LanguageIdentifier::ENGLISH => 'The DML command provided is not supported by this function.'
    ];

    const EMPTY_TABLE_NAME = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'O nome da tabela não foi informado na classe.',
        LanguageIdentifier::ENGLISH => 'The table name was not provided in the class.'
    ];

    const THERE_ARE_NO_MANIPULABLE_FIELDS = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => "
            Não há campos manipulaveis para as operações: “Insert” ou “Update” ou “Delete”. 
            Verifique o que está sendo retornado nas funções “getPrimaryKey”, “getFillable” e “getChangeable”.
        ",
        LanguageIdentifier::ENGLISH => "
            There are no manipulable fields for the operations: “Insert” or “Update” or “Delete”. 
            Check what is being returned in the “getPrimaryKey”, “getFillable” and “getChangeable” functions.
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