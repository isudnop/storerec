@include('partials.header')
<div class="container content-center">
    <h1 class="col-md-4 col-md-offset-4">ระบบร้าน</h1>
        <form action="/record-amount" method="post">
            <div class="row col-md-4 col-md-offset-4 top-buffer">
                    @if(isset($success))
                        <div class="alert alert-success" role="alert">
                            <strong>บันทึกเสร็จสิ้น!</strong> 
                        </div>
                    @endif    
                    <div class=" col-md-4 col-md-offset-4 top-buffer fill-row">
                        <span class="label label-danger">รหัสแผนก</span> : <input type="text" placeholder=  "รหัส" name="department_id" value="" required>
                    </div>
                    <div class="col-md-4 col-md-offset-4 top-buffer fill-row ">
                        <span class="label label-success">ยอดสินค้า</span> : <input type="text" placeholder="0 บาท" id="amount" name="sell_amount" value="" required>
                    </div>
                    <div class="col-md-4 col-md-offset-4 top-buffer fill-row">
                        <span class="label label-info">รหัสผู้ขาย</span> : <input type="text" placeholder="รหัส" name="sales_id" value="" required>
                    </div>

                <div class="col-md-4 col-md-offset-4 top-buffer">
                    <button type="submit" class="btn btn-lg btn-primary" value="submit">บันทึก!</button>
                </div>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form> 
        <table class="table table-striped">
        <thead>
          <tr>
            <th>เวลา</th>
            <th>ยอดสินค้า</th>
            <th>ผู้ขาย</th>
            <th>แผนก</th>
          </tr>
        </thead>
        <tbody>
            @if (isset($latest_record))
                @foreach ($latest_record as $lr)
                <tr>
                    <td>{{ $lr->created_at}}</td>
                    <td>{{ $lr->sell_amount}}</td>
                    <td>{{ $lr->sales->name }}</td>
                    <td>{{ $lr->department->department_name}}</td>
                </tr>
                @endforeach
            @endif
        </tbody>
        </table>
</div>
@include('partials.footer')