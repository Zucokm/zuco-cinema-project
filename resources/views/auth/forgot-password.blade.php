<x-guest-layout>
    <div class="min-h-screen w-full flex items-center justify-center relative overflow-hidden px-4 sm:px-6">
        
        <div class="absolute top-[-10%] left-[-10%] w-[30rem] h-[30rem] bg-[#df1873]/20 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[30rem] h-[30rem] bg-purple-600/20 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="w-full max-w-md bg-[#111]/80 backdrop-blur-xl rounded-[2rem] p-8 md:p-10 border border-gray-800 shadow-[0_20px_50px_rgba(0,0,0,0.5)] relative z-10 transform transition-all duration-500 hover:border-gray-700">
            
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-[#0a0a0a] border border-gray-800 mb-6 shadow-lg">
                    <svg class="w-8 h-8 text-[#df1873]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path></svg>
                </div>
                <h2 class="text-3xl font-black text-white mb-2 tracking-tight">Reset Password</h2>
                <p class="text-sm text-gray-400 leading-relaxed">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.
                </p>
            </div>

            @if(session('status'))
                <div class="mb-8 bg-green-900/20 border border-green-500/50 text-green-400 px-4 py-3 rounded-xl text-sm font-medium flex items-start gap-3">
                    <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-bold text-gray-300 mb-2">Email Address</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-500 group-focus-within:text-[#df1873] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                               class="w-full bg-[#0a0a0a] border border-gray-800 text-white pl-12 pr-4 py-3.5 rounded-xl focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 placeholder-gray-600 transition-all shadow-inner text-sm font-medium">
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs font-bold mt-2 flex items-center gap-1">
                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <button type="submit" class="w-full bg-[#df1873] hover:bg-[#c21463] text-white font-bold py-4 rounded-xl transition-all shadow-[0_0_20px_rgba(223,24,115,0.3)] hover:shadow-[0_0_25px_rgba(223,24,115,0.5)] flex justify-center items-center gap-2 group mt-8">
                    <span>Send Reset Link</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>

            </form>

            <p class="mt-8 text-center text-sm text-gray-500 font-medium border-t border-gray-800/50 pt-8">
                Remember your password? 
                <a href="{{ route('login') }}" class="font-bold text-white hover:text-[#df1873] transition-colors relative after:absolute after:bottom-0 after:left-0 after:h-[2px] after:w-0 after:bg-[#df1873] hover:after:w-full after:transition-all after:duration-300">Back to Login</a>
            </p>
        </div>
    </div>
</x-guest-layout>