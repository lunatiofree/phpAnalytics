<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

/**
 * Class Website
 *
 * @mixin Builder
 * @package App
 */
class Website extends Model
{
    /**
     * @param Builder $query
     * @param $value
     * @return Builder
     */
    public function scopeSearchDomain(Builder $query, $value)
    {
        return $query->where('domain', 'like', '%' . $value . '%');
    }

    /**
     * Get the user that owns the website.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User')->withTrashed();
    }

    /**
     * @param Builder $query
     * @param $value
     * @return Builder
     */
    public function scopeOfUser(Builder $query, $value)
    {
        return $query->where('user_id', '=', $value);
    }

    /**
     * @param Builder $query
     * @param $value
     * @return Builder
     */
    public function scopeOfFavorite(Builder $query, $value)
    {
        if (!$value) {
            return $query->whereNull('favorited_at');
        }
        return $query->whereNotNull('favorited_at');
    }

    /**
     * Get the visitors count.
     *
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function visitors()
    {
        return $this->hasMany('App\Models\Stat', 'website_id', 'id')
            ->where('name', '=', 'visitors');
    }

    /**
     * Get the pageviews count.
     *
     * @return Model|\Illuminate\Database\Eloquent\Relations\HasMany|object|null
     */
    public function pageviews()
    {
        return $this->hasMany('App\Models\Stat', 'website_id', 'id')
            ->where('name', '=', 'pageviews');
    }

    /**
     * Get the website's stats.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stats()
    {
        return $this->hasMany('App\Models\Stat')->where('website_id', $this->id);
    }

    /**
     * Get the website's recent stats.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function recents()
    {
        return $this->hasMany('App\Models\Recent')->where('website_id', $this->id);
    }

    /**
     * Encrypt the website's password.
     *
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Crypt::encryptString($value);
    }

    /**
     * Decrypt the website's password.
     *
     * @param $value
     * @return string
     */
    public function getPasswordAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Exception $e) {
            return null;
        }
    }
}
