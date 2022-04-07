<?php

namespace App\Libraries;

class Marvel
{
    public static function getClientParams(): string
    {
        return "apiKey=" . Marvel::getPublicKey();
    }

    public static function getServerParams(): string
    {
        $timestamp = Marvel::getTimestamp();
        $params = "ts=" . $timestamp
            . "&apiKey=" . Marvel::getPublicKey()
            . "&hash=" . Marvel::getHash($timestamp);
        return $params;
    }

    private static function getTimestamp(): string
    {
        return now()->getTimestamp();
    }

    private static function getHash(string $timestamp): string
    {
        $stringToHash = $timestamp . Marvel::getPrivateKey() . Marvel::getPublicKey();
        return md5($stringToHash);
    }

    private static function getPublicKey(): string
    {
        return config('services.marvel.key');
    }

    private static function getPrivateKey(): string
    {
        return config('services.marvel.secret');
    }

}
