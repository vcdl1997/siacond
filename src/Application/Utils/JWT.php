<?php

final class JWT
{
    const HEADER = 0;
    const PAYLOAD = 1;
    const SIGNATURE = 2;
 
    public static function encode(array $payload): string
    {
        $secret = getenv('JWT_SECRET');
        $header = json_encode([
            "alg" => "HS256",
            "typ" => "JWT"
        ]);
 
        $payload = json_encode($payload);
     
        $header_payload = self::base64url_encode($header) . '.'. self::base64url_encode($payload);
 
        $signature = hash_hmac('sha256', $header_payload, $secret, true);
         
        return self::base64url_encode($header) . '.' . self::base64url_encode($payload) . '.' . self::base64url_encode($signature);
    }
 
    public static function decode(string $token): array
    {
        $secret = getenv('JWT_SECRET');
        $token = explode('.', $token);
        $header = self::base64_decode_url($token[self::HEADER]);
        $payload = self::base64_decode_url($token[self::PAYLOAD]);
        $signature = self::base64_decode_url($token[self::SIGNATURE]);
 
        $header_payload = $token[self::HEADER] . '.' . $token[self::PAYLOAD];
 
        if (hash_hmac('sha256', $header_payload, $secret, true) !== $signature) {
            throw new SignatureException(JWTError::getMessage('INVALID_SIGNATURE'));
        }

        return json_decode($payload, true);
    }

    private static function base64url_encode($data)
    {
        return str_replace(['+','/','='], ['-','_',''], base64_encode($data));
    }
 
    private static function base64_decode_url($string) 
    {
        return base64_decode(str_replace(['-','_'], ['+','/'], $string));
    }
}