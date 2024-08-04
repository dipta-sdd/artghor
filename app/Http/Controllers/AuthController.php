<?php



namespace App\Http\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(UserRegisterRequest $request)
    {
        $validateData = $request->validated();
        $validateData['password'] = bcrypt($validateData['password']);
        $user = User::create($validateData);
        $token = auth('api')->login($user);
        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$token = $this->guard()->attempt($credentials)) {
            $credentials = $request->only('username', 'password');
            if (!$token = $this->guard()->attempt($credentials)) {
                $credentials = $request->only('mobile', 'password');
                if (!$token = $this->guard()->attempt($credentials)) {
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
            }
        }
        return $this->respondWithToken($token);
    }


    public function me()
    {
        return response()->json($this->guard()->user());
    }

    public function logout()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function otp(Request $request)
    {
        $user = auth()->user();
        $method = $request->input('method');
        $otp_sms = $this->generateOTP();
        $otp_email = $this->generateOTP();
        if ($method == 'sms') {
            $user->otp_sms = $otp_sms;
            $user->otp_exp_sms = now()->addMinutes(5);
            $user->save();
            $res_sms = $this->sms_send($user->mobile, $otp_sms);
            return response()->json(['message' => 'An OTP has been send to your phone.']);
        } elseif ($method == 'email') {
            $user->otp_email = $otp_email;
            $user->otp_exp_email = now()->addMinutes(5);
            $user->save();
            $res_email = $this->sendEmail($user->email, $otp_email);
            return response()->json(['message' => 'An OTP has been send to your email.']);
        } else {
            if ($user->mobile) {
                $user->otp_sms = $otp_sms;
                $user->otp_exp_sms = now()->addMinutes(5);
                $res_sms = $this->sms_send($user->mobile, $otp_sms);
            }
            if ($user->email) {
                $user->otp_email = $otp_email;
                $user->otp_exp_email = now()->addMinutes(5);
            }


            $user->save();
            return response()->json(['message' => 'An OTP has been send to your email and phone.']);
        }
    }

    public function verify(Request $request)
    {
        $user = auth()->user();
        $otp = $request->input('otp');
        if ($user->otp_sms == $otp && now() < $user->otp_exp_sms) {
            $user->mobile_verified_at = now();
            $user->save();
            return response()->json(['message' => 'Your phone no has been successfully verified.']);
        } elseif ($user->otp_email == $otp && now() < $user->otp_exp_email) {
            $user->email_verified_at = now();
            $user->save();
            return response()->json(['message' => 'Your phone no has been successfully verified.']);
        }
        return response()->json(['message' => 'Invalid code. Try again.'], 400);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer'
        ]);
    }
    protected function generateOTP()
    {
        $length = 6;
        $characters = '0123456789';
        $otp = '';
        for ($i = 0; $i < $length; $i++) {
            $otp .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $otp;
    }


    protected function sendEmail($to, $otp)
    {
        $mail = new PHPMailer(true);

        try {
            // Server settings (Secure SSL/TLS)
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP();
            $mail->Host = 'mail.artghor.com';
            $mail->Port = 465; // SMTP port
            $mail->SMTPSecure = 'ssl'; // Enable encryption, `tls` also accepted
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'noreply@artghor.com'; // Replace with your email
            $mail->Password = 'Spider@2580'; // Replace with your password

            // Recipients
            $mail->setFrom('noreply@artghor.com', 'artghor.com'); // Replace with your name
            $mail->addAddress($to);

            // Content
            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = "Verification Code";
            $mail->Body = "Your artghor verification code is " . $otp;

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }

    protected function sms_send($number, $otp)
    {
        $url = "http://bulksmsbd.net/api/smsapi";
        $api_key = "nz0NA1WwMB0hFBeljYYN";
        $senderid = "8809604904745";
        $message = "Your Artghor OTP is " . $otp;

        $data = [
            "api_key" => $api_key,
            "senderid" => $senderid,
            "number" => $number,
            "message" => $message
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
    public function guard()
    {
        return Auth::guard('api');
    }
}
