<?php

namespace App\Actions\Fortify;

use App\Models\MobileVerification;
use App\Models\Team;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Twilio\Rest\Client;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'mobile' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'mobile' => $input['mobile'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
                $mv = $this->setVerificationCode(['user_id' => $user->id]);
                $this->sendSMS($user, $mv);
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }

    protected function setVerificationCode($data) : MobileVerification {
        $code = mt_rand(100000, 999999);
        $data['code'] = $code;
        MobileVerification::whereNotNull('user_id')->where(['user_id' => $data['user_id']])->delete();
        return MobileVerification::create($data);
    }

    protected function sendSMS(User $user, MobileVerification $mobileVerification) {

        $receiverNumber = $user->mobile;
        $message = "The Code for verification mobile number is : ".$mobileVerification->code;

        try {

            $account_sid = getenv("TWILIO_SID");
            $auth_token = getenv("TWILIO_TOKEN");
            $twilio_number = getenv("TWILIO_FROM");

            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number,
                'body' => $message]);

            // dd('SMS Sent Successfully.'.$client);

        } catch (Exception $e) {
            dd("Error: ". $e->getMessage());
        }
    }
}
