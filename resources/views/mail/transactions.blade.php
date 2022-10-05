<!DOCTYPE html>
<html>

<head>
    <title>{{ app('config.name') }}</title>
</head>

<body>
    <h1>User Transaction Statement Information</h1>
    <div class="mt-5 p-6 bg-white border-b border-t-2 border-gray-200">
        <span class="text-xl font-bold">
            Your Transactions Statements
        </span>
        <table class="table w-full mt-4 p-4">
            <thead>
                <tr class="p-2">
                    <th class="text-left">#</th>
                    <th class="text-left">Transaction Date</th>
                    <th class="text-left">Balance</th>
                    <th class="text-left">Total Balance</th>
                </tr>
            </thead>
            <tbody>
                @if (count($transactions) == 0)
                    <tr>
                        <td colspan="4" class="text-center py-4">
                            {{ __('No Users available to transfer fund!') }}</td>
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

</body>

</html>
