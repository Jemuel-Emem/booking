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


   <div wire:ignore>
    <canvas id="myChart"></canvas>
  </div>

@assets
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endassets

@script
<script>
  const ctx = document.getElementById('myChart');
  const sub = $wire.sub;
 const Lables = sub.map(item=>item.Day);
 const values = sub.map(item=>item.Value);
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: Lables,
      datasets: [{
        label: 'Daily Income',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        borderColor: 'rgba(75, 192, 192, 1)',
        data:values,
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>
@endscript
 </div>
