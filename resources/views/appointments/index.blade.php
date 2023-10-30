@section('script')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
{{--    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.9/index.global.min.js'></script>--}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            @can('Crea Appuntamento')
                const modalEl = document.getElementById('addAppointmentModal');
                modalEl.setAttribute('data-modal-target', 'addAppointmentModal');
                const modal = new Modal(modalEl);
            @endcan

            const appointmentModalEl = document.getElementById('appointmentModal');
            const appointmentModal = new Modal(appointmentModalEl);


            const appointmentEditModalEl = document.getElementById('editAppointmentModal');
            const appointmentEditModal = new Modal(appointmentEditModalEl);

            let appointmentId = 0;

            function addZero(i) {
                i = i < 10 ? "0" + i : i;
                return i;
            }


            const event = @json($appointments);
            const calendarEl = document.getElementById('calendar');
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek',
                // plugins: [ interactionPlugin ],
                // initialView: 'dayGridWeek',
                height: '72vh',
                locale: 'itLocale',
                firstDay: 1,
                selectable: true,
                @can('Modifica Appuntamento')
                    editable: true,
                @endcan
                eventDurationEditable: false,
                droppable: true,
                eventClick: function (info) {

                    appointmentId = info.event.id;

                    document.getElementById('deleteAppointment').setAttribute('action', window.location.href + '/' + appointmentId);

                    document.getElementById('eventTitle').value = info.event.title;

                    document.getElementById('eventDateFrom').valueAsDate = info.event.start;
                    document.getElementById('eventTimeFrom').value = addZero(info.event.start.getHours()).toString() + ':' + addZero(info.event.start.getMinutes()).toString();

                    document.getElementById('eventDateTo').valueAsDate = info.event.end;
                    document.getElementById('eventTimeTo').value = addZero(info.event.end.getHours()).toString() + ':' + addZero(info.event.end.getMinutes()).toString();

                    appointmentModal.show();
                },
                dateClick: function (info) {

                    @can('Crea Appuntamento')
                        let dateSelect = new Date(info.dateStr);
                        document.getElementById('dateFrom').valueAsDate = dateSelect;
                        document.getElementById('timeFrom').value = addZero(dateSelect.getHours()).toString() + ':' + addZero(dateSelect.getMinutes()).toString();

                        document.getElementById('dateTo').valueAsDate = dateSelect;
                        document.getElementById('timeTo').value = addZero(dateSelect.getHours() + 1).toString() + ':' + addZero(dateSelect.getMinutes()).toString();
                        modal.show();
                    @endcan

                },
                eventDrop: function(info) {

                    appointmentId = info.event.id;

                    document.getElementById('editAppointment').setAttribute('action', window.location.href + '/' + appointmentId);

                    document.getElementById('eventEditTitle').value = info.event.title;

                    document.getElementById('eventEditDateFrom').valueAsDate = info.event.start;
                    document.getElementById('eventEditTimeFrom').value = addZero(info.event.start.getHours()).toString() + ':' + addZero(info.event.start.getMinutes()).toString();

                    document.getElementById('eventEditDateTo').valueAsDate = info.event.end;
                    document.getElementById('eventEditTimeTo').value = addZero(info.event.end.getHours()).toString() + ':' + addZero(info.event.end.getMinutes()).toString();

                    appointmentEditModal.show();

                },
                buttonText: {
                    today: 'oggi',
                    month: 'mese',
                    week: 'settimana',
                    day: 'giorno',
                    list: 'lista'
                },
                allDayText: 'Intero giorno',
                headerToolbar: {
                    start: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                    center: 'title',
                    end: 'today prev,next'
                },
                slotMinTime: '08:00:00',
                slotMaxTime: '19:00:00',
                displayEventTime: false,
                eventDisplay: 'block',
                nowIndicator: true,
                events: function (fetchInfo, successCallback, failureCallback) {
                    successCallback(event)
                },

            });

            calendar.render();

        });
    </script>
@endsection

<x-app-layout>


    <div x-data="{deleteButton: false}"
         x-init="new Hammer($el).on('swiperight', function(ev) {deleteButton = true})"
    >

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div id="calendar" class="bg-white mt-3 p-2"></div>
            </div>
        </div>

        @can('Crea Appuntamento')
            <div id="addAppointmentModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <form action="{{route('appointments.store')}}" method="post">
                        @method('POST')
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Nuovo Appuntamento
                            </h3>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <div class="flex">
                                <div class="flex flex-col items-end justify-center">
                                    <div class="flex items-center">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Inizio</p>
                                        <input type="date" name="dateFrom" id="dateFrom" class="mx-2 w-36 rounded bg-gray-50 text-gray-900 focus:ring-blue-500 block text-sm p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
                                        <input type="time" name="timeFrom" id="timeFrom" class="w-20 rounded bg-gray-50 text-gray-900 focus:ring-blue-500 block text-sm p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                    <div class="flex items-center mt-2">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Fine</p>
                                        <input type="date" name="dateTo" id="dateTo" class="mx-2 w-36 rounded bg-gray-50 text-gray-900 focus:ring-blue-500 block text-sm p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
                                        <input type="time" name="timeTo" id="timeTo" class="w-20 rounded bg-gray-50 text-gray-900 focus:ring-blue-500 block text-sm p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white">
                                    </div>
                                </div>
                                <div class="ml-2 flex items-center">
                                    <textarea class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                              placeholder="Descrizione..." name="title"
                                              rows="5" cols="50" maxlength="250"
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                            <button type="submit" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Crea</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endcan

        <div id="appointmentModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <form id="deleteAppointment" method="post">
                    @method('DELETE')
                    @csrf
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Visualizza Appuntamento
                            </h3>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <div class="flex">
                                <div class="flex flex-col items-end justify-center">
                                    <div class="flex items-center">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Inizio</p>
                                        <input type="date" name="dateFrom" id="eventDateFrom"
                                               class="mx-2 w-36 rounded bg-gray-50 text-gray-900 focus:ring-blue-500 block text-sm p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"
                                               disabled
                                        >
                                        <input type="time" name="timeFrom" id="eventTimeFrom"
                                               class="w-20 rounded bg-gray-50 text-gray-900 focus:ring-blue-500 block text-sm p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"
                                               disabled
                                        >
                                    </div>
                                    <div class="flex items-center mt-2">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Fine</p>
                                        <input type="date" name="dateTo" id="eventDateTo"
                                               class="mx-2 w-36 rounded bg-gray-50 text-gray-900 focus:ring-blue-500 block text-sm p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"
                                               disabled
                                        >
                                        <input type="time" name="timeTo" id="eventTimeTo"
                                               class="w-20 rounded bg-gray-50 text-gray-900 focus:ring-blue-500 block text-sm p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"
                                               disabled
                                        >
                                    </div>
                                </div>
                                <div class="ml-2 flex items-center">
                                    <textarea class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                              placeholder="Descrizione..." name="title"
                                              rows="5" cols="50" maxlength="250" id="eventTitle"
                                              disabled
                                    ></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        @can('Elimina Appuntamento')
                            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button x-show="deleteButton" type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Elimina</button>
                                <div x-show="!deleteButton" class="flex items-center">
                                    <div class="text-white">Swipe to delete</div>
                                    <button @swiperight class="ml-2 text-md text-white">
                                        <i class="fa-solid fa-angles-right fa-beat-fade"></i>
                                    </button>
                                </div>
                            </div>
                        @endcan
                    </div>
                </form>
            </div>
        </div>

        <div id="editAppointmentModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full">
                <form id="editAppointment" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                Conferma Modifica Appuntamento
                            </h3>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6 space-y-6">
                            <div class="flex">
                                <div class="flex flex-col items-end justify-center">
                                    <div class="flex items-center">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Inizio</p>
                                        <input type="date" name="dateFrom" id="eventEditDateFrom"
                                               class="mx-2 w-36 rounded bg-gray-50 text-gray-900 focus:ring-blue-500 block text-sm p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"

                                        >
                                        <input type="time" name="timeFrom" id="eventEditTimeFrom"
                                               class="w-20 rounded bg-gray-50 text-gray-900 focus:ring-blue-500 block text-sm p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"

                                        >
                                    </div>
                                    <div class="flex items-center mt-2">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white">Fine</p>
                                        <input type="date" name="dateTo" id="eventEditDateTo"
                                               class="mx-2 w-36 rounded bg-gray-50 text-gray-900 focus:ring-blue-500 block text-sm p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"

                                        >
                                        <input type="time" name="timeTo" id="eventEditTimeTo"
                                               class="w-20 rounded bg-gray-50 text-gray-900 focus:ring-blue-500 block text-sm p-2.5 dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white"

                                        >
                                    </div>
                                </div>
                                <div class="ml-2 flex items-center">
                                    <textarea class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                              placeholder="Descrizione..." name="title"
                                              rows="5" cols="50" maxlength="250" id="eventEditTitle"

                                    ></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- Modal footer -->
                        @can('Modifica Appuntamento')
                            <div class="flex items-center p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="submit" class="text-white bg-yellow-700 hover:bg-yellow-800 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800">Modifica</button>
                            </div>
                        @endcan
                    </div>
                </form>
            </div>
        </div>

    </div>

</x-app-layout>

