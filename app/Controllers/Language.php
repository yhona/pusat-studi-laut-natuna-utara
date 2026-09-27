<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class Language extends BaseController
{
    /**
     * Switch application locale and persist to session.
     *
     * @param string $locale
     *
     * @return RedirectResponse
     */
    public function switch(string $locale): RedirectResponse
    {
        $session = service('session');
        $supportedLocales = config('App')->supportedLocales;

        if (in_array($locale, $supportedLocales, true)) {
            $session->set('locale', $locale);
            service('request')->setLocale($locale);
            service('language')->setLocale($locale);
        }

        $prevUrl = (string) previous_url();
        $baseURL = config('App')->baseURL;
        $appHost = parse_url($baseURL, PHP_URL_HOST);
        $appPort = parse_url($baseURL, PHP_URL_PORT);
        $parsedPrev = parse_url($prevUrl);

        $prevHost = $parsedPrev['host'] ?? null;
        $prevPort = $parsedPrev['port'] ?? null;
        $prevScheme = strtolower($parsedPrev['scheme'] ?? '');

        $target = $prevUrl;
        if (! is_array($parsedPrev)
            || empty($prevHost)
            || empty($appHost)
            || strcasecmp($prevHost, $appHost) !== 0
            || ! in_array($prevScheme, ['http', 'https'], true)
            || (! empty($appPort) && (int) $prevPort !== (int) $appPort)
            || strpos($parsedPrev['path'] ?? '', '/lang/') !== false
        ) {
            $target = site_url('/');
        }

        session_write_close();

        return redirect()->to($target);
    }
}
