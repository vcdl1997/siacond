<?php

final class PersonRule extends Rule
{
    const INVALID_FIRSTNAME = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => "O valor informado no campo “primeiro nome” deve ter no mínimo 3 e no máximo 100 caracteres.",
        LanguageIdentifier::ENGLISH => "The value entered in the “first name” field must have a minimum of 3 and a maximum of 100 characters."
    ];

    const INVALID_LASTNAME = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => "O valor informado no campo “sobrenome” deve ter no mínimo 3 e no máximo 200 caracteres.",
        LanguageIdentifier::ENGLISH => "The value entered in the “surname” field must have a minimum of 3 and a maximum of 200 characters."
    ];

    const INVALID_BIRTHDATE = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => "
            O valor informado no campo “data de nascimento” deve estar no formato “YYYY-MM-DD” e deve ser uma data válida.
        ",
        LanguageIdentifier::ENGLISH => "
            The value entered in the “date of birth” field must be in the format “YYYY-MM-DD” and must be a valid date.
        "
    ];

    const INVALID_USER = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => "Não foi possível mesclar os dados de usuário e pessoa.",
        LanguageIdentifier::ENGLISH => "Unable to merge user and person data.",
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