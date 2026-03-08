<x-app-layout>
    <div class="bg-[#0a0a0a] min-h-screen py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8 flex items-center gap-4">
                <span class="w-2 h-10 bg-[#df1873] rounded-full"></span>
                <h2 class="text-3xl font-black text-white tracking-tight">
                    {{ __('Account Settings') }}
                </h2>
            </div>

            <div class="space-y-8">
                <div class="p-6 sm:p-10 bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-[0_10px_40px_rgba(0,0,0,0.5)] rounded-[2rem] hover:border-gray-700 transition-colors">
                    <div class="max-w-2xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-6 sm:p-10 bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-[0_10px_40px_rgba(0,0,0,0.5)] rounded-[2rem] hover:border-gray-700 transition-colors">
                    <div class="max-w-2xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-6 sm:p-10 bg-red-950/10 backdrop-blur-xl border border-red-900/30 shadow-[0_10px_40px_rgba(0,0,0,0.5)] rounded-[2rem] hover:border-red-900/50 transition-colors">
                    <div class="max-w-2xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>