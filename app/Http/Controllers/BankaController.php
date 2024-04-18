<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Banka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BankaController extends Controller
{
    public function show()
    {
        $banka = Auth::user()->banka;
        return view('banka.index',['money' => $banka->money,'kontokorentIsEnabled' => $banka->kontokorentIsEnabled,'kontokorentSize' => $banka->kontokorent,'kontokorentAmount' => $banka->kontokorentAmount, 'loan' => $banka->loan]);
    }

    public function switchKontokorent(Request $request)
    {
        $banka = Auth::user()->banka;
        if($request->has('kontokorentCheckBox'))
            $banka->switchOnKontokorent();
        else
        {
            if(Auth::user()->kontokorent->kontokorentAmount < 0)
                return back()->withErrors([
                    'moneyInput' => "You didn't pay off your kontokorent."
                ]);
            $banka->switchOffKontokorent();
        }
        return back();
    }

    public function setKontokorent(Request $request)
    {
        $request->validate(
            [
                'kontokorentInput' => ['required', 'numeric', 'gt:0'],
            ]);

        Auth::user()->kontokorent->setKontokorent($request->input('kontokorentInput'));
        return back();
    }

    public function lend (Request $request)
    {
        $request->validate(
            [
                'lendInput' => ['required', 'numeric', 'gt:0'],
            ]);

        $loan = Auth::user()->loan;
        $loan->addMoney($request->input('lendInput'));
        return back();
    }

    public function splatit (Request $request)
    {
        $request->validate(
            [
                'splatitInput' => ['required', 'numeric', 'gt:0'],
            ]);

        $loan = Auth::user()->loan;
        $loan->withdrawMoney($request->input('splatitInput'));
        return back();
    }

    public function money(Request $request)
    {
        $request->validate(
            [
                'moneyInput' => ['required', 'numeric', 'gt:0'],
            ]);

        $banka = Auth::user()->banka;
        $kontokorent= Auth::user()->kontokorent;

        switch ($request->input('action'))
        {
            case 'deposit':
                if($banka->kontokorentIsEnabled)
                    $kontokorent->addMoney($request->input('moneyInput'));
                else
                    $banka->addMoney($request->input('moneyInput'));
                break;
            case 'withdraw':
                if($banka->kontokorentIsEnabled)
                    $kontokorent->withdrawMoney($request->input('moneyInput'));
                else
                    $banka->withdrawMoney($request->input('moneyInput'));
                break;
        }
        return back();
    }

}
