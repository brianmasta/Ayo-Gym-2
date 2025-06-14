<div>
    @if ($expiredCount > 0)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            ⚠️ Ada {{ $expiredCount }} member yang masa berlakunya telah berakhir!
        </div>
    @endif
</div>
