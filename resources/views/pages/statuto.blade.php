@extends('layouts.public')

@section('title', 'Statuto - ASCAI Bologna')

@section('content')
    {{-- Header --}}
    <div class="mb-8 bg-gradient-to-r from-sky-50 to-blue-50 rounded-2xl border border-sky-100 p-8 mt-10 md:mt-12">
        <h1 class="text-4xl font-extrabold text-slate-800 mb-2">Statuto dell'associazione</h1>
        <p class="text-slate-600 text-lg">Le norme e regolamenti AS.CA.I Bologna</p>
    </div>

    {{-- Contenuto Principale --}}
    <div class="grid md:grid-cols-3 gap-6 mb-12">
        {{-- Statuto --}}
        <div class="md:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-8 space-y-6">
                <div class="bg-sky-50 border border-sky-200 rounded-lg p-6 mb-6">
                    <p class="text-sm text-slate-600 mb-4">
                        Lo statuto è il documento fondamentale che regola l'organizzazione, il funzionamento e le attività di ASCAI Bologna.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="#" class="flex items-center justify-center gap-2 bg-sky-600 hover:bg-sky-700 text-white px-6 py-3 rounded-lg font-semibold transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Scarica lo statuto (PDF)
                        </a>
                    </div>
                </div>

                <div>
                    <h2 class="text-2xl font-bold text-slate-800 mb-4">Articoli principali</h2>
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-800 mb-2">Art. 1 - Costituzione e denominazione</h3>
                            <p class="text-slate-600 leading-relaxed">
                                È costituita, ai sensi del Codice Civile e del Decreto Legislativo 3 luglio 2017 n. 117 (Codice del Terzo Settore), 
                                l’associazione di promozione sociale denominata:
                                “AS.CA.I – Associazione dei Camerunensi in Italia – Sezione Emilia-Romagna Bologna”,
                                di seguito denominata “Associazione”. 
                                L’Associazione assume la qualifica di Ente del Terzo Settore (ETS) e utilizza l’acronimo APS, 
                                una volta iscritta nel Registro Unico Nazionale del Terzo Settore (RUNTS).
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-slate-800 mb-2">Art. 2 - Sede legale</h3>
                            <p class="text-slate-600 leading-relaxed">
                                L’Associazione ha sede legale nel Comune di Bologna.
                                Il trasferimento della sede legale all’interno dello stesso Comune non comporta modifica statutaria. 
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-slate-800 mb-2">Art. 3 - Durata</h3>
                            <p class="text-slate-600 leading-relaxed mb-3">
                                La durata dell’Associazione è illimitata, 
                                salvo scioglimento deliberato secondo le modalità previste dal presente Statuto.            
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-slate-800 mb-2">Art. 4 - Finalità</h3>
                            <p class="text-slate-600 leading-relaxed">
                                L’Associazione è apartitica, aconfessionale e senza scopo di lucro.
                                Persegue finalità civiche, solidaristiche e di utilità sociale,
                                operando prevalentemente a favore dei propri associati e di terzi.
                                In particolare, l’Associazione si propone di:
                            </p>
                            <ul class="list-disc list-inside text-slate-600 space-y-2">
                                <li>favorire l’integrazione sociale, culturale e civile dei cittadini camerunesi in Italia;</li>
                                <li>promuovere la solidarietà, il dialogo interculturale e la cooperazione tra i popoli; </li>
                                <li>contrastare ogni forma di discriminazione, emarginazione e violenza; </li>
                                <li>sostenere iniziative educative, culturali e sociali; </li>
                                <li>promuovere i diritti umani, la giustizia sociale e la pace.</li>
                            </ul> 
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-slate-800 mb-2">Art. 5 - Attività di interesse generale</h3>
                            <p class="text-slate-600 leading-relaxed mb-2">
                                Per il perseguimento delle proprie finalità, 
                                l’Associazione svolge, ai sensi dell’art. 5 del Codice del Terzo Settore, 
                                le seguenti attività di interesse generale:
                            </p>
                            <ul class="list-disc list-inside text-slate-600 space-y-2">
                                <li>attività culturali, artistiche e ricreative di interesse sociale;</li>
                                <li>organizzazione di eventi, incontri, conferenze e seminari;</li>
                                <li>iniziative di cooperazione e solidarietà internazionale;</li>
                                <li>attività di promozione dei diritti civili e sociali;</li>
                                <li>attività di supporto e orientamento sociale.</li>
                            </ul>

                            <p class="text-slate-600 leading-relaxed mt-4">
                                L’Associazione può svolgere altresì attività diverse da quelle di interesse generale, 
                                purché connesse e strumentali al raggiungimento delle finalità istituzionali e
                                nei limiti previsti dalla normativa vigente.
                            </p>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-slate-800 mb-2">Art. 6 - Ammissione dei soci</h3>
                            <p class="text-slate-600 leading-relaxed">
                                Possono essere soci le persone fisiche e gli enti del Terzo Settore che condividano le finalità dell’Associazione e 
                                si impegnino a realizzarle. L’ammissione avviene su domanda scritta, deliberata dal Consiglio Direttivo.
                                Il rapporto associativo è a tempo indeterminato e non trasmissibile. 
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-slate-50 border border-slate-200 rounded-lg p-6 mt-8">
                    <p class="text-sm text-slate-600">
                        <strong>Nota:</strong> Il presente è un riepilogo dei punti principali dello statuto. Per il testo completo e aggiornato, consulta il documento PDF o contatta direttamente l'associazione.
                    </p>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div>
            <div class="bg-sky-50 border border-sky-200 rounded-xl p-6 sticky top-24">
                <h3 class="text-lg font-bold text-slate-800 mb-4">Sezioni correlate</h3>
                <nav class="space-y-2">
                    <a href="{{ route('chi-siamo') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-white transition-all {{ request()->routeIs('chi-siamo') ? 'text-sky-600 bg-white' : '' }}">
                        Chi siamo
                    </a>
                    <a href="{{ route('statuto') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-white transition-all {{ request()->routeIs('statuto') ? 'text-sky-600 bg-white' : '' }}">
                        Statuto
                    </a>
                    <a href="{{ route('staff-ascaibo') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-white transition-all {{ request()->routeIs('staff-ascaibo') ? 'text-sky-600 bg-white' : '' }}">
                        Lo staff
                    </a>
                    <a href="{{ route('bilancio') }}" class="block px-4 py-2 rounded-lg text-sm font-semibold text-slate-700 hover:text-sky-600 hover:bg-white transition-all {{ request()->routeIs('bilancio') ? 'text-sky-600 bg-white' : '' }}">
                        Bilancio sociale
                    </a>
                </nav>
            </div>
        </div>
    </div>
@endsection
