<?php

namespace App\Http\Controllers\Actions;

use Kiranti\Config\Language;
use Illuminate\Http\RedirectResponse;

/**
 * Class LangTranslatorAction
 * @package App\Http\Controllers\Actions
 */
final class LangTranslatorAction
{

    /**
     * @param $locale
     * @return RedirectResponse
     */
    public function __invoke($locale)
    {
        if(in_array($locale, Language::$current)) {
            \Artisan::call('cache:clear');
            request()->session()->put(Language::LANG_KEY, $locale);
        }
        return redirect()
            ->back();
    }

}
