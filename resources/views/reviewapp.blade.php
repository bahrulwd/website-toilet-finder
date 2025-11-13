{{-- filepath: resources/views/reviewapp.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Reviews - Toilet Finder</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: linear-gradient(135deg, #e0e7ff 0%, #c7d2fe 100%); min-height: 100vh; }
        .glass-card { background: rgba(255,255,255,0.85); backdrop-filter: blur(16px); border-radius: 1rem; box-shadow: 0 8px 32px rgba(31,38,135,0.1);}
        .btn-primary { background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%); color: #fff; transition: all 0.3s; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 12px rgba(99,102,241,0.25);}
        .nav-underline { position: relative; }
        .nav-underline:after { content: ''; position: absolute; width: 0; height: 2px; bottom: -2px; left: 0; background-color: #3b82f6; transition: width 0.3s;}
        .nav-underline:hover:after { width: 100%; }
    </style>
</head>
<body class="antialiased text-slate-800">
    <!-- Navbar (copy dari submit.blade.php) -->
    <nav class="bg-white/90 backdrop-filter backdrop-blur-md fixed w-full z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo wcari.png') }}" alt="Toilet Finder Logo" class="h-8">
                </div>
                <div class="hidden md:flex items-center space-x-6">
                    <a href="/" class="nav-underline text-slate-600 hover:text-indigo-600 text-sm font-medium">Home</a>
                    <a href="/" class="nav-underline text-slate-600 hover:text-indigo-600 text-sm font-medium">Find Toilets</a>
                    <a href="{{ route('submit') }}" class="nav-underline text-slate-600 hover:text-indigo-600 text-sm font-medium">Submit Toilet</a>
                    <a href="{{ route('user.reviews') }}" class="nav-underline text-indigo-600 font-medium text-sm">Reviews</a>
                    <a href="{{ route('about') }}" class="nav-underline text-slate-600 hover:text-indigo-600 text-sm font-medium">About</a>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-md text-sm font-medium shadow-sm transition-colors">
                        Sign In
                    </a>
                    <button class="md:hidden text-slate-500 hover:text-slate-700 focus:outline-none" id="mobile-menu-button">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
    <!-- Mobile Menu -->
    <div class="md:hidden glass-card fixed inset-x-0 top-16 z-40 shadow-lg hidden" id="mobile-menu">
        <div class="px-2 pt-2 pb-4 space-y-2">
            <a href="/" class="block px-4 py-3 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50/50">Home</a>
            <a href="/" class="block px-4 py-3 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50/50">Find Toilets</a>
            <a href="{{ route('submit') }}" class="block px-4 py-3 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50/50">Submit Toilet</a>
            <a href="{{ route('user.reviews') }}" class="block px-4 py-3 rounded-lg text-base font-medium text-indigo-600 bg-indigo-50/50 hover:bg-indigo-100/50">Reviews</a>
            <a href="{{ route('about') }}" class="block px-4 py-3 rounded-lg text-base font-medium text-slate-700 hover:bg-slate-50/50">About</a>
            <a href="{{ route('signin') }}" class="block px-4 py-3 rounded-lg text-base font-medium text-blue-600 hover:bg-blue-50/50 border border-blue-100 mt-2">
                Sign Up
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-12 relative z-10">
        <div class="glass-card p-6 sm:p-8 max-w-2xl mx-auto">
            <div class="text-center mb-8">
                <h2 class="text-2xl sm:text-3xl font-semibold text-slate-800 mb-2">Share Your Experience</h2>
                <p class="text-slate-500 text-sm">Tell us what you think about using Toilet Finder!</p>
            </div>

            <!-- Review Form -->
            <form method="POST" action="{{ route('user.review.store') }}" class="space-y-5 mb-8">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Your Name</label>
                    <input type="text" name="name" required class="input-glass w-full px-3 py-2.5 rounded-lg focus:outline-none text-sm" placeholder="Your name">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Your Review</label>
                    <textarea name="review" rows="4" required class="input-glass w-full px-3 py-2.5 rounded-lg focus:outline-none text-sm" placeholder="Share your experience..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Rating</label>
                    <div class="flex items-center space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden">
                            <label for="star{{ $i }}" class="cursor-pointer text-2xl text-yellow-400">
                                <i class="fas fa-star"></i>
                            </label>
                        @endfor
                    </div>
                </div>
                <button type="submit" class="w-full btn-primary py-3 rounded-lg font-medium">Submit Review</button>
            </form>

            <!-- Reviews List -->
            <div>
                <h3 class="text-lg font-semibold text-slate-700 mb-4">What Users Say</h3>
                @forelse($userReviews as $review)
                    <div class="mb-6 border-b border-slate-100 pb-4 last:border-0 last:pb-0">
                        <div class="flex items-center mb-2">
                            <div class="w-8 h-8 rounded-full bg-slate-200 flex items-center justify-center text-slate-500 text-sm">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="ml-3 text-sm text-slate-700 font-semibold">{{ $review->name }}</div>
                            <div class="ml-4 flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $review->rating >= $i ? 'text-yellow-400' : 'text-slate-300' }}"></i>
                                @endfor
                                <span class="ml-2 text-xs text-slate-600">{{ number_format($review->rating, 1) }}</span>
                            </div>
                        </div>
                        <div class="text-slate-600 text-sm pl-11">{{ $review->review }}</div>
                    </div>
                @empty
                    <div class="text-center text-slate-400 py-8">
                        <i class="fas fa-comment-dots text-3xl mb-2"></i>
                        <p>No reviews yet. Be the first to share your experience!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Footer -->
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

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>