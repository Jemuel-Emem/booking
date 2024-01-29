<div>
    <div class="flex gap-2 mt-2">
        <x-input label="" placeholder="Search..." wire:model="search" />
    <div>
        <x-button  label="Search " wire:click.prevent="asss" class="bg-green-700 text-white hover:bg-green-900" />
    </div>
    </div>
    <div class="relative overflow-x-auto mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Reservation Code
                     </th>
                    <th scope="col" class="px-6 py-3">
                       Full Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Location
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cottage Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Payment
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Children
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Adults
                     </th>
                     <th scope="col" class="px-6 py-3">
                        Check In
                      </th>
                      <th scope="col" class="px-6 py-3">
                        Check Out
                      </th>

                      <th scope="col" class="px-6 py-3">
                        Total Bill
                      </th>

                      <th scope="col" class="px-6 py-3">
                     POP
                      </th>

                      <th scope="col" class="px-6 py-3">
                      ID
                         </th>

                    <th scope="col" class="px-6 py-3 text-center">
                     Action
                      </th>

                </tr>
            </thead>
            <tbody>
                @foreach($reserv as $reservation)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $reservation->reservationid }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $reservation->fullname }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->location }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->number }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->cottagenumber }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->paymenttype }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->children }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->adults }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->checkin }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->checkout }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->totalbill }}
                    </td>

                    <td class="px-6 py-4">
                        <img src="{{ asset(Storage::url($reservation->photopayment)) }}" alt="Proof of Payment" class="w-20 h-16 rounded">

                    </td>
                    <td class="px-6 py-4">

                        <img src="{{ asset(Storage::url($reservation->photoid)) }}" alt="Valid ID" class="w-20 h-16 rounded">

                    </td>

                    <td class="px-6 py-4">
                        <span class="flex flex-col gap-2">
                           <button class="bg-green-500 hover:bg-green-600 text-white p-1 rounded"  wire:click="confirm({{ $reservation->id }})">Confirmed</button>
                           <button class="bg-red-500 hover:bg-red-600 text-white p-1 rounded" wire:click="cancelthis">Cancell</button>
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <x-modal wire:model.defer="edit_modal">
        <x-card title="Confirm to delete">
            @foreach($reserv as $reservation)
            <p class="text-red-600 text-xl">
             Are you sure you want to cancell this reservation?
            </p>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Close" x-on:click="close" />
                    <x-button negative label="Cancel" wire:click="cancell({{ $reservation->id }})" />
                </div>
            </x-slot>
            @endforeach
        </x-card>
    </x-modal>
</div>
