<x-layout>
    @include('components.messages')

    <h3 class="text-2xl font-bold tracking-tighest mb-8">{{ __('Edit Task - :title', ['title' => $task->title]) }}</h3>

    <form method="POST" action="{{ route('task.update', ['task' => $task->id]) }}">
        @csrf
        @method('put')

        <div class="mb-6">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">{{ __( 'Task Title' ) }}</label>
            <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" value="{{ old('title', $task->title) }}" required>
        </div>
        <div class="mb-6">
            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">{{ __( 'Task Description' ) }}</label>
            <textarea id="description" name="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" rows="4" required>{{ old('description', $task->description) }}</textarea>
        </div>
        <div class="mb-6">
            <label for="status" class="block mb-2 text-sm font-medium text-gray-900">{{ __( 'Task Status' ) }}</label>
            <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="draft" {{ old('status', $task->status) === 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                <option value="completed" {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
            </select>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">{{ __('Update Task') }}</button>
    </form>
</x-layout>
