<?php

namespace App\Http\Controllers;

class LanguageController
{
    public function changeLanguage($locale)
    {
        if (!in_array($locale, ['en', 'am'])) {
            abort(400);
        }
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
