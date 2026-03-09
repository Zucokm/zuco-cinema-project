<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-4 group">
                <div class="relative">
                    <div class="absolute inset-0 bg-yellow-500 blur-lg opacity-20 group-hover:opacity-40 transition-opacity duration-500 rounded-xl"></div>
                    <div class="relative p-2.5 bg-[#111]/80 backdrop-blur-md border border-yellow-500/20 rounded-xl group-hover:border-yellow-500/50 transition-colors duration-300">
                        <svg class="w-6 h-6 text-yellow-500 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <div>
                    <h2 class="font-black text-2xl tracking-tight text-transparent bg-clip-text bg-gradient-to-r from-white to-gray-400 drop-shadow-[0_2px_2px_rgba(0,0,0,0.8)]">
                        Payment Verification
                    </h2>
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest mt-0.5">Finance Management</p>
                </div>
            </div>
            
            <a href="{{ route('admin.payments.export', request()->query()) }}" class="relative inline-flex group">
                <div class="absolute transition-all duration-1000 opacity-70 -inset-px bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl blur-md group-hover:opacity-100 group-hover:-inset-1 group-hover:duration-200"></div>
                <div class="relative inline-flex items-center gap-2 bg-[#111] border border-green-500/50 group-hover:border-transparent text-white font-bold py-2 px-5 rounded-xl transition-all duration-300 shadow-[0_0_20px_rgba(34,197,94,0.2)] text-sm">
                    <svg class="w-4 h-4 text-green-400 group-hover:text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>Export CSV</span>
                </div>
            </a>
        </div>
    </x-slot>

    <div class="bg-[#0a0a0a] min-h-screen py-10 relative overflow-hidden">
        
        <div class="absolute top-[10%] left-[-10%] w-[40rem] h-[40rem] bg-yellow-600/10 rounded-full blur-[120px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            @if(session('success'))
            <div x-data="{ show: true }" x-show="show" x-transition 
                 class="mb-8 bg-green-500/10 border border-green-500/30 backdrop-blur-md text-green-400 px-6 py-4 rounded-2xl relative shadow-[0_10px_30px_rgba(34,197,94,0.1)] flex items-start gap-4" role="alert">
                <div class="bg-green-500/20 rounded-xl p-2 shrink-0 text-green-400 mt-0.5">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <strong class="font-black text-lg tracking-wide block text-white">Verified Successfully!</strong>
                    <span class="block text-sm font-medium opacity-80 mt-1">{{ session('success') }}</span>
                </div>
                <button @click="show = false" class="absolute top-4 right-4 text-green-500/50 hover:text-green-400 transition-colors p-1.5 hover:bg-green-500/20 rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            @endif

            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-8 bg-[#111]/80 backdrop-blur-xl p-3 sm:p-5 rounded-[1.5rem] border border-gray-800 shadow-xl">
                
                <div class="flex bg-[#0a0a0a] p-1.5 rounded-xl border border-gray-800 w-full md:w-auto overflow-x-auto custom-scrollbar">
                    <a href="{{ route('admin.payments.index', ['status' => 'pending']) }}"
                       class="whitespace-nowrap px-6 py-2.5 rounded-lg text-sm font-bold transition-all duration-300 flex items-center gap-2 {{ $status === 'pending' ? 'bg-yellow-500/20 text-yellow-500 shadow-sm border border-yellow-500/30' : 'text-gray-500 hover:text-gray-300 border border-transparent' }}">
                        @if($status === 'pending') <span class="w-2 h-2 rounded-full bg-yellow-500 animate-pulse"></span> @endif
                        Pending Verification
                    </a>
                    <a href="{{ route('admin.payments.index', ['status' => 'history']) }}"
                       class="whitespace-nowrap px-6 py-2.5 rounded-lg text-sm font-bold transition-all duration-300 flex items-center gap-2 {{ $status === 'history' ? 'bg-indigo-500/20 text-indigo-400 shadow-sm border border-indigo-500/30' : 'text-gray-500 hover:text-gray-300 border border-transparent' }}">
                        Payment History
                    </a>
                </div>

                <form action="{{ route('admin.payments.index') }}" method="GET" class="w-full md:w-auto flex items-center gap-3">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <div class="relative flex-1 md:w-48">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <input type="date" name="date" value="{{ request('date') }}" class="w-full bg-[#0a0a0a] border border-gray-700 text-white rounded-xl pl-9 pr-3 py-2.5 focus:outline-none focus:border-[#df1873]/50 focus:ring-1 focus:ring-[#df1873]/50 font-medium text-sm transition-colors [color-scheme:dark]">
                    </div>
                    <button type="submit" class="bg-gray-800 hover:bg-gray-700 border border-gray-600 text-white px-5 py-2.5 rounded-xl font-bold text-sm transition shadow-md">
                        Filter
                    </button>
                </form>
            </div>

            <div class="bg-[#111]/80 backdrop-blur-xl border border-gray-800 shadow-2xl rounded-[1.5rem] overflow-hidden">
                
                @if($payments->isEmpty())
                    <div class="py-20 text-center flex flex-col items-center">
                        <div class="w-24 h-24 bg-[#0a0a0a] rounded-full border border-gray-800 flex items-center justify-center mb-6 shadow-inner">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-black text-white mb-2">No Payments Found</h3>
                        <p class="text-gray-500 font-medium max-w-md">There are currently no records matching your selected filter criteria.</p>
                    </div>
                @else
                    <div class="overflow-x-auto custom-scrollbar">
                        <table class="w-full text-left whitespace-nowrap">
                            <thead class="bg-[#0a0a0a]/50 border-b border-gray-800">
                                <tr>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Booking Info</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Customer</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest">Payment</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest text-center">Receipt</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-gray-500 uppercase tracking-widest text-right">{{ $status === 'history' ? 'Status' : 'Actions' }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-800/60">
                                @foreach($payments as $payment)
                                <tr class="hover:bg-gray-800/30 transition-colors group">
                                    
                                    <td class="px-6 py-5">
                                        <div class="font-mono text-[#df1873] font-bold text-sm mb-1 tracking-wider">{{ $payment->booking->booking_reference }}</div>
                                        <div class="text-white font-bold text-sm">{{ $payment->booking->showtime->movie->title }}</div>
                                        <div class="text-xs text-gray-500 mt-1 font-medium flex items-center gap-1.5">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            {{ \Carbon\Carbon::parse($payment->booking->showtime->date)->format('d M, Y') }} &bull; {{ \Carbon\Carbon::parse($payment->booking->showtime->start_time)->format('h:i A') }}
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-5">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-gray-700 to-gray-900 flex items-center justify-center text-xs font-bold text-white shadow-inner">
                                                {{ substr($payment->booking->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="text-sm font-bold text-white">{{ $payment->booking->user->name }}</div>
                                                <div class="text-xs text-gray-500 mt-0.5">{{ $payment->booking->user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-5">
                                        <div class="text-lg font-black text-white">{{ number_format($payment->amount) }} <span class="text-xs text-gray-500 uppercase">Ks</span></div>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="px-2 py-0.5 bg-[#0a0a0a] border border-gray-700 rounded text-[10px] font-bold text-gray-300 uppercase tracking-widest">
                                                {{ $payment->payment_method }}
                                            </span>
                                            <span class="text-[10px] text-gray-500 font-medium">{{ $payment->created_at->diffForHumans() }}</span>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-5 text-center" x-data="{ imgModal: false }">
                                        <button @click="imgModal = true" class="inline-flex items-center justify-center p-2 bg-gray-800 hover:bg-gray-700 border border-gray-600 rounded-xl text-gray-300 hover:text-white transition-colors group-hover:border-blue-500/50" title="View Screenshot">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        </button>

                                        <div x-show="imgModal" style="display: none;" class="fixed inset-0 z-[110] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                                            <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
                                                <div x-show="imgModal" @click="imgModal = false" x-transition.opacity class="fixed inset-0 bg-black/80 backdrop-blur-sm" aria-hidden="true"></div>
                                                
                                                <div x-show="imgModal" 
                                                     x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                                     x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                                     class="relative inline-block bg-[#111] rounded-[2rem] border border-gray-800 text-left overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.8)] transform transition-all sm:my-8 sm:max-w-lg w-full">
                                                    
                                                    <div class="px-6 py-4 border-b border-gray-800 flex justify-between items-center bg-[#0a0a0a]">
                                                        <h3 class="text-sm font-black text-white uppercase tracking-widest">Payment Receipt</h3>
                                                        <button type="button" @click="imgModal = false" class="text-gray-500 hover:text-white bg-gray-900 p-2 rounded-full transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                        </button>
                                                    </div>
                                                    <div class="p-6">
                                                        <img src="{{ asset('storage/' . $payment->screenshot_path) }}" class="w-full h-auto max-h-[60vh] object-contain rounded-xl border border-gray-800 shadow-inner bg-black">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-5 text-right">
                                        @if($status === 'pending')
                                            <div class="flex justify-end gap-2">
                                                <form action="{{ route('admin.payments.reject', $payment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to REJECT this payment? This will cancel the booking.');">
                                                    @csrf
                                                    <button type="submit" class="bg-[#111] hover:bg-red-500/20 border border-gray-700 hover:border-red-500/50 text-gray-400 hover:text-red-500 px-4 py-2 rounded-xl text-xs font-bold shadow transition-all duration-300 flex items-center justify-center">
                                                        Reject
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.payments.approve', $payment->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-green-600 hover:bg-green-500 text-white px-5 py-2 rounded-xl text-xs font-bold shadow-[0_0_15px_rgba(34,197,94,0.3)] hover:shadow-[0_0_20px_rgba(34,197,94,0.5)] transition-all duration-300 flex items-center justify-center transform hover:-translate-y-0.5">
                                                        Approve
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            @if($payment->status === 'success')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest bg-green-500/10 text-green-500 border border-green-500/20">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Approved
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg text-[10px] font-black uppercase tracking-widest bg-red-500/10 text-red-500 border border-red-500/20">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Rejected
                                                </span>
                                            @endif
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            @if($payments->hasPages())
                <div class="mt-8 bg-[#111]/80 backdrop-blur-md p-4 rounded-[1.5rem] border border-gray-800 shadow-xl">
                    {{ $payments->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>