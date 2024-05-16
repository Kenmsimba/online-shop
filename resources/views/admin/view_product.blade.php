<!DOCTYPE html>
<html>
  <head>
   @include('admin.css') 

   <style>

    .div_des
    {
        display:flex;
        justify-content: center;
        align-items: center;
        margin-top: 60px;

    }
    .table_des
    {
        border: 2px solid greenyellow;

    }
    th
    {
        background-color: skyblue;
        color: white;
        font-size: 19px;
        font-weight: bold;
        padding: 15px;
    }
    td{
        border: 1px solid skyblue;
        text-align: center;
        color: white;
    }
   </style>
</head>
  <body>
    @include('admin.header')
    <div class="d-flex align-items-stretch">
      <!-- Sidebar Navigation-->
        @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        <div class="page-header">
          <div class="container-fluid">
            

            <div class="div_des">

                <table class="table_des">

                    <tr>

                        <th>Product Title</th>

                        <th>Description</th>

                        <th>Category</th>

                        <th>Price</th>

                        <th>Quantity</th>

                        <th>Image</th>

                    </tr>

                    @foreach($products as $product)

                    <tr>

                        <td>{{$product->title}} </td>

                        {{-- display 5 characters only for each description incase of long descriptions  --}}
                        <td>{!!Str::limit($product->description,50)!!}</td>

                        {{-- display words instead of characters
                        <td>{!!Str::words($product->description,5)!!}</td> --}}
                        
                        <td>{{$product->category}} </td>

                        <td>{{$product->price}} </td>

                        <td>{{$product->quantity}} </td>

                        <td>
                            <img height="120px" width="120px" src="products/{{$product->image}}" alt="">

                        </td>

                    </tr>

                    @endforeach

                </table>

                {{-- pagination  --}}               

            </div>
            <div class="div_des">
                {{$products->onEachSide(1)->links()}}   <!--avoid displaying each page incase the db has too many products-->
            </div>

            

          </div>
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="{{asset('admincss/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/popper.js/umd/popper.min.js')}}"> </script>
    <script src="{{asset('admincss/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery.cookie/jquery.cookie.js')}}"> </script>
    <script src="{{asset('admincss/vendor/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admincss/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{asset('admincss/js/charts-home.js')}}"></script>
    <script src="{{asset('admincss/js/front.js')}}"></script>
  </body>
</html>