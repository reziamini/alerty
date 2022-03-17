@component('alerty::layout')
<div class="w-full">

    <div class="mt-8 flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Query
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Time
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Smell
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Executed At
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($queries as $key => $query)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <pre style="background: none">
                                            <code class="language-sql">
                                                {{ \Illuminate\Support\Str::limit($query->data['bindedQuery'], 60, '..') }}
                                            </code>
                                        </pre>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 bg-orange-400">
                                        <span class="p-2 {{ \Alerty\Services\TimeChecker::getStyle($query->data['time']) }} text-xs rounded">
                                            {{ $query->data['time'] }} ms
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 bg-orange-400">
                                        {{ $query->type }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 bg-orange-400">
                                        {{ $query->created_at }}
                                    </td>

                                    <td style="vertical-align: middle!important;" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 bg-orange-400">
                                        <a href="{{ route('alerty.single', $query) }}" x-on:click.prevent="InformationModal = true">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" style="fill: rgb(107,114,128)" viewBox="0 0 22 16">
                                                <path d="M16.56 13.66a8 8 0 0 1-11.32 0L.3 8.7a1 1 0 0 1 0-1.42l4.95-4.95a8 8 0 0 1 11.32 0l4.95 4.95a1 1 0 0 1 0 1.42l-4.95 4.95-.01.01zm-9.9-1.42a6 6 0 0 0 8.48 0L19.38 8l-4.24-4.24a6 6 0 0 0-8.48 0L2.4 8l4.25 4.24h.01zM10.9 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm0-2a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"></path>
                                            </svg>
                                        </a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if($queries->lastPage() > 1)
                        <div class="px-6 py-3">
                            {{ $queries->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endcomponent
