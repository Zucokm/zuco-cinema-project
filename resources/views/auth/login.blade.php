<x-guest-layout>
    <div class="min-h-screen w-full flex items-center justify-center relative overflow-hidden px-4 sm:px-6">
        
        <div class="absolute top-[-10%] left-[-10%] w-[30rem] h-[30rem] bg-[#df1873]/20 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[30rem] h-[30rem] bg-purple-600/20 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="w-full max-w-md bg-[#111]/80 backdrop-blur-xl rounded-[2rem] p-8 md:p-10 border border-gray-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)] relative z-10 transform transition-all duration-500 hover:border-gray-700">
            
            <div class="text-center mb-10">
                <a href="/" class="inline-flex items-center justify-center mb-6 group">
                    <div class="w-16 h-16 rounded-2xl bg-[#0a0a0a] border border-gray-800 flex flex-col items-center justify-center shadow-lg group-hover:border-[#df1873]/50 transition-colors">
                        <span class="text-xl font-extrabold tracking-widest text-white group-hover:text-indigo-400 transition-colors leading-none">ZUCO</span>
                    </div>
                </a>
                <h2 class="text-3xl font-black text-white mb-2 tracking-tight">Welcome Back</h2>
                <p class="text-sm text-gray-400">Sign in to continue to your account</p>
            </div>

            @if(session('status'))
                <div class="mb-6 bg-green-900/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl text-sm font-medium flex items-center gap-2">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-bold text-gray-300 mb-2">Email Address</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-[#df1873] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                               class="w-full bg-[#0a0a0a] border border-gray-800 text-white pl-12 pr-4 py-3.5 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 placeholder-gray-600 transition-all shadow-inner text-sm font-medium">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs font-bold mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div x-data="{ showPassword: false }">
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-sm font-bold text-gray-300">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-xs font-bold text-[#df1873] hover:text-[#c21463] transition-colors">Forgot Password?</a>
                        @endif
                    </div>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-[#df1873] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" 
                               class="w-full bg-[#0a0a0a] border border-gray-800 text-white pl-12 pr-12 py-3.5 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 placeholder-gray-600 transition-all shadow-inner text-sm font-medium">
                        
                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-500 hover:text-white focus:outline-none transition-colors">
                            <svg x-show="!showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            <svg x-show="showPassword" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path></svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-xs font-bold mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-2">
                    <label for="remember_me" class="flex items-center cursor-pointer group">
                        <div class="relative flex items-center">
                            <input id="remember_me" type="checkbox" name="remember" class="peer sr-only">
                            <div class="w-5 h-5 bg-[#0a0a0a] border border-gray-700 rounded peer-checked:bg-[#df1873] peer-checked:border-[#df1873] transition-all flex items-center justify-center">
                                <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                        <span class="ml-3 text-sm font-medium text-gray-400 group-hover:text-gray-300 transition-colors">Remember me</span>
                    </label>
                </div>

                <button type="submit" class="w-full bg-[#df1873] hover:bg-[#c21463] text-white font-bold py-4 rounded-xl transition-all shadow-[0_0_20px_rgba(223,24,115,0.3)] hover:shadow-[0_0_25px_rgba(223,24,115,0.5)] flex justify-center items-center gap-2 group mt-8">
                    <span>Sign In</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>

            </form>

            @if (Route::has('register'))
            <p class="mt-8 text-center text-sm text-gray-500 font-medium border-t border-gray-800/50 pt-8">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-bold text-white hover:text-[#df1873] transition-colors relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-0 after:bg-[#df1873] hover:after:w-full after:transition-all after:duration-300">Create one now</a>
            </p>
            @endif
        </div>
    </div>
</x-guest-layout>