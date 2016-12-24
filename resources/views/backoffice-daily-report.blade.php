@include('partials.header')
<div class="container content-center">
    <h1 class="col-md-4 col-md-offset-4">
        ระบบร้านหลังบ้าน
    </h1>
    
    @foreach ($totalDep as $key => $td)
        <h1 class="col-md-4 col-md-offset-4">
            <span class="label label-{{ $labelColor[$key] ?? $labelColor[0]}}">{{ $td->department->department_name }}</span> 
            :  {{ number_format($td->sum_sell) }} บาท
        </h1>
    @endforeach
    
    <h1 class="col-md-4 col-md-offset-4">
        <span class="label label-danger">รวม</span> : {{ number_format($totalToday) }} บาท
    </h1>
    
    @foreach ($totalSale as $key => $ts)
        <h1 class="col-md-4 col-md-offset-4">
            <h1 class="col-md-12">
                <span class="label label-primary">{{ $ts->sales->name }}</span>
                ยอด <span class="label label-success">{{ number_format($ts->count_sell) }}</span> ครั้ง 
                รวม <span class="label label-danger">{{ number_format($ts->sum_sell) }}</span> บาท
            </h1> 
        </h1>
        
        <table class="table table-striped">
        <thead>
          <tr>
            <th>แผนก</th>
            <th>ยอดครั้ง</th>
            <th>ยอดบาท</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($totalDetail[$ts->sales_id] as $td)
            <tr>
              <th>{{ $td->department->department_name }}</th>
              <th>{{ number_format($td->count_sell) }}</th>
              <th>{{ number_format($td->sum_sell) }}</th>
            </tr>
            @endforeach
        </tbody>
        </table>
    @endforeach
</div>

@include('partials.footer')