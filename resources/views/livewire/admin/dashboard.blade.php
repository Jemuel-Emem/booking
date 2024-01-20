<div>
   <div class="flex-col text-center">
    <div class="flex gap-4">
        <div class=" w-60 bg-green-700 text-white p-2 h-32 rounded" >Cottage</div>
        <div class=" w-60 bg-green-700 text-white p-2 h-32 rounded">Booking List
            <div class="text-center text-yellow-300 font-bold text-4xl mt-2">
                <span>{{ $totalbookingList }}</span>
            </div>
        </div>
        <div class=" w-60 bg-green-700 text-white p-2 h-32 rounded">Reserved List

         <div class="text-center text-yellow-300 font-bold text-4xl mt-2">
             <span>{{ $totalReservationList }}</span>
         </div>
        </div>
     </div>
     <div class="flex mt-4">
         <div class=" w-60 bg-green-700 text-white p-2 h-32 rounded" >Cancelled List
            <div class="text-center text-yellow-300 font-bold text-4xl mt-2">
                <span>{{ $totalcancelledList }}</span>
            </div>
         </div>
      </div>
   </div>
</div>
