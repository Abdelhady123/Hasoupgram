<x-app-layout>
  {{-- اضهار الرسالة التي تعني اتمام عملية التعديل على الحساب --}}
    <div class="{{session('success')? '':'hidden'}} w-50 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg absolute right-10 shadow shadow-neutral-200" role="alert">
    <span class="font-medium">{{session('success')}}</span>
  </div>
    
    {{-- user Image --}}
<div class="grid grid-cols-4">
    <div class="px-4 col-span-1 order-1">
        <img src="{{asset('storage/'.$user->image)}}" alt="{{$user->username}}' profile picture'"
        class="w-20 rounded-full md:w-40 border border-gray-300">
    </div>
    {{-- username and buttons --}}
   <div class="px-4 col-span-2 md:ml-0 items-center flex flex-row order-2 md:col-span-3">
    <div class="text-3xl my-10">
        {{$user->username}}
    </div>
    <div class="ml-3 my-12">
      @auth
      @if($user->id === auth()->id())
        <a href="/{{$user->username}}/edit"
        class="w-50 px-5 border text-sm font-bold py-1 rounded-md border-neutral-300 text-center">
      {{__('Edit profile')}}
       </a>
       @elseif(auth()->user()->is_following($user))
       <a href="/{{$user->username}}/unfollow" class="w-30 bg-gray-400 text-white px-3 py-1 rounded text-center self-start">
        {{__('UnFollow')}}
       </a>
       @elseif(auth()->user()->is_pending($user))
       <span class="w-30 bg-gray-400 text-white px-3 py-1 rounded text-center self-start">
          {{__('pending')}}
       </span>
       @else 
       <a href="/{{$user->username}}/follow"class="w-30 bg-blue-400 text-white px-3 py-1 rounded text-center self-start">
         {{__('Follow')}}
       </a>
      @endif
      @endauth

      @guest
      <a href="/{{$user->username}}/follow"class="w-30 bg-blue-400 text-white px-3 py-1 rounded text-center self-start">
        {{__('Follow')}}
      </a>
      @endguest
    </div>

   </div>
   {{-- user info --}}
   <div class="text-md mt-8 px-4 col-span-3 col-start-1 order-3 md:col-start-2 md:order-4 md:mt-0">
      <p class="font-bold">{{$user->name}}</p>
      {!! nl2br(e($user->bio)) !!}
   </div>
   {{-- user stats --}}
   <div class="col-span-4 my-5 py-2 border-y border-y-neutral-200 order-4 md:order-3 md:border-none md:px-4 md:col-start-2">
    <div class="text-md flex flex-row justify-around md:justify-start md:space-x-10 md:text-xl">
        <li class="flex flex-col md:flex-row text-center">
          <div class="md:mr-1 font-bold md:font-normal">
            {{$user->posts->count()}}
          </div>
          <span class="text-neatral-500 md:text-black">
             {{$user->posts->count() >1 ?'posts':'post'}}
          </span>
        </li>
        <li class="flex flex-col md:flex-row text-center">
          <div class="md:mr-1 font-bold md-font-normal">
            {{$user->Followers()->count()}}
          </div>
          <span class="text-neutral-500 md:text-black">
          {{$user->Followers()->count()>1 ?__('followers'):__('follower')}}
          </span>
        </li>
        <li class="flex flex-col md:flex-row text-center">
          <div class="md:mr-1 font-bold md:font-normal">
            {{$user->following()->wherePivot('confirmed',true)->get()->count()}}
          </div>
          <span class="text-neutral-500 md:text-black">
           {{__('following')}}
          </span>
        </li>
        
    </div>
   </div>
</div>
{{-- bootom show  posts--}}
@if($user->posts()->count() > 0 and ($user->private_account == false or auth()->id()==$user->id or auth()->user()->is_following($user)))
<div class="grid grid-cols-3 gap-1 my-5">
  @foreach ($user->posts as $post)
      <a href="/p/{{$post->slug}}" class="aspect-square block w-full">
        <img src="{{ asset('storage/'.$post->image) }}" alt="{{$post->description}}" class="w-full aspect-square object-cover">
      </a>
  @endforeach
</div>

@else

<div class="w-full text-center mt-20">
  @if($user->private_account == true and $user->id != auth()->id())
   
    {{__('This Account is Private. follow to see their photos.')}}

    @else

    {{__('This User does not have any posts')}}

    @endif
</div>
@endif
</x-app-layout>