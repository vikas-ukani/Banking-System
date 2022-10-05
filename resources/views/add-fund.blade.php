<x-app-layout>
    <x-slot name="header">
        <div class=" flex justify-between gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Found To Wallet') }}
            </h2>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=" flex flex-col  break-words bg-white w-full shadow-xl rounded-lg ">
                    <div class="px-6">
                        <div class="text-center pt-4">
                            <h3 class="text-4xl font-semibold leading-normal mb-2 text-gray-800">
                                {{ auth()->user()['name'] }}
                            </h3>
                            <div class="text-sm leading-normal mt-0 mb-2 text-gray-500 font-bold uppercase">
                                <i class="fas fa-map-marker-alt mr-2 text-lg text-gray-500"></i>
                                <strong>Balance: </strong> {{ auth()->user()->balance() }}
                            </div>
                        </div>

                        <div class="mt-10 py-10 border-t border-gray-300 text-center">
                            <div class="flex justify-center">

                                <form method="POST" action="{{ url('user/add-money')}}" class="w-full max-w-sm">
                                    @csrf

                                    @isset($success)
                                        <p class="text-green-500 font-bold mb-5">
                                            {{ $success }}
                                        </p>
                                    @endisset
                                    @isset($error)
                                        <p class="text-red-500 font-bold mb-5">
                                            {{ $error }}
                                        </p>
                                    @endisset
                                    <div class="mb-6 ">
                                        <div class="md:flex md:items-center">
                                            <div class="md:w-1/3">
                                                <label
                                                    class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                                    Amount
                                                </label>
                                            </div>
                                            <div class="md:w-2/3">
                                                <span class="leading-10 mr-2"></span>
                                                <input class="" type="number" name="amount" placeholder="3.00"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <div class="md:flex md:items-center">
                                            <div class="md:w-1/3">
                                                <label
                                                    class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                                    Description
                                                </label>
                                            </div>
                                            <div class="md:w-2/3">
                                                <span class="leading-10 mr-2"></span>
                                                <input class="" type="text" name="description"
                                                    placeholder="Enter Description"  required/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-center items-center py-4">
                                        <x-primary-button class="py-4 mb-2 text-center inline-block">
                                            {{ __('Add Money') }}
                                        </x-primary-button>

                                        <a href={{ route('dashboard') }}
                                            class="pl-4 border rounded  p-4 mb-2 text-center ">
                                            {{ __('Back') }}
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
