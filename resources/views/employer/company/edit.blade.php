<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Company') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">

                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <div class="py-3 w-full rounded-3xl bg-red-500 text-white">
                            {{$error}}
                        </div>
                    @endforeach
                @endif
                
                <form method="POST" action="{{ route('employer.company.update', $company) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                
                    <!-- Input Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" value='{{ $company->name }}' class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                
                    <!-- Input logo -->
                    <div class="mt-4">
                        <x-input-label for="logo" :value="__('Logo')" />
                        <x-text-input id="logo" class="block mt-1 w-full" type="file" name="logo" autofocus autocomplete="logo" />
                        <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="about" :value="__('About')" />
                        <x-text-input id="about" value='{{ $company->about }}' class="block mt-1 w-full" type="text" name="about" required autofocus autocomplete="about" />
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>
                
                    <!-- Submit Button -->
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Company
                        </button>
                    </div>
                </form>
                

            </div>
        </div>
    </div>
</x-app-layout>
