@extends("templates.templateAdmin")

@section("titulo", "Adicionar Card")

@section("content")
	<div class="container px-6 my-6 grid">
		<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300" >
			Adicionar Cards ao Deck: 
		</h4></br>		
		<div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" >	
			<div class="w-full overflow-hidden rounded-lg shadow-xs">
			  <div class="w-full overflow-x-auto">
				<table class="w-full whitespace-no-wrap ">
				  <thead>
					<tr>
						<div class="flex justify-center flex-1 lg:mr-32">
							<div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
								<form action="" method="GET">
									@csrf
									<input
									  class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
									  type="text"
									  placeholder="Digite o nome, quantidade de mana, cor ou raridade do card"
									  aria-label="Search" name="search" id="search"
									/>
									<span class="absolute inset-y-0 right-0 flex items-center pl-2">
										<button type="submit" class="p-1 focus:outline-none focus:shadow-outline focus-within:text-purple-500">
											<svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
										</button>
									</span>
								</form>
							</div>
						</div>
					</tr></br>
					<tr>
						<div class="flex justify-center flex-1 lg:mr-32">
							<div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
								<form action="/addCard" method="POST" enctype="multipart/form-data">
									<label class="block text-sm">
										<span class="text-gray-700 dark:text-gray-400">Deck:</span>
										<select name="deck" id= "deck" class="meuselect form-select block w-g mt-1 dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray" required>	
											@foreach($decks as $deck)
												<option value="{{$deck->id}}">{{$deck->name}}</option>
											@endforeach
										</select>
									</label>						  							
							</div><br><br>
						</div>
					</tr></br>	  
					<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
					
						<th class="px-4 py-3">Imagem</th>
					  <th class="px-4 py-3">Nome</th>
					  <th class="px-4 py-3">Descrição</th>
					  <th class="px-4 py-3">Mana</th>
					  <th class="px-4 py-3">Raridade</th>
					  <th class="px-4 py-3">Cores</th>
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
						  <td class="px-4 py-3 text-sm text-center"></td>
						  <td class="px-4 py-3">
							<div class="flex items-center space-x-4 text-sm">							
								<input type="hidden" name="card" id="card" value="{{$card->id}}" />
									@csrf
								  <button class=" flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-green-600 rounded-lg dark:text-green-700 focus:outline-none focus:shadow-outline-gray"
								
								  >
									<svg
									  class="w-5 h-5"
									  aria-hidden="true"
									  fill="currentColor"
									  viewBox="0 0 20 20"
									>
									  <path d="M10.219,1.688c-4.471,0-8.094,3.623-8.094,8.094s3.623,8.094,8.094,8.094s8.094-3.623,8.094-8.094S14.689,1.688,10.219,1.688 M10.219,17.022c-3.994,0-7.242-3.247-7.242-7.241c0-3.994,3.248-7.242,7.242-7.242c3.994,0,7.241,3.248,7.241,7.242C17.46,13.775,14.213,17.022,10.219,17.022 M15.099,7.03c-0.167-0.167-0.438-0.167-0.604,0.002L9.062,12.48l-2.269-2.277c-0.166-0.167-0.437-0.167-0.603,0c-0.166,0.166-0.168,0.437-0.002,0.603l2.573,2.578c0.079,0.08,0.188,0.125,0.3,0.125s0.222-0.045,0.303-0.125l5.736-5.751C15.268,7.466,15.265,7.196,15.099,7.03"></path>
									</svg>
								  </button>
								</form>
							  <form action="/removerCardDeck/{{ $cardDeck->id }}" method="POST" onclick="return confirm('Tem certeza que deseja remover');">
									<input type="hidden" name="_method" value="REMOVER" />
									@csrf
									<button type="submit" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-red-600 focus:outline-none focus:shadow-outline-gray"
									>
										<svg
										  class="w-5 h-5"
										  aria-hidden="true"
										  fill="currentColor"
										  viewBox="0 0 20 20"
										>
										  <path d="M10.185,1.417c-4.741,0-8.583,3.842-8.583,8.583c0,4.74,3.842,8.582,8.583,8.582S18.768,14.74,18.768,10C18.768,5.259,14.926,1.417,10.185,1.417 M10.185,17.68c-4.235,0-7.679-3.445-7.679-7.68c0-4.235,3.444-7.679,7.679-7.679S17.864,5.765,17.864,10C17.864,14.234,14.42,17.68,10.185,17.68 M10.824,10l2.842-2.844c0.178-0.176,0.178-0.46,0-0.637c-0.177-0.178-0.461-0.178-0.637,0l-2.844,2.841L7.341,6.52c-0.176-0.178-0.46-0.178-0.637,0c-0.178,0.176-0.178,0.461,0,0.637L9.546,10l-2.841,2.844c-0.178,0.176-0.178,0.461,0,0.637c0.178,0.178,0.459,0.178,0.637,0l2.844-2.841l2.844,2.841c0.178,0.178,0.459,0.178,0.637,0c0.178-0.176,0.178-0.461,0-0.637L10.824,10z"></path>
										</svg>
									</button>
								</form>
							</div>
						  </td>
						</tr>
					@endforeach				
				  </tbody>
				</table>
			  </div>
			</div>
		</div>
	</div>	

@endsection