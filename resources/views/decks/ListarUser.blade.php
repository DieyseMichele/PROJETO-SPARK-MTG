@extends("templates.templateUser")
@section("titulo", "Decks Cadastrados")
@section("content")
	<div class="container px-6 mx-auto grid">
		</br></br>
		<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 text-center">
		  Decks Cadastrados
		</h4></br></br>
		<div class="w-full overflow-hidden rounded-lg shadow-xs">
			
		  <div class="w-full overflow-x-auto">
			<table class="w-full whitespace-no-wrap ">
			  <thead>
				<tr>
					<div class="flex justify-center flex-1 lg:mr-32">
					  <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
						
						<form action="/searchDeck" method="GET">
							@csrf
							<input
							  class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
							  type="text"
							  placeholder="Digite o nome do deck, formato, ou usuário"
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
				<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
				
					<th class="px-4 py-3">Nome</th>
					<th class="px-4 py-3">Formato</th>			  
				  <th class="px-4 py-3">Exportar</th>
				  <th class="px-4 py-3">Cards</th>
				  <th class="px-4 py-3">Ações</th>
				  
				</tr>
			  </thead>
			  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
				@foreach ($decks as $deck)
					<tr class="text-gray-700 dark:text-gray-400">
					  <td class="px-4 py-3 text-sm ">
						<a href="/cardDeckShow/{{ $deck->id }}/edit" class="font-semibold">{{ $deck->name }}</a>
					  </td>
					  <td class="px-4 py-3 text-sm ">
						{{ $deck->formato }}
					  </td>
					  
					  <td class="px-4 py-3 text-sm ">
						<form action="/ExportardecksCadastrados" method="POST">
								<input type="hidden" name="id" value="{{ $deck->id }}" />
								@csrf
									<div>
										<button
										  class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
										>
										  Exportar
										</button>
								  </div>
						 </form>
					  </td>	
					  <td class="px-4 py-3 text-sm">
								
							<div>
							<a data-fancybox data-type="iframe" class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple" href="/card_deck?deck={{ $deck->id }}">Add Cards</a>
								
						  </div>
						
					  </td>	
			  
					  <td class="px-4 py-3">
						<div class="flex items-center space-x-4 text-sm">
						  <a data-fancybox data-type="iframe" class=" flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
							aria-label="Edit"  href="/cadastrarDeck/{{ $deck->id }}/edit" 
						  >
							<svg
							  class="w-5 h-5"
							  aria-hidden="true"
							  fill="currentColor"
							  viewBox="0 0 20 20"
							>
							  <path
								d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
							  ></path>
							</svg>
						  </a>
						  <form action="/cadastrarDeck/{{ $deck->id }}" method="POST" onclick="return confirm('Tem certeza que deseja excluir');">
								<input type="hidden" name="_method" value="DELETE" />
								@csrf
								<button type="submit" class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
								aria-label="Delete" 
								>
									<svg
									  class="w-5 h-5"
									  aria-hidden="true"
									  fill="currentColor"
									  viewBox="0 0 20 20"
									>
									  <path
										fill-rule="evenodd"
										d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
										clip-rule="evenodd"
									  ></path>
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
	<script>
		function mudaPagina(pagina) {
			$("#page").val(pagina);
			$("#frmSelecao").submit();
		}
	</script>
@endsection