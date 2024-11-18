<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Jobs') }}
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
                
                <form method="POST" action="{{ route('employer.companyJobs.store') }}" enctype="multipart/form-data">
                    @csrf
                
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                
                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" required autofocus autocomplete="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>
                
                    <div class="mt-4">
                        <x-input-label for="category" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="">Choose category</option>
                            @forelse($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @empty
                            @endforelse
                        </select>
                        <x-input-error :messages="$errors->get('category')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" autofocus autocomplete="location" />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>
                
                    <div class="mt-4">
                        <x-input-label for="salary" :value="__('Salary')" />
                        <x-text-input id="salary" class="block mt-1 w-full" type="number" name="salary" :value="old('salary')" autofocus autocomplete="salary" />
                        <x-input-error :messages="$errors->get('salary')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="skill_level" :value="__('Skill Level')" />
                        <x-text-input id="skill_level" class="block mt-1 w-full" type="text" name="skill_level" :value="old('skill_level')" autofocus autocomplete="skill_level" />
                        <x-input-error :messages="$errors->get('skill_level')" class="mt-2" />
                    </div>
                    <div class="mt-4">
                        <x-input-label for="salary" :value="__('Type')" />
                        <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type')" autofocus autocomplete="type" />
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>
                
                    <div class="mt-4">
                        <x-input-label for="about" :value="__('About')" />
                        <textarea name="about" id="about" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full"></textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>
                
                    <hr class="my-5">
                
                    <div class="mt-4">
                        <div class="flex flex-col gap-y-5">
                            <x-input-label for="responsibilities" :value="__('Responsibilities')" />
                            @for ($i = 0; $i < 4; $i++)
                                <input type="text" class="py-3 rounded-lg border-slate-300 border" placeholder="Write your job responsibilities" name="responsibilities[]">
                            @endfor
                        </div>
                        <x-input-error :messages="$errors->get('responsibilities')" class="mt-2" />
                    </div>

                    <hr class="my-5">

                    <div class="mt-4">
                        <div class="flex flex-col gap-y-5">
                            <x-input-label for="qualifications" :value="__('Qualifications')" />
                            @for ($i = 0; $i < 4; $i++)
                                <input type="text" class="py-3 rounded-lg border-slate-300 border" placeholder="Write your job qualifications" name="qualifications[]">
                            @endfor
                        </div>
                        <x-input-error :messages="$errors->get('qualifications')" class="mt-2" />
                    </div>
                
                    <div class="flex items-center justify-end mt-4">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Add New Jobs
                        </button>
                    </div>
                </form>
                

            </div>
        </div>
    </div>
</x-app-layout>