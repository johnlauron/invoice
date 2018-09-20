<?php

namespace App\Http\Controllers;

use Hash;
use App\User;
use App\CompanyUser;
use App\Company;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth;

class UsersController extends Controller
{

    function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users = User::all();
        foreach($users as $user){
            $id = $user->id;
            $company_id = CompanyUser::where('user_id', $id)->first()->company_id;
            $companys = Company::find($company_id);
            if(empty($companys)){
                $user->company_id = null;
            }
            else{
                $user->company_id = $companys->company_name;
            }
           
            if($user->approved == true){
                $user->approved = 'approved';
            }else{
                $user->approved = 'on hold';
            }
        }
        
        return view('users.index',compact('users'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('users.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:100|unique:users,name',
            'email' => 'email|required|unique:users,email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = "success";
        $message = "User created successfully! ";
        
        // Start transaction!
        DB::beginTransaction();

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'approved' => true
            ]);
            
            $newUserID = User::where('name',$request->name)->first()->id;
            CompanyUser::create([
                'user_id' => $newUserID,
                'company_id' => $request->company_id
            ]);
        } catch(\Exception $e)
        {
            dd($e);
            DB::rollback();
            $status = "error";
            $message = "Problem occurred. User creation failed!";
        }

 
        DB::commit();

        return redirect()->route('users.index')
                        ->with($status,$message);

    }

    public function show($id)
    {
/*        $user = User::find($id);
        //dd($user);
        $newApprove = true;
        
        if($user->approved == true){
            $newApprove = false;
        }
        $user->approved = $newApprove;
        $user->save();
        return redirect()->route('users.index');*/
    }

    public function edit($id)
    {
        $USER_ROLES = ['Super Admin', 'Super User', 'Admin', 'User'];
        $user = User::find($id);
        $company = CompanyUser::select('company_id')->where('user_id', $user->id)->first();
        $company_id = $company->company_id;
        $companies = Company::orderBy('company_name', 'asc')->get();
        return view('users.edit', compact('companies', 'user', 'company_id', 'USER_ROLES'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:100',
            'email' => 'email|required',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = "success";
        $message = "User updated successfully! ";

        $user_id = $id;
        $old_name_record = User::find($id);
        // Start transaction!
        DB::beginTransaction();

        try {
            User::where('id', $user_id)->first()->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'approved' => true
            ]);

            $comp_user = User::where('id' , $user_id)->first();
            CompanyUser::where('id', $comp_user->id)->first()->update([
                'user_id' => $user_id,
                'company_id' => $request->company_id
            ]);
        } catch(Exception $e)
        {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return redirect()->route('users.index')
                        ->with($status,$message);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        
        return redirect()->route('users.index')
                        ->with('success','User entry deleted successfully');
    }

    public function dashboard()
    {
        return view('users.dashboard');
    }


    public function editProfile($id)
    {
        $user = User::find($id);
        $company_id = CompanyUser::where('user_id', $user->id)->first()->company_id;
        $companys = Company::find($company_id);
        if(empty($companys->company_name)){
            $company_name = null;
        }
        else{
            $company_name = $companys->company_name;
        }
        $user->companys = $company_name;
        return view('users/editprofile', compact('user'));
    }



    public function changePassword(Request $request, $id)
    {
        $status = "success";
        $message = "Account Dashboard skin color updated successfully!";

        $this->validate($request, [
            'oldPassword' => 'required',
            'password' => 'required|confirmed|min:6|different:oldPassword',
        ]);

        $user = User::find($id);
        $oldpassword = $request->oldPassword;
        $password = $request->password;
        if(Hash::check($oldpassword, $user->password)){
            $user->password = Hash::make($password);            
            if($user->save())
            {}else{
                $status = "error";
                $message = "Problem occurred. Password update unsuccessful.";
            }
        }else{
            $status = "error";
            $message = "Error: Incorrect current password!";
        }

        return redirect()->route('users.editprofile', $id)
                         ->with($status,$message);
    }

    public function changeSkin(Request $request, $id)
    {
        $status = "success";
        $message = "Account Dashboard skin color updated successfully!";
        $skin = $request->input('skin');
        
        $user = User::find($id);
        $user->skin = $skin[0];
        if($user->save())
        {}else
        {
            $status = "error";
            $message = "Problem occured. Dashboard skin update failed!";    
        }
        
        return redirect()->route('users.editprofile', $id)
                         ->with($status,$message);
    }
    
}
?>