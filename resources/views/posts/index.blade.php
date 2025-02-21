<x-app-layout>
    <div class="flex lg:flex-row flex-col-reverse max-w-3xl gap-8 mx-auto">
        {{-- leftside --}}
    <livewire:PostsList/>
    {{-- right side --}}
    <div class="lg:w-[60rem] w-[30rem] mx-auto lg:flex lg:flex-col pt-4">
        <div class="flex flex-row text-sm">
           <div class="mr-5">
            <a href="/{{auth()->user()->username}}">
                <img src="{{asset('storage/'. auth()->user()->image)}}" alt="{{auth()->user()->username}}" class="h-12 w-12 rounded-full border border-gray-300">
            </a>
           </div>
           <div class="flex flex-col">
             <a href="/{{auth()->user()->username}}" class="font-bold">
                {{auth()->user()->username}}
             </a>
             <div class="text-gray-500 text-sm">
                {{auth()->user()->name}}
               </div>
           </div>
        </div>
            {{-- اقتراحات الاصدقاء --}}
    <div class="mt-5">
        <h3 class="text-gray-500 font-bold">
            {{__('suggestion For You')}}
        </h3>
        <uL> 
            @foreach ($suggested_users as $suggested_user)
                <li class="flex flex-row my-5 text-sm justify-items-center">
                    <div class="mr-5">
                        <a href="/{{$suggested_user->username}}">
                            <img src="{{$suggested_user->image}}" class="rounded-full h-9 w-9 border border-gray-300">
                        </a>
                    </div>
                    <div class="flex flex-col grow">
                        <a href="{{$suggested_user->username}}"class="font-bold">
                            {{$suggested_user->username}}
                            {{-- لي اضهار كلمة متابعة في حال كان المستخدم يتابع صاحب الحساب --}}
                            @if(auth()->user()->is_follower($suggested_user))
                            <span class="text-xs text-gray-500">
                                {{__('Follower')}}
                            </span>
                            @endif
                        </a>
                        <div class="text-gray-500 text-sm">
                            {{$suggested_user->name}}
                        </div>
                    </div>
                    {{-- زر المتابعة --}}
                    
                    @if(auth()->user()->is_pending($suggested_user))
                     <span class="text-gray-500 font-bold">
                        {{__('pending')}}
                     </span>
                     @else
                    {{-- <a href="/{{$suggested_user->username}}/follow" class="text-blue-500 font-bold">
                      {{__('Follow')}}
                    </a> --}}
                    <livewire:follow-button :userId="$suggested_user->id" classes="text-blue-500 "/>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    {{--
    طرق استدعاء المكون في livewire
    @livewire('Counter')
    <livewire:Counter /> --}}
    </div>
</div>
</x-app-layout>