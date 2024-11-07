<x-layout color="bg-darkblue-500">
    <x-user.navbar></x-user.navbar>
    <x-user.sidebar></x-user.sidebar>
    <main class="sm:ml-64 sm:my-14 my-16">
        <div class="w-full pt-4 px-6 sm:px-10">
            <div class="flex flex-col">
                <h1 class="text-3xl text-slate-200">Welcome to Lumistock</h1>
                <p class="text-slate-500 mt-2">Lumistock is a lending item app designed specifically for our school, making it easy for students and staff to borrow and manage items responsibly.</p>
            </div>

            <div class="mt-10 bg-darkblue-300 p-6 rounded-lg">
                <h2 class="text-2xl text-slate-200 mb-4">About Lumistock</h2>
                <p class="text-slate-400">
                    Lumistock enables students and staff to borrow school items efficiently. Whether you need equipment for projects, technology, or other school supplies, Lumistock provides a streamlined way to track and manage borrowed items.
                </p>
            </div>

            <div class="mt-6 bg-darkblue-300 p-6 rounded-lg">
                <h2 class="text-2xl text-slate-200 mb-4">Lending Rules</h2>
                <ul class="list-disc list-inside text-slate-400">
                    <li>All items must be returned by the specified return date.</li>
                    <li>Late returns may result in penalties or restrictions on future borrowing privileges.</li>
                    <li>Handle all borrowed items with care. Damaged items must be reported immediately.</li>
                    <li>Borrowed items are for educational and project purposes only and should not be taken off-campus without permission.</li>
                </ul>
            </div>

            <div class="w-full mt-10 py-2 px-4 bg-darkblue-300 rounded-lg">
                <div class="flex mt-2 justify-between">
                    <h1 class="text-2xl text-slate-200 mb-6">Need Assistance?</h1>
                    <a href="https://wa.me/089665375943" target="_blank" class="flex items-center px-2 h-10 bg-teal-500 text-slate-200 rounded-md space-x-2">
                        <span><i class="fa fa-envelope"></i></span>
                        <span>Contact Support</span>
                    </a>
                </div>
                <p class="text-slate-400 mb-2">
                    If you have any questions or encounter issues, feel free to reach out to our support team.
                </p>
            </div>
        </div>
    </main>
</x-layout>
