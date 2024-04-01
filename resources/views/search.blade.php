@props(['result' => null])
<x-app-layout>
  <section class="py-16 bg-gray-400">
    <header>
      <h1 class="text-3xl font-semibold pb-5 text-center">Encontre um endereço atraves do CEP</h1>
    </header>
    <main>
      <x-search-address-form />
    </main>
  </section>
  @if ($result)

    <section>
      <header>
        <h1>CEP: {{$result['cep']}}</h1>
      </header>
      <main class="flex flex-col">

      <div class="flex flex-col items-center justify-center align-middle sm:rounded-lg">
        @error('not_found')
        <div id="toast-danger" class="flex items-center p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
          <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
              <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
              </svg>
              <span class="sr-only">Error icon</span>
          </div>
          <div class="ms-3 text-sm font-normal">{{$message}}</div>
          <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
              <span class="sr-only">Close</span>
              <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
              </svg>
          </button>
      </div>
        @enderror
        <table class="rounded-md overflow-hidden shadow-md text-sm text-left rtl:text-right text-gray-500">
            <tbody class="p-4">
                <tr class="border-b border-gray-400 ">
                    <th scope="row" class="px-6 py-4 text-gray-700 text-lg font-black whitespace-nowrap bg-gray-300">
                      CEP
                    </th>
                    <td class="px-6 py-4 text-lg">
                      {{$result['cep']}}
                    </td>
                </tr>
                <tr class="border-b border-gray-400 ">
                    <th scope="row" class="px-6 py-4 text-gray-700 text-lg font-black whitespace-nowrap bg-gray-300">
                      Logradouro
                    </th>
                    <td class="px-6 py-4 text-lg">
                      {{$result['logradouro']}}
                    </td>
                </tr>
                <tr class="border-b border-gray-400 ">
                    <th scope="row" class="px-6 py-4 text-gray-700 text-lg font-black whitespace-nowrap bg-gray-300">
                      Bairro
                    </th>
                    <td class="px-6 py-4 text-lg">
                      {{$result['bairro']}}
                    </td>
                   
                </tr>
                <tr class="border-b border-gray-400 ">
                    <th scope="row" class="px-6 py-4 text-gray-700 text-lg font-black whitespace-nowrap bg-gray-300">
                      Localidade
                    </th>
                    <td class="px-6 py-4 text-lg">
                      {{$result['localidade']}}
                    </td>
                    
                </tr>
                <tr class="border-b border-gray-400 ">
                  <th scope="row" class="px-6 py-4 text-gray-700 text-lg font-black whitespace-nowrap bg-gray-300">
                      UF
                  </th>
                  <td class="px-6 py-4 text-lg">
                    {{$result['uf']}}
                  </td>
              </tr>
              <tr>
                <th scope="row" class="px-6 py-4 text-gray-700 text-lg font-black whitespace-nowrap bg-gray-300">
                  DDD
                </th>
                <td class="px-6 py-4 text-lg">
                  {{$result['ddd']}}
                </td>
            </tr>
            </tbody>
        </table>
        <div class="py-5">
          <form action="{{route('address.create')}}" method="POST">
            @csrf
            <input type='hidden' name='cep' value="{{$result['cep']}}" />
            <x-primary-button class="bg-blue-700 hover:bg-blue-800">
              salvar Endereço
            </x-primary-button>
          </form>
        </div>
      </div>
      </main>
    </section>
  @endif
</x-app-layout>