<?php

namespace App\Services;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Illuminate\Support\Facades\Crypt;
class EncryptionService
{
    // Define your passphrase (you might want to store it in your .env file)
    private $passphrase = "Testingxxx";
    static public function encrypt($data)
    {
        return Crypt::encryptString($data);
    }

    static public function decrypt($encryptedData)
    {
        return Crypt::decryptString($encryptedData);
    }
}
