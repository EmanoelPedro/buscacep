<x-app-layout>
  <h1>addresses</h1>
  <div class="min-h-[90vh]">
  <div class="flex flex-col items-stretch container mx-auto md:flex-row md:flex-wrap">
    @error('not_found')
        <h1>{{$message}}</h1>
    @enderror
    @foreach ($addresses as $address)
      <div class="flex flex-col p-4 bg-gray-200 m-2 rounded-md md:basis-[calc(50%-1rem)] lg:basis-[calc(25%-1rem)]">
          <div>
            <p><span class="font-bold">CEP: </span>{{$address->cep}}</p>
            <p><span class="font-bold">Logradouro: </span>{{$address->logradouro}}</p>
            <p><span class="font-bold">Bairro: </span>{{$address->bairro}}</p>
            <p><span class="font-bold">Localidade: </span>{{$address->localidade}}</p>
            <p><span class="font-bold">UF: </span>{{$address->uf}}</p>
            <p><span class="font-bold">DDD: </span>{{$address->ddd}}</p>
          </div>

          <div class="flex flex-row-reverse self-end items-end grow">
            <form action="{{route('address.destroy',$address->id)}}" method="post" class="ml-2">
              @csrf
              @method('delete')
              <x-primary-button class="bg-red-700 hover:bg-red-600">
                DELETAR
              </x-primary-button>
            </form>
            <a href="" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">ver mais</a>
          </div>
      </div>
    @endforeach
    <div class="basis-full mt-12">
      {{ $addresses->links() }}
    </div>
  </div>
</div>
</x-app-layout>