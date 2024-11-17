<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('My Company') }}
            </h2>
            @if($myCompany)
            @else
            <a href="{{ route('employer.company.create') }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                Add New
            </a>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                @if($myCompany) 
                    <div class="item-card flex flex-row justify-between items-center my-5">
                        <div class="flex flex-row items-center gap-x-3">
                            <img src="{{ Storage::url($myCompany->logo) }}" alt="" class="rounded-2xl object-contain w-[120px] h-[90px]">
                        </div>
                        <div  class="hidden md:flex flex-col">
                            <p class="text-slate-500 text-sm">Name</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $myCompany->name }}</h3>
                        </div> 
                        <div  class="hidden md:flex flex-col">
                            <p class="text-slate-500 text-sm">Date</p>
                            <h3 class="text-indigo-950 text-xl font-bold">{{ $myCompany->updated_at->format('d F Y') }}</h3>
                        </div>
                        <div class="hidden md:flex flex-row items-center gap-x-3">
                            <a href="{{ route('employer.company.edit', $myCompany) }}" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                                Edit
                            </a>
                            <form action="{{ route('employer.company.destroy', $myCompany) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus {{ $myCompany->name }}?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-bold py-4 px-6 bg-red-700 text-white rounded-full">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold">About</h3>
                        <p>{{ $myCompany->about }}</p>
                    </div>
                @else
                <p>Kamu belum memiliki company</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
