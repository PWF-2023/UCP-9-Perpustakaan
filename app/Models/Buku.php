<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buku extends Model
{

    use HasFactory;

    public function canBeBorrowed(): bool
    {
        return $this->activePeminjamen() < $this->copies_in_circulation;
    }

    private function activePeminjamen(): int
    {
        return $this->peminjamen()
            ->where('is_returned', false)
            ->get()
            ->sum('number_borrowed');
    }

    public function peminjamen(): HasMany
    {
        return $this->hasMany(Peminjaman::class);
    }

    public function availableCopies(): int
    {
        return $this->copies_in_circulation - $this->activePeminjamen();
    }
}
