<div>
    <x-slot name="header">
        <h2 class="font-semibold text-sm text-gray-800 leading-tight" style="text-align: right;">
            <!-- <div class="flex text-align:left">
                <span class="font-bold text-lg text-gray-800">Hello,  " {{ Auth::user()->name }} "</span>
            </div> -->
            <a className="underline text-blue-500 hover:text-blue-600 focus:text-blue-600" href="{{ route('admin.dashboard') }}" style="background-color: #1f908b; padding: 10px; color:white; border-radius: 5px; text-decoration: none; hover:underline; hover:background-color: #73eee8; transition: all 0.3s ease;">| Go to Admin Panel! |</a>    
        </h2>
    </x-slot>
</div>


<div class="p-6 lg:p-8 bg-white border-b border-gray-200">
    <h1 class="mt-8 text-3xl font-bold text-gray-900">
        Welcome to Your All-in-One Web Solution!
    </h1>
    <p class="mt-6 text-gray-500 leading-relaxed">
        We specialize in creating instant full-stack web portfolios tailored for freelancers, designers, teachers, and social influencers. With cool features, seamless monitoring, and scalability, your online presence has never been easier to manage.
    </p>
</div>

<!-- Stats and Reports Section -->
<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 lg:grid-cols-2 gap-6 p-6 lg:p-8">
    <!-- Pie Chart (Sample) -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Quarterly Bandwidth Usage</h2>
        <div class="flex justify-center">
            <!-- Add Pie Chart Here -->
            <div class="w-48 h-48 bg-blue-100 rounded-full flex items-center justify-center">
                <p class="text-xl font-semibold text-blue-600">60%</p>
            </div>
        </div>
        <p class="mt-4 text-gray-500 text-center">
            You have utilized 60% of your allocated bandwidth this quarter. Monitor your usage to optimize performance.
        </p>
    </div>

    <!-- Progress Bar (Sample) -->
    <div class="bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Memory & RAM Usage</h2>
        <div>
            <p class="text-sm font-medium text-gray-700">Memory Usage</p>
            <div class="w-full bg-gray-200 rounded-full h-4 mb-4">
                <div class="bg-green-500 h-4 rounded-full" style="width: 75%;"></div>
            </div>
            <p class="text-sm font-medium text-gray-700">RAM Usage</p>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-red-500 h-4 rounded-full" style="width: 40%;"></div>
            </div>
        </div>
        <p class="mt-4 text-gray-500 text-center">
            Track your resource consumption to ensure your website runs smoothly. Upgrade as needed for more capacity.
        </p>
    </div>
</div>

<!-- Key Features Section -->
<div class="bg-gray-50 p-6 lg:p-8">
    <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Why Choose Us?</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="flex flex-col items-center text-center bg-white p-4 rounded-lg shadow">
            <div class="w-12 h-12 bg-blue-500 text-white flex items-center justify-center rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m3-9.586A2 2 0 1015.414 3L21 8.586A2 2 0 0121 11h-6m-6-4v2M3 13a4 4 0 118 0 4 4 0 01-8 0z" />
                </svg>
            </div>
            <h4 class="font-bold text-lg text-gray-800">Instant Portfolios</h4>
            <p class="text-gray-500 mt-2">Create stunning portfolios instantly with responsive designs and customizable features.</p>
        </div>

        <div class="flex flex-col items-center text-center bg-white p-4 rounded-lg shadow">
            <div class="w-12 h-12 bg-green-500 text-white flex items-center justify-center rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12v2m0 4h.01m-6.938 4h13.856A2.12 2.12 0 0021 18.881V5.12A2.12 2.12 0 0018.881 3H5.12A2.12 2.12 0 003 5.119V18.88A2.12 2.12 0 005.119 21h6.942z" />
                </svg>
            </div>
            <h4 class="font-bold text-lg text-gray-800">Real-Time Monitoring</h4>
            <p class="text-gray-500 mt-2">Keep track of your usage stats like bandwidth and memory with real-time updates.</p>
        </div>

        <div class="flex flex-col items-center text-center bg-white p-4 rounded-lg shadow">
            <div class="w-12 h-12 bg-yellow-500 text-white flex items-center justify-center rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4H8l4-4 4 4h-3v4zM9 22h6" />
                </svg>
            </div>
            <h4 class="font-bold text-lg text-gray-800">Scalable Hosting</h4>
            <p class="text-gray-500 mt-2">Scale your hosting needs as your business grows. We'll handle the technical complexity.</p>
        </div>

        <div class="flex flex-col items-center text-center bg-white p-4 rounded-lg shadow">
            <div class="w-12 h-12 bg-red-500 text-white flex items-center justify-center rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l3-3m0 0l3 3m-3-3v12M5 19a2 2 0 002 2h10a2 2 0 002-2v-4m-5-9h4a2 2 0 012 2v3" />
                </svg>
            </div>
            <h4 class="font-bold text-lg text-gray-800">Custom Domains</h4>
            <p class="text-gray-500 mt-2">Get your own domain with hosting across our secure and high-performance VPS servers.</p>
        </div>
    </div>
</div>


<!-- Contact Information Section -->
<div class="bg-white p-6 lg:p-8 mt-8 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Contact Us</h2>
    <p class="text-gray-500">Have questions or need support? Reach out to us!</p>
    <ul class="mt-4 space-y-2 text-gray-700">
        <li>Email: <a href="mailto:isaac@duckcloud.info" class="text-blue-500 hover:underline">isaac@duckcloud.info</a></li>
        <li>Phone: +1 123-456-7890</li>
    </ul>
</div>
