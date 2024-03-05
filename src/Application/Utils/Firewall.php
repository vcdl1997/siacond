<?php

final class Firewall
{
    const BLACKLIST = "blacklist.txt";
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

    private static function getIpsBlacklist() :array
    {
        $blacklistFilePath = getcwd() . DIRECTORY_SEPARATOR . self::BLACKLIST;
        $fileExists = file_exists($blacklistFilePath);
        $updateTorBlacklist = $fileExists ? date('Y-m-d', filectime($blacklistFilePath)) !== date('Y-m-d') : true;

        if($updateTorBlacklist){
            $ipsPrimarySource = file_get_contents(self::PRIMARY_SOURCE);
            $ipsSecondarySource = file_get_contents(self::SECONDARY_SOURCE);
            $arrIpsPrimarySource = explode("\n", $ipsPrimarySource);
            $arrIpsSecondarySource = explode("\n", $ipsSecondarySource);

            if($fileExists){
                unlink($blacklistFilePath);
            }
            
            $newBlacklist = fopen(self::BLACKLIST,'w');
            fwrite($newBlacklist, implode("\n", array_unique(array_merge($arrIpsPrimarySource, $arrIpsSecondarySource))));
        }

        return explode("\n", file_get_contents($blacklistFilePath));
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