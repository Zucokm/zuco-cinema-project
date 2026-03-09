<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-blue-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                    <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-blue-500/20 rounded-xl group-hover:border-blue-500/50 transition-colors duration-300">
                        <svg class="w-6 h-6 text-blue-400 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    </div>
                </div>
                <div>
                    <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                        Customer Messages
                    </h2>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-0.5">Inbox & Feedback</p>
                </div>
            </div>
            
            <div class="bg-[#111] border border-gray-800 px-5 py-2.5 rounded-xl shadow-[0_0_15px_rgba(0,0,0,0.5)] flex items-center gap-3">
                <div class="flex h-3 w-3 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-500"></span>
                </div>
                <span class="text-sm font-bold text-gray-300 uppercase tracking-wider">Total Messages: <span class="text-white font-black text-lg ml-1">{{ $contacts->total() }}</span></span>
            </div>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-screen py-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] left-[-10%] w-[40rem] h-[40rem] bg-blue-600/10 rounded-full blur-[120px] pointer-events-none"></div>
        <div class="absolute bottom-[20%] right-[-10%] w-[30rem] h-[30rem] bg-[#df1873]/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="space-y-6">
                @forelse($contacts as $contact)
                    <div x-data="{ expanded: false }" class="bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-xl rounded-[1.5rem] p-6 sm:p-8 relative group hover:border-blue-500/30 transition-all duration-300">
                        
                        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center font-black text-white text-lg shadow-inner shadow-white/20 shrink-0">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                </div>
                                <div>
                                    <h3 class="text-lg font-black text-white tracking-wide">{{ $contact->name }}</h3>
                                    <a href="mailto:{{ $contact->email }}" class="text-sm font-medium text-blue-400 hover:text-blue-300 transition-colors flex items-center gap-1.5 mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                        {{ $contact->email }}
                                    </a>
                                </div>
                            </div>
                            
                            <div class="bg-[#0a0a0a] border border-gray-800 px-4 py-2 rounded-lg text-right shrink-0">
                                <div class="text-xs font-black text-gray-400 uppercase tracking-widest">{{ $contact->created_at->format('d M, Y') }}</div>
                                <div class="text-[10px] text-gray-500 font-bold mt-0.5">{{ $contact->created_at->format('h:i A') }}</div>
                            </div>
                        </div>

                        <div class="mb-4 flex items-center gap-3">
                            <span class="w-1.5 h-6 bg-blue-500 rounded-full"></span>
                            <h4 class="text-base font-bold text-gray-200 uppercase tracking-wider">
                                {{ $contact->subject ?? 'No Subject Provided' }}
                            </h4>
                        </div>

                        <div class="bg-[#0a0a0a]/50 border border-gray-800/60 rounded-xl p-5 relative">
                            <div class="absolute top-4 right-4 opacity-5 text-white pointer-events-none">
                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                            </div>
                            
                            <p class="text-gray-400 leading-relaxed font-medium whitespace-pre-line" :class="{'line-clamp-3': !expanded}">
                                {{ $contact->message }}
                            </p>
                            
                            @if(strlen($contact->message) > 250)
                            <button @click="expanded = !expanded" class="mt-3 text-xs font-bold text-blue-500 hover:text-blue-400 tracking-wider uppercase flex items-center gap-1 transition-colors">
                                <span x-text="expanded ? 'Show Less' : 'Read Full Message'"></span>
                                <svg :class="{'rotate-180': expanded}" class="w-3 h-3 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            @endif
                        </div>

                        <div class="absolute bottom-6 right-6 sm:bottom-8 sm:right-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-[#111] hover:bg-red-500/10 border border-gray-700 hover:border-red-500/30 text-gray-400 hover:text-red-500 p-2.5 rounded-xl transition-all duration-300 shadow-lg group/btn relative" title="Delete Message">
                                    <svg class="w-5 h-5 group-hover/btn:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    
                                    <span class="absolute -top-8 right-0 bg-red-500 text-white text-[10px] font-black px-2 py-1 rounded opacity-0 group-hover/btn:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">Delete</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-xl rounded-[1.5rem] p-12 text-center">
                        <div class="w-24 h-24 bg-[#0a0a0a] border border-gray-800 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-black text-white mb-2">Inbox is Empty</h3>
                        <p class="text-gray-500 font-medium max-w-sm mx-auto">You're all caught up! There are no new customer messages at the moment.</p>
                    </div>
                @endforelse
            </div>

            @if($contacts->hasPages())
                <div class="mt-10 bg-[#111]/80 backdrop-blur-md p-4 rounded-[1.5rem] border border-gray-800 shadow-xl">
                    {{ $contacts->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>