<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        "cep",
        "logradouro",
        "complemento",
        "bairro",
        "localidade",
        "uf",
        "ddd"
    ];

    protected static array|MessageBag $errors; 

    public static function searchWithCEP(string $cep)
    {
      if(!self::isCEP($cep)) {
        return null;
      }
      $cep = str_replace('-','', $cep);
    
      $request = Http::get("viacep.com.br/ws/{$cep}/json/");

      if($request->failed()) {
        return null;
      }
      $result = $request->json();

      if(array_key_exists('erro', $result)) {
        return null;
      }
        $result['cep'] = str_replace('-','', $result['cep']);
        return new Address($result);
    }

    protected static function isCEP(string $str): bool
    {
       if(preg_match('/^(?:[0-9]{8}|[0-9]{5}-[0-9]{3})$/', $str)) {
        return true;
       }
       return false;
    }

    private static function setErrors(array $errors): void
    {
        static::$errors = new MessageBag($errors);
    }

    public function users(): BelongsToMany
    {
      return $this->belongsToMany(User::class, 'user_addresses');
    }
}
