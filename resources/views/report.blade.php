<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Reports - Toilet Finder</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
            color: #334155;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        .smooth-transition {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="antialiased">
    <!-- Navbar (optional, samakan dengan halaman lain jika perlu) -->
    <nav class="glass-card fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo wcari.png') }}" alt="Toilet Finder Logo" class="h-8">
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="text-slate-600 hover:text-indigo-600 font-medium text-sm smooth-transition">Home</a>
                    <a href="{{ route('findtoilet') }}" class="text-slate-600 hover:text-indigo-600 font-medium text-sm smooth-transition">Find Toilets</a>
                    <a href="{{ route('submit') }}" class="text-slate-600 hover:text-indigo-600 font-medium text-sm smooth-transition">Submit Toilet</a>
                    <a href="{{ route('user.reviews') }}" class="text-slate-600 hover:text-indigo-600 font-medium text-sm smooth-transition">Reviews</a>
                    <a href="{{ route('report') }}" class="text-indigo-600 font-medium text-sm smooth-transition">Reports</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 pt-24">
        <h2 class="text-2xl font-bold mb-6 text-slate-800 flex items-center gap-2">
            <i class="fas fa-flag text-indigo-600"></i> User Reports
        </h2>

        <!-- Example: Table of Reports -->
        <div class="glass-card rounded-xl overflow-hidden shadow mb-8">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">User</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Toilet</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Report</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-600 uppercase">Date</th>
                        <th class="px-6 py-3"></th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 text-sm">
                    @forelse($reports as $i => $report)
                    <tr>
                        <td class="px-6 py-4">{{ $i+1 }}</td>
                        <td class="px-6 py-4">{{ $report->user->name ?? 'Anonymous' }}</td>
                        <td class="px-6 py-4">{{ $report->toilet->name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ Str::limit($report->content, 40) }}</td>
                        <td class="px-6 py-4">
                            @if($report->status === 'pending')
                                <span class="inline-block px-2 py-1 text-xs rounded bg-amber-100 text-amber-700">Pending</span>
                            @elseif($report->status === 'resolved')
                                <span class="inline-block px-2 py-1 text-xs rounded bg-emerald-100 text-emerald-700">Resolved</span>
                            @else
                                <span class="inline-block px-2 py-1 text-xs rounded bg-slate-100 text-slate-500">-</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">{{ $report->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('report.show', $report->id) }}" class="text-indigo-600 hover:underline text-xs font-semibold">Detail</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-slate-400">No reports found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <!-- Footer (optional, samakan dengan halaman lain) -->
    <footer class="bg-slate-800/80 text-white py-12 mt-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <img src="{{ asset('images/logo wcari.png') }}" alt="Toilet Finder Logo" class="h-8 mb-4">
                    <p class="text-slate-300 text-sm mb-4">Helping you find clean, accessible restrooms wherever you are.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-slate-300 hover:text-white smooth-transition"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-slate-300 hover:text-white smooth-transition"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-slate-300 hover:text-white smooth-transition"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">Navigation</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-slate-300 hover:text-white text-sm smooth-transition">Home</a></li>
                        <li><a href="{{ route('findtoilet') }}" class="text-slate-300 hover:text-white text-sm smooth-transition">Find Toilets</a></li>
                        <li><a href="{{ route('submit') }}" class="text-slate-300 hover:text-white text-sm smooth-transition">Submit Toilet</a></li>
                        <li><a href="{{ route('user.reviews') }}" class="text-slate-300 hover:text-white text-sm smooth-transition">Reviews</a></li>
                        <li><a href="{{ route('report') }}" class="text-slate-300 hover:text-white text-sm smooth-transition">Reports</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-slate-300 hover:text-white text-sm smooth-transition">Privacy Policy</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-white text-sm smooth-transition">Terms of Service</a></li>
                        <li><a href="#" class="text-slate-300 hover:text-white text-sm smooth-transition">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-700 mt-10 pt-6 text-sm text-slate-400">
                <p>&copy; 2025 Toilet Finder. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>