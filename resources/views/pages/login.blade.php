<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Timesheet App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        
        body {
            background: #f2f3f5;
        }
        
        @keyframes slide-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
        
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.85); }
        }
        
        .animate-slide-up {
            animation: slide-up 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }
        
        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
        }
        
        .animate-pulse-dot {
            animation: pulse-dot 2s infinite;
        }
        
        /* Input styles */
        .input-field {
            transition: all 0.2s ease;
            background: #f2f3f5;
            border: 1px solid #e2e4e8;
            color: #1a1a1a;
            width: 100%;
        }
        
        .input-field:focus {
            outline: none;
            background: #f6f7f9;
            border-color: #1a1a1a;
            box-shadow: 0 0 0 3px rgba(26, 26, 26, 0.05);
        }
        
        .input-field::placeholder {
            color: #8a8a8a;
        }
        
        /* Button styles */
        .btn-primary {
            background: #1a1a1a;
            color: #f6f7f9;
            transition: all 0.2s ease;
            width: 100%;
        }
        
        .btn-primary:hover {
            background: #333333;
            transform: translateY(-1px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .btn-secondary {
            background: #f2f3f5;
            color: #6a6a6a;
            border: 1px solid #e2e4e8;
            transition: all 0.2s ease;
        }
        
        .btn-secondary:hover {
            background: #eceef0;
            color: #1a1a1a;
        }
        
        /* Card styles - FIXED */
        .login-card {
            background: #f6f7f9;
            border: 1px solid #e2e4e8;
            border-radius: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
            padding: 2rem;
        }
        
        /* Link styles */
        .link {
            color: #8a8a8a;
            transition: color 0.2s ease;
        }
        
        .link:hover {
            color: #1a1a1a;
        }
        
        /* Custom checkbox */
        .custom-checkbox {
            appearance: none;
            width: 18px;
            height: 18px;
            border: 2px solid #d1d3d8;
            border-radius: 6px;
            background: #f2f3f5;
            transition: all 0.2s ease;
            cursor: pointer;
            position: relative;
            flex-shrink: 0;
        }
        
        .custom-checkbox:checked {
            background: #1a1a1a;
            border-color: #1a1a1a;
        }
        
        .custom-checkbox:checked::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #f6f7f9;
            font-size: 12px;
        }
        
        .custom-checkbox:focus-visible {
            outline: 2px solid #1a1a1a;
            outline-offset: 2px;
        }
        
        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 4px;
        }
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        ::-webkit-scrollbar-thumb {
            background: #c8c8c8;
            border-radius: 20px;
        }
    </style>
</head>
<body class="bg-[#f2f3f5] flex items-center justify-center min-h-screen p-4">
    <div class="w-full max-w-[400px] animate-slide-up">
        <!-- Header -->
        <div class="text-center mb-8 animate-fade-in">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-2xl border border-[#e2e4e8] bg-[#f6f7f9] mb-4">
                <i class="fa-regular fa-clock text-2xl text-[#1a1a1a]"></i>
            </div>
            <h1 class="text-2xl font-semibold tracking-tight text-[#1a1a1a]">Welcome back</h1>
            <p class="mt-1.5 text-sm text-[#8a8a8a]">Sign in to your timesheet account</p>
        </div>

        <!-- Login Card - FIXED -->
        <div class="login-card animate-fade-in" style="animation-delay: 0.1s;">
            <form method="POST" action="/login">
                @csrf
                
                <!-- Email -->
                <div class="mb-4">
                    <label class="block text-xs font-medium uppercase tracking-[0.2em] text-[#6a6a6a] mb-1.5">
                        Email address
                    </label>
                    <div class="relative">
                        <input 
                            type="email" 
                            name="email" 
                            class="input-field rounded-xl px-4 py-3 pr-11 text-sm transition" 
                            placeholder="you@example.com" 
                            required
                        >
                        <i class="fa-regular fa-envelope absolute right-4 top-1/2 -translate-y-1/2 text-[#8a8a8a] text-sm"></i>
                    </div>
                </div>

                <!-- Password -->
                <div class="mb-6">
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="text-xs font-medium uppercase tracking-[0.2em] text-[#6a6a6a]">
                            Password
                        </label>
                        <a href="#" class="text-xs text-[#8a8a8a] hover:text-[#1a1a1a] transition font-medium">
                            Forgot?
                        </a>
                    </div>
                    <div class="relative">
                        <input 
                            type="password" 
                            name="password" 
                            class="input-field rounded-xl px-4 py-3 pr-11 text-sm transition" 
                            placeholder="Enter your password" 
                            required
                        >
                        <button type="button" class="absolute right-4 top-1/2 -translate-y-1/2 text-[#8a8a8a] hover:text-[#1a1a1a] transition" id="togglePassword">
                            <i class="fa-regular fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Options -->
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2.5 text-sm text-[#6a6a6a] cursor-pointer">
                        <input type="checkbox" class="custom-checkbox">
                        <span>Remember me</span>
                    </label>
                    <div class="flex items-center gap-2">
                        <span class="inline-block h-1.5 w-1.5 rounded-full bg-[#1a1a1a] animate-pulse-dot"></span>
                        <span class="text-xs text-[#8a8a8a] font-medium">Secure</span>
                    </div>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn-primary rounded-xl py-3.5 text-sm font-medium transition">
                    <i class="fa-regular fa-arrow-right-to-bracket mr-2"></i>
                    Sign In
                </button>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-[#e2e4e8]"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="bg-[#f6f7f9] px-4 text-[10px] uppercase tracking-[0.3em] text-[#8a8a8a]">Or continue with</span>
                    </div>
                </div>

                <!-- Social Buttons -->
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" class="btn-secondary flex items-center justify-center gap-2.5 rounded-xl px-4 py-2.5 text-sm font-medium transition">
                        <i class="fa-brands fa-google text-[#1a1a1a]"></i>
                        Google
                    </button>
                    <button type="button" class="btn-secondary flex items-center justify-center gap-2.5 rounded-xl px-4 py-2.5 text-sm font-medium transition">
                        <i class="fa-brands fa-github text-[#1a1a1a]"></i>
                        GitHub
                    </button>
                </div>
            </form>

            <!-- Sign Up -->
            <p class="mt-6 text-center text-sm text-[#8a8a8a]">
                Don't have an account? 
                <a href="#" class="font-medium text-[#1a1a1a] hover:underline transition">Create one</a>
            </p>
        </div>

        <!-- Footer -->
        <div class="mt-6 text-center animate-fade-in" style="animation-delay: 0.2s;">
            <p class="text-[10px] uppercase tracking-[0.3em] text-[#8a8a8a]">
                <i class="fa-regular fa-shield-check mr-1.5"></i>
                Secure timesheet • v1.0
            </p>
            <div class="mt-3 inline-flex items-center gap-4 text-xs text-[#8a8a8a]">
                <span>Demo: admin@timesheet.com</span>
                <span class="w-px h-3 bg-[#e2e4e8]"></span>
                <span>Password: admin123</span>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const input = document.querySelector('input[name="password"]');
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Form submission demo
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            const email = document.querySelector('input[name="email"]').value;
            const password = document.querySelector('input[name="password"]').value;
            
            if (email === 'admin@timesheet.com' && password === 'admin123') {
                const btn = this.querySelector('button[type="submit"]');
                btn.innerHTML = '<i class="fa-regular fa-circle-check mr-2"></i> Welcome back!';
                btn.classList.add('bg-[#1a1a1a]');
                
                setTimeout(() => {
                    window.location.href = 'dashboard.html';
                }, 1500);
            } else {
                alert('Invalid credentials. Use admin@timesheet.com / admin123');
            }
        });
    </script>
</body>
</html>