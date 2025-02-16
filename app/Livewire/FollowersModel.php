<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;


class FollowersModel extends ModalComponent
{
    public $userId;
    protected $user;
    
    public function getFollowersListProperty(){
    $this->user=User::find($this->userId);
    return $this->user->followers()->wherePivot('confirmed',true)->get();
    }
    
    public function render()
    {
        return view('livewire.followers-model');
    }
}
