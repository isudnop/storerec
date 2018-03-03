<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Cookie;
use Response;

class LoginController extends Controller
{
    protected $redirectTo = '/backoffice-daily-report';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Do login process.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function doLogin(Request $request)
    {
        if ($request->get('password') === env('ADMIN_PASSWORD')) {
            $cookie = Cookie::make('authAdmin', env('COOKIE_VALUE'));

            return redirect('backoffice-daily-report')->withCookie($cookie);
        }

        return redirect('backoffice-login');
    }

    /**
     * show login page.
     *
     * @return View
     */
    public function showLogin(): View
    {
        return view('backoffice-login');
    }
}
