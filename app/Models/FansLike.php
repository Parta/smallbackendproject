<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FansLike extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'page_id', 'name', 'page', 'count', 'request_time'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'created_at', 'updated_at',
    ];

    protected $table = 'fans_likes';

    /**
     * @param int $offset
     * @param int $limit
     * @param string $pageName
     * @return mixed collection of items base on request parameters
     */
    public static function getChunked(int $offset, int $limit, string $pageName)
    {
        $query = (new static)->newQuery();
        if ($pageName !== 'all') {
            $query->where('page', '=', $pageName);
        }

        return $limit ?
            $query->offset($offset)
                ->limit($limit)
                ->get() :
            $query->get();
    }


    /**
     * Transforms collection of items into proper type
     * @param Collection|null $items
     * @param string $type
     * @return array
     */
    public static function getTransformedItems(Collection $items = null, string $type = 'table')
    {
        if (empty($items)) {
            return [];
        }

        switch ($type) {
            case 'table':
                $results = [];
                foreach ($items as $item) {
                    $results[$item->page][(Carbon::parse($item->request_time))->timestamp] = $item->count;
                }
                return $results;
            case 'linechart':
                $results = [];
                foreach ($items as $item) {
                    $results[$item->page][] = [
                        'date'  => $item->request_time,
                        'value' => $item->count
                    ];
                }
                return $results;
            case 'multipage':
            default:
                $results = [];
                foreach ($items as $item) {
                    $results[$item->page][] = $item->toArray();
                }
                return $results;
        }
    }
}
