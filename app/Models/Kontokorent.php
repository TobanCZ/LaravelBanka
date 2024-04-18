<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontokorent extends Banka
{
    protected $fillable = ['money','kontokorent','kontokorentAmount'];

    public function setKontokorent($amount)
    {
       $this->kontokorent = $amount;
       return $this->save();
    }

    public function addMoney($amount)
    {
        if($this->kontokorentAmount < 0)
        {
            $this->kontokorentAmount += $amount;

            if($this->kontokorentAmount > 0)
            {
                $this->money = $this->kontokorentAmount;
                $this->kontokorentAmount = 0;
            }
        }
        else
        {
            $this->money += $amount;
        }
        $this->save();
        return true;
    }

    public function withdrawMoney($amount)
    {
        if($this->money + $this->kontokorentAmount - $amount < -$this->kontokorent)
            return back()->withErrors([
                'moneyInput' => "You don't have enough kontokorent."
            ]);

        $this->money -= $amount;
        if($this->money < 0)
        {
            $this->kontokorentAmount += $this->money;
            $this->money = 0;
        }
        $this->save();
        return true;
    }
}
