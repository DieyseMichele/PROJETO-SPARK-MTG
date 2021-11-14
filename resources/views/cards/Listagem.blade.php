@extends("templates.templateAdmin")

@section("content")
		<div class="container px-6 mx-auto grid">
			<h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
				
					<div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2 p-1 mt-2 mx-auto lg:mx-2 md:mx-2 justify-between">
						<div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3 text-center">						
							<img src="{{ asset('css/img/exemplo1.jpg') }}"alt="" class="w-f"/>
						</div>
						<div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3 text-center">
							<img src="{{ asset('css/img/exemplo2.jpg') }}" alt="" class="w-f"/>
							
						</div>
						<div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3 text-center">
							<img src="{{ asset('css/img/exemplo3.jpg') }}" alt="" class="w-f"/>
							
						</div>
					
					</div>
					
				<div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2 p-1 mt-2 mx-auto lg:mx-2 md:mx-2 justify-between">
					<div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3 text-center">
						<img src="{{ asset('css/img/exemplo1.jpg') }}"alt="" class="w-f"/>
						
					</div>
					<div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3 text-center">
						<img src="{{ asset('css/img/exemplo2.jpg') }}" alt="" class="w-f"/>
						
					</div>
					<div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3 text-center">
						<img src="{{ asset('css/img/exemplo3.jpg') }}" alt="" class="w-f"/>
						
					</div>
					
				</div>
				<div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2 p-1 mt-2 mx-auto lg:mx-2 md:mx-2 justify-between">
					<div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3 text-center">
						<img src="{{ asset('css/img/exemplo1.jpg') }}"alt="" class="w-f"/>
						
					</div>
					<div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3 text-center">
						<img src="{{ asset('css/img/exemplo2.jpg') }}" alt="" class="w-f"/>
						
					</div>
					<div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3 text-center">
						<img src="{{ asset('css/img/exemplo3.jpg') }}" alt="" class="w-f"/>
						
					</div>
					
				</div>
			</h2>
		</div>		
	
@endsection