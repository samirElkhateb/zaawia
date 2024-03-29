<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\registerRequest;
use App\Http\Requests\loginRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use App\Mail\VerifyEmail;
use App\Mail\ForgetPassword;
use Exception;

class AuthController extends Controller
{
    /**
     * ! Register a new user.
     * ? Handles user registration based on validated data from the request.
     * @param RegisterRequest $request - The incoming request containing user registration data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            // * Get the validated data from the request.
            $validatedData = $request->validated();

            // * Create a new user.
            $user = User::create($validatedData);

            // * Generate a new token for the user.
            $token = $user->createToken('auth_token')->plainTextToken;

            // * Return success message with user data and access token.
            return response()->json([
                'message' => 'User registered successfully',
                'data' => $user,
                'access_token' => $token,
                'token_type' => 'Bearer'
            ], 201);
        } catch (ValidationException $e) {
            // ! Handle validation errors.
            return response()->json(['error' => $e->validator->errors()], 422);
        } catch (\Exception $e) {
            // ! Handle other exceptions during user creation.
            return response()->json(['error' => 'Failed to register user.'], 500);
        }
    }

    /**
     * ! Authenticate a user and generate a token.
     * ? Handles user authentication and generates a token if successful.
     * @param loginRequest $request - The incoming request containing user login credentials.
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(loginRequest $request)
    {
        try {
            // * Retrieve validated data from the request.
            $validatedData = $request->validated();

            // ? Attempt to authenticate the user with the provided credentials.
            if (!$token = auth()->attempt($validatedData)) {
                // ! If authentication fails, return an error response.
                return response()->json([
                    'error' => 'Invalid email or password'
                ], 422);
            }

            // ? If authentication is successful, generate a token and return a success response.
            return $this->respondWithToken($token);
        } catch (ValidationException $e) {
            // ! Handle validation errors and return an error response.
            return response()->json($e->validator->errors(), 422);
        }
    }


    /**
     * !Generate a token and respond with user data.
     * ? Generates an access token and responds with user data in a standardized format.
     * @param string $token - The generated access token.
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken(string $token)
    {
        // * You may customize the user data included in the response based on your needs.
        $userData = auth()->user();

        return response()->json([
            'success' => true,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $userData,
        ]);
    }

    /**
     * ! Logout the authenticated user.
     * ? Attempts to log the user out and returns a success response if successful.
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            // ? Attempt to log the user out
            auth()->logout();

            // * Return a success response if the logout was successful
            return response()->json([
                'success' => true,
                'message' => 'Successfully logged out'
            ]);
        } catch (\Illuminate\Auth\AuthenticationException $e) {
            // ! Catch authentication-related exceptions
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 401);
        } catch (Exception $e) {
            // ! Catch generic exceptions
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * ! Get the profile of the authenticated user.
     * ? Retrieves and returns the profile data of the authenticated user.
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile()
    {
        try {
            // * Return a JSON response with success status and user data.
            return response()->json([
                "success" => true,
                "data" => auth()->user(),
            ]);
        } catch (\Throwable $e) {
            // ! Catch any throwable exceptions and return an error response.
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }



    /**
     * ! Update the profile of the authenticated user.
     * ? Validates and updates the user's profile information.
     * @param Request $request - The incoming request containing user profile data.
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        try {
            // ? Check if the user is authenticated.
            if (auth()->user()) {
                // * Validate the request data.
                $validator = Validator::make($request->all(), [
                    'id' => 'required',
                    'name' => ['required', 'string'],
                    'email' => ['required', 'email', 'string'],
                ]);

                // ? If validation fails, return an error response.
                if ($validator->fails()) {
                    return response()->json([
                        'errors' => $validator->errors()
                    ], 422);
                }

                // * Find the user by ID and update profile information.
                $user = User::find($request->id);
                $user->name = $request->name;
                $user->email = $request->email;
                $user->save();

                // * Return a success response with updated user data.
                return response()->json([
                    "success" => true,
                    "message" => 'Profile updated successfully',
                    'data' => $user
                ], 200);
            } else {
                // ! If the user is not logged in, return an unauthorized response.
                return response()->json([
                    "success" => false,
                    "message" => "You are not logged in"
                ], 401);
            }
        } catch (\Exception $e) {
            // ! Catch any generic exceptions and return an error response.
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }


    /**
     * ! Refresh the authentication token for the authenticated user.
     * ? Checks if the user is authenticated and refreshes the authentication token.
     * @return \Illuminate\Http\JsonResponse
     */
    public function refreshToken()
    {
        try {
            // ? Check if the user is authenticated.
            if (auth()->user()) {
                // * Refresh the authentication token and return a success response with the new token.
                return $this->respondWithToken(Auth::refresh());
            } else {
                // ! If the user is not authenticated, return an unauthorized response.
                return response()->json([
                    "success" => false,
                    "message" => "User not authenticated"
                ], 401);
            }
        } catch (\Exception $e) {
            // ! Catch any generic exceptions and return an error response.
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }


    /**
     * ! Verify the user's email address.
     * ? Sends a verification email to the provided email address if the user is authenticated.
     * @param string $email The email address to verify.
     * @return \Illuminate\Http\JsonResponse The JSON response indicating success or failure.
     */
    public function verifyMail($email)
    {
        try {
            // ? Check if the user is authenticated.
            if (auth()->user()) {
                // * Find the user by email.
                $user = User::where('email', $email)->get();

                // ? Check if user exists.
                if (count($user) > 0) {
                    // * Generate a random token for email verification.
                    $random = Str::random(40);

                    // * Generate verification URL.
                    $url = route('verify.email', ['token' => $random]);

                    // * Prepare data for the email.
                    $data['url'] = $url;

                    // * Send the verification email.
                    Mail::to($email)->send(new VerifyEmail($data));

                    // * Update user's remember_token with the generated token.
                    $user = User::find($user[0]['id']);
                    $user->remember_token = $random;
                    $user->save();

                    // * Return success response.
                    return  response()->json([
                        'success' => true,
                        'message' => 'A verification email has been sent to your registered email address.',
                    ]);
                } else {
                    // ! If user not found, return error response.
                    return response()->json([
                        "success" => false,
                        "message" => "User not found"
                    ], 401);
                }
            } else {
                // ! If user is not logged in, return error response.
                return response()->json([
                    "success" => false,
                    "message" => "You are not logged in"
                ], 401);
            }
        } catch (\Exception $e) {
            // ! Catch any generic exceptions and return an error response.
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }


    /**
     * ! Verify the user's email address.
     * ? This function is responsible for verifying the user's email address using a provided token.
     * @param string $token The token used for email verification.
     * @return \Illuminate\Http\Response The response indicating success or failure.
     */
    public function verifyEmail($token)
    {
        try {
            // ? Attempt to find the user by the provided token
            $user = User::where('remember_token', $token)->firstOrFail();

            // * Update user's information to mark email as verified
            $date_time = now()->toDateTimeString();
            $user->remember_token = '';
            $user->is_email_verified = '1';
            $user->email_verified_at = $date_time;
            $user->save();

            // * Prepare data for the view
            $data = ['url' => route('verify.email', ['token' => $token])];

            // * Render the email verification view
            return view('verifyEmail', compact('data'));
        } catch (\Exception $e) {
            // ! Handle exceptions
            return response()->view('404', [], 404); // todo Render a 404 view for user not found
        }
    }

    /**
     * ! Initiates the password reset process for a user.
     * ? This method generates a reset token, sends a password reset email, and records the token in the database.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing user's email.
     * @return \Illuminate\Http\JsonResponse A JSON response indicating success or failure of the password reset process.
     */
    public function forgetPassword(Request $request)
    {
        try {
            // ? Attempt to find the user by their email
            $user = User::where('email', $request->email)->get();

            // * If user is found
            if (count($user) > 0) {
                // ! Generate a random token for password reset
                $token = Str::random(40);

                // ? Construct the password reset URL
                $domain = Url::to('/');
                $url = $domain . '/forget-password?token=' . $token;

                // * Prepare data for the password reset email
                $data['url'] = $url;

                // ? Send the password reset email
                Mail::to($request->email)->send(new ForgetPassword($data));

                // ! Record the password reset token in the database
                $dateTime = Carbon::now()->format('Y-m-d H:i:s');
                PasswordReset::updateOrCreate([
                    'email' => $request->email,
                    'token' => $token,
                    'created_at' => $dateTime
                ]);

                // * Return success response
                return response()->json([
                    "success" => true,
                    "message" => 'Please check your email for further instructions.'
                ], 200);
            } else {
                // ? Return error response if user not found
                return response()->json([
                    "success" => false,
                    "message" => 'User not found!'
                ], 500);
            }
        } catch (\Exception $e) {
            // ! Return error response if an exception occurs
            return response()->json([
                "success" => false,
                "message" => $e->getMessage()
            ], 500);
        }
    }

    /**
     * ! Loads the password reset form.
     * ? This method loads the password reset form for a user based on the provided reset token.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the reset token.
     * @return \Illuminate\View\View A view displaying the password reset form.
     */
    public function resetPasswordLoad(Request $request)
    {
        try {
            // ? Retrieve the password reset data based on the provided token
            $resetData = PasswordReset::where('token', $request->token)->first();

            // * If no reset data is found, display a 404 error page
            if (!$resetData) {
                return view('404');
            }

            // ? Retrieve the user associated with the reset token
            $user = User::where('email', $resetData->email)->first();

            // * If no user is found, display a 404 error page
            if (!$user) {
                return view('404');
            }

            // * Return the password reset form view with the user data
            return view('resetPassword', compact('user'));
        } catch (\Exception $e) {
            // ! Handle exceptions
            return response()->view('error', ['message' => $e->getMessage()], 500);
        }
    }


    /**
     * ! Resets user password.
     * ? Validates the incoming request and updates the user's password.
     *
     * @param \Illuminate\Http\Request $request The HTTP request object containing the new password.
     * @return string A message indicating the password change status.
     */
    public function resetPassword(Request $request)
    {
        try {
            // ? Validate incoming request
            $request->validate([
                'password' => ['confirmed', 'required', 'min:4', 'string'],
            ]);

            // * Find user by ID
            $user = User::find($request->id);

            // * Update user's password with the hashed new password
            $user->password = Hash::make($request->password);
            $user->save();

            // ! Return message confirming password change
            return view('changeSuccess');
        } catch (\Exception $e) {
            // ! Handle exceptions
            return view('404'); // todo: Render an error view with the exception message
        }
    }
}
