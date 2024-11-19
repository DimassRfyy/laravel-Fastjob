<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('output.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
</head>
<body class="font-poppins text-[#0E0140] pb-[100px] overflow-x-hidden">
    <div id="page-background" class="absolute h-[533px] w-full top-0 -z-10 overflow-hidden">
        <img src="/assets/backgrounds/Group 2009.png" class="w-full h-full object-fill" alt="background">
    </div>
   @include('includes.navbar')
    <form method="POST" enctype="multipart/form-data" action="{{ route('front.store_apply', $companyJob->id) }}" class="relative max-w-[900px] mx-auto flex flex-col rounded-[20px] bg-white border border-[#E8E4F8] p-[30px] gap-10 shadow-[0_8px_30px_0_#0E01400D] mt-[130px]">
        @csrf
        <div class="absolute -top-[60px] left-[50px] w-[120px] h-[120px] p-5 flex shrink-0 items-center justify-center bg-white rounded-[20px] border border-[#E8E4F8] shadow-[0_8px_30px_0_#0E01400D]">
            <img src="{{ Storage::url($companyJob->company->logo) }}" class="object-contain w-full h-full" alt="logo">
        </div>
        <div id="Title" class="flex flex-col pt-[60px] gap-[10px]">
            <p id="HiringBadge" class="rounded-full p-[8px_20px] bg-[#7521FF] font-bold text-white w-fit">WE’RE HIRING!</p>
            <h1 class="font-bold text-[32px] leading-[48px]">{{ $companyJob->name }}</h1>
            <p>{{ $companyJob->category->name }} • Posted at {{ $companyJob->created_at->format('d F Y') }}</p>
        </div>
        <div id="Feature" class="flex items-center gap-6">
            <div class="flex items-center gap-[6px]">
                <div class="flex shrink-0 w-[38px] h-[38px]">
                    <img src="/assets/icons/note-favorite-orange.svg" alt="icon">
                </div>
                <p class="font-semibold text-lg leading-[27px]">{{ $companyJob->type }}</p>
            </div>
            <div class="flex items-center gap-[6px]">
                <div class="flex shrink-0 w-[38px] h-[38px]">
                    <img src="/assets/icons/personalcard-yellow.svg" alt="icon">
                </div>
                <p class="font-semibold text-lg leading-[27px]">{{ $companyJob->skill_level }}</p>
            </div>
            <div class="flex items-center gap-[6px]">
                <div class="flex shrink-0 w-[38px] h-[38px]">
                    <img src="/assets/icons/moneys-cyan.svg" alt="icon">
                </div>
                <p class="font-semibold text-lg leading-[27px]">{{ 'Rp ' . number_format($companyJob->salary, 0, ',', '.') }}</p>
            </div>
            <div class="flex items-center gap-[6px]">
                <div class="flex shrink-0 w-[38px] h-[38px]">
                    <img src="/assets/icons/location-purple.svg" alt="icon">
                </div>
                <p class="font-semibold text-lg leading-[27px]">{{ $companyJob->location }}</p>
            </div>
        </div>
        <div id="Cover-Letter-Container" class="flex flex-col gap-4">
            <p class="font-semibold text-xl leading-[30px]">Write Best Cover Letter</p>
            <div class="flex rounded-[20px] border border-[#0E0140] p-[14px_24px] gap-[10px] focus-within:border-[#FF6B2C] transition-all duration-300">
                <div class="w-6 h-5 flex shrink-0 mt-[2px]">
                    <img src="/assets/icons/award.svg" alt="icon">
                </div>
                <textarea name="message" id="coverLetter" rows="9" class="appearance-none outline-none w-full font-semibold placeholder:text-[#0E0140]" placeholder="Tell your great skills and experiences"></textarea>
            </div>
        </div>
        <div id="Resume-Container" class="flex flex-col gap-4">
            <p class="font-semibold text-xl leading-[30px]">Complete Your Profile</p>
            <div class="flex rounded-[20px] border border-[#0E0140] p-[14px_24px] gap-[10px] focus-within:border-[#FF6B2C] transition-all duration-300">
                <div class="w-6 h-5 flex shrink-0 mt-[2px]">
                    <img src="/assets/icons/brifecase-tick.svg" alt="icon">
                </div>
                <button type="button" id="fileButton" class="font-semibold w-full text-left" onclick="document.getElementById('fileInput').click();">Add your resume .PDF</button>
                <input type="file" name="resume" id="fileInput" class="hidden" accept=".pdf"></input>
            </div>
        </div>
        <hr class="border-[#E8E4F8]">
        <div id="CTA" class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 flex shrink-0">
                    <img src="/assets/icons/security-user.svg" alt="icon">
                </div>
                <p class="font-semibold">We use Privacy to secure your data 100%</p>
            </div>
            <div class="flex items-center gap-3">
                <button type="submit" class="rounded-full p-[14px_24px] bg-[#FF6B2C] font-semibold text-white hover:shadow-[0_10px_20px_0_#FF6B2C66] transition-all duration-300">Submit My Application</button>
            </div>
        </div>
    </form>

    <script src="{{ asset('js/fileInput.js') }}"></script>
</body>
</html>