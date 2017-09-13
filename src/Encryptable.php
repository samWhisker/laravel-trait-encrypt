<?php
namespace Koodoo\laravelTraitEncrypt;

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
               Log::error('Value not decyrptable');
           }
       }

       return $value;
   }

   public function setAttribute($key, $value, $encrypt = true)
   {
      if($encrypt)
      {
          if (in_array($key, $this->encryptable)) {
              $value = \Crypt::encrypt($value);
          }
      }
      return parent::setAttribute($key, $value);
   }
}
