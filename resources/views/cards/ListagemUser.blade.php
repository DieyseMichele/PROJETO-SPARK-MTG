@extends("templates.templateUser")
@section("titulo", "Cards Cadastrados")
@section("content")
	<div class="container px-6 mx-auto grid">
		</br></br>
		<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 text-center">
		  Cards Cadastrados
		</h4></br></br>
		<div class="w-full overflow-hidden rounded-lg shadow-xs">
		  <div class="w-full overflow-x-auto">
			<table class="w-full whitespace-no-wrap ">
			  <thead>
				<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
				
					<th class="px-4 py-3">Imagem</th>
				  <th class="px-4 py-3">Nome</th>
				  <th class="px-4 py-3">Descrição</th>
				  <th class="px-4 py-3">Mana</th>
				  <th class="px-4 py-3">Raridade</th>
				  <th class="px-4 py-3">Quantidade</th>
				  <th class="px-4 py-3">Disponibilidade</th>
				  <th class="px-4 py-3">Ações</th>
				  
				</tr>
			  </thead>
			  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
				@foreach ($cards as $card)
					<tr class="text-gray-700 dark:text-gray-400">
					  <td class="px-4 py-3">
						<div class="flex items-center text-sm">
						  <!-- Avatar with inset shadow -->
							<div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
							<img class="object-cover w-full h-full rounded-full" 
								src="{{url($card->image_uris)}}" width="100" loading="lazy" 
							/>
							<div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
						  </div>
						</div>
					  </td>
					  <td class="px-4 py-3 text-sm ">
						<p class="font-semibold">{{ $card->name }}</p>
					  </td>
					  <td class="px-4 py-3 text-sm ">
						{{ $card->oracle_text }}
					  </td>
					   <td class="px-4 py-3 text-sm text-center">
						{{ $card->mana }}
					  </td>
					   <td class="px-4 py-3 text-sm text-center">
						{{ $card->rarity }}
					  </td>
					  
					   <td class="px-4 py-3 text-sm text-center">
						{{ $card->quantidade }}
					  </td>
					   <td class="px-4 py-3 text-sm text-center">
						{{ $card->disponivel }}
					  </td>
					  
					</tr>
				@endforeach					
			  </tbody>
			</table>
		  </div>
		</div>
		
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
			
			<div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2 p-1 mt-2 mx-auto lg:mx-2 md:mx-2 justify-between">
				@foreach ($cards as $card)
				<div class="flip-box rounded rounded-t-lg overflow-hidden shadow">
					
				  <div class="flip-box-inner text-xs font-semibold">
					<div class="flip-box-front rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3 text-center">
					  <img src="{{url($card->image_uris)}}" alt="{{ $card->name }}" class="w-f" >
					</div>
					<div class="flip-box-back px-4 py-3 text-sm ">
						<p class="font-semibold">Nome: {{ $card->name }}</p>
						<p class="font-semibold"> Descrição: {{ $card->oracle_text }}</p>
						<p class="font-semibold"> Custo de Mana: {{ $card->mana }}</p>
						<p class="font-semibold"> Raridade: {{ $card->rarity }}</p>
					</div>
				  </div>
				 
				</div>
				 @endforeach						
			</div>
		</h2>
	</div>		
	
@endsection