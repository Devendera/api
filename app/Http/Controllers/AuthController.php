<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Student;
use DataTables;

class AuthController extends Controller
{
    /**
     * Create user
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [string] message
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6'
        ]);
        $user = new User([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  
    /**
     * Login user and create token
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);

        $user = Auth::user();//$request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request)
    {
        return response()->json($request->user());
    }

    public function getStudents(Request $request)
    {
        $pageNo = 1;
        if(isset($request->page_no))
        {
            $pageNo = $request->page_no;
            $students = Student::skip(50*($pageNo-1))->take(50)->get();
        }
        else
        {
            $students = Student::all();
        }

        $studentsData = [];
        foreach($students as $student)
        {
            $newData = $student;
            $newData->branch_name = $student->branch->name;
            $studentsData[] = $newData;
        }

        return response()->json($studentsData);
    }

    // login functionality
    public function loginUser()
    {
        if(Auth::check()){
            return redirect('/students');
        }

        return view('login');
    }

    public function loginUserPost(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        $credentials = request(['email', 'password']);
        if(!Auth::attempt($credentials))
        {
            return redirect("login")->withSuccess('Login details are not valid');
        }

        $tokenResult = $request->user()->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        session(['access_token' => $tokenResult->accessToken]);

        return redirect('/students')
            ->withSuccess('Signed in');
    }

    public function studentData(Request $request)
    {
        if(!Auth::check()){
            return redirect('/login');
        }

        return view('students');
    }

    public function logoutUser(Request $request)
    {
        Auth::logout();

        return redirect("login")->withSuccess('Login successful.');
    }
}