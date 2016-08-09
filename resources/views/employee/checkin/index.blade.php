@extends('app')

@section('htmlheader_title')
    Next Inn - Checkin
@endsection
@section('contentheader_title')
    Realizar Checkin
@endsection

@section('meta_scripts')
    <style type="text/css">

        img{
            border:0;
        }
        #main{
            margin: 15px auto;
            background:white;
            overflow: auto;
            width: 100%;
        }

        #mainbody{
            background: white;
            width:100%;
            display:none;
        }

        #v{
            width:320px;
            height:240px;
        }
        #qr-canvas{
            display:none;
        }
        #qrfile{
            width:320px;
            height:240px;
        }
        #mp1{
            text-align:center;
            font-size:35px;
        }
        #imghelp{
            position:relative;
            left:0px;
            top:-160px;
            z-index:100;
            font:18px arial,sans-serif;
            background:#f0f0f0;
            margin-left:35px;
            margin-right:35px;
            padding-top:10px;
            padding-bottom:10px;
            border-radius:20px;
        }
        .selector{
            margin:0;
            padding:0;
            cursor:pointer;
            margin-bottom:-5px;
        }
        #outdiv
        {
            width:320px;
            height:240px;
            border: solid;
            border-width: 3px 3px 3px 3px;
        }
        #result{
            border: solid;
            border-width: 1px 1px 1px 1px;
            padding:20px;
            width:70%;
        }



        .tsel{
            padding:0;
        }

    </style>

    <script type="text/javascript" src="{{ asset('/js/llqrcode.js') }}"></script>
    <script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
    <script type="text/javascript" src="{{ asset('/js/webqr.js') }}"></script>

@endsection


@section('main-content')
    <div id="main">
        <div id="header">
            <p id="mp1">
                Escanear QR CODE
            </p>
        </div>
        <div id="mainbody">
            <table class="tsel" border="0" width="100%">
                <tr>
                    <td valign="top" align="center" width="50%">
                        <table class="tsel" border="0">
                            <tr><td colspan="2" align="center">
                                    <div id="outdiv">
                                    </div></td></tr>
                        </table>
                    </td>
                </tr>
                <tr><td colspan="3" align="center">
                        <div id="result"></div>
                    </td></tr>
            </table>

        </div>
    </div>
    <canvas id="qr-canvas" width="800" height="600"></canvas>
    <script type="text/javascript">load();</script>

@endsection