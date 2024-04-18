<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banka extends Model
{
    protected $table = 'Banka';

    protected $fillable = ['money','kontokorentIsEnabled'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addMoney($amount)
    {
        $this->money += $amount;
        $this->save();
        return true;
    }

    public function withdrawMoney($amount)
    {
        if($this->money - $amount < 0)
            return back()->withErrors([
                'moneyInput' => "You don't have enough money."
            ]);

        $this->money -= $amount;
        $this->save();
        return true;
    }


    public function switchOnKontokorent()
    {
        $this->kontokorentIsEnabled = true;
        return $this->save();
    }
    public function switchOffKontokorent()
    {
        $this->kontokorentIsEnabled = false;
        return $this->save();
    }

}
