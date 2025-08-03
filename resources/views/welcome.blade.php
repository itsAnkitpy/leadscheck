<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LeadsCheck - Turn More Leads into Customers</title>
        <meta name="description" content="An all-in-one platform to capture, track, and convert leads effortlessly. Never miss a follow-up with automated workflows and smart lead management.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Icons -->
        <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    </head>
    <body class="font-inter antialiased bg-white text-gray-900">
        <!-- Hero Section -->
        <section class="relative bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-40">
                <svg class="absolute inset-0 h-full w-full" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="grid" width="32" height="32" patternUnits="userSpaceOnUse">
                            <path d="M0 32V0h32" fill="none" stroke="rgb(59 130 246 / 0.1)" stroke-width="1"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#grid)"/>
                </svg>
            </div>
            
            <!-- Navigation -->
            <nav class="relative z-10 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6 max-w-7xl mx-auto">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                        </div>
                        <span class="text-xl font-bold text-gray-900">LeadsCheck</span>
                    </div>
                    
                    @if (Route::has('login'))
                        <div class="flex items-center space-x-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md text-sm font-medium transition-colors">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Get Started</a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </nav>

            <!-- Hero Content -->
            <div class="relative z-10 px-4 sm:px-6 lg:px-8 pb-20 pt-10">
                <div class="max-w-7xl mx-auto text-center">
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-6">
                        Turn More Leads into 
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Customers</span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto">
                        An all-in-one platform to capture, track, and convert leads effortlessly. Never miss a follow-up with automated workflows and smart lead management.
                    </p>
                    
                    <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-4 rounded-lg text-lg font-semibold transition-colors inline-flex items-center justify-center">
                            <i data-lucide="rocket" class="w-5 h-5 mr-2"></i>
                            Get Started Free
                        </a>
                        <button class="border border-gray-300 hover:border-gray-400 text-gray-700 px-8 py-4 rounded-lg text-lg font-semibold transition-colors inline-flex items-center justify-center">
                            <i data-lucide="play" class="w-5 h-5 mr-2"></i>
                            Watch Demo
                        </button>
                    </div>

                    <!-- Dashboard Preview - Mockup of the actual dashboard interface -->
                    <!-- This section displays a visual preview of what users will see after signing up -->
                    <!-- An actual dashboard screenshot or interactive demo could replace this mockup -->
                    <div class="relative max-w-5xl mx-auto">
                        <div class="bg-white rounded-xl shadow-2xl border border-gray-200 overflow-hidden">
                            <!-- Browser-style header with window controls -->
                            <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex items-center space-x-2">
                                <div class="w-3 h-3 bg-red-400 rounded-full"></div>
                                <div class="w-3 h-3 bg-yellow-400 rounded-full"></div>
                                <div class="w-3 h-3 bg-green-400 rounded-full"></div>
                            </div>
                            <!-- Dashboard screenshot/image -->
                            <div class="relative">
                                <img src="/images/dashboard.png" alt="LeadsCheck Dashboard Preview" class="w-full h-auto object-cover">
                                <!-- Fallback content if image doesn't load -->
                                <div class="absolute inset-0 p-6 bg-gradient-to-br from-blue-50 to-indigo-100 min-h-[300px] flex items-center justify-center" style="display: none;">
                                    <div class="text-center">
                                        <i data-lucide="bar-chart-3" class="w-16 h-16 text-blue-600 mx-auto mb-4"></i>
                                        <p class="text-gray-600">Interactive Dashboard Preview</p>
                                        <p class="text-sm text-gray-500 mt-2">Dashboard image loading...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Features Overview -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                        Everything you need to manage leads
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Powerful features designed to streamline your lead management process and boost conversions.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature 1 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="target" class="w-6 h-6 text-blue-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Multi-Channel Lead Capture</h3>
                        <p class="text-gray-600">Capture leads from web forms, WhatsApp, email, social media, and more - all in one centralized dashboard.</p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="users" class="w-6 h-6 text-green-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Smart Lead Assignment</h3>
                        <p class="text-gray-600">Automatically route leads to the right team members based on location, expertise, or custom rules.</p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="bell" class="w-6 h-6 text-purple-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Follow-up Automation</h3>
                        <p class="text-gray-600">Never miss a follow-up with automated reminders, email sequences, and task scheduling.</p>
                    </div>

                    <!-- Feature 4 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="workflow" class="w-6 h-6 text-orange-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Custom Pipelines</h3>
                        <p class="text-gray-600">Create custom sales pipelines with stages and statuses that match your unique business process.</p>
                    </div>

                    <!-- Feature 5 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="message-circle" class="w-6 h-6 text-red-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Communication History</h3>
                        <p class="text-gray-600">Track all interactions including emails, calls, messages, and notes in one comprehensive timeline.</p>
                    </div>

                    <!-- Feature 6 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-lg transition-shadow">
                        <div class="w-12 h-12 bg-indigo-100 rounded-lg flex items-center justify-center mb-4">
                            <i data-lucide="bar-chart-3" class="w-6 h-6 text-indigo-600"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Advanced Analytics</h3>
                        <p class="text-gray-600">Get detailed insights with conversion rates, team performance, and ROI tracking to optimize your process.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Benefits Section -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
                            Why businesses choose LeadsCheck
                        </h2>
                        
                        <div class="space-y-6">
                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Never miss a follow-up</h3>
                                    <p class="text-gray-600">Automated reminders and smart scheduling ensure every lead gets the attention they deserve.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Boost team productivity</h3>
                                    <p class="text-gray-600">Streamline workflows and eliminate manual tasks so your team can focus on closing deals.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Close deals faster</h3>
                                    <p class="text-gray-600">Automated workflows and intelligent lead scoring help you prioritize high-value prospects.</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-4">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                    <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-1">Centralize your lead data</h3>
                                    <p class="text-gray-600">All your leads, communications, and analytics in one powerful, easy-to-use platform.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-8">
                        <div class="text-center mb-6">
                            <div class="text-4xl font-bold text-blue-600 mb-2">2.5x</div>
                            <p class="text-gray-600">Average increase in lead conversion rate</p>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-6 text-center">
                            <div>
                                <div class="text-2xl font-bold text-gray-900 mb-1">10,000+</div>
                                <p class="text-sm text-gray-600">Leads managed monthly</p>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900 mb-1">95%</div>
                                <p class="text-sm text-gray-600">Customer satisfaction</p>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900 mb-1">24/7</div>
                                <p class="text-sm text-gray-600">Automated follow-ups</p>
                            </div>
                            <div>
                                <div class="text-2xl font-bold text-gray-900 mb-1">50+</div>
                                <p class="text-sm text-gray-600">Integrations available</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Target Audience / Use Cases -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                        Perfect for every industry
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        LeadsCheck adapts to your business needs, no matter what industry you're in.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Sales Teams -->
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="trending-up" class="w-8 h-8 text-white"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Sales Teams</h3>
                        <p class="text-gray-600 text-sm">Streamline your sales process and close more deals with automated lead nurturing.</p>
                    </div>

                    <!-- Real Estate -->
                    <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="home" class="w-8 h-8 text-white"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Real Estate Agents</h3>
                        <p class="text-gray-600 text-sm">Manage property inquiries and nurture potential buyers through the sales funnel.</p>
                    </div>

                    <!-- Education -->
                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="graduation-cap" class="w-8 h-8 text-white"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Education Counsellors</h3>
                        <p class="text-gray-600 text-sm">Track student inquiries and guide them through the enrollment process.</p>
                    </div>

                    <!-- Marketing Agencies -->
                    <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 bg-orange-600 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="megaphone" class="w-8 h-8 text-white"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Marketing Agencies</h3>
                        <p class="text-gray-600 text-sm">Manage client leads and demonstrate ROI with detailed analytics and reporting.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Social Proof -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                        Trusted by businesses worldwide
                    </h2>
                    <p class="text-xl text-gray-600">Join thousands of companies already using LeadsCheck</p>
                </div>

                <!-- Client Logos -->
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center opacity-60 mb-16">
                    <div class="bg-white rounded-lg p-4 flex items-center justify-center h-16">
                        <span class="font-semibold text-gray-400">Company A</span>
                    </div>
                    <div class="bg-white rounded-lg p-4 flex items-center justify-center h-16">
                        <span class="font-semibold text-gray-400">Company B</span>
                    </div>
                    <div class="bg-white rounded-lg p-4 flex items-center justify-center h-16">
                        <span class="font-semibold text-gray-400">Company C</span>
                    </div>
                    <div class="bg-white rounded-lg p-4 flex items-center justify-center h-16">
                        <span class="font-semibold text-gray-400">Company D</span>
                    </div>
                    <div class="bg-white rounded-lg p-4 flex items-center justify-center h-16">
                        <span class="font-semibold text-gray-400">Company E</span>
                    </div>
                    <div class="bg-white rounded-lg p-4 flex items-center justify-center h-16">
                        <span class="font-semibold text-gray-400">Company F</span>
                    </div>
                </div>

                <!-- Testimonials -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">"LeadsCheck transformed our sales process. We've seen a 40% increase in conversion rates since implementing it."</p>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-blue-600 font-semibold text-sm">JS</span>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">John Smith</div>
                                <div class="text-sm text-gray-500">Sales Director, TechCorp</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">"The automation features are incredible. We never miss a follow-up anymore and our team is more productive than ever."</p>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-green-600 font-semibold text-sm">MJ</span>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">Maria Johnson</div>
                                <div class="text-sm text-gray-500">Real Estate Broker</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm">
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                                <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                            </div>
                        </div>
                        <p class="text-gray-600 mb-4">"LeadsCheck's analytics help us understand our students better and improve our enrollment rates significantly."</p>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-purple-600 font-semibold text-sm">RW</span>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-900">Robert Wilson</div>
                                <div class="text-sm text-gray-500">Education Counsellor</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Integrations -->
        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                        Works seamlessly with your existing tools
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Connect LeadsCheck with the tools you already use and love. No disruption to your workflow.
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-center h-20 hover:bg-gray-100 transition-colors">
                        <span class="font-semibold text-gray-600">WhatsApp</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-center h-20 hover:bg-gray-100 transition-colors">
                        <span class="font-semibold text-gray-600">Mailchimp</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-center h-20 hover:bg-gray-100 transition-colors">
                        <span class="font-semibold text-gray-600">Salesforce</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-center h-20 hover:bg-gray-100 transition-colors">
                        <span class="font-semibold text-gray-600">HubSpot</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-center h-20 hover:bg-gray-100 transition-colors">
                        <span class="font-semibold text-gray-600">Google Sheets</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-center h-20 hover:bg-gray-100 transition-colors">
                        <span class="font-semibold text-gray-600">Zapier</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-center h-20 hover:bg-gray-100 transition-colors">
                        <span class="font-semibold text-gray-600">Slack</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-center h-20 hover:bg-gray-100 transition-colors">
                        <span class="font-semibold text-gray-600">Zoom</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-center h-20 hover:bg-gray-100 transition-colors">
                        <span class="font-semibold text-gray-600">Gmail</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-center h-20 hover:bg-gray-100 transition-colors">
                        <span class="font-semibold text-gray-600">Facebook</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-center h-20 hover:bg-gray-100 transition-colors">
                        <span class="font-semibold text-gray-600">LinkedIn</span>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 flex items-center justify-center h-20 hover:bg-gray-100 transition-colors">
                        <span class="font-semibold text-gray-600">+50 more</span>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <p class="text-lg text-gray-600 mb-6">Don't see your tool? We're constantly adding new integrations.</p>
                    <button class="text-blue-600 hover:text-blue-700 font-semibold">Request an integration →</button>
                </div>
            </div>
        </section>

        <!-- Pricing -->
        <section class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">
                        Simple, transparent pricing
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Choose the plan that fits your business needs. Start free, upgrade when you're ready.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Starter Plan -->
                    <div class="bg-white rounded-xl border border-gray-200 p-8">
                        <div class="text-center mb-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Starter</h3>
                            <div class="text-4xl font-bold text-gray-900 mb-2">Free</div>
                            <p class="text-gray-600">Perfect for getting started</p>
                        </div>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <i data-lucide="check" class="w-5 h-5 text-green-500 mr-3"></i>
                                <span class="text-gray-600">Up to 100 leads/month</span>
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="check" class="w-5 h-5 text-green-500 mr-3"></i>
                                <span class="text-gray-600">Basic lead capture</span>
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="check" class="w-5 h-5 text-green-500 mr-3"></i>
                                <span class="text-gray-600">Email support</span>
                            </li>
                        </ul>
                        <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-900 py-3 rounded-lg font-semibold transition-colors">
                            Get Started Free
                        </button>
                    </div>

                    <!-- Professional Plan -->
                    <div class="bg-white rounded-xl border-2 border-blue-600 p-8 relative">
                        <div class="absolute -top-3 left-1/2 transform -translate-x-1/2">
                            <span class="bg-blue-600 text-white px-4 py-1 rounded-full text-sm font-semibold">Most Popular</span>
                        </div>
                        <div class="text-center mb-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Professional</h3>
                            <div class="text-4xl font-bold text-gray-900 mb-2">$49<span class="text-lg text-gray-600">/month</span></div>
                            <p class="text-gray-600">For growing businesses</p>
                        </div>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <i data-lucide="check" class="w-5 h-5 text-green-500 mr-3"></i>
                                <span class="text-gray-600">Up to 1,000 leads/month</span>
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="check" class="w-5 h-5 text-green-500 mr-3"></i>
                                <span class="text-gray-600">Advanced automation</span>
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="check" class="w-5 h-5 text-green-500 mr-3"></i>
                                <span class="text-gray-600">Custom pipelines</span>
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="check" class="w-5 h-5 text-green-500 mr-3"></i>
                                <span class="text-gray-600">Analytics & reporting</span>
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="check" class="w-5 h-5 text-green-500 mr-3"></i>
                                <span class="text-gray-600">Priority support</span>
                            </li>
                        </ul>
                        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold transition-colors">
                            Start Free Trial
                        </button>
                    </div>

                    <!-- Enterprise Plan -->
                    <div class="bg-white rounded-xl border border-gray-200 p-8">
                        <div class="text-center mb-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-2">Enterprise</h3>
                            <div class="text-4xl font-bold text-gray-900 mb-2">Custom</div>
                            <p class="text-gray-600">For large organizations</p>
                        </div>
                        <ul class="space-y-3 mb-8">
                            <li class="flex items-center">
                                <i data-lucide="check" class="w-5 h-5 text-green-500 mr-3"></i>
                                <span class="text-gray-600">Unlimited leads</span>
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="check" class="w-5 h-5 text-green-500 mr-3"></i>
                                <span class="text-gray-600">Custom integrations</span>
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="check" class="w-5 h-5 text-green-500 mr-3"></i>
                                <span class="text-gray-600">Dedicated support</span>
                            </li>
                            <li class="flex items-center">
                                <i data-lucide="check" class="w-5 h-5 text-green-500 mr-3"></i>
                                <span class="text-gray-600">Advanced security</span>
                            </li>
                        </ul>
                        <button class="w-full bg-gray-100 hover:bg-gray-200 text-gray-900 py-3 rounded-lg font-semibold transition-colors">
                            Contact Sales
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Secondary CTA -->
        <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600">
            <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                    Ready to transform your lead management?
                </h2>
                <p class="text-xl text-blue-100 mb-8">
                    Join thousands of businesses already using LeadsCheck to boost their conversions.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="bg-white hover:bg-gray-100 text-blue-600 px-8 py-4 rounded-lg text-lg font-semibold transition-colors inline-flex items-center justify-center">
                        <i data-lucide="rocket" class="w-5 h-5 mr-2"></i>
                        Try it Free - No Credit Card Required
                    </a>
                    <button class="border-2 border-white hover:bg-white hover:text-blue-600 text-white px-8 py-4 rounded-lg text-lg font-semibold transition-colors inline-flex items-center justify-center">
                        <i data-lucide="calendar" class="w-5 h-5 mr-2"></i>
                        Schedule a 1:1 Demo
                    </button>
                </div>
                <p class="text-blue-100 text-sm mt-4">14-day free trial • No setup fees • Cancel anytime</p>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="col-span-1 md:col-span-2">
                        <div class="flex items-center space-x-2 mb-4">
                            <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                                <i data-lucide="zap" class="w-5 h-5 text-white"></i>
                            </div>
                            <span class="text-xl font-bold">LeadsCheck</span>
                        </div>
                        <p class="text-gray-400 mb-6 max-w-md">
                            Turn more leads into customers with our all-in-one lead management platform. Capture, track, and convert leads effortlessly.
                        </p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i data-lucide="twitter" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i data-lucide="linkedin" class="w-5 h-5"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition-colors">
                                <i data-lucide="facebook" class="w-5 h-5"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Product</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Features</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Pricing</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Integrations</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">API</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Support</h3>
                        <ul class="space-y-2">
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Help Center</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact Us</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Privacy Policy</a></li>
                            <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-12 pt-8 text-center">
                    <p class="text-gray-400">&copy; 2024 LeadsCheck. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <!-- Initialize Lucide Icons -->
        <script>
            lucide.createIcons();
        </script>
    </body>
</html>