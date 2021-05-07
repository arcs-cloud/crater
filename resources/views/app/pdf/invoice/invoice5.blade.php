<!DOCTYPE html>
<html>

    <head>
        <title>Invoice</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	
<style type="text/css">

            body {
		font-family: Arial, Helvetica, sans-serif;		
		font-size: 11px;
		line-height: 1.5;
	    }

	    h1 {
		font-size: 30px;
		font-weight: 400;
		margin-top: 0;
		margin-bottom: 12px;
		color: #333 !important;
	    }

	    h2 {
		font-size: 16px;
		margin-top: 0;
		margin-bottom: 15px;
		color: #333 !important;
		text-transform: uppercase;
	    }

	    h3 {
		font-weight: 400;
		font-size: 11px;
		color: #333 !important;
		margin-top: 0;
		margin-bottom: 0;
		text-transform: uppercase;
	    }

	    a {
		color: #a8a8a8;
		text-decoration: none;
		display: block;
	    }

            html {
                margin: 0px;
                padding: 0px;
            }

            table {
                border-collapse: collapse;
	    }

	    td,
	    th {
		text-align: left;
		padding: 15px 0;
		font-weight: 400;
	    }

	    th {
		font-weight: 400;
		color: #a8a8a8;
		font-size: 11px;
		text-transform: uppercase;
		padding: 0;
	    }

	    table tr th:last-child,
	    table tr td:last-child {
		text-align: right;
	    }

	    p {
		margin: 0;
		padding: 0;
	    }

            .top-container {
                background-color: #fcfcfc;
		padding: 80px 80px -40px 80px;
		color: #a8a8a8;
            }

            .bottom-container {
                padding: 80px;
            }

            .company-container,
            .invoice-container {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
	    }

	    .invoice-container h2 {
		margin-top: 18px;
	    }

	    .company-container { 
		margin-bottom: -100px;
	    }

	    .invoice-container {
		margin-bottom: -70px;
	    }

            .company-container .logo img {
                width: 150px;
		height: 150px;
		object-fit: contain;
	    }

            .company-container .company-info {
                text-align: right;
            }

            .invoice-container .invoice-info {
                text-align: right;
	    }

	    .invoice-info p {
		margin-bottom: 20px;
	    }

	    .total-display-container {
                width: 50%;
		margin: 40px 0 40px auto;
	    }

	    .billing-info {
		font-size: 13px;
	    }

	    table td {
		border-bottom: 2px solid #f0f0f0;
	    }

	    hr {
		display: none;
	    }

	    .total-display-container tr:last-child td {
		border-bottom: none;
	    }

	    .final-total {
		color: #f8ba3b;
		font-size: 18px;
		font-weight: bold;
	    }

	    .final-label {
		text-transform: uppercase;
	    }

	    .total-display-container .fade {
		color: #a8a8a8;
	    }

	    .total-display-container td:first-child {
		text-transform: uppercase;
	    }

	    .bank-info {
		text-align: right;
	    }

	    .bank-info p {
		margin-bottom: 10px;
		color: #a8a8a8;
		text-align: right;
	    }

	    .bank-info span {
		font-weight: bold;
		color: #333;
	    }

	</style>
    </head>

    <body>
        <div class="top-container">
            <div class="company-container">
                <div class="logo">
                    @if($logo)
                        <img class="header-logo" src="{{ $logo }}" alt="Company Logo">
                    @else
                        <h1 class="header-logo"> {{$invoice->user->company->name}} </h1>
                    @endif
                </div>

                <div class="company-info">
		    {!! $company_address !!}
		    <br/>
		    <a href="mailto:larsvanduijkeren@gmail.com">larsvanduijkeren@gmail.com</a>
		    <a href="tel:+316 465 71 385">+316 465 71 385</a>
                </div>
            </div>

            <div class="invoice-container">
                <div class="billing-info">
                    <h2>Ontvanger</h2>
                    @if($billing_address)
                        {!! $billing_address !!}
                    @endif
                </div>

                <div class="invoice-info">
                    <h1>Factuur</h1>
                    
                    <h3>Factuurnummer</h3>
                    <p>{{$invoice->invoice_number}}</p>

                    <h3>Factuurdatum</h3>
                    <p>{{$invoice->formattedInvoiceDate}}</p>
                </div>
            </div>
        </div>

        <div class="bottom-container">
            @include('app.pdf.invoice.partials.table')

	    <div class="bank-info">
		<p>
                    Gelieve het totaalbedrag over te schrijven naar <span>NL33INGB0008999668</span>, onder vermelding van het factuurnummer.
		</p>
	    </div>
	    <div class="notes">
                @if($notes)
                    <div class='note'>
                        <div class="notes-label">
                            @lang('pdf_notes')
                        </div>
                        {!! $notes !!}
                    </div>
                    @if($invoice->bunq_me_link !== "")
                        <div class='qr'>
                            <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($invoice->bunq_me_link)) !!} ">
                        </div>
                        <div class='qrnote'>
                            If you're unable to scan the QR code, you can follow <a href="{{ $invoice->bunq_me_link }}">this link</a> to proceed with the payment.
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </body>

</html>
