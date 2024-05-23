<?php

namespace App\Http\Controllers\Auth;


use App\helpers\Functions;
use App\Mail\UserMessageToAdmin;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Exception;
use Symfony\Component\Mailer\Exception\UnexpectedResponseException;

class AuthController extends Controller
{
    use Functions;

    public function index()
    {
        return view('auth.login');
    }

    public function editProfileAdmin()
    {
        return view('admin.components.edit-profile', ['user' => Auth::user()]);
    }

    public function editProfileUser()
    {
        return view('user.components.edit-profile', ['user' => Auth::user()]);
    }


    public function update(Request $request)
    {
        try {
            $user = Auth::user();

            $rules = [
                'first_name' => 'nullable|string|max:255',
                'last_name' => 'nullable|string|max:255',
                'phone' => 'nullable|string|max:20',
                'email' => 'nullable|string|email|max:255|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:8',
            ];

            $messages = [
                'required' => 'The :attribute field is required.',
                'string' => 'The :attribute field must be a string.',
                'max' => 'The :attribute field must not exceed :max characters.',
                'email' => 'The :attribute field must be a valid email address.',
                'unique' => 'The :attribute has already been taken.',
                'min' => 'The :attribute field must be at least :min characters long.',
            ];

            $userData = $request->all();
            $userDB = User::select('first_name', 'last_name', 'phone', 'email', 'password')->get();
            $data = $this->swapNullValues($userData, $userDB);
            $validator = Validator::make($data, $rules, $messages);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $user->update($data);
            if ($user->hasRole('user')) {
                return redirect('home')->with('success', 'User updated successfully');
            }
            return redirect('dashboard')->with('success', 'User updated successfully');

        } catch (Exception $e) {
            return back()->with('error', 'Failed to update user');
        }
    }


    public function destroy()
    {
        if (Auth::check()) {
            $user = Auth::user();

            try {
                $user->delete();
                Auth::logout();
                Session::flush();
                return redirect()->route('login-page')->with('success', 'Profile deleted successfully');
            } catch (\Exception $e) {
                return redirect()->route('dashboard')->with('error', 'Failed to delete profile. Please try again later.');
            }
        } else {
            return redirect()->route('login-page')->with('error', 'User not authenticated.');
        }
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $redirectRoute = $user->hasRole('admin') ? 'dashboard' : 'home';

            return redirect()->route($redirectRoute)->with('success', 'Signed in');
        }

        return redirect("login-page")->with('error', 'Something went wrong');
    }


    public function registrationPage()
    {
        return view('auth.registration');
    }


    public function registration(Request $request)
    {
        try {
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'phone' => 'required|numeric|min:9',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            $data = $request->all();
            $mail = ['email' => $request['email'], 'message' => 'user registered successfully',
                'name' => "{$request['first_name']}", 'subject' => 'User Message To Admin'];
            Mail::send(new UserMessageToAdmin($mail));
            $user = User::create($data);
            $user->assignRole('user');
            Auth::login($user);
            return redirect("home")->with('success', 'You have signed-in');
        } catch (UnexpectedResponseException) {
            return view('auth.registration')->with('error', 'You provide wrong email address.');
        } catch (\Exception) {
            return view('auth.registration')->with('error', 'Something went wrong');
        }
    }

    public function dashboard()
    {
        if (Auth::check()) {
            return view('dashboard');
        }
        return redirect("login")->with('error', 'You are not allowed to access');
    }

    public function home()
    {
        if (Auth::check()) {
            $categories = Category::orderBy('created_at', 'desc')->get();
            return view('user.home', ['categories' => $categories]);
        }
        return redirect("login")->with('error', 'You are not allowed to access');
    }

    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
