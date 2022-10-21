@extends('template')
@section('title', 'Stock')
@section('content')
    <div class="min-w-0 ml-64">
        <div class="bg-white">
            {{-- <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8 lg:py-24">
                <div class="grid grid-cols-1 gap-12 lg:grid-cols-3 lg:gap-8">
                    <div class="space-y-5 sm:space-y-4">
                        <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Tableau de bord</h2>
                        <p class="text-xl text-gray-500">Libero fames augue nisl porttitor nisi, quis. Id ac elit odio vitae
                            elementum enim vitae ullamcorper suspendisse. Vivamus fringilla.</p>
                    </div>
                    <div class="lg:col-span-2">
                        <ul role="list" class="space-y-12 sm:grid sm:grid-cols-2 sm:gap-12 sm:space-y-0 lg:gap-x-8">
                            <li>
                                <div class="flex items-center space-x-4 lg:space-x-6">
                                    <img class="h-16 w-16 rounded-full lg:h-20 lg:w-20"
                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="">
                                    <div class="space-y-1 text-lg font-medium leading-6">
                                        <h3>Leslie Alexander</h3>
                                        <p class="text-indigo-600">Co-Founder / CEO</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center space-x-4 lg:space-x-6">
                                    <img class="h-16 w-16 rounded-full lg:h-20 lg:w-20"
                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                        alt="">
                                    <div class="space-y-1 text-lg font-medium leading-6">
                                        <h3>Leslie Alexander</h3>
                                        <p class="text-indigo-600">Co-Founder / CEO</p>
                                    </div>
                                </div>
                            </li>

                            <!-- More people... -->
                        </ul>
                    </div>
                </div>
            </div> --}}
            <div class="mx-auto max-w-7xl py-12 px-4 sm:px-6 lg:px-8 lg:py-24">
                
                    <div>
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Last 30 days</h3>
                        <dl class="mt-5 grid grid-cols-1 divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow md:grid-cols-3 md:divide-y-0 md:divide-x">
                          <div class="px-4 py-5 sm:p-6">
                            <dt class="text-base font-normal text-gray-900">Total Subscribers</dt>
                            <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                              <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                71,897
                                <span class="ml-2 text-sm font-medium text-gray-500">from 70,946</span>
                              </div>
                      
                              <div class="inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800 md:mt-2 lg:mt-0">
                                <!-- Heroicon name: mini/arrow-up -->
                                <svg class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                  <path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only"> Increased by </span>
                                12%
                              </div>
                            </dd>
                          </div>
                      
                          <div class="px-4 py-5 sm:p-6">
                            <dt class="text-base font-normal text-gray-900">Avg. Open Rate</dt>
                            <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                              <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                58.16%
                                <span class="ml-2 text-sm font-medium text-gray-500">from 56.14%</span>
                              </div>
                      
                              <div class="inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium bg-green-100 text-green-800 md:mt-2 lg:mt-0">
                                <!-- Heroicon name: mini/arrow-up -->
                                <svg class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                  <path fill-rule="evenodd" d="M10 17a.75.75 0 01-.75-.75V5.612L5.29 9.77a.75.75 0 01-1.08-1.04l5.25-5.5a.75.75 0 011.08 0l5.25 5.5a.75.75 0 11-1.08 1.04l-3.96-4.158V16.25A.75.75 0 0110 17z" clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only"> Increased by </span>
                                2.02%
                              </div>
                            </dd>
                          </div>
                      
                          <div class="px-4 py-5 sm:p-6">
                            <dt class="text-base font-normal text-gray-900">Avg. Click Rate</dt>
                            <dd class="mt-1 flex items-baseline justify-between md:block lg:flex">
                              <div class="flex items-baseline text-2xl font-semibold text-indigo-600">
                                24.57%
                                <span class="ml-2 text-sm font-medium text-gray-500">from 28.62%</span>
                              </div>
                      
                              <div class="inline-flex items-baseline px-2.5 py-0.5 rounded-full text-sm font-medium bg-red-100 text-red-800 md:mt-2 lg:mt-0">
                                <!-- Heroicon name: mini/arrow-down -->
                                <svg class="-ml-1 mr-0.5 h-5 w-5 flex-shrink-0 self-center text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                  <path fill-rule="evenodd" d="M10 3a.75.75 0 01.75.75v10.638l3.96-4.158a.75.75 0 111.08 1.04l-5.25 5.5a.75.75 0 01-1.08 0l-5.25-5.5a.75.75 0 111.08-1.04l3.96 4.158V3.75A.75.75 0 0110 3z" clip-rule="evenodd" />
                                </svg>
                                <span class="sr-only"> Decreased by </span>
                                4.05%
                              </div>
                            </dd>
                          </div>
                        </dl>
                      </div>
                      
                </div>
                
            </div>

        </div>  
        
            <livewire:scripts />
        </div>
    @endsection
