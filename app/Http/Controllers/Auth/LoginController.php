<?php

namespace App\Http\Controllers\Auth;

use App\Utils\ModuleUtil;
use App\Utils\BusinessUtil;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * All Utils instance.
     */
    protected $businessUtil;

    protected $moduleUtil;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BusinessUtil $businessUtil, ModuleUtil $moduleUtil)
    {
        $this->middleware('guest')->except('logout');
        $this->businessUtil = $businessUtil;
        $this->moduleUtil = $moduleUtil;
    }

    public function showLoginForm(Request $request)
    {
        if (session('previous_page') === 'recruitment-create') {
            session(['link' => url()->previous()]);
        }
        // dd(session('link'));

        return view('auth.login');
    }


    /**
     * Change authentication from email to username
     *
     * @return void
     */
    public function username()
    {
        return 'username';
    }

    public function logout()
    {
        $this->businessUtil->activityLog(auth()->user(), 'logout');

        request()->session()->flush();
        \Auth::logout();

        return redirect('/');
    }

    /**
     * The user has been authenticated.
     * Check if the business is active or not.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $this->businessUtil->activityLog($user, 'login', null, [], false, $user->business_id);

        if ($user->user_type == 'user_customer') {
            $this->redirectTo();
        } elseif (!$user->business->is_active) {
            \Auth::logout();

            return redirect('/login')
                ->with(
                    'status',
                    ['success' => 0, 'msg' => __('lang_v1.business_inactive')]
                );
        } elseif ($user->status != 'active') {
            \Auth::logout();

            return redirect('/login')
                ->with(
                    'status',
                    ['success' => 0, 'msg' => __('lang_v1.user_inactive')]
                );
        } elseif (!$user->allow_login) {
            \Auth::logout();

            return redirect('/login')
                ->with(
                    'status',
                    ['success' => 0, 'msg' => __('lang_v1.login_not_allowed')]
                );
        } elseif ((!$user->user_type == 'user_customer') && !$this->moduleUtil->hasThePermissionInSubscription($user->business_id, 'crm_module')) {
            \Auth::logout();

            return redirect('/login')
                ->with(
                    'status',
                    ['success' => 0, 'msg' => __('lang_v1.business_dont_have_crm_subscription')]
                );
        }
    }

    protected function redirectTo()
    {
        // Check if there is an intended URL in the session
        if ($intendedUrl = session('url.intended')) {
            return $intendedUrl;
        }

        $user = \Auth::user();

        if (session()->has('intended_url')) {
            $intended_url = session()->get('intended_url');
            session()->forget('intended_url'); // Clear the intended URL from the session
            return '/' . $intended_url;
        }

        // Check user type and permissions
        if (!$user->can('dashboard.data') && $user->can('sell.create')) {
            return '/pos/create';
        }

        if (session()->has('link')) {
            // Get the URL from the session
            $redirectUrl = session('link');
            // dd($redirectUrl);

            // Clear the 'link' session
            // session()->forget('link');

            // Redirect the user to the stored URL
            return $this->redirectTo = $redirectUrl;
        }

        if ($user->user_type == 'user_customer') {
            return '/contact/contact-dashboard';
        }

        // Default redirection for other cases
        return $this->redirectTo = '/home';
    }
}
