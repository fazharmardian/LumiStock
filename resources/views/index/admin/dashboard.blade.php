<x-layout color="bg-darkblue-500">
    <x-admin.navbar></x-admin.navbar>
    <x-admin.sidebar></x-admin.sidebar>
    <main class="sm:ml-64 sm:my-14 my-16">

        <div class="w-full pt-4 px-6 sm:px-10">
            <div class="flex items-center">
                <div class="flex flex-col">
                    <h1 class="text-2xl text-slate-200">Hello {{ auth()->user()->username }}</h1>
                    <p class="text-slate-500">Welcome to the admin panel</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-10">
                <div class="flex flex-col py-6 px-8 bg-darkblue-300 rounded-lg">
                    <div class="flex justify-start">
                        <span class="text-4xl text-indigo-500">
                            <i class="fa fa-circle-user"></i>
                        </span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <h1 class="text-md text-slate-500">Total of User</h1>
                        <h1 class="text-xl text-slate-200">{{ $total_user }}</h1>
                    </div>
                </div>
            
                <div class="flex flex-col py-6 px-8 bg-darkblue-300 rounded-lg">
                    <div class="flex justify-start">
                        <span class="text-4xl text-yellow-500">
                            <i class="fa fa-box-open"></i>
                        </span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <h1 class="text-md text-slate-500">Total of Item</h1>
                        <h1 class="text-xl text-slate-200">{{ $total_item }}</h1>
                    </div>
                </div>
            
                <div class="flex flex-col py-6 px-8 bg-darkblue-300 rounded-lg">
                    <div class="flex justify-start">
                        <span class="text-4xl text-green-500">
                            <i class="fa fa-bell-concierge"></i>
                        </span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <h1 class="text-md text-slate-500">Total of Request</h1>
                        <h1 class="text-xl text-slate-200">{{ $total_request }}</h1>
                    </div>
                </div>
            
                <div class="flex flex-col py-6 px-8 bg-darkblue-300 rounded-lg">
                    <div class="flex justify-start">
                        <span class="text-4xl text-red-500">
                            <i class="fa fa-hand-holding"></i>
                        </span>
                    </div>
                    <div class="flex items-center justify-between mt-4">
                        <h1 class="text-md text-slate-500">Total of Lending</h1>
                        <h1 class="text-xl text-slate-200">{{ $total_lending }}</h1>
                    </div>
                </div>
            </div>
            
            <div class="w-full mt-10 py-2 px-4 bg-darkblue-300 rounded-lg">
                <div class="flex mt-2 justify-between">
                    <h1 class="text-2xl text-slate-200 mb-6">Lending Graph</h1>
                    <a href="{{ route('lending.pdf') }}" class="flex items-center px-2 h-10 bg-teal-500 text-slate-200 rounded-md space-x-2">
                        <span><i class="fa fa-file-pdf"></i></span>
                        <span>Generate Report</span>
                    </a>
                </div>
                <canvas id="lendingChart" class="w-full h-96"></canvas>
            </div>
        </div>
    </main>

        <script>
            const labels = {!! json_encode($lendingData->pluck('date')) !!};
            const data = {!! json_encode($lendingData->pluck('count')) !!};

            const ctx = document.getElementById('lendingChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Number of Lendings',
                        data: data,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderWidth: 2,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true, position: 'top' }
                    },
                    scales: {
                        x: { title: { display: true, text: 'Date' } },
                        y: { 
                            title: { display: true, text: 'Number of Lendings' }, 
                            beginAtZero: true 
                        }
                    }
                }
            });
        </script>
</x-layout>