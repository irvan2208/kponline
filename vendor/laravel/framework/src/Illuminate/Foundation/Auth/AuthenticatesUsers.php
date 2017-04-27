<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\users;

trait AuthenticatesUsers
{
    use RedirectsUsers, ThrottlesLogins;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required', 'password' => 'required',
        ]);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->has('remember')
        );
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $field = filter_var($request->input($this->username()), FILTER_VALIDATE_EMAIL) ? 'email' : 'npm';
        $request->merge([$field => $request->input($this->username())]);
        //dd($request);
        return $request->only($field, 'password');

        //return $request->only($this->username(), 'password');
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->intended($this->redirectPath());
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        if ( Auth::check() && Auth::user()->isAdmin() ){
            return redirect('/admin/perpanjangan');
        }else{
            return redirect('/home');
        }
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        //dd($request);
        $errors = [$this->username() => trans('auth.failed')];
        if($errors){
            $data = array("username" => $request->npm, "password" => $request->password);      
            $data_string = json_encode($data);                                   
            $ch = curl_init('http://apps.uib.ac.id/portal/api/v1/login');        
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                     
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                  
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
            );
            $result = curl_exec($ch);
            $result = json_decode($result, true);
            if(isset($result['code'])){
                $kode = 400;
            }else{
                $kode = 1;
            }

            if($kode == 400)
            {
                return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors($errors);
            }elseif($kode == 1){
                //dd($result);

                if ($result['gender'] == 'L') {
                    $jk = 'm';
                }else{
                    $jk = 'f';
                }
                $pass = bcrypt($request->password);
                $users = new users;
                $users->npm = $result['id'];
                $users->nama = $result['name'];
                $users->jk = $jk;
                $users->prodi = $result['majorCode'];
                $users->email = null;
                $users->phone = $result['phone'];
                $users->password = $pass;
                $users->save();

                Auth::loginUsingId($result['id'],true);
                return redirect('kendaraan');//
            }
        }
        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
   public function username()
    {
        return 'login';
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->flush();

        $request->session()->regenerate();

        return redirect('/');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
