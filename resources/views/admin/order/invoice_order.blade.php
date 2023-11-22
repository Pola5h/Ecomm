@extends('admin.master')
@section('admin')

{{-- <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script> --}}

<!-- Page header -->
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">
          Invoice
        </h2>
      </div>
      <!-- Page title actions -->
      <div class="col-auto ms-auto d-print-none">
        <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
          <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
          <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
          </svg>
          Print Invoice
        </button>
      </div>
    </div>
  </div>
</div>
<!-- Page body -->
<div class="page-body">
  <div class="container-xl">
    <div class="card card-lg">
      <div class="card-body">
        <div class="row">
          <div class="col-6">
            <p class="h3">Company</p>
            <address>
              Street Address<br>
              State, City<br>
              Region, Postal Code<br>
              ltd@example.com
            </address>
          </div>
          <div class="col-6 text-end">
            <p class="h3">Client</p>
            <address>
              {{ $billingInfo->name }}<br>
              {{ $billingInfo->phone }}<br>
              {{ $billingInfo->email }}<br>
              {{ $billingInfo->address }} </address>
          </div>
          <div class="col-12 my-5">
            <h1>Order ID #{{ $orderData->order_id }}</h1>
          </div>
        </div>
        <table class="table table-transparent table-responsive">
          <thead>
            <tr>
              <th class="text-center" style="width: 1%"></th>
              <th>Product</th>
              <th class="text-center" style="width: 1%">Qnt</th>
              <th class="text-end" style="width: 1%">Unit</th>
              <th class="text-end" style="width: 1%">Amount</th>
            </tr>
          </thead>
          @foreach ( $orderItem as $key=> $item )

          <tr>


            <td class="text-center">{{ $key+1 }}</td>
            <td>
              {{ App\Models\Product::where('id',$item->product_id)->value('name') }}
            </td>
            <td class="text-center">
              {{$item->qty}} </td>
            <td class="text-end">${{ $item->sub_total/$item->qty }}</td>
            <td class="text-end">${{ $item->sub_total }}</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="4" class="strong text-end">Total</td>
            <td class="text-end">${{ $orderData->total }}</td>
          </tr>

        </table>
        <p class="text-muted text-center mt-5">Thank you very much for doing business with us. We look forward to
          working with
          you again!</p>
      </div>
    </div>
  </div>
</div>

{{--
<script>
  document.addEventListener('DOMContentLoaded', function () {
        downloadPDF();
    });

    function downloadPDF() {
        // Select the element you want to convert to PDF
        const element = document.querySelector('.page-body');

        // Use html2pdf library to generate PDF
        html2pdf(element, {
            margin: 10,
            filename: 'downloaded-document.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 2 },
            jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
        }).then(function (pdf) {
            // Create a blob URL representing the PDF
            const blob = pdf.output('blob');
            const blobURL = URL.createObjectURL(blob);

            // Create a temporary link element
            const link = document.createElement('a');
            link.href = blobURL;
            link.download = 'downloaded-document.pdf';

            // Append the link to the document and trigger the click event
            document.body.appendChild(link);
            link.click();

            // Remove the link from the document
            document.body.removeChild(link);
        });
    }
</script> --}}
@endsection