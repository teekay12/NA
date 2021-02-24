<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class LoginController extends Controller
{
    public function userLogin(){
        $page ="userlogin";

        return view('login.user', compact('page'));
    }

    public function Authenticate(Request $request)
    {
        try{
            if(Sentinel::Authenticate($request->all()))
            {
                $data = Sentinel::getUser();
                return $data;
            }
            else
            {
                return false;
            }
        }
        catch (ThrottlingException $e) {
            $delay = $e->getDelay();
            return back()->withErrors([
                'error' => "Account Suspended. Try again in $delay seconds.",
            ]);
        }
        catch (NotActivatedException $e) {
            return back()->withErrors([
                'error' => "Account not activated.",
            ]);
        }
        catch(QueryException $e){
            return back()->withErrors([
                'error' => "System Upgrade, try again later.",
            ]);
        }
    }

    public function userLoginPost(Request $request){
        $page ="userlogin";

        $data = $this->Authenticate($request);
        
        if(!$data)
            return back()->withErrors([
                'error' => 'Invalid credentials.',
            ]);

        if($data->type != "user")
            return back()->withErrors([
                'error' => 'Invalid credentials.',
            ]);

        return redirect('user/dashboard');
    }

    public function Logout()
    {
        $user = Sentinel::getUser();
        Sentinel::logout($user, true);
        
        return redirect('/');
    }
}
