@extends('layouts.admin')

@section('title', 'Dashboard Admin - DigiLab')
@section('header_title', 'Dashboard')

@section('content')
    <div class="mb-8 mt-2">
        <h1 class="text-2xl font-bold text-gray-900">Overview Dashboard</h1>
        <p class="text-gray-500 mt-2 font-medium">Welcome back, {{ Auth::user()->name }}. Here's what's happening today.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        
        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-bold text-gray-900 mb-4">Currently Borrowed</p>
                    <div class="flex items-end gap-3">
                        <h3 class="text-4xl font-bold text-gray-900">{{ $currentlyBorrowed }}</h3>
                    </div>
                </div>
                <div class="p-2 bg-[#900b21] text-white rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-bold text-gray-900 mb-4">Returned Books</p>
                    <h3 class="text-4xl font-bold text-gray-900">{{ $returnedBooks }}</h3>
                </div>
                <div class="p-2 bg-[#0077b6] text-white rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-sm font-bold text-gray-900 mb-4">Total Books (Stock)</p>
                    <h3 class="text-4xl font-bold text-gray-900">{{ $totalBooks }}</h3>
                </div>
                <div class="p-2 bg-[#00a870] text-white rounded-lg">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"></path></svg>
                </div>
            </div>
        </div>

    </div>

    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden mb-10">
        <div class="p-6 flex justify-between items-center">
            <h3 class="text-sm font-bold text-gray-900">Recent Activity</h3>
            <a href="{{ route('loans.index') }}" class="text-sm font-semibold text-[#900b21] hover:text-[#7a091c] transition-colors">View All Transaction</a>
        </div>
        
        <div class="overflow-x-auto px-6 pb-6">
            <table class="w-full text-sm text-left">
                <thead class="text-gray-900 font-bold border-b border-gray-200">
                    <tr>
                        <th class="py-4">Student Name</th>
                        <th class="py-4 text-center">Book Title</th>
                        <th class="py-4 text-center">Borrow Date</th>
                        <th class="py-4 text-center">Return Date</th>
                        <th class="py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-gray-900 font-medium">
                    
                    @forelse($recentActivities as $activity)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="py-5">{{ $activity->user->name }}</td>
                        <td class="py-5 text-center">{{ $activity->book->title }}</td>
                        <td class="py-5 text-center">{{ \Carbon\Carbon::parse($activity->borrow_date)->format('M d, Y') }}</td>
                        <td class="py-5 text-center">
                            @if($activity->return_date)
                                {{ \Carbon\Carbon::parse($activity->return_date)->format('M d, Y') }}
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>
                        <td class="py-5 flex justify-center">
                            @if($activity->status == 'borrowed')
                                <span class="bg-[#fff7ed] text-[#ea580c] px-4 py-1.5 rounded-full text-xs font-bold border border-[#ffedd5]">Borrowed</span>
                            @else
                                <span class="bg-[#ebfaef] text-[#00a870] px-4 py-1.5 rounded-full text-xs font-bold border border-[#b2e8cf]">Returned</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-10 text-center text-gray-500">
                            No recent activity found.
                        </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@endsection