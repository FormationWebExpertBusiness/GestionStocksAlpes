<div>
	<header class="bg-white pb-2 rounded-t-lg">
        <section aria-labelledby="filter-heading">
			<div class="bg-white pb-4">
				<div class="mx-auto flex max-w-7xl items-center justify-between ">
					<div class="flow-root">
						<div class="-mx-4 flex items-center divide-x divide-gray-200">
							{{-- search bar --}}
							<div class="relative inline-block px-4 text-left" >
								<div class="min-w-0 flex-1">
									<label for="search" class="sr-only">Search</label>
									<div class="relative rounded-md shadow-sm">
									  	<div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
											<!-- Heroicon name: mini/magnifying-glass -->
											<svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
										  		<path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
											</svg>
									  	</div >
									  	<div class="inline-block mt-1 w-80 border rounded-md border-gray-300 focus-within:border-indigo-600">
										  	<input type="search" name="search" id="search" wire:model="searchFilter" class="block rounded-md w-full pl-10 border border-transparent bg-gray-50 focus:border-indigo-600 focus:ring-0 sm:text-sm" placeholder="Rechercher">
										</div>
									</div>
								</div>
							</div>
							{{-- Quantity Min Max --}}
							<div class="relative inline-block px-4 text-left" >
								<label for="name" class="inline-block mr-2 text-sm font-medium text-gray-700">Quantité</label>
								<div class="inline-block relative mt-1 w-24 border rounded-l-md border-gray-300 focus-within:border-indigo-600">
									<input type="text" name="name" id="name" wire:model="quantityMin" class="block w-full rounded-l-md border border-transparent bg-gray-50 focus:border-indigo-600 focus:ring-0 sm:text-sm" placeholder="Min">
                                    @error('quantityMin')
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    @enderror
                                </div>
								<div class="inline-block relative mt-1 -ml-1 w-24 border rounded-r-md border-gray-300 focus-within:border-indigo-600">
									<input type="text" name="name" id="name" wire:model="quantityMax" class="block w-full rounded-r-md border border-transparent bg-gray-50 focus:border-indigo-600 focus:ring-0 sm:text-sm" placeholder="Max">
                                    @error('quantityMax')
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-5a.75.75 0 01.75.75v4.5a.75.75 0 01-1.5 0v-4.5A.75.75 0 0110 5zm0 10a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                    @enderror
                                </div>
							</div>	
							{{-- Rack Dropdown --}}
							<div class="relative inline-block px-4 text-left">
								<button type="button" wire:click="$toggle('isVisibleRack')" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
								<span>Étage</span>
								<span class="ml-1.5 rounded bg-gray-200 py-0.5 px-1.5 text-xs font-semibold tabular-nums text-gray-700">{{ count($racksFilter) }}</span>
								<!-- Heroicon name: mini/chevron-down -->
								<svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
								</svg>
								</button>
								@if ($isVisibleRack)
									<div class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" @click.outside="$wire.isVisibleRack = false">
										<form class="space-y-1">
										@foreach ($racks as $rack)
											<div class="flex items-center">
												<input id="{{ 'rack' . $rack->id }}" name="{{ $rack->name }}"
												value="{{ $rack->id }}" type="checkbox" wire:model='racksFilter' class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
												<label for="{{ 'rack' . $rack->id }}" class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">{{ $rack->name }}</label>
											</div>
										@endforeach
										</form>
									</div>
								@endif
							</div>
							{{-- RackLevel Dropdown --}}
							<div class="relative inline-block px-4 text-left">
								<button type="button" wire:click="$toggle('isVisibleRackLevel')" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
								<span>Numéro d'étage</span>
								<span class="ml-1.5 rounded bg-gray-200 py-0.5 px-1.5 text-xs font-semibold tabular-nums text-gray-700">{{ count($rackLevelsFilter) }}</span>
								<!-- Heroicon name: mini/chevron-down -->
								<svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
								</svg>
								</button>
								@if ($isVisibleRackLevel)
									<div class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" @click.outside="$wire.isVisibleRackLevel = false">
										<form class="space-y-1">
										@foreach ($rackLevels as $rackLevel)
											<div class="flex items-center">
												<input id="{{ 'rackLevel' . $rackLevel }}" name="{{ 'rackLevel' . $rackLevel }}"
												value="{{ $rackLevel }}" type="checkbox" wire:model='rackLevelsFilter' class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
												<label for="{{ 'rackLevel' . $rackLevel }}" class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">Étage {{ $rackLevel }}</label>
											</div>
										@endforeach
										</form>
									</div>
								@endif
							</div>
							{{-- categories Dropdown --}}
							<div class="relative inline-block px-4 text-left">
								<button type="button" wire:click="$toggle('isVisibleCat')" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
									<span>Catégories</span>
									<span class="ml-1.5 rounded bg-gray-200 py-0.5 px-1.5 text-xs font-semibold tabular-nums text-gray-700">{{ count($catsFilter) }}</span>
									<svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
										<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
									</svg>
								</button>
								@if ($isVisibleCat)
									<div class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" @click.outside="$wire.isVisibleCat = false">
										<form class="space-y-1">
											@foreach ($categories as $category)
												<div class="flex items-center">
													<input id="{{ 'cat' . $category->id }}" name="{{ $category->name }}" value="{{ $category->id }}" type="checkbox" wire:model='catsFilter' class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
													<label for="{{ $category->name }}" class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">{{ $category->name }}</label>
												</div>
											@endforeach
										</form>
									</div>
								@endif
							</div>
							{{-- brands Dropdown --}}
							<div class="relative inline-block px-4 text-left">
								<button wire:click="$toggle('isVisibleBrand')" type="button" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
									<span>Marques</span>
									<span class="ml-1.5 rounded bg-gray-200 py-0.5 px-1.5 text-xs font-semibold tabular-nums text-gray-700">{{ count($brandsFilter) }}</span>
									<svg class="-mr-1 ml-1 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
										<path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
									</svg>
								</button>
								@if ($isVisibleBrand)
									<div class="absolute right-0 z-10 mt-2 origin-top-right rounded-md bg-white p-4 shadow-2xl ring-1 ring-black ring-opacity-5 focus:outline-none" @click.outside="$wire.isVisibleBrand = false">
										<form class="space-y-1">
											@foreach ($brands as $brand)
												<div class="flex items-center">
													<input id="{{ 'brand' . $brand->id }}" name="{{ 'brand' . $brand->id }}" 
														value="{{ $brand->id }}" type="checkbox" wire:model='brandsFilter' 
														class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
													<label for="{{ 'brand' . $brand->id }}" 
														class="ml-3 whitespace-nowrap pr-6 text-sm font-medium text-gray-900">{{ $brand->name }}</label>
												</div>
											@endforeach
										</form>
									</div>
								@endif
							</div>
							{{-- resert filters button --}}
							<div class="relative inline-block px-4 text-left">
								<button wire:click="resetFilters" type="button" class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900" aria-expanded="false">
									<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                    </svg>                                      
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
        </section>
	</header> 
</div>
