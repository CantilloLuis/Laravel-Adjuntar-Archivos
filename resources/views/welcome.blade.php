<!DOCTYPE html>
<html>

<head>
    <title>Cartas de Métricas</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body>

    <br>
    <br>


    <form action="{{route('archivo')}}" method="POST" enctype="multipart/form-data" class="max-w-sm mx-auto">
        @csrf

        <label for="programa" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione Programa academico</label>
        <select id="programa" name="programa" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="Ingenieria de sistemas">Ingenieria de sistemas</option>
            <option value="Derecho">Derecho</option>
            <option value="Psicologia">Psicologia</option>
        </select>


        <br>
        <br>

        <label for="semestre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seleccione el semestre academico</label>
        <select id="semestre" name="semestre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option value="5">5</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select>
        <br>
        <br>
        <div class="flex items-center">
            <label for="file" class="inline-flex p-2 justify-center text-gray-500 rounded cursor-pointer hover:text-gray-900 hover:bg-gray-100 ">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a3 3 0 00-3 3v4a5 5 0 0010 0V7a1 1 0 112 0v4a7 7 0 11-14 0V7a5 5 0 0110 0v4a3 3 0 11-6 0V7a1 1 0 012 0v4a1 1 0 102 0V7a3 3 0 00-3-3z" clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Attach file</span>
            </label>
            <input name="file" class="block w-16 py-2 md:px-2 md:mr-3 md:w-full md:h-full text-sm text-gray-600 rounded file:hidden cursor-pointer bg-green-100 focus:outline-none" id="file" type="file">
        </div>
        <br>
        <br>
        <div align="center">
            <button class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center text-white bg-blue-700 rounded-lg focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-900 hover:bg-blue-800" type="submit">Subir</button>

        </div>

    </form>

    <br>
    <br>
    <h1 align="center">Archivos</h1>

    <div align="center" class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-3/4 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">

                <tr>
                    <th scope="col" class="px-6 py-3">Programa</th>
                    <th scope="col" class="px-6 py-3">Semestre</th>
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($archivoBD as $archivo )

                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-6 py-4">{{$archivo->programa}}</td>
                    <td class="px-6 py-4">{{$archivo->semestre}}</td>
                    <td class="px-6 py-4">
                        <!-- <a href="{{ asset($archivo->archivo) }}" target="_blank">
                            <div class="m-2 border border-cyan-600 rounded">
                                <div class="max-w-prose">
                                    <div class="flex">
                                        <div class="flex-none w-8 h-8">
                                            <img src="{{ asset('images/icons/file-pdf-solid.svg') }}" height="25px" width="25px">
                                        </div>
                                        <p class="text-sm">{{ $archivo->nombre }}</p>
                                    </div>
                                </div>
                            </div>
                        </a> -->
                        {{$archivo->nombre}}
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('archivos.download', $archivo->id) }}" class="text-blue-500 underline ml-4">Descargar</a>
                        <!-- Formulario para eliminar el archivo -->
                        <form action="{{ route('archivos.destroy', $archivo->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 underline ml-4">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>






</body>

</html>


<style>
    .card {
        background-image: linear-gradient(to right, #3b82f6, #2563eb, #1d4ed8);
    }
</style>