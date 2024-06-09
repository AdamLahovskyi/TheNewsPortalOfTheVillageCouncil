<?php

namespace core;

class Pagination
{
    public static function paginate($totalItems, $currentPage, $perPage)
    {
        $totalPages = ceil($totalItems / $perPage);

        $pagination = [
            'total_pages' => $totalPages,
            'current_page' => $currentPage,
            'prev_page' => ($currentPage > 1) ? $currentPage - 1 : null,
            'next_page' => ($currentPage < $totalPages) ? $currentPage + 1 : null,
            'pages' => []
        ];

        for ($i = 1; $i <= $totalPages; $i++) {
            $pagination['pages'][] = $i;
        }

        return $pagination;
    }
}
