<x-app-layout>
    <form action="/{{$user->username}}/update" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
      <div class="space-y-12 mb-5">
        <div class="border-b border-gray-900/10 pb-12 card p-5">
              <!-- UserName -->
          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-4">
              <label for="username" class="block text-sm font-medium leading-6 text-gray-900">{{__('Username')}}</label>
              <div class="mt-2">
                <div class="flex rounded-md shadow-sm ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-600 sm:max-w-md">
                  <input type="text" name="username" id="username" autocomplete="username" class="block flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm sm:leading-6" value="{{$user->username}}">
                  @error('username')
                  <div class="mt-2 text-sm text-red-600">
                    {{$message}}
                  </div>
                  @enderror
                </div>
              </div>
            </div>
    
           <!-- Bio -->
            <div class="col-span-full">
              <label for="bio" class="block text-sm font-medium leading-6 text-gray-900">{{__('Bio')}}</label>
              <div class="mt-2">
                <textarea id="bio" name="bio" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400
                focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">{{$user->bio}}</textarea>
              </div>
            </div>
    
            <div class="col-span-full">
                <label for="image" class="block text-sm font-medium leading-6 text-gray-900">{{__('Photo')}}</label>
                <div class="mt-2 flex items-center gap-x-3">
                  <img src="{{asset('storage/'. auth()->user()->image)}}" class="h-12 w-12 object-cover rounded-full ltr:mr-5 rtl:ml-5 border border-gray-300">
                  <input class="w-full border border-gray-200 bg-gray-50 block focus:outline-none rounded-xl"
                    name="image" id="file_input" type="file">
                 </div>
                @error('image')
                <div class="mt-2 text-sm text-red-600">
                  {{$message}}
                </div>
                @enderror
            </div>
    
            <div class="flex align-items-start items-center">
              <label for="private_account" class="block text-md font-bold leading-6 text-gray-900 me-2">{{__('Private account')}}</label>
              <input type="checkbox" name="private_account" id="private_account"
              autocomplete="private_account" class="focus:ring-neutral-500 h-4 w-4 text-neutral-600 border-gray-300 rounded" {{ $user->private_account ? 'checked': ''}}>
              </div>
            </div>
            <div class="col-span-6 sm:col-span-3">
              <label for="lang" class="block text-sm font-medium text-gray-700">
                {{__('Language')}}
              </label>
              <select id="lang" name="lang"
              class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 ltr:px-3 rtl-px-8 shadow-sm focus:border-indigo-500 focus:outline-none ">
              <option value="ar" {{app()->getLocale()=='ar'?'selected':''}}>العربية</option>
              <option value="en" {{app()->getLocale()=='en'?'selected':''}}>English </option>
            </select>
            </div>
            <div class="mt-6 flex items-center justify-end gap-x-6">
                <x-button>{{ __('Save') }}</x-button>
              </div>
          </div>
        </div>
    
        <div class="border-b border-gray-900/10 pb-12 card p-5">
          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="sm:col-span-3 sm:col-end-4">
              <label for="name" class="block text-sm font-medium leading-6 text-gray-900">{{__('Name')}}</label>
              <div class="mt-2">
                <input type="text" name="name" id="name" autocomplete="name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{$user->name}}">
              </div>
            </div>
    
            <div class="sm:col-span-3 sm:col-end-4">
              <label for="email" class="block text-sm font-medium leading-6 text-gray-900">{{__('Email')}}</label>
              <div class="mt-2">
                <input type="text" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" value="{{$user->email}}">
              </div>
            </div>
    
            <div class="sm:col-span-3 sm:col-end-4">
              <label for="password" class="block text-sm font-medium leading-6 text-gray-900">{{__('Password')}}</label>
              <div class="mt-2">
                <input id="password" name="password" type="password" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
    
            <div class="sm:col-span-3 sm:col-end-4">
              <label for="password_confirmation" class="block text-sm font-medium leading-6 text-gray-900">{{__('Password Confirmation')}}</label>
              <div class="mt-2">
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
              </div>
            </div>
          </div>
          <div class="mt-6 flex items-center justify-end gap-x-6">
            <x-button>{{ __('Save') }}</x-button>
          </div>
        </div>   
      </div>  
    </form>
    </x-app-layout>