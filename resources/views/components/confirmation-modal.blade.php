<div>
    <div class="fixed inset-0 bg-gray-900 opacity-90"></div>

    <div class="bg-white shadow-md p-4 max-w-sm h-48 m-auto rounded-md fixed inset-0">
        <div class="flex flex-col h-full justify-between">
            <header>
                <h3 class="font-bold text-lg">{{ $title }}</h3>
            </header>

            <main class="mb-4">
                <p>{{ $body }}</p>
            </main>

            <footer>
                {{ $footer }}
            </footer>
        </div>

    </div>
</div>
