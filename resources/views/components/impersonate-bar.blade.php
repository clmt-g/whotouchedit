@impersonating
<div style="background: linear-gradient(90deg, rgba(249,115,22,0.08) 0%, rgba(249,115,22,0.04) 100%); border-bottom: 1px solid rgba(249,115,22,0.25);"
     class="w-full px-6 py-2.5 flex items-center justify-between">
    <div class="flex items-center gap-3">
        <span class="flex items-center justify-center w-7 h-7 rounded-full bg-orange-500/15 border border-orange-500/30">
            <svg class="w-3.5 h-3.5 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
            </svg>
        </span>
        <div class="flex items-center gap-1.5 text-sm">
            <span class="text-slate-400">Mode impersonnification</span>
            <span class="text-slate-500">·</span>
            <span class="font-medium text-orange-300">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</span>
            <span class="text-slate-500">·</span>
            <span class="px-1.5 py-0.5 text-xs rounded bg-orange-500/10 border border-orange-500/20 text-orange-400">
                {{ Auth::user()->role }}
            </span>
        </div>
    </div>
    <a href="{{ route('impersonate.leave') }}"
       class="flex items-center gap-1.5 px-3 py-1 text-xs font-medium text-orange-300 border border-orange-500/30 rounded-md hover:bg-orange-500/15 hover:text-orange-200 hover:border-orange-500/50 transition-all duration-150">
        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
        </svg>
        Quitter
    </a>
</div>
@endImpersonating
