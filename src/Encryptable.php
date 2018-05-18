<?php

namespace Koodoo\laravelTraitEncrypt;

use Illuminate\Contracts\Encryption\DecryptException;

trait Encryptable
{
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);
        if (in_array($key, $this->encryptable)) {
            try {
                $value = \Crypt::decrypt($value);
            } catch (DecryptException $e) {
                $value = $value;
                \Log::error('Value not decryptable');
            }
        }
        return $value;
    }

    public function setAttribute($key, $value, $encrypt = true)
    {
        if ($encrypt) {
            if (in_array($key, $this->encryptable)) {
                $value = \Crypt::encrypt($value);
            }
        }
        return parent::setAttribute($key, $value);
    }

    /**
     * When generating an array of attributes (e.g. for the API) this will
     * decrypt the values if the attribute is found in the encryptable array.
     *
     * @return Array
     */
    public function attributesToArray()
    {
        $attributes = parent::attributesToArray();
        foreach ($this->encryptable as $key) {
            $value = parent::getAttribute($key);
            try {
                $attributes[$key] = \Crypt::decrypt($value);
            } catch (DecryptException $e) {
                // no need to do anything here - this attribute is already in the array
            }
        }
        return $attributes;
    }
}
