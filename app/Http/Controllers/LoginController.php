<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Cookie;
use Response;

class LoginController extends Controller
{
    
    protected $redirectTo = '/backoffice-daily-report';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function doLogin(Request $request)
    {
        if ($request->get('password') === env('ADMIN_PASSWORD')) {
            $cookie = Cookie::make('name', 'value');
            
            return redirect('backoffice-daily-report')->withCookie($cookie);
        }
        $this->showLogin();
    }
    
    /**
     * show login page
     *
     * @return View
     */
    public function showLogin()
    {
        return view('backoffice-login');
    }
}
