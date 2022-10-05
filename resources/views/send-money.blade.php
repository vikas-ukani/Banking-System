<x-app-layout>
    <x-slot name="header">
        <div class=" flex justify-between gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Send Money') }}
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
                                {{ auth()->user()->name }}
                            </h3>
                            <div class="text-sm leading-normal mt-0 mb-2 text-gray-500 font-bold uppercase">
                                <i class="fas fa-map-marker-alt mr-2 text-lg text-gray-500"></i>
                                <strong>{{ __('Your Balance: ') }} </strong>
                                {{ auth()->user()->balance() }}
                            </div>
                        </div>

                        <div class="mt-10 py-10 border-t border-gray-300 text-center">
                            <div class="flex justify-center">
                                <form method="post" action="{{ url('user/send-money') }}" class="w-full max-w-sm">
                                    @csrf

                                    @if (auth()->user()->balance() == 0)
                                        <p class="mb-6 text-red-700 font-bold">
                                            {{ __('You dont have enough balance in your wallet.') }}
                                        </p>
                                    @endif

                                    <div class="mb-6">
                                        <div class="md:flex md:items-center">
                                            <div class="md:w-1/3">
                                                <label
                                                    class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                                    {{ __('Transfer to Email') }}
                                                </label>
                                            </div>
                                            <div class="md:w-2/3">
                                                <input class="" type="text" name="email"
                                                    value={{ $toUser['email'] }} placeholder="person@example.net" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <div class="md:flex md:items-center">
                                            <div class="md:w-1/3">
                                                <label
                                                    class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                                    {{ __('Amount') }}
                                                </label>
                                            </div>
                                            <div class="md:w-2/3">
                                                <span class="leading-10 mr-2"></span>
                                                <input class="" type="text" name="amount" placeholder="3.00"
                                                    required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-6">
                                        <div class="md:flex md:items-center">
                                            <div class="md:w-1/3">
                                                <label
                                                    class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                                                    {{ __('Description') }}
                                                </label>
                                            </div>
                                            <div class="md:w-2/3">
                                                <span class="leading-10 mr-2"></span>
                                                <input class="" type="text" name="description"
                                                    placeholder="Enter Description" required />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-center py-4">
                                        <x-primary-button class="py-4 mb-2 text-center inline-block">
                                            {{ __('Send Money') }}
                                        </x-primary-button>
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
