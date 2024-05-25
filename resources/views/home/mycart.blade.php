<!DOCTYPE html>
<html>

<head>
    @include('home.css')

    <style>
        .div_des
        {
            display:flex;
            justify-content:center;
            align-items:center;
            margin:60px;
        }

        table
        {
            border: 2px solid black;
            text-align:center;
            width: 800px;
        }
        th
        {
            border: 2px solid black;
            text-align:center;
            color:white;
            font: 20px;
            font-weight: bold;
            background-color:black;
        }
        td
        {
            border: 1px solid skyblue;
        }
        .cart_value
        {
            text-align:center;
            margin-bottom:70px;
            padding: 18px;
        }
    </style>
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    
    @include('home.header')
    <!-- end header section -->
    
  </div>
 

    <div class="div_des"> 

        <table>
            <tr>
                <th>Product Title</th>

                <th>Price</th>

                <th>Image</th>

                <th>Remove</th>
            </tr>

            @php
                $value = 0;
            @endphp

            @foreach($cart as $cart)

            <tr>
                <td>{{$cart->product->title}} </td>
                <td>{{$cart->product->price}} </td>
                <td>
                    <img height="50px" src="/products/{{$cart->product->image}}" alt=""> 
                </td>
                <td>
                    <a class="btn btn-danger" href="">Remove</a>
                </td>
            </tr>

            @php
                $value = $value + $cart->product->price;
            @endphp

            @endforeach
        </table>
    </div>

    <div class="cart_value">
        <h3>Total; Value of cart is: Ksh. {{$value}}</h3>
    </div>
   

  <!-- info section -->

  @include('home.footer')

</body>

</html>