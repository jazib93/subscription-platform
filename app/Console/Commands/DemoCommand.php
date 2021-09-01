<?php

namespace App\Console\Commands;

use App\Forms\StoreUser;
use App\Services\UserService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class DemoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add users and posts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->userService = App::make(UserService::class);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->createUser();
    }

    private function createUser(){
        $userArr = [
            'name' => 'Jazib',
            'email' => 'jazib@gmail.com',
            'password' => Hash::make('12345678'),
        ];

        $userForm = new StoreUser();
        $userForm->loadFromArray($userArr);
        return $this->userService->store($userForm);
    }
}
