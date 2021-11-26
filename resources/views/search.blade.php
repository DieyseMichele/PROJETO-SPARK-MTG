@extends("templates.templateAdmin")

@section("content")
	<div class="container px-6 my-6 grid">
		<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
				
			<div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2 p-1 mt-2 mx-auto lg:mx-2 md:mx-2 justify-between">
				@if($posts->isNotEmpty())
					@foreach ($posts as $post)
						<div class="flip-box rounded rounded-t-lg overflow-hidden shadow">							
						  <div class="flip-box-inner text-xs font-semibold">
							<div class="flip-box-front rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3 text-center">
							  <img src="{{url($post->image_uris)}}" alt="{{ $post->name }}" class="w-f" >
							</div>
							<div class="flip-box-back px-4 py-3 text-sm ">
								<p class="font-semibold">Nome: {{ $post->name }}</p>
								<p class="font-semibold"> Descrição: {{ $post->oracle_text }}</p>
								<p class="font-semibold"> Custo de Mana: {{ $post->mana }}</p>
								<p class="font-semibold"> Raridade: {{ $post->rarity }}</p>
							</div>
						  </div>
						 
						</div>
					@endforeach	
				@else 
					<div>
						<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
							Nenhum resultado encontrado.
						</h2>
					</div>
				@endif
					
			</div>
		</h2>
	</div>	

@endsection