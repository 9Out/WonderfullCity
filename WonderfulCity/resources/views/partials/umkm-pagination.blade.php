    @if ($umkmCard->hasPages())
            <ul class="pagination">
                {{-- Tombol Previous --}}
                @if ($umkmCard->onFirstPage())
                    <li class="disabled" title="Previous">&laquo;</li>
                @else
                    <li><a href="{{ $umkmCard->previousPageUrl() }}#umkm-list" title="Previous">&laquo;</a></li>
                @endif

                {{-- Tombol Angka --}}
                @foreach ($umkmCard->links()->elements as $element)
                    @if (is_string($element))
                        <li class="disabled">{{ $element }}</li> {{-- Tampilkan titik-titik --}}
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @php $urlWithAnchor = $url . '#umkm-list'; @endphp
                            @if ($page == $umkmCard->currentPage())
                                <li class="active">{{ $page }}</li>
                            @else
                                <li><a href="{{ $urlWithAnchor }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                @if ($umkmCard->hasMorePages())
                    <li><a href="{{ $umkmCard->nextPageUrl() }}#umkm-list" title="Next">&raquo;</a></li>
                @else
                    <li class="disabled" title="Next">&raquo;</li>
                @endif
            </ul>
    @endif