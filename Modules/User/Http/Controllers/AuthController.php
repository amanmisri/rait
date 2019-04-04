<?php

namespace Modules\User\Http\Controllers;

use Modules\Page\Entities\Page;
use Modules\User\Entities\User;

class AuthController extends BaseAuthController
{
    /**
     * Where to redirect users after login..
     *
     * @return string
     */
    protected function redirectTo()
    {
        return route('account.dashboard.index');
    }

    /**
     * The login URL.
     *
     * @return string
     */
    protected function loginUrl()
    {
        return route('login');
    }

    /**
     * Show login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('public.auth.login');
    }

    /**
     * Show registrations form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        $privacyPageURL = Page::urlForPage(setting('storefront_privacy_page'));

        return view('public.auth.register', compact('privacyPageURL'));
    }

    /**
     * Show reset password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReset()
    {
        return view('public.auth.reset.begin');
    }

    /**
     * Reset complete form route.
     *
     * @param \Modules\User\Entities\User $user
     * @param string $code
     * @return string
     */
    protected function resetCompleteRoute($user, $code)
    {
        return route('reset.complete', [$user->email, $code]);
    }

    /**
     * Password reset complete view.
     *
     * @return string
     */
    protected function resetCompleteView()
    {
        return view('public.auth.reset.complete');
    }
}
