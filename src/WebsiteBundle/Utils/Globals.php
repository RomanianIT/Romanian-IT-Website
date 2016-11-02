<?php

namespace WebsiteBundle\Utils;

class Globals

{
    protected static $gedDir;
    protected static $documentDir;
    protected static $publicDir;

    public static function setGedDir($dir)
    {
        self::$gedDir = $dir;
    }

    public static function getGedDir()
    {
        return self::$gedDir;
    }

    public static function setDocumentDir($dir)
    {
        self::$documentDir = $dir;
    }

    public static function getDocumentDir()
    {
        return self::$documentDir;
    }

    public static function setPublicDir($dir)
    {
        self::$publicDir = $dir;
    }

    public static function getPublicDir()
    {
        return self::$publicDir;
    }
}
