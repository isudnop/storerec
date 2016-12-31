@include('partials.header')
<div class="container content-center">
        <form action="/record-amount" method="post">
            <div class="row form-block top-buffer">
                    @if (!empty($success))
                        <div class="row col-md-4 col-md-offset-4 alert alert-success" role="alert">
                            <strong>บันทึกเสร็จสิ้น!</strong> 
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="row col-md-4 col-md-offset-4 alert alert-danger">
                            <strong>กรอกข้อมูลผิดพลาด!</strong> 
                        </div>
                    @endif
                    <div class="row  top-buffer fill-row">
                        <h1><span class="label label-danger">รหัสแผนก</span> : <input type="tel" placeholder=  "รหัส" name="department_id" value="" autofocus="autofocus" required></h1>
                    </div>
                    <div class="row top-buffer fill-row ">
                        <h1><span class="label label-success">ยอดสินค้า</span> : <input type="tel" placeholder="บาท" id="amount" name="sell_amount" value="" required></h1>
                    </div>
                    <div class="row top-buffer fill-row">
                        <h1><span class="label label-info">รหัสผู้ขาย</span> : <input type="tel" placeholder="รหัส" name="sales_id" value="" required></h1>
                    </div>
                    <!--
                    Calculator section (in progress)
                    -->
                <div class="top-buffer">
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