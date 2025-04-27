<?php

namespace App\Infrastructure\Persistence;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * BookModel
 *
 * @mixin Builder
 */
class BookModel extends Model
{
    use SoftDeletes;

    protected $table = 'books';

    protected $fillable = [
        'title',
        'description',
        'author_name',
    ];

    public $timestamps = true;
}
