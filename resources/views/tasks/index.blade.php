<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Listado de tareas
        </h2>
    </x-slot>

<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">

            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="p-4">
                    <a href="{{ route('tasks.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 dark:bg-blue-500 hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:focus:ring-blue-600">
                        Crear tarea
                    </a>
                </div>
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Nombre
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Descripción
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Completada
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Creada
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Acciones
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                   @forelse($tasks as $task)
                       <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                           <td class="px-6 py-4">
                               {{ $task->id }}
                           </td>
                           <td class="px-6 py-4">
                               {{ $task->name }}
                           </td>
                           <td class="px-6 py-4">
                               {{ $task->description }}
                           </td>
                           <td class="px-6 py-4">
                               {{ $task->completed ? 'Si' : 'No' }}
                           </td>
                           <td class="px-6 py-4">
                               {{ $task->created_at->format('d/m/Y') }}
                           </td>
                           <td class="px-6 py-4">
                               <a href="{{ route('tasks.edit', $task) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                   Editar
                               </a>

                               <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                                      @csrf
                                      @method('PATCH')
                                        <button type="submit" class="font-medium hover:underline {{ $task->completed ? 'text-yellow-600 dark:text-yellow:500' : 'text-green-600 dark:text-green:500' }}">
                                            {{ $task->completed ? 'Deshacer' : 'Completar' }}
                                        </button>
                               </form>

                               <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                   @csrf
                                   @method('DELETE')
                                   <button type="submit" class="font-medium hover:underline text-red-600 dark:text-red:500">
                                       Eliminar
                                   </button>
                               </form>

                           </td>
                       </tr>
                   @empty
                     <tr>
                         <td class="px-6 py-4 whitespace-nowrap">No hay tareas</td>
                     </tr>
                   @endforelse

                    </tbody>
                </table>

                <div class="p-4">
                    {{$tasks->links()}}
                </div>

            </div>

        </div>
    </div>
</div>

</x-app-layout>
