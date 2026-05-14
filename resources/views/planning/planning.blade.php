@extends('layouts.calendar')

@section('title', 'WhoTouchedIt - Planning')

@push('styles')
    <style>
        /* Container principal */
        #calendar {
            background: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 12px;
            padding: 1.5rem;
        }

        /* Toolbar (header) */
        .fc .fc-toolbar {
            background: #1e293b;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .fc .fc-toolbar-title {
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: 700;
        }

        /* Boutons */
        .fc .fc-button {
            background: #334155 !important;
            border: 1px solid #475569 !important;
            color: #ffffff !important;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .fc .fc-button:hover {
            background: #475569 !important;
            border-color: #64748b !important;
        }

        .fc .fc-button:focus {
            box-shadow: 0 0 0 2px #3b82f6 !important;
        }

        .fc .fc-button-primary:not(:disabled).fc-button-active {
            background: #3b82f6 !important;
            border-color: #2563eb !important;
        }

        /* En-têtes des jours */
        .fc .fc-col-header-cell {
            background: #1e293b;
            border-color: #334155;
            padding: 1rem 0.5rem;
        }

        .fc .fc-col-header-cell-cushion {
            color: #94a3b8;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        /* Cellules du calendrier */
        .fc .fc-daygrid-day {
            background: #0f172a;
            border-color: #1e293b;
        }

        .fc .fc-daygrid-day:hover {
            background: #1e293b;
        }

        .fc .fc-daygrid-day-top {
            padding: 0.5rem;
        }

        .fc .fc-daygrid-day-number {
            color: #cbd5e1;
            font-weight: 500;
            padding: 0.25rem 0.5rem;
            border-radius: 6px;
        }

        /* Aujourd'hui */
        .fc .fc-day-today {
            background: #172554 !important;
        }

        .fc .fc-day-today .fc-daygrid-day-number {
            background: #3b82f6;
            color: #ffffff;
            font-weight: 700;
        }

        /* Week-end */
        .fc .fc-day-sat,
        .fc .fc-day-sun {
            background: #0c1222;
        }

        .fc-event:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .fc-event-title {
            font-weight: 500;
            font-size: 0.875rem;
        }

        .fc-event-time {
            font-weight: 600;
            font-size: 0.75rem;
        }

        /* Autres jours du mois */
        .fc .fc-daygrid-day.fc-day-other {
            background: #020617;
        }

        .fc .fc-daygrid-day.fc-day-other .fc-daygrid-day-number {
            color: #475569;
        }

        /* Bouton "Plus" pour les événements */
        .fc .fc-daygrid-more-link {
            color: #3b82f6;
            font-weight: 600;
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            background: #1e293b;
            border: 1px solid #334155;
        }

        .fc .fc-daygrid-more-link:hover {
            background: #334155;
            color: #60a5fa;
        }

        /* Popover pour "Plus d'événements" */
        .fc .fc-popover {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        .fc .fc-popover-header {
            background: #334155;
            color: #ffffff;
            padding: 0.75rem;
            border-radius: 8px 8px 0 0;
        }

        .fc .fc-popover-close {
            color: #94a3b8;
            opacity: 1;
        }

        .fc .fc-popover-close:hover {
            color: #ffffff;
        }

        /* Lignes de la grille */
        .fc .fc-scrollgrid {
            border-color: #1e293b !important;
        }

        .fc .fc-scrollgrid td {
            border-color: #1e293b !important;
        }

        /* Vue liste */
        .fc .fc-list {
            border-color: #1e293b;
        }

        .fc .fc-list-day-cushion {
            background: #1e293b;
            color: #ffffff;
        }

        .fc .fc-list-event:hover td {
            background: #1e293b;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .fc .fc-toolbar {
                flex-direction: column;
                gap: 1rem;
            }

            .fc .fc-toolbar-chunk {
                width: 100%;
                display: flex;
                justify-content: center;
            }
        }

        /* Événements - Style moderne et cohérent */
        .fc-event {
            border: none !important;
            border-left: 3px solid !important;
            border-radius: 6px !important;
            padding: 0.375rem 0.625rem !important;
            margin: 0.125rem 0.25rem !important;
            cursor: pointer;
            transition: all 0.2s ease;
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .fc-event:hover {
            transform: translateX(2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            filter: brightness(1.1);
        }

        /* Titre de l'événement */
        .fc-event-title {
            font-weight: 600;
            font-size: 0.875rem;
            line-height: 1.3;
            color: #ffffff !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        /* Heure de l'événement */
        .fc-event-time {
            font-weight: 600;
            font-size: 0.75rem;
            opacity: 0.9;
            color: #ffffff !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        /* Conteneur principal de l'événement */
        .fc-event-main {
            color: #ffffff !important;
        }

        /* Style spécifique pour chaque statut - À ajouter dans votre PHP */
        /* En attente - Jaune */
        .fc-event[style*="rgb(250, 204, 21)"],
        .fc-event[style*="#facc15"] {
            background: linear-gradient(135deg, rgba(250, 204, 21, 0.25) 0%, rgba(217, 119, 6, 0.15) 100%) !important;
            border-left-color: #facc15 !important;
        }

        /* En cours - Orange */
        .fc-event[style*="rgb(251, 146, 60)"],
        .fc-event[style*="#fb923c"] {
            background: linear-gradient(135deg, rgba(251, 146, 60, 0.25) 0%, rgba(249, 115, 22, 0.15) 100%) !important;
            border-left-color: #fb923c !important;
        }

        /* Terminée - Vert */
        .fc-event[style*="rgb(34, 197, 94)"],
        .fc-event[style*="#22c55e"] {
            background: linear-gradient(135deg, rgba(34, 197, 94, 0.25) 0%, rgba(21, 128, 61, 0.15) 100%) !important;
            border-left-color: #22c55e !important;
        }

        /* Annulée - Rouge */
        .fc-event[style*="rgb(239, 68, 68)"],
        .fc-event[style*="#ef4444"] {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.25) 0%, rgba(185, 28, 28, 0.15) 100%) !important;
            border-left-color: #ef4444 !important;
        }

        /* Planifiée - Bleu */
        .fc-event[style*="rgb(59, 130, 246)"],
        .fc-event[style*="#3b82f6"] {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.25) 0%, rgba(37, 99, 235, 0.15) 100%) !important;
            border-left-color: #3b82f6 !important;
        }

        /* Vue liste - événements */
        .fc-list-event:hover td {
            background: #1e293b !important;
        }

        .fc-list-event-dot {
            border-width: 4px !important;
            border-radius: 50%;
        }

        /* Vue semaine/jour - événements */
        .fc-timegrid-event {
            border-radius: 6px !important;
            border-left-width: 3px !important;
            backdrop-filter: blur(8px);
        }

        .fc-timegrid-event:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            filter: brightness(1.1);
        }

        /* Badge pour le nombre d'événements */
        .fc-daygrid-event-dot {
            display: none;
        }

        /* Animation subtile au survol */
        @keyframes pulse-soft {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.9;
            }
        }

        .fc-event:hover {
            animation: pulse-soft 2s ease-in-out infinite;
        }
    </style>
@endpush

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-3xl font-bold text-white mb-2">Planning des interventions</h2>
            <p class="text-gray-400">Gérez et visualisez vos interventions planifiées</p>
        </div>
        <button onclick="openInterventionModal()"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition inline-flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouvelle intervention
        </button>
    </div>

    <!-- Filtres -->
    <div class="mb-6 flex items-center justify-between gap-2 flex-wrap">
        <div class="flex gap-2 flex-wrap">
            <button id="filtre-annulee" data-status="annulee"
                    class="px-3 py-1.5 bg-yellow-500/10 border border-yellow-500/20 text-red-400 rounded-lg text-sm font-medium hover:bg-yellow-500/20 transition">
                <span class="inline-block w-2 h-2 rounded-full bg-red-400 mr-2"></span>
                Annulee
            </button>
            <button id="filtre-en_attente" data-status="en_attente"
                    class="px-3 py-1.5 bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 rounded-lg text-sm font-medium hover:bg-yellow-500/20 transition">
                <span class="inline-block w-2 h-2 rounded-full bg-yellow-400 mr-2"></span>
                En attente
            </button>
            <button id="filtre-en_cours" data-status="en_cours"
                    class="px-3 py-1.5 bg-orange-500/10 border border-orange-500/20 text-orange-400 rounded-lg text-sm font-medium hover:bg-orange-500/20 transition">
                <span class="inline-block w-2 h-2 rounded-full bg-orange-400 mr-2"></span>
                En cours
            </button>
            <button id="filtre-terminee" data-status="terminee"
                    class="px-3 py-1.5 bg-green-500/10 border border-green-500/20 text-green-400 rounded-lg text-sm font-medium hover:bg-green-500/20 transition">
                <span class="inline-block w-2 h-2 rounded-full bg-green-400 mr-2"></span>
                Terminée
            </button>
            <button id="filtre-tout" data-status="tout"
                    class="px-3 py-1.5 bg-blue-500/10 border border-blue-500/20 text-blue-400 rounded-lg text-sm font-medium hover:bg-blue-500/20 transition">
                <span class="inline-block w-2 h-2 rounded-full bg-blue-400 mr-2"></span>
                Tout affiché
            </button>
        </div>
        <button id="btn-export-pdf"
                class="px-3 py-1.5 bg-slate-700 border border-slate-600 text-slate-200 rounded-lg text-sm font-medium hover:bg-slate-600 transition inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
            </svg>
            Exporter PDF
        </button>
    </div>

    <!-- Modal choix intervention -->
    <div id="interventionModal"
         class="fixed inset-0 z-50 hidden items-center justify-center bg-black/60 backdrop-blur-sm">

        <div class="bg-gray-900 border border-gray-700 rounded-xl w-full max-w-md p-6 shadow-xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-white">Nouvelle intervention</h3>
                <button onclick="closeInterventionModal()" class="text-gray-400 hover:text-white transition">✕</button>
            </div>

            <p class="text-sm text-gray-400 mb-6">
                Quel type d’intervention souhaitez-vous créer ?
            </p>

            <div class="grid grid-cols-1 gap-4">
                <button onclick="goToIntervention('curative')"
                        class="flex items-center gap-4 p-4 rounded-lg bg-blue-600/10 border border-blue-600/20 hover:bg-blue-600/20 transition text-left">
                    <span class="text-2xl">🔧</span>
                    <div>
                        <p class="text-white font-medium">Intervention curative</p>
                        <p class="text-sm text-gray-400">Intervention suite à un incident</p>
                    </div>
                </button>

                @can('add-intervention-planifiee')
                    <button onclick="goToIntervention('preventive')"
                            class="flex items-center gap-4 p-4 rounded-lg bg-purple-600/10 border border-purple-600/20 hover:bg-purple-600/20 transition text-left">
                        <span class="text-2xl">🛡️</span>
                        <div>
                            <p class="text-white font-medium">Intervention préventive</p>
                            <p class="text-sm text-gray-400">Maintenance planifiée</p>
                        </div>
                    </button>
                @endcan
            </div>
        </div>
    </div>

    <!-- Calendar -->
    <div id='calendar'></div>
@endsection

@push('scripts')
    <script>
        let allEvents = [
                @foreach($interventions as $intervention)
                @php
                    // Couleurs selon le statut
                    $statusColors = [
                        'en_attente' => ['bg' => '#facc15', 'border' => '#d97706'],  // jaune
                        'en_cours'   => ['bg' => '#fb923c', 'border' => '#f97316'],  // orange
                        'terminee'   => ['bg' => '#22c55e', 'border' => '#15803d'],  // vert
                        'annulee'    => ['bg' => '#ef4444', 'border' => '#b91c1c'],  // rouge
                    ];
                    $c = $statusColors[$intervention->statut] ?? ['bg' => '#6b7280', 'border' => '#374151']; // gris si inconnu
                @endphp
            {
                title: '{{ $intervention->machine->nom ?? "Intervention" }}',
                start: '{{ \Carbon\Carbon::parse($intervention->dateHeureDebut)->format('Y-m-d\TH:i:s') }}',
                end: '{{ \Carbon\Carbon::parse($intervention->dateHeureFin)->format('Y-m-d\TH:i:s') }}',
                backgroundColor: '{{ $c['bg'] }}',
                borderColor: '{{ $c['border'] }}',
                textColor: '#ffffff',
                url: '{{ route('intervention.detail', $intervention->idIntervention) }}',
                status: '{{ $intervention->statut }}',
                extendedProps: {
                    type: 'corrective',
                    id: {{ $intervention->idIntervention }}
                },
            },
                @endforeach

                @foreach($interventions_planifiees as $inter)
                @php
                    // Couleurs selon le statut pour planifiées
                    $statusColors = [
                        'planifiee'  => ['bg' => '#facc15', 'border' => '#d97706'],  // jaune
                        'en_cours'   => ['bg' => '#3b82f6', 'border' => '#2563eb'],  // bleu
                        'terminee'   => ['bg' => '#22c55e', 'border' => '#15803d'],  // vert
                        'annulee'    => ['bg' => '#ef4444', 'border' => '#b91c1c'],  // rouge
                    ];
                    $c = $statusColors[$inter->statut] ?? ['bg' => '#6b7280', 'border' => '#374151']; // gris si inconnu
                @endphp
            {
                title: '{{ $inter->machine->nom ?? "Intervention planifiée" }}',
                start: '{{ \Carbon\Carbon::parse($inter->dateDebut)->format('Y-m-d\TH:i:s') }}',
                end: '{{ \Carbon\Carbon::parse($inter->dateFin)->format('Y-m-d\TH:i:s') }}',
                backgroundColor: '{{ $c['bg'] }}',
                borderColor: '{{ $c['border'] }}',
                textColor: '#ffffff',
                url: '{{ route('intervention_planifiee.detail', $inter->idInterventionPlanifiee) }}',
                status: '{{ $inter->statut }}',
                extendedProps: {
                    type: 'planifiee',
                    id: {{ $inter->idInterventionPlanifiee }}
                },
            },
            @endforeach
        ];

        let calendar;

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                selectable: true,
                initialView: 'dayGridMonth',
                locale: 'fr',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                buttonText: {
                    today: "Aujourd'hui",
                    month: 'Mois',
                    week: 'Semaine',
                    day: 'Jour',
                    list: 'Liste'
                },
                height: 'auto',
                navLinks: true,
                editable: true,
                dayMaxEvents: true,

                // interventions
                events: allEvents,


                // Clic sur un événement
                eventClick: function (info) {
                    info.jsEvent.preventDefault(); // empêche le comportement par défaut
                    window.open(info.event.url, '_self');
                },

                // Drag & drop
                eventDrop: function (info) {
                    const event = info.event;
                    const type  = event.extendedProps.type;
                    const id    = event.extendedProps.id;

                    const start = event.start.toISOString().slice(0, 19).replace('T', ' ');
                    const end   = event.end
                        ? event.end.toISOString().slice(0, 19).replace('T', ' ')
                        : null;

                    if (!end) {
                        info.revert();
                        showToast('error', "Impossible de déplacer : date de fin manquante.");
                        return;
                    }

                    const routes = {
                        corrective: `intervention/${id}/move`,
                        planifiee:  `intervention-planifiee/${id}/move`,
                    };

                    const body = type === 'corrective'
                        ? { dateHeureDebut: start, dateHeureFin: end }
                        : { dateDebut: start,      dateFin: end      };

                    fetch(routes[type], {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify(body),
                    })
                        .then(async res => {
                            const data = await res.json();

                            if (!res.ok) {
                                const errors = data.errors ?? {};
                                const firstError = Object.values(errors).flat()[0]
                                    ?? data.message
                                    ?? "Déplacement impossible : conflit détecté.";
                                showToast('error', firstError);
                                info.revert();
                                return;
                            }

                            if (!data.success) {
                                info.revert();
                                showToast('error', data.message ?? "Erreur lors du déplacement.");
                                return;
                            }

                            showToast('success', "Intervention déplacée avec succès.");
                        })
                        .catch(() => {
                            info.revert();
                            showToast('error', "Erreur réseau, veuillez réessayer.");
                        });
                },

                // clic sur case vide
                dateClick: function (info) {
                    window.selectedDate = info.dateStr; // on garde la date
                    const modal = document.getElementById('interventionModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

            });

            calendar.render();
        });

        // === filtres ===
        // Filters names
        const filtres = [
            'filtre-terminee',
            'filtre-annulee',
            'filtre-en_cours',
            'filtre-en_attente'
        ];

        // Display the right events according to which filter button is clickec
        filtres.forEach((filtre) => document.getElementById(filtre).addEventListener('click', function () {
            let status = this.dataset.status;

            // Filtrer les événements
            let filteredEvents = allEvents.filter(event => event.status === status);

            // Supprimer tous les événements actuels et ajouter les filtrés
            calendar.removeAllEvents();
            calendar.addEventSource(filteredEvents);
        }));

        // Display all the events
        document.getElementById('filtre-tout').addEventListener('click', function () {
            calendar.removeAllEvents();
            calendar.addEventSource(allEvents);
        });

        // === Modal ===
        /* Open the modal */
        function openInterventionModal() {
            const modal = document.getElementById('interventionModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        /* Close the modal */
        function closeInterventionModal() {
            const modal = document.getElementById('interventionModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        /* Display the right page */
        function goToIntervention(type) {
            let url = '';
            if (type === 'curative') url = "{{ route('intervention.add') }}";
            if (type === 'preventive') url = "{{ route('intervention_planifiee.add') }}";

            window.location.href = url + '?date=' + window.selectedDate;
        }

        /**
         * Used to download the calendar to pdf
         */
        document.getElementById('btn-export-pdf').addEventListener('click', async function () {
            const btn = this;
            btn.disabled = true;
            btn.innerHTML = `
        <svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
        </svg>
        Export en cours...`;

            try {
                const { jsPDF } = window.jspdf;
                const calendarEl = document.getElementById('calendar');

                const canvas = await html2canvas(calendarEl, {
                    backgroundColor: '#0f172a',
                    scale: 2,
                    useCORS: true,
                    logging: false,
                });

                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF({
                    orientation: 'landscape',
                    unit: 'mm',
                    format: 'a4',
                });

                const pdfWidth  = pdf.internal.pageSize.getWidth();
                const pdfHeight = pdf.internal.pageSize.getHeight();
                const ratio     = canvas.width / canvas.height;
                const imgHeight = pdfWidth / ratio;

                // Titre + date
                const title = document.querySelector('.fc-toolbar-title')?.textContent ?? 'Planning';
                const today = new Date().toLocaleDateString('fr-FR', { day: '2-digit', month: 'long', year: 'numeric' });

                pdf.setFillColor(15, 23, 42); // bg-slate-950
                pdf.rect(0, 0, pdfWidth, pdfHeight, 'F');

                pdf.setFont('helvetica', 'bold');
                pdf.setFontSize(16);
                pdf.setTextColor(255, 255, 255);
                pdf.text(`Planning des interventions — ${title}`, 10, 12);

                pdf.setFont('helvetica', 'normal');
                pdf.setFontSize(9);
                pdf.setTextColor(148, 163, 184); // slate-400
                pdf.text(`Exporté le ${today}`, 10, 19);

                // Calendrier
                const yOffset = 24;
                const availableHeight = pdfHeight - yOffset - 5;
                const finalHeight = Math.min(imgHeight, availableHeight);

                pdf.addImage(imgData, 'PNG', 0, yOffset, pdfWidth, finalHeight);

                pdf.save(`planning-${new Date().toISOString().slice(0, 10)}.pdf`);
                showToast('success', 'Planning exporté avec succès !');

            } catch (e) {
                console.error(e);
                showToast('error', "Erreur lors de l'export PDF.");
            } finally {
                btn.disabled = false;
                btn.innerHTML = `
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
            </svg>
            Exporter PDF`;
            }
        });
    </script>
@endpush
