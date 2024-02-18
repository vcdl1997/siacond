<?php

final class PersonRule extends Rule
{
    const INVALID_FIRSTNAME = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => "
            O valor informado no campo “primeiro nome” deve ter no mínimo " . PersonBase::MINIMUM_SIZE_FIRSTNAME . " 
            e no máximo " . PersonBase::MAXIMUM_SIZE_FIRSTNAME . " caracteres.
        ",
        LanguageIdentifier::ENGLISH => "
            The value entered in the “first name” field must have a minimum of " . PersonBase::MINIMUM_SIZE_FIRSTNAME . " 
            and a maximum of " . PersonBase::MAXIMUM_SIZE_FIRSTNAME . " characters.
        "
    ];

    const INVALID_LASTNAME = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => "
            O valor informado no campo “sobrenome” deve ter no mínimo " . PersonBase::MINIMUM_SIZE_LASTNAME . " 
            e no máximo " . PersonBase::MAXIMUM_SIZE_LASTNAME . "  caracteres.
        ",
        LanguageIdentifier::ENGLISH => "
            The value entered in the “surname” field must have a minimum of " . PersonBase::MINIMUM_SIZE_LASTNAME . " 
            and a maximum of " . PersonBase::MAXIMUM_SIZE_LASTNAME . " characters.
        "
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

    const INVALID_PERSON_TYPE = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => "Só é possível a realização de cadastros de moradores e funcionários.",
        LanguageIdentifier::ENGLISH => "It is only possible to register residents and employees.",
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