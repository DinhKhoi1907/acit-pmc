<?php
namespace App\Payment\Utils;

// use App\Payment\Crypt\Crypt_RSA;
// dd(ROOT_PATH . DS . 'Crypt/RSA.php');
include(ROOT_PATH . DS . 'Crypt/RSA.php');
use App\Payment\Crypt;

class AlepayUtils
{
    public function encryptData($data, $publicKey)
    {
        $rsa = new Crypt\Crypt_RSA();
        $rsa->loadKey($publicKey); // public key
        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $output = $rsa->encrypt($data);
        return base64_encode($output);
    }

    public function decryptData($data, $publicKey)
    {
        $rsa = new Crypt\Crypt_RSA();
        $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
        $ciphertext = base64_decode($data);
        $rsa->loadKey($publicKey); // public key
        $output = $rsa->decrypt($ciphertext);
        // $output = $rsa->decrypt($data);
        return $output;
    }

    public function decryptCallbackData($data, $publicKey)
    {
        $decoded = base64_decode($data);
        return $this->decryptData($decoded, $publicKey);
    }

    public function makeSignature($data, $hash_key)
    {
        $hash_data = '';
        ksort($data);
        $is_first_key = true;
        foreach ($data as $key => $value) {
            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }
            if (!$is_first_key) {
                $hash_data .= '&' . $key . '=' . $value;
            } else {
                $hash_data .= $key . '=' . $value;
                $is_first_key = false;
            }
        }

        $signature = hash_hmac('sha256', $hash_data, $hash_key);
        return $signature;
    }
}
