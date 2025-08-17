<?php

namespace App\Traits\Auth;
use Illuminate\Support\Str;

trait UsernameTrait
{
    /**
     * Método para gerar o nome de usuário
     */
    public static function CreateUsername($fullName)
    {
        $fullName = strtolower(trim($fullName));

        $fullName = str_replace(['á', 'à', 'â', 'ã', 'ä', 'å', 'æ'], 'a', $fullName);
        $fullName = str_replace(['é', 'è', 'ê', 'ë'], 'e', $fullName);
        $fullName = str_replace(['í', 'ì', 'î', 'ï'], 'i', $fullName);
        $fullName = str_replace(['ó', 'ò', 'ô', 'õ', 'ö'], 'o', $fullName);
        $fullName = str_replace(['ú', 'ù', 'û', 'ü'], 'u', $fullName);

        $nameParts = explode(' ', $fullName);
        $firstName = $nameParts[0];
        $lastName = end($nameParts);

        $firstName = str_replace(' ', '.', $firstName);
        $lastName = str_replace(' ', '.', $lastName);

        $limitLastName = Str::limit($lastName,2,'');
        $nameNumber = self::AleatoryNum(6);

        $username = $firstName . '.' . $limitLastName .''. $nameNumber;

        return $username;
    }

    /**
     * Gerando números aleatórios
     */
    public static function AleatoryNum($tamanho):mixed {
        $caracteres = '0123456789';
        $senha = '';

        for ($i = 0; $i < $tamanho; $i++) {
            $senha .= $caracteres[mt_rand(0, strlen($caracteres) - 1)];
        }

        return $senha;
    }
}
