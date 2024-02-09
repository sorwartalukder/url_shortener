<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden ">
                            <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700 whitespace-nowrap">
                                <thead class="bg-green-400 dark:bg-gray-700">
                                    <tr class="text-center">
                                        <th class="py-3 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-400">
                                            Short URL
                                        </th>
                                        <th class="py-3 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-400">
                                            Click Count
                                        </th>
                                        <th class="py-3 px-6 text-xs font-medium tracking-wider text-gray-700 uppercase dark:text-gray-400">
                                            Orginal URL
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                                    @if ($urls)
                                    @foreach($urls->items() as $url)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 text-center">
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a class="hover:text-blue-500" href="{{ url("url/" . $url['short_url']) }}" target="_blank" rel="noopener noreferrer">{{ url("url/" . $url['short_url']) }}</a>
                                        </td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-500 whitespace-nowrap dark:text-white">{{ $url['click_count'] }}</td>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a class="hover:text-blue-500" href="{{ $url['original_url'] }}" target="_blank" rel="noopener noreferrer">{{ $url['original_url'] }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            {{ $urls->links() }}
        </div>
    </div>
</x-app-layout>