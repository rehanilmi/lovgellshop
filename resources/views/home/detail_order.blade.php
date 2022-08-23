@include('home.css')
@include('home.header')

    <section class="ftco-section ftco-cart">
            <div class="container">
                <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list">
                        <table class="table">
                            <thead class="thead-primary">
                            <tr class="text-center">
                              <th> Nama</th>
                              <th> Email</th>
                              <th> Alamat</th>
                                <th> Gambar</th>
                                <th> Nama Produk</th>
                                <th> Jumlah</th>
                                <th> Harga</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($order as $user => $order)


                                <td>{{ $order->user->name }}</td>
                                <td>{{ $order->user->email }}</td>
                                <td>{{ $order->user->address }}</td>
                                <td>
                                  <img height="100" width="180" src="/product/{{ $order->image }}">
                                </td>
                                <td>{{ $order->product_title }} </td>
                                <td>{{ $order->quantity }} </td>
                                <td> Rp.{{ number_format ($order->price) }} </td>


                            </tr><!-- END TR-->
                            @endforeach
                            <tr class="text-center">
                                <td class=""><a href="#"></a></td>
                                <td class="product-name"></td>
                                <td class="quantity">
                                    <div class="input-group mb-3"></div>
                            </td>
                            </tr><!-- END TR-->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </section>

        <section class="ftco-section ftco-no-pt ftco-no-pb py-5 bg-light">
    <div class="container py-4">
        <div class="row d-flex justify-content-center py-5">
        <div class="col-md-6">
            <h2 style="font-size: 22px;" class="mb-0">Subcribe to our Newsletter</h2>
            <span>Get e-mail updates about our latest shops and special offers</span>
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <form action="#" class="subscribe-form">
            <div class="form-group d-flex">
                <input type="text" class="form-control" placeholder="Enter email address">
                <input type="submit" value="Subscribe" class="submit px-3">
            </div>
            </form>
        </div>
        </div>
    </div>
    </section>

@include('home.footer')
@include('home.script')
