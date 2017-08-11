<?php


namespace App\Http\Traits;


use App\Models\Favourite;

trait Favourable {

    public function favourites () {
        return $this->morphMany(Favourite::class, 'favourited');
    }

    public function favourite () {
        $attributes = ['user_id' => auth()->id()];

        if (!$this->isFavourited()) {
            return $this->favourites()->create($attributes);
        }
    }

    public function unfavourite () {
        $attributes = ['user_id' => auth()->id()];

        $this->favourites()->where($attributes)->delete();
    }

    public function isFavourited () {
        return (boolean)$this->favourites->where('user_id', auth()->id())->count();
    }

    public function getFavouriteCountsAttribute () {
        return $this->favourites->count();
    }

    public function getIsFavouritedAttribute () {
        return $this->isFavourited();
    }
}