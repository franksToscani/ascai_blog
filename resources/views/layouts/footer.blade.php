<footer class="bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900 text-white mt-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Logo e Nome -->
        <div class="flex items-center gap-3 mb-8">
            <img src="{{ asset('images/logoAscai1.png') }}" alt="Logo ASCAI Bologna" class="h-16 w-auto">
            <div>
                <h2 class="text-2xl font-bold text-white">ASCAI Bologna</h2>
                <p class="text-sm text-slate-300">Associazione di Categoria Agenti e Imprese</p>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mb-8">
            <!-- Info Associazione -->
            <div>
                <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Dove siamo
                </h3>
                <div class="space-y-2 text-sm text-slate-400">
                    <p class="flex items-start gap-2">
                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span>Cassero di Porta Galliera<br>Piazza XX Settembre 7, 40121 Bologna</span>
                    </p>
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>P.IVA: 94048620549</span>
                    </p>
                </div>
            </div>

            <!-- Contatti -->
            <div>
                <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Contatti
                </h3>
                <div class="space-y-3 text-sm">
                    <a href="mailto:associazione.camer.bologna@gmail.com" class="flex items-center gap-2 text-slate-300 hover:text-white transition-colors">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        associazione.camer.bologna@gmail.com
                    </a>
                    <a href="https://linktr.ee/ascai.bologna" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 text-slate-300 hover:text-white transition-colors">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                        Social e Collegamenti
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <a href="{{ route('contatti') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-sky-600 hover:bg-sky-700 text-white rounded-lg text-sm font-semibold transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Scrivici
                    </a>

                    <!-- Social Media -->
                    <div class="mt-6 pt-6 border-t border-slate-600">
                        <p class="text-xs text-slate-400 mb-3 uppercase font-semibold">Seguici sui social</p>
                        <div class="flex items-center gap-3">
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/groups/ascai.bologna/?ref=share&mibextid=K35XfP&rdid=q88RUU6BZ76tePig&share_url=https%3A%2F%2Fwww.facebook.com%2Fshare%2Fg%2F19zk7Z7cfU%2F%3Fmibextid%3DK35XfP#" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-slate-700 hover:bg-blue-600 rounded-lg flex items-center justify-center transition-colors" title="Facebook">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>

                            <!-- Instagram -->
                            <a href="https://www.instagram.com/ascai2021/#" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-slate-700 hover:bg-gradient-to-br hover:from-purple-600 hover:via-pink-600 hover:to-orange-500 rounded-lg flex items-center justify-center transition-all" title="Instagram">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>

                            <!-- YouTube -->
                            <a href="https://www.youtube.com/@ASCAIBologn" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-slate-700 hover:bg-red-600 rounded-lg flex items-center justify-center transition-colors" title="YouTube">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M23.498 6.186a2.99 2.99 0 00-2.104-2.116C19.6 3.5 12 3.5 12 3.5s-7.6 0-9.394.57A2.99 2.99 0 00.502 6.186C0 8.004 0 12 0 12s0 3.996.502 5.814a2.99 2.99 0 002.104 2.116C4.4 20.5 12 20.5 12 20.5s7.6 0 9.394-.57a2.99 2.99 0 002.104-2.116C24 15.996 24 12 24 12s0-3.996-.502-5.814zM9.75 15.568V8.432L15.818 12 9.75 15.568z"/>
                                </svg>
                            </a>

                            <!-- TikTok -->
                            <a href="https://www.tiktok.com/login?redirect_url=https%3A%2F%2Fwww.tiktok.com%2F%40ascai2021&lang=en&enter_method=mandatory" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-slate-700 hover:bg-black rounded-lg flex items-center justify-center transition-colors" title="TikTok">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                </svg>
                            </a>

                            <!-- X (Twitter) -->

                            <!-- WhatsApp -->
                            <a href="https://www.whatsapp.com/channel/0029VawPvZ01t90iKspR1l0P" target="_blank" rel="noopener noreferrer" class="w-10 h-10 bg-slate-700 hover:bg-green-600 rounded-lg flex items-center justify-center transition-colors" title="WhatsApp">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright e Note Legali -->
        <div class="border-t border-slate-600 pt-8 mt-8">
            <!-- Link Legali -->
            <div class="flex flex-wrap justify-center gap-4 mb-6 text-xs text-slate-400">
                <a href="{{ route('privacy') }}" class="hover:text-white transition-colors">Privacy Policy</a>
                <span>•</span>
                <a href="{{ route('cookie-policy') }}" class="hover:text-white transition-colors">Cookie Policy</a>
                <span>•</span>
                <a href="{{ route('note-legali') }}" class="hover:text-white transition-colors">Note Legali</a>
                <span>•</span>
                <a href="{{ route('login') }}" class="hover:text-white transition-colors flex items-center gap-1">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Admin
                </a>
            </div>
            
            <!-- Copyright -->
            <div class="text-center space-y-2">
                <p class="text-sm text-slate-300">
                    © {{ date('Y') }} <strong>ASCAI Bologna</strong> - Associazione dei Camerunesi a Bologna
                    <br class="sm:hidden">
                    <span class="hidden sm:inline">•</span> Tutti i diritti riservati
                </p>
                <p class="text-xs text-slate-400 flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                    </svg>
                    Sviluppato da <strong class="text-sky-400">Franks Toscani Koudja</strong> - Web Developer
                    <svg class="w-4 h-4 text-red-400" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                    </svg>
                </p>
            </div>
        </div>
    </div>
</footer>
