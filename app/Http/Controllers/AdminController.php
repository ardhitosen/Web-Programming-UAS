<?php

    namespace App\Http\Controllers;

    use App\Models\Admin;
    use App\Http\Requests\ProfileUpdateRequest;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\View\View;
    use App\Models\Doctor;
    use App\Models\Patient;



    class AdminController extends Controller
    {
        public function login()
        {
            return view('admins.login');
        }

        public function logout()
        {
            Auth::guard('admin')->logout();
            return redirect('/');
        }

        public function loginProcess(Request $request)
        {
            $credentials = $request->only('email', 'password');
            $admin = Admin::where('email', $credentials['email'])->first();

            $hCaptchaResponse = $request->input('h-captcha-response');
            $secretKey = '0x5aDe1898FcA3C3ebdd7837EEAa8Baf6cBa1C7fB0';

            $response = Http::asForm()->post('https://hcaptcha.com/siteverify', [
                'response' => $hCaptchaResponse,
                'secret' => $secretKey,
            ]);

            $responseData = $response->json();
            if (!$responseData['success']) {
                return redirect()->back()->withErrors('Invalid captcha');
            }

            if ($admin && $credentials['password'] == $request->password) {
                Auth::guard('admin')->login($admin);
                return redirect()->intended('admins/dashboard');
            } else {
                return redirect()->back()->withErrors('Invalid credentials');
            }
        }

        public function dashboard()
        {
            return view('admins.dashboard');
        }

        public function doctors()
        {
            $doctors = Doctor::all();
            return view('admins.doctors', compact('doctors'));
        }

        public function patients()
        {
            $patients = Patient::all();
            return view('admins.patients', compact('patients'));
        }


        public function doctorscreate()
        {
            return view('admins.doctorcreate');
        }

    }

