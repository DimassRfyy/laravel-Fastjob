<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Jobs') }}
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
                
                <form method="POST" action="{{ route('employer.companyJobs.update', $companyJob) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" value='{{ $companyJob->name }}' class="block mt-1 w-full" type="text" name="name"  required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                
                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" autofocus autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>
                
                    <div class="mt-4">
                        <x-input-label for="category" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="">Choose category</option>
                            @forelse($categories as $category)
                                <option value="{{ $category->id }}" {{ $category->id == $companyJob->category_id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @empty
                                <option value="" disabled>No categories available</option>
                            @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input value='{{ $companyJob->location }}' id="location" class="block mt-1 w-full" type="text" name="location"  autofocus autocomplete="location" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>
                
                    <div class="mt-4">
                        <x-input-label for="salary" :value="__('Salary')" />
                        <x-text-input id="salary" value='{{ $companyJob->salary }}' class="block mt-1 w-full" type="number" name="salary" autofocus autocomplete="salary" />
                        <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="skill_level" :value="__('Skill Level')" />
                        <x-text-input id="skill_level" value='{{ $companyJob->skill_level }}' class="block mt-1 w-full" type="text" name="skill_level" autofocus autocomplete="skill_level" />
                        <x-input-error :messages="$errors->get('skill_level')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="salary" :value="__('Type')" />
                        <x-text-input id="type" value='{{ $companyJob->type }}' class="block mt-1 w-full" type="text" name="type" autofocus autocomplete="type" />
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>
                
                    <div class="mt-4">
                        <x-input-label for="about" :value="__('About')" />
                        <textarea name="about" id="about" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full">{{ $companyJob->about }}</textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>
                
                    <hr class="my-5">
                
                    <div class="mt-4">
                        <div class="flex flex-col gap-y-5">
                            <x-input-label for="responsibilities" :value="__('Responsibilities')" />
                            @forelse ($companyJob->responsibilities as $responsibility)
                            <input type="text" value='{{ $responsibility->name }}' class="py-3 rounded-lg border-slate-300 border" placeholder="Write your job responsibilities" name="responsibilities[]">
                            @empty
                            @endforelse
                        </div>
                        <x-input-error :messages="$errors->get('responsibilities')" class="mt-2" />
                    </div>

                    <hr class="my-5">

                    <div class="mt-4">
                        <div class="flex flex-col gap-y-5">
                            <x-input-label for="qualifications" :value="__('Qualifications')" />
                            @forelse ($companyJob->qualifications as $qualification)
                            <input type="text" value='{{ $qualification->name }}' class="py-3 rounded-lg border-slate-300 border" placeholder="Write your job qualifications" name="qualifications[]">
                            @empty
                            @endforelse
                        </div>
                        <x-input-error :messages="$errors->get('qualifications')" class="mt-2" />
                    </div>
                
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit Jobs
                        </button>
                    </div>
                </form>
                

            </div>
        </div>
    </div>
</x-app-layout>
