<x-layout>
    @if ($tasks->total() > 0)
        <h3 class="text-2xl font-bold tracking-tighest">{{ __('To Do Lists') }}</h3>
        <span class="text-gray-400 text-sm font-medium mt-1 mb-8 block">{{ trans_choice('{0} There are no task done yet. Lets go!|{1} :count task done. Keep up the good work!|[2,*] :count tasks done. Keep up the good work!', $total_tasks_done) }}</span>

        @include('components.messages')

        <div class="overflow-x-auto relative mb-8">
            <table class="w-full text-gray-500 text-sm text-center">
                <thead class="text-xs text-gray-400 uppercase border-b-2 border-gray-200">
                    <tr>
                        <th scope="col" class="py-3 px-6">{{ __( 'No.' ) }}</th>
                        <th scope="col" class="text-left py-3 px-6">{{ __( 'Task' ) }}</th>
                        <th scope="col" class="py-3 px-6">{{ __( 'Status' ) }}</th>
                        <th scope="col" class="py-3 px-6">{{ __( 'Updated At' ) }}</th>
                        <th scope="col" class="py-3 px-6">{{ __( 'Actions' ) }}</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        if (request()->page > 1) {
                            $i = (request()->page - 1) * $tasks->perPage();
                        } else {
                            $i = 0;
                        }
                    @endphp

                    @foreach ($tasks as $task)
                        @php($i++)

                        <tr class="bg-white border-b hover:bg-gray-50 text-center">
                            <td scope="row" class="text-gray-700 py-4 px-6">{{ $i }}</td>
                            <td scope="row" class="text-gray-700 text-left py-4 px-6">
                                <span class="font-medium text-gray-900 whitespace-nowrap block {{ $task->status === 'completed' ? 'line-through opacity-30' : '' }}">{{ $task->title }}</span>
                                <span class="font-normal text-gray-500 block {{ $task->status === 'completed' ? 'line-through opacity-30' : '' }}">{{ $task->description }}</span>
                            </td>
                            <td class="py-4 px-6">
                                @switch($task->status)
                                    @case('in_progress')
                                        <span class="bg-yellow-200 text-yellow-900 text-xs font-semibold uppercase whitespace-nowrap rounded px-2.5 py-0.5 mr-2">{{ $task->status_label }}</span>
                                        @break

                                    @case('completed')
                                        <span class="bg-green-200 text-green-900 text-xs font-semibold uppercase whitespace-nowrap rounded px-2.5 py-0.5 mr-2">{{ $task->status_label }}</span>
                                        @break

                                    @default
                                        <span class="bg-gray-200 text-gray-900 text-xs font-semibold uppercase whitespace-nowrap rounded px-2.5 py-0.5 mr-2">{{ $task->status_label }}</span>
                                        @break
                                @endswitch
                            </td>
                            <td class="py-4 px-6">{{ $task->updated_at->format('d/m/Y h:i:s a') }}</td>
                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="flex">
                                    @if ($task->status !== 'completed')
                                        <form method="POST" action="{{ route('task.complete', ['task' => $task->id]) }}">
                                            @csrf
                                            @method('put')

                                            <button type="submit" class="p-2.5 m-0.5 text-xs font-medium text-center text-white bg-green-600 rounded hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 inline-block">
                                                <svg class="w-3 h-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M374.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 178.7l-57.4-57.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l80 80c12.5 12.5 32.8 12.5 45.3 0l160-160zm96 128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 402.7 86.6 297.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l256-256z"/></svg>
                                            </button>
                                        </form>
                                    @endif

                                    <a href="{{ route('task.edit', ['task' => $task->id]) }}" class="p-2.5 m-0.5 text-xs font-medium text-center text-white bg-blue-600 rounded hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 inline-block">
                                        <svg class="w-3 h-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.8 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z"/></svg>
                                    </a>

                                    <form method="POST" action="{{ route('task.destroy', ['task' => $task->id]) }}" onSubmit="return confirm('{{ __('Are you sure want to remove task :title? You cannot undo this action.', ['title' => $task->title]) }}');">
                                        @csrf
                                        @method('delete')

                                        <button type="submit" class="p-2.5 m-0.5 text-xs font-medium text-center text-white bg-red-600 rounded hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 inline-block">
                                            <svg class="w-3 h-3 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $tasks->links('pagination::tailwind') }}
    @else
        <main class="mx-auto max-w-7xl p-2 sm:px-6 sm:py-8">
            <div class="sm:text-center lg:text-left">
                <h1 class="text-4xl text-gray-900 font-bold tracking-tight sm:text-6xl">
                    <span class="block xl:inline">Organize your</span>
                    <span class="block text-pink-600 xl:inline">work and life</span>
                </h1>
                <p class="mt-3 text-base text-gray-500 sm:mx-auto sm:mt-5 sm:max-w-xl sm:text-lg md:mt-5 md:text-xl lg:mx-0">{!! __('Become focused, organized, and calm with :app_name. The world’s #1 task manager and to-do list app.', ['app_name' => '<span class="font-semibold">' . __( 'Laravel To Do List App' ) . '</span>']) !!}</p>
                <div class="mt-5 sm:mt-8 sm:flex sm:justify-center lg:justify-start">
                    <div class="rounded-md shadow">
                        <a href="{{ route('task.create') }}" class="flex w-full items-center justify-center rounded-md border border-transparent bg-pink-600 px-8 py-3 text-base font-medium text-white hover:bg-pink-700 md:py-4 md:px-10 md:text-lg">{{ __('Get started') }}</a>
                    </div>
                </div>
            </div>
        </main>
    @endif
</x-layout>
