@include('partials.header')
<div class="container content-center">
    <h1 class="col-md-4 col-md-offset-4">
        ระบบร้านหลังบ้าน
    </h1>
    <h1 class="col-md-4 col-md-offset-4">
        <span class="label label-primary">สำอางค์</span> : 60000 บาท
    </h1>
    <h1 class="col-md-4 col-md-offset-4">
        <span class="label label-success">ตกปลา</span> : 20000 บาท
    </h1>
    <h1 class="col-md-4 col-md-offset-4">
        <span class="label label-info">เตล็ด</span> : 20000 บาท
    </h1>
    <h1 class="col-md-4 col-md-offset-4">
        <span class="label label-danger">รวม</span> : 100000 บาท
    </h1>
    
    <h1 class="col-md-12">ศรี ยอด 500 ครั้ง รวม 30000 บาท</h1>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>แผนก</th>
        <th>ยอดครั้ง</th>
        <th>ยอดบาท</th>
      </tr>
      <tr>
        <th>สำอางค์</th>
        <th>500</th>
        <th>2500</th>
      </tr>
      <tr>
        <th>ตกปลา</th>
        <th>12</th>
        <th>500</th>
      </tr>
      <tr>
        <th>เตล็ด</th>
        <th>71</th>
        <th>21</th>
      </tr>
    </thead>
    <tbody>
        
    </tbody>
    </table>
    
    
    <h1 class="col-md-12">ดา ยอด 100 ครั้ง รวม 8000 บาท</h1>
    <table class="table table-striped">
    <thead>
      <tr>
        <th>แผนก</th>
        <th>ยอดครั้ง</th>
        <th>ยอดบาท</th>
      </tr>
      <tr>
        <th>สำอางค์</th>
        <th>500</th>
        <th>2500</th>
      </tr>
      <tr>
        <th>ตกปลา</th>
        <th>12</th>
        <th>500</th>
      </tr>
      <tr>
        <th>เตล็ด</th>
        <th>71</th>
        <th>21</th>
      </tr>
    </thead>
    <tbody>
        
    </tbody>
    </table>
    
    <!--<table class="table table-striped">
    <thead>
      <tr>
        <th>เวลา</th>
        <th>ยอดขาย</th>
        <th>ผู้ขาย</th>
        <th>แผนก</th>
      </tr>
    </thead>
    <tbody>
        @for ($i = 0; $i < 5; $i++)
        <tr>
            <td>2016-05-05 13.00.00 </td>
            <td>{{ rand() }}</td>
            <td>Doe</td>
            <td>john@example.com</td>
            
        </tr>
        @endfor
    </tbody>
</table>-->
</div>

@include('partials.footer')