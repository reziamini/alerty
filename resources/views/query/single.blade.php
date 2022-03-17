@component('alerty::layout')
    <div class="flex flex-col items-center">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism-themes/1.5.0/prism-dracula.min.css" integrity="sha512-naBrNzTEplW1xpCmrireVtPafiVBwOwFTVhvxH5zspfRL9QeZsaPuPxJZKnSFrFCcFF6XkoT6AiYsN+9dUuo2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <div class="w-5/6">
            <div class="flex justify-center bg-white py-3">
                Detail:
            </div>
            <div class="bg-indigo-100">
                <div class="flex">
                    <div class="w-1/4 p-4 font-bold text-gray-700">
                        Path
                    </div>
                    <div class="w-3/4 p-4 text-gray-600">
                        {{ $query->data['path'] }}
                    </div>
                </div>

                <div class="flex">
                    <div class="w-1/4 p-4 font-bold text-gray-700">
                        Time
                    </div>
                    <div class="w-3/4 p-4 text-gray-600">
                        {{ $query->data['time'] }} ms
                    </div>
                </div>

                <div class="flex">
                    <div class="w-1/4 p-4 font-bold text-gray-700">
                        Connection
                    </div>
                    <div class="w-3/4 p-4 text-gray-600">
                        {{ $query->data['connection'] }}
                    </div>
                </div>

                <div class="flex">
                    <div class="w-1/4 p-4 font-bold text-gray-700">
                        Database
                    </div>
                    <div class="w-3/4 p-4 text-gray-600">
                        {{ $query->data['database'] }}
                    </div>
                </div>

                <div class="flex">
                    <div class="w-1/4 p-4 font-bold text-gray-700">
                        In a Transaction
                    </div>
                    <div class="w-3/4 p-4 text-gray-600 ">
                        {{ $query->data['transaction'] ? 'Yes' : 'No' }}
                    </div>
                </div>

                <div class="flex">
                    <div class="w-1/4 p-4 font-bold text-gray-700">
                        Smell
                    </div>
                    <div class="w-3/4 p-4 text-gray-600">
                        {{ implode(' ', \Illuminate\Support\Str::ucsplit($query->type)) }}
                    </div>
                </div>

                <div class="flex">
                    <div class="w-1/4 p-4 font-bold text-gray-700">
                        Description
                    </div>
                    <div class="w-3/4 p-4 text-gray-600 text-sm">
                        {{ $query->description }}
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <div class="w-5/6 mt-4">
            <div class="flex justify-center bg-white py-3">
                Query:
            </div>
            <div class="">
                <style>
                    .token.operator{
                        background: none;
                    }
                </style>
                <div><pre><code class="language-sql">{{ $query->data['bindedQuery'] }}</code></pre></div>
            </div>
        </div>
    </div>
@endcomponent
