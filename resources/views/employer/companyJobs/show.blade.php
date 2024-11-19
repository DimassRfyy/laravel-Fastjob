<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Company Jobs') }}
            </h2>
            <a href="{{ route('employer.companyJobs.create') }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                
                
                <div class="item-card flex flex-col md:flex-row gap-y-10 justify-between md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($companyJob->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $companyJob->name }}</h3>
                            <p class="text-slate-500 text-sm">{{ $companyJob->category->name }}</p>
                        </div>
                    </div>
                    
                    <div class="hidden md:flex flex-row items-center gap-x-3">
                        <a href="{{ route('employer.companyJobs.edit', $companyJob) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Edit
                        </a>
                        <form action="{{ route('employer.companyJobs.destroy', $companyJob) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $companyJob->name }}?');">
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
                            <p class="text-slate-500 text-sm">{{ 'Rp ' . number_format($companyJob->salary, 0, ',', '.') }}</p>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">Job Type</h3>
                            <p class="text-slate-500 text-sm">{{ $companyJob->type }}</p>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">Location</h3>
                            <p class="text-slate-500 text-sm">{{ $companyJob->location }}</p>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">Skill Level</h3>
                            <p class="text-slate-500 text-sm">{{ $companyJob->skill_level }}</p>
                        </div>
                </div>
                <hr class="my-5">
                <div class="item-card flex flex-col md:flex-row justify-around gap-y-10 md:items-center">
                    <div class="flex flex-col gap-4">
                        <h3 class="text-indigo-950 text-2xl font-bold">Qualifications</h3>
                        @foreach ($companyJob->qualifications as $qualification)
                        <p class="text-slate-500 text-md">{{ $qualification->name }}</p>
                        @endforeach
                    </div>
                    <div class="flex flex-col gap-4">
                        <h3 class="text-indigo-950 text-2xl font-bold">Responsibilities</h3>
                        @foreach ($companyJob->responsibilities as $responsibility)
                        <p class="text-slate-500 text-md">{{ $responsibility->name }}</p>
                        @endforeach
                    </div>
                </div>
                <hr class="my-5">
                <div class="item-card flex flex-col md:flex-row gap-y-10 md:items-center">
                    <div class="flex flex-col">
                        <h3 class="text-indigo-950 text-xl font-bold">About</h3>
                        <p class="text-slate-500 text-sm">{{ $companyJob->about }}</p>
                    </div>
                </div>
                <hr class="my-5">
                <h3 class="text-indigo-950 text-xl font-bold">Applicants</h3>

                @forelse ($companyJob->candidates as $jobCandidate)
                    <div class="flex flex-row justify-between items-center">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($jobCandidate->user->avatar) }}" alt="" class="rounded-full object-cover w-[70px] h-[70px]">
                            <div class="flex flex-col">
                                <h3 class="text-indigo-950 text-xl font-bold">{{ $jobCandidate->user->name }}</h3>
                                <p class="text-slate-500 text-sm">{{ $jobCandidate->user->occupation }}</p>
                            </div>
                        </div>

                        @if($jobCandidate->is_hired === 1)
                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-green-500 text-white">
                                HIRED
                            </span>
                        @elseif($jobCandidate->is_hired === null)
                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-orange-500 text-white">
                                WAITING FOR APPROVAL
                            </span> 
                        @elseif($jobCandidate->is_hired === 0)
                            <span class="w-fit text-sm font-bold py-2 px-3 rounded-full bg-red-500 text-white">
                                REJECTED
                            </span>
                        @endif

                        <div class="flex flex-row items-center gap-x-3">
                            <a href="{{ route('employer.companyJobs.candidate', $jobCandidate) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                                Details
                            </a>
                        </div>
                    </div>
                @empty
                    <p>Belum ada candidate</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
