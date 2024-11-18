{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('output.css') }}" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
      rel="stylesheet" />
    <!-- CSS for carousel/flickity-->
    <link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css" />
  </head>
  <body class="font-poppins text-[#0E0140] pb-[100px] overflow-hidden max-w-[1280px] mx-auto">
    <aside class="fixed left-0 top-0 h-screen w-[640px]">
      <div class="relative h-full flex items-end w-full">
        <img
          src="./assets/photos/Smiley-Woman-on-Floor-1.png"
          alt="woman"
          class="absolute flex -z-10 object-cover min-h-screen" />
          <div
          class="bg-white flex flex-col z-10 w-[580px] rounded-[20px] border border-[#E8E4F8] p-5 gap-4 ml-[30px] mb-[30px] shadow-[0px_8px_30px_0px_rgba(14,1,64,0.05)]">
          <p class="font-semibold text-base leading-8">
            Berkat FastJob saya bisa bekerja dari rumah dengan santai tanpa harus macet-macetan.
            Seluruh lokernya juga aman bebas dari penipuan yang sering terjadi saat ini di seluruh
            dunia.
          </p>
          <div class="flex items-center justify-between">
            <div class="flex items-center gap-[14px]">
              <img src="./assets/photos/photo.png" alt="photos" class="w-[60px] h-[6opx]" />
              <div class="flex flex-col justify-start">
                <p class="font-semibold text-base leading-6">Vanica laras</p>
                <p class="font-normal text-sm leading-[21px]">Programmer</p>
              </div>
            </div>
            <img src="./assets/icons/stars-group.png" alt="stars" class="h-6" />
          </div>
        </div>
      </div>
    </aside>
    <main class="ml-[700px] mr-[70px] flex-1 min-h-screen ">
      <section
        id="content"
        class="w-full min-h-screen mx-auto flex flex-col justify-center bg-white -z-20">    
          <form action="{{ route('login') }}" class="flex flex-col gap-[30px]" method="POST">
            @csrf
            <div class="flex items gap-3">
              <img src="./assets/icons/logo.svg" alt="logo" class="w-10 h-10" />
              <h1 class="text-2xl font-black leading-9">FASTJOB</h1>
            </div>
            <h1 class="text-[26px] font-bold leading-[39px] mt-[40px]">Sign In</h1>
            <div class="flex flex-col gap-6 mb-3">
              <div class="flex flex-col gap-2 group">
                <label for="email" class="text-base leading-6 font-semibold">Email Address</label>
                <div
                  class="flex items-center gap-2 p-[14px_24px] border ring-[#0E0140] rounded-full focus-within:ring-2 focus-within:ring-[#FF6B2C] transition-all duration-300">
                  <div class="w-6 h-6 flex shrink-0">
                    <img src="./assets/icons/sms.svg" alt="" />
                  </div>
                  <input :value="old('email')" required autofocus autocomplete="username"
                    type="email"
                    name="email"
                    class="appearance-none outline-none w-full bg-white placeholder:text-[#0E0140] placeholder:text-base placeholder:leading-6 placeholder:font-normal text-base font-semibold"
                    placeholder="example@gmail.com"
                    required />
                </div>
              </div>
              <div class="flex flex-col gap-2 group">
                <label for="password" class="text-base leading-6 font-semibold">Password</label>
                <div
                  class="flex items-center gap-2 p-[14px_24px] border ring-[#0E0140] rounded-full focus-within:ring-2 focus-within:ring-[#FF6B2C] transition-all duration-300">
                  <div class="w-6 h-6 flex shrink-0">
                    <img src="./assets/icons/lock.svg" alt="" />
                  </div>
                  <input
                    type="password"
                    name="password"
                    autocomplete="off"
                    class="appearance-none outline-none w-full bg-white placeholder:text-[#0E0140] placeholder:text-base placeholder:leading-6 placeholder:font-normal text-base font-semibold"
                    placeholder="Enter your password"
                    required />
                </div>
                <div class="flex flex-1 justify-between mb-6">
                  <a href="#" class="font-normal text-sm leading-[21px] hover:underline hover:underline-offset-2 transition-all duration-300">Forgot Password</a>
                </div>
              </div>
            </div>
            <button
              type="submit"
              class="bg-[#FF6B2C] p-[12px_24px] w-full h-12 flex items-center gap-3 rounded-full justify-center">
              <p class="text-base leading-6 font-semibold text-white">Sign In to My Account</p>
            </button>
            <a 
              href="{{ route('register') }}"
              class="bg-white p-[12px_24px] w-full h-12 flex items-center gap-3 rounded-full justify-center border border-[#0E0140]">
              <p class="text-base leading-6 font-semibold">Create New Account</p>
            </a>
          </form>
      </section>
    </main>
  </body>
</html>

