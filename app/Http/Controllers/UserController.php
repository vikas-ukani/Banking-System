<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepositFundRequest;
use App\Http\Requests\SendMoneyToUserRequest;
use App\Mail\GenerateTransactionPDF;
use App\Models\Account;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    public function __construct()
    {

        $this->middleware('can:deposits', ['only' => ['addFundToWalletView', 'addFundToWallet']]);
        $this->middleware('can:withdrawals', ['only' => ['withdrawView', 'withdrawFund']]);

        /** Stripe API Initiate */
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    /** User Dashboard View */
    public function index()
    {
        $user = User::where('id', auth()->user()->id)->with(['account', 'roles'])->first();

        /** Get Other Users except logged in user */
        $users = Role::where('id', 3)->with(['users' => function ($q) {
            return $q->where('id', '<>', auth()->user()->id);
        }, 'users.account'])->first();

        $transactions = $user->balanceTransactions()->toArray();
        return view('dashboard')
            ->with('user', $user)
            ->with('transactions', $transactions)
            ->with('users', $users->users);
    }

    public function addFundToWalletView()
    {
        return view('add-fund');
    }

    /**
     * Add Money to wallet
     *
     * @param DepositFundRequest $request
     * @return void
     */
    public function addFundToWallet(DepositFundRequest $request)
    {
        $input  = $request->validated();
        try {
            Account::where('user_id', auth()->user()->id)->first();
            $user = auth()->user();
            $user->debitBalance($input['amount'] * 100, $input['description']);
            return view('add-fund')->with('success', 'Fund added to your wallet.');
        } catch (\Exception $e) {
            return view('add-fund')->with('error', $e->getMessage());
        }
    }

    /**
     * Send Money to User from Wallet
     *
     * @return void
     */
    public function sendMoneyFromWallet(SendMoneyToUserRequest $request)
    {
        $input  = $request->validated();
        try {
            $user = auth()->user();
            $toUser = User::where('email', $input['email'])->first();
            $toUser->debitBalance($input['amount'] * 100, $input['description']);
            $user->creditBalance($input['amount'] * 100, $input['description']);
            return redirect()->to('dashboard');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->to('dashboard')->with('error', $e->getMessage());
        }
    }

    /**
     * Generate and Share Invoice to user's email
     *
     * @return void
     */
    public function generateInvoice()
    {
        $user = auth()->user();
        $transactions = $user->balanceTransactions()->toArray();

        Mail::to($user->email)->send(new GenerateTransactionPDF($transactions));
        if (Mail::failures()) {
            return response()->Fail('Sorry! Please try again latter');
        } else {
            return response()->success('Great! Successfully send in your mail');
        }

        // $invoice = $user->createInvoice()->toArray();
        // return $user->downloadInvoice($invoice['id']);
        // return redirect()->to('dashboard');
    }
}
