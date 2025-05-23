    @if ($wisataCard->hasPages())
            <ul class="pagination">
                {{-- Tombol Previous --}}
                @if ($wisataCard->onFirstPage())
                    <li class="disabled" title="Previous">&laquo;</li>
                @else
                    <li><a href="{{ $wisataCard->previousPageUrl() }}#wisata-list" title="Previous">&laquo;</a></li>
                @endif

                {{-- Tombol Angka --}}
                @foreach ($wisataCard->links()->elements as $element)
                    @if (is_string($element))
                        <li class="disabled">{{ $element }}</li> {{-- Tampilkan titik-titik --}}
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @php $urlWithAnchor = $url . '#wisata-list'; @endphp
                            @if ($page == $wisataCard->currentPage())
                                <li class="active">{{ $page }}</li>
                            @else
                                <li><a href="{{ $urlWithAnchor }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                @if ($wisataCard->hasMorePages())
                    <li><a href="{{ $wisataCard->nextPageUrl() }}#wisata-list" title="Next">&raquo;</a></li>
                @else
                    <li class="disabled" title="Next">&raquo;</li>
                @endif
            </ul>
    @endif