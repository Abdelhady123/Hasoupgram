<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use LivewireUI\Modal\ModalComponent;
//تمرير البيانات الى مكونات liveware يعني انها ستكون مكشوفة  في jsلل علن
class FollowingModel extends ModalComponent
{
    public $userId;
    protected $user;
    
    public function getFollowingListProperty(){
    $this->user=User::find($this->userId);
    return $this->user->following()->wherePivot('confirmed',true)->get();
    }
    public function unfollow($userId){
        $following_user=User::find($userId);
        $this->user=User::find($this->userId);
        $this->user->unfollow($following_user);
        $this->dispatch('unfolloweUser');
    }
    public function render()
    {
        return view('livewire.following-model');
    }
}
