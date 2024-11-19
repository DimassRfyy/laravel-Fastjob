<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Jobs Application Details') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                
                
                <div class="item-card flex flex-col md:flex-row gap-y-10 justify-between md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($jobCandidate->companyJob->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $jobCandidate->companyJob->name }}</h3>
                            <p class="text-slate-500 text-sm">{{ $jobCandidate->companyJob->category->name }}</p>
                        </div>
                    </div>
                    
                    <div class="hidden md:flex flex-row items-center gap-x-3">
                        <form action="{{ route('employee.applications.destroy', $jobCandidate) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $companyJob->name }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
                <hr class="my-5">
                <div class="item-card flex flex-col md:flex-row gap-y-10 justify-around md:items-center">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">Salary</h3>
                            <p class="text-slate-500 text-sm">{{ 'Rp ' . number_format($jobCandidate->companyJob->salary, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">Job Type</h3>
                            <p class="text-slate-500 text-sm">{{ $jobCandidate->companyJob->type }}</p>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">Location</h3>
                            <p class="text-slate-500 text-sm">{{ $jobCandidate->companyJob->location }}</p>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">Skill Level</h3>
                            <p class="text-slate-500 text-sm">{{ $jobCandidate->companyJob->skill_level }}</p>
                        </div>
                </div>
                <hr class="my-5">
                <div class="item-card flex flex-col md:flex-row justify-around gap-y-10 md:items-center">
                    <div class="flex flex-col gap-4">
                        <h3 class="text-indigo-950 text-2xl font-bold">Qualifications</h3>
                        @foreach ($jobCandidate->companyJob->qualifications as $qualification)
                        <p class="text-slate-500 text-md">{{ $qualification->name }}</p>
                        @endforeach
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="text-indigo-950 text-2xl font-bold">Responsibilities</h3>
                        @foreach ($jobCandidate->companyJob->responsibilities as $responsibility)
                        <p class="text-slate-500 text-md">{{ $responsibility->name }}</p>
                        @endforeach
                    </div>
                </div>
                <hr class="my-5">
                <div class="item-card flex flex-col md:flex-row gap-y-10 md:items-center">
                    <div class="flex flex-col">
                        <h3 class="text-indigo-950 text-xl font-bold">Message</h3>
                        <p class="text-slate-500 text-sm">{{ $jobCandidate->message }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
