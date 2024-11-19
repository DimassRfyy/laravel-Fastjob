<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Details Candidate') }}
            </h2>
        </div>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <div class="item-card flex flex-col md:flex-row gap-y-10 justify-between md:items-center">
                    <div class="flex flex-row items-center gap-x-3">
                        <img src="{{ Storage::url($jobCandidate->companyJob->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px]">
                        <div class="flex flex-col">
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $jobCandidate->companyJob->name }}</h3>
                            <p class="text-slate-500 text-sm">{{ $jobCandidate->companyJob->category->name }}</p>
                        </div>
                    </div>
                    
                    <div class="hidden md:flex flex-row items-center gap-x-2">
                        <a href="{{ route('employer.candidate.approve', $jobCandidate->id) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Approve
                        </a>
                        <a href="{{ route('employer.candidate.reject', $jobCandidate->id) }}" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                            Reject
                        </a>
                    </div>
                </div>
                <hr class="my-5">
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

                    <div class="flex flex-col items-center gap-3">
                        <h3 class="text-indigo-950 text-xl font-bold">Candidate Resume</h3>
                        <a href="{{ route('employer.candidate.downloadResume', $jobCandidate->id) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Download Resume
                        </a>
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
