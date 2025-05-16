<?php
namespace Utils;

class Escaper
{
    /**
     * Échappe une chaîne pour affichage HTML,
     * accepte null ou tout autre type.
     */
    public static function e($value = ''): string
    {
        // On force en chaîne de caractères pour éviter l’erreur sur null
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }

    /**
     * Force un entier sécurisé (pour les IDs, pages, etc.)
     */
    public static function i($value): int
    {
        return (int) $value;
    }

    /**
     * Échappe une URL ou un segment GET
     */
    public static function url($value = ''): string
    {
        return rawurlencode((string) $value);
    }
}
