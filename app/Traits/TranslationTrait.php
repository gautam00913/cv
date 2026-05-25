<?php
namespace App\Traits;

use Stichoza\GoogleTranslate\GoogleTranslate;

trait TranslationTrait
{
    public function translate(string $text, bool $required = true) : ?string
    {
        $translateText = null;
        $tr = new GoogleTranslate(app()->getLocale() === 'en' ? 'fr' : 'en');
        try {
            $translateText = $tr->translate($text);
        } catch (\Exception $e) {
            if ($required) {
                $translateText = $text;
            }
        }

        return $translateText;
    }
}