<div>
    <div class="max-h-96 flex flex-col">
        <div class="flex w-full items-center border-b border-b-neutral-100 p-2">
          <h1 class="text-lg font-bold pb-2 grow text-center">{{__('Followers')}} </h1>
          <button wire:click="$dispatch('closeModal')">
              <i class="bx bx-x text-xl"> </i>
          </button>
      
        </div>
        <div class="flex justify-center items-center "> <!-- توسيط عمودي وأفقي -->
            <ul class="overflow-y-auto max-w-md w-full p-4"> <!-- تحديد عرض أقصى وإضافة مساحة داخلية -->
                @forelse ($this->FollowersList as $follower)
                    <li class="flex items-center p-3 text-sm">
                        <!-- توسيط الصورة عموديًا وأفقيًا -->
                        <div class="flex items-center justify-center w-10 h-10 mr-2">
                            <img src="{{ $follower->image }}" class="w-8 h-8 rounded-full border border-neutral-300" alt="{{ $follower->username }}">
                        </div>
                        <div class="flex flex-col grow">
                            <div class="font-bold">
                                <a href="/{{ $follower->username }}">
                                    {{ $follower->username }}
                                </a>
                            </div>
                            <div class="text-sm text-neutral-500">
                                {{ $follower->name }}
                            </div>
                        </div>
                    </li>
                @empty
                    <div class="w-full p-3 text-center">
                        {{ __('You are not following anyone.') }}
                    </div>
                @endforelse
            </ul>
        </div>
      </div>
      </div>
