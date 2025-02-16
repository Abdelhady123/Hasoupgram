<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Followerrs extends Component
{
    public $userId;
    protected $user;
    protected $listeners=['followeUser'=>'getCountProperty'];

    public function getCountProperty(){
        $this->user=User::find($this->userId);
        return $this->user->followers()->wherePivot('confirmed',true)->count();
    }

    public function render()
    {
        return view('livewire.followerrs');
    }
}
