<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class LocaleFilter implements FilterInterface
{
    /**
     * Inspects session('locale'), validates against supported locales,
     * and sets the request & language locale.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return mixed
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! $request instanceof \CodeIgniter\HTTP\IncomingRequest) {
            return;
        }

        $session = service('session');
        $config = config('App');
        $locale = $session->get('locale') ?? $config->defaultLocale;

        if (! in_array($locale, $config->supportedLocales, true)) {
            $locale = $config->defaultLocale;
        }

        service('request')->setLocale($locale);
        service('language')->setLocale($locale);
    }

    /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return mixed
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No post-processing required
    }
}
