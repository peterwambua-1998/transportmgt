@extends('layouts.app')
@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap4.min.css">
<style>
    

    
</style>
@endsection
@section('content')
<h3 class="text-center" style="text-decoration: underline">INVOICES SUMMARY</h3>


<div class="page-wrapper">
    <div class="card">
        <div class="page-w card-header p-1 m-0" >
            <form action="">
                <div class="form-row p-0 m-0">
                <div class="form-group col-md-5 m-0">
                    <label for="">from</label>
                    <input type="date" class="form-control" name="from" id="from" >
                    <p style="color: red" class="from-warning"></p>
                </div>
                <div  class="form-group col-md-5 m-0">
                    <label for="">to</label>
                    <input type="date" class="form-control" name="from" id="to">
                    <p style="color: red" class="to-warning"></p>
                </div>
                <div class="form-group col-md-2 m-0">
                    <label for="" style="visibility: hidden">cl</label><br>
                    <button type="button" class="btn get-data" style="background: #0071f3" >Filter</button>
                </div>
                </div>
            </form>
        </div>
    </div>
    

    
</div>

<div bgcolor="#f6f6f6" style="color: #333; height: 100%; width: 100%;" height="100%" width="100%">
    <table bgcolor="#f6f6f6" cellspacing="0" style="border-collapse: collapse; padding: 40px; width: 100%;" width="100%">
        <tbody>
            <tr>
                <td width="5px" style="padding: 0;"></td>
                <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                    <table width="100%" cellspacing="0" style="border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td style="padding: 0;">
                                    <a
                                        href="#"
                                        style="color: #348eda;"
                                        target="_blank"
                                    >
                                        <img
                                            src="//ssl.gstatic.com/accounts/ui/logo_2x.png"
                                            alt="Bootdey.com"
                                            style="height: 50px; max-width: 100%; width: 157px;"
                                            height="50"
                                            width="157"
                                        />
                                    </a>
                                </td>
                                <td style="color: #999; font-size: 12px; padding: 0; text-align: right;" align="right">
                                    
                                    {{ date('F') }} <span id="date"></span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="5px" style="padding: 0;"></td>
            </tr>

            <tr>
                <td width="5px" style="padding: 0;"></td>
                <td bgcolor="#FFFFFF" style="border: 1px solid #000; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                    <table width="100%" style="background: #f9f9f9; border-bottom: 1px solid #eee; border-collapse: collapse; color: #999;">
                        <tbody>
                            <tr>
                                <td width="50%" style="padding: 20px;"><strong style="color: #333; font-size: 24px;" id="paid-top"></strong> Paid</td>
                                
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="padding: 0;"></td>
                <td width="5px" style="padding: 0;"></td>
            </tr>
            <tr>
                <td width="5px" style="padding: 0;"></td>
                <td style="border: 1px solid #000; border-top: 0; clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 0;">
                    <table cellspacing="0" style="border-collapse: collapse; border-left: 1px solid #000; margin: 0 auto; max-width: 600px;">
                        <tbody>
                            <tr>
                                <td valign="top"  style="padding: 20px;">
                                    <h3
                                        style="
                                            border-bottom: 1px solid #000;
                                            color: #000;
                                            font-family: 'Helvetica Neue', Helvetica, Arial, 'Lucida Grande', sans-serif;
                                            font-size: 18px;
                                            font-weight: bold;
                                            line-height: 1.2;
                                            margin: 0;
                                            margin-bottom: 15px;
                                            padding-bottom: 5px;
                                        "
                                    >
                                        Summary
                                    </h3>
                                    <table cellspacing="0" style="border-collapse: collapse; margin-bottom: 40px;">
                                        <tbody class="my-tbody">
                                            <tr>
                                                <td style="padding: 5px 0;">Total Invoices Paid</td>
                                                <td align="right" style="padding: 5px 0;" id="total-invoice-paid"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 5px 0;">Total Invoices UnPaid</td>
                                                <td align="right" style="padding: 5px 0;" id="total-invoice-unpaid"></td>
                                            </tr>
                                            <tr>
                                                <td style="padding-top: 5px; padding-bottom: 5px; padding-right: 200px">No Of Invoices</td>
                                                <td align="right" style="padding: 5px 0;" id="num-of-invoices"></td>
                                            </tr>
                                            <tr>
                                                <td style="border-bottom: 2px solid #000; border-top: 2px solid #000; font-weight: bold; padding: 5px 0;">Amount paid</td>
                                                <td align="right" style="border-bottom: 2px solid #000; border-top: 2px solid #000; font-weight: bold; padding: 5px 0;" id="amt-paid"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="5px" style="padding: 0;"></td>
            </tr>

            {{---
            <tr style="color: #666; font-size: 12px;">
                <td width="5px" style="padding: 10px 0;"></td>
                <td style="clear: both; display: block; margin: 0 auto; max-width: 600px; padding: 10px 0;">
                    <table width="100%" cellspacing="0" style="border-collapse: collapse;">
                        <tbody>
                            <tr>
                                <td width="40%" valign="top" style="padding: 10px 0;">
                                    <h4 style="margin: 0;">Questions?</h4>
                                    <p style="color: #666; font-size: 12px; font-weight: normal; margin-bottom: 10px;">
                                        Please visit our
                                        <a
                                            href="#"
                                            style="color: #666;"
                                            target="_blank"
                                        >
                                            Support Center
                                        </a>
                                        with any questions.
                                    </p>
                                </td>
                                <td width="10%" style="padding: 10px 0;">&nbsp;</td>
                                <td width="40%" valign="top" style="padding: 10px 0;">
                                    <h4 style="margin: 0;"><span class="il">Bootdey</span> Technologies</h4>
                                    <p style="color: #666; font-size: 12px; font-weight: normal; margin-bottom: 10px;">
                                        <a href="#">535 Mission St., 14th Floor San Francisco, CA 94105</a>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="5px" style="padding: 10px 0;"></td>
            </tr>
            ---}}
        </tbody>
    </table>
</div>

<div class="overlay">
    <div class="spinner-border" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
@endsection


@section('js')

    <script defer src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer>
        $(document).ready( function () {
            $.ajax({
                type: "GET",
                url: "{{ route('financialdata') }}",
                processData: false,
                contentType: false,
                cache: false,
               
                error: function (err) {
                    console.log(err)
                },
                success: function (response) {
                 console.log(response)
                    $('#paid-top').text('KSH ' + response[0]);
                    $('#total-invoice-paid').text('KSH ' + response[0]);
                    $('#total-invoice-unpaid').text('KSH ' + response[1]);
                    $('#num-of-invoices').text(response[4]);
                    $('#amt-paid').text('KSH ' + response[0]);
                    $('#date').text(response[3]);
                }   
            });

            function getData() {
                var from = $('#from').val();
                var to = $('#to').val();

                

                
                if (! from) {
                    $('.from-warning').text('please eneter date');
                    return;
                }

                if (! to) {
                    $('.to-warning').text('please eneter date');
                    return;
                }

                if (! from && ! to) {
                    $('.from-warning').text('please eneter date');
                    return;
                }

                var data = new FormData;
                data.append('_token', '{{ csrf_token() }}');
                data.append('from', from);
                data.append('to', to);

                $.ajax({
                    type: "POST",
                    url: "{{ route('financialquery') }}",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: data,
                    error: function (err) {
                        console.log(err)
                    },
                    success: function (response) {
                        console.log(response);
                        $('#paid-top').text('KSH ' + response[0]);
                        $('#total-invoice-paid').text('KSH ' + response[0]);
                        $('#total-invoice-unpaid').text('KSH ' + response[1]);
                        $('#num-of-invoices').text(response[3]);
                        $('#amt-paid').text('KSH ' + response[0]);
                        
                    }
                });
                
            }

            $('.get-data').on('click', getData);
            /*
            $('#vehTable').DataTable({
                searching: false
            });


            


            function getData() {
                var from = $('#from').val();
                var to = $('#to').val();

                

                
                if (! from) {
                    $('.from-warning').text('please eneter date');
                    return;
                }

                if (! to) {
                    $('.to-warning').text('please eneter date');
                    return;
                }

                if (! from && ! to) {
                    $('.from-warning').text('please eneter date');
                    return;
                }

                var data = new FormData;
                data.append('_token', '{{ csrf_token() }}');
                data.append('from', from);
                data.append('to', to);

                $.ajax({
                    type: "POST",
                    url: "{{ route('invoice_search') }}",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: data,
                    error: function (err) {
                        console.log(err)
                    },
                    success: function (response) {
                        console.log(response);
                        $('tbody').html(response);

                    }
                });
                
            }

            $('.get-data').on('click', getData);


            if("{{ Session::has('success') }}") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ Session::get("success") }}',
                    showConfirmButton: false,
                    timer: 1500
                })
               
            } else if ("{{ Session::has('unsuccess') }}") {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ Session::get("unsuccess") }}',
                    showConfirmButton: false,
                    timer: 1500
                })
            }
        } );


        $('#genInv').on('click', function() {

            
           

            var data = new FormData;
            data.append('_token','{{csrf_token()}}');

            Swal.fire({
                title: 'Are you sure?',
                text: "Ensure its a new month before genrating invoices to avoid duplicates",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Generate',
                cancelButtonText: 'Cancel',
                

            }).then((result) => {

                if (result.isConfirmed) {
                    $("body").addClass("loading");
                    $.ajax({
                        type: "POST",
                        url: "{{route('invoice_store')}}",
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: data,
                        
                        error: function(data){
                            console.log(data);
                        },
                        success: function (message) {
                            $("body").removeClass("loading"); 
                            location.reload();
                        }
                    });
               
                } 
            });
            */
        });

        

    </script>
@endsection