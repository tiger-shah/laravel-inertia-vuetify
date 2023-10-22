<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Spatie\Permission\Models\Role;

class CreateSuperAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:superadmin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $roleName = 'Super Admin';

        $role = Role::where('name', $roleName)->first();
        if (! $role) {
            $role = Role::create(['name' => $roleName]);
        }

        if (User::role($roleName)->count()) {
            $this->error('Super admin is already declared. You can`t set more than one super admins.');
            return;
        }

        $this->info('Please answer these questions. These information is editable for later:');

        $firstName = $this->validate_cmd(function() {
            return $this->ask('What is super admin`s first name? Like "Alireza"');
        }, ['required', 'min:2']);

        $lastName = $this->validate_cmd(function() {
            return $this->ask('And what`s last name? Like "Malayeri"');
        }, ['required', 'min:2']);

        $email = $this->validate_cmd(function() {
            return $this->ask('Ok, what about email? Like "tigershah@gmail.com"');
        }, ['required', 'email']);

        $password = $this->validate_cmd(function() {
            return $this->secret('Now declare password. (Invisible)');
        }, ['required', Password::min(6)->letters()->numbers()]);

        $user = User::create([
            'first_name'    => $firstName,
            'last_name'     => $lastName,
            'email'         => $email,
            'password'      => Hash::make($password)
        ]);

        $user->assignRole($role);

        $this->info('Super admin created :)');
    }

    /**
     * Validate an input.
     *
     * @param  mixed   $method
     * @param  array   $rules
     * @return string
     */
    public function validate_cmd($method, $rules)
    {
        $value = $method();
        $validate = $this->validateInput($rules, $value);

        if ($validate !== true) {
            $this->warn($validate);
            $value = $this->validate_cmd($method, $rules);
        }
        return $value;
    }

    public function validateInput($rules, $value)
    {

        $validator = Validator::make([$rules[0] => $value], [ $rules[0] => $rules[1] ]);

        if ($validator->fails()) {
            $error = $validator->errors();
            return $error->first($rules[0]);
        }else{
            return true;
        }

    }
}
