<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Sentinel;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;
use App\Models\Assignment;
use App\Models\Company;
use App\Events\UserEvent;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Events\CompanyEvent;

class UserController extends Controller
{
    public function userRegister(){
        $page = "userregister";
        return view('register.user', compact('page'));
    }

    public function userRegisterPost(Request $request){
        $page = "userregister";

        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'email|required|unique:users',
            'mobile' => 'required|max:11',
            'country' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);
        
        try{
            $user = Sentinel::registerAndActivate( [
                    'email' => $request->email,
                    'password' => $request->password,
            ]);

            event(new UserEvent($user, $request));
    
            return redirect('/login/user')->with('Success','Registeration successful and activated. Please Login');
            
        }
        catch(QueryException $e){

            dd($e);
            return redirect()->back()->with('error','Server Error, please check back later');
        }
        
    }

    public function userDashboard(){
        $page = "dashboard";

        $userobj = new Profile();
        $user = $userobj->getCx();

        $obj = new Assignment();
        $company = $obj->getCompanyList();

        $companyobj = new Company();
        $allcompany = $companyobj->getAllCompany();

        return view('page.user',compact('page','company', 'user', 'allcompany'));
    }

    public function Search(Request $request){
      
        $page = "dashboardsearch";

        $userobj = new Profile();
        $user = $userobj->getCx();

        $obj = new Assignment();
        $company = $obj->getCompanySearch($request->search);

        $companyobj = new Company();
        $allcompany = $companyobj->getAllCompany();

        return view('page.user',compact('page','company', 'user', 'allcompany', 'request'));
    }

    public function userProfileUpdate(Request $request)
    {
        $userobj = new Profile();
        $user = $userobj->getCx();

        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => (strtolower($user->email) == strtolower($request->email)) ? 'email|required' :'email|required|unique:users',
            'mobile' => 'required|max:11',
            'country' => 'required',
        ]);
        
        try{
            $profileUpdate = Profile::findorFail($user->id);
            
            $profile = [
                //'user_id' => Sentinel::getuser()->id,
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'country' => $request->country,
            ];

            DB::table('users as u')
                        ->where('u.id', $user->user_id)
                        ->update(['u.email' => $request->email]);
            
            $profileUpdate->update($profile);

            return redirect('/user/dashboard')->with('Success','Profile update successful');
        }
        catch(QueryException $e){
            return redirect()->back()->with('error','Server Error, please check back later');
        }
        
    }

    public function RemoveCompany($id){
        $userobj = new Profile();
        $user = $userobj->getCx();

        $checkifcompanyexist = Assignment::userCompanyifexist($id);
        if($checkifcompanyexist == 0){
            return redirect('/user/dashboard')->with('error','What you seem to be lookin for does not exist');
        }
        
        Assignment::userCompanyDelete($user->id, $id);

        return redirect('/user/dashboard')->with('Success','Company deleted successfully');
    }

    public function userPasswordUpdate(Request $request)
    {
        $user = Sentinel::getUser();
        $request->validate([
            'oldpassword' => 'required' ,
            'password' => 'required|confirmed|min:6',
        ]);

        if (Hash::check($request->oldpassword, $user->password)) {
            $request->user()->fill([
                'password' => Hash::make($request->password)
            ])->save();
        }else{
            return redirect('/user/dashboard')->with('error','Password does not match');
        }

        return redirect('/user/dashboard')->with('Success','Password updated successfully');
    }

    public function editCompany($id) 
    {
        $userobj = new Profile();
        $user = $userobj->getCx();

        $checkifcompanyexist = Assignment::userCompanyifexist($id);
        if($checkifcompanyexist == 0){
            return redirect('/user/dashboard')->with('error','What you seem to be lookin for does not exist');
        }

        $obj = new Assignment();
        $company = $obj->getCompanybyid($id);

        return view('page.updatecompany', compact('company'));
    }

    public function editCompanyUpdate(Request $request) {
        $userobj = new Company();
        $user = $userobj->getCompany($request->cid);
        
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => ($user->email == $request->email) ? 'email|required' :'email|required|unique:companys',
            'location' => 'required',
        ]);
        
        try{
            $profileUpdate = Company::findorFail($request->cid);
            
            $profile = [
                //'user_id' => Sentinel::getuser()->id,
                'name' => $request->name,
                'email' => $request->email,
                'location' => $request->location,
            ];
            
            $profileUpdate->update($profile);

            return redirect('/user/dashboard')->with('Success','Profile update successful');
        }
        catch(QueryException $e){
            return redirect()->back()->with('error','Server Error, please check back later');
        }
    }

    public function addCompany(){
        $page = "addcompany";
        $user = Sentinel::getUser();

        return view('page.addcompany', compact('user'));
    }

    public function addCompanyUpdate(Request $request){
        $page = "addcompany";

        $user = Sentinel::getUser();

        $checkcount = Assignment::userCompanyCount($user->id);

        if($checkcount >= 3)
            return redirect('/user/dashboard')->with('error','You have reached the limit of companies you can add.');
        
        $checkifexist = Assignment::userCompanyDeleted($user->id, $request->email);

        if($checkifexist == 1){
            Assignment::restoreCompany($user->id, $request->email, $request->name, $request->location);
            return redirect('/user/dashboard')->with('Success','Company restored with changes successfully');
        }

        $request->validate([
            'name' => 'required|min:3|max:50|unique:companys',
            'email' =>'email|required|unique:companys',
            'location' => 'required',
        ]);
        
        try{
            $user = Sentinel::getUser();
            event(new CompanyEvent($user, $request));
                
            return redirect('/user/dashboard')->with('Success','New company added successfully');
        }
        catch(QueryException $e){
            dd($e);
            return redirect()->back()->with('error','Server Error, please check back later');
        }
        catch(QueryException $e){
            return redirect()->back()->with(['error'=>'Email exist: '.$request->email]);
        }
    }

}
