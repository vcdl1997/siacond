<?php

abstract class BaseError
{ 
    const NOT_DEFINED = [
        LanguageIdentifier::ENGLISH => 'The error message being fetched was not found.',
        LanguageIdentifier::PORTUGUESE_BRAZIL => 'A mensagem de erro que está sendo buscada não foi encontrada.'
    ];

    protected static function formatMessage(string $message) :string
    {
    	return Text::removeLineBreaks($message);
    }
}