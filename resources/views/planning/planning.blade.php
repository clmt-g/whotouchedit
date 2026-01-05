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

        /* Événements */
        .fc-event {
            border: none !important;
            border-radius: 6px !important;
            padding: 0.25rem 0.5rem !important;
            margin: 0.125rem 0 !important;
            cursor: pointer;
            transition: all 0.2s;
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
    <div class="mb-6 flex gap-2 flex-wrap">
        <button
            class="px-3 py-1.5 bg-yellow-500/10 border border-yellow-500/20 text-red-400 rounded-lg text-sm font-medium hover:bg-yellow-500/20 transition">
            <span class="inline-block w-2 h-2 rounded-full bg-red-400 mr-2"></span>
            Anulee
        </button>
        <button
            class="px-3 py-1.5 bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 rounded-lg text-sm font-medium hover:bg-yellow-500/20 transition">
            <span class="inline-block w-2 h-2 rounded-full bg-yellow-400 mr-2"></span>
            En attente
        </button>
        <button
            class="px-3 py-1.5 bg-blue-500/10 border border-blue-500/20 text-blue-400 rounded-lg text-sm font-medium hover:bg-blue-500/20 transition">
            <span class="inline-block w-2 h-2 rounded-full bg-blue-400 mr-2"></span>
            En cours
        </button>
        <button
            class="px-3 py-1.5 bg-green-500/10 border border-green-500/20 text-green-400 rounded-lg text-sm font-medium hover:bg-green-500/20 transition">
            <span class="inline-block w-2 h-2 rounded-full bg-green-400 mr-2"></span>
            Terminée
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
                <button onclick="goToIntervention('curative')" class="flex items-center gap-4 p-4 rounded-lg bg-blue-600/10 border border-blue-600/20 hover:bg-blue-600/20 transition text-left">
                    <span class="text-2xl">🔧</span>
                    <div>
                        <p class="text-white font-medium">Intervention curative</p>
                        <p class="text-sm text-gray-400">Intervention suite à un incident</p>
                    </div>
                </button>

                <button onclick="goToIntervention('preventive')" class="flex items-center gap-4 p-4 rounded-lg bg-purple-600/10 border border-purple-600/20 hover:bg-purple-600/20 transition text-left">
                    <span class="text-2xl">🛡️</span>
                    <div>
                        <p class="text-white font-medium">Intervention préventive</p>
                        <p class="text-sm text-gray-400">Maintenance planifiée</p>
                    </div>
                </button>
            </div>
        </div>
    </div>

    <!-- Calendar -->
    <div id='calendar'></div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
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
                events: [
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
                        url: '{{ route('intervention.detail', $intervention->idIntervention) }}'
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
                        url: '{{ route('intervention_planifiee.detail', $inter->idInterventionPlanifiee) }}'
                    },
                    @endforeach
                ],


                // Clic sur un événement
                eventClick: function(info) {
                    info.jsEvent.preventDefault(); // empêche le comportement par défaut
                    window.open(info.event.url, '_self');
                },

                // Drag & drop (déplacement) FIXME
                eventDrop: function (info) {
                    console.log('Événement déplacé:', info.event.title);
                    // Appeler votre API Laravel pour mettre à jour
                },

                // clic sur case vide
                dateClick: function(info) {
                    window.selectedDate = info.dateStr; // on garde la date
                    const modal = document.getElementById('interventionModal');
                    modal.classList.remove('hidden');
                    modal.classList.add('flex');
                }

            });

            calendar.render();
        });

        // modal
        function closeInterventionModal() {
            const modal = document.getElementById('interventionModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function goToIntervention(type) {
            let url = '';
            if (type === 'curative') url = "{{ route('intervention.add') }}";
            if (type === 'preventive') url = "{{ route('intervention_planifiee.add') }}";

            // ajoute la date dans l'URL si tu veux
            window.location.href = url + '?date=' + window.selectedDate;
        }

        function openInterventionModal() {
            const modal = document.getElementById('interventionModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

    </script>
@endpush
