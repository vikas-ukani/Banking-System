<x-app-layout>
    <x-slot name="header">
        <div class=" flex justify-between gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <div class="flex justify-between gap-2">
                @if ($user->account)
                    <div class="border px-4 py-2 rounded text-sm text-gray-700 bg-slate-50 ">
                        <strong>{{ __('Balance: ') }}</strong>
                        {{ auth()->user()->balance() ?? 0.0 }}
                    </div>
                @endif

                @can('deposits')
                    <a href="{{ route('user.add-fund') }}"
                        class="border px-4 py-2 rounded text-sm text-gray-700 bg-slate-200 ">
                        {{ __('Deposits Fund') }}
                    </a>
                @endcan

                @can('withdrawals')
                    <a href="{{ url('/user.withdraw') }}"
                        class="border px-4 py-2 rounded text-sm text-gray-700 bg-orange-400 ">
                        {{ __('Withdraw Fund') }}
                    </a>
                @endcan
            </div>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="mb-4 p-6 bg-white border-b border-gray-200">
                    <span class="text-xl font-bold">
                        {{ __('All Users') }}
                    </span>
                    <table class="table w-full mt-4 p-4">
                        <thead>
                            <tr class="p-2">
                                <th class="text-left">#</th>
                                <th class="text-left">Name</th>
                                <th class="text-left">Email</th>
                                <th class="text-left">Balance</th>
                                <th class="text-left">Transer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users) == 0)
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        {{ __('No Users available to transfer fund!') }}</td>
                                </tr>
                            @endif
                            @foreach ($users as $usr)
                                <tr>
                                    <td> {{ ++$loop->index }}</td>
                                    <td>{{ $usr['name'] }}</td>
                                    <td>{{ $usr['email'] }}</td>
                                    <td>{{ $usr->balance() }}</td>
                                    <td>
                                        <div class=" flex justify-between gap-2">
                                            {{-- Only User Can Transer amount --}}
                                            @if (collect(auth()->user()->roles)->where('id', 3)->first())
                                                <a href="{{ url('send-money/' . $usr->id) }}"
                                                    class="border px-4 py-2 rounded text-sm text-gray-700 bg-green-400 ">
                                                    {{ __('Send Money') }}
                                                </a>
                                            @else
                                                -
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-5 p-6 bg-white border-b border-t-2 border-gray-200">
                    <span class="text-xl font-bold">
                        {{ __('Your Transactions Statements') }}
                    </span>

                    @if (count($transactions) > 0)
                        <a href="{{ route('generate-invoice') }}" class="text-sm text-blue-500 underline pl-4">
                            {{ __('Generate Invoice') }}
                        </a>
                    @endif
                    <table class="table w-full mt-4 p-4">
                        <thead>
                            <tr class="p-2">
                                <th class="text-left">{{ __('#') }}</th>
                                <th class="text-left">{{ __('Transaction Date') }}</th>
                                <th class="text-left">{{ __('Balance') }}</th>
                                <th class="text-left">{{ __('Total Balance') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($transactions) == 0)
                                <tr>
                                    <td colspan="4" class="text-center py-4">
                                        {{ __('No transactions statements fund!') }}</td>
                                </tr>
                            @endif
                            @foreach ($transactions as $transaction)
                                <tr>
                                    <?php $transaction = $transaction->toArray(); ?>
                                    <td> {{ ++$loop->index }}</td>
                                    <td>
                                        {{ gmdate('d-m-Y H:i:s', $transaction['created']) }}
                                    </td>

                                    <td>{{ $transaction['amount'] / 100 }}</td>
                                    <td>{{ $transaction['ending_balance'] / 100 }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
