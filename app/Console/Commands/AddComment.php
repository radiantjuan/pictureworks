<?php

namespace App\Console\Commands;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ValidatedInput;

class AddComment extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Users:AddComment {ID} {COMMENT}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command add comments for the existing users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle() {
        $rules = ['id' => 'numeric', 'comment' => 'min:8'];
        $input = [
            'id' => $this->argument('ID'),
            'comment' => $this->argument('COMMENT')
        ];
        $errors = Validator::make($input, $rules)->errors();

        if (!empty($errors->messages())) {
            foreach ($errors->messages() as $error_message) {
                $this->error($error_message[0]);
            }
        } else {
            $user = User::find($input['id']);
            if (!empty($user)) {
                $user = User::add_comment($user, $input);
                $this->line("Update success!");
                $this->line("You can check the update in " . env('APP_URL') . "/users/" . $user->id);
            } else {
                $this->error('ID does not exists in the database');
            }
        }
        return 0;
    }
}
