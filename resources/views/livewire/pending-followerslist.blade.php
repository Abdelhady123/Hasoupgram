<div>
    <li class="flex flex-row w-full p-3 items-center text-sm">

    @forelse (auth()->user()->pending_followers as $pending)
        <div>
            <img src="{{asset('storage/'.$pending->image)}}" class="w-8 h-8 mr-2 rounded-full border border-neutral-300" alt={{$pending->username}}>
        </div>
        <div class="flex flex-col grow">
            <div class="font-bold">
                <a href="/{{$pending->username}}">
                 {{$pending->username}}
                </a>
            </div>
        
        <div class="text-sm text-neutral-500">
            {{$pending->name}}
        </div>
        </div>
       <button class="border border-blue-500 bg-blue-500 text-white px-2 py-1 rounded mr-2"
       wire:click="confirm({{$pending->id}})">  
           {{__('Confirm')}}
       </button>
       <button class="border border-blue-500 px-2 py-1 rounded"
       wire:click="delete({{$pending->id}})">  
           {{__('Delete')}}
       </button>
    </li>
@empty
    <div class="w-full py-3 text-center">
        {{__('No pending follow request.')}}
    </div>
@endforelse
</ul>
</div>
