<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-[#0E0140] pb-[100px] overflow-x-hidden">
    <div id="page-background" class="absolute h-[863px] w-full top-0 -z-10 overflow-hidden">
        <img src="assets/backgrounds/Group 2009.png" class="w-full h-full object-fill" alt="background">
    </div>
    @include('includes.navbar')
    <header class="container max-w-[1130px] mx-auto flex items-center justify-between gap-[50px] mt-[70px]">
        <div class="flex flex-col items-center w-full gap-[30px]">
            <h1 class="font-black text-[36px] leading-[50px] text-white text-center">Explore 10,000 <br>Most Popular Jobs</h1>
            <form action="{{ route('front.search') }}" method="GET" class="w-[579px] flex items-center bg-white rounded-full pl-6 h-fit focus-within:ring-2 focus-within:ring-[#FF6B2C] transition-all duration-300">
                <div class="flex items-center w-full mr-6 gap-[10px]">
                    <div class="flex shrink-0">
                        <img src="assets/icons/search-normal.svg" alt="icon">
                    </div>
                    <input type="text" name="query" autocomplete="off" class="appearance-none w-full outline-none font-semibold placeholder:font-normal placeholder:text-[#0E0140] focus:outline-none" placeholder="Quick search your dream job...">
                </div>
                <button type="submit" class="rounded-full py-5 px-[30px] bg-[#FF6B2C] font-semibold text-white text-nowrap hover:shadow-[0_10px_20px_0_#FF6B2C66] transition-all duration-300">Explore Now</button>
            </form>
        </div>
    </header>
    <section id="Result" class="container max-w-[1130px] mx-auto flex flex-col gap-[30px] mt-[70px] w-fit">
        <h2 class="font-bold text-2xl leading-[36px] text-white">Search Result: {{ $query }}</h2>
        <div class="categories-container grid grid-cols-3 gap-[30px]">
           @forelse ($companyJobs as $jobs)
           <a href="{{ route('front.details', $jobs->slug) }}" class="card w-[300px] flex flex-col shrink-0 rounded-[20px] border border-[#E8E4F8] p-5 gap-5 bg-white shadow-[0_8px_30px_0_#0E01400D] hover:ring-2 hover:ring-[#FF6B2C] transition-all duration-300">
            <div class="company-info flex items-center gap-3">
                <div class="w-[70px] flex shrink-0 overflow-hidden">
                    <img src="{{ Storage::url($jobs->thumbnail) }}" class="object-contain w-full h-full" alt="logo">
                </div>
                <div class="flex flex-col">
                    <p class="font-semibold">{{ $jobs->company->name }}</p>
                    <p class="text-sm leading-[21px]">Posted at</p>
                    <p class="text-xs font-thin">{{ $jobs->created_at->format('d F Y') }}</p>
                </div>
            </div>
            <hr class="border-[#E8E4F8]">
            <p class="job-title font-bold text-lg leading-[27px] h-[54px] flex shrink-0 line-clamp-2">{{ $jobs->name }}</p>
            <div class="job-info flex flex-col gap-[14px]">
                <div class="flex items-center gap-[6px]">
                    <div class="flex shrink-0 w-6 h-6">
                        <img src="assets/icons/note-favorite-orange.svg" alt="icon">
                    </div>
                    <p class="font-medium">{{ $jobs->type }}</p>
                </div>
                <div class="flex items-center gap-[6px]">
                    <div class="flex shrink-0 w-6 h-6">
                        <img src="assets/icons/moneys-cyan.svg" alt="icon">
                    </div>
                    <p class="font-medium">{{ $jobs->skill_level }}</p>
                </div>
                <div class="flex items-center gap-[6px]">
                    <div class="flex shrink-0 w-6 h-6">
                        <img src="assets/icons/location-purple.svg" alt="icon">
                    </div>
                    <p class="font-medium">{{ $jobs->location }}</p>
                </div>
            </div>
            <hr class="border-[#E8E4F8]">
            <div class="flex items-center justify-between">
                <div class="flex flex-col gap-[2px]">
                    <p class="font-bold text-lg leading-[27px]">{{ 'Rp ' . number_format($jobs->salary, 0, ',', '.') }}</p>
                    <p class="text-sm leading-[21px]">/month</p>
                </div>
                <span class="rounded-full p-[14px_24px] bg-[#FF6B2C] font-semibold text-white hover:shadow-[0_10px_20px_0_#FF6B2C66] transition-all duration-300">Details</span>
            </div>
        </a>
           @empty
               <p>Tidak Menemukan Pekerjaan yg cocok</p>
           @endforelse
        </div>
        <div id="Pagination" class="flex items-center justify-center gap-[14px] mt-10">
            {{ $companyJobs->appends(request()->input())->links('includes.pagination') }}
        </div>
    </section>
</body>
</html>