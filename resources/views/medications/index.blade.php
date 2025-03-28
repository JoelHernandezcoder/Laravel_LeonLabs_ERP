<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Medications
        </h2>
    </x-slot>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-4">
                <h1 class="dark:text-white font-bold text-xl mb-4">List</h1>
                <table class="w-full text-left border-collapse">
                    <thead>
                    <tr class="border-b">
                        <th class="p-2 dark:text-white">ID</th>
                        <th class="p-2 dark:text-white">Medication</th>
                        <th class="p-2 dark:text-white">Price U$D</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($medications ?? [] as $medication)
                        <tr class="border-b">
                            <td class="p-2">
                                <a href="/medications/{{ $medication->id }}" class="text-blue-800">{{ $medication->id }}</a>
                            </td>
                            <td class="p-2 dark:text-white">{{ $medication->name }}</td>
                            <td class="p-2 dark:text-white">{{ $medication->price }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <x-forms.divider/>
                <div class="mx-4">
                    {{ $medications->links() }}
                </div>
                <div class="text-center mb-8">
                    <x-action-button href="/medications/create" >Create Medication</x-action-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

