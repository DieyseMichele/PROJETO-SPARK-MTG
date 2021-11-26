@extends("templates.templateUser")
@section("titulo", "Decks Cadastrados")
@section("content")
	<div class="container px-6 mx-auto grid">
		</br></br>
		<h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300 text-center">
		  Decks Prontos
		</h4></br></br>
		<div class="w-full overflow-hidden rounded-lg shadow-xs">
			
			@if ($decks->currentPage() > 1)
				<a href="#" onclick="mudaPagina({{ $decks->currentPage() - 1 }});" class="btn btn-primary">Anterior</a>
			@endif
			
			@if ($decks->hasMorePages())
				<a href="#" onclick="mudaPagina({{ $decks->currentPage() + 1 }});" class="btn btn-primary">Próximo</a>
			@endif

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
					  <div class="relative w-full max-w-xl mr-6 focus-within:text-purple-500">
					  <label for="ordenacao">Ordenar por:</label></div>
						<div class="col-4 form-group">
							<form id="frmSelecao" method="POST" action="/ordenacaoDeck">
								@csrf
								<input type="hidden" id="page" name="page" value="{{ $decks->currentPage() }}" />
								<select id="ordenacao" name="ordenacao" class="form-control" onchange="$(this).parents('form').submit();">
									<option value="0" 
										@if ($ordenacao == "0")
											selected="selected"
										@endif
									>Nenhum</option>
									<option value="1"
										@if ($ordenacao == "1")
											selected="selected"
										@endif
									>Alfabética</option>
									<option value="2"
										@if ($ordenacao == "2")
											selected="selected"
										@endif
									>Menor Preço</option>
									<option value="3"
										@if ($ordenacao == "3")
											selected="selected"
										@endif
									>Maior Preço</option>
								</select>
							</form>
						</div>
									</div>
					</tr></br>
				<tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
				
					<th class="px-4 py-3">Nome</th>
					<th class="px-4 py-3">Formato</th>
					<th class="px-4 py-3">Usuário</th>
				  <th class="px-4 py-3">Quantidade de Cards</th>				  
				  <th class="px-4 py-3">Ações</th>
				  
				</tr>
			  </thead>
			  <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
				@foreach ($decks as $deck)
					<tr class="text-gray-700 dark:text-gray-400">
					  <td class="px-4 py-3 text-sm ">
						<a href="" class="font-semibold">{{ $deck->name }}</a>
					  </td>
					  <td class="px-4 py-3 text-sm ">
						{{ $deck->formato }}
					  </td>
					 <td class="px-4 py-3 text-sm ">
						{{ $deck->usuario }}
					  </td>
					  <td class="px-4 py-3 text-sm ">
						
					  </td>
					  <td class="px-4 py-3 text-sm ">
					  <div class="flex items-center space-x-4 text-sm">
							<a class=" inline-flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
							href="" 
						  >
							<svg
							  class="w-5 h-5"
							  aria-hidden="true"
							  fill="currentColor"
							  viewBox="0 0 20 20"
							>
							  <path d="M10.219,1.688c-4.471,0-8.094,3.623-8.094,8.094s3.623,8.094,8.094,8.094s8.094-3.623,8.094-8.094S14.689,1.688,10.219,1.688 M10.219,17.022c-3.994,0-7.242-3.247-7.242-7.241c0-3.994,3.248-7.242,7.242-7.242c3.994,0,7.241,3.248,7.241,7.242C17.46,13.775,14.213,17.022,10.219,17.022 M15.099,7.03c-0.167-0.167-0.438-0.167-0.604,0.002L9.062,12.48l-2.269-2.277c-0.166-0.167-0.437-0.167-0.603,0c-0.166,0.166-0.168,0.437-0.002,0.603l2.573,2.578c0.079,0.08,0.188,0.125,0.3,0.125s0.222-0.045,0.303-0.125l5.736-5.751C15.268,7.466,15.265,7.196,15.099,7.03"></path>
							</svg>
							Solicitar Empréstimo
						  </a>
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