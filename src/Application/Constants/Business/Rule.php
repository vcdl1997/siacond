<?php

abstract class Rule
{ 
    const NOT_DEFINED = [
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'A regra que está sendo buscada não foi encontrada.',
        LanguageIdentifier::ENGLISH => 'The rule being searched for was not found.'
    ];

    protected static function getLanguage() :string
    {
    	return getenv('LANGUAGE');
    }

    protected static function formatMessage(string $message) :string
    {
    	return Text::removeLineBreaks($message);
    }
}