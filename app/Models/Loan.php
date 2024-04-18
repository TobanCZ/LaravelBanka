<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Loan extends Banka
{
    protected $fillable = ['loan'];

    public function withdrawMoney($amount)
    {
        $banka = Auth::user()->banka;
        if($banka->kontokorentIsEnabled)
            $result = Auth::user()->kontokorent->withdrawMoney($amount);
        else
            $result = $banka->withdrawMoney($amount);

        if($result === true)
        {
            $this->loan += $amount;
            if ($this->loan > 0) {
                $this->addMoney($this->loan);
                $this->loan = 0;
            }
        }

        return $this->save();
    }

    public function addMoney($amount)
    {
        $banka = Auth::user()->banka;
        if($banka->kontokorentIsEnabled)
            $result = Auth::user()->kontokorent->addMoney($amount);
        else
            $result = $banka->addMoney($amount);

        $this->loan -= $amount;
        return $this->save();
    }
}
