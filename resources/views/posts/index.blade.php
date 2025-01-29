<x-app-layout>
<div class="flex flex-row max-w-3xl gap-8 mx-auto">
    {{-- leftside --}}
    <div class="w-[30rem] mx-auto lg:w-[95rem]">
        @forelse ($posts as $post)
        <x-post :post="$post"/>
        @empty
            <div class="max-w-2xl gap-8 mx-auto">
                {{__('Start Follwing Your Frends and Enjoy.')}}
            </div>
        @endforelse
       
    </div>
    {{-- right side --}}
    <div class="hidden w-[60rem] lg:flex lg:flex-col pt-4">
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
                        </a>
                        <div class="text-gray-500 text-sm">
                            {{$suggested_user->name}}
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
    </div>

</div>
</x-app-layout>