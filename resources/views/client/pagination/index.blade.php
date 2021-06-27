<?php
// config
$link_limit = 5; // maximum number of links (a little bit inaccurate, but will be ok for now)
?>

@if ($paginator->lastPage() > 1)
<div class="grid grid-cols-11 gap-1">
        <a class="col-span-4 py-2 px-3 relative" href="{{ $paginator->url($paginator->currentPage()-1) }}" style = "{{ $paginator->currentPage() == 1 ? 'visibility:hidden;' : '' }}">
            <span class="absolute right-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                </svg>
            </span>
        </a>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
               $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            ?>
            @if ($from < $i && $i < $to)
            <div class="mt-2">
                <a class="{{ ($paginator->currentPage() == $i) ? 'text-blue-400' : '' }}" href="{{ $paginator->url($i) }}">{{ $i }}</a>
            </div>
            @endif
        @endfor
        <a class="col-span-4 py-2 px-3 relative" href="{{ $paginator->url($paginator->currentPage()+1) }}" style="{{ $paginator->currentPage() == $paginator->lastPage() ? 'visibility:hidden;' : '' }}">
            <span class="absolute left-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
        </a>
</div>
@endif