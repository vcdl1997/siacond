<?php

abstract class Rule
{ 
    const NOT_DEFINED = [
        LanguageIdentifier::ENGLISH => 'The rule being searched for was not found.',
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'A regra que está sendo buscada não foi encontrada.'
    ];

    protected static function getLanguage() :string
    {
    	return getenv('LANGUAGE');
    }

    protected static function formatMessage(string $message) :string
    {
    	return Text::removeLineBreaks($message);
    }

    protected static function getMessageByConstant(string $rule) :string
    {
        $language = self::getLanguage();

        if (!defined($rule)) {
            throw new NotFoundException(self::NOT_DEFINED[$language]);
        }

        return self::formatMessage(constant($rule)[$language]); 
    }
}