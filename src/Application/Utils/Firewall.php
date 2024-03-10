<?php

final class Firewall
{
    const BLACKLIST = "blacklist";
    const PRIMARY_SOURCE = "https://www.dan.me.uk/torlist/?full";
    const SECONDARY_SOURCE = "https://raw.githubusercontent.com/SecOps-Institute/Tor-IP-Addresses/master/tor-exit-nodes.lst";

    private static function getClientIp() :string
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    private static function getIpsPrimarySource() :array
    {
        try{
            return explode("\n", @file_get_contents(self::PRIMARY_SOURCE));
        }catch(Exception $e){
            return [];
        }
    }

    private static function getIpsSecondarySource() :array
    {
        try{
            return explode("\n", @file_get_contents(self::SECONDARY_SOURCE));
        }catch(Exception $e){
            return [];
        }
    }

    private static function getIpsBlacklist() :array
    {
        $updatedFilePath = getcwd() . DIRECTORY_SEPARATOR . self::BLACKLIST . '_' . date('Y-m-d') . '.txt';
        $outdatedFilePath = getcwd() . DIRECTORY_SEPARATOR . self::BLACKLIST . '_' . date("Y-m-d", strtotime("-1 day")) . '.txt';
        $fileExists = file_exists($updatedFilePath);

        if(!$fileExists){
            $arrIps = array_unique(array_merge(self::getIpsPrimarySource(), self::getIpsSecondarySource()));
            array_map('unlink', glob(getcwd() . DIRECTORY_SEPARATOR . self::BLACKLIST . '_*.txt'));
            $newBlacklist = fopen(self::BLACKLIST . '_' . date('Y-m-d') . '.txt','w');
            fwrite($newBlacklist, implode("\n",  $arrIps));
        }

        return explode("\n", file_get_contents($updatedFilePath));
    }

    public static function execute() :void
    {
        $clientIp = self::getClientIp();
        $blacklist = self::getIpsBlacklist();

        if(in_array($clientIp, $blacklist)){
            throw new RuntimeException(IpBlockedError::getMessage('ACCESS_BLOCKED'));
        }
    }
}